# -*- coding: utf-8 -*-
"""
Hymmnoserver module: common.lookup

Purpose
=======
 Reads words from the database, applying class-inference and
 structure-processing as required.
 
Legal
=====
 All code, unless otherwise indicated, is original, and subject to the terms of
 the GNU GPLv3 or, at your option, any later version of the GPL.
 
 All content is derived from public domain, promotional, or otherwise-compatible
 sources and published uniformly under the
 Creative Commons Attribution-Share Alike 3.0 license.
 
 See license.README for details.
 
 (C) Neil Tallim, 2009
"""
import cgi
import re
import threading

EMOTION_VOWELS = r'A|I|U|E|O|N|YA|YI|YU|YE|YO|YN|LYA|LYI|LYU|LYE|LYO|LYN' #: A regexp fragment containing all known Emotion Vowels.
_EMOTION_VOWELS_FULL = r'(%(emotion_vowels)s|\.)?' % {
 'emotion_vowels': EMOTION_VOWELS,
} #: A regexp fragment containing all emotion vowels and a bank-slot marker in a capture group.

WORD_STRUCTURE_REGEXP = re.compile(r"^(%(emotion_vowels)s)?(.+?)(_\w+)?$" % {
 'emotion_vowels': EMOTION_VOWELS,
}) #: A regular expression that matches Pastalia-ized nouns.
_EMOTION_WORDS_REGEXP = re.compile(r'^(%(emotion_vowels)s)(\w+)$' % {
 'emotion_vowels': EMOTION_VOWELS,
}) #: A regular expression that matches any Pastalia-ized word.

EMOTION_VERB_REGEXPS = None #: A collection of regular expressions that match all Emotion Verbs known to exist, plus the pure word forms and dialects.

SYNTAX_CLASS_REV = {
 'ES(I)': (14,),
 'ES(II)': (7,),
 'ES(III)': (13,),
 'EV': (1,),
 'adj': (8, 10, 11, 20),
 'adv': (3, 19, 20),
 'conj': (5,),
 'cnstr': (18,),
 'intj': (16,),
 'n': (4, 9, 10, 19),
 'prep': (6,),
 'pron': (15,),
 'prt': (12,),
 'v': (2, 9, 11)
} #: A mapping from symbolic lexical class identifiers to numeric constants, used to make code more readable.

DIALECT = {
 'Unknown': 0,
 'Central Standard Note': 1,
 'Cult Ciel Note': 2,
 'Cluster Note': 3,
 'Alpha Note': 4,
 'Metafalss Note': 5,
 'New Testament of Pastalie': 6,
 'Alpha Note (EOLIA)': 7,
 'Unknown [Unofficial]': 50,
 'Central Standard [Unofficial]': 51,
 'Cult Ciel [Unofficial]': 52,
 'Cluster [Unofficial]': 53,
 'Alpha [Unofficial]': 54,
 'Metafalss [Unofficial]': 55,
 'Pastalia [Unofficial]': 56,
 '(EOLIA) [Unofficial]': 57
} #: A mapping from symbolic dialect identifiers to numeric constants, used to make code more readable.

def initialiseEmotionVerbRegexps(db_con):
	global EMOTION_VERB_REGEXPS
	
	if not EMOTION_VERB_REGEXPS:
		emotion_verbs = _getEmotionVerbs(db_con)
		EMOTION_VERB_REGEXPS = tuple([(
		 re.compile(r"^%(emotion_vowels_full)s(eh|aye|za)?$" % {
		  'emotion_vowels_full': (ev.replace(".", _EMOTION_VOWELS_FULL)),
		 }),
		 ev,
		 d,
		) for (ev, d) in emotion_verbs])
		
def readWord(word, words, db_con):
	"""
	[word, meaning, kana, class, dialect, decorations, syllables]
	"""
	dialect = None #Limit returned records to a specific dialect.
	position = word.find('$')
	if position > -1:
		try:
			dialect = int(word[position + 1:])
		except:
			pass
		word = word[:position]
		
	if words:
		w = words.get(word.lower())
		if w:
			return tuple([list(elements) for elements in w if not dialect or elements[4] == dialect])
	return _queryEmotionVerb(word, dialect, db_con) or _queryWord(word, dialect, db_con)
	
def readWords(words, db_con):
	"""
	{word.lower(): [word, meaning, kana, class, dialect, decorations, syllables]}
	"""
	cursor = db_con.cursor()
	cursor.execute("SELECT word, meaning, kana, class, dialect, syllables FROM hymmnos WHERE word IN (" + ','.join(['%s' for w in words])  + ") ORDER BY dialect ASC", words)
	records = cursor.fetchall()
	cursor.close()
	
	r_words = {}
	for (word, meaning, kana, syntax_class, dialect, syllables) in records:
		l_word = word.lower()
		w = r_words.get(l_word)
		if not w:
			w = []
			r_words[l_word] = w
		w.append([word, meaning, kana, syntax_class, dialect, None, syllables.split('/')])
		
	for word in r_words:
		r_words[word] = tuple(r_words[word])
	return r_words
	
def _getEmotionVerbs(db_con):
	cursor = db_con.cursor()
	cursor.execute("SELECT word, dialect FROM hymmnos WHERE class = 1")
	emotion_verbs = cursor.fetchall()
	cursor.close()
	
	return emotion_verbs
	
def _readWord(word, dialect, db_con):
	limiter = "ORDER BY dialect ASC"
	if dialect:
		limiter = "AND dialect = %(dialect)i" % {
		 'dialect': dialect,
		}
		
	cursor = db_con.cursor()
	cursor.execute("SELECT word, meaning, kana, class, dialect, syllables FROM hymmnos WHERE word = %s " + limiter, (word,))
	records = cursor.fetchall()
	cursor.close()
	
	if records:
		return tuple([[word, meaning, kana, syntax_class, dialect, None, syllables.split('/')] for (word, meaning, kana, syntax_class, dialect, syllables) in records])
	return ([word, None, None, 0, 0, None, [word.lower()]],)
	
def _queryEmotionVerb(word, dialect, db_con):
	for (ev_re, ev, d) in EMOTION_VERB_REGEXPS:
		if dialect and not d == dialect: #Support filtering.
			continue
			
		match = ev_re.match(word)
		if match:
			record = _queryWord(ev, d, db_con)
			decorations = record[0][5] = []
			for group in match.groups()[:-1]:
				if group:
					decorations.append(group)
				else:
					decorations.append('.')
			decorations.append(match.groups()[-1])
			
			return record
	return None
	
def _queryWord(word, dialect, db_con):
	match = WORD_STRUCTURE_REGEXP.match(word)
	records = _readWord(match.group(2), dialect, db_con)
	valid = False
	for record in records:
		if record[3] > 0: #Entry found.
			record[5] = [match.group(1), match.group(3)]
			valid = True
	return records
	