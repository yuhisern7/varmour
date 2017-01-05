#!/usr/bin/env python
# -*- coding: utf-8 -*-
import MySQLdb as mdb

def createUser(user, password, server, dbaccess):
    con = mdb.connect('localhost', 'root', 'varmour');
    with con:
        cursor = con.cursor()
        statement = "CREATE USER " + "'" + user + "'" + "@" + "'" + server + "'" +" IDENTIFIED BY " + "'" + password + "'"
        cursor.execute(statement)
        if dbaccess != "":
            dbaccess2 = dbaccess.split(";")
            for x in xrange(len(dbaccess2)):     
                cursor.execute("GRANT ALL ON " + dbaccess2[x] + ".* TO " + "'" + user + "'" + "@" + "'" + server + "'")
    cursor.close()
    con.close()
    return "done"

#allows for creation of database(same as below)
def createDatabase(database, user):
    con = mdb.connect('localhost', 'root', 'varmour');
    with con:
        cursor = con.cursor()
        cursor.execute("DROP DATABASE IF EXISTS " + database)
        cursor.execute("CREATE DATABASE " + database)
        if user != "":
            user2 = user.split(";")
            for x in xrange(len(user2)):
                info = user2[x].split()
                name = info[0]
                server = info[1]
                cursor.execute("GRANT ALL ON " + database + ".* TO " + "'" + name + "'" + "@" + "'" + server + "'")
    cursor.close()
    con.close()
    return "done"

#allows for creation of tables(name, password, address, database) and data
def createTable(server, name, password, database, table):
    con = mdb.connect(server, name, password, database);
    with con:
        cursor = con.cursor()
        cursor.execute("DROP TABLE IF EXISTS " + table)
        cursor.execute("CREATE TABLE " + table + "(Name VARCHAR(255), Type VARCHAR(255), Address VARCHAR(255))")
    cursor.close()
    con.close()
    return "done"

#allow inserting data in database
def insertData(server, name, password, database, table, files, add):
    con = mdb.connect(server, name, password, database);
    with con:
        cursor = con.cursor()
        if files.strip() != '':
            data = []
            files1 = open(files)
            for line in files1:
                data.append(line)
            for x in xrange(len(data)):
                command = data[x]
                info = command.split()
                ids = info[0]
                types = info[1]
                address = info[2]
                cursor.execute("INSERT INTO " + table + "(Name, Type, Address) VALUES (" + "'" + ids + "'" + "," + "'" + types + "'" + "," + "'" + address + "'" + ")")
        elif add != '':
            add2 = add.split(";")
            for x in xrange(len(add2)):
                info = add2[x].split()
                ids = info[0]
                types = info[1]
                address = info[2]
                cursor.execute("INSERT INTO " + table + "(Name, Type, Address) VALUES (" + "'" + ids + "'" + "," + "'" + types + "'" + "," + "'" + address + "'" + ")")
    cursor.close()
    con.close()
    return "done"

#allow user to see MySQL
def seeMySQL(item, database, table):
    con = mdb.connect('localhost', 'root', 'varmour');
    with con:
        cursor = con.cursor()
        if item.strip() == 'users':
            cursor.execute("SELECT USER FROM mysql.user")
            for user in cursor.fetchall():
                print user
        if item.strip() == 'databases':
            cursor.execute("SHOW DATABASES")
            for db in cursor.fetchall():
                print db
        if item.strip() == 'tables':
            cursor.execute("USE " + database)
            cursor.execute("SHOW TABLES")
            for tables in cursor.fetchall():
                print tables
        if item.strip() == 'info':
            cursor.execute("USE " + database)
            cursor.execute("SELECT * FROM " + table)
            for info in cursor.fetchall():
                print info
    cursor.close()
    con.close()
    return "done"

#allows deletion of table, databases, info, and users
def deleteMySQL(item, info):
    con = mdb.connect('localhost', 'root', 'varmour');
    with con:
        cursor = con.cursor()
        if info != "":
            info2 = info.split(";")
            if item.strip() == 'users':
                for x in xrange(len(info2)):
                    data = info2[x].split()
                    user = data[0]
                    server = data[1]
                    cursor.execute("DROP USER " + "'" + user + "'" + "@" + "'" + server + "'")
            if item.strip() == 'databases':
                for x in xrange(len(info2)):
                    cursor.execute("DROP DATABASE " + info2[x])
            if item.strip() == 'tables':
                for x in xrange(len(info2)):
                    data = info2[x].split()
                    database = data[1]
                    table = data[0]
                    cursor.execute("USE " + database)
                    cursor.execute("DROP TABLE " + table)
            if item.strip() == 'info':
                for x in xrange(len(info2)):
                    data = info2[x].split()
                    name = data[0]
                    database = data[1]
                    table = data[2]
                    cursor.execute("USE " + database)
                    if name.strip() == 'whole':
                        cursor.execute("DELETE FROM " + table)
                    else:
                        cursor.execute("USE " + database)
                        types = "Name"
                        cursor.execute("DELETE FROM " + table + " WHERE " + types + " = " + "'" + name + "'")
    cursor.close()
    con.close()
    return "done"