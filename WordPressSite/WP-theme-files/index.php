<?php get_header(); ?>
<div id="content">
	<div id="posts">
		<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<article class="blog-post">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				 <p>Written on
					<time datetime="<?php the_time('Y-m-d'); ?>">
						<?php the_time('M j'); ?>
					</time>
					by <?php the_author(); ?>
				 </p>
				<?php the_post_thumbnail(); ?>
				<?php the_content("Read More"); ?>
				<?php comments_number("0 comments", "1 comment", "% comments"); ?>
			</article>
		<?php endwhile; else: ?>
			<p>Sorry no posts</p>
		<?php endif; ?>
	</div>
	<?php get_sidebar("left"); ?>
</div>
<?php get_footer(); ?>