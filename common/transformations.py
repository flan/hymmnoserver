# -*- coding: utf-8 -*-
"""
HymmnoServer module: transformations

Purpose
=======
 Provides library routines for Binasphere codec logic, and support for the
 Persistant Emotion Sounds definition syntax.
 
Legal
=====
 All code, unless otherwise indicated, is original, and subject to the terms of
 the GNU GPLv3 or, at your option, any later version of the GPL.
 
 All content is derived from public domain, promotional, or otherwise-compatible
 sources and published uniformly under the
 Creative Commons Attribution-Share Alike 3.0 license.
 
 See license.README for details.
 
 (C) Neil Tallim, 2009-2021
"""
import random
import re

from . import lookup

_BINASPHERE_REGEXP = re.compile("^=>(.+?)EXEC[ _]hymme (\d*[1-9])x1/0[ ]?>>((?:[ ]?\d+)+)$") #: A regular expression used to match encoded Binasphere content.
_BINASPHERE_CONTENT_REGEXP = re.compile("^[A-Z0-9x= ]+$") #: A regular expression used to restrict Binasphere input to valid characters.
_PERSISTANT_START_REGEXP = re.compile("^([A-Za-z]+) ([A-Za-z]+) ([A-Za-z]+) 0x vvi\.$") #: A regular expression used to match the opening stanza of Persistent Emotion Sounds structures.
_PERSISTANT_END_REGEXP = re.compile("^1x AAs ixi\.$") #: A regular expression used to match the closing stanza of Persistent Emotion Sounds structures.
_GENERAL_CONTENT_REGEXP = re.compile("^[\w= ]+$") #: A regular expression used to catch characters that are always unwanted.

def applyPersistentEmotionSounds(lines, db_con):
    m = _PERSISTANT_START_REGEXP.match(lines[0])
    if not _PERSISTANT_END_REGEXP.match(lines[-1]):
        if not m:
            raise FormatError("Persistant syntax not detected")
        else:
            raise ContentError("Persistent Emotion Sounds terminator not found")
    elif not m:
        raise ContentError("Persistent Emotion Sounds initiator not found")
        
    lookup.initialiseEmotionVerbRegexps(db_con)
    
    new_lines = []
    processed = []
    unknown_set = set()
    
    es_i = None
    es_ii = None
    es_iii = None
    es_i_values = lookup.SYNTAX_CLASS_REV['ES(I)']
    words = lookup.readWord(m.group(1).lower(), None, db_con)
    for (word, meaning, kana, syntax_class, dialect, decorations, syllables) in words:
        if syntax_class in es_i_values:
             es_i = word
             break
    if not es_i:
        es_i = m.group(1).title()
        unknown.add(es_i)
        
    es_ii_values = lookup.SYNTAX_CLASS_REV['ES(II)']
    words = lookup.readWord(m.group(2).lower(), None, db_con)
    for (word, meaning, kana, syntax_class, dialect, decorations, syllables) in words:
        if syntax_class in es_ii_values:
             es_ii = word
             break
    if not es_ii:
        es_ii = m.group(2).lower()
        unknown.add(es_ii)
        
    es_iii_values = lookup.SYNTAX_CLASS_REV['ES(III)']
    words = lookup.readWord(m.group(3).lower(), None, db_con)
    for (word, meaning, kana, syntax_class, dialect, decorations, syllables) in words:
        if syntax_class in es_iii_values:
             es_iii = word
             break
    if not es_iii:
        es_iii = m.group(3).title()
        unknown.add(es_iii)
        
    for line in lines[1:-1]:
        if not _GENERAL_CONTENT_REGEXP.match(line):
            raise ContentError("Non-Hymmnos content provided")
        (line, processed_lines, unknown) = _applyPersistentEmotionSounds(es_i, es_ii, es_iii, line.split(), db_con)
        new_lines.append(line)
        processed.append(processed_lines)
        unknown_set.update(unknown)
        
    return (
        ["{es_i} {es_ii} {es_iii} 0x vvi.".format(
            es_i=es_i,
            es_ii=es_ii,
            es_iii=es_iii,
        )] + new_lines + lines[-1:],
        processed,
        sorted(unknown_set),
    )
    
