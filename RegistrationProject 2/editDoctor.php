<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$doctorID = $_GET['id'] ?? null;
$doctor = null;

if ($doctorID) {
    $stmt = $conn->prepare("SELECT firstName, lastName, specialty FROM doctor WHERE doctorID = ?");
    $stmt->bind_param("i", $doctorID);
    $stmt->execute();
    $result = $stmt->get_result();
    $doctor = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $specialty = $_POST['specialty'];

    $sql = "UPDATE doctor SET firstName=?, lastName=?, specialty=? WHERE doctorID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $firstName, $lastName, $specialty, $doctorID);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: viewDoctors.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Doctor Information</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <div class="container">
        <div class="row col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h1>Edit Doctor Form</h1>
                </div>
                <div class="panel-body">
                    <form action="editDoctor.php?id=<?php echo $doctorID; ?>" method="post">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $doctor['firstName']; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $doctor['lastName']; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="specialty">Specialty</label>
                            <input type="text" class="form-control" id="specialty" name="specialty" value="<?php echo $doctor['specialty']; ?>" required />
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