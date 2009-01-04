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
			<p style="color: red;">
				Some of the content found on this page parallels that translated by
				<a href="http://conlang.wikia.com/wiki/Conlang:Hymmnos">Conlang</a> because
				their work was used as a reference for accuracy.
				They have put extensive work into documenting how the Hymmnos language works, and
				I neither wish to contradict their research, nor duplicate it unnecessarily; all
				I wish to do is present the content in a manner that offers English-speaking
				audiences an experience similar to that provided to the Japanese by GUST.
			</p>
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
					This complete sentence means &quot;I would be delighted to oblige&quot;.<br/>
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
					changed (the speaker still expresses eagerness at doing something); the only
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
						<span class="text-basic">&quot;I would be delighted to oblige&quot;</span>
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
						<td class="ev-2b" style="text-align: center; width: 50px;">A</td>
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
			<div class="section-title text-title-small">⠕ 名詞</div><br/>
			<p>
				新約パスタリエは、「インフェル・ピラ」サーバーが現行ヒュムノスをエミュレーションする為、第一紀成語の名詞も使用可能である。
				しかし、新約パスタリエ専用名詞を使うことで更に効率化を図れる。<br/>
				新約パスタリエの名詞は、その語頭が効率化の特徴となる。例を挙げて説明する。
				<table>
					<tr>
						<td bgcolor="ffff88" class=fonts2 align=center colspan=3>
							<b>gasar（がさる）:ぬいぐるみ</b><br/>
							<font class=fonts1>（新約パスタリエ名詞）</font>
						</td>
					</tr>
					<tr>
						<td bgcolor="ddffdd" class=fonts2 align=left>展開１</td>
						<td bgcolor="ddffdd" class=fonts2 align=left>Agasar</td>
						<td bgcolor="ddffdd" class=fonts2 align=left>私のぬいぐるみ</td>
					</tr>
					<tr>
						<td bgcolor="ddddff" class=fonts2 align=left>展開２</td>
						<td bgcolor="ddddff" class=fonts2 align=left>YAgasar</td>
						<td bgcolor="ddddff" class=fonts2 align=left>貴方（達）のぬいぐるみ</td>
					</tr>
					<tr>
						<td bgcolor="ffddff" class=fonts2 align=left>展開３</td>
						<td bgcolor="ffddff" class=fonts2 align=left>LYAgasar</td>
						<td bgcolor="ffddff" class=fonts2 align=left>この場（公共）のぬいぐるみ</td>
					</tr>
					<tr>
						<td bgcolor="eebbff" class=fonts2 align=left>展開４</td>
						<td bgcolor="eebbff" class=fonts2 align=left>Agasar_chroche</td>
						<td bgcolor="eebbff" class=fonts2 align=left>クローシェのぬいぐるみ</td>
					</tr>
				</table>
			</p>
			<p>
				上記のように、一単語で「〜の」という所まで包含する。
				<table>
					<tr>
						<td bgcolor="aaccaa" class=fonts2 align=center width=90><b>目的</b></td>
						<td bgcolor="aaccaa" class=fonts2 align=center width=200><b>用法</b></td>
					</tr>
					<tr>
						<td bgcolor="ddffdd" class=fonts2 align=left>私の</td>
						<td bgcolor="ddffdd" class=fonts2 align=left>A〜</td>
					</tr>
					<tr>
						<td bgcolor="ddffdd" class=fonts2 align=left>貴方(達)の</td>
						<td bgcolor="ddffdd" class=fonts2 align=left>YA〜</td>
					</tr>
					<tr>
						<td bgcolor="ddffdd" class=fonts2 align=left>この場の</td>
						<td bgcolor="ddffdd" class=fonts2 align=left>LYA〜</td>
					</tr>
					<tr>
						<td bgcolor="ddffdd" class=fonts2 align=left>○○の</td>
						<td bgcolor="ddffdd" class=fonts2 align=left>A〜_○○</td>
					</tr>
				</table>
			</p>
			<p>
				※母音が続く場合は伸ばす。例えば名詞が「abb（あぶぶ）」の場合「Aabb（あーぶぶ）」になる。
			</p>
			<p>
				<b>wYEsA Agasar_luca/.</b><br/>
				（うぃえさ　あがさる　るか）<br/>
				（私は）瑠珈所有のヌイグルミを貴方に嬉々としてプレゼントします。
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ 長文文法</div><br/>
			<p>
				長文の場合、だんだんと現行ヒュムノスと変わらなくなってくる。<br/>
				具体的には、以下のような感じになる。
			</p>
			<p style="font-weight: bold;">
				[想音動詞]-[目的語]-[目的語](VOO)<br/>
				[想音動詞]-[目的語]-[装飾語](VOC)<br/>
				[想音動詞]-[装飾語](VC)
			</p>
			<p>
				基本的には英語と同じで、現行ヒュムノスとも同じである。
				新約パスタリエは、「想音＋動詞＋目的語」の部分が１つになっている所が
				最も効率化がとれて特徴的な部分であるが、装飾がつけばつくほど、そのうま味が薄れてくる。
				その場合は「ファンクション」が有効的になる。ファンクションについては、最後の方で解説している。
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ 主語定義</div><br/>
			<p>
				新約パスタリエの主語定義は、第一紀成語ヒュムノスと同じである。<br/>
				ただし「その事を語ってる自分の、今の気持ち」部分が定義化されている。
			</p>
			<p style="color: green; font-role: italic;">
				[x.]-[rre]-[主語]-[想音動詞']-[目的語]-…
			</p>
			<p>
				x.は、自分の想いを綴る部分。「.（バンクピリオド）」に想母音を１つ入れる。<br/>
				rreは主語定義単語で、その１つ後ろに来る単語を主語として認定する。
			</p>
			<p>
				<b>xE rre chroche cEzE hymmnos/.</b><br/>
				（ぜ　[ﾙﾙ]れ　くろーしぇ　しぇぜ　ひゅむのす）<br/>
				クローシェは謳になる（事に私は幸せを願っている）
			</p>
			<p>
				ただし、「彼」「彼女」「あなた」「彼ら」「彼女ら」に関しては、
				rreを含んだ主語定義用の単語があるので、rreを使わない。<br/>
				「rre」を使わない（主語定義を含む）単語を以下に示す。
			</p>
			<table>
				<tr>
					<td bgcolor="#ffcccc" class=fonts2><b>人称</b></td>
					<td bgcolor="#ffeeee" class=fonts2><b>通常（目的語）</b></td>
					<td bgcolor="#ffeeee" class=fonts2><b>主語使用</b></td>
				</tr>
				<tr>
					<td bgcolor="#ffcccc" class=fonts2>あなた</td>
					<td bgcolor="#ffeeee" class=fonts2>yor</td>
					<td bgcolor="#ffeeee" class=fonts2>yorr</td>
				</tr>
				<tr>
					<td bgcolor="#ffcccc" class=fonts2>あなたたち</td>
					<td bgcolor="#ffeeee" class=fonts2>yora</td>
					<td bgcolor="#ffeeee" class=fonts2>yorra</td>
				</tr>
				<tr>
					<td bgcolor="#ffcccc" class=fonts2>彼</td>
					<td bgcolor="#ffeeee" class=fonts2>hes</td>
					<td bgcolor="#ffeeee" class=fonts2>herr</td>
				</tr>
				<tr>
					<td bgcolor="#ffcccc" class=fonts2>彼ら</td>
					<td bgcolor="#ffeeee" class=fonts2>hers</td>
					<td bgcolor="#ffeeee" class=fonts2>herra</td>
				</tr>
				<tr>
					<td bgcolor="#ffcccc" class=fonts2>彼女</td>
					<td bgcolor="#ffeeee" class=fonts2>has</td>
					<td bgcolor="#ffeeee" class=fonts2>harr</td>
				</tr>
				<tr>
					<td bgcolor="#ffcccc" class=fonts2>彼女ら</td>
					<td bgcolor="#ffeeee" class=fonts2>hars</td>
					<td bgcolor="#ffeeee" class=fonts2>harra</td>
				</tr>
			</table>
			<p>
				<b>xI harr cEzE hymmnos/.</b><br/>
				（じ　はるる　しぇぜ　ひゅむのす）<br/>
				彼女は謳になる（事を私は妬んでいる）
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ 様々な文法</div><br/>
			<p>
				新約パスタリエでは、様々な想いに対応できるよう、文法も様々な形に拡張され効率的に唱えられるように作られている。
				ここではそれらの中でも特徴的な文法形態を紹介する。
			</p>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">受動態</div>
				<p>
					想音動詞＋「eh」で受動態。
				</p>
				<p>
					<b>fEwErYEn</b><br/>
					愛を持って貴方を包み込む（能動態）
				</p>
				<p>
					<b>fEwErYEneh</b><br/>
					貴方に包み込まれて愛を感じる（受動態）
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">強調</div>
				<p>
					主語定義用の目的語と汎用主語定義を同時に使うことで、主語の強調を行うことが出来る。
				</p>
				<p>
					<b>xE rre yorra cEzE hymmnos/.</b><br/>
					あのクローシェが歌になる（ので私はとても嬉しい）
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">否定</div>
				<p>
					否定にはzzを使う。名詞でも想音動詞でも、その前に来る。
				</p>
				<p>
					<b>zz rUfImeh/.</b><br/>
					私にはまだ見えない
				</p>
				<p>
					<b>zz Agasar</b><br/>
					私のぬいぐるみではない
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">想音動詞の名詞的扱い</div>
				<p>
					想音動詞は、ピリオドを全てピリオドのままにしておくことで、不発動詞もしくは名詞的扱いとして使うことが可能である。
				</p>
				<p>
					<b>aIuUkA zess pop v.a en d.z./.</b><br/>
					生まれては消える泡のように
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">「」表記</div>
				<p>
					新約パスタリエは :/   /:によって、言い伝え（「」表記）を行える。
				</p>
			</div>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ ファンクション</div><br/>
			<p>
				新約パスタリエでは、ファンクションと言って、文章を１つの単語にすることが出来る。
				簡単に言えば、この詩の中でのみ有効な、新造単語という位置づけになる。<br/>
				使用する場合、
			</p>
			<p style="color: green; font-role: italic;">
				[新造単語]->[文章]
			</p>
			<p>
				という定義構文を用いる。その詩の中では、その新造単語は１語で１文唱えたことと同じになる。
				「->」は、「ぱす」と発音する。
			</p>
			<p>
				<b>ishikawa -> jYOzAt METHOD_HYMME_ISHIKAWA_JANNE/. !</b><br/>
				いしかわ ぱす じょざっと めそっど　ひゅむ　いしかわ　じゃんぬ<br/>
				<b>ishikawa! ishikawa! ishikawa! ishikawa!</b><br/>
				イシカワァ！イシカワァ！イシカワァ！イシカワァ！
			</p>
			<p>
				上記サンプルで、相手にイシカワジャンヌを４回発動します（あくまでサンプルです。実際には発動しません）。
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ 例文集</div><br/>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">単語例</div>
				<p>
					h<u><b>YA</b></u>mmr<u><b>A</b></u>（ひゃんむら）<br/>
					（相手を想い、一生懸命に謳う）
				</p>
				<p>
					h<u><b>YI</b></u>m<u><b>O</b></u>m<u><b>O</b></u>r<u><b>O</b></u>（ひぇいももろ）<br/> 
					（必ず呪い殺してやる！と怒りに満ちて謳う）
				</p>
				<p>
					h<u><b>YE</b></u>m<u><b>YE</b></u>m<u><b>A</b></u>r<u><b>A</b></u>（ひぇみぇまら）<br/>
					（相手の幸せを願い、嬉々として謳ってる）
				</p>
				<p>
					h<u><b>E</b></u>m<u><b>E</b></u>m<u><b>A</b></u>r<u><b>A</b></u>（へめまら）<br/>
					（自分が嬉しくて一生懸命謳ってる）
				</p>
				<p>
					h<u><b>LYI</b></u>m<u><b>LYI</b></u>m<u><b>O</b></u>r<u><b>O</b></u>（ひりぇいむりぇいもろ）<br/>
					（怒りに満ちて、この世界を滅ぼし呪う気持ちで謳う）
				</p>
			</div>
			<div style="padding-left: 10px;">
				<div class="subsection-title text-title-small">文例</div>
				<p>
					実際に名詞などを含んだ文章として成り立っているものに関して、以下に例文を示す。
					名詞などは、現行ヒュムノスと互換性があるので使用可能。「想音動詞」が新約パスタリエの要となる。
				</p>
				<p>
					<b>hYAmmrA chroche/.</b><br/>
					（ひゃんむら　くろ−しぇ）<br/>
					（私は）クローシェのために一生懸命謳う
				</p>
				<p>
					<b>hYImOmOrO!</b><br/>
					（ひぇいももろ！）<br/>
					（私は）お前を呪い殺してやる。必ずな！
				</p>
				<p>
					<b>cEzE hymmnos/.</b><br/>
					（しぇぜ　ひゅむのす）<br/>
					（私は）謳になる　＞現行ヒュムノスだとWas yea ra chs hymmnos mea.
				</p>
				<p>
					<b>cYEzYE hymmnos/.</b><br/>
					（しいぇずぃえ　ひゅむのす）<br/>
					（私は）貴方を謳にする
				</p>
				<p>
					<b>jAzOtYI LIKAR an dius fwal fwal ,en wOsYI !</b><br/>
					（じゃぞち　りかる　あん　でぃうす　ふわる　ふわる　えん　うぉしぇい！）<br/>
					白き翼持つ清き乙女リカルちゃん、神を、裁きのいかづちを下さい！！
				</p>
			</div>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
