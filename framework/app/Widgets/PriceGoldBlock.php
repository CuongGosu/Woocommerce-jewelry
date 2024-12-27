<?php

namespace Gaumap\Widgets;

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class PriceGoldBlock extends Widget
{
    // Register widget function. Must have the same name as the class
    function __construct()
    {
        $this->setup('gold_block', __('Bảng giá vàng hôm nay', 'nrglobal'), __('Hiển thị bảng giá các loại vàng hôm nay', 'nrglobal'), [
          Field::make('text', 'main_title', __('Tiêu đề', 'nrglobal')),
        ]);
    }
    // Called when rendering the widget in the front-end
    function front_end($args, $instance)
    {
  
        if(is_home()){
?>
        <section class="section-top-gold">
          <div class="wrapperDiv">
              <h2 class="section-title"><?php echo $instance['main_title'] ?></h2>
              <p class="section-time">Cập nhật vào lúc: 
                <?php 
                echo theOption('price_page_update_time')
                ?>
            </p>


              <div class="table-wrapper">

                <?php echo theOption('price_page') ?>
              </div>
          </div>
        </section>
        <?php
        }
    }
}