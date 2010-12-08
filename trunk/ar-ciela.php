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
				Transcribed Ar ciela is written using two notation layers, described below.
			</p>
			<div class="section-title text-title-small">⠕ [Layer 1] Public Ar ciela</div>
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
			<div class="section-title text-title-small">⠕ [Layer 2] Compartment Ar ciela</div>
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
			<div class="section-title text-title-small">⠕ Structure of Ar ciela</div>
			<p>
				Ar ciela is the basis of the
				<a href="http://conlang.wikia.com/wiki/Hymmnos#Moon_Singing_of_the_Story_Previous_to_the_Notes_.28Risshizentsukuyomi.29_.28Ancient_Language_From_Before_the_First_Era.29">
					Risshizen Tsukuyomi
				</a>
				language, used by the Tsukikanade. Like Risshizen Tsukuyomi, each uttered sound has
				its own associated meaning (expressible as feelings through H-waves). As each word
				is a collection of sounds, each carrying its own meaning, the symbolism of a
				complete word is that of the aggregated sum of its sounds: for example,
				&quot;Ec Tisia&quot; literally means 「共感＋成長」と「皆＋誠心＋赦し＋希望＋想いの力」,
				which is collectively transmitted via H-waves, as a unified message along the lines
				of "everything is forgiven".
			</p>
			<p>
				Note that the effective meaning of the message is not necessarily a one-to-one match
				with its constituent sounds. Since each symbol that makes up a word in Ar ciela
				describes a single feeling, the language can be viewed as being similar to Emotion
				Sounds in Hymmnos.
			</p>
			<p>
				Vowels are not sub-divided by waveform category, for reasons described in
				the preceding section; rather, they work with associated consonants to form
				meaning. The vowels' meaning, of which there are many, is selected based on
				its context. A generalised form is presented in square brackets, though it
				is purely an arbitrary human choice.
			</p>
			<p>
				Specific references (such as to a planet's language (Ar ciela) as a concrete noun)
				are not possible. Because Ar ciela is a means of conveying composite feelings, a
				word that describes "A" would need to contain "U" or "N" and would therefore no
				longer describe the purity of the feeling associated with "A".
				Expressing concrete concepts like arbitrary words with the abstract feelings
				afforded by vowels and consonants cannot be done.
			</p>
			<p>
				The following table maps each Ar ciela sound to its associated feelings.
			</p>
			<table style="text-align: center;">
				<tr>
					<td/>
					<td style="font-weight: bold;" colspan="9">
						Feelings grouped by frequency range
					</td>
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
					<td class="content" colspan="9">【スカラー】中立、平等、公平、エネルギー、想いの力、バランス, love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
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
					<td class="content">love</td>
				</tr>
			</table>
			<p>
				<!--
					This will probably be rewritten once I've played the game, since the I-IX
					stuff probably gets explained there. -Neil
				-->
				<em>Ar cia laboratory research</em>
				<ul style="margin-top: -10px;">
					<li>
						This table is incomplete: at this time, only identified feelings are
						recorded
					</li>
					<li>
						The assignment of I-IX is done by the laboratory; it is an arbitrary process
						not endemic to Ar ciela
					</li>
					<li>
						It would be possible to further sub-divide a section (III, for example) into
						ten new sections and still have more than enough feelings to fill the slots.
					</li>
				</ul>
			</p>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
