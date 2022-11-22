<?php
// =============================================================================
// CONTAINERS.PHP
// -----------------------------------------------------------------------------
// Hybric Composer containers front-end components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. SCROLL BOX - Documentation and demo: framework-y.com/containers/others.html#scroll-box
//   02. GRID TABLE - Documentation and demo: framework-y.com/components/components.html#table-bootgrid
//   03. PAGE LIGHTBOX - Documentation and demo: framework-y.com/containers/lightbox-popup.html
//   04. PAGE POPUPS - Documentation and demo: framework-y.com/containers/lightbox-popup.html
//   05. SLIDER - Documentation and demo: framework-y.com/containers/sliders.html
//   06. TAB - Documentation and demo: framework-y.com/containers/others.html#tabs
//   07. ACCORDION - Documentation and demo: framework-y.com/containers/others.html#accordion-lists
//   08. COLLAPSE - Documentation and demo: framework-y.com/containers/others.html#cbox
//   09. GRID LIST - Documentation and demo: framework-y.com/containers/list-grid.html
//   10. MASONRY LIST - Documentation and demo: framework-y.com/containers/list-masonry.html
//   11. ALBUM - Documentation and demo: framework-y.com/containers/list-masonry.html#maso-gallery-albums
//   12. FIXED AREA - Documentation and demo: framework-y.com/components/components-base.html#base-javascript
//   13. POPOVER - Documentation and demo: framework-y.com/components/components-bootstrap.html#popovers
//   14. STEPS - Documentation and demo: framework-y.com/components/containers/others.html#steps
// =============================================================================

function hc_include_hc_scroll_box(&$Y_NOW,$EXTRA) {   ?>
<div data-height-remove="<?php echo esc_attr($Y_NOW["remove_height"]); ?>" class="scroll-content <?php echo hc_get_component_classes($Y_NOW,$EXTRA); if ($Y_NOW["mobile_disabled"] == "true") echo " scroll-mobile-disabled"; ?>" data-height="<?php if (hc_get_now($Y_NOW,"full_screen")) echo "fullscreen"; else echo esc_attr($Y_NOW["height"]); ?>" data-options="<?php echo esc_attr($Y_NOW["data_options"]); ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
    $CURRENT_SECTION = $Y_NOW["content"];
    for ($i = 0; $i < count($CURRENT_SECTION); $i++) {
        hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA);
    }
    ?>
</div>
<?php }
function hc_include_hc_grid_table(&$Y_NOW,$EXTRA) {
    $CURRENT_SECTION = $Y_NOW["content"];
    $cols = $Y_NOW["cols"];
    $count = count($Y_NOW["content"]);
    $css = "";
    if (hc_get_now($Y_NOW,"full-border")) {
        $css = " full-border-table";
    }
    if (hc_get_now($Y_NOW,"full-mobile")) {
        $css .= " grid-table-sm-12";
    }
?>
<table class="grid-table border-table <?php echo hc_get_component_classes($Y_NOW,$EXTRA);  echo $css; ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <tbody>
        <?php
    for ($i = 0; $i < $Y_NOW["rows"]; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $Y_NOW["cols"]; $j++) {
            echo "<td>";
            $index = $i * $cols + $j;
            if ($index < $count) hc_get_content_recursive($CURRENT_SECTION[$i * $cols + $j],$EXTRA);
            echo "</td>";
        }
        echo "</tr>";
    }
        ?>
    </tbody>
