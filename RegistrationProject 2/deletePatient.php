<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM patientregistration WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record.";
    }

    $stmt->close();
    $conn->close();
}

header("Location: viewPatients.php");
exit;
?>