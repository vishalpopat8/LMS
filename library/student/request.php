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
        if (isset($_SESSION['login_user'])) {
            $q = mysqli_query($db, "SELECT * FROM issue_book where username='$_SESSION[login_user]' and (approve='APPROVED' OR approve='PENDING');");
            if (mysqli_num_rows($q) == 0) {
                echo "<h2><b><CENTER>";
                echo "<br>There is no pending Request";
                echo "</h2></b></CENTER>";
            } else {

                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #cbce86;'>";
                echo "<th>";
                echo "Book ID";
                echo "</th>";
                echo "<th>";
                echo "Status (APPROVED/PENDING)";
                echo "</th>";
                echo "<th>";
                echo "Issue Date";
                echo "</th>";
                echo "<th>";
                echo "Return Date";
                echo "</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($q)) {


                    $issue_date = $row['issue'];
                    list($issue_year, $issue_month, $issue_day) = explode('-', $issue_date);

                    $return_date = $row['return'];
                    list($return_year, $return_month, $return_day) = explode('-', $return_date);
                    
                    echo "<tr>";
                    echo "<td>";
                    echo $row['bid'];
                    echo "</td>";
                    echo "<td>";
                    echo $row['approve'];
                    echo "</td>";
                    echo "<td>";
                    echo "{$issue_day}-{$issue_month}-{$issue_year}";
                    echo "</td>";
                    echo "<td>";
                    echo "{$return_day}-{$return_month}-{$return_year}";
                    echo "</td>";
                    echo "</tr>";


                }echo "</table>";
            }
        } else {
            echo "<br><br>";
            echo "<h2>Please Login First To see The Request</h2>";
        }
        ?>
    </body>
    </html>
