<?php
// =============================================================================
// POST_TYPES.PHP
// -----------------------------------------------------------------------------
// Hybric Composer post types admin components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. GRID LIST - POST TYPE - Show the items of selected custom Post Type - Lists with the grid component. Grid documentation and demo: framework-y.com/containers/list-grid.html
//   02. MASONRY LIST - POST TYPE - Show the items of selected custom Post Type - Lists with the masonry component. Masonry documentation and demo: framework-y.com/containers/list-masonry.html
//   03. SLIDER LIST - POST TYPE - Show the items of selected custom Post Type - Lists with the slider component. Slider documentation and demo: framework-y.com/containers/sliders.html
//   04. COVERFLOW LIST - POST TYPE - Show the items of selected custom Post Type - Lists with the coverflow component. Coverflow documentation and demo: framework-y.com/containers/sliders.html#coverflow
//   05. MENU - POST TYPE - Show the categories menu of selected custom Post Type - Lists with the inner menu component. Inner menu documentation and demo: framework-y.com/components/menu/menu-inner-horizontal.html
//   06. TAG CLOUD - POST TYPE - Show the tags of post's blog
// =============================================================================

function hc_html_categories() { 
    global $hc_all_post_types;
    ?>
<option data-taxonomy="" value="">All</option>
<?php 
    for ($i = 0; $i < count($hc_all_post_types); $i++) {
        if ($hc_all_post_types[$i][1] != "page" && $hc_all_post_types[$i][1] != "y-post-types" && $hc_all_post_types[$i][1] != "post" && $hc_all_post_types[$i][1] != "y-post-types-arc") {
            $catsArr = get_terms(array('taxonomy' => $hc_all_post_types[$i][1] . '-cat','hide_empty' => false));
            foreach ( $catsArr as $term ) { ?>
<option data-taxonomy="<?php echo esc_attr($term->taxonomy) ?>" value="<?php echo esc_attr($term->slug) ?>"><?php echo esc_attr($term->name) ?></option>
<?php }
        }
    }
    $catsArr = get_categories();
    foreach ( $catsArr as $term ) {
        if ($term->term_id > 1) { ?>
<option data-taxonomy="post" value="<?php echo esc_attr($term->slug) ?>"><?php echo esc_attr($term->name) ?></option>
<?php
        }
    }
}

function hc_html_post_types() { 
    global $hc_all_post_types; ?>
<option value="">--</option>
<?php for ($i = 0; $i < count($hc_all_post_types); $i++) { 
          if ($hc_all_post_types[$i][1] != "page" && $hc_all_post_types[$i][1] != "y-post-types" && $hc_all_post_types[$i][1] != "y-post-types-arc") { ?>
           <option value="<?php echo esc_attr($hc_all_post_types[$i][1]) ?>"><?php echo esc_attr($hc_all_post_types[$i][0]) ?></option>';
        <?php   }
      }
}
?>

