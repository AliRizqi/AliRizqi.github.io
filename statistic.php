<?php
    include("includes/includedFiles.php");
?>

<div class="statisticContainer">
    <h2>Statistic</h2>
    <span class="playedSongs">You have listened <?php echo $userLoggedIn->getPlayCount();?> time(s).</span>
</div>