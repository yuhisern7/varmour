#!/usr/bin/env python
# -*- coding: utf-8 -*-
import MySQLdb as mdb

server = "localhost"
name = "testuser"
password = "test623"
database = "testdb"
con = mdb.connect(server, name, password, database);

with con:

    cur = con.cursor()
    cur.execute("DROP TABLE IF EXISTS Writers")
    cur.execute("CREATE TABLE Writers(Id INT PRIMARY KEY AUTO_INCREMENT, \
                 Name VARCHAR(25))")
    cur.execute("INSERT INTO Writers(Name) VALUES('Jack BIO')")
    cur.execute("SELECT * FROM Writers")