</table>
<?php }
function hc_include_hc_page_lightbox(&$Y_NOW,$EXTRA) {}
function hc_include_hc_page_popup(&$Y_NOW,$EXTRA) {}
function hc_include_hc_image_slider(&$Y_NOW,$EXTRA) {
    $cnt_classes = $Y_NOW["type"] . ' ' . hc_get_component_classes($Y_NOW,$EXTRA);
    if (hc_get_now($Y_NOW,"nav_inner") == "true") $cnt_classes .= " nav-inner";
    if ($Y_NOW["outer_arrows"] == "true") $cnt_classes .= " outer-navs";
    if ($Y_NOW["visible_arrows"] == "true") $cnt_classes .= " visible-dir-nav";
    if (hc_get_now($Y_NOW,"png-over") == "true") $cnt_classes .= " png-over";
?>
<div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="flexslider <?php echo $cnt_classes ?>"
    data-options="<?php echo esc_attr($Y_NOW["data_options"]) ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php hc_echo(hc_get_now($Y_NOW,"trigger"),"data-trigger='","'") ?>>
    <ul class="slides">
        <?php
    $arr = $Y_NOW["slides"];
    $span_1 = "";
    $span_2 = "";
    $custom_class = hc_get_now($Y_NOW,"custom_classes");
    if (hc_get_now($Y_NOW,"thumbnail")) {
        $custom_class .= " thumbnail";
        $span_1 = "<span>";
        $span_2 = "</span>";
    }
    $custom_class .= hc_get(hc_get_now($Y_NOW,"image_animation")," img-","");
    $html = "";
    if ($Y_NOW["lightbox"] == "true") {
        $anima = hc_get(esc_attr($Y_NOW["lightbox_animation"]),"data-lightbox-anima='","'");
        for ($i = 0; $i < count($arr); $i++) $html .= '<li><a class="img-box lightbox ' . $custom_class . '" href="'. hc_get_img($arr[$i]["link"],hc_get_now($Y_NOW,"image_size","ultra-large")) .'" ' . $anima .'>' . $span_1 . '<img alt="slide" src="'.  hc_get_img($arr[$i]["link"], $Y_NOW["thumb_size"]) .'" />' . $span_2 . '</a></li>';
    } else {
        for ($i = 0; $i < count($arr); $i++) {
            $html .= '<li><img class="' . $custom_class . '" alt="slide" src="'.  hc_get_img($arr[$i]["link"], $Y_NOW["thumb_size"]) .'" /></li>';
        }
    }
    echo $html;
        ?>
    </ul>
</div>
<?php }
function hc_include_hc_slider(&$Y_NOW,$EXTRA) {
    $cnt_classes = $Y_NOW["type"] . ' ' . hc_get_component_classes($Y_NOW,$EXTRA);
    if (hc_get_now($Y_NOW,"nav_inner") == "true") $cnt_classes .= " nav-inner";
    if ($Y_NOW["outer_arrows"] == "true") $cnt_classes .= " outer-navs";
    if ($Y_NOW["visible_arrows"] == "true") $cnt_classes .= " visible-dir-nav";
    if (hc_get_now($Y_NOW,"png-over") == "true") $cnt_classes .= " png-over";
?>
<div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="flexslider <?php echo $cnt_classes ?>"
    data-options="<?php echo esc_attr($Y_NOW["data_options"]) ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php hc_echo(hc_get_now($Y_NOW,"trigger"),"data-trigger='","'") ?>>
    <ul class="slides">
        <?php
    $arr = $Y_NOW["content"];
    $CURRENT_SECTION = $Y_NOW["content"];
    for ($i = 0; $i < count($arr); $i++) { ?>
        <li>
            <?php  hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA); ?>
        </li>
        <?php } ?>
    </ul>
