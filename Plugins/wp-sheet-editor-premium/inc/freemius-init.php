<?php

class vgseFsNull {
    public function checkout_url() {
        return '';
    }

    public function get_account_url() {
        return '';
    }

    public function can_use_premium_code__premium_only() {
        return true;
    }
}
// Create a helper function for easy SDK access.
if ( !function_exists( 'vgse_freemius' ) ) {
    function vgse_freemius()
    {
        global  $vgse_freemius ;
        
        if ( !isset( $vgse_freemius ) ) {
            $vgse_freemius = new vgseFsNull();
        }
        
        return $vgse_freemius;
    }

}
// Init Freemius.
vgse_freemius();
// Signal that SDK was initiated.
do_action( 'vgse_freemius_loaded' );