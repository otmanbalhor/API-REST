<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

include_once '../../Config/database.php';
include_once '../../Models/Post.php';


$database = new database();
$db = $database->connect();

$post = new Post($db);

$result = $post->read();

$num = $result->rowCount();

if($num>0){

$posts_arr = array();
$posts_arr['data'] = array();

while($row = $result->fetch(PDO::FETCH_ASSOC)){

    extract($row);

    $posts_item = array(

        'id'=> $id,
        'title'=>$title,
        'body'=>html_entity_decode($body),
        'author'=>$author,
        'created_at'=>$created_at,
        'update_at'=>$update_at
    );

    array_push($posts_arr['data'],$posts_item);
}

echo json_encode($posts_arr);

}else{

    echo json_encode(
        array('message' => 'No posts found')
    );
}