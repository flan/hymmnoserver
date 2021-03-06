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
		<title>Hymmnoserver - Song Magic Servers</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>

		<?php include 'common/header.xml'; ?>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Song Magic Servers</div>
			<p>
				The first game featured the tower of Ar tonelico and the second features a new system:
				Infel Phira.<br/>
				Both of these systems are Song Magic Servers and have the same basic fundamental features:
			</p>
			<ul class="basic-inline" style="font-weight: bold; font-size: 9pt; margin-top: -10px;">
				<li>An H-wave receptor that can interpret instructions and produce D-waves</li>
				<li>The ability to support connections from at least one Reyvateil (daughter)</li>
				<li>Hymmnos-language-processing capabilities</li>
			</ul>
			<p>
				Ar tonelico was constructed during the First Era. 
				Its basic functionality is much like a core that produces magical effects upon
				receiving a Reyvateil's song.
				The magical effects are caused by the emission of dynamic D-waves upon receiving
				thoughts; the net effect of this process is that its users, the Reyvateils, can
				command powers far beyond their actual capabilities.
			</p>
		</div>
		<div class="text-basic">
			<div class="section-title text-title-small">⠕ Ar tonelico and Infel Phira</div>
			<p>
				The differences between Ar tonelico and Infel Phira are not unlike the differences
				between an Intel-based system and a Sparc.
			</p>
			<table>
				<tr>
					<td class="server-header">Server Name</td>
					<td class="server-header">Equivalent</td>
					<td class="server-header">Location</td>
				</tr>
				<tr>
					<td class="server-data">Ar tonelico</td>
					<td class="server-data">Intel</td>
					<td class="server-data">Sol Ciel (At1)</td>
				</tr>
				<tr>
					<td class="server-data">Infel Phira</td>
					<td class="server-data">Sparc</td>
					<td class="server-data">Metafalss (At2)</td>
				</tr>
			</table>
			<p>
				For each system, the basic logic is the same: CPU receives instructions in a format it
				can understand -> CPU acts accordingly.
			</p>
			<p>
				However, Intel processors, and the format they work with, store and transport data differently
				from the machinations of a Sparc processor, so you could not simply send messages intended for
				one to the other without some sort of translator.
				<br/><br/>
				The same problem arises when attempting to foster communication between different systems like
				Ar tonelico and Infel Phira: both perform similar tasks, but their formats and means of encoding
				messages (the Hymmnos they recognize) are very different.
				Additionally, like the systems themselves, there are no fundamental differences between the
				roles of the Reyvateils of one system and the Reyvateils of the other: the only difference is which
				Hymmnos dialect they natively speak. The relationship is much like different partition formats on
				hard drives: they are accessed differently and have varying, often incompatible designs,
				but they can all handle the same basic data.
			</p>
			<table>
				<tr>
					<td class="server-header">Server Name</td>
					<td class="server-data">Ar tonelico</td>
					<td class="server-data">Infel Phira</td>
				</tr>
				<tr>
					<td class="server-header">Equivalent</td>
					<td class="server-data">Intel (small-endian)</td>
					<td class="server-data">Sparc (big-endian)</td>
				</tr>
				<tr>
					<td class="server-header">Languages</td>
					<td class="server-data">Central Standard Note and dialects</td>
					<td class="server-data">New Testament of Pastalie only</td>
				</tr>
				<tr>
					<td class="server-header">Invocation</td>
					<td class="server-data">EXEC_XXXX/.</td>
					<td class="server-data">METHOD_XXXX/.</td>
				</tr>
				<tr>
					<td class="server-header">Reyvateil</td>
					<td class="server-data">Tower-Alpha-format memory</td>
					<td class="server-data">I.P.D.-format memory</td>
				</tr>
			</table>
			<p>
				As designed, neither system is inherently able to communicate with the other.
				To get around this, they need to agree on a compatible protocol for exchanging
				data, somewhat like how your Web browser used TCP/IP and HTTP to access this page.
				Once a protocol has been agreed on, simple tasks like sharing files to complex
				ones like entering Cosmospheres and establishing links in the Binary Field may be
				accomplished.
			</p>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
