<?php
    class Song
    {
        private $conn;
        private $id;
        private $result;
        private $title;
        private $artistId;
        private $albumId;
        private $genre;
        private $duration;
        private $path;

        public function __construct($conn, $id)
        {
            $this->conn = $conn;
            $this->id = $id;

            $query = mysqli_query($this->conn, "SELECT * FROM songs WHERE id='$this->id'");
            $this->result = mysqli_fetch_array($query);
            $this->title = $this->result['title'];
            $this->artistId = $this->result['artist'];
            $this->albumId = $this->result['album'];
            $this->genre = $this->result['genre'];
            $this->duration = $this->result['duration'];
            $this->path = $this->result['path'];
            $this->playCount = $this->result['playCount'];
        }

        public function getTitle()
        {
            return $this->title;
        }
        public function getId()
        {
            return $this->id;
        }
        public function getArtist()
        {
            return new Artist($this->conn, $this->artistId);
        }
        public function getAlbum()
        {
            return new Album($this->conn, $this->albumId);
        }
        public function getGenre()
        {
            return $this->genre;
        }
        public function getDuration()
        {
            return $this->duration;
        }
        public function getPath()
        {
            return $this->duration;
        }
        public function getResult()
        {
            return $this->result;
        }
        public function getPlayCount()
        {
            return $this->playCount;
        }

    }
?>