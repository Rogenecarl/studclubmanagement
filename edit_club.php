<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Club</title>
    <style>
        /* Add your styling if needed */
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

    <form method='post' action='' enctype='multipart/form-data'>
        <input type='hidden' name='clubID' value='<?php echo $clubID; ?>'>
        <label for='clubLogo'>Club Logo:</label>
        <input type='file' name='clubLogo' accept='image/*'>
        <img src='<?php echo $clubData['ClubLogo']; ?>' alt='Club Logo' style='max-width: 50px; max-height: 50px;'>
        <br>
        <label for='newClubName'>New Club Name:</label>
        <input type='text' name='newClubName' value='<?php echo $clubData['ClubName']; ?>' placeholder='New Club Name'>
        <br>
        <button type='submit' name='updateClub'>Update Club</button>
    </form>

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

    // Redirect back to the page after update
    header('Location: index.php');  // Change this to the actual name of your clubs_table.php file
    exit();
}

mysqli_close($conn);
?>

</body>
</html>
