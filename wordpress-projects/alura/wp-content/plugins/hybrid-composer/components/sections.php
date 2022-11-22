<?php
// =============================================================================
// SECTIONS.PHP
// -----------------------------------------------------------------------------
// Hybric Composer sections front-end components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. SECTION MANAGER BLOCK - Container for all the sections
//   02. SECTION IMAGE - Documentation and demo: framework-y.com/components/title/template-title-image.html
//   03. SECTION SLIDER - Documentation and demo: framework-y.com/components/title/template-title-slider.html
//   04. SECTION VIDEO - Documentation and demo: framework-y.com/components/title/template-title-video-mp4.html
//   05. SECTION ANIMATION - Documentation and demo: framework-y.com/components/title/template-title-animation.html
//   06. SECTION TWO BLOCKS - Documentation and demo: framework-y.com/sections/section-two-blocks.html
//   07. SECTION MAP - Documentation and demo: framework-y.com/sections/section-map.html
// =============================================================================

function hc_get_section_content($Y_NOW, $classes, $EXTRA = array()) { ?>
<div class="content <?php if($Y_NOW["section_width"] != "full-width") echo "container "; echo esc_attr($classes); if (in_array("fullpage", $EXTRA)) echo " box-middle"; ?>" style="<?php if (in_array("box-middle", $EXTRA)) echo "padding:0"; ?>">
    <div class="row <?php if (in_array("vertical-row", $EXTRA)) echo "vertical-row"; if (in_array("box-middle", $EXTRA) && !in_array("fullpage", $EXTRA)) echo " box-middle";  ?>">
        <?php
    $CURRENT_SECTION = $Y_NOW["section_content"];
    for ($i = 0; $i < count($CURRENT_SECTION); $i++) {
        hc_get_content_recursive($CURRENT_SECTION[$i], $EXTRA);
    }
        ?>
    </div>
</div>
<?php }
function hc_include_hc_section(&$Y_NOW,$EXTRA) {
    $section_classes = hc_get_component_classes($Y_NOW,$EXTRA);
    $SECTION_SETTINGS = $Y_NOW["section_settings"];
    $SUB_EXTRA = array();

    if ($Y_NOW["timeline_animation"] == "true") array_push($SUB_EXTRA, "timeline");
    if (!in_array("fullpage", $EXTRA)) {
        if ($Y_NOW['vertical_row'] == "true") array_push($SUB_EXTRA, "vertical-row");

        if (!empty($SECTION_SETTINGS)) {
            if ($SECTION_SETTINGS["component"] == "hc_section_image") {
                $section_overlay = esc_attr($SECTION_SETTINGS["overlay"]);
?>
<div id="<?php echo esc_attr($Y_NOW['id']); ?>" class="section-item section-bg-image <?php
                if (strlen($section_overlay) > 0) echo "overlay-container ";
                if ($SECTION_SETTINGS['parallax'] == "true") echo "parallax-window ";
                if ($SECTION_SETTINGS['full_screen'] == "true") echo "full-screen-title ";
                if ($Y_NOW['box_middle'] == "true") { echo "box-middle-container "; array_push($SUB_EXTRA, "box-middle"); }
                echo esc_attr($SECTION_SETTINGS['ken_burn']) . ' ';
                echo $section_classes;
                                                                                     ?>"
    <?php
                hc_get_scroll_animation($Y_NOW["animation"],$Y_NOW["animation_time"],$Y_NOW["timeline_animation"],$Y_NOW["timeline_delay"],$Y_NOW["timeline_order"],(in_array("fullpage", $EXTRA) ? "fullpage":""));
                $tmp = hc_get_img_arr($SECTION_SETTINGS['image']);
                if ($SECTION_SETTINGS['parallax'] == "true") {
                    hc_echo(hc_get_now($SECTION_SETTINGS,"bleed"),' data-bleed="','" ');
                    echo 'data-parallax="scroll" data-natural-height="' . esc_attr($tmp[1]) . '" data-natural-width="' . esc_attr($tmp[2]) . '" data-position="top" data-image-src="' . hc_get_img($SECTION_SETTINGS['image'],"full") . '"';
                } 
    ?>
    data-sub-height="<?php echo esc_attr($SECTION_SETTINGS['full_screen_height']) ?>" style="<?php if ($SECTION_SETTINGS['parallax'] != "true") echo 'background-image: url(' . hc_get_img($SECTION_SETTINGS['image'],"full") . '); ';  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
                if (strlen($section_overlay) > 0){
                    echo '<div class="bg-overlay ' . $section_overlay . '"></div>';
                    hc_get_section_content($Y_NOW,"overlay-content", $SUB_EXTRA);
                } else hc_get_section_content($Y_NOW,"",$SUB_EXTRA);
    ?>
</div>
<?php }
            if ($SECTION_SETTINGS["component"] == "hc_section_slider") {
                $section_overlay = $SECTION_SETTINGS["overlay"];
?>
<div id="<?php echo esc_attr($Y_NOW['id']); ?>" class="section-item section-slider <?php
                if (strlen($section_overlay) > 0) echo "overlay-container ";
                if ($SECTION_SETTINGS['full_screen']) echo "full-screen-title ";
                if ($Y_NOW['box_middle'] == "true") { echo "box-middle-container "; array_push($SUB_EXTRA, "box-middle"); }
                echo $section_classes;
                                                                                   ?>"
    style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php hc_get_scroll_animation($Y_NOW["animation"],$Y_NOW["animation_time"],$Y_NOW["timeline_animation"],$Y_NOW["timeline_delay"],$Y_NOW["timeline_order"],(in_array("fullpage", $EXTRA) ? "fullpage":"")) ?> data-sub-height="<?php echo $SECTION_SETTINGS['full_screen_height'] ?>">
    <div class="flexslider slider" data-options="<?php echo $Y_NOW["section_settings"]["data_options"] ?>">
        <ul class="slides">
            <?php
                $tmp = $SECTION_SETTINGS["slides"];
                foreach ($tmp as $value) {
                    echo '<li><img alt="slide" src="' . hc_get_img($value["link"],"hd") . '" /></li>';
                }
            ?>
        </ul>
    </div>
    <?php
                if (strlen($section_overlay) > 0) echo '<div class="bg-overlay ' . $section_overlay . '"></div>';
    ?>
    <div class="overlaybox">
        <?php  hc_get_section_content($Y_NOW,"",$SUB_EXTRA);?>
    </div>
</div>
<?php }
            if ($SECTION_SETTINGS["component"] == "hc_section_video") {
                $section_overlay = $SECTION_SETTINGS["overlay"];
?>
<div id="<?php echo esc_attr($Y_NOW['id']); ?>" class="section-item section-bg-video <?php
                if (strlen($section_overlay) > 0) echo "overlay-container ";
                if ($SECTION_SETTINGS['full_screen']) echo "full-screen-title ";
                if ($Y_NOW['box_middle'] == "true") { echo "box-middle-container "; array_push($SUB_EXTRA, "box-middle"); }
                echo $section_classes;
                                                                                     ?>"
    style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php hc_get_scroll_animation($Y_NOW["animation"],$Y_NOW["animation_time"],$Y_NOW["timeline_animation"],$Y_NOW["timeline_delay"],$Y_NOW["timeline_order"],(in_array("fullpage", $EXTRA) ? "fullpage":"")) ?>>
    <div class="videobox">
        <?php $tmp = $SECTION_SETTINGS['video'];
              if (strpos($tmp,'.mp4') !== false) { ?>
        <video autoplay loop muted poster="<?php echo hc_get_img($SECTION_SETTINGS['image'],"hd"); ?>">
            <source src="<?php echo esc_url($tmp); ?>" type="video/mp4">
        </video>
        <?php } else { ?>
        <div class="videobox">
            <div data-video-youtube="<?php echo ((strpos($tmp,'http') !== false) ? esc_url($tmp):esc_attr($tmp)) ?>"></div>
            <div class="mobile-poster" style="background-image:url(<?php echo hc_get_img($SECTION_SETTINGS['image'],"hd"); ?>)"></div>
        </div>
        <?php }  ?>
    </div>
    <?php
                if (strlen($section_overlay) > 0) echo '<div class="bg-overlay ' . $section_overlay . '"></div>';
    ?>
    <div class="overlay-content">
        <?php hc_get_section_content($Y_NOW,"",$SUB_EXTRA);?>
    </div>
</div>
<?php }
            if ($SECTION_SETTINGS["component"] == "hc_section_animation") { ?>
<div id="<?php echo esc_attr($Y_NOW['id']); ?>" class="section-item section-bg-animation header-animation 
<?php if ($Y_NOW['box_middle'] == "true") { echo "box-middle-container "; array_push($SUB_EXTRA, "box-middle"); } echo $section_classes; ?>"
    <?php $tmp = hc_get_img_arr($SECTION_SETTINGS['image']);
          if ($SECTION_SETTINGS['parallax']) {
              echo 'data-parallax="scroll" data-natural-height="' . esc_attr($tmp[1]) . '" data-natural-width="' . esc_attr($tmp[2]) . '" data-position="top" data-image-src="' . hc_get_img($SECTION_SETTINGS['image'],"full") . '" ';
              hc_echo(hc_get_now($SECTION_SETTINGS,"bleed"),' data-bleed="','" ');
          } hc_get_scroll_animation($Y_NOW["animation"],$Y_NOW["animation_time"],$Y_NOW["timeline_animation"],$Y_NOW["timeline_delay"],$Y_NOW["timeline_order"],(in_array("fullpage", $EXTRA) ? "fullpage":"")) ?> style="<?php if ($SECTION_SETTINGS['parallax'] != "true") echo 'background-image: url(' . hc_get_img($SECTION_SETTINGS['image'],"hd") . '); ';  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div id="anima-layer-<?php echo esc_attr($Y_NOW["id"]) ?>" class="anima-layer <?php echo esc_attr($SECTION_SETTINGS['animation_image']); ?>"></div>
    <div id="anima-layer-b-<?php echo esc_attr($Y_NOW["id"]) ?>" class="anima-layer <?php echo esc_attr($SECTION_SETTINGS['animation_image_2']); ?>"></div>
    <?php
                $tmp = hc_get_img_arr($SECTION_SETTINGS['image_main']);
                if ($tmp[0] != "") echo '<img alt="" class="overlay bottom center" ' . hc_get(esc_attr($tmp[2]),'width="','"') . ' src="' . esc_url($tmp[0]) .'" />';
                hc_get_section_content($Y_NOW,"",$SUB_EXTRA);
    ?>
    <script>
    jQuery(document).ready(function () {
        jQuery('#anima-layer-<?php echo esc_attr($Y_NOW["id"]) ?>').pan({ fps: 30, speed: 0.7, dir: 'left', depth: 30 });
        jQuery('#anima-layer-b-<?php echo esc_attr($Y_NOW["id"]) ?>').pan({ fps: 30, speed: 1, dir: 'left', depth: 70 });
    });
    </script>
</div>
<?php }
        } else {
?>
<div id="<?php echo esc_attr($Y_NOW['id']); ?>" class="section-item section-empty <?php if ($Y_NOW['box_middle'] == "true") { echo "box-middle-container "; array_push($SUB_EXTRA, "box-middle"); } echo $section_classes; ?>" <?php hc_get_scroll_animation($Y_NOW["animation"],$Y_NOW["animation_time"],$Y_NOW["timeline_animation"],$Y_NOW["timeline_delay"],$Y_NOW["timeline_order"],(in_array("fullpage", $EXTRA) ? "fullpage":"")) ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php  hc_get_section_content($Y_NOW,"",$SUB_EXTRA);  ?>
</div>
<?php }
    } else {
        //FULLPAGE TEMPLATE
?>
<div data-id="<?php echo esc_attr($Y_NOW['id']); ?>" class="<?php if (in_array("fullpage_horizontal",$EXTRA)) echo "slide "; else echo "section "; echo $section_classes; ?> overlay-container" <?php hc_get_scroll_animation($Y_NOW["animation"],$Y_NOW["animation_time"],$Y_NOW["timeline_animation"],$Y_NOW["timeline_delay"],$Y_NOW["timeline_order"],(in_array("fullpage", $EXTRA) ? "fullpage":"")) ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
        if (in_array("single_background",$EXTRA) && !empty($SECTION_SETTINGS)) hc_set_fullpage_bg_section($SECTION_SETTINGS);
        array_push($EXTRA, "fullpage");
        if ($Y_NOW['vertical_row'] == "true") array_push($EXTRA, "vertical-row");
        if (isset($Y_NOW["section_content"][0]["component"]) && $Y_NOW["section_content"][0]["component"] == "hc_fp_slides") {
            $extra_1 = "";
            $extra_2 = "";
            if ($Y_NOW["section_width"] != "full-width") $extra_1 = ' container';
            if (in_array("vertical-row", $EXTRA)) $extra_2 = ' vertical-row';
            $Y_NOW = $Y_NOW["section_content"][0];

            if ($Y_NOW["arrows"] != "") { ?>
    <nav class="fullpage-arrow">
        <?php if ($Y_NOW["arrows"] == "all") { ?>
        <table class="arrow left">
            <tr>
                <th>
                    <i class="fa fa-angle-left"></i>
                </th>
                <th>
                    <span>
                        <?php echo $Y_NOW["left_arrow"] ?>
                    </span>
                </th>
            </tr>
        </table>
        <?php }  ?>
        <table class="arrow right">
            <tr>
                <th>
                    <i class="fa fa-angle-right"></i>
                </th>
                <th>
                    <span>
                        <?php echo $Y_NOW["right_arrow"] ?>
                    </span>
                </th>
            </tr>
        </table>
    </nav>
    <?php }
            if ($Y_NOW["menu"]) {
                $menu_pos = "nav-center";
                $menu_vpos = "top";
                if ($Y_NOW["menu_position"] == "left" || $Y_NOW["menu_position"] == "left-bottom") $menu_pos = "nav-left";
                if ($Y_NOW["menu_position"] == "right" || $Y_NOW["menu_position"] == "right-bottom") $menu_pos = "nav-right";
                if ($Y_NOW["menu_position"] == "right-bottom" || $Y_NOW["menu_position"] == "left-bottom" || $Y_NOW["menu_position"] == "center-bottom") $menu_vpos = "bottom";
    ?>
    <div class="<?php echo $menu_vpos ?>-area hidden-sm">
        <div class="navbar navbar-inner" <?php hc_echo($Y_NOW["menu_margins"],'style="margin-' . $menu_vpos . ': ','px"') ?>>
            <div class="navbar-toggle">
                <i class="fa fa-bars"></i>
                <span>
                    <?php esc_attr_e("Menu","hc") ?>
                </span>
                <i class="fa fa-angle-down"></i>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav fullpage-inner-menu inner <?php echo $menu_pos . " " . $Y_NOW["menu_style"] ?>">
                    <?php
                $html = "";
                for ($i = 1; $i < 9; $i++) {
                    if (count($Y_NOW["content_" . $i]) > 0) {
                        $html .= '<li><a href="#">' . hc_get($Y_NOW["icon_" . $i],'<i class="','"></i> ') . $Y_NOW["name_" . $i] . '</a></li>';
                    }
                }
                echo $html;
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php }
            for ($i = 1; $i < 9; $i++) {
                if (count($Y_NOW["content_" . $i]) > 0) {
                    $CURRENT_SECTION = $Y_NOW["content_". $i];
                    $html = '<div class="slide" ' . hc_get(hc_get_img($Y_NOW["image_" . $i],"hd"),'style="background-image:url(',')"') . '><div class="content box-middle' . $extra_1 . '"><div class="row'. $extra_2 . '">';
                    $html .= "";
                    echo $html;
                    for ($j = 0; $j < count($CURRENT_SECTION); $j++) {
                        hc_get_content_recursive($CURRENT_SECTION[$j],$EXTRA);
                    }
                    echo '</div></div></div>';
                }
            }
        } else {
            hc_get_section_content($Y_NOW,"",$EXTRA);
        }
    ?>
</div>
<?php }
}
function hc_include_hc_section_two_blocks(&$Y_NOW,$EXTRA) {
    $css = "";
    $fp = false;
    if (in_array("fullpage", $EXTRA))  $fp = true;
    if ($Y_NOW["inverse"] == "true") $css .= "blocks-right";
    if($Y_NOW["section_width"] == "full-width") $css .= " full-width-section";
    if ($Y_NOW["tab_index"] == 3) $css .= " section-custom";
    $css .= " " . hc_get_now($Y_NOW,"section_skin");
    $css .= " " . esc_attr($Y_NOW["css_classes"] . $Y_NOW["custom_css_classes"]);
    if ($fp) $css .= " section";
    if (hc_get_now($Y_NOW,"boxed"))  $css .= " two-blocks-container";
?>
<div <?php echo (($fp) ? 'data-id="':'id="') . $Y_NOW['id'] ?> " class="section-item section-two-blocks <?php echo $css ?>"
    <?php hc_echo(esc_attr($Y_NOW["custom_css_styles"]),"style='","'");
          hc_echo(hc_get_now($Y_NOW,"bleed"),' data-bleed="','" ');
          if ($Y_NOW["parallax"] == "true") echo ' data-parallax="scroll" data-image-src="' . hc_get_img($Y_NOW["image"],"hd") .'"';  hc_get_scroll_animation($Y_NOW["animation"],hc_get_now($Y_NOW,"animation_time"),hc_get_now($Y_NOW,"timeline_animation"),hc_get_now($Y_NOW,"timeline_delay"),hc_get_now($Y_NOW,"timeline_order"),(in_array("fullpage", $EXTRA) ? "fullpage":"")) ?>>
    <div class="row <?php if ($Y_NOW["vertical_row"] == "true") echo "vertical-row"; ?>">
        <div class="col-md-6 <?php if ($Y_NOW["tab_index"] == 2) echo "blocks-video"; ?>">
            <?php
    if ($Y_NOW["tab_index"] == 0 && $Y_NOW["parallax"] != "true") echo '<a class="img-box"><img alt="slide" src="' . hc_get_img($Y_NOW["image"],"hd") . '" /></a>';
    if ($Y_NOW["tab_index"] == 1) { ?>
            <div class="flexslider slider">
                <ul class="slides">
                    <?php
        $tmp = $Y_NOW["slides"];
        foreach ($tmp as $value) {
            echo '<li><img alt="slide" src="'. hc_get_img($value["link"],"ultra-large") .'" /></li>';
        }
                    ?>
                </ul>
            </div>
            <?php }
    if ($Y_NOW["tab_index"] == 2) {
        $tmp = $Y_NOW['video'];
        if (strpos($tmp,'.mp4') !== false) { ?>
            <video autoplay loop muted poster="<?php echo hc_get_img($Y_NOW["video_poster"],"ultra-large"); ?>">
                <source src="<?php echo esc_url($tmp); ?>" type="video/mp4">
            </video>
            <?php } else { ?>
            <div data-video-youtube="<?php echo ((strpos($tmp,'http') !== false) ? esc_url($tmp):esc_attr($tmp)) ?>"></div>
            <?php }
    }
    if ($Y_NOW["tab_index"] == 3) {
        $CURRENT_SECTION = $Y_NOW["custom_content"];
        for ($i = 0; $i < count($CURRENT_SECTION); $i++) {
            hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA);
        }
    }
            ?>
        </div>
        <div class="col-md-6">
            <div class="content">
                <?php
    $CURRENT_SECTION = $Y_NOW["section_content"];
    for ($i = 0; $i < count($CURRENT_SECTION); $i++) {
        hc_get_content_recursive($CURRENT_SECTION[$i], $EXTRA);
    }
                ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<?php }
