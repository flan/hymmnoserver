# -*- coding: utf-8 -*-
"""
Hymmnoserver module: common.syntax

Purpose
=======
 Processes Hymmnos, producing syntax trees upon sucess.
 
Details
=======
 This module implements a forward-only recursive descent parser.
 
 This means that the first successful match is considered correct; doing this
 was a decision based on the fact that Hymmnos is largely linear in nature, and
 only truly exceptional cases actually need backtracking. For those, it should
 suffice to craft an especially detailed AST and place it before the more
 general entries, thus saving vast amounts of processing power without
 significantly reducing coverage of the language's syntactic structures.
 
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
 (_ANY, 5, 16, 6),
 (_ANY,
  'ESP',
  (_ALL,
   (_ONE,
    (_ALL, 'VsP', 'SgP', 'VP'),
    (_ALL, 'SgP', 'VP'),
    (_ALL, 'VsP', 'VP'),
    'VP',
    'SgP',
   ),
   (_ANY, (_ALL, 5, 'SgsP'))
  )
 ),
 (_ANY, 'CgP'),
 (_ANY, 'AaP'),
 (_ANY, 16)
) #: The AST that describes standard Hymmnos.

_PASTALIA_AST = (_ALL,
 (_ANY, 5, 16, 6),
 (_ONE,
  (_ALL, 'NsP', 5, 'SpP', 'EVP'),
  (_ALL,
   'SevmP',
   (_ANY,
    (_ONE,
     (_ALL, 5, 'SevP'),
     'VP',
     'EVP'
    )
   )
  ),
  (_ALL,
   (_ONE, 
    (_ALL,
     (_ONE,
      'SevnP',
      'EVhP'
     ),
    ),
    (_ANY, 'SpP')
   ),
   (_ANY, (_ONE, 'EVP', 'VP')),
   (_ANY, (_ALL, 5, 'SevP'))
  ),
  (_ALL,
   15,
   'EVP'
  )
 ),
 (_ANY, 'CpP'),
 (_ANY, 'AaP'), 
 (_ANY, 16)
) #: The AST that describes Pastalia Hymmnos.

_AST_FRAGMENTS = {
 'AaP': (_ALL,
  (_ONE, 3, 8),
  (_ANY, 'AalP')
 ),
 'AalP': (_ALL,
  (_ONE, 3, 8),
  (_ANY, 'AalP')
 ),
 'AnP': (_ALL,
  (_ONE, 8, 3, 15),
  (_ANY, 'AnlP'),
  (_ANY, (_ALL, 5, 'AnP'))
 ),
 'AnlP': (_ALL,
  (_ONE, 8, 3),
  (_ANY, 'AnlP'),
  (_ANY, (_ALL, 5, 'AnP'))
 ),
 'AnpP': (_ALL,
  (_ONE, 8, 3),
  (_ANY, 'AnplP'),
  (_ANY, (_ALL, 5, 'AnpP'))
 ),
 'AnplP': (_ALL,
  (_ONE, 8, 3),
  (_ANY, 'AnplP'),
  (_ANY, (_ALL, 5, 'AnpP'))
 ),
 'AvP': (_ALL,
  (_ONE, 8, 3, 15),
  (_ANY, 'AvlP'),
  (_ANY, (_ALL, 5, 'AvP'))
 ),
 'AvlP': (_ALL,
  (_ONE, 8, 3),
  (_ANY, 'AvlP'),
  (_ANY, (_ALL, 5, 'AvP'))
 ),
 'CgP': (_ONE,
  'NP',
  (_ALL,
   'VP',
   (_ANY, 'NP'),
   (_ANY, 'CgP')
  )
 ),
 'CpP': (_ONE,
  'NP',
  (_ALL,
   (_ONE, 'VP', 'EVP'),
   (_ANY, 'NP'),
   (_ANY, 'CpP')
  )
 ),
 'ESP': (_ALL, 14, 7, 13),
 'EVNP': (_ALL,
  (_ANY, 15),
  (_ANY, 'AvP'),
  1,
  (_ANY, 3),
  (_ANY,
   (_ALL,
    (_ANY, (_ONE, 6, 12)),
    (_ONE,
     (_ONE,
      (_ALL, 'TP', 'TP'),
      'TP'
     ),
     'EVOP',
     'EVNP'
    ),
    (_ANY, 'PP')
   )
  ),
 ),
 'EVOP': (_ALL,
  'x.$6',
  (_ONE,
   (_ALL,
    (_ANY, 'rre$1'),
    (_ONE,
     15,
     (_ALL, 1, (_ANY, 3))
    )
   ),
   (_ALL, 'rre$1', 'NP')
  ),
  'EVP'
 ),
 'EVP': (_ALL,
  (_ANY, 15),
  (_ANY, 'AvP'),
  1,
  (_ANY, 3),
  (_ANY, 'SevP'),
  (_ANY,
   (_ONE,
    (_ONE,
     (_ONE,
      (_ALL, 'TP', 'TP'),
      'TP'
     ),
     'PP'
    ),
    'EVNP'
   )
  ),
  (_ANY,
   'AaP',
   (_ONE,
    (_ALL, 5, (_ONE, 'VP', 'EVP')),
    'PP'
   )
  ),
 ),
 'EVhP': (_ALL,
  1,
  'TP',
  (_ANY, 'AaP')
 ),
 'EVscP': (_ALL,
  1,
  (_ANY, 3),
  (_ANY, (_ONE, 'tes$1', 'ut$6', 'anw$5', 'dn$6', 'du$6', 'tie$6', 'tou$1', 'ween$1', 'won$1')),
  'NsP',
  (_ANY,
   (_ALL, 5, (_ONE, 'VP', 'EVP'))
  )
 ),
 'EVsclP': (_ALL,
  'EVscP',
  (_ANY, 'EVsclP')
 ),
 'NP': (_ALL,
  (_ANY, 'AnP'),
  (_ONE,
   (_ALL, 4, 'NP'),
   4,
   'PP'
  ),
  (_ANY, (_ALL, (_ONE, 5, 'oz$1'), 'NP'))
 ),
 'NsP': (_ALL,
  (_ANY, 'AnP'),
  (_ONE,
   (_ALL, 4, 'NsP'),
   4
  ),
  (_ANY, (_ALL, (_ONE, 5, 'oz$1'), 'NsP'))
 ),
 'NtP': (_ALL,
  (_ANY, 'AnP'),
  4,
  (_ANY, 'NtP'),
  (_ANY, (_ALL, (_ONE, 5, 'oz$1'), 'NtP'))
 ),
 'PP': (_ALL, (_ONE, 6, 12), 'NP'),
 'SevP': (_ALL,
  (_ONE,
   (_ALL,
    (_ANY, (_ALL, (_ANY, 'x.$6'), 'rre$1')),
    (_ONE,
     (_ALL, (_ANY, 'AnpP'), 15),
     (_ALL, 1, (_ANY, 3))
    )
   ),
   (_ALL, 'rre$1', 'NsP')
  )
 ),
 'SevnP': (_ALL, 'x.$6', 'rre$1', 'NsP'),
 'SevmP': (_ALL,
  'x.$6',
  'rre$1',
  (_ONE,
   (_ALL,
    'EVscP',
    'EVscP',
    (_ANY, 'EVsclP')
   ),
   'EVP',
  )
 ),
 'SgP': (_ALL,
  (_ANY, 'rre$1'),
  (_ONE,
   (_ALL, (_ANY, 'AnpP'), 15),
   'NsP'
  )
 ),
 'SgsP': (_ALL,
  'rre$1',
  (_ONE,
   (_ALL, (_ANY, 'AnpP'), 15),
   'NsP'
  )
 ),
 'SpP': (_ALL,
  'x.$6',
  (_ONE,
   (_ALL, 'rre$1', 'NsP'),
   (_ALL,
    (_ANY, 'rre$1'),
    (_ONE,
     'NsP',
     15,
     (_ALL, 1, (_ANY, 3))
    )
   )
  )
 ),
 'TP': (_ALL,
  (_ANY, (_ONE, 12, 6, 'en$1')),
  'NtP'
 ),
 'VP': (_ALL,
  (_ANY, 15),
  (_ANY, 'AvP'),
  2,
  (_ANY, 3),
  (_ANY,
   (_ONE,
    (_ALL, 'TP', 'TP'),
    'TP'
   ),
   'PP'
  ),
  (_ANY,
   'AaP',
   (_ALL, 5, (_ONE, 'VP', 'EVP'))
  )
 ),
 'VsP': (_ALL,
  (_ANY, 'AvP'),
  2,
  (_ANY, 3),
  (_ANY, 'NsP'),
  (_ANY,
   (_ALL, 5, 'VsP')
  )
 ),
} #: Symbolic AST mappings and descriptions.

_EXACT_MATCH_REGEXP = re.compile(r"^[a-z.]+\$\d+$") #: A regular expression used to determine whether an AST element is an exact-match specifier.

_PHRASE_REDUCTION = {
 'AaP': 'AP',
 'AnP': 'AP',
 'AnpP': 'AP',
 'AvP': 'AP',
 'CP': 'CP',
 'CgP': 'MP',
 'CpP': 'MP',
 'ESP': 'ESP',
 'EVNP': 'EOP',
 'EVOP': 'EOP',
 'EVP': 'EVP',
 'EVhP': 'EVP',
 'EVscP': 'EVP',
 'NP': 'NP',
 'NsP': 'NP',
 'NtP': 'NP',
 'PP': 'PP',
 'SevP': 'SVP',
 'SevnP': 'SP',
 'SevmP': 'SP',
 'SgP': 'SP',
 'SgsP': 'SP',
 'SpP': 'SP',
 'TP': 'TP',
 'VP': 'VP',
 'VsP': 'VP',
} #: Mappings from phrase-notation to symbolic descriptions.

_PHRASE_EXPANSION = {
 'AP': "Complement Phrase",
 'CP': "Sentence",
 'ESP': "Emotion Sound Phrase",
 'EOP': "Emotion Object Phrase",
 'EVP': "Emotion Verb Phrase",
 'MP': "Compound Phrase",
 'NP': "Noun Phrase",
 'PP': "Preposition Phrase",
 'SP': "Subject Phrase",
 'SVP': "Subject Verb Phrase",
 'TP': "Transitive Phrase",
 'VP': "Verb Phrase",
} #: Mappings from phrase-notation to human-readable descriptions.

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
 'SVP': 8,
 'TP': 10,
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
 7: (7, 8), #Doubles as adjective.
 8: (8, 7), #Doubles as E.S.(II).
 9: (4, 2),
 10: (8, 4, 7), #Doubles as E.S.(II).
 11: (8, 2, 7), #Doubles as E.S.(II).
 12: (12,),
 13: (13,),
 14: (14,),
 15: (4, 15,),
 16: (3, 16),
 17: (6, 12),
 18: (18,),
 19: (3, 4),
 20: (3, 8, 7), #Doubles as E.S.(II).
 21: (5, 6),
 22: (2, 12),
 23: (3, 12),
 24: (4, 6),
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

_COLLIDING_EMOTION_VERBS = (
 'd.n.',
) #: A collection of all Emotion Verbs that collide with basic words in the sanitization process.

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
		phrase_node.appendChild(document.createTextNode(_PHRASE_EXPANSION[_PHRASE_REDUCTION[self._phrase]]))
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
	
	tree = _SyntaxTree()
	(display_string, result) = _processInput(tree, line.split(), db_con)
	
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
	(pastalia, pastalia_prefix_only, words, prefixes, suffixes, slots) = _sanitizePastalia(tokens)
	pastalia_prefix_valid = False #Enforces Pastalia when a Pastalian prefix is present.
	
	word_list = lookup.readWords(words, db_con)
	decorated_words = []
	words_details = []
	for (w, p, s, l) in zip(words, prefixes, suffixes, slots):
		lexicon_entry = word_list.get(w.lower())
		if lexicon_entry is None:
			if w.isdigit(): #It's a number.
				lexicon_entry = ([w, w, w, 4, 1, None, ''],)
			if p: #Reattach the prefix, since it may be a song or a mistakenly capitalized word.
				song_check = p.lower() + w.lower()
				p = None
				lexicon_entry = lookup.readWords((song_check,), db_con).get(song_check)
			if lexicon_entry is None:
				raise ContentError("unknown word in input: %s" % w)
		elif pastalia and p:
			pastalia_prefix_valid = True
			
			pastalia_entry = 0
			for (i, l_e) in enumerate(lexicon_entry):
				if l_e[4] % 50 == 6: #Favour Pastalian forms.
					pastalia_entry = i
			#Duplicate the best candidate, mark it as a noun, and use it to replace the list.
			new_entry = lexicon_entry[i][:]
			new_entry[3] = 4
			lexicon_entry = (new_entry,)
		else:
			if not s and w in _COLLIDING_EMOTION_VERBS: #Handle exceptions where Emotion Verbs match basic words.
				basic_form = w.replace('.', '')
				l_e = lookup.readWords((basic_form,), db_con).get(basic_form)
				if l_e: #Just in case this fails somehow.
					lexicon_entry = tuple([l_e[0]] + list(lexicon_entry))
					
		decorated_words.append(_decorateWord(lexicon_entry[0][0], p, s, l, False))
		words_details.append((lexicon_entry, p, s, l))
	return (words_details, ' '.join(decorated_words), pastalia_prefix_valid or (pastalia and not pastalia_prefix_only))
	
def _processAST(words, ast, phrase=None):
	#Refuse to process requests that would invariably lead to failure.
	if words:
		if phrase in ('AnP', 'AvP', 'AnlP', 'AvlP'):
			if len(words) == 1:
				return None
			else:
				relevant_classes = None
				if phrase in ('AnP', 'AnlP'):
					relevant_classes = (4,)
				else:
					relevant_classes = (1, 2)
				following_classes = [_SYNTAX_MAPPING[c] for (w, m, k, c, d, e, s) in words[1][0]]
				for classes in [_SYNTAX_MAPPING[c] for (w, m, k, c, d, e, s) in words[0][0]]:
					if len(classes) > 1 and [None for c in classes if c in (3, 6, 8)] and [None for c in classes if c in relevant_classes]: #Variable, stop-on-able item.
						for f_classes in following_classes:
							if not [None for c in f_classes if c in relevant_classes]: #Not AP-eligible.
								return None
		if phrase in ('AaP', 'AalP'):
			word = words[0][0][0]
			if "%s$%i" % (word[0], word[4]) in ('re$1', 'na$1', 'zz$6'): #These are prefixes only.
				return None
				
	#Process AST normally.
	tuple_rule = ast[0]
	working_words = words[:]
	successes = []
	
	success = False
	for st_a in ast[1:]:
		offset = 0
		result = None
		if type(st_a) == int: #Word from specific lexical class needed.
			result = _processWord_int(working_words, st_a)
			if result:
				offset = result.countLeaves()
				successes.append((result,))
		elif type(st_a) == str:
			if _EXACT_MATCH_REGEXP.match(st_a): #Exact word needed.
				result = _processWord_exact(working_words, st_a)
				if result:
					offset = result.countLeaves()
					successes.append((result,))
			else: #Symbolic AST identifier.
				result = _processAST(working_words, _AST_FRAGMENTS[st_a], st_a)
				if result:
					offset = sum([r.countLeaves() for r in result])
					successes.append(result)
		else: #tuple, meaning nested AST.
			result = _processAST(working_words, st_a)
			if result:
				offset = sum([r.countLeaves() for r in result])
				successes.append(result)
		success = not result == None
		
		if not success and tuple_rule == _ALL: #Failed.
			return None
		elif success and tuple_rule == _ONE: #End lookup.
			break
		elif offset: #Consume tokens before next cycle.
			working_words = working_words[offset:]
			
	if not success and tuple_rule == _ONE: #Failed to get a single success.
		return None
		
	#Successfully validated tuple. Aggregate results.
	nodes = []
	for success in successes:
		for node in success:
			nodes.append(node)
			
	if phrase and nodes and phrase in _PHRASE_REDUCTION: #Construct a parent for the nodes.
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
		result = _processAST(words_details, _GENERAL_AST)
	else:
		result = _processAST(words_details, _PASTALIA_AST)
		
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
		if "%s$%i" % (word.lower(), dialect % 50) == target:
			return _Word(word, meaning, _SYNTAX_MAPPING[syntax_class][0], dialect, prefix, suffix, slots)
	return None
	
def _processWord_int(words, target):
	if not words:
		return None
		
	(details, prefix, suffix, slots) = words[0]
	for (word, meaning, kana, syntax_class, dialect, decorations, syllables) in details:
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
	""" % (_PHRASE_COLOURS[_PHRASE_REDUCTION[tree.getPhrase()]], _PHRASE_EXPANSION[_PHRASE_REDUCTION[tree.getPhrase()]], '\n'.join(children_entries))
	
