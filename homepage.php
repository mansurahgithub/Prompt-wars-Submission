<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage_today.css">

    <title>Home - FoodBridge</title>
    <style>
        /* Basic styling for dropdown */
        .dropdown-menu {
            display: none; /* Hidden by default */
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-menu a:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <button class="btn" onclick="window.location.href='donate.php'">Donate</button>
    <button class="donbtn"onclick="window.location.href='view_donations.php'">View Donation</button>

    
    <h1 class="heading">FoodBridge</h1>
    <p class="tagline">Connecting Plates, Saving Lives❤️</p>

    <!-- User Icon and Dropdown Menu -->
    <div class="user-icon-container">
        <a href="javascript:void(0);" onclick="toggleDropdown()" class="user-icon">
            <img src="user.png" alt="User Icon">
        </a>
        <div class="dropdown-menu" id="userDropdown">
            <a href="profile.php">Profile</a>
            <a href="rewards.php">Rewards</a>
            <a href="donations.php">User Donations</a>
            <a href="hellologout.php">Logout</a>
        </div>
    </div>

    <script src="login.js"></script>
</body>
</html>
