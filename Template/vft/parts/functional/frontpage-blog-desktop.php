<?

// Front page news block (Desktop)

?>
<h2 class="title">Recent blog posts</h2>
<section class="recent-blog-ds">
<?
$args = array(
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
             );
$q = new WP_Query($args);
?>
                    <? if ( $q->have_posts() ) : ?>
                        <? while ( $q->have_posts() ) : $q->the_post(); ?>
                            <div class="blog-post">
                                <div class="blog-post__info">
									<div class="blog-post__category">
										<? the_category(); ?>
									</div>
                                    <p class="blog-post__date"><? echo get_the_date(); ?></p>
                                </div>
                                <div class="post-content">
									<a href="<? the_permalink(); ?>">
                                    <? echo get_the_post_thumbnail()?>
                                    <h3 class="blog-post__title"><? the_title(); ?></h3>
									</a>
                                    <div class="blog-post__content"><? the_excerpt() ?></div>
                                    <a href="<? the_permalink(); ?>" class="blog-post__link">Read more</a>   
                                </div>
                            </div>
                            <? endwhile; ?>
                        <? endif; ?>
                    <? wp_reset_postdata(); ?>

</section>