<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

use function PHPSTORM_META\type;

class BlogBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('blog_block', __('Danh sách bài viết', 'nrglobal'), __('Hiển thị các tin tức', 'nrglobal'), [
          Field::make('text', 'main_title', __('Tiêu đề chính', 'nrglobal')),
          Field::make('multiselect', 'blog_category', __('Lọc theo danh mục', 'nrglobal'))
          ->set_options(function () {
              $terms = get_terms(['taxonomy' => 'category', 'hide_empty' => false ]);
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
          Field::make('text', 'blog_per_page', __('Số lượng', 'nrglobal'))
          ->set_default_value(8)
          ->set_attributes(['type' => 'number']),
            Field::make('radio', 'blog_style', __('Sắp xếp theo', 'nrglobal'))

                  ->set_options([

                      'feature-blog'   => __('Nổi bật', 'nrglobal'),

                      'new-blog'       => __('Mới nhất', 'nrglobal'),
            ]),
        ]);
    }

    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {
      $blog_style = $instance['blog_style']; 
      $blog_category = $instance['blog_category']; 

      switch ($blog_style) {
          case 'new-blog':
              $meta_query = [];
             break;
         
          default:
              $meta_query[] = [

                array(

                    'key'     => '_is_feature',

                    'value'   => 'yes',

                )

            ];  
              break;
      }
      // Kiểm tra nếu trong mảng có chứa giá trị 0 (tức là chọn "Tất cả")
      if (in_array(0, $blog_category)) {
        // Không thêm 'tax_query' khi chọn "Tất cả"
        $args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $instance['blog_per_page'],
            'meta_query'     => $meta_query,
        ];
      } else {
        // Nếu chọn danh mục cụ thể, thêm 'tax_query' vào
        $args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => $instance['blog_per_page'],
            'meta_query'     => $meta_query,
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $blog_category,
                    'operator' => 'IN',
                ],
            ],
        ];
      }
       $listBlog = new \WP_Query($args);
        if (is_home()) {
            ?>
        <section class="section-top-blog">
          <div class="wrapperDiv">
            <h2 class="section-title"><?php echo $instance['main_title']; ?></h2>
            <div class="swiper-blog swiper">
              <div class="swiper-wrapper">
              <?php
                  if($listBlog->have_posts()){
                      while($listBlog->have_posts()){
                      $listBlog->the_post();
                      ?>
                  <a class="blog-slide swiper-slide" href="<?php echo get_the_permalink(); ?>">
                    <figure class="blog-thumbnail">
                      <img class="object-common" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>" />
                    </figure>
                    <div class="blog-content">
                      <h3 class="blog-title">
                        <?php echo get_the_title(); ?>
                      </h3>
                      <p class="blog-excerpt">
                        <?php echo get_the_excerpt(); ?>
                      </p>
                    </div>
                   </a>
                      <?php          
                      }

                      wp_reset_postdata();
                      wp_reset_query();
                  }
                ?>
                </div>
              <div class="swiper-pagination"></div>
            </div>
           <a href="<?php echo $instance['link_blog']; ?>" class="btn-more">Xem tất cả</a>
          </div>
        </section>
            <?php
        }
    }
}
