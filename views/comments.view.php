<?php

?>
<section id="comments" class="body">
	  
    <header id='comments_header'>
        <h2>Comments</h2>
    </header>

    <?php displayComments($db_conn);?>    

    <div class="form-group mr-2">
        <h3>Leave a Comment</h3>
        <!-- Form below actually calls Ajax on submit and action will be read and used inside Ajax as URL
             actually the submit would be prevented  
             Please see js/proj.js for the details.
        -->
        <form action="post_comment.php" method="post" id="comment_form">
            <div class="form-group">
                <label for="comment_author" class="required">Your name</label>
                <input type="text" class="form-control form-control-sm col-6" id="comment_author" name="comment_author" value="" required="required">
            </div>
            <div class="form-group">
                <label for="comment" class="required">Your message</label>
                <textarea class="form-control form-control-sm" name="comment" rows="3" id='comment_text' required="required"></textarea>
            </div>
            <input type="hidden" id="parent" name="parent" value="0" />
            <input class="btn btn-primary" id="submit_comment" name="submit_comment" type="submit" value="Submit comment" />        
        </form>					
	</div>
			
</section>