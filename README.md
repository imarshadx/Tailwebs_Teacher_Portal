Use the following SQL queries to set up a database with a default username 'admin' and password 'admin':

CREATE DATABASE tailwebs_php;

USE tailwebs_php;

CREATE TABLE teachers (
    id INT(11) PRIMARY KEY,
    username VARCHAR(200),
    password VARCHAR(200)
);

INSERT INTO teachers (id, username, password)
VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

CREATE TABLE students (
    id INT(11) PRIMARY KEY,
    name VARCHAR(100),
    subject VARCHAR(100),
    marks VARCHAR(100),
    timestamp INT(50)
);

Update database details in database.php file inside root folder.
