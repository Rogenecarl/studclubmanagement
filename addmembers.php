<?php
include("db.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $studentName = $_POST["studentName"];
    $studentID = $_POST["studentID"];
    $selectedClubID = $_POST["club"];

    // Validate input (add more validation if needed)
    if (empty($studentName) || empty($studentID) || empty($selectedClubID)) {
        $errorMessage = "Please fill in all fields.";
    } else {
        // Insert data into the clubmembers table
        $insertQuery = "INSERT INTO clubmembers (ClubID, StudentID, StudentName) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iss", $selectedClubID, $studentID, $studentName);

        if ($stmt->execute()) {
            $successMessage = "Club member added successfully!";
        } else {
            $errorMessage = "Error adding club member. Please try again.";
        }

        $stmt->close();
    }
}

// Fetch available clubs for the dropdown
$clubsQuery = "SELECT ClubID, ClubName FROM clubs";
$clubsResult = $conn->query($clubsQuery);

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
	<title>student club management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <link rel="icon" href="https://codingbirdsonline.com/wp-content/uploads/2019/12/cropped-coding-birds-favicon-2-1-192x192.png" type="image/x-icon">
    <style>
        body {
            background-color: #f8f8f8;
        }

        .container {
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #3498db; /* Header color */
        }

        #clubsTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #clubsTable th, #clubsTable td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        #clubsTable th {
            background-color: #3498db; /* Header background color */
            color: white;
        }

        #clubsTable tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        #clubsTable tbody tr:hover {
            background-color: #cce5ff;
        }
    </style>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Club management</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="index.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Add member</span>
				</a>
			</li>
			<li>
				<a href="clubmembers.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Club Members</span>
				</a>
			</li>
			<li>
				<a href="clubofficials.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Club Officers</span>
				</a>
			</li>
			<li>
				<a href="addmembers.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Add club member</span>
				</a>
			</li>
			<li>
				<a href="removemem.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Remove club member</span>
				</a>
			</li>
		</ul>
		<!-- <ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul> -->
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Add members</h1>
				</div>
			</div>

			<div class="container">
        <h2 style="text-align: center; color: #333;">Add Club Member</h2>

        <?php
        // Display success or error message if set
        if (isset($successMessage)) {
            echo '<div class="alert alert-success">' . $successMessage . '</div>';
        } elseif (isset($errorMessage)) {
            echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
        }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="studentName">Student Name:</label>
                <input type="text" class="form-control" name="studentName" required>
            </div>
            <div class="form-group">
                <label for="studentID">Student ID:</label>
                <input type="text" class="form-control" name="studentID" required>
            </div>
            <div class="form-group">
                <label for="club">Select Club:</label>
                <select class="form-control" name="club" required>
                    <?php
                    // Display available clubs in the dropdown
                    while ($row = $clubsResult->fetch_assoc()) {
                        echo '<option value="' . $row["ClubID"] . '">' . $row["ClubName"] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Club Member</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#exampleTable').DataTable();
        });
    </script>
            

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>

<?php
// Close the database connection
if (isset($conn)) {
    mysqli_close($conn);
}
?>