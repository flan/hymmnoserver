# -*- encoding: utf-8 -*-
import MySQLdb
import sqlite3
import sys

mysql_db = MySQLdb.connect(host="localhost", user="aurica", passwd="misha", db="hymmnoserver")
mysql_cur = mysql_db.cursor()
sqlite_db = sqlite3.connect(sys.argv[1])
sqlite_cur = sqlite_db.cursor()

#Assume the specified sqlite3 file doesn't exist.
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
