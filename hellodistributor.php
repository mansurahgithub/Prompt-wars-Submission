<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Your phpMyAdmin username
$password = ""; // Your phpMyAdmin password
$dbname = "foodbridge"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Distributor Registration
if (isset($_POST['register_distributor'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $employee_id = $_POST['employee_id'];
    $aadhar = $_POST['aadhar'];
    $collection_site = $_POST['collection_site'];
    $pin = $_POST['pin'];

    // Hash the PIN for security
    $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);

    // Check if Aadhaar already exists
    $check_sql = "SELECT * FROM distributors WHERE aadhar='$aadhar'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<script>alert('Distributor with this Aadhaar already exists!');</script>";
    } else {
        // Insert distributor details into the database
        $insert_sql = "INSERT INTO distributors (name, contact, employee_id, aadhar, collection_site, pin) 
                      VALUES ('$name', '$contact', '$employee_id', '$aadhar', '$collection_site', '$hashed_pin')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>alert('Registration successful! You can now log in.');</script>";
            header("Location: hello.php"); // Redirect back to registration page
            exit();
        } else {
            echo "<script>alert('Error during registration: " . $conn->error . "');</script>";
        }
    }
}

// Distributor Login
if (isset($_POST['login_distributor'])) {
    $aadhar = $_POST['aadhar'];
    $pin = $_POST['pin'];

    // Fetch distributor details based on Aadhaar
    $sql = "SELECT * FROM distributors WHERE aadhar='$aadhar'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify PIN
        if (password_verify($pin, $row['pin'])) {
            // Set session variables for distributor login
            $_SESSION['distributor_id'] = $row['distributor_id'];
            $_SESSION['distributor_name'] = $row['name'];

            // Redirect to distributor dashboard
            header("Location: distributor_dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid PIN!');</script>";
        }
    } else {
        echo "<script>alert('Distributor not found!');</script>";
    }
}

$conn->close();
?>