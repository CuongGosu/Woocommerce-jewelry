<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class ProductBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('list_visble_product', __('Danh sách Sản phẩm', 'nrglobal'), __('Hiển thị các sản phẩm', 'nrglobal'), [
          Field::make('checkbox', 'show_sidebar', __('Hiển thị sản phẩm theo kiểu 2', 'nrglobal')),
            Field::make('text', 'main_title', __('Tiêu đề', 'nrglobal')),
            Field::make('image', 'main_image', __('Hình ảnh', 'nrglobal')),
            Field::make('select', 'product_category', __('Lọc theo danh mục', 'nrglobal'))
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
                }),
                Field::make('text', 'limit_per_page', __('Số lượng', 'nrglobal'))

                ->set_default_value(8)

                ->set_attributes(['type' => 'number']),
            Field::make('radio', 'product_style', __('Sắp xếp theo', 'nrglobal'))
                 ->set_options([
                     'feature-product'   => __('Nổi bật', 'nrglobal'),
                     'new-product'       => __('Mới nhất', 'nrglobal'),
                 ]),
        ]);
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {
       
      $product_style = $instance['product_style']; 

      $product_categories = $instance['product_category']; 
        switch ($product_style) {
            case 'new-product':
              $meta_query = [];
               break;
           
            default:
            $meta_query = [
                 [
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                    ],
          ];
                break;
        }
                if ($product_categories == 0) {
          // Không thêm 'tax_query' khi chọn "Tất cả"
          $args = [
              'post_type'      => 'product',
              'post_status'    => 'publish',
              'posts_per_page' => $instance['limit_per_page'],
              'meta_query'     => $meta_query,
          ];
                   $view = get_post_type_archive_link('product');
        } else {
          // Nếu chọn danh mục cụ thể, thêm 'tax_query' vào
          $args = [
              'post_type'      => 'product',
              'post_status'    => 'publish',
              'posts_per_page' => $instance['limit_per_page'],
              'meta_query'     => $meta_query,
              'tax_query'      => [
                  [
                      'taxonomy' => 'product_cat',
                      'field'    => 'term_id',
                      'terms'    => $product_categories,
                      'operator' => 'IN',
                  ],
              ],
          ];
           $view =  get_term_link($product_categories);
        }                              
        $listProduct = new \WP_Query($args);
        // dump($listProduct);
        if(is_home()){
?>
           <?php if( $instance['show_sidebar'] == 0 ) { ?>
      <section class="list-product-primary is-primary">
          <div class="wrapperDiv">
            <h2 class="section-title"><?php echo $instance['main_title'] ?></h2>
            <figure class="product-banner">
              <img
                src="<?php echo  getImageUrlById($instance['main_image']) ?>"
                class="object-common"
              />
            </figure>
            <div class="swiper product-swiper">
              <div class="swiper-wrapper">
                <?php
                      if($listProduct->have_posts()){
                          while($listProduct->have_posts()): $listProduct->the_post();
                              ?>
                              <a class="product-slide swiper-slide" href="<?php echo get_the_permalink() ?>">
                                <figure class="product-thumbnail">
                                  <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title()?>" />
                                </figure>
                                <div class="product-content">
                                  <h3 class="product-title">
                                  <?php echo get_the_title()?>
                                  </h3>
                                  <div class="product-price"><?php 
                                  global $product;  
                                  $product = wc_get_product(get_the_ID()); 
                                  echo custom_price_html($product->get_price_html(), $product) ?>
                                  </div>
                                </div>
                            </a>
                              <?php
                          endwhile;
                          wp_reset_postdata();
                          wp_reset_query();
                      }           
                  ?>
              </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
            <a class="btn-more" href="<?php echo $view ?>">Xem thêm</a>
          </div>
        </section>
        <?php
      }
      else{
        ?>
        <section class="list-product-primary is-secondary">
          <div class="wrapperDiv">
            <h2 class="section-title"><?php echo $instance['main_title'] ?></h2>
            <div class="list-product-inner">
              <figure class="product-banner pc">
                <img
                  src="<?php echo  getImageUrlById($instance['main_image']) ?>"
                  class="object-common"
                />
              </figure>
              <div class="swiper product-swiper list-product-pc">
                <div class="swiper-wrapper">
                <?php
                      if($listProduct->have_posts()){
                          while($listProduct->have_posts()): $listProduct->the_post();
                              ?>
                              <a class="product-slide swiper-slide" href="<?php echo get_the_permalink() ?>">
                                <figure class="product-thumbnail">
                                  <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title()?>" />
                                </figure>
                                <div class="product-content">
                                  <h3 class="product-title">
                                  <?php echo get_the_title()?>
                                  </h3>
                                  <div class="product-price"><?php 
                                  global $product;  
                                  $product = wc_get_product(get_the_ID()); 
                       
                                  echo custom_price_html($product->get_price_html(), $product) ?>
                                  
                                  </div>
                                </div>
                            </a>
                              <?php
                          endwhile;
                          wp_reset_postdata();
                          wp_reset_query();
                      }           
                  ?>
     
                  
                </div>
                <div class="swiper-button-next">
                  <span class="span-icon">
                    <ion-icon class="icon-next" name="chevron-forward-outline"></ion-icon>
                  </span>
                </div>
                <div class="swiper-button-prev">
                  <span class="span-icon">
                    <ion-icon class="icon-prev" name="chevron-back-outline"></ion-icon>
                  </span>
                </div>
              </div>
              </div>
            <a class="btn-more" href="#">Xem thêm</a>
          </div>
        </section>
      <?php
      }
        }
    }
}