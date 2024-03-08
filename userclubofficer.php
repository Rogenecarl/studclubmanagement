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
    <link rel="stylesheet" href="userdash.css">
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
            margin-top: 1px;
            background-color: #fff;
            padding: 20px;
            border-radius: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #3498db; /* Header color */
        }

        #exampleTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        #exampleTable th,
        #exampleTable td {
            padding: 15px;
            text-align: center;
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

        .add-officer-btn {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .edit-btn,
    .delete-btn {
        padding: 5px 10px;
        margin: 2px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .edit-btn {
        background-color: #3498db;
        color: #fff;
    }

    .delete-btn {
        background-color: #e74c3c;
        color: #fff;
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
                <a href="userclublist.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Club List</span>
                </a>
            </li>
            <li>
                <a href="userclubofficer.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Club Officer</span>
                </a>
            </li>
            <li>
                <a href="userclubmem.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Club Member</span>
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
                <a href="log.php" class="login">
                    <i class='bx bxs-log-in-circle'></i>
                    <span class="text">Log in</span>
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
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main class="main-content">
            <div class="container">
                <h2 style="text-align: center; color: #3498db;">Club Officers</h2>
                <table id="exampleTable" class="table table-striped table-bordered">
                <thead id="thead">
                    <tr>
                        <th>Club Logo</th>
                        <th>Club Name</th>
                        <th>Student ID</th>
                        <th>Position</th>
                        <th>Student Name</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php
                    $sql = "SELECT clubofficers.ClubID, clubs.ClubLogo, clubs.ClubName, clubofficers.StudentID, clubofficers.Position, clubofficers.StudentName
                            FROM clubofficers
                            INNER JOIN clubs ON clubofficers.ClubID = clubs.ClubID
                            ORDER BY clubofficers.ClubID, 
                                     CASE 
                                        WHEN clubofficers.Position = 'President' THEN 1
                                        WHEN clubofficers.Position = 'Vice President' THEN 2
                                        WHEN clubofficers.Position = 'Treasurer' THEN 3
                                        WHEN clubofficers.Position = 'Secretary' THEN 4
                                     END, 
                                     clubofficers.StudentID";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $prevClubID = '';
                        $clubLogoDisplay = '';
                        $clubNameDisplay = '';

                        while ($row = $result->fetch_assoc()) {
                            if ($row["ClubID"] !== $prevClubID) {
                                // Display club logo and name for the first row of each club
                                echo '<tr>
                                        <td rowspan="5"><img src="' . $row["ClubLogo"] . '" alt="Club Logo" width="50"></td>
                                        <td rowspan="5">' . $row["ClubName"] . '</td>';
                            }

                            // Display individual rows for each position
                            echo '<tr>
                                    <td>' . $row["StudentID"] . '</td>
                                    <td>' . $row["Position"] . '</td>
                                    <td>' . $row["StudentName"] . '</td>
                        
                            </td>
                                </tr>';

                            $prevClubID = $row["ClubID"];
                        }
                        echo "</table>";

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