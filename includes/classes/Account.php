<?php
    class Account
    {
        private $conn;
        private $errorArray;

        public function __construct($conn)
        {
            $this->conn = $conn;
            $this->errorArray = array();
        }

        public function login($uname, $pwd)
        {
            $pwd = md5($pwd);
            $login = mysqli_query($this->conn, "SELECT * FROM users WHERE username='$uname' AND password='$pwd'");
            if(mysqli_num_rows($login) == 1)
            {
                $row = mysqli_fetch_array($login);
                $role = $row['role'];
                return $role;
            }
            else
            {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }
        public function register($uname,$fName,$lName,$em,$pw,$pw2, $role)
        {
            $this->validateUsername($uname);
            $this->validateFirstName($fName);
            $this->validateLastName($lName);
            $this->validateEmail($em);
            $this->validatePassword($pw,$pw2);

            if(empty($this->errorArray))
            {
                //Insert into database
                return $this->inputUserData($uname, $fName, $lName, $em, $pw, $role);
            }
            else
            {
                return false;
            }
        }

        public function getError($error)
        {
            if(!in_array($error, $this->errorArray))
            {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function inputUserData($uname, $fName, $lName, $em, $pw, $role)
        {
            $encryptedPwd = md5($pw);
            $profilePic = "assets/images/profile-pictures/pp1.png";
            $date = date("Y-m-d H:i:s");

            $result = mysqli_query($this->conn, "INSERT INTO users VALUES ('','$uname','$fName','$lName','$em','$encryptedPwd','$date', '$profilePic', 0, '$role')");

            return $result;
        }
        private function validateUsername($uname)
        {
            if(strlen($uname)<5 || strlen($uname)>25)
            {
                array_push($this->errorArray, Constants::$usernameLength);
                return;
            }
            
            $checkUsername = mysqli_query($this->conn, "SELECT username FROM users WHERE username='$uname'");
            if(mysqli_num_rows($checkUsername) != 0)
            {
                array_push($this->errorArray, Constants::$usernameStatus);
                return;
            }
        }

        private function validateFirstName($fName)
        {
            if(strlen($fName)<5 || strlen($fName)>25)
            {
                array_push($this->errorArray, Constants::$firstNameLength);
                return;
            }
        }

        private function validateLastName($lName)
        {
            if(strlen($lName)<5 || strlen($lName)>25)
            {
                array_push($this->errorArray, Constants::$lastNameLength);
                return;
            }
        }

        private function validateEmail($em)
        {
            if(!filter_var($em, FILTER_VALIDATE_EMAIL))
            {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }
            
            $checkEmail = mysqli_query($this->conn,"SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkEmail) != 0)
            {
                array_push($this->errorArray, Constants::$emailStatus);
                return;
            }
            
        }

        private function validatePassword($pw, $pw2)
        {
            if($pw != $pw2)
            {
                array_push($this->errorArray, Constants::$passwordDoNotMatch);
                return;
            }
            if(preg_match('/[^A-Za-z0-9]/',$pw))
            {
                array_push($this->errorArray, Constants::$paswordDoNotAlphanumeric);
                return;
            }
            if(strlen($pw)<8 || strlen($pw)>30)
            {
                array_push($this->errorArray, Constants::$passwordLength);
                return;
            }
        }
    }
?>