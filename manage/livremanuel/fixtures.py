import mysql.connector
from mysql.connector import errorcode
import random

try:
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="ecoline_livremanuel"
    )
    cursor = mydb.cursor()

    def trueorfalse():
        return random.choice([True, False])
        
    def barcode_generation():
        return random.randint(10000000, 99999999)
    
    def isbn_generation():
        return random.randint(1000000000000, 9999999999999)
    
    def title_generation(index):
        return "Livre" + str(index)
        
    def genre_choice():
        genres = ["Sf", "Romance", "Thriller", "Fantistique", "Dramatique"]
        return random.choice(genres)

    def author_choice():
        authors = ["Kylian Leard", "Kylian Lelard", "Kylian Lezard", "Kylian Lamard", "Kylian Tetard"]
        return random.choice(authors)

    books_and_textbooks = [
        (barcode_generation(), title_generation(i), trueorfalse(), genre_choice(), isbn_generation(), trueorfalse(), author_choice())
        for i in range(6)
    ]

    insert_book = "INSERT INTO Books(barcode, title, is_book, genre, isbn, is_borrowed, author) VALUES (%s, %s, %s, %s, %s, %s, %s)"
    cursor.executemany(insert_book, books_and_textbooks)
    mydb.commit()
    
    def barcode_generation():
        return random.randint(10000000, 99999999)

    def firstname_generation():
        first_names = ["Kylian" + str(i) for i in range(6)]
        return random.choice(first_names)

    def lastname_generation():
        last_names = ["Kylian" + str(i) for i in range(6)]
        return random.choice(last_names)

    def city_generation():
        cities = ["Dijon" + str(i) for i in range(6)]
        return random.choice(cities)

    users = [
        (barcode_generation(), firstname_generation(), lastname_generation(), city_generation(), random.randint(0, 5))
        for _ in range(6)  
    ]

    insert_user = "INSERT INTO student (barcode, first_name, last_name, city, book_id) VALUES (%s, %s, %s, %s, %s)"
    cursor.executemany(insert_user, users)
    mydb.commit()

    cursor.close()
    mydb.close()

except mysql.connector.Error as err:
    if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
        print("L'accès vous est refusé monsieur Kylian")
    elif err.errno == errorcode.ER_BAD_DB_ERROR:
        print("La BDD n'existe point monsieur Kylian.")
    else:
        print(err)