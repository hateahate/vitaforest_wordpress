<?
/*
* Template name: Archive
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
			<h3>
			Categories
		</h3>
		<button class="blog-filter-close"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger-close.svg" alt="Close button"></button>
		<?php if ( is_active_sidebar( 'blog2-filter' ) ) : ?>
		<?php dynamic_sidebar( 'blog2-filter' ); ?>
		<?php endif; ?>	
	</div>
    <section class="blog">
		<div class="blog-section__header">
        <h2 class="blog__page-title">Category: <span>'<? $cattitle = get_the_category(); echo $cattitle[0]->name; ?>'</span></h2>
		<button class="blog-filters-shown"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/params.svg" alt="Filter button"></button>
		</div>
        <div class="blog-container">
        <?
        $args = array(
		'paged' => $paged,
        'orderby'        => 'date',
        'order'          => 'ASC',
		'category_name' => $cattitle[0]->name
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
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </section>
</div>
	
</div>
<? do_action('vft_js_blogpage'); ?>
<?
get_footer();
?>
