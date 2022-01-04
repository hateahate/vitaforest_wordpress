<?php



if ( ! defined('ABSPATH')) exit;  // if direct access 


	
	
	
function breadcrumb_themes_css($theme){

    $breadcrumb_themes_css = array();
    $breadcrumb_bg_color = get_option('breadcrumb_bg_color','#278df4');

    ob_start();
    ?>
    <?php

    $breadcrumb_themes_css['theme1'] = ob_get_clean();


    ob_start();

    ?>
    <?php

    $breadcrumb_themes_css['theme2'] = ob_get_clean();



    ob_start();

    ?>
    <?php

    $breadcrumb_themes_css['theme3'] = ob_get_clean();


    ob_start();

    ?>
   
    <?php

    $breadcrumb_themes_css['theme4'] = ob_get_clean();



    ob_start();

    ?>
    
    <?php

    $breadcrumb_themes_css['theme5'] = ob_get_clean();

    $breadcrumb_themes_css = apply_filters('breadcrumb_themes_css', $breadcrumb_themes_css);

    //echo '<pre>'.var_export($breadcrumb_themes_css, true).'</pre>';

    return isset($breadcrumb_themes_css[$theme]) ? $breadcrumb_themes_css[$theme] : '';
						
				
				

}
	
	
	
	