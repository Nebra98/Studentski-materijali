Web aplikacija, koja pruža portal za objavljivanje studentskih materijala za učenje.

1. Što je potrebno: 
    - instaliran lokalni server npr. xampp
    - instaliran phpadminpanel (mysql)
    
2. Pokrenuti komandu: git clone https://github.com/Nebra98/elektronicko_poslovanje.git , ili Download ZIP
    
3. Nakon što ste preuzeli datoteku, potrebno je da se navigirate u nju preko terminala ili cmd-a
 
4. Nakon što ste se navigirali potrebno je pokrenuti komandu: composer install, composer update

5. Pokrenuti komandu: cp .env.example .env 

6. Napraviti novu bazu podataka u phpmyadmin (npr. ime: ep)

7. U .env fileu podesiti parametre za spajanje s bazom podataka: 
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=ime_baze_podataka
    - DB_USERNAME=root
    - DB_PASSWORD=
            
8. Pokrenuti komandu: php artisan key:generate 

9. Pokrenuti komandu: php artisan storage:link

9. File baze podataka (ep.sql) koji se nalazi u folderu potrebno je importati u novonapravljenoj bazi podataka u phpmyadmin panelu
 
10. Pokrenuti lokalni server

Podaci za logiranje kao admin user su:
- email: admin@admin.com
- pass: password

