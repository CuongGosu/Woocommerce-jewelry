<?php
get_header() ;
global $product;
if (!$product || !is_a($product, 'WC_Product')) {
  $product = wc_get_product(get_the_ID()); // Lấy sản phẩm từ ID hiện tại
}

?>
  
   <section class="section-detail-product">
          <div class="wrapperDiv">
            <div class="product-inner">
              <div class="product-left">
                <?php
                   $gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
                   $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                   $thumbnail_url = wp_get_attachment_url($thumbnail_id);
                   if ($gallery) {
                    $gallery_ids = explode(',', $gallery);
                ?>
                <div class="swiper thumbnail-preview">
                  <div class="swiper-wrapper list-thumbnail-preview">
                  <div class="swiper-slide object-fit preview-item">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Thumbnail Image" />
                  </div>
                  <?php
                // Duyệt qua từng ID hình ảnh trong gallery
                    foreach ($gallery_ids as $attachment_id) {
                        // Lấy URL của hình ảnh tương ứng
                        $image_url = wp_get_attachment_url($attachment_id);

                        if ($image_url) { // Kiểm tra nếu URL tồn tại
                ?>
                <div class="swiper-slide object-fit preview-item">
                  <img src="<?php echo esc_url($image_url); ?>" alt="Gallery Image" />
                </div>
                <?php
                        }
                    }
                ?>
                  </div>
                </div>
                <?php } ?>
                <div class="swiper thumbnail-hero">
                  <div class="swiper-wrapper">
                  <div class="swiper-slide object-fit preview-item">
                     <img src="<?php echo esc_url($thumbnail_url); ?>" alt="Thumbnail Image" />
                 </div>
                  <?php
                     if ($gallery){
                // Duyệt qua từng ID hình ảnh trong gallery
                    foreach ($gallery_ids as $attachment_id) {
                        // Lấy URL của hình ảnh tương ứng
                        $image_url = wp_get_attachment_url($attachment_id);

                        if ($image_url) { // Kiểm tra nếu URL tồn tại
                ?>
                <div class="swiper-slide object-fit slide-image">
                  <img src="<?php echo esc_url($image_url); ?>" alt="Gallery Image" />
                </div>
                <?php
                        }
                    }
                  }
                ?>

                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>
              <div class="product-right">
                <h1 class="title-product"><?php theTitle() ?></h1>
                <?php
                if($product->get_sku()) {
                  ?>
                 <div class="sku-product">
                  <span>SKU: </span>
                    <?php 
                    echo $product->get_sku(); // Hiển thị má SKU            
                    ?>
                  </div>
                  <?php
                }
                ?>
                  <div class="price-product">
                    <span class="price-new">
                    <?php 
                      
                      if ($product) {
                          echo custom_price_html($product->get_price_html(), $product) ;
                      } else {
                          echo 'Giá hiện đang cập nhật';
                      }
                    ?>
                      </span>            
                      <span class="price-subtext">(Giá sản phẩm thay đổi tùy trọng lượng vàng và đá)</span>                   
                </div>
                
                <div class="anchor-link-zalo">
                  <div class="d-flex gap-3 align-items-center">
                    <div class="anchor-text">
                      Gọi <span class="span-icon"><ion-icon name="call-outline"></ion-icon></span>
                    </div>
                    <div class="d-flex gap-1">
                      <a href="tel:<?php theOption('dien_thoai') ?>"><?php theOption('dien_thoai') ?></a>
                      -
                      <a href="tel:<?php theOption('dien_thoai_02') ?>"><?php theOption('dien_thoai_02') ?></a>
                    </div>
                  </div>
                  Chat zalo:
                  <a href="https://zalo.me/<?php theOption('zalo') ?>" target="_blank"><img class="img-lazyload has-shadow" src="/wp-content/uploads/2024/12/tong-hop-25-mau-logo-zalo-dep-va-an-tuong1.png" data-src="" alt="QUAN TÂM ZALO OA PNJ" style="opacity: 1;"></a>
                  để được hỗ trợ tư vấn 24/7
                </div>
              <div class="categories-product">
                  <span>Danh mục: </span>
                  <?php
                  $categories = get_the_terms(get_the_ID(), 'product_cat');
                  if ($categories && !is_wp_error($categories)) {
                    // Hiển thị từng danh mục dưới dạng liên kết
                    $category_links = array_map(function ($category) {
                        // Tạo liên kết đến trang danh mục
                        $category_url = get_term_link($category);
                        return '<a href="' . esc_url($category_url) . '" class="category-link">' . esc_html($category->name) . '</a>';
                    }, $categories);
            
                    // Nối các liên kết bằng dấu " / "
                    echo implode(' / ', $category_links);
                }
                  ?>
              </div>
              <div class="specifications-product">
                  <h3 class="specifications-heading">
                    Thông số kỹ thuật
                  </h3>
            
                    <div class="content-specifications">
                    <?php
                  $product_id = get_the_ID(); // Lấy ID sản phẩm hiện tại
                  $taxonomies = get_object_taxonomies('product', 'objects'); // Lấy danh sách các taxonomy liên quan đến sản phẩm

                  foreach ($taxonomies as $taxonomy) {
                      // Lấy các giá trị (terms) của taxonomy cho sản phẩm này
                      if ($taxonomy->name === 'product_type') {
                        continue;
                    }
                      if ($taxonomy->name === 'product_cat') {
                        continue;
                    }
                    if ($taxonomy->name === 'product_visibility') {
                      continue; 
                  }
                      $terms = get_the_terms($product_id, $taxonomy->name);

                      if ($terms && !is_wp_error($terms)) {
                          // Lấy tên các term và nối bằng dấu ', '
                          $term_names = array_map(function ($term) {
                              return $term->name;
                          }, $terms);
                          $term_values = implode(', ', $term_names);
                          echo '<dl class="specifications-list">';
                          // Render ra HTML
                          echo '<dt class="specifications-title">' . esc_html($taxonomy->label) . ': </dt>';
                          echo '<dd class="specifications-value"> ' . esc_html($term_values) . '</dd>';
                          echo '</dl>';
                        }
                      }
                      ?>
                    </div>        
                  </div> 

                  <div class="form-add-to-cart" >
                    <label>Số lượng :</label>
                    <input type="number" class="form-quantity"id="quantity_<?php echo esc_attr(get_the_ID()); ?>" value="1"  step="1" min="1" max="" name="quantity" />
                    <button class="button-add-to-cart" data-product_id="<?php echo esc_attr(get_the_ID()); ?>">Thêm giỏ hàng</button>
                  </div>
                  <div id="cart-success-popup" class="cart-success-popup">
                  <p>Thêm vào giỏ hàng thành công!</p>
                </div>
                </div>
              </div>
            </div>
          </div>
    </section>
    <section class="section-product-content">
      <div class="wrapperDiv">
        <h2 class="section-title">Mô tả sản phẩm</h2>
        <div class="product-content">
          <?php theContent() ?>
        </div>
      </div>
    </section>
                         
