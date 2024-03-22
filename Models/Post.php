<?php

class Post{

    private $db;
    private $table = 'posts';

    public $id;
    public $title;
    public $body;
    public $author;
    public $created_at;
    public $update_at;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function read(){

        $query = 'SELECT * FROM '.$this->table.' ORDER BY created_at DESC';

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        return $stmt;
    }

}