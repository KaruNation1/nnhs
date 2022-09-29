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
        html, body
        {
            min-height: 100% !important;
            height: 100vh;
        }
        section
        {
            margin-top: -25px;
            width: 100%; 
            height: 100%; 
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
            height: 100%;
        }
        .box1
        {
            height: 400px;
            width: 450px;
            background-color: #8c5638;
            margin: 70px auto;
            opacity: .9;
            color: wheat;
            padding: 20px;
            border-radius: 5mm;
        }
        .box1 h1
        {
            margin-bottom: 20px;  
            text-align: center;
            font-size: 40px;  
        }
        label
        {
            font-size: 15px;
        }
        form .login
        {
            margin: auto 85px;
        }
        input
        {
            height: 25px;
            width: 250px;
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

                    <b><p style="padding-left: 85px; font-size: 15px;">Login as:</p></b>
                    <input style="margin-left: 85px; width: 18px;" type="radio" name="user" id="admin" value="admin">
                    <label for="admin">Admin</label>
                    <input style="margin-left: 85px; width: 18px;" type="radio" name="user" id="student" value="student" checked="">
                    <label for="student">Student</label>

                    <div class="login">
                        <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                        <input class="form-control" type="password" name="password" placeholder="Password" required=""><br>
                        <input class="btn btn-default" type="submit" name="submit" value="LogIn" 
                        style="color: #8c5638; width: 65px; height: 35px;">
                    </div>
                
                    <p style="padding-left: 7.5px;">
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
            if($_POST['user']=='admin')
            {
            $count=0;
            $res=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_POST[username]' &&
             password='$_POST[password]' and status='yes';");
            
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
                        window.location="admin/profile.php"
                    </script>
                <?php
            }
            }
            else
            {
                $count=0;
                $res=mysqli_query($db,"SELECT * FROM `student` WHERE username='$_POST[username]' &&
                password='$_POST[password]' and status='yes';");

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
                    if($row['ver']==1)
                    {
                    $_SESSION['login_user'] = $_POST['username'];
                    $_SESSION['pic'] = $row['pic'];
                    
                    ?>
                        <script type="text/javascript">
                            window.location="student/profile.php"
                        </script>
                    <?php
                    }
                    else
                    {
                        ?>
                            <div class="alert alert-danger">
                                <strong>Verify your email by OTP before loging in.</strong>
                            </div>
                        <?php
                    }
                }
            }
        }
    ?>
</body>
</html>