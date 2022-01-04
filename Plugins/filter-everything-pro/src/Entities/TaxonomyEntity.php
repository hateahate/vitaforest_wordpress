<?php

namespace FilterEverything\Filter;

if ( ! defined('WPINC') ) {
    wp_die();
}

class TaxonomyEntity implements Entity
{
    public $items = [];

    public $excludedTerms = [];

    private $entityName = '';

    private $new_tax_query = [];

    private $postTypes = [];

    public function __construct( $taxName ){
        $this->entityName = $taxName;
        $this->getAllExistingTerms();
        $this->passTermNames();
    }

    public function setPostTypes( $postTypes )
    {
        $this->postTypes = $postTypes;
    }

    public function setExcludedTerms( $excludedTerms )
    {
        $this->excludedTerms = (array) $excludedTerms;
    }

    public function getName()
    {
        return $this->entityName;
    }

    function excludeTerms( $terms )
    {
        $exclude = [];

        if( ! empty( $this->excludedTerms ) ){
            $exclude = $this->excludedTerms;
        }

        // Exclude taxonomy term if it already exists in wp_query
        $wpManager          = Container::instance()->getWpManager();
        $wp_queried_object  = $wpManager->getQueryVar( 'wp_queried_object' );

        if( isset( $wp_queried_object['taxonomy'] ) && $wp_queried_object['taxonomy'] === $this->getName() ){
            $exclude[] = $wp_queried_object['term_id'];
        }

        foreach( $terms as $index => $term ){
            if( in_array( $term->term_id, $exclude ) ){
                unset( $terms[$index] );
            }
        }

        return $terms;
    }

    public function getTermTaxonomyPostsIds( $termTaxonomyIds )
    {
        global $wpdb;

        $query[] = "SELECT DISTINCT {$wpdb->term_relationships}.term_taxonomy_id,{$wpdb->term_relationships}.object_id";
        $query[] = "FROM {$wpdb->term_relationships}";
        $query[] = "WHERE {$wpdb->term_relationships}.term_taxonomy_id IN ('" . implode("','", $termTaxonomyIds) . "')";

        $query = implode(' ', $query);

        $results = $wpdb->get_results($query, ARRAY_A);

        $ids = [];
        foreach ($results as $key => $result) {
            $ids[$result['term_taxonomy_id']][] = $result['object_id'];
        }

        return $ids;
    }

    public function populateTermsWithPostIds( $setId, $post_type )
    {
        $termTaxonomyIds     = [];
        $em                  = Container::instance()->getEntityManager();
        $allWpQueriedPostIds = $em->getAllSetWpQueriedPostIds( $setId );

        foreach ( $this->getAllExistingTerms() as $term ){
            $termTaxonomyIds[] = $term->term_taxonomy_id;
        }

        $termPosts = $this->getTermTaxonomyPostsIds( $termTaxonomyIds );

        foreach( $this->items as $index => $term ){
            if( isset( $termPosts[$term->term_taxonomy_id] ) ){
                $this->items[$index]->posts = array_intersect( $allWpQueriedPostIds, $termPosts[$term->term_taxonomy_id] );
            }else{
                $this->items[$index]->posts = [];
            }
        }

    }

    public function getTerms()
    {
        return $this->excludeTerms( $this->getAllExistingTerms() );
    }

    /**
     * @param int $id term id
     * @return false|object term object of false
     */
    public function getTerm( $id ){
        if( ! $id ){
            return false;
        }

        foreach ( $this->getAllExistingTerms() as $term ){
            if( $id == $term->term_id ){
                return $term;
            }
        }

        return false;
    }

    public function getTermId( $termSlug )
    {
        foreach ( $this->getAllExistingTerms() as $term ){
            if( $termSlug == $term->slug ){
                return $term->term_id;
            }
        }

        return false;
    }

    /**
     * @return array list of term_id and names useful to create Select dropdown
     */
    public function getTermsForSelect( $optionGroup = false )
    {
        $toSelect = [];
        foreach ( $this->getTerms() as $term ) {
            if( $optionGroup ){
                $key = $term->taxonomy.":".$term->term_id;
                $toSelect[$key] = $term->name;
            }else{
                $toSelect[$term->term_id] = $term->name;
            }

        }

        return $toSelect;
    }

    public function getTermsForSelect2()
    {
        $toSelect = [];
        foreach ( $this->getTerms() as $term ) {
            $toSelect[] = array( 'id' => $term->term_id, 'text' =>$term->name );
        }
        return $toSelect;
    }

    public function passTermNames()
    {
        foreach ($this->getAllExistingTerms() as $index => $term ) {
            $this->items[$index]->name = apply_filters( 'wpc_filter_taxonomy_term_name', $term->name, $this->getName() );
        }
    }

