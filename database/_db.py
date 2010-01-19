import MySQLdb

def getConnection():
	return MySQLdb.connect(
	 host="localhost", db="database",
	 user="username", passwd="password"
	)
	
