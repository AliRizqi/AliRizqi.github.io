<?php
    include("../../config/config.php");

    if(isset($_POST['songId']))
    {
        $songId = $_POST['songId'];
        $query = "SELECT * FROM songs WHERE id='$songId'";
        $result = mysqli_query($conn, $query);
        $resultArray = mysqli_fetch_array($result);

        echo json_encode($resultArray);
    }

?>