<?php
    include("includes/includedFiles.php");
?>

<div class="entityInfo">
    <div class="centerSection">
        <div class="userInfo">
            <h1><?php echo $userLoggedIn->getName();?></h1>
        </div>
    </div>
    <div class="buttonItems">
        <button class="button" onclick="openPage('userDetails.php')">User Details</button>
        <button class="button" onclick="logout()">LOG OUT</button>
       
    </div>
</div>