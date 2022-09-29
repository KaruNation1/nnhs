<?php
    include "connection.php";
    include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Message</title>
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style type="text/css">
        body
        {
            height: 500px;
            background-color: #ff9;
        }
        .wrapper
        {
            height: 500px;
            width: 400px;
            border-bottom-left-radius: 3mm;
            border-top-right-radius: 3mm;
            background-color: #8c5638;
            opacity: .7;
            color: white;
            margin: 30px auto;
        }
        .form-control
        {
            height: 35px;
            width: 75%;
        }
        .msg
        {
            height: 400px;
            background-color: wheat;
            overflow-y: scroll;
        }
        .btn-info
        {
            background-color: brown;
        }
        .chat
        {
            display: flex;
            flex-flow: row wrap;
        }
        .user .chatbox
        {
            height: 40px;
            width: 325px;
            padding: 10px 12px;
            background-color: #f48e46;
            border-radius: 10px;
            order: -1;
            color: white;
        }
        .admin .chatbox
        {
            height: 40px;
            width: 320px;
            padding: 10px 12px;
            background-color: #a7a5a5;
            border-radius: 10px;
            color: white; 
        }
    </style>
<body>
        
    <?php

        if(isset($_POST['submit']))
        {
            mysqli_query($db, "INSERT into `library`.`message` VALUES ('', '$_SESSION[login_user]', '$_POST[message]',
            'no', 'student');");

            $res=mysqli_query($db, "SELECT * FROM message where username='$_SESSION[login_user]' ;");
        }
        else
        {
            $res=mysqli_query($db, "SELECT * FROM message where username='$_SESSION[login_user]' ;");
        }
        mysqli_query($db, "UPDATE message set status='yes' where sender='admin'
         and username='$_SESSION[login_user]' ;");

    ?>

    <div class="wrapper">
        <div style="height: 50px; width: 100%; background-color: brown; text-align: center; border-top-right-radius: 3mm;">
            <h3 style="padding-top: 12.5px;">Admin</h3>
        </div>
        
        <div class="msg">
        
            <?php

                while($row=mysqli_fetch_assoc($res))
                {
                    if($row['sender']=='student')
                    {

            ?>
            <!-------------student------------------------------------->
            <br><div class="chat user">
                <div style="float: left; padding-top: 5px;">
                    &nbsp;
                    <?php
                        echo "<img class='img-circle profile_img'
                        height=30 width=30 src='images/".$_SESSION['pic']."'>";
                    ?>
                    &nbsp;
                </div>
                <div class="chatbox" style="float: left; margin-left: 7px;">
                    <?php

                        echo $row['message'];

                    ?>
                </div>
            </div>
            <br>

            <?php

                    }
                    else
                    {

            ?>


            <!-------------admin------------------------------------->
            <br><div class="chat admin">
                <div style="float: left; padding-top: 5px;">
                    &nbsp;
                    <img style="height: 30px; width: 30px; border-radius: 50%;" src="images/p.png" alt="">
                    &nbsp;
                </div>
                <div class="chatbox" style="float: left; margin-left: 7px;">
                    <?php

                        echo $row['message'];

                    ?>
                </div>
            </div>
            <br>

            <?php

                    }
                }

            ?>
            
        </div>

        <div style="height: 100px; padding-top: 7.5px;">
            <form action="" method="post">
                <input style="float: left; margin-left: 3px;" type="text" class="form-control" name="message" required="" placeholder="Write Message...">&nbsp;
                <button class="btn btn-warning btn-log" type="submit" name="submit"><span class="glyphicon glyphicon-send"></span>&nbsp; Send</button>
            </form>
        </div>
    </div>

</body>
</html>