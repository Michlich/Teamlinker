import sqlite3
#Тут создавал базу. Оставил на случай, если переделывать придётся. Потом удалим.
conn = sqlite3.connect("login_data.db")
cursor = conn.cursor()

cursor.execute('''
CREATE TABLE IF NOT EXISTS Users(id INTEGER PRIMARY KEY, email TEXT NOT NULL, password TEXT NOT NULL)''')

conn.commit()
conn.close()