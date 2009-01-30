<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Grammar Evaluator</title>
		<!-- <%="-->"%>
<%
import os
from mod_python import apache
_WORKING_PATH = os.path.dirname(__file__) + "/common"

binasphere = apache.import_module('binasphere', path=[_WORKING_PATH])

_db_con = None
_query = None
if form.has_key('query'):
	_query = form['query'].strip()
	if not _query:
%>
		<%@include file="/your_database_file_here.xml" %>
<%
	else:
		pass

%>
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
				JavaScript was supposed to hide the statement above, but your browser does
				not support it, so just pretend that nothing's there.
			</noscript>
			<%@include file="common/header.xml" %>
			
<%
if not _query:
%>
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
<%
else:
	try:
		words = binasphere.decodeBinasphere(query)
		for lines in binasphere.divideAndCapitalise(words, _db_con):
			req.write(str(lines) + "<br/>")
	except binasphere.FormatError:
		pass #try syntax
	except binasphere.ContentError, e:
		req.write("Unable to decode Binasphere phrase: %s" % e)

%>
			<form method="get" action="/hymmnoserver/grammar.pyp">
				<textarea name="query"></textarea><br/>
				<input type="submit" value="Process"/>
			</form>
			<%if _db_con: _db_con.close() %>
			<%@include file="common/footer-py.xml" %>
		</div>
		<%="<!--"%> -->
	</body>
</html>
