<?php

if ( ! defined('WPINC') ) {
    wp_die();
}

use FilterEverything\Filter\Pro\Admin\SeoRules;

function flrt_get_seo_rules_fields($post_id )
{
    $seoRules = new SeoRules();
    return $seoRules->getRuleInputs( $post_id );
}

function flrt_create_seo_rules_nonce()
{
    return SeoRules::createNonce();
}