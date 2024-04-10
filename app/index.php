<?php
require_once './config/database.php';
$db = connect();


// TODO variables


//TODO boucles




$request = $db->prepare("SELECT * FROM users;");
$request->execute();
$students = $request->fetchAll();

// TODO for
// TODO while

foreach($students as $student){
    echo $student['firstname'] . ' / ' . $student['lastname'] . ' / ' . $student['username'] . '<br>';
}

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
</body>
</html>
