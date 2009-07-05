# -*- coding: utf-8 -*-
"""
Hymmnoserver module: common.syntax

Purpose
=======
 Processes Hymmnos, producing syntax trees upon sucess.
 
Legal
=====
 All code, unless otherwise indicated, is original, and subject to the terms of
 the Creative Commons Attribution-Noncommercial-Share Alike 3.0 License,
 which is provided in license.README.
 
 (C) Neil Tallim, 2009
"""
import cgi
import re
import urllib
import xml.dom.minidom

import lookup

_ANY = 0 #: An AST classifier that requires 0-or-more matches from its set.
_ALL = -1 #: An AST classifier that requires every set member to match.
_ONE = 1 #: An AST classifier that requires at least one member to match. (Successive matches are ignored)

_GENERAL_AST = (_ALL,
 (_ANY,
  (_ONE,
   (_ALL,
    (_ANY, 'ESP'),
    (_ANY, (_ONE, 'SgP', (_ANY, 'NP'))),
    'VP'
   ),
   (_ALL, 'ESP', 'SgP', 'VP')
  )
 ),
 'CgP',
) #: The AST that describes standard Hymmnos.

_PASTALIA_AST = (_ALL,
 (_ANY, 'SpP'),
 'EVP',
 'CpP',
) #: The AST that describes Pastalia Hymmnos.

_AST_FRAGMENTS = {
 'AP': (_ONE,
  (_ALL,
   6,
   (_ANY, 'AP'),
   (_ANY, (_ALL, 5, 'AP'))
  ),
  (_ALL,
   8,
   (_ANY, 'AP'),
   (_ANY, (_ALL, 5, 'AP'))
  ),
  (_ALL,
   3,
   (_ANY, 'AP'),
   (_ANY, (_ALL, 5, 'AP'))
  ),
  (_ALL,
   12,
   (_ANY, 'AP'),
   (_ANY, (_ALL, 5, 'AP'))
  ),
  (_ALL,
   15,
   (_ANY, 'AP'),
   (_ANY, (_ALL, 5, 'AP'))
  ),
 ),
 'CgP': (_ANY,
  (_ONE,
   'NP',
   (_ALL, 'VP', (_ANY, 'NP'), 'CgP')
  )
 ),
 'CpP': (_ANY,
  (_ONE,
   'NP',
   (_ALL, 'VP', (_ANY, 'NP'), 'CpP'))
  )
 ),
 'ESP': (_ALL, 14, 7, 13),
 'EVNP': (_ALL,
  (_ANY, 'AP'),
  1,
  (_ANY,
   (_ALL,
    (_ANY, (_ONE, 6, 12)),
    (_ONE, 'EVOP', 'NP'),
    (_ANY, 'PP')
   )
  ),
 ),
 'EVOP': (_ALL,
  'x.$6',
  (_ONE,
   (_ALL, (_ANY, 'rre$1'), 15),
   (_ALL, 'rre$1', 'NP')
  ),
  'EVP'
 ),
 'EVP': (_ALL,
  (_ANY, 'AP'),
  1,
  (_ANY, 'SpP'),
  (_ANY,
   (_ALL,
    (_ANY, (_ONE, 6, 12)),
    (_ONE, 'NP', 'EVNP'),
    (_ANY,
     (_ONE, (_ALL, 5, 'EVP'), 'PP')
    )
   )
  ),
 ),
 'NP': (_ONE,
  (_ALL, 'AP', 'NP'),
  (_ALL, 4, 'NP'),
  4,
  (_ALL, (_ONE, 5, 6), 'NP')
 ),
 'NsP': (_ONE,
  (_ALL, 'AP', 'NsP'),
  (_ALL, 4, 'NsP'),
  4,
  (_ALL, (_ONE, 5, 6), 'NsP')
 ),
 'NvP': (_ALL,
  (_ANY, 'AP'),
  4
 ),
 'PP': (_ALL, (_ONE, 6, 12), 'NP'),
 'SgP': (_ONE, (_ALL, 'rre$1', 'NP'), 15),
 'SpP': (_ALL,
  'x.$6',
  (_ONE,
   (_ALL, (_ANY, 'rre$1'), 15),
   (_ALL, 'rre$1', 'NsP')
  )
 ),
 'VP': (_ALL,
  (_ANY, (_ONE, 'na$1', 're$1', 'zz$6')),
  (_ANY, 'AP'),
  2,
  (_ANY,
   (_ALL,
    (_ANY, (_ONE, 6, 12)),
    (_ONE,
     (_ALL,
      'NvP',
      (_ONE, 'tes$1', 'ut$6'),
      'NP'
     ),
     'NP'
    ),
    (_ANY, 'PP')
   ),
   (_ALL, 5, 'VP')
  ),
 ),
} #: Symbolic AST mappings and descriptions.

