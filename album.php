<?php include("includes/includedFiles.php"); ?>

<?php
    if(isset($_GET['id']))
    {
        $albumId = $_GET['id'];
    }
    else
    {
        header("Location:index.php");
    }

    $album = new Album($conn, $albumId);
    $artist = $album->getArtist();

?>

<div class="entityInfo">
    
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="Album-Pict">
    </div>
    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getName(); ?></p>
        <p><?php echo $album->getNumberOfSongs(); ?> songs</p>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
            $songIdArray = $album->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId)
            {
                $albumSong = new Song($conn, $songId);
                $albumArtist = $albumSong->getArtist();
                
                echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img src='assets/images/icons/now playing/play-gray.png' class='play' onclick='setTrack(\"". $albumSong->getId() ."\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>".$albumSong->getTitle()."</span>
                        <span class='artistName'>".$albumArtist->getName()."</span>
                    </div>

                    <div class='trackLike'>
                        <input type='hidden' class='songId' value=". $albumSong->getId().">
                        <img src='assets/images/icons/now playing/like.png' class='optionButton' onclick='like(\"". $albumSong->getId() ."\")'>
                    </div>

                    <div class='trackDislike'>
                        <input type='hidden' class='songId' value=". $albumSong->getId().">
                        <img src='assets/images/icons/now playing/dislike.png' class='optionButton' onclick='dislike(\"". $albumSong->getId() ."\")'>
                    </div>

                    <div class='trackOption'>
                        <input type='hidden' class='songId' value=". $albumSong->getId().">
                        <img src='assets/images/icons/now playing/more.png' class='optionButton' onclick='showOptionsMenu(this)'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'> ".$albumSong->getDuration()."</span>
                    </div>
                </li>";
                $i++;
            }
        ?>

        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray);?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>

    </ul>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist :: getPlaylistDropdown($conn, $userLoggedIn->getUsername());?>
</nav>