</div>
<?php }
function hc_include_hc_adv_slider(&$Y_NOW,$EXTRA) { ?>
<div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="section-slider <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>">
    <div class="flexslider advanced-slider slider <?php if (hc_get_now($Y_NOW,"nav_inner") == "true") echo " nav-inner"; if ($Y_NOW["outer_arrows"] == "true") echo " outer-navs"; if ($Y_NOW["visible_arrows"] == "true") echo " visible-dir-nav"; ?>"
        data-options="<?php echo esc_attr($Y_NOW["data_options"]) ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php hc_echo(hc_get_now($Y_NOW,"trigger"),"data-trigger='","'") ?>>
        <ul class="slides">
            <?php
    array_push($EXTRA,"flexslider");
    for ($i = 1; $i < 7; $i++) {
        if (count($Y_NOW["content_" . $i]) > 0) {
            $CURRENT_SECTION = $Y_NOW["content_". $i];
            ?>
            <li <?php hc_echo($Y_NOW["animation"],'data-slider-anima="','"'); ?>>
                <div class="section-slide">
                    <?php hc_echo(hc_get_img($Y_NOW["image_" . $i],"hd"),'<div class="bg-cover" style="background-image:url(',')"></div>'); ?>
                    <div class="container">
                        <div class="container-middle">
                            <div class="container-inner">
                                <?php
            for ($j = 0; $j < count($CURRENT_SECTION); $j++) {
                hc_get_content_recursive($CURRENT_SECTION[$j],$EXTRA);
            }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php }
    } ?>
        </ul>
    </div>
</div>
<?php }
function hc_include_hc_image_coverflow(&$Y_NOW,$EXTRA) {
    $slide_width = hc_get(esc_attr($Y_NOW["slide_width"]),"data-width='","'") . hc_get(hc_get_now($Y_NOW,"slide_width_mobile")," data-mobile-width='","'");
?>
<div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="coverflow-slider <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" data-options="enableMousewheel:false" <?php echo $slide_width; ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php hc_echo(hc_get_now($Y_NOW,"trigger"),"data-trigger='","'") ?>>
    <ul class="slides">
        <?php
    $arr = $Y_NOW["slides"];
    $span_1 = "";
    $span_2 = "";
    $custom_class = hc_get_now($Y_NOW,"custom_classes");
    if (hc_get_now($Y_NOW,"thumbnail")) {
        $custom_class .= " thumbnail";
        $span_1 = "<span>";
        $span_2 = "</span>";
    }
    $custom_class .= hc_get(hc_get_now($Y_NOW,"image_animation")," img-","");
    $html = "";
    if ($Y_NOW["lightbox"] == "true") {
        $anima = hc_get(esc_attr($Y_NOW["lightbox_animation"]),"data-lightbox-anima='","'");
        for ($i = 0; $i < count($arr); $i++) $html .= '<li><a class="img-box lightbox ' . $custom_class . '" href="'. hc_get_img($arr[$i]["link"],"ultra-large") .'" ' . $anima .'>' . $span_1 . '<img alt="slide" src="'.  hc_get_img($arr[$i]["link"], $Y_NOW["thumb_size"]) .'" />' . $span_2 . '</a></li>';
    } else {
        for ($i = 0; $i < count($arr); $i++) {
            $html .= '<li><img class="' . $custom_class . '" alt="slide" src="'.  hc_get_img($arr[$i]["link"], $Y_NOW["thumb_size"]) .'" /></li>';
        }
    }
    echo $html;
        ?>
    </ul>
</div>
<?php }
function hc_include_hc_coverflow(&$Y_NOW,$EXTRA) {
    $slide_width = hc_get(esc_attr($Y_NOW["slide_width"]),"data-width='","'") . hc_get(hc_get_now($Y_NOW,"slide_width_mobile")," data-mobile-width='","'");
?>
<div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="coverflow-slider <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" data-options="enableMousewheel:false" <?php echo $slide_width; ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <ul class="slides">
        <?php
    $arr = $Y_NOW["content"];
    $CURRENT_SECTION = $Y_NOW["content"];
    for ($i = 0; $i < count($arr); $i++) { ?>
        <li>
            <?php  hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA); ?>
        </li>
        <?php } ?>
    </ul>
