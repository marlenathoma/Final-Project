<html>
<head><title>Add Reservation</title></head>
<body>
    <h1>Add Reservation</h1>
    <form method="POST" action="RestaurantDatabase.php">
        Customer ID: <input type="text" name="customer_id" id='customer_id'><br>
        Reservation Time: <input type="datetime-local" name="reservation_time" id='datetime-local'><br>
        Number of Guests: <input type="number" name="number_of_guests" id='number_of_guests'><br>
        Special Requests: <textarea name="special_requests" id='special_requests'></textarea><br>
        <button type="submit">Submit</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>