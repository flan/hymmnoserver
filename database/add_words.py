# -*- encoding: utf-8 -*-
"""
Hymmnoserver support module: add_words

Purpose
=======
 Endlessly prompts the user to provide word elements so that new Hymmnos may be
 quickly added to the database.
 
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
import _romaji

db_con = _db.getConnection()
cursor = db_con.cursor()
try:
	while True:
		print "Word to be added:"
		word = "'%s'" % raw_input().replace("'", "\\'")
	
		print "English translation:"
		english = "'%s'" % raw_input().replace("'", "\\'")
	
		print "Japanese form:"
		japanese = "'%s'" % raw_input().replace("'", "\\'")
	
		print "Kana form:"
		kana = "'%s'" % raw_input().replace("'", "\\'")
	
		print "Syllables in lower-case, separated by spaces (; for E.V.):"
		syllables = None
		while True:
			syllables = "'%s'" % raw_input().replace("'", "\\'")
			if syllables.replace(' ', '').lower() == word.lower():
				break
			elif syllables.endswith(";'"):
				syllables = syllables[:-2] + "'"
				break
			else:
				print "Entry does not match word structure"
			
		print "1) 中央正純律（共通語） | Central"
		print "2) クルトシエール律（Ⅰ紀前古代語） | Cult Ciel"
		print "3) クラスタ律（クラスタ地方語） | Cluster"
		print "4) アルファ律（オリジンスペル） | Alpha"
		print "5) 古メタファルス律（Ⅰ紀神聖語） | Metafalss"
		print "6) 新約パスタリエ（パスタリア成語） | Pastalie"
		print "7) アルファ律（オリジンスペル：EOLIA属） | Alpha (EOLIA)"
		print "0) Unknown"
		print "Dialect (add 50 to mark as unofficial):"
		school = int(raw_input())
	
		print "1) Emotion verb"
		print "2) verb"
		print "3) adverb"
		print "4) noun"
		print "5) conjunction"
		print "6) preposition"
		print "7) Emotion sound (II)"
		print "8) adjective"
		print "9) verb/noun"
		print "10) adjective/noun"
		print "11) verb/adjective"
		print "12) particle"
		print "13) Emotion sound (III)"
		print "14) Emotion sound (I)"
		print "15) pronoun"
		print "16) interjection"
		print "17) Emotion sound (II)/adjective"
		print "18) conjunction/verb"
		print "19) noun/adverb"
		print "20) adjective/adverb"
		print "Syntax class:"
		syntax = int(raw_input())
	
		print "Comments:"
		comments = "'%s'" % raw_input().replace("'", "\\'")
		if comments == "''":
			comments = "NULL"
		
		if kana == '?':
			romaji = "'?'"
		else:
			romaji = "'%s'" % _romaji.getRomaji(kana.decode('utf-8')).replace("'", "\\'")
		
		cursor.execute(' '.join((
		 "INSERT INTO hymmnos",
		 "(word, meaning_english, meaning_japanese, school, kana, romaji, description, class, syllables)",
		 "VALUES (%s, %s, %s, %i, %s, %s, %s, %i, %s)",
		)), (word, english, japanese, school, kana, romaji, comments, syntax, syllables.replace(' ', '/'),))
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
		
