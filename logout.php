<?php

session_start();

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    phpAlert("Session LoginUser:" . $_SESSION["LoginUser"]);

    // Redirect to login page
    header("Location: login.php", true, 301);
    exit();   
?>

<html>
<head>
</head>
<body>
Logout Page 2
</body>
</html>