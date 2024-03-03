<?php
include("db.php");

// Check if StudentID is provided in the URL
if (isset($_GET['StudentID'])) {
    $studentID = $_GET['StudentID'];

    // Retrieve club member information
    $sql = "SELECT * FROM clubmembers WHERE StudentID = $studentID";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $studentName = $row['StudentName'];
    } else {
        // Redirect to the club members page if the member is not found
        header("Location: clubmembers.php");
        exit();
    }
} else {
    // Redirect to the club members page if StudentID is not provided
    header("Location: clubmembers.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $newStudentID = mysqli_real_escape_string($conn, $_POST['newStudentID']);
    $newStudentName = mysqli_real_escape_string($conn, $_POST['newStudentName']);

    // Update database
    $updateSql = "UPDATE clubmembers SET StudentID = $newStudentID, StudentName = '$newStudentName' WHERE StudentID = $studentID";
    if ($conn->query($updateSql) === TRUE) {
        // Redirect to the club members page after successful update
        header("Location: clubmembers.php");
        exit();
    } else {
        // Handle error if the update fails
        echo "Error updating record: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include necessary CSS and head content here -->
</head>

<body>
    <!-- Create a form for editing -->
    <form method="POST" action="">
        <label for="newStudentID">New Student ID:</label>
        <input type="text" name="newStudentID" value="<?php echo $studentID; ?>" required>
        <br>
        <label for="newStudentName">New Student Name:</label>
        <input type="text" name="newStudentName" value="<?php echo $studentName; ?>" required>
        <br>
        <input type="submit" value="Update">
    </form>

    <?php
    // Close the database connection
    if (isset($conn)) {
        mysqli_close($conn);
    }
    ?>
</body>

</html>
