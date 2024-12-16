<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('memory_limit', "1024M");
ini_set('max_execution_time', 600);

require './config/database.php';
require './entities/User.php';

$db = connect();

if(isset($_POST['insert-user'])){
    $query = $db->prepare("INSERT INTO users (firstname, lastname, username) VALUES (:firstname, :lastname, :username);");
    $query->bindValue(':firstname', $_POST['firstname']);
    $query->bindValue(':lastname', $_POST['lastname']);
    $query->bindValue(':username', $_POST['username']);
    $query->execute();
}

$query = $db->prepare("SELECT firstname, lastname, username FROM users");
$query->execute();
$users = $query->fetchAll(PDO::FETCH_OBJ);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire des utilisateurs </title>
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

    <table>
        <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Pseudonyme</th>
        </tr>

        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->firstname ?></td>
                <td><?= $user->lastname ?></td>
                <td><?= $user->username ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


    <form id="form_user" method="POST">
        <label for="firstname">Prénom :</label>
        <input type="text" id="firstname" name="firstname" placeholder="Votre prénom..">

        <label for="lastname">Nom :</label>
        <input type="text" id="lastname" name="lastname" placeholder="Votre nom..">

        <label for="username">Pseudo :</label>
        <input type="text" id="username" name="username" placeholder="Votre pseudo..">

        <input type="submit" name="insert-user" id="submit-btn" value="Envoyer">
    </form>

</body>
</html>