</div>
<?php }
function hc_tab_menu(&$Y_NOW,$classes) {
    $style = $Y_NOW["style"];
?>
<ul class="nav <?php if ($style=="justified" || $style=="justified-bottom") echo "nav-justified "; echo hc_get_component_classes($Y_NOW,array()); if ($style == "vertical-left-justified" || $style == "vertical-right-justified") echo "nav-justified-v "; if ($style=="centered" || $style=="centered-bottom") echo "nav-center "; echo esc_attr($classes); if ($Y_NOW["pills"] == "true") echo " nav-pills"; else echo " nav-tabs"; ?>">
    <?php
    for ($i = 1; $i < 9; $i++) {
        if (count($Y_NOW["content_" . $i]) > 0) echo "<li" . (($i==1) ? " class='active'" : "") . hc_get(esc_attr($Y_NOW["animation_icon"])," data-anima='","' data-trigger='hover'") ."><a>" . hc_get_icon($Y_NOW["icon_" . $i],$Y_NOW["icon_style_" . $i],$Y_NOW["icon_image_" . $i], ((strlen($Y_NOW["animation_icon"]) > 0) ? "anima ":"")) . " " . $Y_NOW["name_" . $i] . "</a></li>";
    }
    ?>
</ul>
<?php   }
function hc_tab_content(&$Y_NOW,$EXTRA) {
    for ($i = 1; $i < 9; $i++) {
        if (count($Y_NOW["content_" . $i]) > 0) {
            $arr = $Y_NOW["content_". $i];
            $CURRENT_SECTION = $Y_NOW["content_". $i]; ?>
<div class="panel <?php if ($i==1) echo "active"; ?>">
    <div class="row">
        <?php for ($j = 0; $j < count($arr); $j++) {
                  hc_get_content_recursive($CURRENT_SECTION[$j],$EXTRA);
              }
        ?>
    </div>
    <div class="clear"></div>
</div>
<?php
        }
    }
}
function hc_include_hc_tab(&$Y_NOW,$EXTRA) {
    $style = $Y_NOW["style"];
    if ($style == "vertical-left" || $style == "vertical-left-justified" || $style == "vertical-right" || $style == "vertical-right-justified") {
        $tab_style = "right";
        if ($style == "vertical-left" || $style == "vertical-left-justified") $tab_style = "left";
?>
<div class="tab-box <?php echo esc_attr($tab_style) . ' ' .  hc_get_component_classes($Y_NOW,$EXTRA); if ($Y_NOW["pills"] == "true") echo " pills"; ?>" <?php hc_echo(esc_attr($Y_NOW["animation"]),"data-tab-anima='","'"); ?> style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
        $col_menu = "col-md-4";
        $col_panel = "col-md-8";
        $layout = hc_get_now($Y_NOW,"layout");
        if ($layout == "3-9") {
            $col_menu = "col-md-3";
            $col_panel = "col-md-9";
        }
        if ($layout == "2-10") {
            $col_menu = "col-md-2";
            $col_panel = "col-md-10";
        }
        if ($tab_style == "right") { ?>
    <div class="panel-box col-md-8">
        <?php
            hc_tab_content($Y_NOW,$EXTRA);
        ?>
    </div><?php
            hc_tab_menu($Y_NOW,$col_menu);
        } else {
            hc_tab_menu($Y_NOW,$col_menu); ?>
    <div class="panel-box <?php echo $col_panel ?>">
        <?php
            hc_tab_content($Y_NOW,$EXTRA);
        ?>
    </div><?php
        }
          ?>
</div>
<?php } else {
        $tab_style = "";
        if ($style == "classic-bottom" || $style == "justified-bottom" || $style == "centered-bottom") $tab_style = "bottom";
?>
<div class="tab-box <?php echo hc_get_component_classes($Y_NOW,$EXTRA) . ' '; if ($tab_style == "bottom") echo "inverse"; if ($Y_NOW["pills"] == "true") echo " pills"; ?>" <?php hc_echo(esc_attr($Y_NOW["animation"]),"data-tab-anima='","'"); ?> style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
        if ($tab_style == "bottom") {
            hc_tab_content($Y_NOW,$EXTRA);
            hc_tab_menu($Y_NOW,"");
        } else {
            hc_tab_menu($Y_NOW,"");
            hc_tab_content($Y_NOW,$EXTRA);
        }
    ?>
</div>
<?php  }
}
function hc_include_hc_accordion(&$Y_NOW,$EXTRA) { ?>
<div class="list-group accordion-list <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" <?php hc_echo(esc_attr($Y_NOW["open_type"]),"data-type='","'"); hc_echo(esc_attr($Y_NOW["time"])," data-time='","'"); ?> style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"open"))," data-open='","'"); ?>>
    <?php
    for ($i = 1; $i < 11; $i++) {
        if (count($Y_NOW["content_" . $i]) > 0) {
            $arr = $Y_NOW["content_". $i];
            $CURRENT_SECTION = $Y_NOW["content_". $i];
    ?>
    <div class="list-group-item">
        <a href="#">
            <?php echo hc_get_icon($Y_NOW["icon_" . $i],$Y_NOW["icon_style_" . $i],$Y_NOW["icon_image_" . $i],""); echo esc_attr($Y_NOW["name_" . $i]); ?>
        </a>
        <div class="panel">
            <div class="inner">
                <?php
            for ($j = 0; $j < count($arr); $j++) {
                hc_get_content_recursive($CURRENT_SECTION[$j],$EXTRA);
            }
                ?>
            </div>
        </div>
    </div>
    <?php  }
    }
    ?>
