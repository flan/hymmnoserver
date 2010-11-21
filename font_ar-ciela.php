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
		<title>Hymmnoserver - Grammar (Standard)</title>
		<?php include 'common/resources.xml'; ?>
		<style type="text/css">
			table.coding{
				border: 1px solid #000044;
				border-collapse: collapse;
				border-spacing: 1px;
			}
			table.coding > td{
				vertical-align: middle;
				text-align: center;
			}
			td.header{
				font-weight: bold;
			}
			td.ciela{
				font-size: 3em;
				font-family: ar-ciela(compartment), sans;
				color: black;
			}
			td.keyboard{
				background-color: #FFCCCC;
			}
		</style>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Coding Ar ciel modifiers</div>
			<p>
				Transcribed Ar ciel makes use of modifieres to convey emphasis and categorization
				of the frequency and amplitude its notes. While writing basic script is
				straight-forward, indicating modification requires that you follow the coding
				schemes described below.
			</p>
			<b>▼ FMCL</b><br/>
			<table class="coding">
				<tr>
					<td class="header">Modifier</td>
					
					<td/>
					<td class="ciela">!</td>
					<td class="ciela">#</td>
					<td class="ciela">$</td>
					<td class="ciela">%</td>
				</tr>
				<tr>
					<td class="header">Category</td>
					
					<td>session-0</td>
					<td>session-1</td>
					<td>session-2</td>
					<td>session-3</td>
					<td>session-4</td>
				</tr>
				<tr>
					<td class="header">Frequency range</td>
					
					<td>20000Hz</td>
					<td>50000Hz</td>
					<td>100000Hz</td>
					<td>150000Hz</td>
					<td>300000Hz</td>
				</tr>
				<tr>
					<td class="header keyboard">Keystroke</td>
					
					<td class="keyboard"/>
					<td class="keyboard">!</td>
					<td class="keyboard">#</td>
					<td class="keyboard">$</td>
					<td class="keyboard">%</td>
				</tr>
			</table><br/>
			<b>▼ AMCL</b><br/>
			<table class="coding">
				<tr>
					<td class="header">Modifier</td>
					
					<td class="ciela">&</td>
					<td class="ciela">(</td>
					<td/>
					<td class="ciela">)</td>
				</tr>
				<tr>
					<td class="header">Category</td>
					
					<td>quad</td>
					<td>dual</td>
					<td>single</td>
					<td>half</td>
				</tr>
				<tr>
					<td class="header">Amplitude signature</td>
					
					<td>＼＿＿＿</td>
					<td>／￣＼＿</td>
					<td>＿＿＿＿</td>
					<td>／＼&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td class="header keyboard">Keystroke</td>
					
					<td class="keyboard">&</td>
					<td class="keyboard">(</td>
					<td class="keyboard"/>
					<td class="keyboard">)</td>
				</tr>
			</table><br/>
			<p>
				Note that these coding elements will not cause your cusror to advance. To use them
				effectively, enter the modifiers before the note being described.
			</p>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
