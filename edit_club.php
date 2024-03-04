<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Editing Page</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        table {
            margin: 0 auto;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        img {
            max-width: 50px;
            max-height: 50px;
            margin-top: 10px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php
    // Your database connection code here
    include("db.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editClub'])) {
        $clubID = $_POST['clubID'];

        // Retrieve club details for pre-filling the form
        $query = "SELECT * FROM clubs WHERE ClubID = $clubID";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $clubData = mysqli_fetch_assoc($result);
        } else {
            echo "Club not found.";
            exit();
        }
    ?>
        <table>
            <tr>
                <td>
                    <form method='post' action='' enctype='multipart/form-data'>
                        <input type='hidden' name='clubID' value='<?php echo $clubID; ?>'>
                        <label for='clubLogo'>Club Logo:</label>
                        <input type='file' name='clubLogo' accept='image/*'>
                        <img src='<?php echo $clubData['ClubLogo']; ?>' alt='Club Logo'>
                        <br>
                        <label for='newClubName'>New Club Name:</label>
                        <input type='text' name='newClubName' value='<?php echo $clubData['ClubName']; ?>' placeholder='New Club Name'>
                        <br>
                        <label for='newClubStatus'>Club Status:</label>
                        <select name='newClubStatus'>
                            <option value='Accredited' <?php echo ($clubData['Status'] == 'Accredited') ? 'selected' : ''; ?>>Accredited</option>
                            <option value='Not Accredited' <?php echo ($clubData['Status'] == 'Not Accredited') ? 'selected' : ''; ?>>Not Accredited</option>
                        </select>
                        <br>
                        <button type='submit' name='updateClub'>Update Club</button>
                    </form>
                </td>
            </tr>
        </table>
    <?php
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateClub'])) {
        $clubID = $_POST['clubID'];

        // Check if an image is uploaded
        if ($_FILES['clubLogo']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';  // Specify the directory where you want to store the uploaded images
            $uploadFile = $uploadDir . basename($_FILES['clubLogo']['name']);

            // Move the uploaded file to the specified directory
            move_uploaded_file($_FILES['clubLogo']['tmp_name'], $uploadFile);

            // Update the ClubLogo in the database
            $updateLogoQuery = "UPDATE clubs SET ClubLogo = '$uploadFile' WHERE ClubID = $clubID";
            mysqli_query($conn, $updateLogoQuery);
        }

        // Update the ClubName in the database
        $newClubName = $_POST['newClubName'];
        $updateNameQuery = "UPDATE clubs SET ClubName = '$newClubName' WHERE ClubID = $clubID";
        mysqli_query($conn, $updateNameQuery);

        // Update the ClubStatus in the database
        $newClubStatus = $_POST['newClubStatus'];
        $updateStatusQuery = "UPDATE clubs SET Status = '$newClubStatus' WHERE ClubID = $clubID";
        mysqli_query($conn, $updateStatusQuery);

        // Redirect back to the page after update
        header('Location: index.php');  // Change this to the actual name of your clubs_table.php file
        exit();
    }

    mysqli_close($conn);
    ?>
</body>

</html>