</div>
<?php }
function hc_include_hc_steps(&$Y_NOW,$EXTRA) {
    $steps_num = 1;
    $col = "col-md-12";
    if ($Y_NOW["name_2"] != "") { $steps_num = 2; $col = "col-md-6"; }
    if ($Y_NOW["name_3"] != "") { $steps_num = 3; $col = "col-md-4"; }
    if ($Y_NOW["name_4"] != "") { $steps_num = 4; $col = "col-md-3"; }
    if ($Y_NOW["name_5"] != "") { $steps_num = 5; $col = "col-md-2"; }
    if ($Y_NOW["name_6"] != "") { $steps_num = 6; $col = "col-md-2"; }
?>
<div class="row box-steps <?php echo hc_get_component_classes($Y_NOW,$EXTRA) ?>" <?php hc_echo(esc_attr($Y_NOW["custom_css_styles"]),'style="','"') ?>>
    <?php
    for ($i = 1; $i <= $steps_num; $i++) {
        if (count($Y_NOW["content_" . $i]) > 0) {
            $arr = $Y_NOW["content_". $i];
            $CURRENT_SECTION = $Y_NOW["content_". $i];
    ?>
    <div class="step-item <?php echo $col ?>">
        <span class="step-number">
            <?php esc_attr_e($Y_NOW["number_" . $i]) ?>
        </span>
        <h3>
            <?php esc_attr_e($Y_NOW["name_" . $i]) ?>
        </h3>
        <?php
            for ($j = 0; $j < count($arr); $j++) {
                hc_get_content_recursive($CURRENT_SECTION[$j],$EXTRA);
            }
        ?>
    </div>
    <?php  }
    } ?>
</div>
<?php }
function hc_include_hc_collapse(&$Y_NOW,$EXTRA) { ?>
<div class="collapse-box <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" <?php hc_echo(esc_attr($Y_NOW["height"]),"data-height='","'"); ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php if ($Y_NOW["position"] == "top") echo '<div class="text-' . esc_attr(hc_get_now($Y_NOW,"alignment","center")) .'"><a class="collapse-button" data-button-open-text="' . hc_get_now($Y_NOW,"button_open_text","Close") . '"'. hc_get(esc_attr($Y_NOW["time"])," data-time='","'") .'><b>' . hc_get_now($Y_NOW,"button_text","Show all") . '</b><span class="caret"></span></a></div>'; ?>
    <div class="panel">
        <?php
    $arr = $Y_NOW["content"];
    $CURRENT_SECTION = $Y_NOW["content"];
    for ($i = 0; $i < count($arr); $i++) {
        hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA);
    } ?>
    </div>
    <?php if ($Y_NOW["position"] == "bottom") echo '<div class="text-' . hc_get_now($Y_NOW,"alignment","center") .'"><a class="collapse-button" data-button-open-text="' . hc_get_now($Y_NOW,"button_open_text","Close") . '" ' . hc_get(esc_attr($Y_NOW["time"])," data-time='","'") .'><b>' . hc_get_now($Y_NOW,"button_text","Show all") . '</b><span class="caret"></span></a></div>'; ?>
</div>
<?php }
function hc_include_hc_grid_list(&$Y_NOW,$EXTRA) {
    $gallery = false;
    if (hc_get_now($Y_NOW,"gallery") == "true" || $Y_NOW["tab_index"] == 0) $gallery = true;
?>
<div class="grid-list <?php echo hc_get_component_classes($Y_NOW,$EXTRA); if (hc_get_now($Y_NOW,"gallery") == "true" || $Y_NOW["tab_index"] == 0) echo " gallery"; if($Y_NOW["column"] == "col-md-12") echo " one-row-list"; ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div class="grid-box row" <?php hc_echo($Y_NOW["lightbox_animation"],"data-lightbox-anima='","'"); if (strlen($Y_NOW["margins"]) > 0) echo ' style="margin: -'. esc_attr($Y_NOW["margins"]) . 'px; width: calc(100% + ' . intval ($Y_NOW["margins"]) * 2 . 'px);"'; ?>>
        <?php if ($Y_NOW["tab_index"] == 0) {
                  $arr = $Y_NOW["images"];
                  $thumbnail = "";
                  $thumbnail_s = "";
                  $thumbnail_e = "";
                  if (hc_get_now($Y_NOW,"thumbnail") == "true") {
                      $thumbnail_s = "<span>";
                      $thumbnail_e = "</span>";
                      $thumbnail = " thumbnail";
                  }
                  $hover = hc_get(esc_attr($Y_NOW["hover_animation"]),"img-","");
                  $icon_animation = hc_get($Y_NOW["icon_animation"],"data-anima='","'  data-trigger='hover'");
                  $icon = hc_get(esc_attr($Y_NOW["icon"]),"<i class='". ((strlen($Y_NOW["icon_animation"]) > 0) ? "anima ":""),"'></i>");
                  $icon_pos = hc_get_now($Y_NOW,"icon_position","i-center");
                  $large_size = hc_get_now($Y_NOW,"lightbox_size","ultra-large");
                  if (strlen($Y_NOW["icon_animation"]) > 0 && $Y_NOW["hide_icon"] == "true") $icon_animation .= " data-anima-out='hide'";
                  $html = "";
                  for ($i = 0; $i < count($arr); $i++)  {
                      $html .= '<div class="grid-item ' . esc_attr($Y_NOW["column"] . " " . hc_get_now($Y_NOW,"mobile_column") . " " . $Y_NOW["row"]) . '" ' . hc_get(esc_attr($Y_NOW["margins"])," style='padding:","px'") . '>
                                <a class="img-box ' . $icon_pos . " " . $hover . $thumbnail . '" href="' . hc_get_img($arr[$i]["link"],$large_size) . '" '. $icon_animation . '>' . $thumbnail_s . $icon . '<img alt="" src="' . hc_get_img($arr[$i]["link"],$Y_NOW["thumb_size"]) . '" />' . $thumbnail_e . '</a></div>';
                  }
                  echo $html;
              }
              if ($Y_NOW["tab_index"] == 1) {
                  $arr = $Y_NOW["content"];
                  $CURRENT_SECTION = $Y_NOW["content"];
                  for ($i = 0; $i < count($arr); $i++) { ?>
        <div class="grid-item <?php echo esc_attr($Y_NOW["column"] . " " . hc_get_now($Y_NOW,"mobile_column") . " " . $Y_NOW["row"]); ?>" <?php hc_echo(esc_attr($Y_NOW["margins"])," style='padding:","px'"); ?>>
            <?php
                      $CURRENT_SECTION[$i]["gallery"] = $gallery;
                      hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA);
            ?>
        </div>
        <?php }
              } ?>
    </div>
    <?php if ($Y_NOW["pagination"] == "true") {
              if ($Y_NOW["pag_centered"] == "true") echo "<div class='list-nav'>"; ?>
    <ul class="<?php echo esc_attr($Y_NOW["pag_size"]); if ($Y_NOW["pag_hide_controls"] == "true") echo " hide-first-last"; ?> pagination-grid" data-page-items="<?php if (strlen($Y_NOW["pag_items"]) > 0 ) echo esc_attr($Y_NOW["pag_items"]); else echo "3"; ?>" <?php hc_echo(esc_attr($Y_NOW["pag_animation"]),"data-pagination-anima='","'"); ?> data-options="<?php echo $Y_NOW["pag_data_options"]; ?>"></ul>
    <?php if ($Y_NOW["pag_centered"] == "true") echo "</div>";
          }
          if ($Y_NOW["load_more"] == "true") {  ?>
    <div class="list-nav">
        <a class="circle-button btn btn-sm load-more-grid" <?php hc_echo(esc_attr($Y_NOW["lm_animation"]),"data-pagination-anima='","'"); ?>
            data-page-items="<?php if (strlen($Y_NOW["lm_items"]) > 0 ) echo esc_attr($Y_NOW["lm_items"]); else echo "3"; ?>"
            data-options="<?php if (strlen($Y_NOW["lm_lazy"]) > 0 ) echo "lazyLoad:true"; ?>">
            <?php echo esc_attr($Y_NOW["lm_button_text"]); ?>
            <i class="fa fa-arrow-down"></i>
        </a>
    </div>
    <?php } ?>
