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
 the GNU GPLv3 or, at your option, any later version of the GPL.
 
 All content is derived from public domain, promotional, or otherwise-compatible
 sources and published uniformly under the
 Creative Commons Attribution-Share Alike 3.0 license.
 
 See license.README for details.
 
 (C) Neil Tallim, 2009
"""
import cgi
import re
import urllib
import xml.dom.minidom

import lookup

_ANY = 0 #: An AST classifier that requires zero-or-more matches from its set.
_ALL = -1 #: An AST classifier that requires every set member to match.
_ONE = 1 #: An AST classifier that requires at least one member to match. (Successive matches are ignored)

_LEX_ADJ = 8 #: A symbolic constant identifying adjectives.
_LEX_ADV = 3 #: A symbolic constant identifying adverbs.
_LEX_CNSTR = 18 #: A symbolic constant identifying language constructs.
_LEX_CONJ = 5 #: A symbolic constant identifying conjunctions.
_LEX_ESi = 14 #: A symbolic constant identifying Emotion Sound Is.
_LEX_ESii = 7 #: A symbolic constant identifying Emotion Sound IIs.
_LEX_ESiii = 13 #: A symbolic constant identifying Emotion Sound IIIs.
_LEX_EV = 1 #: A symbolic constant identifying Emotion Verbs.
_LEX_INTJ = 16 #: A symbolic constant identifying interjections.
_LEX_N = 4 #: A symbolic constant identifying nouns.
_LEX_PREP = 6 #: A symbolic constant identifying prepositions.
_LEX_PRON = 15 #: A symbolic constant identifying pronouns.
_LEX_PRT = 12 #: A symbolic constant identifying particles.
_LEX_V = 2 #: A symbolic constant identifying verbs.

_DLCT_UNKNOWN = 0 #: A symbolic constant identifying unknown words.
_DLCT_CENTRAL = 1 #: A symbolic constant identifying Central words.
_DLCT_CULT_CIEL = 2 #: A symbolic constant identifying Cult Ciel words.
_DLCT_CLUSTER = 3 #: A symbolic constant identifying Cluster words.
_DLCT_ALPHA = 4 #: A symbolic constant identifying Alpha words.
_DLCT_METAFALSS = 5 #: A symbolic constant identifying Metafalss words.
_DLCT_PASTALIE = 6 #: A symbolic constant identifying Pastalie words.
_DLCT_ALPHA_EOLIA = 7 #: A symbolic constant identifying EOLIA words.

_DIALECT_SHIFT = 50 #: The constant value that determines the spacing between dialect variants.

_EXACT_MATCH_REGEXP = re.compile(r"^[a-z.]+\$\d+$") #: A regular expression used to determine whether an AST element is an exact-match specifier.

_GENERAL_AST = (_ALL,
 (_ANY, _LEX_CONJ, _LEX_INTJ, _LEX_PREP),
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
   (_ANY, (_ALL, _LEX_CONJ, 'SgsP'))
  )
 ),
 (_ANY, 'CgP'),
 (_ANY, 'AaP'),
 (_ANY, _LEX_INTJ)
) #: The AST that describes standard Hymmnos.

_PASTALIE_AST = (_ALL,
 (_ANY, _LEX_CONJ, _LEX_INTJ, _LEX_PREP),
 (_ONE,
  (_ALL, 'NsP', _LEX_CONJ, 'SpP', 'EVP'),
  (_ALL,
   'SevmP',
   (_ANY,
    (_ONE,
     (_ALL, _LEX_CONJ, 'SevP'),
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
   (_ANY, (_ALL, _LEX_CONJ, 'SevP'))
  ),
  (_ALL,
   _LEX_PRON,
   'EVP'
  )
 ),
 (_ANY, 'CpP'),
 (_ANY, 'AaP'), 
 (_ANY, _LEX_INTJ)
) #: The AST that describes Pastalie Hymmnos.

_AST_FRAGMENTS = {
 'AaP': (_ALL,
  (_ONE, _LEX_ADV, _LEX_ADJ),
  (_ANY, 'AalP')
 ),
 'AalP': (_ALL,
  (_ONE, _LEX_ADV, _LEX_ADJ),
  (_ANY, 'AalP')
 ),
 'AavP': (_ALL,
  _LEX_ADV,
  (_ANY, 'AavlP')
 ),
 'AavlP': (_ALL,
  _LEX_ADV,
  (_ANY, 'AavlP')
 ),
 'AnP': (_ALL,
  (_ONE, _LEX_ADJ, _LEX_ADV, _LEX_PRON),
  (_ANY, 'AnlP'),
  (_ANY, (_ALL, _LEX_CONJ, 'AnP'))
 ),
 'AnlP': (_ALL,
  (_ONE, _LEX_ADJ, _LEX_ADV),
  (_ANY, 'AnlP'),
  (_ANY, (_ALL, _LEX_CONJ, 'AnP'))
 ),
 'AnpP': (_ALL,
  (_ONE, _LEX_ADJ, _LEX_ADV),
  (_ANY, 'AnplP'),
  (_ANY, (_ALL, _LEX_CONJ, 'AnpP'))
 ),
 'AnplP': (_ALL,
  (_ONE, _LEX_ADJ, _LEX_ADV),
  (_ANY, 'AnplP'),
  (_ANY, (_ALL, _LEX_CONJ, 'AnpP'))
 ),
 'AvP': (_ALL,
  (_ONE, _LEX_ADJ, _LEX_ADV, _LEX_PRON),
  (_ANY, 'AvlP'),
  (_ANY, (_ALL, _LEX_CONJ, 'AvP'))
 ),
 'AvlP': (_ALL,
  (_ONE, _LEX_ADJ, _LEX_ADV),
  (_ANY, 'AvlP'),
  (_ANY, (_ALL, _LEX_CONJ, 'AvP'))
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
 'ESP': (_ALL, _LEX_ESi, _LEX_ESii, _LEX_ESiii),
 'EVNP': (_ALL,
  (_ANY, _LEX_PRON),
  (_ANY, 'AvP'),
  _LEX_EV,
  (_ANY, 'AavP'),
  (_ANY,
   (_ALL,
    (_ANY, (_ONE, _LEX_PREP, _LEX_PRT)),
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
  'x.$%i' % (_DLCT_PASTALIE),
  (_ONE,
   (_ALL,
    (_ANY, 'rre$%i' % (_DLCT_CENTRAL)),
    (_ONE,
     _LEX_PRON,
     (_ALL, _LEX_EV, (_ANY, 'AavP'))
    )
   ),
   (_ALL, 'rre$%i' % (_DLCT_CENTRAL), 'NP')
  ),
  'EVP'
 ),
 'EVP': (_ALL,
  (_ANY, _LEX_PRON),
  (_ANY, 'AvP'),
  _LEX_EV,
  (_ANY, (_ONE, 'AavP', 'SevP')),
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
   'AavP',
   (_ONE,
    (_ALL, _LEX_CONJ, (_ONE, 'VP', 'EVP')),
    'PP'
   )
  ),
 ),
 'EVhP': (_ALL,
  _LEX_EV,
  'TP',
  (_ANY, 'AavP')
 ),
 'EVscP': (_ALL,
  _LEX_EV,
  (_ANY, 'AavP'),
  (_ANY,
   (_ONE,
    'tes$%i' % (_DLCT_CENTRAL),
    'ut$%i' % (_DLCT_CENTRAL),
    'anw$%i' % (_DLCT_METAFALSS),
    'dn$%i' % (_DLCT_PASTALIE),
    'du$%i' % (_DLCT_PASTALIE),
    'tie$%i' % (_DLCT_PASTALIE),
    'tou$%i' % (_DLCT_CENTRAL),
    'ween$%i' % (_DLCT_CENTRAL),
    'won$%i' % (_DLCT_CENTRAL),
    'elle$%i' % (_DLCT_CENTRAL)
   )
  ),
  'NsP',
  (_ANY,
   (_ALL, _LEX_CONJ, (_ONE, 'VP', 'EVP'))
  )
 ),
 'EVsclP': (_ALL,
  'EVscP',
  (_ANY, 'EVsclP')
 ),
 'NP': (_ALL,
  (_ANY, 'AnP'),
  (_ONE,
   (_ALL, _LEX_N, 'NP'),
   _LEX_N,
   'PP'
  ),
  (_ANY,
   (_ALL,
    (_ONE,
     _LEX_CONJ,
     'oz$%i' % (_DLCT_CENTRAL),
     'ween$%i' % (_DLCT_CENTRAL),
     'won$%i' % (_DLCT_CENTRAL),
     'elle$%i' % (_DLCT_CENTRAL)
    ),
    'NP'
   )
  )
 ),
 'NsP': (_ALL,
  (_ANY, 'AnP'),
  (_ONE,
   (_ALL, _LEX_N, 'NsP'),
   _LEX_N
  ),
  (_ANY,
   (_ALL,
    (_ONE,
     _LEX_CONJ,
     'oz$%i' % (_DLCT_CENTRAL),
     'ween$%i' % (_DLCT_CENTRAL),
     'won$%i' % (_DLCT_CENTRAL),
     'elle$%i' % (_DLCT_CENTRAL)
    ),
    'NsP'
   )
  )
 ),
 'NtP': (_ALL,
  (_ANY, 'AnP'),
  _LEX_N,
  (_ANY, 'NtP'),
  (_ANY,
   (_ALL,
    (_ONE,
     _LEX_CONJ,
     'oz$%i' % (_DLCT_CENTRAL),
     'ween$%i' % (_DLCT_CENTRAL),
     'won$%i' % (_DLCT_CENTRAL),
     'elle$%i' % (_DLCT_CENTRAL)
    ),
    'NtP'
   )
  )
 ),
 'PP': (_ALL, (_ONE, _LEX_PREP, _LEX_PRT), 'NP'),
 'SevP': (_ALL,
  (_ONE,
   (_ALL,
    (_ANY,
     (_ALL,
      (_ANY, 'x.$%i' % (_DLCT_PASTALIE)),
      'rre$%i' % (_DLCT_CENTRAL)
     )
    ),
    (_ONE,
     (_ALL, (_ANY, 'AnpP'), _LEX_PRON),
     (_ALL, _LEX_EV, (_ANY, 'AavP'))
    )
   ),
   (_ALL, 'rre$%i' % (_DLCT_CENTRAL), 'NsP')
  )
 ),
 'SevnP': (_ALL,
  'x.$%i' % (_DLCT_PASTALIE),
  'rre$%i' % (_DLCT_CENTRAL),
  'NsP'
 ),
 'SevmP': (_ALL,
  'x.$%i' % (_DLCT_PASTALIE),
  'rre$%i' % (_DLCT_CENTRAL),
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
  (_ANY, 'rre$%i' % (_DLCT_CENTRAL)),
  (_ONE,
   (_ALL, (_ANY, 'AnpP'), _LEX_PRON),
   'NsP'
  )
 ),
 'SgsP': (_ALL,
  'rre$%i' % (_DLCT_CENTRAL),
  (_ONE,
   (_ALL, (_ANY, 'AnpP'), _LEX_PRON),
   'NsP'
  )
 ),
 'SpP': (_ALL,
  'x.$%i' % (_DLCT_PASTALIE),
  (_ONE,
   (_ALL, 'rre$%i' % (_DLCT_CENTRAL), 'NsP'),
   (_ALL,
    (_ANY, 'rre$%i' % (_DLCT_CENTRAL)),
    (_ONE,
     'NsP',
     _LEX_PRON,
     (_ALL, _LEX_EV, (_ANY, 'AavP'))
    )
   )
  )
 ),
 'TP': (_ALL,
  (_ANY, (_ONE, _LEX_PRT, _LEX_PREP, 'en$1')),
  'NtP'
 ),
 'VP': (_ALL,
  (_ANY, _LEX_PRON),
  (_ANY, 'AvP'),
  _LEX_V,
  (_ANY, 'AavP'),
  (_ANY,
   (_ONE,
    (_ALL, 'TP', 'TP'),
    'TP'
   ),
   'PP'
  ),
  (_ANY,
   'AaP',
   (_ALL, _LEX_CONJ, (_ONE, 'VP', 'EVP'))
  )
 ),
 'VsP': (_ALL,
  (_ANY, 'AvP'),
  _LEX_V,
  (_ANY, 'AavP'),
  (_ANY, 'NsP'),
  (_ANY,
   (_ALL, _LEX_CONJ, 'VsP')
  )
 ),
} #: Symbolic AST mappings and descriptions.

_PHRASE_REDUCTION = {
 'AaP': 'AP',
 'AavP': 'AP',
 'AnP': 'AP',
 'AnpP': 'AP',
 'AvP': 'AP',
 'CP': 'CP',
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
 _LEX_ADJ: 'adj.',
 _LEX_ADV: 'adv.',
 _LEX_CNSTR: 'cnstr.',
 _LEX_CONJ: 'conj.',
 _LEX_ESi: 'E.S. (I)',
 _LEX_ESii: 'E.S. (II)',
 _LEX_ESiii: 'E.S. (III)',
 _LEX_EV: 'E.V.',
 _LEX_INTJ: 'intj.',
 _LEX_N: 'n.',
 _LEX_PREP: 'prep.',
 _LEX_PRON: 'pron.',
 _LEX_PRT: 'prt.',
 _LEX_V: 'v.',
} #: Mappings from lexical class constants to human-readable names.

_SYNTAX_CLASS_FULL = {
 _LEX_ADJ: 'adjective',
 _LEX_ADV: 'adverb',
 _LEX_CNSTR: 'language construct',
 _LEX_CONJ: 'conjunction',
 _LEX_ESi: 'Emotion Sound (I)',
 _LEX_ESii: 'Emotion Sound (II)',
 _LEX_ESiii: 'Emotion Sound (III)',
 _LEX_EV: 'Emotion Verb',
 _LEX_INTJ: 'interjection',
 _LEX_N: 'noun',
 _LEX_PREP: 'preposition',
 _LEX_PRON: 'pronoun',
 _LEX_PRT: 'particle',
 _LEX_V: 'verb',
} #: Mappings from lexical class constants to expanded human-readable names.

_SYNTAX_MAPPING = {
 1: (_LEX_EV,),
 2: (_LEX_V,),
 3: (_LEX_ADV,),
 4: (_LEX_N,),
 5: (_LEX_CONJ,),
 6: (_LEX_PREP,),
 7: (_LEX_ESii, _LEX_ADJ), #Doubles as adjective.
 8: (_LEX_ADJ, _LEX_ESii), #Doubles as E.S.(II).
 9: (_LEX_N, _LEX_V),
 10: (_LEX_ADJ, _LEX_N, _LEX_ESii), #Doubles as E.S.(II).
 11: (_LEX_ADJ, _LEX_V, _LEX_ESii), #Doubles as E.S.(II).
 12: (_LEX_PRT,),
 13: (_LEX_ESiii,),
 14: (_LEX_ESi,),
 15: (_LEX_PRON, _LEX_N,),
 16: (_LEX_ADV, _LEX_INTJ),
 17: (_LEX_PREP, _LEX_PRT),
 18: (_LEX_CNSTR,),
 19: (_LEX_ADV, _LEX_N),
 20: (_LEX_ADV, _LEX_ADJ, _LEX_ESii), #Doubles as E.S.(II).
 21: (_LEX_CONJ, _LEX_PREP),
 22: (_LEX_V, _LEX_PRT),
 23: (_LEX_ADV, _LEX_PRT),
 24: (_LEX_N, _LEX_PREP),
 25: (_LEX_ADV, _LEX_PREP),
} #: Mappings from lexical class database values to their constituent lexical class constants.

_DIALECT = {
 _DLCT_UNKNOWN: 'Unknown',
 _DLCT_CENTRAL: 'Central Standard Note',
 _DLCT_CULT_CIEL: 'Cult Ciel Note',
 _DLCT_CLUSTER: 'Cluster Note',
 _DLCT_ALPHA: 'Alpha Note',
 _DLCT_METAFALSS: 'Metafalss Note',
 _DLCT_PASTALIE: 'New Testament of Pastalie',
 _DLCT_ALPHA_EOLIA: 'Alpha Note (EOLIA)',
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
		
	def getMeaning(self, xhtml=False):
		if xhtml:
			return cgi.escape(self._meaning)
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
		dialect_node.appendChild(document.createTextNode(_DIALECT[self._dialect % _DIALECT_SHIFT]))
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
		<table class="result" style="border-collapse: collapse; border: 1px solid black; width: 100%%;">
			<tr>
				<td style="color: #00008B; text-align: center; background: #D3D3D3;">
					<div style="font-family: hymmnos, sans; font-size: 24pt;">%(display_string)s</div>
					<div style="font-size: 18pt;">%(display_string)s</div>
				</td>
			</tr>
			<tr>
				<td style="background: #808080; color: white;">
					<div style="width: 100%%;">
						%(branches)s
					</div>
				</td>
			</tr>
			<tr>
				<td style="color: #00008B; text-align: right; background: #D3D3D3; font-size: 0.7em;">
					You may wish to <a href="./search.php?%(display_string_translate)s">
						translate this sentence word-for-word
					</a> or <a href="./syntax-xml.py?%(display_string_xml)s">
						view it as XML
					</a>
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
	""" % {
	 'display_string': display_string,
	 'branches': _renderBranches(tree),
	 'display_string_translate': urllib.urlencode({'word': display_string}),
	 'display_string_xml': urllib.urlencode({'query': display_string}),
	}
	
