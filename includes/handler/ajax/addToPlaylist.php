<?php
    include("../../config/config.php");

    if(isset($_POST['playlistId']) && isset($_POST['songId']))
    {
        $playlistId = $_POST['playlistId'];
        $songId = $_POST['songId'];

        $getOrderNum = mysqli_query($conn, "SELECT MAX(playlistOrder) as playlistOrder FROM playlistssongs WHERE playlistId = '$playlistId'");
        $row = mysqli_fetch_array($getOrderNum);
        $orderNum = $row['playlistOrder'] + 1;
        $query = mysqli_query($conn, "INSERT INTO playlistssongs VALUES('','$songId','$playlistId','$orderNum')");
    }
    else
    {
        echo "Playlist ID or Song ID not set.";
    }
?>