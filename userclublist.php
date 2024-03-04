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
            <li >
                <a href="login.php" class="login">
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
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main class="main-content">
        <div class="container">
        <h2 style="text-align: center; color: #3498db;">Club List</h2>
        <table id="exampleTable" class="table table-striped table-bordered">
            <thead id="thead">
                <tr>
                        <th>Club Logo</th>
                        <th>Club Name</th>
                        <th>Status</th>
                        <th>Apply Club</th>
                    </tr>
                </thead>
                <tbody>
                <?php
        $query = "SELECT * FROM clubs";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                    <td>
                        <img src="' . $row["ClubLogo"] . '" alt="Club Logo" style="max-width: 50px; max-height: 50px;">
                    </td>
                    <td>' . $row["ClubName"] . '</td>
                    <td>' . $row["Status"] . '</td>
                    <td>';

                // Check if the club is accredited
                if ($row["Status"] == "Not Accredited") {
                    echo '<button class="btn btn-success btn-sm" disabled>
                        <i class="glyphicon glyphicon-ok"></i> Not avialable
                    </button>';
                } else {
                    echo '<form method="post" action="apply.php" style="display: inline;">
                            <input type="hidden" name="clubID" value="' . $row['ClubID'] . '">
                            <button class="btn btn-success btn-sm" type="submit" name="applyClub">
                                <i class="glyphicon glyphicon-ok"></i> Apply
                            </button>
                        </form>';
                }

                echo '</td>
                    </tr>';
                        }
                    
                        echo "</table>";

                        // Add Clubs Button
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

    <?php
    // Close the database connection
    if (isset($conn)) {
        mysqli_close($conn);
    }
    ?>
<script src="script.js"></script>
</body>
</html>