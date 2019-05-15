<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/conn.php';
  include_once '../classes/class.php';

  $database = new Database();
  $db = $database->connection();

  $book = new Books($db);

  $data = json_decode(file_get_contents("php://input"));
  
  $book->bookId = $data->bookId;
  $book->bookTitle = $data->bookTitle;
  $book->authorId = $data->authorId;
 
  // Update book
  if($book->updateBook()) {
    echo json_encode(
      array('message' => 'Book Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Book Not Updated')
    );
  }