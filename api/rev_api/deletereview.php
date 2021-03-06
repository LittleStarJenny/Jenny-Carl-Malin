<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/conn.php';
  include_once '../classes/class.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connection();

  $review = new Reviews($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $review->revId = $data->revId;

  // Delete review
  if($review->deleteReview()) {
    echo json_encode(
      array('message' => 'Review Deleted')
    );

  } else {
    echo json_encode(
      array('message' => 'Review Not Deleted')
    );
  }
