<?php


// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "home";

// Create a PDO instance for database connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Exit the script if connection fails
}
// Modify the BookingListBuilder class to generate HTML markup
class BookingListBuilder
{
    private $userId;
    private $conn;

    public function __construct(PDO $conn, $userId)
    {
        $this->conn = $conn;
        $this->userId = $userId;
    }

    public function buildBookingList()
    {
        $bookingList = new BookingList();
        $stmt = $this->conn->prepare("SELECT * FROM booking WHERE userID = :userID");
        $stmt->bindParam(':userID', $this->userId);
        $stmt->execute();
        $bookingsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($bookingsData as $booking) {
            // Generate HTML markup for each booking
           // Generate HTML markup for each booking with inline CSS
$bookingHtml = "<div class='booking-container' style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
$bookingHtml .= "<div class='booking' style='/* Styles for individual booking */'>";
$bookingHtml .= "<p><strong>Booking ID:</strong> " . $booking['bookingID'] . "</p>";
$bookingHtml .= "<p><strong>Ticket Price:</strong> $" . $booking['ticketPrice'] . "</p>";
$bookingHtml .= "<p><strong>Total Price:</strong> $" . $booking['totalPrice'] . "</p>";
$bookingHtml .= "<p><strong>Booking Number:</strong> " . $booking['bookingNumber'] . "</p>";
$bookingHtml .= "<p><strong>Booking Status:</strong> " . $booking['bookingStatus'] . "</p>";
// Add more details as needed
$bookingHtml .= "</div>";
$bookingHtml .= "</div>"; // Close the booking container
            // Add the HTML markup to the booking list
            $bookingList->addBookingHtml($bookingHtml);
        }
        return $bookingList;
    }
}

// Define the BookingList class
class BookingList
{
    private $bookingsHtml;

    public function __construct()
    {
        $this->bookingsHtml = [];
    }

    public function addBookingHtml($html)
    {
        $this->bookingsHtml[] = $html;
    }

    public function getBookingsHtml()
    {
        return $this->bookingsHtml;
    }
}

// Usage example:

// Create a PDO instance for database connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Define the user ID
$userId = 12; // You can replace 1 with the actual user ID

// Create a BookingListBuilder instance
$bookingListBuilder = new BookingListBuilder($conn, $userId);

// Build the booking list
$bookingList = $bookingListBuilder->buildBookingList();

// Get the bookings HTML
$bookingsHtml = $bookingList->getBookingsHtml();

// Output the bookings HTML
foreach ($bookingsHtml as $bookingHtml) {
    echo $bookingHtml;
}
