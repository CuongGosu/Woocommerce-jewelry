var loader = `<div class=\"gm-loader\" style="position:fixed;z-index:99999999;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;background-color:rgba(0,0,0,0.51)"><div class=\"windows8\"> <div class=\"wBall\" id=\"wBall_1\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_2\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_3\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_4\"> <div class=\"wInnerBall\"> </div> </div> <div class=\"wBall\" id=\"wBall_5\"> <div class=\"wInnerBall\"> </div> </div> </div></div>`;
$('#contact_form').submit(function (e) {
  e.preventDefault();
  let form = $(this);
  form.validate();
  if (form.valid()) {
    $('body').append(loader);
    $.post(
      $(this).attr('action'),
      {
        action: 'send_contact_form',
        _token: $(this).find('[name="_token"]').val(),
        name: $(this).find('[name="name"]').val(),
        email: $(this).find('[name="email"]').val(),
        phone_number: $(this).find('[name="phone_number"]').val(),
        subject: $(this).find('[name="subject"]').val(),
        message: $(this).find('[name="message"]').val(),
      },
      function (response) {
        if (response.success === true) {
          var contact_danger = document.getElementById('contact_danger').value;
          var contact_success =
            document.getElementById('contact_success').value;
          swal(contact_danger, contact_success, 'success');
          form.trigger('reset');
        } else {
          var contact_waring = document.getElementById('contact_waring').value;
          var contact_error = document.getElementById('contact_error').value;
          swal(contact_waring, contact_error, 'error');
        }
        $(document).find('.gm-loader').remove();
      }
    );
  }
});
var swiperBanner = new Swiper('.slide_swp', {
  autoplay: {
    delay: 40000,
  },
  loop: true,
  spaceBetween: 30,
  // effect: 'fade',
  pagination: {
    clickable: true,
  },
});
// swiper categories
var swiperCategories = new Swiper('.categories-swiper', {
  loop: true,
  spaceBetween: 30,
  slidesPerView: 7,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    1560: {
      slidesPerView: 7,
      spaceBetween: 20,
    },
    1260: {
      slidesPerView: 6,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 5,
    },
    // 767: {
    //   slidesPerView: 4,
    // },
    560: {
      slidesPerView: 4,
    },
    320: {
      slidesPerView: 3,
    },
  },
});
// slide product
var swiperProductPrimary = new Swiper('.is-primary .product-swiper', {
  loop: true,
  spaceBetween: 30,
  slidesPerView: 5,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  breakpoints: {
    1260: {
      slidesPerView: 5,
    },
    1024: {
      slidesPerView: 4,
    },
    767: {
      slidesPerView: 3,
    },
    560: {
      slidesPerView: 2,
    },
    320: {
      slidesPerView: 2,
    },
  },
});
// slide product 2
var swiperProductSecondary = new Swiper('.is-secondary .product-swiper', {
  loop: true,
  spaceBetween: 20,
  slidesPerView: 3,
  grid: {
    rows: 2,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    // Dưới 768px (mobile)
    768: {
      slidesPerView: 3, // Chỉ hiển thị 1 slide mỗi lần
      grid: {
        rows: 2, // Loại bỏ chế độ lưới
      },
    },
    320: {
      slidesPerView: 2,
      grid: {
        rows: 1, // Loại bỏ chế độ lưới
      },
    },
  },
});
// brand swiper
var swiperBrand = new Swiper('.brand-swiper', {
  loop: true,
  spaceBetween: 30,
  slidesPerView: 3,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    1260: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 2,
    },
    767: {
      slidesPerView: 2,
    },
    560: {
      slidesPerView: 2,
    },
    320: {
      slidesPerView: 1,
    },
  },
});
// blog swiper
var swiperBlog = new Swiper('.swiper-blog', {
  spaceBetween: 30,
  slidesPerView: 4,
  // navigation: {
  //   nextEl: '.swiper-button-next',
  //   prevEl: '.swiper-button-prev',
  // },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    1024: {
      slidesPerView: 4,
    },
    767: {
      slidesPerView: 3,
    },
    560: {
      slidesPerView: 2,
    },
    320: {
      slidesPerView: 1,
    },
  },
});

var swiperBlogLQ = new Swiper('.blog-wrapper-lienquan', {
  slidesPerView: 2,
  spaceBetween: 20,
  breakpoints: {
    // when window width is >= 320px
    765: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  },
});
