<?php
include 'connection.php';
include 'navbar.php';
?>
<html>
    <head>
        <title>Profile</title>
        
        <style type="text/css">
            .wrapper{
                width: 500px;
                height: 600px;
                margin: 0 auto;
                
                color: white;
            }
        </style>
    </head>
    <body style="background-color: #8f9c50">
        <div class="container">

            
            <div class="wrapper">
                <?php
                
                if(isset($_POST['submit']))
                {
                    ?>
                <script type="text/javascript">
                window.location="edit.php";
                </script>
                <?php
                }
                
                $q = mysqli_query($db, "SELECT * FROM student where username='$_SESSION[login_user]' ");
                ?>
                <h2 style="margin:20px;text-align:center;">My Profile</h2>
                <?php 
                $row = mysqli_fetch_assoc($q);

                echo "<div class='img-circle profile-img' style='text-align:center;margin-left:20px;'><img src='images/" . $_SESSION['pic'] . "'></div>";
                ?>
                <div style="text-align: center;">
                    <b>Welcome, </b>

                    <h4>
                        <?php
                        echo $row['fname']." ".$row['lname'];
                        ?>
                    </h4>
                </div>
                <?php
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr>";
                    echo "<td>";
                    echo "<b> Username : </b>";
                    echo "</td>";
                    echo "<td>";
                    echo $row['username'];
                    echo "</td>";
                echo "</tr>";
                
                
                
                echo "<tr>";
                    echo "<td>";
                    echo "<b> Enrollment No. : </b>";
                    echo "</td>";
                    echo "<td>";
                    echo $row['enrol'];
                    echo "</td>";
                echo "</tr>";
                
                echo "<tr>";
                    echo "<td>";
                    echo "<b> Email : </b>";
                    echo "</td>";
                    echo "<td>";
                    echo $row['email'];
                    echo "</td>";
                echo "</tr>";
                
                echo "<tr>";
                    echo "<td>";
                    echo "<b> Mobile No. : </b>";
                    echo "</td>";
                    echo "<td>";
                    echo $row['phone'];
                    echo "</td>";
                echo "</tr>";
                
                echo "</table>";
                ?>
                
                <form action="" method="post">
                <button class="btn btn-primary" style="margin-left:220px;background-color: #d9cd5d" name="submit">
                    Edit
                </button>
            </form>
            </div>
        </div>

    </body>
</html>
