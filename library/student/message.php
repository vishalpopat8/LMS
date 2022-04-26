<?php
include "connection.php";
include "navbar.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Message</title>
	
	<style type="text/css">
		body{
			background-image: url("images/msg.jpg");
			width: : 100%;
		}
		.wrapper{
			height: 654px;
			width: 500px;
			background-color: black;
			opacity: .8;
			color: white;
			margin:  auto;
			padding: 10px;
		}
		.form-control{

			width: 77%;
		}
		.msg{
			height: 510px;
			
			overflow-y: scroll;
		}
		.chat{
			display: flex;
			flex-flow: row wrap;

		}
		.user .chatbox{
			height: 50px;
			width: 400px;
			padding: 10px;
			background-color: #118040;
			border-radius: 10px;
			order: -1;
			margin-right: 8px;
		}

		.admin .chatbox{
			height: 50px;
			width: 400px;
			padding: 10px;
			background-color: #115f80;
			border-radius: 10px;
		}
		.center{
			border-radius: 50%;
			padding-right: unset;
			height: 40px;
			width: 40px;
		}

	</style>
</head>
<body>

	<?php

	if (isset($_POST['submit'])) {
		mysqli_query($db,"INSERT INTO message VALUES ('','$_SESSION[login_user]','$_POST[msg]','NO','STUDENT');");

		$res=mysqli_query($db,"SELECT * FROM message WHERE username='$_SESSION[login_user]';");
	}
	else
	{
		$res=mysqli_query($db,"SELECT * FROM message WHERE username='$_SESSION[login_user]';");
	}
	mysqli_query($db,"UPDATE message SET status='YES' WHERE sender='admin' and username='$_SESSION[login_user]';");
	?>

	<div class="wrapper">
		<div style="height: 70px; width: 100%;background-color: #3f85e9;text-align: center;color: white;">
			<h3 style="padding-top: 15px;">ADMIN</h3>
		</div>
		<div class="msg">
			<?php
			while ($row=mysqli_fetch_assoc($res)) {
				if ($row['sender']=='STUDENT') {
					
							
			?>
			<br>
			<div class="chat user">
				<div style="float: left;padding-top: 5px;"> 
					<?php
					echo "<img class='center' src='images/" . $_SESSION['pic'] . "'>";
					?>
				</div>
				<div style="float: left;" class="chatbox">
					<?php 
					echo $row['message'];
					?>
				</div>
			</div>
		<?php }
		else{



		 ?>
			
		 	<br>
			<div class="chat admin">
				<div style="float: left;padding-top: 5px;"> 
					<img class="center" src="images/user.jpg">
				</div>&nbsp;&nbsp;
				<div style="float: left;" class="chatbox">
					<?php 
					echo $row['message'];
					?>
				</div>
			</div>
		<?php } } ?>
		</div>

		<div style="padding-top: 10px;">
			<form action="" method="post">
				<input class="form-control" type="text" name="msg" required="" placeholder="Write message..." style="float: left;">&nbsp;&nbsp;&nbsp;
				<button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
			</form>
		</div>
	</div>

	
</body>
</html>