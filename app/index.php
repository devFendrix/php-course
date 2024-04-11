<?php
require_once './config/database.php';
$db = connect();


$firstname = 'Marc';
$lastname = 'Baribaud' . ' Dev';
$age = 27;
$height = 1.90;

function getInfoVariable($variable): string
{
    return 'Type de la variable : ' . gettype($variable) . ' / Valeur : ' . $variable . '<br>';
}

echo getInfoVariable($firstname);
echo getInfoVariable($lastname);
echo getInfoVariable($age);
echo getInfoVariable($height);

$request = $db->prepare("SELECT * FROM users;");
$request->execute();
$students = $request->fetchAll(PDO::FETCH_OBJ);

$i = 0;
echo '<br> Boucle avec while';
while($i < count($students)){
    echo $students[$i]->firstname . ' / ' . $students[$i]->lastname . ' / ' . $students[$i]->username . '<br>';
    $i++;
}

echo '<br> Boucle avec for';
for ($j = 0; $j < count($students); $j++) {
    echo $students[$j]->firstname . ' / ' . $students[$j]->lastname . ' / ' . $students[$j]->username . '<br>';
}

echo '<br> Boucle avec foreach';
foreach($students as $student){
    echo $student->firstname . ' / ' . $student->lastname. ' / ' . $student->username . '<br>';
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
