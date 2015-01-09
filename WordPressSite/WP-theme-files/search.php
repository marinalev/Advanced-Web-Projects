<?php get_header(); ?>
<div id="content">
	<h2 id="search-box">Search Results for <?php echo get_search_query(); ?></h2>
	<div id="posts">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
            <article class="postcol">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_content("view more"); ?>
                <?php comments_number("0 comments", "1 comment", "% comments"); ?>
            </article>
        <?php endwhile; else: ?>
            <p>Sorry no search results</p>
            <p><?php get_search_form(); ?></p>
        <?php endif; ?>
    </div>
	<?php get_sidebar("left"); ?>
</div>
<?php get_footer(); ?>












