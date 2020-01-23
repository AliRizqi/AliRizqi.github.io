<?php
	$songQuery = mysqli_query($conn, "SELECT * FROM songs ORDER BY RAND() LIMIT 3");

	$resultArray = array();
	while($row=mysqli_fetch_array($songQuery))
	{
		array_push($resultArray, $row['id']);
	}

	$jsonArray = json_encode($resultArray);

?>

<script>
	var newPlaylist = <?php echo $jsonArray?>;
	$(document).ready(function(){
		audioElement = new Audio();
		setTrack(newPlaylist[0], newPlaylist, false);
		updateVolumeProgressBar(audioElement.audio);

		$("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove",function(e){
			e.preventDefault();
		});

		$(".playbackBar .progressBar").mousedown(function(){
			mouseDown = true;
		});

		$(".playbackBar .progressBar").mousemove(function(e){
			if(mouseDown == true)
			{
				//buat waktu tergantung posisi kursor
				timeFromOffset(e, this);
			}
		});

		$(".playbackBar .progressBar").mouseup(function(e){
			timeFromOffset(e, this);
		});

		$(".volumeBar .progressBar").mousedown(function(){
			mouseDown = true;
		});

		$(".volumeBar .progressBar").mousemove(function(e){
			if(mouseDown == true)
			{
				//buat waktu tergantung posisi kursor
				var percentage = e.offsetX / $(this).width();
				if(percentage >= 0 && percentage <= 1)
				{
					audioElement.audio.volume = percentage;
				}
			}
		});

		$(".volumeBar .progressBar").mouseup(function(e){
			var percentage = e.offsetX / $(this).width();
			if(percentage >= 0 && percentage <= 1)
			{
				audioElement.audio.volume = percentage;
			}
		});

		$(document).mouseup(function(){
			mouseDown = false;
		});
	});

	function timeFromOffset(mouse, progressBar)
	{
		var percentage = mouse.offsetX / $(progressBar).width() * 100;
		var seconds = audioElement.audio.duration * (percentage / 100);
		audioElement.setTime(seconds);
	}

	function nextSong()
	{
		if(repeat == true)
		{
			audioElement.setTime(0);
			playSong();
			return;
		}
		if(currentIndex == currentPlaylist.length - 1)
		{
			currentIndex = 0;
		}
		else
		{
			currentIndex++;
		}

		var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
		setTrack(trackToPlay, currentPlaylist, true);
	}

	function prevSong()
	{
		if(repeat == true)
		{
			audioElement.setTime(0);
			playSong();
			return;
		}
		if(currentIndex == 0)
		{
			currentIndex = currentPlaylist.length - 1;
		}
		else
		{
			currentIndex--;
		}

		var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
		setTrack(trackToPlay, currentPlaylist, true);
	}

	function setRepeat()
	{
		repeat = !repeat;
		var imageName = repeat ? "repeat-one-on.png" : "repeat-one-off.png";
		$(".controlButtons.repeat img").attr("src","assets/images/icons/now playing/" + imageName);
	}

	function setVolume()
	{
		audioElement.audio.muted = !audioElement.audio.muted;
		var imageName = audioElement.audio.muted ? "mute.png" : "volume.png";
		$(".controlButtons.volume img").attr("src","assets/images/icons/now playing/" + imageName);
	}

	function setShuffle()
	{
		shuffle = !shuffle;
		var imageName = shuffle ? "shuffle-on.png" : "shuffle.png";
		$(".controlButtons.shuffle img").attr("src","assets/images/icons/now playing/" + imageName);

		if(shuffle)
		{
			//random
			shuffleArray(shufflePlaylist);
			currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id)
		}
		else
		{
			currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id)
		}
	}

	function shuffleArray(a)
	{
    		var j, x, i;
    		for (i = a.length - 1; i > 0; i--) {
        		j = Math.floor(Math.random() * (i + 1));
        		x = a[i];
				a[i] = a[j];
				a[j] = x;
			}
			return a;
	}

	function setTrack(trackId, newPlaylist, play)
	{
		if(newPlaylist != currentPlaylist)
		{
			currentPlaylist = newPlaylist;
			shufflePlaylist = currentPlaylist.slice();
			shuffleArray(shufflePlaylist);
		}

		if(shuffle)
		{
			currentIndex = shufflePlaylist.indexOf(trackId);
		}
		else
		{
			currentIndex = currentPlaylist.indexOf(trackId);
		}
		pauseSong();
		$.post("includes/handler/ajax/getSongJson.php",{songId:trackId}, function(data){
			var track = JSON.parse(data);
			$.post("includes/handler/ajax/getArtistJson.php",{artistId:track.artist}, function(data){
				var artist = JSON.parse(data);
				$(".trackInfo .artistName span").text(artist.name);
				$(".trackInfo .artistName span").attr("onclick", "openPage('artist.php?id=" + artist.id + "')");
			});

			$.post("includes/handler/ajax/getAlbumJson.php",{albumId:track.album}, function(data){
				var album = JSON.parse(data);
				$(".content .albumLink img").attr("src",album.artworkPath);
				$(".content .albumLink img").attr("onclick", "openPage('album.php?id=" + album.id + "')");
				$(".trackInfo .trackName span").attr("onclick", "openPage('album.php?id=" + album.id + "')");
			});
			$(".trackName span").text(track.title);
			$(".artistName span").text(track.artist);

			audioElement.setTrack(track);
			if(play)
			{
				playSong();
			}
		}); //ajax code
		
		
	}

	function playSong()
	{
		if(audioElement.audio.currentTime == 0)
		{
			$.post("includes/handler/ajax/updatePlayCount.php",{songId:audioElement.currentlyPlaying.id});
		}
		else
		{
		}
		$(".controlButtons.play").hide();
		$(".controlButtons.pause").show();
		audioElement.play();
	}
	function pauseSong()
	{
		$(".controlButtons.pause").hide();
		$(".controlButtons.play").show();
		audioElement.pause();
	}
