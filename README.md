To install the mini math application you must first have docker installed on your device and nodejs for running cypress.
You will need to download this repository folder and then extract the files, you should end up with a my_project folder and inside that folder you will see the cypress folder, the web folder and some config files.
The my_project folder needs to be placed in the c drive in your users folder and into your own personal folder, the path should look like this C:\Users\(this is different for every person, whatever the name is of your prsonal folder)
open up the command prompt and use the path mention above, then execute this command, docker-compose up --build -d this will build the docker containers, the web server and the MySQL database.
http://localhost:8091/index.php?route=/sql&db=database_name&table=users&pos=0 (the address of the php myadmin, username = db_minimath password = db_group5)    http://localhost:8080/index.html (address of the website).
log into php myadmin and use the sql statement to create the users table  

CREATE TABLE users ( 

    id INT AUTO_INCREMENT PRIMARY KEY, 

    username VARCHAR(50) NOT NULL, 

    email VARCHAR(100) NOT NULL, 

    password VARCHAR(255) NOT NULL, 

    subscribed BOOLEAN NOT NULL DEFAULT FALSE 

); 
use the  http://localhost:8080/index.html to visit the site
