<?php
/**
 * Plugin Name: Hybrid Composer
 * Plugin URI: http://www.wordpress.framework-y.com/
 * Description: Page Builder and Framework for WordPress
 * Version: 1.4.5
 * Author: Schiocco
 * Author URI: http://schiocco.io/
 */
// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Theme functions for WPTF.
// =============================================================================
// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Admin scrips and styles
//   02. Front-end scripts and styles
//   03. Admin files
//   04. Post Types
//   05. Miscellaneous
//   06. Hybrid Composer
//   07. WordPress settings
//   08. Functions
//   09. AJAX
// =============================================================================
// GLOBAL CONSTANTS
// =============================================================================

define("HC_PLUGIN_URL", plugins_url() . "/hybrid-composer");
define("HC_PLUGIN_PATH", ABSPATH . "wp-content/plugins/hybrid-composer");
define("HC_THEME_URL", get_template_directory_uri());
define("HC_THEME_PATH", get_template_directory());
define("HC_SITE_URL", get_site_url());
define("HC_IS_CUSTOM_HC", file_exists(HC_PLUGIN_PATH . '/custom/custom-components.php'));
define("HC_IS_CUSTOM_PANEL", file_exists(HC_PLUGIN_PATH . '/custom/custom-options-panel.php'));

$HC_THEME_SETTINGS = get_option('framework_y_theme_settings');
$HC_IS_ARCHIVE = false;
$HC_PT_CATEGORY = "";
$HC_TEMPLATE_SLUG = str_replace(".php","",get_page_template_slug());
$hc_all_post_types = array(array('Posts','post'), array('Pages','page'),array('Post Types','y-post-types'),array('Post Types Archivies','y-post-types-arc'));
$hc_all_custom_post_types = array();
$hc_wp_query;
include(HC_PLUGIN_PATH. "/admin/composer-side.php");
include(HC_PLUGIN_PATH. "/admin/widgets.php");
include_once(HC_PLUGIN_PATH. "/inc/front-functions.php");

// ADMIN - LOAD ADMINISTRATION CSS AND JS FILES
// =============================================================================
function hc_enqueue_admin() {
    $icons_family = hc_get_setting('icons-family');
    if ($icons_family == "font-awesome") wp_enqueue_style("font-awesome", HC_PLUGIN_URL ."/scripts/font-awesome/css/font-awesome.min.css", array(), "1.0", "all");
    if ($icons_family == "icons-mind-solid") wp_enqueue_style("icons-mind-solid", HC_PLUGIN_URL ."/scripts/iconsmind/solid-icons.min.css", array(), "1.0", "all");
    if ($icons_family == "icons-mind-line") wp_enqueue_style("icons-mind-line", HC_PLUGIN_URL ."/scripts/iconsmind/line-icons.min.css", array(), "1.0", "all");
    wp_enqueue_style("icons-admin", HC_PLUGIN_URL ."/admin/icons/icons.css", array(), "1.0", "all");
    wp_enqueue_style("hc-admin-style", HC_PLUGIN_URL ."/admin/admin-style.css", array(), "1.0.3", "all");
    wp_enqueue_style("magnific-popup", HC_PLUGIN_URL ."/scripts/magnific-popup.css", array(), "1.0", "all");
    wp_enqueue_script("hc-admin-script", HC_PLUGIN_URL ."/admin/admin-script.js", array(), "1.0.3");
    wp_enqueue_script("hc-composer", HC_PLUGIN_URL ."/admin/composer.js", array(), "1.0.2");
    wp_enqueue_script("hc-script", HC_PLUGIN_URL ."/scripts/script.js", array(), "1.0.2");
    wp_enqueue_script("hc-tab-accordion", HC_PLUGIN_URL ."/scripts/jquery.tab-accordion.js", array(), "1.0");
    wp_enqueue_script("twbsPagination", HC_PLUGIN_URL ."/admin/scripts/jquery.twbsPagination.min.js", array(), "1.0");
    wp_enqueue_script("datepicker", HC_PLUGIN_URL ."/admin/scripts/datepicker.min.js", array(), "1.0");
    wp_enqueue_script("slimscroll", HC_PLUGIN_URL ."/admin/scripts/jquery.slimscroll.min.js", array(), "1.0");
    wp_enqueue_script("prettify", HC_PLUGIN_URL ."/admin/scripts/prettify.js", array(), "1.0");
    wp_enqueue_script("bootstrap-popover", HC_PLUGIN_URL ."/admin/scripts/bootstrap.popover.min.js", array(), "1.0");
    wp_enqueue_script("magnific-popup", HC_PLUGIN_URL ."/admin/scripts/jquery.magnific-popup.min.js", array(), "1.0");
    wp_enqueue_script("hc-script-global",  HC_PLUGIN_URL . '/admin/scripts/script-global.js"', array(), "1.0",true);
}
add_action('admin_enqueue_scripts', 'hc_enqueue_admin');

// FRONT-END - LOAD FRONT-END CSS
// -----------------------------------------------------------------------------
// The .css styles are loaded dynamically. Every page load only the required styles
// =============================================================================
function hc_enqueue_front_end_css() {
    global $HC_PAGE_ARR;
    wp_enqueue_style("hc-bootstrap", HC_PLUGIN_URL . "/scripts/bootstrap/css/bootstrap.css", array(), "1.0", "all"); //Prefix required. This bootstrap file has been customized.
    wp_enqueue_style("hc-style", HC_PLUGIN_URL . "/style.css", array(), "1.0", "all");
    wp_enqueue_style("hc-animations", HC_PLUGIN_URL . "/css/animations.css", array(), "1.0", "all");
    $HC_PAGE_ARR['css']['components'] = "css/components.css"; //Only for tab menu
    if ((class_exists('WooCommerce') && is_product()) || hc_get_now($HC_PAGE_ARR["page_setting"],"lightbox") || hc_get_now($HC_PAGE_ARR["page_setting"],"popup"))  $HC_PAGE_ARR['css']['lightbox'] = "scripts/magnific-popup.css";
    if (isset($HC_PAGE_ARR['css'])) {
        $Y_NOW = $HC_PAGE_ARR['css'];
        foreach( $Y_NOW as $value ) {
            wp_enqueue_style("hc-" . $value , HC_PLUGIN_URL . "/" . str_replace("plugins/","scripts/",$value), array(), "1.0", "all");
        }
    }
    $icons_family = hc_get_setting('icons-family');
    if ($icons_family == "icons-mind-line") wp_enqueue_style("icons-mind-line", HC_PLUGIN_URL ."/scripts/iconsmind/line-icons.min.css", array(), "1.0", "all");
    if ($icons_family == "icons-mind-solid") wp_enqueue_style("icons-mind-solid", HC_PLUGIN_URL ."/scripts/iconsmind/solid-icons.min.css", array(), "1.0", "all");
    if ($icons_family == "font-awesome" || strlen($icons_family) < 2) wp_enqueue_style("font-awesome", HC_PLUGIN_URL ."/scripts/font-awesome/css/font-awesome.min.css", array(), "1.0", "all");
    if (hc_get_setting("title-type") == "slider") wp_enqueue_style("css-flexslider", HC_PLUGIN_URL . '/scripts/flexslider/flexslider.css', array(), "1.0","all");
    $skin = hc_get_setting('skin');
    if ($skin != "") {
        wp_enqueue_style("hc_css_skin", HC_PLUGIN_URL . "/custom/skins/" . $skin . "/skin.css", array(), "1.0", "all");
        wp_add_inline_style('hc_css_skin', hc_set_theme_skin($skin));
        wp_add_inline_style('hc_css_skin', hc_settings_styles());
    }  else {
        if (file_exists(HC_THEME_PATH . '/skin.css')) {
            wp_enqueue_style("hc_css_skin", HC_THEME_URL . "/skin.css", array(), "1.0", "all");
            wp_add_inline_style('hc_css_skin', hc_set_theme_skin($skin));
            wp_add_inline_style('hc_css_skin', hc_settings_styles());
        } else {
            wp_enqueue_style("hc_css_skin", HC_PLUGIN_URL . "/skins/custom/skin.css", array(), "1.0", "all");
        }
    }
    if (file_exists(HC_PLUGIN_PATH . '/custom/custom.css')) wp_enqueue_style("hc_css_custom", HC_PLUGIN_URL . "/custom/custom.css", array(), "1.0", "all");
    $font_all = hc_get_setting("font-family");
    $font_2 = hc_get_setting("font-family-2");
    if ($font_2 != "") {
        if ($font_all != "") {
            $font_all .= "|" . $font_2;
        } else {
            $font_all = $font_2;
        }    
    }
    if (HC_IS_CUSTOM_PANEL) { 
        include(HC_PLUGIN_PATH . "/custom/custom-options-panel.php");
        if (isset($HC_CUSTOM_FONT) && $font_all == "") wp_enqueue_style("google-font", hc_get_fonts_url($HC_CUSTOM_FONT), array(), "1.0", "all"); 
    }
    if ($font_all != "") wp_enqueue_style("google-font", hc_get_fonts_url($font_all), array(), "1.0", "all");
    if (hc_is_setted("css-global")) wp_add_inline_style('hc_css_skin', html_entity_decode(hc_get_setting("css-global")));
    if (isset($HC_PAGE_ARR["css_page"]) && $HC_PAGE_ARR["css_page"] != "") wp_add_inline_style('hc_css_skin', $HC_PAGE_ARR["css_page"]);
    $page_css = "";
    if (hc_is_setted("menu-hide")) $page_css .= "header { display: none; }";
    if (hc_is_setted("footer-hide")) $page_css .= "footer { display: none; }";
    if ($page_css != "") wp_add_inline_style('hc_css_skin', $page_css);
    if (hc_is_setted("rtl")) wp_enqueue_style("hc_rtl", HC_PLUGIN_URL . "/css/rtl.css", array(), "1.0", "all");
}
add_action('wp_enqueue_scripts', 'hc_enqueue_front_end_css');

