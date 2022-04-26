<?php
include "connection.php";
include "navbar.php";
?>
<html>
<head>
    <title>Forgot Password</title>
    
    <style type="text/css">
        body{
            background-image: url('images/pass.jpg');
            background-size: 100%;
        }
        .wrapper{
            width: 400px;
            height: 400px;
            margin: 100px auto;
            background-color: black;
            opacity: .8;
            color: white;
            padding: 27px 15px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1 style="text-align: center;font-size: 35px">Password Reset</h1><br>

        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" class="form-control" required=""><br>
            <input type="email" name="email" placeholder="Email" class="form-control" required=""><br>
            <button type="submit" name="submit" class="btn btn-primary">Generate OTP</button>

        </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $_SESSION['un']=$_POST['username'];
        $_SESSION['em']=$_POST['email'];
        $u = mysqli_query($db, "SELECT * FROM student WHERE username='$_POST[username]' AND email='$_POST[email]';");
        $r = mysqli_fetch_array($u);
        if (isset($r['username']) == $_POST['username'] && isset($r['email']) == $_POST['email']) {

           $otp=rand(10000,99999);
           mysqli_query($db,"INSERT INTO otp VALUES ('$_POST[username]','$otp')");

           mail($_POST['email'], "Password Reset","Your OTP for Password update is ".$otp ); 
           ?>
           <!---------------------------------------Enter OTP sent to your registered email address---------------------------------------------->
           <!-- The Modal -->
           <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">OTP sent to your registered email address Successfully</h4>
                        <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="forgot.php">&times;</a></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post" action="">
                            <input type="Password" name="newpass" class="form-control" placeholder="New Password" required=""><br>
                            <input type="Password" name="conpass" class="form-control" placeholder="Confirm Password" required=""><br>
                            <input type="text" name="otp" class="form-control" placeholder="Enter OTP" required="">
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                         <button name="update" type="submit" class="btn btn-primary">Update</button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     <div class="modal-backdrop fade show"></div>
     <!-------------------------Enter OTP sent to your registered email address--------------------------------------------------->
     <?php
 } else {
    ?>
    <!----------------------------------------Invalid Username or email. Please try again.---------------------------------------------->
    <!-- The Modal -->
    <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Invalid Username or email. Please try again. &#10060;</h4>
                    <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="forgot.php">&times;</a></button>
                </div>



                <!-- Modal footer -->
                <div class="modal-footer">

                    <button name="ok" type="button" class="btn btn-dark"><a style="text-decoration: none;color: white;" href="forgot.php">OK</a></button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <!-------------------------Invalid Username or email. Please try again.---------------------------------------------------->
    <?php
}
}
?>

<?php

if (isset($_POST['update'])) {
    $u1 = mysqli_query($db, "SELECT * FROM student WHERE username='$_SESSION[un]' AND email='$_SESSION[em]';");
    $r1 = mysqli_fetch_array($u1);
    $u2 = mysqli_query($db, "SELECT * FROM otp WHERE username='$r1[username]'");
    $r2 = mysqli_fetch_array($u2);

    if ($_POST['newpass'] == $_POST['conpass'] && $_POST['otp'] == $r2['otp']) {
        $v=mysqli_query($db, "UPDATE student SET password='$_POST[newpass]' WHERE username='$_SESSION[un]'");
        if ($v) {
            mysqli_query($db,"DELETE FROM otp WHERE username='$r2[username]'");
            ?>
            <!----------------------------------------password updated successfully---------------------------------------------->
    <!-- The Modal -->
    <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Password Updated Successfully.&#9989;</h4>
                    <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="forgot.php">&times;</a></button>
                </div>



                <!-- Modal footer -->
                <div class="modal-footer">

                    <button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="student_login.php">Login</a></button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <!-------------------------Password Updated Successfully.---------------------------------------------------->
            <?php
        }

    }
    else
    {

        ?>
        <!----------------------------------------Password not matched or Invalid OTP---------------------------------------------->
    <!-- The Modal -->
    <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Password not matched or Invalid OTP &#10060;</h4>
                    <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="forgot.php">&times;</a></button>
                </div>



                <!-- Modal footer -->
                <div class="modal-footer">

                    <button name="ok" type="button" class="btn btn-dark"><a style="text-decoration: none;color: white;" href="forgot.php">OK</a></button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <!-------------------------Password not matched or Invalid OTP---------------------------------------------------->
        <?php
        
        mysqli_query($db,"DELETE FROM otp WHERE username='$r2[username]';");
    }
    
}

?>
</body>
</html>
