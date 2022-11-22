<?php
// =============================================================================
// CONTENT_BOX.PHP
// -----------------------------------------------------------------------------
// Hybric Composer content boxes front-end components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. CONTENT BOX - Documentation and demo: framework-y.com/components/content-box.html
//   02. NICHE CONTENT BOX BLOG - Documentation and demo: framework-y.com/components/content-box.html#niche-box
//   03. NICHE CONTENT BOX TESTIMONIALS - Documentation and demo: framework-y.com/components/content-box.html#niche-box
//   04. NICHE CONTENT BOX TEAM - Documentation and demo: framework-y.com/components/content-box.html#niche-box
//   05. NICHE CONTENT BOX PRICING TABLES - Documentation and demo: framework-y.com/components/content-box.html#niche-box
//   06. NICHE CONTENT BOX CALL TO ACTION - Documentation and demo: framework-y.com/components/content-box.html#niche-box
// =============================================================================

function hc_include_hc_content_box(&$Y_NOW,$EXTRA) {
    $style = $Y_NOW['box_style'];
    $boxed = "";
    $css = "";
    $extra_content = "";
    $title = '<h3' . ((hc_get_now($Y_NOW,"title_size") != "") ? ' class="' . hc_get_now($Y_NOW,"title_size") . '"':'') . '>' . esc_attr($Y_NOW["title"]) . '</h3>';
    if ($Y_NOW["boxed"] == "true") $boxed = "boxed";
    if ($Y_NOW["boxed_inverse"] == "true") $boxed = "boxed-inverse";
    if ($Y_NOW["extra_content"] != "") $boxed .= " extra-content-cnt";
    if (hc_get_now($Y_NOW,"extra_content_2") != "") $boxed .= " extra-content-cnt extra-content-cnt-2";
    $button = "";
    $button_out = "";
    if (hc_get_now($Y_NOW,"button_style") == "hidden") {
        $css = " " . hc_get_link_classes($Y_NOW);
        if ($Y_NOW["link_type"] == "custom") $button_out .= ' data-href="#lightbox_' . $Y_NOW["id"] . '"';
        else $button_out = ' data-href="' . $Y_NOW["link"] . '"';
        if ($Y_NOW["new_window"] == "true") $button_out .= " data-target='_blank'";
        if (strlen($Y_NOW["lightbox_animation"]) > 0) $button_out .= ' data-lightbox-anima="' . $Y_NOW["lightbox_animation"] .'"';
    } else {
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
            $button = '<a ' . hc_get_link_settings($Y_NOW, $button)  . '>' . ((hc_get_now($Y_NOW,"button_animation")) ? '<i class="fa fa-long-arrow-right"></i> ':'') . $Y_NOW["button_text"] . '</a>';
        }
    }
    if ($style == "side_content") {
        $icon = hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], "icon anima");
?>
<div class="advs-box advs-box-side <?php echo hc_get_component_classes($Y_NOW,$EXTRA) . ' ' . $boxed . $css; ?>" data-anima="fade-left" data-trigger="hover" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php echo $button_out ?>>
    <div class="row">
        <?php hc_echo(hc_get_img($Y_NOW["image"],"ultra-large"),'<div class="col-md-4"><a ' . hc_get_link_settings($Y_NOW,"img-box") . '><img src="','" alt="" /></a></div>'); ?>
        <div class="<?php if ($Y_NOW["image"] != "") echo 'col-md-8'; else echo 'col-md-12'; ?>">
            <?php echo $title; ?>
            <hr class="anima" />
            <?php hc_echo($Y_NOW["extra_content"],'<span class="extra-content">','</span>'); ?>
            <?php hc_echo(hc_get_now($Y_NOW,"extra_content_2"),'<span class="extra-content-2">','</span>'); ?>
            <p class="big-text">
                <?php echo $Y_NOW["text"] ?>
            </p>
            <?php echo $button ?>
        </div>
    </div>
    <?php hc_set_content_lightbox($Y_NOW); ?>
