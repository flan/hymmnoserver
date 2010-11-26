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
                The full range of Al ciela phonology cannot be perceived by human ears. This does
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
                このように、現在の人間にはアルシエラの真の意味を聞き分けることが出来ない為、
                聞き分けられるレベルでカテゴリ化を行い、更にその中で三次元的（立体マトリックス的）に視覚的細分化を行った。
                それがアルシエラである。
            </p>
            <p>
                アルシエラを表記するには、以下に説明する2種類の表記方法が存在する。
            </p>
            <div class="section-title text-title-small">⠕ [Tier 1] Public Ar ciela</div>
            <p>
                パブリック文字は、人間に聞こえる範囲で聞き分けられる音を26文字に落とし込んだものである。
                通常人間は、この26文字で表現する単語以上の表情を、その単語から読み取ることが出来ない。
                これはその「開き直った」、聞こえる限りの単語を文字化したものである。
                CDの解説書に書かれているアルシエラフォントは、このパブリック文字である。
            </p>
            <div class="section-title text-title-small">⠕ [Tier 2] Compartment Ar ciela</div>
            <p>
                コンパートメント文字は、パブリック文字に注釈を付けることで、人間には聞き取れない領域の周波数帯で
                どのような波形が存在しているか、しいてはそれが聞き取れたときどんな文字になるか、を
                マトリックス的に表現するものである。<br/>
                通常、アルシエラでの会話を聞いて、それをコンパートメント文字で書くことは人間には出来ない。
                また、人間がアルシエラを書くとき、コンパートメント文字を使ってしっかりとした一対一の意味を作れるほど
                アルシエラに精通していない。
                だが、より科学的にアルシエラを解析する為にはその基準を作る為の文字が必要である。
            </p>
            <p>
                コンパートメントは、パブリック文字1文字を更に、周波数傾向５種類と振幅傾向４種類に分離する為に使われる。
                これをコンパートメントコードと言い、パブリック文字に対しての部位的な扱いで表現される。<br/>
            （漢字で言えば、鰯、溺、といった魚へんやさんずいに当たる部分がコンパートメントコード）
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
                コンパートメントコードは、２００００Hz〜６０００００Hzまでの間を対数的に等分し、それぞれに対して
                コンパートメントレベルという形で表現する。
                コンパートメントコードにはFMCLとAMCLという2種類が存在する。
                FMCL（周波数帯域傾向）とは、２００００Hz以上の周波数帯において対数的に5分割した時、
                その最も音圧が高い区画について、記号化したものになる。
                例えば、１００Hzで聞いたときのくぐもった「あ」は「か」かもしれないし「さ」かもしれないが、
                「か」よりも「さ」の方が高周波成分を多く含んでいる。それをザックリと定義している。
                AMCL（振幅域傾向）とは、その文字を発音している際に、２００００Hz以上の発音音圧の変遷（エンベロープ）が
                どのように変化するかによって決められている。例えば「か」と「さ」では、前者の方がより鋭利で短時間集中型であり、
                後者の方がよりソフトにまんべんなく音圧が存在する。<br/>
            </p>
            <p>
                通常、FMCLはパブリック文字の上側に、AMCLは下側に記述する。<br/>
                尚、コンパートメントコードは母音には使わない。<br/>
                子音に多く存在する高周波成分の指標である為、母音に使うのは無意味な為である。<br/>
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
                「Ec Tisia」は「共感＋成長」と「皆＋誠心＋赦し＋希望＋想いの力」という意味による綴りである為、コンパートメント表記では『Ec[s-4/harf] T[s-3/quad]is[s-4/dual]ia』となる。
                それをコンパートメント文字で記すと、上記のような文字になるのである。
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
