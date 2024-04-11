<?php
require_once './config/database.php';
$db = connect();

// Insertion dans la base de données
if(isset($_POST['model']) && isset($_POST['brand']) && isset($_POST['price']) && isset($_POST['nb_seat'])) {
    $request = $db->prepare("INSERT INTO cars (model, brand, price, nb_seat) VALUES (:model, :brand, :price, :nb_seat)");
    $request->bindValue(':model', $_POST['model']);
    $request->bindValue(':brand', $_POST['brand']);
    $request->bindValue(':price', $_POST['price']);
    $request->bindValue(':nb_seat', $_POST['nb_seat']);
    $request->execute();
}

// Récupération des utilisateurs
$query = $db->prepare("SELECT model, brand, price, nb_seat FROM cars");
$query->execute();
$cars = $query->fetchAll(PDO::FETCH_OBJ);
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire de d'enregistrement de voiture</title>
        <link rel="stylesheet" href="css/styles.css">
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
                </tr>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?= $car->model ?></td>
                        <td><?= $car->brand ?></td>
                        <td><?= $car->price ?></td>
                        <td><?= $car->nb_seat ?></td>
                    </tr>
                <?php endforeach;?>
            </table>
        <?php endif;?>
        <form id="form_cars" method="POST">
            <label for="model">Modèle :</label>
            <input type="text" id="model" name="model" placeholder="Modèle du véhicule..">

            <label for="brand">Marque :</label>
            <input type="text" id="brand" name="brand" placeholder="Marque du véhicule..">

            <label for="price">Prix :</label>
            <input type="text" id="price" name="price" placeholder="Prix du véhicule..">

            <label for="nb_seat">Nombres de places :</label>
            <input type="text" id="nb_seat" name="nb_seat" placeholder="Places du véhicule..">

            <input type="button" id="submit-btn" value="Confirmer">
        </form>

        <script src="js/script.js"></script>
    </body>
</html>