</div>
<?php }
    if ($style == "top_icon") {
        $icon = hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], "icon circle anima");
?>
<div class="advs-box advs-box-top-icon <?php echo hc_get_component_classes($Y_NOW,$EXTRA) . ' ' . $boxed . $css ?>"
    <?php if (strlen($icon) > 0 ) echo 'data-anima="scale-up" data-trigger="hover"'; ?>
    style="<?php echo esc_attr($Y_NOW["custom_css_styles"]);
                 if ($icon == "" && $boxed == "") echo " padding-top:0 !important; margin-top:0 !important;";
                 if ($icon == "" && $boxed != "") echo " padding-top:15px !important; margin-top:0 !important;"
           ?>" <?php $button_out ?>>
    <?php echo $icon; ?>
    <?php echo $title; ?>
    <?php hc_echo($Y_NOW["extra_content"],'<span class="extra-content">','</span>'); ?>
    <?php hc_echo(hc_get_now($Y_NOW,"extra_content_2"),'<span class="extra-content-2">','</span>'); ?>
    <p class="big-text">
        <?php echo $Y_NOW["text"] ?>
    </p>
    <?php echo $button ?>
    <?php hc_set_content_lightbox($Y_NOW); ?>
</div>
<?php }
    if ($style == "side_icon") {
        $icon = hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], "icon anima");
?>
<div class="advs-box advs-box-side-icon <?php echo hc_get_component_classes($Y_NOW,$EXTRA) . ' ' . $boxed . $css ?>" <?php if (strlen($icon) > 0 ) echo 'data-anima="scale-up" data-trigger="hover"'; ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php echo $button_out ?>>
    <?php hc_echo($icon,'<div class="icon-box">','</div>'); ?>
    <div class="caption-box">
        <?php echo $title; ?>
        <?php hc_echo($Y_NOW["extra_content"],'<span class="extra-content">','</span>'); ?>
        <?php hc_echo(hc_get_now($Y_NOW,"extra_content_2"),'<span class="extra-content-2">','</span>'); ?>
        <p class="big-text">
            <?php echo $Y_NOW["text"] ?>
        </p>
        <?php echo $button ?>
        <?php hc_set_content_lightbox($Y_NOW); ?>
    </div>
</div>
<?php }
    if ($style == "top_icon_image") {
        $icon = hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], "icon anima");
?>
<div class="advs-box advs-box-top-icon-img <?php echo hc_get_component_classes($Y_NOW,$EXTRA) . ' ' . $boxed . $css ?>"
    <?php if (strlen($icon) > 0) echo 'data-anima="scale-up" data-trigger="hover"'; ?> style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php echo $button_out ?>>
    <?php echo $icon; ?>
    <a <?php hc_set_link_settings($Y_NOW, "img-box img-scale-up"); ?>>
        <span>
            <img alt="" src="<?php echo hc_get_img($Y_NOW["image"],"ultra-large"); ?>" />
        </span>
    </a>
    <div class="advs-box-content">
        <?php echo $title; ?>
        <?php hc_echo($Y_NOW["extra_content"],'<span class="extra-content">','</span>'); ?>
        <?php hc_echo(hc_get_now($Y_NOW,"extra_content_2"),'<span class="extra-content-2">','</span>'); ?>
        <p>
            <?php echo $Y_NOW["text"] ?>
        </p>
        <?php echo $button ?>
    </div>
    <?php hc_set_content_lightbox($Y_NOW); ?>
</div>
<?php }
    if ($style == "multiple_box") {
        $icon = hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], "icon anima");
