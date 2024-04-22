<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$patientID = $_POST['patientID'];
$doctorID = $_POST['doctorID'];

$sql = "UPDATE patientregistration SET doctorID=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $doctorID, $patientID);
if ($stmt->execute()) {
    echo "Doctor assigned successfully.";
} else {
    echo "Error assigning doctor.";
}
$stmt->close();
$conn->close();

header("Location: viewPatients.php"); // Redirect back to the patient list
exit;
?>