_EXACT_MATCH_REGEXP = re.compile(r"^[a-z.]+\$\d+$") #: A regular expression used to determine whether an AST element is an exact-match specifier.

_PHRASE_EXPANSION = {
 'AP': "Complement Phrase",
 'CP': "Clause Phrase",
 'CgP': "Compound Phrase",
 'CpP': "Compound Phrase",
 'ESP': "Emotion Sound Phrase",
 'EVNP': "Emotion Object Phrase",
 'EVOP': "Emotion Object Phrase",
 'EVP': "Emotion Verb Phrase",
 'NP': "Noun Phrase",
 'NsP': "Noun Phrase",
 'NvP': "Noun Phrase",
 'PP': "Preposition Phrase",
 'SgP': "Subject Phrase",
 'SpP': "Subject Phrase",
 'VP': "Verb Phrase",
} #: Mappings from phrase-notation to human-readable descriptions.

_PHRASE_REDUCTION = {
 'AP': 'AP',
 'CP': 'CP',
 'CgP': 'MP',
 'CpP': 'MP',
 'ESP': 'ESP',
 'EVNP': 'EOP',
 'EVOP': 'EOP',
 'EVP': 'EVP',
 'NP': 'NP',
 'NsP': 'NP',
 'NvP': 'NP',
 'PP': 'PP',
 'SgP': 'SP',
 'SpP': 'SP',
 'VP': 'VP',
} #: Mappings from phrase-notation to symbolic descriptions.

_PHRASE_COLOURS = {
 'AP': 3,
 'CP': 0,
 'EOP': 9,
 'ESP': 4,
 'EVP': 5,
 'MP': 7,
 'NP': 1,
 'PP': 6,
 'SP': 8,
 'VP': 2,
} #: Mappings from symbolic descriptions to colour keys.

_SYNTAX_CLASS = {
 1: 'E.V.',
 2: 'v.',
 3: 'adv.',
 4: 'n.',
 5: 'conj.',
 6: 'prep.',
 7: 'E.S. (II)',
 8: 'adj.',
 12: 'prt.',
 13: 'E.S. (III)',
 14: 'E.S. (I)',
 15: 'pron.',
 16: 'intj.',
 18: 'cnstr.',
} #: Mappings from lexical class constants to human-readable names.
_SYNTAX_CLASS_FULL = {
 1: 'Emotion Verb',
 2: 'verb',
 3: 'adverb',
 4: 'noun',
 5: 'conjunction',
 6: 'preposition',
 7: 'Emotion Sound (II)',
 8: 'adjective',
 12: 'particle',
 13: 'Emotion Sound (III)',
 14: 'Emotion Sound (I)',
 15: 'pronoun',
 16: 'interjection',
 18: 'language construct',
} #: Mappings from lexical class constants to expanded human-readable names.

_SYNTAX_MAPPING = {
 1: (1,),
 2: (2,),
 3: (3,),
 4: (4,),
 5: (5,),
 6: (6,),
 7: (7,),
 8: (8,),
 9: (4, 2),
 10: (8, 4),
 11: (8, 2),
 12: (12,),
 13: (13,),
 14: (14,),
 15: (15,),
 16: (16,),
 17: (6, 12),
 18: (18,),
 19: (3, 4),
 20: (3, 8),
 21: (5, 6),
 22: (2, 12),
 90: (7, 8),
} #: Mappings from lexical class constants to their constituent members.

_DIALECT = {
 0: 'Unknown',
 1: 'Central Standard Note',
 2: 'Cult Ciel Note',
 3: 'Cluster Note',
 4: 'Alpha Note',
 5: 'Metafalss Note',
 6: 'New Testament of Pastalie',
 7: 'Alpha Note (EOLIA)',
} #: Mappings from dialect constants to human-readable names.


