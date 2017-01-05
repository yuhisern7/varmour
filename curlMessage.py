#!/usr/bin/env python
# -*- coding: utf-8 -*-
import MySQLdb as mdb
import subprocess
import random

def split(command):
    com = command[:command.index("'") - 1].split(" ")
    com.append(command[command.index("'")+1:command[command.index("'"):].index("-") + command.index("'") - 2])
    com = com + command[command.index("-X"):].split(" ")
    return com

def getAddress(server):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    response = raw_input("Do you want to see address or address-groups? (Type \"address\" or \"address_group\"): ")
    if response.strip() == 'address':
        command = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X GET https://" + server + "/api/v0.9/config/address"
        com = split(command)
        subprocess.call(com)
    if response.strip() == 'address_group':
        command = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X GET https://" + server + "/api/v0.9/config/address_group"
        com = split(command)
        subprocess.call(com)

def addAddress(num, server, names, addresses, types):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    types1 = types
    if types.strip() == 'mac-address':
        types1 = "mac"
    if types.strip() == 'hostname':
        types1 = "fqdn"
    for x in xrange(num):
        command2 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/config/address/" + names[x] + " -d '{\"name\":" + '"' + names[x]+ '"' + "," + '"' + types1 + '"' + ":" + '"' + addresses[x] + '"' +",\"type\":" + '"' + types + '"' + "}'"
        subprocess.call(command2, shell=True)
    command3 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/commit"
    com = split(command3)
    subprocess.call(com)

def addAddressFile(server, files):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    data = []
    for line in files:
        data.append(line)
    for x in xrange(len(data)):
        command = data[x]
        info = command.split()
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

def addAddressMySQL(server, MySQLserver, name, password, database):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    con = mdb.connect(MySQLserver, name, password, database);
    with con:
        cursor = con.cursor()
        table = raw_input("Which table do you want to add to server?: ")
        cursor.execute("SELECT * FROM " + table)
        for info in cursor.fetchall():
            data = str(info).replace("'","").strip('()').split(", ")
            print data
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

def deleteAddress(num, server, names):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    for x in xrange(num):
        command2 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X DELETE https://" + server + "/api/v0.9/config/address/" + names[x] + " -d '{\"name\":" + '"' + names[x] + '"' "}'"
        com = split(command2)
        subprocess.call(com)
    command3 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/commit"
    com = split(command3)
    subprocess.call(com)

def deleteAddressFile(server, files):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    data = []
    for line in files:
        data.append(line)
    names = []
    response = raw_input("What name do you not want to delete? (Type \"done\" when you are done): ")
    names.append(response)
    while response.strip() != 'done':
        response = raw_input("What name do you not want to delete? (Type \"done\" when you are done): ")
        names.append(response)
    for x in xrange(len(data)):
        command = data[x]
        info = command.split()
        name = info[0]
        canDelete = True
        for y in xrange(len(names)):
            if name == names[y]:
                canDelete = False
        if canDelete:
            command2 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X DELETE https://" + server + "/api/v0.9/config/address/" + name + " -d '{\"name\":" + '"' + name + '"' "}'"
            com = split(command2)
            subprocess.call(com)
        command3 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/commit"
        com = split(command3)
        subprocess.call(com)

def changeAddress(server, name, types):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    types1 = types
    if types.strip() == 'mac-address':
        types1 = "mac"
    if types.strip() == 'hostname':
        types1 = "fqdn"
    address = raw_input("What is the new address?: ")
    mistake = raw_input("Is this the correct address (" + address + "? (y/n): ")
    while mistake.strip() == 'n':
        address = raw_input("What is the new address?: ")
        mistake = raw_input("Is this the correct address (" + address + "? (y/n): ")
    command2 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X PUT https://" + server + "/api/v0.9/config/address/" + name + " -d '{\"name\":" + '"' + name + '"' + "," +'"' + types1 + '"' +  ":" + '"' + address + '"' + ",\"type\":" + '"' + types + '"' + "}'"
    subprocess.call(command2, shell=True)
    command3 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/commit"
    com = split(command3)
    subprocess.call(com)

def changeAddressFile(server, files):
    command1 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/auth"
    com = split(command1)
    subprocess.call(com)
    data = []
    for line in files:
        data.append(line)
    response = raw_input("What name do you not want to change? (Type \"done\" when you are done): ")
    while response.strip() != 'done':
        response = raw_input("What name do you not want to change? (Type \"done\" when you are done): ")
    for x in xrange(len(data)):
        command = data[x]
        info = command.split()
        name = info[0]
        types = info[1]
        types1 = types
        if types.strip() == 'mac-address':
            types1 = "mac"
        if types.strip() == 'hostname':
            types1 = "fqdn"
        canChange = True
        for y in xrange(len(names)):
            if name == names[y]:
                canChange = False
        if canChange:
            address = raw_input("What is the new address?: ")
            mistake = raw_input("Is this the correct address (" + address + "? (y/n): ")
            while mistake.strip() == 'n':
                address = raw_input("What is the new address?: ")
                mistake = raw_input("Is this the correct address (" + address + "? (y/n): ")
            command2 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X PUT https://" + server + "/api/v0.9/config/address/" + name + " -d '{\"name\":" + '"' + name + '"' + "," +'"' + types1 + '"' +  ":" + '"' + address + '"' + ",\"type\":" + '"' + types + '"' + "}'"
            subprocess.call(command2, shell=True)
    command3 = "curl -v --insecure -H 'Authorization: Basic dmFybW91cjp2YXJtb3Vy' -X POST https://" + server + "/api/v0.9/commit"
    com = split(command3)
    subprocess.call(com)

