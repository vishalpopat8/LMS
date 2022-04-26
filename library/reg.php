<?php
include "connection.php";
include "navbar.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
	
	<style type="text/css">
		.box2 {
			height: 400px;
			width: 500px;
			background-color: #e88f41;
			opacity: .8;
			margin-left: 500px;
			padding: 45px;
			padding-top: 100px;
		}
		.custom-control-input:checked~.custom-control-label::before {
			color: #fff;
			border-color: #40372b;
			background-color: #40372b;
		}
	</style>
</head>
<body>

	<section>

		<div class="stu_reg">
			<br><br>
			<div class="box2">

				<h1 style="text-align: center;font-size: 35px"> Registration</h1><br>
				<form name="reg" method="post" action="">
					<b><p style="text-align: center;">Register as:</p></b>
					<div style="display: flex;justify-content: center;font-weight: bold;" class="input-group mb-3">


						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="defaultUnChecked" name="r" value="student">
							<label class="custom-control-label"  for="defaultUnChecked">Student</label>
						</div>

						<!-- Default unchecked -->
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="defaultUnchecked" name="r" value="admin">
							<label class="custom-control-label"  for="defaultUnchecked">Admin</label>
						</div>

						

					</div><br>
					<center>
						<button class="btn btn-primary" type="submit" name="submit">OK</button></center>
					</form>

				</div>
			</div>
			<?php 
			if (isset($_POST['submit'])) {
				if ($_POST['r']=='admin') 
				{
					?>
					<script type="text/javascript">
						window.location="admin/reg.php";
					</script>
					<?php
				}
				else
				{
					?>
					<script type="text/javascript">
						window.location="student/reg.php";
					</script>
					<?php
				}
			}
			?>
		</section>

		<?php
		if (isset($_POST['reg'])) {

			$count = 0;
			$sql = "select username from student";
			$res = mysqli_query($db, $sql);

			while ($row = mysqli_fetch_assoc($res)) {
				if ($row['username'] == $_POST['username']) {
					$count = $count + 1;
				}
			}

			if ($count == 0) {



				mysqli_query($db, "INSERT INTO student VALUES ('$_POST[fname]','$_POST[lname]','$_POST[username]','$_POST[password]','$_POST[enrol]','$_POST[email]','$_POST[phone]','user.jpg');");
				?>

				<!------------------------------------------------Registration Successful-------------------------------------------------------->
				<!-- The Modal -->
				<div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

					<div class="modal-dialog modal-dialog-centered">

						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title">Registration Successful &#9989;</h4>
								<button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="reg.php">&times;</a></button>
							</div>

							<!-- Modal footer -->
							<div class="modal-footer">
								<form method="post" action="">
									<button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;"href="student_login.php">Login</a></button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-backdrop fade show"></div>
				<!------------------------------------------Registration Successful--------------------------------------------------->
				<?php
			} else {
				?>
				<!-------------------------------------------------Username already Exists-------------------------------------------------------->
				<!-- The Modal -->
				<div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

					<div class="modal-dialog modal-dialog-centered">

						<div class="modal-content">

							<!-- Modal Header -->
							<div class="modal-header">
								<h4 class="modal-title"><i class="fa fa-exclamation-triangle" style="font-size:24px;color:#f7cd29"></i> Username already Exists</h4>
								<button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="reg.php">&times;</a></button>
							</div>



							<!-- Modal footer -->
							<div class="modal-footer">
								<form method="post" action="">
									<button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="reg.php">OK</a></button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-backdrop fade show"></div>
				<!-------------------------------------------Username already Exists---------------------------------------------------->
				<?php
			}
		}
		?>

	</body>
	</html>