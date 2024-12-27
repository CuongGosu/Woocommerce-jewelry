<?php

namespace Gaumap\Walkers;

/**
 * The menu walker.  This is just the methods from `Walker_Nav_Menu` with
 * all of the whitespace generation (eg. `$indent` remove) as well as
 * some restrictions on the CSS classes that are added. Menu item IDs are also
 * removed.
 * Most of the filters here are preserved so it should be backwards
 * compatible.
 *
 * @since   0.1
 */
class CustomMenuWalker extends \Walker_Nav_Menu
{
    
    /**
     * {@inheritdoc}
     */
    function start_lvl(&$output, $depth = 0, $args = null) {
        if ($args->walker->has_children) {
            $output .= '<ul class="list-unstyled sub-menu ">';
        } else {
            $output .= '<ul class="list-unstyled">';
        }
    }
    function end_lvl(&$output, $depth = 0, $args = [])
    {
        if ($args->walker->has_children) {
            $output .= '</ul>';
        } else {
            $output .= '</ul>';
        }
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'nav-item';
    
        // Lấy thông tin từ Carbon Fields
        $grid_menu = carbon_get_nav_menu_item_meta($item->ID, 'grid_menu');
        $show_img = carbon_get_nav_menu_item_meta($item->ID, 'show_img');
        $show_category = carbon_get_nav_menu_item_meta($item->ID, 'show_category');
        $img_menu = carbon_get_nav_menu_item_meta($item->ID, 'img_menu');
        $mega_thumbnails = getOption('mega-thumbnail');
        if ($grid_menu && $depth == 0) {
            $classes[] = 'menu-item-has-children has-mega-menu';
        }
    
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? " class='" . esc_attr($class_names) . "'" : '';
    
        $output .= $indent . '<li' . $class_names . '>';
    
        // Cấu trúc link
        $attributes = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $item_output = $args->before;
    
        if ($show_category && $depth == 0) {
            $item_output .= "<a{$attributes} class='is-categories'>
                <span class='icon-categories'><ion-icon name='menu-outline'></ion-icon></span>
                <p class='text-categories'>{$item->title}</p>
                <span class='icon-down'><ion-icon name='chevron-down-outline'></ion-icon></span>
            </a>";
            $item_output .= "
            <div class='mega-menu-container'>
                <div class='wrapperDiv'>
                    <div class='mega-inner'>";
                    if (!empty($mega_thumbnails) && is_array($mega_thumbnails)) {
                        foreach ($mega_thumbnails as $thumbnail) {
                            $image_url = wp_get_attachment_image_url($thumbnail['image'], 'full');
                            $link = esc_url($thumbnail['link']);
                            $title = $thumbnail['title'];
                            $item_output .= "
                                <a href='{$link}' class='mega-thumbnail'>
                                    <figure>
                                        <img class='object-common' src='{$image_url}' alt=''>
                                    </figure>
                                    <span class='button'>{$title}</span>
                                </a>
                            ";
                        }
                    }
                    $item_output .= '
                        <div class="mega-navigation">
                            <span class="submenu-title">' . esc_html(get_nav_name('gm-menu-01')) . '</span>
                            ' . wp_nav_menu([
                                'menu' => 'gm-menu-01',
                                'theme_location' => 'gm-menu-01',
                                'container' => false,
                                'menu_class' => 'sub-menu',
                                'depth' => 1,
                                'echo' => false,
                            ]) . '
                        </div>
                        <div class="mega-navigation">
                            <span class="submenu-title">' . esc_html(get_nav_name('gm-menu-02')) . '</span>
                            ' . wp_nav_menu([
                                'menu' => 'gm-menu-02',
                                'theme_location' => 'gm-menu-02',
                                'container' => false,
                                'menu_class' => 'sub-menu',
                                'depth' => 1,
                                'echo' => false,
                            ]) . '
                        </div>
                    </div>
                </div>
            </div>';
        } elseif ($show_img && $img_menu && $depth == 1) {
            $img_url = wp_get_attachment_image_url($img_menu, 'full');
            $item_output .= "<a{$attributes} class='mega-thumbnail'>
                <figure class='object-common'>
                    <img src='{$img_url}' alt=''>
                </figure>
                <span class='button'>{$item->title}</span>
            </a>";
        } elseif ($depth == 1) {
            $item_output .= "<a{$attributes} class='submenu-title'>{$item->title}</a>";
        } else {
            $item_output .= '<a' . $attributes . '>' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</a>';
        }
    
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}