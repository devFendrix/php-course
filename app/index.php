<?php
require_once './config/database.php';

$db = connect();

$request = $db->prepare("INSERT INTO users (firstname, lastname, username) VALUES (:firstname, :lastname, :username)");
$request->bindValue(':firstname', 'Marc');
$request->bindValue(':lastname', 'Baribaud');
$request->bindValue(':username', 'mb96');
$request->execute();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Test Page</title>
</head>
<body>
<h1>PHP Test Page</h1>
<?php
echo 'lol mdr';
?>
</body>
</html>
