<?
get_header();
?>
<?
$currentid = get_the_ID(); 
while ( have_posts() ) :
?>
<div class="container">
    <div class="single-wiki" itemscope itemtype="http://schema.org/Article">
	<h1 hidden="true" itemprop="headline name">
		<? single_post_title(); ?>
	</h1>
    <h2 class="single-wiki__title"><? single_post_title(); ?></h2>
    <div class="single-wiki__content">
        <div class="single-wiki__thumbnail" itemscope itemtype="http://schema.org/ImageObject">
        <?php $post_thumbnail_id = get_post_thumbnail_id(); ?>
        <img src="<?php echo wp_get_attachment_url( $post_thumbnail_id ); ?>" alt="<? single_post_title(); ?>" itemprop="contentUrl">
			<p hidden="true" itemprop="name">
				<? single_post_title(); ?>
			</p>
			<p hidden="true" itemprop="description">
				<? single_post_title(); ?> image
			</p>
        </div>
        <div class="signle-wiki__post">
            <div class="single-wiki__post-tabs post-tabs">
                <button class="post-tabs__btn tabs__btn_general">General information</button>
                <button class="post-tabs__btn tabs__btn_external">External signs of raw materials</button>
                <button class="post-tabs__btn tabs__btn_cnt">Contraindications</button>
            </div>
            <div class="single-wiki__post-content" itemprop="articleBody">
                <?
                the_post();
                the_content();
                ?>
            </div>
        </div>
		<? endwhile; ?>
    </div>
    </div>
</div>
    <div class="single-wiki__related-products related-products">
        <h3 class="related-products__title">Related products</h3>
        <div class="related-products__slider_nojs">
            <?
            $a = array(
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'order'          => 'DESC',
            'orderby'        => 'date',
            'posts_per_page' => 12
            );
            $query = new WP_Query($a); ?>
            <? if ($query->have_posts()) {
            while ($query->have_posts()) {
            $query->the_post(); ?>
            <div class="related-products__slide">
            <?
                $currentid = get_the_ID();
                $urli = get_the_post_thumbnail_url($currentid);
            ?>
                <h4 class="related-products__slide-title"><?php the_title(); ?></h4>
                <a href="<?php the_permalink(); ?>" class="related-products__slide-link">Shop now</a>
                <img src="<? echo $urli; ?>" alt="<?php the_title(); ?>" class="related-products__slide-image">
                <div class="related-products__slide-bg"></div>
            </div>
            <?
            }
            }
            else {
                                                    
            }
            ?>
        </div>
    </div>
<?
do_action('vft_js_singlewiki');
?>
<?
get_footer();
?>