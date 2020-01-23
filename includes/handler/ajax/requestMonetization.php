<?php
    include("../../config/config.php");
    include("../../classes/Artist.php");
    include("../../classes/User.php");
    if(isset($_POST['password']))
    {
        $password = $_POST['password'];
        $password = mysqli_real_escape_string($conn, $password);
        $hashed = md5($password);
        $username = $_POST['username'];

        $user = new User($conn, $username);
        $id = $user->getArtistId();
        $artist = new Artist($conn, $id);
        $result = $artist->verify($hashed, $username);
        if($result == 1)
        {
            echo "Your request has been sent";
        }
        else
        {
            echo "You are not verified";
        }
    }
    else
    {
        echo "Password was not passed.";
    }
?>