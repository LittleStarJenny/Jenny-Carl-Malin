<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../classes/class.php';

$database = new Database();
$db = $database->connection();

$review = new Reviews($db);

$result = $review->bookScore();
$num = $result->rowCount();

if($num > 0) {
   
    $books_arr = array();
   // $books_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $book_item = array(

            'reviewScore' => $reviewScore,
            'bookTitle' => $bookTitle,
         //   'authorId' => $authorId,
            
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