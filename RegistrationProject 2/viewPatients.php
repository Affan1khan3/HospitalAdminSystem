<?php
/*
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$gender_filter = isset($_GET['gender']) ? $conn->real_escape_string($_GET['gender']) : "";
$doctor_filter = isset($_GET['doctorID']) ? $conn->real_escape_string($_GET['doctorID']) : "";

// Build the query based on filters
$patients_sql = "SELECT p.id, p.firstName, p.lastName, p.dob, p.gender, p.email, p.contactNumber, p.doctorID, d.firstName AS docFirstName, d.lastName AS docLastName FROM patientregistration p LEFT JOIN doctor d ON p.doctorID = d.doctorID";

// Apply gender filter if selected
if (!empty($gender_filter)) {
    $patients_sql .= " WHERE p.gender = '$gender_filter'";
}

// Apply doctor filter if selected
if (!empty($doctor_filter)) {
    if (!empty($gender_filter)) {
        $patients_sql .= " AND";
    } else {
        $patients_sql .= " WHERE";
    }
    $patients_sql .= " p.doctorID = '$doctor_filter'";
}

$patients_result = $conn->query($patients_sql);

// Fetch all doctors for the dropdown
$doctors_sql = "SELECT doctorID, firstName, lastName FROM doctor";
$doctors_result = $conn->query($doctors_sql);

echo "<!DOCTYPE html><html><head><title>View Patients</title><link rel='stylesheet' type='text/css' href='css/style.css' /></head><body>";
echo "<div class='container'><h2>Patient List</h2>";

// Dropdown for Gender filter
echo "<form action='' method='get'>";
echo "Filter by Gender: <select name='gender' onchange='this.form.submit()'>";
echo "<option value=''>Select Gender</option>";
echo "<option value='m'" . ($gender_filter == "m" ? " selected" : "") . ">Male</option>";
echo "<option value='f'" . ($gender_filter == "f" ? " selected" : "") . ">Female</option>";
echo "<option value='o'" . ($gender_filter == "o" ? " selected" : "") . ">Other</option>";
echo "</select> ";

// Dropdown for Doctor filter
echo "Filter by Doctor: <select name='doctorID' onchange='this.form.submit()'>";
echo "<option value=''>Select Doctor</option>";
if ($doctors_result->num_rows > 0) {
    while ($doc = $doctors_result->fetch_assoc()) {
        $selected = ($doctor_filter == $doc['doctorID']) ? " selected" : "";
        echo "<option value='" . $doc['doctorID'] . "'" . $selected . ">" . $doc['firstName'] . " " . $doc['lastName'] . "</option>";
    }
}
echo "</select>";
echo "</form>";

echo "<table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>Gender</th><th>Email</th><th>Contact Number</th><th>Doctor</th><th>Edit</th><th>Delete</th></tr>";

if ($patients_result->num_rows > 0) {
    while($row = $patients_result->fetch_assoc()) {
        $doctorName = $row['docFirstName'] ? $row['docFirstName'] . ' ' . $row['docLastName'] : 'Not Assigned';
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstName"]. "</td><td>" . $row["lastName"]. "</td><td>" . $row["dob"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["email"]. "</td><td>" . $row["contactNumber"]. "</td>";
        echo "<td>" . $doctorName . "</td>";
        echo "<td><a href='editPatient.php?id=" . $row['id'] . "' class='btn'>Edit</a></td>";
        echo "<td><form action='deletePatient.php' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'/><input type='submit' value='Delete' class='btn btn-red' onclick='return confirm(\"Are you sure you want to delete this record?\")'/></form></td></tr>";
    }
} else {
    echo "<tr><td colspan='10'>No records found</td></tr>";
}
echo "</table>";
echo "<a href='patientRegistration.php' class='btn btn-info' style='margin-top: 20px;'>Back to Registration</a>";
echo "</div></body></html>";
$conn->close();
?>*/
//<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$gender_filter = isset($_GET['gender']) ? $conn->real_escape_string($_GET['gender']) : "";
$doctor_filter = isset($_GET['doctorID']) ? $conn->real_escape_string($_GET['doctorID']) : "";
$name_search = isset($_GET['name']) ? $conn->real_escape_string($_GET['name']) : "";

