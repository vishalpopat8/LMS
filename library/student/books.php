<?php
include "connection.php";
include "navbar.php";
?>
<html>

<head>
    <title>Books</title>
    
    <style type="text/css">
        .mydiv{
            margin-left: 20px;
            margin-top: 20px;
            display:  inline-flex;

        }
        .search{
            float: right;
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
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            padding-right: unset;
            border-radius: 50%;
        }

        .rq {
            position: relative;
            top: 5px;
            left: 22px;
            height: 27px;
            width: 498px;

        }

        marquee {
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .scroll{
            width: 100%;
            height: 402px;
            overflow: auto;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['login_user'])) {
        ?>
        <center>
            <h1 style="position: absolute;left: 45%;margin-top: 10px;">Books</h1>
        </center>
        <?php
    } else {

        ?>
        <center>
            <h1 style="position: relative;margin-top: 10px;">Books</h1>
        </center>
        <?php

    }
    ?>
    <!-------------------------------sidenav------------------------------------------>

    <?php
    if (isset($_SESSION['login_user'])) {
        ?>

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
            <a href="request.php">Book Request</a>
            <a href="issue_info.php">Issue Information</a>
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

            <?php
        }
        ?>

        <!--------------------------------------------- search bar ---------------------------------------->
        <br>
        <div class="search">
            <form class="navbar-form" method="post" name="form1">
                <div class="mydiv">
                    <br><input style="width: 500px;" class="form-control" type="text" name="search" placeholder="search books.." required="">&nbsp;&nbsp;&nbsp;&nbsp;
                    <button style="background-color: #cbce86;" type="submit" name="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                </div>


            </form>

            <!---------------------------------------request book--------------------------->

            <?php
            if (isset($_SESSION['login_user'])) {
                ?>

                <form class="navbar-form" method="post" name="form1">
                    <div class="mydiv">
                        <br><input style="width: 500px;" class="form-control" type="text" name="bid" placeholder="Enter Book ID" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                        <button style="background-color: #cbce86;" type="submit" name="submit1" class="btn btn-secondary">Request</button>
                    </div>
                </form>

                <div class="rq">
                    <marquee class="alert-danger">
                        Maximum 3 books can be requested or issued
                    </marquee>
                </div>
                <?php
            }
            ?>
        </div>

        <br><br><br><br><br>
        
        <?php
        if (isset($_POST['submit'])) {
            $q = mysqli_query($db, "SELECT * FROM books where name like '%$_POST[search]%'");
            if (mysqli_num_rows($q) == 0) {
                ?>
                <!--------------------------------------------------No Book Found------------------------------------------------------------->
                <!-- The Modal -->
                <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Sorry! No Books Found. Please try again.</h4>
                                <button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                            </div>



                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <form method="post" action="">
                                    <button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade show"></div>
                <!--------------------------------------------No Book Found---------------------------------------------------->
                <?php
            } else {
                echo "<h2 style='margin: auto;'>List of Books</h2>";
                echo "<div class='scroll'>";
                
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #cbce86;'>";
                echo "<th>";
                echo "ID";
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
                echo "Quantity";
                echo "</th>";
                echo "<th>";
                echo "Department";
                echo "</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($q)) {
                    echo "<tr>";
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
                    echo $row['quantity'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['department'];
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
        } else {
            $res = mysqli_query($db, "select * from books;");
            echo "<h2 style='margin: auto;'>List of Books</h2>";
            echo "<div class='scroll'>";
            
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color: #cbce86;'>";
            echo "<th>";
            echo "ID";
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
            echo "Quantity";
            echo "</th>";
            echo "<th>";
            echo "Department";
            echo "</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
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
                echo $row['quantity'];
                echo "</td>";
                echo "<td>";
                echo $row['department'];
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }
        if (isset($_POST['submit1'])) {
            if (isset($_SESSION['login_user'])) {
                $sa1 = mysqli_query($db, "SELECT * FROM books WHERE status='Not Available' and bid='$_POST[bid]';");

                $ca1 = mysqli_num_rows($sa1);

                if ($ca1 == 0) {
                    $s1 = mysqli_query($db, "SELECT * FROM issue_book WHERE username='$_SESSION[login_user]' and (approve='APPROVED' or approve='PENDING');");

                    $c1 = mysqli_num_rows($s1);

                    if ($c1 > 2) {
                        ?>
                        <!-------------------------------You have already requested or issued 3 Books.-------------------------------------->

                        <!-- The Modal -->
                        <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">You have already requested or issued 3 Books.</h4>
                                        <button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                                    </div>



                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <form method="post" action="">
                                            <button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-backdrop fade show"></div>
                        <!--------------------------------------------You have already issued 3 Books.------------------------------------------------->
                        <?php
                    } else {
                        $sa2 = mysqli_query($db, "SELECT * FROM issue_book WHERE bid = '$_POST[bid]' and username = '$_SESSION[login_user]' and (approve='PENDING' OR approve='APPROVED')");
                        $ra2 = mysqli_fetch_assoc($sa2);
                        $ca2 = mysqli_num_rows($sa2);
                        if (isset($ra2['bid']) == $_POST['bid']) {
                            ?>
                            <!------------------------------------------This book has already been issued------------------------------------------->

                            <!-- The Modal -->
                            <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">This book has already been issued or requested</h4>
                                            <button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                                        </div>



                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <form method="post" action="">
                                                <button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-backdrop fade show"></div>
                            <!-----------------------------------------This book has already been issued-------------------------------------------->
                            <?php
                        } else {
                            $sql1 = mysqli_query($db, "SELECT * FROM books WHERE bid='$_POST[bid]';");
                            $row1 = mysqli_fetch_assoc($sql1);
                            $count1 = mysqli_num_rows($sql1);
                            if ($count1 != 0) {
                                mysqli_query($db, "INSERT INTO issue_book VALUES ('$_SESSION[login_user]','$_POST[bid]','PENDING','--','--');");

                                ?>
                                <!----------------------------------------------Book Requested Successfully------------------------------------------->

                                <!-- The Modal -->
                                <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Book Requested Successfully &#9989;</h4>
                                                <button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                                            </div>



                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form method="post" action="">
                                                    <button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                                                    <button name="request" type="button" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="request.php">See
                                                    Requests</a></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-backdrop fade show"></div>
                                <!--------------------------------------------Book Requested Successfully----------------------------------------------->
                                <?php

                            } else {
                                ?>
                                <!----------------------------------------------No Book available------------------------------------------------------------->

                                <!-- The Modal -->
                                <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">This Book is not Available in Library</h4>
                                                <button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                                            </div>



                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form method="post" action="">
                                                    <button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-backdrop fade show"></div>
                                <!--------------------------------------------No Book available---------------------------------------------------->
                                <?php
                            }
                        }
                    }
                } else {
                    ?>

                    <!----------------------------------------------This Book is currenty not Available------------------------------------------>

                    <!-- The Modal -->
                    <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">This Book is currenty not Available</h4>
                                    <button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                                </div>



                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <form method="post" action="">
                                        <button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                    <!--------------------------------------This Book is currenty not Available------------------------------------------------>

                    <?php
                }
            } else {
                ?>
                <script type="text/javascript">
                    alert("You need to Login First To request a Book");
                </script>
                <?php
            }
        }

        ?>
    </body>

    </html>