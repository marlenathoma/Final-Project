<?php
require_once 'restaurantDatabase.php';

class RestaurantPortal {
    private $db;

    public function __construct() {
        $this->db = new RestaurantDatabase();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {
            case 'addReservation':
                $this->addReservation();
                break;
            case 'viewReservations':
                $this->viewReservations();
                break;
            default:
                $this->home();
        }
    }

    private function home() {
        include 'home.php';
    }

    private function addReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerId = $_POST['customer_id'];
            $reservationTime = $_POST['reservation_time'];
            $numberOfGuests = $_POST['number_of_guests'];
            $specialRequests = $_POST['special_requests'];

            $this->db->addReservation($customerId, $reservationTime, $numberOfGuests, $specialRequests);
            header("Location: home.php?action=viewReservations&message=Reservation Added");
        } else {
            include 'addReservation.php'; // might have to change this to just addres
        }
    }

    private function viewReservations() {
        $reservations = $this->db->getAllReservations();
        include 'viewReservations.php'; // same here
    }
}

$portal = new RestaurantPortal();
$portal->handleRequest();