    function getAllExistingTerms( $force = false )
    {

        if( empty( $this->items ) || $force ){

            $args = array(
                'taxonomy'      => $this->entityName,
                'hide_empty'    => false,
                'order'         => 'ASC'
            );

            /**
             * Filter terms query $args to allow handle cases with some specific taxonomies
             */
            $args   = apply_filters( 'wpc_filter_term_query_args', $args, 'taxonomy', $this->getName() );
            $result = apply_filters( 'wpc_filter_get_taxonomy_terms', get_terms( $args ), $this->getName() );

            $termsUpdated = [];

            if( ! empty( $result ) && ! is_wp_error( $result ) ) {
                foreach ($result as $i => $termObject) {
                    $termObject->name = apply_filters('wpc_filter_' . $this->getName() . '_term_name', $termObject->name, $termObject);
                    $termsUpdated[$i] = $termObject;
                }

                $this->items = $termsUpdated;
            }

        }

        return $this->items;
    }

    private function getSqlLogicOperator( $filter ){
        if( $filter['logic'] === 'and' ){
            return 'AND';
        } else {
            return 'IN';
        }
    }

    public function isTermAlreadyInQuery( $queried_value, $wp_query ){
        $duplicate = [];

        if ( ! empty( $wp_query->tax_query->queried_terms ) ) {
            $native_query_terms = $wp_query->tax_query->queried_terms;
            $queried_taxonomies = array_keys( $native_query_terms );

            foreach ( $queried_taxonomies as $q_taxonomy ) {
                if( $q_taxonomy === $queried_value['e_name'] ){
                    $query = $native_query_terms[$q_taxonomy];

                    if ( ! empty( $query['terms'] ) ) {
                        if ( 'term_id' == $query['field'] ) {
                            $term = get_term( reset( $query['terms'] ), $q_taxonomy );
                        } else {
                            $term = get_term_by( $query['field'], reset( $query['terms'] ), $q_taxonomy );
                        }

                        if( ! $term || is_wp_error( $term ) ){
                            return false;
                        }

                        foreach( $queried_value['values'] as $filter_slug ){
                            if(  $filter_slug === $term->slug ){
                                $duplicate['taxonomy'] = $q_taxonomy;
                                $duplicate['term']     = $term->slug;
                                return $duplicate;
                            }
                        }
                    }
                }
            }
        }

        return false;
    }

    private function isTheSameTaxQuery( $tax_query_1, $tax_query_2 ){
        $tax_query_1 = $this->normalizeTaxQueryArray($tax_query_1);
        $tax_query_2 = $this->normalizeTaxQueryArray($tax_query_2);

        $diff = array_diff( $tax_query_1, $tax_query_2 );

        if ( empty( $diff ) ){
            return true;
        }

        return false;
    }

    private function normalizeTaxQueryArray( $tax_query ){
        $normalized_tax_query = [];

        if( ! is_array( $tax_query ) || ! isset( $tax_query['taxonomy'] ) ){
            return false;
        }

        if( is_array( $tax_query['terms'] ) ){
            sort( $tax_query['terms'] );
        }

        $normalized_tax_query['taxonomy'] = $tax_query['taxonomy'];
        $normalized_tax_query['field']    = $tax_query['field'];

        if( is_array($tax_query['terms']) ){
            $normalized_tax_query['terms']    = implode( '-', $tax_query['terms'] );
        }else{
            $normalized_tax_query['terms']    = $tax_query['terms'];
        }

        return $normalized_tax_query;
    }

    private function addTaxQueryArray( $tax_query_array ){
        if( ! isset( $tax_query_array['taxonomy'] ) ){
            return false;
        }

        // Do not include posts in children terms
        // because it makes unexpected filter results
        $tax_query_array['include_children'] = false;

        $existing_tax_query = $this->new_tax_query;
        foreach( $existing_tax_query as $index => $present_query ){
            if( $this->isTheSameTaxQuery( $present_query, $tax_query_array ) ){
                return false;
            }
        }

        $this->new_tax_query[] = $tax_query_array;
    }

    /**
     * @return mixed object WP_Query|string;
    */
    public function addTermsToWpQuery($queried_value, $wp_query ){

        if( $term = $this->isTermAlreadyInQuery( $queried_value, $wp_query ) ){
            // It is be better to return 404 result and process it in WpManager
            /**
             * @todo replace with with just false. Or better - show this only in debug mode.
             */
            return 'Term already in query';
        }
        /**
         * @feature Include children should be optionally configured in Settings. Maybe.
        */
        $args = array(
            'taxonomy' => $queried_value['e_name'],
            'field'    => 'slug',
            'terms'    => $queried_value['values'],
            'include_children' => false
        );

        $args['operator'] = $this->getSqlLogicOperator( $queried_value );

        if( isset( $wp_query->tax_query->queries ) && count( $wp_query->tax_query->queries ) ){
            foreach($wp_query->tax_query->queries as $single_tax_query ){
                $this->addTaxQueryArray( $single_tax_query );
            }
        }

        $this->addTaxQueryArray( $args );

        $already_existing_tax_query = $wp_query->get('tax_query');

        if( is_array( $already_existing_tax_query ) ){
            foreach( $already_existing_tax_query as $value ){
                $this->addTaxQueryArray( $value );
            }
        }

        if( count($this->new_tax_query) > 1 ){
            $this->new_tax_query['relation'] = 'AND';
        }

        $wp_query->set('tax_query', $this->new_tax_query );
        $this->new_tax_query = [];

        return $wp_query;
    }
}