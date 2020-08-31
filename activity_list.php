<?php

    // Utility function to show alert from php
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    // Create database connection
    require 'db_connect.php';

    // Check if session exists
    session_start();
    if (isset($_SESSION["LoginUser"]))
    {
        //$_SESSION["LoginUser"] = $_POST["username"];
    }
    else
    {
        // Not logged in redirect to login page
        header("Location: login.php", true, 301);
        exit();
    }

    $dateFrom = date('Y-m-d');
    $dateTo = date('Y-m-d');

    if (isset($_POST['Submit'])) 
    {
        $dateFrom = $_POST["DateFrom"];
        $dateTo = $_POST["DateTo"];
    }
    if (isset($_POST['StatId'])) 
    {
        $statId = $_POST["StatId"];
        $dateFrom = $_POST["DateFrom"];
        $dateTo = $_POST["DateTo"];
        $sqli = "DELETE FROM robwhzru_stats.activity_statistics where Stat_ID =" .$statId;
        $result = mysqli_query($connection, $sqli);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>List of Statistics</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"> -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        
        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    

        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    "order": [[ 0, "desc" ]],
                    searching: false, 
                    paging: true, 
                    info: true
                } );
            } );
        </script>     

        <script>
         function SubmitDelete(statId)
        {
            // POST back to same page to avoid values in URL
            var f = document.createElement('form');
            f.action='activity_list.php';
            f.method='POST';
            f.target='_self';
            var i=document.createElement('input');
            i.type='hidden';
            i.name='StatId';
            i.value=statId;
            f.appendChild(i);
            i=document.createElement('input');
            i.type='hidden';
            i.name='DateFrom';
            i.value=document.getElementById("DateFrom").value;
            f.appendChild(i);
            i=document.createElement('input');
            i.type='hidden';
            i.name='DateTo';
            i.value=document.getElementById("DateTo").value;
            f.appendChild(i);
            document.body.appendChild(f);
            f.submit();
        }
        </script>   
    </head>  
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a class="navbar-brand" href="activity_list.php">My Activities</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample06">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="activity_list.php">List Activities </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="activity_new.php">New Activity </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown06">
                        <a class="dropdown-item" href="#">Report 1</a>
                        <a class="dropdown-item" href="#">Report 2</a>
                        <a class="dropdown-item" href="#">Report 3</a>
                    </div>
                </li>
                </ul>
            </div>
        </nav>

        <form id="form" name="form"  method="POST">
            <div class="container" style="width:100%">
                <div>
                    <table class="table" >
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <h1>List of Activity Statistics</h1>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="container" style="width:100%">
                <table class="table" >
                    <tr>
                        <td>
                            <label>Date From</label><br>
                            <input type="date" id="DateFrom" name="DateFrom" value="<?php echo $dateFrom?>" class="datepicker">
                        </td>
                        <td>
                            <label>Date To</label><br>
                            <input type="date" id="DateTo" name="DateTo" value="<?php echo $dateTo?>" class="datepicker">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <input id="SubmitType" name="SubmitType" type="hidden" value="Search" >
                            <input name="Reset" type="Submit" value="Reset" onclick="ResetForm();">
                            <input name= "Submit" type="Submit" value= "Search">
                        </td>
                    </tr>
                </table>
            </div>

            <div class="container" style="width:100%">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Weight</th>
                            <th>Distance</th>
                            <th>Steps</th>
                            <th>Time</th>
                            <th>Average Pace</th>
                            <th>Average Cadance</th>
                            <th>Average Speed</th>
                            <th>Calories</th>
                            <th>Average Heart Rate</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sqli = "SELECT * FROM robwhzru_stats.activity_statistics order by Stat_ID desc";
                            if (isset($_POST['DateFrom'])) 
                            {
                                $dateFrom = $_POST["DateFrom"];
                                $dateTo = $_POST["DateTo"];
                                // Build up the criteria string
                                $criteria = " WHERE Date BETWEEN '" . $dateFrom . "' AND '" . $dateTo . "' ";
                                $sqli = "SELECT * FROM robwhzru_stats.activity_statistics " . $criteria . " order by Stat_ID desc";
                            }
                            try 
                            {
                                $result = mysqli_query($connection, $sqli);
                                while ($row = mysqli_fetch_array($result)) 
                                {
                                    echo "<tr><td nowrap><a href='activity_edit.php?Func=Edit&StatId=".$row["Stat_ID"]."'>".$row["Date"]."</a></td>
                                    <td>".$row["Weight"]."</td><td>".$row["Distance"]."</td><td>".$row["StepCount"]."</td><td>".$row["TotalTime"]."</td>
                                    <td>".$row["AveragePace"]."</td><td>".$row["AverageCadance"]."</td><td>".$row["AverageSpeed"]."</td><td>".$row["TotalCalories"]."</td>
                                    <td>".$row["AverageHeartRate"]."</td><td><input type=button onclick=\"SubmitDelete(".$row["Stat_ID"].");\" value='Delete'/></td></tr>";
                                }
                            } catch (Exception $e) {
                                echo 'Caught exception: ',  $e->getMessage(), "\n";
                            }
                            // Close database connection
                            require 'db_disconnect.php';
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </body>
</html>