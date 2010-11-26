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
		<title>Hymmnoserver - Ar ciela font usage</title>
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
			td.keyboard{
				background-color: #FFCCCC;
			}
		</style>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Ar ciel Compartment coding</div>
			<p>
				Transcribed Ar ciel makes use of Compartments to convey emphasis and categorization
				of the frequency and amplitude its notes. While writing Public script is
				straight-forward, indicating Compartments requires that you follow the coding
				schemes described below.
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
				<tr>
					<td class="property keyboard">Keystroke</td>
					
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
				<tr>
					<td class="property keyboard">Keystroke</td>
					
					<td class="keyboard">&amp;</td>
					<td class="keyboard">(</td>
					<td class="keyboard"/>
					<td class="keyboard">)</td>
				</tr>
			</table><br/>
			<p>
				Note that these coding elements will not cause your cusror to advance. To use them
				effectively, provide the Compartment(s) before the note being described.
			</p>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
