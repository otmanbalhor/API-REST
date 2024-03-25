<?php

class Post
{

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

    public function read()
    {

        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';

        $stmt = $this->db->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function read_single()
    {

        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row["title"];
        $this->body = $row["body"];
        $this->author = $row["author"];
    }

    public function create()
    {

        $query = 'INSERT INTO ' . $this->table . ' SET title = :title,body = :body,author = :author,created_at = :created_at,update_at = :update_at ';

        $stmt = $this->db->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->created_at = date('Y-m-d H:i:s');
        $this->update_at = date('Y-m-d H:i:s');

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':update_at', $this->update_at);

        if ($stmt->execute()) {

            return true;
        }

        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    public function update()
    {

        $query = 'UPDATE ' . $this->table . ' SET title = :title,body = :body,author = :author,created_at = :created_at,update_at = :update_at WHERE id = :id ';

        $stmt = $this->db->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->created_at = date('Y-m-d H:i:s');
        $this->update_at = date('Y-m-d H:i:s');

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':update_at', $this->update_at);

        if ($stmt->execute()) {

            return true;
        }

        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    //DELETE POST

    public function delete()
    {

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->db->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {

            return true;
        }

        printf("Error: %s. \n", $stmt->error);

        return false;
    }

}
