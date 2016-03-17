<?php

include("includes/theme_options.php");

if ( function_exists('register_sidebar') )
    register_sidebar();
	
if ( function_exists('register_nav_menus') ) {
    register_nav_menus(array(
        'primary' => 'Navigation menu'
    ));
}	

//Support from the chain thumbnail
function get_featcat_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
		$random = mt_rand(1, 10);
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/random/'.$random.'.jpg';
  }
  return $first_img;
}

//Article thumbnail
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
// for post and page
add_theme_support('post-thumbnails', array( 'post', 'page' ) );
function fb_AddThumbColumn($cols) {
$cols['thumbnail'] = __('Thumbnail');
return $cols;
}
function fb_AddThumbValue($column_name, $post_id) {
$width = (int) 35;
$height = (int) 35;
if ( 'thumbnail' == $column_name ) {
// thumbnail of WP 2.9
$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
// image from gallery
$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
if ($thumbnail_id)
$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
elseif ($attachments) {
foreach ( $attachments as $attachment_id => $attachment ) {
$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
}
}
if ( isset($thumb) && $thumb ) {
echo $thumb;
} else {
echo __('None');
}
}
}
// for posts
add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
// for pages
add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}

//Article pagination
if ( !function_exists('pagenavi') ) {
	function pagenavi( $p = 7 ) { // Take this page before and after the two, based on the need to change
		if ( is_singular() ) return; // Articles and inset do
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return; // Only one without
		if ( empty( $paged ) ) $paged = 1;
		echo '<span class="pages">Pages:' . $paged . '/' . $max_page . '</span>'; // Show page
		if ( $paged > $p + 1 ) p_link( 1, 'First' );
		if ( $paged > $p + 2 ) echo '... ';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // Intermediate page
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '... ';
		if ( $paged < $max_page - $p ) p_link( $max_page, 'Last Page' );
	}
	function p_link( $i, $title = '' ) {
		if ( $title == '' ) $title = "No {$i} Page";
		echo "<a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";
	}
}

//Headline text truncation
function cut_str($src_str,$cut_length) {
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length)) {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224) {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192) {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90) {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length) {
        $return_str = $return_str . '';
    }
    if (get_post_status() == 'private') {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}

//Related Articles Code
function related_posts() {
$post_num = 8; // Number set.
global $post;
$tmp_post = $post;
$tags = ''; $i = 0; // First take tags article.
$exclude_id = $post->ID;
$posttags = get_the_tags();
if ( $posttags ) {
  foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
  $tags = strtr(rtrim($tags, ','), ' ', '-');
  $myposts = get_posts('numberposts='.$post_num.'&tag='.$tags.'&exclude='.$exclude_id);
  foreach($myposts as $post) {
    setup_postdata($post);
    ?>
    <li><a href="<?php the_permalink(); ?>"><?php echo cut_str($post->post_title,90); ?></a></li>
    <?php
    $exclude_id .= ','.$post->ID; $i ++;
  }
}
if ( $i < $post_num ) { // When the lack of tags article number, and then take category make up.
  $post = $tmp_post; setup_postdata($post);
  $cats = ''; $post_num -= $i;
  foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
  $cats = strtr(rtrim($cats, ','), ' ', '-');
  $myposts = get_posts('numberposts='.$post_num.'&category='.$cats.'&exclude='.$exclude_id);
  foreach($myposts as $post) {
    setup_postdata($post);
    ?>
    <li><a href="<?php the_permalink(); ?>"><?php echo cut_str($post->post_title,90); ?></a></li>

    <?php
    $i ++;
  }
}
if ( $i == 0 ) echo '<li>No Related Articles</li>';
$post = $tmp_post; setup_postdata($post);
}

//Comments expression
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
    return get_bloginfo('template_directory').'/images/smilies/'.$img;
}

//Recent comments function   
function get_new_comments(){   
    //Get the most recent 10 comments   
    $comments = get_comments('number=10&status=approve&user_id=0');     
    foreach($comments as $comment) {   
        //Review the tag removed   
        $comment_content = strip_tags($comment->comment_content);   
        //Comments may be very long, so consider truncating Review, only 14 characters
        $short_comment_content = trim(mb_substr($comment_content ,0,14,"UTF-8"));   
        //First obtain Avatar   
        $output .= '<li>'.get_avatar( $comment, 32, $default, $comment->comment_author );   
        //Get Authors   
        $output .= $comment->comment_author .':<br /><a href="';
        //Content and links  
        $output .= get_permalink( $comment->comment_post_ID ) ."#comment-" .$comment->comment_ID .'" title="View《'.get_post( $comment->comment_post_ID )->post_title .'》Comments on">';   
        $output .= $short_comment_content .'</a></li>';   
    }   
    //Output   
    echo $output;   
}  
	
//Automatic generation of copyright time
function comicpress_copyright() {
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
    SELECT
    YEAR(min(post_date_gmt)) AS firstdate,
    YEAR(max(post_date_gmt)) AS lastdate
    FROM
    $wpdb->posts
    WHERE
    post_status = 'publish'
    ");
    $output = '';
    if($copyright_dates) {
    $copyright = "&copy; " . $copyright_dates[0]->firstdate;
    if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
    $copyright .= '-' . $copyright_dates[0]->lastdate;
    }
    $output = $copyright;
    }
    return $output;
    }	

?>