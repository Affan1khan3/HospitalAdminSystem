<!DOCTYPE html>
<html>
<head>
    <title>Appointment Registration</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'hospital');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetching patients
    $patients_sql = "SELECT id, firstName, lastName FROM patientregistration";
    $patients_result = $conn->query($patients_sql);
    ?>
    <div class="container">
        <div class="row col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h1>Appointment Registration Form</h1>
                </div>
                <div class="panel-body">
                    <form action="connectAppointment.php" method="post">
                        <div class="form-group">
                            <label for="appointmentDate">Date</label>
                            <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" required />
                        </div>
                        <div class="form-group">
                            <label for="appointmentTime">Time</label>
                            <input type="time" class="form-control" id="appointmentTime" name="appointmentTime" required />
                        </div>
                        <div class="form-group">
                            <label for="purpose">Purpose</label>
                            <textarea class="form-control" id="purpose" name="purpose"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="patientID">Patient</label>
                            <select class="form-control" id="patientID" name="patientID">
                                <?php
                                while ($patient = $patients_result->fetch_assoc()) {
                                    echo "<option value='" . $patient['id'] . "'>" . $patient['firstName'] . " " . $patient['lastName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Register Appointment" />
                    </form>
                </div>
                <div class="panel-footer text-right">
                    <small>&copy; Your Hospital</small>
                </div>
            </div>
            <a href="viewAppointments.php" class="btn btn-info">View Appointments</a>
            <!-- Added Back button here -->
            <a href="index.html" class="btn btn-default">Back to Main Menu</a>
        </div>
    </div>
</body>
</html>