<?php
/*
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling the GET request to load existing data
$id = $_GET['id'] ?? null;
$patient = null;

if ($id) {
    $stmt = $conn->prepare("SELECT firstName, lastName, dob, gender, email, contactNumber FROM patientregistration WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contactNumber'];

    $sql = "UPDATE patientregistration SET firstName=?, lastName=?, dob=?, gender=?, email=?, contactNumber=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssii", $firstName, $lastName, $dob, $gender, $email, $contactNumber, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: viewPatients.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient Information</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <div class="container">
        <div class="row col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h1>Edit Patient Form</h1>
                </div>
                <div class="panel-body">
                    <form action="editPatient.php?id=<?php echo $id; ?>" method="post">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $patient['firstName']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $patient['lastName']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $patient['dob']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="m" <?php echo $patient['gender'] == 'm' ? 'selected' : ''; ?>>Male</option>
                                <option value="f" <?php echo $patient['gender'] == 'f' ? 'selected' : ''; ?>>Female</option>
                                <option value="o" <?php echo $patient['gender'] == 'o' ? 'selected' : ''; ?>>Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $patient['email']; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Phone Number</label>
                            <input type="number" class="form-control" id="contactNumber" name="contactNumber" value="<?php echo $patient['contactNumber']; ?>" />
                        </div>
                        <input type="submit" class="btn btn-primary" value="Update" />
                    </form>
                </div>
                <div class="panel-footer text-right">
                    <small>&copy; Your Hospital</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>*/
//<?php=================================
/*
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching doctors
$doctors_sql = "SELECT doctorID, firstName, lastName FROM doctor";
$doctors_result = $conn->query($doctors_sql);

// Handling the GET request to load existing data
$id = $_GET['id'] ?? null;
$patient = null;

if ($id) {
    $stmt = $conn->prepare("SELECT firstName, lastName, dob, gender, email, contactNumber, doctorID FROM patientregistration WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contactNumber'];
    $doctorID = $_POST['doctorID']; // Retrieve doctorID from the form

    $sql = "UPDATE patientregistration SET firstName=?, lastName=?, dob=?, gender=?, email=?, contactNumber=?, doctorID=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiii", $firstName, $lastName, $dob, $gender, $email, $contactNumber, $doctorID, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: viewPatients.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient Information</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <div class="container">
        <div class="row col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h1>Edit Patient Form</h1>
                </div>
                <div class="panel-body">
                    <form action="editPatient.php?id=<?php echo $id; ?>" method="post">
                        <!-- Existing form fields -->
                        <div class="form-group">
                            <label for="doctorID">Assigned Doctor</label>
                            <select class="form-control" id="doctorID" name="doctorID">
                                <?php
                                while ($doctor = $doctors_result->fetch_assoc()) {
                                    $selected = ($doctor['doctorID'] == $patient['doctorID']) ? 'selected' : '';
                                    echo "<option value='" . $doctor['doctorID'] . "' $selected>" . $doctor['firstName'] . " " . $doctor['lastName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Update" />
                    </form>
                </div>
                <div class="panel-footer text-right">
                    <small>&copy; Your Hospital</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>*/
//<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching doctors
$doctors_sql = "SELECT doctorID, firstName, lastName FROM doctor";
$doctors_result = $conn->query($doctors_sql);

// Handling the GET request to load existing data
$id = $_GET['id'] ?? null;
$patient = null;

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM patientregistration WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming all necessary fields are provided in the form.
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contactNumber'];
    $doctorID = $_POST['doctorID'];

    // Update the record
    $update_sql = "UPDATE patientregistration SET firstName=?, lastName=?, dob=?, gender=?, email=?, contactNumber=?, doctorID=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssiii", $firstName, $lastName, $dob, $gender, $email, $contactNumber, $doctorID, $id);
    $update_stmt->execute();
    $update_stmt->close();
    $conn->close();

    header("Location: viewPatients.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Patient Information</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <div class="container">
        <div class="row col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h1>Edit Patient Information</h1>
                </div>
                <div class="panel-body">
                    <form action="editPatient.php?id=<?php echo $id; ?>" method="post">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($patient['firstName']); ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($patient['lastName']); ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($patient['dob']); ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="M" <?php echo ($patient['gender'] == 'M') ? 'selected' : ''; ?>>Male</option>
                                <option value="F" <?php echo ($patient['gender'] == 'F') ? 'selected' : ''; ?>>Female</option>
                                <option value="O" <?php echo ($patient['gender'] == 'O') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($patient['email']); ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Contact Number</label>
                            <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="<?php echo htmlspecialchars($patient['contactNumber']); ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="doctorID">Assigned Doctor</label>
                            <select class="form-control" id="doctorID" name="doctorID" required>
                                <?php
                                while ($doctor = $doctors_result->fetch_assoc()) {
                                    $selected = ($doctor['doctorID'] == $patient['doctorID']) ? 'selected' : '';
                                    echo "<option value='" . $doctor['doctorID'] . "' $selected>" . htmlspecialchars($doctor['firstName'] . " " . $doctor['lastName']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Update" />
                    </form>
                </div>
                <div class="panel-footer text-right">
                    <small>&copy; Your Hospital</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>