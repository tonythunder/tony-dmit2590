<div class="sidebar">
	<ul>
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>
		<li class="widget"><h2 class="widgettitle"><?php _e('Categories'); ?></h2>
			<ul>
				<?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
			</ul>
		</li>
		<li class="widget"><h2 class="widgettitle"><?php _e('Archives'); ?></h2>
			<ul class="sidebar_archives">
				<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
				<div class="clearfix"></div>
			</ul>
		</li>
		<li class="widget"><h2 class="widgettitle"><?php _e('Sponsored'); ?></h2>
			<ul>
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-1770935404061309";
			/* ad010 */
			google_ad_slot = "2916661661";
			google_ad_width = 200;
			google_ad_height = 200;
			//-->
			</script>
			<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
			</ul>
		</li>
		<li class="widget"><h2 class="widgettitle"><?php _e('Random article'); ?></h2>
			<ul>
				<?php $rand_posts = get_posts('numberposts=10&orderby=rand');
				foreach( $rand_posts as $post ) : ?>
   				<li><a href="<?php the_permalink(); ?>" title="Read more about《<?php the_title(); ?>》"><?php echo mb_strimwidth(strip_tags(apply_filters('the_title', $post->post_title)), 0, 32); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</li>
		<li class="widget"><h2 class="widgettitle"><?php _e('latest comment'); ?></h2>
			<ul>
				<?php get_new_comments();?>  
			</ul>
		</li>
		<li class="widget"><h2 class="widgettitle"><?php _e('Tags'); ?></h2>
			<ul class="tags">
				<?php wp_tag_cloud("number=50&smallest=13&largest=13&unit=px"); ?>
				<div class="clearfix"></div>
			</ul>
		</li>
		<li class="widget"><h2 class="widgettitle"><?php _e('Links'); ?></h2>
			<ul class="links">
				<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
				<div class="clearfix"></div>
			</ul>
		</li>
<li class="widget"><h2 class="widgettitle"><?php _e('Site Information'); ?></h2>		
		<ul>
			<li>Total posts:<?php global $wpdb; $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?> Piece</li>
			<li>Creation Date：2015.10.25</li>
			<li>Comments Total:<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?> Article</li>
			<li>Tags Total:<?php echo $count_tags = wp_count_terms('post_tag'); ?> </li>			
			<li>Total Categories:<?php echo $count_categories =wp_count_terms('category'); ?> </li>
			<li>Contact QQ: 448942787</li>
			<li>Total number of pages:<?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?> </li>
			<li>E-Mail: yuchen.deng1992@gmail.com</li>
			<li>Total number of links:<?php $link = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->links WHERE link_visible = 'Y'"); echo $link; ?> Article</li>
		</ul>
</li>
		<li class="widget"><h2 class="widgettitle"><?php _e('Meta'); ?></h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</li>
		<?php endif; ?>
	</ul>
</div>