// FRONT-END - LOAD FRONT-END SCRIPT
// -----------------------------------------------------------------------------
// The .js scripts are loaded dynamically. Every page load only the required scripts
// =============================================================================
function hc_enqueue_front_end_script() {
    global $HC_PAGE_ARR;
    wp_enqueue_script("hc_script",  HC_PLUGIN_URL . '/scripts/script.js', array("jquery"), "1.0",true);
    wp_enqueue_script("hc_bootstrap",  HC_PLUGIN_URL . '/scripts/bootstrap/js/bootstrap.min.js', array(), "1.0",true);
    wp_enqueue_script("imagesloaded",  HC_PLUGIN_URL . '/scripts/imagesloaded.min.js"', array(), "1.0",true);
    wp_add_inline_script('hc_script', hc_get_setting("js-global") . " var ajax_url = '" .  esc_url(admin_url('admin-ajax.php')) . "';");
    if (file_exists(HC_PLUGIN_PATH. '/custom/custom.js')) wp_enqueue_script("custom-js",  HC_PLUGIN_URL . '/custom/custom.js"', array(), "1.0",true);
    if (hc_get_setting('menu-type') == "side") wp_enqueue_script("script-slimscroll", HC_PLUGIN_URL . '/scripts/jquery.slimscroll.min.js', array(), "1.0",true);
    if (hc_is_setted("title-parallax")) wp_enqueue_script("script-parallax", HC_PLUGIN_URL . '/scripts/parallax.min.js', array(), "1.0",true);
    if (hc_get_setting("title-type") == "slider") wp_enqueue_script("script-flexslider", HC_PLUGIN_URL . '/scripts/flexslider/jquery.flexslider-min.js', array(), "1.0",true);
    if (hc_is_setted("smooth-scroll")) wp_enqueue_script("script-smooth-scroll", HC_PLUGIN_URL . '/scripts/smooth.scroll.min.js', array(), "1.0",true);
    if ((class_exists('WooCommerce') && is_product()) || hc_get_now($HC_PAGE_ARR["page_setting"],"lightbox") || hc_get_now($HC_PAGE_ARR["page_setting"],"popup")) $HC_PAGE_ARR['scripts']['lightbox'] = 'jquery.magnific-popup.min.js';
    if (isset($HC_PAGE_ARR['scripts'])) {
        $Y_NOW = $HC_PAGE_ARR['scripts'];
        foreach( $Y_NOW as $value ) {
            if (strpos($value,'ttp://') == false && strpos($value,'ttps://') == false) {
                wp_enqueue_script($value,  HC_PLUGIN_URL . '/scripts/' . $value, array(), "1.0",true);
            } else {
                if (strpos($value,'maps') > -1) {
                    $value .= "&key=" .  hc_get_setting("google-api-key");
                }
                wp_enqueue_script($value, $value, array(), "1.0",true);
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'hc_enqueue_front_end_script');

// LOAD WP ADMIN FILES
// =============================================================================
function hc_load_wp_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'hc_load_wp_media_files' );
add_action("admin_menu", function () { add_theme_page("Theme options", "Theme options", "manage_options", "theme-panel", function() {  include(HC_PLUGIN_PATH. "/admin/admin-settings-page.php"); }, null, 99); });
add_action( 'admin_notices', function () { include_once(HC_PLUGIN_PATH. "/admin/other.php"); });
function hc_toolbar_preview_link( $wp_admin_bar ) {
	$wp_admin_bar->add_node(array(
		'id'    => 'hc_page_preview',
		'title' => esc_attr__('Preview Changes','hc'),
		'href'  => '#',
		'meta'  => array( 'onclick' => 'jQuery("#post-preview").click();','class' => 'hc-post-preview-button')
	));
    $wp_admin_bar->add_node(array(
		'id'    => 'hc_page_save',
		'title' => esc_attr__('Save Changes','hc'),
		'href'  => '#',
		'meta'  => array( 'onclick' => 'jQuery("#publish").click();','class' => 'hc-post-preview-button')
	));
}
add_action( 'admin_bar_menu', 'hc_toolbar_preview_link', 999 );

add_action('init', function () {
    add_post_type_support( 'page', 'excerpt' );
    load_plugin_textdomain('hc', false, dirname(plugin_basename(__FILE__)) . '/languages');
});

// Create the Post Type Archive page when a user create a new Post Type - List
// -----------------------------------------------------------------------------
$hc_loop_avoid = true;
function hc_post_published_notification() {
    global $hc_loop_avoid;
    $slug = strtolower($_POST['post-type-slug']);
    $lists_archives;
    if ($hc_loop_avoid && isset($_POST['hidden_post_status']) && $_POST['hidden_post_status'] == "draft") {
        //Create the page
        $title = $_POST['post_title'];
        $my_post =  hc_default_content_post_type(ucfirst($slug),$slug);
        $post_ID = wp_insert_post($my_post);
        //Set the new page as archive page for current list
        $lists_archives = get_option('y_theme_lists_archives');
        if ($lists_archives == false) {
            $lists_archives = array($slug => array($title,$post_ID));
        } else {
            $lists_archives[$slug] = array($title,$post_ID);
        }
    } else {
        //Update page archive id
        if ($hc_loop_avoid) {
            $id = $_POST['pages-list'];
            $lists_archives = get_option('y_theme_lists_archives');
            $lists_archives[$slug] = array($_POST['post-type-name'],$id);
        }
    }
    update_option('y_theme_lists_archives',$lists_archives);
}
add_action( 'publish_y-post-types', 'hc_post_published_notification', 10, 2 );

// Generate the custom Post Types - Lists
// -----------------------------------------------------------------------------
function hc_create_custom_post_types() {
    global $hc_all_post_types;
    global $hc_all_custom_post_types;
    $post_types_arr = array();
    $args = array( 'post_type' => 'y-post-types', 'posts_per_page' => 999 );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $content = json_decode(get_the_content(), true);
            if (!($content === NULL)) array_push($post_types_arr,$content);
        }
    }
    if (function_exists("hc_create_custom_post_types_plugin")) {
        $tmp = hc_create_custom_post_types_plugin($post_types_arr,$hc_all_post_types,$hc_all_custom_post_types);
        $hc_all_post_types = $tmp[0];
        $hc_all_custom_post_types = $tmp[1];
    }
}
add_action( 'init', 'hc_create_custom_post_types', 0);

// Generate the base category taxonomy for the custom Post Types - Lists
// -----------------------------------------------------------------------------
function hc_create_custom_post_types_cat() {
    global $hc_all_custom_post_types;
    hc_load_taxonomies($hc_all_custom_post_types);
    flush_rewrite_rules();
}
add_action( 'init', 'hc_create_custom_post_types_cat', 10);

// Add the meta boxes for the custom Post Types admin page
// -----------------------------------------------------------------------------
add_action('add_meta_boxes', function () {
    add_meta_box('y-post-types-area', 'Post Type Settings', function () { hc_block_post_types_area(); }, 'y-post-types', 'normal', 'high' );
});
function hc_post_type_single_area() {
    global $hc_all_custom_post_types;
    $post_types_arr = array_merge($hc_all_custom_post_types,array(array('Posts','post')));
    add_meta_box('y-post-types-single-area', 'Item main content', function () { hc_block_post_types_single_area(); }, $post_types_arr, 'side', 'high' );
}
add_action('add_meta_boxes', 'hc_post_type_single_area');

// MISCELLANEOUS
// =============================================================================
if (!isset( $content_width )) $content_width = 1200;
add_theme_support('post-thumbnails');
add_image_size('y-theme-ultra-large', 1200, 750, true );
add_image_size('y-theme-hd', 1920, 1080, true );
if (hc_get_setting('menu-type') == "side" && !hc_is_setted('menu-hamburger')) {
    add_filter('body_class', function($classes) {
        return array_merge($classes, array('side-menu-container'));
    });
}
if (hc_get_setting('layout-type') == "boxed") {
    add_filter('body_class', function($classes) {
        return array_merge($classes, array('boxed-layout'));
    });
}
if (hc_is_setted('menu-transparent')) {
    add_filter('body_class', function($classes) {
        return array_merge($classes, array('transparent-header'));
    });
}
function hc_after_setup_theme(){
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'hc_after_setup_theme');

