<?php
define('PROJPATH',__DIR__);
include(PROJPATH.'/config.php');
include(PROJPATH.'/models/Comments.php');
include(PROJPATH.'/controllers/functions_controllers.php');
include(PROJPATH.'/templates/header.template.php');
include(PROJPATH.'/templates/topmenu.template.php');
include(PROJPATH.'/views/content.view.php');
include(PROJPATH.'/views/comments.view.php');
include(PROJPATH.'/templates/footer.template.php');
?>
	

	
