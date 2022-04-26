<?php
include "connection.php";
include "navbar.php";
?>
<html>
<head>
    <title>Book Request</title>
    
    <style type="text/css">
        .mydiv{
            margin-left: 20px;
            margin-top: 20px;
            display:  inline-flex;

        }
        .search{
            padding-left: 800px; 
        }
        body {
            background-image: url('images/book.jpg');
            background-size: 100%;
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
        form{
            display: inline-flex;
        }
    </style>
</head>
<body>
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




        <?php if (isset($_SESSION['login_user'])) { ?>
            <h3 style="text-align: center;">Pending Book Requests</h3> <br>
            <?php
            $sql = "SELECT student.username,enrol,books.bid,name,authors,edition,status FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve='PENDING';";
            $res = mysqli_query($db, $sql);

            if (mysqli_num_rows($res) == 0) {
                echo "<h2><b><CENTER>";
                echo "<br><br><br><br>There is no pending Request";
                echo "</h2></b></CENTER>";
            } else {
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #cbce86;'>";
                echo "<th>";
                echo "Student Username";
                echo "</th>";
                echo "<th>";
                echo "Student Enrollment No.";
                echo "</th>";
                echo "<th>";
                echo "Book ID";
                echo "</th>";
                echo "<th>";
                echo "Book Name";
                echo "</th>";
                echo "<th>";
                echo "Author Name";
                echo "</th>";
                echo "<th>";
                echo "Edition";
                echo "</th>";
                echo "<th>";
                echo "Status";
                echo "</th>";
                echo "<th>";
                echo "APPROVE/REJECT";
                echo "</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>";
                    echo $row['username'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['enrol'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['bid'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['name'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['authors'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['edition'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['status'];
                    echo "</td>";
                    echo "<td>";
                    echo "<form method='post' action=''><input type='hidden' value='$row[username]' name='username'><input type='hidden' value='$row[bid]' name='bid'><button type='submit' name='submit' class='btn btn-success'>APPROVE</button>&nbsp;&nbsp;<button type='submit' name='submit1' class='btn btn-danger'>REJECT</button></form>";
                    echo "</td>";
                    echo "</tr>";
                }echo "</table>";   
            }
        } else {
            ?>
            <br>
            <h4 style="color: yellowgreen; text-align: center;">Please Login First to see the Requests</h4>


            <?php
        }
        if (isset($_POST['submit'])) {
            $d=date("Y-m-d");
            $d1=date("Y-m-d", strtotime("+1 month"));
            mysqli_query($db, "UPDATE issue_book SET `approve`='APPROVED',`issue`='$d',`return`='$d1' WHERE `username`='$_POST[username] ' and `bid`='$_POST[bid]'"); 
            mysqli_query($db,"UPDATE books SET quantity=quantity-1 WHERE bid='$_POST[bid]'");
            
            $res1=mysqli_query($db,"SELECT quantity from books where bid=$_POST[bid]");

            while($row1=mysqli_fetch_assoc($res1))
            {
                if ($row1['quantity']==0) {
                    mysqli_query($db,"UPDATE books SET status='Not Available' WHERE bid='$_POST[bid]'");
                }
                else
                {
                    mysqli_query($db,"UPDATE books SET status='Available' WHERE bid='$_POST[bid]'");
                }
            }

            $res2=mysqli_query($db,"SELECT * FROM student WHERE username='$_POST[username]'");

            $row2=mysqli_fetch_assoc($res2);

            $res3=mysqli_query($db,"SELECT * FROM books WHERE bid='$_POST[bid]'");
            $row3=mysqli_fetch_assoc($res3);



            $dat=date("Y-m-d");

            mysqli_query($db,"INSERT INTO history_issue VALUES('$_POST[username]','$row2[enrol]','$_POST[bid]','$row3[name]','$row3[authors]','$row3[edition]','$dat')");
            

            ?>
            <script type="text/javascript">
                window.location="request.php";
            </script>
            <?php 
        }   

        if (isset($_POST['submit1'])) {



            mysqli_query($db, "UPDATE issue_book SET `approve`='REJECTED',`issue`='--',`return`='--' WHERE `username`='$_POST[username] ' and `bid`='$_POST[bid]'");

            mysqli_query($db,"DELETE FROM issue_book WHERE approve='REJECTED'");



            ?>
            <script type="text/javascript">
                window.location="request.php";
            </script>
            <?php
        }
        ?>
    </body>
    </html>