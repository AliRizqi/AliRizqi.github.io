<?php include("includes/includedFiles.php"); ?>

<?php
    if(isset($_GET['id']))
    {
        $playlistId = $_GET['id'];
    }
    else
    {
        header("Location:index.php");
    }

   $playlist = new Playlist($conn, $playlistId);
   $owner = new User($conn, $playlist->getOwner());

?>

<div class="entityInfo">
    
    <div class="leftSection">
        <div class="playlistImage">
            <img src="assets/images/icons/playlist.png" alt="Playlist-Pict">
        </div>
    </div>
    <div class="rightSection">
        <h2><?php echo $playlist->getName(); ?></h2>
        <p>By <?php echo $playlist->getOwner(); ?></p>
        <p><?php echo $playlist->getNumberOfSongs(); ?> songs</p>
        <button class="button" onclick="deletePlaylist(<?php echo $playlist->getId();?>)">Delete Playlist</button>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
            $songIdArray = $playlist->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId)
            {
                $playlistSong = new Song($conn, $songId);
                $songArtist = $playlistSong->getArtist();
                
                echo "<li class='tracklistRow'>
                    <div class='trackCount'>
                        <img src='assets/images/icons/now playing/play-gray.png' class='play' onclick='setTrack(\"". $playlistSong->getId() ."\", tempPlaylist, true)'>
                        <span class='trackNumber'>$i</span>
                    </div>

                    <div class='trackInfo'>
                        <span class='trackName'>".$playlistSong->getTitle()."</span>
                        <span class='artistName'>".$songArtist->getName()."</span>
                    </div>

                    <div class='trackLike'>
                        <input type='hidden' class='songId' value=". $playlistSong->getId().">
                        <img src='assets/images/icons/now playing/like.png' class='optionButton' onclick='like(\"". $playlistSong->getId() ."\")'>
                    </div>

                    <div class='trackDislike'>
                        <input type='hidden' class='songId' value=". $playlistSong->getId().">
                        <img src='assets/images/icons/now playing/dislike.png' class='optionButton' onclick='dislike(\"". $playlistSong->getId() ."\")'>
                    </div>

                    <div class='trackOption'>
                        <input type='hidden' class='songId' value=". $playlistSong->getId().">
                        <img src='assets/images/icons/now playing/more.png' class='optionButton' onclick='showOptionsMenu(this)'>
                    </div>

                    <div class='trackDuration'>
                        <span class='duration'> ".$playlistSong->getDuration()."</span>
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
    <div class="item" onclick="removeFromPlaylist(this, <?php echo $playlistId;?>)">Remove from Playlist</div>
</nav>