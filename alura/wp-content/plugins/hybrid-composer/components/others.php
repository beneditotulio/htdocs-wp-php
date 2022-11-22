<?php
// =============================================================================
// OTHERS.PHP
// -----------------------------------------------------------------------------
// Hybric Composer various front-end components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. TITLE TAG - H1 to H6 title tags
//   02. IMAGE - Image
//   03. VIDEO - Video
//   04. BUTTON -  Documentation and demo: framework-y.com/components/components-bootstrap.html
//   05. TITLE TAG - H1 to H6 title tags
//   06. SUBTITLE - Documentation and demo: framework-y.com/components/typography.html
//   07. TEXT BLOCK -  Basic row text and html block
//   08. WYSIWYG EDITOR - Documentation and demo: wysiwygjs.github.io
//   09. ICON LIST - Documentation and demo: framework-y.com/components/components.html
//   10. ICON BOX - Documentation and demo: framework-y.com/components/components.html
//   11. TEXT LIST - Documentation and demo: framework-y.com/components/components.html#lists
//   12. COUNTER - Documentation and demo: framework-y.com/components/components.html#counter
//   13. COUNTDOWN - Documentation and demo: framework-y.com/components/components.html#countdown
//   14. PROGRESS BAR - Documentation and demo: framework-y.com/components/components.html#progress-bar
//   15. CIRCLE PROGRESS BAR - Documentation and demo: framework-y.com/components/components.html#circle-progress-bar
//   16. TIMELINE - Documentation and demo: framework-y.com/components/components.html#timeline
//   17. GOOGLE MAP - Documentation and demo: framework-y.com/components/components.html#google-maps
//   18. SOCIAL FEEDS - Documentation and demo: framework-y.com/components/social.html
//   19. SOCIAL SHARE BUTTONS - Documentation and demo: framework-y.com/components/social.html#social
//   20. QUOTE - Documentation and demo: framework-y.com/components/typography.html#block-quotes
//   21. SEPARATORS - Documentation and demo: framework-y.com/components/typography.html#separators
//   22. SPACE - Documentation and demo: framework-y.com/components/components-base.html
//   23. TABLE - Documentation and demo: framework-y.com/components/components.html#table-bootgrid
//   24. FULL-PAGE MENU - Part of composer-side.php, this component is outside the main container. Documentation and demo:  framework-y.com/templates/fullpage/template-fullpage-documentation.html
//   25. INNER MENU - Documentation and demo: framework-y.com/components/menu/menu-inner-horizontal.html
//   26. CONTACT FORM - Documentation and demo: framework-y.com/components/php-contact-form.html
//   27. WORDPRESS EDITOR - Wordpress WYSIWYG editor
//   28. CODE BLOCK - Raw code string
//   29. FULLPAGE COMPONENTS - Exclusive fullpage template components
// =============================================================================

function hc_include_hc_title_tag(&$Y_NOW,$EXTRA) {
    echo "<" . esc_attr($Y_NOW["tag"]) . " " . hc_get(esc_attr($Y_NOW["id"]),'id="','"') . " class='". hc_get_component_classes($Y_NOW,$EXTRA) . "' style='" .  esc_attr($Y_NOW["custom_css_styles"]) . "'>" . wp_kses_post($Y_NOW["text"]) . "</" . esc_attr($Y_NOW["tag"]) . ">";
}
function hc_include_hc_video(&$Y_NOW,$EXTRA) {
    $width = "100%";
    if ($Y_NOW['width'] != "") $width = esc_attr($Y_NOW['width']) . "px";
    if (strpos($Y_NOW['link'],'.mp4') !== false) { ?>
<video <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','" '); ?>
    <?php if ($Y_NOW['autoplay'] == "true") echo "autoplay ";
          if ($Y_NOW['loop'] == "true") echo "loop ";
          if ($Y_NOW['muted'] == "true") echo "muted "; 
          if ($Y_NOW['controls'] == "true") echo "controls "; 
          hc_echo(esc_attr($Y_NOW['height']),'height="','"')?> class="video-box <?php echo hc_get_component_classes($Y_NOW,$EXTRA) ?>" style="<?php echo 'width: ' . esc_attr($width) . '; ' .  esc_attr($Y_NOW["custom_css_styles"]) ?>">
    <source src="<?php echo esc_url($Y_NOW['link']); ?>" type="video/mp4">
</video>
<?php } else {
        $att = "?modestbranding=1&rel=0&showinfo=0";
        if ($Y_NOW['autoplay'] == "true") $att .= "&autoplay=1";
        if ($Y_NOW['loop'] == "true") $att .= "&loop=1&playlist=" . hc_get_youtube_id($Y_NOW['link']);
        if ($Y_NOW['controls'] != "true") $att .= "&controls=0";
?>

<iframe <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> <?php hc_echo(esc_attr($Y_NOW['height']),' height="','"') ?>
    src="<?php echo esc_url('//www.youtube.com/embed/' . hc_get_youtube_id($Y_NOW['link']) . $att); ?>" allowfullscreen class="video-box <?php echo hc_get_component_classes($Y_NOW,$EXTRA) ?>" style="border:none; <?php echo 'width: ' . esc_attr($width) . '; ' . esc_attr($Y_NOW["custom_css_styles"]) ?>"></iframe>
<?php }
}
function hc_include_hc_text_block(&$Y_NOW,$EXTRA) {
    echo "<div " . hc_get(esc_attr($Y_NOW["id"]),'id="','"') . " class='". hc_get_component_classes($Y_NOW,$EXTRA) . "' style='" . esc_attr($Y_NOW["custom_css_styles"]) . "'>" . do_shortcode(str_replace("\n","<br />",$Y_NOW["content"])) . "</div>";
}
function hc_include_hc_wp_editor(&$Y_NOW,$EXTRA) {  ?>
<div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="main-text wysiwyg-editor <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
    $tmp = wpautop($Y_NOW["editor_content"]);
    $tmp = str_replace("\n&nbsp;\n","<br /><br />",$tmp);
    echo do_shortcode($tmp);
    ?>
</div>
<?php } ?>
<?php
function hc_include_hc_button(&$Y_NOW,$EXTRA) {
    $css_classes = "btn ";
    $tmp = $Y_NOW["style"];
    if ($tmp == "square") $css_classes .= "btn-default ";
    if ($tmp == "circle")  $css_classes .=  "circle-button ";
    if ($tmp == "square-border") $css_classes .= "btn-border ";
    if ($tmp == "circle-border")  $css_classes .=  "circle-button btn-border ";
    if ($tmp == "link")  $css_classes =  "btn-text ";
    $css_classes .=  $Y_NOW["size"];
    if ($Y_NOW["animation"] == "true")  $css_classes .=  " anima-button ";
?>
<div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="button-cnt <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>"
    style="display: block; <?php echo esc_attr($Y_NOW["custom_css_styles"]) . (($Y_NOW["position"] != "full") ? "text-align:" . $Y_NOW["position"]:""); ?>">
    <a
        <?php hc_set_link_settings($Y_NOW,$css_classes);
              if ($Y_NOW["position"] == "full") echo " style='display:block'"?>>
        <?php if (strlen($Y_NOW["icon"]) > 0) echo "<i class='fa " . esc_attr($Y_NOW["icon"]) . "'></i>"; echo esc_attr($Y_NOW["text"]); ?>
    </a>
    <?php hc_set_content_lightbox($Y_NOW); ?>
</div>
<?php }
function hc_include_hc_icon_list(&$Y_NOW,$EXTRA) {
    $icon_size = $Y_NOW["icon_size"];
    $text_size = $icon_size;
    $icon_position = $Y_NOW["icon_position"];
    if(isset($Y_NOW["text_size"])) $text_size = hc_get_now($Y_NOW,"text_size");
    else {
        $icon_size = $text_size;
        if ($text_size == "text-l") $icon_size = "text-xl";
        if ($text_size == "text-m") $icon_size = "text-l";
        if ($text_size == "text-s") $icon_size = "text-l";
        if ($text_size == "text-xs") $icon_size = "text-s";
    }
?>
<div <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="icon-list <?php echo esc_attr($Y_NOW["alignment"] . ' ' .$Y_NOW["direction"]) . ' ' . hc_get_component_classes($Y_NOW,$EXTRA); if ($icon_position == "top" || $icon_position == "bottom") echo " icon-list-top-bottom"; ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
    $arr = $Y_NOW["rows"];
    for ($i = 0; $i < count($arr); $i++) {
        if ($icon_position == "right" || $icon_position == "bottom") echo '<div class="list-item"><label class="' . esc_attr($text_size) . '">'. esc_attr($arr[$i]["text"]) .'</label>'. hc_get_icon($arr[$i]["icon"], $arr[$i]["icon_style"], $arr[$i]["icon_image"], $icon_size) .'</div>';
        else echo '<div class="list-item">'. hc_get_icon($arr[$i]["icon"], $arr[$i]["icon_style"], $arr[$i]["icon_image"], $icon_size) . '<label class="' . esc_attr($text_size) . '">'. $arr[$i]["text"] .'</label></div>';
    }
    ?>
</div>
<?php }
function hc_include_hc_icon_list_simple(&$Y_NOW,$EXTRA) {
    $style = esc_attr(hc_get_now($Y_NOW,"list_style"));
    $list_class = "fa-ul";
    if ($style == "initial") $list_class = "ul-dots";
    if ($style == "square") $list_class = "ul-squares";
    if ($style == "decimal") $list_class = "ul-decimal";
?>
<ul <?php hc_echo(esc_attr($Y_NOW["id"]),'id="','"'); ?> class="<?php echo $list_class . ' ' . (($style != "") ? 'no-icons':'') . ' ' . esc_attr($Y_NOW["icon_size"] . ' ' . $Y_NOW["alignment"]) . ' ' . hc_get_component_classes($Y_NOW,$EXTRA); ?>"
    style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); if ($style != "") echo " list-style: " . esc_attr($style); ?>">
    <?php
    $arr = $Y_NOW["rows"];
    for ($i = 0; $i < count($arr); $i++) {
        if ($Y_NOW["alignment"] == "text-right") echo '<li>' . wp_kses($arr[$i]["text"],array('b' => array())) . ' <i class="fa-li ' . esc_attr($arr[$i]["icon"]) . '"></i></li>';
        else echo '<li><i class="fa-li ' . esc_attr($arr[$i]["icon"]) . '"></i> ' . $arr[$i]["text"] . '</li>';
    }
    ?>
