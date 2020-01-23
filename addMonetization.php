<?php
    include("includes/includedFiles.php");
    include("includes/handler/checkArtist.php");
?>

<div class="monetizationContainer">
    <div class="containera borderBottom">  
        <h1>Monetization</h1>
        <input type="password" class="conPass" placeholder="Please verify your account" name="password">
        <span class="message"></span>
        <button class="button" onclick="requestMonetization('conPass')">Verify</button>
    </div>
</div>