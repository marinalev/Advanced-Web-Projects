<?php 
	register_nav_menus(array(
		"main-menu" => "Main website navigation"
	)); 

	add_theme_support('post-thumbnails'); 
	set_post_thumbnail_size(200,200, true);
	
	//sidebars
	register_sidebar(array(
		"name" => "Left Sidebar",
		"id" => "left-sidebar",
		"description" => "Will appear on the Left",
		"before_widget" =>"<div class='widget'>",
		"after_widget" =>"</div>",
		"before_title" => "<h3 class='widget_title'>",
		"after_title" => "</h3>"
	));
?>