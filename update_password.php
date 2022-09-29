<?php
    include "navbar.php";
    include "connection.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
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
            height: 100%;
            width: 100%;
        }
        .box
        {
            height: 150px;
            width: 350px;
            background-color: #8c5638;
            margin-top: 10%;
            opacity: .9;
            color: wheat;
            padding: 20px;
            border-radius: 5mm;
        }
        body
        {
            background-color: #ff9;
        }
        button
        {
            margin-top: 20px; 
            width: 70px;
            height: 30px;
            margin-left: 38%; 
        }
    </style>

</head>
<body>
        
    <section>
        <div class="box">
            <form name="signup" action="" method="post">

                <b><p style="padding-left: 50px auto; font-size: 15px;">Forgot Password As?</p></b>
                <input style="margin-left: 70px; width: 18px;" type="radio" name="user" id="admin" value="admin">
                <label for="admin">Admin</label>
                <input style="margin-left: 50px; width: 18px;" type="radio" name="user" id="student" value="student" checked="">
                <label for="student">Student</label>&nbsp;&nbsp;

                <button style="color: brown; background-color: wheat;" class="btn btn-default" type="submit" name="submit1">Ok</button>

            </form>
        </div>
        <?php

            if(isset($_POST['submit1']))
            {
                if($_POST['user']=='admin')
                {
                    ?>

                        <script type="text/javascript">
                            window.location="admin/update_password.php"
                        </script>

                    <?php
                }
                else
                {
                    ?>

                        <script type="text/javascript">
                            window.location="student/update_password.php"
                        </script>

                    <?php
                }
            }

        ?>
    </section>

</body>
</html>