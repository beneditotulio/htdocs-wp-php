<?php
// =============================================================================
// MENU-SUBLINE.PHP
// -----------------------------------------------------------------------------
// Subline menus type.
// This file generate the following menu types:

// 01. MENU SUBLINE - framework-y.com/components/menu/menu-subline.html
// =============================================================================

$menu_arr = hc_get_menu_array('header-menu');
$menu_html = '<ul '. ((hc_is_setted('menu-one-page')) ? 'id="hc-inner-menu" ':"") . ' class="nav navbar-nav subline-menu' . ((hc_is_setted('menu-one-page')) ? " one-page-menu":"") . '">';
$menu_sub_html = '';
for ($i = 0; $i < count($menu_arr); $i++) {
    $menu_item = $menu_arr[$i];
    $menu_html .= '<li><a href="' . esc_url($menu_item[1]) . '">' . esc_attr($menu_item[0]) . '</a></li>';
}
for ($i = 0; $i < count($menu_arr); $i++) {
    $menu_item = $menu_arr[$i];
    if (count($menu_item[2]) == 0) $menu_sub_html .= '<ul></ul>';
    else {
        $menu_sub_html .= '<ul>';
        for ($j = 0; $j < count($menu_item[2]); $j++) {
            $sub_menu_item = $menu_item[2][$j];
            $menu_sub_html .= '<li><a href="' . esc_url($sub_menu_item[1]) . '">' . esc_attr($sub_menu_item[0]) . '</a></li>';
        }
        $menu_sub_html .= '</ul>';
    }
}
$menu_html .= '</ul>';
$logo = hc_get_setting('logo');
$logo_retina = hc_get_setting("logo-retina");
if ($logo_retina == "") $logo_retina = $logo;
$home_url = home_url();
?>
<header class="<?php echo esc_attr(hc_get_setting("menu-css")); if (hc_is_setted('menu-fixed')) echo " fixed-top "; if ($hc_menu_pos == "right") echo " menu-right "; if ($hc_is_transparent) echo " bg-transparent menu-transparent scroll-change"; ?>">
    <div class="navbar navbar-default <?php if (hc_is_setted('menu-fixed')) echo "navbar-fixed-top";  ?>" role="navigation">
        <?php if (hc_is_setted('menu-top-area')) include("menu-top-area.php"); ?>
        <div class="navbar navbar-main">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo home_url() ?>">
                        <img class="logo-default" src="<?php echo esc_url($logo) ?>" alt="" style="<?php echo esc_attr($hc_logo_margin_top) ?>" />
                        <img class="logo-retina" src="<?php echo esc_url($logo_retina) ?>" alt="" style="<?php echo esc_attr($hc_logo_margin_top) ?>" />
                    </a>
                    <button type="button" class="navbar-toggle">
                        <i class="fa fa-bars"></i>
                        <span></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php if ($hc_menu_pos == "" || $hc_menu_pos == "left") echo $menu_html;//NO ESCAPE ?>
                    <div class="nav navbar-nav navbar-right">
                        <?php if ($hc_menu_pos == "right") echo $menu_html;//NO ESCAPE ?>
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
                        <?php if (hc_is_setted('menu-search-button')) { ?>
                        <form role="search" method="get" id="searchform" onsubmit='<?php echo $home_url?>' class="navbar-form" action="<?php echo $home_url ?>">
                            <div class="search-box-menu">
                                <div class="search-box scrolldown">
                                    <input name="s" id="s" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search for ...','hc'); ?>" />
                                    <input class="hidden" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'GO','hc'); ?>" />
                                </div>
                                <button class="btn btn-default btn-search" value="<?php esc_html_e( 'GO','hc'); ?>">
                                    <span class="fa fa-search"></span>
                                </button>
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
                              if (hc_is_setted('menu-custom-area')) echo '<div class="custom-area">' . wp_kses_post(html_entity_decode(hc_get_setting('menu-custom-area'))) . '</div>';
                              if (hc_is_setted('menu-language')) echo wp_kses_post(hc_get_wpml_menu());
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="subline-bar">
        <div class="container">
            <?php echo wp_kses_post($menu_sub_html); ?>
        </div>
    </div>
</header>