class _SyntaxTree(object):
	_children = None
	_phrase = None
	
	def __init__(self):
		self._phrase = "CP"
		self._children = []
		
	def addChild(self, syntax_tree):
		self._children.append(syntax_tree)
		
	def getChildren(self):
		return tuple(self._children)
		
	def toXML(self):
		document = xml.dom.minidom.getDOMImplementation().createDocument(None, "s", None)
		
		self._xml_attachNodes(document, document.firstChild)
		
		return document.toprettyxml()
		
	def _xml_attachNodes(self, document, parent):
		node = document.createElement(self._phrase.lower())
		parent.appendChild(node)
		
		phrase_node = document.createElement("phrase")
		phrase_node.appendChild(document.createTextNode(_PHRASE_EXPANSION[self._phrase]))
		node.appendChild(phrase_node)
		
		for child in self._children:
			child._xml_attachNodes(document, node)
			
	def countLeaves(self):
		return sum([child.countLeaves() for child in self._children])
		
	def getPhrase(self):
		return self._phrase
		
class _Phrase(_SyntaxTree):
	def __init__(self, phrase):
		self._phrase = phrase
		self._children = []
		
class _Word(_SyntaxTree):
	_children = ()
	_word = None
	_meaning = None
	_class = None
	_dialect = None
	_prefix = None
	_suffix = None
	_slots = None
	
	def __init__(self, word, meaning, syntax_class, dialect, prefix, suffix, slots):
		self._word = word
		self._meaning = meaning
		self._class = syntax_class
		self._dialect = dialect
		self._prefix = prefix
		self._suffix = suffix
		self._slots = slots
		
	def getWord(self, xhtml=False):
		return _decorateWord(self._word, self._prefix, self._suffix, self._slots, xhtml)
		
	def getBaseWord(self):
		return self._word
		
	def getMeaning(self):
		return self._meaning
		
	def getClass(self):
		return self._class
		
	def getDialect(self):
		return self._dialect
		
	def getPhrase(self):
		return None
		
	def _xml_attachNodes(self, document, parent):
		node = document.createElement("word")
		parent.appendChild(node)
		
		node.setAttribute("dialect", str(self._dialect))
		
		hymmnos_node = document.createElement("hymmnos")
		hymmnos_node.appendChild(document.createTextNode(_decorateWord(self._word, self._prefix, self._suffix, self._slots, False)))
		node.appendChild(hymmnos_node)
		
		class_node = document.createElement("class")
		class_node.appendChild(document.createTextNode(_SYNTAX_CLASS[self._class]))
		node.appendChild(class_node)
		
		meaning_node = document.createElement("meaning")
		meaning_node.appendChild(document.createTextNode(self._meaning))
		node.appendChild(meaning_node)
		
		dialect_node = document.createElement("dialect")
		dialect_node.appendChild(document.createTextNode(_DIALECT[self._dialect % 50]))
		node.appendChild(dialect_node)
		
	def countLeaves(self):
		return 1
		
		
def processSyntax(line, db_con):
	lookup.initialiseEmotionVerbRegexps(db_con)
	
	tokens = re.sub("(?:/\.)|(?:!|\?)|\.*$", "", line, 1).split()
	
	tree = _SyntaxTree()
	(display_string, result) = _processInput(tree, tokens, db_con)
	
	return (tree, display_string, result)
	
def renderResult_xhtml(tree, display_string):
	return """
		<table style="border-collapse: collapse; border: 1px solid black; width: 100%%;">
			<tr>
				<td style="color: #00008B; text-align: center; background: #D3D3D3;">
					<div style="font-family: hymmnos; font-size: 24pt;">
						%s
					</div>
					<div style="font-size: 18pt;">
						%s
					</div>
				</td>
			</tr>
			<tr>
				<td style="background: #808080; color: white;">
					<div style="width: 100%%;">
						%s
					</div>
				</td>
			</tr>
			<tr>
				<td style="color: #00008B; text-align: right; background: #D3D3D3; font-size: 0.7em;">
					You may wish to <a href="/hymmnoserver/search.php?%s">translate this sentence word-for-word</a> or <a href="/hymmnoserver/syntax-xml.psp?%s">view it as XML</a>
				</td>
			</tr>
		</table>
		<hr/>
		<div style="color: #808080; font-size: 0.6em;">
			<span>
				Lexical classes reflect instance, not abstraction.
				<br/>
				The syntax tree does not take Emotion Vowels into consideration.
			</span>
		</div>
	""" % (display_string, display_string, _renderBranches(tree), urllib.urlencode({'word': display_string}), urllib.urlencode({'query': display_string}))
	
