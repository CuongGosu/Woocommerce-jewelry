<div class="product-item">
  <a class="product-box" href="<?php the_permalink() ?>">
    <figure class="product-thumbnail">
      <img width="200" height="200"  src="<?php thePostThumbnailUrl(); ?>" alt=" <?php the_title() ?>" loading="lazy"/>
    </figure>
                  <div class="product-content">
                    <h3 class="product-title">
                      <?php the_title() ?>
                    </h3>
                    <div class="product-price">
                      <?php
                       global $product;
                       echo custom_price_html($product->get_price_html(), $product)
                      ?>
                    </div>
                  </div>
</a>
</div>