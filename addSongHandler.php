<?php
    include("includes/config/config.php");
    include("includes/classes/Album.php");

    if(isset($_POST['submit']))
    {
        $songTitle = $_POST['songTitle'];
        $songDuration = $_POST['songDuration'];
        $songTrack = $_FILES['songTrack'];
        $albumId = $_POST['songAlbum'];
        $username = $_POST['username'];

        $name = $songTrack['name'];
        $type = $songTrack['type'];
        $path = $songTrack['tmp_name'];

        $allowedType = ['audio/mpeg','audio/wav','audio/ogg'];

        $error[]="";
        // if($imageSize > 100000)
        // {
        //     $error[]="File must not exceed 100KB.";
        // }
        // if(!in_array($type,$allowedType))
        // {
        //     $error[]="File type is not supported";
        // }
        if(!is_dir("assets/music/$username/$albumId"))
        {
            mkdir("assets/music/$username/$albumId",777, true);
        }
        $uploadPath = "assets/music/$username/$albumId/$name";

        if(count($error)>1)
        {
            var_dump($error);
        }
        else
        {
            if(move_uploaded_file($path,$uploadPath))
            {
                $status = true;
            }
            else{
                echo "Failed";
            }
        }

        if($status == true)
        {
            $album = new Album($conn, $albumId);
            $genre = $album->getGenre();
            $query = mysqli_query($conn, "SELECT id FROM artist WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            $artistId = $row['id'];
            $album->addSong($songTitle, $songDuration, $artistId, $uploadPath);
            header("Location:album.php?id=$albumId");
        }
    }
?>