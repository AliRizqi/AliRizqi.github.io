<?php
    include("../../classes/User.php");
    include("../../config/config.php");

    if(isset($_POST['songId']) && isset($_POST['username']))
    {
        $id = $_POST['songId'];
        $username = $_POST['username'];
        $userLoggedIn = new User($conn, $username);

        if($userLoggedIn->checkLike($id) == 0)
        {
            if($userLoggedIn->checkDislike($id) == 1)
            {
                $userLoggedIn->removeDislike($id);
            }
            $userLoggedIn->like($id);
            echo "You liked this song.";
            exit();
        }
        else
        {
            echo "You have already liked this song.";
        }
    }
?>