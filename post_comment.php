<?php
//var_dump($_POST);
define('PROJPATH',__DIR__);
include(PROJPATH.'/config.php');
include(PROJPATH.'/models/Comments.php');
include(PROJPATH.'/controllers/functions_controllers.php');
$name=$_POST['comment_author'];
$comment=$_POST['comment'];
$parent=$_POST['parent'];
if($id=addComment($db_conn,$parent,$name,$comment)){
    $row=getCommentsById($db_conn,$id);
    $data = array(
        'comment_id' => $id,
        'comment_author' => $row['name'],
        'comment' => $row['comment'],
        'parent' => $parent,
        'date_created' => $row['created'],
        'err' => NULL
    );
} else {
    $data = array(
        'comment_id' => 0,
        'comment_author' => NULL,
        'comment' => NULL,
        'parent' => 0,
        'date_created' => NULL,
        'err' => 'Unable to post comment!'
    );

} 
echo json_encode($data);
