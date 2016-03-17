<div id="post_box">
	<div class="authorbio">
		<div class="author_pic">
			<?php echo get_avatar( get_the_author_email(), '48' ); ?>
		</div>
		<div class="author_description">
			<span>Author: <?php the_author_posts_link(); ?></span>
			<?php //the_author_description(); //?>
		</div>
	</div>
	<div class="author_text">
		The log from the <?php the_author() ?> At<?php the_time('Y/M/D') ?>Published in<?php the_category(', ') ?>Classification under，
		<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {?>
		You can<a href="#respond">Comment</a>，And reservations<a href="<?php the_permalink() ?>" rel="bookmark">Original Address</a>And at the author's case<a href="<?php trackback_url(); ?>" rel="trackback">Quote</a>To your website or blog.
		<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) { ?>
		Announcement is currently unavailable, you can leave comments to the bottom.
		<?php } ?><br/>
		Reproduced please specify: <a href="<?php the_permalink() ?>" rel="bookmark" title="This article Permalink <?php the_permalink() ?>"><?php the_title(); ?></a><br/>
		Tags: <?php the_tags('', ', ', ''); ?>
	</div>
	<div class="clearfix"></div>
</div>

<div id="post_box">
	<?php previous_post_link('【Previous】%link') ?><br/>
	<?php next_post_link('【Next】%link') ?>
	<div class="clearfix"></div>
</div>

<!-- related content -->
<div id="post_box_related">
	<h3>Articles you may be interested:</h3>
	<ul>
		<?php related_posts() ?>
	</ul>
	<div class="clearfix"></div>    
</div>