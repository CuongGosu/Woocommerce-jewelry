<?php

namespace Theme\Taxonomies;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

use Gaumap\Abstracts\AbstractTaxonomy;

class ProductGold extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'product_gold';
        $this->singular  = $this->plural = __('Loại vàng', 'gaumap');
        $this->postTypes = ['product'];
        $this->slug      = 'loai-vang';
        parent::__construct();
    }
    
    /**
     * Document: https://docs.carbonfields.net/#/containers/term-meta?id=term-meta
     */
    public function metaFields()
    {
      // Container::make('term_meta', __('Category Properties', 'nrglobal'))
      // ->where('term_taxonomy', '=', $this->taxonomy)
      // ->add_fields([
      //    Field::make('image', 'thumb', __('Hình ảnh', 'nrglobal')),

      // ]);
    }
    
}