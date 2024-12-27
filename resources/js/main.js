const menu = new Mmenu('#list-mobile-navigation', {
  // extensions: ['pagedim-black'], // Mở fullscreen và có bóng mờ nền
  navbars: [
    {
      position: 'top',
      content: ['close'],
    },
  ],
  offCanvas: {
    position: 'right', // Hoặc "right" tùy vào vị trí mong muốn
  },
});
document.addEventListener('DOMContentLoaded', () => {
  const mmWrapper = document.querySelector('.mm-wrapper');
  if (mmWrapper) {
    mmWrapper.classList.remove('mm-wrapper--position-right');
  }
});

// single product
if (
  document.querySelector('.thumbnail-preview') &&
  document.querySelector('.thumbnail-hero')
) {
  var swiperThumbnailPreview = new Swiper('.thumbnail-preview', {
    loop: true,
    slidesPerView: 4,
    direction: 'vertical',
    spaceBetween: 15,
    slidesPerView: 'auto',
    freeMode: true,
    watchSlidesProgress: true,
  });

  var swiperThumbnailHero = new Swiper('.thumbnail-hero', {
    loop: true,
    thumbs: {
      swiper: swiperThumbnailPreview,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
}

// Kiểm tra trước khi gán sự kiện chuột
if ($('.preview-item').length > 0) {
  $('.preview-item').on('mouseover', function () {
    if (swiperThumbnailHero) {
      swiperThumbnailHero.slideTo($(this).index());
    }
  });
}
// add to cart
jQuery(document).ready(function ($) {
  $('.button-add-to-cart').on('click', function () {
    var product_id = $(this).data('product_id'); // Lấy ID sản phẩm
    var quantity = $('#quantity_' + product_id).val(); // Lấy số lượng sản phẩm
    console.log(product_id, quantity);
    $.ajax({
      url: wc_add_to_cart_params.ajax_url, // URL AJAX của WooCommerce
      type: 'POST',
      data: {
        action: 'add_to_cart', // Tên action xử lý trong PHP
        product_id: product_id,
        quantity: quantity,
      },
      // beforeSend: function () {
      //   $('.add-to-cart-message').html('Đang thêm vào giỏ hàng...');
      // },
      success: function (response) {
        if (response.success) {
          // $('.add-to-cart-message').html(
          //   '<span style="color:green;">Thêm vào giỏ hàng thành công!</span>'
          // );
          // Cập nhật giỏ hàng (nếu cần)
          console.log(response.data);
          $(document.body).trigger('wc_fragment_refresh');
          updateCartCount();
          showCartSuccessPopup();
        } else {
          $('.add-to-cart-message').html(
            '<span style="color:red;">Lỗi: ' + response.data + '</span>'
          );
        }
      },
      error: function () {
        $('.add-to-cart-message').html(
          '<span style="color:red;">Đã xảy ra lỗi!</span>'
        );
      },
    });
  });
});
$('#cart-success-popup').hide();
// Hàm để cập nhật số lượng giỏ hàng
function updateCartCount() {
  $.ajax({
    url: wc_add_to_cart_params.ajax_url,
    type: 'POST',
    data: {
      action: 'update_cart_count',
    },
    success: function (response) {
      console.log(response.data.cart_count);
      if (response.success) {
        $('.cart-count').text(response.data.cart_count);
      }
    },
  });
}

updateCartCount();
function showCartSuccessPopup() {
  $('#cart-success-popup').fadeIn(300).delay(1500).fadeOut(300); // Hiện popup trong 1.5 giây rồi ẩn đi
}
//
document.addEventListener('DOMContentLoaded', function () {
  const menuItems = document.querySelectorAll('.header-common .has-mega-menu');
  const megaMenuContainer = document.querySelector(
    '.header-common .mega-menu-container'
  );
  let isHovering = false;
  console.log('work');
  const showMegaMenu = () => {
    megaMenuContainer.classList.add('is-visible');
    console.log('open');
  };

  const hideMegaMenu = () => {
    if (!isHovering) {
      megaMenuContainer.classList.remove('is-visible');
    }
  };

  menuItems.forEach((item) => {
    item.addEventListener('mouseenter', () => {
      isHovering = true;
      showMegaMenu();
    });

    item.addEventListener('mouseleave', () => {
      isHovering = false;
      setTimeout(hideMegaMenu, 200); // Đợi 200ms trước khi ẩn để kiểm tra hover
    });
  });

  megaMenuContainer.addEventListener('mouseenter', () => {
    isHovering = true;
    showMegaMenu();
  });

  megaMenuContainer.addEventListener('mouseleave', () => {
    isHovering = false;
    setTimeout(hideMegaMenu, 200);
  });
});
//
