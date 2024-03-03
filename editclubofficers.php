<?php
include("db.php");

// Check if StudentID is provided in the URL
if (isset($_GET['StudentID'])) {
    $studentID = $_GET['StudentID'];

    // Retrieve club officer information
    $sql = "SELECT * FROM clubofficers WHERE StudentID = $studentID";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $clubID = $row['ClubID'];
        $position = $row['Position'];
        $studentName = $row['StudentName'];
    } else {
        // Redirect to the club members page if the officer is not found
        header("Location: clubofficials.php");
        exit();
    }
} else {
    // Redirect to the club members page if StudentID is not provided
    header("Location: clubofficials.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $newStudentName = mysqli_real_escape_string($conn, $_POST['newStudentName']);
    $newPosition = mysqli_real_escape_string($conn, $_POST['newPosition']);

    // Update database
    $updateSql = "UPDATE clubofficers SET StudentName = '$newStudentName', Position = '$newPosition'
                  WHERE ClubID = $clubID AND StudentID = $studentID";

    if ($conn->query($updateSql) === TRUE) {
        // Redirect to the club members page after successful update
        header("Location: clubofficials.php");
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
        <label for="newStudentName">New Student Name:</label>
        <input type="text" name="newStudentName" value="<?php echo $studentName; ?>" required>
        <br>
        <label for="newPosition">New Position:</label>
        <input type="text" name="newPosition" value="<?php echo $position; ?>" required>
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
