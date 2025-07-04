<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: hellor2.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $foodName = $_POST['foodName'];
    $foodType = $_POST['foodType'];
    $peopleCount = $_POST['peopleCount'];
    $edibleTime = $_POST['edibleTime'];
    $selfTransport = $_POST['selfTransport'];
    
    // File upload
    $targetDir = "uploads/";
    $fileName = basename($_FILES["foodImage"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["foodImage"]["tmp_name"], $targetFilePath)) {
        $conn = new mysqli("localhost", "root", "", "foodbridge");
        $stmt = $conn->prepare("INSERT INTO donations (user_id, foodName, foodType, peopleCount, edibleTime, foodImage, selfTransport) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ississs", $user_id, $foodName, $foodType, $peopleCount, $edibleTime, $fileName, $selfTransport);
        $stmt->execute();
        header("Location: homepage.php"); // Corrected redirect
    } else {
        echo "File upload failed!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Donate Food</title>
    <link rel="stylesheet" href="form.css">
    
</head>
<body>
    <h2>Fill in your donation details</h2>
    <div id="donation-form">
    <form method="POST" action="donate.php" enctype="multipart/form-data">
        <label for="foodName">Food Name:</label>
        <input type="text" id="foodName" name="foodName" required><br>

        <label for="foodType">Type:</label>
        <select id="foodType" name="foodType" required>
            <option value="veg">Veg</option>
            <option value="non-veg">Non-Veg</option>
        </select><br>

        <label for="peopleCount">How many people can it serve?</label>
        <input type="number" id="peopleCount" name="peopleCount" required><br>

        <label for="edibleTime">How long will it stay fresh and edible?</label>
        <select id="edibleTime" name="edibleTime" required>
            <option value="1hr">1 Hour</option>
            <option value="2hr">2 Hours</option>
            <option value="3hr">3 Hours</option>
            <option value="4hr">4 Hours</option>
            <option value="5hr">5 Hours</option>
        </select><br>

        <label for="foodImage">Upload an Image of your donation (max.5 MB)</label>
        <input type="file" id="foodImage" name="foodImage" accept="image/*" required><br>

        <label for="selfTransport">Can you take the food yourself to the collection site?</label>
        <select id="selfTransport" name="selfTransport" required>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select><br>

        <button type="submit">Submit</button>
    </form>
    </div>
</body>
</html>