// HYBRID COMPOSER
// =============================================================================
// Include the composer main file in Pages, Posts and Custom Post Types admin pages
// -----------------------------------------------------------------------------
function hc_hybrid_composer() {
    global $hc_all_post_types;
    $arr = array();
    for ($i = 0; $i < count($hc_all_post_types); $i++){
    	array_push($arr,$hc_all_post_types[$i][1]);
    }
    add_meta_box('hybrid-composer', 'Page editor', function () { include_once(HC_PLUGIN_PATH. "/admin/composer.php"); }, $arr, 'normal', 'high' );
}
add_action('add_meta_boxes', 'hc_hybrid_composer');
// Add the composer meta box to Pages, Posts and Custom Post Types admin pages. Function stored in admin/composer-side.php
// -----------------------------------------------------------------------------
function hc_hybrid_composer_side() {
    global $hc_all_post_types;
    add_meta_box('hybrid-composer-side', 'Composer options', function () { hc_block_composer_side(); }, $hc_all_post_types, 'side', 'high' );
}
add_action('add_meta_boxes', 'hc_hybrid_composer_side');

// Save additional data's page, outside the main content
// -----------------------------------------------------------------------------
function hc_post_all_published_notification() {
    if (isset($_POST['content'])) {
        $val = ((0 === strpos($_POST['content'], '{')) ? "composer":"classic");
        if (update_post_meta($_POST['post_ID'], 'hc-editor-mode', $val) != true) {
            add_post_meta($_POST['post_ID'], 'hc-editor-mode', $val);
        }
    }
}
add_action('save_post', 'hc_post_all_published_notification', 10, 2);

// Add Hybrid Composer meta boxes for templates. Function stored in admin/composer-side.php
// -----------------------------------------------------------------------------
function hc_template_meta_boxes() {
    global $hc_all_custom_post_types;
    global $hc_all_post_types;
    $arr = array_merge($hc_all_custom_post_types,$hc_all_post_types);
    add_meta_box('page-settings-meta-boxes', 'Page settings', function () { echo '<a class="preview button" href="#" id="hc-page-settings" onclick="showPageSettingsBox()">' . __("Page settings","hc") . '</a><div class="clear"></div>'; }, $arr, 'side', 'low' );
        add_meta_box('template-meta-boxes', 'Options', function () { hc_block_templates_meta_boxes(); }, $arr, 'side', 'low' );
}
add_action('add_meta_boxes', 'hc_template_meta_boxes');
function hc_template_meta_boxes_top() {
    add_meta_box('template-meta-boxes-top', 'Page menu', function () { hc_block_templates_meta_boxes_top(); }, 'page', 'side', 'high' );
}
add_action('add_meta_boxes', 'hc_template_meta_boxes_top');

// WP SETTING - MENU ADMIN PAGE
// -----------------------------------------------------------------------------
// Functions stored in admin/composer-side.php
// =============================================================================
function hc_add_meta_box_menu() {
    add_meta_box('meta-box-divider', 'Divider', 'hc_init_meta_box_divider', 'nav-menus', 'side', 'low');
    add_meta_box('meta-box-mega-menu', 'Mega menu', 'hc_init_meta_box_mega_menu', 'nav-menus', 'side', 'low');
    add_meta_box('meta-box-mega-menu-tab', 'Mega menu tab', 'hc_init_meta_box_mega_menu_tab', 'nav-menus', 'side', 'low');
    add_meta_box('meta-box-mega-menu-col', 'Mega menu column', 'hc_init_meta_box_mega_menu_col', 'nav-menus', 'side', 'low');
    add_meta_box('meta-box-mega-menu-title', 'Mega menu title', 'hc_init_meta_box_mega_menu_title', 'nav-menus', 'side', 'low');
}
add_action( 'admin_init', 'hc_add_meta_box_menu' );

