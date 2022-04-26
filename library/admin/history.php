<?php
include "connection.php";
include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>History</title>
    
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
        .s{
            position: relative;
            width: 1510px;
            height: 411px;
            overflow: auto;
        }
        
        thead th{
            position: sticky;
            top: 0;
            background: #f1c242;
        }
        table{
            display: none;

        }
        .custom-control-input:checked~.custom-control-label::before {
            color: #fff;
            border-color: #f1c242;
            background-color: #f1c242;
        }
        .mydiv{
            display: inline-flex;
            float: right;
        }
    </style>
    <script type="text/javascript">
        function div(x) {
            if (x=="1") 
            {
                document.getElementById('s1').style.display="table";
                document.getElementById('s2').style.display="none";
            }
            if (x=="2") 
            {
                document.getElementById('s2').style.display="table";
                document.getElementById('s1').style.display="none";

            }
            return;
        }
    </script>
</head>
<body>
    <center>
        <h1 style="position: absolute;left:45%;margin-top: 10px;">History</h1>
    </center>
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

        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span><br><br><br>


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

        <form class="navbar-form" method="post" name="form1">
            <div class="mydiv">
                <br><input style="width: 400px;" class="form-control" type="text" name="username" placeholder="search Student Username" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                <button style="background-color: #cbce86;" type="submit" name="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
            </div>


        </form>
        <?php
        if (isset($_POST['submit'])) {

            $q1 = mysqli_query($db, "SELECT * FROM history_issue WHERE username='$_POST[username]'");
            $q2 = mysqli_query($db, "SELECT * FROM history_return WHERE username='$_POST[username]'");
            if (mysqli_num_rows($q1)==0 && mysqli_num_rows($q2)==0) {
                ?>
                <!--------------------------------------------------No Student Found------------------------------------------------------------->



                <!-- The Modal -->
                <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Sorry! No Student Found with that Username. Please try again.</h4>
                                <button type="button" class="close" data-dismiss="modal"><a style="text-decoration: none;color: #808080;" href="history.php">&times;</a></button>
                            </div>



                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <form method="post" action="">
                                    <button name="ok" type="submit" class="btn btn-primary" data-dismiss="modal"><a style="text-decoration: none;color: white;" href="history.php">OK</a></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade show"></div>
                <!--------------------------------------------No Student Found---------------------------------------------------->
                <?php
            }else{
                ?>

                <div style="display: flex;justify-content: center;" class="input-group mb-3">


                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="defaultUnChecked" name="book" onclick="div('1')">
                        <label class="custom-control-label"  for="defaultUnChecked">Show Issued Books</label>
                    </div>

                    <!-- Default unchecked -->
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="defaultUnchecked" name="book" onclick="div('2')">
                        <label class="custom-control-label"  for="defaultUnchecked">Show Returned Books</label>
                    </div>

                </div>

                <br> 

                <?php 
                $res = mysqli_query($db, "SELECT * FROM history_issue WHERE username='$_POST[username]'");

                echo "
                <div class='s'>

                <table class='table table-bordered table-hover' id='s1'>
                <thead>
                <tr>
                <th colspan='7' style='text-align: center;font-size: 30px;FONT-FAMILY: -webkit-pictograph;font-weight:bold;'>Issued Book</th>
                </tr>
                <tr>
                <th>Student Username</th>
                <th>Enrollment No.</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Author Name</th>
                <th>Edition</th>
                <th>Book Issue Date</th>
                </tr>
                </thead>
                <tbody>
                ";
                while ($row = mysqli_fetch_assoc($res))
                {
                    $issue_date = $row['issue'];
                    list($issue_year, $issue_month, $issue_day) = explode('-', $issue_date);

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
                    echo $row['bname'];
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
                    echo "</tr>";

                }

                echo "</tbody>";
                echo "</table>";

                $res1 = mysqli_query($db, "SELECT * FROM history_return WHERE username='$_POST[username]'");

                echo 
                "
                <table class='table table-bordered table-hover' id='s2'>
                <thead>
                <tr>
                <th colspan='8' style='text-align:center;font-size: 30px;FONT-FAMILY: -webkit-pictograph;font-weight:bold;'>Returned Book</th>
                </tr>
                <tr>
                <th>Student Username</th>
                <th>Enrollment No.</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Author Name</th>
                <th>Edition</th>
                <th>Book Return Date</th>
                <th>Fine paid(If any)</th>
                </tr>
                </thead>
                <tbody>
                ";

                while ($row1 = mysqli_fetch_assoc($res1))
                {
                    $return_date = $row1['return'];
                    list($return_year, $return_month, $return_day) = explode('-', $return_date);

                    echo "<tr>";
                    echo "<td>";
                    echo $row1['username'];
                    echo "</td>";
                    echo "<td>";
                    echo $row1['enrol'];
                    echo "</td>";
                    echo "<td>";
                    echo $row1['bid'];
                    echo "</td>";
                    echo "<td>";
                    echo $row1['bname'];
                    echo "</td>";
                    echo "<td>";
                    echo $row1['authors'];
                    echo "</td>";
                    echo "<td>";
                    echo $row1['edition'];
                    echo "</td>";
                    echo "<td>";
                    echo "{$return_day}-{$return_month}-{$return_year}";
                    echo "</td>";
                    echo "<td>";
                    echo $row1['fine_paid'];
                    echo "</td>";
                    echo "</tr>";

                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
        }
        ?>

    </div>
</body>
</html>