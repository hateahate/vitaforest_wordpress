<?
// OTHER MENU ARRAY
function other_menu(){
wp_nav_menu(
    array( 
    'menu' => 'header-other',
    'container' => 'ul',
    'menu_class' => 'navigation__list',
    'theme_location' => 'headerother',
	'add_li_class' => 'navigation__main-link-n'
    )
	);
}
?>
<? //DRAW MENU ?>
<? other_menu(); ?>
