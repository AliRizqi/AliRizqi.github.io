<div id="navBarcontainer">
	<nav class="navBar">

		<span role=link tabindex="0" onclick="openPage('userDetails.php')" class="profilepic">
			<img src="<?php echo $userLoggedIn->getProfilePicture();?>" alt="profpic">
		</span>
		<span role=link tabindex="0" onclick="openPage('userDetails.php')" class="profile">Hi, <?php echo $userLoggedIn->getFirstName();?></span>
		<div class="group">
			<div class="navItem">
				<span role=link tabindex="0" onclick="openPage('search.php')" class="navItemLink">Search
					<img src="assets/images/icons/search.png" class="icon" alt="Search">
				</span>
			</div>
		</div>
		<div class="group">
			<div class="navItem">
				<span role=link tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Browse</span>
			</div>
			<div class="navItem">
				<span role=link tabindex="0" onclick="openPage('yourMusic.php')" class="navItemLink">Your Music</span>
			</div>
			<div class="navItem">
				<span role=link tabindex="0" onclick="openPage('statistic.php')" class="navItemLink">Statistic</span>
			</div>
			<?php
				if($_SESSION['role'] == "artist")
				{
			?>
				<div class="navItem">
					<span role=link tabindex="0" onclick="openPage('artistMode.php')" class="navItemLink">Artist Mode</span>
				</div>
			<?php
				}
			?>
			<div class="navItem">
				<span role=link class="navItemLink" tabindex="0" onclick="logout()">Log Out</span>
			</div>
		</div>

	</nav>
</div>