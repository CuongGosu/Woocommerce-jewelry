<?php

require_once 'vendor/autoload.php';


register_nav_menu('gm-primary', __('Menu chính', 'gaumap'));
register_nav_menu('gm-menu-01', __('Menu phụ', 'gaumap'));
register_nav_menu('gm-menu-02', __('Menu phụ 2', 'gaumap'));
register_nav_menu('gm-sidebar', __('Menu sidebar', 'gaumap'));
register_nav_menu('gm-footer', __('Menu footer', 'gaumap'));
register_nav_menu('gm-footer-02', __('Menu footer 2', 'gaumap'));
register_nav_menu('gm-footer-03', __('Menu footer 3', 'gaumap'));

new \Theme\PostTypes\Post();
new \Theme\PostTypes\Product();
new \Theme\Taxonomies\Category();
new \Theme\Taxonomies\ProductGold();
new \Theme\Taxonomies\ProductCat();
// new \Theme\Taxonomies\ProductAge();
new \Theme\Taxonomies\ProductSex();
new \Theme\Taxonomies\ProductStone();

loadStyles([    
      "https://fonts.googleapis.com",
      "https://fonts.gstatic.com",
      "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css",
      "https://cdn.jsdelivr.net/gh/aquawolf04/font-awesome-pro@5cd1511/css/all.css?ver=0.1.0",
      "https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Unbounded:wght@200..900&display=swap",
      "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" ,
        asset("css/mmenu.css"),   
        asset("css/style.css"),
        asset("css/theme.css"),
]); 
    
loadScripts([
	"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js",
    "https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js",
    "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js",
    "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js",
    "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js",
    asset("js/mmenu.js"), 
    asset("js/theme.js"),
    asset("js/main.js"),
]);

add_action('widgets_init', function () {
    register_sidebar([
        'name'          => __   ('Trang chủ - Nội dung trang chủ', 'gaumap'),
        'id'            => 'home',
        'description'   => __('Khu vực hiển thị nội dung trang chủ', 'gaumap'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="home">',
        'after_title'   => '</h2>',
    ]);

    register_sidebar([
        'name'          => __   ('Sidebar ', 'gaumap'),
        'id'            => 'sidebar',
        'description'   => __('Nội dung', 'gaumap'),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="sidebar">',
        'after_title'   => '</h2>',
    ]);
    register_widget(\Gaumap\Widgets\CategoryBlock::class);
    register_widget(\Gaumap\Widgets\BannerBlock::class);
    register_widget(\Gaumap\Widgets\ProductBlock::class);
    register_widget(\Gaumap\Widgets\BlogBlock::class);
    register_widget(\Gaumap\Widgets\PriceGoldBlock::class);
    // register_widget(\Gaumap\Widgets\ContactFormBlock::class);
    // register_widget(\Gaumap\Widgets\UspBlock::class);
    // register_widget(\Gaumap\Widgets\DvKhacVaBlog::class);
});

function ajax_filter_products() {
    // Lấy query vars từ request
    $query_vars = [];
    $query_string = urldecode($_GET['query_vars']); // Giải mã trước khi phân tích
    parse_str(sanitize_text_field($query_string), $query_vars);

    // Xử lý pagination
    $paged = 1;
    
    if (preg_match('/\/page\/(\d+)\//', $_SERVER['REQUEST_URI'], $matches)) {
        $paged = (int) $matches[1];
    }
    // Tạo query args để lọc sản phẩm
    $args = [
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 20, // Số lượng sản phẩm mỗi trang
        'paged' => $paged, // Xử lý pagination
    ];

    // Xây dựng tax_query nếu có
    $tax_query = [];
    foreach ($query_vars as $taxonomy => $slugs) {
        if (in_array($taxonomy, ['product_sex', 'product_stone','product_gold'])) { // Chỉ xử lý các taxonomy cụ thể
            $slugs_array = explode(',', $slugs);

            // Tạo một array để giữ các sub-conditions cho từng giá trị trong taxonomy
            $sub_tax_query = [];
            foreach ($slugs_array as $slug) {
                $sub_tax_query[] = [
                    'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $slug,
                    'operator' => 'IN', // Dùng 'IN' để khớp từng giá trị riêng lẻ
                ];
            }

            // Thêm mối quan hệ 'OR' cho các sub-tax_query
            if (count($sub_tax_query) > 1) {
                $tax_query[] = [
                    'relation' => 'OR',
                    ...$sub_tax_query,
                ];
            } else {
                $tax_query = array_merge($tax_query, $sub_tax_query);
            }
        }
    }
    // Xử lý danh mục sản phẩm hiện tại
    $current_category = null;

    if (is_tax('product_cat')) {
        $current_category = get_queried_object(); // Lấy danh mục từ truy vấn hiện tại
    } elseif (!empty($query_vars['product_cat'])) {
        $current_category = get_term_by('slug', $query_vars['product_cat'], 'product_cat'); // Lấy danh mục từ query_vars
        unset($query_vars['product_cat']); // Loại bỏ product_cat khỏi query_vars để tránh xử lý trùng lặp
    }

    if ($current_category) {
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $current_category->term_id,
            'operator' => 'IN',
        ];
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    // Query sản phẩm
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            template('loop/content-product');
        }
    } else {
        echo '<p>Không tìm thấy sản phẩm nào phù hợp.</p>';
    }

    wp_reset_postdata();
    wp_die(); // Kết thúc AJAX
}
add_action('wp_ajax_filter_products', 'ajax_filter_products');
add_action('wp_ajax_nopriv_filter_products', 'ajax_filter_products');

