<?php
require_once ('includes.php');
$testAuthenticate = new AuthenticateRequest;
if (!empty($_GET["apiKey"])) {
$testAuthenticate->testAuthentic($_GET['apiKey']);
}else {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode("Authorization error");
    die;
}
class AuthenticateRequest
{
    public function __construct()
    {
        $dbConnect = new Database();
        $this->db = $dbConnect->pdo;
    }
    public function testAuthentic($uniqueKey)
    {

        echo json_encode("apiKey found, testing...");
        header("HTTP/1.1 403 Forbidden");
        $sql = null;
        $parameters = null;

        $sql = " SELECT * FROM userapi WHERE apiKey = :apiKey ";
        $parameters = ['apiKey' => $uniqueKey];
        $stmt = $this->db->prepare($sql);
        $stmt->execute($parameters);
        $row = $stmt->fetch();
    
        if ($row) {
            echo json_encode("Authentification accepted");
            header("HTTP/1.1 200 ok");
        } else {
            echo json_encode("There was an error with your authentification. please re-enter your API key or request a new one");
            header("HTTP/1.1 403 Forbidden");
            die;
        }
    }
}
?>