<div id="cnt_hc_pt_grid_list">
    <div data-hc-id="_ID" data-hc-component="hc_pt_grid_list" data-hc-setting="main_content" class="hc-pt-grid-list hc-cnt-component">
        <input type="hidden" class="file_require" value="content_box">
        <input type="hidden" class="file_require" value="image_box">
        <input type="hidden" class="file_require" value="pagination">
        <?php hc_e_composer_item_menu("Grid list - List Post Type") ?>
        <div class="">
            <div class="input-row input-select">
                <p><?php _e("Post type","hc") ?></p>
                <select class="post-type-slug" data-hc-setting="post_type_slug">
                    <?php hc_html_post_types(); ?>
                </select>
            </div>
            <div class="button-inner-options big-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="divider"><?php _e("Grid options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Category","hc") ?></p>
                        <select class="post-type-category" data-hc-setting="post_type_category">
                            <?php hc_html_categories(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Columns","hc") ?></p>
                        <select data-hc-setting="column">
                            <option value="col-md-12">1</option>
                            <option value="col-md-6">2</option>
                            <option value="col-md-4">3</option>
                            <option value="col-md-3" selected>4</option>
                            <option value="col-md-2">6</option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Row height","hc") ?></p>
                        <select data-hc-setting="row">
                            <option value="" selected><?php _e("Auto","hc") ?></option>
                            <option value="row-1"><?php _e("Row","hc") ?> 1</option>
                            <option value="row-2"><?php _e("Row","hc") ?> 2</option>
                            <option value="row-3"><?php _e("Row","hc") ?> 3</option>
                            <option value="row-4"><?php _e("Row","hc") ?> 4</option>
                            <option value="row-5"><?php _e("Row","hc") ?> 5</option>
                            <option value="row-6"><?php _e("Row","hc") ?> 6</option>
                            <option value="row-7"><?php _e("Row","hc") ?> 7</option>
                            <option value="row-8"><?php _e("Row","hc") ?> 8</option>
                            <option value="row-9"><?php _e("Row","hc") ?> 9</option>
                            <option value="row-10"><?php _e("Row","hc") ?> 10</option>
                            <option value="row-11"><?php _e("Row","hc") ?> 11</option>
                            <option value="row-12"><?php _e("Row","hc") ?> 12</option>
                            <option value="row-13"><?php _e("Row","hc") ?> 13</option>
                            <option value="row-14"><?php _e("Row","hc") ?> 14</option>
                            <option value="row-15"><?php _e("Row","hc") ?> 15</option>
                            <option value="row-16"><?php _e("Row","hc") ?> 16</option>
                            <option value="row-17"><?php _e("Row","hc") ?> 17</option>
                            <option value="row-18"><?php _e("Row","hc") ?> 18</option>
                            <option value="row-19"><?php _e("Row","hc") ?> 19</option>
                            <option value="row-20"><?php _e("Row","hc") ?> 20</option>
                            <option value="row-21"><?php _e("Row","hc") ?> 21</option>
                            <option value="row-22"><?php _e("Row","hc") ?> 22</option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Margins","hc") ?></p>
                        <input data-hc-setting="margins" placeholder="5" type="text" data-mask="number">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Pagination type","hc") ?></p>
                        <select data-hc-setting="pagination_type" class="animations-list">
                            <option value=""><?php _e("None","hc") ?></option>
                            <option value="pagination_wp" selected><?php _e("Pagination","hc") ?></option>
                            <option value="pagination"><?php _e("HTML Pagination","hc") ?></option>
                            <option value="load_more"><?php _e("HTML Load more","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Items per page","hc") ?></p>
                        <input data-hc-setting="pag_items" placeholder="10" type="text" data-mask="number">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Navigation size","hc") ?></p>
                        <select data-hc-setting="button_size">
                            <option value="pagination-sm" selected><?php _e("Small","hc") ?></option>
                            <option value="pagination"><?php _e("Normal","hc") ?></option>
                            <option value="pagination-lg"><?php _e("Large","hc") ?></option>
                        </select>
                    </li>
                    <li class="divider"><?php _e("Box options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Box","hc") ?></p>
                        <select data-hc-setting="box" data-require-file="yes">
                            <option selected value="side_content"><?php _e("Side image","hc") ?></option>
                            <option value="top_icon_image"><?php _e("Top image","hc") ?></option>
                            <option value="side_icon"><?php _e("Side icon","hc") ?></option>
                            <option value="top_icon"><?php _e("Top icon","hc") ?></option>
                            <option value="multiple_box"><?php _e("Multiple box","hc") ?></option>
                            <option value="blog_side"><?php _e("Blog side","hc") ?></option>
                            <option value="blog_full_width"><?php _e("Blog full width","hc") ?></option>
                            <option value="blog_full_width_2"><?php _e("Blog full width 2","hc") ?></option>
                            <option value="team"><?php _e("Team","hc") ?></option>
                            <option value="image_half_content"><?php _e("Image half content","hc") ?></option>
                            <option value="image_side_content"><?php _e("Image side content","hc") ?></option>
                            <option value="image_full_content"><?php _e("Image full content","hc") ?></option>
                            <option value="image_buttons_content" data-require-file="lightbox"><?php _e("Image buttons content","hc") ?></option>
                            <option value="image_down_text"><?php _e("Image down text","hc") ?></option>
                            <option value="image_classic_box"><?php _e("Image classic box","hc") ?></option>
                            <option value="image_circle_center"><?php _e("Image circle center","hc") ?></option>
                            <option value="image_circle_center_2"><?php _e("Image circle center 2","hc") ?></option>
                            <option value="image_circle_half"><?php _e("Image circle half","hc") ?></option>
                            <option value="image_circle_bottom"><?php _e("Image circle bottom","hc") ?></option>
                            <option value="image_circle_background"><?php _e("Image circle background","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Boxed","hc") ?></p>
                        <input data-hc-setting="boxed" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Boxed inverse","hc") ?></p>
                        <input data-hc-setting="boxed_inverse" type="checkbox">
                    </li>
                    <?php hc_button_options() ?>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Hidden content","hc") ?></p>
                        <input data-hc-setting="hidden_content" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show extra 1","hc") ?></p>
                        <input data-hc-setting="extra_1" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show extra 2","hc") ?></p>
                        <input data-hc-setting="extra_2" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Content","hc") ?></p>
                        <select data-hc-setting="content">
                            <option value=""><?php _e("All","hc") ?></option>
                            <option value="subtitle"><?php _e("Subtitle","hc") ?></option>
                            <option value="description"><?php _e("Excerpt","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Title length","hc") ?></p>
                        <input type="text" data-hc-setting="title_length" placeholder="999" data-mask="number" />
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Excerpt length","hc") ?></p>
                        <input type="text" data-hc-setting="excerpt_length" placeholder="999" data-mask="number" />
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Title size","hc") ?></p>
                        <select data-hc-setting="title_size">
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option selected="selected" value=""><?php _e("Default","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="box_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Custom CSS","hc") ?></p>
                        <input type="text" data-hc-setting="custom_css" placeholder="" />
                    </li>
                    <li class="divider"><?php _e("Pagination options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="pag_lm_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Scroll top","hc") ?></p>
                        <input data-hc-setting="pag_scroll_top" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Centered","hc") ?></p>
                        <input data-hc-setting="pag_centered" type="checkbox">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Prev text","hc") ?></p>
                        <input data-hc-setting="pag_button_prev" placeholder="<?php _e("Prev","hc") ?>" value="<?php _e("Prev","hc") ?>" type="text">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Next text","hc") ?></p>
                        <input data-hc-setting="pag_button_next" placeholder="<?php _e("Next","hc") ?>" value="<?php _e("Next","hc") ?>" type="text">
                    </li>
                    <li class="divider"><?php _e("Load more options","hc") ?></li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Lazy load","hc") ?></p>
                        <input data-hc-setting="lm_lazy" type="checkbox">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Button text","hc") ?></p>
                        <input data-hc-setting="lm_button_text" placeholder="<?php _e("Load more","hc") ?>" value="<?php _e("Load more","hc") ?>" type="text">
                    </li>
                    <li class="hidden">
                        <input data-hc-setting="data_options_pagination" value="" type="text">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_pt_masonry_list">
    <div data-hc-id="_ID" data-hc-component="hc_pt_masonry_list" data-hc-setting="main_content" class="hc-pt-masonry-list hc-cnt-component">
        <input type="hidden" class="file_require" value="masonry">
        <?php hc_e_composer_item_menu("Masonry list - List Post Type") ?>
        <div>
            <div class="input-row input-select">
                <p><?php _e("Post type","hc") ?></p>
                <select class="post-type-slug" data-hc-setting="post_type_slug">
                    <?php hc_html_post_types(); ?>
                </select>
            </div>
            <div class="button-inner-options big-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="divider"><?php _e("Masonry options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Category","hc") ?></p>
                        <select class="post-type-category" data-hc-setting="post_type_category">
                            <?php hc_html_categories(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Columns","hc") ?></p>
                        <select data-hc-setting="column">
                            <option value="col-md-12">1</option>
                            <option value="col-md-6">2</option>
                            <option value="col-md-4">3</option>
                            <option value="col-md-3" selected>4</option>
                            <option value="col-md-2">6</option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Row height","hc") ?></p>
                        <select data-hc-setting="row">
                            <option value="" selected>Auto</option>
                            <option value="row-1"><?php _e("Row","hc") ?> 1</option>
                            <option value="row-2"><?php _e("Row","hc") ?> 2</option>
                            <option value="row-3"><?php _e("Row","hc") ?> 3</option>
                            <option value="row-4"><?php _e("Row","hc") ?> 4</option>
                            <option value="row-5"><?php _e("Row","hc") ?> 5</option>
                            <option value="row-6"><?php _e("Row","hc") ?> 6</option>
                            <option value="row-7"><?php _e("Row","hc") ?> 7</option>
                            <option value="row-8"><?php _e("Row","hc") ?> 8</option>
                            <option value="row-9"><?php _e("Row","hc") ?> 9</option>
                            <option value="row-10"><?php _e("Row","hc") ?> 10</option>
                            <option value="row-11"><?php _e("Row","hc") ?> 11</option>
                            <option value="row-12"><?php _e("Row","hc") ?> 12</option>
                            <option value="row-13"><?php _e("Row","hc") ?> 13</option>
                            <option value="row-14"><?php _e("Row","hc") ?> 14</option>
                            <option value="row-15"><?php _e("Row","hc") ?> 15</option>
                            <option value="row-16"><?php _e("Row","hc") ?> 16</option>
                            <option value="row-17"><?php _e("Row","hc") ?> 17</option>
                            <option value="row-18"><?php _e("Row","hc") ?> 18</option>
                            <option value="row-19"><?php _e("Row","hc") ?> 19</option>
                            <option value="row-20"><?php _e("Row","hc") ?> 20</option>
                            <option value="row-21"><?php _e("Row","hc") ?> 21</option>
                            <option value="row-22"><?php _e("Row","hc") ?> 22</option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Margins","hc") ?></p>
                        <input data-hc-setting="margins" placeholder="5" type="text" data-mask="number">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Pagination type","hc") ?></p>
                        <select data-hc-setting="pagination_type" class="animations-list" data-require-file="yes">
                            <option value=""><?php _e("None","hc") ?></option>
                            <option value="pagination_wp" selected><?php _e("Pagination","hc") ?></option>
                            <option value="pagination" data-require-file="pagination"><?php _e("HTML Pagination","hc") ?></option>
                            <option value="load_more" data-require-file="pagination"><?php _e("HTML Load more","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Items per page","hc") ?></p>
                        <input data-hc-setting="pag_items" placeholder="10" type="text" data-mask="number">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="pag_lm_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Navigation size","hc") ?></p>
                        <select data-hc-setting="button_size">
                            <option value="pagination-sm" selected><?php _e("Small","hc") ?></option>
                            <option value="pagination"><?php _e("Normal","hc") ?></option>
                            <option value="pagination-lg"><?php _e("Large","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show menu","hc") ?></p>
                        <input data-hc-setting="menu" checked="checked" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Menu position","hc") ?></p>
                        <select data-hc-setting="menu_position">
                            <option value=""><?php _e("Left","hc") ?></option>
                            <option value="nav-center"><?php _e("Center","hc") ?></option>
                            <option value="nav-right"><?php _e("Right","hc") ?></option>
                            <option value="nav-center nav-menu-outer"><?php _e("Outer right","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Menu style","hc") ?></p>
                        <select data-hc-setting="menu_style">
                            <option value=""><?php _e("Default","hc") ?></option>
                            <option value="ms-rounded"><?php _e("Rounded","hc") ?></option>
                            <option value="ms-minimal"><?php _e("Minimal","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Auto masonry","hc") ?></p>
                        <input data-hc-setting="auto_masonry" type="checkbox">
                    </li>
                    <li class="divider"><?php _e("Box options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Box","hc") ?></p>
                        <select data-hc-setting="box" data-require-file="yes">
                            <option value="top_icon_image" data-require-file="content_box"><?php _e("Top image","hc") ?></option>
                            <option selected value="side_content" data-require-file="content_box"><?php _e("Side image","hc") ?></option>
                            <option value="top_icon" data-require-file="content_box"><?php _e("Top icon","hc") ?></option>
                            <option value="side_icon" data-require-file="content_box"><?php _e("Side icon","hc") ?></option>
                            <option value="multiple_box" data-require-file="content_box"><?php _e("Multiple box","hc") ?></option>
                            <option value="blog_side" data-require-file="content_box"><?php _e("Blog side","hc") ?></option>
                            <option value="blog_full_width" data-require-file="content_box"><?php _e("Blog full width","hc") ?></option>
                            <option value="blog_full_width_2" data-require-file="content_box"><?php _e("Blog full width 2","hc") ?></option>
                            <option value="team" data-require-file="content_box"><?php _e("Team","hc") ?></option>
                            <option value="image_half_content" data-require-file="image_box"><?php _e("Image half content","hc") ?></option>
                            <option value="image_side_content" data-require-file="image_box"><?php _e("Image side content","hc") ?></option>
                            <option value="image_full_content" data-require-file="image_box"><?php _e("Image full content","hc") ?></option>
                            <option value="image_buttons_content" data-require-file="lightbox"><?php _e("Image buttons content","hc") ?></option>
                            <option value="image_down_text" data-require-file="image_box"><?php _e("Image down text","hc") ?></option>
                            <option value="image_classic_box" data-require-file="image_box"><?php _e("Image classic box","hc") ?></option>
                            <option value="image_circle_center" data-require-file="image_box"><?php _e("Image circle center","hc") ?></option>
                            <option value="image_circle_center_2" data-require-file="image_box"><?php _e("Image circle center 2","hc") ?></option>
                            <option value="image_circle_half" data-require-file="image_box"><?php _e("Image circle half","hc") ?></option>
                            <option value="image_circle_bottom" data-require-file="image_box"><?php _e("Image circle bottom","hc") ?></option>
                            <option value="image_circle_background" data-require-file="image_box"><?php _e("Image circle background","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Boxed","hc") ?></p>
                        <input data-hc-setting="boxed" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Boxed inverse","hc") ?></p>
                        <input data-hc-setting="boxed_inverse" type="checkbox">
                    </li>
                    <?php hc_button_options() ?>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Hidden content","hc") ?></p>
                        <input data-hc-setting="hidden_content" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show extra 1","hc") ?></p>
                        <input data-hc-setting="extra_1" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show extra 2","hc") ?></p>
                        <input data-hc-setting="extra_2" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Content","hc") ?></p>
                        <select data-hc-setting="content">
                            <option value=""><?php _e("All","hc") ?></option>
                            <option value="subtitle"><?php _e("Subtitle","hc") ?></option>
                            <option value="description"><?php _e("Excerpt","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Title length","hc") ?></p>
                        <input type="text" data-hc-setting="title_length" placeholder="999" data-mask="number" />
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Excerpt length","hc") ?></p>
                        <input type="text" data-hc-setting="excerpt_length" placeholder="999" data-mask="number" />
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Title size","hc") ?></p>
                        <select data-hc-setting="title_size">
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option selected="selected" value=""><?php _e("Default","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="box_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Custom CSS","hc") ?></p>
                        <input type="text" data-hc-setting="custom_css" placeholder="" />
                    </li>
                    <li class="divider"><?php _e("Pagination options","hc") ?></li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Scroll top","hc") ?></p>
                        <input data-hc-setting="pag_scroll_top" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Centered","hc") ?></p>
                        <input data-hc-setting="pag_centered" type="checkbox">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Prev text","hc") ?></p>
                        <input data-hc-setting="pag_button_prev" placeholder="<?php _e("Prev","hc") ?>" value="<?php _e("Prev","hc") ?>" type="text">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Next text","hc") ?></p>
                        <input data-hc-setting="pag_button_next" placeholder="<?php _e("Next","hc") ?>" value="<?php _e("Next","hc") ?>" type="text">
                    </li>
                    <li class="divider"><?php _e("Load more options","hc") ?></li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Lazy load","hc") ?></p>
                        <input data-hc-setting="lm_lazy" type="checkbox">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Button text","hc") ?></p>
                        <input data-hc-setting="lm_button_text" placeholder="<?php _e("Load more","hc") ?>" value="<?php _e("Load more","hc") ?>" type="text">
                    </li>
                    <li class="hidden">
                        <input data-hc-setting="data_options_pagination" value="" type="text">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_pt_slider">
    <div data-hc-id="_ID" data-hc-component="hc_pt_slider" data-hc-setting="main_content" class="hc-pt-slider hc-cnt-component">
        <input type="hidden" class="file_require" value="flexslider">
        <?php hc_e_composer_item_menu("Slider - List Post Type") ?>
        <div>
            <div class="input-row input-select">
                <p><?php _e("Post type","hc") ?></p>
                <select class="post-type-slug" data-hc-setting="post_type_slug">
                    <?php hc_html_post_types(); ?>
                </select>
            </div>
            <div class="input-row input-select">
                <p><?php _e("Category","hc") ?></p>
                <select class="post-type-category" data-hc-setting="post_type_category">
                    <?php hc_html_categories(); ?>
                </select>
            </div>
            <div class="button-inner-options big-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="divider"><?php _e("Slider options","hc") ?></li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Items number","hc") ?></p>
                        <input type="text" data-hc-setting="num_items" value="6" data-mask="number" />
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Type","hc") ?></p>
                        <select data-hc-setting="slider_type">
                            <option value="slider"><?php _e("Slider","hc") ?></option>
                            <option value="carousel"><?php _e("Carousel","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Outer arrows","hc") ?></p>
                        <input data-hc-setting="outer_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Visible arrows","hc") ?></p>
                        <input data-hc-setting="visible_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Inner dots","hc") ?></p>
                        <input data-hc-setting="nav_inner" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Trigger","hc") ?></p>
                        <select data-hc-setting="trigger">
                            <option value=""><?php _e("Auto","hc") ?></option>
                            <option value="manual"><?php _e("Manual","hc") ?></option>
                        </select>
                    </li>
                    <li class="divider"><?php _e("Box options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Box","hc") ?></p>
                        <select data-hc-setting="box" data-require-file="yes">
                            <option value="top_icon_image" data-require-file="content_box"><?php _e("Top image","hc") ?></option>
                            <option selected value="side_content" data-require-file="content_box"><?php _e("Side image","hc") ?></option>
                            <option value="top_icon" data-require-file="content_box"><?php _e("Top icon","hc") ?></option>
                            <option value="side_icon" data-require-file="content_box"><?php _e("Side icon","hc") ?></option>
                            <option value="multiple_box" data-require-file="content_box"><?php _e("Multiple box","hc") ?></option>
                            <option value="blog_side" data-require-file="content_box"><?php _e("Blog side","hc") ?></option>
                            <option value="blog_full_width" data-require-file="content_box"><?php _e("Blog full width","hc") ?></option>
                            <option value="blog_full_width_2" data-require-file="content_box"><?php _e("Blog full width 2","hc") ?></option>
                            <option value="team" data-require-file="content_box"><?php _e("Team","hc") ?></option>
                            <option value="image_half_content" data-require-file="image_box"><?php _e("Image half content","hc") ?></option>
                            <option value="image_side_content" data-require-file="image_box"><?php _e("Image side content","hc") ?></option>
                            <option value="image_full_content" data-require-file="image_box"><?php _e("Image full content","hc") ?></option>
                            <option value="image_buttons_content" data-require-file="lightbox"><?php _e("Image buttons content","hc") ?></option>
                            <option value="image_down_text" data-require-file="image_box"><?php _e("Image down text","hc") ?></option>
                            <option value="image_classic_box" data-require-file="image_box"><?php _e("Image classic box","hc") ?></option>
                            <option value="image_circle_center" data-require-file="image_box"><?php _e("Image circle center","hc") ?></option>
                            <option value="image_circle_center_2" data-require-file="image_box"><?php _e("Image circle center 2","hc") ?></option>
                            <option value="image_circle_half" data-require-file="image_box"><?php _e("Image circle half","hc") ?></option>
                            <option value="image_circle_bottom" data-require-file="image_box"><?php _e("Image circle bottom","hc") ?></option>
                            <option value="image_circle_background" data-require-file="image_box"><?php _e("Image circle background","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Boxed","hc") ?></p>
                        <input data-hc-setting="boxed" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Boxed inverse","hc") ?></p>
                        <input data-hc-setting="boxed_inverse" type="checkbox">
                    </li>
                    <?php hc_button_options() ?>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Hidden content","hc") ?></p>
                        <input data-hc-setting="hidden_content" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="box_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show extra 1","hc") ?></p>
                        <input data-hc-setting="extra_1" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show extra 2","hc") ?></p>
                        <input data-hc-setting="extra_2" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Content","hc") ?></p>
                        <select data-hc-setting="content">
                            <option value=""><?php _e("All","hc") ?></option>
                            <option value="subtitle"><?php _e("Subtitle","hc") ?></option>
                            <option value="description"><?php _e("Description","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Title length","hc") ?></p>
                        <input type="text" data-hc-setting="title_length" placeholder="999" data-mask="number" />
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Excerpt length","hc") ?></p>
                        <input type="text" data-hc-setting="excerpt_length" placeholder="999" data-mask="number" />
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Title size","hc") ?></p>
                        <select data-hc-setting="title_size">
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option selected="selected" value=""><?php _e("Default","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Custom CSS","hc") ?></p>
                        <input type="text" data-hc-setting="custom_css" placeholder="" />
                    </li>
                </ul>
            </div>
            <a class="input-row" data-hc-setting="data_options" data-hc-component="value" data-value="" href="#popover-box-flexslider"><i class="button-icon input-row icon-gear-setting-2"></i></a>
        </div>
    </div>
