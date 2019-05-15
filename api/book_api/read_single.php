<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/conn.php';
include_once '../../classes/class.php';

$database = new Database();
$db = $database->connection();

$book = new Books($db);

$book->bookId = isset($_GET['bookId']) ? $_GET['bookId'] : die();

$book->read_single();

$book_arr = array(
    'bookTitle' => $book->bookTitle,
    'authorName' => $book->authorName,
    'publisherName' => $book->publisherName
);

print_r(json_encode($book_arr));

?>