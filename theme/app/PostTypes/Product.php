<?php

namespace Theme\PostTypes;

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Gaumap\Abstracts\AbstractPostType;

class Product extends AbstractPostType
{
    public function __construct()
    {
        $this->showThumbnailOnList = true;
        $this->supports            = [
            'title',
            'editor',
            'author',
            'comments',
            'thumbnail',
            'excerpt',
        ];
        $this->menuIcon            = 'dashicons-products';
        $this->capalityType        = 'product';
        $this->post_type           = 'product';
        $this->singularName        = $this->pluralName = __('Sản phẩm', 'nrglobal');
        $this->titlePlaceHolder    = __('Tiêu đề', 'nrglobal');
        $this->slug                = 'san-pham';
       // parent::__construct();
        $this->metaFields();
    }
    
    /**
     * Document: https://docs.carbonfields.net/#/containers/post-meta
     */
    public function metaFields()
    {
        Container::make('post_meta', __('Cài đặt chung', 'nrglobal'))
                 ->set_context('normal')// normal, advanced, side or get_set_context_value = carbon_fields_after_title
                 ->set_priority('high')// high, core, default or low
                 ->where('post_type', 'IN', [$this->post_type])
                 ->add_fields([
                    // Field::make('rich_text', 'advise', __('Lời khuyên', 'nrglobal')),
                    // Field::make('rich_text', 'why_choose', __('Lý do chọn sản phẩm', 'nrglobal')),
                 ]);
    }
}