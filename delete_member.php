<?php
include("db.php");

// Check if StudentID is provided in the URL
if (isset($_GET['StudentID'])) {
    $studentID = $_GET['StudentID'];

    // Delete the club member from the database
    $deleteSql = "DELETE FROM clubmembers WHERE StudentID = $studentID";

    if ($conn->query($deleteSql) === TRUE) {
        // Redirect to the club members page after successful deletion
        header("Location: clubmembers.php");
        exit();
    } else {
        // Handle error if the deletion fails
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect to the club members page if StudentID is not provided
    header("Location: clubmembers.php");
    exit();
}

// Close the database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>
