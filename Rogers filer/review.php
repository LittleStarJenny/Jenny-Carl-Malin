<?PHP

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

try {

    if (!@include_once('includes/includes.php')) // @ - to suppress warnings, 
        // you can also use error_reporting function for the same purpose which may be a better option
        throw new Exception('includes.php does not exist');

    if (!file_exists('includes/includes.php'))
        throw new Exception('includes.php does not exist');
    else
        require_once('includes/includes.php');
} catch (Exception $e) {
    echo "Message : " . $e->getMessage();
    echo "Code : " . $e->getCode();
}


$currentReview = new Review;
$requestMethod = $_SERVER["REQUEST_METHOD"];


if ($_GET["apiKey"]) {
    $testRequest->testAuthentic($_GET["apiKey"]);
    switch ($requestMethod) {
        case 'GET':
            if (!empty($_GET["apiKey"])) {
                if (!empty($_GET["revId"])) {
                    $reviewId = $_GET['revId'] ?? null;
                    $response = $currentReview->getReviews($reviewId);
                    if ($response != null) {                //Om svaret från databasen inte är null
                        header("HTTP/1.1 200 OK");
                        echo json_encode($response);
                    } else {                                //Id är högre än högsta Id i databasen (felaktig id hanteras i klassen)
                        header("HTTP/1.1 404 NOT FOUND");
                        echo json_encode("Error, review not found");
                    }
                } else {
                    header("HTTP/1.1 400 Bad Request");     //Detta är enbart för när reviews körs utan resten av API-n
                    echo json_encode("In current form, Id cannot be left empty");
                }
            }
            header("HTTP/1.1 403 Forbidden");
            echo json_encode("There was an error with your authentification. please re-enter your API key or consult documentation");
            die;
        case 'POST':
            $newReview = $currentReview->writeReview();
            switch ($newReview) {
                case '1':
                    header("HTTP/1.1 200 OK");
                    echo json_encode("All is well, review created");
                    break;
                case '2':
                    header("HTTP/1.1 404 NOT FOUND");
                    echo json_encode("review id not found");
                    break;
                case '3':
                    header("HTTP/1.1 400 Bad Request");
                    echo json_encode("Bad Request, please consult documentation");
                    break;
                default:
                    echo json_encode("Severe server trauma or other really weird thing happened!");
                    break;
            }
            break;
            echo json_encode("review accepted and added to database, thank you!");
            header("HTTP/1.1 200 OK");

            break;
        case 'PUT':
            if ($_GET) {
                var_dump($_GET);
            } /*
            $changeReview = $currentReview->writeReview();
            $product_id = intval($_GET["product_id"]);
            update_product($product_id);
            break;
            */
        case "DELETE":
            $deleteRequest = $currentReview->deleteReview();
            switch ($deleteRequest) {
                case '1':
                    header("HTTP/1.1 200 OK");
                    echo json_encode("All is well, review deleted");
                    break;
                case '2':
                    header("HTTP/1.1 404 NOT FOUND");
                    echo json_encode("review id not found");
                    break;
                case '3':
                    header("HTTP/1.1 400 Bad Request");
                    echo json_encode("Bad Request, please consult documentation");
                    break;
                default:
                    echo json_encode("Severe server trauma or other really weird thing happened!");
                    break;
            }
    }
} else {
    echo json_encode("Please add your API key to your request, if you don't have one, please visit our automatic API Key service");
}

class Review
{
    private $db;

    public function __construct()
    {
        $dbConnect = new DBConnect();
        $this->db = $dbConnect->pdo;
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getReviews($revId = null)
    {
        $sql = null;
        $parameters = null;

        if ($revId > 0) {
            $sql = " SELECT * FROM reviews WHERE revId = :revId ";
            $parameters = ['revId' => $revId];
        } elseif ($revId == 'All' || $revId == 'all') {
            $sql = "SELECT * FROM reviews";
        } else {
            header('HTTP/1.1 400 Bad Request');
            die;
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($parameters);
        $reviews = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $singleReview = [
                'revId'             => $revId,
                'reviewText'        => $reviewText,
                'reviewScore'       => $reviewScore,
                'reviewAuthor'      => $reviewAuthor,
                'reviewDate'        => $reviewDate,
                'bookId'            => $bookId
            ];

            array_push($reviews, $singleReview);
        }
        return $reviews;
    }
    public function writeReview()
    {
        $reviewData = json_decode(file_get_contents('php://input'));
        $sql = 'INSERT INTO reviews (reviewText, reviewScore, reviewAuthor, reviewDate, bookId)' .
            'VALUES (:reviewText, :reviewScore, :reviewAuthor, :reviewDate, :bookId)';
        $statement = $this->db->prepare($sql);
        $statement->bindValue('reviewText', filter_var($reviewData->reviewText, FILTER_SANITIZE_STRING));
        $statement->bindValue('reviewScore', filter_var($reviewData->reviewScore, FILTER_SANITIZE_STRING));
        $statement->bindValue('reviewAuthor', filter_var($reviewData->reviewAuthor, FILTER_SANITIZE_STRING));
        $statement->bindValue('reviewDate', filter_var($reviewData->reviewDate, FILTER_SANITIZE_STRING));
        $statement->bindValue('bookId', filter_var($reviewData->bookId, FILTER_SANITIZE_STRING));
        if ($statement->execute()) {
            return 1;
        } else {
            return 3;
        }
    }

    public function deleteReview()
    {
        $deleteData = json_decode(file_get_contents('php://input'));
        if ($deleteData->revId > 0) {
            $sql = " DELETE FROM reviews WHERE revId = :revId ";
            $statement = $this->db->prepare($sql);
            $statement->bindValue('revId', filter_var($deleteData->revId, FILTER_SANITIZE_STRING));
            $statement->execute();
            $deletedRows = $statement->rowCount();
            if ($deletedRows > 0) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }
}
