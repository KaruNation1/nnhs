<?php
    include "connection.php";
    include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Report
        </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>REPORT</h4>
                    </div>
                    <div class="card-body"> 
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date</label>
                                        <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Click to Generate</label><br>
                                        <button type="submit" class="btn btn-primary">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Book ID</th>
                                    <th>Issue Date</th>
                                    <th>Return Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_GET['from_date']) && isset($_GET['to_date']))
                                    {
                                        $from_date = $_GET['from_date'];
                                        $to_date = $_GET['to_date'];

                                        $query = "SELECT * FROM `issue_book` WHERE issue between '$from_date' and '$to_date' ";
                                        $query_run = mysqli_query($db,$query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
                                            {
                                                //echo $row['username'];
                                                ?>
                                                    <tr>
                                                        <td><?= $row['username']; ?></td>
                                                        <td><?= $row['bid']; ?></td>
                                                        <td><?= $row['issue']; ?></td>
                                                        <td><?= $row['return']; ?></td>
                                                    </tr>
                                                <?php

                                                //echo "There is $row number of books borrowed from the selected date.";
                                                printf("Total number of borrowed books on the selected days :  %d\n", $row);

                                            }
                                        }
                                        else
                                        {
                                            echo "No record Found";
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>