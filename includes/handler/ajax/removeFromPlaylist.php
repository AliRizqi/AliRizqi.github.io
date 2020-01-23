<?php
    include("../../config/config.php");

    if(isset($_POST['playlistId']) && isset($_POST['songId']))
    {
        $playlistId = $_POST['playlistId'];
        $songId = $_POST['songId'];

        $query = mysqli_query($conn, "DELETE FROM playlistssongs WHERE songId = '$songId' AND playlistId = '$playlistId'");
    }
    else
    {
        echo "Playlist ID or Song ID not set.";
    }
?>