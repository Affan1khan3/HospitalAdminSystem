<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'hospital');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $appointmentID = $_GET['id'] ?? null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $appointmentDate = $_POST['appointmentDate'];
        $appointmentTime = $_POST['appointmentTime'];
        $purpose = $_POST['purpose'];
        $patientID = $_POST['patientID'];

        $sql = "UPDATE appointment SET appointmentDate=?, appointmentTime=?, purpose=?, patientID=? WHERE appointmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $appointmentDate, $appointmentTime, $purpose, $patientID, $appointmentID);
        if ($stmt->execute()) {
            header("Location: viewAppointments.php");
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    } else {
        // Fetch existing appointment data
        $sql = "SELECT * FROM appointment WHERE appointmentID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $appointmentID);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointment = $result->fetch_assoc();
    }

    // Fetching patients for the dropdown
    $patients_sql = "SELECT id, firstName, lastName FROM patientregistration";
    $patients_result = $conn->query($patients_sql);
    ?>
    <div class="container">
        <h2>Edit Appointment</h2>
        <form action="editAppointment.php?id=<?php echo $appointmentID; ?>" method="post">
            <div class="form-group">
                <label for="appointmentDate">Date:</label>
                <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" value="<?php echo $appointment['appointmentDate']; ?>" required>
            </div>
            <div class="form-group">
                <label for="appointmentTime">Time:</label>
                <input type="time" class="form-control" id="appointmentTime" name="appointmentTime" value="<?php echo $appointment['appointmentTime']; ?>" required>
            </div>
            <div class="form-group">
                <label for="purpose">Purpose:</label>
                <textarea class="form-control" id="purpose" name="purpose" required><?php echo $appointment['purpose']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="patientID">Patient:</label>
                <select class="form-control" id="patientID" name="patientID">
                    <?php
                    while ($patient = $patients_result->fetch_assoc()) {
                        $selected = ($patient['id'] == $appointment['patientID']) ? 'selected' : '';
                        echo "<option value='" . $patient['id'] . "' $selected>" . $patient['firstName'] . " " . $patient['lastName'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>