</ul>
<?php }
function hc_include_hc_icon_box(&$Y_NOW,$EXTRA) {
    $default_size = esc_attr($Y_NOW["icon_size"]);
    $icon_size = esc_attr(hc_get_now($Y_NOW,"icon_size"));
    $title_size = esc_attr(hc_get_now($Y_NOW,"title_size",""));
    $text_size = esc_attr(hc_get_now($Y_NOW,"text_size",""));
    $icon_position = esc_attr($Y_NOW["icon_position"]);

    if ($title_size == "" && $text_size == "") {
        if ($default_size == "text-l") {
            $title_size = "text-xl";
            $icon_size = "text-xl";
        }
        if ($default_size == "text-s") {
            $title_size = "text-s";
            $icon_size = "text-l";
        }
        if ($default_size == "text-xs") {
            $title_size = "text-xs";
            $icon_size = "text-xs";
        }
        if ($default_size == "text-m") {
            $title_size = "text-m";
            $text_size = "text-s";
            $icon_size = "text-xl";
        }
    }
?>
<div class="icon-box text-<?php echo esc_attr($icon_position) . " " . hc_get_component_classes($Y_NOW,$EXTRA); if ($icon_position == "top" || $icon_position == "bottom") echo " icon-box-top-bottom"; if ($icon_position == "right") echo " icon-box-right"; ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
    $icon_block = '<div class="icon-box-cell">' . hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], $icon_size) . '</div>';
    $text_block = '<div class="icon-box-cell"><label class="' . $title_size . '">' .  esc_attr($Y_NOW["title"]) . '</label>' . ((strlen($Y_NOW["title"])> 0)?'<p class="' . $text_size . '">' . esc_attr($Y_NOW["subtitle"]) . '</p></div>':'');

    if ($icon_position == "right" || $icon_position == "bottom") echo $text_block . $icon_block; else echo $icon_block . $text_block;
    ?>
