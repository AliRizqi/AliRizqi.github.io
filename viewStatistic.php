<?php
    include("includes/includedFiles.php");
    include("includes/handler/checkArtist.php");

    $artistId = $userLoggedIn->getArtistId();
    $artist = new Artist($conn, $artistId);
?>

<div class="statisticContainer">
    <div class="container borderBottom">
        <h2>Your Songs</h2>
    </div>
    <table class="tableOfSongs">
            <tr>
                <th>No.</th>
                <th>Song</th>
                <th>Album</th>
                <th>Duration</th>
                <th>PlayCount</th>
            </tr>
            <?php
                $songIds = $artist->getSongIds();
                $i = 1;
                foreach($songIds as $id)
                {
                    $song = new Song($conn, $id);
                    $album = $song->getAlbum();
                    $albumTitle = $album->getTitle();
            ?>
                    <tr>
                        <td><?php echo $i;?> </th>
                        <td><?php echo $song->getTitle();?></th>
                        <td><?php echo $albumTitle;?></th>
                        <td><?php echo $song->getDuration();?></th>
                        <td><?php echo $song->getPlayCount();?></th>
                    </tr>
            <?php
                $i+=1;
                }
            ?>
        </table>
</div>