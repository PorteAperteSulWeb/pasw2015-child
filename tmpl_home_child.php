<?php
/*
Template Name: Home page Child
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
        <div class="homec">
            <?php the_content(); ?>
            <div class="clear"></div>
        </div>
    <?php endwhile; endif; ?>
<?php     
	$sticky = get_option( 'sticky_posts' );
	if ( isset($sticky[0]) ) {
		get_template_part('home-child-widgets');
	}
?>
<?php include(TEMPLATEPATH . '/home-widgets.php'); ?>

</div>
<?php include(TEMPLATEPATH . '/rightsidebar.php'); ?>
<?php get_footer(); ?>