// FUNCTIONS
// -----------------------------------------------------------------------------
// Various functions
// =============================================================================
function hc_get_breadcrumb($classes = "") {
	global $post;
    global $wp_query;

    if (isset($post)) {
        $trail = '<ol class="breadcrumb b ' . $classes . '"><li><a href="' . get_home_url() . '">' . __("Home","hc") . '</a></li>';
        $page_title = esc_attr(hc_get_the_title()[0]);
        if($post->post_parent) {
            $parent_id = $post->post_parent;
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_attr(get_the_title($page->ID)) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach($breadcrumbs as $crumb) $trail .= $crumb;
        }
        $pt = get_post_type();
        if ($pt != "") {
            if ($pt != "post") {
                $lists = get_option('y_theme_lists_archives');
                if (is_array($lists)) {
                    foreach ($lists as $key => $value ) {
                        if ($key == $pt) $trail .= '<li><a href="' . get_permalink($value[1]) . '">' . $value[0] . '</a></li>';
                    }
                }
            } else {
                $b = hc_get_setting("blog-page");
                if ($b == "") $b = get_post_type_archive_link("post");
                else $b = get_permalink($b);
                if ($b != "") $trail .= '<li><a href="' . $b . '">' . __("Blog","hc") . '</a></li>';
            }
        }
        
        if (class_exists('WooCommerce') && (is_product_category() || is_product_tag() || is_product())) {
            $wc_id = hc_get_setting("shop-page");
            if ($wc_id == "") $wc_id = wc_get_page_id('shop');
            $wc =  get_permalink($wc_id);
            if (isset($wc)) $trail .= '<li><a href="' . $wc . '">' . __("Shop","hc") . '</a></li>';
        }

        $title = get_the_title(); 
        if (class_exists('WooCommerce') && is_shop()) $title = __("Shop","hc");
        if (strlen($title) > 20) $title = mb_substr($title,0,20) . ' ...';
        if (is_category() || is_tag() || (isset($wp_query->tax_query) && count($wp_query->tax_query->queries) > 0)) { 
            $trail .= '<li class="active">' . ucfirst($wp_query->queried_object->name) . '</li>';
        } else {
            if (is_day() || is_month() || is_year()) {
                $trail .= '<li class="active">' . get_the_date() . '</li>';
            } else {
                if (is_author()) {
                    $trail .= '<li class="active">' . ucfirst(get_the_author()) . '</li>';
                } else {
                    $trail .= '<li class="active">' . $title . '</li>';
                }
            }
        }
        $trail .= '</ol>';
        return $trail;
    }
	return "";
}
function hc_echo_setting($id) {
    echo hc_get_setting($id);
}
function hc_get_setting($id, $default="") {
    global $HC_THEME_SETTINGS;
    global $HC_PAGE_SETTINGS;
    if ($HC_PAGE_SETTINGS != false && isset($HC_PAGE_SETTINGS[$id])) {
        $val = $HC_PAGE_SETTINGS[$id];
        if ($val != "") return $val;
    }
    if ($HC_THEME_SETTINGS != false) {
        foreach ($HC_THEME_SETTINGS as $val) {
            if ($val[0] == $id && strlen($val[1]) > 0) return $val[1];
        }
    }
    return $default;
}
function hc_is_setted($id) {
    global $HC_THEME_SETTINGS;
    global $HC_PAGE_SETTINGS;
    if ($HC_PAGE_SETTINGS != false && isset($HC_PAGE_SETTINGS[$id])) {
        $val = $HC_PAGE_SETTINGS[$id];
        if (strlen($val) > 0 && $val != "false" && $val != "no" || $val == "true") {
            return true;
        } else { 
            if (($val == "false" || $val == "no" || $val == false) && $val != "") return false;
        }
    }
    if ($HC_THEME_SETTINGS != false) {
        foreach ($HC_THEME_SETTINGS as $val) {
            if ($val[0] == $id && strlen($val[1]) > 0) return true;
        }
    }
    return false;
}
function hc_get_post_type_items($post_type, $cat = "", $pag_items = 10, $isSearch = false, $isPagination = true) {
    global $paged;
    global $hc_wp_query;
    if (!isset($paged)) $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    if (!$isPagination) $paged = 0;
    $arr = array();
    $args = array();
    if ($isSearch) {
        $args = array('s' => get_search_query(),'paged' => $paged);
    } else {
        if (is_tag()) {
            $args = array('post_type' => $post_type,'tag'=>$cat, 'posts_per_page' => $pag_items,'paged' => $paged);
        } else {
            if ($post_type != 'post') {
                $args = array('post_type' => $post_type, $post_type. '-cat'=>$cat, 'posts_per_page' => $pag_items,'paged' => $paged);
            } else {
                $args = array('post_type' => $post_type,'category_name'=>$cat, 'posts_per_page' => $pag_items,'paged' => $paged);
            }
        }
    }
    $date = "";
    if (is_day()) $date = get_the_date();
    if (is_month()) $date = get_the_date('F Y');
    if (is_year()) $date = get_the_date('Y');
    if ($date != "") {
        $args['monthnum'] = get_the_date('m');
        $args['year'] = get_the_date('Y');
    }
    $hc_wp_query = new WP_Query($args);
    if ($hc_wp_query->have_posts()) {
        while ($hc_wp_query->have_posts() ) {
            $hc_wp_query->the_post();
            $content = json_decode($hc_wp_query->post->post_content, true);
            if ($hc_wp_query->post->post_type == "page" || !isset($content['post_type_setting'])) {
                $item = array(
                  "id" => $hc_wp_query->post->ID,
                  "link" => get_the_permalink(),
                  "date" => get_the_date("U"),
                  "title" => get_the_title(),
                  "subtitle" => "",
                  "image"=> get_the_post_thumbnail_url(),
                  "excerpt"=> get_the_excerpt(),
                  "extra_1"=> "",
                  "extra_2"=> "",
                  "icon" => "",
                  "author_id" => $hc_wp_query->post->post_author,
                  "comments_count" => $hc_wp_query->post->comment_count);
            } else {
                $item = array(
                  "id" => $hc_wp_query->post->ID,
                  "link" => get_the_permalink(),
                  "date" => get_the_date("U"),
                  "title" =>$content['main-title']['title'],
                  "subtitle" =>$content['main-title']['subtitle'],
                  "image"=> $content['post_type_setting']['settings']['image'],
                  "excerpt"=> $content['post_type_setting']['settings']['excerpt'],
                  "extra_1"=> $content['post_type_setting']['settings']['extra_1'],
                  "extra_2"=> $content['post_type_setting']['settings']['extra_2'],
                  "icon" => $content['post_type_setting']['settings']['icon'],
                  "author_id" => $hc_wp_query->post->post_author,
                  "comments_count" => $hc_wp_query->post->comment_count);
            }
            array_push($arr,$item);
        }
        wp_reset_postdata();
    }
    return $arr;
}
function hc_get_post_categories($post_id,$slug) {
    $cat_html = "";
    $post_categories;
    $taxonomy = "category";
    if ($slug != 'post') { 
        $post_categories = get_the_terms($post_id, $slug . "-cat"); 
        $taxonomy = $slug . "-cat";
    } else {
        $post_categories = wp_get_post_categories($post_id);
    }
    if ($post_categories !== false && !is_wp_error($post_categories)) {
        foreach($post_categories as $c){
            $cat = get_category( $c );
            $cat_html .= '<a class="category-'. $cat->slug . '" href="'. get_term_link($cat->term_id,$taxonomy) .'">'. $cat->name . '</a>, ';
        }
    }
    if (strlen($cat_html) > 0) return mb_substr($cat_html,0,strlen($cat_html)-2);
    return "";
}
function hc_get_social_links() {
    $tmp = hc_get_setting('social-fb'); if (strlen($tmp) > 0) echo "<a target='_blank' rel='nofollow' href='".esc_url($tmp)."'><i class='fa fa-facebook'></i></a>";
    $tmp = hc_get_setting('social-tw'); if (strlen($tmp) > 0) echo "<a target='_blank' rel='nofollow' href='".esc_url($tmp)."'><i class='fa fa-twitter'></i></a>";
    $tmp = hc_get_setting('social-ig'); if (strlen($tmp) > 0) echo "<a target='_blank' rel='nofollow' href='".esc_url($tmp)."'><i class='fa fa-instagram'></i></a>";
    $tmp = hc_get_setting('social-yt'); if (strlen($tmp) > 0) echo "<a target='_blank' rel='nofollow' href='".esc_url($tmp)."'><i class='fa fa-youtube'></i></a>";
    $tmp = hc_get_setting('social-in'); if (strlen($tmp) > 0) echo "<a target='_blank' rel='nofollow' href='".esc_url($tmp)."'><i class='fa fa-linkedin'></i></a>";
    $tmp = hc_get_setting('social-g+'); if (strlen($tmp) > 0) echo "<a target='_blank' rel='nofollow' href='".esc_url($tmp)."'><i class='fa fa-google-plus'></i></a>";
    $tmp = hc_get_setting('social-pi'); if (strlen($tmp) > 0) echo "<a target='_blank' rel='nofollow' href='".esc_url($tmp)."'><i class='fa fa-pinterest'></i></a>";
}
function hc_get_wpml_menu($type = "dropdown") {
    $html = '';
    if (function_exists('icl_object_id')) {
        $langs = icl_get_languages('skip_missing=1&orderby=KEY&order=DIR&link_empty_to=str');
        $wpml_current;
        $wpml_list = "";
        if ($type ==  "dropdown") {
            foreach ($langs as $item) {
                if ($item['active'] == 1) $wpml_current = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><img alt="flag" src="' . $item['country_flag_url'] .'">' . $item['language_code'] . ' <span class="caret"></span></a>';
                else $wpml_list .= ' <li><a href="' . $item['url'] .'"><img alt="flag" src="' . $item['country_flag_url'] .'">' . $item['language_code'] . '</a></li>';
            }
            if (isset($wpml_current)){
                $html = '<ul class="nav navbar-nav lan-menu"><li class="dropdown">' . $wpml_current . ((strlen($wpml_list) > 0) ? '<ul class="dropdown-menu">' . $wpml_list . '</ul>':'') . '</li></ul>';
            }
        }
        if ($type ==  "list") {
            foreach ($langs as $item) {
                $html .= '<a ' . (($item['active'] == 1) ? 'class="active"':'') . ' title="' . $item['language_code'] . '" href="' . $item['url'] .'"><img alt="flag" src="' . $item['country_flag_url'] .'"></a><span class="space"></span>';
            }
            if (strlen($html) > 0) $html = mb_substr($html,0,count($html) - 28);
        }
    }
    return $html;
}
function hc_get_shop_menu() { 
    if (class_exists('WooCommerce')) {
?>
<div class="shop-menu-cnt shop-menu-empty">
    <i class="fa fa-shopping-cart"></i>
    <div class="shop-menu">
        <ul class="shop-cart">
            
        </ul>
        <p class="cart-total" data-currency="<?php _e("$","hc") ?>">
            <?php _e("Subtotal:","hc") ?> <span>--</span>
        </p>
        <p class="cart-buttons">
            <a href="<?php echo get_permalink(wc_get_page_id('cart')) ?>" class="btn btn-xs cart-view"><?php _e("View Cart","hc") ?></a>
            <a href="<?php echo get_permalink(wc_get_page_id('checkout')) ?>" class="btn btn-xs cart-checkout"><?php _e("Checkout","hc") ?></a>
        </p>
    </div>
</div>
<?php }
}
function hc_get_now($arr,$key,$default = "") {
    $result = "";
    if (is_string($key)) {
        if(isset($arr[$key])) $result = $arr[$key];
        else $result = $default;
    } else {
        $count = count($key);
        if ($count == 1) {
            if(isset($arr[$key[0]])) $result = $arr[$key[0]];
            else $result = $default;
        }
        if ($count == 2) {
            if(isset($arr[$key[0]][$key[1]])) $result = $arr[$key[0]][$key[1]];
            else $result = $default;
        }
        if ($count == 3) {
            if(isset($arr[$key[0]][$key[1]][$key[2]])) $result = $arr[$key[0]][$key[1]][$key[2]];
            else $result = $default;
        }
        if ($count == 4) {
            if(isset($arr[$key[0]][$key[1]][$key[2]][$key[3]])) $result = $arr[$key[0]][$key[1]][$key[2]][$key[3]];
            else $result = $default;
        }
        if ($count == 5) {
            if(isset($arr[$key[0]][$key[1]][$key[2]][$key[3]][$key[4]])) $result = $arr[$key[0]][$key[1]][$key[2]][$key[3]][$key[4]];
            else $result = $default;
        }
    }
    if ($result == "") return $default;
    else return $result;
}
function hc_get_fonts_url($url_attr) {
    $font_url = '';
    if ( 'off' !== _x( 'on', 'Google font: on or off','hc') ) {
        $font_url = add_query_arg( 'family', $url_attr, "https://fonts.googleapis.com/css" );
    }
    return $font_url;
}
function hc_get_pages_list($selected_id = "") {
?>
<select name="pages-list" id="pages-list">
    <option value="">--</option>
    <?php
    $pages = get_pages();
    foreach ( $pages as $page ) {
        $option = '<option data-link="' . get_page_link( $page->ID ) . '" value="' . $page->ID . '" ' . (($selected_id == $page->ID) ? "selected":"") .' >';
        $option .= $page->post_title;
        $option .= '</option>';
        echo $option;
    }
    ?>
</select>
<?php
}

