<?php
// =============================================================================
// MENU-CLASSIC.PHP
// -----------------------------------------------------------------------------
// Horizontal menus.
// This file generate the following menu types:

// 01. MENU CLASSIC - framework-y.com/components/menu/menu-classic.html
// 02. MENU CLASSIC TRANSPARENT - framework-y.com/components/menu/menu-classic-transparent.html
// 03. MENU BIG LOGO - framework-y.com/components/menu/menu-big-logo.html
// 04. MENU MIDDLE LOGO - framework-y.com/components/menu/menu-middle-logo.html
// 05. MENU MIDDLE LOGO TOP - framework-y.com/components/menu/menu-middle-logo-top.html
// 06. MENU MIDDLE BOX - framework-y.com/components/menu/menu-middle-box.html
// 07. MENU MIDDLE BOX - framework-y.com/components/menu/menu-icons.html
// 08. MENU MIDDLE BOX - framework-y.com/components/menu/menu-icons-top.html

// Documentation: framework-y.com/components/menu/menu-documentation.html
// =============================================================================

$home_url = home_url();
$menu_count =  count($menu_arr);
$tab_animation = hc_get_setting('menu-animation');
if (strlen($tab_animation) > 0) $tab_animation = " data-tab-anima='" . $tab_animation . "'";

$menu_middle_count = (int)($menu_count / 2);
$menu_margin_left = hc_get_setting('menu-margin-left');

if (strlen($menu_margin_left) != 0) $menu_margin_left = "margin-left: " . $menu_margin_left . "px";

$logo = hc_get_setting("logo");
$logo_retina = hc_get_setting("logo-retina");
$logo_retina_2 = hc_get_setting("logo-2-retina");
if ($logo == "") $logo = HC_THEME_URL . "/inc/logo.png";
if ($logo_retina == "") $logo_retina = $logo;
if ($logo_retina_2 == "") $logo_retina_2 = $logo_retina;


$menu_id = "main-menu";
if ($HC_TEMPLATE_SLUG == "template-fullpage" && hc_is_setted("menu-one-page")) {
    if (hc_get_now($HC_PAGE_ARR,array("template_setting","settings","direction")) == "") $menu_id = "fullpage-menu";
    else $menu_id = "fullpage-horizontal-menu";
}
if ($HC_TEMPLATE_SLUG != "template-fullpage" && hc_is_setted("menu-one-page")) $menu_id = "hc-inner-menu";

$menu_html = '<ul id="' . $menu_id . '" class="nav navbar-nav ' . ((hc_is_setted('menu-one-page') && $HC_TEMPLATE_SLUG != "template-fullpage") ? " one-page-menu":"") . ((hc_is_setted("menu-top-icons")) ? " icon-top":"") . '" style="' . (($hc_menu_type == "middle-logo") ? $menu_margin_left : ""). '">';
if ($hc_menu_type == "subtitle") $menu_html = '<ul '. ((hc_is_setted('menu-one-page')) ? 'id="hc-inner-menu"':"") . ' class="nav navbar-nav subheader-bootstrap '  . ((hc_is_setted('menu-one-page')) ? " one-page-menu":"") . '">';

