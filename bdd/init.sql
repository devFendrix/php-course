    CREATE TABLE client(
        id INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
        firstname VARCHAR(255),
        lastname VARCHAR(255)
    );

    CREATE TABLE commande (
        id INT(11)AUTO_INCREMENT PRIMARY KEY NOT NULL,
        commande_id INT (11) NOT NULL,
        price DECIMAL (8,2),
        FOREIGN KEY (commande_id) REFERENCES client(id)
    );

    INSERT INTO client (firstname,lastname) VALUES ('coco', 'lala');

    INSERT INTO commande (commande_id, price) VALUES ('78936437203', ('20,4€'));
