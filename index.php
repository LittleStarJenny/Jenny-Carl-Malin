<?php
// $host    = 'localhost';
// $port    = 8889;
// $db      = 'books';
// $user    = 'root';
// $pass    = 'Carlphp2019';
// $charset = 'utf8mb4';
// $options = [
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
// ];
// $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

// try {
//     $pdo = new PDO($dsn, $user, $pass, $options);
// } catch (\PDOException $e) {
//     throw new \PDOException($e->getMessage(), (int)$e->getCode());
// }

// $valid_user = false;

// if (isset($_GET['apikey'])) {
//     // Check if apikey is valid.
//     $apikey = filter_input(INPUT_GET, 'apikey', FILTER_SANITIZE_STRING);
//     $sql = 'SELECT * FROM users WHERE apikey = :apikey';
//     $statement->bindValue('apikey', $apikey, PDO::PARAM_STR);
//     $statement = $this->db->prepare($sql);
//     $data = $statement->execute();
//     if ($data) {
//         // Apikey is valid.
//         $valid_user = true;
//         $_SESSION['apikey'] = $apikey;
//     }
// }
// if (!$valid_user) {
//     http_response_code(401);
//     exit;
// }
// // Everytime you make a request, update the stats.
// // How many requests should each user be able to make during what time period?

$host = 'localhost';
$db = 'books';
$user = 'root';
$pass = 'Carlphp2019';
$charset = 'utf8';

$dsn = "mysql:host=$host;
 dbname=$db;
 charset=$charset";

try {   
     $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(),(int)$e->getCode());
}

if (isset($_POST['Skicka'])) {
    //echo 'Skickat med formulär!';
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $passWord = filter_input(INPUT_POST, 'passWord', FILTER_SANITIZE_STRING);
    $apiKey = filter_input(INPUT_POST, 'apiKey', FILTER_SANITIZE_STRING);
    $passWord = password_hash($passWord, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name, passWord, apiKey) VALUES('$name', '$passWord', '$apiKey')";
    //echo $sql . '<br>'; //(Mickes grej för att kolla varför inte formuläret fungerade)
    $stmt =$pdo->prepare($sql); 
    $stmt->execute();
    // header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="main.css" media="screen" />
    <title>Book Shop Rest Api</title>
</head>
<body>
<h1>Welcome to The Bookshop Api Service</h1>
<h2>Please register with name and password to get api-key</h2>    
<form method="POST" action="index.php">
    <input type="text" name="name"><caption><i> Name</i></caption><br>
    <input type="text" name="password"><caption><i> Password</i></caption><br>
    <input type="text" name="apiKey"><caption><i> Api Key</i></caption><br>
    <input type="submit" name="Skicka" value="Submit">
</form>

</body>
</html>