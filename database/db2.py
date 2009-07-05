# -*- encoding: utf-8 -*-
"""
HymmnoServer support module: db2

Purpose
=======
 Endlessly prompts the user to provide word pairs of words so that related
 Hymmnos may be linked.
 
 Note that this script performs NO error-handling.
 
Legal
=====
 All code, unless otherwise indicated, is original, and subject to the terms of
 the Creative Commons Attribution-Noncommercial-Share Alike 3.0 License,
 which is provided in license.README.
 
 (C) Neil Tallim, 2009
"""
import _mysql

db = _mysql.connect("localhost", "username", "password", "database")

while True:
	print "First word:"
	word1 = "'%s'" % raw_input().replace("'", "\\'")
	
	print "First dialect:"
	school1 = int(raw_input())
	
	print "Second word:"
	word2 = "'%s'" % raw_input().replace("'", "\\'")
	
	print "Second dialect:"
	school2 = int(raw_input())
	
	db.query("insert into hymmnos_mapping values (%s, %s, %i, %i)" % (word1, word2, school1, school2))
	db.query("insert into hymmnos_mapping values (%s, %s, %i, %i)" % (word2, word1, school2, school1))
	print
	
