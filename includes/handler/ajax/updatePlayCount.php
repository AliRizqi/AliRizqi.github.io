<?php
    include("../../config/config.php");
    session_start();

    if(isset($_POST['songId']))
    {
        $songId = $_POST['songId'];
        $query = "UPDATE songs SET playCount = playCount + 1 WHERE id='$songId'";
        $result = mysqli_query($conn, $query);

        $username = $_SESSION['userLoggedIn'];
        $query2 = "UPDATE users SET playCount = playCount + 1 WHERE username = '$username'";
        $result = mysqli_query($conn, $query2);
    }

?>