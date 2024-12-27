document.addEventListener('DOMContentLoaded', function () {
  let currentPage = 1;
  const maxPages = parseInt(ajax_object.max_pages); // Số trang tối đa từ backend
  const container = document.querySelector('.list-product-container');
  let loading = false;

  // Hàm tải thêm sản phẩm
  const loadMoreProducts = () => {
    if (loading || currentPage >= maxPages) return;

    loading = true;
    currentPage++;

    $.ajax({
      url: ajax_object.ajax_url,
      type: 'POST',
      data: {
        action: 'load_more_products',
        paged: currentPage,
      },
      beforeSend: function () {
        // Hiển thị spinner hoặc trạng thái tải
        container.classList.add('loading');
      },
      success: function (response) {
        if (response.trim() !== '') {
          container.insertAdjacentHTML('beforeend', response); // Thêm sản phẩm mới
          loading = false;
        } else {
          console.log('Không còn sản phẩm nào để tải.');
        }
      },
      complete: function () {
        container.classList.remove('loading');
      },
      error: function () {
        console.error('Lỗi khi tải thêm sản phẩm.');
        loading = false;
      },
    });
  };

  // Lắng nghe sự kiện cuộn
  window.addEventListener('scroll', function () {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const offsetHeight = document.documentElement.offsetHeight;
    const windowHeight = window.innerHeight;

    if (scrollTop + windowHeight >= offsetHeight - 100) {
      loadMoreProducts(); // Tải thêm khi gần chạm đáy
    }
  });
});
