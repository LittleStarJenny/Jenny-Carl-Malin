<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/conn.php';
include_once '../../classes/class.php';

$database = new Database();
$db = $database->connection();

$book = new Books($db);

$book->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : die();

$result = $book->booksByauthor();

if($result) {
    $books_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $book_item = array(
            'bookTitle' => $bookTitle,
            'revText' => $revText,
            'revDate' => $revDate,
        );

        array_push($books_arr, $book_item);

    }
    echo json_encode($books_arr);
}
?>