# -*- coding: utf-8 -*-
"""
Hymmnoserver package: secure

Purpose
=======
 Centralizes modules needed for database access.
 
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

import inspect
import os
import sqlite3

def getConnection():
    db_dir = os.path.dirname(os.path.abspath(inspect.getfile(inspect.currentframe())))
    return sqlite3.connect(os.path.join(db_dir, 'hymmnos.sqlite3'))
