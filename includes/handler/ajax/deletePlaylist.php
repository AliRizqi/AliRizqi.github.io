<?php
    include("../../config/config.php");
    if(isset($_POST['playlistId']))
    {
        $playlistId = $_POST['playlistId'];
        $playlistQuery = mysqli_query($conn, "DELETE FROM playlists WHERE id = '$playlistId'");
        $songsQuery = mysqli_query($conn, "DELETE FROM playlistssongs WHERE playlistId = '$playlistId'");
    }
    else
    {
        echo "No Playlist ID passed.";
    }
?>