<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class CategoryBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('product_block', __('Danh mục sản phẩm', 'nrglobal'), __('Hiển thị các danh mục sản phẩm', 'nrglobal'), [
            Field::make('text', 'title_product', __('Tiêu đề', 'nrglobal')),
            Field::make('multiselect', 'product_category', __('Lọc theo danh mục', 'nrglobal'))
                ->set_options(function () {
                    $terms = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false ]);
                    $items = [];
                    $items[0] = __('Tất cả', 'nrglobal');
                    foreach ($terms as $term) {
                        if($term->parent == 0){
                            $items[$term->term_id] = $term->name;
                            $items += get_child_terms($term->term_id, $terms, '--');
                        }
                    }
                    return $items;
                })
        ]);
    }
    
    
    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {
            $filter_type = $instance['product_category']; 
            $tax = 'product_cat';

        if(is_home()){
?>
        <section class="section-top-categories">
          <div class="wrapperDiv">
            <h2 class="section-title"><?php echo $instance['title_product']; ?></h2>

                <?php 
                  if(empty($filter_type) || in_array(0, $filter_type) ){
                    $filters = get_terms($tax,[
                        'hide_empty' => false,
                        'parent' => 0
                    ]);
                    }else{
                        $filters =  $filter_type;
                    }
                  if(!empty($filters)){
                    echo '<div class="swiper categories-swiper">
                              <div class="categories-wrapper swiper-wrapper">';
                              $exclude_id = get_option('default_product_cat');
                     foreach ($filters as $filter) {
                                $term = get_term($filter);
                                if (!is_wp_error($term) && $term && $term->term_id != $exclude_id) {
                                  $thumb_id = get_term_meta($term->term_id, 'thumbnail_id', true);
                                  // Lấy URL hình ảnh
                                  $image_url = $thumb_id ? wp_get_attachment_url($thumb_id) : 'https://example.com/default-image.jpg';
                                    echo '<a class="categories-slide swiper-slide" href="' . esc_url(get_term_link($term->term_id, $tax)) . '">
                                        <figure class="slide-thumbnail">
                                            <img src="' . esc_url($image_url) . '" alt="' . esc_attr($term->name) . '" width="110" height="110" class="object-common" />
                                        </figure>
                                        <div class="slide-content">
                                            <h3 class="slide-title">' . esc_html($term->name) . '</h3>
                                        </div>
                                    </a>';
                                }
                            }
                    echo '       </div>
                                </div>';
                   }
                 ?>
    
          </div>
        </section>
      
<?php
        }
    }
}