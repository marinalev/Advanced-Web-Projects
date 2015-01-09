<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php bloginfo("name"); ?></title>
	<link rel="stylesheet" href="style.css">
	
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<header>
    	<h1><a href="<?php bloginfo("url"); ?>">
			<?php bloginfo("name"); ?>
        </a></h1>
        <h2><?php bloginfo("description"); ?></h2>
        
        <?php wp_nav_menu(array("menu" => "Marina's Menu")); ?>
    </header>
    
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
        	<h2><?php the_title(); ?></h2>
            <p><?php the_content(); ?></p>
    <?php endwhile; else: ?>
    	<p>Sorry you don't have posts :(</p>
    <?php endif; ?>
</body>
</html>











