import cgi
import re
import xml.dom.minidom

import lookup

_PHRASE_EXPANSION = {
 'ESP': "Emotion Sound Phrase",
 'VP': "Verb Phrase",
 'NP': "Noun Phrase",
 'SgP': "Subject Phrase",
 'AP': "Complement Phrase",
 'CP': "Clause Phrase",
 'CgP': "Compound Phrase",
}
_PHRASE_REDUCTION = {
 'ESP': 'ESP',
 'VP': 'VP',
 'NP': 'NP',
 'SgP': 'SP',
 'AP': 'AP',
 'CP': 'CP',
 'CgP': 'MP',
}

_L_CASE_REGEXP = re.compile("^[a-z]+\$\d+$")

_ANY = 0 #0-or-more (failure tolerated)
_ALL = -1 #failure not tolerated
_ONE = 1 #Failure not tolerated, one of the set

_GENERAL_AST = (_ALL,
 (_ANY, (_ONE, (_ALL, 'ESP', 'VP'), 'VP'), (_ONE, 'SgP', 'NP')), #[([ESP] VP) | (SgP | NP)]
 'VP',
 (_ANY, 'NP'),
 'CgP',
)

_PASTALIA_AST = ()

_AST_FRAGMENTS = {
 'ESP': (_ALL, 14, 7, 13), #<ES I, ES II, ES III>
 'VP': (_ALL,
  (_ANY, 'AP'),
  2,
  (_ANY, (_ALL, (_ONE, 6, 12), 'NP', (_ANY, 'PP'))),
  (_ANY, (_ALL, 5, 'VP'))
 ), #<[AvP] v. [[prep | prt] NP [PP]] [conj VP]>
 'SgP': (_ONE, (_ALL, 'rre$1', 'NP'), 15), #<(rre NP) | pron.>
 'CgP': (_ANY,
  (_ONE, 'NP', (_ALL, 'VP', (_ANY, 'NP'), 'CgP'))
 ), #[NP | (VP NP CgP) | (VP CgP)]
 'NP': (_ONE,
  (_ALL, 'AP', 'NP'),
  (_ALL, 4, 'NP'),
  4,
  (_ANY, (_ALL, (_ONE, 5, 6), 'NP'))
 ), #<(AjP NP) | (n. NP) | n. [(conj | prep) NP]>
 'AP': (_ONE,
  (_ALL, 6, (_ANY, 'AP'), (_ANY, (_ALL, 5, 'AP'))),
  (_ALL, 8, (_ANY, 'AP'), (_ANY, (_ALL, 5, 'AP'))),
  (_ALL, 3, (_ANY, 'AP'), (_ANY, (_ALL, 5, 'AP'))),
 ), #[(prep | adj | adv) AP [conj AP]]
 'PP': (_ALL, (_ONE, 6, 12), 'NP'), #<<prep | prt> NP>
}

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
}
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
 18: (18,),
 19: (3, 4),
 20: (3, 8),
 21: (5, 6),
}
_DIALECT = {
 0: 'Unknown',
 1: 'Central Standard Note',
 2: 'Cult Ciel Note',
 3: 'Cluster Note',
 4: 'Alpha Note',
 5: 'Metafalss Note',
 6: 'New Testament of Pastalie',
 7: 'Alpha Note (EOLIA)',
}

_EMOTION_VOWELS = 'A|I|U|E|O|N|YA|YI|YU|YE|YO|YN|LYA|LYI|LYU|LYE|LYO|LYN'
_EMOTION_WORDS_REGEXP = re.compile('^(%s)?(.+)(_\w+)?$' % _EMOTION_VOWELS)

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
	
	tokens = re.sub("/\.$", "", line, 1).split()
	
	tree = _SyntaxTree()
	(display_string, result) = _processInput(tree, tokens, db_con)
	
	return (tree, display_string, result)
	
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
			
	result = result and tree.countLeaves() == len(tokens)
	
	return (display_string, result)
	