for ($i = 0; $i < $menu_count; $i++) {
    $menu_item = $menu_arr[$i];
    $menu_css = hc_get_menu_css($menu_item[4]);
    if ($menu_css[0] != "menu-obj") {
        if (($hc_menu_type == "middle-logo") && ($i == $menu_middle_count)) {
            $menu_html .= '<li class="logo-item ' . ((hc_is_setted("menu-top-logo") || $hc_is_transparent) ? "scroll-show" : "") . '">';
            $menu_html .= '<a href="' . $home_url . '"><img class="logo-default" src="' . hc_get_setting("logo-2") . '" alt="logo" style="'. $hc_logo_margin_top . '"><img class="logo-retina" src="' . esc_url($logo_retina_2) . '" alt="" style="' . esc_attr($hc_logo_margin_top) . '" /></a></li>';
            if ($hc_is_transparent) {
                $menu_html .= '<li class="logo-item scroll-hide"><img class="logo-default" src="' . esc_url($logo) . '" alt="logo" style="'. $hc_logo_margin_top . '"><img class="logo-retina" src="' . esc_url($logo_retina) . '" alt="" style="' . esc_attr($hc_logo_margin_top) . '" />';
            }
        }
        if (count($menu_item[2]) == 0) $menu_html .= '<li' . $menu_css[1] . '><a ' . (($menu_item[5] == "_blank") ? 'target="_blank" ':'') . 'href="' . esc_url($menu_item[1]) . '">'. hc_get_iconMenu($hc_menu_type,$menu_item) . esc_attr($menu_item[0]) . (($hc_menu_type == "subtitle") ? "<span class='sub'>" . esc_attr($menu_item[3]) ."</span>" : "") . '</a></li>';
        else {
            $is_mega = (($menu_item[2][0][4] == "_mega_menu") || ($menu_item[2][0][4] == "_mega_menu_small_width")) ? true : false;
            $is_tab = (($is_mega && $menu_item[2][0][2][0][4] == "_mega_menu_tab") ? true : false);
            $menu_html .= '<li class="' . $menu_css[2] . ' ' . (($is_mega && $menu_item[2][0][4] != "_mega_menu_small_width") ? " dropdown mega-dropdown " : " dropdown multi-level ") . (($is_tab) ? "mega-tabs " : "") . (($menu_item[2][0][4] == "_mega_menu_small_width") ? "dropdown " : "") . '"><a class="dropdown-toggle" data-toggle="dropdown" href="' . esc_url($menu_item[1]) . '">'. hc_get_iconMenu($hc_menu_type,$menu_item) . esc_attr($menu_item[0]) . '<span class="caret"></span>' . (($hc_menu_type == "subtitle") ? "<span class='sub'>" . $menu_item[3] ."</span>" : "") . '</a>' . (($is_mega) ? '' : '<ul class="dropdown-menu">');
            for ($j = 0; $j < count($menu_item[2]); $j++) {
                $sub_menu_item = $menu_item[2][$j];
                $menu_css = hc_get_menu_css($sub_menu_item[4]);
                if ($menu_css[1] == "_divider") {
                    $menu_html .= '<li role="separator" class="divider"></li>';
                } else {
                    if (count($sub_menu_item[2]) == 0) $menu_html .= '<li' . $menu_css[1] . '><a ' . (($sub_menu_item[5] == "_blank") ? 'target="_blank" ':'') . 'href="' . esc_url($sub_menu_item[1]) . '">' . esc_attr($sub_menu_item[0]) . '</a></li>';
                    else {
                        if ($is_mega) {
                            if (strlen($sub_menu_item[1]) > 0 ) $menu_html .= '<div class="mega-menu dropdown-menu multi-level row bg-menu" style="background-image:url(' . esc_url($sub_menu_item[1]) . ')">';
                            else $menu_html .= '<div class="mega-menu dropdown-menu multi-level row">';
                            if ($is_tab) {
                                $menu_html .= '<div class="tab-box"'. $tab_animation .'><ul class="nav nav-tabs">';
                                for ($y = 0; $y < count($sub_menu_item[2]); $y++) $menu_html .= '<li class="'. (($y==0) ? 'active ':'') . $menu_css[2] . '"><a href="#">'. esc_attr($sub_menu_item[2][$y][0]) .'</a></li>';
                                $menu_html .= '</ul>';
                            }
                            for ($y = 0; $y < count($sub_menu_item[2]); $y++) {
                                $sub_sub_menu_item = $sub_menu_item[2][$y];
                                $menu_css = hc_get_menu_css($sub_sub_menu_item[4]);
                                if (!$is_tab) {
                                    $menu_html .= hc_set_menu_col($sub_sub_menu_item,$menu_css[1]);
                                } else {
                                    $menu_html .= '<div class="panel'. (($y==0) ? ' active':'') .'">';
                                    for ($x = 0; $x < count($sub_sub_menu_item[2]); $x++) {
                                        $menu_html .= hc_set_menu_col($sub_sub_menu_item[2][$x],$menu_css[1]);
                                    }
                                    $menu_html .= '</div>';
                                }
                            }
                            $menu_html .= '</div>';
                            if ($is_tab) $menu_html .= '</div>';
                        } else {
                            $menu_html .= '<li class="dropdown multi-level dropdown-submenu' . $menu_css[2] . '"><a class="dropdown-toggle" data-toggle="dropdown" href="' . esc_url($sub_menu_item[1]) . '">' . esc_attr($sub_menu_item[0]) . '</a><ul class="dropdown-menu">';
                            for ($y = 0; $y < count($sub_menu_item[2]); $y++) {
                                $menu_css = hc_get_menu_css($sub_menu_item[2][$y][4]);
                                $menu_html .= '<li' . $menu_css[1] . '><a ' . (($sub_menu_item[2][$y][5] == "_blank") ? 'target="_blank" ':'') . 'href="' . esc_url($sub_menu_item[2][$y][1]) . '">' . esc_attr($sub_menu_item[2][$y][0]) . '</a></li>';
                            }
                        }
                        if (!$is_mega) $menu_html.= '</ul>';
                    }
                }
            }
            if (!$is_mega) $menu_html.= '</ul>';
        }
    }
}
function hc_set_menu_col($sub_sub_menu_item,$classes="") {
    $css = "";
    $style = "";
    if (isset($sub_sub_menu_item[2][0])) {
        if ($sub_sub_menu_item[2][0][4] == "") {
            $css = " no-icons";
            $style = '  style="margin-left:0"';
        }
    }
    $menu_html = '<div class="col"><ul class="fa-ul text-s' . $css . '"' . $style .'>';
    for ($x = 0; $x < count($sub_sub_menu_item[2]); $x++) {
        $sub_sub_sub_menu_item = $sub_sub_menu_item[2][$x];
        if ($sub_sub_sub_menu_item[4] == "_mega_menu_title") {
            $menu_html .= '</ul>' .(($x==0) ? '':'<hr class="space xs">') . '<h5>' . $sub_sub_sub_menu_item[0] . '</h5><ul class="fa-ul text-s">';
        } else {
            if ($sub_sub_sub_menu_item[4] == "_divider") {
                $menu_html .= '<li role="separator" class="divider"></li>';
            } else {
                $menu_html .= '<li' . $classes . '>'. ((strlen($sub_sub_sub_menu_item[4]) == 0) ? "": "<i class='fa-li " . $sub_sub_sub_menu_item[4] . "'></i>") .'<a ' . (($sub_sub_sub_menu_item[5] == "_blank") ? 'target="_blank" ':'') . 'href="' . esc_url($sub_sub_sub_menu_item[1]) . '">' . esc_attr($sub_sub_sub_menu_item[0]) . '</a></li>';
            }
        }
    }
    $menu_html .= '</ul></div>';
    return $menu_html;
}
function hc_get_iconMenu($hc_menu_type,$menu_item) {
    return (($hc_menu_type == "icons") ? "<i class='" . ((strpos($menu_item[4],'fa fa-') !== false) ? $menu_item[4] : "onlycover") . "'" . ((strpos($menu_item[4],'fa fa-') !== false) ? "":" style='background-image:url(" . esc_url(str_replace("-I-","/",str_replace("-D-",".",str_replace("-T-",":",$menu_item[4]))))  . ")'") . "></i>" : "");
}
$menu_html .= '</ul>';
$menu_fixed = hc_is_setted('menu-fixed');

