<?php
    include("../../classes/User.php");
    include("../../config/config.php");

    if(isset($_FILES['profilePicture']) && isset($_POST['username']))
    {
        $image = $_FILES['profilePicture'];
        $username = $_POST['username'];

        $imageName = $image['name'];
        // $imageSize = $image['size'];        
        $imageType = $image['type'];
        $path = $image['tmp_name'];

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
        if(!file_exists("../../../assets/images/profile-pictures/$username"))
        {
            mkdir("../../../assets/images/profile-pictures/$username",777);
        }
        $uploadPath = "../../../assets/images/profile-pictures/$username/$imageName";

        if(count($error)>1)
        {
            var_dump($error);
        }
        else
        {
            if(move_uploaded_file($path,$uploadPath))
            {
                $uploadPath = "assets/images/profile-pictures/$username/$imageName";
                $userLoggedIn = new User($conn, $username);
                $userLoggedIn->changeProfilePicture($uploadPath);
                header("Location: ../../../userDetails.php");
            }
            else{
                echo "Failed";
            }
        }

    }
?>