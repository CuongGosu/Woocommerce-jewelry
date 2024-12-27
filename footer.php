<footer class="footer-section">
        <div class="wrapperDiv">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="cta-text">
                                <h4>Địa chỉ</h4>
                                <span><?php theOption('dia_chi') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone"></i>
                            <div class="cta-text">
                                <h4>Tư vấn</h4>
                                <span><?php theOption('dien_thoai') ?> / <?php theOption('dien_thoai_02') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4>Email</h4>
                                <span><?php theOption('email') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 mb-50">
                        <div class="footer-widget ab-ftwg">
                            <div class="footer-logo">
                                <a href="/"><img src="<?php echo wp_get_attachment_url(getOption('desktop_logo'))?>" class="img-fluid" alt="logo"></a>
                            </div>
                            <div class="footer-text">
                                <p><?php echo apply_filters( 'the_content', getOption('short_intro')) ?></p>
                            </div>
                        </div>
                    </div>
                     <div class="col-xl-2 col-lg-2 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3><span><?php _e(get_nav_name('gm-footer')) ?></span></h3>
                            </div>
                            <?php
                                                            wp_nav_menu([
                                                                'menu'           => 'gm-footer',
                                                                'theme_location' => 'gm-footer',
                                                                'container'      => false,
                                                                'menu_class' => 'footer-text',
                                                                'depth' => 1,
                                                            ])
                                                        ?>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-30">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3><span><?php _e(get_nav_name('gm-footer-02')) ?></span></h3>
                            </div>
                            <?php
                                                            wp_nav_menu([
                                                                'menu'           => 'gm-footer-02',
                                                                'theme_location' => 'gm-footer-02',
                                                                'container'      => false,
                                                                'menu_class' => 'footer-text',
                                                                'depth' => 1,
                                                            ])
                                                        ?>
                            <div class="footer-widget-heading">
                                <h3><span><?php _e(get_nav_name('gm-footer-03')) ?></span></h3>
                            </div>
                            <?php
                                                            wp_nav_menu([
                                                                'menu'           => 'gm-footer-03',
                                                                'theme_location' => 'gm-footer-03',
                                                                'container'      => false,
                                                                'menu_class' => 'footer-text',
                                                                'depth' => 1,
                                                            ])
                                                        ?>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-50">
                        <div class="footer-widget">
                            <div class="footer-widget-heading">
                                <h3><span>Kết nối với chúng tôi</span></h3>
                            </div>
                            <div class="connect-us-outer"> 
                                <a class="connect-link" aria-label="PNJ Faceboo" rel="nofollow noopener" target="_blank" href="/" title="PNJ Facebook" alt="PNJ Facebook"> <i> <img class="img-lazyload" data-src="" alt="Facebook" src="/wp-content/uploads/2024/12/hinh-anh2024-12-03101314524.png" style="opacity: 1;"> </i> </a>
                                <a class="connect-link" aria-label="Instagram" rel="nofollow noopener" target="_blank" href="/" title="Instagram" alt="Instagram"> <i> <img class="img-lazyload" data-src="" alt="Instagram" src="/wp-content/uploads/2024/12/hinh-anh2024-12-03101324069.png" style="opacity: 1;"> </i> </a>
                                <a class="connect-link" aria-label="Youtube" rel="nofollow noopener" target="_blank" href="/" title="Youtube" alt="Youtube"> <i> <img class="img-lazyload" data-src="" alt="Youtube" src="/wp-content/uploads/2024/12/hinh-anh2024-12-03101329229.png" style="opacity: 1;"> </i> </a> 
                                <a class="connect-link" aria-label="Youtube" rel="nofollow noopener" target="_blank" href="/" title="Email" alt="Email"> <i> <img class="img-lazyload" data-src="" alt="Email" src="/wp-content/uploads/2024/12/hinh-anh2024-12-03101333901.png" style="opacity: 1;"> </i> </a> </div>
                            </div>
                            <div class="footer-widget-heading">
                                <h3><span>Quan tâm Zalo OA HKN</span></h3>
                                <p>Nhận các thông tin khuyến mãi hấp dẫn</p>
                                <a href="https://zalo.me/<?php theOption('zalo') ?>" target="_blank"><img class="img-lazyload has-shadow" src="/wp-content/uploads/2024/12/hinh-anh2024-12-03102102976.png" data-src="" alt="QUAN TÂM ZALO OA PNJ" style="opacity: 1;"></a>
                            </div>
                            <div class="footer-widget-heading ft-bando">
                                <h3><span>Google Map</span></h3>
                                <p><?php theOption('ban_do_cong_ty') ?></p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright © 2024 <a href="/">Tiệm Vàng Hoa Kim Nguyên</a>. Thiết kế và vận hành website: <a href="https://nrglobal.vn" target="_blank" rel="nofollow" style="text-decoration: underline;text-underline-position: under;">NR Global</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Terms</a></li>
                                <li><a href="#">Privacy</a></li>
                                <li><a href="#">Policy</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<?php wp_footer() ?>
</div>

<script>


</script>
</body>

</html>