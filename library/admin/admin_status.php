<?php
include 'connection.php';
include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin approve Request</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">
		.mydiv{
			margin: 20px;
			float: right;
			display:  inline-flex;

		}
		
		body {

			transition: background-color .5s;
		}

		.sidenav {
			height: 100%;
			margin-top: 100px;
			width: 0;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			background-color: #e8d192;
			overflow-x: hidden;
			transition: 0.5s;
			padding-top: 60px;

		}

		.sidenav a {
			padding: 8px 8px 8px 32px;
			text-decoration: none;
			font-size: 25px;
			color: #695a33;
			display: block;
			transition: 0.3s;
		}

		.sidenav a:hover {
			color: #f1f1f1;
		}

		.sidenav .closebtn {
			position: absolute;
			top: 0;
			right: 25px;
			font-size: 36px;
			margin-left: 50px;
		}

		#main {
			transition: margin-left .5s;
			padding: 16px;
		}

		@media screen and (max-height: 450px) {
			.sidenav {padding-top: 15px;}
			.sidenav a {font-size: 18px;}
		}
		.center{
			display: block;
			margin-left: auto;
			margin-right: auto;
			width: 50%;
			padding-right: unset;
			border-radius: 50%;
		}
		.scroll{
			width: 100%;
			height: 450px;
			overflow: auto;
		}
	</style>