?>
<header class="scroll-change <?php if ($menu_fixed) echo "fixed-top ";
                                   if ($hc_is_transparent) echo "bg-transparent menu-transparent ";
                                   if ($hc_menu_type == "subtitle") echo "subtitle-header ";
                                   if ($hc_menu_type == "middle-logo" && hc_is_setted("menu-top-logo")) echo "menu-top-logo ";
                                   echo esc_attr(hc_get_setting("menu-css"));
                             ?>"
    <?php echo esc_attr($hc_menu_animation) ?> <?php hc_echo(hc_get_setting("menu-height"),'data-menu-height="','"') ?>>
    <div class="navbar navbar-default <?php if (hc_is_setted("menu-wide-area")) echo "wide-area "; if (hc_is_setted('menu-mega-full-width')) echo "mega-menu-fullwidth "; if ($hc_menu_type == "big-logo") echo "navbar-big-logo "; if ($menu_fixed) echo "navbar-fixed-top "; if ($hc_menu_type == "icons" && hc_is_setted("menu-top-icons")) echo " icon-menu-top"; ?>" role="navigation">
        <?php if (hc_is_setted('menu-top-area')) include("menu-top-area.php"); ?>
        <div class="navbar navbar-main <?php if ($hc_menu_type == "middle-logo") echo 'navbar-middle'; if ($hc_menu_type == "middle-box") echo 'middle-box-menu '; if ($hc_menu_type == "icons") echo 'icon-menu'; ?>">
            <div class="container">
                <?php  if ($hc_menu_type == "middle-logo" && hc_is_setted("menu-top-logo")) { ?>
                <div class="scroll-hide">
                    <div class="container">
                        <?php
                           if ($hc_is_transparent) echo "<a class='navbar-brand center scroll-hide' href='" . $home_url . "'><img class='logo-default' src='" . esc_url(hc_get_setting("logo-2")) . "' alt='' style='" . esc_attr($hc_logo_2_margin_top) . "' /></a>";
                           else echo "<a class='navbar-brand center' href='" . $home_url . "'>
                        <img class='logo-default' src='" . esc_url($logo) . "' alt='' style='" . esc_attr($hc_logo_margin_top) . "' />
                        <img class='logo-retina' src='" . esc_url($logo_retina) . "' alt='' style='" . esc_attr($hc_logo_margin_top) . "' /></a>";
                        ?>
                    </div>
                </div>
                <?php } ?>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php
                    if ($hc_is_transparent) {
                        echo "<a class='navbar-brand scroll-hide' href='" . $home_url . "'><img class='logo-default' src='" . hc_get_setting("logo-2") . "' alt='' style='" . esc_attr($hc_logo_2_margin_top) . "'/>
                              <img class='logo-retina' src='" . esc_url($logo_retina_2) . "' alt='' style='" . esc_attr($hc_logo_margin_top) . "' /></a>";
                        echo "<a class='navbar-brand scroll-show' href='" . $home_url . "'><img class='logo-default' src='" . esc_url($logo) . "' alt='' style='" . esc_attr($hc_logo_margin_top) . "' />
                              <img class='logo-retina' src='" . esc_url($logo_retina) . "' alt='' style='" . esc_attr($hc_logo_margin_top) . "' /></a>";
                    } else {
                        echo "<a class='navbar-brand' href='" . $home_url . "'><img class='logo-default' src='" . esc_url($logo) . "' alt='' style='" . esc_attr($hc_logo_margin_top) . "' /><img class='logo-retina' src='" . esc_url($logo_retina) . "' alt='' style='" . esc_attr($hc_logo_margin_top) . "' /></a>";
                    }
                    ?>
                </div>
                <div class="collapse navbar-collapse">
                    <?php if ($hc_menu_pos == "" || $hc_menu_pos == "left") echo $menu_html; //NO ESCAPE ?>
                    <div class="nav navbar-nav navbar-right">
                        <?php if ($hc_menu_pos == "right") echo $menu_html; //NO ESCAPE ?>
                        <?php if (hc_is_setted('menu-search')) {  ?>
                        <form role="search" method="get" id="searchform" class="navbar-form" action="<?php echo $home_url ?>">
                            <div class="input-group">
                                <input name="s" id="s" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search for ...','hc'); ?>" />
                                <span class="input-group-btn">
                                    <input class="btn btn-default" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'GO','hc'); ?>" />
                                </span>
                            </div>
                        </form>
                        <?php } ?>
                        <?php if (hc_is_setted('menu-social')) { ?>
                        <div class="btn-group navbar-social">
                            <div class="btn-group social-group">
                                <?php hc_get_social_links() ?>
                            </div>
                        </div>
                        <?php }
                              if (hc_is_setted('menu-shop')) hc_get_shop_menu();
                              if (hc_is_setted('menu-search-button')) { ?>
                        <form role="search" method="get" id="searchform" onsubmit="return true" class="navbar-form" action="<?php echo esc_url(HC_SITE_URL) ?>">
                            <div class="search-box-menu">
                                <div class="search-box scrolldown">
                                    <input name="s" id="s" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search for ...','hc'); ?>" />
                                    <input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'GO','hc'); ?>" />
                                </div>
                                <button class="btn btn-default btn-search" value="<?php esc_attr_e( 'GO','hc'); ?>">
                                    <span class="fa fa-search"></span>
                                </button>
                            </div>
                        </form>
                        <?php }
                              if (hc_is_setted('menu-custom-area')) echo '<div class="custom-area">' . html_entity_decode(hc_get_setting('menu-custom-area')) . '</div>';
                              if (hc_is_setted('menu-language')) echo hc_get_wpml_menu();
                        ?>
                    </div>
                </div>
            </div>
            <?php  if ($hc_menu_type == "middle-box") { ?>
            <div class="container box-menu-inner scroll-hide">
                <?php echo html_entity_decode(hc_get_setting('menu-middle-box')); ?>
            </div>
            <?php } ?>
        </div>
    </div>
</header>
