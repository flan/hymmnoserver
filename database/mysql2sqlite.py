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
 the Creative Commons Attribution-Noncommercial-Share Alike 3.0 License,
 which is provided in license.README.
 
 (C) Neil Tallim, 2009
"""
import MySQLdb
import os
import sqlite3
import sys

#Kill the existing SQLite file, if any.
if os.path.exists(sys.argv[1]):
	os.remove(sys.argv[1])
	
mysql_db = MySQLdb.connect(host="localhost", user="username", passwd="password", db="database")
mysql_cur = mysql_db.cursor()
sqlite_db = sqlite3.connect(sys.argv[1])
sqlite_cur = sqlite_db.cursor()

sqlite_cur.execute("""
 CREATE TABLE hymmnos (
  word TEXT,
  dialect INTEGER,
  class INTEGER,
  meaning_english TEXT,
  meaning_japanese TEXT,
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

mysql_cur.execute("SELECT * FROM hymmnos ORDER BY word ASC")
for (word, meaning_english, meaning_japanese, dialect, kana, romaji, description, syntax_class, syllables) in mysql_cur.fetchall():
	sqlite_cur.execute(
	 u"INSERT INTO hymmnos VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
	 (word.decode('utf-8'), dialect, syntax_class, meaning_english.decode('utf-8'), meaning_japanese.decode('utf-8'), kana.decode('utf-8'), romaji.decode('utf-8'), description and description.decode('utf-8'), syllables.decode('utf-8'))
	)
	
mysql_cur.execute("SELECT * FROM hymmnos_mapping ORDER BY source ASC, destination ASC")
for (source, destination, source_dialect, destination_dialect) in mysql_cur.fetchall():
	sqlite_cur.execute(
	 u"INSERT INTO hymmnos_mapping VALUES (?, ?, ?, ?)",
	 (source.decode('utf-8'), destination.decode('utf-8'), source_dialect, destination_dialect)
	)
	
mysql_cur.close()
mysql_db.close()
sqlite_cur.close()
sqlite_db.commit()
sqlite_db.close()
