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
        th, td, input
        {
            width: 100px;
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
        <div class="h"> <a href="request.php">Book Request</a></div>
        <div class="h"> <a href="issue_info.php">Issue Information</a></div>
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
                    $q=mysqli_query($db,"SELECT * from issue_book where username='$_SESSION[login_user]' 
                    and approve='' ;");
                
                    if(mysqli_num_rows($q)==0)
                    {
                        echo "<h1>There is no pending request</h1>";
                    }
                    else
                    {
                        ?>
                            <form method="post" action="">
                        <?php
                        echo "<table class='table table-bordered table-hover' >";
                        echo "<tr style='background-color: #ed6335;'>";
                            //header
                            echo "<th>";   echo "Select";    echo "</th>";
                            echo "<th>";   echo "Accession Number";    echo "</th>";
                            echo "<th>";   echo "Approve Status";    echo "</th>";
                            echo "<th>";   echo "Issue Date";    echo "</th>";
                            echo "<th>";   echo "Return Date";    echo "</th>";
                        echo "</tr>";
            
                    while($row=mysqli_fetch_assoc($q))
                    {
                        echo "<tr>";
                        ?>
                            <td><input type="checkbox" name="check[]" value="<?php echo $row["bid"] ?>"></td>
                        <?php
                        echo "<td>"; echo $row['bid']; echo "</td>";
                        echo "<td>"; echo $row['approve']; echo "</td>";
                        echo "<td>"; echo $row['issue']; echo "</td>";
                        echo "<td>"; echo $row['return']; echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                        <p align="center"><button type="submit" name="delete" class="btn btn-success"
                        onclick="location.reload()">Delete</button></p>
                    <?php
                    }
                
            ?>
        </div>    
    </div>  
        <?php

            if(isset($_POST['delete']))
            {
                if(isset($_POST['check']))
                {
                    foreach($_POST['check'] as $delete_id)
                    {
                        mysqli_query($db, "DELETE from issue_book WHERE bid='$delete_id' 
                        and username='$_SESSION[login_user]' ORDER BY bid ASC LIMIT 1;");

                        mysqli_query($db,"UPDATE books SET `status` = 'Available' where bid='$delete_id';");
                    }
                }
            }           

        ?>
</body>
</html>