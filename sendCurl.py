#!/usr/bin/env python
import subprocess

def sendCurl(num, command, names, addresses):
    name = command[command.index("{") + 1:].index(":") + command.index("{") + 1
    nEnd = command[name:].index(",") + name
    address = command[name + 1:].index(":") + name + 1
    aEnd = command[address:].index(",") + address
    for x in xrange(num):
        newN = '"' + names[x] + '"'
        newA = '"' + addresses[x] + '"'
        temp = command[:name+1] + newN + command[nEnd:address+1] + newA + command[aEnd:]
        com = temp.split(" ")
        subprocess.call(com)

command = raw_input("curl command: ")
names = ["bob", "joe", "dave"]
addresses = []
for x in xrange(len(names)):
    addresses.append("1.1.1.1" + str(x))
sendCurl(len(names), command, names, addresses)