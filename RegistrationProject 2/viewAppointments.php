<!DOCTYPE html>
<html>
<head>
    <title>View Appointments</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'hospital');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collecting input data
    $date_filter = isset($_GET['date']) ? $_GET['date'] : "";
    $purpose_filter = isset($_GET['purpose']) ? $_GET['purpose'] : "";
    $name_search = isset($_GET['name']) ? $_GET['name'] : "";

    // Constructing SQL with filters
    $sql = "SELECT a.appointmentID, a.appointmentDate, a.appointmentTime, a.purpose, p.firstName, p.lastName 
            FROM appointment a
            JOIN patientregistration p ON a.patientID = p.id";

    $whereClauses = [];

    if (!empty($date_filter)) {
        $whereClauses[] = "a.appointmentDate = '$date_filter'";
    }

    if (!empty($purpose_filter)) {
        $whereClauses[] = "a.purpose LIKE '%$purpose_filter%'";
    }

    if (!empty($name_search)) {
        $whereClauses[] = "(p.firstName LIKE '%$name_search%' OR p.lastName LIKE '%$name_search%')";
    }

    if (!empty($whereClauses)) {
        $sql .= " WHERE " . implode(" AND ", $whereClauses);
    }

    $result = $conn->query($sql);
    ?>
    <div class="container">
        <h2>Appointments List</h2>
        <form method="get">
            <div class="form-group">
                <label for="date">Filter by Date:</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($date_filter); ?>">
            </div>
            <div class="form-group">
                <label for="purpose">Filter by Purpose:</label>
                <input type="text" id="purpose" name="purpose" placeholder="Enter purpose" value="<?php echo htmlspecialchars($purpose_filter); ?>">
            </div>
            <div class="form-group">
                <label for="name">Search by Patient Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter name" value="<?php echo htmlspecialchars($name_search); ?>">
            </div>
            <button type="submit" class="btn btn-default">Filter/Search</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Purpose</th>
                    <th>Patient</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['appointmentID']}</td>
                                <td>{$row['appointmentDate']}</td>
                                <td>{$row['appointmentTime']}</td>
                                <td>{$row['purpose']}</td>
                                <td>{$row['firstName']} {$row['lastName']}</td>
                                <td><a href='editAppointment.php?id={$row['appointmentID']}' class='btn btn-primary'>Edit</a></td>
                                <td><a href='deleteAppointment.php?id={$row['appointmentID']}' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No appointments found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="appointmentRegistration.php" class="btn btn-success">Add Appointment</a>
        <a href="appointmentRegistration.php" class="btn btn-info">Back to Appointment Registration</a>
    </div>
</body>
</html>