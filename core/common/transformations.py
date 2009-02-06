import re
import random

import lookup

_BINASPHERE_REGEXP = re.compile("^=>([A-Zx ]+)EXEC[ _]hymme (\d*[1-9])x1/0[ ]?>>((?:[ ]?\d+)+)$")
_PERSISTANT_START_REGEXP = re.compile("^([A-Za-z]+) ([A-Za-z]+) ([A-Za-z]+) 0x vvi.$")
_PERSISTANT_END_REGEXP = re.compile("^1x AAs ixi.$")

class Error(Exception):
	"""
	This class serves as the base from which all exceptions native to this
	module are derived.
	"""
	description = None #: A description of the error.
	
	def __str__(self):
		"""
		This function returns an ASCII version of the description of this Error.
		
		When possible, the Unicode version should be used instead.		
		
		@rtype: str
		@return: The description of this error. 
		"""
		return str(self.description)
		
	def __unicode__(self):
		"""
		This function returns the description of this Error.		
		
		@rtype: unicode
		@return: The description of this error. 
		"""
		return self._description
		
	def __init__(self, description):
		"""
		This function is invoked when creating a new Error object.
		
		@type description: basestring
		@param description: A description of the problem that this object
		    represents.
		
		@return: Nothing.
		"""
		self.description = unicode(description)
		
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
		self.description = unicode(description)
		
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
		self.description = unicode(description)
		
		
def _readWord(word, db_con):
	(word, meaning_english, kana, syntax_class, dialect, decorations, syllables) = lookup.readWord(word, db_con)[0]
	if syntax_class > 0:
		if dialect % 50 == lookup.DIALECT['New Testament of Pastalie'] or decorations:
			reason = "'%s'" % (word)
			if decorations and not dialect % 50 == lookup.DIALECT['New Testament of Pastalie']:
				reason += " (carried markup)"
			raise ContentError("Only Central Standard Note and related dialects are Binasphere-supported (offending word: %s)" % (reason))
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
			raise ContentError("String %i contains an unterminated word (fragment: '%s')" % (i, ''.join(buffer)))
			
	return words
	
def decodeBinasphere(line, db_con):
	match = _BINASPHERE_REGEXP.match(line)
	if not match:
		raise FormatError("Non-Binasphere input provided")
		
	tokens = match.group(1).strip().split()
	size = int(match.group(2))
	
	sequence = match.group(3).strip().split()
	if len(sequence) == 1:
		if size > 9:
			raise ContentError("For line-counts greater than 9, sequence entries must be space-delimited")
		sequence = sequence[0]
	sequence = [int(i) for i in sequence]
	
	return _divideAndCapitalise(_reconstructBinasphere(tokens, sequence, size), db_con)
	
def _divideAndCapitaliseLine(words, db_con):
	lines = []
	buffer = []
	unknown = set()
	
	for word in words:
		(word, syntax_class, dialect, syllables) = _readWord(word.lower(), db_con)
		if syntax_class > 0:
			if syntax_class in lookup.SYNTAX_CLASS_REV['ES(I)'] and buffer: #Trailing ES(I)
				lines.append(' '.join(buffer))
				buffer = []
			buffer.append(word)
		else:
			word = word.lower()
			buffer.append(word)
			unknown.add(word)
	return (lines + [' '.join(buffer)], unknown)
	
def _divideAndCapitalise(words, db_con):
	lookup.initialiseEmotionVerbRegexps(db_con)
	
	lines = []
	unknown_set = set()
	for token_string in words:
		(line_list, unknown) = _divideAndCapitaliseLine(token_string, db_con)
		lines.append(line_list)
		unknown_set.update(unknown)
	return (lines, sorted(unknown))
	
def _dissectSyllables(words, db_con):
	lines = []
	buffer = []
	line_syllables = []
	unknown = set()
	
	for word in words:
		(word, syntax_class, dialect, syllables) = _readWord(word, db_con)
		if syntax_class > 0:
			if syntax_class in lookup.SYNTAX_CLASS_REV['ES(I)'] and buffer: #Trailing ES(I)
				lines.append(' '.join(buffer))
				buffer = []
			buffer.append(word)
			line_syllables += [syllable.upper() + 'x' for syllable in syllables[:-1]] + [syllables[-1].upper()]
		else:
			buffer.append(word.lower())
			line_syllables.append(word.upper())
			unknown.add(word)
	return (lines + [' '.join(buffer)], line_syllables, unknown)
	
