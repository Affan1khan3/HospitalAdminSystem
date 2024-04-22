<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$appointmentID = $_GET['id'];
if ($appointmentID) {
    $sql = "DELETE FROM appointment WHERE appointmentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentID);
    if ($stmt->execute()) {
        echo "Appointment deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}

header("Location: viewAppointments.php");
exit;
?>