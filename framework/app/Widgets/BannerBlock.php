<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class BannerBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('banner_block', __('Danh sách ảnh banner', 'nrglobal'), __('Hiển thị các ảnh banner', 'nrglobal'), [
            Field::make('complex', 'main_banner', __('Ảnh ', 'nrglobal'))
            ->set_layout('tabbed-horizontal')// grid, tabbed-vertical
            ->add_fields([
                Field::make('image', 'image', __('Hình ảnh', 'nrglobal')),
                Field::make('text', 'link', __('Link url', 'nrglobal')),
            ])->set_max(6),
        ]);
    }
    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {
  
        if(is_home()){
?>
        <section class="section-top-brand">
          <div class="wrapperDiv">
            <div class="swiper brand-swiper">
              <div class="brand-wrapper swiper-wrapper">
              <?php
                if($instance['main_banner']){
                  foreach($instance['main_banner'] as $main_banner){
                ?>
                <a class="brand-slide swiper-slide">
                  <figure class="slide-thumbnail">
                    <img
                      src="<?php echo getImageUrlById($main_banner['image']) ?>"
                      class="object-common"
                    />
                  </figure>
                </a>
                <?php
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </section>
        <?php
        }
    }
}