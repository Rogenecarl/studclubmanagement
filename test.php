<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View users</title>
    <link rel="stylesheet" type="text/css" href="test.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 bg-dark height">
                <p class="pt-5 pb-5 text-center">
                    <a href="admin-panel.php" class="text-decoration-none"><span class="text-light text-font">Admin</span></a>
                </p>
                <hr class="bg-light ">
                 <p class="pt-2 pb-2 text-center">
                    <a href="admin-profile.php" class="text-decoration-none"><span class="text-light">Profile</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="categories.php" class="text-decoration-none"><span class="text-light">Categories</span></a>
                </p>
                <hr class="bg-light ">
                 <p class="pt-2 pb-2 text-center">
                    <a href="subcategories.php" class="text-decoration-none"><span class="text-light">Browse Categories</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="products-add.php" class="text-decoration-none"><span class="text-light">Add Products</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="products-display.php" class="text-decoration-none"><span class="text-light">View Products</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="new-user-requests.php" class="text-decoration-none"><span class="text-light">New user requests</span></a>
                </p>
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="view-users.php" class="text-decoration-none"><span class="text-light">View user</span></a>
                </p>                
                <hr class="bg-light ">
                <p class="pt-2 pb-2 text-center">
                    <a href="display-orders.php" class="text-decoration-none"><span class="text-light">View Orders</span></a>
                </p>
            </div>
            <div class="col-sm-10 bg-light">
               <div class="row">
                   <div class="col-sm-2">
                       <p class="text-center pt-1">
                                    <img class="rounded" src="<?php echo ("/test123/profile-pic/") . ($_SESSION['email']) . "display-picture.jpg"; ?>" width="150px" height="140px">
                                </p>
                   </div>
                   <div class="col-sm-8">
                       <h1 class="text-center pt-2 pb-1"><strong>Student Club Management</strong></h1>
                   </div>
                   <div class="col-sm-2">
                       <p class="pt-5">
                            <a href="logout.php" class="btn btn-outline-primary">Logout</a>
                       </p>
                   </div>
               </div>
               <div class="container-fluid pt-1 pb-1 bg-light">
        <div class="container width">
            <hr class="border-bottom bg-success w-50 mx-auto">
            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                <table class="table table-striped w-100 table-bordered">
                                <thead class="table-primary">
                                <tr>
                                    <th>Club Logo</th>
                                    <th>Club Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteClub'])) {
                                    $clubID = $_POST['clubID'];
            
                                    $checkQuery = "SELECT * FROM clubofficers WHERE ClubID = $clubID";
                                    $checkResult = mysqli_query($conn, $checkQuery);
            
                                    if (mysqli_num_rows($checkResult) > 0) {
                                        
                                        $deleteOfficersQuery = "DELETE FROM clubofficers WHERE ClubID = $clubID";
                                        mysqli_query($conn, $deleteOfficersQuery);
                                    }
            
                            
                                    $deleteQuery = "DELETE FROM clubs WHERE ClubID = $clubID";
                                    mysqli_query($conn, $deleteQuery);
                                }
            
                                $query = "SELECT * FROM clubs";
                                $result = mysqli_query($conn, $query);
            
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                                            <td>
                                                <img src="' . $row["ClubLogo"] . '" alt="Club Logo" style="max-width: 50px; max-height: 50px;">
                                            </td>
                                            <td>' . $row["ClubName"] . '</td>
                                            <td>
                                                <div class="custom-dropdown">
                                                    <select name="status">
                                                        <option value="0" ' . ($row["Status"] == 0 ? "selected" : "") . '>Not Accredited</option>
                                                        <option value="1" ' . ($row["Status"] == 1 ? "selected" : "") . '>Accredited</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <form method="post" action="edit_club.php" style="display: inline;">
                                                    <input type="hidden" name="clubID" value="' . $row['ClubID'] . '">
                                                    <button class="btn btn-warning btn-sm" type="submit" name="editClub">
                                                        <i class="glyphicon glyphicon-pencil"></i> Edit
                                                    </button>
                                                </form>
                                                <form method="post" style="display: inline;">
                                                    <input type="hidden" name="clubID" value="' . $row['ClubID'] . '">
                                                    <button class="btn btn-danger btn-sm" type="submit" name="deleteClub">
                                                        <i class="glyphicon glyphicon-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>';
                                    }
            
                                    echo "</table>";
            
                                    // Add Clubs Button
                                    echo '<button class="add-clubs-btn" onclick="location.href=\'add_clubs.php\';">Add Clubs</button>';
                                } else {
                                    echo "No clubs found.";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <script>
                $(document).ready(function() {
                    $('#exampleTable').DataTable();
                });
        
                    </script>
                </main>
                <!-- MAIN -->
        
                </div>
            </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>