</div>
<?php
}
function hc_include_hc_masonry_list(&$Y_NOW,$EXTRA = array()) {
    $index = 0;
    $gallery = false;
    $css = "";
    if (hc_get_now($Y_NOW,"gallery") == "true" || $Y_NOW["tab_index"] == 0) {
        $gallery = true;
        $css .= " gallery";
    }
    if ($Y_NOW["column"] == "col-md-12") $css .= " one-row-list";
    if ($Y_NOW["auto_masonry"] == "true")  $css .= " maso-layout";
    if ($Y_NOW["menu_position"] == "nav-outer") $css .= " menu-outer";
?>
<div class="maso-list <?php echo hc_get_component_classes($Y_NOW,$EXTRA); echo $css; ?>"
    style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php if (in_array("hc_album",$EXTRA)) echo 'data-trigger="manual"'; ?>>
    <?php if ($Y_NOW["menu"] == "true") { ?>
    <div class="navbar navbar-inner">
        <div class="navbar-toggle">
            <i class="fa fa-bars"></i>
            <span>
                <?php esc_html_e("Menu","hc"); ?>
            </span>
            <i class="fa fa-angle-down"></i>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav over inner maso-filters <?php echo esc_attr($Y_NOW["menu_style"] . " " . $Y_NOW["menu_position"]); ?>">
                <li class="current-active active">
                    <a class="maso-filter-auto" data-filter="maso-item"><?php echo hc_get_now($Y_NOW,"all_text","All") ?></a>
                </li>
                <?php
              if ($Y_NOW["tab_index"] == 0) {
                  for ($i = 1; $i < 11; $i++)  {
                      if (count($Y_NOW["images_" . $i]) > 0) echo '<li><a data-filter="cat-'. esc_attr($i) .'">'. esc_attr($Y_NOW["name_" . $i]) .'</a></li>';
                  }
              }
              if ($Y_NOW["tab_index"] == 1) {
                  for ($i = 1; $i < 11; $i++)  {
                      if (count($Y_NOW["content_2_" . $i]) > 0) echo '<li><a data-filter="cat-'. esc_attr($i) .'">'. esc_attr($Y_NOW["name_2_" . $i]) .'</a></li>';
                  }
              }
                ?>
                <li>
                    <a class="maso-order maso-filter-auto" data-sort="asc">
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php } ?>
    <div class="maso-box row" <?php hc_echo(esc_attr($Y_NOW["lightbox_animation"]),"data-lightbox-anima='","'"); if (strlen($Y_NOW["margins"]) > 0) echo ' style="margin: -'. esc_attr($Y_NOW["margins"]) . 'px; width: calc(100% + ' . intval ($Y_NOW["margins"]) * 2 . 'px"'; ?>>
        <?php if ($Y_NOW["tab_index"] == 0) {
                  for ($j = 1; $j < 11; $j++)  {
                      if (count($Y_NOW["images_" . $j]) > 0) {
                          $arr = $Y_NOW["images_" . $j];
                          $hover = hc_get(esc_attr($Y_NOW["hover_animation"]),"img-","");
                          $thumbnail = "";
                          $thumbnail_s = "";
                          $thumbnail_e = "";
                          if (hc_get_now($Y_NOW,"thumbnail") == "true") {
                              $thumbnail_s = "<span>";
                              $thumbnail_e = "</span>";
                              $thumbnail = " thumbnail";
                          }
                          $icon_animation = hc_get(esc_attr($Y_NOW["icon_animation"]),"data-anima='","'  data-trigger='hover'");
                          $icon = hc_get(esc_attr($Y_NOW["icon"]),"<i class='". ((strlen($Y_NOW["icon_animation"]) > 0) ? "anima ":""),"'></i>");
                          $icon_pos = hc_get_now($Y_NOW,"icon_position","i-center");
                          $large_size = hc_get_now($Y_NOW,"lightbox_size","ultra-large");
                          if (strlen($Y_NOW["icon_animation"]) > 0 && $Y_NOW["hide_icon"] == "true") $icon_animation .= " data-anima-out='hide'";
                          for ($i = 0; $i < count($arr); $i++)  {
                              $index = $index + 1;
        ?>
        <div data-sort="<?php echo esc_attr($index); ?>" class="maso-item <?php echo esc_attr($Y_NOW["column"] . " " . hc_get_now($Y_NOW,"mobile_column") ." " . $Y_NOW["row"] . " cat-" . $j); ?>"
            <?php hc_echo(esc_attr($Y_NOW["margins"]),' style="padding:','px"'); ?>>
            <a class="img-box <?php echo $icon_pos . " " . $hover . $thumbnail; ?>" href="<?php echo hc_get_img($arr[$i]["link"], $large_size); ?>" <?php echo $icon_animation ?>>
                <?php echo $thumbnail_s ?>
                <?php echo $icon ?>
                <img alt="" src="<?php echo hc_get_img($arr[$i]["link"],$Y_NOW["thumb_size"]) ?>" />
                <?php echo $thumbnail_e ?>
            </a>
        </div>
        <?php             }
                      }
                  }
              }
              if ($Y_NOW["tab_index"] == 1) {
                  for ($j = 1; $j < 11; $j++)  {
                      if (count($Y_NOW["content_2_" . $j]) > 0) {
                          $arr = $Y_NOW["content_2_" . $j];
                          $CURRENT_SECTION = $Y_NOW["content_2_" . $j];

                          for ($i = 0; $i < count($arr); $i++) { ?>
        <div data-sort="<?php echo esc_attr($index); ?>" class="maso-item <?php echo esc_attr($Y_NOW["column"] . " " . hc_get_now($Y_NOW,"mobile_column") . " " . $Y_NOW["row"] . " cat-" . $j); ?>"
            <?php hc_echo($Y_NOW["margins"]," style='padding:","px'"); ?>>
            <?php
                              $CURRENT_SECTION[$i]["gallery"] = $gallery;
                              hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA);
            ?>
        </div>
        <?php }
                      }
                  }
              } ?>
    </div>
    <?php if ($Y_NOW["pagination"] == "true") {
              if ($Y_NOW["pag_centered"] == "true") echo "<div class='list-nav'>"; ?>
    <ul class="<?php echo esc_attr($Y_NOW["pag_size"]); if ($Y_NOW["pag_hide_controls"] == "true") echo " hide-first-last"; ?> pagination-maso" data-page-items="<?php if (strlen($Y_NOW["pag_items"]) > 0 ) echo esc_attr($Y_NOW["pag_items"]); else echo "3"; ?>" <?php hc_echo(esc_attr($Y_NOW["pag_animation"]),"data-pagination-anima='","'"); ?> data-options="<?php echo $Y_NOW["pag_data_options"]; ?>"></ul>
    <?php if ($Y_NOW["pag_centered"] == "true") echo "</div>";
          }
          if ($Y_NOW["load_more"] == "true") {  ?>
    <div class="list-nav">
        <a class="circle-button btn btn-sm load-more-maso" <?php hc_echo(esc_attr($Y_NOW["lm_animation"]),"data-pagination-anima='","'"); ?>
            data-page-items="<?php if (strlen($Y_NOW["lm_items"]) > 0 ) echo esc_attr($Y_NOW["lm_items"]); else echo "3"; ?>"
            data-options="<?php if (strlen($Y_NOW["lm_lazy"]) > 0 ) echo "lazyLoad:true"; ?>">
            <?php echo esc_attr($Y_NOW["lm_button_text"]); ?>
            <i class="fa fa-arrow-down"></i>
        </a>
    </div>
    <?php } ?>
