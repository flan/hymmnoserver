import re
import threading
import cgi

EMOTION_VOWELS = 'A|I|U|E|O|N|YA|YI|YU|YE|YO|YN|LYA|LYI|LYU|LYE|LYO|LYN'
_EMOTION_VOWELS_REGEXP = r'(%s)' % (EMOTION_VOWELS)
_EMOTION_VOWELS_REGEXP_FULL = r'(%s|\.)?' % (EMOTION_VOWELS)
_WORD_STRUCTURE = "^%s?(.+?)(_\w+)?$" % (_EMOTION_VOWELS_REGEXP)

_EMOTION_WORDS_REGEXP = re.compile('^(%s)(\w+)$' % (EMOTION_VOWELS))

_INIT_LOCK = threading.Lock()
_EMOTION_VERB_REGEXPS = None

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
}

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
}

def _getEmotionVerbs(db_con):
	cursor = db_con.cursor()
	cursor.execute("SELECT word, school FROM hymmnos WHERE class = 1")
	emotion_verbs = cursor.fetchall()
	cursor.close()
	
	return emotion_verbs
	
def initialiseEmotionVerbRegexps(db_con):
	global _EMOTION_VERB_REGEXPS
	_INIT_LOCK.acquire()
	try:
		if not _EMOTION_VERB_REGEXPS:
			emotion_verbs = _getEmotionVerbs(db_con)
			_EMOTION_VERB_REGEXPS = [(
			 re.compile(r"^%s(eh)?$" % (ev.replace(".", _EMOTION_VOWELS_REGEXP_FULL))),
			 ev, d) for (ev, d) in emotion_verbs]
	finally:
		_INIT_LOCK.release()
		
def _queryWord(word, dialect, db_con):
	limiter = "ORDER BY school ASC"
	if dialect:
		limiter = "AND school = %i" % (dialect)
		
	cursor = db_con.cursor()
	cursor.execute("SELECT word, meaning_english, kana, class, school, syllables FROM hymmnos WHERE word = %s " + limiter, (word,))
	records = cursor.fetchall()
	cursor.close()
	
	if records:
		return tuple([[word, meaning_english, kana, syntax_class, dialect, None, syllables.split('/')] for (word, meaning_english, kana, syntax_class, dialect, syllables) in records])
	return ([word, None, None, 0, 0, None, [word.lower()]],)
	
def _queryEmotionVerb(word, dialect, db_con):
	for (ev_re, ev, d) in _EMOTION_VERB_REGEXPS:
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
			
			syllables = record[0][0].split('.')
			for i in range(ev.count('.')):
				decoration = decorations[i]
				if decoration:
					syllables[i] += decoration
			if decorations[-1]:
				syllables.append(decorations[-1])
				
			return record
	return None
	
def _queryWord(word, dialect, db_con):
	match = _WORD_STRUCTURE.match(word)
	records = _queryWord(match.group(2), dialect, db_con)
	valid = False
	for record in records:
		if record[3] > 0: #Entry found.
			record[5] = [match.group(1), match.group(3)]
			record[6].insert(0, match.group(1))
			valid = True
	return records
	
def readWord(word, db_con):
	"""
	[word, meaning_english, kana, class, dialect, decorations, syllables]
	"""
	dialect = None #Limit returned records to a specific dialect.
	position = word.find('$')
	if position > -1:
		try:
			dialect = int(word[position + 1:])
		except:
			pass
		word = word[:position]
		
	return _queryEmotionVerb(word, dialect, db_con) or _queryWord(word, dialect, db_con)
	
def decorateWord(word, syntax_class, decorations, colours):
	if not decorations:
		return cgi.escape(word)
		
	for (i, d) in enumerate(decorations):
		if d is None:
			decorations[i] = ''
			
	if syntax_class in SYNTAX_CLASS_REV['EV']: #Emotion Verb
		result = []
		for (chunk, vowel) in zip(word.split('.'), decorations[:-1]):
			result.append(cgi.escape(chunk))
			if colours:
				result.append(("<span style=\"color: %s;\">" % colours[0]) + cgi.escape(vowel) + "</span>")
			else:
				result.append(cgi.escape(vowel))
		if decorations[-1]:
			if colours:
				result.append(("<span style=\"color: %s;\">" % colours[1]) + cgi.escape(decorations[-1]) + "</span>")
			else:
				result.append(cgi.escape(decorations[-1]))
		return ''.join(result)
		
	if syntax_class in SYNTAX_CLASS_REV['n'] or syntax_class in SYNTAX_CLASS_REV['adj']: #noun/adj
		if colours:
			result = []
			if decorations[0]:
				result.append("<span style=\"color: %s;\">" % colours[0]) + cgi.escape(decorations[0]) + "</span>")
			result.append(cgi.escape(word))
			if decorations[1]:
				result.append("<span style=\"color: %s;\">" % colours[1]) + cgi.escape(decorations[1]) + "</span>")
			return ''.join(result)
		return decorations[0] + word + decorations[1]
		