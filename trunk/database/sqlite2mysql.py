# -*- encoding: utf-8 -*-
"""
HymmnoServer support module: sqlite2mysql

Purpose
=======
 Reads all data from an SQLite3 file and uses it to update a localized
 MySQL database, making it easy to translate the Hymmnoserver into
 different languages.
 
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
mysql_db = _db.getConnection()
mysql_cur = mysql_db.cursor()
sqlite_db = sqlite3.connect(sys.argv[1])
sqlite_cur = sqlite_db.cursor()
print "found"

try:
	print "Updating hymmnos..."
	sqlite_cur.execute("SELECT word, meaning, japanese, dialect, kana, romaji, description, class, syllables FROM hymmnos ORDER BY word ASC, dialect ASC")
	while True:
		row = sqlite_cur.fetchone()
		if not row:
			break
			
		(word, meaning, japanese, dialect, kana, romaji, description, class, syllables) = row
		mysql_cur.execute("SELECT meaning, description, japanese FROM hymmnos WHERE word = %s AND dialect = %s", (word, dialect,))
		row = mysql_cur.fetchone()
		if not row:
			print "%s : '%s'" % (word, japanese,)
			print "English: %s" % (meaning,)
			print "Description: %s" % (description,)
			
			print "New meaning:"
			meaning = raw_input()
			
			print "New description:"
			description = raw_input()
			
		elif not row[2] == japanese:
			print "%s : '%s' became '%s'" % (word, japanese, row[2],)
			print "Old meaning: %s" % (row[0],)
			print "Old description: %s" % (row[1],)
			
			print "New meaning:"
			meaning = raw_input()
			
			print "New description:"
			description = raw_input()
			
		mysql_cur.execute(
		 ' '.join((
		  "INSERT INTO hymmnos",
		  "(word, meaning, japanese, dialect, kana, romaji, description, class, syllables)",
		  "VALUES (%s, %s, %s, %i, %s, %s, %s, %i, %s)",
		  "ON DUPLICATE KEY UPDATE",
		  "meaning = %s,",
		  "japanese = %s,",
		  "kana = %s,",
		  "romaji = %s,",
		  "description = %s,",
		  "class = %i,",
		  "syllables = %s,",
		 )),
		 (
		  word, meaning, japanese, dialect, kana, romaji, description, class, syllables,
		  meaning, japanese, kana, romaji, description, class, syllables,
		 )
		)
		print
		print
	print "Optimizing hymmnos table..."
	mysql_cur.execute("OPTIMIZE LOCAL TABLE hymmnos")
	
	
	print "Rebuilding hymmnos_mapping..."
	mysql_cur.execute("DROP TABLE hymmnos_mapping")
	mysql_cur.execute(' '.join((
	 "CREATE TABLE `hymmnos_mapping` (",
	 " `source` varchar(25) NOT NULL DEFAULT '',",
	 " `destination` varchar(25) NOT NULL DEFAULT '',",
	 " `source_dialect` tinyint(3) unsigned NOT NULL,",
	 " `destination_dialect` tinyint(3) unsigned NOT NULL,",
	 " PRIMARY KEY (`source`,`destination`,`source_dialect`,`destination_dialect`),",
	 " KEY `source_idx` (`source`,`source_dialect`),",
	 " KEY `destination_idx` (`destination`,`destination_dialect`),",
	 " CONSTRAINT `source_fk` FOREIGN KEY (`source`, `source_dialect`) REFERENCES `hymmnos` (`word`, `dialect`),",
	 " CONSTRAINT `destination_fk` FOREIGN KEY (`destination`, `destination_dialect`) REFERENCES `hymmnos` (`word`, `dialect`)",
	 ") ENGINE=InnoDB DEFAULT CHARSET=utf8;",
	)))
	sqlite_cur.execute("SELECT source, destination, source_dialect, destination_dialect FROM hymmnos_mapping")
	while True:
		row = sqlite_cur.fetchone()
		if not row:
			break
			
		mysql_cur.execute(
		 ' '.join((
		  "INSERT INTO hymmnos_mapping",
		  "(source, destination, source_dialect, destination_dialect)",
		  "VALUES (%s, %s, %i, %i)",
		 )),
		 row
		)
	print "Database synchronized"
except Exception, e:
	print "Error while updating database: %s" % (str(e))
	exit()
	
mysql_cur.close()
mysql_db.close()
sqlite_cur.close()
sqlite_db.commit()
sqlite_db.close()
