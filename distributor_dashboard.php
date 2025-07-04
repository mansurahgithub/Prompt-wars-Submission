<?php
session_start();
if (!isset($_SESSION['distributor_id'])) {
    header("Location: hellodistributor.php");
    exit();
}

include 'helloconnect.php';  // Database connection

// Fetch donations that are not claimed
$sql = "SELECT * FROM donations WHERE claimed = FALSE ORDER BY donation_id ASC";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distributor Dashboard</title>
    <link rel="stylesheet" href="distributor_dashboard.css">
</head>
<body>
        <!-- Hidden Easter‑Egg Icon -->
<div id="easter-egg" style="
    position: fixed;
    bottom: 0;
    left: -40px;
    width: 80px;
    height: 80px;
    background: url('easteregg.png') no-repeat center;
    background-size: contain;
    cursor: pointer;
    transition: left 0.5s ease;
"></div>

<!-- Burst Message Template (initially hidden) -->
<div id="egg-burst" style="
    position: fixed;
    bottom: 40%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    padding: 20px 30px;
    background: #fff;
    border-radius: 10px;
    font-size: 24px;
    box-shadow: 0 0 20px rgba(0,0,0,0.5);
    transition: transform 0.5s ease;
    pointer-events: none;
    z-index: 999;
">
  🎉 Woohoo! You found the Easter Egg! 🎉
</div>

<script>
// Slide‑in on hover
const egg = document.getElementById('easter-egg');
egg.addEventListener('mouseenter', () => egg.style.left = '0');
egg.addEventListener('mouseleave', () => egg.style.left = '-40px');

// On click, pop the burst message
egg.addEventListener('click', () => {
  const burst = document.getElementById('egg-burst');
  // trigger scale-up
  burst.style.transform = 'translate(-50%, -50%) scale(1)';
  // auto‑dismiss after 3s
  setTimeout(() => {
    burst.style.transform = 'translate(-50%, -50%) scale(0)';
  }, 3000);
});
</script>

    <h2>Welcome, <?php echo $_SESSION['distributor_name']; ?></h2>
    <a href="hellologout.php">Logout</a>
    <h3>Donation List</h3>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Food Name</th>
                <th>Type</th>
                <th>Serves</th>
                <th>Edible Time</th>
                <th>Transport</th>
                <th>Food Image</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['foodName']; ?></td>
                <td><?php echo $row['foodType']; ?></td>
                <td><?php echo $row['peopleCount']; ?></td>
                <td><?php echo $row['edibleTime']; ?></td>
                <td><?php echo $row['selfTransport']; ?></td>
                <td><img src="uploads/<?php echo $row['foodImage']; ?>" alt="Food Image"></td>
                <td><button onclick="askForAadhaar(<?php echo $row['donation_id']; ?>)">Claim</button></td>
            </tr>
            <?php endwhile; ?>
        </table>

    <?php else: ?>
        <p>No unclaimed donations available.</p>
    <?php endif; ?>

</body>
</html>

<script>
function askForAadhaar(donation_id) {
    const aadhaar = prompt("Enter recipient Aadhaar for verification:");
    if (aadhaar) {
        // Use URL with parameters for GET request
        window.location.href = `verify_aadhaar.php?donation_id=${donation_id}&aadhaar=${aadhaar}`;
    }
}
</script>