def _decorateWord(word, prefix, suffix, slots, xhtml):
		if not slots is None:
			slots = map(cgi.escape, slots)
		else:
			slots = ()
		prefix = prefix or ''
		suffix = suffix or ''
		
		if xhtml:
			slots = [''.join(('<span style="color: #FFD700;">', slot, '</span>',)) for slot in slots]
			if prefix:
				prefix = ''.join(('<span style="color: #F0D000;">', cgi.escape(prefix), '</span>',))
			if suffix:
				suffix = ''.join(('<span style="color: #FF00FF;">', cgi.escape(suffix), '</span>',))
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
	(pastalie, pastalie_prefix_only, words, prefixes, suffixes, slots) = _sanitizePastalie(tokens)
	pastalie_prefix_valid = False #Enforces Pastalie when a Pastalie prefix is present.
	
	word_list = lookup.readWords(words, db_con)
	decorated_words = []
	words_details = []
	for (w, p, s, l) in zip(words, prefixes, suffixes, slots):
		lexicon_entry = word_list.get(w.lower())
		if lexicon_entry is None:
			if w.isdigit(): #It's a number.
				lexicon_entry = ([w, w, w, 8, 1, None, ''],)
			if p: #Reattach the prefix, since it may be a song or a mistakenly capitalized word.
				song_check = p.lower() + w.lower()
				p = None
				lexicon_entry = lookup.readWords((song_check,), db_con).get(song_check)
			if lexicon_entry is None:
				raise ContentError("unknown word in input: %(word)s" % {
				 'word': w,
				})
		elif pastalie and p:
			pastalie_prefix_valid = True
			
			pastalie_entry = 0
			for (i, l_e) in enumerate(lexicon_entry):
				if l_e[4] % _DIALECT_SHIFT == _DLCT_PASTALIE: #Favour Pastalie forms.
					pastalie_entry = i
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
	return (words_details, ' '.join(decorated_words), pastalie_prefix_valid or (pastalie and not pastalie_prefix_only))
	