//AJAX
function hc_get_templates() {
    if (file_exists(HC_PLUGIN_PATH . '/custom/templates.php')) {
        include(HC_PLUGIN_PATH . "/custom/templates.php");
        $template_id = $_POST['template_id'];
        if (isset($HC_TEMPLATES) && isset($HC_TEMPLATES[$template_id])) {
            echo $HC_TEMPLATES[$template_id];
        } else {
            echo "error";
        }  
    }
    die();
}
function hc_ajax_save_option() {
    echo update_option($_POST['option_name'], $_POST['content']);
    die();
}
function hc_wp_wysiwyg() {
    $editor_id = $_POST['editor_id'];
    echo '<div data-hc-component="wordpress_editor">';
    wp_editor('', $editor_id, array(
             'media_buttons' => true,
             'textarea_rows' => 5,
             'quicktags'     => true,
             'editor_class' => $editor_id
             ));
    echo '</div>';
    die();
}
function hc_export_theme_settings() {
    $string_arr = $_POST['framework_y_settings'];
    if (strlen($string_arr) > 0) {
        $all_settings_arr  = json_decode(stripslashes($string_arr));
        $val = json_encode($all_settings_arr);
        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }
        if(!file_put_contents(HC_PLUGIN_PATH . '/export.json', $val)) {
            die("error");
        } else {
            die(HC_PLUGIN_URL . '/export.json');
        }
    }
    die("error");
}
function hc_get_wc_cart_items() {
    $arr = array();
    if (class_exists('WooCommerce')) {
        global $woocommerce;
        $items = $woocommerce->cart->get_cart();
        foreach ($items as $key => $value ) {
            $title = $value['data']->get_title();
            $quantity =  intval($value['quantity']);
            $price = $value['data']->get_price();
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($value['product_id']), 'single-post-thumbnail');
            $link = get_permalink($value['product_id']);
            array_push($arr, array("title" => $title, "image" => $image[0],"link" => $link,"price" => $price,"quantity" => $quantity));
        }
    }
    die(json_encode($arr,JSON_PRETTY_PRINT));
}
function remove_woocommerce_default_shop( $args, $post_type ) {
    if ( $post_type == "product" ) {
        $args['has_archive'] = true;
    }
    return $args;
}

add_action('wp_ajax_hc_ajax_save_option', 'hc_ajax_save_option');
add_action('wp_ajax_hc_demo_import', 'hc_demo_import');
add_action('wp_ajax_hc_export_theme_settings', 'hc_export_theme_settings');
add_action('wp_ajax_hc_download_demo', 'hc_download_demo');
add_action('wp_ajax_hc_start_manual_demo', 'hc_start_manual_demo');
add_action('wp_ajax_nopriv_hc_ajax_save_option', 'hc_ajax_save_option');
add_action('wp_ajax_hc_wp_wysiwyg', 'hc_wp_wysiwyg');
add_action('wp_ajax_hc_get_templates', 'hc_get_templates');
add_action('wp_ajax_nopriv_hc_get_wc_cart_items', 'hc_get_wc_cart_items');
add_action('wp_ajax_hc_get_wc_cart_items', 'hc_get_wc_cart_items');
add_filter( 'register_post_type_args', 'remove_woocommerce_default_shop', 20, 2 );

//add_action('wp_ajax_nopriv_hc_wp_wysiwyg', 'hc_wp_wysiwyg');
//add_action('wp_ajax_hc_wp_wysiwyg', 'hc_wp_wysiwyg');
//LOAD CUSTOM.PHP
if (file_exists(HC_PLUGIN_PATH. "/custom/custom.php")) require_once(HC_PLUGIN_PATH. "/custom/custom.php");
function hc_archive_engine() {
    include_once(HC_PLUGIN_PATH ."/global-content.php");
    global $HC_IS_ARCHIVE;
    global $HC_PT_CATEGORY;
    global $wp_query;
    $HC_IS_ARCHIVE = true;
    $current_post_type = $wp_query->query_vars['post_type'];
    $query_count = count($wp_query->tax_query->queries);
    $query_val = "";
    $plural_name = "posts";
    $lists_archives;
    $archive_post_id = "";
    $tag = "";
    $date = "";
    $title = "";
    $subtitle = "";
    if ($query_count > 0) $query_val = $wp_query->tax_query->queries[0]['terms'][0];
    if ($current_post_type == "") $current_post_type = get_post_type();
    if ($current_post_type != 'post') {
        $lists_archives = get_option('y_theme_lists_archives');
        $plural_name = $lists_archives[$current_post_type][0];
    }
    if (is_day()) $date = get_the_date();
    if (is_month()) $date = get_the_date('F Y');
    if (is_year()) $date = get_the_date('Y');
    if (is_author()) {
        $title = ucfirst($plural_name) . esc_attr__(" by ","hc") . ucfirst(get_the_author());
        $subtitle = esc_attr__("Author archive","hc");
    }
    if ($query_count > 0) {
        $tag = $wp_query->queried_object->name;
        $title = ucfirst($tag);
        $subtitle = ucfirst($tag) . " " . $plural_name;
    }
    if ($date != "") {
        $title = ucfirst($date);
        $subtitle = ucfirst($plural_name);
    }
    if (is_category() || is_tag() || $query_val != "") { 
        $type = " " . __("category","hc") . ": ";
        if (is_tag()) $type = " " . __("tag","hc") . ": ";
        $subtitle = ucfirst($plural_name) . $type . $query_val;
    }
    if ($query_count > 0) $HC_PT_CATEGORY = $query_val;
    if ($current_post_type != 'post') {
        if ($lists_archives != false) {
            $archive_post_id = hc_get_now($lists_archives,$current_post_type,"");
            if ($archive_post_id == "") {
                //Compatibility block
                $wp_query = new WP_Query(array('post_type' => 'y-post-types'));
                if ( $wp_query->have_posts() ) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                        $content = json_decode(get_the_content(), true);
                        if ($content['post_type_setting']['settings']['slug'] == $current_post_type) {
                            $archive_post_id = $content['post_type_setting']['settings']['archive_page_id'];
                            break;
                        }
                        if ($title == "" && isset($content['main-title']['title'])) {
                            $title = $content['main-title']['title'];
                            $subtitle = $content['main-title']['subtitle'];
                        }
                    }
                    wp_reset_postdata();
                }
            } else $archive_post_id = $archive_post_id[1];
        }
    } else $archive_post_id = hc_get_setting('blog-page');
    if ($title == "") {
        $title = ucfirst($current_post_type);
    }
    if ($archive_post_id != "") {
        $HC_PAGE_ARR = json_decode(get_post($archive_post_id)->post_content, true);
        if (key_exists('main-title',$HC_PAGE_ARR)) {
            $HC_PAGE_ARR['main-title']['title'] = $title;
            $HC_PAGE_ARR['main-title']['subtitle'] = $subtitle;
        }
        get_header();
        hc_get_title($archive_post_id, $title, $subtitle);
        hc_the_sidebar_content($archive_post_id);
    } else {
        hc_set_default_page_content_arr();
        get_header();
        if ($date != "") hc_default_blog("","",$date);
        else  hc_default_blog("",$tag);
    }
}
function hc_load_taxonomies($hc_all_custom_post_types) {
    for ($i = 0; $i < count($hc_all_custom_post_types); $i++) {
        register_taxonomy( $hc_all_custom_post_types[$i] . '-cat', $hc_all_custom_post_types[$i], array(
           'label'        => esc_attr__('Categories','hc'),
           'rewrite'      => array( 'slug' => $hc_all_custom_post_types[$i]. '-cat','with_front' => false),
           'hierarchical' => true
        ));
    }
}

