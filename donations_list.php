<?php
session_start();
if (!isset($_SESSION['distributor_id'])) {
    header("Location: hellodistributor.php");
    exit();
}

include 'dbconnect.php'; // Include database connection

// Get distributor's name
$distributor_name = $_SESSION['distributor_name'];

// Fetch all available donations (that are not claimed)
$sql = "SELECT * FROM donations WHERE claimed = 0 ORDER BY donation_id ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Distributor Dashboard</title>
    <script>
        // Function to open popup for Aadhaar verification
        function openAadhaarPopup(donationId) {
            let aadhaar = prompt("Enter Recipient's Aadhaar Number:");
            if (aadhaar) {
                // Redirect to verify_aadhaar.php with donationId and aadhaar as query parameters
                window.location.href = `verify_aadhaar.php?donation_id=${donationId}&aadhaar=${aadhaar}`;
            }
        }
    </script>
</head>
<body>
    <h1>Welcome, <?php echo $distributor_name; ?></h1>
    <h2>Available Donations</h2>

    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Food Name</th>
                <th>Food Type</th>
                <th>Serves</th>
                <th>Edible Time</th>
                <th>Self Transport</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['foodName']); ?></td>
                    <td><?php echo htmlspecialchars($row['foodType']); ?></td>
                    <td><?php echo htmlspecialchars($row['peopleCount']); ?> people</td>
                    <td><?php echo htmlspecialchars($row['edibleTime']); ?></td>
                    <td><?php echo htmlspecialchars($row['selfTransport']); ?></td>
                    <td><img src="uploads/<?php echo htmlspecialchars($row['foodImage']); ?>" width="100"></td>
                    <td><button onclick="openAadhaarPopup(<?php echo $row['donation_id']; ?>)">Claim</button></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No available donations.</p>
    <?php endif; ?>

</body>
</html>
