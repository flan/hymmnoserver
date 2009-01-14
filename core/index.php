<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Main</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<table class="text-basic">
			<tr>
				<td align="left" valign="top" style="width: 450px;">
					<p>
						<span class="text-title">Welcome to HYMMNOSERVER</span><br/>
						The world of Ar tonelico, "Sol Ciel", is home to a language of Song Magic, known as "Hymmnos Words".
					</p>
					<p>
						Here, you will be able to learn how this language works and you may look up words in English and Japanese.
					</p>
					<p style="color: red;">
						Please be aware that this English version is an unofficial, fan-translated work and may, therefore, contain
						errors, and suffer from synchronization issues with the original Japanese site.
						Some features differ (for better or worse), and some details were intentionally rewritten in a manner
						believed to make more sense to an English-speaking audience (because of our idioms).<br/>
						If you note any problems, please let the appropriate maintainer know; see the
						<a href="/hymmnoserver/credits.php">credits page</a> for details.
					</p>
					<hr/>
					<p>
						This site is an open source, community-friendly effort, released under
						<a href="http://creativecommons.org/licenses/by-nc-sa/2.5/ca/">the by-nc-sa/2.5 Creative Commons license</a>.
						If you agree to the terms of this license (really, it just says
						&quot;don't sell or limit this work, and please provide due credit&quot;),
						you may grab all of its materials using Subversion:
						&quot;svn co
						<a href="http://hamsterx.homelinux.org/svn/hymmnoserver/">http://hamsterx.homelinux.org/svn/hymmnoserver/</a>
						hymmnoserver/&quot;.
						You may also browse the repository using a web browser or any DAV-capable
						client.
					</p>
					<hr/>
					<p>
						<b>Mirrors wanted!</b><br/>
						Unfortunately, the origin server is on a data-transfer-monitored connection, and this connection
						is prone to random periods of downtime that last between five minutes and an hour.
						If you have PHP 5 and MySQL 5 and you want to help, please contact this site's maintainer to find
						out more.
						If you are a normal visitor and you want to help, consider using a non-origin mirror; these may
						be found on the right side of this page.
					</p>
					<hr/>
					<p>
						<span class="text-title">⠕ The grammar of Hymmnos Words</span><br/>
						Hymmnos Words are organized into a simple grammar. Before perusing the dictionary, you should consider
						learning about its syntax to deepen your understanding. To the right, you will find links to articles
						about the different types of Hymmnos and details about how the grammar works.
					</p>
					<p>
						<span class="text-title">⠕ Hymmnos characters</span><br/>
						Hymmnos Words are written in a special script. Browsing this archive will be more enjoyable if you
						are able to see these characters. A TrueType Font for Hymmnos script is available as a free download
						to your right.
					</p>
					<ul class="basic-inline text-small">
						<li>
							Users of modern Unix-like operating systems can usually just save the font file into ~/.fonts/
							and make	use of it immediately.
						</li>
						<li>
							Mac users may drag fonts from the Finder into the Fonts section under their Library.
						</li>
						<li>
							Those using Microsoft Windows will need to do some weird dance that may or may not involve
							a lot of right-clicking, finding a Fonts directory that may or may not be write-protected,
							and, possibly, restarting their system several times to get the font-indexer to notice the
							addition.
						</li>
					</ul>
					<p>
						<span class="text-title">⠕ Searching for Hymmnos</span><br/>
						The search bar at the top of every page allows you to look up Hymmnos in the database.
						Using this feature, you can do the following:
					</p>
					<blockquote class="text-small">
						<p>
							<span class="text-title-small">1) Find a word in Hymmnos</span><br/>
							Enter a word in Hymmnos and submit it.
							You will see a list of all words beginning with the characters you entered.
						</p>
						<p>
							<span class="text-title-small">2) Process an entire Hymmnos statement</span><br/>
							Enter a complete string of Hymmnos and submit it.
							Every word will be translated in sequence, and the sentence's syntax will be evaluated.
						</p>
						<p>
							<span class="text-title-small">3) Find the Hymmnos for an English word</span><br/>
							Enter a word in English, then submit it.
							All Hymmnos words that involve the fragment you provided will be displayed.
						</p>
						<p>
							<span class="text-title-small">4) Find Hymmnos by kana</span><br/>
							Enter the first few characters that represent the pronunciation of the Hymmnos
							you are trying to find, then submit them.
							All Hymmnos words with Japanese pronunciation beginning with what you provided
							will be displayed.
						</p>
						<p>
							<span class="text-title-small">5) Find Hymmnos by romaji</span><br/>
							This works in the same manner as searching by kana, but it uses a romaji
							representation of words in Hymmnos, which may be easier for some users.
						</p>
						<p>
							<span class="text-title-small">6) List Hymmnos alphabetically</span><br/>
							Click the &quot;Browse words in Roman order&quot; link below the search bar
							and you will be presented with a full index of the dictionary, split by Roman
							letter.
						</p>
						<p>
							<span class="text-title-small">7) List Hymmnos by syntax class</span><br/>
							Click the &quot;Browse words by syntax class&quot; link below the search bar and
							you will be presented with a full index of the dictionary, split by syntax class.
						</p>
					</blockquote>
				</td>
				<td align="right" valign="top" style="width: 184px;">
					<table style="width: 184px; border-color: #001144; border-width: 1px; border-style: outset;">
						<tr>
							<td class="fontcell" style="text-align: center; style=width: 184px;">
								<a href="/hymmnoserver/images/hymmnos.ttf" style="text-decoration: none; display: block;">
									<img src="/hymmnoserver/images/hymgrp.gif" style="border-width: 0;" alt="Download the Hymmnos TrueType Font (v1.1)"/>
									<span style="color: #FFFFFF; font-weight: bold; margin-top: -10px;">
										<span style="font-size: 9pt;">Download the [Hymmnos]</span><br/>
										<span style="font-size: 8pt;">TrueType Font (v1.1)</span>
									</span>
								</a>
							</td>
						</tr>
					</table>
					<br/>
	
					<table cellspacing="0">
						<tr>
							<td class="titlecell">
								⠕ Updates
							</td>
						</tr>
						<tr>
							<td class="infocell">
								<ul class="basic-inline" style="font-weight: bold; font-size: 7pt; line-height: 3.5mm;">
									<li>Source released (14/1/2009)</li>
									<li>Unofficial words (13/1/2009)</li>
									<li>Grammar evaluator (7/1/2009)</li>
									<li>Private beta (6/1/2009)</li>
									<li>Japanese site's content archived (31/12/2008)</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td class="titlecell">
								⠕ Hymmnos Information
							</td>
						</tr>
						<tr>
							<td class="infocell">
								<ul class="basic-inline" style="font-weight: bold; font-size: 9pt; line-height: 3.5mm;">
									<li><a href="/hymmnoserver/introduction.php">Introduction</a></li>
									<li><a href="/hymmnoserver/types.php">Hymmnos Types</a></li>
									<li><a href="/hymmnoserver/dialects.php">Dialects</a></li>
									<li><a href="/hymmnoserver/servers.php">Song Magic Servers</a></li>
									<li><a href="/hymmnoserver/grammar.php">Grammar (Standard)</a></li>
									<li><a href="/hymmnoserver/grammar2.php">Grammar (Pastalia)</a></li>
									<li><a href="/hymmnoserver/credits.php">Credits</a></li>
								</ul>
							</td>
						</tr>
						<tr>
							<td class="titlecell">
								⠕ Link Banner
							</td>
						</tr>
						<tr>
							<td style="text-align: center;" class="infocell">
								<a href="http://game.salburg.com/hymmnoserver/">
									<img src="/hymmnoserver/images/hssupA_02.gif" style="border-width: 0px; margin-top: 2px;" alt="Japanese HYMMNOSERVER website"/>
								</a>
							</td>
						</tr>
						<tr>
							<td class="titlecell">
								⠕ Related Resources
							</td>
						</tr>
						<tr>
							<td class="infocell">
								<ul class="basic-inline" style="font-weight: bold; font-size: 9pt; line-height: 3.5mm;">
									<li><a href="http://conlang.wikia.com/wiki/Conlang:Hymmnos">Hymmnos, Conlang</a></li>
									<li><a href="http://weezy.freeforums.org/">A Reyvateil's Melody</a></li>
								</ul>
							</td>
						</tr>
						<tr>
							<td class="titlecell">
								⠕ Mirrors
							</td>
						</tr>
						<tr>
							<td class="infocell">
								<ul class="basic-inline" style="font-weight: bold; font-size: 9pt; line-height: 3.5mm;">
									<li><a href="http://hamsterx.homelinux.org/hymmnoserver/">Origin</a></li>
								</ul>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
