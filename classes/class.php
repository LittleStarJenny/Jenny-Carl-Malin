<?php 
include_once '../../config/conn.php';
$database = new Database();
$db = $database->connection();

$testAuthenticate = new AuthenticateRequest($db);
if (!empty($_GET["apiKey"])) {
$testAuthenticate->testAuthentic($_GET['apiKey']);
var_dump($_GET['apiKey']);
}else {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode("Authorization error");
    die;
}
class AuthenticateRequest {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function testAuthentic($uniqueKey)
    {
        $sql = null;
        $parameters = null;

        $sql = " SELECT * FROM userapi WHERE apiKey = :apiKey ";
        $parameters = ['apiKey' => $uniqueKey];
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($parameters);
        $row = $stmt->fetch();
   
        
        if ($row) {
            header("HTTP/1.1 200 ok");
        } else {
            echo json_encode("There was an error with your authentification. please re-enter your API key or request a new one");
            header("HTTP/1.1 403 Forbidden");
            die;
        }
    }
}

class Books {
    private $conn;
    private $table = 'books';

    public $bookId;
    public $bookTitle;
    public $authorId;
    public $authorName;
    public $publisherId;
    public $publisherName;
    public $revId;
    public $reviewText;
    public $reviewScore;
    public $reviewDate;
    public $reviewAuthor;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readBook() {
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
        a.authorId,
        p.publisherId,
        t.bookId,
        t.bookTitle,
        a.authorName,
        p.publisherName
        FROM
        ' . $this->table . ' t
        JOIN
        authors as a on a.authorId = t.authorId
        JOIN
        publishers as p on p.publisherId = a.publisherId
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

        //Select all books from authorId
        public function booksByauthor() {
            $query = 'SELECT
            a.authorId,
            p.publisherId,
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
            a.authorId = ?';
    
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(1, $this->authorId);
    
            $stmt->execute();
    
            return $stmt;
                 
        }

        //Select all reviews by book
        public function reviewsBybook() {
            $query = 'SELECT
            b.bookId,
            b.bookTitle,
            r.reviewText,
            r.reviewDate            
            FROM
            ' . $this->table . ' b
            JOIN
            reviews as r on r.bookId = b.bookId
            WHERE 
            b.bookId = ?';
    
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(1, $this->bookId);
    
            $stmt->execute();
    
            return $stmt;
                    
        }     

//create book
public function createBook() {
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
public function updateBook() {
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
public function deleteBook() {
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

class Authors {
    // DB 
    private $conn;
    private $table = 'authors';

    public $bookId;
    public $bookTitle;
    public $authorId;
    public $authorName;
    public $publisherId;
    public $Country;
    public $publisherName;
   
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

     // CREATE Author
     public function createAuthor() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' 
        SET 
        authorId = :authorId, 
        authorName = :authorName,
        publisherId = :publisherId,
        Country = :Country
        ';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->authorName = htmlspecialchars(strip_tags($this->authorName));
        $this->publisherId = htmlspecialchars(strip_tags($this->publisherId));
        $this->Country = htmlspecialchars(strip_tags($this->Country));

        // Bind data
        $stmt->bindParam(':authorId', $this->authorId);
        $stmt->bindParam(':authorName', $this->authorName);
        $stmt->bindParam(':publisherId', $this->publisherId);
        $stmt->bindParam(':Country', $this->Country);
   
        // Execute query
        if($stmt->execute()) {
          return true;
    }
    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);
    return false;
  }

  // UPDATE Author
  public function updateAuthor() {
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
  
  // DELETE Author
  public function deleteAuthor() {
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

class Reviews {
    private $conn;
    private $table = 'reviews';

    public $bookId;
    public $bookTitle;
    public $revId;
    public $reviewText;
    public $reviewScore;
    public $reviewDate;
    public $reviewAuthor;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function bookScore() {
        $query = 'SELECT
        b.bookId,
        b.bookTitle,
        r.reviewScore
        FROM
        ' . $this->table . ' r
        JOIN
        books as b on b.bookId = r.bookId
        ORDER BY 
        r.reviewScore DESC';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }   


//create review
public function createReview() {
    $query = 'INSERT INTO ' . $this->table . '
    SET
        revId = :revId,
        reviewText = :reviewText,
        reviewScore = :reviewScore,
        reviewDate = :reviewDate,
        reviewAuthor = :reviewAuthor';

        $stmt = $this->conn->prepare($query);
        
        //Clean
        $this->revId = htmlspecialchars(strip_tags($this->revId));
        $this->reviewText = htmlspecialchars(strip_tags($this->reviewText));
        $this->reviewScore = htmlspecialchars(strip_tags($this->reviewScore));
        $this->reviewDate = htmlspecialchars(strip_tags($this->reviewDate));
        $this->reviewAuthor = htmlspecialchars(strip_tags($this->reviewAuthor));
        //Bind
        $stmt->bindParam(':revId', $this->revId);
        $stmt->bindParam(':reviewText', $this->reviewText);
        $stmt->bindParam(':reviewScore', $this->reviewScore);
        $stmt->bindParam(':reviewDate', $this->reviewDate);
        $stmt->bindParam(':reviewAuthor', $this->reviewAuthor);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: $s. \n", $stmt->error);

        return false;
}

//update review
public function updateReview() {
    $query = 'UPDATE ' . $this->table . '
    SET
        revId = :revId,
        reviewText = :reviewText,
        reviewScore = :reviewScore,
        reviewDate = :reviewDate,
        reviewAuthor = :reviewAuthor
    WHERE
        revId = :revId';

        $stmt = $this->conn->prepare($query);
        
        //Clean
        $this->revId = htmlspecialchars(strip_tags($this->revId));
        $this->reviewText = htmlspecialchars(strip_tags($this->reviewText));
        $this->reviewScore = htmlspecialchars(strip_tags($this->reviewScore));
        $this->reviewDate = htmlspecialchars(strip_tags($this->reviewDate));
        $this->reviewAuthor = htmlspecialchars(strip_tags($this->reviewAuthor));
        //Bind
        $stmt->bindParam(':revId', $this->revId);
        $stmt->bindParam(':reviewText', $this->reviewText);
        $stmt->bindParam(':reviewScore', $this->reviewScore);
        $stmt->bindParam(':reviewDate', $this->reviewDate);
        $stmt->bindParam(':reviewAuthor', $this->reviewAuthor);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: $s. \n", $stmt->error);

        return false;
}
//Delete review
public function deleteReview() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE revId = :revId';

    $stmt = $this->conn->prepare($query);

    $this->revId = htmlspecialchars(strip_tags($this->revId));
    $stmt->bindParam(':revId', $this->revId);

    if($stmt->execute()) {
        return true;
    }
    printf("Error: $s. \n", $stmt->error);

    return false;    
}

}




    
