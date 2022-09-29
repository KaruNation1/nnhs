<?php
    include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>
        Verify Email Address
    </title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <style type="text/css">
        body
        {
            background-color: #ff9;

        }
        .box1
        {
            height: 320px;
            width: 450px;
            background-color: #ff9;
            margin: 70px auto;
            opacity: .9;
            color: wheat;
            padding: 20px;
            border-radius: 5mm;
        }
        h3
        {
            color: #8c5638;
        }
        .alert
        {
            position: fixed;
            top: 70px; 
            margin-left: 40%;
            width: 200px;
        }
    </style>

</head>
<body>

        <div class="box1">
        <h3>Enter the OTP: </h3>
            <form method="post">
                <input style="width: 300px; height: 40px;" type="text" name="otp" class="form-control" required="" 
                placeholder="Enter the OTP here."> <br>
                <button style="font-weight: 700;" class="btn btn-default" type="submit" name="submit_v">Verify</button>
            </form>
        </div>
    
        <?php
        $ver1=0;
            if(isset($_POST['submit_v']))
            {
                $ver2=mysqli_query($db, "SELECT * FROM verify;");
                while($row=mysqli_fetch_assoc($ver2))
                {
                    if($_POST['otp']==$row['otp'])
                    {
                        mysqli_query($db, "UPDATE student set `ver`='1' where username='$row[username]';");
                        $ver1=$ver1+1;
                    }
                }
                if($ver1==1)
                {
                    header("location:login.php");
                }
                else
                {
                    ?>
                        <div class="alert alert-danger">
                            <strong>Wrong OTP. Try again.</strong>
                        </div>
                    <?php
                }  
            }
        ?>

</body>
</html>