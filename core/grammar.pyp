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
				<div>
					JavaScript was supposed to hide the statement above, but your browser does
					not support it, so just pretend that nothing's there.
				</div>
			</noscript>
			<%@include file="common/header.xml" %>
			
			Features that will appear here:
			<ul class="basic-inline">
				<li>
					Syntactic validation and structural processing
					<ul>
						<li>
							Enter a complete sentence and it will be evaluated; a syntax tree
							will be rendered, allowing you to study the structure of the phrase,
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
			Note: This section is currently pre-alpha and highly incomplete.
			
			<%@include file="common/footer-py.xml" %>
		</div>
		<%="<!--"%> -->
	</body>
</html>
