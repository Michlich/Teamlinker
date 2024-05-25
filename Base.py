#!C:\Users\Anton\AppData\Local\Programs\Python\Python312\python.exe
import requests
import sqlite3
from bs4 import BeautifulSoup
import cgi, cgitb




form = cgi.FieldStorage()
response = requests.get('http://localhost/signup.html')#Получение запроса
mail = form.getvalue('mail')#Получение переменной value
pas1 = form.getvalue('pas1')
pas2 = form.getvalue('pas2')
conn = sqlite3.connect("login_data.db")#открытие базы
cursor = conn.cursor()
table_mail = [x[0] for x in cursor.execute("SELECT email FROM Users").fetchall()] # массив с id записей
if not(mail in table_mail) and pas1 == pas2:
    cursor.execute('''INSERT INTO Users (email, password) Values ("%s", "%s")''' % (mail, pas1))
    conn.commit()
    f = open("login.html", 'r', encoding="cp1251")# читаем код html из файла
    html = f.read()
    print("Content-type: text/html\n")#Выводим html-файл
    print(html)
elif mail in table_mail:
    f = open("signup.html", 'r', encoding="cp1251")  # Пока заполнитель. Сделать сообщение "Логин занят"
    html = f.read()
    print("Content-type: text/html\n")
    print(html)
else:
    f = open("signup.html", 'r', encoding="cp1251")  # Пока заполнитель. Сделать сообщение "Пароли не сходятся"
    html = f.read()
    print("Content-type: text/html\n")
    print(html)