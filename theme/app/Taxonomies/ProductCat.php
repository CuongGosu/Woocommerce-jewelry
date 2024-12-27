<?php

namespace Theme\Taxonomies;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Gaumap\Abstracts\AbstractTaxonomy;

class ProductCat extends AbstractTaxonomy
{
    
    public function __construct()
    {
        $this->taxonomy  = 'product_cat';
        $this->singular  = $this->plural = __('Danh mục sản phẩm', 'gaumap');
        $this->postTypes = ['product'];
        $this->slug      = 'danh-muc-san-pham';
        parent::__construct();
    }
    
    /**
     * Document: https://docs.carbonfields.net/#/containers/term-meta?id=term-meta
     */
    public function metaFields()
    {
        Container::make('term_meta', __('Hình ảnh danh mục'))
                 ->where('term_taxonomy', '=', $this->taxonomy)
                 ->add_fields([
                     Field::make('image', 'thumb', __('Thumbnail')),
                 ]);
    }
    
}