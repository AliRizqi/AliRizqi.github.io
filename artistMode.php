<?php
    include("includes/includedFiles.php");
    include("includes/handler/checkArtist.php");
?>

<div class="artistDetails">
    <div class="container borderBottom">
        <h2>Album and Song</h2>
        <button class="button" onclick="openPage('addAlbum.php')">Add Album</button>
        <button class="button" onclick="openPage('addSong.php')">Add Song</button>
    </div>
    <div class="container borderBottom">
        <h2>Statistic</h2>
        <button class="button" onclick="openPage('viewStatistic.php')">View Statistic</button>
    </div>
    <div class="container borderBottom">
        <h2>Monetization</h2>
        <button class="button" onclick="openPage('addMonetization.php')">Add Request</button>
    </div>
</div>