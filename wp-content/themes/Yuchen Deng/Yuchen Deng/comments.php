<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die (__('Please do not load this page directly. Thanks!'));
	}
?>
<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // if there's a password
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
?>
<h2><?php _e('Password Protected'); ?></h2>
<p><?php _e('Enter the password to view comments.'); ?></p>
<?php return;
	}
}
	/* This variable is for alternating comment background */
$oddcomment = 'alt';
?>
<!-- You can start editing here. -->
<?php if ($comments) : ?>
	<h3 id="comments"><?php comments_number('0 Replies', '1 Replies', '% Replies' );?></h3>
	<?php if ( $comments ) : ?>
	<ol class="commentlist">
		<?php wp_list_comments();?>
	</ol>
	<?php else : // If there are no comments yet ?>
	<p><?php _e('No comments yet.'); ?></p>
	<?php endif; ?>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
	<!-- If comments are open, but there are no comments. -->
	<?php else : // comments are closed ?>
	<!-- If comments are closed. -->
	<p class="nocomments">Comments are closed.</p>
	<?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
	<div id="respond">
	<h3 id="postcomment">Comment</h3>
	<div id="cancel-comment-reply"> 
		<?php cancel_comment_reply_link() ?>
	</div>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p>You must <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">:Log In</a> To post a comment.</p>
<?php else : ?>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
	<p>You now <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> Log on. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">[Log Out]</a></p>
<?php else : ?>
	<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="40" tabindex="1" />
	<label for="author">Nickname <?php if ($req) echo "(*Required)"; ?></label></p>
	<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="40" tabindex="2" />
	<label for="email">E-Mail <?php if ($req) echo "(*Required，But it will not open)"; ?></label></p>
	<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="40" tabindex="3" />
	<label for="url">WebSite (Optional)</label></p>
<?php endif; ?>
	<!--<p><strong>XHTML:</strong> <?php _e('You can use these tags&#58;'); ?> <?php echo allowed_tags(); ?></p>-->
	<?php include(TEMPLATEPATH . '/includes/smiley.php'); ?>
	<p><textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea></p>
	<p>
	<input name="submit" type="submit" id="submit" tabindex="5" value="Comment" />
	<input name="reset" type="reset" class="tinput" id="reset" value="Re-write" />
	<?php comment_id_fields(); ?>
	</p>
<?php do_action('comment_form', $post->ID); ?>
	</form>
<?php endif; // If registration required and not logged in ?>
	</div>
<?php endif; // if you delete this the sky will fall on your head ?>