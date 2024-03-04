<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addOfficer'])) {
    $clubID = $_POST['clubID'];
    $studentID = $_POST['studentID'];
    $position = $_POST['position'];  // Modified to get the selected position from the dropdown
    $studentName = $_POST['studentName'];

    // Check if the student is already an officer for the same position in the same club
    $checkQuery = "SELECT * FROM clubofficers WHERE ClubID = $clubID AND StudentID = '$studentID' AND Position = '$position'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Error: The student is already an officer for the same position in this club.";
    } else {
        // Insert the new officer into the database
        $insertQuery = "INSERT INTO clubofficers (ClubID, StudentID, Position, StudentName) VALUES ($clubID, '$studentID', '$position', '$studentName')";
        mysqli_query($conn, $insertQuery);

        echo "Officer added successfully!";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Officer</title>
</head>

<body>
    <h2>Add Officer</h2>
    <form method='post' action=''>
        <label for='clubID'>Club ID:</label>
        <input type='text' name='clubID' required>
        <br>
        <label for='studentID'>Student ID:</label>
        <input type='text' name='studentID' required>
        <br>
        <label for='position'>Position:</label>
        <select name='position' required>
            <option value='President'>President</option>
            <option value='Vice President'>Vice President</option>
            <option value='Secretary'>Secretary</option>
            <option value='Treasurer'>Treasurer</option>
        </select>
        <br>
        <label for='studentName'>Student Name:</label>
        <input type='text' name='studentName' required>
        <br>
        <button type='submit' name='addOfficer'>Add Officer</button>
    </form>
</body>

</html>
