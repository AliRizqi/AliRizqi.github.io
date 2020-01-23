<?php
    include("includes/includedFiles.php");
    if(isset($_GET['id']))
    {
        $artistId = $_GET['id'];
    }
    else
    {
        header("Location:index.php");
    }

    $artist = new Artist($conn, $artistId);
?>

<div class="entityInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName"><?php echo $artist->getName();?></h1>
            <div class="headerButtons">
                <button class="button blue" onclick="playFirstSong()">PLAY</button>
            </div>
        </div>
    </div>
</div>

<div class="tracklistContainer borderBottom">
    <h2>TOP 5</h2>
    <ul class="tracklist">
        <?php
            $songIdArray = $artist->getSongIds();
            $i = 1;
            foreach($songIdArray as $songId)
            {
                if($i > 5)
                    break; //tampilkan 5 lagu yang paling banyak playcountnya
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

<div class="gridViewContainer">
    <h2>Album</h2>
    <?php
        $albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE artist='$artistId'");
        while ($row = mysqli_fetch_array($albumQuery))
        {
            
            echo "<div class='gridViewItem'>
                <span role=link tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] ."\")'>
                    <img src='" . $row['artworkPath'] . "'>
                    <div class=gridViewInfo>
                        " . $row['title'] . "
                    </div>
                </span>
            </div>";
        }
    ?>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist :: getPlaylistDropdown($conn, $userLoggedIn->getUsername());?>
</nav>