def _processAST(words, ast, pastalia, phrase=None):
	if not ast:
		return None
		
	nodes = []
	tuple_rule = ast[0]
	
	for st_a in ast[1:]:
		if type(st_a) == int:
			result = _processWord_int(words, st_a, pastalia)
			if result is None:
				if tuple_rule == _ALL:
					return None
			else:
				nodes.append(result)
				words = words[result.countLeaves():]
				if tuple_rule == _ONE:
					break
		elif type(st_a) == str:
			if _L_CASE_REGEXP.match(st_a): #Exact word needed.
				result = _processWord_exact(words, st_a)
				if result is None:
					if tuple_rule == _ALL:
						return None
				else:
					nodes.append(result)
					words = words[result.countLeaves():]
					if tuple_rule == _ONE:
						break
			else:
				result = _processAST(words, _AST_FRAGMENTS[st_a], pastalia, st_a)
				if result is None:
					if tuple_rule == _ALL:
						return None
				else:
					offset = 0
					for node in result:
						nodes.append(node)
						offset += node.countLeaves()
					words = words[offset:]
					if tuple_rule == _ONE:
						break
		else: #Tuple.
			result = _processAST(words, st_a, pastalia)
			if result is None:
				if tuple_rule == _ALL:
					return None
			else:
				offset = 0
				for node in result:
					nodes.append(node)
					offset += node.countLeaves()
				words = words[offset:]
				if tuple_rule == _ONE:
					break
					
	if tuple_rule == _ONE and not nodes:
		return None
		
	#Successfully validated tuple.
	if phrase and nodes:
		root = _Phrase(phrase)
		for node in nodes:
			root.addChild(node)
		return [root]
	return nodes
		
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
	
def _processWord_exact(words, target):
	if not words:
		return None
		
	(details, prefix, suffix, slots) = words[0]
	for (word, meaning_english, kana, syntax_class, dialect, decorations, syllables) in details:
		if "%s$%i" % (word.lower(), dialect) == target:
			return _Word(word, meaning, syntax_class, dialect, prefix, suffix, slots)
	return None
	
def _sanitizePastalia(tokens, db_con):
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
				
				emotion_hit = True
				pastalia = True
				break
		if not emotion_hit:
			match = _EMOTION_WORDS_REGEXP.match(token)
			if match and match.group(1) or match.group(3):
				words.append(match.group(2))
				prefixes.append(match.group(1))
				suffixes.append(match.group(3))
				slots.append(None)
				
				emotion_hit = True
				pastalia = True
				break
		if not emotion_hit:
			words.append(token)
			prefixes.append(None)
			suffixes.append(None)
			slots.append(None)
			
	return (pastalia, words, prefixes, suffixes, slots)
	
def _digestTokens(tokens, db_con):
	(pastalia, words, prefixes, suffixes, slots) = _sanitizePastalia(tokens, db_con)
	
	word_list = lookup.readWords(words, db_con)
	decorated_words = []
	words_details = []
	for (w, p, s, l) in zip(words, prefixes, suffixes, slots):
		lexicon_entry = word_list.get(w.lower())
		if lexicon_entry is None:
			song_check = (p or '') + w
			lexicon_entry = lookup.readWords((song_check,), db_con).get(song_check)
			if lexicon_entry is None:
				raise ContentError("Unknown word in input: %s" % w)
				
		decorated_words.append(_decorateWord(lexicon_entry[0][0].lower(), p, s, l, False))
		
		if len(lexicon_entry) == 1 and lexicon_entry[0][4] % 50 == 6: #Pastalia.
			pastalia = True
			
		words_details.append((lexicon_entry, p, s, l))
	return (words_details, ' '.join(decorated_words), pastalia)
	
def _decorateWord(word, prefix, suffix, slots, xhtml):
	#Avoid Nones.
	if not slots is None:
		slots = map(cgi.escape, slots)
	else:
		slots = ()
	prefix = prefix or ''
	suffix = suffix or ''
	
	if xhtml:
		slots = ["<span style=\"color: #FFD700;\">%s</span>" % (slot) for slot in slots]
		prefix = "<span style=\"color: #FF00FF;\">%s</span>" % (cgi.escape(prefix))
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
	

