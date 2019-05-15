<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/conn.php';
include_once '../classes/class.php';

$database = new Database();
$db = $database->connection();

$book = new Books($db);

$result = $book->readBook();
$num = $result->rowCount();

if($num > 0) {
   
    $books_arr = array();
   // $books_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $book_item = array(
            'bookId' => $bookId,
            'bookTitle' => $bookTitle,
         //   'authorId' => $authorId,
            'authorName' => $authorName,
            'publisherName' => $publisherName
        );
        array_push($books_arr, $book_item);
        //array_push($books_arr['data'], $book_item);
    }

    echo json_encode($books_arr);
   
} else {
    echo json_encode(
        array('message' => 'Nothing Found')
    );
}
?>