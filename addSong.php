<?php
    include("includes/includedFiles.php");
    include("includes/handler/checkArtist.php");
    $username = $userLoggedIn->getUsername();
    $query = mysqli_query($conn, "SELECT id FROM artist WHERE username='$username'");
    $row = mysqli_fetch_array($query);
    $id = $row['id'];

    $artist = new Artist($conn, $id);
?>

<div class="addSong">
    <div class="borderBottom">
        <h1>Add Song</h1>
    </div>
    <form action="addSongHandler.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="username" value="<?php echo $userLoggedIn->getUsername();?>">
        <div class="container borderBottom">
            <h3>Song Title</h3>
            <input type="text" class="songTitle" name="songTitle" placeholder="Song Title">
            <h3>Song File</h3>
            <div class="fileUpload">
                <input type="file" id="realFileButton" class="songTrack" name="songTrack" hidden="hidden">
                <button id="fakeFileButton" type="button" class="fileButton">Choose File</button>
                <span class="customText" id="customText">No file chosen.</span>
            </div>
            <h3>Song Duration</h3>
            <input type="text" class="songDuration" name="songDuration" placeholder="Song Duration">
            <h3>Song Album</h3>
            <div class="songAlbum">
                <?php
                    $albumIds = $artist->getAlbumId();
                    foreach($albumIds as $id)
                    {
                        $album = new Album($conn, $id);
                        $title = $album->getTitle();
                ?>
                        <input type="radio" name="songAlbum" id="" value="<?php echo $id;?>"><?php echo $title;?>
                <?php
                    }
                ?>
            </div>
            <input type="submit" value="Add Song" class="button" name="submit">
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