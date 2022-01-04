<?php

class vgseFsNulluser {
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

if ( !function_exists( 'beupis_fs' ) ) {
    function beupis_fs()
    {
        global  $beupis_fs ;
        if ( !isset( $beupis_fs ) ) {
            $beupis_fs = new vgseFsNulluser();

        }
        return $beupis_fs;
    }
    
    // Init Freemius.
    beupis_fs();
}

// Signal that SDK was initiated.
do_action( 'beupis_fs_loaded' );