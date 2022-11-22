<?php
function hc_set_fullpage_bg_section($bg_settings) {
    $overlay = hc_get($bg_settings["overlay"],"
<div class='bg-overlay ","'></div>");
    if ( $bg_settings["component"] == "hc_section_image"|| $bg_settings["component"] == "hc_title_image") echo '
<div class="background-page" style="background-image:url('. hc_get_img($bg_settings["image"],"hd") .')">' . $overlay . '</div>';
    if ( $bg_settings["component"] == "hc_section_slider"|| $bg_settings["component"] == "hc_title_slider") { ?>
<div class="background-page">
    <?php echo $overlay; ?>
    <div class="flexslider slider" data-options="<?php echo esc_attr($bg_settings['data_options']); ?>,directionNav:false,animation:fade">
        <ul class="slides">
            <?php
        foreach ($bg_settings['slides'] as $value) {
            echo '<li><div class="bg-cover" style="background-image: url(' . hc_get_img($value["link"],"hd")  .')"></div></li>';
        }
            ?>
        </ul>
    </div>
</div>
<?php  }
    if ( $bg_settings["component"] == "hc_section_video" || $bg_settings["component"] == "hc_title_video") { ?>
<div class="background-page" style="background-image:url(<?php echo hc_get_img($bg_settings['image'],"hd"); ?>)">
    <?php
    echo $overlay;
    $tmp = $bg_settings['video'];
    if (strpos($tmp,'.mp4') !== false) { ?>
    <video autoplay loop muted poster="<?php echo hc_get_img($bg_settings['image'],"hd"); ?>" style="background-image:url(<?php echo hc_get_img($bg_settings['image'],"hd"); ?>)">
        <source src="<?php echo esc_url($tmp); ?>" type="video/mp4">
    </video>
    <?php } else { ?>
    <div data-video-youtube="<?php echo ((strpos($tmp,'http') !== false) ? esc_url($tmp):esc_attr($tmp)) ?>"></div>
    <?php }  ?>
</div>
<?php }
}

if (isset($HC_PAGE_ARR["template_setting"])) {
    $fp_settings = $HC_PAGE_ARR["template_setting"]["settings"];
    $menu_id;
    if (!hc_is_setted("menu-one-page")) {
        if ($fp_settings["direction"] == "") $menu_id = "fullpage-menu"; else $menu_id = "fullpage-horizontal-menu";
    } else $menu_id = "secondary-fullpage-menu";
    if ($fp_settings["menu_style"] == "classic") { ?>
<div class="fixed-top">
    <div id="<?php echo esc_attr($menu_id) ?>" class="full-width-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav over inner nav-center">
                        <?php
        $arr = $HC_PAGE_ARR["template_setting_top"]["fullpage_menu"];
        for ($i = 1; $i < $arr["repeater_items"] + 1; $i++) {
            echo ' <li><a>'. esc_attr($arr["item_" . $i]["text"]) .'</a></li>';
        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else {
        $tooltip_pos = "left";
        if ($fp_settings["menu_position"] == "left") $tooltip_pos = "right"
?>
<nav id="<?php echo esc_attr($menu_id) ?>" class="fullpage-menu <?php echo esc_attr($fp_settings["menu_position"]); if ($fp_settings["menu_style"] == "dots") echo " menu-dots"; ?>"
    <?php if ($fp_settings["menu_style"] == "none") { echo 'style="display:none"'; $fp_settings["menu_style"] = "dots"; }?>>
    <?php if (hc_get_now($fp_settings,"menu_logo") != "") { echo '<div class="fp-menu-brand' . (($fp_settings["menu_logo"] == "scroll") ? " scroll-show":"") . '"><img src="' . esc_url(hc_get_setting("logo")) . '" alt="logo" /></div>'; } ?>
    <ul>
        <?php
        $arr = $HC_PAGE_ARR["template_setting_top"]["fullpage_menu"];
        for ($i = 1; $i < $arr["repeater_items"] + 1; $i++) {
            $item = $arr["item_" . $i];
            if ($fp_settings["menu_style"] == "icon") echo ' <li><a data-toggle="tooltip" data-placement="'.$tooltip_pos.'" title="'. esc_attr($item["text"]).'">'. hc_get_icon($item["icon"], $item["icon_style"], $item["icon_image"], "") .'</a><hr /></li>';
            if ($fp_settings["menu_style"] == "icon_text") echo ' <li><a>'. hc_get_icon($item["icon"], $item["icon_style"], $item["icon_image"], "") .'<span>'.  esc_attr($item["text"]) .'</span></a><hr /></li>';
            if ($fp_settings["menu_style"] == "dots") echo ' <li><a data-toggle="tooltip" data-placement="'.$tooltip_pos.'" title="'. esc_attr($item["text"]).'"></a></li>';
        }
        ?>
    </ul>
</nav>
<?php   }
    if ($fp_settings["arrows"] == "true" || $fp_settings["arrows"] == "next" || $fp_settings["arrows"] == "all") {
        if ($fp_settings["direction"] == "") {?>
<nav class="fullpage-varrow <?php echo  esc_attr($fp_settings["arrows_position"]) . " v" . $fp_settings["arrows_style"]; ?>">
    <div class="arrow down">
        <span>
            <?php echo esc_attr($fp_settings["arrow_text_2"]); ?>
        </span>
        <i class="fa fa-angle-down"></i>
    </div>
    <?php if ($fp_settings["arrows"] != "next") { ?>
    <div class="arrow up">
        <i class="fa fa-angle-up"></i>
        <span>
            <?php echo esc_attr($fp_settings["arrow_text_1"]); ?>
        </span>
    </div>
    <?php } ?>
</nav>
<?php } else { ?>
<nav class="fullpage-arrow <?php echo esc_attr($fp_settings["arrows_style"]); ?>">
    <?php if ($fp_settings["arrows"] != "next") { ?>
    <table class="arrow left">
        <tr>
            <th>
                <i class="fa fa-angle-left"></i>
            </th>
            <th>
                <span>
                    <?php echo esc_attr($fp_settings["arrow_text_1"]); ?>
                </span>
            </th>
        </tr>
    </table>
    <?php } ?>
    <table class="arrow right">
        <tr>
            <th>
                <i class="fa fa-angle-right"></i>
            </th>
            <th>
                <span>
                    <?php echo esc_attr($fp_settings["arrow_text_2"]); ?>
                </span>
            </th>
        </tr>
    </table>
</nav>
<?php }
    }
    if ($fp_settings["single_background"]) hc_set_fullpage_bg_section($HC_PAGE_ARR["main-title"]["title_content"]);
?>
<div id="fullpage-main" <?php hc_echo($fp_settings["data_options"],"data-options='","'"); hc_echo(hc_get_now($fp_settings,"center_offset")," data-offset='","'") ?>>
    <?php
    $SUB_EXTRA = array("fullpage","single_background");
    if ($fp_settings["direction"] == "horizontal") {
        array_push($SUB_EXTRA,"fullpage_horizontal");
        echo '<div class="section">';
    }
    foreach ($HC_PAGE_ARR as $key => $value) {
        if (is_array($value) && $key != "main-title") hc_get_content_recursive($value,$SUB_EXTRA);
    }
    if ($fp_settings["direction"] == "horizontal") echo "</div>";
    if ($fp_settings["direction"] != "horizontal" && hc_get_now($fp_settings,"footer")) {
        echo '<footer class="fp-wp-footer"></footer>';
    }
    ?>
</div>
<?php }
if (hc_get_now($HC_PAGE_ARR,array("template_setting","settings","hide_header"))) {
    echo "<style>header { display:none !important; }</style>";
}
