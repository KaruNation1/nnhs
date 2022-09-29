<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			NNHS Library
		</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

		<style type="text/css">
			html, body
			{
				min-height: 100% !important;
				height: 100vh;
			}
			nav
			{
				float: right;
				word-spacing: 35px;
				padding: 20px;
			}
			nav li
			{
				display: inline-block;
				line-height: 25px;
			}
			section
			{
				height: 100%;
				width: 100%;
				background-color: #ff9;
				margin-top: 0px;
			}
            .wrapper
            {
				height: 100%;
				margin: 0px auto;
				overflow: auto;
            }
            header
            {
                height: 70px;
                width: 100%;
                background-color: brown;
            }
            footer
            {
                height: 50px;
                width: 100%;
                background-color: brown;
            }
            li a
            {
                color: wheat;
            }
            .logo
            {
                float: left;
                padding-left: 20px;
            }.logo h1
            {
                color: wheat; 
                line-height: 35px;
                font-size: x-large;
            }
            .box
            {
                height: 300px;
                width: 700px;
                background-color: #8c5638;
                margin: 40px auto;
                border-radius: 5mm;
                opacity: .7;
                color: wheat;
            }
            .box h1
            {
                text-align: center;
                font-size: 35px;
            }
            .box p
            {
                text-align: center;
                font-size: 25px;
            }
            footer p
            {
                color: wheat;
                text-align: center;
            }
			a 
			{
				box-shadow: inset 0 0 0 0 #ECB390;
				color: #ECB390;
				margin: 0 -.25rem;
				padding: 0 .25rem;
				transition: color .3s ease-in-out, box-shadow .3s ease-in-out;
			}
			a:hover
			{
				box-shadow: inset 100px 0 0 0 #ECB390;
				color: white;
				text-decoration: none;
				border-radius: 1mm;
			}
		</style>

	</head>
	<body>
		<div class="wrapper">
			<header>
				<div class="logo">
					<h1>NNHS Library</h1>
				</div>

				<?php
				if(isset($_SESSION['login_user']))
					{?>
						<nav>
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a href="books.php">Books</a></li>
								<li><a href="logout.php">LogOut</a></li>
							</ul>
						</nav>
					<?php
					}
					else
					{?>
						<nav>
							<ul>
								<li><a href="index.php">Home</a></li>
								<li><a href="books.php">Books</a></li>
								<li><a href="student_login.php">LogIn</a></li>
							</ul>
						</nav>
					<?php
					}
				?>
			</header>

			<section>
				<div class="sec_img">
					<br><br><br>
                    <div class="box">
						<br>
						<h1>Welcome To Naglaoa-an National High School Library</h1><br><br>
						<p>Open at 7:30am</p><br>
						<p>Closes at 4:00pm</p>
					</div>
				</div>
			</section>

			<footer style="height: 70px;">
				<p style="padding-top: 30px;">
					Email:&nbsp; naglaoaannationalhighschool@gmail.com <br>
				</p>
			</footer>
		</div>
	</body>
</html>