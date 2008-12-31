<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Song Magic Servers</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div class="text-basic">
			<div class="section-title text-title-small">■詩魔法サーバーとは</div>
			<p>
				一作目で登場した塔「アルトネリコ」と、今作の「インフェル・ピラ」は両方とも「詩魔法サーバー」と言われるものである。<br/>
				その定義は、以下のようなものによる。
			</p>
			<ul class="basic-inline" style="font-weight: bold; font-size: 9pt; margin-top: -10px;">
				<li>想い（導体Ｈ波）を魔法の力（導体Ｄ波）に変換するシステムを持つ</li>
				<li>レーヴァテイル（娘）が1人以上接続されている</li>
				<li>ヒュムノス言語をサポートしている</li>
			</ul>
			<p>
				アルトネリコは、第一紀と呼ばれる文明期に建てられた塔である。
				全てのレーヴァテイルは、このアルトネリコの中に「心」があり、詩を謳えば塔が魔法にしてくれた。
				塔は魔法を創り出す為のエネルギー（導体Ｄ波）を無限に保有してはいるが、
				それを何かの形にしたり、実質的な力にする為の思考は持ち合わせていない。
				それを行うのが、レーヴァテイルなのである。
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">■アルトネリコとインフェル・ピラ</div>
			<p>
				アルトネリコ（塔）とインフェル・ピラを分かりやすく例えれば、WindowsマシンとMacである。
			</p>
			<table>
				<tr>
					<td bgcolor="#aaddaa"><font class=fonts2 color="#001144"><b>サーバー名</b></font></td>
					<td bgcolor="#aaddaa"><font class=fonts2 color="#001144"><b>例えるなら</b></font></td>
					<td bgcolor="#aaddaa"><font class=fonts2 color="#001144"><b>設置場所</b></font></td>
				</tr>
				<tr>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">アルトネリコ</font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">Windowsパソコン</font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">ソル・シエール（AT1の舞台）</font></td>
				</tr>
				<tr>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">インフェル・ピラ</font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">Macintoshパソコン</font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">メタ・ファルス（AT2の舞台）</font></td>
				</tr>
			</table>
			<p>
				両者は、基本的な処理理論は同じである。
				PCでいうなら、プログラム言語がCPU等を動かして結果をはじき出す、というプロセスは同じという事である。<br/>
				しかしWindowsとMacでは、根本的にCPUが違い、それに対応する言語も違う。
				それは、ヒュムノス言語の「新約パスタリエ（インフェル・ピラ用）」とそれ以外（アルトネリコ用）の差として説明できる。
				また、レーヴァテイルはSDカードである事にかわりなく、厳密にハードウェアレベルでいえば、第三世代もI.P.D.も何の変わりもない。
				何が違うのかと言えば、生まれたときに「Windows用にフォーマットされたか、Mac用にフォーマットされたか」でしかない。
			</p>
			<table>
				<tr>
					<td bgcolor="#aaddaa"><font class=fonts2 color="#001144"><b>サーバー名</b></font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">アルトネリコ</font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">インフェル・ピラ</font></td>
				</tr>
				<tr>
					<td bgcolor="#aaddaa"><font class=fonts2 color="#001144"><b>PCに例えると</b></font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">PC/AT互換機(Windows)</font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">Macintosh(PPC)</font></td>
				</tr>
				<tr>
					<td bgcolor="#aaddaa"><font class=fonts2 color="#001144"><b>使用言語</b></font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">中央正純律他数種（インテル系アセンブリ）</font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">新約パスタリエのみ（モトローラ系アセンブリ）</font></td>
				</tr>
				<tr>
					<td bgcolor="#aaddaa"><font class=fonts2 color="#001144"><b>対応拡張子</b></font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">EXEC_XXXXX/.</font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">METHOD_XXXXX/.</font></td>
				</tr>
				<tr>
					<td bgcolor="#aaddaa"><font class=fonts2 color="#001144"><b>レーヴァテイル</b></font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">Alphaフォーマットされたメモリカード</font></td>
					<td bgcolor="#ccffcc"><font class=fonts2 color="#001144">I.P.D.フォーマットされたメモリカード</font></td>
				</tr>
			</table>
			<p>
				これら２つは、普通繋ぐことが出来ない。
				繋ぐためには、物理結線を行った後に、互換プロトコルを用いてデータのやりとりを行う必要がある。
				簡単に言えば、例えばLANで接続をする。
				すると、データの閲覧やストレージ（コスモスフィア、バイナリ野）の更新は相互に出来るようになる。
			</p>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
