<?php
function yogastudio_scripts(){
	if(is_front_page()){
		wp_enqueue_style('yogastudio',get_stylesheet_directory_uri().'/yogastudio.css' );
	}
}

add_action('wp_enqueue_scripts','yogastudio_scripts' );

?>