function hc_include_hc_section_map(&$Y_NOW,$EXTRA) {
    $fp = false;
    if (in_array("fullpage", $EXTRA))  $fp = true;
?>
<div <?php echo (($fp) ? 'data-id="':'id="') . $Y_NOW['id'] ?>" class="<?php if ($fp) echo "section" ?> section-map box-middle-container <?php echo esc_attr($Y_NOW["css_classes"] . $Y_NOW["custom_css_classes"]) ?>" style="<?php echo 'height: ' . esc_attr($Y_NOW["map_height"]) . 'px; '. esc_attr($Y_NOW["custom_css_styles"]) ?>">
    <div class="google-map" data-address="<?php echo esc_attr($Y_NOW["map_address"]); ?>"
        data-zoom="<?php if (strlen($Y_NOW["map_zoom"]) > 0) echo esc_attr($Y_NOW["map_zoom"]); else echo "12"; ?>"
        data-coords="<?php echo esc_attr($Y_NOW["map_coordinates"]); ?>"
        data-marker-pos="<?php echo esc_attr($Y_NOW["marker_position"]); ?>"
        data-skin="<?php echo esc_attr($Y_NOW["map_skin"]); ?>"
        data-marker-pos-top="<?php echo esc_attr($Y_NOW["marker_position_top"]); ?>"
        data-marker-pos-left="<?php echo esc_attr($Y_NOW["marker_position_left"]); ?>"
        <?php if (strlen($Y_NOW["marker_image"]) > 0) echo ' data-marker="'. hc_get_img($Y_NOW["marker_image"]).'"'; ?>></div>
    <?php
    if (count($Y_NOW["section_content"]) > 0 ) {
        $box_pos = $Y_NOW["map_box_position"]; ?>
    <div class="overlaybox overlaybox-side <?php if ($box_pos == "right") echo 'overlaybox-right'; if ($box_pos == "top") echo 'overlaybox-center overlaybox-top'; if ($box_pos == "bottom") echo 'overlaybox-center overlaybox-bottom'; ?>">
        <div class="container content">
            <div class="row">
                <?php if ($box_pos == "right" || $box_pos == "left") echo '<div class="col-md-6"></div>'; ?>
                <div class="col-md-6 overlaybox-inner <?php if ($box_pos == "right" || $box_pos == "left") echo 'box-middle' ?>">
                    <div class="row">
                        <?php
        $CURRENT_SECTION = $Y_NOW["section_content"];
        for ($i = 0; $i < count($CURRENT_SECTION); $i++) {
            hc_get_content_recursive($CURRENT_SECTION[$i], $EXTRA);
        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php }
?>


