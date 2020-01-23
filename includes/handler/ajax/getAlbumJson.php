<?php
    include("../../config/config.php");

    if(isset($_POST['albumId']))
    {
        $albumId = $_POST['albumId'];
        $query = "SELECT * FROM albums WHERE id='$albumId'";
        $result = mysqli_query($conn, $query);
        $resultArray = mysqli_fetch_array($result);

        echo json_encode($resultArray);
    }

?>