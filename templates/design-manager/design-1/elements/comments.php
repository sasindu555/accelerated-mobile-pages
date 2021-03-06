<?php
global $redux_builder_amp;
if (!comments_open() || $redux_builder_amp['ampforwp-disqus-comments-support']) {
  return;
}
?>
<div class="ampforwp-comment-wrapper">
<?php
	global $redux_builder_amp;
	// Gather comments for a specific page/post
	$postID = get_the_ID();
	$comments = get_comments(array(
			'post_id' => $postID,
			'status' => 'approve' //Change this to the type of comments to be displayed
	));
	if ( $comments ) { ?>
		<div class="amp-wp-content comments_list">
            <h3><?php global $redux_builder_amp; echo ampforwp_translation($redux_builder_amp['amp-translator-view-comments-text'] , 'View Comments' )?></h3>
            <ul>
					<?php
					// Display the list of comments
				function ampforwp_custom_translated_comment($comment, $args, $depth){
									$GLOBALS['comment'] = $comment;
									global $redux_builder_amp;
									?>
									<li id="li-comment-<?php comment_ID() ?>"
									<?php comment_class(); ?> >
										<article id="comment-<?php comment_ID(); ?>" class="comment-body">
											<footer class="comment-meta">
												<div class="comment-author vcard">
													 <?php
													 printf(__('<b class="fn">%s</b> <span class="says">'.ampforwp_translation($redux_builder_amp['amp-translator-says-text'],'says').':</span>'), get_comment_author_link()) ?>
												</div>
												<!-- .comment-author -->
												<div class="comment-metadata">
													<a href="<?php echo htmlspecialchars( trailingslashit( get_comment_link( $comment->comment_ID ) ) ) ?>">
														<?php printf( ampforwp_translation( ('%1$s '. ampforwp_translation($redux_builder_amp['amp-translator-at-text'],'at').' %2$s'), '%1$s at  %2$s') , get_comment_date(),  get_comment_time())?>
													</a>
													<?php edit_comment_link( ampforwp_translation( $redux_builder_amp['amp-translator-Edit-text'], 'Edit' ) ) ?>
												</div>
												<!-- .comment-metadata -->
											</footer>
												<!-- .comment-meta -->
											<div class="comment-content">
                        <p><?php
                          $comment_content = get_comment_text();
                          $sanitizer = new AMPFORWP_Content( $comment_content, array(), apply_filters( 'ampforwp_content_sanitizers', array( 'AMP_Img_Sanitizer' => array() ) ) );
                          echo $sanitizer->get_amp_content(); ?>
                        </p>
											</div>
												<!-- .comment-content -->
										</article>
									 <!-- .comment-body -->
									</li>
								<!-- #comment-## -->
									<?php
								}// end of ampforwp_custom_translated_comment()

				wp_list_comments( array(
				  'per_page' 			=> AMPFORWP_COMMENTS_PER_PAGE , //Allow comment pagination
				  'style' 				=> 'li',
				  'type'				=> 'comment',
				  'max_depth'   		=> 5,
				  'avatar_size'			=> 0,
					'callback'				=> 'ampforwp_custom_translated_comment',
				  'reverse_top_level' 	=> true //Show the latest comments at the top of the list
				), $comments);  ?>
		    </ul>
		</div>
    <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if( ! is_plugin_active( 'amp-comments/amp-comments.php' ) ) { ?>
  		<div class="comment-button-wrapper">
  		    <a href="<?php echo trailingslashit( get_permalink() ) .'?nonamp=1'.'#commentform' ?>" rel="nofollow"><?php echo  ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment'  ); ?></a>
  		</div>
    <?php } ?>
    <?php } else {
       global $redux_builder_amp ;
       if (!comments_open()) {
         return;
       } ?>
       <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
       if( ! is_plugin_active( 'amp-comments/amp-comments.php' ) ) { ?>
         <div class="comment-button-wrapper">
  	        <a href="<?php echo trailingslashit( get_permalink() ) .'?nonamp=1'.'#commentform' ?>" rel="nofollow"><?php echo  ampforwp_translation( $redux_builder_amp['amp-translator-leave-a-comment-text'], 'Leave a Comment'  ); ?></a>
          </div>
        <?php } ?>
<?php  } ?>
</div>
