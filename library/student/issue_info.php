<?php
include "connection.php";
include "navbar.php";
?>
<html>

<head>
    <title>Issue Book Information</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .mydiv {
            margin-left: 20px;
            margin-top: 20px;
            display: inline-flex;

        }

        .search {
            padding-left: 850px;
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

        .scroll {
            width: 100%;
            height: 433px;
            overflow: auto;
        }

        .center {
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
        <div>


            <?php
            $c = 0;
            if (isset($_SESSION['login_user'])) {
                ?>
                <h1 style="text-align: center;">Issued Book Information</h1><br>
                <?php
                $sql = "SELECT student.username,enrol,books.bid,name,authors,edition,issue,issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve='APPROVED' and issue_book.username='$_SESSION[login_user]' ORDER BY issue_book.return ASC";
                $res = mysqli_query($db, $sql);
                echo "<div class='scroll'>";
                echo "<table class='table table-bordered table-hover'>
                <tr style='background-color: #cbce86;'>
                <th>Student Username</th>
                <th>Student Enrollment No.</th> 
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Author Name</th>
                <th>Edition</th>
                <th>Book Issue Date</th>
                <th>Expected Book Return Date</th>
                </tr>";

                while ($row = mysqli_fetch_assoc($res)) {

                    $d = date("Y-m-d");
                    if ($d > $row['return']) {
                        $c = $c + 1;
                        $var = '<p style="color:yellow;background-color:red;">EXPIRED</p>';
                        mysqli_query($db, "UPDATE issue_book SET approve='$var' where `return`='$row[return]' and approve='APPROVED' limit $c;");
                    }

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
            } else {
                ?>
                <br>
                <h4 style="color: yellowgreen;text-align: center;">Login to see Issued Book Information</h4>
                <?php
            }
            ?>

        </div>
    </div>
</body>

</html>