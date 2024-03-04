<?php
include("db.php");

function applyToClub($conn, $clubID, $studentID, $studentName) {
    $checkMembershipQuery = "SELECT * FROM clubmembers WHERE ClubID = ? AND StudentID = ?";
    $stmt = mysqli_prepare($conn, $checkMembershipQuery);
    mysqli_stmt_bind_param($stmt, "is", $clubID, $studentID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        $applyQuery = "INSERT INTO clubmembers (ClubID, StudentID, StudentName) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $applyQuery);
        mysqli_stmt_bind_param($stmt, "iss", $clubID, $studentID, $studentName);

        if (mysqli_stmt_execute($stmt)) {
            return "Application submitted successfully!";
        } else {
            return "Error submitting application.";
        }
    } else {
        return "You are already a member of this club.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['applyClub'])) {
    if (isset($_POST['studentID']) && isset($_POST['studentName'])) {
        $clubID = $_POST['clubID'];
        $studentID = mysqli_real_escape_string($conn, $_POST['studentID']);
        $studentName = mysqli_real_escape_string($conn, $_POST['studentName']);

        $resultMessage = applyToClub($conn, $clubID, $studentID, $studentName);

        echo $resultMessage;
    } else {
        echo "Student ID and Student Name are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply to Club</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 50px;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        h2 {
            text-align: center;
            color: #3498db;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Apply to Club</h2>
        <form method="post" action="">
            <input type="hidden" name="clubID" value="<?php echo $_POST['clubID']; ?>">
            <label for="studentID">Student ID:</label>
            <input type="text" name="studentID" required>
            <br>
            <label for="studentName">Student Name:</label>
            <input type="text" name="studentName" required>
            <br>
            <button type="submit" name="applyClub">Apply</button>
        </form>
    </div>
</body>

</html>
