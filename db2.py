# -*- encoding: utf-8 -*-

import _mysql
db = _mysql.connect("localhost", "aurica", "misha", "hymmnoserver")

while True:
	print "First word: "
	word1 = "'%s'" % raw_input().replace("'", "\\'")
	print "Second word: "
	word2 = "'%s'" % raw_input().replace("'", "\\'")
	
	db.query("insert into hymmnos_mapping values (%s, %s)" % (word1, word2))
	db.query("insert into hymmnos_mapping values (%s, %s)" % (word2, word1))
	print
	