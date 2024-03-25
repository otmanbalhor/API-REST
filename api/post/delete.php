<?php

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-with");


include_once '../../Config/database.php';
include_once '../../Models/Post.php';


$database = new database();
$db = $database->connect();

$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

if($post->delete()){

    echo json_encode(

        array('message'=> 'Post Deleted')
    );
}else{

    echo json_encode(
        array('message'=> 'Post Not Deleted')
    );
}
