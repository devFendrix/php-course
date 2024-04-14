<?php
/**
 * Class Car
 *
 * @TODO
 *
 */

class Car {
    private int $id;
    private string $model;
    private string $brand;
    private float $price;
    private int $nbSeat;
    private PDO $db;
    public function __construct($db, $id)
    {
        $query = $db->prepare("SELECT * FROM cars WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $car = $query->fetchObject();

        if(!$car) {
            throw new InvalidArgumentException("Voiture introuvable avec cet id");
        }

        $this->id = $id;
        $this->model = $car->model;
        $this->brand = $car->brand;
        $this->price = $car->price;
        $this->nbSeat = $car->nb_seat;
        $this->db = $db;
    }

    // @TODO

    public static function create($db, $model, $brand, $price, $nbSeat): Car
    {
        $query = $db->prepare("INSERT INTO cars (model, brand, price, nb_seat) VALUES (:model, :brand, :price, :nb_seat)");
        $query->bindValue(':model', $model);
        $query->bindValue(':brand', $brand);
        $query->bindValue(':price', $price);
        $query->bindValue(':nb_seat', $nbSeat, PDO::PARAM_INT);
        $query->execute();

        $id = $db->lastInsertId();

        return new Car($db, $id);
    }

    // @TODO
    public function delete(): void
    {
        $query = $this->db->prepare("DELETE FROM cars WHERE id = :id");
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->execute();
    }

    // @TODO
    public function update(): void
    {
        $query = $this->db->prepare("UPDATE cars SET model = :model, brand = :brand, price = :price, nb_seat = :nb_seat WHERE id = :id");
        $query->bindValue(':model', $this->model);
        $query->bindValue(':brand', $this->brand);
        $query->bindValue(':price', $this->price);
        $query->bindValue(':nb_seat', $this->nbSeat, PDO::PARAM_INT);
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->execute();
    }

    // @TODO
    public function getId()
    {
        return $this->id;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel(string $model)
    {
        $this->model = $model;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getNbSeat()
    {
        return $this->nbSeat;
    }

    public function setNbSeat(int $nbSeat)
    {
        $this->nbSeat = $nbSeat;
    }
}