// POST TYPES
// =============================================================================
// Create the Post Type used for generate the custom Post Types - Lists of user
// -----------------------------------------------------------------------------
function hc_create_post_types() {
	register_post_type( 'y-post-types',
		array(
			'labels' => array(
				'name' => esc_attr__('Lists','hc'),
				'singular_name' => esc_attr__('List','hc'),
                'add_new_item' => esc_attr__('Add New List','hc'),
                'edit_item' => esc_attr__('Edit List','hc'),
                'not_found' => esc_attr__('No Lists Found','hc'),
                'not_found_in_trash' => esc_attr__('No Lists Found in Trash','hc')
			),
			'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
			'has_archive' => false,
			'rewrite' => array('slug' => 'y-post-types'),
            'menu_position' => 99,
            'menu_icon' => 'dashicons-editor-ul'
		)
	);
}
add_action('init','hc_create_post_types');
function hc_create_custom_post_types_plugin($post_types_arr,$hc_all_post_types,$hc_all_custom_post_types) {
    for ($i = 0; $i < count($post_types_arr); $i++) {
        $item = $post_types_arr[$i]['post_type_setting']['settings'];
        if (count($item['slug']) > 0) {
            register_post_type($item['slug'],
               array(
                   'labels' => array(
                       'name' => esc_attr__($item['name'],'hc'),
                       'singular_name' => esc_attr__($item['name_singular'],'hc'),
                       'add_new_item' => esc_attr__('Add New Item','hc'),
                       'edit_item' => esc_attr__('Edit Item','hc'),
                       'not_found' => esc_attr__('No Items Found','hc'),
                       'not_found_in_trash' => esc_attr__('No Items Found in Trash','hc')
                   ),
                   'public' => true,
                   'has_archive' => true,
                   'menu_icon' => str_replace("dashicons ","",$item['icon']),
                   'supports' => array('title','editor','comments','revisions','excerpt','thumbnail'),
                   'rewrite' => array('slug' => $item['slug'],'with_front' => false)
               )
            );
            array_push($hc_all_post_types,array($item['name'],$item['slug']));
            array_push($hc_all_custom_post_types,$item['slug']);
        }
    }
    return array($hc_all_post_types,$hc_all_custom_post_types);
}
function hc_download_demo() {
    if (HC_IS_CUSTOM_PANEL) { 
        include(HC_PLUGIN_PATH . "/custom/custom-options-panel.php");
        if (isset($HC_CUSTOM_PANEL["demos_url"])) {
            $demo_slug = $_POST['demo_slug'];
            $path = ABSPATH . "wp-content/uploads/demo-import";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if ($demo_slug != "") {
                $files = glob($path . "/*");
                foreach($files as $file){
                    if(is_file($file))
                        unlink($file);
                }
                $file_path = $path . "/demo.zip";
                $download_url = $HC_CUSTOM_PANEL["demos_url"] . "/" . $demo_slug . "/demo.zip";
                $file = hc_download_file($download_url);
                $result = file_put_contents($file_path, $file);
                if ($result != false) {
                    WP_Filesystem();
                    $unzipfile = unzip_file($file_path, $path);
                    if ($unzipfile)  die("success"); else die("error");
                } else die("error file_put_contents");
            }
            die("error_no_demo_slug");
        } else die("error_no_demos_url");
    } else die("error_custom_panel_file");
}
function hc_start_manual_demo() { 
    $path = ABSPATH . "wp-content/uploads/demo.zip";
    if (file_exists($path)) {
        $path_dest = ABSPATH . "wp-content/uploads/demo-import";
        if (!file_exists($path_dest)) {
            mkdir($path_dest, 0777, true);
        } else {
            $files = glob($path_dest . "/*");
            foreach($files as $file){
                if(is_file($file))
                    unlink($file);
            }
        }
        WP_Filesystem();
        $unzipfile = unzip_file($path, $path_dest);
        if ($unzipfile) die("success"); else die("error");
    }  
    die("nofile");
}
function hc_demo_import() {
    $step = $_POST['step'];
    $extra = $_POST['extra'];
    $UPLOAD_PATCH = ABSPATH . "wp-content/uploads/demo-import/";
    require_once HC_PLUGIN_PATH . "/admin/autoimporter.php";
    if (!class_exists('Auto_Importer')) die('Auto_Importer not found');
    //Step 1
    if ($step == 1) {
        $files_num = "";
        if ($extra != "") {
            $files_num = "-" . $extra;
        } else {
            try {
                wp_delete_nav_menu("Main menu");
                wp_delete_nav_menu("Footer menu");
                wp_delete_nav_menu("Top menu");
            }
            catch (Exception $exception) {}
        }
        if (file_exists($UPLOAD_PATCH . 'demo-all-contents' . $files_num . '.xml')) {
            auto_import(array(
            'file'        => $UPLOAD_PATCH . 'demo-all-contents' . $files_num . '.xml',
            'map_user_id' => 1
           ));
        }
        die('success');
    }
    //Step 2
    if ($step == 2) {
        if (file_exists($UPLOAD_PATCH . 'demo-list-1.xml')) {
            auto_import(array(
               'file'        => $UPLOAD_PATCH . 'demo-list-1.xml',
               'map_user_id' => 1
             ));
            die('success');
        }
    }
    //Step 3
    if ($step == 3) {
        $file = "";
        if (file_exists($UPLOAD_PATCH . 'export.json')) {
            $path = HC_SITE_URL . '/wp-content/uploads/demo-import/export.json';
            $file = hc_download_file($path);
        }
        if (strlen($file) > 0) {
            $tmp = json_decode($file,true);
            update_option('framework_y_theme_settings', $tmp);
        }
        die('success');
    }
    //Step 4
    if ($step == 4) {
        if (class_exists('RevSliderSlider')) {
            if (file_exists(ABSPATH . 'wp-content/uploads/demo-import/main-slider.zip')) {
                if (!RevSliderSlider::isAliasExists("main-slider")) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost(true, true, ABSPATH . 'wp-content/uploads/demo-import/main-slider.zip');
                }
            }
            for ($i = 2; $i < 11; $i++) {
                if (file_exists(ABSPATH . 'wp-content/uploads/demo-import/main-slider-' . $i . '.zip')) {
                    if (!RevSliderSlider::isAliasExists("main-slider-" . $i)) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost(true, true, ABSPATH . 'wp-content/uploads/demo-import/main-slider-' . $i . '.zip');
                    }
                }
            }
        }
        die('success');
    }
    //Step 5
    if ($step == 5) {
        $page_home = get_page_by_title("Home");
        if ($page_home !== null) {
            update_option( 'page_on_front', $page_home->ID);
            update_option( 'show_on_front', 'page' );
        }
        $main_menu = wp_get_nav_menu_object("Main menu");
        $footer_menu = wp_get_nav_menu_object("Footer menu");
        $top_menu = wp_get_nav_menu_object("Top menu");
        $locations = array('header-menu'=>'','footer-menu'=>'','extra-menu'=>'');
        if ($main_menu != false) $locations['header-menu'] = $main_menu->term_id;
        if ($footer_menu != false) $locations['footer-menu'] = $footer_menu->term_id;
        if ($top_menu != false) $locations['extra-menu'] = $top_menu->term_id;
        set_theme_mod( 'nav_menu_locations', $locations );
        die('success');
    }
    die('error_no_steps');
}
if (!class_exists('WP_Customize_Control'))
    return NULL;
/**
 * A class to create a dropdown for all google fonts
 */
