<?php
    include "navbar.php";
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style type="text/css">
        .srch
        {
            padding-left: 72.5%;
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
            padding-left: 10px;
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
        .scroll
        {
            width: 100%;
            height: 400px;
            overflow: auto;
        }
        th,td
        {
            width: 10%;
        }
        .container
        {
            height: 800px;
            margin-top: -70px;
            width: 85%;
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
            <?php
            
                if(isset($_SESSION['login_user']))
                {
                    ?>
                        <div style="padding-right: 500px; float: left; margin-top: 25px;">
                            <form action="" method="post">
                                <button name="submit2" type="submit" class="btn btn-success">Returned</button>&nbsp;&nbsp;
                                <button name="submit3" type="submit" class="btn btn-danger">Expired</button><br><br>
                            </form>
                        </div>
                    <?php

                    if(isset($_POST['submit']))
                    {

                        $var1='<p style="color: green; background-color: black;">RETURNED</p>';
                        
                        mysqli_query($db,"UPDATE issue_book SET approve='$var1' where username='$_POST[username]'
                         and bid='$_POST[bid]';");

                        mysqli_query($db,"UPDATE `books` SET `status`='Available',`quantity`=quantity+1 WHERE bid='$_POST[bid]';");

                    }

                }
                $c=0;
                    if(isset($_SESSION['login_user']))
                    {
                        $ret='<p style="color: green; background-color: black;">RETURNED</p>';
                        $exp='<p style="color: red; background-color: black;">EXPIRED</p>';
                        if(isset($_POST['submit2']))
                        {
                            $sql="SELECT student.username,sid,books.bid,name,authors,subject,edition,approve,
                             issue,issue_book.return FROM student inner JOIN issue_book ON
                             student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid
                             WHERE issue_book.approve ='$ret'  ORDER BY `issue_book`.`return` DESC";
                             $res=mysqli_query($db,$sql);
                        }
                        else if(isset($_POST['submit3']))
                        {
                            $sql="SELECT student.username,sid,books.bid,name,authors,subject,edition,approve,
                             issue,issue_book.return FROM student inner JOIN issue_book ON
                             student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid
                             WHERE issue_book.approve ='$exp' ORDER BY `issue_book`.`return` DESC";
                             $res=mysqli_query($db,$sql);
                        }
                        else
                        {
                            $sql="SELECT student.username,sid,books.bid,name,authors,subject,edition,approve,
                             issue,issue_book.return FROM student inner JOIN issue_book ON
                             student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid
                             WHERE issue_book.approve !='' and issue_book.approve !='Yes' ORDER BY `issue_book`.`return` DESC";
                             $res=mysqli_query($db,$sql);
                        }

                        echo "<table class='table table-bordered' style='width: 100%;'>";
                            echo "<tr style='background-color: #ed6335;'>";
                            //header
                                echo "<th>";   echo "Student Username";    echo "</th>";
                                echo "<th>";   echo "Student ID";    echo "</th>";
                                echo "<th>";   echo "Book ID";    echo "</th>";
                                echo "<th>";   echo "Book Name";    echo "</th>";
                                echo "<th>";   echo "Author Name";    echo "</th>";
                                echo "<th>";   echo "Subject";    echo "</th>";
                                echo "<th>";   echo "Edition";    echo "</th>";
                                echo "<th>";   echo "Status";    echo "</th>";
                                echo "<th>";   echo "Issue Date";    echo "</th>";
                                echo "<th>";   echo "Return Date";    echo "</th>";
                            echo "</tr>";
                        echo "</table>";

                        echo "<div class='scroll'>";
                            echo "<table class='table table-bordered' >";
                            while($row=mysqli_fetch_assoc($res))
                                {
                                    echo "<tr>";
                                        echo "<td>"; echo $row['username']; echo "</td>";
                                        echo "<td>"; echo $row['sid']; echo "</td>";
                                        echo "<td>"; echo $row['bid']; echo "</td>";
                                        echo "<td>"; echo $row['name']; echo "</td>";
                                        echo "<td>"; echo $row['authors']; echo "</td>";
                                        echo "<td>"; echo $row['subject']; echo "</td>";
                                        echo "<td>"; echo $row['edition']; echo "</td>";
                                        echo "<td>"; echo $row['approve']; echo "</td>";
                                        echo "<td>"; echo $row['issue']; echo "</td>";
                                        echo "<td>"; echo $row['return']; echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</table>";
                        echo "</div>";
                }
                else
                {
                    ?>
                        <h2 style="text-align: center; font-size: 25px;">Login to see information of Borrowed Books</h2>
                    <?php
                }
            ?>

        </div>

    </div>
</body>
</html>