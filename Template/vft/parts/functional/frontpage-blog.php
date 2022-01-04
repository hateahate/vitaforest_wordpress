<?

// Front page news block

?>
<h2 class="title frontpage-blog-mobile">Recent blog posts</h2>
<section class="recent-blog">
    <div class="recent-blog__slider slider">
        <div class="slider__container">
            <div class="slider__wrapper">
                <div class="slider__items">
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
                            <div class="blog-post slider__item">
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
            </div>

        </div>
			 <div class="recent-blog__navigation">
              <button class="recent-blog__control slider__control" data-slide="prev"><img
                  src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/arrow-l.svg" alt="Previous button"></button>
              <button class="recent-blog__control slider__control" data-slide="next"><img
                  src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/arrow-r.svg" alt="Next button"></button>
              <a href="#" class="recent-blog__full"> See more</a>
            </div>
    </div>
</div>
</section>