</div>
<?php
}
function hc_include_hc_album(&$Y_NOW,$EXTRA = array()) { ?>
<div class="album-main <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" data-album-anima="<?php echo esc_attr($Y_NOW["animation"]); ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div class="album-list row">
        <?php
    $CURRENT_SECTION = $Y_NOW["menu_items"];
    for ($i = 0; $i < count($CURRENT_SECTION); $i++) { ?>
        <div class="album-box <?php echo esc_attr($Y_NOW["column"]); ?>">
            <div class="img-box scale adv-img adv-img-half-content" data-anima="fade-left" data-trigger="hover">
                <a class="img-box anima-scale-up anima">
                    <img src="<?php echo hc_get_img($CURRENT_SECTION[$i]["album_image"],'ultra-large'); ?>" alt="" />
                </a>
                <div class="caption">
                    <h2 class="album-name">
                        <?php echo esc_attr($CURRENT_SECTION[$i]["album_name"]); ?>
                    </h2>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="cont-album-box">
        <p class="album-title">
            <span>...</span>
            <a class="button-list btn btn-sm">
                <i class="fa fa-arrow-left"></i>Album list
            </a>
        </p>
        <?php
    $CURRENT_SECTION = $Y_NOW["content"];
    for ($i = 0; $i < count($CURRENT_SECTION); $i++) { ?>
        <div class="album-item">
            <?php
        array_push($EXTRA,"hc_album");
        hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA); ?>
            <div class="clear"></div>
        </div>
        <?php } ?>
    </div>
</div>
<?php
}
function hc_include_hc_fixed_area(&$Y_NOW,$EXTRA) {   ?>
<div class="fixed-area <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" <?php hc_echo(esc_attr($Y_NOW["top"]),"data-topscroll='","'"); hc_echo(esc_attr($Y_NOW["bottom"])," data-bottom='","'"); ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div class="row">
        <?php
    $CURRENT_SECTION = $Y_NOW["content"];
    for ($i = 0; $i < count($CURRENT_SECTION); $i++) {
        hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA);
    }
        ?>
    </div>
