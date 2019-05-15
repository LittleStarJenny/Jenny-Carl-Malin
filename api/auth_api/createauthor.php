<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/conn.php';
  include_once '../classes/class.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connection();

  $author = new Authors($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  $author->authorId = $data->authorId;
  $author->authorName = $data->authorName;
  $author->publisherId = $data->publisherId;
  $author->Country = $data->Country;

 
  // Create author
  if($author->createAuthor()) {
    echo json_encode(
      array('message' => 'Author Created')
    );
    
  } else {
    echo json_encode(
      array('message' => 'Author Not Created')
    );
  }
