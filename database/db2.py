# -*- encoding: utf-8 -*-

import _mysql
db = _mysql.connect("localhost", "aurica", "misha", "hymmnoserver")

while True:
	print "First word: "
	word1 = "'%s'" % raw_input().replace("'", "\\'")
	print "First dialect:"
	school1 = int(raw_input())
	print "Second word: "
	word2 = "'%s'" % raw_input().replace("'", "\\'")
	print "Second dialect:"
	school2 = int(raw_input())
	
	db.query("insert into hymmnos_mapping values (%s, %s, %i, %i)" % (word1, word2, school1, school2))
	db.query("insert into hymmnos_mapping values (%s, %s, %i, %i)" % (word2, word1, school2, school1))
	print
	
