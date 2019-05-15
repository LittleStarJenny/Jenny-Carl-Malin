<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/conn.php';
  include_once '../classes/class.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connection();

  $author = new Authors($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $author->publisherId = $data->publisherId;
  $author->authorName = $data->authorName;
  $author->authorId = $data->authorId;

  // Update author
  if($author->updateAuthor()) {
    echo json_encode(
      array('message' => 'Author Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Author Not Updated')
    );
  }
