<?php
/**
 * Class User
 * Creation d'une classe user qui prend en compte  parametres
 *
 *
 */

class User {
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $username;
    private PDO $db;
    public function __construct($db, $id)
    {
        $query = $db->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindValue(":id", $id);
        $query->execute(['id' => $id]);

        $user = $query->fetchObject();

        if(!$user) {
            throw new InvalidArgumentException("Pas d'user avec cet id");
        }

        $this->id = $id;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->username = $user->username;
        $this->db = $db;
    }
    public static function create($db, $firstname, $lastname, $username): User
    {
        $query = $db->prepare("INSERT INTO users (firstname, lastname, username) VALUES (:firstname, :lastname, :username)");
        $query->bindValue(':firstname', $firstname);
        $query->bindValue(':lastname', $lastname);
        $query->bindValue(':username', $username);
        $query->execute();

        $id = $db->lastInsertId();

        return new User($db, $id);
    }

    public function delete(): void
    {
        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $query->bindValue(":id", $this->id);
        $query->execute();
    }

    public function update($firstname, $lastname, $username): void
    {
        $query = $this->db->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, username = :username WHERE id = :id");
        $query->bindValue(":firstname", $firstname);
        $query->bindValue(":lastname", $lastname);
        $query->bindValue(":username", $username);
        $query->bindValue(":id", $this->id);
        $query->execute();

    }
    // getter/setter
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }
    public function getLastname(): string
    {
        return $this->lastname;
    }
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username)
    {
        $this->username = $username;
    }


    //fin
}