function enqueue_filter_scripts() {
    wp_enqueue_script('filter-ajax', get_template_directory_uri() . '/resources/js/filter.js', ['jquery'], null, true);
    wp_localize_script('filter-ajax', 'ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_filter_scripts');


function add_custom_query_vars($vars) {
    $vars[] = 'product_sex';
    $vars[] = 'product_stone';
    $vars[] = 'product_gold';
    return $vars;
}
add_filter('query_vars', 'add_custom_query_vars');

function modify_product_archive_query($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('product')) {
        // Kiểm tra nếu có filter trong query vars
        $product_sex = get_query_var('product_sex');
        $product_stone = get_query_var('product_stone');
        $product_gold = get_query_var('product_gold');
        $has_filter = false; 
        // Áp dụng filter vào query
        $tax_query = [];
        $taxonomies = [ 'product_sex', 'product_stone','product_gold']; 
        foreach ($taxonomies as $taxonomy) { 
            $terms = get_query_var($taxonomy); 
            if (!empty($terms)) { 
                $has_filter = true; 
                $terms_array = explode(',', $terms); 
                $tax_query[] = [ 
                    'taxonomy' => $taxonomy, 
                    'field' => 'slug', 
                    'terms' => $terms_array,
                     'operator' => count($terms_array) > 1 ? 'IN' : 'AND', ]; } }

            // Xử lý danh mục sản phẩm hiện tại nếu là trang danh mục
        if (is_tax('product_cat')) {
            $current_term = get_queried_object();
            $tax_query[] = [
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $current_term->term_id,
            ];
        }

         // Áp dụng relation OR nếu có nhiều điều kiện
         if ($has_filter) {
            if (count($tax_query) > 1) {
                $tax_query['relation'] = 'OR';
            }
            $query->set('tax_query', $tax_query);
        }
        $query->set('posts_per_page', 10);
        return $query; 
    }
}
add_action('pre_get_posts', 'modify_product_archive_query');
// add to cart

// Xử lý yêu cầu AJAX
add_action('wp_ajax_add_to_cart', 'ajax_add_to_cart_handler');
add_action('wp_ajax_nopriv_add_to_cart', 'ajax_add_to_cart_handler');

