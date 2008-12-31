<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Summary</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div class="text-basic">
			<p>
				<div class="section-title text-title-small">■ヒュムノス単語を使った呪文列の種類</div><br/>
				ヒュムノスワードを使用する呪文フォーマットには、大きく分けて３つが存在する。
			</p>
			<ul class="basic-inline" style="font-weight: bold; font-size: 9pt; margin-top: -10px;">
				<li>ヒュムノスエクストラクト</li>
				<li>ヒュムノスワード</li>
				<li>ヒュムノススペル</li>
			</ul>
			<p>
				「ヒュムノスエクストラクト」とは、「塔をコントロールする詩」の事で、アルトネリコを直接制御できる力を持つ。
				しかし、これには認証が必要であり、その許可を得ている特定のレーヴァテイルしか使うことが出来ない。
				一般的に「ヒュムノス」と言われる場合、全てはこの「ヒュムノスエクストラクト」の事を指す。
				ヒュムノスエクストラクトを使用するための鍵、それは「ヒュムネコード」といわれるレーヴァテイル識別子である。
				これを持っているレーヴァテイルは、このコードを照合することで、ヒュムノスエクストラクトを使用することが可能になる。
				ヒュムネコードとは、「EOLIA_ANSUL_ARTONELICO」などの文字列で、β純血種以上のレーヴァテイルには全個体に固有の文字列が当てられている。
				ヒュムノスエクストラクトを使用することが出来ると、天候のコントロールから重力制御、大地を揺るがす大魔法、詩魔法による全体統制、環境コントロールなど
				様々な事を行うことが出来る。
			</p>
			<p>
				「ヒュムノスワード」とは、いわゆる第三紀で「詩魔法」と言われているもので、戦闘などで使う妄想魔法の事である。これはレーヴァテイルであれば誰でも使うことが出来、
				自分の心の中にアクセスするだけで、そのバリエーションをどんどん増やすことが可能である。使用に制限はなく、心の豊かさ＝ヒュムノスワードの多彩さ、という事になる。
			</p>
			<p>
				「ヒュムノススペル」とは、詩として使用することはないが、詠唱することで発動する呪文文字列。レーヴァテイルが唱えるものではないというのも大きな特徴である。
				ヒュムノススペルは、主に人間がレーヴァテイルや塔にアクセスしたりコントロールする時に使用するもの。文法的には「ヒュムノスワード」と全く同じだが、違いは
				塔内に全く同じスペルが登録されており、それと同じ呪文列を詠唱すると実行されるだけ…という、プリセット呪文であるという事だ。その為、ヒュムノスワードと違い、
				次々と新しいものを産み出すことは出来ない。主にヒュムノスエクストラクトのダウンロード、隔壁認証などに使われていた。
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">■ヒュムノスの理論</div>
			<p>
				ここからは、ヒュムノスのそれぞれについて、より深くロジックを解説していこう。
			</p>
			<p>
				「ヒュムノス・スペル」はレーヴァテイルの詩ではない為特殊であるが、
				「ヒュムノス・エクストラクト」と「ヒュムノス・ワード」は、一見同じ理屈で動いているように見える。
				それは、端から見ればどちらも「詩を謳う→何かが発動する」という事に違いがないためである。
				しかし、実際は全然違う。
				簡単に言えば、ヒュムノス・ワードとは100％レーヴァテイルの妄想の具現化であり、
				ヒュムノス・エクストラクトとは、よりメカ的でシステム的な、無機的部分が多く含まれる詩である。
			</p>
			<p>
				<b>▼ヒュムノス・エクストラクトとヒュムノス・ワードの発動</b><br/>
				<img src="/images/shereing.jpg"><br/>
				ヒュムノスの理論に詳しい方はピンと来るかも知れないが、ヒュムノス・エクストラクトは純粋なレーヴァテイルの想いではない。
				そこには「想い（導体H波）」を信号としてしか見ない類の、明らかなる「人工的な処理」が介在する。
			</p>
			<p>
				<b>▼ヒュムノスの実行結果例</b><br/>
				<table>
					<tr>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>詩名</b></font></td>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>詩種</b></font></td>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>効果</b></font></td>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>実行範囲</b></font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_PAJA/.</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">エクストラクト</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">塔内の特定回線を切断</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">塔システム内</font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_SUSPEND/.</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">エクストラクト</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">塔全体をスタンバイに移行</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">塔システム内</font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_LINCA/.</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">エクストラクト</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">塔とレーヴァテイルを物理結線</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">塔システム内</font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_HYMME_LIFE_A:W:S/.</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">ワード</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">特定有機体の定常D波の秩序補正</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">詠唱個人視野内</font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_HYMME_LUMINOUS_DEF/.</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">ワード</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">特定フィールドにD波シールド</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">詠唱個人視野内</font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_HYMME_OYAJI/.</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">ワード</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">頑固親父のビジョン創出とD波ダメージ</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">詠唱個人視野内</font></td>
					</tr>
				</table>
			</p>
			<p>
				しかし、レーヴァテイルが詩を謳う（＝導体H波を放出する）為には、自分の精神の中に
				完全に納得した形でその「詩」を落とし込まなければならない。
				ヒュムノス・ワードは、自分自身が想い描いた詩を自分に落とし込むのだから、100％成功して当然である。<br/>
				（ところがワードであっても、レーヴァテイル自身に自己不安があると、なかなか詩が思い通りの効果を発揮しない）
			</p>
			<p>
				ヒュムノス・エクストラクトの最も難しい点はここで、設計されたヒュムノス・エクストラクトの想いを、
				レーヴァテイルが何の違和感もなくダウンロード（心に落とし込むこと）出来なければならない。
				自分以外の誰かの「想い」を、あたかも自分の「想い」として擬似的に吸収しなければならないのであるから、
				その互換性は相当シビアになってくる。<br/>
				それ故ヒュムノス・エクストラクトには、ショックアブソーバーとして、その挙動に近い種の「物語」が封入されていることが多い。
				それは、レーヴァテイルと人工的プログラムを馴染ませるための手段として、しばしば用いられる。
				ヒュムノスエクストラクト制作時に、ここに矛盾が発生すると、
				レーヴァテイルはダウンロードを拒絶するか、もしくはダウンロード出来ても力が出ない。
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">■ヒュムノス・エクストラクトの仕組み</div>
			<p>
				EXEC_PAJA/.などは、歌い手の「想い（導体H波）」が塔のシステムを動かす詩である。
				厳密には、ヒュムノスという詩をダウンロード（心に記憶）したレーヴァテイル（娘）が謳う。
				その時のレーヴァテイルは「プログラマー」というよりは、「（ゲーム機の）ROMカセット」と言う方がより正しい。
				この例えでヒュムノスというプログラミング言語を説明すると、謳っている最中の歌い手の「想い（導体H波）」とは、
				バスを経由しCPUなどのコントローラーへ流れる電気信号そのもの、という定義になる。
				レーヴァテイルとは、ゲーム機のカセットであり、塔自体がゲーム機本体というのが一番分かりやすい例えではないだろうか。
				（もっと厳密に話せば、レーヴァテイルはメディア（メモリーカードやHDD、DVD-RAMなど）である）
			</p>
			<p>
				<b>▼分かりやすい例え</b><br/>
				<table>
					<tr>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>ヒュムネクリスタル</b></font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">プログラム</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">ソフトウェア</font></td>
					</tr>
					<tr>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>レーヴァテイル</b></font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">DVD-RAMや、書き換え可能なゲームカセット等</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">ハードウェア</font></td>
					</tr>
					<tr>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>アルトネリコ（塔）</b></font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">PCやゲーム機本体</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">ハードウェア</font></td>
					</tr>
				</table>
			</p>
			<p>
				波動科学に戻すと、導体H波がプログラムによって法則性を持って送り出される電気信号で、導体D波が実行された結果（画面表示など）となる。
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">■導体Ｈ波の力関係</div>
			<p>
				ヒュムノス・ワードの場合、導体H波はレーヴァテイルが任意に送信するものであり、塔（サーバー）から要求されるものではない。
				レーヴァテイルは、自分自身の意識と無意識で、導体H波の流量（＝想いの力）を制御する。
				それが許されるのは、ヒュムノス・ワードがレーヴァテイルの責任においてのみ発動する詩だからである。
				しかし、ヒュムノス・エクストラクトともなると、それでは収まらない。
			</p>
			<p>
				ヒュムノス・エクストラクトは「他人の想い」であり、自分自身の裁量では必要な導体Ｈ波流量を決められない。
				例えば「EXEC_HYMME_LIFE_A:W:S/.（ワード）」をオリカが謳う場合、
				それを紡ぎ出したのがオリカである故、必要導体Ｈ波流量とスペクトルもオリカの裁量で無意識に決定している。
				しかし「EXEC_LINCA/.（エクストラクト）」をオリカが謳う場合、他人の決めた仕様を謳うのであるから、当然導体Ｈ波流量とスペクトルは自分では決められない。
				そこでは、オリカがどれくらいのキャパを持っているかなどは関係ない。
				ヒュムノス・エクストラクトはただ無情に、記録された仕様通りの流量とスペクトルを要求するだけなのである。
			</p>
			<p>
				ここに悲劇が発生する。
				すなわち、レーヴァテイルがヒュムノス・エクストラクトに喰われるという事が発生するのである。
				第一紀において、その問題は殆どなかった。
				なぜなら、「オリジン」がずば抜けたパワーを持つ以外は、「ベータ純血種」が全員均一のパワーを持つだけだったからである。
				すなわち、ヒュムノス・エクストラクトの格付けは「オリジン専用」と「汎用」の2種で十分だったのだ。
				（厳密には、第二紀ソル・シエールで開発されたベータ純血種は、オリジンに近いスペックを持っている）
				しかし、第三世代が入ってきて、その単純さは失われる。
				第三世代は個体差がある。ＭＡＸでベータ純血種を越え、ミニマムでは何も謳えない。
				その為、第三世代がヒュムノス・エクストラクトを謳う場合、能力の低い第三世代はその場で死んでしまうこともある。
			</p>
			<p>
				不幸中の幸いなのは、第三世代がヒュムネコードを持っておらず、ヒュムノス・エクストラクトをダウンロード出来ないという点である。
				それによって、ゲームの時期「第三紀」では、ヒュムノス・エクストラクトを謳ったことのある第三世代は皆無である。
			</p>
			<p>
				<b>▼参考：数字で見るエクストラクトの仕様</b><br/>
				<table>
					<tr>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>名称</b></font></td>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>要求流量</b></font></td>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>要求スペクトル平均</b></font></td>
						<td bgcolor="#aaaadd"><font class=fonts2 color="#001144"><b>備考</b></font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_PAJA/.</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">2,800 SHmag/s</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">2.4x10^5Hz</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144"></font></td>
					
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_LINCA/.</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">15,400 SHmag/s</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">9.14x10^5Hz</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144"></font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_CHRONICLE_KEY/.</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">300 SHmag/s</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">6.1x10^6Hz</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144"></font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_HARMONIUS/.</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">6,400 SHmag/s</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">3.8x10^8Hz</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144"></font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_SUSPEND/.</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">198,000 SHmag/s</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">9.8x10^5Hz</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">オリジン専用の流量</font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_RE=NATION/.</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">32,800 SHmag/s</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">1.19x10^6Hz</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144"></font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_PHANTASMAGORIA/.</font></td>v
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">7,600 SHmag/s</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">3.31x10^10Hz</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">人間の限界値間近の周波数</font></td>
					</tr>
					<tr>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">EXEC_METAFALICA/.</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">13,122,800 SHmag/s</font></td>
						<td bgcolor="#ccccff" align=right><font class=fonts2 color="#001144">2.98x10^18Hz</font></td>
						<td bgcolor="#ccccff"><font class=fonts2 color="#001144">人間には謳えない周波数と流量</font></td>
					</tr>
				</table>
			</p>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
