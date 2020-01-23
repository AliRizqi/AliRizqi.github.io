<?php
    include("includes/config/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Constants.php");

    $account = new Account($conn);

    include("includes/handler/register-handler.php");
    include("includes/handler/login-handler.php");

    function getInputValue($string)
    {
        if(isset($_POST[$string]))
        {
            echo $_POST[$string];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BeatHub</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
    <?php
        if(isset($_POST['register']))
        {
            echo '<script>
            $(document).ready(function()
            {
                $("#loginForm").hide();
                $("#registerForm").show();
            });
            </script>';
        }
        else
        {
            echo '<script>
            $(document).ready(function()
            {
                $("#loginForm").show();
                $("#registerForm").hide();
            });
            </script>';
        }
    ?>
    
    <div id="background">

        <div id=loginContainer>

            <div id="inputContainer">
                <form id="loginForm" action="register.php" method="POST">
                    <h2>Welcome to BeatHub!</h2> <br>
                    <h3>Login to your account</h3>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed);?>
                        <input type="text" name="loginUsername" id="loginUsername" placeholder="Username" required>
                    </p>
                    <p>
                        <input type="password" name="loginPassword" id="loginPassword" placeholder="Password" required>
                    </p>
                    <p>
                        <button type="submit" name="login">Log In</button>
                    </p>
                    <div class="haveAccount">
                        <span id='hideLogin'>Don't have an account yet? Register here.</span>
                    </div>
                </form>

                <form id="registerForm" action="register.php" method="POST">
                    <h3>Don't have an account yet? Let's make a free one!</h3>
                    <p>
                        <?php echo $account->getError(Constants::$usernameLength);?>
                        <?php echo $account->getError(Constants::$usernameStatus);?>
                        <input type="text" name="username" id="username" placeholder="Username" value="<?php getInputValue('username');?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstNameLength);?>
                        <input type="text" name="firstName" id="firstName" placeholder="First Name" value="<?php getInputValue('firstName');?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$lastNameLength);?>
                        <input type="text" name="lastName" id="lastName" placeholder="Last Name" value="<?php getInputValue('lastName');?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailInvalid);?>
                        <?php echo $account->getError(Constants::$emailStatus);?>
                        <input type="email" name="email" id="email" placeholder="Email Address" value="<?php getInputValue('email');?>" required>
                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordDoNotMatch);?>
                        <?php echo $account->getError(Constants::$passwordDoNotAlphanumeric);?>
                        <?php echo $account->getError(Constants::$passwordLength);?>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </p>
                    <p>
                        <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password" required>
                    </p>
                    <p>
                        <input type="radio" name="role" value="artist" required>Artist
                        <input type="radio" name="role" value="user" required>User
                    </p>
                    <p>
                        <button type="submit" name="register">Register</button>
                    </p>
                    <div class="haveAccount">
                        <span id='hideRegister'>Already have an account? Log in here.</span>
                    </div>
                </form>
            </div>

            <div id="info">
                <h1>Let's hear some beat.</h1>
                <ul>
                    <li>Discover beautiful voices from around the world.</li>
                    <li>Help musicians and orphanages.</li>
                    <li>Give likes to support your favourites cover.</li>
                </ul>
            </div>

        </div>
    </div>
</body>
</html>