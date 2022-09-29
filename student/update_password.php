<?php
    include "connection.php";
    include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Change Password
    </title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <style type="text/css">
        body
        {
            height: 550px;
            background-color: #ff9;
        }
        .wrapper
        {
            width: 400px;
            height: 400px;
            background-color: #8c5638;
            opacity: .7;
            margin: 70px auto;
            border-radius: 5mm;
            color: wheat;
            padding: 20px 15px;
        }
        .wrapper h1
        {
            text-align: center;
            font-size: 35px;
        }
        .form-control
        {
            width: 250px;
        }
        .alert
        {
            position: fixed;
            top: 5px; 
            margin-left: 500px;
            width: 300px;
        }
    </style>
</head>
<body>

        <div class="wrapper">
            <div style="text-align: center;">
                <h1>Change Password</h1>
            </div>
            <div style="padding-left: 55px">
                <form action="" method="post">
                    <br>
                    <input type="text" name="username" placeholder="Username" class="form-control" required=""><br>
                    <input type="text" name="password" placeholder="Password" class="form-control" required=""><br>
                    <input type="text" name="email" placeholder="Email" class="form-control" required=""><br>
                    <input type="text" name="newpassword" placeholder="New Password" class="form-control" required=""><br>
                    <button class="btn btn-default" type="submit" name="submit">Update</button>
                </form>
            </div>
        </div>

        <?php

            /*---
            if(isset($_POST['submit']))
            {
                if(mysqli_query($db,"UPDATE admin SET password='$_POST[password]'
                 WHERE username='$_POST[username]' and email='$_POST[email]';"))
                 {
                     ?>
                        <div class="alert alert-success">
                            <strong>The Password Updated Successfully.</strong>
                        </div>
                     <?php
                 }
            }
            ---*/

            if(isset($_POST['submit']))
            {
            $count=0;
            $res=mysqli_query($db,"SELECT * FROM `student` WHERE username='$_POST[username]' and
             password='$_POST[password]' and email='$_POST[email]';");
            
            $row=mysqli_fetch_assoc($res);

            $count=mysqli_num_rows($res);

            if($count==0)
            {
                ?>
                    <div class="alert alert-danger">
                        <strong>&nbsp;There is no user account like that.</strong>
                    </div>
                <?php
                }
                else
                {
                    if(mysqli_query($db,"UPDATE `student` SET password='$_POST[newpassword]'
                    WHERE username='$_POST[username]' and email='$_POST[email]';"))
                    {
                        ?>
                        <div class="alert alert-success">
                            <strong>The Password Updated Successfully.</strong>
                        </div>
                        <?php
                    }
                }
            }

        ?>
    
</body>
</html>