def _multiplexBinasphere(lines, hashable):
	output_sequence = []
	
	syllable_count = [len(syllables) for syllables in lines]
	greatest_factor = None
	for i in range(min(syllable_count), 0, -1):
		if not [None for s_c in syllable_count if s_c % i]:
			greatest_factor = i
			
	pool = []
	for (i, n) in enumerate([s_c / greatest_factor for s_c in syllable_count]):
		pool += [i] * n
	random.Random(hashable).shuffle(pool)
	
	while True:
		for i in pool:
			output_sequence.append(lines[i].pop(0))
		if not [None for p in pool if p]:
			break
			
	sequence = None
	if len(lines) > 10:
		sequence = ' '.join(pool)
	else:
		sequence = ''.join(pool)
	return "=> %s EXEC hymme %ix1/0>>%s" % (' '.join(output_sequence), len(lines), sequence)
	
def encodeBinasphere(lines, db_con):
	lookup.initialiseEmotionVerbRegexps(db_con)
	
	new_lines = []
	syllable_lines = []
	unknown_set = set()
	for l in lines:
		(lines, syllable_line, unknown) = _dissectSyllables(l.split(), db_con)
		new_lines.append(lines)
		syllable_lines.append(syllable_line)
		unknown_set.update(unknown)
	return (_multiplexBinasphere(syllable_lines, lines.join('').lower()), new_lines, sorted(unknown))
	
def _applyPersistentEmotionSounds(es_i, es_ii, es_iii, words, db_con):
	lines = []
	buffer = []
	line = []
	unknown = set()
	
	for word in words:
		(word, syntax_class, dialect, syllables) = _readWord(word, db_con)
		if syntax_class > 0:
			if syntax_class in lookup.SYNTAX_CLASS_REV['ES(I)'] and buffer: #Trailing ES(I)
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
	
def applyPersistentEmotionSounds(lines, db_con):
	m = _PERSISTANT_START_REGEXP.match(lines[0])
	if not m or not _PERSISTANT_END_REGEXP.match(lines[-1]):
		raise FormatError("Persistant syntax not detected")
		
	new_lines = []
	processed = []
	unknown_set = set()
	
	es_i = None
	es_ii = None
	es_iii = None
	words = lookup.readWord(m.group(1).lower(), db_con)
	for (word, meaning_english, kana, syntax_class, dialect, decorations, syllables) in words:
		if syntax_class in lookup.SYNTAX_CLASS_REV['ES(I)']:
			 es_i = word
			 break
	if not es_i:
		es_i = m.group(1).title()
		unknown.add(es_i)
		
	words = lookup.readWord(m.group(2).lower(), db_con)
	for (word, meaning_english, kana, syntax_class, dialect, decorations, syllables) in words:
		if syntax_class in lookup.SYNTAX_CLASS_REV['ES(II)']:
			 es_ii = word
			 break
	if not es_ii:
		es_ii = m.group(2).lower()
		unknown.add(es_ii)
		
	words = lookup.readWord(m.group(3).lower(), db_con)
	for (word, meaning_english, kana, syntax_class, dialect, decorations, syllables) in words:
		if syntax_class in lookup.SYNTAX_CLASS_REV['ES(III)']:
			 es_iii = word
			 break
	if not es_iii:
		es_iii = m.group(3).title()
		unknown.add(es_iii)
		
	for line in lines[1:-1]:
		(line, processed_lines, unknown) = _applyPersistentEmotionSounds(es_i, es_ii, es_iii, line.split(), db_con)
		new_lines.append(line)
		processed.append(processed_lines)
		unknown_set.update(unknown)
		
	return (["%s %s %s 0x vvi." % (es_i, es_ii, es_iii)] + new_lines + line[-1], processed, sorted(unknown_set))
	