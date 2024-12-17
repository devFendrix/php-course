<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', "1024M");
ini_set('max_execution_time', 600);

require './config/database.php';

$db = connect();

if(isset($_POST['insert-apartment'])){
    $query = $db->prepare("
            INSERT INTO apartments (nb_room, price, address_label, furnished) 
            VALUES (:nb_room, :price, :address_label, :furnished)
    ");
    $query->bindValue(':nb_room', $_POST['nb_room'], PDO::PARAM_INT);
    $query->bindValue(':price', $_POST['price']);
    $query->bindValue(':address_label', $_POST['address_label'], PDO::PARAM_STR);
    $query->bindValue(':furnished', $_POST['furnished'] ? 1 : 0, PDO::PARAM_INT);
    $query->execute();
}


$query = $db->prepare("SELECT id, nb_room, price, address_label, furnished FROM apartments");
$query->execute();
$apartments = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire des appartements </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="button"]:hover {
            background-color: #45a049;
        }

        _table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>PHP Test Page</h1>

<?php if($apartments): ?>
    <table>
        <tr>
            <th>Adresse</th>
            <th>Prix</th>
            <th>Pièces</th>
            <th>Meublé</th>
            <th>Action</th>

        </tr>
        <?php foreach ($apartments as $apartment) : ?>
            <tr>
                <td><?= $apartment->address_label ?></td>
                <td><?= $apartment->price ?></td>
                <td><?= $apartment->nb_room ?></td>
                <td><?= $apartment->furnished ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>

    </table>
<?php endif; ?>


<form id="form_user" method="POST">
    <label for="address">Adresse :</label>
    <input type="text" id="address" name="address_label" placeholder="Votre adresse..">

    <label for="price">Prix :</label>
    <input type="number" id="price" name="price" placeholder="Votre prix.."><br>

    <label for="room">Pièces :</label>
    <input type="text" id="room" name="nb_room" placeholder="Nombre de pièces...">

    <label for="furnished">Meublé :</label>
    <input type="checkbox" id="furnished" name="furnished">

    <input type="submit" name="insert-apartment" id="submit-btn" value="Envoyer">
</form>

</body>
</html>


