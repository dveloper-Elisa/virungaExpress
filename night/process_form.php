<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection file
include "../connect.php";

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collecting form data
    $date = $_POST['date'];
    $branch = htmlspecialchars($_POST['branch']);
    $placque = $_POST['placque'];
    $driver = htmlspecialchars($_POST['name_driver']);
    $ration = htmlspecialchars($_POST['ration']);

    // Prepare the SQL statement using prepared statements to prevent SQL injection
    $query = $conn->prepare("INSERT INTO `nightParking` (`date`, `branch`, `placque`, `driver`, `ration`) VALUES (?, ?, ?, ?, ?)");


    $query->bind_param("sssss", $date, $branch, $placque, $driver, $ration);

    if ($query->execute()) {
        ?>
        <script>alert('New record inserted');

            window.location.href="./nightParking.php"
        </script>
        <?php
        exit();

    } else {
        ?>

        <script>alert('Failed to insert record');
            window.location.href="./nightParking.php"

        </script>

        <?php
        exit();
    }

    // Close the prepared statement
    $query->close();
} else {
    echo "Please submit the form.";
}

// Close the database connection
$conn->close();
?>