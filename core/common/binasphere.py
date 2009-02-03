import re
import random

import lookup

lookup.initialiseEmotionVerbRegexps(_db_con)

_BINASPHERE_REGEXP = re.compile("^=>((?:[A-Zx ]|%s)+)EXEC[ _]hymme (\d*[1-9])x1/0[ ]?>>((?:[ ]?\d+)+)$" % lookup.EMOTION_VOWELS.swapcase())
"""Binasphere sequence generator.
To build pool, count the number of syllables in each line, and divide by the greatest common factor.
rnd = random.Random(647)
pool = [5, 4, 2] # [[0, 0, 0, 0, 0], [1, 1, 1, 1], [2, 2]]
while max(pool):
	count = float(sum(pool))
	spread = [c/count for c in pool]
	num = rnd.random()
	for (i, s) in enumerate(spread):
		if num < s + sum(spread[:i]):
			print i
			pool[i] -= 1
			break
"""

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
		
		
def _reconstructBinasphere(tokens, sequence, size):
	buffers = [[] for i in range(size)]
	words = tuple([[] for i in range(size)])
	
	while True:
		for i in sequence:
			if not tokens:
				raise ContentError("Fewer syllables than expected found in input")
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
	
def decodeBinasphere(line):
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
	
	return _reconstructBinasphere(tokens, sequence, size)
	
def _divideAndCapitalise(words, db_con):
	lines = []
	buffer = []
	unknown = set()
	
	cursor = db_con.cursor()
	for word in words:
		cursor.execute("SELECT word, class FROM hymmnos WHERE word = %s LIMIT 1", (word,))
		result = cursor.fetchone()
		if result:
			if result[1] == 14 and buffer: #ES(I)
				lines.append(' '.join(buffer))
				buffer = []
			buffer.append(result[0])
		else:
			word = word.lower()
			buffer.append(word)
			unknown.add(word)
	cursor.close()
	
	return (lines + [' '.join(buffer)], unknown)
	
def divideAndCapitalise(words, db_con):
	lines = []
	unknown_set = set()
	for token_string in words:
		(line_list, unknown) = _divideAndCapitalise(token_string, db_con)
		lines.append(line_list)
		unknown_set.update(unknown)
	return (lines, sorted(unknown))
	