<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	
	<style type="text/css">
		.left_box{
			height: 653px;
			width: 500px;
			float: left;
			background-color: #cef261;
		}
		.left_box2{
			height: 653px;
			width: 300px;
			background-color: #6bf261;
			border-radius: 20px;
			float: right;
			margin-right: 30px;
		}
		.left_box input{
			width: 150px;
			background-color: #6bf261;
			padding: 10px;
			margin: 10px;
			border-radius: 10px;
		}
		.list{
			height: 500px;
			width: 300px;
			background-color: #6bf261;
			float: right;
			color: white;
			overflow-y: scroll;
			overflow-x: hidden;
		}
		.right_box{
			height: 653px;
			width: 1036px;
			margin-left: 500px;
			background-color: #cef261;
		}
		.right_box2{
			height: 653px;
			width: 866px;
			background-color: #6bf261;
			border-radius: 20px;
			float: left;
			
		}
		.center{
			height: 60px;
			width: 60px;
			padding-right: unset;
			border-radius: 50%;
		}
		tr:hover{
			background-color: #52be4a;
			cursor: pointer;
		}
		.form-control{
			width: 83%;
		}
		.msg{
			height: 510px;
			
			overflow-y: scroll;
		}
		.chat{
			display: flex;
			flex-flow: row wrap;
			margin-left: 40px;

		}
		.user .chatbox{
			height: 50px;
			width: 715px;
			padding: 10px;
			background-color: #118040;
			border-radius: 10px;
			margin-left: 15px;
			margin-right: 8px;
		}

		.admin .chatbox{
			height: 50px;
			width: 715px;
			padding: 10px;
			background-color: #115f80;
			border-radius: 10px;
			margin-right: 15px;
			order: -1;
		}
		.cen{
			height: 50px;
			width: 50px;
			padding-right: unset;
			border-radius: 50%;
		}
		.tenor{
			padding-right:unset;
			max-height: unset;
			max-width: unset;
			height: 93%;
			width: 100%;
			padding: 30px;
			border-radius: 50%;

		}
	</style>    
</head>
<body>
	<?php 

	$sql1=mysqli_query($db,"SELECT student.pic,message.username FROM student INNER JOIN message ON student.username=message.username GROUP BY username ORDER BY status;");

	?>
	<!-----------------------left box-------------------------->
	<div class="left_box">
		<div class="left_box2">
			<div>
				<form method="post" enctype="multipart/form-data">
					<input type="text" name="username" id="uname">
					<button type="submit" name="submit" class="btn btn-secondary">SHOW</button>
				</form>
			</div>
			<div class="list">
				<?php 
				echo "<table id='table' class='table'>";
				while ($res1=mysqli_fetch_assoc($sql1)) {


					echo "<tr>";
					echo "<td>"; echo "<img class='center' src='images/".$res1['pic']."'>"; echo "</td>";
					echo "<td style='padding:30px;'>"; echo $res1['username']; echo "</td>";
					echo "</tr>";
				}
				echo "</table>";
				?>
			</div>
		</div>
	</div>
	<!-----------------------right box-------------------------->
	<div class="right_box">
		<div class="right_box2">
			<br>
			<?php 
			/*----------------------if submit is pressed---------------------*/
			if (isset($_POST['submit'])) {

				$res=mysqli_query($db,"SELECT * FROM message where username='$_POST[username]';");

				mysqli_query($db,"UPDATE message SET status='YES' where sender='student' and username='$_POST[username]';");

				if($_POST['username'] != '') 
				{
					$_SESSION['username']=$_POST['username'];
				}

				?>
				<div style="height: 70px;width: 100%;text-align: center;">
					<h3 style="margin-top: -10px;"><?php echo $_SESSION['username']; ?></h3>	
				</div>
				<div class="msg">
					<?php
					while ($row=mysqli_fetch_assoc($res)) {
						if ($row['sender']=='STUDENT') {
							?>
							<br>
							<div class="chat user">
								<div style="float: left;"> 
									<img class="cen" src="images/user.jpg">
									
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
								<div style="float: left;"> 
									<?php
									echo "<img class='cen' src='images/" . $_SESSION['pic'] . "'>";
									?>
								</div>&nbsp;&nbsp;
								<div style="float: left;" class="chatbox">
									<?php 
									echo $row['message'];
									?>
								</div>
							</div>
						<?php } } ?>
					</div>

					<div style="margin-left: 40px;">
						<form action="" method="post">
							<input class="form-control" type="text" name="msg" required="" placeholder="Write message..." style="float: left;">&nbsp;&nbsp;&nbsp;
							<button class="btn btn-primary" type="submit" name="submit1"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
						</form>
					</div>

					<?php
				}
				/*----------------------if submit is not pressed---------------------*/
				else
				{
					if ($_SESSION['username']=='') {
						?>
						<img class="tenor" src="images/tenor.gif" alt="animated" >
						<?php
					}
					else
					{
						if(isset($_POST['submit1'])){
							mysqli_query($db,"INSERT INTO message VALUES ('','$_SESSION[username]','$_POST[msg]','NO','admin');");
							$res=mysqli_query($db,"SELECT * FROM message where username='$_SESSION[username]'");
						}else{
							$res=mysqli_query($db,"SELECT * FROM message where username='$_SESSION[username]'");
						}?>
						<div style="height: 70px;width: 100%;text-align: center;">
							<h3 style="margin-top: -10px;"><?php echo $_SESSION['username']; ?></h3>	
						</div>

						<div class="msg">
							<?php
							while ($row=mysqli_fetch_assoc($res)) {
								if ($row['sender']=='STUDENT') {

									
									?>
									<br>
									<div class="chat user">
										<div style="float: left;"> 
											<img class="cen" src="images/user.jpg">
											
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
										<div style="float: left;"> 
											<?php
											echo "<img class='cen' src='images/" . $_SESSION['pic'] . "'>";
											?>
										</div>&nbsp;&nbsp;
										<div style="float: left;" class="chatbox">
											<?php 
											echo $row['message'];
											?>
										</div>
									</div>
								<?php } } ?>
							</div>

							<div style="margin-left: 40px;">
								<form action="" method="post">
									<input class="form-control" type="text" name="msg" required="" placeholder="Write message..." style="float: left;">&nbsp;&nbsp;&nbsp;
									<button class="btn btn-primary" type="submit" name="submit1"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
								</form>
							</div>


							<?php

							

						}
					}
					?>
				</div>
			</div>
			<script type="text/javascript">
				var table=document.getElementById('table'),eIndex; 
				for (var i = 0; i< table.rows.length;i++) {
					table.rows[i].onclick=function(){
						rIndex=this.rowIndex;
						document.getElementById("uname").value=this.cells[1
						].innerHTML;
					}
				}
			</script>
		</body>
		</html>