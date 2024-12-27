<?php

namespace Theme\Taxonomies;

use Gaumap\Abstracts\AbstractTaxonomy;

class ProductStone extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'product_stone';
        $this->singular  = $this->plural = __('Đính đá', 'gaumap');
        $this->postTypes = ['product'];
        $this->slug      = 'dinh-da';
        parent::__construct();
    }
    
    /**
     * Document: https://docs.carbonfields.net/#/containers/term-meta?id=term-meta
     */
    public function metaFields()
    {

    }
    
}