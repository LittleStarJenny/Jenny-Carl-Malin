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
        authors as A on a.authorId = t.authorId
        JOIN
        publishers as P on p.publisherId = a.publisherId';

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
        a.authorId = ?
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam( $this->bookId);
        $stmt->bindParam( $this->authorId);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->bookTitle = $row['bookTitle'];
        $this->authorName = $row['authorName'];
        $this->publisherName = $row['publisherName'];
       // $this->bookTitle = $row['bookId'];

    }

//create
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

//update
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
//Delete
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
    