<?php

?>
<article id="<?php echo 'art'.$row['id']; ?>" class="hentry">
    <footer class="post-info">
        <abbr>
            <?php echo $row['created']; ?>
        </abbr>
        <address>
            By <a class="url fn" href="#"><?php echo $row['name']; ?></a>
        </address>
    </footer>
    <div>
        <p><?php echo $row['comment']; ?></p>
        <div  class="form-row mx-sm-1" style="display: block">
            <!-- Form below actually calls Ajax on submit and action will be read and used inside Ajax as URL
                 actually the submit would be prevented  
                 Please see proj.js for the details.
            -->
            <form action="post_comment.php" method="post" class="form-inline" id="comment_form<?php echo $row['id']; ?>">
                <div class="form-line mx-sm-1 " >
                    <input type="text" class="form-control bform-control-sm col-md-3" name="comment_author" id="comment_author<?php echo $row['id']; ?>" placeholder="name" value="" required="required">
                    <input type="text" class="form-control bform-control-sm col-md-9 " name="comment" id='comment_text<?php echo $row['id']; ?>' placeholder="comment" required="required"></textarea>
                    <input type="hidden" name="parent" value="<?php echo $row['id']; ?>" id="parent<?php echo $row['id']; ?>"/>
                    <button type="submit" class="btn btn-primary mbtn-sm" name="submit_comment" id="submit_comment_ch" value="<?php echo $row['id']; ?>">reply</button>
                </div>               
            </form>					
        </div>
    </div>
</article>
