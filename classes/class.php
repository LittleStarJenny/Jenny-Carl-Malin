<?php 

class Books {
    private $conn;
    private $table = 'books';

    public $bookId;
    public $bookTitle;
    public $authorId;
    public $authorName;
    public $publisherId;
    public $publisherName;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT
        a.authorId as authorId,
        p.publisherId as publisherId,
        t.bookId,
        t.bookTitle,
        a.authorName,
        p.publisherName
        FROM
        ' . $this->table . ' t
        JOIN
        authors as a on a.authorId = t.authorId
        JOIN
        publishers as p on p.publisherId = a.publisherId';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single() {
        $query = 'SELECT
        a.authorId as authorId,
        p.publisherId as publisherId,
        t.bookId,
        t.bookTitle,
        a.authorName,
        p.publisherName
        FROM
        ' . $this->table . ' t
        JOIN
        authors as A on a.authorId = t.authorId
        JOIN
        publishers as P on p.publisherId = a.publisherId
        WHERE 
        t.bookId = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->bookId);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->bookTitle = $row['bookTitle'];
        $this->authorName = $row['authorName'];
        $this->publisherName = $row['publisherName'];
       // $this->bookTitle = $row['bookId'];       
    }

//create book
public function createbook() {
    $query = 'INSERT INTO ' . $this->table . '
    SET
        bookId = :bookId,
        bookTitle = :bookTitle,
        authorId = :authorId';

        $stmt = $this->conn->prepare($query);
        
        //Clean
        $this->bookId = htmlspecialchars(strip_tags($this->bookId));
        $this->bookTitle = htmlspecialchars(strip_tags($this->bookTitle));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        //Bind
        $stmt->bindParam(':bookId', $this->bookId);
        $stmt->bindParam(':bookTitle', $this->bookTitle);
        $stmt->bindParam(':authorId', $this->authorId);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: $s. \n", $stmt->error);

        return false;
}

//update Book
public function updatebook() {
    $query = 'UPDATE ' . $this->table . '
    SET
        bookId = :bookId,
        bookTitle = :bookTitle,
        authorId = :authorId
    WHERE
        bookId = :bookId';

        $stmt = $this->conn->prepare($query);
        
        //Clean
        $this->bookId = htmlspecialchars(strip_tags($this->bookId));
        $this->bookTitle = htmlspecialchars(strip_tags($this->bookTitle));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        //Bind
        $stmt->bindParam(':bookId', $this->bookId);
        $stmt->bindParam(':bookTitle', $this->bookTitle);
        $stmt->bindParam(':authorId', $this->authorId);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: $s. \n", $stmt->error);

        return false;
}
//Delete Book
public function deletebook() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE bookId = :bookId';

    $stmt = $this->conn->prepare($query);

    $this->bookId = htmlspecialchars(strip_tags($this->bookId));
    $stmt->bindParam(':bookId', $this->bookId);

    if($stmt->execute()) {
        return true;
    }
    printf("Error: $s. \n", $stmt->error);

    return false;    
}

}

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
        $query = 'UPDATE ' . $this->table . ' SET publisherId = :publisherId, authorName = :authorName, authorId = :authorId WHERE authorId = :authorId';

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

class Publishers {
    private $conn;
    private $table = 'publishers';

    public $publisherId;
    public $publisherName;
    public $City;
    public $Country;

    public function __construct($db) {
        $this->conn = $db;
    }

//create Publisher
public function createPublisher() {
    $query = 'INSERT INTO ' . $this->table . '
    SET
        publisherId = :publisherId,
        publisherName = :publisherName,
        City = :City
        Country = :Country';

        $stmt = $this->conn->prepare($query);
        
        //Clean
        $this->publisherId = htmlspecialchars(strip_tags($this->publisherId));
        $this->publisherName = htmlspecialchars(strip_tags($this->publisherName));
        $this->City = htmlspecialchars(strip_tags($this->City));
        $this->Country = htmlspecialchars(strip_tags($this->Country));
        //Bind
        $stmt->bindParam(':publisherId', $this->publisherId);
        $stmt->bindParam(':publisherName', $this->publisherName);
        $stmt->bindParam(':City', $this->City);
        $stmt->bindParam(':Country', $this->Country);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: $s. \n", $stmt->error);

        return false;
}

//update Publisher
public function updatePublisher() {
    $query = 'UPDATE ' . $this->table . '
    SET
        publisherId = :publisherId,
        publisherName = :publisherName,
        City = :City
        Country = :Country
    WHERE
        publisherId = :publisherId';

        $stmt = $this->conn->prepare($query);
        
        //Clean
        $this->publisherId = htmlspecialchars(strip_tags($this->publisherId));
        $this->publisherName = htmlspecialchars(strip_tags($this->publisherName));
        $this->City = htmlspecialchars(strip_tags($this->City));
        $this->Country = htmlspecialchars(strip_tags($this->Country));
        //Bind
        $stmt->bindParam(':publisherId', $this->publisherId);
        $stmt->bindParam(':publisherName', $this->publisherName);
        $stmt->bindParam(':City', $this->City);
        $stmt->bindParam(':Country', $this->Country);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: $s. \n", $stmt->error);

        return false;
}
//Delete Publisher
public function deletePublisher() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE publisherId = :publisherId';

    $stmt = $this->conn->prepare($query);

    $this->publisherId = htmlspecialchars(strip_tags($this->publisherId));
    $stmt->bindParam(':publisherId', $this->publisherId);

    if($stmt->execute()) {
        return true;
    }
    printf("Error: $s. \n", $stmt->error);

    return false;    
}

}

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




    