# -*- encoding: utf-8 -*-
"""
Hymmnoserver support module: link_words

Purpose
=======
 Endlessly prompts the user to provide word pairs of words so that related
 Hymmnos may be linked.
 
 Note that this script performs NO error-handling.
 
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
import _db

db_con = _db.getConnection()
cursor = db_con.cursor()
try:
	while True:
		print "First word:"
		word1 = "'%s'" % raw_input().replace("'", "\\'")
		
		print "First dialect:"
		school1 = int(raw_input())
		
		print "Second word:"
		word2 = "'%s'" % raw_input().replace("'", "\\'")
		
		print "Second dialect:"
		school2 = int(raw_input())
		
		
		cursor.execute(' '.join((
		 "INSERT INTO hymmnos_mapping",
		 "(source, destination, source_school, destination_school)",
		 "VALUES (%s, %s, %i, %i)",
		)), (word1, word2, school1, school2,))
		cursor.execute(' '.join((
		 "INSERT INTO hymmnos_mapping",
		 "(source, destination, source_school, destination_school)",
		 "VALUES (%s, %s, %i, %i)",
		)), (word2, word1, school2, school1,))
		print
finally:
	try:
		cursor.close()
	except:
		pass
	try:
		db_con.close()
	except:
		pass
		
