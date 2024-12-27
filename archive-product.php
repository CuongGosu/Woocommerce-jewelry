<?php get_header() ?>
<?php theBreadcrumb() ?>
<div class="content-page">
    <figure class="section-page-product">
        <img class="object-common" src="<?php echo  theOptionImage('banner-page-product') ?>"alt="<?php theOption('ten_cong_ty') ?>">
    </figure>
    <div class="wrapperDiv">
        <div class="section-product-heading">
            <h1 class="section-title">Trang sức</h1>
            <ul class="list-product-cat">
            <?php 
                        $categories = get_terms('product_cat', [
                            'hide_empty' => false,
                        ]);
                        function render_categories($categories, $parent = 0, $obj = null) {
                            $filtered_categories = array_filter($categories, function($cat) use ($parent) {
                                return $cat->parent == $parent && $cat->slug !== 'chua-phan-loai';
                            });
                            if (empty($filtered_categories)) return;
                            foreach ($filtered_categories as $category) {
                                $active = ($obj && $obj->parent == $category->term_id) ? 'active' : '';
                                $current = ($obj && $obj->slug == $category->slug) ? 'current' : '';
                                echo '<li class=" item-product-cat  ' . $active . ' ' . $current . '   ">';
                                echo '<a href="' . get_term_link($category) . '">' . $category->name . '</a>';
                                // Render danh mục con
                                render_categories($categories, $category->term_id, $obj);
                                echo '</li>';
                            }
                        }

                        if ($categories):
                            $obj = get_queried_object(); // Lấy đối tượng hiện tại
                            render_categories($categories, 0, $obj);
                        endif;
                        ?>
            </ul>
        </div>
        <div class="section-product-filter">
            <div class="filter-wrapper">
                    <?php
                    // Hiển thị các bộ lọc trên trang archive-product.php
                        function render_filter_block($taxonomy, $title, $css_class) {
                        // Lấy danh sách các term trong taxonomy
                        $terms = get_terms([
                            'taxonomy' => $taxonomy,
                            'hide_empty' => false, // Chỉ lấy các term có sản phẩm
                        ]);

                        // Nếu không có term, không hiển thị gì
                        if (empty($terms)) return;
                        // Lấy các filter hiện tại từ URL (query vars)
                        $current_filters = isset($_GET[$taxonomy]) ? explode(',', sanitize_text_field($_GET[$taxonomy])) : [];
                        // Bắt đầu render HTML
                        echo '<div class="filter-block">';
                        echo '<div class="filter-items category">';
                        echo '<span class="title-filter" data-title="' . esc_attr($title) . '">' . esc_html($title) . '<i class="fa fa-angle-down" aria-hidden="true"></i></span>';
                        echo '<ul class="' . esc_attr($css_class) . ' filter-check">';

                        // Hiển thị từng term
                        foreach ($terms as $term) {
                            $is_checked = in_array($term->slug, $current_filters) ? 'checked' : '';
                            echo '<li class="filter-item ' . $is_checked . '" data-value="' . esc_attr($term->slug) . '" data-taxonomy="' . esc_attr($taxonomy) . '">';
                            echo '<a href="javascript:void(0)" class="filter-link" data-value="' . esc_attr($term->slug) . '">';
                            echo esc_html($term->name);
                            echo '</a>';
                            echo '</li>';
                        }

                        echo '</ul>';
                        echo '</div>';
                        echo '</div>';
                    }

                    // Gọi hàm render cho từng taxonomy
                    render_filter_block('product_sex', 'Giới tính', 'type-choise');
                    render_filter_block('product_stone', 'Đính đá', 'tag-choise');
                    render_filter_block('product_gold', 'Loại vàng', '', 'tag-choise');
                    ?>
            </div>
            <div class="sort-wrapper"></div>
        </div>
        <div class="products-container">
            <div class="list-product-container" id="list-product-container">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()): the_post();
                    template('loop/content-product');
                ?>
                <?php endwhile; ?>
            <?php else : ?>
                <p>Không tìm thấy sản phẩm nào.</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const filterBlocks = document.querySelectorAll('.filter-block');

    filterBlocks.forEach(function (block) {
        const toggleElement = block.querySelector('.title-filter');

        toggleElement.addEventListener('click', function () {
            // Ẩn tất cả các filter ul khác
            filterBlocks.forEach(function (otherBlock) {
                if (otherBlock !== block) {
                    otherBlock.classList.remove('active');
                }
            });

            // Chuyển trạng thái active cho filter-block hiện tại
            block.classList.toggle('active');
        });
    });
});


</script>
<?php get_footer() ?>