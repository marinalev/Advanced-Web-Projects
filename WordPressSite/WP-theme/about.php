<?php
	/*
	* Template Name: About Page
	*/
?>
<?php get_header(); ?>
<div id="content">
    <div class="half-col-1">
    	<?php the_block("Column 1"); ?>
    </div>
    <div class="half-col-2">
    	<?php the_block("Column 2"); ?>
    </div>
	<div class="col1of3">
		<?php the_block("Column 1a"); ?>
	</div>
	<div class="col2of3">
		<?php the_block("Column 2a"); ?>
	</div>
	<div class="col3of3">
		<?php the_block("Column 3a"); ?>
	</div>
</div>
<?php get_footer(); ?>






