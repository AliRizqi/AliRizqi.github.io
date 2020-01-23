var currentPlaylist = new Array();
var shufflePlaylist = new Array();
var tempPlaylist = new Array();
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;
var timer;

$(document).click(function(click){
    var target = $(click.target);
    if(!target.hasClass("item") && !target.hasClass("optionButton"))
    {
        hideOptionMenu();
    }
});

$(window).scroll(function(){
    hideOptionMenu();
});

$(document).on("change", "select.playlist", function(){
    var select = $(this); //$(this) mengacu kepada select.playlist, disimpan ke var supaya bisa dipanggil di bawah
    var playlistId = select.val();
    var songId = select.prev(".songId").val();

    $.post("includes/handler/ajax/addToPlaylist.php", {playlistId:playlistId, songId:songId}).done(function(error){
        if(error!="")
        {
            alert(error);
            return;
        }
        hideOptionMenu();
        select.val("");
    });
});

function openPage(url)
{

    if(timer != null)
    {
        clearTimeout(timer);
    }

    if(url.indexOf("?") == -1)
    {
        url += "?";
    }
    var encodeUrl = encodeURI(url+ "&userLoggedIn=" + userLoggedIn);
    $("#mainContent").load(encodeUrl);
    $("body").scrollTop(0);
    history.pushState(null,null,url);
}

function removeFromPlaylist(button, playlistId)
{
    var songId = $(button).prevAll(".songId").val();
    $.post("includes/handler/ajax/removeFromPlaylist.php", {playlistId:playlistId, songId:songId}).done(function(error){
        if(error!="")
            {
                alert(error);
                return;
            }
        openPage("playlist.php?id="+playlistId);
    });
}

function createPlaylist(username)
{
    var playlistName = prompt("Your playlist's name: ");

    if(playlistName != null)
    {
        $.post("includes/handler/ajax/createPlaylist.php", {name:playlistName, username: userLoggedIn}).done(function(error){
            if(error!="")
            {
                alert(error);
                return;
            }
            openPage("yourMusic.php");
        });
    }
}

function deletePlaylist(playlistId)
{
    var prompt = confirm("Are you sure to delete this playlist?");
    if(prompt)
    {
        $.post("includes/handler/ajax/deletePlaylist.php", {playlistId:playlistId}).done(function(error){
            if(error!="")
            {
                alert(error);
                return;
            }
            openPage("yourMusic.php");
        });
    }
}

function hideOptionMenu()
{
    var menu = $(".optionsMenu");
    if(menu.css("display") != "none")
    {
        menu.css("display", "none");
    }
}

function showOptionsMenu(button)
{
    var songId = $(button).prevAll(".songId").val();
    var menu = $(".optionsMenu");
    var menuWidth = menu.width();
    menu.find(".songId").val(songId);

    var scrollTop = $(window).scrollTop();
    var elementOffSet = $(button).offset().top;

    var top = elementOffSet - scrollTop;
    var left = $(button).position().left;

    menu.css({"top":top+"px", "left":left-menuWidth+"px", "display":"inline"});
}

function like(songId)
{
    $.post("includes/handler/ajax/addLikes.php", {songId:songId, username:userLoggedIn}).done(function(response){
        if(response!="")
            alert(response);
    });
}

function dislike(songId)
{
    $.post("includes/handler/ajax/addDislikes.php", {songId:songId, username:userLoggedIn}).done(function(response){
        if(response!="")
            alert(response);
    });
}

function formatTime(seconds)
{
    var time = Math.round(seconds);
    var minutes = Math.floor(time/60);
    var seconds = time - minutes * 60;

    var extraZero = '';
    if(seconds < 10)
    {
        extraZero = '0';
    }
    return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio)
{
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

    var progress = audio.currentTime / audio.duration * 100;
    $(".playbackBar .progress").css("width",progress+"%");
}

function updateVolumeProgressBar(audio)
{
    var volume = audio.volume * 100;
    $(".volumeBar .progress").css("width",volume+"%");
}

function playFirstSong()
{
    setTrack(tempPlaylist[0], tempPlaylist, true);
}

function updateEmail(emailClass)
{
    var emailValue = $("." + emailClass).val();

    $.post("includes/handler/ajax/updateEmail.php", {email:emailValue, username:userLoggedIn}).done(function(response){
        $("." + emailClass).nextAll(".message").text(response);
    });
}

function updatePassword(oldPass, newPass, conPass)
{
    var oldPassValue = $("." + oldPass).val();
    var newPassValue = $("." + newPass).val();
    var conPassValue = $("." + conPass).val();

    $.post("includes/handler/ajax/updatePassword.php", {oldPass:oldPassValue, newPass:newPassValue, conPass: conPassValue, username:userLoggedIn}).done(function(response){
        $("." + conPass).nextAll(".message").text(response);
    });
}

function logout()
{
    $.post("includes/handler/ajax/logout.php", function(){
        location.reload();
    });
}

function requestMonetization(passwordClass)
{
    var password = $("." + passwordClass).val();
    $.post("includes/handler/ajax/requestMonetization.php", {username:userLoggedIn, password:password}).done(function(response){
        $("." + passwordClass).nextAll(".message").text(response);
    });
}

function Audio()
{
    this.currentlyPlaying;
    this.audio = document.createElement('audio');

    this.audio.addEventListener("ended", function(){
        nextSong();
    });

    this.audio.addEventListener("canplay", function(){
        //this adalah object yang memanggil event
        $(".progressTime.remaining").text(formatTime(this.duration));
        updateVolumeProgressBar(this);
    });

    this.audio.addEventListener("timeupdate", function(){
        if(this.duration)
        {
            updateTimeProgressBar(this);
        }
    });

    this.audio.addEventListener("volumechange", function(){
        updateVolumeProgressBar(this);
    });

    this.setTrack = function(track)
    {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    }

    this.play = function()
    {
        this.audio.play();
    }

    this.pause = function()
    {
        this.audio.pause();
    }

    this.setTime = function(seconds)
    {
        this.audio.currentTime = seconds;
    }

}