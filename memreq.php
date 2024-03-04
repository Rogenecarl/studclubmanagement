<?php
include("db.php");

// Function to retrieve and display submitted applications
function displayApplications($conn) {
    $query = "SELECT * FROM clubmembers";
    $result = mysqli_query($conn, $query);

    echo "<table border='1'>
            <tr>
                <th>Club ID</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Action</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['ClubID']}</td>
                <td>{$row['StudentID']}</td>
                <td>{$row['StudentName']}</td>
                <td>
                    <form method='post' action=''>
                        <input type='hidden' name='clubID' value='{$row['ClubID']}'>
                        <input type='hidden' name='studentID' value='{$row['StudentID']}'>
                        <button type='submit' name='approveApplication'>Approve</button>
                        <button type='submit' name='rejectApplication'>Reject</button>
                    </form>
                </td>
            </tr>";
    }

    echo "</table>";
}

// Function to update the application status when Approve or Reject is clicked
function updateApplicationStatus($conn, $clubID, $studentID, $status) {
    $updateQuery = "UPDATE clubmembers SET Status = ? WHERE ClubID = ? AND StudentID = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "iis", $status, $clubID, $studentID);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function rejectApplication($conn, $clubID, $studentID) {
    $deleteQuery = "DELETE FROM clubmembers WHERE ClubID = ? AND StudentID = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "is", $clubID, $studentID);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve'])) {
        $clubID = $_POST['clubID'];
        $studentID = $_POST['studentID'];

        if (updateApplicationStatus($conn, $clubID, $studentID, 1)) {
            echo "Application approved successfully!";
        } else {
            echo "Error approving application.";
        }
    } elseif (isset($_POST['reject'])) {
        $clubID = $_POST['clubID'];
        $studentID = $_POST['studentID'];

        if (rejectApplication($conn, $clubID, $studentID)) {
            echo "Application rejected and deleted successfully!";
        } else {
            echo "Error rejecting application.";
        }
    }
}

$clubID = $_GET['clubID'] ?? 0;
?>