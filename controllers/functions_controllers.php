<?php
// Functions and Controllers
function displayComments($db_conn,$parent=0){
    // Displaying Root Comments
    $rows=getComments($db_conn,$parent);
    if(!$rows) {
        // skip hatch for recursive function
        return;
    }
    echo '<ol id="posts-list'.$parent.'" class="hfeed">';
    foreach($rows as $row) {
        echo '<li id="comment_li'.$row['id'].'">';
        include(PROJPATH.'/templates/comment.template.php');
        echo '</li>';
        // Display Chilren recursively
        displayComments($db_conn,$row['id']);
    } 
    echo '</ol>';

}

// $url should be an absolute url
function redirect($url){
    if (headers_sent()){
      die('<script type="text/javascript">window.location=\''.$url.'\';</script‌​>');
    }else{
      header('Location: ' . $url);
      die();
    }    
}