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

  $publisher = new Publishers($db);

  $data = json_decode(file_get_contents("php://input"));
  
    $publisher->publisherId = $data->publisherId;
    $publisher->publisherName = $data->publisherName;
    $publisher->City = $data->City;
    $publisher->Country = $data->Country;
 
  // Update book
  if($publisher->updatePublisher()) {
    echo json_encode(
      array('message' => 'Publisher Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Publisher Not Updated')
    );
  }