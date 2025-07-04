<?php
session_start();
include 'helloconnect.php';

// Assume recipient ID is passed via GET or POST after verification
if (isset($_POST['recipient_id'])) {
    $recipient_id = $_POST['recipient_id'];

    // Assume recipient verification logic here
    $verified = true; // Example: Verification status

    if ($verified) {
        echo "<script>
            alert('Recipient Verified');
            window.location.href = 'donations_list.php?recipient_id=" . $recipient_id . "';
        </script>";
    } else {
        echo "Verification failed.";
    }
} else {
    echo "Recipient ID is missing.";
}
?>