</head>
<body>
	<!-------------------------------sidenav------------------------------------------>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<div style=""><br>
			<?php
			if (isset($_SESSION['login_user'])) {
				echo "<img class='center' src='images/" . $_SESSION['pic'] . "'>";
				?>
			</div>
			<div style="text-align: center; font-size: 20px;">
				<?php
				echo "<div style='margin-top:10px;'>" . ($_SESSION['login_user']) . "</div>";
			}
			?>
		</div>
		<a href="add.php">Add Books</a>
		<a href="request.php">Book Request</a>
		<a href="issue_info.php">Issue Information</a>
		<a href="return.php">Return Book</a>
		<a href="fine.php">Fine</a>
		<a href="history.php">History</a>
	</div>

	<div id="main">

		<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>


		<script>
			function openNav() {
				document.getElementById("mySidenav").style.width = "300px";
				document.getElementById("main").style.marginLeft = "300px";
				document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
			}

			function closeNav() {
				document.getElementById("mySidenav").style.width = "0";
				document.getElementById("main").style.marginLeft = "0";
				document.body.style.backgroundColor = "white";
			}
		</script>
		<!--------------------------------------------- search bar ---------------------------------------->
		
		<form class="navbar-form" method="post" name="form1">
			<div class="mydiv">
				<br><input style="width: 500px;" class="form-control" type="text" name="search" placeholder="Enter Username.." required="">&nbsp;&nbsp;&nbsp;&nbsp;
				<button style="background-color: #cbce86;" type="submit" name="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
			</div>


		</form>
		<br><br><br>
		<h2 style="margin: auto;">New Admin Requests</h2>
		<?php
		if (isset($_POST['submit'])) {
			$q = mysqli_query($db, "SELECT `first`, `last`, `username` , `email`, `contact` FROM `admin` where status='' and username like '%$_POST[search]%'");
			if (mysqli_num_rows($q) == 0) {
				?>
				<!--------------------------------------------------No student Found------------------------------------------------------------->



				<!-- The Modal -->
				<div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

					<div class="modal-dialog modal-dialog-centered">

						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Sorry! No request Found with that Username. Please try
								again.</h4>
								<button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="admin_status.php">&times;</a></button>
							</div>



							<!-- Modal footer -->
							<div class="modal-footer">
								<form method="post" action="">
									<button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="admin_status.php">OK</a></button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-backdrop fade show"></div>
				<!--------------------------------------------No student Found---------------------------------------------------->
				<?php
			} else {
				echo "<div class='scroll'>";
				echo "<table class='table table-bordered table-hover'>";
				echo "<tr style='background-color: #cbce86;'>";
				echo "<th>";
				echo "First Name";
				echo "</th>";
				echo "<th>";
				echo "Last Name";
				echo "</th>";
				echo "<th>";
				echo "Username";
				echo "</th>";

				echo "<th>";
				echo "Email";
				echo "</th>";
				echo "<th>";
				echo "Mobile No.";
				echo "</th>";
				echo "<th>APPROVE/REJECT</th>";
				echo "</tr>";

				while ($row = mysqli_fetch_assoc($q)) {
					echo "<tr>";
					echo "<td>";
					echo $row['first'];
					echo "</td>";
					echo "<td>";
					echo $row['last'];
					echo "</td>";
					echo "<td>";
					echo $row['username'];
					echo "</td>";
					echo "<td>";
					echo $row['email'];
					echo "</td>";
					echo "<td>";
					echo $row['contact'];
					echo "</td>";
					echo "<td>";
					echo "<form method='post' action=''><input type='hidden' value='$row[username]' name='username'><input type='hidden' value='$row[bid]' name='bid'><button type='submit' name='submit' class='btn btn-success'>APPROVE</button>&nbsp;&nbsp;<button type='submit' name='submit1' class='btn btn-danger'>REJECT</button></form>";
					echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</div>";
			}
		} else {
			$res = mysqli_query($db, "SELECT `first`, `last`, `username` , `email`, `contact` FROM `admin` WHERE status='';");
			echo "<div class='scroll'>";
			echo "<table class='table table-bordered table-hover'>";
			echo "<tr style='background-color: #cbce86;'>";
			echo "<th>";
			echo "First Name";
			echo "</th>";
			echo "<th>";
			echo "Last Name";
			echo "</th>";
			echo "<th>";
			echo "Username";
			echo "</th>";
			echo "<th>";
			echo "Email";
			echo "</th>";
			echo "<th>";
			echo "Mobile No.";
			echo "</th>";
			echo "<th>APPROVE/REJECT</th>";
			echo "</tr>";

			while ($row = mysqli_fetch_assoc($res)) {
				echo "<tr>";
				echo "<td>";
				echo $row['first'];
				echo "</td>";
				echo "<td>";
				echo $row['last'];
				echo "</td>";
				echo "<td>";
				echo $row['username'];
				echo "</td>";

				echo "<td>";
				echo $row['email'];
				echo "</td>";
				echo "<td>";
				echo $row['contact'];
				echo "</td>";
				echo "<td>";
				echo "<form method='post' action=''><input type='hidden' value='$row[username]' name='username'><button type='submit' name='approve' class='btn btn-success'>APPROVE</button>&nbsp;&nbsp;<button type='submit' name='reject' class='btn btn-danger'>REJECT</button></form>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
		}


		if (isset($_POST['approve'])) {
			$_SESSION['admin_status']=$_POST['username'];
			?>
			<!------------------------------------------------------------------approve admin------------------------------------------------------------->



			<!-- The Modal -->
			<div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

				<div class="modal-dialog modal-dialog-centered">

					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Are you sure you want to Approve this user as Admin?</h4>
							<button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="admin_status.php">&times;</a></button>
						</div>



						<!-- Modal footer -->
						<div class="modal-footer">
							<form method="post" action="">
								<button name="app" type="submit" class="btn btn-primary">Yes</button>
								<button name="cancel" type="button" class="btn btn-secondary"><a style="text-decoration: none;color: white;" href="admin_status.php">No</a></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-backdrop fade show"></div>
			<!------------------------------------------------------------------approve admin------------------------------------------------------------->
			<?php
		}
		if (isset($_POST['app'])) {
			mysqli_query($db,"UPDATE admin SET status='yes' WHERE username='$_SESSION[admin_status]'");
			?>
			<!--------------------------------------------------------user aproved successfully-------------------------------------->



			<!-- The Modal -->
			<div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

				<div class="modal-dialog modal-dialog-centered">

					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">User Approved Successfully &#9989;</h4>
							<button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="admin_status.php">&times;</a></button>
						</div>



						<!-- Modal footer -->
						<div class="modal-footer">
							<form method="post" action="">
								<button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="admin_status.php">OK</a></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-backdrop fade show"></div>
			<!------------------------------------------------user approved successfully---------------------------------------------------->
			<?php
			unset($_SESSION['admin_status']);
		}
		

		if (isset($_POST['reject'])) {
			$_SESSION['admin_status']=$_POST['username'];
			?>
			<!------------------------------------------------------------------approve admin------------------------------------------------------------->



			<!-- The Modal -->
			<div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

				<div class="modal-dialog modal-dialog-centered">

					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Are you sure you want to Reject this user as Admin?</h4>
							<button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="admin_status.php">&times;</a></button>
						</div>



						<!-- Modal footer -->
						<div class="modal-footer">
							<form method="post" action="">
								<button name="rej" type="submit" class="btn btn-danger">Yes</button>
								<button name="cancel" type="button" class="btn btn-secondary"><a style="text-decoration: none;color: white;" href="admin_status.php">No</a></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-backdrop fade show"></div>
			<!------------------------------------------------------------------approve admin------------------------------------------------------------->
			<?php
		}
		if (isset($_POST['rej'])) {
			mysqli_query($db,"DELETE FROM admin WHERE username='$_SESSION[admin_status]' AND status='';");
			?>
			<!--------------------------------------------------------user rejected successfully-------------------------------------->



			<!-- The Modal -->
			<div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

				<div class="modal-dialog modal-dialog-centered">

					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">User Rejected Successfully &#9989;</h4>
							<button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="admin_status.php">&times;</a></button>
						</div>



						<!-- Modal footer -->
						<div class="modal-footer">
							<form method="post" action="">
								<button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="admin_status.php">OK</a></button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-backdrop fade show"></div>
			<!------------------------------------------------user rejected successfully---------------------------------------------------->
			<?php
			unset($_SESSION['admin_status']);
		}
		
		?>
	</body>
	</html>

