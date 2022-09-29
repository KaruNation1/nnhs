<?php
    include "navbar.php";
    include "connection.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <style type="text/css">
        html, body
		{
			min-height: 100% !important;
			height: 100vh;
            background-color: #ff9;
		}
        section
        {
            margin-top: -25px;
            height: 750px;
        }
        .box2
        {
            height: 500px;
            width: 450px;
            background-color: #8c5638;
            margin: 60px auto;
            opacity: .9;
            color: wheat;
            padding: 20px;
            border-radius: 5mm;
            margin-top: 20px;
        }
        .box2 h1
        {
            text-align: center;
            font-size: 40px;  
        }
        .reg_img
        {
            height: 100%
            width: 100%;
            margin-top: 0px;
        }
    </style>

</head>
<body>
        
    <section>
        <div class="reg_img">
        <br>
            <div class="box2">
                <h1>Register</h1>
                <form name="Registration" action="" method="post">
                    <div class="login">
                        <input class="form-control" type="text" name="first" placeholder="First Name" required=""><br>
                        <input class="form-control" type="text" name="middle" placeholder="Middle Name" required=""><br>
                        <input class="form-control" type="text" name="last" placeholder="Last Name" required=""><br>
                        <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                        <input class="form-control" type="text" name="email" placeholder="Email" required=""><br>
                        <input class="form-control" type="password" name="password" placeholder="Password" required=""><br>
                        <input class="btn btn-default" type="submit" name="submit" value="Sign Up" 
                        style="color: #8c5638; width: 75px; height: 35px;">
                    </div>
                </form>
            </div>
        </div>
    </section>

        <?php

            if(isset($_POST['submit']))
            {
                $count=0;
                $sql="SELECT username FROM `admin`";
                $res=mysqli_query($db,$sql);

                while($row=mysqli_fetch_assoc($res))
                {
                    if($row['username']==$_POST['username'])
                    {
                        $count=$count+1;
                    }
                }
            if($count==0)
            {mysqli_query($db,"INSERT INTO `admin` VALUES('', '$_POST[first]', '$_POST[middle]',
            '$_POST[last]', '$_POST[username]', '$_POST[email]', '$_POST[password]', 'p.png', '');");
        ?>
            <script type="text/javascript">
                window.location="../login.php"
            </script>
            <?php
                }
                else
                {
                    ?>
                    <script type="text/javascript">
                    alert("The Username already exist.");
                    </script>
            <?php
                }
            }
        ?>

</body>
</html>