</div>
<?php }
function hc_include_hc_popover(&$Y_NOW,$EXTRA) {
    $css = 'class="' . hc_get_component_classes($Y_NOW,$EXTRA) . '" style="' . esc_attr($Y_NOW["custom_css_styles"]) . '"';
    if ($Y_NOW["type"] == "toolstip") { ?>
<div <?php echo $css ?> data-toggle="tooltip" data-placement="<?php echo esc_attr($Y_NOW["direction"]) ?>" title="<?php echo esc_attr($Y_NOW["title"]) ?>" data-trigger="<?php echo esc_attr($Y_NOW["trigger"]) ?>">
    <?php hc_get_content_recursive($Y_NOW["content"][0],$EXTRA) ?>
</div>
<?php }
    if ($Y_NOW["type"] == "popover") { ?>
<div <?php echo $css ?> data-toggle="popover" <?php hc_echo(esc_attr($Y_NOW["title"]),'title="','"') ?> data-content="<?php echo esc_attr($Y_NOW["text"]) ?>" data-placement="<?php echo esc_attr($Y_NOW["direction"]) ?>" title="<?php echo esc_attr($Y_NOW["title"]) ?>" data-trigger="<?php echo esc_attr($Y_NOW["trigger"]) ?>" data-container="body">
    <?php hc_get_content_recursive($Y_NOW["content"][0],$EXTRA) ?>
</div>
<?php }
}
function hc_include_hc_background_icon_box(&$Y_NOW,$EXTRA) { 
//This item id deprecated and will be remove soon. 
} ?>
