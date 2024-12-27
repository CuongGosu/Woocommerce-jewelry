<?php
//Template name: About us
get_header(); ?>

<section class="brea-page-about">
	<div class="container">
		<div class="row">
			<div class="col-12"> <?php theBreadcrumb() ?></div>
		</div>
	</div>
</section>

  <section class="page-about">
  	<div class="container">
       	 <div class="row">
            <div class="content-about">
                  <?php echo apply_filters('the_content', getOption('noi_dung_lien_he')) ?>
            </div>
		</div>
	</div>

</section>


<?php get_footer() ?>