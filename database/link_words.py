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
 
 (C) Neil Tallim, 2009-2021
"""
from . import db

db_con = db.getConnection()
cursor = db_con.cursor()
try:
    while True:
        print("First word:")
        word_1 = input()
        
        print("First dialect:")
        dialect_1 = int(input())
        
        print("Second word:")
        word_2 = input()
        
        print ("Second dialect:")
        dialect_2 = int(input())
        
        
        cursor.executemany(
            ' '.join((
                "INSERT INTO hymmnos_mapping",
                "(source, destination, source_dialect, destination_dialect)",
                "VALUES (?, ?, ?, ?)",
            )),
            (word_1, word_2, dialect_1, dialect_2,),
            (word_2, word_1, dialect_2, dialect_1,),
        )
        db_con.commit()
        print()
finally:
    try:
        cursor.close()
    except:
        pass
    try:
        db_con.close()
    except:
        pass
        