// Build the query based on filters and search
$patients_sql = "SELECT p.id, p.firstName, p.lastName, p.dob, p.gender, p.email, p.contactNumber, p.doctorID, d.firstName AS docFirstName, d.lastName AS docLastName FROM patientregistration p LEFT JOIN doctor d ON p.doctorID = d.doctorID";

$whereClauses = [];

// Apply gender filter if selected
if (!empty($gender_filter)) {
    $whereClauses[] = "p.gender = '$gender_filter'";
}

// Apply doctor filter if selected
if (!empty($doctor_filter)) {
    $whereClauses[] = "p.doctorID = '$doctor_filter'";
}

// Apply name search if provided
if (!empty($name_search)) {
    $whereClauses[] = "(p.firstName LIKE '%$name_search%' OR p.lastName LIKE '%$name_search%')";
}

if (!empty($whereClauses)) {
    $patients_sql .= " WHERE " . implode(" AND ", $whereClauses);
}

$patients_result = $conn->query($patients_sql);

// Fetch all doctors for the dropdown
$doctors_sql = "SELECT doctorID, firstName, lastName FROM doctor";
$doctors_result = $conn->query($doctors_sql);

echo "<!DOCTYPE html><html><head><title>View Patients</title><link rel='stylesheet' type='text/css' href='css/style.css' /></head><body>";
echo "<div class='container'><h2>Patient List</h2>";

// Filters and Search Form
echo "<form action='' method='get'>";
echo "Filter by Gender: <select name='gender' onchange='this.form.submit()'>";
echo "<option value=''>Select Gender</option>";
echo "<option value='m'" . ($gender_filter == "m" ? " selected" : "") . ">Male</option>";
echo "<option value='f'" . ($gender_filter == "f" ? " selected" : "") . ">Female</option>";
echo "<option value='o'" . ($gender_filter == "o" ? " selected" : "") . ">Other</option>";
echo "</select> ";

echo "Filter by Doctor: <select name='doctorID' onchange='this.form.submit()'>";
echo "<option value=''>Select Doctor</option>";
if ($doctors_result->num_rows > 0) {
    while ($doc = $doctors_result->fetch_assoc()) {
        $selected = ($doctor_filter == $doc['doctorID']) ? " selected" : "";
        echo "<option value='" . $doc['doctorID'] . "'" . $selected . ">" . $doc['firstName'] . " " . $doc['lastName'] . "</option>";
    }
}
echo "</select> ";

echo "Search by Name: <input type='text' name='name' value='" . htmlspecialchars($name_search) . "'/>";
echo "<input type='submit' value='Search'/>";
echo "</form>";

echo "<table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>DOB</th><th>Gender</th><th>Email</th><th>Contact Number</th><th>Doctor</th><th>Edit</th><th>Delete</th></tr>";

if ($patients_result->num_rows > 0) {
    while($row = $patients_result->fetch_assoc()) {
        $doctorName = $row['docFirstName'] ? $row['docFirstName'] . ' ' . $row['docLastName'] : 'Not Assigned';
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstName"]. "</td><td>" . $row["lastName"]. "</td><td>" . $row["dob"]. "</td><td>" . $row["gender"]. "</td><td>" . $row["email"]. "</td><td>" . $row["contactNumber"]. "</td>";
        echo "<td>" . $doctorName . "</td>";
        echo "<td><a href='editPatient.php?id=" . $row['id'] . "' class='btn'>Edit</a></td>";
        echo "<td><form action='deletePatient.php' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'/><input type='submit' value='Delete' class='btn btn-red' onclick='return confirm(\"Are you sure you want to delete this record?\")'/></form></td></tr>";
    }
} else {
    echo "<tr><td colspan='10'>No records found</td></tr>";
}
echo "</table>";
echo "<a href='patientRegistration.php' class='btn btn-info' style='margin-top: 20px;'>Back to Registration</a>";
echo "</div></body></html>";
$conn->close();
?>