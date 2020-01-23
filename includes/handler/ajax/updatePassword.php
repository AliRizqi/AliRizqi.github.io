<?php
    include("../../config/config.php");

    if(isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['conPass']) && isset($_POST['username']))
    {
        $oldPass = $_POST['oldPass'];
        $newPass = $_POST['newPass'];
        $conPass = $_POST['conPass'];
        $username = $_POST['username'];

        $getPassword = mysqli_query($conn, "SELECT password FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($getPassword);
        $oldPassHashed = md5($oldPass);

        if($oldPassHashed == $row['password'])
        {
            if($newPass == $conPass)
            {
                $newPass = md5($newPass);
                $query = mysqli_query($conn, "UPDATE users SET password='$newPass' WHERE username='$username'");
                echo "Your password has been updated.";
                exit();
            }
        }
        echo "Failed";
    }
?>