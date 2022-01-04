<?php
/*
Template Name: Wiki
*/
?>
<?php get_header(); ?>
<?php if ( is_active_sidebar( 'glossary-filter' ) ) : ?>
<?php dynamic_sidebar( 'glossary-filter' ); ?>
<?php endif; ?>
<?php echo do_shortcode('[wpg_list title="Plants Database" layout="three_column" taxonomy="glossary_cat" post_type="glossary"]');?>
<?php get_footer(); ?>
