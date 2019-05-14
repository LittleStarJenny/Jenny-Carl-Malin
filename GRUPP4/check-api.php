<?php
$host    = 'localhost';
$db      = 'tester';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$valid_user = false;
if (isset($_GET['apikey'])) {
    // Check if apikey is valid.
    $apikey = filter_input(INPUT_GET, 'apikey', FILTER_SANITIZE_STRING);
    $sql = 'SELECT * FROM users WHERE apikey = :apikey';
    $statement->bindValue('apikey', $apikey, PDO::PARAM_STR);
    $statement = $this->db->prepare($sql);
    $data = $statement->execute();
    if ($data) {
        // Apikey is valid.
        $valid_user = true;
        $_SESSION['apikey'] = $apikey;
    }
}
if (!$valid_user) {
    http_response_code(401);
    exit;
}

