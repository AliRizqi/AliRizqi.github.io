<?php
    include("includes/includedFiles.php");
    include("includes/handler/checkArtist.php");

    if(isset($_POST['username']))
    {
        $albumTitle = $_POST['albumTitle'];
        $albumArtWork = $_FILES['albumArtWork'];
        $albumGenre = $_POST['albumGenre'];
        $username = $_POST['username'];
        echo $username;

        $imageName = $albumArtWork['name'];
        // $imageSize = $image['size'];        
        $imageType = $albumArtWork['type'];
        $path = $albumArtWork['tmp_name'];

        $allowedType = ['image/jpg','image/png','image/jpeg'];

        $error[]="";
        // if($imageSize > 100000)
        // {
        //     $error[]="File must not exceed 100KB.";
        // }
        if(!in_array($imageType,$allowedType))
        {
            $error[]="File type is not supported";
        }
        if(!file_exists("assets/images/album/$username"))
        {
            mkdir("assets/images/album/$username",777);
        }
        $uploadPath = "assets/images/album/$username/$imageName";

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
            $query = mysqli_query($conn, "SELECT id FROM artist WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            $id = $row['id'];

            $artist = new Artist($conn, $id);
            $result = $artist->addAlbum($albumTitle, $albumGenre, $uploadPath);

            if($result == true)
            {
                header("Location:addAlbum.php");
            }
        }
    }
    else
    {
        echo "No data";
    }
?>