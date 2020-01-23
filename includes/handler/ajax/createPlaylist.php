<?php
    include("../../config/config.php");
    if(isset($_POST['name']) && isset($_POST['username']))
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $date = date("Y-m-d");
        $query = mysqli_query($conn, "INSERT INTO playlists VALUES ('','$name','$username','$date')");
    }
    else
    {
        echo "No username or playlist name.";
    }
    
?>