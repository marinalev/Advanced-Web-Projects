<?php
	/*
	* Template Name: Two Columns
	*/
?>
<?php get_header(); ?>
<div id="content">
    <div class="col1of2">
    	<?php the_block("Column 1"); ?>
    </div>
    <div class="col2of2">
    	<?php the_block("Column 2"); ?>
    </div>
</div>
<?php get_footer(); ?>






