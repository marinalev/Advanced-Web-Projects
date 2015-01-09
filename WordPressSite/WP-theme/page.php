<?php get_header(); ?>
<div id="content">
	<div class="breadcrumbs">
		<?php 
			if(function_exists('bcn_display'))
			{
           		bcn_display();
        	}
		?>
    </div>
	<div id="posts">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
            <article>
                <?php the_content("Read More"); ?>
            </article>
        <?php endwhile; else: ?>
            <p>Sorry no posts</p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>