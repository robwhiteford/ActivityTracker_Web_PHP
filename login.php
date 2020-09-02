<?php

    // Utility function to show alert from php
    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    // Create database connection
    require 'db_connect.php';

    // Check if session exists then destroy it
    //session_start();
    //session_unset();
    //session_destroy();

    if (isset($_POST["username"]))
    {
        $sql = "Select * from robwhzru_stats.login where Username='". $_POST["username"] . "' and Password ='" .  $_POST["password"]  . "'"; 
        $result = mysqli_query ($connection,$sql);
        $user = mysqli_fetch_array($result);
        if ($user)
        {
                session_start();
                $_SESSION["LoginUser"] = $_POST["username"];
                $message = "Successful Login";
                header("Location: activity_list.php", true, 301);
                exit();
        }      
        else
        {
                $message = "Invalid Login";
        }
    }
    // Close database connection
    require 'db_disconnect.php';
    
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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
        
        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    </head>  
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a class="navbar-brand" href="activity_list.php">My Activities</a>
        </nav>
        <div class="container" style="width:100%">
            <div>
                <table class="table" >
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <h1>My Activities Web Site</h1>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height:50vh">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                        <form action="" method="post" id="frmLogin" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="password">
                                </div>
                                <div class="text-danger"><?php if(isset($message)) {echo $message;} ?></div>
                                <input type="submit" id="sendlogin" class="btn btn-primary" value="Login">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>