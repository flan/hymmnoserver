<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php/*
All code, unless otherwise indicated, is original, and subject to the terms of
the GNU GPLv3 or, at your option, any later version of the GPL.

All content is derived from public domain, promotional, or otherwise-compatible
sources and published uniformly under the
Creative Commons Attribution-Share Alike 3.0 license.

See license.README for details.
 
(C) Neil Tallim, 2009
*/?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Hymmnoserver - Grammar (Pastalia)</title>
		<?php include 'common/resources.xml'; ?>
		<style type="text/css">
			td.ev-1{
				background: #bbffbb;
			}
			td.ev-2{
				background: #bbbbff;
			}
			td.ev-3{
				background: #bbbbbb;
			}
			td.ev-4{
				background: #ffbbbb;
			}
			td.ev-5{
				background: #aaccaa;
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
			}
		</style>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Before learning the Pastalie New Testament grammar...</div>
			<p>
				The grammar of Pastalia is based on the
				<a href="./grammar.php">standard grammar of the First Era</a>.
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
				<table style="text-align: center;">
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
					This complete sentence, &quot;hEmmErYE/.&quot;, means
					&quot;I would be delighted to sing for your happiness&quot;.
					<br/>
					<i>
						As a tease of what is to come, &quot;Was yea ra chs hymmnos mea,&quot; the
						example from the standard grammar section, can be written in Pastalia as
						&quot;cEzE hymmnos/.&quot;; both forms carry the same meaning:
						&quot;I am delighted to express myself through song&quot;.
					</i>
				</p>
				<p>
					Emotion Verbs are written as a series of alternating lower-case and upper-case
					letters; the exact details of this system will be described later. For now, the
					most important detail is how they identify their objects, given the implicit
					referencing nature of this sentence structure. The upper-case components indicate
					one of three possible scopes:
				</p>
				<ul class="basic-inline" style="font-size: 9pt; margin-top: -10px;">
					<li>The speaker herself</li>
					<li>An individual, singled out by context</li>
					<li>All of the speaker's surroundings</li>
				</ul>
				<p>
					Intuitively, if the objects relevant to the Hymmnos can be identified by one of these
					three scope limiters, then there is no need to explicitly identify them; the qualifiers
					(upper-case components) packed into the Emotion Verb will convey all needed information.
				</p>
				<p>
					Sentences in Pastalia are terminated with &quot;/.&quot;; fundamentally, this is the same
					as how sentences are normally terminated with a period in English, but this also has the
					effect of executing the spoken statement.
					As an alternative, &quot;!&quot; or &quot;?&quot; may be used to indicate the end of a
					statement without invoking anything. 
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">2. Usage with explicit objects</div>
				<p>
					If it is not clear what the objects are from context, they need to be qualified explicitly.
				</p>
				<table style="text-align: center;">
					<tr>
						<td class="ev-1">hEmmErYE</td>
						<td class="ev-2">hymmnos</td>
						<td class="ev-3">/.</td>
					</tr>
					<tr>
						<td class="ev-1b">Emotion Verb</td>
						<td class="ev-2b">object</td>
						<td class="ev-3b">invoke</td>
					</tr>
				</table>
				<p>
					This sentence is an extension of the one found in the previous example; it means
					&quot;I would be delighted to sing a song for your happiness&quot;.
					Notice how the intent has not changed (the speaker still expresses eagerness over
					doing something to make a second party happy); the only difference is that it is
					now clear exactly what the speaker intends to do.
				</p>
				<p>
					The same structure may be used when identifying proper nouns; the syntax in that
					case is like [VO] in English.
				</p>
			</div>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Emotion Verbs</div>
			<p>
				The meaning of Emotion Verbs is not fixed.
				Depending on how they are constructed, they can convey very different things from
				sentence to sentence.
				This flexibility is the key to the expressive power of Pastalia.
			</p>
			<p>
				Emotion Verbs are formed of two types of elements: a template and Emotion Vowels.<br/>
				Let's revisit our example word, &quot;hEmmErYE&quot;.
				Its template is &quot;h.m.m.r.&quot; and it has three emotion vowels:
				&quot;E&quot;, another &quot;E&quot;, and &quot;YE&quot;.
				Notice that the template is written in lower-case letters, while the Emotion Vowels
				are written in upper-case.
			</p>
			<table style="text-align: center;">
				<tr>
					<td class="ev-1" colspan="2" style="color: blue;">
						h<span style="color: red;">E</span>mm<span style="color: red;">E</span>r<span style="color: red;">YE</span><br/>
						<span class="text-basic">&quot;I would be delighted to sing for your happiness&quot;</span>
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
					<b>[h<span style="color: red;">.</span>m<span style="color: red;">.</span>m<span style="color: red;">.</span>r<span style="color: red;">.</span>]</b> (sing, express through song)
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
				<p>
					If this confuses you, don't worry. An analysis of the example sentence's emotional
					meaning is provided at the end of this section.
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
					There are three categories of Emotion Vowels; they may be used interchangeably
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
						<td class="ev-1b" style="text-align: center; width: 50px;">I</td>
						<td class="ev-1b" style="text-align: center; width: 50px;">い</td>
						<td class="ev-1b">pain, fear, desire to escape</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center; width: 50px;">U</td>
						<td class="ev-1b" style="text-align: center; width: 50px;">う</td>
						<td class="ev-1b">sadness, concern (sometimes positive)</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center; width: 50px;">E</td>
						<td class="ev-1b" style="text-align: center; width: 50px;">え</td>
						<td class="ev-1b">happiness, pleasure</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center; width: 50px;">O</td>
						<td class="ev-1b" style="text-align: center; width: 50px;">お</td>
						<td class="ev-1b">anger, malice</td>
					</tr>
					<tr>
						<td class="ev-1b" style="text-align: center; width: 50px;">N</td>
						<td class="ev-1b" style="text-align: center; width: 50px;">ん</td>
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
						<td class="ev-2b" style="text-align: center; width: 50px;">YI</td>
						<td class="ev-2b" style="text-align: center; width: 50px;">いぇい</td>
						<td class="ev-2b">suffering, pain, death</td>
					</tr>
					<tr>
						<td class="ev-2b" style="text-align: center; width: 50px;">YU</td>
						<td class="ev-2b" style="text-align: center; width: 50px;">ゆ</td>
						<td class="ev-2b">sadness, anxiety</td>
					</tr>
					<tr>
						<td class="ev-2b" style="text-align: center; width: 50px;">YE</td>
						<td class="ev-2b" style="text-align: center; width: 50px;">いぇ</td>
						<td class="ev-2b">happiness, fortune</td>
					</tr>
					<tr>
						<td class="ev-2b" style="text-align: center; width: 50px;">YO</td>
						<td class="ev-2b" style="text-align: center; width: 50px;">よ</td>
						<td class="ev-2b">anger, rage</td>
					</tr>
					<tr>
						<td class="ev-2b" style="text-align: center; width: 50px;">YN</td>
						<td class="ev-2b" style="text-align: center; width: 50px;">ぅん</td>
						<td class="ev-2b">calmness, comfort</td>
					</tr>
				</table>
				<br/>
				<span class="text-title" style="color: #800080;">▼ Emotions directed towards the speaker's surroundings</span><br/>
				<table>
					<tr>
						<td class="ev-4b" style="text-align: center; width: 50px;">LYA</td>
						<td class="ev-4b" style="text-align: center; width: 50px;">りゃ</td>
						<td class="ev-4b" style="width: 505px;">(emotional sympathy)</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center; width: 50px;">LYI</td>
						<td class="ev-4b" style="text-align: center; width: 50px;">りぇい</td>
						<td class="ev-4b">pain, destruction, ruin</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center; width: 50px;">LYU</td>
						<td class="ev-4b" style="text-align: center; width: 50px;">りゅ</td>
						<td class="ev-4b">sadness, instability</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center; width: 50px;">LYE</td>
						<td class="ev-4b" style="text-align: center; width: 50px;">りぇ</td>
						<td class="ev-4b">happiness, satisfaction</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center; width: 50px;">LYO</td>
						<td class="ev-4b" style="text-align: center; width: 50px;">りょ</td>
						<td class="ev-4b">strife, chaos, war</td>
					</tr>
					<tr>
						<td class="ev-4b" style="text-align: center; width: 50px;">LYN</td>
						<td class="ev-4b" style="text-align: center; width: 50px;">りん</td>
						<td class="ev-4b">calmness, quietness</td>
					</tr>
				</table>
			</div>
			<p>
				In our example, &quot;hEmmErYE&quot;, the Bank Slot allocation
				&quot;1: <b>E</b> | 2: none | 3: <b>E</b> | 4: <b>YE</b>&quot;
				indicates that the speaker's happiness is by far the dominant sentiment,
				although she could be happier, because the second slot is unused.
				The second party's happiness is significant, but not as significant as the
				happiness the action will provide the speaker.
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Nouns</div>
			<p>
				Infel Phira, for which the New Testament of Pastalie was created, supports the
				standard noun forms found in other dialects of Hymmnos. However, with Pastalia's
				emphasis on succinct sentences, a noun syntax that couples ownership with emotional
				attachment has been developed.<br/>
				Once again, this language feature will be demonstrated with examples.
			</p>
			<table>
				<tr>
					<td style="background: #ffff88; text-align: center;" colspan="3">
						<b>gasar (stuffed animal)</b><br/>
						<small>(noun from the New Testament of Pastalie)</small>
					</td>
				</tr>
				<tr>
					<td class="ev-1b">Form 1</td>
					<td class="ev-1b">Egasar</td>
					<td class="ev-1b">The speaker's stuffed animal; it makes her happy</td>
				</tr>
				<tr>
					<td class="ev-2b">Form 2</td>
					<td class="ev-2b">YUgasar</td>
					<td class="ev-2b">Someone else's stuffed animal; it worries them</td>
				</tr>
				<tr>
					<td class="ev-4b">Form 3</td>
					<td class="ev-4b">LYNgasar</td>
					<td class="ev-4b">Everyone's stuffed animal; it soothes them</td>
				</tr>
				<tr>
					<td class="ev-5b">Form 4</td>
					<td class="ev-5b">Agasar_cloche</td>
					<td class="ev-5b">Cloche's stuffed animal; it gives her strength</td>
				</tr>
			</table>
			<p>
				As seen above, an Emotion Vowel that prefixes a noun indicates to whom
				it belongs, as well as the nature of their emotional connection to the
				entity being described. This table formalizes the pattern, using the
				Emotion Vowel family &quot;A&quot; as an example.
			</p>
			<table>
				<tr style="font-weight: bold;">
					<td class="ev-5" style="width: 90px;">Owner</td>
					<td class="ev-5" style="width: 200px;">Expression form</td>
				</tr>
				<tr>
					<td class="ev-1b" style="width: 90px;">me</td>
					<td class="ev-1b" style="width: 200px;">A[object]</td>
				</tr>
				<tr>
					<td class="ev-1b" style="width: 90px;">you</td>
					<td class="ev-1b" style="width: 200px;">YA[object]</td>
				</tr>
				<tr>
					<td class="ev-1b" style="width: 90px;">everyone,<br/>the land,<br/>the world</td>
					<td class="ev-1b" style="width: 200px;">LYA[object]</td>
				</tr>
				<tr>
					<td class="ev-1b" style="width: 90px;">a specific<br/>person</td>
					<td class="ev-1b" style="width: 200px;">A[object]_[person's name]</td>
				</tr>
			</table>
			<p>
				<b>wYEsA Agasar_luca/.</b><br/>
				&quot;I will give you Luca's precious stuffed animal to make you happy.&quot;<br/>
				(This simple sentence offers an idea of how expressive Pastalia forms can be)
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ The structure of long sentences</div>
			<p>
				As sentences become longer, the differences between the New Testament of Pastalie and
				standard Hymmnos become less pronounced. Indeed, the sentence structures start to
				appear very much the same: 
			</p>
			<p>
				<b>[Emotion Verb]-[compound]</b> [VC]<br/>
				<b>[Emotion Verb]-[object]-[compound]</b> [VOC]
			</p>
			<p>
				As you can see, when long sentences are required, the advantages of Pastalia are
				dramatically lessened.
				(Compounds, of course, may be built in the same manner as in other Hymmnos dialects)
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ &quot;x.&quot;, the subject identifier</div>
			<p>
				Just as in standard variants of Hymmnos, the New Testament of Pastalie features a means of
				explicitly specifying the subject of a sentence. However, the emotional expressiveness
				permitted by this structure has been expanded.
			</p>
			<p style="color: green; font-role: italic;">
				[x.]-[rre]-[subject]-[Emotion Verb]-[compound]<br/>
				[x.]-[rre]-[subject]-[Emotion Verb]-[object]-[compound]
			</p>
			<p>
				&quot;x.&quot;, as you may have noticed, bears a Bank Slot.
				It accepts an Emotion Vowel that may be used to describe the speaker's emotions regarding
				the subject of the sentence.
			</p>
			<p>
				<b>xE rre cloche cEzE hymmnos/.</b><br/>
				&quot;Cloche is delighted to express herself through song and this makes me happy.&quot;
			</p>
			<p>
				Just as with standard Hymmnos, the subject identifier &quot;rre&quot; and the subject it
				identifies may be omitted in favour of a pronoun; there are no differences in how
				pronouns are defined in the New Testament of Pastaile. An example follows:
			</p>
			<p>
				<b>xI harr cEzE hymmnos/.</b><br/>
				&quot;She is delighted to express herself through song and this makes me jealous.&quot;
			</p>
			<p>
				<span style="color: red;">
					Lazy, a contributor to
					<a href="http://conlang.wikia.com/wiki/Conlang:Hymmnos">the wiki on Conlang</a>,
					made note of the following information. It is unconfirmed, but because it seems
					reasonable and significant, it has been included here.
				</span><br/>
				&quot;x.&quot; is used primarily with Category 1 Emotion Vowels and they carry slightly
				different meanings in this context:
			</p>
			<table>
				<tr>
					<td class="ev-1b" style="text-align: center; width: 50px;">A</td>
					<td class="ev-1b" style="text-align: center; width: 50px;">あ</td>
					<td class="ev-1b">indifferent</td>
				</tr>
				<tr>
					<td class="ev-1b" style="text-align: center; width: 50px;">I</td>
					<td class="ev-1b" style="text-align: center; width: 50px;">い</td>
					<td class="ev-1b">jealous</td>
				</tr>
				<tr>
					<td class="ev-1b" style="text-align: center; width: 50px;">U</td>
					<td class="ev-1b" style="text-align: center; width: 50px;">う</td>
					<td class="ev-1b">concerned</td>
				</tr>
				<tr>
					<td class="ev-1b" style="text-align: center; width: 50px;">E</td>
					<td class="ev-1b" style="text-align: center; width: 50px;">え</td>
					<td class="ev-1b">happy</td>
				</tr>
				<tr>
					<td class="ev-1b" style="text-align: center; width: 50px;">O</td>
					<td class="ev-1b" style="text-align: center; width: 50px;">お</td>
					<td class="ev-1b">angry</td>
				</tr>
				<tr>
					<td class="ev-1b" style="text-align: center; width: 50px;">N</td>
					<td class="ev-1b" style="text-align: center; width: 50px;">ん</td>
					<td class="ev-1b">opposed</td>
				</tr>
			</table>
			<p>
				&quot;x.&quot; has been used with Emotion Vowels from other categories, but their implications
				are still unknown at this time.
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
					&quot;I would be delighted to sing for your happiness&quot; (active voice)
				</p>
				<p>
					<b>hEmmErYEeh</b><br/>
					&quot;Singing for your happiness would delight me&quot; (passive voice)
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Emphasis</div>
				<p>
					By placing &quot;rre&quot; before a pronoun that does not normally
					require a subject identifier, its significance will be emphasized,
					which narrows the scope of the statement.
				</p>
				<p>
					<b>xE rre yorra cEzE hymmnos/.</b><br/>
					&quot;Cloche and company are delighted to express themselves through song and this makes me happy.&quot;
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Negation</div>
				<p>
					Placing &quot;zz&quot; before an Emotion Verb or noun (Emotion Sound optional) will cause it to
					carry meaning opposite its normal interpretation.
				</p>
				<p>
					<b>zz hEmmErYE/.</b><br/>
					&quot;I would <b>not</b> be delighted to sing for your happiness&quot;
				</p>
				<p>
					<b>zz arhou</b><br/>
					&quot;despair&quot; (normally &quot;hope&quot;)
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Using Emotion Verbs as objects</div>
				<p>
					If all Bank Slots in an Emotion Verb are left unused, then the template word
					may be interpreted as an action, like a gerund in English.
				</p>
				<p>
					<b>fEwrEn h.m.m.r. eje/.</b><br/>
					&quot;I am very happy to embrace the singing of my heart&quot;
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Quotation</div>
				<p>
					In the New Testament of Pastalie, Hymmnos between :/ and /: is considered quoted,
					just like encapsulating text between &quot;&quot; in English.
				</p>
			</div>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Functions</div>
			<p>
				Under the New Testament of Pastalie, it is possible to define a complete
				Hymmnos passage and enumerate a name by which it may be invoked in the future.
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
				nothing would actually happened)
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Putting it all together</div>
			<p style="font-style: italic;">
				Note that all of these statements are actually in the infinitive tense. However,
				conveying that while making the translation flow is difficult, so some of them have
				been written in incorrect quasi-future-tense.
			</p>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Example words</div>
				<p>
					h<b>YA</b>mmr<b>A</b><br/>
					&quot;I will sing my best for you&quot;
				</p>
				<p>
					h<b>YI</b>m<b>O</b>m<b>O</b>r<b>O</b><br/> 
					&quot;I will sing of how I want you to suffer&quot;
				</p>
				<p>
					h<b>YE</b>m<b>YE</b>m<b>A</b>r<b>A</b><br/>
					&quot;I will sing as best I can for your elation&quot;
				</p>
				<p>
					h<b>E</b>m<b>E</b>m<b>A</b>r<b>A</b><br/>
					&quot;I will sing as best I can to express my elation&quot;
				</p>
				<p>
					h<b>LYI</b>m<b>LYU</b>m<b>O</b>r<b>O</b><br/>
					&quot;I will sing angrily of bringing ruin and chaos upon the world&quot;
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">Example statements</div>
				<p>
					Complete sentences including nouns are presented below.
					Any noun present in standard Hymmnos may be used with Emotion Verbs
					within the context of the New Testament of Pastalie.
				</p>
				<p>
					<b>hYAmmrA chroche/.</b><br/>
					&quot;I will sing my best for Cloche&quot;
				</p>
				<p>
					<b>hYImOmOrO!</b><br/>
					&quot;I will sing of how I want you to suffer&quot; (not invoked)
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
					&quot;Her singing is like a sharp lightning strike upon the land&quot;
				</p>
			</div>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
