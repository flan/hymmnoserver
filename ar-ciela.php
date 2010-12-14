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
				planet and describes things like natural phenomena (in terms applicable to Earth,
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
				1,200kHz would be
				<a href="http://en.wikipedia.org/wiki/Nyquist%E2%80%93Shannon_sampling_theorem">required</a>
				(for reference, CD-quality audio is sampled at 44.1kHz).
			</p>
			<p>
				So, then, what does Ar ciela sound like when observed by human ears? One method of
				approximating the difference between the full range of Ar ciela and what humans can
				hear is as follows: take a recording of speech or song and load it into a
				<a href="http://audacity.sourceforge.net/">waveform editor</a>, then resample it at
				100Hz, one twentieth of what human ears can perceive. Play back the result and you
				will find the audio muffled and hard to understand. Perceived by humans, Ar ciela is
				much like the 100Hz sample of the original audio.
				<br/><br/>
				<em>
					A 4000Hz example is available in <a href="http://www.vorbis.com/">Vorbis</a>
					format. 4000Hz was chosen because it's the smallest sampling rate known to work
					with most sound cards, though it only demonstrates 1/10 range-compression,
					rather than the target 1/40; just imagine that the quality would be much worse.
					Download:
					<a href="./static/goodbye_44100.ogg">44100Hz</a>,
					<a href="./static/goodbye_4000.ogg">4000Hz</a>.
				</em>
			</p>
			<p>
				Suppose the word recorded were <em>[okaasan]</em>
				(<em>おかあさん : mother</em>). Had you resampled it at 100Hz, effectively cutting off
				every frequency higher than that value, you would have been left with something that
				sounds like <em>/ohoohon/</em> (<em>おほおほん</em>), which has no meaning.
				However, phonologically, the utterance still has significance: it retains five
				morae (including the nasal), emphasis is placed over the second and third morae, and
				the prosodical pattern holds. Despite the phonological similarities, though, what
				was <em>[okaasan]</em> may be mentally interpreted as the equally meaningless
				<em>/notaahau/</em> (<em>のたあはう</em>), since
				<em>/ohoohon/</em> isn't any more recognizable as a word.
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
				<em>/l/</em> and <em>/r/</em> in English, native speakers cannot, without great
				effort, mentally hear the difference between the words: to them, both are
				<em>/gurasu/</em> (<em>グラース</em>). 
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
			<p title="Alternate translations welcome; I'm not sure if I got this right">
				Because the true form of Ar ciela utterances cannot be aurally perceived by humans,
				its depictions are presented in three-dimensional terms, as a logical matrix that
				can be used to construct visual forms. All renditions describe the same Ar ciela
				language.
			</p>
			<div class="section-title text-title-small">
				⠕ Ar ciela is transcribed using two notation layers
			</div>
			<div class="section-title text-title-small">⠕ [Layer 1] Public Ar ciela</div>
			<p>
				Public notation uses a set of 26 symbols, each representing a sound in the
				human-audible domain. Because this notation is limited to the human-audible domain,
				it cannot be used to fully model all of Ar ciela, providing a simple, though highly
				lossy, encoding scheme.
			</p>
			<p style="font-style: italic;">
				The <a href="./font_ar-ciela.php">Ar ciela compartment font</a>'s standard form
				is that of Public Ar ciela.
			</p>
			<div class="section-title text-title-small">⠕ [Layer 2] Compartment Ar ciela</div>
			<p>
				Compartment notation is an extension of Public notation, in which annotations
				are added to the set of 26 symbols, describing properties of the sound that fall
				outside of the human-audible domain. They provide additional dimensions to
				complete the aforementioned logical matrix.
			</p>
			<p>
				When casually observing Ar ciela, it is impossible for humans to determine which
				Compartment notation elements to use for transcription, since they describe
				inaudible properties of the sounds. Even if the full range of sound could be heard,
				though, the listener would need to be trained to recognize the differences between
				Compartment notation elements for each sound. However, despite the complications
				associated with observation, Compartment notation is necessary to properly analyse
				transcribed Ar ciela.
			</p>
			<p>
				The extensions provided by Compartment notation are thus: markings that sub-divide
				the Public symbols into five frequency categories and four amplitude categories.
				These sub-divided categories are collectively referred to as Compartments.
			</p>
			<p style="font-style: italic;">
				The use of Compartment notation is not unlike that of
				<a href="http://en.wikipedia.org/wiki/Diacritic">diacritics</a>, where an umlaut
				(<em>¨</em>) can, in languages such as German, fundamentally change the
				pronunciation of a word.
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
				&quot;Ec Tisia&quot; means 「empathy + growth」 and
				「everyone + sincerity + forgiveness + hope + belief」, the sum of
				the symbols that comprise its words; its Compartment form is
				&quot;Ec<em>[s-4/half]</em> T<em>[s-3/quad]</em>is<em>[s-4/dual]</em>ia&quot;,
				which is rendered in glyphs above.
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
				&quot;Ec Tisia&quot; literally means 「empathy + growth」 and
				「everyone + sincerity + forgiveness + hope + belief」,
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
				meaning. The vowels' meaning, of which there are many possibilities, is selected
				based on its context. A generalised category is presented in square brackets, though
				it is purely an arbitrary human choice.
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
					<td class="content" style="text-align: right; font-weight: bold;">[Scale]</td>
					<td class="content" style="text-align: left;" colspan="8">
						neutrality, equality, justice, energy, belief, balance, love
					</td>
				</tr>
				<tr>
					<td class="letter vowel">I</td>
					<td class="content" style="text-align: right; font-weight: bold;">[Pray]</td>
					<td class="content" style="text-align: left;" colspan="8">
						fear, anxiety, reverence, hope, spirituality, love
					</td>
				</tr>
				<tr>
					<td class="letter vowel">U</td>
					<td class="content" style="text-align: right; font-weight: bold;">[Experience]</td>
					<td class="content" style="text-align: left;" colspan="8">
						aspiration, envy, rivalry, co-operation, friendship
					</td>
				</tr>
				<tr>
					<td class="letter vowel">E</td>
					<td class="content" style="text-align: right; font-weight: bold;">[Neighbour]</td>
					<td class="content" style="text-align: left;" colspan="8">
						pity, reservation, understanding, empathy, intimate love
					</td>
				</tr>
				<tr>
					<td class="letter vowel">O</td>
					<td class="content" style="text-align: right; font-weight: bold;">[Karma]</td>
					<td class="content" style="text-align: left;" colspan="8">
						hatred, anger, sadness, guidance, self-esteem
					</td>
				</tr>
				<tr>
					<td class="letter vowel">N</td>
					<td class="content" style="text-align: right; font-weight: bold;">[Mandela]</td>
					<td class="content" style="text-align: left;" colspan="8">
						want, comfort, enlightnment, charity
					</td>
				</tr>
				<tr>
					<td class="letter consonant">b</td>
					<td class="content">individual</td>
					<td class="content"/>
					<td class="content">surroundings</td>
					<td class="content"/>
					<td class="content">region</td>
					<td class="content"/>
					<td class="content">universe</td>
					<td class="content"/>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">c</td>
					<td class="content"/>
					<td class="content">transformation</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content">revolution</td>
					<td class="content"/>
					<td class="content">growth</td>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">d</td>
					<td class="content">evil</td>
					<td class="content"/>
					<td class="content">corrupt</td>
					<td class="content"/>
					<td class="content">dark</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">light</td>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">f</td>
					<td class="content">dissemination</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">influence</td>
					<td class="content"/>
					<td class="content">permiation</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">g</td>
					<td class="content">chaos</td>
					<td class="content"/>
					<td class="content">disruption</td>
					<td class="content"/>
					<td class="content">transformation</td>
					<td class="content"/>
					<td class="content">regeneration</td>
					<td class="content">nurturing</td>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">h</td>
					<td class="content">fevered</td>
					<td class="content"/>
					<td class="content">blazing</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">burning</td>
					<td class="content"/>
					<td class="content">empassioned</td>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">j</td>
					<td class="content">stupid</td>
					<td class="content">unknown</td>
					<td class="content"/>
					<td class="content">novel</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">unique</td>
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
					<td class="content">stranger</td>
					<td class="content"/>
					<td class="content">neighbour</td>
					<td class="content"/>
					<td class="content">friend</td>
					<td class="content"/>
					<td class="content">partner</td>
					<td class="content">true friend</td>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">m</td>
					<td class="content">tranquility</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">sympathy</td>
					<td class="content"/>
					<td class="content">help</td>
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
					<td class="content">foolishness</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">ignorance</td>
					<td class="content"/>
					<td class="content">innocence</td>
					<td class="content"/>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">r</td>
					<td class="content">movement</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content">pulse</td>
					<td class="content"/>
					<td class="content">life</td>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">s</td>
					<td class="content">desire</td>
					<td class="content">control</td>
					<td class="content"/>
					<td class="content">prayer</td>
					<td class="content">wish</td>
					<td class="content"/>
					<td class="content">thanks</td>
					<td class="content">forgiveness</td>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">t</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">oneself</td>
					<td class="content">group</td>
					<td class="content"/>
					<td class="content">everyone</td>
					<td class="content"/>
					<td class="content">universe</td>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">v</td>
					<td class="content"/>
					<td class="content">delight</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content">praise</td>
					<td class="content"/>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">w</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">inner space</td>
					<td class="content"/>
					<td class="content">spirit</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">x</td>
					<td class="content">offense</td>
					<td class="content">defense</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content">protection</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">y</td>
					<td class="content">dark</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content"/>
					<td class="content">holy</td>
					<td class="content"/>
					<td class="content">love</td>
				</tr>
				<tr>
					<td class="letter consonant">z</td>
					<td class="content"/>
					<td class="content">god</td>
					<td class="content">master</td>
					<td class="content"/>
					<td class="content"/>
					<td class="content">household</td>
					<td class="content"/>
					<td class="content">oneself</td>
					<td class="content">love</td>
				</tr>
			</table>
			<p>
				<em>Ar cia laboratory research</em>
				<ul style="margin-top: -10px;">
					<li>
						This table is incomplete: at this time, only identified feelings have been
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
			<p style="font-style: italic;">
				(Editor's note: No, it's not clear what the I-IX stuff actually means at this time)
			</p>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
