<?php
//Template name: Update price gold
get_header(); ?>

<?php theBreadcrumb() ?>

	<div class="wrapperDiv page-contact-us page-content">
	<h1 class="section-title my-4">Giá vàng mới nhất hôm nay</h1>
	<p class="section-time">Cập nhật vào lúc: 
                <?php 
                echo theOption('price_page_update_time')
                ?>
            </p>
		<div class="table-wrapper">
			<?php echo theOption('price_page') ?>
		</div>
	</div>

<?php get_footer() ?>