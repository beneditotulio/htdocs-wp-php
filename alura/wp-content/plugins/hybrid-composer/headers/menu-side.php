<?php
// =============================================================================
// MENU-SIDE.PHP
// -----------------------------------------------------------------------------
// Side menus.
// This file generate the following menu types:

// 01. SIDE CLASSIC - framework-y.com/components/menu/menu-side.html
// 02. SIDE LATERAL - framework-y.com/components/menu/menu-side-lateral.html
// 03. SIDE SIMPLE - framework-y.com/components/menu/menu-side-simple.html
// =============================================================================

$menu_arr = hc_get_menu_array('header-menu');

//BUILD MENU HTML
$menu_id = "main-menu";
if ($HC_TEMPLATE_SLUG == "template-fullpage" && hc_is_setted("menu-one-page")) {
    if (hc_get_now($HC_PAGE_ARR,array("template_setting","settings","direction")) == "") $menu_id = "fullpage-menu";
    else $menu_id = "fullpage-horizontal-menu";
}
if ($HC_TEMPLATE_SLUG != "template-fullpage" && hc_is_setted("menu-one-page")) $menu_id = "hc-inner-menu";

$menu_html = '<ul id="' . $menu_id . '" class="side-menu ' . ((hc_is_setted('menu-click')) ? "" : "over") . ((hc_is_setted('menu-one-page') && $HC_TEMPLATE_SLUG != "template-fullpage") ? " one-page-menu":"") . '">';
$menu_sub_html = '';
$col_padd = hc_get_setting('menu-mega-padding');
for ($i = 0; $i < count($menu_arr); $i++) {
    $menu_item = $menu_arr[$i];
    $menu_css = hc_get_menu_css($menu_item[4]);
    if ($menu_css[0] != "menu-obj") {
        if (count($menu_item[2]) == 0) $menu_html .= '<li ' . $menu_css[1] . '><a href="' . esc_url($menu_item[1]) . '">'. $menu_css[0] .  esc_attr($menu_item[0]) . '</a></li>';
        else {
            $is_mega = (($menu_item[2][0][4] == "_mega_menu") || ($menu_item[2][0][4] == "_mega_menu_small_width")) ? true : false;
            if ($is_mega) $menu_html .= '<li class="panel-item mega-item"><span>'. $menu_css[0] . $menu_item[0] . '<span class="fa arrow"></span>' . '</span>';
            else $menu_html .= '<li' . $menu_css[1] . '><a class="dropdown-toggle" data-toggle="dropdown" href="' .  esc_url($menu_item[1]) . '">' . $menu_css[0] . esc_attr($menu_item[0]) . '<span class="fa arrow"></span>' . '</a><ul class="collapse">';
            for ($j = 0; $j < count($menu_item[2]); $j++) {
                $sub_menu_item = $menu_item[2][$j];
                if ($sub_menu_item[4] == "_divider") {
                    $menu_html .= '<li role="separator" class="divider"></li>';
                } else {
                    if (count($sub_menu_item[2]) == 0) $menu_html .= '<li' . $menu_css[1] . '><a href="' .  esc_url($sub_menu_item[1]) . '">' . esc_attr($sub_menu_item[0]) . '</a></li>';
                    else {
                        if ($is_mega) {
                            if (strlen($sub_menu_item[1]) > 0 ) $menu_html .= '<div class="collapse panel bg-menu" style="background-image:url(' . esc_url($sub_menu_item[1]) . ')">';
                            else $menu_html .= '<div class="collapse panel">';
                            for ($y = 0; $y < count($sub_menu_item[2]); $y++) {
                                $sub_sub_menu_item = $sub_menu_item[2][$y];
                                $menu_html .= '<ul class="collapse"'. ((strlen($col_padd) > 0)? ' style="padding-top:'.$col_padd.'px"':'') .'>';
                                for ($x = 0; $x < count($sub_sub_menu_item[2]); $x++) {
                                    $sub_sub_sub_menu_item = $sub_sub_menu_item[2][$x];
                                    if ($sub_sub_sub_menu_item[4] == "_mega_menu_title") {
                                        $menu_html .= '</ul><ul class="collapse "><li' . $menu_css[1] . '><a>' . $sub_sub_sub_menu_item[0] . '</a></li>';
                                    } else $menu_html .= '<li' . $menu_css[1] . '><a href="' .  esc_url($sub_sub_sub_menu_item[1]) . '">' . esc_attr($sub_sub_sub_menu_item[0]) . '</a></li>';
                                }
                                $menu_html .= '</ul>';
                            }
                            $menu_html .= '</div>';
                        } else {
                            $menu_html .= '<li' . $menu_css[1] . '><a href="' .  esc_url($sub_menu_item[1]) . '">' . esc_attr($sub_menu_item[0]) . '</a><ul class="collapse">';
                            for ($y = 0; $y < count($sub_menu_item[2]); $y++) {
                                $menu_html .= '<li' . $menu_css[1] . '><a href="' .  esc_url($sub_menu_item[2][$y][1]) . '">' . esc_attr($sub_menu_item[2][$y][0]) . '</a></li>';
                            }
                        }
                        if (!$is_mega) $menu_html.= '</ul>';
                    }
                }
            }
            if (!$is_mega) $menu_html.= '</ul>';
        }
    } else {
        $menu_html .= '<li role="separator" class="divider"></li>';
    }
}
$menu_html .= '</ul>';
$hamburger_menu = hc_is_setted('menu-hamburger');
$home_url = home_url();
$classes = "";
if ($hamburger_menu) {
    $classes = "hamburger-header";
} else {
    $classes = "side-menu-header";
    if (hc_is_setted('menu-lateral')) $classes .= " side-menu-lateral";
    if ($hc_is_transparent) $classes .=  " bg-transparent menu-transparent ";
}
$classes .= " " . esc_attr(hc_get_setting("menu-css"));
$logo = hc_get_setting('logo');
$logo_retina = hc_get_setting("logo-retina");
if ($logo_retina == "") $logo_retina = $logo;
$home_url = home_url();
?>
<header class="<?php echo $classes ?>" <?php echo esc_attr($hc_menu_animation) ?>>
    <?php if (!$hamburger_menu) { ?>
    <div class="navbar" role="navigation">
        <div class="navbar navbar-main">
            <div class="container">
                <div class="navbar-header">
                    <a class="hamburger-button" data-menu-anima="fade-left">
                        <i class="fa fa-bars"></i>
                    </a>
                    <a class="navbar-brand" href="<?php echo $home_url ?>">
                        <img class="logo-default" src="<?php echo esc_url($logo) ?>" alt="" />
                        <img class="logo-retina" src="<?php echo esc_url($logo_retina) ?>" alt="" />
                    </a>
                </div>
                <div class="nav navbar-nav navbar-right">
                    <?php if (hc_is_setted('menu-search')) {
                    ?>
                    <form role="search" method="get" id="searchform" onsubmit='<?php echo $home_url ?>' class="navbar-form" action="<?php echo $home_url ?>">
                        <div class="input-group">
                            <input name="s" id="s" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search for ...','hc'); ?>" />
                            <span class="input-group-btn">
                                <input class="btn btn-default" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'GO','hc'); ?>" />
                            </span>
                        </div>
                    </form>
                    <?php } ?>
                    <?php if (hc_is_setted('menu-social')) { ?>
                    <div class="btn-group navbar-left navbar-social">
                        <div class="btn-group social-group">
                            <?php hc_get_social_links() ?>
                        </div>
                    </div>
                    <?php }
                          if (hc_is_setted('menu-custom-area')) echo '<div class="navbar-left custom-area">' . wp_kses_post(html_entity_decode(hc_get_setting('menu-custom-area'))) . '</div>';
                    ?>
                    <a class="hamburger-button" data-menu-anima="fade-left">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php  } else {
               echo '<a class="hamburger-button" data-menu-anima="fade-left"><span class="hidden-xs">' . esc_attr__( 'Menu','hc') . '</span><i class="fa fa-bars"></i></a>';
          } ?>
    <div class="side-menu-fixed <?php if ($hamburger_menu) echo "hamburger-menu"; ?>">
        <div class="top-area">
            <a class="brand" href="<?php echo $home_url ?>">
                <img class="logo-default" src="<?php echo esc_url($logo) ?>" alt="" />
                <img class="logo-retina" src="<?php echo esc_url($logo_retina) ?>" alt="" />
            </a>
            <?php if (hc_is_setted('menu-search')) {  ?>
            <form role="search" method="get" id="searchform" onsubmit='<?php echo $home_url ?>' class="navbar-form" action="<?php echo $home_url ?>">
                <div class="input-group">
                    <input name="s" id="s" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search for ...','hc'); ?>" />
                    <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'GO','hc'); ?>" />
                    </span>
                </div>
            </form>
            <?php } ?>
        </div>
        <aside class="sidebar mi-menu">
            <nav class="sidebar-nav <?php if (hc_is_setted('menu-center')) echo "side-menu-center"; else echo "scroll-content"; ?>">
                <?php echo $menu_html; //NO ESCAPE ?>
            </nav>
        </aside>
        <div class="bottom-area">
            <?php
            if (hc_is_setted('menu-language')) echo wp_kses_post(hc_get_wpml_menu("list"));
            if (hc_is_setted('menu-social')) { ?>
            <div class="btn-group social-group">
                <?php hc_get_social_links() ?>
            </div>
            <?php }
            if (hc_is_setted('menu-custom-area')) echo '<div class="custom-area">' . wp_kses_post(html_entity_decode(hc_get_setting('menu-custom-area'))) . '</div>';
            ?>
        </div>
    </div>
</header>
