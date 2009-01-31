import MySQLdb

def getConnection():
	_db_con = MySQLdb.connect(
	 host="localhost", user="username", passwd="password", db="database")
