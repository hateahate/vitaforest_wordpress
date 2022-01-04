<?
/*
* Template name: Blog
*/
?>
<? 
get_header();
?>
<div class="container">
	<h1 hidden="true">
		Blog
	</h1>
		<div class="blog-wrapper">
	<div class="blog-filter">
			<p>
			Categories
		</p>
		<button class="blog-filter-close"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger-close.svg" alt="Close button"></button>
		<?php if ( is_active_sidebar( 'blog-filter' ) ) : ?>
		<?php dynamic_sidebar( 'blog-filter' ); ?>
		<?php endif; ?>	
	</div>
    <section class="blog">
		<div class="blog-section__header">
        <h2 class="blog__page-title">Recent Blog Posts</h2>
		<button class="blog-filters-shown"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/params.svg" alt="Filter button"></button>
		</div>
        <div class="blog-container">
        <?
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
		'posts_per_page' => 8,
		'paged' => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC'
        );
        $q = new WP_Query($args);
        ?>
        <? if ( $q->have_posts() ) : ?>
        <? while ( $q->have_posts() ) : $q->the_post(); ?>
            <div class="blog-post">
                <div class="blog-post__info">
                    <p class="blog-post__category"><?php the_category(' > ', 'single'); ?></p>
                    <p class="blog-post__date"><?php echo get_the_date(); ?></p>
                </div>
                <div class="post-content">
					<a href="<?php the_permalink(); ?>">
                    <?php echo get_the_post_thumbnail()?>
                    <h3 class="blog-post__title"><?php the_title(); ?></h3>
                    <div class="blog-post__content"><?php the_excerpt();  ?></div>
					</a>
					<div class="blog-post__info">
                    <a href="<?php the_permalink(); ?>" class="blog-post__link">Read more</a>
					<? 
					$pid = get_the_ID();
					$cc = get_comments_number($pid); 
					?>
					<p class="blog-post__comments"><? echo $cc; ?></p>
					</div>
                </div>
            </div>
        <?php endwhile; ?>
</div>
					<div class="blog-pagination">
			<?php if (function_exists("blog_pagination")) {
    blog_pagination($q->max_num_pages);
} ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
        </div>
    </section>
</div>
	
</div>
<?
get_footer();
?>
<? do_action('vft_js_blogpage'); ?>