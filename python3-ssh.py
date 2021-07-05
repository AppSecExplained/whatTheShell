#!/usr/bin/python3
import paramiko

host = "mango.htb"
port = 22
username = ""
password = ""

command = "whoami"

ssh = paramiko.SSHClient()
ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
ssh.connect(host, port, username, password)

stdin, stdout, stderr = ssh.exec_command(command)
lines = stdout.readlines()
print(lines)
