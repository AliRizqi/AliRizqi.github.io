<?php
    include("includes/includedFiles.php");
    include("includes/handler/checkArtist.php");
?>

<div class="addAlbum">
    <div class="borderBottom">
        <h1>Add Album</h1>
    </div>
    <form action="addAlbumHandler.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="username" value="<?php echo $userLoggedIn->getUsername();?>">
        <div class="container borderBottom">
            <h3>Album Title</h3>
            <input type="text" class="albumTitle" name="albumTitle" placeholder="Album Title">
            <h3>Album Cover</h3>
            <div class="fileUpload">
                <input type="file" id="realFileButton" class="albumArtWork" name="albumArtWork" hidden="hidden">
                <button id="fakeFileButton" type="button" class="fileButton">Choose File</button>
                <span class="customText" id="customText">No file chosen.</span>
            </div>
            <h3>Album Genre</h3>
            <div class="albumGenre">
                <input type="radio" name="albumGenre" value="1">Pop
                <input type="radio" name="albumGenre" value="2">Indie
                <input type="radio" name="albumGenre" value="3">Country
                <input type="radio" name="albumGenre" value="4">Blues
                <input type="radio" name="albumGenre" value="5">Classic
                <input type="radio" name="albumGenre" value="6">EDM
                <input type="radio" name="albumGenre" value="7">RnB
            </div>
            <input type="submit" value="Add Album" class="button">
        </div>
        
    </form>
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