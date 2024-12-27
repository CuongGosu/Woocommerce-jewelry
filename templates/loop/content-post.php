<a class="blog-slide" href="<?php echo get_the_permalink(); ?>">
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