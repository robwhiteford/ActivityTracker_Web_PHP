<?php

    // Utility function to show alert from php
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    // Create database connection
    require 'db_connect.php';

    // Check if session exists
    session_start();
    if (!isset($_SESSION["LoginUser"]))
    {
        // Not logged in redirect to login page
        header("Location: login.php", true, 301);
        exit();
    }


    // Declare variables for data insert
    $statId = "";
    $activityDate = date('Y-m-d');
    $weight = "";
    $stepCount = "";
    $distance = "";
    $totalTime = "";
    $averagePace = "";
    $maximumPace = "";
    $averageCadance = "";
    $maximumCadance = "";
    $averageStride = "";
    $averageSpeed = "";
    $calories = "";
    $averageHeartRate = "";
    $maximumHeartRate = "";
    $minimumHeartRate = "";

    $statId = $_GET['StatId'];
    $sqli = "Select * FROM robwhzru_stats.activity_statistics where Stat_ID =" .$statId;
    $result = mysqli_query($connection, $sqli);
    if (mysqli_query($connection, $sqli)) 
    {
        while ($row = mysqli_fetch_array($result)) 
        {
            $activityDate = $row["Date"];
            $weight = $row["Weight"];
            $stepCount = $row["StepCount"];
            $distance = $row["Distance"];
            $totalTime = $row["TotalTime"];
            $averagePace = $row["AveragePace"];
            $maximumPace = $row["MaxPace"];
            $averageCadance = $row["AverageCadance"];
            $maximumCadance = $row["MaxCadance"];
            $averageStride = $row["AverageStride"];
            $averageSpeed = $row["AverageSpeed"];
            $calories = $row["TotalCalories"];
            $averageHeartRate = $row["AverageHeartRate"];
            $maximumHeartRate = $row["MaxHeartRate"];
            $minimumHeartRate = $row["MinHeartRate"];
        }
    } 
    else 
    {
        phpAlert("Error: " . $sql . "" . mysqli_error($connection));
    }

 
    if (isset($_POST['Submit'])) 
    {
        if(isset($_POST["ActivityDate"]))  
        { 
            $activityDate = $_POST["ActivityDate"];
        }
        if(isset($_POST["Weight"]))  
        { 
            $weight = $_POST["Weight"];
        }
        if(isset($_POST["StepCount"]))  
        { 
            $stepCount = $_POST["StepCount"];
        }
        if(isset($_POST["Distance"]))  
        { 
            $distance = $_POST["Distance"];
        }
        if(isset($_POST["TotalTime"]))  
        { 
            $totalTime = $_POST["TotalTime"];
        }
        if(isset($_POST["AveragePace"]))  
        { 
            $averagePace = $_POST["AveragePace"];
        } 
        if(isset($_POST["MaximumPace"]))  
        { 
            $maximumPace = $_POST["MaximumPace"];
        } 
        if(isset($_POST["AverageCadance"]))  
        { 
            $averageCadance = $_POST["AverageCadance"];
        } 
        if(isset($_POST["MaximumCadance"]))  
        { 
            $maximumCadance = $_POST["MaximumCadance"];
        }   
        if(isset($_POST["AverageStride"]))  
        { 
            $averageStride = $_POST["AverageStride"];
        }  
        if(isset($_POST["AverageSpeed"]))  
        { 
            $averageSpeed = $_POST["AverageSpeed"];
        }  
        if(isset($_POST["Calories"]))  
        { 
            $calories = $_POST["Calories"];
        }     
        if(isset($_POST["AverageHeartRate"]))  
        { 
            $averageHeartRate = $_POST["AverageHeartRate"];
        }  
        if(isset($_POST["MaximumHeartRate"]))  
        { 
            $maximumHeartRate = $_POST["MaximumHeartRate"];
        } 
        if(isset($_POST["MinimumHeartRate"]))  
        { 
            $minimumHeartRate = $_POST["MinimumHeartRate"];
        }  
        
        $sqli = "UPDATE `robwhzru_stats`.`activity_statistics`
        SET
        `Date` = '{$activityDate}',
        `Weight` = '{$weight}',
        `StepCount` = '{$stepCount}',
        `Distance` = '{$distance}',
        `TotalTime` = '{$totalTime}',
        `AveragePace` = '{$averagePace}',
        `MaxPace` = '{$maximumPace}',
        `AverageCadance` = '{$averageCadance}',
        `MaxCadance` = '{$maximumCadance}',
        `AverageStride` = '{$averageStride}',
        `AverageSpeed` = '{$averageSpeed}',
        `TotalCalories` = '{$calories}',
        `AverageHeartRate` = '{$averageHeartRate}',
        `MaxHeartRate` = '{$maximumHeartRate}',
        `MinHeartRate` = '{$minimumHeartRate}'
        WHERE `Stat_ID` = " .$statId;


        if (mysqli_query($connection, $sqli)) 
        {
            phpAlert("Record updated successfully");
        }
        else
        {
            phpAlert("Error: " . $sqli . "" . mysqli_error($connection));
        }         
        // Close database connection
        require 'db_disconnect.php';
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Activity</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
       
        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

        <!-- custom javascript -->
        <script src="assets/main.js"></script>
   
        <script>
            $(document).ready(function() {
                $('#display').DataTable();
            } );
        </script>
    
    </head>  
    <body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a class="navbar-brand" href="#">My Activities</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample06">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="activity_list.php">List Activities </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="activity_new.php">New Activity </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
            <div class="dropdown-menu" aria-labelledby="dropdown06">
              <a class="dropdown-item" href="#">Report 1</a>
              <a class="dropdown-item" href="#">Report 2</a>
              <a class="dropdown-item" href="#">Report 3</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <form id="form" name="form" onsubmit="return ValidateForm();" method="POST">
        <div class="container" style="width:100%">
                <div >
                    <table class="table" >
                        <tr>
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <h1>Edit Activity</h1>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="container" style="width:100%">
                <table style="width:100%">
                    <tr>
                        <td style="width:30%">
                            <label>Date </label><br>
                            <input type="date" id="ActivityDate" name="ActivityDate" value="<?php echo $activityDate?>" class="datepicker">
                        </td>
                        <td style="width:30%">
                            <label>Weight (kgs)</label><br>
                            <input id="Weight" name="Weight" value="<?php echo $weight?>">
                        </td>
                        <td style="width:30%">
                            <label>Step Count</label><br>
                            <input id="StepCount" name="StepCount" value="<?php echo $stepCount?>">
                        </td>                            
                    </tr>
                    <tr>
                        <td>
                            <label>Distance (kms)</label><br>
                            <input id="Distance" name="Distance" value="<?php echo $distance?>">
                        </td>
                        <td>
                            <label>Total Time</label><br>
                            <input id="TotalTime" name="TotalTime" value="<?php echo $totalTime?>">
                        </td>
                        <td>
                            <label>Average Pace</label><br>
                            <input id="AveragePace" name="AveragePace" value="<?php echo $averagePace?>">
                        </td>                            
                    </tr>
                    <tr>
                        <td>
                            <label>Maximum Pace </label><br>
                            <input id="MaximumPace" name="MaximumPace" value="<?php echo $maximumPace?>">
                        </td>
                        <td>
                            <label>Average Cadance</label><br>
                            <input id="AverageCadance" name="AverageCadance" value="<?php echo $averageCadance?>">
                        </td>
                        <td>
                            <label>Maximum Cadance</label><br>
                            <input id="MaximumCadance" name="MaximumCadance" value="<?php echo $maximumCadance?>">
                        </td>                            
                    </tr> 
                    <tr>
                        <td>
                            <label>Average Stride</label><br>
                            <input id="AverageStride" name="AverageStride" value="<?php echo $averageStride?>">
                        </td>
                        <td>
                            <label>Average Speed</label><br>
                            <input id="AverageSpeed" name="AverageSpeed" value="<?php echo $averageSpeed?>">
                        </td>
                        <td>
                            <label>Calories</label><br>
                            <input id="Calories" name="Calories" value="<?php echo $calories?>">
                        </td>                            
                    </tr>
                    <tr>
                        <td>
                            <label>Average Heart Rate</label><br>
                            <input id="AverageHeartRate" name="AverageHeartRate" value="<?php echo $averageHeartRate?>">
                        </td>
                        <td>
                            <label>Maximum Heart Rate</label><br>
                            <input id="MaximumHeartRate" name="MaximumHeartRate" value="<?php echo $maximumHeartRate?>">
                        </td>
                        <td>
                            <label>Minimum Heart Rate</label><br>
                            <input id="MinimumHeartRate" name="MinimumHeartRate" value="<?php echo $minimumHeartRate?>">
                        </td>                            
                    </tr>                                                                       
                    <tr>
                        <td colspan="3" style="text-align: center;height:10px">&nbsp;

                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center">
                            <input id="SubmitType" name="SubmitType" type="hidden" value="Search" >
                            <input name="Reset" type="Reset" value="Reset">
                            <input name= "Submit" type="Submit" value= "Save">
                        </td>
                    </tr>                        
               </table>
            </div>
        </form>
    </body>
</html>