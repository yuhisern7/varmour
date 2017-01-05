#!/usr/bin/env python
# -*- coding: utf-8 -*-
import MySQLdb as mdb

def createUser():
    con = mdb.connect('localhost', 'root', 'varmour');
    with con:
        cursor = con.cursor()
        print "You are creating a user for this MySQL. Fill in the corresponding inputs that you want your user to have."
        name = raw_input("Name: ")
        server = raw_input("Server (Can use \'localhost\'): ")
        password = raw_input("Password: ")
        statement = "CREATE USER " + "'" + name + "'" + "@" + "'" + server + "'" +" IDENTIFIED BY " + "'" + password + "'"
        cursor.execute(statement)
        cursor.execute("SHOW DATABASES")
        for db in cursor.fetchall():
            print db
        database = raw_input("Which database do you want to have access to? (Type \"done\" when you are done): ")
        while database.strip() != 'done':
            cursor.execute("GRANT ALL ON " + database + ".* TO " + "'" + name + "'" + "@" + "'" + server + "'")
            database = raw_input("Which database do you want to have access to? (Type \"done\" when you are done): ")
    cursor.close()
    con.close()

#allows for creation of database(same as below)
def createDatabase():
    con = mdb.connect('localhost', 'root', 'varmour');
    with con:
        cursor = con.cursor()
        print "You are creating a database for this MySQL. Fill in the corresponding inputs that you want your database to have."
        database = raw_input("Name: ")
        cursor.execute("DROP DATABASE IF EXISTS " + database)
        cursor.execute("CREATE DATABASE " + database)
        cursor.execute("SELECT USER FROM mysql.user")
        for db in cursor.fetchall():
            print db
        user = raw_input("Which users do you want to have access to this database? (Type \"done\" when you are done): ")
        if user.strip() != 'done':
            server = raw_input("Server (Can use \'localhost\'): ")
            while user.strip() != 'done':
                cursor.execute("GRANT ALL ON " + database + ".* TO " + "'" + user + "'" + "@" + "'" + server + "'")
                user = raw_input("Which users do you want to have access to this database? (Type \"done\" when you are done): ")
                if user.strip() != 'done':
                    server = raw_input("Server (Can use \'localhost\'): ")
    cursor.close()
    con.close()

#allows for creation of tables(name, password, address, database) and data
def createTable(server, name, password, database):
    con = mdb.connect(server, name, password, database);
    with con:
        cursor = con.cursor()
        print "You are creating a table for this MySQL. Fill in the corresponding inputs that you want your table to have."
        table = raw_input("Name: ")
        cursor.execute("DROP TABLE IF EXISTS " + table)
        cursor.execute("CREATE TABLE " + table + "(Name VARCHAR(255), Type VARCHAR(255), Address VARCHAR(255))")
        files = raw_input("Do you have a file? (If yes, input your file name else type \'n\'): ")
        if files.strip() != 'n':
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
        else:
            ids = raw_input("Add name of address (Type \"done\" when you are done):  ")
            if ids.strip() != 'done':
                types = raw_input("Type of address: ")
                address = raw_input("Address: ")
                while ids.strip() != 'done':
                    cursor.execute("INSERT INTO " + table + "(Name, Type, Address) VALUES (" + "'" + ids + "'" + "," + "'" + types + "'" + "," + "'" + address + "'" + ")")
                    ids = raw_input("Add name of address (Type \"done\" when you are done):  ")
                    if ids.strip() != 'done':
                        types = raw_input("Type of address: ")
                        address = raw_input("Address: ")
    cursor.close()
    con.close()

#allow inserting data in database
def insertData(server, name, password, database):
    con = mdb.connect(server, name, password, database);
    with con:
        cursor = con.cursor()
        cursor.execute("USE " + database)
        cursor.execute("SHOW TABLES")
        for tables in cursor.fetchall():
            print tables
        table = raw_input("Which table do you want to input data into?: ")
        files = raw_input("Do you have a file? (If yes, input your file name else type \'n\'): ")
        if files.strip() != 'n':
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
        else:
            ids = raw_input("Add name of address (Type \"done\" when you are done):  ")
            if ids.strip() != 'done':
                types = raw_input("Type of address: ")
                address = raw_input("Address: ")
                while ids.strip() != 'done':
                    cursor.execute("INSERT INTO " + table + "(Name, Type, Address) VALUES (" + "'" + ids + "'" + "," + "'" + types + "'" + "," + "'" + address + "'" + ")")
                    ids = raw_input("Add name of address (Type \"done\" when you are done):  ")
                    if ids.strip() != 'done':
                        types = raw_input("Type of address: ")
                        address = raw_input("Address: ")
    cursor.close()
    con.close()

#allow user to see MySQL
def seeMySQL(item):
    con = mdb.connect('localhost', 'root', 'varmour');
    with con:
        cursor = con.cursor()
        if item.strip() == 'user':
            cursor.execute("SELECT USER FROM mysql.user")
            for user in cursor.fetchall():
                print user
        if item.strip() == 'database':
            cursor.execute("SHOW DATABASES")
            for db in cursor.fetchall():
                print db
        if item.strip() == 'table':
            cursor.execute("SHOW DATABASES")
            for db in cursor.fetchall():
                print db
            database = raw_input("Which database do you want to see tables from?: ")
            cursor.execute("USE " + database)
            cursor.execute("SHOW TABLES")
            for tables in cursor.fetchall():
                print tables
        if item.strip() == 'info':
            cursor.execute("SHOW DATABASES")
            for db in cursor.fetchall():
                print db
            database = raw_input("Which database do you want to see info from?: ")
            cursor.execute("USE " + database)
            cursor.execute("SHOW TABLES")
            for tables in cursor.fetchall():
                print tables
            table = raw_input("Which table do you want to see info from?: ")
            cursor.execute("SELECT * FROM " + table)
            for info in cursor.fetchall():
                print info
    cursor.close()
    con.close()

