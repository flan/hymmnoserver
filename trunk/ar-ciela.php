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
		<title>Hymmnoserver - Ar ciela (basics)</title>
		<?php include 'common/resources.xml'; ?>
		<style type="text/css">
			table.coding{
				border-collapse: separate;
				text-align: center;
			}
			table.coding > td{
				vertical-align: middle;
			}
			td.property{
				font-weight: bold;
				text-align: left;
			}
			td.ciela{
				font-size: 4.5em;
				font-family: "Ar-Ciela(Compartment)", sans;
				text-align: left;
				padding-left: 4px;
				color: black;
			}
			td.mcl{
                background-color: #E9E9FF;
			}
			td.content{
			    background-color: #F0F0FF;
			}
			td.numeral{
			    font-weight: bold;
			    width: 4em;
			}
			td.letter{
			    font-weight: bold;
			    width: 2em;
			}
			td.vowel{
			    background-color: #FFCCCC;
			}
			td.consonant{
			    background-color: #CCCCFF;
			}
		</style>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div class="text-basic">
		    <div class="section-title text-title-small">⠕ About Ar ciela</div>
            <p>
                Ar Ciela, also referred to as the &quot;language of the planet&quot;, is not a language
                conceived of for human use. Rather, it is a language that expresses the will of the
                planet and serves to describe natural phenomena (in terms applicable to Earth,
                examples would be weather systems, volcanic activity, tectonic shifts, and other
                properties that govern the natural cycle of life). Taken in this context, Ar ciela
                can be viewed as the language used by Ar ciel to manifest change.
            </p>
            <div class="section-title text-title-small">⠕ Features of the Ar ciela language</div>
            <p>
                The full range of Ar ciela phonology cannot be perceived by human ears. This does
                not seem unreasonable when considering the scale on which the language, which
                is conveyed as pure dynamic H-waves, operates, as a force that shapes the world.
                The full spectrum of Ar ciela spans 20-600,000Hz; compared to the human-perceptible
                domain of 20-20,000Hz, the upper bound of Ar ciela's frequency range is thirty times
                higher. Were this range to be recorded, instruments capable of sampling at a rate of
                1200kHz would be
                <a href="http://en.wikipedia.org/wiki/Nyquist%E2%80%93Shannon_sampling_theorem">required</a>
                (for reference, CD-quality audio is sampled at 44.1kHz).
            </p>
            <p>
                So, then, what does Ar ciela sound like when observed by human ears? One method of
                approximating the difference between the full range of Ar ciela and what humans can
                hear is as follows: take a recording of speech or song and load it into a
                <a href="http://audacity.sourceforge.net/">waveform editor</a>, then resample it at
                100Hz, one twentieth of what human ears can perceive. Play back the result and you
                will find the audio muffled and hard to understand. Perceived by humans, Al ciela is
                much like the 100Hz sample of the original audio.
                <br/><br/>
                <em>
                    A 4000Hz example is available in <a href="http://www.vorbis.com/">Vorbis</a>
                    format. 4000Hz was chosen since it's the smallest sampling rate known to work
                    with most sound cards, though it only demonstrates 1/5 range-compression, rather
                    than the target 1/30; just imagine that the quality would be much worse.
                    Download:
                    <a href="./static/goodbye_44100.ogg">44100Hz</a>,
                    <a href="./static/goodbye_4000.ogg">4000Hz</a>.
                </em>
            </p>
            <p>
                Suppose the word recorded were &quot;<em>okaasan</em>&quot;
                (<em>おかあさん : mother</em>). Had you resampled it at 100Hz, effectively cutting off
                every frequency higher than that value, you would have been left with something that
                sounds like &quot;<em>ohoohon</em>&quot; (<em>おほおほん</em>), which has no meaning.
                However, phonologically, the utterance still has significance: it still has five
                morae (including the nasal), emphasis is placed over the second and third morae, and
                the prosodical pattern holds. Despite the phonological similarities, though, what
                was &quot;<em>okaasan</em>&quot; may be mentally represented as
                &quot;<em>notaahau</em>&quot; (<em>のたあはう</em>), since
                &quot;<em>ohoohon</em>&quot; isn't recognizable as a word.
                <br/><br/>
                Expanding on the presented idea, consider the Ar ciela utterance transcribed as
                &quot;<em>Tisia</em>&quot;: not knowing what its full enunciation sounds like, it is
                impossible to know exactly what word it really is. Were you able to hear it
                pronounced at 600,000Hz, however, it would be possible to indentify, with
                confidence, the true form of the word being uttered.
            </p>
            <p>
                An everyday example of the significance of frequency ranges is in how a Japanese
                speaker deals with the English words &quot;grass&quot; and &quot;glass&quot;. Since
                Japanese phonemes do not distinguish between the high frequencies that contrast
                &quot;l&quot; and &quot;r&quot; in English, native speakers cannot, without great
                effort, mentally hear the difference between the words: to them, both are
                &quot;<em>gurasu</em>&quot; (<em>グラース</em>). 
            </p>
            <div style="text-align: center; font-size: 0.9em;">
                <img src="./static/arciela_fft.png" alt="Human-observable frequency range versus Ar ciela frequency range"/>
                <br/>
                A visual look at the subset of human-audible sound relative to the full frequency
                range of Ar ciela.
                <br/>
                It is impossible to observe the full range of sound because of limitations on what
                can be heard.
            </div>
            <p>
                <!--
                    If anyone has a better translation for this, please submit it. I'm afraid I
                    don't know if I got it right. -Neil
                    このように、現在の人間にはアルシエラの真の意味を聞き分けることが出来ない為、
                    聞き分けられるレベルでカテゴリ化を行い、更にその中で三次元的（立体マトリックス的）に視覚的細分化を行った。
                   それがアルシエラである。
               -->
                Because the true form of Ar ciela utterances cannot be aurally perceived by humans,
                its depictions are presented in three-dimensional terms, as a logical matrix that
                can be used to construct visual forms. All renditions describe the same Ar ciela
                language.
            </p>
            <p>
                Transcribed Ar ciela is written using two different notation schemes, described
                below.
            </p>
            <div class="section-title text-title-small">⠕ [Scheme 1] Public Ar ciela</div>
            <p>
                Public notation uses a set of 26 symbols, each representing a sound in the
                human-audible domain. Because this notation is limited to the human-audible domain,
                it cannot be used to fully model all of Ar ciela, providing a simple, though highly
                lossy, encoding scheme.
                <br/>
                <em>
                    The <a href="./font_ar-ciela.php">Ar ciela compartment font</a>'s standard form
                    is that of Public Ar ciela.
                </em>
            </p>
            <div class="section-title text-title-small">⠕ [Scheme 2] Compartment Ar ciela</div>
            <p>
                Compartment notation is an extension of Public notation, in which annotations
                are added to the set of 26 symbols, describing properties of the sound that fall
                outside of the human-audible domain. They provide additional dimensions to the
                aforementioned logical matrix.
            </p>
            <p>
                When casually observing Ar ciela, it is impossible for humans to determine which
                Compartment notation elements to use for transcription, since they describe
                inaudible properties of the sounds. Even if the full range of sound could be heard,
                though, the listener would need to be trained to recognize the differences between
                Compartment notation elements for each sound. However, despite these complications,
                Compartment notation is necessary to properly analyse transcribed Ar ciela.
            </p>
            <p>
                The extensions provided by Compartment notation are thus: markings that sub-divide
                the Public symbols into five frequency categories and four amplitude categories.
                These sub-divided categories are collectively referred to as Compartments.
                <br/>
                <em>
                    The use of Compartment notation is not unlike that of
                    <a href="http://en.wikipedia.org/wiki/Diacritic">diacritics</a>, where an umlaut
                    (<em>¨</em>) can, in languages such as German, fundamentally change the
                    pronunciation of a word.
                </em>
            </p>
            <b>▼ FMCL</b><br/>
			<table class="coding">
				<tr>
					<td class="property mcl">Compartment</td>
					
					<td class="mcl"/>
					<td class="ciela mcl">!</td>
					<td class="ciela mcl">#</td>
					<td class="ciela mcl">$</td>
					<td class="ciela mcl">%</td>
				</tr>
				<tr>
					<td class="property mcl">Category</td>
					
					<td class="mcl">session-0</td>
					<td class="mcl">session-1</td>
					<td class="mcl">session-2</td>
					<td class="mcl">session-3</td>
					<td class="mcl">session-4</td>
				</tr>
				<tr>
					<td class="property mcl">Frequency range</td>
					
					<td class="mcl">20,000Hz</td>
					<td class="mcl">50,000Hz</td>
					<td class="mcl">100,000Hz</td>
					<td class="mcl">150,000Hz</td>
					<td class="mcl">300,000Hz</td>
				</tr>
			</table><br/>
            <b>▼ AMCL</b><br/>
			<table class="coding">
				<tr>
					<td class="property mcl">Compartment</td>
					
					<td class="ciela mcl">&amp;</td>
					<td class="ciela mcl">(</td>
					<td class="mcl"/>
					<td class="ciela mcl">)</td>
				</tr>
				<tr>
					<td class="property mcl">Category</td>
					
					<td class="mcl">quad</td>
					<td class="mcl">dual</td>
					<td class="mcl">single</td>
					<td class="mcl">half</td>
				</tr>
				<tr>
					<td class="property mcl">Amplitude signature</td>
					
					<td class="mcl">＼＿＿＿</td>
					<td class="mcl">／￣＼＿</td>
					<td class="mcl">＿＿＿＿</td>
					<td class="mcl">/\&nbsp;&nbsp;&nbsp;</td>
				</tr>
			</table><br/>
            <p>
                Compartment notation provides approximately logarithmic sub-division of the
                frequency range from 20,000Hz through 600,000Hz.
                To effect this sub-division, notations describe two properties: FMCL (frequency) and
                AMCL (amplitude).
            </p>
            <p>
                FMCL notation applies to sounds with a frequency over 20,000Hz, providing five
                distinct categories. For example, using the 100Hz example from before, what is heard
                as <em>[a]</em> (<em>あ</em>) may have actually been <em>[ka]</em> (<em>か</em>) or
                <em>[sa]</em> (<em>さ</em>); <em>[ka]</em> and <em>[sa]</em> are distinguishable only
                at frequencies higher than 100Hz.
            </p>
            <p>
                AMCL describes pronunciation properties within frequency categories. For example, in
                the 20,000Hz range, with the sounds <em>[ka]</em> (<em>か</em>) and <em>[sa]</em>
                (<em>さ</em>), the frequency-distribution is such that the former has a short, sharp
                leading burst, while the latter is characterised by a softer, more rolling pattern.
            </p>
            <p>
                Notes:
                <ul style="margin-top: -10px;">
                    <li>
                        When written, FMCL annotation is placed in the upper section of an
                        otherwise-Public character, with AMCL annotation appearing on the lower side.
                    </li>
                    <li>
                        Compartment notation is not used with vowels, since morae are not subject to
                        variances in enunciation: their formants remain steady throughout the duration
                        of the sound.
                    </li>
                </ul>
            </p>
            <b>▼　A practical example</b><br/>
            <table style="text-align: center;">
                <tr>
    	            <td class="ciela content" style="padding-right: 23px;">
                        Ec Tisia
    	            </td>
    	            <td class="ciela content" style="padding-right: 23px;">
                        E%)c $&amp;Ti%(sia
    	            </td>
	            </tr>
	            <tr>
	                <td class="mcl">
	                    &quot;Ec Tisia&quot; in Public form<br/>
	                    Ec Tisia
                    </td>
                    <td class="mcl">
                        &quot;Ec Tisia&quot; in Compartment form<br/>
                        Ec[s-4/half] T[s-3/quad]is[s-4/dual]ia
                    </td>
                </tr>
            </table>
            <p>
                &quot;Ec Tisia&quot; means 「共感＋成長」と「皆＋誠心＋赦し＋希望＋想いの力」, the sum of
                the symbols that comprise its words; its Compartment form is
                &quot;Ec[s-4/half] T[s-3/quad]is[s-4/dual]ia&quot;, which is rendered in glyphs
                above.
            </p>
            <div class="section-title text-title-small">⠕ Pronunciation in Ar ciela</div>
            <p>
                アルシエラは律詩前月読の原型的存在であるが為に、律詩前月読と同様に、発音自体にある程度心的作用（＝想いの力＝導体H波）が入る。
                それによって生成される単語の意味は、その単語ごとに意訳されてわかりやすくなるが、その単語の想いは発音ごとの集合体によって紡がれる。
                例えば「Ec Tisia」は「共感＋成長」と「皆＋誠心＋赦し＋希望＋想いの力」といった導体H波的な想いを載せて、「全てを赦そう」という意味を形成している。
                ただし、単語の意味＝文字の想いを繋げたときの意味、とは限らない。
                あくまでその単語を発音している時の想いであり、ヒュムノス語で言うところの想音を発音全てに含んでいると言った方が正しいかも知れない。
            </p>
            <p>
                下記の「発音想い表」はこれを一元化したものである。
                母音に波動レベルによる分類がないのは、母音は子音の想いに対してエネルギーを与える役割だからである。
                波動科学的には、上記のように、コンパートメントに対応できない為に分類分けをしていない。
                意味がバラバラなようにも感じるかもしれないが、惑星意志にとってこれらの意味は全部同義である。
                それを敢えて一言で言えば【】表記のような単語になる。ただしこれも、人間が勝手に定義したものだ。
                それ以上の定義（例えば星語（アルシエラ）で一言に置き換えると…など）は出来ない。
                なぜなら、アルシエラで作られた単語はそれ自体が想いのポリマー的生成物であり、
                例えば「A」を説明する単語の中に「U」やら「N」やらが入るわけで
                その時点でその単語は既に不純であり的を得ていない。
                母音や子音の想いを言葉で表現するのは不可能なのである。
            </p>
            <table style="text-align: center;">
                <tr>
                    <td/>
                    <td style="font-weight: bold;" colspan="9">周波数帯域レベル（レベル毎の代表的な発音に対する想い）</td>
                </tr>
                <tr>
                    <td/>
                    <td class="numeral" style="background-color: #FFCCCC;">I</td>
                    <td class="numeral" style="background-color: #FFE0CC;">II</td>
                    <td class="numeral" style="background-color: #FFFFCC;">III</td>
                    <td class="numeral" style="background-color: #E0FFCC;">IV</td>
                    <td class="numeral" style="background-color: #CCFFCC;">V</td>
                    <td class="numeral" style="background-color: #CCFFE0;">VI</td>
                    <td class="numeral" style="background-color: #CCFFFF;">VII</td>
                    <td class="numeral" style="background-color: #CCE0FF;">VIII</td>
                    <td class="numeral" style="background-color: #CCCCFF;">IX</td>
                </tr>
                <tr>
                    <td class="letter vowel">A</td>
                    <td class="content" colspan="9">【スカラー】中立、平等、公平、エネルギー、想いの力、バランス、愛</td>
                </tr>
                <tr>
                    <td class="letter vowel">I</td>
                    <td class="content" colspan="9">【プレイ】畏オソれ、不安フアン、敬ウヤマい、希望キボウ、精神セイシン、慈愛</td>
                </tr>
                <tr>
                    <td class="letter vowel">U</td>
                    <td class="content" colspan="9">【イクスピアリ】憧アコガれ、羨望センボウ、好ヨシミ敵テキ、協力キョウリョク、友愛</td>
                </tr>
                <tr>
                    <td class="letter vowel">E</td>
                    <td class="content" colspan="9">【ネイバー】憐アワれみ、遠慮エンリョ、理解リカイ、共感キョウカン、性愛</td>
                </tr>
                <tr>
                    <td class="letter vowel">O</td>
                    <td class="content" colspan="9">【カルマ】憎悪ゾウオ、怒イカり、悲カナしみ、諭サトし、自己愛</td>
                </tr>
                <tr>
                    <td class="letter vowel">N</td>
                    <td class="content" colspan="9">【マンダラ】無ム、楽ラク、悟サト、博愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">b</td>
                    <td class="content">自身</td>
                    <td class="content"/>
                    <td class="content">隣人</td>
                    <td class="content"/>
                    <td class="content">地域</td>
                    <td class="content"/>
                    <td class="content">世界</td>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">c</td>
                    <td class="content"/>
                    <td class="content">変身</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">革命</td>
                    <td class="content"/>
                    <td class="content">成長</td>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">d</td>
                    <td class="content">魔</td>
                    <td class="content"/>
                    <td class="content">堕落</td>
                    <td class="content"/>
                    <td class="content">闇</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">光</td>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">f</td>
                    <td class="content">伝導</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">波及</td>
                    <td class="content"/>
                    <td class="content">浸透</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">g</td>
                    <td class="content">地獄</td>
                    <td class="content"/>
                    <td class="content">破壊</td>
                    <td class="content"/>
                    <td class="content">変化</td>
                    <td class="content"/>
                    <td class="content">再生</td>
                    <td class="content">育成</td>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">h</td>
                    <td class="content">熱</td>
                    <td class="content"/>
                    <td class="content">炎</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">燃焼</td>
                    <td class="content"/>
                    <td class="content">情熱</td>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">j</td>
                    <td class="content">無知</td>
                    <td class="content">未知</td>
                    <td class="content"/>
                    <td class="content">奇抜</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">特異</td>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">k</td>
                    <td class="content">K</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">l</td>
                    <td class="content">他人</td>
                    <td class="content"/>
                    <td class="content">隣人</td>
                    <td class="content"/>
                    <td class="content">友人</td>
                    <td class="content"/>
                    <td class="content">伴侶</td>
                    <td class="content">託生</td>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">m</td>
                    <td class="content">平静</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">同情</td>
                    <td class="content"/>
                    <td class="content">救</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">p</td>
                    <td class="content">P</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">q</td>
                    <td class="content"/>
                    <td class="content">愚</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">無知</td>
                    <td class="content"/>
                    <td class="content">無心</td>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">r</td>
                    <td class="content">胎動</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">躍動</td>
                    <td class="content"/>
                    <td class="content">生命</td>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">s</td>
                    <td class="content">欲望</td>
                    <td class="content">すがり</td>
                    <td class="content"/>
                    <td class="content">願</td>
                    <td class="content">祈り</td>
                    <td class="content"/>
                    <td class="content">感謝</td>
                    <td class="content">赦し</td>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">t</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">己</td>
                    <td class="content">我々</td>
                    <td class="content"/>
                    <td class="content">皆</td>
                    <td class="content"/>
                    <td class="content">世界</td>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">v</td>
                    <td class="content"/>
                    <td class="content">喜び</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">賞賛</td>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">w</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">内面</td>
                    <td class="content"/>
                    <td class="content">精神</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">x</td>
                    <td class="content">攻勢</td>
                    <td class="content">防御</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">守護</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">y</td>
                    <td class="content">闇</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">聖</td>
                    <td class="content"/>
                    <td class="content">愛</td>
                </tr>
                <tr>
                    <td class="letter consonant">z</td>
                    <td class="content"/>
                    <td class="content">神</td>
                    <td class="content">主</td>
                    <td class="content"/>
                    <td class="content"/>
                    <td class="content">内面</td>
                    <td class="content"/>
                    <td class="content">己</td>
                    <td class="content">愛</td>
                </tr>
            </table>
            <p>
                ※アルキア研究所所蔵資料。研究当時において、何となく解った部分のみが記されている<br/>
                Ⅰ〜Ⅸの区分は研究所がつけたもので、実際のアルシエラとしての意味は全くない<br/>
                寧ろ、この1区画（例えばⅢ）を更に10分割しても、新たな「発音の想い」があふれ出てくるであろう<br/>
            </p>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
