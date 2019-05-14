<?php

include_once 'config/conn.php';
include_once 'classes/class.php';
$database = new Database();
$db = $database->connection();

$api = new API($db);


if (isset($_POST['Send'])) {
   $apiKey = uniqid();

    $success = $api->createApi();
    if($success) {
    echo 'Your api-key is: ' . ($apiKey);   
} else {
    echo 'not working';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="main.css" media="screen" />
    <title>Bookshop</title>
</head>
<body>
<h1>Bookshop</h1>   
<form method="POST" action="index.php">
    <input type="text" name="userName">Name<br>
    <input type="password" name="passWord">Password<br>
    <input type="submit" name="Send" value="Submit">
</form><br>

</body>
</html>