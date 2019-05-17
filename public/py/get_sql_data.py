import MySQLdb
import csv

c = MySQLdb.connect(host="127.0.0.1", user="root", passwd="0000", db="dbproject2019")
cursor = c.cursor()

SQL = "SELECT * FROM rank"
cursor.execute(SQL)

rank_data = cursor.fetchall()

with open('rank_data.csv', 'w', newline='') as f:
    writer = csv.writer(f)
    writer.writerow(['user_id','food_id','rank'])
    for r in rank_data:
        writer.writerow([r[2],r[1],r[3]])

cursor.close()
c.close()
f.close()