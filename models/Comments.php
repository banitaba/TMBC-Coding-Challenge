<?php

// Create connection
global $db_conn;
$db_conn = new mysqli($db_hostname, $db_username, $db_password,$db_name);

// Check connection
if ($db_conn->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
} 

//Geting the comments from database
function getComments($db_conn,$parent=0) {
    $sql = "SELECT * 
            FROM comments_table 
            WHERE parent='".$parent."'
            ORDER BY created ASC
            ";  

    if(!($result = $db_conn->query($sql))) {
        echo 'Error getting Comments from the database.<br/>';
        echo "Error: " . $sql . "<br>" . $db_conn->error;
        die();
    }
    if ($result->num_rows > 0) {
          $rows = $result->fetch_all(MYSQLI_ASSOC);
        } else {
          $rows = 0;  
    }
    return $rows;
}

//Geting the comments from database
function getCommentsById($db_conn,$id) {
    $sql = "SELECT * 
            FROM comments_table 
            WHERE id='".$id."'
            ";  

    if(!($result = $db_conn->query($sql))) {
        echo 'Error getting Comments from the database.<br/>';
        echo "Error: " . $sql . "<br>" . $db_conn->error;
        die();
    }
    if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
        } else {
          $row = FALSE;  
    }
    return $row;
}

function addComment($db_conn,$parent,$name,$comment){
    $name=htmlentities($name);
    $comment=htmlentities($comment);
    $sql = "INSERT INTO `comments_table` 
            (`parent`, `name`, `comment`, `created`) VALUES 
            ('".$parent."', '".$name."', '".$comment."', CURRENT_TIMESTAMP);";
    //echo $sql;
    if ($db_conn->query($sql) === TRUE) {
        return $db_conn->insert_id;
    } else {
        echo 'Error adding Comments to the database.<br/>';
        echo "Error: " . $sql . "</br>" . $db_conn->error;
        return FALSE;
    }

}