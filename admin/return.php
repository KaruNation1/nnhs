<?php
    include "navbar.php";
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Return Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style type="text/css">
        .srch
        {
            padding-left: 900px;
        }
        body
        {
            background-color: #ff9;
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }
        .sidenav
        {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #a52a2a;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidenav a
        {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 20px;
            color: wheat;
            display: block;
            transition: 0.3s;
        }
        .sidenav a:hover
        {
            color: #f1f1f1;
        }
        .sidenav .closebtn
        {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        #main
        {
            transition: margin-left .5s;
            padding: 16px;
        }
        @media screen and (max-height: 450px)
        {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
        .img-circle
        {
            margin-left: 25px;
        }
        .h:hover
        {
            color: white;
            width: 250px;
            height: 50px;
            background-color: #ed6335;
        }
        .form-control
        {
            width: 275px;
            height: 27.5px;
            background-color: wheat;
            color: black;
        }
        .Approve
        {
            margin-left: 425px;
        }
        .alert
        {
            position: fixed;
            top: 25px; 
            margin-left: 42.5%;
        }
    </style>

</head>

<body>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div style="color: white; margin-top: 15px; margin-left: 30px; font-size: 20px;">
            <?php

            if(isset($_SESSION['login_user']))
            {
                echo "<img class='img-circle profile_img'
                height=100 width=100 src='images/".$_SESSION['pic']."'>";
                echo "</br></br>";
                echo " Welcome ".$_SESSION['login_user'];
            }
            ?>
            &nbsp;&nbsp;
        </div><br>

        <div class="h"> <a href="books.php">Books</a></div>
        <div class="h"> <a href="add.php">Add Book</a></div>
        <div class="h"> <a href="delete.php">Delete Books</a></div>
        <div class="h"> <a href="request.php">Book Request</a></div>
        <div class="h"> <a href="return.php">Return Book</a></div>
        <div class="h"> <a href="issue_info.php">Issue Information</a></div>
        <div class="h"> <a href="expired.php">Expired List</a></div>
    </div>

    <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
    
    <script>
        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "#ff9";
        }
    </script>
    <div class="container">
        <br><h3 style="text-align: center;">Return Book</h3><br><br>
        <form class="Approve" action="" method="post">
            <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
            <input type="text" name="bid" class="form-control" placeholder="Accession Number" required=""><br>
            <select class="form-control" required="" name="condition" size="2" multiple>
                <option value="Good">Good</option>
                <option value="Damaged">Damaged</option>
            </select><br>
            <button class="btn btn-deffault" name="save" type="submit" 
                style="background-color: #ed6335; color: wheat; margin-left: 100px;">Save</button>
            </form><br>
        </form>
    </div>
</div>

    <?php
        if(isset($_POST['save']))
        {
            if(isset($_SESSION['login_user']))
            {
                $check=mysqli_query($db,"SELECT * from `issue_book` WHERE bid='$_POST[bid]';");
                $rows=mysqli_fetch_assoc($check);
                $result=mysqli_num_rows($check);

                if($result!=0)
                {
                    $var1='<p style="color: green; background-color: black;">RETURNED</p>';
                    
                    mysqli_query($db,"UPDATE issue_book SET approve='$var1' where username='$_POST[username]'
                     and bid='$_POST[bid]';");

                    mysqli_query($db,"UPDATE `books` SET `status`='Available',`quantity`=quantity+1
                     ,`condition`='$_POST[condition]' WHERE bid='$_POST[bid]';");

                    ?>
                        <div class="alert alert-success">
                            <strong>Save successfully.</strong>
                        </div>
                    <?php
                }
                else
                {
                    ?>
                        <div class="alert alert-danger">
                            <strong>There is no such borrowed in the library.</strong>
                        </div>
                    <?php
                }
            }
            else
            {
                ?>

                    <div class="alert alert-danger">
                        <strong>You must login first.</strong>
                    </div>

                <?php
            }

        }
        
    ?>


</div>  
</body>
</html>

