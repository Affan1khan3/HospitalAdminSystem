<?php
/*   
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contactNumber = $_POST['contactNumber'];

    // Database connection
    $conn = new mysqli('localhost','root','','hospital');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("insert into patientregistration(firstName, lastName, dob, gender, email, password, contactNumber) values(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $firstName, $lastName, $dob, $gender, $email, $password, $contactNumber);
        $execval = $stmt->execute();
        echo $execval ? "Registration Successful!" : "Error: Registration Failed";
        $stmt->close();
        $conn->close();
    }

    // Include HTML to display a back button
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Registration Result</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="patientRegistration.php" class="btn btn-info" style="margin-top: 20px;">Back to Registration</a>
                </div>
            </div>
        </div>
    </body>
    </html>';*/
    //<?php
    //<?php
$conn = new mysqli('localhost', 'root', '', 'hospital');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password']; // Ensure password is securely handled or hashed in real applications
$contactNumber = $_POST['contactNumber'];
$doctorID = $_POST['doctorID']; // This retrieves the selected doctorID from the form

// Prepare the SQL statement
$sql = "INSERT INTO patientregistration (firstName, lastName, dob, gender, email, password, contactNumber, doctorID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die('MySQL prepare error: ' . $conn->error);
}

// Bind parameters and execute
$stmt->bind_param("sssssisi", $firstName, $lastName, $dob, $gender, $email, $password, $contactNumber, $doctorID);
if ($stmt->execute()) {
    echo "Registration Successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

// HTML for back button
echo '<!DOCTYPE html>
<html>
<head>
    <title>Registration Complete</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="patientRegistration.php" class="btn btn-info">Back to Registration Form</a>
            </div>
        </div>
    </div>
</body>
</html>';
?>

	
    



