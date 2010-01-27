#!/usr/bin/python
# -*- coding: utf-8 -*-
"""
Hymmnoserver script: syntax-xml

Purpose
=======
 Offers an XML version of any generatable syntax tree.
 
Legal
=====
 All code, unless otherwise indicated, is original, and subject to the terms of
 the GNU GPLv3 or, at your option, any later version of the GPL.
 
 All content is derived from public domain, promotional, or otherwise-compatible
 sources and published uniformly under the
 Creative Commons Attribution-Share Alike 3.0 license.
 
 See license.README for details.
 
 (C) Neil Tallim, 2009
"""
import cgi

import common.syntax as syntax
import secure.db as db

form = cgi.FieldStorage()

print "Content-Type: text/xml"
print "Expires: Mon, 20 Dec 1998 01:00:00 GMT"
print "Last-Modified:", time.strftime("%a, %d %b %Y %H:%M:%S", time.gmtime()), "GMT"
print "Cache-Control: no-cache, must-revalidate"
print "Pragma: no-cache"
print
try:
	query = form.getfirst("query")
	
	if not query or not query.strip():
		raise ValueError("nothing to process")
		
	lines = [line for line in [l.strip() for l in query.splitlines()] if line]
	if not lines:
		raise ValueError("nothing to process")
		
	db_con = db.getConnection()
	(tree, display_string, result) = syntax.processSyntax(lines[0], db_con)
	if result is None:
		raise ValueError("incomplete sentence")
		
	print tree.toXML()
	
	try:
		db_con.close()
	except:
		pass
except Exception, e:
	print """<?xml version="1.0" encoding="UTF-8"?>"""
	print "<error><![CDATA[%(error)s]]></error>" % {'error': e,}
	