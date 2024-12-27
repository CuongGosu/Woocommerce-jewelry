<?php

namespace Theme\Taxonomies;

use Gaumap\Abstracts\AbstractTaxonomy;

class ProductAge extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'product_age';
        $this->singular  = $this->plural = __('Tuổi vàng', 'gaumap');
        $this->postTypes = ['product'];
        $this->slug      = 'tuoi-vang';
        parent::__construct();
    }
    
    /**
     * Document: https://docs.carbonfields.net/#/containers/term-meta?id=term-meta
     */
    public function metaFields()
    {
        // Container::make('term_meta', __('Category Properties'))
        //          ->where('term_taxonomy', '=', $this->taxonomy)
        //          ->add_fields([
        //              Field::make('color', 'crb_title_color', __('Title Color')),
        //              Field::make('image', 'crb_thumb', __('Thumbnail')),
        //          ]);
    }
    
}