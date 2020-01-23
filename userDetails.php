<?php
    include("includes/includedFiles.php");
?>

<div class="userDetails">
    <div class="centerSection">
        <div class="userInfo">
            <h1>Hi, <?php echo $userLoggedIn->getName();?></h1>
        </div>
    </div>
    <div class="container borderBottom">
        <h2>Email</h2>
        <input type="text" class="email" name="email" placeholder="Email Address" value="<?php echo $userLoggedIn->getEmail();?>">
        <span class="message"></span>
        <button class="button" onclick="updateEmail('email')">Save</button>
    </div>
    <div class="container borderBottom">
        <h2>Change Profile Picture</h2>
        <form action="includes/handler/ajax/changeProfilePicture.php" method="POST" enctype="multipart/form-data">
            <div class="fileUpload">
                <input type="file" id="realFileButton" class="profPict" name="profilePicture" hidden="hidden">
                <button id="fakeFileButton" type="button" class="fileButton">Choose File</button>
                <span class="customText" id="customText">No file chosen</span>
                <input type="submit" id="submit" value="Change" class="button">
            </div>
            <input type="hidden" name="username" value="<?php echo $userLoggedIn->getUsername();?>">
        </form>
    </div>
    <div class="containera">
        <h2>Password</h2>
        <input type="password" class="oldPass" name="oldPass" placeholder="Current Password">
        <input type="password" class="newPass" name="newPass" placeholder="New Password">
        <input type="password" class="conPass" name="conPass" placeholder="Confirm New Password">
        <span class="message"></span>
        <button class="button" onclick="updatePassword('oldPass','newPass','conPass')">Save</button>
    </div>
</div>


<script type="text/javascript">
    const realFileButton = document.getElementById("realFileButton");
    const fakeFileButton = document.getElementById("fakeFileButton");
    const customText = document.getElementById("customText");

    fakeFileButton.addEventListener("click", function(){
        realFileButton.click();
    });

    realFileButton.addEventListener("change", function(){
        if(realFileButton.value){
            customText.innerHTML = realFileButton.value.match(/[\/\\]([ \w\d\s\.\-\(\)]+)$/);
            if(customText.innerHTML == null)
            {
                customText.innerHTML = "File selected.";
            }
        }
        else
        {
            customText.innerHTML = "No file chosen.";
        }
    });
</script>