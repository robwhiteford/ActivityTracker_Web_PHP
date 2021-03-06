<?php
    session_start();
    
    // Utility function to show alert from php
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    // Create database connection
    require 'db_connect.php';

    if (!isset($_SESSION["LoginUser"]))
    {
        // Not logged in redirect to login page
        header("Location: login.php", true, 301);
        exit();
    }


    // Declare variables for data insert
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
        
        $sqli = " INSERT INTO `activity_statistics`(`Date`, `Weight`, `StepCount`, `Distance`, `TotalTime`, `AveragePace`, `MaxPace`, 
                `AverageCadance`, `MaxCadance`, `AverageStride`, `AverageSpeed`, `TotalCalories`, `AverageHeartRate`, `MaxHeartRate`, `MinHeartRate`) 
                VALUES ('{$activityDate}','{$weight}','{$stepCount}','{$distance}','{$totalTime}','{$averagePace}','{$maximumPace}','{$averageCadance}',
                    '{$maximumCadance}','{$averageStride}','{$averageSpeed}','{$calories}','{$averageHeartRate}','{$maximumHeartRate}','{$minimumHeartRate}')";


        if (mysqli_query($connection, $sqli)) 
        {
            phpAlert("Record saved successfully");
        }
        else
        {
            phpAlert("Error: " . $sqli . "" . mysqli_error($connection));
        }         
    }
    // Close database connection
    require 'db_disconnect.php';
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add New activity</title>
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
        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown06" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
        <div class="dropdown-menu" aria-labelledby="dropdown06">
            <a class="dropdown-item" href="rpt_averagepace.php">Average/Maximum Pace</a>
            <a class="dropdown-item" href="rpt_heartrate.php">Heart Rates</a>
            <a class="dropdown-item" href="rpt_within30min.php">Within 30 minutes</a>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout </a>
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
                                <h1>Add New Activity</h1>
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
                            <input id="Weight" name="Weight" placeholder="00.0">
                        </td>
                        <td style="width:30%">
                            <label>Step Count</label><br>
                            <input id="StepCount" name="StepCount" placeholder="0000">
                        </td>                            
                    </tr>
                    <tr>
                        <td>
                            <label>Distance (kms)</label><br>
                            <input id="Distance" name="Distance" placeholder="00.00">
                        </td>
                        <td>
                            <label>Total Time</label><br>
                            <input id="TotalTime" name="TotalTime" placeholder="hh:mm:ss">
                        </td>
                        <td>
                            <label>Average Pace</label><br>
                            <input id="AveragePace" name="AveragePace" placeholder="00.00">
                        </td>                            
                    </tr>
                    <tr>
                        <td>
                            <label>Maximum Pace </label><br>
                            <input id="MaximumPace" name="MaximumPace" placeholder="00.00">
                        </td>
                        <td>
                            <label>Average Cadance</label><br>
                            <input id="AverageCadance" name="AverageCadance" placeholder="00">
                        </td>
                        <td>
                            <label>Maximum Cadance</label><br>
                            <input id="MaximumCadance" name="MaximumCadance" placeholder="00">
                        </td>                            
                    </tr> 
                    <tr>
                        <td>
                            <label>Average Stride</label><br>
                            <input id="AverageStride" name="AverageStride" placeholder="00">
                        </td>
                        <td>
                            <label>Average Speed</label><br>
                            <input id="AverageSpeed" name="AverageSpeed" placeholder="00.00">
                        </td>
                        <td>
                            <label>Calories</label><br>
                            <input id="Calories" name="Calories" placeholder="000">
                        </td>                            
                    </tr>
                    <tr>
                        <td>
                            <label>Average Heart Rate</label><br>
                            <input id="AverageHeartRate" name="AverageHeartRate" placeholder="000">
                        </td>
                        <td>
                            <label>Maximum Heart Rate</label><br>
                            <input id="MaximumHeartRate" name="MaximumHeartRate" placeholder="000">
                        </td>
                        <td>
                            <label>Minimum Heart Rate</label><br>
                            <input id="MinimumHeartRate" name="MinimumHeartRate" placeholder="000">
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