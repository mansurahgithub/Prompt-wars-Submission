<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: hellor.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$conn = new mysqli("localhost", "root", "", "foodbridge"); // Database name
$result = $conn->query("SELECT * FROM donations WHERE user_id = $user_id");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Donations</title>
    
    <style>
        /* Reset and base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    min-height: 100vh; /* Full height of the viewport */
    background: linear-gradient( rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7) ), url('bg1.jpg');
    background-position: center top;
    background-size: cover;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    color: black;
    margin: 0;
    padding: 20px;
}

/* Heading Styling */
h1 {
    text-align: center;
    color: white;
    font-size: 36px;
    margin-bottom: 30px;
}

/* Table Styling */
table {
    width: 100%;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px 15px;
    text-align: center;
    font-size: 16px;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #333;
    color: white;
}

td {
    background-color: #f9f9f9;
}

td img {
    border-radius: 5px;
    max-width: 100px;
    height: auto;
}

/* Styling for No Donations Message */
p {
    text-align: center;
    font-size: 18px;
    color: white;
    margin-top: 20px;
}

/* Back Button Styling */
a {
    display: block;
    width: 200px;
    margin: 30px auto;
    text-align: center;
    padding: 10px 0;
    background-color: #333;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 18px;
}

a:hover {
    background-color: #555;
}

    </style>
</head>
<body>
    <h1>Your Donations</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Food Name</th>
                <th>Type</th>
                <th>Serves</th>
                <th>Edible Time</th>
                <th>Self Transport</th>
                <th>Image</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['foodName']; ?></td>
                <td><?php echo $row['foodType']; ?></td>
                <td><?php echo $row['peopleCount']; ?></td>
                <td><?php echo $row['edibleTime']; ?></td>
                <td><?php echo $row['selfTransport']; ?></td>
                <td><img src="uploads/<?php echo $row['foodImage']; ?>" width="100"></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No donations</p>
    <?php endif; ?>
    <a href="homepage.php">Back to Home</a>
</body>
</html>
