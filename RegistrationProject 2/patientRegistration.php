<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <script>
        function validateForm() {
            var firstName = document.forms["registrationForm"]["firstName"].value;
            var lastName = document.forms["registrationForm"]["lastName"].value;
            var email = document.forms["registrationForm"]["email"].value;
            var contactNumber = document.forms["registrationForm"]["contactNumber"].value;

            if (!firstName.match(/^[a-zA-Z]+$/)) {
                alert("First Name must contain only letters.");
                return false;
            }
            if (!lastName.match(/^[a-zA-Z]+$/)) {
                alert("Last Name must contain only letters.");
                return false;
            }
            if (!email.includes("@")) {
                alert("Email must contain an '@' symbol.");
                return false;
            }
            if (contactNumber.length != 10 || !contactNumber.match(/^\d+$/)) {
                alert("Phone Number must be exactly 10 digits.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'hospital');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetching doctors
    $doctors_sql = "SELECT doctorID, firstName, lastName FROM doctor";
    $doctors_result = $conn->query($doctors_sql);
    ?>
    <div class="container">
        <div class="row col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h1>Registration Form</h1>
                </div>
                <div class="panel-body">
                    <form name="registrationForm" action="connect.php" method="post" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required />
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required />
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" required />
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <div>
                                <label for="male" class="radio-inline">
                                    <input type="radio" name="gender" value="m" id="male" required />Male
                                </label>
                                <label for="female" class="radio-inline">
                                    <input type="radio" name="gender" value="f" id="female" required />Female
                                </label>
                                <label for="others" class="radio-inline">
                                    <input type="radio" name="gender" value="o" id="others" required />Others
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required />
                        </div>
                        <div class="form-group">
                            <label for="contactNumber">Phone Number</label>
                            <input type="number" class="form-control" id="contactNumber" name="contactNumber" required />
                        </div>
                        <div class="form-group">
                            <label for="doctorID">Assigned Doctor</label>
                            <select class="form-control" id="doctorID" name="doctorID">
                                <?php
                                while ($doctor = $doctors_result->fetch_assoc()) {
                                    echo "<option value='" . $doctor['doctorID'] . "'>" . $doctor['firstName'] . " " . $doctor['lastName'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Register" />
                    </form>
                </div>
                <div class="panel-footer text-right">
                    <small>&copy; Your Hospital</small>
                    <a href="index.html" class="btn btn-default">Back to Main Menu</a>
                </div>
            </div>
            <a href="viewPatients.php" class="btn btn-info">View Registered Patients</a>
        </div>
    </div>
</body>
</html>