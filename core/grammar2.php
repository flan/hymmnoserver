<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Grammar (Pastalia)</title>
		<?php include 'common/resources.xml'; ?>
		<style type="text/css">
			td.ev-1{
				background: #bbffbb;
				text-align: center;
			}
			td.ev-2{
				background: #bbbbff;
				text-align: center;
			}
			td.ev-3{
				background: #bbbbbb;
				text-align: center;
			}
			td.ev-4{
				background: #ffbbbb;
				text-align: center;
			}
			td.ev-5{
				background: #aaccaa;
				text-align: center;
			}
			td.ev-6{
				background: #ffcccc;
			}
			td.ev-1b{
				background: #ddffdd;
			}
			td.ev-2b{
				background: #ddddff;
			}
			td.ev-3b{
				background: #dddddd;
			}
			td.ev-4b{
				background: #ffddff;
			}
			td.ev-5b{
				background: #eebbff;
			}
			td.ev-6b{
				background: #ffeeee;
			}
			td.dark-blue{
				background: #000044;
				color: white;
				font-weight: bold;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Before learning the Pastalie New Testament grammar...</div>
			<p>
				The grammar of Pastalia is based on the standard
				<a href="/hymmnoserver/grammar.php">grammar of the First Era</a>.
				Because of this, knowledge of that grammar is a prerequisite for understanding what will be
				discussed here.
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Grammar principles</div>
			<p>
				Pastalia is based on the idea of expressing as much meaning and emotion as possible with as few
				words as possible.
				This variant of Hymmnos is so streamlined that, in some cases, a single word, known as an
				&quot;Emotion Verb&quot; is enough to form an entire sentence.
			</p>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">1. Usage with implicit objects</div>
				<p>
					When the subject of a sentence is implied by context, it is possible to form useful
					Hymmnos using only one word. Like usual, we will explore this concept with an example.
				</p>
				<table>
					<tr>
						<td class="ev-1">hEmmErYE</td>
						<td class="ev-3">/.</td>
					</tr>
					<tr>
						<td class="ev-1b">Emotion Verb</td>
						<td class="ev-3b">invoke</td>
					</tr>
				</table>
				<p>
					This complete sentence means &quot;I would be delighted to sing&quot;.<br/>
					As a tease of what is to come, &quot;Was yea ra chs hymmnos mea,&quot; the
					example from the standard grammar section, can be written in Pastalia as
					&quot;cEzE hymmnos/.&quot;; both forms carry the same meaning:
					&quot;I am delighted to express myself through song&quot;.
				</p>
				<p>
					Emotion Verbs are written as a series of alternating lower-case and upper-case
					letters; the exact details of this system will be described later. For now, the
					most important detail is how they identify their objects, given the implicit
					referencing nature of this sentence structure. The upper-case components indicate
					one of three possible scopes:
					<ul class="basic-inline" style="font-weight: bold; font-size: 9pt; margin-top: -10px;">
						<li>The speaker herself</li>
						<li>An individual, singled out by context</li>
						<li>All of the speaker's surroundings</li>
					</ul>
				</p>
				<p>
					Intuitively, if the objects relevant to the Hymmnos can be identified by one of these
					three scope limiters, then there is no need to explicitly identify them; the qualifiers
					(upper-case components) packed into the Emotion Verb will convey all needed information.
				</p>
				<p>
					Sentences in Pastalia are terminated with &quot;/.&quot;; fundamentally, this is the same
					as how sentences are normally terminated with a period in English, but this also has the
					effect of executing the spoken statement.
					As an alternative, &quot;!&quot; and &quot;?&quot; may be used to indicate the end of a
					statement without invoking anything. 
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">2. Usage with explicit objects</div>
				<p>
					If it is not clear what the objects are from context, they need to be qualified explicitly.
				</p>
				<table>
					<tr>
						<td bgcolor="#bbffbb" align=center>hEmmErYE</td>
						<td bgcolor="#bbbbff" align=center>hymmnos</td>
						<td bgcolor="#bbbbbb" align=center>/.</td>
					</tr>
					<tr>
						<td bgcolor="#ddffdd" class=fonts2>Emotion Verb</td>
						<td bgcolor="#ddddff" class=fonts2>object</td>
						<td bgcolor="#dddddd" class=fonts2>invoke</td>
					</tr>
				</table>
				<p>
					This sentence is an extension of the one found in the previous example; it means
					&quot;I would be delighted to sing a song&quot;.<br/>Notice how the intent has not
					changed (the speaker still expresses eagerness over doing something); the only
					difference is that it is now clear what the speaker intends to do.
				</p>
				<p>
					The same structure may be used when identifying proper nouns; the syntax here
					is like [VO] in English.
				</p>
			</div>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Emotion Verbs</div><br/>
			<p>
				The meaning of Emotion Verbs is not fixed.
				Depending on how they are constructed, they can convey very different things from
				sentence to sentence.
				This flexibility is the key to the power of Pastalia.
			</p>
			<p>
				Emotion Verbs are formed of two types of elements: a template and Emotion Vowels.<br/>
				Let's revisit our example word, &quot;hEmmErYE&quot;.
				Its template is &quot;h.m.m.r.&quot; and it has three emotion vowels:
				&quot;E&quot;, another &quot;E&quot;, and &quot;YE&quot;.
				Notice that the template is written in lower-case letters, while the Emotion Vowels
				are written in upper-case.
			</p>
			<table>
				<tr>
					<td class="ev-1" colspan="2" style="color: blue;">
						h<span style="color: red;">E</span>mm<span style="color: red;">E</span>r<span style="color: red;">YE</span><br/>
						<span class="text-basic">&quot;I would be delighted to sing&quot;</span>
					</td>
				</tr>
				<tr>
					<td class="dark-blue" colspan="2">↓disassembly↓</td>
				</tr>
				<tr>
					<td class="ev-2">
						[template]<br/><b>h.m.m.r.</b>
					</td>
					<td class="ev-4">
						[Emotion Vowels]<br/>1: <b>E</b> | 2: none | 3: <b>E</b> | 4: <b>YE</b>
					</td>
				</tr>
			</table>
			<p>
				In the following sections, the exact meaning of these components will be described.
			</p>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Template words</div>
				<p>
					<b>[h<span style="color: red;">.</span>m<span style="color: red;">.</span>m<span style="color: red;">.</span>r<span style="color: red;">.</span>]</b> (express, state, insist)
				</p>
				<p>
					The keys to template words are the dots (periods) that separate their component letters.
					These dots, called "Bank Slots", may hold Emotion Vowels, and it is the combination of
					these two elements that give them their meaning.
				</p>
				<p>
					&quot;h.m.m.r.&quot; has four Bank Slots, one after each letter.
					The significance of Emotion Vowels is reduced as they appear closer to the end of an
					Emotion Verb.
					In other words, the first Emotion Vowel in an Emotion Verb has the most influence
					over the meaning of the speaker's statement.
					To provide more flexibility in expressing emotional significance, Bank Slots may be
					left empty; Emotion Vowels appearing after an empty Bank Slot hold the same
					significance that they would were that space filled.
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Emotion Vowels</div>
				<p>
					As mentioned previously, Emotion Vowels are the upper-case letters found in
					Emotion Verbs.
					They may be placed into any of a template word's Bank Slots, or these Bank
					Slots may be left empty.
				</p>
				<p>
					There are three categories of Emotion Vowels; they may be used interchangably
					to better reflect the emotions of the speaker, and members of one group
					may be used together or reused to strengthen or elaborate the emotions behind
					a statement.
				</p>
				<p style="font-weight: bold;">
					Category 1: Emotions directed towards the speaker herself<br/>
					Category 2: Emotions directed towards another individual<br/>
					Category 3: Emotions directed towards the speaker's surroundings (or the world)
				</p>
				<p>
					No one category is any less significant than the others; significance is
					determined based on how Emotion Vowels are ordered within an Emotion Verb.
				</p>
				<span class="text-title" style="color: green;">▼ Emotions directed towards the speaker herself</span><br/>
				<table>
					<tr>
						<td class="ev-1b" style="text-align: center; width: 50px;">A</td>
						<td class="ev-1b" style="text-align: center; width: 50px;">あ</td>
						<td class="ev-1b" style="width: 505px;">strength, determination</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">I</td>
						<td class="ev-1b" style="text-align: center;">い</td>
						<td class="ev-1b">pain, fear, desire to escape</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">U</td>
						<td class="ev-1b" style="text-align: center;">う</td>
						<td class="ev-1b">sadness, concern (sometimes positive)</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">E</td>
						<td class="ev-1b" style="text-align: center;">え</td>
						<td class="ev-1b">happiness, pleasure</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">O</td>
						<td class="ev-1b" style="text-align: center;">お</td>
						<td class="ev-1b">anger, malice</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">N</td>
						<td class="ev-1b" style="text-align: center;">ん</td>
						<td class="ev-1b">aloofness, relaxation, neutrality</td>
					</tr>
				</table>
				<br/>
				<span class="text-title" style="color: blue;">▼ Emotions directed towards another individual</span><br/>
				<table>
					<tr>
						<td class="ev-2b" style="text-align: center; width: 50px;">YA</td>
						<td class="ev-2b" style="text-align: center; width: 50px;">や</td>
						<td class="ev-2b" style="width: 505px;">(emotional sympathy)</td>
					</tr>
					<tr>
						<td class="ev-2b" style="text-align: center;">YI</td>
						<td class="ev-2b" style="text-align: center;">いぇい</td>
						<td class="ev-2b">suffering, pain, death</td>
					</tr>
					<tr>
						<td class="ev-2b" style="text-align: center;">YU</td>
						<td class="ev-2b" style="text-align: center;">ゆ</td>
						<td class="ev-2b">sadness, anxiety</td>
					</tr>
					<tr>
						<td class="ev-2b" style="text-align: center;">YE</td>
						<td class="ev-2b" style="text-align: center;">いぇ</td>
						<td class="ev-2b">happiness, fortune</td>
					</tr>
					<tr>
						<td class="ev-2b" style="text-align: center;">YO</td>
						<td class="ev-2b" style="text-align: center;">よ</td>
						<td class="ev-2b">anger, rage</td>
					</tr>
					<tr>
						<td class="ev-2b" style="text-align: center;">YN</td>
						<td class="ev-2b" style="text-align: center;">ぅん</td>
						<td class="ev-2b">calmness, comfort</td>
					</tr>
				</table>
				<br/>
				<span class="text-title" style="color: purple;">▼ Emotions directed towards the speaker's surroundings</span><br/>
				<table>
					<tr>
						<td class="ev-4b" style="text-align: center; width: 50px;">LYA</td>
						<td class="ev-4b" style="text-align: center; width: 50px;">りゃ</td>
						<td class="ev-4b" style="width: 505px;">(emotional sympathy)</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center;">LYI</td>
						<td class="ev-4b" style="text-align: center;">りぇい</td>
						<td class="ev-4b">pain, destruction, ruin</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center;">LYU</td>
						<td class="ev-4b" style="text-align: center;">りゅ</td>
						<td class="ev-4b">sadness, instability</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center;">LYE</td>
						<td class="ev-4b" style="text-align: center;">りぇ</td>
						<td class="ev-4b">happiness, satisfaction</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center;">LYO</td>
						<td class="ev-4b" style="text-align: center;">りょ</td>
						<td class="ev-4b">strife, chaos, war</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center;">LYN</td>
						<td class="ev-4b" style="text-align: center;">りん</td>
						<td class="ev-4b">calmness, quietness</td>
					</tr>
				</table><br/>
			</div>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Nouns</div><br/>
			<p>
				Infel-Phira, for which the New Testament of Pastalie was created, supports the
				standard noun forms found in other dialects of Hymmnos. However, with Pastalia's
				emphasis on succinct sentences, a noun syntax that couples ownership with emotional
				attachment has been developed.<br/>
				Once again, this language feature will be demonstrated with examples.
				<table>
					<tr>
						<td style="background: #ffff88; text-align: center;" colspan="3">
							<b>lyuma (star)</b><br/>
							<font class=fonts1>(noun from the New Testament of Pastalie)</font>
						</td>
					</tr>
					<tr>
						<td class="ev-1b">Form 1</td>
						<td class="ev-1b">Elyuma</td>
						<td class="ev-1b">The speaker's star; it makes her happy</td>
					</tr>
					<tr>
						<td class="ev-2b">Form 2</td>
						<td class="ev-2b">YUlyuma</td>
						<td class="ev-2b">Someone else's star; it worries them</td>
					</tr>
					<tr>
						<td class="ev-4b">Form 3</td>
						<td class="ev-4b">LYNlyuma</td>
						<td class="ev-4b">Everyone's star; it soothes them</td>
					</tr>
					<tr>
						<td class="ev-5b">Form 4</td>
						<td class="ev-5b">Olyuma_cloche</td>
						<td class="ev-5b">Cloche's star; it infuriates her</td>
					</tr>
				</table>
			</p>
			<p>
				As seen above, an Emotion Vowel that prefixes a noun indicates to whom
				it belongs, as well as the nature of their emotional connection to the
				entity being described. This table formalizes the pattern, using the
				Emotion Vowel family &quot;A&quot; as an example.
				<table>
					<tr style="font-weight: bold;">
						<td class="ev-5" style="width: 90px;">Owner</td>
						<td class="ev-5" style="width: 200px;">Expression form</td>
					</tr>
					<tr>
						<td class="ev-1b">me</td>
						<td class="ev-1b">A[object]</td>
					</tr>
					<tr>
						<td class="ev-1b">you</td>
						<td class="ev-1b">YA[object]</td>
					</tr>
					<tr>
						<td class="ev-1b">everyone,<br/>the land,<br/>the world</td>
						<td class="ev-1b">LYA[object]</td>
					</tr>
					<tr>
						<td class="ev-1b">a person</td>
						<td class="ev-1b">A[object]_[person's name]</td>
					</tr>
				</table><br/>
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ The structure of long sentences</div><br/>
			<p>
				As sentences become longer, the differences between the New Testament of Pastalie and
				standard Hymmnos become less pronounced. Indeed, the sentence structures are very much
				the same: 
			</p>
			<p style="font-weight: bold;">
				[Emotion Verb]-[object]-[object] [VOO]<br/>
				[Emotion Verb]-[object]-[compound] [VOC]<br/>
				[Emotion Verb]-[compound] [VC]
			</p>
			<p>
				As you can see, when long sentences are required, the advantages of Pastalia are
				dramatically lessened.
				(Compounds, of course, may be built in the same manner as in other Hymmnos dialects)
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ &quot;x.&quot;, the subject identifier</div><br/>
			<p>
				Just as in standard variants of Hymmnos, the New Testament of Pastalie features a means of
				explicitly specifying the subject of a sentence. However, the emotional expressiveness
				permitted by this structure has been expanded.
			</p>
			<p style="color: green; font-role: italic;">
				[x.]-[rre]-[subject]-[Emotion Verb]-[OO/OC/C]
			</p>
			<p>
				&quot;x.&quot;, as you may have noticed, bears a Bank Slot.
				It accepts an Emotion Vowel that may be used to describe the speaker's emotions regarding
				the matter of the sentence.
			</p>
			<p>
				<b>xE rre cloche cEzE hymmnos/.</b><br/>
				&quot;Cloche is delighted to express herself through song, and this makes me happy.&quot;
			</p>
			<p>
				Just as with standard Hymmnos, the subject identifier &quot;rre&quot; and the subject it
				identifies may be omitted in favour of a pronoun; there are no differences in how
				pronouns are defined in the New Testament of Pastaile. An example follows:
			</p>
			<p>
				<b>xI harr cEzE hymmnos/.</b><br/>
				&quot;She is delighted to express herself through song, and this makes me jealous.&quot;
			</p>
			<p>
				<span style="color: red;">
					Lazy, a contributer to <a href="http://conlang.wikia.com/wiki/Conlang:Hymmnos">Conlang</a>,
					made note of the following information. However, it does not seem to appear anywhere on
					<a href="http://game.salburg.com/hymmnoserver/">HYMMNOSERVER</a>. But, because it seems
					reasonable and significant, it has been included here.
				</span><br/>
				&quot;x.&quot; can accept only Category 1 Emotion Vowels, and they carry slightly different
				meanings in this context:
				<table>
					<tr>
						<td class="ev-1b" style="text-align: center; width: 50px;">A</td>
						<td class="ev-1b" style="text-align: center; width: 50px;">あ</td>
						<td class="ev-1b">I feel indifferent</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">I</td>
						<td class="ev-1b" style="text-align: center;">い</td>
						<td class="ev-1b">I feel jealous</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">U</td>
						<td class="ev-1b" style="text-align: center;">う</td>
						<td class="ev-1b">I feel concerned</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">E</td>
						<td class="ev-1b" style="text-align: center;">え</td>
						<td class="ev-1b">I feel happy</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">O</td>
						<td class="ev-1b" style="text-align: center;">お</td>
						<td class="ev-1b">I feel angry</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center;">N</td>
						<td class="ev-1b" style="text-align: center;">ん</td>
						<td class="ev-1b">I feel opposed</td>
					</tr>
				</table><br/>
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Grammatical flexibility</div>
			<p>
				The New Testament of Pastalie introduces additional rules that broaden the range
				of feelings that may be communicated. This section provides a brief overview of
				how they work.
			</p>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Passive voice</div>
				<p>
					Appending a &quot;-eh&quot; suffix to an Emotion Verb will cause the sentence to be
					interpreted in the passive voice.
				</p>
				<p>
					<b>hEmmErYE</b><br/>
					&quot;I would be delighted to sing&quot; (active voice)
				</p>
				<p>
					<b>hEmmErYEeh</b><br/>
					&quot;Obliging would delight me&quot; (passive voice)
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Emphasis</div>
				<p>
					By placing &quot;rre&quot; before a pronoun, which normally does not
					require a subject identifier, its significance will be emphasized,
					which narrows the scope of the statement.
				</p>
				<p>
					<b>xE rre yorra cEzE hymmnos/.</b><br/>
					&quot;Cloche and company are delighted to express themselves through song, and this makes me happy.&quot;
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Negation</div>
				<p>
					Placing &quot;zz&quot; before an Emotion Verb or noun (Emotion Sound optional) will cause it to
					carry meaning opposite to its normal interpretation.
				</p>
				<p>
					<b>zz hEmmErYE/.</b><br/>
					&quot;I would <b>not</b> be delighted to sing&quot;
				</p>
				<p>
					<b>zz arhou</b><br/>
					&quot;despair&quot; (normally &quot;hope&quot;)
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Using Emotion Verbs as nouns</div>
				<p>
					If all Bank Slots in an Emotion Verb are left unused, then the template word
					may be interpreted as a noun.
				</p>
				<p>
					<b>fEwrEn h.m.m.r. eje/.</b><br/>
					&quot;I am happy to embrace the singing of my heart&quot;
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Quotation</div>
				<p>
					In the New Testament of Pastalie, Hymmnos between :/ and /: are considered quoted,
					just like encapsulating text in &quot;&quot; in English.
				</p>
			</div>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Functions</div>
			<p>
				Under the New Testament of Pastalie, it is possible to define a complete
				Hymmnos passage and specify a name by which it may be invoked in the future.
				The syntax for invoking this mechanism follows:
			</p>
			<p>
				<span style="color: green; font-role: italic;">[function name]->[Hymmnos passage]</span><br/>
				(&quot;->&quot; is pronounced as &quot;pass&quot;)
			</p>
			<p>
				Upon completion, it is possible to invoke the complete, stored passage with
				the single word provided as the name of the function.
				As always, an example follows.
			</p>
			<p>
				<b>ishikawa -> jYOzAt METHOD_HYMME_ISHIKAWA_JANNE/. !<br/>
				ishikawa! ishikawa! ishikawa! ishikawa!</b>
			</p>
			<p>
				In this example, the Hymmnos &quot;jYOzAt METHOD_HYMME_ISHIKAWA_JANNE/.&quot; was
				stored in a function named &quot;ishikawa&quot;. It was then invoked four times.<br/>
				(Of course, because &quot;!&quot; was present at the end of every statement,
				nothing would have really been invoked)
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Putting it all together</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Example words</div>
				<p>
					h<u><b>YA</b></u>mmr<u><b>A</b></u><br/>
					&quot;I will sing my best for you&quot;
				</p>
				<p>
					h<u><b>YI</b></u>m<u><b>O</b></u>m<u><b>O</b></u>r<u><b>O</b></u><br/> 
					&quot;I will sing of how I want you dead&quot;
				</p>
				<p>
					h<u><b>YE</b></u>m<u><b>YE</b></u>m<u><b>A</b></u>r<u><b>A</b></u><br/>
					&quot;I will sing as best I can for your elation&quot;
				</p>
				<p>
					h<u><b>E</b></u>m<u><b>E</b></u>m<u><b>A</b></u>r<u><b>A</b></u><br/>
					&quot;I will sing as best I can to express my elation&quot;
				</p>
				<p>
					h<u><b>LYI</b></u>m<u><b>LYU</b></u>m<u><b>O</b></u>r<u><b>O</b></u><br/>
					&quot;I will sing to bring ruin and misery upon this wretched world&quot;
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Example statements</div>
				<p>
					Complete sentences including nouns are presented below.
					Any noun present in modern Hymmnos may be used with Emotion Verbs
					within the context of the New Testament of Pastalie.
				</p>
				<p>
					<b>hYAmmrA chroche/.</b><br/>
					&quot;I will sing my best for Cloche&quot;
				</p>
				<p>
					<b>hYImOmOrO!</b><br/>
					&quot;I will sing of how I want you dead&quot; (not invoked)
				</p>
				<p>
					<b>cEzE hymmnos/.</b><br/>
					&quot;I am delighted to express myself through song&quot;
				</p>
				<p>
					<b>cYEzYE hymmnos/.</b><br/>
					&quot;You are delighted I am expressing you through song&quot;
				</p>
				<p>
					<b>xN rre harr hLYImLYUmOrO a.u.k. zess quesa/.</b><br/>
					&quot;Her singing is like thunder upon the land&quot;
				</p>
			</div>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
