<?
// FOOTER FIRST COLUMN ARRAY
function footer_first(){
wp_nav_menu(
    array( 
    'menu' => 'footer-first',
    'container' => 'ul',
    'menu_class' => 'footer-navigation__list',
    'theme_location' => 'footerfirst'
    )
	);
}
?>
<?
// GET MENU NAME
$menu_location = 'footerfirst';
$menu_locations = get_nav_menu_locations();
$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
$menu_name = (isset($menu_object->name) ? $menu_object->name : '');
?>
<? // DRAW MENU ?>
<div class="footer-navigation__column">
    <h3 class="footer-navigation__title"><? echo $menu_name; ?></h3>
    <? footer_first(); ?>
</div>