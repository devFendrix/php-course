<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', "1024M");
ini_set('max_execution_time', 600);

require './config/database.php';
require './entities/Car.php';
require './entities/User.php';

$db = connect();

// Insertion dans la base de données
if(isset($_POST['insert-car'])) {
    Car::create(
        db: $db,
        model: $_POST['model'],
        brand: $_POST['brand'],
        price: $_POST['price'],
        nbSeat: $_POST['nb_seat'],
        ownerId: $_POST['owners']
    );
}

// Suppression d'une entrée dans la base de données
if(isset($_POST['delete-car'])){
    $car = new Car(db: $db, id: $_POST['id-car']);
    $car->delete();
}

// Mise à jour d'une entrée dans la base de données
if(isset($_POST['update-car'])){
    $car = new Car(db: $db, id: $_POST['id-car']);
    $car->setModel($_POST['model']);
    $car->setBrand($_POST['brand']);
    $car->setPrice($_POST['price']);
    $car->setNbSeat($_POST['nb_seat']);
    $car->update();
}

// Récupération des cars
$query = $db->prepare("SELECT id, model, brand, price, nb_seat, owner_id FROM cars");
$query->execute();
$cars = $query->fetchAll(PDO::FETCH_OBJ);

// Récupération des clients
$query = $db->prepare("SELECT id, firstname, lastname FROM users");
$query->execute();
$customers = $query->fetchAll(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire de d'enregistrement de voiture</title>
        <link rel="stylesheet" href="public/css/styles.css">
    </head>
    <body>
        <h1>PHP Test Page</h1>
        <?php if ($cars): ?>
            <table>
                <tr>
                    <th>Modèle</th>
                    <th>Marque</th>
                    <th>Prix</th>
                    <th>Places</th>
                    <th>Propriétaire</th>
                    <th>Action</th>
                </tr>
                <?php
                    foreach ($cars as $car):
                        $customer = '';
                        if(!empty($car->owner_id)) {
                            $user = new User($db, $car->owner_id);
                            $customer = $user->getFirstname() . ' ' . $user->getLastname();
                        }

                ?>
                    <form class="form-cars" method="POST">
                        <tr>

                            <td><input type="text" name="model" value="<?= $car->model ?>"/></td>
                            <td><input type="text" name="brand" value="<?= $car->brand ?>"/></td>
                            <td><input type="number" name="price" value="<?= $car->price ?>"/></td>
                            <td><input type="number" name="nb_seat" value="<?= $car->nb_seat ?>"/></td>
                            <td><?= $customer ?></td>
                            <td>
                                <input type="hidden" name="id-car" value="<?= $car->id ?>"/>
                                <button class="delete-car" name="delete-car">Supprimer</button>
                                <button class="update-car" name="update-car">Modifier</button>
                            </td>
                        </tr>
                    </form>
                <?php endforeach;?>
            </table>
        <?php endif;?>
        <form id="form_car" method="POST">
            <label for="model">Modèle :</label>
            <input type="text" id="model" name="model" placeholder="Modèle du véhicule..">

            <label for="brand">Marque :</label>
            <input type="text" id="brand" name="brand" placeholder="Marque du véhicule..">

            <label for="price">Prix :</label>
            <input type="text" id="price" name="price" placeholder="Prix du véhicule..">

            <label for="nb_seat">Nombres de places :</label>
            <input type="text" id="nb_seat" name="nb_seat" placeholder="Places du véhicule..">

            <label for="owners">Propriétaires :</label>
            <select name="owners" id="owners">
                <?php foreach ($customers as $customer):?>
                    <option value="<?= $customer->id ?>"><?= $customer->firstname . ' ' . $customer->lastname ?></option>
                <?php endforeach;?>
            </select>

            <input type="submit" name="insert-car" id="submit-btn" value="Confirmer">
        </form>

        <script src="public/js/script.js"></script>
    </body>
</html>
