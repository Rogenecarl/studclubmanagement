<?php
include("db.php");

// Handle form submission for adding a new officer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addSubmit'])) {
    // Validate and sanitize input
    $newClubID = mysqli_real_escape_string($conn, $_POST['newClubID']);
    $newStudentID = mysqli_real_escape_string($conn, $_POST['newStudentID']);
    $newStudentName = mysqli_real_escape_string($conn, $_POST['newStudentName']);
    $newPosition = mysqli_real_escape_string($conn, $_POST['newPosition']);

    // Insert into the database
    $insertSql = "INSERT INTO clubofficers (ClubID, StudentID, StudentName, Position) 
                  VALUES ($newClubID, $newStudentID, '$newStudentName', '$newPosition')";

    if ($conn->query($insertSql) === TRUE) {
        // Redirect to the club members page after successful insert
        header("Location: clubofficials.php");
        exit();
    } else {
        // Handle error if the insert fails
        echo "Error adding record: " . $conn->error;
    }
}

// Retrieve available clubs for the dropdown
$clubsSql = "SELECT ClubID, ClubName FROM clubs";
$clubsResult = $conn->query($clubsSql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include necessary CSS and head content here -->
</head>

<body>
    <!-- Create a form for adding a new officer -->
    <form method="POST" action="">
        <label for="newClubID">Select Club:</label>
        <select name="newClubID" required>
            <?php
            while ($club = $clubsResult->fetch_assoc()) {
                echo '<option value="' . $club['ClubID'] . '">' . $club['ClubName'] . '</option>';
            }
            ?>
        </select>
        <br>
        <label for="newStudentID">Student ID:</label>
        <input type="text" name="newStudentID" required>
        <br>
        <label for="newStudentName">Student Name:</label>
        <input type="text" name="newStudentName" required>
        <br>
        <label for="newPosition">Position:</label>
        <input type="text" name="newPosition" required>
        <br>
        <input type="submit" name="addSubmit" value="Add Officer">
    </form>

    <?php
    // Close the database connection if needed
    if (isset($conn)) {
        mysqli_close($conn);
    }
    ?>
</body>

</html>
