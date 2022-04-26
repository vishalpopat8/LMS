<?php
include "connection.php";
include "navbar.php";
?>
<html>
<head>
    <title>Books</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        .rd{
            margin-top: 7px;
            margin-left: 20px;
        }
        .custom-control-input:checked~.custom-control-label::before{
            color: #fff;
            border-color: #d39e00;
            background-color: #f6f64c;
        }
        .scroll{
            width: 100%;
            height: 363px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION['login_user'])) {
        ?>
        <center><h1 style="position: absolute;left: 45%;margin-top: 10px;">Books</h1></center>
        <?php
    }
    else
    {

        ?>
        <center><h1 style="position: relative;margin-top: 10px;">Books</h1></center>
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
            <?php if (isset($_SESSION['login_user'])) { ?>
                <form class="navbar-form" method="post" name="form2">
                    <div class="mydiv">
                        <br><input style="width: 500px;" class="form-control" type="text" name="bid" placeholder="Enter Book ID" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                        <button  type="submit" name="submit1" class="btn btn-danger">Delete</button>
                    </div>


                </form>

                <form class="navbar-form" method="post" name="form3">
                    <div class="mydiv">
                        <br><input style="width: 500px;" class="form-control" type="text" name="bid1" placeholder="Enter Book ID" required="">&nbsp;&nbsp;&nbsp;&nbsp;
                        <button  type="submit" name="update" class="btn btn-success">Update</button>
                    </div>


                </form><br>
            <?php }
            ?>
        </div><br><br><br><br><br><br>
        
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
                $v = mysqli_query($db, "SELECT * FROM books WHERE bid='$_POST[bid]';");
                $v1 = mysqli_fetch_array($v);
                if (isset($v1['bid']) == '$_POST[bid]') {
                    ?>
                    <!------------------------------------------------------------------modal------------------------------------------------------------->



                    <!-- The Modal -->
                    <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Are you sure you want to delete this book?</h4>
                                    <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                                </div>



                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <form method="post" action="">
                                        <button name="delete" type="submit" class="btn btn-danger">Yes</button>
                                        <button name="cancel" type="button" class="btn btn-secondary"><a style="text-decoration: none;color: white;" href="books.php">Cancel</a></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                    <!------------------------------------------------------------------modal------------------------------------------------------------->
                    <?php
                } else {
                    ?>
                    <!-------------------------------------------------------No Book id Found-------------------------------------------------->



                    <!-- The Modal -->
                    <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">No Books Found with this Book ID</h4>
                                    <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                                </div>



                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <form method="post" action="">
                                        <button name="ok" type="submit" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                    <!----------------------------------------------------------No Book id Found------------------------------------------->
                    <?php
                }
            } else {
                ?>
                <!------------------------------------------------------------------Login------------------------------------------------------------->



                <!-- The Modal -->
                <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Please Login First to Delete the Books</h4>
                                <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                            </div>



                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <form method="post" action="">
                                    <button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="admin_login.php">Login</a></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop fade show"></div>
                <!------------------------------------------------------------------Login------------------------------------------------------------->
                <?php
            }
        }

        if (isset($_POST['delete'])) {
            mysqli_query($db, "DELETE FROM books WHERE `bid`='" . $_SESSION['bookid'] . "';");
            ?>
            <!--------------------------------------------------------book deleted successfully-------------------------------------->



            <!-- The Modal -->
            <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Book Deleted Successfully &#9989;</h4>
                            <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                        </div>



                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <form method="post" action="">
                                <button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
            <!------------------------------------------------book deleted successfully---------------------------------------------------->
            <?php
        }
        ?>
        <?php
        if (isset($_POST['bid'])) {
            $_SESSION['bookid'] = $_POST['bid'];
        }
        ?>

    </div>


    <?php
    if (isset($_POST['update'])) {
        if (isset($_SESSION['login_user'])) {
            $v = mysqli_query($db, "SELECT * FROM books WHERE bid='$_POST[bid1]';");
            $v1 = mysqli_fetch_assoc($v);
            if ($v1) {
                $name = $v1['name'];
                $authors = $v1['authors'];
                $edition = $v1['edition'];
                $status = $v1['status'];
                $quantity = $v1['quantity'];
                $department = $v1['department'];
            }
            if (isset($v1['bid']) == '$_POST[bid1]') {
                ?>
                <!------------------------------------------------modal------------------------------------------------------------->





                <!-- The Modal -->
                <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Update Book</h4>
                                <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="post" action="">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Book Name</label>
                                        </div>
                                        <input type="text" name="name" class="form-control" placeholder="Book Name" required="" value="<?php echo $name; ?>">                    
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Author Name</label>
                                        </div>
                                        <input type="text" name="authors" class="form-control" placeholder="Author Name" required="" value="<?php echo $authors; ?>">                    
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Edition</label>
                                        </div>
                                        <input type="text" name="edition" class="form-control" placeholder="Edition" required="" value="<?php echo $edition; ?>">                    
                                    </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Status</label>
                                        </div>
                                        <div class="rd">
                                            <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" class="custom-control-input" id="defaultChecked" name="status" value="Available" required="">
                                              <label class="custom-control-label"  for="defaultChecked">Available</label>
                                          </div>

                                          <!-- Default unchecked -->
                                          <div class="custom-control custom-radio custom-control-inline">
                                              <input type="radio" class="custom-control-input" id="defaultUnchecked" name="status" value="Not Available" required="">
                                              <label class="custom-control-label"  for="defaultUnchecked">Not Available</label>
                                          </div>
                                      </div>                    
                                  </div>

                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Quantity</label>
                                    </div>
                                    <input type="text" name="quantity" class="form-control" placeholder="Quantity" required="" value="<?php echo $quantity; ?>">                    
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Department</label>
                                    </div>
                                    <input type="text" name="department" class="form-control" placeholder="Department" required="" value="<?php echo $department; ?>">                    
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">

                                <button name="update1" type="submit" class="btn btn-primary">Update</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>

            <!------------------------------------------------------------------modal------------------------------------------------------------->
        <?php } else {
            ?>
            <!-------------------------------------------------------No Book id Found------------------------------------------------------------->



            <!-- The Modal -->
            <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">No Books Found with this Book ID</h4>
                            <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                        </div>



                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <form method="post" action="">
                                <button name="ok" type="submit" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
            <!----------------------------------------------------------No Book id Found------------------------------------------------------------->
            <?php
        }
    }
}
?>
<?php
if (isset($_POST['bid1'])) {
    $_SESSION['bid1'] = $_POST['bid1'];
}
?>

<?php
if (isset($_POST['update1'])) {
    mysqli_query($db, "UPDATE books SET name='$_POST[name]', authors='$_POST[authors]', edition='$_POST[edition]', status='$_POST[status]',quantity='$_POST[quantity]',department='$_POST[department]' WHERE bid='$_SESSION[bid1]';");
    ?>
    <!--------------------------------------------------------book deleted successfully-------------------------------------->



    <!-- The Modal -->
    <div class="modal fade show" aria-modal="true" role="dialog" style="display: block;">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Book Updated Successfully &#9989;</h4>
                    <button type="button" class="close"><a style="text-decoration: none;color: #808080;" href="books.php">&times;</a></button>
                </div>



                <!-- Modal footer -->
                <div class="modal-footer">
                    <form method="post" action="">
                        <button name="ok" type="button" class="btn btn-primary"><a style="text-decoration: none;color: white;" href="books.php">OK</a></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    <!------------------------------------------------book deleted successfully---------------------------------------------------->
    <?php
}
?>
</body>
</html>