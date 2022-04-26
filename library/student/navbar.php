<?php
session_start();
include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel = "icon" href = "images/book.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style type="text/css">
        .cent{
            border-radius: 50%;
            padding-right: unset;
            height: 30px;
            width: 30px;
        }
        .tm{
            position:absolute;
            top:3px;
            right: 20px;
            text-shadow: 2px 2px 4px red;
            height: 30px;
            width: 200px;
            color: #695a33;
            font-size: 25px;
        }
    </style>

</head>
<body>

    <?php 
    if (isset($_SESSION['login_user'])){

        $r=mysqli_query($db,"SELECT COUNT(status) as total from message where status='NO' AND username='$_SESSION[login_user]' and sender='admin'");

        $c=mysqli_fetch_assoc($r);}

        ?>

        <header>
            <div class="logo">
                <img src="images/book.png">
                <h1 style="color: #695a33">Library Management System</h1>
            </div>


            <?php if (isset($_SESSION['login_user'])) {
                ?>
                <!------------------------------fine-------------------------------------->
                <div class="tm">
                    <?php 
                    $res = mysqli_query($db, "SELECT * FROM issue_book where username='$_SESSION[login_user]';");

                    $sum = 0;

                    while ($row = mysqli_fetch_assoc($res)) {
                        if($row['return'] != '--' && $row['approve']=='APPROVED'){
                            $return_date = $row['return'];

                            $now = time(); // or your date as well
                            $your_date = strtotime($return_date);
                            $datediff = round(($now - $your_date) / (60 * 60 * 24));

                            if ($datediff > 0){
                                $sum = $sum + $datediff*2;
                            }
                        }
                    }

                    echo "Your Fine is : &#8377; " . $sum;
                    ?>
                </div>
                <!------------------------------fine-------------------------------------->


                <nav>
                    <ul class="nav">
                        <a href="profile.php" style="word-spacing: normal;margin-top: 10px; font-weight: bold; color: #695a33;" class="nav-item nav-link"> 
                            <?php
                            echo "<img class='cent' src='images/" . $_SESSION['pic'] . "'>"." ";
                            echo "Welcome " . ($_SESSION['login_user']);
                            ?>
                        </a>
                        <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"> HOME</i><a></li>
                            <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="books.php"><i class="fa fa-book" aria-hidden="true"> BOOKS</i></a></li>
                            <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="message.php"><i class="fa fa-envelope" aria-hidden="true"> <span class="badge badge-secondary"><?php echo $c['total']; ?></span></i></a></li>
                            <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="feed.php"><i class="fa fa-comment" aria-hidden="true"> FEEDBACK</i></a></li>	
                            <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt">  LOGOUT</i></a></li>
                        </ul>
                    </nav>
                    <?php } else { ?><nav>
                        <ul class="nav">
                            <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"> HOME</i><a></li>
                                <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="books.php"><i class="fa fa-book" aria-hidden="true"> BOOKS</i></a></li>
                                <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="../login.php"><i class="fas fa-sign-in-alt"> LOGIN</i></a></li>
                                <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="reg.php"><i class="fas fa-user-alt"> REGISTRATION</i></a></li>
                                <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="feed.php"><i class="fa fa-comment" aria-hidden="true"> FEEDBACK</i></a></li>	
                            </ul>
                        </nav>
                        <?php
                    }

                    if (isset($_SESSION['login_user'])) {
                        $day = 0;
                        $exp = '<p style="color:yellow;background-color:red;">EXPIRED</p>';
                        $res = mysqli_query($db, "SELECT * from issue_book where username='$_SESSION[login_user]' and approve='$exp';");


                        while ($row = mysqli_fetch_assoc($res)) {
                            $d = strtotime($row['return']);
                            $c = strtotime(date("d-m-Y"));


                            $diff = $c - $d;
                            if ($diff >= 0) {
                                $day = $day + floor($diff / (60 * 60 * 24));
                            }
                        }
                        $_SESSION['fine'] = $day;
                    }
                    ?>

                </header>
            </body>
            </html>