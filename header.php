<!doctype html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head() ?>
</head>
<body>
  <div class="page-content">
     <header class="header-common">
      <!-- <div class="header-top-info">
        <div class="wrapperDiv">
            <div class="header-left">
              <a href="https://maps.app.goo.gl/9dGe5oLckBRF85pU6" target="_blank">
                    <span class="span-icon">

                    <ion-icon name="location-outline"></ion-icon>
                    </span>
                    Vị trí cửa hàng
              </a>
                <span class="header-time">
                    <span class="span-icon">

                      <ion-icon name="time-outline"></ion-icon>
                    </span>
                    <?php echo getOption('time_work') ?>
                  </span>
            </div>
            <div class="header-right">
            </div>
        </div>
      </div> -->
        <div class="header-top">
          <div class="wrapperDiv">
            <div >
               <div class="header-left">
                <a class="header-anchor" href="/tra-cuu-gia-vang" target="_blank">
                 
                  <span class="span-icon">
                   <ion-icon name="logo-usd"></ion-icon>
                  </span>
                  <span class="span-text"> Tra cứu giá vàng</span>
                </a>
            </div>
          </div>
          <div >
            <a class="trans logo-header-primary" href="/">
              <img
              class="object-common"
              src="<?php echo wp_get_attachment_url(getOption('desktop_logo'))?>"
            alt="<?php echo getOption('ten_cong_ty') ?>"
              />
                  </a>
          </div>
          <div>
            <div class="header-right">
            <a href="tel:<?php echo getOption('dien_thoai') ?>" target="_blank" class="header-phone">
                    <span class="span-icon">
                      <ion-icon name="call-outline"></ion-icon>
                    </span>
                    <?php echo getOption('dien_thoai') ?>
                  </a>
              <a class="header-cart" href="/gio-hang">
                <ion-icon name="cart-outline"></ion-icon>
                 <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
              Giỏ hàng
              </a>
            </div>
          </div>
         </div>
        </div>
          <div class="header-bottom">
            <div class="wrapperDiv">
              <nav class="header-list-navigation">
                <?php 
                  	wp_nav_menu([
                      'menu'           => 'gm-primary',
                      'theme_location' => 'gm-primary',
                      'container'      => false,
                      'menu_class' => 'list-navigation',
                      'walker'         => new Gaumap\Walkers\CustomMenuWalker()
                    ])
                ?>
               
              </nav>
              <form class="header-form-search" action="/" method="get">
                  <input type="hidden" name="post_type" value="product">
                <input type="text" name="s" class="form-control" placeholder="Tìm kiếm"/>
                <ion-icon name="search" class="icon-search"></ion-icon>
              </form>
                      
           </div>
          </div>
   
      </header>
  	  <header class="header-mobile">
     <div class="wrapperDiv">
          <div class="header-top">
            <a class="trans logo-header-primary" href="/">
              <img
                class="object-common"
              src="<?php echo wp_get_attachment_url(getOption('desktop_logo'))?>"
              alt="<?php echo getOption('ten_cong_ty') ?>"
              />
            </a>
            <form class="header-form-search" method="get">
                <input type="hidden" name="post_type" value="product">
                <input type="text" name="s" class="form-control" placeholder="Tìm kiếm"/>
              <ion-icon name="search" class="icon-search"></ion-icon>
            </form>
          </div>
        </div>
        <div class="header-bottom">
          <div class="wrapperDiv">
            <div class="header-bar">
              <ul class="list-bar">
                <li>
                  <a class="item-box" href="/">
                    <span class="box-icon">
                      <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="box-title">Trang chủ</span>
                  </a>
                </li>
                <li>
                  <a class="item-box" href="#">
                    <span class="box-icon">
                      <ion-icon name="call-outline"></ion-icon>
                    </span>
                    <span class="box-title">Tư vấn</span>
                  </a>
                </li>
                <li>
                  <a class="item-box header-cart" href="/gio-hang">
                    <span class="box-icon">
                      <ion-icon name="cart-outline"></ion-icon>
                    </span>
                    <span class="box-title">Giỏ hàng
                     <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                     </span>
                  </a>
                </li>
                <li>
                  <a class="item-box" href="#list-mobile-navigation">
                    <span class="box-icon">
                      <ion-icon name="menu-outline"></ion-icon>
                    </span>
                    <span class="box-title">Danh mục</span>
                  </a>
                </li>
              </ul>
            </div>
            <nav class="list-mobile-navigation" id="list-mobile-navigation">
                <?php 
                  	wp_nav_menu([
                      'menu'           => 'gm-primary',
                      'theme_location' => 'gm-primary',
                      'container'      => false,
                      'menu_class' => 'list-navigation',
                      'walker'         => new Gaumap\Walkers\CustomMenuWalker()
                    ])
                ?>

            </nav>
          </div>
        </div>
    </header>