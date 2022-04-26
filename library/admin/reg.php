<?php
include "connection.php";
include "navbar.php";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    
</head>
<body>

    <section>

        <div class="stu_reg">
            <br><br>
            <div class="box2">

                <h1 style="text-align: center;font-size: 35px">Admin Registration</h1><br>
                <form name="reg" action="" method="post" style="text-align: center;">
                    <input class="form-control" style="height: 30px;width: 400px;" type="text" name="fname" placeholder="First Name" required><br>
                    <input class="form-control" style="height: 30px;width: 400px;"  type="text" name="lname" placeholder="Last Name" required><br>
                    <input class="form-control" style="height: 30px;width: 400px;"  type="text" name="username" placeholder="Username" required><br>
                    <input class="form-control" style="height: 30px;width: 400px;"  type="password" name="password" placeholder="Password" required><br>
                    
                    <input class="form-control" style="height: 30px;width: 400px;"  type="email" name="email" placeholder="Email" required><br>
                    <input class="form-control" style="height: 30px;width: 400px;"  type="number" name="contact" placeholder="Mobile No." maxlength="10" size="10" required><br>
                    <input type="submit" name="reg" value="Register" class="btn-warning" style="height: 30px;width: 100px;border-radius: 5px"><br><br>

                </form>

            </div>
        </div>

    </section>

    <?php
    if (isset($_POST['reg'])) {

        $count = 0;
        $sql = "select username from admin";
        $res = mysqli_query($db, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            if ($row['username'] == $_POST['username']) {
                $count = $count + 1;
            }
        }

        if ($count == 0) {

            mysqli_query($db, "INSERT INTO admin VALUES ('','$_POST[fname]','$_POST[lname]','$_POST[username]','$_POST[password]','$_POST[email]','$_POST[contact]','user.jpg','');");
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
                        <!-- Modal body -->
                            <div class="modal-body">
                                <b><u>Note</u>:-</b>You can login after you are approved as admin.
                            </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <form method="post" action="">
                                <button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;"href="../login.php">Login</a></button>
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