<?php
    include "navbar.php";
    include "connection.php";
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
            margin-left: 72.5%;
        }
        .main
        {
            width: 100%; 
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
        td, th
        {
            text-align: center;
        }
        .wrapper
        {
            overflow:hidden;
            overflow-y: scroll;
            height: 500px;
            width: 100%;
            border-radius: 5mm;
        }
        tr:nth-child(even)
        {
            background-color: #fcf6ca;
        }
        tr:nth-child(odd)
        {
            background-color: #f9fcca;
        }
        .alert
        {
            position: fixed;
            top: 25px; 
            margin-left: 40%;
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
        <div class="srch">
            <form class="navbar-form" method="post" name="form1">
                <br><input class="form-control" style="width: 250px;" type="text" name="name" placeholder="Search Books Name">
                <button style="background-color: #ed6335; width: 80px;" type="submit" name="submit_n" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            
                <label for="subject">Choose a Subject: </label>
                <select style="width: 125px; outline: none;" name="subject">
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
                </select>
                <button style="background-color: #ed6335; width: 80px;" type="submit" name="submit_s" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
                <br>
            </form>
        </div>


        <h2>List of BOOKS</h2>
        <?php
            if(isset($_POST['submit_n']))
            {
                $n=mysqli_query($db,"SELECT * from books where name like
                 '%$_POST[name]%';");

                if(mysqli_num_rows($n)==0)
                {
                    ?>
                        <div class="alert alert-danger">
                            <strong>The book is not available in the library.</strong>
                        </div>
                    <?php

                    $res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`bid` ASC;");
                    echo "<div class='wrapper'>";
                        echo "<table class='table table-bordered table-hover' >";
                            echo "<tr style='background-color: #faaf69;'>";
                                //header
                                echo "<th>";   echo "Accession Number";    echo "</th>";
                                echo "<th>";   echo "Book Name";    echo "</th>";
                                echo "<th>";   echo "Authors Name";    echo "</th>";
                                echo "<th>";   echo "Subject";    echo "</th>";
                                echo "<th>";   echo "Edition";    echo "</th>";
                                echo "<th>";   echo "Status";    echo "</th>";
                                echo "<th>";   echo "Condition";    echo "</th>";
                                echo "<th>";   echo "Quantity";    echo "</th>";       
                            echo "</tr>";

                            while($row=mysqli_fetch_assoc($res))
                            {
                                echo "<tr>";
                                echo "<td>"; echo $row['bid']; echo "</td>";
                                echo "<td>"; echo $row['name']; echo "</td>";
                                echo "<td>"; echo $row['authors']; echo "</td>";
                                echo "<td>"; echo $row['subject']; echo "</td>";
                                echo "<td>"; echo $row['edition']; echo "</td>";
                                echo "<td>"; echo $row['status']; echo "</td>";
                                echo "<td>"; echo $row['condition']; echo "</td>";
                                echo "<td>"; echo $row['quantity']; echo "</td>";
                                echo "</tr>";
                            }
                        echo "</table>";
                    echo "</div>";

                }
                else
                {
                    echo "<div class='wrapper'>";
                    echo "<table class='table table-bordered table-hover' >";
                        echo "<tr style='background-color: #faaf69;'>";
                            //header
                            echo "<th>";   echo "Accession Number";    echo "</th>";
                            echo "<th>";   echo "Book Name";    echo "</th>";
                            echo "<th>";   echo "Authors Name";    echo "</th>";
                            echo "<th>";   echo "Subject";    echo "</th>";
                            echo "<th>";   echo "Edition";    echo "</th>";
                            echo "<th>";   echo "Status";    echo "</th>";
                            echo "<th>";   echo "Condition";    echo "</th>";
                            echo "<th>";   echo "Quantity";    echo "</th>";       
                        echo "</tr>";
        
                    while($row=mysqli_fetch_assoc($n))
                    {
                        echo "<tr>";
                        echo "<td>"; echo $row['bid']; echo "</td>";
                        echo "<td>"; echo $row['name']; echo "</td>";
                        echo "<td>"; echo $row['authors']; echo "</td>";
                        echo "<td>"; echo $row['subject']; echo "</td>";
                        echo "<td>"; echo $row['edition']; echo "</td>";
                        echo "<td>"; echo $row['status']; echo "</td>";
                        echo "<td>"; echo $row['condition']; echo "</td>";
                        echo "<td>"; echo $row['quantity']; echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
            }
            /*button not pressed*/

            
            else if(isset($_POST['submit_s']))
            {
                $s=mysqli_query($db,"SELECT * from books where `subject`='$_POST[subject]';");

                if(mysqli_num_rows($s)==0)
                {
                    ?>
                        <div class="alert alert-danger">
                            <strong>The book is not available in the library.</strong>
                        </div>
                    <?php
                    $res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`bid` ASC;");
                echo "<div class='wrapper'>";
                    echo "<table class='table table-bordered table-hover' >";
                        echo "<tr style='background-color: #faaf69;'>";
                            //header
                            echo "<th>";   echo "Accession Number";    echo "</th>";
                            echo "<th>";   echo "Book Name";    echo "</th>";
                            echo "<th>";   echo "Authors Name";    echo "</th>";
                            echo "<th>";   echo "Subject";    echo "</th>";
                            echo "<th>";   echo "Edition";    echo "</th>";
                            echo "<th>";   echo "Status";    echo "</th>";
                            echo "<th>";   echo "Condition";    echo "</th>";
                            echo "<th>";   echo "Quantity";    echo "</th>";       
                        echo "</tr>";

                        while($row=mysqli_fetch_assoc($res))
                        {
                            echo "<tr>";
                            echo "<td>"; echo $row['bid']; echo "</td>";
                            echo "<td>"; echo $row['name']; echo "</td>";
                            echo "<td>"; echo $row['authors']; echo "</td>";
                            echo "<td>"; echo $row['subject']; echo "</td>";
                            echo "<td>"; echo $row['edition']; echo "</td>";
                            echo "<td>"; echo $row['status']; echo "</td>";
                            echo "<td>"; echo $row['condition']; echo "</td>";
                            echo "<td>"; echo $row['quantity']; echo "</td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                echo "</div>";
                }
                else
                {
                    echo "<div class='wrapper'>";
                        echo "<table class='table table-bordered table-hover' >";
                            echo "<tr style='background-color: #faaf69;'>";
                                //header
                                echo "<th>";   echo "Accession Number";    echo "</th>";
                                echo "<th>";   echo "Book Name";    echo "</th>";
                                echo "<th>";   echo "Authors Name";    echo "</th>";
                                echo "<th>";   echo "Subject";    echo "</th>";
                                echo "<th>";   echo "Edition";    echo "</th>";
                                echo "<th>";   echo "Status";    echo "</th>";
                                echo "<th>";   echo "Condition";    echo "</th>";
                                echo "<th>";   echo "Quantity";    echo "</th>";       
                            echo "</tr>";
            
                        while($r=mysqli_fetch_assoc($s))
                        {
                            echo "<tr>";
                            echo "<td>"; echo $r['bid']; echo "</td>";
                            echo "<td>"; echo $r['name']; echo "</td>";
                            echo "<td>"; echo $r['authors']; echo "</td>";
                            echo "<td>"; echo $r['subject']; echo "</td>";
                            echo "<td>"; echo $r['edition']; echo "</td>";
                            echo "<td>"; echo $r['status']; echo "</td>";
                            echo "<td>"; echo $r['condition']; echo "</td>";
                            echo "<td>"; echo $r['quantity']; echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    echo "</div>";
                }
            }
            else
            {
                $res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`bid` ASC;");
                echo "<div class='wrapper'>";
                    echo "<table class='table table-bordered table-hover' >";
                        echo "<tr style='background-color: #faaf69;'>";
                            //header
                            echo "<th>";   echo "Accession Number";    echo "</th>";
                            echo "<th>";   echo "Book Name";    echo "</th>";
                            echo "<th>";   echo "Authors Name";    echo "</th>";
                            echo "<th>";   echo "Subject";    echo "</th>";
                            echo "<th>";   echo "Edition";    echo "</th>";
                            echo "<th>";   echo "Status";    echo "</th>";
                            echo "<th>";   echo "Condition";    echo "</th>";
                            echo "<th>";   echo "Quantity";    echo "</th>";       
                        echo "</tr>";

                        while($row=mysqli_fetch_assoc($res))
                        {
                            echo "<tr>";
                            echo "<td>"; echo $row['bid']; echo "</td>";
                            echo "<td>"; echo $row['name']; echo "</td>";
                            echo "<td>"; echo $row['authors']; echo "</td>";
                            echo "<td>"; echo $row['subject']; echo "</td>";
                            echo "<td>"; echo $row['edition']; echo "</td>";
                            echo "<td>"; echo $row['status']; echo "</td>";
                            echo "<td>"; echo $row['condition']; echo "</td>";
                            echo "<td>"; echo $row['quantity']; echo "</td>";
                            echo "</tr>";
                        }
                    echo "</table>";
                echo "</div>";
            }
        ?>
    </div>
</body>
</html>