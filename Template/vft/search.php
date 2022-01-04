<? get_header(); ?>
<?
$s = get_search_query();
function get_price(){
    global $product;
	$price = $product->get_price();
}
?>
<div class="container">
	<h2 class="search-page__title">Search results for: <span class="search-page__query">'<? echo $s; ?>'</span></h2>
    <div class="search-page">
        <div class="search-page__container">
            <div class="search-page__navigation search-navigation">
                <button class="search-navigation__btn search-navigation__btn_products">Products&nbsp;<span class="products-count"></span></button>
                <button class="search-navigation__btn search-navigation__btn_blog">Blog&nbsp;<span class="blog-count"></span></button>
                <button class="search-navigation__btn search-navigation__btn_wiki">Wiki&nbsp;<span class="wiki-count"></span></button>
            </div>
            <div class="search-page__results">
                <div class="product-results">
<? $a = array(
'post_type'      => 'product',
'orderby'        => 'date',
'order'          => 'DESC',
's' => $s
);
$q = new WP_Query($a);
?>

<? if ( $q->have_posts() ) : ?>
<? while ( $q->have_posts() ) : $q->the_post(); ?>

    <div class="product-result">
      <div class="product-result__image"><? echo get_the_post_thumbnail() ?></div>
      <h3 class="product-result__title"><? the_title(); ?></h3>

<? $sku = $product->get_sku();
if ($sku == null){
$sku = 'Not setup';
}
?>
<div class="product-result__line">
      <p class="product-result__sku">SKU: <? echo $sku; ?></p>
      <a href="<? the_permalink(); ?>" class="product-result__link">Read more</a>
</div>
      <? do_action('vft_productionstatus_display'); ?>
    </div>

<? endwhile; ?>
<? else: ?>
<div class="empty-search">
  <h2 class="empty-search__header">We couldn't find any results for <span class='empty-search__query'>'<? echo $s; ?>'</span>
  </h2>
</div>
<? endif; ?>
	
<? wp_reset_postdata(); ?>

</div>
  <div class="blog-results search-block_hide">
  <?
$a = array(
'post_type' => 'post',
'orderby'        => 'date',
'order'          => 'DESC',
's' => $s
);
$q = new WP_Query($a);
?>
<? if ( $q->have_posts() ) : ?>
<? while ( $q->have_posts() ) : $q->the_post(); ?>
            <div class="blog-post">
                                <div class="blog-post__info">
									<? $postid = get_the_ID(); ?>
									<div class="blog-post__category">
										<? the_category(); ?>
									</div>
                                    <p class="blog-post__date"><? echo get_the_date(); ?></p>
                                </div>
                                <div class="post-content">
                                    <? echo get_the_post_thumbnail()?>
                                    <h3 class="blog-post__title"><? the_title(); ?></h3>
                                    <div class="blog-post__content"><? the_excerpt() ?></div>
									<div class="blog-post__info">
                                    <a href="<? the_permalink(); ?>" class="blog-post__link">Read more</a>  
									<p class="blog-post__comments"><? echo get_comments_number($postid); ?></p>
									</div>
                                </div>
                            </div>
                            <? endwhile; ?>
	  <? else: ?>
<div class="empty-search">
  <h2 class="empty-search__header">We couldn't find any results for <span class='empty-search__query'>'<? echo $s; ?>'</span>
  </h2>
</div>
                        <? endif; ?>
                    <? wp_reset_postdata(); ?>
  </div>
  <div class="wiki-results search-block_hide">
<? $a = array(
'post_type'      => 'glossary',
'orderby'        => 'date',
'order'          => 'DESC',
's' => $s
          );
$q = new WP_Query($a);
          ?>
<? if ( $q->have_posts() ) : ?>
<? while ( $q->have_posts() ) : $q->the_post(); ?>
    <div class="wiki-result">
       <a href="<? the_permalink(); ?>" class="wiki-result__link">
         <div class="wiki-result__image"><? echo get_the_post_thumbnail() ?></div>
          <h3 class="wiki-result__title"><? the_title(); ?></h3>
          <div class="wiki-result__deskription"><? the_excerpt(); ?></div>
       </a>
    </div>
<? endwhile; ?>
	  <? else: ?>
<div class="empty-search">
  <h2 class="empty-search__header">We couldn't find any results for <span class='empty-search__query'>'<? echo $s; ?>'</span>
  </h2>
</div>
<? endif; ?>
<? wp_reset_postdata(); ?>
</div>
    </div>
</div>
<? do_action('vft_js_searchfilter'); ?>
<? get_footer(); ?>