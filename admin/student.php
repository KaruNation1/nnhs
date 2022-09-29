<?php
    include "navbar.php";
    include "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style type="text/css">
        .srch
        {
            padding-left: 70%;
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
            width: 300px;
            height: 38px;
            background-color: wheat;
            color: black;
        }
        .wrapper
        {
            overflow:hidden;
            overflow-y: scroll;
            height: 500px;
            width: 100%;
            border-radius: 5mm;
        }
        table, th, td
        {
            text-align: center;
        }
        tr:nth-child(even)
        {
            background-color: #fcf6ca;
        }
        tr:nth-child(odd)
        {
            background-color: #f9fcca;
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

        <div class="h"> <a href="student.php">List of Students</a></div>
        <div class="h"> <a href="delete_s.php">Delete Record</a></div>
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
        <div class="srch">
            <form class="navbar-form" method="post" name="form1">
                    <input class="form-control" type="text" name="search" placeholder="Search Username" required="">
                    <button style="background-color: #ed6335;" type="submit" name="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
            </form>
        </div>
            <h2>List of STUDENTS</h2>
            <?php

                if(isset($_POST['submit']))
                {
                    $q=mysqli_query($db,"SELECT sid,first,last,username,grade,section,email from student where username like
                    '%$_POST[search]%' ");

                    if(mysqli_num_rows($q)==0)
                    {
                        echo "Sorry! No Student Found.";
                    }
                    else
                    {
                        echo "<div class='wrapper'>";
                        echo "<table class='table table-bordered table-hover' >";
                            echo "<tr style='background-color: #faaf69;'>";
                                //header
                                echo "<th>";   echo "Studet ID";    echo "</th>";
                                echo "<th>";   echo "First Name";    echo "</th>";
                                echo "<th>";   echo "Last Name";    echo "</th>";
                                echo "<th>";   echo "Username";    echo "</th>";
                                echo "<th>";   echo "Grade";    echo "</th>";
                                echo "<th>";   echo "Section";    echo "</th>";
                                echo "<th>";   echo "E-mail";    echo "</th>";     
                            echo "</tr>";
            
                        while($row=mysqli_fetch_assoc($q))
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
                        echo "</div>";
                    }
                }
                /*button not pressed*/
                else
                {
                    $res=mysqli_query($db,"SELECT sid,first,last,username,grade,section,email from student;");

                echo "<div class='wrapper'>";
                echo "<table class='table table-bordered table-hover' >";
                    echo "<tr style='background-color: #faaf69;'>";
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
                echo "</div>";
                }
            ?>
    </div>
</body>
</html>