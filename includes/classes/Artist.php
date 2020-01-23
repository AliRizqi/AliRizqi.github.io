<?php
    class Artist
    {
        private $conn;
        private $id;

        public function __construct($conn, $id)
        {
            $this->conn = $conn;
            $this->id = $id;
        }

        public function getName()
        {
            $artistQuery = mysqli_query($this->conn, "SELECT name FROM artist WHERE id = '$this->id'");
            $artist = mysqli_fetch_array($artistQuery);
            return $artist['name'];
        }

        public function getSongIds()
        {
            $query = mysqli_query($this->conn, "SELECT id FROM songs WHERE artist = '$this->id' ORDER BY playCount DESC");
            $array = array();

            while($row = mysqli_fetch_array($query))
            {
                array_push($array,$row['id']);
            }
            return $array;
        }

        public function getAlbumId()
        {
            $query = mysqli_query($this->conn, "SELECT id FROM albums WHERE artist='$this->id'");
            $array = array();
            while($row = mysqli_fetch_array($query))
            {
                array_push($array,$row['id']);
            }
            return $array;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setArtist($name, $username)
        {
            $query = mysqli_query($this->conn, "INSERT INTO artist VALUES ('','$name', '$username')");
            return $query;
        }

        public function addAlbum($title, $genre, $artworkPath)
        {
            $query = mysqli_query($this->conn, "INSERT INTO albums VALUES('', '$title', '$this->id', '$genre', '$artworkPath')");
            return $query;
        }

        public function verify($pass, $uname)
        {
            $query = mysqli_query($this->conn, "SELECT * FROM users WHERE username='$uname' AND password='$pass'");
            $row = mysqli_num_rows($query);
            return $row;
        }
    }
?>