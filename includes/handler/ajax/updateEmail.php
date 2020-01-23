<?php
    include("../../config/config.php");

    if(isset($_POST['username']) && isset($_POST['email']) && $_POST['email'] != "")
    {
        $email = $_POST['email'];
        $username = $_POST['username'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo "Email is invalid";
            exit();
        }

        $emailCheck = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if(mysqli_num_rows($emailCheck) != 0)
        {
            echo "Email is already used";
            exit();
        }

        $query = mysqli_query($conn, "UPDATE users SET email = '$email' WHERE username='$username'");
        echo "Your email is updated.";
    }
    else
    {
        echo "Could not set username or email";
    }
?>