<?php
include 'connection.php';
include 'navbar.php';
?>
<html>
<head>
    <title>Edit Profile</title>
    
    <style type="text/css">

        form{
            padding-left:  615px;
            margin-right: 540px;

        }


    </style>
</head>
<body style="background-color: #8f9c50;">
    <h2 style="text-align: center;margin-top: 8px;">Edit Information</h2>

    <?php
    $sql = "SELECT * FROM student WHERE username='$_SESSION[login_user]'";
    $result = mysqli_query($db, $sql) or die(mysql_error());
    while ($row = mysqli_fetch_assoc($result)) {
        $fname = $row['fname'];
        $lname = $row['lname'];
        $username = $row['username'];
        $password = $row['password'];
        $enrol = $row['enrol'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
    ?>

    <div class="profile_info" style="text-align: center;">
        <span style="color: white;">Welcome</span>
        <h4 style="color: white;"><?php echo $_SESSION['login_user']; ?> </h4>
    </div>

    <div > 
        <form action="" method="post" enctype="multipart/form-data">

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">Profile Picture</label>
                </div>
                <input type="file" name="file" class="form-control" required="">                    
            </div>



            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">Name</label>
                </div>
                <input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php echo $fname; ?>">
                <input type="text" name="lname" class="form-control" placeholder="Last Name" value="<?php echo $lname; ?>">
            </div>  

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Username</span>
                </div>
                <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">

            </div>  

            <div style="margin-right:100px;" class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Password</span>
                </div>
                <input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">

            </div> 

            <div style="margin-right:100px;" class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Enrollment No.</span>
                </div>
                <input type="text" name="enrol" class="form-control" placeholder="Enrollment No." value="<?php echo $enrol; ?>">

            </div>

            <div style="margin-right:100px;" class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">

            </div>  

            <div style="margin-right:100px;" class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Mobile No.</span>
                </div>
                <input type="text" name="phone" class="form-control" placeholder="Mobile No." value="<?php echo $phone; ?>">

            </div> 
            <div style="padding-left:130px;"><input class="btn btn-secondary" type="submit" name="submit" value="Update"></div>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        move_uploaded_file($_FILES['file']['tmp_name'], "images/" . $_FILES['file']['name']);

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $enrol = $_POST['enrol'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pic = $_FILES['file']['name'];

        $sql1 = "UPDATE student SET pic='$pic', fname='$fname',lname='$lname',username='$username',password='$password',enrol='$enrol',email='$email',phone='$phone' WHERE username='" . $_SESSION['login_user'] . "';";

        if (mysqli_query($db, $sql1)) {
            ?>
            <!------------------------------------------------------------------profile updated succesfully-------------------------------------------------->



            <!-- The Modal -->
            <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                <div class="modal-dialog modal-dialog-centered">

                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Profile Updated Successfully&#9989;</h4>
                      <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="edit.php">&times;</a></button>
                  </div>



                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <form method="post" action="">
                      <button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="profile.php">OK</a></button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <div class="modal-backdrop fade show"></div>
  <!------------------------------------------------------------------profile updated succesfully------------------------------------------------------------->
  <?php
}
}
?>

</body>
</html>
