<?php get_header(); ?>
<div id="container">
	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><a href="<?php the_permalink(); ?>" title="Read more about《<?php the_title(); ?>》"><?php the_title(); ?></a></h2>
        <div class="entry">
			<div class="postmetadata">
				Author: <?php the_author_posts_link(); ?> Date of Post: <span><?php the_time('Y/M/D'); ?></span> Category: <?php the_category(', ') ?> 
                <?php the_tags('Tags: ', ' , ' , ''); ?> 
				Comments: <?php comments_popup_link('0', '1', '%'); ?> Article <?php edit_post_link('[Edit]'); ?>
			</div>       
			<?php the_content(); ?>
            <div class="readmore">
            	<span><?php if(function_exists('the_views')) { echo"Views: "; the_views(); } ?></span>
            </div>
			<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
		</div>
	</div>
	<?php endwhile; ?>
	<?php include (TEMPLATEPATH . '/includes/related.php'); ?>
	<div class="comments-template">
		<?php comments_template( '', true ); ?>
	</div>    
	<?php else : ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><?php _e('404 - File or directory not found.'); ?></h2>
			<?php include (TEMPLATEPATH . '/404.php'); ?>
		</div>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>