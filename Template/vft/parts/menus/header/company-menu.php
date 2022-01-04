<?
// COMPANY MENU ARRAY
function company_menu(){
wp_nav_menu(
    array( 
    'menu' => 'header-company',
    'container' => 'ul',
    'menu_class' => 'navigation-subcategory__list',
    'theme_location' => 'headercompany'
    )
	);
}
?>
<?
// GET MENU NAME
$menu_location = 'headercompany';
$menu_locations = get_nav_menu_locations();
$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
$menu_name = (isset($menu_object->name) ? $menu_object->name : '');
?>
<? //DRAW MENU ?>
<li class="navigation__subcategory navigation-subcategory" id="company-dropdown">
<? company_menu(); ?>
</li>