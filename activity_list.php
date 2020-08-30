<?php
    // Get the database connection
    //session_cache_limiter('private_no_expire'); // work


    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

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
    $testerName = [];
    $customerTested = [];
    $moduleTested = [];
    $testResult = [];
    if (isset($_POST['DateFrom'])) 
    {
        $submitType = $_POST["SubmitType"];
        if($submitType=="Search")
        {
            $func = 'Search';



            if(isset($_POST["ddlTesterName"]))  
            { 
                $testerName = $_POST["ddlTesterName"];
            }
            
            if(isset($_POST["ddlCustomerName"]))  
            { 
                $customerTested = $_POST["ddlCustomerName"];
            }

            if(isset($_POST["ddlModuleTested"]))  
            { 
                $moduleTested = $_POST["ddlModuleTested"];
            }

            if(isset($_POST["ddlResult"]))  
            { 
                $testResult = $_POST["ddlResult"];
            }
            $dateFrom = $_POST["DateFrom"];
            $dateTo = $_POST["DateTo"];
        }
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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        


        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    
        <script>
            $(document).ready(function() {
                $('#display').DataTable();
            } );
        </script>
    
    </head>  
    <body>
      <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Expand at xl</a>
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
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>



        <form id="form" name="form"  method="POST">


        <div class="container" style="width:100%">
                <div class= "row">
                    <table class="table" >
                        <tr>
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <h1>List of Activity Statistics</h1>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="container" style="width:100%">
                <div class= "row">
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
            </div>

              
            <div class="container" style="width:100%">
                <div class= "row">
                    <table id="display" class="table table-striped table-bordered">
                    <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Weight</th>
                                <th>Distance</th>
                                <th>Steps</th>
                                <th>Time</th>
                            </tr>
                                <?php
                                $sqli = "SELECT * FROM robwhzru_stats.activity_statistics order by Stat_ID desc";
                                if (isset($_POST['DateFrom'])) 
                                {
                                    if($submitType=="Search")
                                    {
                                        $func = 'Search';
                                        $dateFrom = $_POST["DateFrom"];
                                        $dateTo = $_POST["DateTo"];
                                        // Build up the criteria string
                                        $criteria = " WHERE Date BETWEEN '" . $dateFrom . "' AND '" . $dateTo . "' ";
                                        $sqli = "SELECT * FROM robwhzru_stats.activity_statistics " . $criteria . " order by Stat_ID desc";
                                    }
                                }
                                //phpAlert($sqli);
                                try 
                                {
                                    $result = mysqli_query($connection, $sqli);
                                    while ($row = mysqli_fetch_array($result)) 
                                    {
                                        echo "<tr><td><a href='activity_edit.php?Func=Edit&TestId=".$row["Stat_ID"]."'>".$row["Stat_ID"]."</a></td><td>".$row["Date"]."</td><td>".$row["Weight"]."</td><td>".$row["Distance"]."</td><td>".$row["StepCount"]."</td><td>".$row["TotalTime"]."</td></tr>";
                                    }
                                } catch (Exception $e) {
                                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                                }

                            ?>
    
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </body>
</html>