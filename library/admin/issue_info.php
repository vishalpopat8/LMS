<?php
include "connection.php";
include "navbar.php";
?>
<html>
<head>
    <title>Issue Book Information</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
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
        
        .mydiv{
            margin: 20px;
            
            display:  inline-flex;
            float: right;

        }
        .scroll{
            width: 100%;
            height: 470px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <h1 style="position: absolute;left: 35%;margin-top: 10px;">Issued Book Information</h1>
    <!-------------------------------sidenav------------------------------------------>
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
        <div>
            
                <form class="navbar-form" method="post" name="form1">
                    <div class="mydiv">
                        <br><input style="width: 500px;" class="form-control" type="text" name="search" placeholder="search Student username" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                        <button style="background-color: #cbce86;" type="submit" name="search1" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            <br>

            <?php
            
            
            if (isset($_POST['search1'])) {
                $q=mysqli_query($db,"SELECT student.username,enrol,books.bid,name,authors,edition,issue,issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve='APPROVED' AND issue_book.username like '%$_POST[search]%' ORDER BY issue_book.return ASC");
                if (mysqli_num_rows($q) == 0) {
                    ?>
                    <!--------------------------------------------------No student Found----------------------------------------------------->
                    <!-- The Modal -->
                    <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">No Student Found</h4>
                                    <button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="return.php">&times;</a></button>
                                </div>



                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <form method="post" action="">
                                        <button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="return.php">OK</a></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                    <!--------------------------------------------No student Found---------------------------------------------------->
                    <?php
                }
                else
                {
                    echo "<div class='scroll'>";
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
                    echo "Book Issue Date";
                    echo "</th>";
                    echo "<th>";
                    echo "Expected Book Return Date";
                    echo "</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_assoc($q)) {

                        $issue_date = $row['issue'];
                        list($issue_year, $issue_month, $issue_day) = explode('-', $issue_date);

                        $return_date = $row['return'];
                        list($return_year, $return_month, $return_day) = explode('-', $return_date);

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
                        echo "{$issue_day}-{$issue_month}-{$issue_year}";
                        echo "</td>";
                        echo "<td>";
                        echo "{$return_day}-{$return_month}-{$return_year}";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
            }
            else
            {
                $sql = "SELECT student.username,enrol,books.bid,name,authors,edition,issue,issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve='APPROVED' ORDER BY issue_book.return ASC";
                $res = mysqli_query($db, $sql);
                echo "<div class='scroll'>";
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
                echo "Book Issue Date";
                echo "</th>";
                echo "<th>";
                echo "Expected Book Return Date";
                echo "</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($res)) {

                    $issue_date = $row['issue'];
                    list($issue_year, $issue_month, $issue_day) = explode('-', $issue_date);

                    $return_date = $row['return'];
                    list($return_year, $return_month, $return_day) = explode('-', $return_date);

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
                    echo "{$issue_day}-{$issue_month}-{$issue_year}";
                    echo "</td>";
                    echo "<td>";
                    echo "{$return_day}-{$return_month}-{$return_year}";
                    echo "</td>";
                    echo "</tr>";
                }
            }

            echo "</table>";
            echo "</div>";
            


            ?>

        </div>
    </div>
</body>
</html>