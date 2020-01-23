<?php
    ob_start();

    session_start();
    
    #$timezone = date_default_timezone_set("Asia/Bangkok");

    $conn = mysqli_connect("localhost","root","","beathub");

    if(mysqli_connect_errno())
    {
        echo "Failed to connect to the database" , mysqli_connect_errno();
    }
?>