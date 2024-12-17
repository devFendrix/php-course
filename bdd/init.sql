CREATE DATABASE IF NOT EXISTS php_course;

USE php_course;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    username VARCHAR(255)
);

INSERT INTO users (firstname, lastname, username)
VALUES ('John', 'Dupont', 'jd96'),
       ('Pierre', 'Mendez', 'pm96');

CREATE TABLE IF NOT EXISTS apartments (
    id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nb_room INT(11) NOT NULL,
    price DECIMAL(8,2),
    address_label VARCHAR(255) NOT NULL,
    furnished TINYINT(1) DEFAULT 0
);