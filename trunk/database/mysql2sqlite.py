# -*- encoding: utf-8 -*-
"""
HymmnoServer support module: mysql2sqlite

Purpose
=======
 Reads all data from the MySQL database and dumps it into an SQLite3 file,
 making it possible to use the content without being tethered to a server.
 
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
import os
import sqlite3
import sys

import _db

print "SQLite database expected as first argument...",
#Kill the existing SQLite file, if any.
if os.path.exists(sys.argv[1]):
	os.remove(sys.argv[1])
	
mysql_db = _db.getConnection()
mysql_cur = mysql_db.cursor()
sqlite_db = sqlite3.connect(sys.argv[1])
sqlite_cur = sqlite_db.cursor()
print "found"

sqlite_cur.execute("""
 CREATE TABLE hymmnos (
  word TEXT,
  dialect INTEGER,
  class INTEGER,
  meaning TEXT,
  japanese TEXT,
  kana TEXT,
  romaji TEXT,
  description TEXT,
  syllables TEXT
 )
""")
sqlite_cur.execute("""
 CREATE TABLE hymmnos_mapping (
  source TEXT,
  destination TEXT,
  source_dialect INTEGER,
  destination_dialect INTEGER
 )
""")

try:
	mysql_cur.execute("SELECT word, meaning, japanese, dialect, kana, romaji, description, class, syllables FROM hymmnos ORDER BY word ASC")
	for (word, meaning, japanese, dialect, kana, romaji, description, syntax_class, syllables) in mysql_cur.fetchall():
		sqlite_cur.execute(
		 u"INSERT INTO hymmnos (word, dialect, class, meaning, japanese, kana, romaji, description, syllables) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
		 (word.decode('utf-8'), dialect, syntax_class, meaning.decode('utf-8'), japanese.decode('utf-8'), kana.decode('utf-8'), romaji.decode('utf-8'), description and description.decode('utf-8'), syllables.decode('utf-8'))
		)
except:
	print "Error while populating SQLite database (hymmnos)"
	print "Word responsible: %s:%i" % (word, dialect)
	exit()
	
try:
	mysql_cur.execute("SELECT source, destination, source_dialect, destination_dialect FROM hymmnos_mapping ORDER BY source ASC, source_dialect ASC, destination ASC, destination_dialect ASC")
	for (source, destination, source_dialect, destination_dialect) in mysql_cur.fetchall():
		sqlite_cur.execute(
		 u"INSERT INTO hymmnos_mapping (source, destination, source_dialect, destination_dialect) VALUES (?, ?, ?, ?)",
		 (source.decode('utf-8'), destination.decode('utf-8'), source_dialect, destination_dialect)
		)
except:
	print "Error while populating SQLite database (hymmnos_mapping)"
	print "Mapping: %s:%i <-> %s:%i" % (source, source_dialect, destination, destination_dialect)
	exit()
	
mysql_cur.close()
mysql_db.close()
sqlite_cur.close()
sqlite_db.commit()
sqlite_db.close()
