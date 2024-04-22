<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$appointmentDate = $_POST['appointmentDate'];
$appointmentTime = $_POST['appointmentTime'];
$purpose = $_POST['purpose'];
$patientID = $_POST['patientID'];

// Prepare the SQL statement
$sql = "INSERT INTO appointment (appointmentDate, appointmentTime, purpose, patientID) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die('MySQL prepare error: ' . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("sssi", $appointmentDate, $appointmentTime, $purpose, $patientID);
if ($stmt->execute()) {
    echo "Appointment registered successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: viewAppointments.php"); // Redirect to view appointments
exit;
?>