</script>

<div id="nowPlayingBarContainer">	
	<div id="nowPlayingBar">
		<div id="nowPlayingLeft">
			<div class="content">
				<span class="albumLink">
					<img role=link tabindex="0" src="" class="albumArtwork">
				</span>

				<div class="trackInfo">
					<span class="trackName">
						<span role=link tabindex="0"></span>
					</span>
					<span class="artistName">
						<span role=link tabindex="0"></span>				
					</span>
				</div>
			</div>
		</div>
		<div id="nowPlayingCenter">
			<div class="content playerControls">
				<div class="buttons">
					<button class="controlButtons shuffle" title="Shuffle" onclick="setShuffle()">
						<img src="assets/images/icons/now playing/shuffle.png" alt="Shuffle">
					</button>
					<button class="controlButtons previous" title="Previous" onclick="prevSong()">
						<img src="assets/images/icons/now playing/prev.png" alt="Previous">
					</button>
					<button class="controlButtons play" title="Play" onclick="playSong()">
						<img src="assets/images/icons/now playing/play.png" alt="Play">
					</button>
					<button class="controlButtons pause" title="Pause" style="display:none;" onclick="pauseSong()">
						<img src="assets/images/icons/now playing/pause.png" alt="Pause">
					</button>
					<button class="controlButtons next" title="Next" onclick="nextSong()">
						<img src="assets/images/icons/now playing/next.png" alt="Next">
					</button>
					<button class="controlButtons repeat" title="Repeat" onclick="setRepeat()">
						<img src="assets/images/icons/now playing/repeat-one-off.png" alt="Repeat">
					</button>
				</div>
				
				<div class="playbackBar">
						<span class="progressTime current"></span>

					 	<div class="progressBar">
							<div class="progressBarBg">
								<div class="progress"> </div>
							</div>
						</div>

						<span class="progressTime remaining"></span>
				</div>
			</div>
		</div>
		<div id="nowPlayingRight">
			<div class="volumeBar">
				<button class="controlButtons volume" title="Volume" onclick="setVolume()">
					<img src="assets/images/icons/now playing/volume.png" alt="Volume">
				</button>
				<div class="progressBar">
					<div class="progressBarBg">
						<div class="progress"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>