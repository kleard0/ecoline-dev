import mysql.connector
from mysql.connector import errorcode
from datetime import date, timedelta
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

    genres = [
        ("Sf",),
        ("Romance",),
        ("Thriller",),
        ("Fantistique",),
        ("Dramatique",)
    ]
    insert_genre = "INSERT INTO genre (genre) VALUES (%s )"
    cursor.executemany(insert_genre, genres)
    mydb.commit()

    authors = [
        ("Kylian Leard",),
        ("Kylian Lelard",),
        ("Kylian Lezard",),
        ("Kylian Lamard",),
        ("Kylian Tetard",)
    ]
    insert_author = "INSERT INTO author (author)  VALUES (%s)"
    cursor.executemany(insert_author, authors)
    mydb.commit()

    


    def barcode_generation():
        barcode = (random.randint(10000000, 99999999),)
        return barcode
    
    def isbn_generation():
        isbn = (random.randint(1000000000000, 9999999999999),)
        return isbn
    
    def title_generation():
        for i in range(6):
            title = "Livre" + i
            return title
        
    def BookorManuel():
        result = (random.randint(0, 50),)
        if result  <= 50:
            return False
        else: return True
        
    def author_generation():
        
        
        

    books_and_textbooks = [
        (title_generation(), BookorManuel(), 1, isbn_generation(), barcode_generation(), 1),
        (title_generation(), BookorManuel(), 3, isbn_generation(), barcode_generation(), 2),
        (title_generation(), BookorManuel(), 2, isbn_generation(), barcode_generation(), 3),
        (title_generation(), BookorManuel(), 4, isbn_generation(), barcode_generation(), 4),
        (title_generation(), BookorManuel(), 5, isbn_generation(), barcode_generation(), 5)
    ]
    insert_book = "INSERT INTO BookorTextbook (title, books, textbook, genre_id, isbn, barcode, author_id) VALUES (%s, %s, %s, %s, %s, %s, %s)"
    cursor.executemany(insert_book, books_and_textbooks)
    mydb.commit()

 
    users = [
        ("Kylian", "Leard", "Fleurey-sur-Ouche", "0754329309", "kylian.leardpro@gmail.com", date(2004, 7, 22), random.choice(barcodes)[0], 1),
        ("Armand", "Jurkowski", "Dijon", "0102030405", "arman.jrk@gmail.com", date(2004, 4, 8), random.choice(barcodes)[0], 5)
    ]
    insert_user = "INSERT INTO users (first_name, last_name, city, mobile_number, email, birthdate, barcode, BookorTextbook_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)"
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


