<?php
session_start();
include 'helloconnect.php';  // Database connection

// Check if donation ID and Aadhaar are set
if (isset($_GET['donation_id']) && isset($_GET['aadhaar'])) {
    $donation_id = $_GET['donation_id'];
    $aadhaar = $_GET['aadhaar'];

    // Verify recipient's Aadhaar in the people table
    $stmt = $conn->prepare("SELECT * FROM people WHERE aadhaar = ?");
    $stmt->bind_param("s", $aadhaar);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $recipient = $result->fetch_assoc();
        
        // Update the people table to assign the donation
        $stmt_update = $conn->prepare("UPDATE people SET donation_id = ?, claim_count = claim_count + 1 WHERE id = ?");
        $stmt_update->bind_param("ii", $donation_id, $recipient['id']);
        $stmt_update->execute();

        // Mark the donation as claimed in the donations table
        $stmt_claim = $conn->prepare("UPDATE donations SET claimed = TRUE WHERE donation_id = ?");
        $stmt_claim->bind_param("i", $donation_id);
        $stmt_claim->execute();

        echo "Donation assigned successfully to recipient.";
    } else {
        echo "Recipient not found for this Aadhaar.";
    }
} else {
    echo "No donation ID or Aadhaar received!";
}

$conn->close();
?>