class Google_Font_Dropdown_Custom_Control extends WP_Customize_Control {
    private $fonts = false;
    public function __construct($manager, $id, $args = array(), $options = array())
    {
        $this->fonts = $this->get_fonts();
        parent::__construct( $manager, $id, $args );
    }
    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content() {
        if(!empty($this->fonts)) {
?>
<label>
    <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
    <select <?php $this->link(); ?>>
        <?php
            foreach ( $this->fonts as $k => $v) {
                printf('<option value="%s" %s>%s</option>', $k, selected($this->value(), $k, false), $v->family);
            }
        ?>
    </select>
</label>
<?php
        }
    }
    /**
     * Get the google fonts from the API or in the cache
     *
     * @param  integer $amount
     *
     * @return String
     */
    public function get_fonts( $amount = 30 )
    {
        $selectDirectory = get_stylesheet_directory().'/wordpress-theme-customizer-custom-controls/select/';
        $selectDirectoryInc = get_stylesheet_directory().'/inc/wordpress-theme-customizer-custom-controls/select/';
        $finalselectDirectory = '';
        if(is_dir($selectDirectory))
        {
            $finalselectDirectory = $selectDirectory;
        }
        if(is_dir($selectDirectoryInc))
        {
            $finalselectDirectory = $selectDirectoryInc;
        }
        $fontFile = $finalselectDirectory . '/cache/google-web-fonts.txt';
        //Total time the file will be cached in seconds, set to a week
        $cachetime = 86400 * 7;
        if(file_exists($fontFile) && $cachetime < filemtime($fontFile))
        {
            $content = json_decode(hc_download_file($fontFile));
        } else {
            $googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key={API_KEY}';
            $fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );
            $fp = fopen($fontFile, 'w');
            fwrite($fp, $fontContent['body']);
            fclose($fp);
            $content = json_decode($fontContent['body']);
        }
        if($amount == 'all')
        {
            return $content->items;
        } else {
            return array_slice($content->items, 0, $amount);
        }
    }
}
function hc_download_file($url) {
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $file = curl_exec($ch);
    curl_close($ch);
    return $file;
}
//HEADER
function hc_header_engine() {
    global $HC_TEMPLATE_SLUG;
    global $HC_PAGE_ARR;
    if ($HC_TEMPLATE_SLUG == "") $HC_TEMPLATE_SLUG = str_replace(".php","",get_page_template_slug());
    $menu_arr = hc_get_menu_array('header-menu');
    $hc_menu_type = hc_get_setting('menu-type');
    $classes = hc_get_container_template();
    $layout_type = hc_get_setting('layout-type');
    if ($HC_TEMPLATE_SLUG == "template-background-image" || $HC_TEMPLATE_SLUG == "template-background-slider" || $HC_TEMPLATE_SLUG == "template-background-video") {
        $classes .= " overlay-content";
    }
    if ($layout_type == "boxed") {
        $classes .= " content-parallax";
    }
?>
<div id="preloader"></div>
<?php
    if ($HC_TEMPLATE_SLUG == "template-background-image" || (hc_get_setting('site-background') != "" && $layout_type == "boxed" && $HC_TEMPLATE_SLUG != "template-background-video" && $HC_TEMPLATE_SLUG != "template-background-slider")) {
        $img = "";
        if ($HC_TEMPLATE_SLUG == "template-background-image") $img = hc_get_img(hc_get_now($HC_PAGE_ARR,array("template_setting","template_image","image")),"hd");
        else $img = hc_get_setting('site-background');
        echo '<div class="background-page" style="background-image:url('. esc_url($img) .')"></div>';
    }
    if ($HC_TEMPLATE_SLUG == "template-background-slider") { ?>
<div class="background-page overlay-container">
    <div class="flexslider slider" data-options="directionNav:false,animation:fade,slideshowSpeed:<?php echo esc_attr($HC_PAGE_ARR["template_setting"]["settings"]["speed"]); ?>">
        <ul class="slides">
            <?php
        $arr = $HC_PAGE_ARR["template_setting"]["template_slider"]["slides"];
        for ($i = 0; $i < count($arr); $i++) echo '<li><div class="bg-cover" style="background-image:url(' . hc_get_img($arr[$i]["link"],"hd") . ')"></div></li>';
            ?>
        </ul>
    </div>
</div>
<?php }
    if ($HC_TEMPLATE_SLUG == "template-background-video") {  ?>
    <div class="background-page overlay-container">
        <video autoplay="autoplay" loop muted poster="<?php echo hc_get_img($HC_PAGE_ARR["template_setting"]["template_video"]["image"],"hd"); ?>" class="background-fullscreen">
            <source src="<?php echo esc_url($HC_PAGE_ARR["template_setting"]["template_video"]["link"]); ?>" type="video/mp4">
        </video>
    </div>
<?php }
    echo '<div class="'.$classes . '">';
    $hc_is_transparent = hc_is_setted('menu-transparent');
    $hc_menu_pos = hc_get_setting('menu-position');
    $hc_logo_margin_top = hc_get_setting('logo-margin-top');
    if (strlen($hc_logo_margin_top) != 0) $hc_logo_margin_top = "margin-top: " . $hc_logo_margin_top . "px";
    $hc_logo_2_margin_top = hc_get_setting('logo-2-margin-top');
    if (strlen($hc_logo_2_margin_top) != 0) $hc_logo_2_margin_top = "margin-top: " . $hc_logo_2_margin_top . "px";
    $hc_menu_animation = hc_get_setting('menu-animation');
    if (strlen($hc_menu_animation) > 0) $hc_menu_animation = "data-menu-anima=" . $hc_menu_animation;
    if ($hc_menu_type == "side") include(HC_PLUGIN_PATH . "/headers/menu-side.php");
    elseif ($hc_menu_type == "subline") include(HC_PLUGIN_PATH . "/headers/menu-subline.php");
    else include(HC_PLUGIN_PATH . "/headers/menu-classic.php");
}
function hc_get_post_tags(&$item,$slug,$date=true,$author=true,$comments=true,$categories=true,$share=false) {
?>
        <div class="tag-row icon-row">
            <?php
    if ($date) hc_echo(date_i18n('d M Y', $item["date"]),'<span><i class="fa fa-calendar"></i><a> ','</a></span>');
    if ($categories) hc_echo(hc_get_post_categories($item["id"],$slug),'<span><i class="fa fa-bookmark"></i> ','</span>');
    if ($author) hc_echo(ucfirst(get_the_author_meta('display_name', $item["author_id"])),'<span><i class="fa fa-pencil"></i><a> ','</a></span>');
    if ($comments) hc_echo($item["comments_count"],'<span><i class="fa fa-comment-o"></i><a> ','</a></span>');
    if ($share) {
            ?>
            <div class="social-group-button">
                <div class="social-button" data-anima="pulse-vertical" data-trigger="hover">
                    <i class="fa fa-share-alt"></i>
                </div>
                <div class="btn-group social-group">
                    <a target="_blank" href="<?php echo esc_url($item["link"]) ?>">
                        <i data-social="share-facebook" class="fa fa-facebook circle"></i>
                    </a>
                    <a target="_blank" href="<?php echo esc_url($item["link"]) ?>">
                        <i data-social="share-twitter" class="fa fa-twitter circle"></i>
                    </a>
                    <a target="_blank" href="<?php echo esc_url($item["link"]) ?>">
                        <i data-social="share-google" class="fa fa-google circle"></i>
                    </a>
                    <a target="_blank" href="<?php echo esc_url($item["link"]) ?>">
                        <i data-social="share-linkedin" class="fa fa-linkedin circle"></i>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
}

function hc_get_the_excerpt($excerpt = "",$length = 500) {
    $text = $excerpt;
    if (strlen($text) < 5) {
        $content = get_the_content(get_the_id());
        $overflow = false;
        $arr = explode("hc_text_block",$content);
        for ($i = 1; $i < count($arr); $i++) {
            if (strlen($text) < $length) {
                $pos = strpos($arr[$i], 'content') + 10;
                $now = mb_substr($arr[$i],$pos);
                $now = mb_substr($now,0,strpos($now, '}')-1);
                $now = str_replace("\\n","",$now);
                $text .= " " . $now;
            } else { 
                $overflow = true;
            }
        }    
        if (strlen($text) > $length) {
            $text = mb_substr($text,0,$length);
            $text .= " ...";
        }
        if ($overflow) $text .= " ...";
    }
    return strip_tags($text);
}

//WIDGETS
function hc_widgets_init() {
    if (class_exists('WooCommerce')) {
        register_sidebar(array(
           'name'          => esc_attr__('Woocommerce Shop Sidebar Left','hc'),
           'id'            => 'woocommerce_shop_left_side_bar',
           'description'   => esc_attr__('Shop sidebar, enable it on Theme options > List Post Types','hc'),
           'before_widget' => '<div class="list-group list-blog">',
           'after_widget'  => '</div>',
           'before_title'  => '<p class="list-group-item active">',
           'after_title'   => '</p>',
       ));
        register_sidebar(array(
          'name'          => esc_attr__('Woocommerce Shop Sidebar Right','hc'),
          'id'            => 'woocommerce_shop_right_side_bar',
          'description'   => esc_attr__('Shop sidebar, enable it on Theme options > List Post Types','hc'),
          'before_widget' => '<div class="list-group list-blog">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="list-group-item active">',
          'after_title'   => '</p>',
      ));
        register_sidebar(array(
          'name'          => esc_attr__('Woocommerce Item Sidebar Left','hc'),
          'id'            => 'woocommerce_single_left_side_bar',
          'description'   => esc_attr__('Single product sidebar, enable it on Theme options > List Post Types','hc'),
          'before_widget' => '<div class="list-group list-blog">',
          'after_widget'  => '</div>',
          'before_title'  => '<p class="list-group-item active">',
          'after_title'   => '</p>',
      ));
        register_sidebar(array(
           'name'          => esc_attr__('Woocommerce Item Sidebar Right','hc'),
           'id'            => 'woocommerce_single_right_side_bar',
           'description'   => esc_attr__('Single product sidebar, enable it on Theme options > List Post Types','hc'),
           'before_widget' => '<div class="list-group list-blog">',
           'after_widget'  => '</div>',
           'before_title'  => '<p class="list-group-item active">',
           'after_title'   => '</p>',
       ));
    }
}
add_action('widgets_init', 'hc_widgets_init');

//FOOTER
function hc_get_footer_content($index) {
    if (function_exists('icl_object_id')) {
        $content = hc_get_setting('footer-content-' . $index . '-' . ICL_LANGUAGE_CODE);
        if ($content == "") $content = hc_get_setting('footer-content-' . $index);
        return $content;
    } else {
        return hc_get_setting('footer-content-' . $index);
    }
}
function hc_get_footer_copyright() {
    if (function_exists('icl_object_id')) {
        $content = hc_get_setting('footer-copyright-'  . ICL_LANGUAGE_CODE);
        if ($content == "") $content = hc_get_setting('footer-copyright');
        return $content ;
    } else {
        return hc_get_setting('footer-copyright');
    }
}
function hc_get_footer_engine() {
    global $HC_PAGE_ARR;
    $footer_class = "";
    if (hc_get_setting('footer-type') == "parallax") $footer_class = "footer-sides footer-parallax";
    if (hc_get_setting('footer-type') == "minimal")  $footer_class = "footer-center footer-minimal";
    if (hc_get_setting('bg-footer') != "") $footer_class .= " footer-bg bg-cover";
    if (hc_is_setted('footer-wide')) $footer_class .= " wide-area";
    $footer_class .= " " . hc_get_setting('footer-css');
    $col_1 = "col-md-3 footer-left"; 
    $col_2 = "col-md-6 footer-center"; 
    $col_3 = "col-md-3 footer-right"; 
    if (hc_get_setting('footer-cols') == "4-4-4") {  
        $col_1 = "col-md-4 footer-left"; 
        $col_2 = "col-md-4 footer-left";
        $col_3 = "col-md-4 footer-left";
    }
    if (hc_get_setting('footer-cols') == "6-3-3") { 
        $col_1 = "col-md-6 footer-left"; 
        $col_2 = "col-md-3"; 
        $col_3 = "col-md-3"; 
    }
    if (hc_get_setting('footer-cols') == "6-6") { 
        $col_1 = "col-md-6 footer-left"; 
        $col_2 = ""; 
        $col_3 = "col-md-6 footer-right"; 
    }
    $footer_content_1 = hc_get_footer_content(1);
    $footer_content_2 = hc_get_footer_content(2);
    $footer_content_3 = hc_get_footer_content(3);
    $footer_copyright = hc_get_footer_copyright();

    if ($footer_content_1 == "" && $footer_content_2 == "" && $footer_content_3 == "" && $footer_copyright == "") { ?>
<footer class="default-wp-footer">
    <div class="content">
        <div class="container">
            <div><?php echo esc_attr__("Copyright Schiocco | All Rights Reserved | Powered by","yellowbusiness") ?> <a href="<?php echo esc_url("http//wordpress.org") ?>"><?php echo esc_attr("WordPress")?></a></div>
        </div>
    </div>
</footer>  
<?php } else { ?>
<?php if (hc_get_setting('scroll-top-btn') != "") echo '<i class="scroll-top scroll-top-mobile fa fa-sort-asc' . ((hc_get_setting('scroll-top-btn') =="always") ? " show" : "") . '"></i>'; ?>
<footer class="<?php echo esc_attr($footer_class) ?>" <?php if (hc_get_setting('bg-footer') != "") echo 'style="background-image:url(' . esc_url(hc_get_setting('bg-footer')) .')"' ?>>
    <div class="content">
        <div class="container">
            <?php if (hc_get_setting('footer-type') != "minimal") { ?>
            <div class="row">
                <div class="<?php echo esc_attr($col_1) ?> footer-left">
                      <?php hc_echo(html_entity_decode(do_shortcode($footer_content_1)),"","") ?>
                </div>
                <?php if ($col_2 != "") { ?>
                <div class="<?php echo esc_attr($col_2) ?>">
                    <?php hc_echo(html_entity_decode(do_shortcode($footer_content_2)),"","") ?>
                    <?php if (hc_get_setting('footer-social') == "checked") { ?>
                    <hr class="space xs" />
                    <div class="btn-group navbar-social">
                        <div class="btn-group social-group">
                            <?php hc_get_social_links() ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php  } ?>
                <div class="<?php echo esc_attr($col_3) ?> ">
                    <?php 
                      hc_echo(html_entity_decode(do_shortcode($footer_content_3)),'','<span class="space"></span><span class="space"></span>'); 
                      if ($col_2 == "" && hc_get_setting('footer-social') == 'checked') { 
                          echo '<div class="btn-group navbar-social"><div class="btn-group social-group">';  
                          hc_get_social_links(); 
                          echo '</div></div>'; 
                      }
                      $menu_arr = hc_get_menu_array('footer-menu');
                      if (count($menu_arr) > 0) { ?>
                    <ul class="fa-ul text-s">
                        <?php for ($i = 0; $i < count($menu_arr); $i++) { ?>
                        <li><i class="fa-li <?php echo esc_attr($menu_arr[$i][4]) ?>"></i><a href="<?php echo esc_attr($menu_arr[$i][1]) ?>"><?php echo esc_attr($menu_arr[$i][0]) ?></a></li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
            <?php if (hc_get_setting('footer-type') == "minimal") { ?>
            <div class="row footer-main">
                <?php echo wp_kses_post(html_entity_decode(hc_get_setting('footer-content-2'))) ?>
                <?php if (hc_get_setting('footer-social') == "checked") { ?>
                <hr class="space xs" />
                <div class="btn-group navbar-social">
                    <div class="btn-group social-group">
                        <?php hc_get_social_links() ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php }  ?>
        </div>
        <?php hc_echo(html_entity_decode($footer_copyright),'<div class="row copy-row"><div class="col-md-12 copy-text">',' </div></div>') ?>
    </div>
</footer>
<?php }
    if (hc_get_now($HC_PAGE_ARR["page_setting"],"lightbox")) { 
        $t = $HC_PAGE_ARR["page_setting"]["lightbox"];
        if ($t["active"]) {
            $target = $t["new_window"];
            if ($target == 1) $target = ' data-click-target="_blank"';
            $data = hc_get($t["animation"],'data-lightbox-anima="','" ') . hc_get($t["link"],'data-click="','" ') . $target . hc_get($t["expire"],'data-expire-anima="','" ') . hc_get(hc_get_img($t["media_link"]),'data-link="','"');
            echo '<div id="page-lightbox" class="box-lightbox ' . $t["lightbox_size"] . '" ' . $data . ' data-trigger="load">' . $t["content"] . '</div>';
        }   
    }
    if (hc_get_now($HC_PAGE_ARR["page_setting"],"popup")) { 
        $t = $HC_PAGE_ARR["page_setting"]["popup"];
        if ($t["active"]) {
            if (!$t["full_width"]) {
?>
<div id="page-popup" class="popup-banner <?php echo "popup-" . $t["position"] ?>" <?php hc_echo($t["animation"],'data-popup-anima="','"'); hc_echo($t["expire"],' data-expire="','"'); ?> data-trigger="load" style="<?php if (strlen($t["link"]) > 0) echo ' cursor:pointer'; ?>">
    <i class="fa fa-times popup-close"></i>
    <div class="bs-panel panel-default">
        <?php hc_echo($t["title"],'<div class="panel-heading">','</div>') ?>
        <div class="panel-body" <?php hc_echo(esc_url($t["link"]),' data-click="','" data-click-trigger="#page-popup .panel-body"'); if ($t["new_window"] == "true") echo ' data-click-target="_blank"'; ?>>
            <?php hc_echo(hc_get_img($t['image']),'<img alt="" src="','" /><br><br>'); echo $t["text"]; ?>
        </div>
    </div>
</div>
<?php
            } else { ?>
<div id="page-popup" class="popup-banner <?php echo "full-width-" . (($t["position"] == "top-right" || $t["position"] == "top-left") ? "top":"bottom") ?>"
<?php hc_echo($t["animation"],'data-popup-anima="','"'); hc_echo($t["expire"],' data-expire="','"'); ?> data-trigger="load" style="<?php if (count($t["link"]) > 0) echo ' cursor:pointer'; ?>">
    <i class="fa fa-times popup-close"></i>
    <div <?php hc_echo(esc_url($t["link"]),' data-click="','" data-click-trigger="#page-popup div"'); if ($t["new_window"] == "true") echo ' data-click-target="_blank"';  ?>><?php echo $t["text"]; ?></div>
</div>
<?php }
        }
    }
}
function hc_the_sidebar_content($archive_post_id) { 
    $sidebar = get_post_meta($archive_post_id, 'wptf-sidebar');
    $woocommerce_prefix = "";
    $sw = array("left"=>"col-md-3","right"=>"col-md-3","content"=>"col-md-9");
    if (count($sidebar) > 0) {
        $sidebar = $sidebar[0];
        if (defined("HC_PLUGIN_PATH") && hc_get_setting("shop-page") == $archive_post_id) $woocommerce_prefix = "woocommerce_shop_";
        if (defined("HC_PLUGIN_PATH")) $sw = hc_get_sidebars_width($sidebar);
    } else $sidebar = "";
    if ($sidebar != "") {?>
<div class='sidebar-cnt'> 
<div class="container content <?php if ($sidebar != "") echo "sidebar-content"; ?>">
    <?php }
    if ($sidebar == "left") { ?>
    <div class="row">
        <div class="<?php echo esc_attr($sw["left"]) ?> widget">
            <?php if (is_active_sidebar("left_side_bar")) dynamic_sidebar($woocommerce_prefix . "left_side_bar"); ?>
        </div>
        <div class="<?php echo esc_attr($sw["content"]) ?>">
            <?php echo hc_get_hc_content($archive_post_id) ?>
        </div>
    </div>
    <?php  }
    if ($sidebar == "right") { ?>
    <div class="row">
        <div class="<?php echo esc_attr($sw["content"]) ?>">
            <?php echo hc_get_hc_content($archive_post_id) ?>
        </div>
        <div class="<?php echo esc_attr($sw["right"]) ?> widget">
            <?php if (is_active_sidebar("right_side_bar")) dynamic_sidebar($woocommerce_prefix . "right_side_bar"); ?>
        </div>
    </div>
    <?php
    }
    if ($sidebar == "right-left") { ?>
    <div class="row">
        <div class="<?php echo esc_attr($sw["left"]) ?> widget">
            <?php if (is_active_sidebar("left_side_bar")) dynamic_sidebar($woocommerce_prefix . "left_side_bar"); ?>
        </div>
        <div class="<?php echo esc_attr($sw["content"]) ?>">
            <?php echo hc_get_hc_content($archive_post_id) ?>
        </div>
        <div class="<?php echo esc_attr($sw["right"]) ?> widget">
            <?php if (is_active_sidebar("right_side_bar")) dynamic_sidebar($woocommerce_prefix . "right_side_bar"); ?>
        </div>
    </div>
    <?php  }
    if ($sidebar == "") {
        echo hc_get_hc_content($archive_post_id);
    }
    if ($sidebar != "") echo "</div></div>";
}
    ?>
