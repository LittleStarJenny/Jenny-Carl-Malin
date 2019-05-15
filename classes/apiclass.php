<?php
class API {
        // DB 
        private $conn;
        private $table = 'userapi';
    
        // Post Properties
   
        public $userName;
        public $passWord;
        public $apiKey;
       
        // Constructor with DB
        public function __construct($db) {
          $this->conn = $db;
        }

        public function createApi() {
            $query = 'INSERT INTO ' . $this->table . '
            SET
                
                userName = :userName,
                passWord = :passWord,
                apiKey = :apiKey';

                $stmt = $this->conn->prepare($query);
            
            $this->userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
            $this->passWord = password_hash('passWord', PASSWORD_DEFAULT);
            $this->apiKey = uniqid(); 
    
        
        $stmt->bindParam(':userName', $this->userName);
        $stmt->bindParam(':passWord', $this->passWord);
        $stmt->bindParam(':apiKey', $this->apiKey);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: $s. \n", $stmt->error);

        return false;
        }
    }
    ?>