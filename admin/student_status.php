<?php
    include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Approve Student Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style type="text/css">
        .srch
        {
            padding-left: 850px;
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
            margin-top: 52px;
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
    </style>
    </style>
</head>
<body>


    <!----sidenav----->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div style="color: white; margin-top: 15px; margin-left: 50px; font-size: 20px;">
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
        </div>

        <div class="h"> <a href="books.php">Books</a></div>
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

    <!--------searchbar--------->
    <div class="container">
        <h3 style="float: left;">Search one username at a time to approve student account.</h3>
    <div class="srch" style="float: right;">
        <form class="navbar-form" method="post" name="form1">
            
                <input class="form-control" type="text" name="search" placeholder="Search Username" required="">
                <button style="background-color: #ed6335;" type="submit" name="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            
        </form>
    </div>


    <br><h2>Approve Student Account</h2>
    <?php

        if(isset($_POST['submit']))
        {
            $q=mysqli_query($db,"SELECT sid,first,last,username,grade,section,email from student where username like
             '$_POST[search]%' and status='' ");

            if(mysqli_num_rows($q)==0)
            {
                echo "Sorry! No new request found with that username. Try searching again.";
            }
            else
            {
                echo "<table class='table table-bordered table-hover' >";
                    echo "<tr style='background-color: #ed6335;'>";
                        //header
                        echo "<th>";   echo "First Name";    echo "</th>";
                        echo "<th>";   echo "Last Name";    echo "</th>";
                        echo "<th>";   echo "Username";    echo "</th>";
                        echo "<th>";   echo "Grade";    echo "</th>";
                        echo "<th>";   echo "Section";    echo "</th>";
                        echo "<th>";   echo "E-mail";    echo "</th>";     
                    echo "</tr>";
    
                while($row=mysqli_fetch_assoc($q))
                {
                    $_SESSION['test_name1']=$row['username'];
                    echo "<tr>";
                    echo "<td>"; echo $row['first']; echo "</td>";
                    echo "<td>"; echo $row['last']; echo "</td>";
                    echo "<td>"; echo $row['username']; echo "</td>";
                    echo "<td>"; echo $row['grade']; echo "</td>";
                    echo "<td>"; echo $row['section']; echo "</td>";
                    echo "<td>"; echo $row['email']; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
                    <form method="post">
                    <button type="submit" name="b_deny" style="background-color: #ffe5b4; font-weight: 700; font-size: 15px;" class="btn btn-deffault">
                    <span style="color: red;" class="glyphicon glyphicon-remove-sign"></span>&nbsp;Remove</button>
                    <button type="submit" name="b_approve" style="background-color: #ffe5b4; font-weight: 700; font-size: 15px;" class="btn btn-deffault">
                    <span style="color: green;" class="glyphicon glyphicon-ok-sign"></span>&nbsp;Approve</button>
                    </form>
                <?php
                
            }
        }
        /*button not pressed*/
        else
        {
            $res=mysqli_query($db,"SELECT sid,first,last,username,grade,section,email from student where status='';");

            echo "<table class='table table-bordered table-hover' >";
                echo "<tr style='background-color: #ed6335;'>";
                    //header
                    echo "<th>";   echo "Student ID";    echo "</th>";
                    echo "<th>";   echo "First Name";    echo "</th>";
                    echo "<th>";   echo "Last Name";    echo "</th>";
                    echo "<th>";   echo "Username";    echo "</th>";
                    echo "<th>";   echo "Grade";    echo "</th>";
                    echo "<th>";   echo "Section";    echo "</th>";
                    echo "<th>";   echo "E-mail";    echo "</th>";            
                echo "</tr>";

                while($row=mysqli_fetch_assoc($res))
                {
                    echo "<tr>";
                    echo "<td>"; echo $row['sid']; echo "</td>";
                    echo "<td>"; echo $row['first']; echo "</td>";
                    echo "<td>"; echo $row['last']; echo "</td>";
                    echo "<td>"; echo $row['username']; echo "</td>";
                    echo "<td>"; echo $row['grade']; echo "</td>";
                    echo "<td>"; echo $row['section']; echo "</td>";
                    echo "<td>"; echo $row['email']; echo "</td>";
                    echo "</tr>";
                }
            echo "</table>";
        }
        if(isset($_POST['b_deny']))
        {
            mysqli_query($db, "DELETE from `student` where username='$_SESSION[test_name1]' and status='';");
            unset($_SESSION['test_name']);
        }
        if(isset($_POST['b_approve']))
        {
            mysqli_query($db, "UPDATE student set status='yes' where username='$_SESSION[test_name1]';");
            unset($_SESSION['test_name']);
        }
    ?>
    </div>
</body>
</html>