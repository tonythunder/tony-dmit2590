<?php get_header(); ?>
<div class="col-9 col-m-9" id="container">
    <?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
            <div class="post" id="post-<?php the_ID(); ?>">
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <div class="entry">
                    <div class="postmetadata">
                        Author: <?php the_author_posts_link(); ?> Date of publication: <span><?php the_time('Y/M/D'); ?></span>  
                        <?php the_tags('Tags: ', ' , ', ''); ?> 
                        Comments: <?php comments_popup_link('0', '1', '%'); ?> Article <?php edit_post_link('[Edit]'); ?>
                    </div>        
                    <?php the_content(); ?>
                    <?php link_pages('<p><code>Pages:</strong> ', '</p>', 'number'); ?>
                </div>
            </div>
        <?php endwhile; ?>
        <div class="comments-template clearfix">
            <?php comments_template('', true); ?>
        </div>   
    <?php else : ?>
        <div class="post" id="post-<?php the_ID(); ?>">
            <h2><?php _e('Sorry, there is no search for what you need! However, the following may help you!'); ?></h2>
            <?php include (TEMPLATEPATH . '/404.php'); ?>
        </div>
    <?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>