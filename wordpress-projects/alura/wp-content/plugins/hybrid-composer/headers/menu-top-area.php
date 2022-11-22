<?php
// =============================================================================
// MENU-TOP-AREA.PHP
// -----------------------------------------------------------------------------
// Top area of horizontal menu types.
// Documentation: framework-y.com/components/menu/menu-documentation-sections.html
// =============================================================================

$topMenuArr = hc_get_menu_array("extra-menu");
$top_menu_html = "";
for ($i = 0; $i < count($topMenuArr); $i++) {
    $menu_item = $topMenuArr[$i];
    $top_menu_html .= '<span><a href="' . esc_url($menu_item[1]) . '">'. ((strlen($menu_item[4]) > 0) ? "<i class='" . $menu_item[4] . "'></i>" : "") . esc_attr($menu_item[0]) .'</a></span><hr />';
}
if (strlen($top_menu_html) > 0) $top_menu_html = mb_substr($top_menu_html,0, strlen($top_menu_html) - 6);
?>


<div class="navbar-mini <?php if (hc_is_setted('menu-top-scroll-hide')) echo "scroll-hide" ?>">
    <div class="container">
        <div class="nav navbar-nav navbar-left">
            <?php echo wp_kses_post($top_menu_html);  ?>
        </div>
        <div class="nav navbar-nav navbar-right">
            <?php 
            if (hc_is_setted('menu-top-language')) echo hc_get_wpml_menu();        
            if (hc_is_setted('menu-top-search')) {  ?>
            <form role="search" method="get" id="searchform" class="navbar-form" action="<?php echo home_url(); ?>">
                <div class="input-group">
                    <input name="s" id="s" type="text" class="form-control" placeholder="<?php esc_attr_e( 'Search for ...','hc'); ?>" />
                    <span class="input-group-btn">
                        <input class="btn btn-default" type="submit" id="searchsubmit" value="<?php esc_attr_e( 'GO','hc'); ?>" />
                    </span>
                </div>
            </form>
            <?php } ?>
            <?php if (hc_is_setted('menu-top-social')) { ?>
            <div class="minisocial-group">
                <?php hc_get_social_links() ?>
            </div>
            <?php } ?>
            <?php if (hc_is_setted('menu-custom-top-area')) { ?>
            <div class="navbar-left custom-area">
                <?php echo wp_kses_post(html_entity_decode(hc_get_setting('menu-custom-top-area'))); ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
