<?php
    class Album
    {
        private $conn;
        private $id;
        private $title;
        private $artistId;
        private $genre;
        private $artworkPath;

        public function __construct($conn, $id)
        {
            $this->conn = $conn;
            $this->id = $id;

            $albumQuery = mysqli_query($this->conn, "SELECT * from albums WHERE id = '$this->id'");
            $album = mysqli_fetch_array($albumQuery);
            $this->title = $album['title'];
            $this->genre = $album['genre'];
            $this->artistId = $album['artist'];
            $this->artworkPath = $album['artworkPath'];

        }

        public function getTitle()
        {
            return $this->title;
        }

        public function getArtist()
        {
            $artist = new Artist($this->conn, $this->artistId);
            return $artist;
        }

        public function getArtworkPath()
        {
            return $this->artworkPath;
        }

        public function getGenre()
        {
            return $this->genre;
        }

        public function getNumberOfSongs()
        {
            $query = mysqli_query($this->conn, "SELECT * FROM songs WHERE album = '$this->id'");
            return mysqli_num_rows($query);
        }

        public function getSongIds()
        {
            $query = mysqli_query($this->conn, "SELECT id from songs WHERE album = '$this->id' ORDER BY albumOrder ASC");
            $array = array();

            while($row = mysqli_fetch_array($query))
            {
                array_push($array,$row['id']);
            }
            return $array;
        }

        public function addSong($title, $duration, $artistId, $path)
        {
            $getOrderNum = mysqli_query($this->conn, "SELECT MAX(albumOrder) as albumOrder FROM songs WHERE album = '$this->id'");
            $row = mysqli_fetch_array($getOrderNum);
            $orderNum = $row['albumOrder'] + 1;
            $query = mysqli_query($this->conn, "INSERT INTO songs VALUES('', '$title', '$artistId', '$this->id', '$this->genre', '$duration', '$path', '$orderNum', 0)");
        }

    }
?>