def _decorateWord(word, prefix, suffix, slots, xhtml):
		if not slots is None:
			slots = map(cgi.escape, slots)
		else:
			slots = ()
		prefix = prefix or ''
		suffix = suffix or ''
		
		if xhtml:
			slots = ["<span style=\"color: #FFD700;\">%s</span>" % (slot) for slot in slots]
			prefix = "<span style=\"color: #F0D000;\">%s</span>" % (cgi.escape(prefix))
			suffix = "<span style=\"color: #FF00FF;\">%s</span>" % (cgi.escape(suffix))
			word = cgi.escape(word)
			
		word_fragments = word.split('.')
		word = ''
		for (fragment, slot) in zip(word_fragments[:-1], slots):
			word += fragment + slot
		word = prefix + word + word_fragments[-1] + suffix
		
		if not xhtml:
			word = cgi.escape(word)
			
		return word
		
def _digestTokens(tokens, db_con):
	(pastalia, words, prefixes, suffixes, slots) = _sanitizePastalia(tokens)
	
	word_list = lookup.readWords(words, db_con)
	decorated_words = []
	words_details = []
	for (w, p, s, l) in zip(words, prefixes, suffixes, slots):
		lexicon_entry = word_list.get(w.lower())
		if lexicon_entry is None:
			song_check = (p or '') + w
			lexicon_entry = lookup.readWords((song_check,), db_con).get(song_check)
			if lexicon_entry is None:
				raise ContentError("unknown word in input: %s" % w)
				
		decorated_words.append(_decorateWord(lexicon_entry[0][0], p, s, l, False))
		
		if len(lexicon_entry) == 1 and lexicon_entry[0][3] == 7: #E.S. (II)
			(word, meaning, kana, syntax_class, dialect, decorations, syllables) = lexicon_entry[0]
			lexicon_entry = ((word, meaning, kana, 90, dialect, decorations, syllables),) #Dual-class as (E.S. (ii), adj.)
			
		words_details.append((lexicon_entry, p, s, l))
	return (words_details, ' '.join(decorated_words), pastalia)
	
def _processAST(words, ast, pastalia, phrase=None):
	tuple_rule = ast[0]
	nodes = []
	success = False
	for st_a in ast[1:]:
		offset = 0
		if type(st_a) == int: #Word from specific lexical class needed.
			result = _processWord_int(words, st_a, pastalia)
			if result is None:
				if tuple_rule == _ALL:
					return None
			else:
				success = True
				nodes.append(result)
				offset = result.countLeaves()
		elif type(st_a) == str:
			if _EXACT_MATCH_REGEXP.match(st_a): #Exact word needed.
				result = _processWord_exact(words, st_a)
				if result is None:
					if tuple_rule == _ALL:
						return None
				else:
					success = True
					nodes.append(result)
					offset = result.countLeaves()
			else: #Symbolic AST identifier.
				result = _processAST(words, _AST_FRAGMENTS[st_a], pastalia, st_a)
				if result is None:
					if tuple_rule == _ALL:
						return None
				else:
					success = True
					for node in result:
						nodes.append(node)
						offset += node.countLeaves()
		else: #tuple, meaning nested AST.
			result = _processAST(words, st_a, pastalia)
			if result is None:
				if tuple_rule == _ALL:
					return None
			else:
				success = True
				for node in result:
					nodes.append(node)
					offset += node.countLeaves()
					
		if success and tuple_rule == _ONE: #Abort lookup.
			break
		elif offset: #Consume tokens before next cycle.
			words = words[offset:]
			
	if not success and tuple_rule == _ONE:
		return None
		
	#Successfully validated tuple.
	if phrase and nodes: #Construct a parent for the nodes.
		root = _Phrase(phrase)
		for node in nodes:
			root.addChild(node)
		return [root]
	return nodes
	
