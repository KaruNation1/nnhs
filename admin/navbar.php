<?php
    include "connection.php";
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>

    </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>

    <?php

        $r=mysqli_query($db, "SELECT COUNT(status) as total FROM message where status='no' and
         sender='student' ;");

        $c=mysqli_fetch_assoc($r);

        $sql_app=mysqli_query($db, "SELECT COUNT(status) as total FROM admin where status='';");

        $a=mysqli_fetch_assoc($sql_app);

        $sql_app_st=mysqli_query($db, "SELECT COUNT(status) as total FROM student where status='';");

        $s=mysqli_fetch_assoc($sql_app_st);

    ?>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand active" style="color: wheat;">NNHS</a>
        </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php" style="color: wheat;">Home</a></li>
                <li><a href="books.php" style="color: wheat;">Books</a></li>
            </ul>
            <?php
            if(isset($_SESSION['login_user']))
            {?>
                <ul class="nav navbar-nav">
                    <li><a href="profile.php" style="color: wheat;">Profile</a></li>
                    <li><a href="student.php" style="color: wheat;">Student-Information</a></li>  
                    <li><a href="report.php" style="color: wheat;">Report</a></li>
                </ul>          
                <ul class="nav navbar-nav navbar-right">
                <li><a href="admin_status.php"><span style="margin-top: 5px;" class="glyphicon glyphicon-user"> Admin</span>
                     <span style="margin-top: -5px;" class="badge bg-green">
                        <?php

                            echo $a['total'];

                        ?>
                     </span></a></li>
                <li><a href="student_status.php"><span style="margin-top: 5px;" class="glyphicon glyphicon-user"> Student</span>
                     <span style="margin-top: -5px;" class="badge bg-green">
                        <?php

                            echo $s['total'];

                        ?>
                     </span></a></li>
                <li><a href="message.php"><span style="margin-top: 5px;" class="glyphicon glyphicon-envelope"></span>
                     <span style="margin-top: -5px;" class="badge bg-green">
                        <?php

                            echo $c['total'];

                        ?>
                     </span></a></li>
                    <li><a href="profile.php">
                        <div style="color: white;">
                            <?php
                                echo "<img class='img-circle profile_img'
                                height=20 width=20 src='images/".$_SESSION['pic']."'>";
                                echo " ".$_SESSION['login_user'];
                            ?>
                        </div>
                    </a></li>
                    <li>
                        <a href="logout.php" style="color: wheat;"><span class="glyphicon glyphicon-log-out"> LogOut</span></a>
                    </li>    
                </ul>
            <?php
            }
            else
            {?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../login.php" style="color: wheat;"><span class="glyphicon glyphicon-log-in"> LogIn</span></a></li>    
                <li><a href="registration.php" style="color: wheat;"><span class="glyphicon glyphicon-user"> SignUp</span></a></li>
            </ul>
            <?php
            }
            ?>
            
        </div>
    </nav>

    <?php

            if(isset($_SESSION['login_user']))
            [
                
            ]

    ?>
    
</body>
</html>