</div>
<div id="cnt_hc_pt_coverflow">
    <div data-hc-id="_ID" data-hc-component="hc_pt_coverflow" data-hc-setting="main_content" class="hc-pt-coverflow hc-cnt-component">
        <input type="hidden" class="file_require" value="flipster">
        <?php hc_e_composer_item_menu("Coverflow - List Post Type") ?>
        <div class="box-content-bar">
            <div class="input-row input-select">
                <p><?php _e("Post type","hc") ?></p>
                <select class="post-type-slug" data-hc-setting="post_type_slug">
                    <?php hc_html_post_types(); ?>
                </select>
            </div>
            <div class="input-row input-select">
                <p><?php _e("Category","hc") ?></p>
                <select class="post-type-category" data-hc-setting="post_type_category">
                    <?php hc_html_categories(); ?>
                </select>
            </div>
            <div class="button-inner-options big-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="divider"><?php _e("Coverflow options","hc") ?></li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Items number","hc") ?></p>
                        <input type="text" data-hc-setting="num_items" value="6" data-mask="number" />
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Slide width","hc") ?></p>
                        <input data-hc-setting="slide_width" placeholder="" type="text" data-mask="number">
                    </li>
                    <li class="divider"><?php _e("Box options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Box","hc") ?></p>
                        <select data-hc-setting="box" data-require-file="yes">
                            <option value="top_icon_image" data-require-file="content_box"><?php _e("Top image","hc") ?></option>
                            <option selected value="side_content" data-require-file="content_box"><?php _e("Side image","hc") ?></option>
                            <option value="top_icon" data-require-file="content_box"><?php _e("Top icon","hc") ?></option>
                            <option value="side_icon" data-require-file="content_box"><?php _e("Side icon","hc") ?></option>
                            <option value="multiple_box" data-require-file="content_box"><?php _e("Multiple box","hc") ?></option>
                            <option value="blog_side" data-require-file="content_box"><?php _e("Blog side","hc") ?></option>
                            <option value="blog_full_width" data-require-file="content_box"><?php _e("Blog full width","hc") ?></option>
                            <option value="blog_full_width_2" data-require-file="content_box"><?php _e("Blog full width 2","hc") ?></option>
                            <option value="team" data-require-file="content_box"><?php _e("Team","hc") ?></option>
                            <option value="image_half_content" data-require-file="image_box"><?php _e("Image half content","hc") ?></option>
                            <option value="image_side_content" data-require-file="image_box"><?php _e("Image side content","hc") ?></option>
                            <option value="image_full_content" data-require-file="image_box"><?php _e("Image full content","hc") ?></option>
                            <option value="image_buttons_content" data-require-file="lightbox"><?php _e("Image buttons content","hc") ?></option>
                            <option value="image_down_text" data-require-file="image_box"><?php _e("Image down text","hc") ?></option>
                            <option value="image_classic_box" data-require-file="image_box"><?php _e("Image classic box","hc") ?></option>
                            <option value="image_circle_center" data-require-file="image_box"><?php _e("Image circle center","hc") ?></option>
                            <option value="image_circle_center_2" data-require-file="image_box"><?php _e("Image circle center 2","hc") ?></option>
                            <option value="image_circle_half" data-require-file="image_box"><?php _e("Image circle half","hc") ?></option>
                            <option value="image_circle_bottom" data-require-file="image_box"><?php _e("Image circle bottom","hc") ?></option>
                            <option value="image_circle_background" data-require-file="image_box"><?php _e("Image circle background","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Boxed","hc") ?></p>
                        <input data-hc-setting="boxed" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Boxed inverse","hc") ?></p>
                        <input data-hc-setting="boxed_inverse" type="checkbox">
                    </li>
                    <?php hc_button_options() ?>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Hidden content","hc") ?></p>
                        <input data-hc-setting="hidden_content" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="box_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show extra 1","hc") ?></p>
                        <input data-hc-setting="extra_1" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show extra 2","hc") ?></p>
                        <input data-hc-setting="extra_2" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Content","hc") ?></p>
                        <select data-hc-setting="content">
                            <option value=""><?php _e("All","hc") ?></option>
                            <option value="subtitle"><?php _e("Subtitle","hc") ?></option>
                            <option value="description"><?php _e("Description","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Title length","hc") ?></p>
                        <input type="text" data-hc-setting="title_length" placeholder="999" data-mask="number" />
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Excerpt length","hc") ?></p>
                        <input type="text" data-hc-setting="excerpt_length" placeholder="999" data-mask="number" />
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Title size","hc") ?></p>
                        <select data-hc-setting="title_size">
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option selected="selected" value=""><?php _e("Default","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Custom CSS","hc") ?></p>
                        <input type="text" data-hc-setting="custom_css" placeholder="" />
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_pt_menu">
    <div data-hc-id="_ID" data-hc-component="hc_pt_menu" data-hc-setting="main_content" class="hc-pt-menu hc-cnt-component">
        <input type="hidden" class="file_require" value="flipster">
        <?php hc_e_composer_item_menu("Menu - List Post Type") ?>
        <div>
            <div class="input-row input-select">
                <p><?php _e("Post type","hc") ?></p>
                <select class="post-type-slug" data-hc-setting="post_type_slug">
                    <?php hc_html_post_types(); ?>
                </select>
            </div>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Type","hc") ?></p>
                        <select data-hc-setting="type">
                            <option value="horizontal"><?php _e("Horizontal","hc") ?></option>
                            <option value="vertical"><?php _e("Vertical","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Style","hc") ?></p>
                        <select data-hc-setting="style">
                            <option value="" selected><?php _e("Classic","hc") ?></option>
                            <option value="ms-rounded"><?php _e("Style","hc") ?> 1</option>
                            <option value="ms-minimal"><?php _e("Style","hc") ?> 2</option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Alignment","hc") ?></p>
                        <select data-hc-setting="alignment">
                            <option selected value=""><?php _e("Left","hc") ?></option>
                            <option value="nav-right"><?php _e("Right","hc") ?></option>
                            <option value="nav-center"><?php _e("Center","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("All button text","hc") ?></p>
                        <input data-hc-setting="all_button_text" placeholder="<?php _e("All","hc") ?>" value="<?php _e("All","hc") ?>" type="text">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_pt_tag_cloud">
    <div data-hc-id="_ID" data-hc-component="hc_pt_tag_cloud" data-hc-setting="main_content" class="hc-pt-tag-cloud hc-cnt-component">
        <?php hc_e_composer_item_menu("Tag cloud - List Post Type") ?>
        <div>
            <div class="input-row input-select">
                <p><?php _e("Post type","hc") ?></p>
                <select class="post-type-slug">
                    <option><?php _e("Posts","hc") ?></option>
                </select>
            </div>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Order by","hc") ?></p>
                        <select data-hc-setting="orderby">
                            <option value=""><?php _e("Default","hc") ?></option>
                            <option value="count"><?php _e("Count","hc") ?></option>
                            <option value="name"><?php _e("Name","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Order","hc") ?></p>
                        <select data-hc-setting="order">
                            <option value="" selected><?php _e("Asc","hc") ?></option>
                            <option value="desc"><?php _e("Desc","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Items","hc") ?></p>
                        <input data-hc-setting="items" placeholder="" value="" type="text" data-mask="number">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_pt_navigation">
    <div data-hc-id="_ID" data-hc-component="hc_pt_navigation" data-hc-setting="main_content" class="hc-pt-navigation hc-cnt-component">
        <?php hc_e_composer_item_menu("Navigation - List Post Type") ?>
        <div class="text-center">
            <div class="input-row input-select">
                <p><?php _e("Post type","hc") ?></p>
                <select class="post-type-slug" data-hc-setting="post_type_slug">
                    <?php hc_html_post_types(); ?>
                </select>
            </div>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Archive link","hc") ?></p>
                        <input data-hc-setting="archive_link" value="" type="text">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Previous text","hc") ?></p>
                        <input data-hc-setting="previous_text" value="<?php _e("Previous","hc") ?>" type="text">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Next text","hc") ?></p>
                        <input data-hc-setting="next_text" placeholder="" value="<?php _e("Next","hc") ?>" type="text">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_pt_post_informations">
    <div data-hc-id="_ID" data-hc-component="hc_pt_post_informations" data-hc-setting="main_content" class="hc-pt-post-informations hc-cnt-component">
        <?php hc_e_composer_item_menu("Post informations - List Post Type") ?>
        <div class="text-center">
            <div class="input-row input-select">
                <p><?php _e("Post type","hc") ?></p>
                <select class="post-type-slug" data-hc-setting="post_type_slug">
                    <option value=""><?php _e("Current post","hc") ?></option>
                </select>
            </div>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Position","hc") ?></p>
                        <select data-hc-setting="position">
                            <option value="left"><?php _e("Left","hc") ?></option>
                            <option value="right"><?php _e("Right","hc") ?></option>
                            <option value="center"><?php _e("Center","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Date","hc") ?></p>
                        <input data-hc-setting="date" checked type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Categories","hc") ?></p>
                        <input data-hc-setting="categories" checked type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Author","hc") ?></p>
                        <input data-hc-setting="author" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Share","hc") ?></p>
                        <input data-hc-setting="share" checked type="checkbox">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
