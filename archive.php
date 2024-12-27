<?php get_header() ?>
<main>
<section class="section-archive-post">
          <div class="wrapperDiv">
          <?php theBreadcrumb() ?>
            <ul class="list-post">
            <?php

                  if(have_posts()){

                      while(have_posts()): the_post();

                          template('loop/content-post');

                      endwhile;

                      wp_reset_postdata();

                      wp_reset_query();
                  }
                  ?>
            </ul>
            <div class="section-archive-pagination">
            <?php thePagination() ?>
            </div>
          </div>
        </section>
      </main>
<?php get_footer() ?>