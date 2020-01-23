<?php
    include("includes/includedFiles.php");

    if(isset($_GET['term']))
    {
        $term = urldecode($_GET['term']);
        
    }
    else
    {
        $term = "";
    }
?>

<div class="searchContainer">
    <h2>Find songs, artists, or albums you need</h2>
    <input type="text" class="searchInput" value="<?php echo $term;?>" placeholder="Start typing" onfocus="this.setSelectionRange(this.value.length,this.value.length);">
</div>

<script>
    $(".searchInput").focus();
    $(function(){
        $(".searchInput").keyup(function(){
            clearTimeout(timer);

            timer = setTimeout(function(){
                var val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 1000);
        });
    });
</script>

<?php
    if($term == "")
    {
        exit();
    }
?>

<div class="tracklistContainer borderBottom">
    <h2>TOP 10</h2>
    <ul class="tracklist">
        <?php
            $songsQuery = mysqli_query($conn, "SELECT id from songs WHERE title LIKE '%$term%' LIMIT 10");
            if(mysqli_num_rows($songsQuery) == 0)
            {
                echo "<span class='noResult'>Ups! No song matched '" . $term . "'.</span>";
            }
            $songIdArray = array();
            $i = 1;
            while($row = mysqli_fetch_array($songsQuery))
            {
                array_push($songIdArray, $row['id']);
                $albumSong = new Song($conn, $row['id']);
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

<div class="artistContainer borderBottom">

    <h2>Artist</h2>

    <?php
        $artistQuery = mysqli_query($conn, "SELECT id from artist WHERE name LIKE '%$term%' LIMIT 10");
        if(mysqli_num_rows($artistQuery) == 0)
        {
            echo "<span class='noResult'>Ups! No artist matched '" . $term . "'.</span>";
        }
        else
        {
            while($row = mysqli_fetch_array($artistQuery))
            {
                $artistFound = new Artist($conn, $row['id']);

                echo "
                    <div class='searchResultRow'>
                        <div class='artistName'>
                            <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=".$artistFound->getId()."\")'>".$artistFound->getName().
                            "</span>
                        </div>
                    </div>
                ";
            }
        }
        
    ?>

</div>

<div class="gridViewContainer">
    <h2>Album</h2>
    <?php
        $albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE title LIKE '%$term%' LIMIT 10");
        if(mysqli_num_rows($albumQuery) == 0)
        {
            echo "<span class='noResult'>Ups! No album matched '" . $term . "'.</span>";
        }
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