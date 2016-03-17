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
			<?php include('includes/thumbnail.php'); ?>
			<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 400,"......"); ?></p>
            <div class="readmore">
            	<span><?php if(function_exists('the_views')) { echo"Views: "; the_views(); } ?></span>
            	<span style="font-weight:700;"><a href="<?php the_permalink(); ?>" title="Read more about《<?php the_title(); ?>》">read more>></a></span>
            </div>         
		</div>
	</div>
    <div class="clearfix"></div>
	<?php endwhile; ?>
    <?php include (TEMPLATEPATH . '/includes/paginate.php'); ?>
	<?php else : ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><?php _e('Sorry, there is no search for what you need! However, the following may help you!'); ?></h2>
			<?php include (TEMPLATEPATH . '/404.php'); ?>
		</div>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>