</div>
<?php }
function hc_include_hc_text_list(&$Y_NOW,$EXTRA) {
    $arr = $Y_NOW["rows"];
    $css = "";
    $anima_1 = "";
    $anima_2 = "";
    if ($Y_NOW["animation"] != "") {
        $anima_1 = ' data-anima="' . $Y_NOW["animation"] . '" data-timeline="asc"';
        $anima_2 = 'anima';
    }
    if ($Y_NOW["style"] == "" || $Y_NOW["style"] == "style_4") {
        if ($Y_NOW["style"] == "style_4") {
            $css = "list-items-justified";
        } ?>
<div class="list-items <?php echo hc_get_component_classes($Y_NOW,$EXTRA) . " " . $css; ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>"<?php echo $anima_1 ?>>
    <?php
        $isImage = hc_get_now($Y_NOW,"show_images");
        $img_html = "";
        $html = "";
        for ($i = 0; $i < count($arr); $i++) {
            if ($isImage) $img_html = '<i class="onlycover circle icon" style="background-image:url(' . hc_get_img($arr[$i]["image_link"],"medium") . ')"></i>';
            $html .= '<div class="list-item' . (($isImage) ? " list-item-img":"" ) . $anima_2 . '"><div class="row"><div class="col-md-9">' . $img_html . '<h3>' . esc_attr($arr[$i]["title"]) . '</h3><p>' . $arr[$i]["subtitle"] . '</p></div><div class="col-md-3"><span>' . $arr[$i]["extra"] . '</span></div></div></div>';
        }
        echo $html;
    ?>
</div>
<?php }
    if ($Y_NOW["style"] == "style_2" || $Y_NOW["style"] == "style_3") {
        if ($Y_NOW["style"] == "style_3") {
            $css = "list-texts-justified";
        }
?>
<ul class="list-texts <?php echo hc_get_component_classes($Y_NOW,$EXTRA) . " " . $css ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]) ?>"<?php echo $anima_1 ?>>
    <?php
        $arr = $Y_NOW["rows"];
        $html = "";
        for ($i = 0; $i < count($arr); $i++) {
            $html .= ' <li' . hc_get($anima_2,' class="','"') . '><b>' . esc_attr($arr[$i]["title"]) . '</b> <span>' . $arr[$i]["subtitle"] . '</span>' . hc_get($arr[$i]["extra"],' <b>','</b>') . '</li>';
        }
        echo $html;
    ?>
</ul>
<?php
    }
}
function hc_include_hc_counter(&$Y_NOW,$EXTRA) {
    if ($Y_NOW["style"] == "") { ?>
<span class="counter-box-simple <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
        $before = hc_get_now($Y_NOW,"before_text");
        if ($before != "") { ?>
    <span class="<?php echo hc_get_now($Y_NOW,"text_size_2","text-s") ?>">
        <?php echo $before ?>
    </span>
    <?php } ?>
    <span class="counter <?php echo esc_attr(hc_get_now($Y_NOW,"text_size","text-l")); ?>" data-to="<?php echo esc_attr($Y_NOW["count_to"]); ?>" <?php hc_echo(esc_attr($Y_NOW["from"]),' data-from="','"'); hc_echo(esc_attr($Y_NOW["speed"]),' data-speed="','"'); hc_echo(esc_attr($Y_NOW["interval"]),' data-refresh-interval="','"'); ?>>0</span>
    <span class="<?php echo hc_get_now($Y_NOW,"text_size_2","text-s") ?>">
        <?php echo esc_attr($Y_NOW["title"]); ?>
    </span>
</span>
<?php }
    if ($Y_NOW["style"] == "icon" || $Y_NOW["style"] == "icon-horizontal") { ?>
<div class="counter-box-icon icon-box <?php if ($Y_NOW["style"] == "icon") echo "icon-box-top-bottom "; echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div class="icon-box-cell">
        <?php echo hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], "icon " . hc_get_now($Y_NOW,"icon_size","text-xl")); ?>
    </div>
    <div class="icon-box-cell">
        <?php
        $before = hc_get_now($Y_NOW,"before_text");
        if ($before != "") { ?>
        <span class="<?php echo hc_get_now($Y_NOW,"text_size_2","text-s") ?>">
            <?php echo $before ?>
        </span>
        <?php } ?>
        <b>
            <label class="counter <?php echo esc_attr(hc_get_now($Y_NOW,"text_size","text-l")); ?>" data-to="<?php echo esc_attr($Y_NOW["count_to"]); ?>" <?php hc_echo(esc_attr($Y_NOW["from"]),' data-from="','"'); hc_echo(esc_attr($Y_NOW["speed"]),' data-speed="','"'); hc_echo(esc_attr($Y_NOW["interval"]),' data-refresh-interval="','"'); ?>>0</label>
        </b>
        <p class="<?php echo esc_attr(hc_get_now($Y_NOW,"text_size_2","text-s")) ?>">
            <?php echo esc_attr($Y_NOW["title"]); ?>
        </p>
    </div>
</div>
<?php }
}
function hc_include_hc_countdown(&$Y_NOW,$EXTRA) {
    $html = "";
    $html_1 = "";
    $html_2 = "";
    $html_3 = "";
    $number_size = esc_attr(hc_get_now($Y_NOW,"number_size","text-l"));
    $text_size = esc_attr(hc_get_now($Y_NOW,"text_size",""));
    if ($Y_NOW["style"] == "column") {
        $html_1 = "<div>";
        $html_2 = "<br>";
        $html_3 = "</div>";
    }
    if ($Y_NOW["days"] == "true") $html .= $html_1 . '<span class="days countdown-values ' . $number_size . '">00</span>' . $html_2 . '<span class="countdown-label ' . $text_size . '"> '. esc_attr($Y_NOW["days_text"]) .'</span>' . $html_3;
    if ($Y_NOW["hours"] == "true") $html .=  $html_1 . '<span class="hours countdown-values ' . $number_size . '">00</span>' . $html_2 . '<span class="countdown-label ' . $text_size . '"> '. esc_attr($Y_NOW["hours_text"]) .'</span>' . $html_3;
    if ($Y_NOW["minutes"] == "true") $html .=  $html_1 . '<span class="minutes countdown-values ' . $number_size . '">00</span>' . $html_2 . '<span class="countdown-label ' . $text_size . '"> '. esc_attr($Y_NOW["minutes_text"]) .'</span>' . $html_3;
    if ($Y_NOW["seconds"] == "true") $html .=  $html_1 . '<span class="seconds countdown-values ' . $number_size . '">00</span>' . $html_2 . '<span class="countdown-label ' . $text_size . '"> '. esc_attr($Y_NOW["seconds_text"]) .'</span>' . $html_3;
    if ($Y_NOW["style"] == "" || $Y_NOW["style"] == "column") { ?>
<div class="countdown <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" data-time="<?php echo esc_attr($Y_NOW["date"]); ?>" data-utc-offset="<?php echo esc_attr($Y_NOW["offset"]); ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <span class="countdown-text">
        <?php echo $Y_NOW["text"]; echo hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], "text-xl"); ?>
    </span>
    <?php echo $html; ?>
    <?php hc_echo($Y_NOW["after_text"],"<span>","</span>"); ?>
</div>
<?php }
    if ($Y_NOW["style"] == "icon") { ?>
<div class="icon-box icon-box-top-bottom col-center <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>">
    <div class="icon-box-cell">
        <?php hc_echo(esc_attr($Y_NOW["text"]),'<label class="text-m">','</label>'); ?>
        <?php echo hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], "text-xl"); ?>
    </div>
    <div class="icon-box-cell">
        <p class="countdown" data-time="<?php echo esc_attr($Y_NOW["date"]); ?>" data-utc-offset="<?php echo esc_attr($Y_NOW["offset"]); ?>">
            <?php echo $html; ?>
    </div>
