<?php
    include "connection.php";
    include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <style type="text/css">
        body
        {
            height: 500px;
            background-color: #ff9;
        }
        .left_box
        {
            width: 500px;
            height: 500px;
            background-color: #ff9;
            float: left;
            margin-left: 4.5%;
        }
        .left_box2
        {
            height: 500px;
            width: 300px;
            background-color: gold;
            border-radius: 20px;
            margin-left: 250px;
        }
        .left_box input
        {
            width: 170px;
            height: 30px;
            background-color: gold;
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
        }
        .list
        {
            height: 450px;
            width: 300px;
            background-color: pink;
            float: right;
            color: white;
            padding: 10px;
            overflow-y: scroll;
            overflow-x: hidden;
        }
        .right_box
        {
            width: 740px;
            height: 500px;
            background-color: #ff9;
            margin-left: 5.5%;
        }
        .right_box2
        {
            height: 500px;
            width: 450px;
            background-color: brown;
            border-radius: 20px;
            margin-left: 575px;
            padding: 30px;
        }
        tr:hover
        {
            background-color: wheat;
            cursor: pointer;
        }
        .form-control
        {
            height: 35px;
            width: 75%;
        }
        .msg
        {
            margin-top: -15px; 
            height: 350px;
            background-color: wheat;
            overflow-y: scroll;
            border-radius: 5px;
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
            width: 310px;
            padding: 10px 12px;
            background-color: #f48e46;
            border-radius: 10px;
            color: white;
        }
        .admin .chatbox
        {
            height: 40px;
            width: 310px;
            padding: 10px 12px;
            background-color: #a7a5a5;
            border-radius: 10px;
            color: white; 
            order: -1;
        }
    </style>
</head>
<body>
    <?php

        $sql1=mysqli_query($db,"SELECT student.pic,message.username FROM student
         INNER JOIN message ON student.username=message.username group by username ORDER BY 'status';");
    
    ?>
<!---------------left box-------------------------------------------------------------------->
    <div class="left_box">
        <div class="left_box2">
            <div style="color: black;">
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="username" id="uname">
                    <button type="submit" name="submit" class="btn btn-default">SHOW</button>
                </form>
            </div>
            <div class="list">
                <?php
                    echo "<table id='table' class='table' >";
                        while($res1=mysqli_fetch_assoc($sql1))
                        {
                            echo "<tr>";
                                echo "<td width=60>"; echo "<img class='img-circle profile_img' height=55 width=55
                                src='images/".$res1['pic']."'>"; echo "</td>";
                                echo "<td style='padding-top: 25px;'>"; echo $res1['username']; echo "</td>"; 
                            echo "</tr>";
                        }
                    echo "</table>";
                ?>
            </div>
        </div>
    </div>
<!---------------right box-------------------------------------------------------------------->
    <div class="right_box">
        <div class="right_box2">
            <?php
/*-------------------------------------------submit is pressed--------------------------------------*/
                if(isset($_POST['submit']))
                {

                    $res=mysqli_query($db,"SELECT * from message where username='$_POST[username]' ;");

                    mysqli_query($db,"UPDATE message SET status='yes' where sender='student' and
                     username='$_POST[username]' ;");

                    if($_POST['username'] != '')
                    {
                        $_SESSION['username']=$_POST['username'];
                    }

                    ?>
                        <div style="height: 70px; width: 100%;color: white; text-align: center;">
                            <h3 style="margin-top: -5px; padding-top: 10px;">
                             <?php echo $_SESSION['username'] ?> </h3>
                        </div>
<!-----------------------------------------------show message--------------------------------------->
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
                                    else
                                    {
                            ?>
                                        <!-------------admin------------------------------------->
                                        <br><div class="chat admin">
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
                                }

                            ?>
                            
                        </div>

                        <div style="height: 100px; padding-top: 7.5px;">
                            <form action="" method="post">
                                <input style="float: left; margin-left: 3px;" type="text" class="form-control" name="message" required="" placeholder="Write Message...">&nbsp;
                                <button class="btn btn-warning btn-log" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span>&nbsp; Send</button>
                            </form>
                        </div>
                    <?php
                }
/*-------------------------------------------show message is not pressed--------------------------------------*/
                else
                {
                    if($_SESSION['username']=='')
                    {
                        ?>
                            <img src="images/message.gif" alt="test" width="270" height="270"
                             style="margin: 80px 65px; border-radius: 60%;">
                        <?php
                    }
                    else
                    {
                        if(isset($_POST['submit1']))
                        {

                            mysqli_query($db, "INSERT into `library`.`message` VALUES ('', '$_SESSION[username]', '$_POST[message]',
                             'no', 'admin');");

                            $res=mysqli_query($db,"SELECT * from message where username='$_SESSION[username]' ;");
                        }
                        else
                        {
                            $res=mysqli_query($db,"SELECT * from message where username='$_SESSION[username]' ;");
                        }
                        ?>
                            <div style="height: 70px; width: 100%;color: white; text-align: center;">
                                <h3 style="margin-top: -5px; padding-top: 10px;">
                                <?php echo $_SESSION['username'] ?> </h3>
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
                                        else
                                        {
                                ?>
                                            <!-------------admin------------------------------------->
                                            <br><div class="chat admin">
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
                                    }

                                ?>
                            
                            </div>

                            <div style="height: 100px; padding-top: 7.5px;">
                                <form action="" method="post">
                                    <input style="float: left; margin-left: 3px;" type="text" class="form-control" name="message" required="" placeholder="Write Message...">&nbsp;
                                    <button class="btn btn-warning btn-log" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span>&nbsp; Send</button>
                                </form>
                            </div>

                        <?php
                    }
                }
            ?>
        </div>
    </div>

    <script>
        var table = document.getElementById('table'),eIndex;
        for(var i=0; i< table.rows.length; i++)
        {
            table.rows[i].onclick =function()
            {
                rIndex = this.rowIndex;
                document.getElementById("uname").value = this.cells[1].innerHTML;
            }
        }
    </script>

</body>
</html>