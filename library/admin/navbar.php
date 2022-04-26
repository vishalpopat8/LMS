<?php
include 'connection.php';
session_start();
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
            padding-right: unset;
            border-radius: 50%;
            height: 30px;
            width: 30px;
        }
        .nav-link {
            display: block;
            padding: .5rem .5rem;
        }
    </style>

</head>
<body>

    <?php 

    $r=mysqli_query($db,"SELECT COUNT(status) as total from message where status='NO' AND  sender='STUDENT';");

    $c=mysqli_fetch_assoc($r);

    $sql_app=mysqli_query($db,"SELECT COUNT(status) as total from admin where status='';");

    $a=mysqli_fetch_assoc($sql_app);

    ?>
    <header>
        <div class="logo">
            <img src="images/book.png">
            <h1 style="color: #695a33">Library Management System</h1>
        </div>


        <?php if (isset($_SESSION['login_user'])) {
            ?>
            <nav>
                <ul class="nav">
                    <a href="profile.php" style="word-spacing: normal;margin-top: 10px; font-weight: bold; color: #695a33;" class="nav-item nav-link"> 
                        <?php
                        echo "<img class='cent' src='images/" . $_SESSION['pic'] . "'>"." ";
                        echo "Welcome " . ($_SESSION['login_user']);
                        ?>
                    </a>
                    <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"> HOME</i><a></li>
                        <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="admin_status.php"><i class="fa fa-user" aria-hidden="true"> <span class="badge badge-secondary"><?php echo $a['total']; ?></span></i></a></li>
                        <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="books.php"><i class="fa fa-book" aria-hidden="true"> BOOKS</i></a></li>

                        <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="student.php"><i class="fa fa-graduation-cap" aria-hidden="true"> STUDENT INFO</i></a></li>
                        <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="message.php"><i class="fa fa-envelope" aria-hidden="true"> <span class="badge badge-secondary"><?php echo $c['total']; ?></span></i></a></li>
                        <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="feed.php"><i class="fa fa-comment" aria-hidden="true"> FEEDBACK</i></a></li>	
                        <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt">  LOGOUT</i></a></li>
                    </ul>
                </nav>
                <?php } else { ?><nav>
                    <ul class="nav">
                        <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"> HOME</i><a></li>
                            <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="books.php"><i class="fa fa-book" aria-hidden="true"> BOOKS</i></a></li>
                            <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="../login.php"><i class="fas fa-sign-in-alt">  LOGIN</i></a></li>
                            <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="reg.php"><i class="fas fa-user-alt"> REGISTRATION</i></a></li>
                            <li style="word-spacing: normal;" class="nav-item"><a class="nav-link" href="feed.php"><i class="fa fa-comment" aria-hidden="true"> FEEDBACK</i></a></li>	
                        </ul>
                    </nav>
                    <?php
                }
                ?>

            </header>
        </body>
        </html>