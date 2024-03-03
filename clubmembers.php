<?php
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">
    <title>Student Club Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <link rel="icon" href="https://codingbirdsonline.com/wp-content/uploads/2019/12/cropped-coding-birds-favicon-2-1-192x192.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>

        body {
            background-color: #f8f8f8;
            font-family: 'Arial', sans-serif;
        }
        
        .container {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #3498db; /* Header color */
        }

        #exampleTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #exampleTable th,
        #exampleTable td {
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        #exampleTable th {
            background-color: #3498db; /* Header background color */
            color: white;
        }

        #exampleTable tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        #exampleTable tbody tr:hover {
            background-color: #cce5ff;
        }

        .add-clubs-btn {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Club Management</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="index.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Club List</span>
                </a>
            </li>
            <li>    
                <a href="clubofficer.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Club Officer</span>
                </a>
            </li>
            <li>
                <a href="clubmembers.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Club Member</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Member Request</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main class="main-content">
    <div class="container">
        <h2 style="text-align: center; color: #3498db;">Club Members</h2>
        <table id="exampleTable" class="table table-striped table-bordered">
            <thead id="thead">
                <tr>
                    <th>Club Logo</th>
                    <th>Club Name</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Actions</th> <!-- New column for Edit and Delete buttons -->
                </tr>
            </thead>
            <tbody id="tbody">
                <?php
                    $sql = "SELECT clubs.ClubName, clubs.ClubLogo, clubmembers.StudentID, clubmembers.StudentName
                            FROM clubmembers
                            INNER JOIN clubs ON clubmembers.ClubID = clubs.ClubID";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $prevClubName = '';
                        while ($row = $result->fetch_assoc()) {
                            $clubLogoDisplay = $row["ClubLogo"] ? '<img src="' . $row["ClubLogo"] . '" alt="Club Logo" width="50">' : '';
                            $clubNameDisplay = ($row["ClubName"] !== $prevClubName) ? $row["ClubName"] : '';
                            $prevClubName = $row["ClubName"];

                            echo '<tr>
                            <td>' . $clubLogoDisplay . '</td>
                            <td>' . $clubNameDisplay . '</td>
                            <td>' . $row["StudentID"] . '</td>
                            <td>' . $row["StudentName"] . '</td>
                            <td>
                                <a href="edit_member.php?StudentID=' . $row["StudentID"] . '" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i> Edit </a>
                                <a href="delete_member.php?StudentID=' . $row["StudentID"] . '" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Delete </a>
                            </td>
                        </tr>';
                }
                echo "</table>";
                    // Add Clubs Button
                    echo '<button style="text-align: center;" class="add-clubs-btn" onclick="location.href=\'addmembers.php\';">Add Member</button>';
                    } else {
                        echo '<tr><td colspan="5" style="text-align: center;">No data available</td></tr>';
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

    <?php
    // Close the database connection
    if (isset($conn)) {
        mysqli_close($conn);
    }
    ?>

<script src="script.js"></script>
</body>

</html>