?>
<div class="advs-box advs-box-multiple <?php echo hc_get_component_classes($Y_NOW,$EXTRA) . ' ' . $boxed . $css ?>" data-anima="scale-up" data-trigger="hover" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php echo $button_out ?>>
    <a class="img-box">
        <img alt="" class="anima" src="<?php echo hc_get_img($Y_NOW["image"],"large"); ?>" />
    </a>
    <div class="circle anima">
        <?php if (strlen($Y_NOW["extra_content"]) > 0) echo $Y_NOW["extra_content"];
              else echo hc_get_icon($Y_NOW["icon"],$Y_NOW["icon_style"],$Y_NOW["icon_image"],"") ?>
    </div>
    <div class="advs-box-content">
        <?php echo $title; ?>
        <?php hc_echo(hc_get_now($Y_NOW,"extra_content_2"),'<span class="extra-content">','</span>'); ?>
        <p>
            <?php echo $Y_NOW["text"] ?>
        </p>
        <?php echo $button ?>
    </div>
    <?php hc_set_content_lightbox($Y_NOW); ?>
</div>
<?php }
}
function hc_include_hc_niche_content_box_blog(&$Y_NOW,$EXTRA) {
    $boxed = "";
    if ($Y_NOW["boxed"] == "true") $boxed = "boxed";
    if ($Y_NOW["boxed_inverse"] == "true") $boxed = "boxed-inverse";
    if ($Y_NOW["box_style"] == "side") {
?>
<div class="advs-box advs-box-side-img <?php echo hc_get_component_classes($Y_NOW,$EXTRA) . ' ' . $boxed; ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div class="row">
        <div class="col-md-4">
            <?php if ($Y_NOW["media_content"]["content_type"] == "image"){ ?>
            <a <?php hc_set_link_settings($Y_NOW, "img-box"); ?>>
                <img alt="Post image" src="<?php echo hc_get_img($Y_NOW["media_content"]["image"],"ultra-large"); ?>" />
            </a>
            <?php }
                  if ($Y_NOW["media_content"]["content_type"] == "slider"){ ?>
            <div class="flexslider slider nav-inner">
                <ul class="slides">
                    <?php
                      $arr = $Y_NOW["media_content"]["slides"];
                      for ($i = 0; $i < count($arr); $i++) echo '<li><img alt="Post image" src="'.  hc_get_img($arr[$i]["link"],"ultra-large") .'" /></li>';
                    ?>
                </ul>
            </div>
            <?php }
                  if ($Y_NOW["media_content"]["content_type"] == "video"){
                      $video = $Y_NOW["media_content"]['video'];
                      if (strpos($video,'.mp4') !== false) { ?>
            <video autoplay loop poster="<?php echo hc_get_img($Y_NOW["media_content"]['image'],"ultra-large"); ?>">
                <source src="<?php echo esc_url($video); ?>" type="video/mp4">
            </video>
            <?php } else echo '<iframe src="' . esc_url('https://www.youtube.com/embed/' . hc_get_youtube_id(esc_url($video)) . '?showinfo=0&controls=0') . '"></iframe>';
                  } ?>
        </div>
        <div class="col-md-8">
            <h2>
                <a <?php hc_set_link_settings($Y_NOW, ""); ?>>
                    <?php echo esc_attr($Y_NOW["title"]); ?>
                </a>
            </h2>
            <hr />
            <div class="tag-row icon-row">
                <span>
                    <?php echo esc_attr($Y_NOW["subtitle"]) ?>
                </span>
                <div class="social-group-button">
                    <div class="social-button" data-anima="pulse-vertical" data-trigger="hover">
                        <i class="fa fa-share-alt"></i>
                    </div>
                    <div class="btn-group social-group">
                        <a target="_blank" href="#">
                            <i data-social="share-facebook" class="fa fa-facebook circle"></i>
                        </a>
                        <a target="_blank" href="#">
                            <i data-social="share-twitter" class="fa fa-twitter circle"></i>
                        </a>
                        <a target="_blank" href="#">
                            <i data-social="share-google" class="fa fa-google circle"></i>
                        </a>
                        <a target="_blank" href="#">
                            <i data-social="share-linkedin" class="fa fa-linkedin circle"></i>
                        </a>
                    </div>
                </div>
            </div>
            <p>
                <?php echo $Y_NOW["text"] ?>
            </p>
            <a <?php hc_set_link_settings($Y_NOW, " btn btn-sm anima-button"); ?>>
                <i class="fa fa-long-arrow-right"></i><?php echo esc_attr($Y_NOW["button_text"]); ?>
            </a>
        </div>
    </div>
    <?php hc_set_content_lightbox($Y_NOW); ?>
</div>
<?php }
    if ($Y_NOW["box_style"] == "full_width") { ?>
<div class="advs-box advs-box-top-icon-img niche-box-post blog-manual <?php if ($Y_NOW["extra_content"] == "") echo "no-block-infos "; echo hc_get_component_classes($Y_NOW,$EXTRA) . ' ' . $boxed; ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php hc_echo($Y_NOW["extra_content"],'<div class="block-infos"><div class="block-data">','</div></div>'); ?>
    <?php if ($Y_NOW["media_content"]["content_type"] == "image"){ ?>
    <a <?php hc_set_link_settings($Y_NOW, "img-box"); ?>>
        <img alt="Post image" src="<?php echo hc_get_img($Y_NOW["media_content"]["image"],"ultra-large") ?>" />
    </a>
    <?php }
          if ($Y_NOW["media_content"]["content_type"] == "slider"){ ?>
    <div class="flexslider slider nav-inner">
        <ul class="slides">
            <?php
              $arr = $Y_NOW["media_content"]["slides"];
              for ($i = 0; $i < count($arr); $i++) echo '<li><img alt="Post image" src="' . hc_get_img($arr[$i]["link"],"ultra-large") . '" /></li>';
            ?>
        </ul>
    </div>
    <?php }
          if ($Y_NOW["media_content"]["content_type"] == "video"){
              $video = $Y_NOW["media_content"]['video'];
              if (strpos($video,'.mp4') !== false) { ?>
    <video autoplay loop poster="<?php echo hc_get_img($Y_NOW["media_content"]['image']); ?>">
        <source src="<?php echo esc_url($video); ?>" type="video/mp4">
    </video>
    <?php } else echo '<iframe src="' . esc_url('https://www.youtube.com/embed/' . hc_get_youtube_id($video) . '?showinfo=0&controls=0') . '"></iframe>';
          } ?>
    <div class="advs-box-content">
        <h2>
            <a <?php hc_set_link_settings($Y_NOW, ""); ?>>
                <?php echo esc_attr($Y_NOW["title"]); ?>
            </a>
        </h2>
        <div class="tag-row icon-row">
            <span>
                <?php echo esc_attr($Y_NOW["subtitle"]) ?>
            </span>
        </div>
        <p>
            <?php echo $Y_NOW["text"] ?>
        </p>
        <?php if ($Y_NOW["button_text"] != "") { ?>
        <a <?php hc_set_link_settings($Y_NOW, "anima-button circle-button btn btn-sm"); ?>>
            <i class="fa fa-long-arrow-right"></i><?php echo esc_attr($Y_NOW["button_text"]); ?>
        </a>
        <?php } ?>
    </div>
    <?php hc_set_content_lightbox($Y_NOW); ?>
</div>
<?php }
    if ($Y_NOW["box_style"] == "full_width_2") { ?>
<div class="advs-box niche-box-blog blog-manual <?php if ($Y_NOW["extra_content"] == "") echo "no-block-infos "; echo hc_get_component_classes($Y_NOW,$EXTRA) . ' ' . esc_attr($boxed); ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div class="block-top">
        <?php hc_echo($Y_NOW["extra_content"],'<div class="block-infos"><div class="block-data">','</div><a class="block-comment"></a></div>'); ?>
        <div class="block-title">
            <h2>
                <a <?php hc_set_link_settings($Y_NOW, ""); ?>>
                    <?php echo esc_attr($Y_NOW["title"]); ?>
                </a>
            </h2>
            <div class="tag-row icon-row" style="overflow: hidden;">
                <span>
                    <?php echo esc_attr($Y_NOW["subtitle"]) ?>
                </span>
            </div>
        </div>
    </div>
    <?php if ($Y_NOW["media_content"]["content_type"] == "image"){ ?>
    <a <?php hc_set_link_settings($Y_NOW, "img-box"); ?>>
        <img alt="" src="<?php echo hc_get_img($Y_NOW["media_content"]["image"],"ultra-large") ?>" />
    </a>
    <?php }
          if ($Y_NOW["media_content"]["content_type"] == "slider"){ ?>
    <div class="flexslider slider nav-inner">
        <ul class="slides">
            <?php
              $arr = $Y_NOW["media_content"]["slides"];
              for ($i = 0; $i < count($arr); $i++) echo '<li><img alt="" src="' . hc_get_img($arr[$i]["link"],"ultra-large") .'" /></li>';
            ?>
        </ul>
    </div>
    <?php }
          if ($Y_NOW["media_content"]["content_type"] == "video"){
              $video = $Y_NOW["media_content"]['video'];
              if (strpos($video,'.mp4') !== false) { ?>
    <video autoplay loop poster="<?php echo hc_get_img($Y_NOW["media_content"]['image']); ?>">
        <source src="<?php echo esc_url($video); ?>" type="video/mp4">
    </video>
    <?php } else echo '<iframe src="' . esc_url('https://www.youtube.com/embed/' . hc_get_youtube_id(esc_url($video)) . '?showinfo=0&controls=0') . '"></iframe>';
          } ?>
    <p class="excerpt">
        <?php echo $Y_NOW["text"] ?>
    </p>
    <a <?php hc_set_link_settings($Y_NOW, "anima-button circle-button btn btn-sm"); ?>>
        <i class="fa fa-long-arrow-right"></i><?php echo esc_attr($Y_NOW["button_text"]); ?>
    </a>
    <?php hc_set_content_lightbox($Y_NOW); ?>
</div>
<?php }
}
function hc_include_hc_niche_content_box_testimonials(&$Y_NOW,$EXTRA) {
    if ($Y_NOW["box_style"] == "style_1") { ?>
<div class="advs-box advs-box-top-icon niche-box-testimonails <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php hc_echo(hc_get_img($Y_NOW["image"],"thumbnail"),'<i class="fa text-xl circle onlycover" style="background-image: url(',')"></i>'); ?>
    <p>
        <?php echo nl2br($Y_NOW["text"]) ?>
    </p>
    <?php hc_echo(esc_attr($Y_NOW["title"]),"<h5>", hc_get(esc_attr($Y_NOW["subtitle"]) ,' <span class="subtxt">','</span>') . "</h5>"); ?>
</div>
<?php }
    if ($Y_NOW["box_style"] == "style_2") { ?>
<div class="advs-box niche-box-testimonails-cloud <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <p>
        <?php echo nl2br($Y_NOW["text"]); ?>
    </p>
    <div class="name-box vertical-row">
        <?php hc_echo(hc_get_img($Y_NOW["image"],"thumbnail"),'<i class="fa text-l circle onlycover" style="background-image: url(',')"></i>'); ?>
        <h5 class="vertical-col subtitle">
            <?php echo esc_attr($Y_NOW["title"]) . hc_get(esc_attr($Y_NOW["subtitle"]) ,'<span class="subtxt">','</span>') ?>
        </h5>
    </div>
</div>
<?php }
}
function hc_include_hc_niche_content_box_team(&$Y_NOW,$EXTRA) { ?>
<div class="advs-box niche-box-team <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" data-anima="scale-up" data-trigger="hover">
    <a <?php hc_set_link_settings($Y_NOW, "img-box"); ?>>
        <img alt="" class="anima" src="<?php echo hc_get_img($Y_NOW["image"],"ultra-large") ?>" />
    </a>
    <div class="content-box">
        <h2>
            <?php echo esc_attr($Y_NOW["title"]) ?>
        </h2>
        <h4>
            <?php echo esc_attr($Y_NOW["subtitle"]) ?>
        </h4>
        <hr class="e" />
        <?php if (strlen($Y_NOW["social_fb"].$Y_NOW["social_tw"].$Y_NOW["social_g+"].$Y_NOW["social_in"].$Y_NOW["social_yt"].$Y_NOW["social_ig"]) > 0) { ?>
        <div class="btn-group social-group">
            <?php hc_echo(esc_url($Y_NOW["social_fb"]),' <a target="_blank" href="','"><i class="fa fa-facebook"></i></a>') ?>
            <?php hc_echo(esc_url($Y_NOW["social_tw"]),' <a target="_blank" href="','"><i class="fa fa-twitter"></i></a>') ?>
            <?php hc_echo(esc_url($Y_NOW["social_g+"]),' <a target="_blank" href="','"><i class="fa fa-google-plus"></i></a>') ?>
            <?php hc_echo(esc_url($Y_NOW["social_in"]),' <a target="_blank" href="','"><i class="fa fa-linkedin"></i></a>') ?>
            <?php hc_echo(esc_url($Y_NOW["social_yt"]),' <a target="_blank" href="','"><i class="fa fa-youtube"></i></a>') ?>
            <?php hc_echo(esc_url($Y_NOW["social_ig"]),' <a target="_blank" href="','"><i class="fa fa-instagram"></i></a>') ?>
        </div>
        <?php } ?>
        <p>
            <?php echo $Y_NOW["text"] ?>
        </p>
    </div>
    <?php hc_set_content_lightbox($Y_NOW);  ?>
</div>
<?php }
function hc_include_hc_niche_content_box_pricing_table(&$Y_NOW,$EXTRA) { ?>
<div class="list-group pricing-table <?php echo hc_get_component_classes($Y_NOW,$EXTRA); if ($Y_NOW["featured"] == "true") echo " pricing-table-big"; ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
    $extra = hc_get(hc_get_now($Y_NOW,"extra_text",""),"<span>","</span>");
    hc_echo($Y_NOW["title"],'<div class="list-group-item pricing-price">', $extra . '</div>');
    hc_echo(esc_attr($Y_NOW["subtitle"]),'<div class="list-group-item pricing-name"><h3>','</h3></div>');
    $arr = $Y_NOW["rows"];
    for ($i = 0; $i < count($arr); $i++) {
        echo ' <div class="list-group-item">'. $arr[$i]["text"] .'</div>';
    }
    $link = hc_get_now($Y_NOW,"button_link");
    if ($link != "") echo '<div class="list-group-item"><a class="btn btn-sm" href="' . esc_url($link) . '">' . hc_get_now($Y_NOW,"button_text","Details") .'</a></div>';
    ?>
</div>
<?php }
function hc_include_hc_niche_content_box_call(&$Y_NOW,$EXTRA) { ?>
<div class="call-action-box vertical-row <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div class="row">
        <?php hc_echo($Y_NOW["icon"],'<div class="col-md-1 vertical-col"><i class="',' action-icon"></i></div>'); ?>
        <div class="col-md-9 vertical-col">
            <p>
                <?php echo $Y_NOW["content"] ?>
            </p>
            <div class="clear"></div>
        </div>
        <?php if (strlen($Y_NOW["button_text"]) > 0) { ?>
        <div class="<?php if ($Y_NOW["icon"] != "") echo 'col-md-2'; else echo 'col-md-3'; ?>  vertical-col">
            <a <?php hc_set_link_settings($Y_NOW, " circle-button btn btn-sm"); ?>>
                <?php echo esc_attr($Y_NOW["button_text"]); ?>
            </a>
            <div class="clear"></div>
        </div>
        <?php } ?>
    </div>
    <?php hc_set_content_lightbox($Y_NOW);  ?>
</div>
<?php } ?>

