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
		word = raw_input()
		
		print "English translation:"
		meaning = raw_input()
		
		print "Japanese form:"
		japanese = raw_input()
		
		print "Kana form:"
		kana = raw_input()
		
		print "Syllables in lower-case, separated by spaces (; for E.V.):"
		syllables = None
		while True:
			syllables = raw_input()
			if syllables.replace(' ', '').lower() == word.lower():
				break
			elif syllables.endswith(";"):
				syllables = syllables[:-1]
				break
			else:
				print "Entry does not match word structure"
		syllables = syllables.replace(' ', '/')
		
		print "1) 中央正純律（共通語） | Central"
		print "2) クルトシエール律（Ⅰ紀前古代語） | Cult Ciel"
		print "3) クラスタ律（クラスタ地方語） | Cluster"
		print "4) アルファ律（オリジンスペル） | Alpha"
		print "5) 古メタファルス律（Ⅰ紀神聖語） | Metafalss"
		print "6) 新約パスタリエ（パスタリア成語） | Pastalie"
		print "7) アルファ律（オリジンスペル：EOLIA属） | Alpha (EOLIA)"
		print "0) Unknown"
		print "Dialect (add 50 to mark as unofficial):"
		dialect = int(raw_input())
		
		print "1) Emotion Verb"
		print "2) verb"
		print "3) adverb"
		print "4) noun"
		print "5) conjunction"
		print "6) preposition"
		print "7) Emotion Sound (II)"
		print "8) adjective"
		print "9) noun, verb"
		print "10) adjective, noun"
		print "11) adjective, verb"
		print "12) particle"
		print "13) Emotion Sound (III)"
		print "14) Emotion Sound (I)"
		print "15) pronoun"
		print "16) interjection"
		print "17) preposition, particle"
		print "18) language construct"
		print "19) adverb, noun"
		print "20) adjective, adverb"
		print "21) conjunction, preposition"
		print "22) particle, verb"
		print "23) adverb, particle"
		print "24) noun, prepositon"
		print "25) adverb, preposition"
		print "Syntax class:"
		syntax = int(raw_input())
		
		print "Description:"
		description = raw_input()
		if not description.strip():
			description = None
			
		if kana == '?':
			romaji = "?"
		else:
			romaji = _romaji.getRomaji(kana.decode('utf-8'))
			
		cursor.execute(' '.join((
		 "INSERT INTO hymmnos",
		 "(word, meaning, japanese, dialect, kana, romaji, description, class, syllables)",
		 "VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
		)), (word, meaning, japanese, dialect, kana, romaji, description, syntax, syllables,))
		db_con.commit()
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
		