def _processInput(tree, tokens, db_con):
	#Read the definition of every provided word and construct the displayable Hymmnos string.
	(words_details, display_string, pastalia) = _digestTokens(tokens, db_con)
	
	message = result = None
	if not pastalia:
		result = _processAST(words_details, _GENERAL_AST, False)
	else:
		result = _processAST(words_details, _PASTALIA_AST, True)
		
	if result:
		for node in result:
			tree.addChild(node)
			
	if not tree.countLeaves() == len(tokens):
		result = None 
		
	return (display_string, result)
	
def _processWord_exact(words, target):
	if not words:
		return None
		
	(details, prefix, suffix, slots) = words[0]
	for (word, meaning, kana, syntax_class, dialect, decorations, syllables) in details:
		if "%s$%i" % (word.lower(), dialect) == target:
			return _Word(word, meaning, _SYNTAX_MAPPING[syntax_class][0], dialect, prefix, suffix, slots)
	return None
	
def _processWord_int(words, target, pastalia):
	if not words:
		return None
		
	(details, prefix, suffix, slots) = words[0]
	for (word, meaning, kana, syntax_class, dialect, decorations, syllables) in details:
		if not pastalia and dialect % 50 == 6: #Ignore Pastalia words.
			continue
		if target in _SYNTAX_MAPPING[syntax_class]:
			return _Word(word, meaning, target, dialect, prefix, suffix, slots)
	return None
	
def _renderBranches(tree):
	children_entries = []
	for child in tree.getChildren():
		if type(child) == _Word: #Leaf.
			children_entries.append(_renderLeaf(child))
		else:
			children_entries.append(_renderBranches(child))
			
	return """
		<div class="phrase phrase-%i">
			<span style="font-size: 0.9em;">%s</span>
			<div style="margin-left: 15px;">%s</div>
		</div>
	""" % (_PHRASE_COLOURS[_PHRASE_REDUCTION[tree.getPhrase()]], _PHRASE_EXPANSION[tree.getPhrase()], '\n'.join(children_entries))
	
def _renderLeaf(leaf):
	return """<span style="float: right; font-size: 0.675em;">(%s)</span>
		<div class="phrase-word phrase-word-%i">
			<span>%s (%s)</span>
			<div style="margin-left: 10px; font-size: 0.85em;">%s</div>
		</div>
	""" % (
	 _DIALECT[leaf.getDialect() % 50],
	 leaf.getClass(),
	 """<a href="javascript:popUpWord('%s', %i)" style="color: white;">%s</a>""" % (
	  leaf.getBaseWord(), leaf.getDialect(), leaf.getWord(True)
	 ),
	 _SYNTAX_CLASS_FULL[leaf.getClass()],
	 leaf.getMeaning()
	)
	
def _sanitizePastalia(tokens):
	emotion_verbs = lookup.EMOTION_VERB_REGEXPS
	pastalia = False
	
	words = []
	prefixes = []
	suffixes = []
	slots = []
	for token in tokens:
		emotion_hit = False
		for (regexp, emotion_verb, dialect) in emotion_verbs:
			match = regexp.match(token)
			if match:
				words.append(emotion_verb)
				
				prefixes.append(None)
				suffixes.append(match.groups()[-1])
				word_slots = []
				for hit in match.groups()[:-1]:
					if hit is None:
						word_slots.append('.')
					else:
						word_slots.append(hit)
				slots.append(tuple(word_slots))
				
				pastalia = True
				emotion_hit = True
				break
		if emotion_hit:
			continue
			
		match = lookup.WORD_STRUCTURE_REGEXP.match(token)
		if match and match.group(1) or match.group(3):
			words.append(match.group(2))
			prefixes.append(match.group(1))
			suffixes.append(match.group(3))
			slots.append(None)
			
			pastalia = True
			continue
			
		words.append(token)
		prefixes.append(None)
		suffixes.append(None)
		slots.append(None)
		
	return (pastalia, words, prefixes, suffixes, slots)
	
	
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
		