def _processAST(words, ast, phrase=None):
	#Refuse to process requests that would invariably lead to failure.
	if words:
		if phrase in ('AnP', 'AvP', 'AnlP', 'AvlP'):
			if len(words) == 1:
				return None
			else:
				relevant_classes = None
				if phrase in ('AnP', 'AnlP'):
					relevant_classes = (_LEX_N,)
				else:
					relevant_classes = (_LEX_EV, _LEX_V)
				filter_classes = (_LEX_ADV, _LEX_ADJ)
				following_classes = [_SYNTAX_MAPPING[c] for (w, m, k, c, d, e, s) in words[1][0]]
				for classes in [_SYNTAX_MAPPING[c] for (w, m, k, c, d, e, s) in words[0][0]]:
					if len(classes) > 1 and [None for c in classes if c in filter_classes] and [None for c in classes if c in relevant_classes]: #Variable, stop-on-able item.
						for f_classes in following_classes:
							if not [None for c in f_classes if c in relevant_classes]: #Not AP-eligible.
								return None
		if phrase in ('AaP', 'AalP'):
			word = words[0][0][0]
			if "%(word)s$%(dialect)i" % {
			 'word': word[0],
			 'dialect': word[4],
			} in (
			 're$%(dialect)i' % {'dialect': _DLCT_CENTRAL,},
			 'na$%(dialect)i' % {'dialect': _DLCT_CENTRAL,},
			 'zz$%(dialect)i' % {'dialect': _DLCT_PASTALIE,},
			): #These are prefixes only.
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
	(words_details, display_string, pastalie) = _digestTokens(tokens, db_con)
	
	message = result = None
	if not pastalie:
		result = _processAST(words_details, _GENERAL_AST)
	else:
		result = _processAST(words_details, _PASTALIE_AST)
		
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
		if "%(word)s$%(dialect)i" % {
		 'word': word.lower(),
		 'dialect': dialect % _DIALECT_SHIFT,
		} == target:
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
		<div class="phrase phrase-%(colour)i">
			<span class="phrase-title">%(type)s</span>
			<div class="phrase-content">%(content)s</div>
		</div>
	""" % {
	 'colour': _PHRASE_COLOURS[_PHRASE_REDUCTION[tree.getPhrase()]],
	 'type': _PHRASE_EXPANSION[_PHRASE_REDUCTION[tree.getPhrase()]],
	 'content': '\n'.join(children_entries),
	}
	
def _renderLeaf(leaf):
	base_word = leaf.getBaseWord()
	if base_word.isdigit():
		base_word = '1'
		
	return """<span class="phrase-word-dialect">(%(base_dialect)s)</span>
		<div class="phrase-word phrase-word-%(class)i">
			<a href="javascript:popUpWord('%(base_word)s', %(dialect)i)" style="color: white;">
				%(word)s
			</a>
			<span class="phrase-word-class">(%(syntax_class)s)</span>
			<div class="phrase-word-meaning">%(meaning)s</div>
		</div>
	""" % {
	 'base_dialect': _DIALECT[leaf.getDialect() % _DIALECT_SHIFT],
	 'class': leaf.getClass(),
	 'base_word': base_word,
	 'dialect': leaf.getDialect(),
	 'word': leaf.getWord(True),
	 'syntax_class': _SYNTAX_CLASS_FULL[leaf.getClass()],
	 'meaning': leaf.getMeaning(True),
	}
	
def _sanitizePastalie(tokens):
	emotion_verbs = lookup.EMOTION_VERB_REGEXPS
	pastalie = False
	pastalie_prefix_only = True
	
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
				
				pastalie = True
				pastalie_prefix_only = False
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
			
			pastalie = True
			if match.group(3):
				pastalie_prefix_only = False
			continue
			
		words.append(token)
		prefixes.append(None)
		suffixes.append(None)
		slots.append(None)
		
	return (pastalie, pastalie_prefix_only, words, prefixes, suffixes, slots)
	
	
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
		
