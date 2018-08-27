$(document).ready(function(){
  //root
  $(document).on('click', '#submit_comment', function(e) {
    e.preventDefault();
    var comment_text = $('#comment_text').val();
    var comment_author = $('#comment_author').val();
    var parent = $('#parent').val();
    var url = $('#comment_form').attr('action');
		// Stop executing if not value is entered
		if (comment_text === "" || comment_author ==="" ) return;
		$.ajax({
			url: url,
			type: "POST",
			data: {
				comment : comment_text,
        comment_author : comment_author,
        parent : parent,
        
			},
			success: function(data){
        var response = JSON.parse(data);
				if (response.comment_id === 0) {
					alert('There was an error adding comment. Please try again');
				} else {
          $('#comment_author').val('');
          $('#comment_text').val('');
          if ( $( '#posts-list0' ).length ) {
            $('#posts-list0').append(addRootComment(response));
          } else {
            $('#comments_header').after(addChildComment(response));
          }
				}
			}
		});
  });
  // Children
  $(document).on('click', '#submit_comment_ch', function(e) {
    e.preventDefault();
    var comment_id = $(this).val();
    var comment_text = $('#comment_text'+comment_id).val();
    var comment_author = $('#comment_author'+comment_id).val();
    var parent = $('#parent'+comment_id).val();
    var url = $('#comment_form'+comment_id).attr('action');
		// Stop executing if not value is entered
		if (comment_text === "" || comment_author ==="" ) return;
		$.ajax({
			url: url,
			type: "POST",
			data: {
				comment : comment_text,
        comment_author : comment_author,
        parent : parent 
			},
			success: function(data){
        
        var response = JSON.parse(data);
				if (response.comment_id === 0) {
					alert('There was an error adding comment. Please try again');
				} else {
          
          $('#comment_author'+response.parent).val('');
          $('#comment_text'+response.parent).val('');
          if ( $( '#posts-list'+response.parent ).length ) {
            $('#posts-list'+response.parent).append(addRootComment(response)); 
          } else {
            $('#comment_li'+response.parent).after(addChildComment(response));
          }
          
        }
			}
		});
	});  
});

function addChildComment(response){
  var outHtml=`<ol id="posts-list`+response.parent+`" class="hfeed"><li id="comment_li`+response.comment_id+`">`+commentTemplate(response)+`</li></ol>`;
  return outHtml;
}
function addRootComment(response){
  return `<li id="comment_li`+response.comment_id+`">`+commentTemplate(response)+`</li>`;
}
function commentTemplate(response){
  //return comment template
  return `
  <article id="art`+response.comment_id+`" class="hentry">
    <footer class="post-info">
        <abbr>`+
            response.date_created
        +`</abbr>
        <address>
            By <a class="url fn" href="#">`+response.comment_author+`</a>
        </address>
    </footer>
    <div>
        <p>`+response.comment+`</p>
        <div  class="form-row mx-sm-1" style="display: block">
            <form action="post_comment.php" method="post" class="form-inline" id="comment_form`+response.comment_id+`">
                <div class="form-line mx-sm-1 " >
                    <input type="text" class="form-control bform-control-sm col-md-3" name="comment_author" id="comment_author`+response.comment_id+`" placeholder="name" value="" required="required">
                    <input type="text" class="form-control bform-control-sm col-md-9 " name="comment" id="comment_text`+response.comment_id+`" placeholder="comment" required="required"></textarea>
                    <input type="hidden" name="parent" value="`+response.comment_id+`" id="parent`+response.comment_id+`"/>
                    <button type="submit" class="btn btn-primary mbtn-sm" name="submit_comment" id="submit_comment_ch" value="`+response.comment_id+`">reply</button>
                </div>               
            </form>					
        </div>
    </div>
</article>
  `;
}