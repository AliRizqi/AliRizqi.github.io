<?php
    include("../../config/config.php");

    if(isset($_POST['artistId']))
    {
        $artistId = $_POST['artistId'];
        $query = "SELECT * FROM artist WHERE id='$artistId'";
        $result = mysqli_query($conn, $query);
        $resultArray = mysqli_fetch_array($result);

        echo json_encode($resultArray);
    }

?>