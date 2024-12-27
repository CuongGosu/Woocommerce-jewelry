document.addEventListener('DOMContentLoaded', function () {
  const filterLinks = document.querySelectorAll('.filter-link');

  filterLinks.forEach((link) => {
    link.addEventListener('click', function (e) {
      e.preventDefault();

      const li = this.parentElement;
      const taxonomy = li.getAttribute('data-taxonomy');
      const value = li.getAttribute('data-value');
      const isChecked = li.classList.contains('checked');

      // Lấy các query vars hiện tại từ URL
      const params = new URLSearchParams(window.location.search);
      const currentFilters = params.get(taxonomy)
        ? params.get(taxonomy).split(',')
        : [];

      // Thêm hoặc xóa giá trị khỏi query vars
      if (isChecked) {
        const index = currentFilters.indexOf(value);
        if (index > -1) currentFilters.splice(index, 1);
        li.classList.remove('checked');
      } else {
        currentFilters.push(value);
        li.classList.add('checked');
      }

      // Cập nhật query vars
      if (currentFilters.length > 0) {
        params.set(taxonomy, currentFilters.join(','));
      } else {
        params.delete(taxonomy);
      }

      // Đặt pagination về trang 1
      const currentUrl = new URL(window.location.href);
      let newPathname = currentUrl.pathname.replace(/\/page\/\d+\//, '/');

      // Loại bỏ `product_cat` nếu đang ở trang danh mục
      const categoryMatch = currentUrl.pathname.match(
        /\/danh-muc-san-pham\/([^/]+)/
      );
      if (categoryMatch) {
        params.delete('product_cat'); // Không cần thêm `product_cat`
      }

      // Cập nhật URL mà không tải lại trang
      const newUrl = `${newPathname}?${params.toString()}`;
      window.history.replaceState({}, '', newUrl);

      // Gửi AJAX request
      $.ajax({
        url: ajax_object.ajax_url,
        method: 'GET',
        data: {
          action: 'filter_products',
          query_vars: params.toString(),
        },

        beforeSend: function () {
          $('.list-product-container').addClass('loading');
        },
        success: function (response) {
          if (response.trim() !== '') {
            $('.list-product-container').html(response);
            $('.list-product-container').removeClass('loading');
          } else {
            console.error('Không có sản phẩm phù hợp.');
            $('.list-product-container').removeClass('loading');
          }
        },
        error: function () {
          console.error('Lỗi khi lọc sản phẩm.');
        },
      });
    });
  });
});
