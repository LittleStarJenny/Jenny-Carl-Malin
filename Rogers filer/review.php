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


switch ($requestMethod) {
    case 'GET':                                     //OM metoden är "get"       
        if (!empty($_GET["id"])) {                  //kontrollera att ID inte är tom
            $reviewId = $_GET['id'] ?? null;
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
        break;
    case 'POST':
        $newReview = $currentReview->writeReview();
        echo json_encode("review accepted and added to database, thank you!");
        break;
        /*case 'PUT':
        // Update Product
        $product_id = intval($_GET["product_id"]);
        update_product($product_id);
        break;*/
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
        break;






    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}


class Review
{
    private $db;

    public function __construct()
    {
        $dbConnect = new DBConnect();
        $this->db = $dbConnect->pdo;
    }

    public function getReviews($id = null)
    {
        $sql = null;
        $parameters = null;

        if ($id > 0) {
            $sql = " SELECT * FROM reviews WHERE id = :id ";
            $parameters = ['id' => $id];
        } elseif ($id == 'All' || $id == 'all') {
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
                'id'                => $id,
                'reviewText'        => $reviewText,
                'reviewScore'       => $reviewScore,
                'reviewAuthor'      => $reviewAuthor,
                'reviewDate'        => $reviewDate
            ];

            array_push($reviews, $singleReview);
        }
        return $reviews;
    }
    public function writeReview()
    {
        $reviewData = json_decode(file_get_contents('php://input'));
        $sql = 'INSERT INTO reviews (reviewText, reviewScore, reviewAuthor, reviewDate)' .
            'VALUES (:reviewText, :reviewScore, :reviewAuthor, :reviewDate)';

        // Prepare query.
        $statement = $this->db->prepare($sql);

        // Bind values.
        $statement->bindValue('reviewText', filter_var($reviewData->reviewText, FILTER_SANITIZE_STRING));
        $statement->bindValue('reviewScore', filter_var($reviewData->reviewScore, FILTER_SANITIZE_STRING));
        $statement->bindValue('reviewAuthor', filter_var($reviewData->reviewAuthor, FILTER_SANITIZE_STRING));
        $statement->bindValue('reviewDate', filter_var($reviewData->reviewDate, FILTER_SANITIZE_STRING));


        // Execute query and return result.

        return $statement->execute();
    }

    public function deleteReview()
    {
        $deleteData = json_decode(file_get_contents('php://input'));

        if ($deleteData->id > 0) {
            $sql = " DELETE FROM reviews WHERE id = :id ";
            $statement = $this->db->prepare($sql);
            $statement->bindValue('id', filter_var($deleteData->id, FILTER_SANITIZE_STRING));
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
