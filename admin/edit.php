<?php
    include "navbar.php";
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>

    <title>Edit Profile</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    
    <style type="text/css">
        body, html
        {
            height: 850px;
            width: 100%;
        }
        .form-control
        {
            width: 250px;
            height: 32.5px;
            margin-right: auto;
            margin-left: auto;
        }
        form
        {
            text-align: center;
        }
        .form1
        {
            margin: auto;
            width: 50%;
            border: 3px solid green;
            padding: 10px;
        }
        input
        {
            text-align: center;
        }
        .alert
        {
            position: fixed;
            top: 5px; 
            margin-left: 450px;
            width: 400px;
        }
    </style>

</head>
<body style="background-color: #ff9;"><br>
    
    <h2 style="text-align: center; color: #8c5638;">Edit Profile Information</h2>

    <?php

        $sql = "SELECT * FROM admin WHERE username='$_SESSION[login_user]' ";
        $result = mysqli_query($db,$sql) or die (mysql_error());

        while($row = mysqli_fetch_assoc($result))
        {
            $first=$row['first'];
            $middle=$row['middle'];
            $last=$row['last'];
            $username=$row['username'];
            $email=$row['email'];
            $password=$row['password'];
        }

    ?>

    <div class="form1">
        <form action="" method="post" enctype="multipart/form-data">

            <label><h4>Profile Picture:</h4></label>
            <input class="form-control" type="file" name="file">

            <label><h4>First Name:</h4></label>
            <input class="form-control" type="text" name="first" value="<?php echo $first; ?>">
            <label><h4>Middle Name:</h4></label>
            <input class="form-control" type="text" name="middle" value="<?php echo $middle; ?>">
            <label><h4>Last Name:</h4></label>
            <input class="form-control" type="text" name="last" value="<?php echo $last; ?>">
            <label><h4>Username:</h4></label>
            <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
            <label><h4>E-mail:</h4></label>
            <input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
            <label><h4>Password:</h4></label>
            <input class="form-control" type="text" name="password" value="<?php echo $password; ?>"><br>
                <div style="padding-left: 1px;">
                    <button class="btn btn-success" type="submit" name="submit">Update</button>
                </div>
        </form>
    </div>

    <?php

        if(isset($_POST['submit']))
        {

            move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);

            $first=$_POST['first'];
            $middle=$_POST['middle'];
            $last=$_POST['last'];
            $username=$_POST['username'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $pic=$_FILES['file']['name'];

            $sql1= "UPDATE admin SET pic='$pic', first='$first', middle='$middle', last='$last',
             username='$username', email='$email', password='$password' WHERE
              username='".$_SESSION['login_user']."';";

            if(mysqli_query($db,$sql1))
            {
                ?>

                    <div class="alert alert-success">
                        <strong>Saved Successfully.</strong>
                    </div>

                <?php
            }

        }

    ?>

</body>
</html>