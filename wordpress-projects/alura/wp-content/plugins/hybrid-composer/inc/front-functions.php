<?php
// =============================================================================
// FRON-FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Variouse functions for the front-end.
// =============================================================================

function hc_set_menu_item($menu_item, $child_items) {
    return array($menu_item->title, $menu_item->url, $child_items, $menu_item->description, implode(" ", $menu_item->classes), $menu_item->target);
}
function hc_get_menu_array($menu_name) {
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $tabs = false;
        $menu_arr = array();

        if (isset($menu->term_id)) {
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            $menu_count = count($menu_items);

            //BUILD MENU ITEMS ARRAY
            for ($i = 0; $i < $menu_count; $i++) {
                $menu_item = $menu_items[$i];
                if ($menu_item->classes[0] == "_mega_menu_tab") $tabs = true;
                $sub_menu_arr = array();
                if ($menu_item->ID != "-1") {
                    for ($j = $i; $j < $menu_count; $j++) {
                        if ($menu_items[$j]->menu_item_parent == $menu_item->ID) {
                            $sub_menu_item = $menu_items[$j];
                            $sub_sub_menu_arr = array();
                            for ($y = $j; $y < $menu_count; $y++) {
                                if ($menu_items[$y]->menu_item_parent == $sub_menu_item->ID) {
                                    $sub_sub_menu_item = $menu_items[$y];
                                    $sub_sub_sub_menu_arr = array();
                                    for ($x = $y; $x < $menu_count; $x++) {
                                        if ($menu_items[$x]->menu_item_parent == $sub_sub_menu_item->ID) {
                                            $sub_sub_sub_menu_item = $menu_items[$x];
                                            $sub_sub_sub_sub_menu_arr = array();
                                            for ($k = $x; $k < $menu_count; $k++) {
                                                if ($menu_items[$k]->menu_item_parent == $sub_sub_sub_menu_item->ID) {
                                                    array_push($sub_sub_sub_sub_menu_arr, hc_set_menu_item($menu_items[$k],""));
                                                    $menu_items[$k]->ID = "-1";
                                                }
                                            }
                                            array_push($sub_sub_sub_menu_arr, hc_set_menu_item($menu_items[$x],$sub_sub_sub_sub_menu_arr));
                                            $menu_items[$x]->ID = "-1";
                                        }
                                    }
                                    array_push($sub_sub_menu_arr, hc_set_menu_item($menu_items[$y],$sub_sub_sub_menu_arr));
                                    $menu_items[$y]->ID = "-1";
                                }
                            }
                            array_push($sub_menu_arr,hc_set_menu_item($sub_menu_item, $sub_sub_menu_arr));
                            $menu_items[$j]->ID = "-1";
                        }
                    }
                    array_push($menu_arr,hc_set_menu_item($menu_item, $sub_menu_arr));
                }
            }
        }

        if ($tabs) {
            wp_enqueue_script("jquery.tab-accordion.js",  HC_PLUGIN_URL . '/scripts/jquery.tab-accordion.js"', array(), "1.0",true);
        }
        return $menu_arr;
    } else return array();
}
function hc_get_menu_css($css_classes) {
    $arr = explode(" ", $css_classes);
    $icon = "";
    $classes = "";
    $classes_html = "";
    if ($css_classes != "_divider" && $css_classes != "_mega_menu" &&  $css_classes != "_mega_menu_small_width" && $css_classes != "_mega_menu_col" && $css_classes != "_mega_menu_title") {
        for ($i = 0; $i < count($arr); $i++){
            if (strpos($arr[$i],'fa-') !== false) $icon = "fa " . $arr[$i];
            if (strpos($arr[$i],'im-') !== false) $icon = $arr[$i];
            if (strpos($arr[$i],'im-') === false && strpos($arr[$i],'fa-') === false  && $arr[$i] !== "fa") $classes .= " " . $arr[$i];
        }
        if ($icon != "") $icon =  '<i class="' . $icon . '"></i>';
        if ($classes != "") $classes_html =  ' class="' . $classes . '" ';
    } else {
        $icon = "menu-obj";
        $classes = "menu-obj";
    }

    return array($icon,$classes_html,$classes);
}
function hc_set_theme_skin($skin = "") {
    $styles = "";
    if ($skin == "") {
        if (HC_IS_CUSTOM_PANEL) {
            include(HC_PLUGIN_PATH . "/custom/custom-options-panel.php");
            if (hc_get_setting('main-color') != "") {
                if (isset($HC_SITE_COLORS)) {
                    $styles = str_replace("[MAIN-COLOR]", hc_get_setting('main-color'),$HC_SITE_COLORS);
                    $styles = str_replace("[HOVER-COLOR]", hc_get_setting('hover-color'),$styles);
                    $styles = str_replace("[COLOR-3]", hc_get_setting('color-3'),$styles);
                    $styles = str_replace("[COLOR-4]", hc_get_setting('color-4'),$styles);
                }
            }
            if (isset($HC_SITE_FONTS)) {
                $font_css = $HC_SITE_FONTS;
                $font_1 = hc_get_setting('font-family');
                if ($font_1 != "") {
                    $font_1 = str_replace("+", " ", $font_1);
                    if (strpos($font_1, ':') > 0) $font_1 = substr($font_1, 0, strpos($font_1, ':'));
                    $font_css = str_replace("[FONT-1]", $font_1, $font_css);
                }
                $font_2 = hc_get_setting('font-family-2');
                if ($font_2 != "") {
                    $font_2 = str_replace("+", " ", $font_2);
                    if (strpos($font_2, ':') > 0) $font_2 = substr($font_2, 0, strpos($font_2, ':'));
                    $font_css = str_replace("[FONT-2]", $font_2, $font_css);
                }
                if ($font_2 != "" || $font_2 != "") $styles .= " " . $font_css;
            }
        }
    } else {
        if (function_exists("hc_set_theme_skin_multiple")) {
            $styles = hc_set_theme_skin_multiple($skin);
        }
    }
    return $styles;
}

