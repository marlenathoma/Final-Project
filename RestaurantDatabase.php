<?php
class RestaurantDatabase {
    private $host = "localhost";
    private $port = "3306";
    private $database = "restaurant_reservations";
    private $user = "root";
    private $password = "";
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        echo "Successfully connected to the database";
    }



    public function addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests) {
        $stmt = $this->connection->prepare(
            "INSERT INTO reservations (customerId, reservationTime, numberOfGuests, specialRequests) VALUES (?, ?, ?, ?)" );
        $stmt->bind_param("isis",$customerId, $reservationTime, $numberOfGuests, $specialRequests);
        $stmt->execute();
        $stmt->close();
        echo "Reservation added successfully";
    }





    public function getAllReservations() {
        $result = $this->connection->query("SELECT * FROM reservations");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addCustomer($customerName, $contactInfo) {
     /// Prepare a statement to check if the customer already exists
    $stmt = $this->connection->prepare("SELECT customerId FROM customers WHERE contactInfo = ?");
    $stmt->bind_param("s", $contactInfo);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result->fetch_assoc();
    $stmt->close();

    if ($customer) {
        // If customer exists, return their ID
        return $customer['customerId'];
    } else {
        // If customer does not exist, insert them into the database
        $stmt = $this->connection->prepare(
            "INSERT INTO customers (customerName, contactInfo) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $customerName, $contactInfo);
        $stmt->execute();
        $newCustomerId = $stmt->insert_id; // Get the ID of the new customer
        $stmt->close();

        return $newCustomerId; // Return the new customer ID
    }
}
    public function getCustomerPreferences($customerId) {
    $stmt = $this->connection->prepare(
        "SELECT favoriteTable, dietaryRestrictions FROM diningpreferences WHERE customerId = ?"
    );
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $preferences = $result->fetch_assoc();
    $stmt->close();

    // Return the preferences (null if none are found)
    return $preferences;
    }
} // class end 
 $x = new RestaurantDatabase(); // creating the object to perform
// get Values
//$customerId, $reservationTime, $numberOfGuests, $specialRequests
$customerId = $_POST['customer_id'];
$reservationTime = $_POST['reservation_time'];
$numberOfGuests = $_POST ['number_of_guests'];
$specialRequests = $_POST ['special_requests'];

//echo "\nhello";

$x->addReservation($customerId ,$reservationTime, $numberOfGuests , $specialRequests );
?>
