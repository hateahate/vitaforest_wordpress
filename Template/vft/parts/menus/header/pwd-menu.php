<?
// POWDERS MENU ARRAY
function pwd_menu(){
wp_nav_menu(
    array( 
    'menu' => 'header-powders',
    'container' => 'ul',
    'menu_class' => 'navigation-subcategory__list',
    'theme_location' => 'headerpowders'
    )
	);
}
?>
<?
// GET MENU NAME
$menu_location = 'headerpowders';
$menu_locations = get_nav_menu_locations();
$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
$menu_name = (isset($menu_object->name) ? $menu_object->name : '');
?>
<? //DRAW MENU ?>
<li class="navigation__subcategory navigation-subcategory">
<a href="/shop/product-category-powders/" class="navigation-subcategory__main-link"><? echo $menu_name; ?></a>
<? pwd_menu(); ?>
</li>