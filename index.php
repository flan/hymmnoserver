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
		<title>Hymmnoserver - Main</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div class="text-basic">
			<table>
				<tr>
					<td align="left" valign="top" style="width: 450px;">
						<p>
							<span class="text-title">Welcome to the Hymmnoserver</span><br/>
							The world of Ar tonelico, Sol Ciel, is home to a language of song magic, known as &quot;Hymmnos&quot;.
							<br/><br/>
							Here, you will be able to learn how this language works and you may look up words in English and Japanese.
						</p>
						<noscript>
							<hr/>
							<p style="color: red;">
								This site was designed with JavaScript 1.5, XHTML 1.1, and CSS 2.0.
								It is accessible using limited browsers (like lynx, elinks, and Microsoft's Internet Explorer),
								but some features will be unavailable.
							</p>
						</noscript>
						<hr/>
						<p style="font-size: 0.9em;">
							Please be aware that this English version is an unofficial, fan-translated work and may, therefore, contain
							errors and suffer from synchronization lag against the
							<a href="http://game.salburg.com/hymmnoserver/">original Japanese site</a>.
							<br/><br/>
							Some features differ (for better or worse) and some details, such as examples, were intentionally rewritten
							in a manner believed to make more sense to an English-speaking audience.
							<br/><br/>
							If you notice any problems, please
							<a href="http://code.google.com/p/hymmnoserver/issues/list">report the issue</a> and help to make this
							service better.
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
							Hymmnos Words are written in special scripts. Exploring this system will be more enjoyable if you
							are able to see the characters as intended. TrueType fonts for are available as free downloads from
							the sidebar to the right.
						</p>
						<ul class="basic-inline text-small">
							<li>
								Users of modern Unix-like operating systems can usually just view the font with their platform's
								font-viewer and click 'Install' or save the font file into <tt>~/.fonts/</tt> and make use of it
								immediately.
							</li>
							<li>
								Mac OS X users may view the font and click 'Install' or drag the font into
								<tt>Library/Fonts/</tt> under their home directory.
							</li>
							<li>
								Those using Microsoft Windows will need to do some weird dance that may or may not involve
								a lot of right-clicking, finding a <tt>Fonts</tt> directory that may or may not be
								write-protected, and, possibly, restarting their system several times to get the font-indexer
								to notice the addition.
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
								<span class="text-title-small">2) Look up an entire Hymmnos sentence</span><br/>
								Enter several words in Hymmnos, separated by spaces, and submit them.
								A translation for each word will be presented.
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
								<span class="text-title-small">6) Browse Hymmnos by letter or category</span><br/>
								Click the &quot;Full Hymmnos lexicon&quot; link below the search bar and you will
								be presented with a full index of the dictionary, split based on the Roman alphabet
								or syntax class.
							</p>
							<p>
								<span class="text-title-small">7) Advanced grammar processing</span><br/>
								Click the &quot;Advanced grammar resources&quot; link below the search bar and
								you will be presented with an interface that supports the following:
							</p>
							<ul style="margin-top: -10px;">
								<li>Syntactic validation and structural processing</li>
								<li>Binasphere Chorus encoding and decoding</li>
								<li>Persistent Emotion Sounds evaluation</li>
							</ul>
						</blockquote>
					</td>
					<td align="right" valign="top" style="width: 184px;">
						<table style="width: 100%; border-color: #001144; border-width: 1px; border-style: outset;">
							<tr>
								<td class="fontcell" style="text-align: center; width: 184px;">
									<a href="./static/hymmnos.ttf" style="text-decoration: none; display: block;">
										<img src="./static/hymgrp.gif" style="border-width: 0;" alt="Download the Hymmnos TrueType Font (v1.1)"/>
										<span style="color: white; font-weight: bold; margin-top: -10px;">
											<span style="font-size: 9pt;">Download the Hymmnos</span><br/>
											<span style="font-size: 8pt;">TrueType Font (v1.1)</span>
										</span>
									</a>
								</td>
							</tr>
						</table>
						<br/>
						<table style="width: 100%; border-color: #001144; border-width: 1px; border-style: outset;">
							<tr>
								<td class="fontcell" style="text-align: center; width: 184px;">
									<a href="./static/ar-ciela_compartment.ttf" style="text-decoration: none; display: block;">
										<img src="./static/arcgrp.gif" style="border-width: 0;" alt="Download the Ar ciela TrueType Font (v0.9)"/>
										<span style="color: white; font-weight: bold; margin-top: -10px;">
											<span style="font-size: 9pt;">Download the Ar ciela</span><br/>
											<span style="font-size: 8pt;">TrueType Font (v0.9)</span>
										</span>
									</a>
									<small><a href="./font_ar-ciela.php" style="color: #70FF99;">Usage notes</a></small>
								</td>
							</tr>
						</table>
						<br/>
						<table style="width: 100%; border-collapse: collapse;">
							<tr>
								<td class="titlecell">
									⠕ Recent updates
								</td>
							</tr>
							<tr>
								<td class="infocell">
									<ul class="basic-inline" style="font-weight: bold; font-size: 7pt; line-height: 3.5mm;">
										<li>(9/1/2016) Added new words</li>
										<li>(13/12/2010) Ar ciela (basics)</li>
										<li>(20/10/2010) Added Ar ciela font</li>
										<li>(20/10/2010) Housekeeping</li>
										<li>(21/2/2010) At3 words added</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td class="titlecell">
									⠕ Hymmnos information
								</td>
							</tr>
							<tr>
								<td class="infocell">
									<ul class="basic-inline" style="font-weight: bold; font-size: 8pt; line-height: 3.5mm;">
										<li><a href="./introduction.php">Introduction</a></li>
										<li><a href="./types.php">Hymmnos Types</a></li>
										<li><a href="./dialects.php">Dialects</a></li>
										<li><a href="./servers.php">Song Magic Servers</a></li>
										<li><a href="./grammar.php">Grammar (Standard)</a></li>
										<li><a href="./grammar2.php">Grammar (Pastalie)</a></li>
										<li><a href="./ar-ciela.php">Ar ciela (basics)</a></li>
										<li><a href="./credits.php">Credits</a></li>
									</ul>
								</td>
							</tr>
							<tr>
								<td class="titlecell">
									⠕ Link banner
								</td>
							</tr>
							<tr>
								<td class="infocell" style="text-align: center;">
									<a href="http://game.salburg.com/hymmnoserver/">
										<img src="./static/hssupA_02.gif" style="border-width: 0px; margin-top: 2px;" alt="Japanese Hymmnoserver"/>
									</a>
								</td>
							</tr>
							<tr>
								<td class="titlecell">
									⠕ Related resources
								</td>
							</tr>
							<tr>
								<td class="infocell">
									<ul class="basic-inline" style="font-weight: bold; font-size: 8pt; line-height: 3.5mm;">
										<li><a href="http://conlang.wikia.com/wiki/Conlang:Hymmnos">Hymmnos, Conlang</a></li>
										<li><a href="http://artonelico.isisview.org/">A Reyvateil's Melody</a></li>
										<li><a href="http://bitbucket.org/dervish_candela/hymmnodict/wiki/Home">Hymmnodict</a></li>
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
									<ul class="basic-inline" style="font-weight: bold; font-size: 8pt; line-height: 3.5mm;">
										<li><a href="http://hymmnoserver.uguu.ca/">uguu.ca</a></li>
									</ul>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<hr/>
			<p>
				<b>Community-friendly</b><br/>
				This site is an open source effort, released in its entirety under the
				<a href="http://gplv3.fsf.org/">GPLv3</a> and
				<a href="http://creativecommons.org/licenses/by-sa/3.0/">by-sa/3.0 Creative Commons</a>
				licenses.
				If you agree to the open terms of these licenses, you may access all of its materials via
				its <a href="http://uguu.ca/ar-sphaela/hymmnoserver/">project site</a>.
			</p>
			<p>
				<b>Localizable</b><br/>
				The Hymmnoserver's database, tools, and development repository are evolving to make
				localization -- and, more importantly, maintainability of localizations -- easy.
				If you want to provide this service in your own language,
				<a href="./credits.php">just ask</a> and we'll help you get started.
			</p>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>

