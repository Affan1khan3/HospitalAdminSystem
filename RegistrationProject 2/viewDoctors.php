<?php
/*
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT doctorID, firstName, lastName, specialty FROM doctor";
$result = $conn->query($sql);

echo "<!DOCTYPE html><html><head><title>View Doctors</title><link rel='stylesheet' type='text/css' href='css/style.css' /></head><body>";
echo "<div class='container'><h2>Doctor List</h2><table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Specialty</th><th>Edit</th><th>Delete</th></tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["doctorID"] . "</td><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["specialty"] . "</td>";
        echo "<td><a href='editDoctor.php?id=" . $row['doctorID'] . "' class='btn'>Edit</a></td>";
        echo "<td><form action='deleteDoctor.php' method='post'><input type='hidden' name='id' value='" . $row['doctorID'] . "'/><input type='submit' value='Delete' class='btn btn-red' onclick='return confirm(\"Are you sure you want to delete this doctor?\")'/></form></td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}
echo "</table>";
// Button to go back to the Doctor Registration page
echo "<a href='DoctorRegistration.html' class='btn btn-info' style='margin-top: 20px;'>Back to Doctor Registration</a>";
echo "</div></body></html>";
$conn->close();
?>*/
//<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$specialty_filter = isset($_GET['specialty']) ? $conn->real_escape_string($_GET['specialty']) : "";
$name_search = isset($_GET['name']) ? $conn->real_escape_string($_GET['name']) : "";

// Build the query based on filters and search
$sql = "SELECT doctorID, firstName, lastName, specialty FROM doctor";
$whereClauses = [];

// Apply specialty filter if selected
if (!empty($specialty_filter)) {
    $whereClauses[] = "specialty = '$specialty_filter'";
}

// Apply name search if provided
if (!empty($name_search)) {
    $whereClauses[] = "(firstName LIKE '%$name_search%' OR lastName LIKE '%$name_search%')";
}

if (!empty($whereClauses)) {
    $sql .= " WHERE " . implode(" AND ", $whereClauses);
}

$result = $conn->query($sql);

// Fetch all specialties for the dropdown
$specialties_sql = "SELECT DISTINCT specialty FROM doctor";
$specialties_result = $conn->query($specialties_sql);

echo "<!DOCTYPE html><html><head><title>View Doctors</title><link rel='stylesheet' type='text/css' href='css/style.css' /></head><body>";
echo "<div class='container'><h2>Doctor List</h2>";

// Filters and Search Form
echo "<form action='' method='get'>";
echo "Filter by Specialty: <select name='specialty' onchange='this.form.submit()'>";
echo "<option value=''>Select Specialty</option>";
if ($specialties_result->num_rows > 0) {
    while ($spec = $specialties_result->fetch_assoc()) {
        $selected = ($specialty_filter == $spec['specialty']) ? " selected" : "";
        echo "<option value='" . $spec['specialty'] . "'" . $selected . ">" . $spec['specialty'] . "</option>";
    }
}
echo "</select> ";

echo "Search by Name: <input type='text' name='name' value='" . htmlspecialchars($name_search) . "'/>";
echo "<input type='submit' value='Search'/>";
echo "</form>";

echo "<table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Specialty</th><th>Edit</th><th>Delete</th></tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["doctorID"] . "</td><td>" . $row["firstName"] . "</td><td>" . $row["lastName"] . "</td><td>" . $row["specialty"] . "</td>";
        echo "<td><a href='editDoctor.php?id=" . $row['doctorID'] . "' class='btn'>Edit</a></td>";
        echo "<td><form action='deleteDoctor.php' method='post'><input type='hidden' name='id' value='" . $row['doctorID'] . "'/><input type='submit' value='Delete' class='btn btn-red' onclick='return confirm(\"Are you sure you want to delete this doctor?\")'/></form></td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}
echo "</table>";
echo "<a href='DoctorRegistration.html' class='btn btn-info' style='margin-top: 20px;'>Back to Doctor Registration</a>";
echo "</div></body></html>";
$conn->close();
?>