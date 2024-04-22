<?php
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $specialty = $_POST['specialty'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'hospital');
    if($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO doctor (firstName, lastName, specialty) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $firstName, $lastName, $specialty);
        $execval = $stmt->execute();
        echo $execval ? "Doctor Registration Successful!" : "Error in Doctor Registration";
        $stmt->close();
        $conn->close();
    }

    echo '<a href="DoctorRegistration.html">Back to Registration</a>';
?>