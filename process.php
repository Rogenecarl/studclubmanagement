<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["approveClubMember"])) {
    $clubID = $_POST['clubID'];
    $studentID = $_POST['studentID'];
    $status = $_POST['status']; // Assuming you have a status field in your clubmembers table

    // Validate and sanitize input if needed

    // Update status in clubmembers table
    $updateQuery = "UPDATE clubmembers SET Status = $status WHERE ClubID = $clubID AND StudentID = $studentID";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        // Approval successful, you can redirect or display a success message
        header("Location: success_page.php");
        exit();
    } else {
        // Approval failed, handle the error
        echo "Error approving the club member: " . mysqli_error($conn);
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["rejectClubMember"])) {
    $clubID = $_POST['clubID'];
    $studentID = $_POST['studentID'];

    // Validate and sanitize input if needed

    // Delete the club member record for rejection
    $deleteQuery = "DELETE FROM clubmembers WHERE ClubID = $clubID AND StudentID = $studentID";
    $result = mysqli_query($conn, $deleteQuery);

    if ($result) {
        // Rejection successful, you can redirect or display a success message
        header("Location: success_page.php");
        exit();
    } else {
        // Rejection failed, handle the error
        echo "Error rejecting the club member: " . mysqli_error($conn);
    }
}
?>
