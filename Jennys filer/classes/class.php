<?php 
class Books {
    private $conn;
    private $table = 'books';

    public $bookId;
    public $bookTitle;
    public $authorId;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT
        *
        FROM
        ' . $this->table . '';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
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

}
    