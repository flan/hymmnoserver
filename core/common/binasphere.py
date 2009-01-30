import re

_BINASPHERE_REGEXP = re.compile("^=>([A-Zx ]+)EXEC[ _]hymme 2x1/0>>([01]+)$")

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
		
		
def _reconstructBinasphere(tokens, sequence):
	buffers = [[], []]
	words = ([], [])
	
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
			raise ContentError("String %i contains an unterminated word" % (i))
			
	return words
	
def decodeBinasphere(line):
	match = _BINASPHERE_REGEXP.match(line)
	if not match:
		raise FormatError("Non-Binasphere input provided")
		
	return _reconstructBinasphere(
	 match.group(1).strip().split(),
	 [int(i) for i in match.group(2)]
	)
	
def _divideAndCapitalise(words, db_con):
	#Load every word from the database.
	#every time ES(I) is reached, start a new word line.
	
def divideAndCapitalise(words, db_con):
	lines = []
	for token_string in words:
		lines.append(_divideAndCapitalise(token_string, db_con))
		
print decodeBinasphere("=> RRHA RRHA GUWO Ax GAx PEx GIS A GAx TIE INNx GIS NA GRAN GAx PAUL NOx TYUNY INI SAASH AR YANJE CIEL EN INI LA ZAx AR HHA CIEL RRHA RRHA Ax GUWO GA PEx GAx A TYUNY RA HARx AR CIEL TES EN YORA INI CHYET WAx SOR GAx LAx TYUNx SYE LA FORx GANx ART SA DAL FAYx WASSA RA CIEL EXEC hymme 2x1/0>>01101010")