<section class="list-product-primary is-primary">
  <div class="wrapperDiv">
    <h2 class="section-title">Sản phẩm tương tự</h2>
    <div class="swiper product-swiper">
      <div class="swiper-wrapper">
        <?php
        // Lấy các term của taxonomy 'material' cho post hiện tại
        $terms = get_the_terms(get_the_ID(), 'product_cat');
        
        if ($terms && !is_wp_error($terms)) {
            $term_ids = wp_list_pluck($terms, 'term_id');
            
            // Query các bài viết liên quan có cùng 'material'
            $args = [
                'post_type' => 'product',  // Tên post type của bạn
                'posts_per_page' => 8,      // Số lượng bài viết muốn hiển thị
                'post__not_in' => [get_the_ID()],  // Loại trừ bài viết hiện tại
                'tax_query' => [
                    [
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $term_ids,
                    ],
                ],
            ];
            
            $similar_query = new WP_Query($args);
            
            if ($similar_query->have_posts()) :
                while ($similar_query->have_posts()) : $similar_query->the_post(); ?>
                  <div class="swiper-slide similar-slide">
                    <a class="product-slide swiper-slide" href="<?php the_permalink(); ?>">
                      <figure class="product-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                          <?php the_post_thumbnail('medium'); // Hiển thị thumbnail của bài viết ?>
                        <?php endif; ?>
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
                  </div>
                <?php endwhile; 
                wp_reset_postdata();
            else :
                echo '<p>Không có sản phẩm nào cùng loại.</p>';
            endif;
        } else {
            echo '<p>Không có sản phẩm tương ứng.</p>';
        }
        ?>
      </div>
      <div class="button-control swiper-button-next"></div>
      <div class="button-control swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
<?php get_footer() ?>