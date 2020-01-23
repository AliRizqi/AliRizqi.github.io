<?php
    class User
    {
        private $conn;
        private $username;

        public function __construct($conn, $username)
        {
            $this->conn = $conn;
            $this->username = $username;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getFirstName()
        {
            $query = mysqli_query($this->conn, "SELECT first_name FROM users WHERE username='$this->username'");
            $row = mysqli_fetch_array($query);
            return $row['first_name'];
        }

        public function getEmail()
        {
            $query = mysqli_query($this->conn, "SELECT email FROM users WHERE username='$this->username'");
            $row = mysqli_fetch_array($query);
            return $row['email'];
        }

        public function getName()
        {
            $query = mysqli_query($this->conn, "SELECT concat(first_name, ' ', last_name) as name FROM users WHERE username='$this->username'");
            $row = mysqli_fetch_array($query);
            return $row['name'];
        }

        public function getPlayCount()
        {
            $query = mysqli_query($this->conn, "SELECT playCount FROM users WHERE username='$this->username'");
            $row = mysqli_fetch_array($query);
            return $row['playCount'];
        }

        public function like($songId)
        {
            $query = mysqli_query($this->conn, "INSERT INTO likes VALUES ('', '$songId', '$this->username')");
        }

        public function checkLike($songId)
        {
            $query = mysqli_query($this->conn, "SELECT * from likes WHERE songId='$songId' AND username='$this->username'");
            $num = mysqli_num_rows($query);
            return $num;
        }

        public function dislike($songId)
        {
            $query = mysqli_query($this->conn, "INSERT INTO dislikes VALUES ('', '$songId', '$this->username')");
        }

        public function checkDislike($songId)
        {
            $query = mysqli_query($this->conn, "SELECT * from dislikes WHERE songId='$songId' AND username='$this->username'");
            $num = mysqli_num_rows($query);
            return $num;
        }

        public function removeLike($songId)
        {
            $query = mysqli_query($this->conn, "DELETE FROM likes WHERE songId='$songId' AND username='$this->username'");
        }

        public function removeDislike($songId)
        {
            $query = mysqli_query($this->conn, "DELETE FROM dislikes WHERE songId='$songId' AND username='$this->username'");
        }

        public function getProfilePicture()
        {
            $query = mysqli_query($this->conn, "SELECT profile_pic FROM users WHERE username='$this->username'");
            $row = mysqli_fetch_array($query);
            return $row['profile_pic'];
        }

        public function changeProfilePicture($path)
        {
            $query = mysqli_query($this->conn, "UPDATE users SET profile_pic = '$path' WHERE username='$this->username'");
        }

        public function getArtistId()
        {
            $query = mysqli_query($this->conn, "SELECT a.id FROM users u JOIN artist a ON u.username = a.username WHERE a.username = '$this->username'");
            if($query)
            {
                $row = mysqli_fetch_array($query);
                return $row['id'];
            }
        }
    }
?>