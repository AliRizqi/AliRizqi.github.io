<?php
    include("../../classes/User.php");
    include("../../config/config.php");

    if(isset($_POST['songId']) && isset($_POST['username']))
    {
        $id = $_POST['songId'];
        $username = $_POST['username'];
        $userLoggedIn = new User($conn, $username);

        if($userLoggedIn->checkDislike($id) == 0)
        {
            if($userLoggedIn->checkLike($id) == 1)
            {
                $userLoggedIn->removeLike($id);
            }
            $userLoggedIn->dislike($id);
            echo "You disliked this song.";
            exit();
        }
        else
        {
            echo "You have already disliked this song.";
        }
    }
?>