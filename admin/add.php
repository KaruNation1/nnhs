<?php
    include "connection.php";
    include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style type="text/css">
        .srch
        {
            padding-left: 950px;
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
        .book
        {
            width: 300px;
            margin: 0px auto;
        }
        .form-control
        {
            background-color: wheat;
            color: black;
        }
        .alert
        {
            position: fixed;
            top: 5px; 
            margin-left: 450px;
            width: 400px;
        }
        select
        {
            background-color: wheat; 
            border-radius: 2mm;
        }
        select option 
        { 
            background-color: wheat; 
        }
    </style>
</head>
<body>
    <!----sidenav----->
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
        <span style="font-size:30px;cursor:pointer; color: #ed6335;" onclick="openNav()">&#9776;</span>

        <div class="container" style="text-align: center;">
            <h2 style="color: #ed6335; font-size: 50px; text-align: center;">Add New Book</h2><br>
            <form class="book" action="" method="post">
                <input type="text" name="bid" class="form-control" placeholder="Accession Number" required=""><br>
                <input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br>
                <input type="text" name="author" class="form-control" placeholder="Book Author" required=""><br>
                <!--<input type="text" name="subject" class="form-control" placeholder="Subject" required=""><br>-->
                <select style="width: 300px; height: 30px; outline: none;" name="subject" id="" required="">
                <option disabled selected value>-- select subject -- </option>
                    <optgroup label="Educational">
                        <option>English</option>
                        <option>Filipino</option>
                        <option>Economics</option>
                        <option>Science</option>
                        <option>Mathematics</option>
                        <option>MAPEH</option>
                        <option>Reference Books</option>
                        <option>Edukasyon sa Pagpapakatao</option>
                    </optgroup>
                    <optgroup label="Foreign Section">
                        <option>Social Sciences</option>
                        <option>Language</option>
                        <option>Pure Science</option>
                        <option>Arts and Recreation</option>
                        <option>History and Geography</option>
                        <option>Literature</option>
                    </optgroup>
                    <optgroup label="Others">
                        <option>Encyclopedia</option>
                        <option>Handbooks</option>
                        <option>Yearbooks</option>
                        <option>Biographies</option>
                        <option>Dictionaries</option>
                        <option>Thesaurus</option>
                        <option>Atlases</option>
                    </optgroup>
                </select><br><br>
                <!--<input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br>-->
                <select style="width: 300px; height: 30px; outline: none;" name="edition" id="" required="">
                <option disabled selected value>-- select edition -- </option>
                    <option>1st</option>
                    <option>2nd</option>
                    <option>3rd</option>
                    <option>4th</option>
                    <option>5th</option>
                </select><br><br>
                <!--<input type="text" name="condition" class="form-control" placeholder="Condition" required=""><br>-->
                <select style="width: 300px; height: 30px; outline: none;" name="condition" id="" required="">
                <option disabled selected value>-- select condition -- </option>
                    <option>Good</option>
                    <option>Bad</option>
                </select><br><br>

                <button class="btn btn-default" type="submit" name="submit" style="color: #8c5638; width: 65px; height: 35px;">Add</button>

            </form>
        </div>

        <?php

            if(isset($_POST['submit']))
            {
                if(isset($_SESSION['login_user']))
                {
                    $sql2=mysqli_query($db,"SELECT * from `books` WHERE bid='$_POST[bid]';");
                    $rows2=mysqli_fetch_assoc($sql2);
                    $count2=mysqli_num_rows($sql2);
                        if($count2==0)
                        {
                            mysqli_query($db, "INSERT INTO `books`(`bid`, `name`, `authors`, `subject`, `edition`, `status`, `condition`, `quantity`, `bcount`)
                             VALUES ('$_POST[bid]','$_POST[name]','$_POST[author]','$_POST[subject]','$_POST[edition]','Available','$_POST[condition]','1','0');");
                             
                            ?>
                                <div class="alert alert-success">
                                    <strong>Book Added Successfully.</strong>
                                </div>
                            <?php
                        }
                        else
                        {
                            ?>
                                <div class="alert alert-danger">
                                    <strong>The Book is already uploaded.</strong>
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
    <script>
        function openNav()
        {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav()
        {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        document.body.style.backgroundColor = "#ff9";
        }
    </script>
</body>
</html>