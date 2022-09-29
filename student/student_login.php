<?php
    include "connection.php";
    include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student LogIn</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <style type="text/css">
        section
        {
            margin-top: -25px;
        }
        .alert
        {
            position: fixed;
            top: 5px; 
            margin-left: 450px;
            width: 400px;
        }
        .log_img
        {
            margin-top: 0px;
            background-color: #ff9;
            height: 570px;
        }
        .box1 h1
        {
            margin-bottom: 20px;  
        }
    </style>

</head>
<body>
    
    <section>
        <div class="log_img">
        <br>
            <div class="box1">
                <h1>LogIn</h1>
                <form name="login" action="" method="post">
                    <div class="login">
                        <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                        <input class="form-control" type="password" name="password" placeholder="Password" required=""><br>
                        <input class="btn btn-default" type="submit" name="submit" value="LogIn" 
                        style="color: #8c5638; width: 65px; height: 35px;">
                    </div>
                
                    <p style="padding-left: 8px;">
                        <br><br>
                        <a style="color: yellow; text-decoration: none;margin-left: 75px; opacity: .8;" href="update_password.php">Forgot Password?</a> &nbsp; &nbsp; &nbsp;
                    </p>
                </form> 
            </div>
        </div>
    </section>
    
    <?php
        if(isset($_POST['submit']))
        {
            $count=0;
            $res=mysqli_query($db,"SELECT * FROM `student` WHERE username='$_POST[username]' &&
             password='$_POST[password]';");
            
            $row=mysqli_fetch_assoc($res);

            $count=mysqli_num_rows($res);

            if($count==0)
            {
                ?>
                    <div class="alert alert-danger">
                        <strong>The Username and Password doesn't match.</strong>
                    </div>
                <?php
            }
            else
            {
                /*---pass and username matches---*/
                $_SESSION['login_user'] = $_POST['username'];
                $_SESSION['pic']= $row['pic'];
                $_SESSION['username']='';
                
                ?>
                    <script type="text/javascript">
                        window.location="index.php"
                    </script>
                <?php
            }
        }
    ?>
</body>
</html>