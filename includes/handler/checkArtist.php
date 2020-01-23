<?php
    if($_SESSION['role'] != "artist")
    {
        header("Location:../../index.php");
        exit();
    }
?>