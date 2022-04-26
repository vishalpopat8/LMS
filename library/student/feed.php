<?php
include "connection.php";
include "navbar.php";
?>

<html>
    <head>
        <title>Feedback</title>
        
        <style type="text/css">
            body{
                background-image: url('images/feed.jpg');
                background-size: 100%;

            }
            .wrapper{
                padding: 10px;
                margin: 10px auto;
                width: 900px;
                height: 600px;
                background-color: black;
                opacity: .8;
                color: white;
                text-align: center;
            }
            .form-control{
                height: 78px;
                width: 60%;
                margin : auto;
            }
            .scroll{
                width: 100%;
                height: 350px;
                overflow: auto;
            }

        </style>
    </head>
    <body>
        <div class="wrapper">
            <h4>If you have any Suggestions or Questions please comment below.</h4><br>
            <form style="" method="post">
                <input class="form-control" type="text" name="comment" placeholder="Write Something..." required=""><br>
                <input class="btn btn-primary" type="submit" name="submit" value="Comment">

            </form>
            <br>
            <div class="scroll">
                <?php
                if (isset($_POST['submit'])) {
                    if (isset($_SESSION['login_user'])) {
                        # code...
                    
                        $sql = "INSERT INTO feedback VALUES('','$_SESSION[login_user]','$_POST[comment]');";
                        if (mysqli_query($db, $sql)) {
                            $q = "SELECT * FROM `feedback` ORDER BY `feedback`.`id` DESC";
                            $res = mysqli_query($db, $q);

                            echo "<table  class ='table table-dark table-hover'>";

                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";
                                echo "<td>";
                                echo $row['username'];
                                echo "</td>";
                                echo "<td>";
                                echo $row['comment'];
                                echo "</td>";

                                echo "</tr>";
                            }echo "</table>";
                        }
                    }
                    else
                    {
                        $sql = "INSERT INTO feedback VALUES('','','$_POST[comment]');";
                        if (mysqli_query($db, $sql)) {
                            $q = "SELECT * FROM `feedback` ORDER BY `feedback`.`id` DESC";
                            $res = mysqli_query($db, $q);

                            echo "<table  class ='table table-dark table-hover'>";

                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";
                                echo "<td>";
                                echo $row['username'];
                                echo "</td>";
                                echo "<td>";
                                echo $row['comment'];
                                echo "</td>";

                                echo "</tr>";
                            }echo "</table>";
                        }
                    }
                } else {
                    $q = "SELECT * FROM `feedback` ORDER BY `feedback`.`id` DESC";
                    $res = mysqli_query($db, $q);

                    echo "<table  class ='table table-dark table-hover'>";

                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td>";
                        echo $row['username'];
                        echo "</td>";
                        echo "<td>";
                        echo $row['comment'];
                        echo "</td>";

                        echo "</tr>";
                    }echo "</table>";
                }
                ?>
            </div>
        </div>
    </body>
</html>
