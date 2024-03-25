<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

include_once '../../Config/database.php';
include_once '../../Models/Post.php';


$database = new database();
$db = $database->connect();

$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$post->read_single();

$post_arr = array(
    'id'=>$post->id,
    'title'=>$post->title,
    'body'=>$post->body,
    'author'=>$post->author,
    'created_at'=>$post->created_at,
    'update_at'=>$post->update_at,
);

print_r(json_encode($post_arr));