def _renderLeaf(leaf):
	base_word = leaf.getBaseWord()
	if base_word.isdigit():
		base_word = '1'
		
	return """<span style="float: right; font-size: 0.675em;">(%s)</span>
		<div class="phrase-word phrase-word-%i">
			<span>%s (%s)</span>
			<div style="margin-left: 10px; font-size: 0.85em;">%s</div>
		</div>
	""" % (
	 _DIALECT[leaf.getDialect() % 50],
	 leaf.getClass(),
	 """<a href="javascript:popUpWord('%s', %i)" style="color: white;">%s</a>""" % (
	  base_word, leaf.getDialect(), leaf.getWord(True)
	 ),
	 _SYNTAX_CLASS_FULL[leaf.getClass()],
	 leaf.getMeaning()
	)
	
def _sanitizePastalia(tokens):
	emotion_verbs = lookup.EMOTION_VERB_REGEXPS
	pastalia = False
	pastalia_prefix_only = True
	
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
				pastalia_prefix_only = False
				emotion_hit = True
				break
		if emotion_hit:
			continue
			
		match = lookup.WORD_STRUCTURE_REGEXP.match(token)
		if match and (match.group(1) or match.group(3)):
			words.append(match.group(2))
			prefixes.append(match.group(1))
			suffixes.append(match.group(3))
			slots.append(None)
			
			pastalia = True
			if match.group(3):
				pastalia_prefix_only = False
			continue
			
		words.append(token)
		prefixes.append(None)
		suffixes.append(None)
		slots.append(None)
		
	return (pastalia, pastalia_prefix_only, words, prefixes, suffixes, slots)
	
	
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
		