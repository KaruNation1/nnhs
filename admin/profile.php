<?php
    include "connection.php";
    include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Profile
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">


    <style type="text/css">
        .wrapper
        {
            height: 500px;
            width: 500px;
            margin: 0 auto;
            background-color: #8c5638;
            border-radius: 5mm;
            color: wheat;
        }
        table, td, tr
        {
            margin-left: 40px;
            border: 1px solid wheat;
            width: 85%;
        }
        tr, td
        {
            height: 35px;
            text-align: center;
            padding: 6px;
        }
        td
        {
            width: 1px;
        }
        thead tr th:first-child,
        tbody tr td:first-child 
        {
        width: 8em;
        min-width: 10em;
        max-width: 12em;
        word-break: break-all;
        }
    </style>
</head>
<body style="background-color: #ff9;">

    <div class="container">
       
        <div class="wrapper">

            <?php

            if(isset($_POST['submit1']))
            {
                ?>

                    <script type="text/javascript">
                        window.location="edit.php"
                    </script>

                <?php
            }

                $q=mysqli_query($db,"SELECT * FROM admin where username='$_SESSION[login_user]' ;");

            ?>

            <h2 style="text-align: center; color: #ff9; line-height: 60px;">Profile</h2>

            <?php
                $row=mysqli_fetch_assoc($q);

                echo "<div style='text-align: center;'>
                    <img class='img-circle profile-img' height=70 width=70 src='images/".$_SESSION['pic']."'>
                </div>";
            ?>
            <br>
            <div style="text-align:center; font-size: 20px; color: #ff9;"><b">WELCOME, </b>
                <h4>
                    <?php
                        echo $_SESSION['login_user'];
                    ?>
                </h4>
            </div>
            <?php
                echo "<b>";
                    echo "<table>";
                        
                        echo "<tr>";
                            echo "<td>";
                                echo "<b> &nbsp; First Name: </b>";
                            echo "</td>";

                            echo "<td>";
                                echo $row['first'];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "<b> &nbsp; Middle Name: </b>";
                            echo "</td>";

                            echo "<td>";
                            echo $row['middle'];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "<b> &nbsp; Last Name: </b>";
                            echo "</td>";
                            
                            echo "<td>";
                                echo $row['last'];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "<b> &nbsp; Username: </b>";
                            echo "</td>";
                            
                            echo "<td>";
                                echo $row['username'];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "<b> &nbsp; E-mail: </b>";
                            echo "</td>";
                            
                            echo "<td>";
                                echo $row['email'];
                            echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                            echo "<td>";
                                echo "<b> &nbsp; Password: </b>";
                            echo "</td>";
                            
                            echo "<td>";
                                echo $row['password'];
                            echo "</td>";
                        echo "</tr>";

                    echo "</table>";
                echo "</b>";
            ?>

            <form action="" method="post">
                <button class="btn btn-default" style="color: #8c5638; width:
                100px; height: 35px; margin-top: 10px; margin-left: 37.5%;" name="submit1">Edit Profile</button>
            </form>
        </div>
    </div>
    
</body>
</html>