def decodeBinasphere(line, db_con):
    match = _BINASPHERE_REGEXP.match(line)
    if not match:
        raise FormatError("Non-Binasphere input provided")
    if not _BINASPHERE_CONTENT_REGEXP.match(match.group(1)):
        raise ContentError("Invalid Binasphere content provided")
        
    tokens = match.group(1).strip().split()
    size = int(match.group(2))
    
    sequence = match.group(3).strip().split()
    if len(sequence) == 1:
        if size > 9:
            raise ContentError("For line-counts greater than 9, sequence entries must be space-delimited")
        sequence = sequence[0]
    sequence = [int(i) for i in sequence]
    
    lookup.initialiseEmotionVerbRegexps(db_con)
    
    return _divideAndCapitalise(_reconstructBinasphere(tokens, sequence, size), db_con)
    
def encodeBinasphere(lines, db_con):
    lookup.initialiseEmotionVerbRegexps(db_con)
    
    new_lines = []
    syllable_lines = []
    unknown_set = set()
    for line in lines:
        if not _GENERAL_CONTENT_REGEXP.match(line):
            raise ContentError("Non-Hymmnos content provided for Binasphere encoding")
        (lines, syllable_line, unknown) = _dissectSyllables(line.split(), db_con)
        new_lines.append(lines)
        syllable_lines.append(syllable_line)
        unknown_set.update(unknown)
    return (_multiplexBinasphere(syllable_lines, ''.join(lines).lower()), new_lines, sorted(unknown))
    
def _applyPersistentEmotionSounds(es_i, es_ii, es_iii, words, db_con):
    lines = []
    buffer = []
    line = []
    unknown = set()
    
    es_i_values = lookup.SYNTAX_CLASS_REV['ES(I)']
    plain_words = lookup.readWords(tuple(set(words)), db_con)
    for word in words:
        (word, syntax_class, dialect, syllables) = _readWord(word, plain_words, db_con)
        if syntax_class > 0:
            if syntax_class in es_i_values and buffer: #Trailing ES(I)
                lines.append(' '.join(buffer))
                buffer = []
            if not buffer and not lines and not syntax_class in lookup.SYNTAX_CLASS_REV['ES(I)']:
                buffer = [es_i, es_ii, es_iii]
            buffer.append(word)
            line.append(word)
        else:
            word = word.lower()
            buffer.append(word)
            line.append(word)
            unknown.add(word)
    return (' '.join(line), lines + [' '.join(buffer)], unknown)
    
def _dissectSyllables(words, db_con):
    lines = []
    buffer = []
    line_syllables = []
    unknown = set()
    
    es_i_values = lookup.SYNTAX_CLASS_REV['ES(I)']
    plain_words = lookup.readWords(tuple(set(words)), db_con)
    for word in words:
        (word, syntax_class, dialect, syllables) = _readWord(word, plain_words, db_con)
        if syntax_class > 0:
            if syntax_class in es_i_values and buffer: #Trailing ES(I)
                lines.append(' '.join(buffer))
                buffer = []
            buffer.append(word)
            line_syllables += [syllable.upper() + 'x' for syllable in syllables[:-1]] + [syllables[-1].upper()]
        else:
            buffer.append(word.lower())
            line_syllables.append(word.upper())
            unknown.add(word)
    return (lines + [' '.join(buffer)], line_syllables, unknown)
    
def _divideAndCapitalise(words, db_con):
    lines = []
    unknown_set = set()
    for token_string in words:
        (line_list, unknown) = _divideAndCapitaliseLine(token_string, db_con)
        lines.append(line_list)
        unknown_set.update(unknown)
    return (lines, sorted(unknown))
    
