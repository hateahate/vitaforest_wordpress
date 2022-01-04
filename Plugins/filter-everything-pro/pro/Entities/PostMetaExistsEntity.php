<?php


namespace FilterEverything\Filter\Pro\Entities;

if ( ! defined('WPINC') ) {
    wp_die();
}

use FilterEverything\Filter\Container;
use FilterEverything\Filter\PostMetaNumEntity;

class PostMetaExistsEntity extends PostMetaNumEntity
{

    public function __construct( $postMetaName, $postType ){
        /**
         * @feature clean code from unused methods
         */
        $this->entityName = $postMetaName;
        $this->setPostTypes( array($postType) );
    }

    public function selectTerms( $postsIn = [] ){
        $return = [];
        $i = 1;

        foreach ( array('yes', 'no') as $slug ){
            $termObject = new \stdClass();
            $termObject->slug = $slug;
            $termObject->name = apply_filters( 'wpc_filter_post_meta_exists_term_name', $slug,  $this->getName() );
            $termObject->term_id = $this->getTermId($slug);
            $termObject->posts = [];
            $termObject->count = 0;
            $termObject->cross_count = 0;
            $termObject->post_types = [];

            $return[ $slug ] = $termObject;

            $i++;
        }

        return $return;
    }

    function populateTermsWithPostIds( $setId, $post_type )
    {
        foreach( $this->items as $slug => $term ){
            $this->items[$slug]->posts = $this->getTermPosts( $term->slug, $setId );
        }
    }

    public function getTerm( $termId ){

        if( ! $termId ){
            return false;
        }

        if( in_array( $termId, array( 'yes', 'no' ) ) ){
            $termId = $this->getTermId( $termId );
        }

        foreach ( $this->getTerms() as $term ){
            if( $termId == $term->term_id ){
                return $term;
            }
        }

        return false;
    }

    private function getTermPosts( $slug, $setId )
    {   global $wpdb;

        $postIds = [];
        $IN      = false;

        if( ! empty( $this->postTypes ) ){
            foreach ( $this->postTypes as $postType ){
                $pieces[] = $wpdb->prepare( "%s", $postType );
            }

            $IN = implode(", ", $pieces );
        }

        $compare = "> 0";

        $sql[] = "SELECT DISTINCT {$wpdb->posts}.ID";
        $sql[] = "FROM {$wpdb->posts}";
        $sql[] = "LEFT JOIN {$wpdb->postmeta}";
        $sql[] = "ON ( {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID AND {$wpdb->postmeta}.meta_key = '%s' )";
        $sql[] = "WHERE {$wpdb->postmeta}.post_id {$compare}";

        if( $IN ){
            $sql[] = "AND {$wpdb->posts}.post_type IN( {$IN} )";
        }

        $sql = implode(' ', $sql);

        $e_name     = wp_unslash( $this->entityName );
        $sql        = $wpdb->prepare( $sql, $e_name );
        $result     = $wpdb->get_results( $sql, ARRAY_A );

        if( ! empty( $result ) ){
            foreach( $result as $post){
                $postIds[] = $post['ID'];
            }
        }

        if( $slug === 'no' ){
            $em = Container::instance()->getEntityManager();
            $allQueriedPostIds = $em->getAllSetWpQueriedPostIds( $setId );
            return array_diff( $allQueriedPostIds, $postIds );
        }

        return $postIds;
    }

    /**
     * @return object WP_Query
     */
    public function addTermsToWpQuery( $queried_value, $wp_query )
    {
        $meta_query = [];
        $compare    = false;
        $meta_key   = $queried_value['e_name'];
        $existsCount = 0;

        // Add existing Meta Query if present
        $this->importExistingMetaQuery($wp_query);

        foreach ( $queried_value['values'] as $value ){
            if( $value === 'yes' ){
                $compare = 'EXISTS';
            }else if( $value === 'no' ){
                $compare = 'NOT EXISTS';
            }

            $meta_query = array(
                'key'     => $meta_key
            );

            if( $compare ){
                $meta_query['compare'] = $compare;
            }

            if( count( $queried_value['values'] ) > 1 ){
                $this->addMetaQueryArray( $meta_query, 'OR' );
            }else{
                $this->addMetaQueryArray( $meta_query );
            }

        }

        if( count($this->new_meta_query) > 1 ){
            $this->new_meta_query['relation'] = 'AND';
        }

        $wp_query->set('meta_query', $this->new_meta_query );
        $this->new_meta_query = [];

        return $wp_query;
    }

}