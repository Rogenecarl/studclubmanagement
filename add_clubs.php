<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addClub'])) {
    $clubName = $_POST['clubName'];
    $status = $_POST['status'];

    // Handle image upload
    $targetDirectory = "uploads/";  // Specify the directory where you want to store the uploaded images
    $targetFile = $targetDirectory . basename($_FILES["clubLogo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is a actual image or fake image
    $check = getimagesize($_FILES["clubLogo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["clubLogo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["clubLogo"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, now insert the club into the database
            $insertQuery = "INSERT INTO clubs (ClubName, ClubLogo, Status) VALUES ('$clubName', '$targetFile', $status)";
            mysqli_query($conn, $insertQuery);
            // Redirect to the club list page if StudentID is not provided
            header("Location: index.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        } 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Club</title>
    <!-- Add your CSS styles or include Bootstrap if needed -->
</head>
<body>
    <h2>Add Club</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="clubName">Club Name:</label>
        <input type="text" name="clubName" required>
        <br>

        <label for="clubLogo">Club Logo:</label>
        <input type="file" name="clubLogo" accept="image/*" required>
        <br>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="0">Not Accredited</option>
            <option value="1">Accredited</option>
        </select>
        <br>

        <button type="submit" name="addClub">Add Club</button>
    </form>
</body>
</html>