</div>
<?php }
}
function hc_include_hc_progress_bar(&$Y_NOW,$EXTRA) {
    $title_pos = $Y_NOW["title_position"];
    echo '<div class="' . hc_get_component_classes($Y_NOW,$EXTRA) . '" style="'. esc_attr($Y_NOW["custom_css_styles"]) . '">';
    $counter = '<span><span class="counter" data-to="'. esc_attr($Y_NOW["progress"]) .'">'. esc_attr($Y_NOW["progress"]) .'</span> ' . esc_attr($Y_NOW["progress_text"]) . '</span>';
    if ($title_pos == "top") echo '<p class="progress-label">' . esc_attr($Y_NOW["title"]) . (($Y_NOW["progress_position"] == "outer") ? $counter : '') .'</p>';
    if ($title_pos == "left") echo '<div class="row vertical-row"><div class="col-md-3"><p class="progress-label">' . esc_attr($Y_NOW["title"]) .
        (($Y_NOW["progress_position"] == "outer") ? $counter : '') . '</p></div><div class="col-md-9">';
    if ($title_pos == "right") echo '<div class="row vertical-row"><div class="col-md-9">';
?>
<div class="progress">
    <div class="progress-bar <?php if ($Y_NOW["style"] == "striped") echo 'progress-bar-striped active'; ?>" data-progress="<?php echo esc_attr($Y_NOW["progress"]); ?>">
        <?php if ($Y_NOW["progress_position"] == "inner") echo $counter; ?>
    </div>
</div>
<?php
    if ($title_pos == "bottom") echo '<p class="progress-label">' . esc_attr($Y_NOW["title"]) . (($Y_NOW["progress_position"] == "outer") ? $counter : '') .'</p>';
    if ($title_pos == "left") echo '</div></div>';
    if ($title_pos == "right") echo '</div><div class="col-md-3" style="text-align: right;"><p class="progress-label">' . esc_attr($Y_NOW["title"]) .
        (($Y_NOW["progress_position"] == "outer") ? ' <span><span class="counter" data-to="'. $Y_NOW["progress"] .'">'. esc_attr($Y_NOW["progress"]) .'</span> ' . esc_attr($Y_NOW["progress_text"]):'') . '</span></p></div></div>';
    echo "</div>";
}
function hc_include_hc_circle_progress_bar(&$Y_NOW,$EXTRA) {
    $title = esc_attr($Y_NOW["title"]);
    $icon = hc_get_icon($Y_NOW["icon"], $Y_NOW["icon_style"], $Y_NOW["icon_image"], (strlen($title) == 0) ? "text-xl":"text-m");
    $hide = $Y_NOW["hide_percentage"];

?>
<div class="progress-circle <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>"
    data-progress="<?php echo esc_attr($Y_NOW["progress"]); ?>"
    data-thickness="<?php echo esc_attr($Y_NOW["thickness"]); ?>"
    data-options="<?php echo esc_attr($Y_NOW["data_options"]); ?>"
    data-size="<?php echo esc_attr($Y_NOW["size"]); ?>"
    data-color="<?php echo hc_get_now($Y_NOW,"color",hc_get_setting('main-color')); ?>"
    data-unit="<?php echo esc_attr(hc_get_now($Y_NOW,"unit","%")); ?>"
    style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div class="inner-circle">
        <div class="inner-center">
            <?php
    if (strlen($title) == 0 && strlen($Y_NOW["subtitle"]) == 0) {
        if ($hide == "true") echo $icon;
        else echo '<span class="counter-circle"></span>';
    } else {
        if ($hide == "true" && strlen($icon) == 0 && strlen($Y_NOW["subtitle"]) == 0) echo '<h2 class="main">' . $title . '</h2>';
        else { ?>
            <div class="subtitle c">
                <?php hc_echo($title,'<h2 class="main">','</h2>'); ?>
                <?php hc_echo(esc_attr($Y_NOW["subtitle"]),'<p class="sub">','</p>'); ?>
                <hr class="d" />
                <?php echo $icon; if ($hide != "true") echo ' <span class="counter-circle"></span>'; ?>
            </div>
            <?php }
    }
            ?>
        </div>
    </div>
</div>
<?php }
function hc_include_hc_timeline(&$Y_NOW,$EXTRA) {   ?>
<ul class="timeline <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
    $arr = $Y_NOW["rows"];
    for ($i = 0; $i < count($arr); $i++) {  ?>
    <li class="<?php if ($arr[$i]["position"] == "right") echo "timeline-inverted"; ?>">
        <div class="timeline-badge"></div>
        <div class="timeline-label">
            <h4>
                <?php echo esc_attr($arr[$i]["date"]); ?>
            </h4>
            <p>
                <?php echo esc_attr($arr[$i]["date_subtitle"]); ?>
            </p>
        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title">
                    <?php echo esc_attr($arr[$i]["title"]); ?>
                </h4>
                <p>
                    <small class="text-muted">
                        <?php echo esc_attr($arr[$i]["subtitle"]); ?>
                    </small>
                </p>
            </div>
            <div class="timeline-body">
                <p>
                    <?php echo $arr[$i]["content"]; ?>
                </p>
            </div>
        </div>
    </li>
    <?php }  ?>
</ul>
<?php }
function hc_include_hc_google_map(&$Y_NOW,$EXTRA) {   ?>
<div class="google-map <?php echo hc_get_component_classes($Y_NOW,$EXTRA); echo " " . $Y_NOW["map_skin"] . "-map"; ?>" data-address="<?php echo esc_attr($Y_NOW["map_address"]); ?>"
    data-zoom="<?php if (strlen($Y_NOW["map_zoom"]) > 0) echo esc_attr($Y_NOW["map_zoom"]); else echo "12"; ?>"
    data-coords="<?php echo esc_attr($Y_NOW["map_coordinates"]); ?>"
    data-marker-pos="<?php echo esc_attr($Y_NOW["marker_position"]); ?>"
    data-skin="<?php echo esc_attr($Y_NOW["map_skin"]); ?>"
    data-marker-pos-top="<?php echo esc_attr($Y_NOW["marker_position_top"]); ?>"
    data-marker-pos-left="<?php echo esc_attr($Y_NOW["marker_position_left"]); ?>"
    <?php hc_echo(hc_get_now($Y_NOW,"trigger"),'data-trigger="','"') ?>
    <?php if (strlen($Y_NOW["marker_image"]) > 0) echo ' data-marker="' . hc_get_img($Y_NOW["marker_image"]) . '"'; ?> style="<?php echo esc_attr($Y_NOW["custom_css_styles"]) . hc_get(esc_attr($Y_NOW["map_height"]),"height: ","px;"); ?>"></div>
<?php }
function hc_include_hc_social_feeds(&$Y_NOW,$EXTRA) {
    $type = esc_attr($Y_NOW["container_type"]);
    $source_type = esc_attr($Y_NOW["type"]);
    $css = hc_get_component_classes($Y_NOW,$EXTRA);
    if ($type == "") {
?>
<div class="<?php echo 'social-feed-' . $source_type . ' ' . $css; if ($Y_NOW["hide_comments"] == "true") echo " no-comments"; ?>" data-social-id="<?php echo esc_attr($Y_NOW["page_id"]); ?>" data-token="<?php echo esc_attr($Y_NOW["access_token"]); ?>" data-options="<?php echo $Y_NOW["data_options_".$source_type]; ?>"></div>
<?php }
    if ($type == "scroll_box") {
        $arr_opt = hc_get_arr_options($Y_NOW["data_sub_options_scroll_box"]);
?>
<div class="scroll-content <?php echo $css . ' '; if (hc_get_now($arr_opt, "mobile_disabled") == "true") echo "scroll-mobile-disabled"; ?>" data-height="<?php echo esc_attr(hc_get_now($arr_opt,"height")); ?>" <?php hc_echo(esc_attr(hc_get_now($arr_opt, "height_remove")), 'data-height-remove="','"') ?> data-options="<?php echo $Y_NOW["data_options_scroll_box"]; ?>">
    <div class="<?php echo 'social-feed-' . $source_type; if ($Y_NOW["hide_comments"] == "true") echo " no-comments"; ?>" data-social-id="<?php echo esc_attr($Y_NOW["page_id"]); ?>" data-token="<?php echo esc_attr($Y_NOW["access_token"]); ?>" data-options="<?php echo $Y_NOW["data_options_".$source_type]; ?>"></div>
</div>
<?php }
    if ($type == "slider" || $type == "carousel") {
?>
<div class="<?php echo 'social-feed-' . $source_type . ' ' . $css; if ($Y_NOW["hide_comments"] == "true") echo " no-comments"; if ($type == "carousel") echo " carousel"; ?> flexslider outer-navs"
    data-social-id="<?php echo esc_attr($Y_NOW["page_id"]); ?>"
    data-token="<?php echo esc_attr($Y_NOW["access_token"]); ?>"
    data-options="<?php echo $Y_NOW["data_options_".$source_type]; hc_echo($Y_NOW["data_options_slider"],","); ?>"
    <?php if (hc_get_now($Y_NOW,"trigger")) echo ' data-trigger="manual"'; ?>></div>
<?php }
}
function get_social_link($link,$type,$network) {
    if ($type == "link") return 'href="' . esc_url($link) . '" target="_blank"';
    else return hc_get(esc_url($link),'data-social-url="','"') . ' data-social="share-' . $network . '" target="_blank" href="#"';
}
function hc_include_hc_social_share_buttons(&$Y_NOW,$EXTRA) {
    echo '<div class="text-' . $Y_NOW["position"] . '">';
    if ($Y_NOW["type"] == "classic" || $Y_NOW["type"] == "classic_big") {
        hc_echo(esc_attr($Y_NOW["text"]),'<span>','</span><span class="space"></span>');
?>
<div class="btn-group social-group btn-group-icons <?php if ($Y_NOW["type"] == "classic_big") echo "btn-group-lg"; if (hc_get_now($Y_NOW,"social_colors")) echo " social-colors"; ?>" role="group">
    <?php
        if ($Y_NOW["fb"] == "true") echo '<a '. get_social_link($Y_NOW["fb_link"], hc_get_now($Y_NOW,"link_type"), "facebook") .'><i class="fa fa-facebook"></i></a>';
        if ($Y_NOW["tw"] == "true") echo '<a '. get_social_link($Y_NOW["tw_link"], hc_get_now($Y_NOW,"link_type"), "twitter") .'><i class="fa fa-twitter"></i></a>';
        if ($Y_NOW["g+"] == "true") echo '<a '. get_social_link($Y_NOW["g+_link"], hc_get_now($Y_NOW,"link_type"), "google") .'><i class="fa fa-google-plus"></i></a>';
        if ($Y_NOW["li"] == "true") echo '<a '. get_social_link($Y_NOW["li_link"], hc_get_now($Y_NOW,"link_type"), "linkedin") .'><i class="fa fa-linkedin"></i></a>';
    ?>
</div>
<?php  }
    if ($Y_NOW["type"] == "circle_tt" || $Y_NOW["type"] == "circle_tt_big" || $Y_NOW["type"] == "simple")  {
        $class_global = "circle ";
        if ($Y_NOW["type"] == "simple") $class_global = "";
        if ($Y_NOW["type"] == "circle_tt_big") $class_global .= "text-m"; else $class_global .= "text-s";
?>
<div class="btn-group social-group">
    <?php
        if ($Y_NOW["fb"] == "true") echo '<a ' . get_social_link($Y_NOW["fb_link"], hc_get_now($Y_NOW,"link_type"), "facebook") . ' data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook ' . $class_global . '"></i></a>';
        if ($Y_NOW["tw"] == "true") echo '<a ' . get_social_link($Y_NOW["tw_link"], hc_get_now($Y_NOW,"link_type"), "twitter") . ' data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter ' . $class_global . '"></i></a>';
        if ($Y_NOW["g+"] == "true") echo '<a ' . get_social_link($Y_NOW["g+_link"], hc_get_now($Y_NOW,"link_type"), "google") . ' data-toggle="tooltip" data-placement="top" title="Google +"><i class="fa fa-google-plus ' . $class_global . '"></i></a>';
        if ($Y_NOW["li"] == "true") echo '<a ' . get_social_link($Y_NOW["li_link"], hc_get_now($Y_NOW,"link_type"), "linkedin") . ' data-toggle="tooltip" data-placement="top" title="LinkedIn"><i class="fa fa-linkedin ' . $class_global . '"></i></a>';
    ?>
</div>
<?php  }
    if ($Y_NOW["type"] == "button" || $Y_NOW["type"] == "button_2") { ?>
<div class="social-group-button <?php if ($Y_NOW["type"] == "button_2") echo "bottom-icons"; ?>">
    <div class="social-button" data-anima="pulse-vertical" data-trigger="hover">
        <i class="fa fa-share-alt circle text-s"></i>
    </div>
    <div class="btn-group social-group">
        <?php
        if ($Y_NOW["fb"] == "true") echo '<a ' . get_social_link($Y_NOW["fb_link"], hc_get_now($Y_NOW,"link_type"), "facebook") . ' data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook circle"></i></a>';
        if ($Y_NOW["tw"] == "true") echo '<a ' . get_social_link($Y_NOW["tw_link"], hc_get_now($Y_NOW,"link_type"), "twitter") . ' data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter circle"></i></a>';
        if ($Y_NOW["g+"] == "true") echo '<a ' . get_social_link($Y_NOW["g+_link"], hc_get_now($Y_NOW,"link_type"), "google") . ' data-toggle="tooltip" data-placement="top" title="Google +"><i class="fa fa-google-plus circle"></i></a>';
        if ($Y_NOW["li"] == "true") echo '<a ' . get_social_link($Y_NOW["li_link"], hc_get_now($Y_NOW,"link_type"), "linkedin") . ' data-toggle="tooltip" data-placement="top" title="LinkedIn"><i class="fa fa-linkedin circle"></i></a>';
        ?>
    </div>
</div>
<?php  }
    echo '</div>';
}
function hc_include_hc_icon_links(&$Y_NOW,$EXTRA) {
    $html = "";
    $html_append  = "</div>";
    $link_classes = "";
    $i_classes = (($Y_NOW["type"] == "circle_tt" || $Y_NOW["type"] == "circle_tt_big") ? "circle ":"");
    if ($Y_NOW["type"] == "classic" || $Y_NOW["type"] == "classic_big") {
        $html = '<div class="btn-group btn-group-icons ' . (($Y_NOW["type"] == "classic_big") ? "btn-group-lg":"") . '" role="group">';
        $link_classes = "btn btn-default";
    }
    if ($Y_NOW["type"] == "circle_tt" || $Y_NOW["type"] == "circle_tt_big" || $Y_NOW["type"] == "simple")  {
        $html = '<div class="btn-group social-group">';
        $i_classes .= (($Y_NOW["type"] == "circle_tt_big") ? "text-m":"text-s");
    }
    if ($Y_NOW["type"] == "button" || $Y_NOW["type"] == "button_2") {
        $html = '<div class="social-group-button ' . (($Y_NOW["type"] == "button_2") ? "bottom-icons":"") . '"><div class="social-button" data-anima="pulse-vertical" data-trigger="hover">
                  <i class="fa fa-share-alt circle text-s"></i></div><div class="btn-group social-group">';
        $i_classes .= "circle";
        $html_append =  "</div></div>";
    }
    $arr = $Y_NOW["rows"];
    for ($i = 0; $i < count($arr); $i++) {
        $html .= '<a target="_blank" href="' . esc_url($arr[$i]["text"]) . '" class="' . $link_classes . '"><i class="' . esc_attr($arr[$i]["icon"]) . ' ' . $i_classes . '"></i></a>';
    }
    echo '<div class="' . hc_get_component_classes($Y_NOW,$EXTRA) . ((hc_get_now($Y_NOW,"social_colors")) ? " social-colors":"") . '" style="' .  esc_attr($Y_NOW["custom_css_styles"]) .  '">' . $html . $html_append . '</div>';
}
function hc_include_hc_subtitle(&$Y_NOW,$EXTRA) {
    $css = hc_get_component_classes($Y_NOW,$EXTRA) . ' ' . esc_attr($Y_NOW["alignment"]);
    if ($Y_NOW["style"] == "base") { ?>
<div class="title-base <?php echo $css ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" id="<?php echo $Y_NOW["id"] ?>">
    <hr />
    <h2>
        <?php echo esc_attr($Y_NOW["title"]); ?>
    </h2>
    <?php hc_echo(esc_attr($Y_NOW["subtitle"]),"<p>","</p>"); ?>
</div>
<?php }
    if ($Y_NOW["style"] == "base_2") { ?>
<div class="title-base <?php echo $css ?>"
    style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" id="<?php echo $Y_NOW["id"] ?>">
    <hr />
    <h2>
        <?php echo esc_attr($Y_NOW["title"]); ?>
    </h2>
    <?php hc_echo(esc_attr($Y_NOW["subtitle"]),"<p>","</p>"); ?>
    <?php if ($Y_NOW["scroll_top"] != "false") echo '<i class="fa fa-angle-up scroll-top"></i>'; ?>
</div>
<?php }
    if ($Y_NOW["style"] == "base_small") { ?>
<div class="title-base title-small <?php echo $css ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" id="<?php echo $Y_NOW["id"] ?>">
    <h2>
        <?php echo esc_attr($Y_NOW["title"]); ?>
    </h2>
    <hr />
    <?php hc_echo(esc_attr($Y_NOW["subtitle"]),"<p>","</p>"); ?>
    <?php if ($Y_NOW["scroll_top"] != "false") echo '<i class="fa fa-angle-up scroll-top"></i>'; ?>
</div>
<?php   }
    if ($Y_NOW["style"] == "icon") { ?>
<div class="title-icon <?php echo $css ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" id="<?php echo $Y_NOW["id"] ?>">
    <h2>
        <?php echo esc_attr($Y_NOW["title"]); ?>
    </h2>
    <?php hc_echo(esc_attr($Y_NOW["subtitle"]),"<p>","</p>"); ?>
    <i class="<?php echo esc_attr($Y_NOW["icon"]); ?>"></i>
</div>
<?php   }
    if ($Y_NOW["style"] == "bg_icon") { ?>
<div class="title-icon title-icon-bg <?php echo $css ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" id="<?php echo $Y_NOW["id"] ?>">
    <h2>
        <?php echo esc_attr($Y_NOW["title"]); ?>
    </h2>
    <?php hc_echo(esc_attr($Y_NOW["subtitle"]),"<p>","</p>"); ?>
    <i class="<?php echo esc_attr($Y_NOW["icon"]); ?>"></i>
</div>
<?php    }
    if ($Y_NOW["style"] == "modern") { ?>
<div class="title-modern st-icon <?php echo $css ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" id="<?php echo $Y_NOW["id"] ?>">
    <h3>
        <?php echo esc_attr($Y_NOW["title"]); ?>
    </h3>
    <hr />
    <?php hc_echo(esc_attr($Y_NOW["subtitle"]),"<p>","</p>"); ?>
    <?php if ($Y_NOW["scroll_top"] != "false") echo '<i class="fa fa-angle-up scroll-top"></i>'; ?>
</div>
<?php
    }
}
function hc_include_hc_quote(&$Y_NOW,$EXTRA) {   ?>
<p class="block-quote <?php echo hc_get_component_classes($Y_NOW,$EXTRA); if ($Y_NOW["style"] == "") echo " quote-1"; if ($Y_NOW["style"] == "double_quote") echo " quote-2"; ?> " style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
    echo esc_attr($Y_NOW["text"]);
    hc_echo(esc_attr($Y_NOW["author"]),'<span class="quote-author">','</span>');
    ?>
</p>
<?php }
function hc_include_hc_separator(&$Y_NOW,$EXTRA) {
    echo '<hr class="' . esc_attr(hc_get_now($Y_NOW,"style","default")) . ' ' . hc_get_component_classes($Y_NOW,$EXTRA) . '" ' . hc_get(esc_attr($Y_NOW["custom_css_styles"]),'style="','"')  . ' />';
}
function hc_include_hc_table(&$Y_NOW,$EXTRA) {
    $col_num = $Y_NOW["tab_index"] + 1;
    if ($Y_NOW["advanced"] == "true") { ?>
<table class="table table-hover bootgrid-table <?php echo esc_attr($Y_NOW["style"]) . ' ' . hc_get_component_classes($Y_NOW,$EXTRA); ?>" data-options="<?php echo esc_attr($Y_NOW["data_options"]);  ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <thead>
        <tr>
            <?php
        for ($i=1; $i <= $col_num; $i++) {
            $val = $Y_NOW["table"]["c" . $col_num . "_" . $i . "_header"];
            $format = "";
            if (strpos($val,'img:') !== false) { $format = " data-formatter='image'"; $val = str_replace("img:","",$val); };
            if (strpos($val,'btn:') !== false) { $format = " data-formatter='button'"; $val = str_replace("btn:","",$val); };
            if (strpos($val,'link:') !== false) { $format = " data-formatter='link'"; $val = str_replace("link:","",$val); };
            if (strpos($val,'icon:') !== false) { $format = " data-formatter='link-icon'"; $val = str_replace("icon:","",$val); };
            echo "<th data-column-id='table_c_" . $i ."'" . $format  . ">" . esc_attr($val) . "</th>";
        };
            ?>
        </tr>
    </thead>
    <tbody>
        <?php for ($i=0; $i < count($Y_NOW["table"]["rows"]); $i++) {
                  echo "<tr>";
                  for ($j=1; $j <= $col_num; $j++) echo "<td data-column-id='table_c_" . $i ."'>" . $Y_NOW["table"]["rows"][$i]["c" . $col_num . "_" . $j . "_content"] . "</td>";
                  echo "</tr>";
              } ?>
    </tbody>
</table>
<?php } else { ?>
<table class="table table-hover <?php echo esc_attr($Y_NOW["style"] . ' ' . hc_get_component_classes($Y_NOW,$EXTRA)); ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <thead>
        <tr>
            <?php for ($i=1; $i <= $col_num; $i++) echo "<th>" . $Y_NOW["table"]["c" . $col_num . "_" . $i . "_header"] . "</th>"; ?>
        </tr>
    </thead>
    <tbody>
        <?php for ($i=0; $i < count($Y_NOW["table"]["rows"]); $i++) {
                  echo "<tr>";
                  for ($j=1; $j <= $col_num; $j++) echo "<td>" . $Y_NOW["table"]["rows"][$i]["c" . $col_num . "_" . $j . "_content"] . "</td>";
                  echo "</tr>";
              } ?>
    </tbody>
</table>
<?php }
}
function hc_include_hc_inner_menu(&$Y_NOW,$EXTRA) {
    global $HC_PAGE_ARR;
    $menu_html = '';

    $menu_type =  $Y_NOW["type"];
    if ($menu_type == "horizontal") $menu_html = '<ul id="hc-inner-menu" class="nav navbar-nav inner '. $Y_NOW["alignment"] . ' ' . $Y_NOW["style"] . '">';
    if ($menu_type == "vertical") {
        $ms = $Y_NOW["style"];
        if ($ms == "ms-rounded") $ms = "ms-simple";
        $menu_html = '<ul id="hc-inner-menu" class="side-menu ' . $ms . '">';
    }

    $menu_items = $Y_NOW["rows"];
    $count = count($menu_items);
    $arr_sections_id = array();
    $one_page = $Y_NOW["one_page"];

    if ($one_page == "true") {
        foreach ($HC_PAGE_ARR as $key => $value) {
            if (is_array($HC_PAGE_ARR[$key]) && key_exists("component",$HC_PAGE_ARR[$key]) && $HC_PAGE_ARR[$key]["component"] == "hc_section") array_push($arr_sections_id,$HC_PAGE_ARR[$key]["id"]);
        }
        $diff = $count - count($arr_sections_id);
        for ($i = 0; $i < $diff; $i++) array_push($arr_sections_id,"");
    }
    for ($i = 0; $i < $count; $i++) {
        if ($one_page != "true") $link = esc_url($menu_items[$i]["link"]); else $link = "#" . $arr_sections_id[$i];
        if ($menu_items[$i]["child"] != "true") {
            if ($i + 1 < $count && $menu_items[$i + 1]["child"] == "true") {
                if ($menu_type == "horizontal") $menu_html .= '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">' . hc_get_icon($menu_items[$i]["icon"],"","","") . esc_attr($menu_items[$i]["text"]) . '<i class="caret"></i></a>';
                if ($menu_type == "vertical") $menu_html .= '<li><a href="#">' . hc_get_icon($menu_items[$i]["icon"],"","","") . esc_attr($menu_items[$i]["text"]) . ' <span class="fa arrow"></span></a>';

                $html = '';
                if ($menu_type == "horizontal") $html = '<ul class="dropdown-menu multi-level">';
                if ($menu_type == "vertical") $html = '<ul class="collapse">';

                $j = $i + 1;
                while ($j < $count && $menu_items[$j]["child"] == "true") {
                    $sub_link = '';
                    if ($one_page != "true") $sub_link = esc_url($menu_items[$j-1]["link"]); else $sub_link = "#" . $arr_sections_id[$j - 1];
                    $html .= '<li><a ' . (($Y_NOW["one_page"] != "true") ? 'onclick="document.location=\'' . $sub_link . '\'"':"") . ' href="' . $sub_link . '">'. hc_get_icon($menu_items[$j]["icon"],"","","") . esc_attr($menu_items[$j]["text"]) . '</a></li>';
                    $j++;
                }
                $i = $j-1;
                $menu_html .=  $html . '</ul></li>';
            } else $menu_html .= '<li><a href="' . $link . '">'. hc_get_icon($menu_items[$i]["icon"],"","","") . esc_attr($menu_items[$i]["text"]) . '</a></li>';
        }
    }
    $menu_html .= '</ul>';
    if ($menu_type == "horizontal") echo '<div class="navbar navbar-inner ' . hc_get_component_classes($Y_NOW,$EXTRA) .'" style="' . esc_attr($Y_NOW["custom_css_styles"]) .'"><div class="navbar-toggle"><i class="fa fa-bars"></i><span>' . esc_attr__("menu","hc") . '</span><i class="fa fa-angle-down"></i></div><div class="collapse navbar-collapse">' . $menu_html . '</div></div>';
    if ($menu_type == "vertical") echo '<aside class="sidebar mi-menu ' . hc_get_component_classes($Y_NOW,$EXTRA) .'" style="' . esc_attr($Y_NOW["custom_css_styles"]) .'"><nav class="sidebar-nav">' . $menu_html . '</nav></aside>';
}
function hc_include_hc_contact_form(&$Y_NOW,$EXTRA) { ?>
<form action="<?php echo HC_PLUGIN_URL ?>/scripts/php/contact-form.php" class="form-box form-ajax form-ajax-wp <?php echo hc_get_component_classes($Y_NOW,$EXTRA); if ($Y_NOW["label"] == "true") echo " label-visible"; ?>" method="post" data-email="<?php echo $Y_NOW["recipient_email"]; ?>" <?php hc_echo(hc_get_now($Y_NOW,"subject"),'data-subject="','"') ?> <?php hc_echo(esc_attr($Y_NOW["custom_css_styles"]),'style="','"'); ?>>
    <div class="row <?php if ($Y_NOW["button_position"] == "inline") echo "form-inline"; ?>">
        <?php
    $button = "";
    $button_text = esc_attr($Y_NOW["button_text"]);
    if ($button_text == "") $button_text = __("Send message");
    $button = hc_get_now($Y_NOW,"button_style","circle");
    if ($button == "square" || $button == "square-anima") $button = "btn ";
    if ($button == "circle" || $button == "circle-anima") $button = "btn circle-button ";
    if ($button == "square-border") $button = "btn btn-border ";
    if ($button == "circle-border")  $button =  "btn circle-button btn-border ";
    if ($button == "link") {
        $button =  "btn-text";
    } else {
        $button .= " " . hc_get_now($Y_NOW,"button_dimensions","btn-sm");
        if (hc_get_now($Y_NOW,"button_animation")) $button .= " anima-button ";
    }
    if ($Y_NOW["button_position"] == "inline") $button .=  " pull-right ";
    $button = '<button class="' . $button . '" type="submit">' . ((strlen($Y_NOW["button_icon"]) > 0) ? "<i class='" . $Y_NOW["button_icon"] . "'></i>":"") . $button_text . '</button>';

    $arr = $Y_NOW["rows"];
    for ($i = 0; $i < count($arr); $i++) {
        $text = esc_attr($arr[$i]["text"]);
        $id = str_replace(" ","-",$text);
        $placeholder = (($Y_NOW["placeholder"] == "true") ? 'placeholder="' . $text . '"':'');
        $required = (($arr[$i]["required"] == "true") ? 'required':'');
        ?>
        <div class="<?php echo $arr[$i]["column"]; ?>">
            <hr class="space xs" />
            <?php
        if ($Y_NOW["label"] == "true") echo '<p>' . $text . '</p>';
        if ($arr[$i]["input_type"] == "text") echo '<input id="' . $id . '" name="' . $text . '" ' . $placeholder . ' type="text" class="form-control form-value" ' . $required . '>';
        if ($arr[$i]["input_type"] == "email") echo '<input id="' . $id . '" name="' . $text . '" ' . $placeholder . ' type="email" class="form-control form-value" ' . $required . '>';
        if ($arr[$i]["input_type"] == "number") echo '<input id="' . $id . '" name="' . $text . '" ' . $placeholder . ' type="number" class="form-control form-value" ' . $required . '>';
        if ($arr[$i]["input_type"] == "link") echo '<input id="' . $id . '" name="' . $text . '" ' . $placeholder . ' type="url" class="form-control form-value" ' . $required . '>';
        if ($arr[$i]["input_type"] == "textarea") echo '<textarea id="' . $id . '" name="' . $text . '" ' . $placeholder . ' class="form-control form-value" ' . $required . '></textarea>';
        if ($arr[$i]["input_type"] == "select") echo '<select id="' . $id . '" name="' . $text . '" class="form-control form-value" ' . $required . '><option value="" label="--">--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10+">10+</option></select>';
        if ($arr[$i]["input_type"] == "calendar") echo '<input id="' . $id . '" name="' . $text . '" ' . $placeholder . ' type="text" data-toggle="datepicker" class="form-control form-value" ' . $required . '>';
            ?>
        </div>
        <?php }
    $loader = '<img class="cf-loader" src="' . HC_PLUGIN_URL . '/images/loader.svg" alt="" />';
    if ($Y_NOW["button_position"] == "inline") {
        if (hc_get_now($Y_NOW,"recaptcha") != "") echo '<div class="g-recaptcha" data-sitekey="' . hc_get_now($Y_NOW,"recaptcha") . '"></div>';
        echo $button;
    }
        ?>
    </div>
    <?php
    if ($Y_NOW["button_position"] != "inline") echo '<hr class="space s" />';
    if ($Y_NOW["button_position"] != "inline" && hc_get_now($Y_NOW,"recaptcha") != "") echo '<div class="g-recaptcha" data-sitekey="' . hc_get_now($Y_NOW,"recaptcha") . '"></div>';
    if ($Y_NOW["button_position"] == "left") echo $button . $loader;
    if ($Y_NOW["button_position"] == "center") echo '<div class="text-center">' . $button . $loader . '</div>';
    if ($Y_NOW["button_position"] == "right") echo '<div class="text-right">' . $button . $loader . '</div>';
    ?>
    <div class="success-box">
        <div class="alert alert-success">
            <?php echo esc_attr($Y_NOW["success_message"]); ?>
        </div>
    </div>
    <div class="error-box">
        <div class="alert alert-warning">
            <?php echo esc_attr($Y_NOW["error_message"]); ?>
        </div>
    </div>
</form>
<?php }
function hc_include_hc_space(&$Y_NOW,$EXTRA) {   ?>
<hr class="space <?php echo esc_attr($Y_NOW["size"]) . ' ' . hc_get_component_classes($Y_NOW,$EXTRA); ?>" <?php hc_echo(esc_attr($Y_NOW["custom_css_styles"] . hc_get(hc_get_now($Y_NOW,"height")," height: ","px")),'style="','"') ?> />
<?php }
function hc_include_hc_breadcrumbs(&$Y_NOW,$EXTRA) {
    echo hc_get_breadcrumb($Y_NOW["position"]);
}
function hc_include_hc_fp_slides(&$Y_NOW,$EXTRA) {
    //Compatibility function - Fullpage slides component on sections.php
}
function hc_include_hc_code_block(&$Y_NOW,$EXTRA) {
    echo '<div class="' . hc_get_component_classes($Y_NOW,$EXTRA) . '" ' . hc_echo(esc_attr($Y_NOW["custom_css_styles"]),'style="','"') . '>';
    if (ctype_xdigit($Y_NOW["content"])) {
        $content = hex2binX($Y_NOW["content"]);
        $content = iconv(mb_detect_encoding($content, mb_detect_order(), true), "UTF-8", $content);
        if ($Y_NOW["language"] == "js") echo "<script>" . $content . "</script>";
        if ($Y_NOW["language"] == "css") echo "<style>" . $content . "</style>";
        if ($Y_NOW["language"] == "") echo $content;
    }
    echo '</div>';
}
function hex2binX($hex) {
    function uchr ($codes) {
        if (is_scalar($codes)) $codes= func_get_args();
        $str= '';
        foreach ($codes as $code) $str.= html_entity_decode('&#'.$code.';',ENT_NOQUOTES,'UTF-8');
        return $str;
    }
    $hexes = str_split($hex, 4);
    $back = "";
    for ($j = 0; $j < count($hexes); $j++) {
        $back .= uchr(intval($hexes[$j],16));
    }
    return $back;
}
function hc_include_hc_fp_bottom_top_container(&$Y_NOW,$EXTRA) { ?>
<div class="hc_fp_bottom_top_container_cnt">
    <div class="<?php echo esc_attr($Y_NOW["position"]) . '-area ' . hc_get_component_classes($Y_NOW,$EXTRA); ?>" <?php hc_echo(esc_attr($Y_NOW["custom_css_styles"]),'style="','"') ?>>
        <?php
    if (!$Y_NOW["full_width"]) echo '<div class="container">';
    $CURRENT_SECTION = $Y_NOW["content"];
    for ($i = 0; $i < count($CURRENT_SECTION); $i++) {
        hc_get_content_recursive($CURRENT_SECTION[$i],$EXTRA);
    }
    if (!$Y_NOW["full_width"]) echo '</div>';
        ?>
    </div>
</div>
<?php
}
?>
