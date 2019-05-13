<?php 
  class Post {
    // DB 
    private $conn;
    private $table = 'authors';

    // Post Properties
    public $publisherId;
    public $authorName;
    public $authorId;
   
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }


    // READ 
    public function read() {
      // Create query
      $query = 'SELECT * FROM authors';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }

    // CREATE
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET publisherId = :publisherId, authorName = :authorName';
          // Prepare statement
          $stmt = $this->conn->prepare($query);
          // Clean data
          $this->publisherId = htmlspecialchars(strip_tags($this->publisherId));
          $this->authorName = htmlspecialchars(strip_tags($this->authorName));

          // Bind data
          $stmt->bindParam(':publisherId', $this->publisherId);
          $stmt->bindParam(':authorName', $this->authorName);
     
          // Execute query
          if($stmt->execute()) {
            return true;
      }
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
    }

    // UPDATE
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . ' SET publisherId = :publisherId, authorName = :authorName WHERE authorId = :authorId';

          // Prepare statement
          $stmt = $this->conn->prepare($query);
          // Clean data
          $this->publisherId = htmlspecialchars(strip_tags($this->publisherId));
          $this->authorName = htmlspecialchars(strip_tags($this->authorName));
      

          // Bind data
          $stmt->bindParam(':publisherId', $this->publisherId);
          $stmt->bindParam(':authorName', $this->authorName);
          $stmt->bindParam(':authorId', $this->authorId);

          // Execute query
          if($stmt->execute()) {
            return true;
          }
          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
          return false;
    }
    
    // DELETE
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE authorId = :authorId';
          // Prepare statement
          $stmt = $this->conn->prepare($query);
          // Clean data
          $this->authorId = htmlspecialchars(strip_tags($this->authorId));
          // Bind data
          $stmt->bindParam(':authorId', $this->authorId);

          // Execute query
          if($stmt->execute()) {
            return true;
          }
          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
          return false;
    }
    
  }