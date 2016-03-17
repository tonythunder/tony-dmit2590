<?php get_header(); ?>
<div id="container">
	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<div class="entry">
			<div class="postmetadata">
				作者: <?php the_author_posts_link(); ?> 发表日期: <span><?php the_time('Y年m月d日'); ?></span>  
                <?php the_tags('标签: ', ' , ' , ''); ?> 
				评论数: <?php comments_popup_link('0', '1', '%'); ?> 条 <?php edit_post_link('[编辑]'); ?>
			</div>        
			<?php the_content(); ?>
			<?php link_pages('<p><code>Pages:</strong> ', '</p>', 'number'); ?>
		</div>
	</div>
	<?php endwhile; ?>
	<div class="comments-template">
		<?php comments_template( '', true ); ?>
	</div>   
	<?php else : ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><?php _e('抱歉，暂时没有搜索到您需要的内容！不过，以下内容或许能帮到您！'); ?></h2>
			<?php include (TEMPLATEPATH . '/404.php'); ?>
		</div>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>