<?php
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');
add_action('wp_ajax_ajax_search', 'ajax_search');
function ajax_search()
{
{
	$getquery = $_POST['term'];
    $args = array(
        'post_type'      => 'product', // Тип записи: post, page, кастомный тип записи
        'post_status'    => 'publish',
        'order'          => 'DESC',
        'orderby'        => 'date',
        's'              => $_POST['term'],
        'posts_per_page' => 3
    );
    $query = new WP_Query($args); ?>
<div class="ajax__product-result">
    <?
    if ($query->have_posts()) {
        echo '<h2 class="ajax__title">Products</h2>';
		?><div class="ajax__results-container"><?
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <div class="ajax__result-item">
				
					<? the_post_thumbnail(); ?>
                <a href="<?php the_permalink(); ?>" class="ajax-search__link"><?php the_title(); ?></a>
				<div class="product-bg">
					
				</div>
                <div class="ajax-search__excerpt"><?php the_excerpt(); ?></div>
            </div>
			<? } ?>
		</div>
	<a class="ajax__btn-more" href="/?s=<? echo $getquery; ?>">See more</a></div><?
    } else { echo '</div>'; ?>
<?php }} ?>
    <?
{
    $args = array(
        'post_type'      => 'post', // Тип записи: post, page, кастомный тип записи
        'post_status'    => 'publish',
        'order'          => 'DESC',
        'orderby'        => 'date',
        's'              => $_POST['term'],
        'posts_per_page' => 3
    );
    $query = new WP_Query($args);?>
    <div class="ajax__blog-results">
    <?
    if ($query->have_posts()) {
		echo '<h2 class="ajax__title">Blog</h2>';
		?><div class="ajax__results-container"><?
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <div class="ajax__result-item">
                <a href="<?php the_permalink(); ?>" class="ajax__item-title"><?php the_title(); ?></a>
                <div class="ajax__item-excerpt"><?php the_excerpt(); ?></div>
            </div>
		<? } ?>
		</div>
        <a class="ajax__btn-more" href="/?s=<? echo $getquery; ?>">See more</a></div><?
    } else { echo '</div>'; ?>

<?php } ?>
<?
}
{
    $args = array(
        'post_type'      => 'glossary', // Тип записи: post, page, кастомный тип записи
        'post_status'    => 'publish',
        'order'          => 'DESC',
        'orderby'        => 'date',
        's'              => $_POST['term'],
        'posts_per_page' => 3
    );
    $query = new WP_Query($args);?>
    <div class="ajax__wiki-results">
        <? 
    if ($query->have_posts()) {
		echo '<h2 class="ajax__title">Wiki</h2>';?>
		<div class="ajax__results-container">
		<?
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <div class="ajax__result-item">
                <a href="<?php the_permalink(); ?>" class="ajax__item-title"><?php the_title(); ?></a>
                <div class="ajax__item-excerpt"><?php the_excerpt(); ?></div>
            </div>
        <?php }?>
		</div><a class="ajax__btn-more" href="/?s=<? echo $getquery; ?>">See more</a></div><?
    } else { echo '</div>'; ?>

<?php } ?><script id="ajax-search-results-check">function checkSearchResults() {
    let searchContainer = document.querySelector('.ajax-search');
    let productResult = document.querySelector('.ajax__product-result');
    let blogResult = document.querySelector('.ajax__blog-results');
    let wikiResult = document.querySelector('.ajax__wiki-results');
    let productResultInner = productResult.querySelector('.ajax__result-item');
    let blogResultInner = blogResult.querySelector('.ajax__result-item');
    let wikiResultInner = wikiResult.querySelector('.ajax__result-item');
    if (productResultInner == null && blogResultInner == null && wikiResultInner == null) {
        searchContainer.innerHTML = '<p class="ajax-search__empty-results">Nothing found</p>';
        return;
    }
    else {
        return;
    }
}
checkSearchResults();</script>
    <?
    exit;
}
}