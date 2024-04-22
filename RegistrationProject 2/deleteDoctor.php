<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {  // Ensure proper syntax for checking the connection error
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctorID = $_POST['id'];

    $sql = "DELETE FROM doctor WHERE doctorID = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    $stmt->bind_param("i", $doctorID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Doctor deleted successfully.";
    } else {
        echo "Error deleting doctor.";
    }

    $stmt->close();
    $conn->close();

    header("Location: viewDoctors.php");
    exit;
}
?>