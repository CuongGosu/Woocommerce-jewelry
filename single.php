<?php get_header() ?>
<?php get_header(); updateViewCount(get_the_ID()) ?>
<main class="wrapper">
    <section id="content-blog">
        <div class="wrapperDiv">
             <div class="blog-inner">
                    <div class="inner-content">
                            <div >
                                <h1 class="blog-title"><?php the_title() ?></h1>
                                <div class="information">
                                      <i class="fa-light fa-user"></i> <?php the_author() ?> | <i class="fal fa-eye"></i> <?php echo get_post_meta(get_the_ID(), '_gm_view_count', true) + 5000 ?> | <?php the_time('d/m/Y') ?>
                                </div>

                            </div>
                            <figure>    
                                <img src="<?php the_post_thumbnail_url()?>" alt="<?php the_title() ?>" width="100%" height="auto">
                            </figure>
                            <div class="blog-content" >
                                <?php echo apply_filters( 'the_content', the_content()) ?>
                                </br>
                                <div class="share-blog">Share: <?php template('parts/share-box') ?></div>
                            </div>
                    </div>
                    <div class="inner-sidebar">
                        <h2 class="sidebar-title">Bài viết liên quan</h2>
                        <ul class="list-sidebar">                 
                            <?php 
                                    $query = getRelatePost(get_the_ID(), 4  );
                                    if ($query->have_posts()):
                            while($query->have_posts()) : $query->the_post(); ?>
                            <li class="sidebar-item">
                                <a  href="<?php the_permalink() ?>" class="item-box">
                                    <figure class="item-thumbnail">
                                        <img class="object-common" src="<?php the_post_thumbnail_url()?>" alt="<?php the_title() ?>" width="100" height="100">
                                    </figure>
                                    <div class="item-content">
                                         <h3><?php the_title()?></h3>
                                        <time datetime="<?php the_time('d/m/Y') ?>"><?php the_time('d/m/Y') ?></time>
                                    </div>
                                </a>
                            </li>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                                wp_reset_query();
                            ?>
                        </ul>
                    </div>
             </div>
        </div>
    </section>

    <?php endif; ?>
</main>
<?php get_footer() ?>