#allows deletion of table, databasese, info, and users
def deleteMySQL(item):
    con = mdb.connect('localhost', 'root', 'varmour');
    with con:
        cursor = con.cursor()
        if item.strip() == 'user':
            cursor.execute("SELECT USER FROM mysql.user")
            for user in cursor.fetchall():
                print user
            users = []
            server = []
            user2 = raw_input("Which user do you want to delete? (\"done\" when done): ")
            if user2.strip() != 'done':
                servers = raw_input("Server: ")
            while user2.strip() != 'done':
                users.append(user2)
                server.append(servers)
                user2 = raw_input("Which user do you want to delete? (\"done\" when done): ")
                if user2.strip() != 'done':
                    servers = raw_input("Server: ")
            for x in xrange(len(users)):
                cursor.execute("DROP USER " + "'" + users[x] + "'" + "@" + "'" + server[x] + "'")
        if item.strip() == 'database':
            cursor.execute("SHOW DATABASES")
            for db in cursor.fetchall():
                print db
            databases = []
            database = raw_input("Which database do you want to delete? (\"done\" when done): ")
            while database.strip() != 'done':
                databases.append(database)
                database = raw_input("Which database do you want to delete? (\"done\" when done): ")
            for x in xrange(len(databases)):
                cursor.execute("DROP DATABASE " + databases[x])
        if item.strip() == 'table':
            cursor.execute("SHOW DATABASES")
            for db in cursor.fetchall():
                print db
            database = raw_input("Which database do you want to delete from?: ")
            cursor.execute("USE " + database)
            cursor.execute("SHOW TABLES")
            for tables in cursor.fetchall():
                print tables
            tables2 = []
            table = raw_input("Which table do you want to delete? (\"done\" when done): ")
            while table.strip() != 'done':
                tables2.append(table)
                table = raw_input("Which table do you want to delete? (\"done\" when done): ")
            for x in xrange(len(tables2)):
                cursor.execute("DROP TABLE " + tables2[x])
        if item.strip() == 'info':
            cursor.execute("SHOW DATABASES")
            for db in cursor.fetchall():
                print db
            database = raw_input("Which database do you want to delete from?: ")
            cursor.execute("USE " + database)
            cursor.execute("SHOW TABLES")
            for tables in cursor.fetchall():
                print tables
            table = raw_input("Which table do you want to delete from?: ")
            cursor.execute("USE " + database)
            response = raw_input("Do you want to delete the whole table or just rows? (Type whole or row): ")
            if response.strip() == 'whole':
                cursor.execute("DELETE FROM " + table)
            elif response.strip() == 'row':
                cursor.execute("USE " + database)
                cursor.execute("SELECT * FROM " + table)
                for info in cursor.fetchall():
                    print info
                rows = []
                types = raw_input("What type of data do you want to delete? (Name, Type, Address): ")
                row = raw_input("Specify which row to delete: (\"done\" when done): ")
                while row.strip() != 'done':
                    rows.append(row)
                    row = raw_input("Specify which row to delete: (\"done\" when done): ")
                for x in xrange(len(rows)):
                    cursor.execute("DELETE FROM " + table + " WHERE " + types + " = " + "'" + rows[x] + "'")
    cursor.close()
    con.close()


#User interface
question = "y"
while question.strip() == 'y':
    action = raw_input("What do you want to do? (create, delete, insert, or see): ")
    if action.strip() == 'create':
        action2 = raw_input("What do you want to create? (user, database, or table): ")
        if action2.strip() == 'user':
            createUser()
            see = raw_input("Do you want to see " + action2 + "? (y/n): ")
            if see.strip() == 'y':
                seeMySQL("user")
        if action2.strip() == 'database':
            createDatabase()
            see = raw_input("Do you want to see " + action2 + "? (y/n): ")
            if see.strip() == 'y':
                seeMySQL("database")
        if action2.strip() == 'table':
            server = raw_input("Server (Can be \"localhost\"): ")
            name = raw_input("Username: ")
            password = raw_input("Password: ")
            database = raw_input("Which database do you want to add the table to?: ")
            createTable(server, name, password, database)
            see = raw_input("Do you want to see " + action2 + "? (y/n): ")
            if see.strip() == 'y':
                seeMySQL("table")
                see = raw_input("Do you want to see the data in the table? (y/n): ")
                if see.strip() == 'y':
                    seeMySQL("info")
    elif action.strip() == 'insert':
        server = raw_input("Server (Can be \"localhost\"): ")
        name = raw_input("Username: ")
        password = raw_input("Password: ")
        database = raw_input("Which database do you want to insert data into?: ")
        insertData(server, name, password, database)
        see = raw_input("Do you want to see info in the table? (y/n): ")
        if see.strip() == 'y':
            seeMySQL("info")
    elif action.strip() == 'delete':
        delete = raw_input("What do you want to delete? (user, database, table, info): ")
        deleteMySQL(delete)
        response = raw_input("Do you want to see your changes? (y/n): ")
        if response.strip() == 'y':
            seeMySQL(delete)
    elif action.strip() == 'see':
        see = raw_input("What do you want to see? (user, database, table, info): ")
        seeMySQL(see)
    question = raw_input("Do you want to do anything else? (y/n): ")
