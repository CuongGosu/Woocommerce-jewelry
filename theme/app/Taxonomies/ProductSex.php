<?php

namespace Theme\Taxonomies;

use Gaumap\Abstracts\AbstractTaxonomy;

class ProductSex extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'product_sex';
        $this->singular  = $this->plural = __('Giới tính', 'gaumap');
        $this->postTypes = ['product'];
        $this->slug      = 'gioi-tinh';
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