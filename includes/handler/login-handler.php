<?php
    if(isset($_POST['login']))
    {
        $username = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $role = $account->login($username, $password);

        if($role == "user" || $role == "artist")
        {
            $_SESSION['userLoggedIn'] = $username;
            $_SESSION['role'] = $role;
            header("Location:index.php");
            exit;
        }
    }
?>