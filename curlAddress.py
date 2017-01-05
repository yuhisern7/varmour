#!/usr/bin/env python
# -*- coding: utf-8 -*-
import MySQLdb as mdb
import subprocess

def split(command):
    com = command[:command.index("'") - 1].split(" ")
    com.append(command[command.index("'")+1:command[command.index("'"):].index("-") + command.index("'") - 2])
    com = com + command[command.index("-X"):].split(" ")
    return com

def getAddress(server, response):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    if response.strip() == 'address':
        command = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X GET https://" + server + "/api/v0.9/config/address"
        com = split(command)
        subprocess.call(com)
    if response.strip() == 'address_group':
        command = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X GET https://" + server + "/api/v0.9/config/address_group"
        com = split(command)
        subprocess.call(com)
    return "done"

def addAddress(server, data):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    data2 = data.split(";")
    for x in xrange(len(data2)):
        info = data2[x].split()
        name = info[0]
        types = info[1]
        address = info[2]
        types1 = types
        if types.strip() == 'mac-address':
            types1 = "mac"
        if types.strip() == 'hostname':
            types1 = "fqdn"
        command2 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/config/address/" + name + " -d '{\"name\":" + '"' + name + '"' + "," + '"' + types1 + '"' + ":" + '"' + address + '"' +",\"type\":" + '"' + types + '"' + "}'"
        subprocess.call(command2, shell=True)
    command3 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/commit"
    com = split(command3)
    subprocess.call(com)
    return "done"

def addAddressMySQL(server, MySQLserver, name, password, database, table):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    con = mdb.connect(MySQLserver, name, password, database);
    with con:
        cursor = con.cursor()
        cursor.execute("SELECT * FROM " + table)
        for info in cursor.fetchall():
            name = info[0]
            types = info[1]
            address = info[2]
            types1 = types
            if types.strip() == 'mac-address':
                types1 = "mac"
            if types.strip() == 'hostname':
                types1 = "fqdn"
            command2 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/config/address/" + name + " -d '{\"name\":" + '"' + name + '"' + "," + '"' + types1 + '"' + ":" + '"' + address + '"' +",\"type\":" + '"' + types + '"' + "}'"
            subprocess.call(command2, shell=True)
    command3 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/commit"
    com = split(command3)
    subprocess.call(com)
    cursor.close()
    con.close()
    return "done"

def deleteAddress(server, names):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    names2 = names.split(";")
    for x in xrange(len(names2)):
        command2 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X DELETE https://" + server + "/api/v0.9/config/address/" + names2[x] + " -d '{\"name\":" + '"' + names2[x] + '"' "}'"
        com = split(command2)
        subprocess.call(com)
    command3 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/commit"
    com = split(command3)
    subprocess.call(com)
    return "done"

def changeAddress(server, name, types, address):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    types1 = types
    if types.strip() == 'mac-address':
        types1 = "mac"
    if types.strip() == 'hostname':
        types1 = "fqdn"
    command2 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X PUT https://" + server + "/api/v0.9/config/address/" + name + " -d '{\"name\":" + '"' + name + '"' + "," +'"' + types1 + '"' +  ":" + '"' + address + '"' + ",\"type\":" + '"' + types + '"' + "}'"
    subprocess.call(command2, shell=True)
    command3 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/commit"
    com = split(command3)
    subprocess.call(com)
    return "done"