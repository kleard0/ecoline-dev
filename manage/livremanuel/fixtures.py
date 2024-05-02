import mysql.connector
from mysql.connector import errorcode
import random

# Connexion à la base de données
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

    def title_generation(i):
        return "Livre" + str(i)

    def book_or_manual():
        return random.randint(0, 50) <= 25

    def author_choice():
        authors = ["Kylian Leard", "Kylian Lelard", "Kylian Lezard", "Kylian Lamard", "Kylian Tetard"]
        return random.choice(authors)

    def genre_choice():
        genres = ["Sf", "Romance", "Thriller", "Fantastique", "Dramatique"]
        return random.choice(genres)

    def firstname_generation(i):
        return "Kylian" + str(i)

    def lastname_generation(i):
        return "Leard" + str(i)

    def city_generation(i):
        return "Dijon" + str(i)

    def create_books(i):
        books = [
            (barcode_generation(), title_generation(i), book_or_manual(), genre_choice(), isbn_generation(), trueorfalse(), author_choice())
            for _ in range(i)  # Note the use of _ since i is already defined
        ]
        insert_book = "INSERT INTO Books (barcode, title, is_book, genre, isbn, is_borrowed, author) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        cursor.executemany(insert_book, books)
        mydb.commit()

    def create_students(i):
        students = [
            (barcode_generation(), firstname_generation(i), lastname_generation(i), city_generation(i), random.randint(0, 5))
            for _ in range(i)  # Same as above
        ]
        insert_student = "INSERT INTO student (barcode, first_name, last_name, city, book_id) VALUES (%s, %s, %s, %s, %s)"
        cursor.executemany(insert_student, students)
        mydb.commit()

    def create_all(n):
        create_books(n)
        create_students(n)
            
    create_all(100000000000000)

    cursor.close()
    mydb.close()

except mysql.connector.Error as err:
    if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
        print("L'accès vous est refusé monsieur Kylian")
    elif err.errno == errorcode.ER_BAD_DB_ERROR:
        print("La BDD n'existe point monsieur Kylian.")
    else:
        print(err)
