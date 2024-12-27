<section>
<div class="swiper slide_swp">
    <div class="swiper-wrapper">
      <?php
      $sliders = getOption('main_slider');
      foreach($sliders as $item){
        ?>
      <div class="swiper-slide"><img src="<?php echo wp_get_attachment_url($item ['image']) ?>" alt=""></div>
      <?php } ?>
    </div>
  
  </div>
</section>