question = "y"
server = raw_input("Server: ")
while question.strip() == 'y':
    names = []
    response = raw_input("Do you want to add, delete, change, or see addresses: ")
    if response.strip() == 'add':
        files = raw_input("Do you have a file with addresses? (y/n): ")
        if files.strip() == 'y':
            mysql = raw_input("Is it stored in a MySQL database? (y/n): ")
            if mysql.strip() == 'y':
                mySQLserver = raw_input("Server (Can be \"localhost\"): ")
                user = raw_input("Username: ")
                password = raw_input("Password: ")
                database = raw_input("What is the database called?: ")
                addAddressMySQL(server, mySQLserver, user, password, database)
            elif mysql.strip() == 'n':
                f = open(raw_input("What is the filename?: "))
                addAddressFile(server, f)
        if files.strip() == 'n':
            name = raw_input("What is the name of address you want to add to the server? (type \"done\" when you are done): ")
            while name.strip() != 'done':
                names.append(name)
                name = raw_input("What is the name of address you want to add to the server? (type \"done\" when you are done): ")
            addresses = []
            types = raw_input("What type of address are you adding? ")
            if types.strip() == 'ipv4':
                response4 = raw_input("Do you want random addresses? (y/n): ")
                if response4.strip() == 'y':
                    address = raw_input("Address (Format 0.0.0.0/0): ")
                    for x in xrange(len(names)):
                        addresses.append(address + str(x))
                elif response4.strip() == 'n':
                    for x in xrange(len(names)):
                        address = raw_input("Address (Format 0.0.0.0/00): ")
                        mistake = raw_input("Is this the correct address (" + address + "? (y/n): ")
                        while mistake.strip() == 'n':
                            address = raw_input("What is the new address? (Format 0.0.0.0/00): ")
                            mistake = raw_input("Is this the correct address (" + address + "? (y/n): ")
                        addresses.append(address)
            if types.strip() == 'mac-address':
                response4 = raw_input("Do you want random addresses? (y/n): ")
                if response4.strip() == 'y':
                    for x in xrange(len(names)):
                        address = [ 0x00, 0x24, 0x81, random.randint(0x00, 0x7f), random.randint(0x00, 0xff), random.randint(0x00, 0xff) ]
                        address = ':'.join(map(lambda x: "%02x" % x, address))
                        addresses.append(address)
                elif response4.strip() == 'n':
                    for x in xrange(len(names)):
                        address = raw_input("Address (Format 0:0:0:0:0:0): ")
                        mistake = raw_input("Is this the correct address (" + address + "? (y/n): ")
                        while mistake.strip() == 'n':
                            address = raw_input("What is the new address? (Format 0:0:0:0:0:0): ")
                            mistake = raw_input("Is this the correct address (" + address + "? (y/n): ")
                        addresses.append(address)
            if types.strip() == 'hostname':
                for x in xrange(len(names)):
                    address = raw_input("Address: ")
                    addresses.append(address)
            addAddress(len(names), server, names, addresses, types)
        response2 = raw_input("Do you want to see the addresses? (y/n): ")
        if response2.strip() == 'y':
            getAddress(server)
    if response.strip() == 'delete':
        files = raw_input("Do you have a file with addresses? (y/n): ")
        if files.strip() == 'y':
            f = open(raw_input("What is the filename?: "))
            deleteAddressFile(server, f)
        if files.strip() == 'n':
            name = raw_input("What is the name of address you want to delete from the server? (type \"done\" when you are done): ")
            while name.strip() != 'done':
                names.append(name)
                name = raw_input("What is the name of address you want to delete from the server? (type \"done\" when you are done): ")
            deleteAddress(len(names), server, names)
            response2 = raw_input("Do you want to see the addresses? (y/n): ")
            if response2.strip() == 'y':
                getAddress(server)
    if response.strip() == 'change':
        files = raw_input("Do you have a file with addresses? (y/n): ")
        if files.strip() == 'y':
            f = open(raw_input("What is the filename?: "))
            changeAddressFile(server, f)
        if files.strip() == 'n':
            name = raw_input("What is the name of the address you want to change?: ")
            types = raw_input("What type of address is it?: ")
            changeAddress(server, name, types)
            response1 = raw_input("Do you want to change anything else? (y/n): ")
            while response1.strip() == 'y':
                name = raw_input("What is the name of the address you want to change?: ")
                types = raw_input("What type of address is it?: ")
                changeAddress(server, name, types)
                response1 = raw_input("Do you want to change anything else? (y/n): ")
            response2 = raw_input("Do you want to see the addresses? (y/n): ")
            if response2.strip() == 'y':
                getAddress(server)
    if response.strip() == 'see':
        getAddress(server)
    question = raw_input("Do you want to do anything else? (y/n):  ")
    if question.strip() == 'y':
        response3 = raw_input("Do you want to change servers? (y/n): ")
        if response3.strip() == 'y':
            server = raw_input("Server: ")