function hc_settings_styles() {
    $css = "";
    if (hc_is_setted("boxed-layout") && hc_is_setted("site-width")) {
        $css .= '.boxed-layout .navbar-fixed-top, .boxed-layout .navbar-fixed-top, .boxed-layout header, .boxed-layout .parallax-mirror, .boxed-layout .content-parallax, .boxed-layout footer, .boxed-layout [class*="header-"], .boxed-layout #fullpage-main,.boxed-layout .container { max-width: ' . esc_attr(hc_get_setting("site-width")) . 'px; }';
    }
    if (hc_is_setted("site-width")) {
        $css .= '@media (min-width: 1200px) { .container { width: ' . esc_attr(hc_get_setting("site-width")) . 'px; }}';
    }
    if (hc_is_setted("section-padding-y")) {
        $css .= '.container.content, .section-empty > .content, .section-two-blocks .content, .section-bg-image > .content, .section-bg-video > .content, .section-bg-animation > .content, .section-slider > .content, .section-bg-color > .content { padding-top: ' . esc_attr(hc_get_setting("section-padding-y")) . 'px;  padding-bottom: ' . esc_attr(hc_get_setting("section-padding-y")) . 'px; }';
    }
    if (hc_is_setted("section-padding-x")) {
        $css .= '@media (min-width: 1200px) { .section-item div.content:not(.container) { padding-left: ' . esc_attr(hc_get_setting("section-padding-x")) . 'px; padding-right: ' . esc_attr(hc_get_setting("section-padding-x")) . 'px; } }';
    }
    if (hc_is_setted("column-margin")) {
        $css .= '.hc_column_cnt { margin-top: ' . esc_attr(hc_get_setting("column-margin")) .'px; margin-bottom: ' . esc_attr(hc_get_setting("column-margin")) . 'px; }';
    }
    if (hc_is_setted("elements-margin")) {
        $css .= '.title-base,.title-base.title-small { margin-bottom: ' . esc_attr(hc_get_setting("elements-margin")) . 'px; }';
    }
    if (hc_is_setted("logo-height")) {
        $css .= '.navbar-brand img,header .brand img { max-height: ' . esc_attr(hc_get_setting("logo-height")) . 'px; }';
    }
    if (hc_is_setted("logo-margin-top")) {
        $css .= '.navbar-brand img,header .brand img { margin-top: ' . esc_attr(hc_get_setting("logo-margin-top")) . 'px; }';
    }
    if (hc_is_setted("footer-height")) {
        $css .= 'footer,footer.footer-parallax { height: ' . esc_attr(hc_get_setting("footer-height")) . 'px; }';
        if (hc_get_setting("footer-type") == "parallax") {
            $css .= 'body .footer-parallax-container { margin-bottom: ' . (intval(hc_get_setting("footer-height")) - 2) . 'px; }';
        }
    }
    return $css;
}
?>
