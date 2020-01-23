<?php

function processInputUsername($input)
{
    $input = strip_tags($input);
    $input = str_replace(" ","",$input);
    return $input;
}

function processInputName($input)
{
    $input = strip_tags($input);
    $input = str_replace(" ","",$input);
    $input = ucfirst(strtolower($input));
    return $input;
}

function processInputPassword($input)
{
    $input = strip_tags($input);
    return $input;
}

if(isset($_POST['register']))
{
    $username = processInputUsername($_POST['username']);
    $firstName = processInputName($_POST['firstName']);
    $lastName = processInputName($_POST['lastName']);
    $email = processInputUsername($_POST['email']);
    $password = processInputPassword($_POST['password']);
    $password2 = processInputPassword($_POST['passwordConfirm']);
    $role = $_POST['role'];

    $username = mysqli_real_escape_string($conn, $username);
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $password2 = mysqli_real_escape_string($conn, $password2);

    $status = $account->register($username,$firstName,$lastName,$email,$password,$password2, $role);
    if($role=="artist")
    {
        $artist = new Artist($conn, $username);
        $name = $firstName ." " . $lastName;
        $setArtist = $artist->setArtist($name, $username);
    }
    
    if($status == true)
    {
        $_SESSION['userLoggedIn'] = $username;
        $_SESSION['role'] = $role;
        header("Location:index.php");
    }
}
    
   
?>