"""
	#Renders a single word in the output table.
	#Return format: true if this word has alternative entries.
	function renderWord($word){
		global $SYNTAX_CLASS;
		
		list($l_word, $english, $kana, $class, $dialect, $decorations, $hits) = $word;
		$base_word = htmlspecialchars($l_word);
		if($hits == 0){
			$english = '???';
			$kana = '???';
		}else{
			$l_word = "<a href=\"javascript:popUpWord('$base_word', $dialect)\" style=\"color: white;\">".decorateWord($l_word, $class, $decorations, true)."</a>";
		}
		
		echo "<tr>";
			echo "<td class=\"word-header-$class\" style=\"width: 17%;\">$l_word</td>";
			echo "<td class=\"word-header-$class\" style=\"width: 14%;\">$SYNTAX_CLASS[$class]</td>";
			echo "<td class=\"word-header-$class\" style=\"width: 50%;\">$english</td>";
			echo "<td class=\"word-header-$class\" style=\"width: 19%;\">$kana</td>";
		echo "</tr>";
		
		return $hits > 1;
	}
	
	#Processes a list of words, rendering everything provided.
	#Return format: A list of all words with alternative entries.
	function renderWords($words){
		$alternatives = array();
		foreach($words as $word){
			if(renderWord($word)){
				$word_c = $word[0];
				if(!in_array($word_c, $alternatives)){
					array_push($alternatives, $word_c);
				}
			}
		}
		return $alternatives;
	}
?>
<table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
	<tr>
		<td style="color: #00008B; text-align: center; background: #D3D3D3;">
			<div style="font-family: hymmnos; font-size: 24pt;">
				<?php echo $word_string; ?>
			</div>
			<div style="font-size: 18pt;">
				<?php echo $word_string; ?>
			</div>
		</td>
	</tr>
	<tr>
		<td style="background: #808080; color: white;">
			<table style="width: 100%; border-spacing: 1px;">
				<?php
					$alternatives = renderWords($words);
				?>
			</table>
		</td>
	</tr>
	<?php
		$alternatives_pos = 0;
		foreach($alternatives as $alternative){
			$alternatives[$alternatives_pos++] = "<a href=\"/hymmnoserver/search.php?word=".urlencode($alternative)."&exact=hymmnos\" style=\"color: white;\">".htmlspecialchars($alternative)."</a>";
		}
		if($alternatives_pos > 0){
			echo "<tr>";
				echo "<td style=\"color: white; background: black; font-size: 0.85em;\">";
					echo "Words with alternative meanings: ".implode(", ", $alternatives);
				echo "</td>";
			echo "</tr>";
		}
	?>
	<tr>
		<td style="color: #00008B; text-align: right; background: #D3D3D3; font-size: 0.7em;">
			<?php
				$query_encode = urlencode($query);
				echo "If this is a sentence, you may <a href=\"/hymmnoserver/grammar.psp?query=$query_encode\">inspect its structure</a>";
			?>
		</td>
	</tr>
</table>
<hr/>
<div style="color: #808080; font-size: 0.6em;">
	<?php
		if($alternatives_pos > 0){
			echo "<p style=\"color: black;\">Please make note of the words identified as having alternate meanings. In particular, consider that Pastalia forms typically take precedence when other Pastalia words are present.</p>";
		}
	?>
	<p>
		There is no difference between singular and plural nouns, unless implied by context:
		&quot;wart&quot;, for example, can mean either &quot;word&quot; or &quot;words&quot;,
		depending on which is more appropriate.<br/>
	</p>
	<p>
		The presented kana does not take Emotion Vowels into consideration.
	</p>
</div>

#If alternative words in other dialects could have been used instead,
#render all permutations at the bottom of the output.
#Format: word$dialect, like "tie$6", to indicate which variant to use.
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
		