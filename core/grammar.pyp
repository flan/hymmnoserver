<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Grammar Evaluator</title>
		<!-- <%="-->"%>
		<%@include file="common/resources.xml" %>
		<%="<!--"%> -->
	</head>
	<body>
		<div id="no-python">
			<p>
				Unfortunately, this mirror does not have mod_python, so this
				portion of the site is unavailable.
			</p>
		</div>
		<!-- <%="-->"%>
		<div>
			<script type="text/javascript">
				/*<![CDATA[*/
					document.getElementById("no-python").style.display = 'none';
				/*]]>*/
			</script>
			<noscript>
				JavaScript was supposed to hide the above warning, but your browser does
				not support it, so just pretend that statement isn't there.
			</noscript>
			<%@include file="common/header.xml" %>
			
			Features that will appear here:
			<ul class="basic-inline">
				<li>
					Syntactic validation and structural processing
					<ul>
						<li>
							Enter a complete sentence and it will be evaluated; a syntax tree
							will be rendered, allowing you to study the structure of the statement,
							which may help with translation efforts
						</li>
					</ul>
				</li>
				<li>
					Binasphere conversion
					<ul>
						<li>Enter two sentences and a binasphere line will be generated</li>
						<li>Enter a binasphere line and its component sentences will be reconstructed</li>
					</ul>
				</li>
			</ul>
			Note: This section is currently pre-alpha, and highly incomplete.
			
			<div class="footer-copyright">
				<div id="footer-bar">
					<a href="/hymmnoserver/index.php" class="footer-link">[Go to index]</a>
				</div>
				<i>Hymmnos</i> and <i><a href="http://game.salburg.com/hymmnoserver/" class="footer-copyright">HYMMNOSERVER</a></i> were created by Akira Tsuchiya. (Ver2.0/Rev.20080312)<br/>
				English version provided by <a href="/hymmnoserver/credits.php" class="footer-copyright">Neil Tallim and others</a>. (This is a freely provided, fan-translated service)
			</div>
			<div style="text-align: right;">
				<a href="http://validator.w3.org/check?uri=referer"><img src="/hymmnoserver/images/xhtml11-bar.png" alt="Valid XHTML 1.1" style="border-width: 0;"/></a>
				<a href="http://jigsaw.w3.org/css-validator/validator?uri=http://hamsterx.homelinux.org/hymmnoserver/resources/hymmnoserver.css"><img src="/hymmnoserver/images/css-bar.png" alt="Valid CSS" style="border-width: 0;"/></a>
				<a href="http://bluefish.openoffice.nl"><img src="/hymmnoserver/images/bluefish-bar.png" alt="Made with Bluefish" style="border-width: 0;"/></a>
				<a href="http://www.modpython.org"><img src="/hymmnoserver/images/mod_python-bar.png" alt="Powered by Python" style="border-width: 0;"/></a>
				<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/ca/"><img alt="Creative Commons License" style="border-width: 0;" src="http://i.creativecommons.org/l/by-nc-sa/2.5/ca/80x15.png"/></a>
			</div>
		</div>
		<%="<!--"%> -->
	</body>
</html>
