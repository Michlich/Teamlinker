import sqlite3
#тестовый файл
conn = sqlite3.connect("login_data.db")
cursor = conn.cursor()

# Создаем таблицу Users
table_mail = [x[0] for x in cursor.execute("SELECT email FROM Users").fetchall()]
print(table_mail)

conn.close()