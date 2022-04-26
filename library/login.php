<?php
include 'connection.php';
include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	
	<style type="text/css">
	.box1{
		height: 450px;
		width: 500px;
		background-color: #5d79a6;
		opacity: .8;
		margin-left: 500px;
		padding: 45px;
	}
	.custom-control-input:checked~.custom-control-label::before {
		color: #fff;
		border-color: #385955;
		background-color: #385955;
	</style>
</head>
<body>

	<section>

		<div class="stu_log">
			<br>
			<div class="box1">

				<h1 style="text-align: center;font-size: 35px">Login</h1>
				<br>
				<form  name="login" action="" method="post" style="text-align: center;">
					<b><p>Login as:</p></b>
					<div style="display: flex;justify-content: center;" class="input-group mb-3">


						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="defaultUnChecked" name="login" value="student">
							<label class="custom-control-label"  for="defaultUnChecked">Student</label>
						</div>

						<!-- Default unchecked -->
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" class="custom-control-input" id="defaultUnchecked" name="login" value="admin">
							<label class="custom-control-label"  for="defaultUnchecked">Admin</label>
						</div>

					</div>
					<div class="login">
						<input class="form-control" type="text" name="username" placeholder="Username" required><br>
						<input class="form-control" type="password" name="password" placeholder="Password" required><br>
						<input class="btn-info" type="submit" name="btn_login" value="Login" style="height: 30px;width: 100px;border-radius: 5px"></div><br>


						<a class="text-decoration-none" style="color: #b5d2ff"   href="forgot.php">Forgot Password</a>
						<p style="color: white">New To this Website? <a class="text-decoration-none" style="color: #b5d2ff" href="reg.php"> Sign Up</a></p> 
					</form>


				</div>
			</div>

		</section>
		<?php
		if (isset($_POST['btn_login'])) {
			if ($_POST['login']=='admin') {
				$count = 0;
				$res = mysqli_query($db, "SELECT * FROM `admin` WHERE `username`='$_POST[username]' AND `password`='$_POST[password]' AND status='yes';");
				
				$row= mysqli_fetch_assoc($res);
				$count = mysqli_num_rows($res);

				if ($count == 0) {
					?>
					<!-----------------------------------------------Username and Password does not match-------------------------------------------->
					<!-- The Modal -->
					<div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

						<div class="modal-dialog modal-dialog-centered">

							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Username and Password does not match &#10060;</h4>
									<button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="admin_login.php">&times;</a></button>
								</div>

								<!-- Modal footer -->
								<div class="modal-footer">
									<form method="post" action="">
										<button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;"href="login.php">OK</a></button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-backdrop fade show"></div>
					<!----------------------------------------Username and Password does not match----------------------------------------------->
					<?php
				} else {
					/*------------------if username and password matches-------------------*/
					$_SESSION['login_user'] = $_POST['username'];
					$_SESSION['pic']=$row['pic'];
					$_SESSION['username']='';
					?>
					<script type="text/javascript">
						window.location = "admin/index.php";
					</script> 
					<?php
				}
			}
			else
			{
				$count = 0;
				$res = mysqli_query($db, "SELECT * FROM `student` WHERE `username`='$_POST[username]' AND `password`='$_POST[password]';");
				$row= mysqli_fetch_assoc($res);
				$count = mysqli_num_rows($res);

				if ($count == 0) {
					?>
					<!-----------------------------------------------Username and Password does not match-------------------------------------------->
					<!-- The Modal -->
					<div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

						<div class="modal-dialog modal-dialog-centered">

							<div class="modal-content">

								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Username and Password does not match &#10060;</h4>
									<button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="login.php">&times;</a></button>
								</div>

								<!-- Modal footer -->
								<div class="modal-footer">
									<form method="post" action="">
										<button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;"href="login.php">OK</a></button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-backdrop fade show"></div>
					<!----------------------------------------Username and Password does not match----------------------------------------------->
					<?php
				} else {
					$_SESSION['login_user'] = $_POST['username'];
					$_SESSION['pic']=$row['pic'];
					?>
					<script type="text/javascript">
						window.location = "student/index.php";
					</script> 
					<?php
				}
			}
		}
		?>

	</body>
	</html>