def _divideAndCapitaliseLine(words, db_con):
    lines = []
    buffer = []
    unknown = set()
    
    es_i_values = lookup.SYNTAX_CLASS_REV['ES(I)']
    plain_words = lookup.readWords(tuple(set(words)), db_con)
    for word in words:
        (word, syntax_class, dialect, syllables) = _readWord(word.lower(), plain_words, db_con)
        if syntax_class > 0:
            if syntax_class in es_i_values and buffer: #Trailing ES(I)
                lines.append(' '.join(buffer))
                buffer = []
            buffer.append(word)
        else:
            word = word.lower()
            buffer.append(word)
            unknown.add(word)
    return (lines + [' '.join(buffer)], unknown)
    
def _multiplexBinasphere(lines, hashable):
    output_sequence = []
    
    syllable_count = [len(syllables) for syllables in lines]
    greatest_factor = None
    for i in range(min(syllable_count), 0, -1):
        if not [None for s_c in syllable_count if s_c % i]:
            greatest_factor = i
            break
            
    pool = []
    for (i, n) in enumerate([s_c / greatest_factor for s_c in syllable_count]):
        pool += [i] * n
    random.Random(hashable).shuffle(pool)
    
    while True:
        for i in pool:
            output_sequence.append(lines[i].pop(0))
        if not [None for l in lines if l]:
            break
    pool = map(str, pool)
    
    sequence = None
    if len(lines) > 10:
        sequence = ' '.join(pool)
    else:
        sequence = ''.join(pool)
    return "=> {output} EXEC hymme {count}x1/0>>{sequence}".format(
        output=' '.join(output_sequence),
        count=len(lines),
        sequence=sequence,
    )
    
def _readWord(word, words, db_con):
    (word, meaning, kana, syntax_class, dialect, decorations, syllables) = lookup.readWord(word, words, db_con)[0]
    if syntax_class > 0:
        l_decorations = decorations
        if l_decorations:
            l_decorations = [d for d in decorations if d]
        if l_decorations or (dialect % 50 == lookup.DIALECT['New Testament of Pastalie']):
            reason = ["'", word, "'",]
            if l_decorations and not (dialect % 50 == lookup.DIALECT['New Testament of Pastalie']):
                reason += [" (carried markup: ", l_decorations, ")",]
            raise ContentError("Only Central Standard Note and related dialects are Binasphere-supported (offending word: {reason})".format(
                reason=''.join(reason),
            ))
    return (word, syntax_class, dialect, syllables)
    
def _reconstructBinasphere(tokens, sequence, size):
    buffers = [[] for i in range(size)]
    words = tuple([[] for i in range(size)])
    
    while True:
        for i in sequence:
            if not tokens:
                raise ContentError("Syllable-count not a multiple of sequence length")
            fragment = tokens.pop(0)
            if fragment.endswith('x'):
                buffers[i].append(fragment[:-1])
            else:
                words[i].append(''.join(buffers[i] + [fragment]))
                buffers[i] = []
                
        if not tokens:
            break
            
    for (i, buffer) in enumerate(buffers):
        if buffer:
            raise ContentError("String {string} contains an unterminated word (fragment: '{fragment}')".format(
                string=i,
                fragment=''.join(buffer),
            ))
            
    return words
    
    
class Error(Exception):
    """
    This class serves as the base from which all exceptions native to this
    module are derived.
    """
    description = None #: A description of the error.
    
    def __str__(self):
        """
        This function returns a description of this Error.
        
        @rtype: str
        @return: The description of this error. 
        """
        return str(self.description)
        
    def __init__(self, description):
        """
        This function is invoked when creating a new Error object.
        
        @type description: basestring
        @param description: A description of the problem that this object
            represents.
        
        @return: Nothing.
        """
        self.description = str(description)
        
class ContentError(Error):
    """
    This class represents problems that might occur because of invalid data.
    """
    def __init__(self, description):
        """
        This function is invoked when creating a new ContentError object.
        
        @type description: basestring
        @param description: A description of the problem that this object
            represents.
        
        @return: Nothing.
        """
        self.description = str(description)
        
class FormatError(Error):
    """
    This class represents problems that might occur because of ill-formed data.
    """
    def __init__(self, description):
        """
        This function is invoked when creating a new FormatError object.
        
        @type description: basestring
        @param description: A description of the problem that this object
            represents.
        
        @return: Nothing.
        """
        self.description = str(description)
        
