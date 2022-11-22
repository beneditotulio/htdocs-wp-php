<?php
// =============================================================================
// IMAGE_BOX.PHP
// -----------------------------------------------------------------------------
// Hybric Composer image boxes front-end components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. IMAGE BOX - Documentation and demo: framework-y.com/components/image-box.html
//   02. ADVANCED IMAGE BOX - Documentation and demo: framework-y.com/components/image-box.html#advanced-image-box
//   03. IMAGE - Static image
// =============================================================================

function hc_include_hc_image_box(&$Y_NOW,$EXTRA) {
    $img = hc_get_img_arr($Y_NOW['image']);
    $css_classes = "img-box " . $Y_NOW['icon_position'] . " " . $Y_NOW["css_classes"] . " " . $Y_NOW["custom_css_classes"]. " ";
    $img_style = $Y_NOW['style'];
    if ($img_style == "square_thumbnail") $css_classes .= "thumbnail ";
    if ($img_style == "circle") $css_classes .= "circle ";
    if ($img_style == "circle_thumbnail") $css_classes .= "circle thumbnail ";
    if ($Y_NOW['img_box_inner_caption'] == "true") $css_classes .= "inner ";
    if (strlen($Y_NOW["image_animation"]) > 0) $css_classes .= "img-" . $Y_NOW["image_animation"];
?>
<a id="<?php echo esc_attr($Y_NOW["id"]); ?>" <?php hc_set_link_settings($Y_NOW, $css_classes);
                                                    if (strlen($Y_NOW['icon_animation']) > 0) echo ' data-anima="'. esc_attr($Y_NOW['icon_animation']) . '" data-trigger="hover" ';
                                                    if ($Y_NOW['icon_hidden'] == "true") echo ' data-anima-out="hide"';
                                              ?> style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <span>
        <?php if (strlen($Y_NOW['icon']) > 0) echo '<i class="' . esc_attr($Y_NOW["icon"]) . ' ' .  ((strlen($Y_NOW['icon_animation']) > 0) ? 'anima':'') .'"></i>'; ?>
        <img alt="<?php echo esc_attr(hc_get_now($Y_NOW,'alt')) ?>" src="<?php echo hc_get_img($Y_NOW['image'],hc_get_now($Y_NOW,"thumb_size","large")); ?>" data-width="<?php echo esc_attr($img[2]); ?>" data-height="<?php echo esc_attr($img[1]); ?>">
    </span>
    <?php
    if (strlen($Y_NOW['caption_img_box']) > 0) {
        if ($img_style != "circle" && $img_style != "circle_thumbnail")
            if ($Y_NOW['img_box_inner_caption'] == "true") echo '<span class="caption-box"><span class="caption">' . strip_tags($Y_NOW['caption_img_box'],'<b><span><br>') . '</span></span></a>';
        else echo '<span class="caption">'. esc_attr($Y_NOW['caption_img_box']) .'</span></a>';
        else {
            if ($Y_NOW['img_box_inner_caption'] == "true") echo '<span class="caption">'. strip_tags($Y_NOW['caption_img_box'],'<b><span><br>') .'</span></a>';
            else echo '</a><span class="caption caption-out">'. esc_attr($Y_NOW['caption_img_box']) .'</span>';
        }
    } else echo "</a>";
    hc_set_content_lightbox($Y_NOW);
}
function hc_include_hc_adv_image_box(&$Y_NOW,$EXTRA) {
    $style = $Y_NOW['box_style'];
    $img = hc_get_img($Y_NOW['image'],hc_get_now($Y_NOW,"thumb_size","large"));
    $css_cnt = hc_get_component_classes($Y_NOW,$EXTRA);
    $css_classes = "img-box ";
    $css_classes .= hc_get($Y_NOW["image_animation"], "img-", " ");
    $img_anima_no_hidden = (($Y_NOW["hidden_content"] == "true") ? "" : hc_get($Y_NOW["image_animation"], "img-", " "));
    $anima_css = (($Y_NOW["hidden_content"] == "true") ? "anima":"");

    $button = "";
    if ($Y_NOW["button_text"] != "") {
        $button = hc_get_now($Y_NOW,"button_style","circle");
        if ($button == "square") $button = "btn btn-default ";
        if ($button == "circle")  $button =  "btn circle-button ";
        if ($button == "square-border") $button = "btn btn-border ";
        if ($button == "circle-border")  $button =  "btn circle-button btn-border ";
        if ($button == "link") {
            $button =  "btn-text";
        } else {
            $button .= hc_get_now($Y_NOW,"button_dimensions","btn-sm");
            if (hc_get_now($Y_NOW,"button_animation")) $button .= " anima-button ";
        }
        $button = '<hr class="space s"><a ' . hc_get_link_settings($Y_NOW, $button)  . '>' . ((hc_get_now($Y_NOW,"button_animation")) ? '<i class="fa fa-long-arrow-right"></i> ':'') . $Y_NOW["button_text"] . '</a>';
    }

    if ($style == "double_content") { ?>
    <div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="adv-img-double-content">
        <div class="img-box adv-img adv-img-half-content <?php echo esc_attr($img_anima_no_hidden . ' ' . $css_cnt); ?>" <?php if ($Y_NOW["hidden_content"] == "true") echo 'data-anima="fade-bottom" data-trigger="hover" data-anima-out="hide"'; ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
            <?php hc_echo($Y_NOW["icon"],'<i class="',' anima anima-fade-left"></i>'); ?>
            <a <?php if (strlen($Y_NOW["button_text"]) == 0) hc_set_link_settings($Y_NOW, $css_classes); else echo ' class="' . esc_attr($css_classes) . '" href="#"' ?>>
                <img alt="" src="<?php echo esc_url($img) ?>">
            </a>
            <div class="caption <?php if ($Y_NOW["hidden_content"] == "true") echo "anima" ?>">
                <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<h3>","</h3>"); ?>
                <p>
                    <?php echo esc_attr($Y_NOW["text"]) ?>
                </p>
                <?php echo $button; ?>
            </div>
            <?php hc_set_content_lightbox($Y_NOW); ?>
        </div>
        <div class="caption-bottom">
            <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
            <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p>','</p>'); ?>
        </div>
    </div>
    <?php }
    if ($style == "half_content") { ?>
    <div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="img-box adv-img adv-img-half-content <?php echo esc_attr($img_anima_no_hidden . ' ' . $css_cnt); ?>" <?php if ($Y_NOW["hidden_content"] == "true") echo 'data-anima="fade-bottom" data-trigger="hover" data-anima-out="hide"'; ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <?php hc_echo($Y_NOW["icon"],'<i class="',' anima anima-fade-left"></i>'); ?>
        <a <?php if (strlen($Y_NOW["button_text"]) == 0) hc_set_link_settings($Y_NOW, $css_classes); else echo ' class="' . esc_attr($css_classes) . '" href="#"' ?>>
            <img alt="" src="<?php echo esc_url($img) ?>">
        </a>
        <div class="caption <?php if ($Y_NOW["hidden_content"] == "true") echo "anima" ?>">
            <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
            <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<span class='extra-content'>","</span>"); ?>
            <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p class="sub">','</p>'); ?>
            <?php hc_echo(esc_attr($Y_NOW["text"]),'<p>','</p>'); ?>
            <?php echo $button; ?>
        </div>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </div>
    <?php }
    if ($style == "side_content") { ?>
    <div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="img-box adv-img adv-img-side-content i-top-right <?php echo esc_attr($img_anima_no_hidden . ' ' . $css_cnt); ?>" <?php if ($Y_NOW["hidden_content"] == "true") echo 'data-anima="fade-left" data-trigger="hover" data-anima-out="hide"' ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <?php hc_echo($Y_NOW["icon"],'<i class="',' anima anima-fade-top"></i>'); ?>
        <a <?php if (strlen($Y_NOW["button_text"]) == 0) hc_set_link_settings($Y_NOW, $css_classes); else echo ' class="' . esc_attr($css_classes) . '" href="#"' ?>>
            <img alt="" src="<?php echo esc_url($img)?>">
        </a>
        <div class="caption <?php if ($Y_NOW["hidden_content"] == "true") echo "anima" ?>">
            <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
            <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<span class='extra-content'>","</span>"); ?>
            <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p class="sub">','</p>'); ?>
            <?php hc_echo(esc_attr($Y_NOW["text"]),'<p>','</p>'); ?>
            <?php echo $button; ?>
        </div>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </div>
    <?php }
    if ($style == "full_content") { ?>
    <div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="img-box adv-img adv-img-full-content <?php echo esc_attr($img_anima_no_hidden . ' ' . $css_cnt); ?>" <?php if ($Y_NOW['hidden_content'] == "true") echo ' data-anima="' . hc_get_now($Y_NOW,"image_animation","fade-top")  . '" data-trigger="hover" data-anima-out="hide"'; ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <div class="<?php echo esc_attr($css_classes) ?>">
            <img alt="" src="<?php echo esc_url($img)?>">
        </div>
        <a <?php hc_set_link_settings($Y_NOW, "img-box caption-bg" .(($Y_NOW["hidden_content"] == "true") ? " anima":"")); ?>>
            <div class="caption">
                <div class="inner">
                    <?php hc_echo(esc_attr($Y_NOW["icon"]),'<i class="',' main-icon anima anima-fade-top"></i>'); ?>
                    <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
                    <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<span class='extra-content'>","</span>"); ?>
                    <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p class="sub">','</p>'); ?>
                    <?php hc_echo(esc_attr($Y_NOW["text"]),'<p>','</p>'); ?>
                </div>
            </div>
        </a>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </div>
    <?php }
    if ($style == "buttons_content") { ?>
    <div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="img-box adv-img adv-img-button-content <?php echo esc_attr($css_cnt); ?>" data-anima="fade-left" data-trigger="hover" <?php if ($Y_NOW["hidden_content"] == "true") echo 'data-anima-out="hide"' ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <a <?php echo ' class="' . esc_attr($css_classes) . '" href="#"' ?>>
            <img alt="" src="<?php echo esc_url($img)?>">
        </a>
        <div class="caption <?php if ($Y_NOW["hidden_content"] == "true") echo "anima anima-fade-top" ?>">
            <div class="inner">
                <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
                <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p class="sub">','</p>'); ?>
                <?php hc_echo(esc_attr($Y_NOW["text"]),'<p>','</p>'); ?>
                <a <?php hc_set_link_settings($Y_NOW, "");?>>
                    <i class="fa <?php if(strlen($Y_NOW["icon"]) > 0) echo esc_attr($Y_NOW["icon"]); else echo "fa-link"; ?> text-m circle anima"></i>
                </a>
                <a class="lightbox" href="<?php echo esc_url($img)?>" <?php hc_echo($Y_NOW["lightbox_animation"],'data-lightbox-anima="','"'); ?>>
                    <i class="fa fa-search text-m circle anima anima-fade-right"></i>
                </a>
            </div>
        </div>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </div>
    <?php }
    if ($style == "down_text") { ?>
    <div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="img-box adv-img adv-img-down-text <?php echo esc_attr($css_cnt); ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <a <?php hc_set_link_settings($Y_NOW, "img-box i-center" . ((strlen($Y_NOW["image_animation"]) > 0) ? " img-" . $Y_NOW["image_animation"] : "")); ?>>
            <div class="caption">
                <i class="fa <?php if ($Y_NOW["icon"] != "") echo esc_attr($Y_NOW["icon"]); else echo "fa-plus"; ?>"></i>
            </div>
            <img alt="" src="<?php echo esc_url($img)?>">
        </a>
        <div class="caption-bottom">
            <h2><a <?php hc_set_link_settings($Y_NOW, (($Y_NOW["link_type"] == "lightbox") ? "lightbox":"")) ?>><?php echo esc_attr($Y_NOW["title"]); ?></a></h2>
            <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<span class='extra-content'>","</span>"); ?>
            <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p class="sub">','</p>'); ?>
            <p>
                <?php echo esc_attr($Y_NOW["text"]) ?>
            </p>
        </div>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </div>
    <?php }
    if ($style == "classic_box") { ?>
    <div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="img-box adv-img adv-img-classic-box <?php echo esc_attr($css_cnt); ?>" <?php if ($Y_NOW['image_animation'] != "") echo ' data-anima="' . hc_get_now($Y_NOW,"image_animation")  . '" data-trigger="hover"'; ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <div class="img-box">
            <img alt="" <?php if ($Y_NOW["image_animation"] != "") echo 'class="anima"' ?>" src="<?php echo esc_url($img)?>">
        </div>
        <a <?php hc_set_link_settings($Y_NOW, "caption img-box"); ?>>
            <div class="caption-inner">
                <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
                <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<span class='extra-content'>","</span>"); ?>
                <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p class="sub-text">','</p>'); ?>
                <?php hc_echo(esc_attr($Y_NOW["text"]),'<p>','</p>'); ?>
            </div>
        </a>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </div>
    <?php }
    if ($style == "circle_center") { ?>
    <a <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> <?php hc_set_link_settings($Y_NOW, "img-box adv-circle circle adv-circle-center ". esc_attr($css_classes) . (($Y_NOW["hidden_content"] == "true") ? "":" show")); ?> 
        <?php if ($Y_NOW["hidden_content"] == "true") { 
                  echo 'data-anima-out="hide" data-trigger="hover" '; 
                  if (strlen($Y_NOW["image_animation"]) > 0) echo 'data-anima="' . esc_attr($Y_NOW["image_animation"]) . '"'; 
                  else echo 'data-anima="fade-in"'; 
              } ?> 
        style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <?php hc_echo(esc_attr($Y_NOW["icon"]),'<i class="',' main-icon ' . esc_attr($anima_css) .  '"></i>'); ?>
        <img alt="" src="<?php echo esc_url($img)?>">
        <div class="caption <?php echo esc_attr($anima_css) ?>">
            <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
            <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<span class='extra-content'>","</span>"); ?>
            <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p>','</p>'); ?>
            <?php hc_echo(esc_attr($Y_NOW["text"]),'<p>','</p>'); ?>
        </div>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </a>
    <?php   }
    if ($style == "circle_center_2") { ?>
    <a <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> <?php hc_set_link_settings($Y_NOW, "img-box adv-circle circle adv-circle-center-2 ". esc_attr($css_classes) . (($Y_NOW["hidden_content"] == "true") ? "":" show")); ?> 
       <?php if ($Y_NOW["hidden_content"] == "true") { 
                 echo 'data-anima-out="hide" data-trigger="hover" '; 
                 if (strlen($Y_NOW["image_animation"]) > 0) echo 'data-anima="' . esc_attr($Y_NOW["image_animation"]) . '"'; 
                 else echo 'data-anima="fade-in"'; 
             } ?> 
        style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <?php hc_echo(esc_attr($Y_NOW["icon"]),'<i class="',' main-icon ' . esc_attr($anima_css) .  '"></i>'); ?>
        <img alt="" src="<?php echo esc_url($img)?>">
        <div class="caption <?php echo esc_attr($anima_css) ?>">
            <div class="inner">
                <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
                <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<span class='extra-content'>","</span>"); ?>
                <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p>','</p>'); ?>
                <?php hc_echo(esc_attr($Y_NOW["text"]),'<p class="sub">','</p>'); ?>
            </div>
        </div>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </a>
    <?php   }
    if ($style == "circle_half" || $style == "circle_bottom") { ?>
    <a <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> <?php hc_set_link_settings($Y_NOW, "img-box adv-circle circle " . esc_attr($css_classes) . (($style == "circle_bottom") ? " adv-circle-bottom":" adv-circle-half") . (($Y_NOW["hidden_content"] == "true") ? "":" show"));  
             if ($Y_NOW['hidden_content'] == "true") echo ' data-anima="fade-bottom" data-trigger="hover" data-anima-out="hide"'; ?>
        style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <?php hc_echo($Y_NOW["icon"],'<i class="',' main-icon ' . (($Y_NOW['hidden_content'] == "true") ? 'anima':'') . ' ' . (($style == "circle_bottom") ? " i-center":"") .'"></i>'); ?>
        <img alt="" src="<?php echo esc_url($img)?>">
        <div class="caption <?php if ($Y_NOW['hidden_content'] == "true") echo 'anima'; ?>">
            <div class="inner">
                <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
                <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<span class='extra-content'>","</span>"); ?>
                <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p>','</p>'); ?>
                <?php hc_echo(esc_attr($Y_NOW["text"]),'<p class="sub">','</p>'); ?>
            </div>
        </div>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </a>
    <?php   }
    if ($style == "circle_background") { ?>
    <a <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> <?php hc_set_link_settings($Y_NOW, "img-box adv-circle circle adv-circle-bg " . esc_attr($css_classes) . (($Y_NOW["hidden_content"] == "true") ? "":" show")); 
             if ($Y_NOW['hidden_content'] == "true") echo ' data-anima="' . ((strlen($Y_NOW["image_animation"]) > 0) ? $Y_NOW["image_animation"]:"show-scale") .'" data-trigger="hover" data-anima-out="hide"'; ?> 
        style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
        <?php hc_echo(esc_attr($Y_NOW["icon"]),'<i class="',' main-icon ' . (($Y_NOW['hidden_content'] == "true") ? 'anima':'') . '"></i>'); ?>
        <img alt="" src="<?php echo esc_url($img)?>">
        <div class="caption <?php if ($Y_NOW['hidden_content'] == "true") echo 'anima'; ?>">
            <div class="inner">
                <?php hc_echo(esc_attr($Y_NOW["title"]),"<h2>","</h2>"); ?>
                <?php hc_echo(esc_attr(hc_get_now($Y_NOW,"extra_text")),"<span class='extra-content'>","</span>"); ?>
                <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p>','</p>'); ?>
                <?php hc_echo(esc_attr($Y_NOW["text"]),'<p class="sub">','</p>'); ?>
            </div>
        </div>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </a>
<?php   }
}
function hc_include_hc_image(&$Y_NOW,$EXTRA) {
    echo '<img class="' . hc_get_component_classes($Y_NOW,$EXTRA) . '" style="' . esc_attr($Y_NOW["custom_css_styles"]) . '" src="'. hc_get_img($Y_NOW['image'],hc_get_now($Y_NOW,"thumb_size","large")) .'" alt="' . esc_attr(hc_get_now($Y_NOW,'alt')) . '" />';
} ?>
