<?php
include "connection.php";
include "navbar.php";
?>
<html>
<head>
    <title>Fine</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style type="text/css">
        .mydiv{
            margin-left: 20px;
            margin-top: 20px;
            display:  inline-flex;

        }
        .search{
            padding-left: 900px; 
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
        .scroll{
            width: 100%;
            height: 498px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <h1 style="left: 45%;position: absolute;">Fine</h1>
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
        <!--------------------------------------------- search bar ---------------------------------------->
        <br><br>
        <h2 style="margin: auto;">List of Students</h2>
        <?php

        $res = mysqli_query($db, "SELECT * FROM issue_book where username='$_SESSION[login_user]' and approve='APPROVED';");
        echo "<div class='scroll'>";
        echo "<table class='table table-bordered table-hover'>";
        echo "<tr style='background-color: #cbce86;'>";
        echo "<th>";
        echo "Username";
        echo "</th>";
        echo "<th>";
        echo "Book ID";
        echo "</th>";
        echo "<th>";
        echo "Expected Return Date";
        echo "</th>";
        echo "<th>";
        echo "Days";
        echo "</th>";
        echo "<th>";
        echo "Fine";
        echo "</th>";
        echo "</tr>";

        

        while ($row = mysqli_fetch_assoc($res)) {
            $return_date = $row['return'];
            list($return_year, $return_month, $return_day) = explode('-', $return_date);

                $now = time(); // or your date as well
                $your_date = strtotime($return_date);
                $datediff = round(($now - $your_date) / (60 * 60 * 24));

                
                echo "<tr>";
                echo "<td>";
                echo $row['username'];
                echo "</td>";
                echo "<td>";
                echo $row['bid'];
                echo "</td>";
                echo "<td>";
                echo "{$return_day}-{$return_month}-{$return_year}";
                echo "</td>";
                echo "<td>";
                if ($datediff>0) {
                    echo ($datediff);
                }
                else
                {
                    echo "-";
                }
                echo "</td>";
                echo "<td>";
                if ($datediff>0) {
                    echo "&#8377;" . $datediff*2;
                }
                else
                {
                    echo "-";
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
            ?>
        </body>
        </html>