function ajax_add_to_cart_handler() {
    // Kiểm tra dữ liệu
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($product_id && $quantity > 0) {
        // Thêm sản phẩm vào giỏ hàng
        $added = WC()->cart->add_to_cart($product_id, $quantity);

        if ($added) {
            wp_send_json_success('Sản phẩm đã được thêm vào giỏ hàng.');
        } else {
            wp_send_json_error('Không thể thêm sản phẩm vào giỏ hàng.');
        }
    } else {
        wp_send_json_error('Dữ liệu không hợp lệ.');
    }

    wp_die(); // Kết thúc xử lý AJAX
}
function enqueue_ajax_add_to_cart_script() {

    // Truyền các tham số cần thiết từ PHP sang JS
    wp_localize_script('custom-ajax-add-to-cart', 'wc_add_to_cart_params', array(
        'ajax_url' => admin_url('admin-ajax.php'), // URL AJAX của WordPress
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_add_to_cart_script');
// Xử lý AJAX thêm sản phẩm vào giỏ hàng
add_action('wp_ajax_update_cart_count', 'ajax_update_cart_count_handler');
add_action('wp_ajax_nopriv_update_cart_count', 'ajax_update_cart_count_handler');

function ajax_update_cart_count_handler() {
    // Lấy tổng số lượng sản phẩm trong giỏ hàng
    $cart_count = WC()->cart->get_cart_contents_count();
    // Gửi phản hồi JSON về số lượng giỏ hàng
    wp_send_json_success(array('cart_count' => $cart_count));
}


function custom_admin_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var lastValue = $('textarea[name="carbon_fields_compact_input[_price_page]"]').val(); // Lưu giá trị ban đầu của textarea

            // Kiểm tra giá trị của textarea theo chu kỳ
            setInterval(function() {
                var currentValue = $('textarea[name="carbon_fields_compact_input[_price_page]"]').val(); // Lấy giá trị hiện tại của textarea

                // Nếu giá trị thay đổi, cập nhật thời gian và ghi lại sự thay đổi
                if (currentValue !== lastValue) {
                    updateUpdateTime();
                    console.log("Textarea Changed (via visual update)");
                    lastValue = currentValue; // Cập nhật giá trị lưu trữ
                }
            }, 1000); // Kiểm tra mỗi giây

            // Lắng nghe sự thay đổi trong chế độ text (textarea)
            $('textarea[name="carbon_fields_compact_input[_price_page]"]').on('input', function() {
                updateUpdateTime();
                console.log("Text Area Changed");
            });

            // Hàm cập nhật thời gian
            function updateUpdateTime() {
                var currentTime = new Date().toLocaleString('vi-VN', {
                    hour: '2-digit', minute: '2-digit', second: '2-digit',
                    day: '2-digit', month: '2-digit', year: 'numeric'
                });

                // Cập nhật giá trị thời gian vào trường 'price_page_update_time'
                $('input[name="carbon_fields_compact_input[_price_page_update_time]"]').val(currentTime);
            }
        });
    </script>
    <?php
}
add_action('admin_footer', 'custom_admin_script');


function save_update_time_on_price_page_change($post_id) {
    if (get_post_type($post_id) === 'your_post_type') {
        $price_page = get_post_meta($post_id, 'carbon_fields_compact_input[_price_page]', true);
        if ($price_page) {
            // Cập nhật thời gian
            $current_time = current_time('Y-m-d H:i:s');
            update_post_meta($post_id, 'carbon_fields_compact_input[_price_page_update_time]', $current_time);
        }
    }
}
add_action('save_post', 'save_update_time_on_price_page_change');
// 

function enqueue_infinite_scroll_scripts() {
    wp_enqueue_script('infinite-scroll', get_template_directory_uri() . '/resources/js/infinite-scroll.js', ['jquery'], null, true);

    // Truyền dữ liệu cho JavaScript
    wp_localize_script('infinite-scroll', 'ajax_object', [
        'ajax_url'  => admin_url('admin-ajax.php'),
        'max_pages' => $GLOBALS['wp_query']->max_num_pages, // Tổng số trang
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_infinite_scroll_scripts');

// load infiniti scroll
function load_more_products() {
    // Kiểm tra trang hiện tại (paged) được gửi qua AJAX
    $paged = isset($_POST['paged']) ? absint($_POST['paged']) : 1;

    // Query sản phẩm
    $args = [
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 10,
        'paged'          => $paged,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            template('loop/content-product'); // Sử dụng template hiện tại
        }
    } else {
        echo ''; // Không còn sản phẩm nào để tải
    }

    wp_reset_postdata();
    wp_die(); // Dừng AJAX
}
add_action('wp_ajax_load_more_products', 'load_more_products');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products');
add_action('wp_footer', function () {
    if (is_product()) {
        global $wp_filter;
        echo '<pre>';
        print_r($wp_filter['woocommerce_after_single_product_summary']);
        echo '</pre>';
    }
});

// 
add_filter('wpseo_metadesc', function ($description) {
    return wp_strip_all_tags($description, true); // Loại bỏ toàn bộ HTML.
});
add_filter('woocommerce_is_purchasable', 'allow_purchase_without_price', 10, 2);

function allow_purchase_without_price($purchasable, $product) {
    // Kiểm tra nếu sản phẩm không có giá
    if (!$product->get_price()) {
        $purchasable = true; 
    }
    return $purchasable;
}

