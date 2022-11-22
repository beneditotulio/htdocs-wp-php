<?php
// =============================================================================
// TITLES.PHP
// -----------------------------------------------------------------------------
// Hybric Composer titles front-end components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. TITLE MANAGER BLOCK - Container for all the titles
//   02. TITLE IMAGE - Documentation and demo: framework-y.com/components/title/template-title-image.html
//   03. TITLE SLIDER - Documentation and demo: framework-y.com/components/title/template-title-slider.html
//   04. TITLE VIDEO - Documentation and demo: framework-y.com/components/title/template-title-video-mp4.html
//   05. TITLE ANIMATION - Documentation and demo: framework-y.com/components/title/template-title-animation.html
//   06. TITLE BASE - Documentation and demo: framework-y.com/components/title/template-title-base-1.html
// =============================================================================

$NOW_SUB = $Y_NOW['title_content'];
$white = " white ";
if (isset($NOW_SUB["white"]) && hc_get_now($NOW_SUB,"white") == 0) $white = "";
if ($NOW_SUB["component"] == "hc_title_image") {
?>
<div class="header-title overlay-container <?php echo $white . esc_attr($NOW_SUB['ken_burn']); if ($NOW_SUB['full_screen']) echo " full-screen-title";?>"
    <?php  $tmp = explode("|",$NOW_SUB['image']);
       if ($NOW_SUB['parallax'] && count($tmp) > 1) {
           echo 'data-parallax="scroll" data-natural-height="' .  esc_attr($tmp[1]) . '" data-natural-width="' . esc_attr($tmp[2]) . '" data-position="top" data-image-src="' . hc_get_img($NOW_SUB['image'],"hd") . '"';
           hc_echo(hc_get_now($NOW_SUB,"bleed"),' data-bleed="','"');
       } else echo ' style="background-image: url(' . hc_get_img($NOW_SUB['image'],"hd") . ');"' ?> data-sub-height="<?php echo esc_attr($NOW_SUB['full_screen_height']) ?>">
    <?php hc_echo($NOW_SUB['overlay'],'<div class="bg-overlay ','"></div>') ?>
    <div class="overlay-content overlaybox">
        <div class="container">
            <div class="title-base">
                <hr class="anima" />
                <h1>
                    <?php echo esc_attr($Y_NOW['title']); ?>
                </h1>
                <p>
                    <?php echo esc_attr($Y_NOW['subtitle']); ?>
                </p>
                <?php if (hc_get_now($NOW_SUB,"breadcrumbs")) echo hc_get_breadcrumb(); ?>
            </div>
        </div>
    </div>
</div>
<?php }
if ($NOW_SUB["component"] == "hc_title_slider") {
    $css = $white;
    if ($NOW_SUB['full_screen']) $css .= "full-screen-title ";
    if ($NOW_SUB['parallax']) $css .= "header-parallax";
?>
<div class="header-slider <?php echo $css ?>" data-sub-height="<?php echo esc_attr($NOW_SUB['full_screen_height']) ?>">
    <?php if ($NOW_SUB['parallax']) echo '<div class="layer-parallax">'; ?>
    <?php hc_echo(esc_attr($NOW_SUB['overlay']),'<div class="bg-overlay ','"></div>') ?>
    <div class="flexslider slider" data-options="<?php echo $NOW_SUB['data_options']; ?>">
        <ul class="slides">
            <?php
    $tmp = $NOW_SUB["slides"];
    foreach ($tmp as $value) {
        echo '<li><div class="bg-cover" style="background-image: url(' .  hc_get_img($value['link'],"hd") .')"></div></li>';
    }
            ?>
        </ul>
    </div>
    <?php if ($NOW_SUB['parallax']) echo '</div>'; ?>
    <div class="overlaybox">
        <div class="container">
            <div class="title-base">
                <hr class="anima" />
                <h1>
                    <?php echo esc_attr($Y_NOW['title']); ?>
                </h1>
                <p>
                    <?php echo esc_attr($Y_NOW['subtitle']); ?>
                </p>
                <?php if (hc_get_now($NOW_SUB,"breadcrumbs")) echo hc_get_breadcrumb(); ?>
            </div>
        </div>
    </div>
</div>
<?php }
if ($NOW_SUB["component"] == "hc_title_video") {
    $css = $white;
    if ($NOW_SUB['full_screen']) $css .= "full-screen-title ";
    if ($NOW_SUB['parallax']) $css .= "header-parallax";
?>
<div class="header-video <?php echo $css ?>" data-sub-height="<?php echo esc_attr($NOW_SUB['full_screen_height']) ?>">
    <?php $tmp =  $NOW_SUB['overlay']; if (strlen($tmp) > 0) echo '<div class="bg-overlay video '. $tmp .'"></div>'; ?>
    <div class="videobox <?php if ($NOW_SUB['parallax']) echo " layer-parallax" ?>">
        <?php $tmp = $NOW_SUB['video'];
              if (strpos($tmp,'.mp4') !== false) { ?>
        <video autoplay loop muted poster="<?php echo hc_get_img($NOW_SUB['image'],"hd"); ?>">
            <source src="<?php echo esc_url($tmp); ?>" type="video/mp4">
        </video>
        <?php } else { ?>
        <div class="videobox <?php if ($NOW_SUB['parallax']) echo 'layer-parallax'; ?>">
            <div data-video-youtube="<?php echo ((strpos($tmp,'http') !== false) ? esc_url($tmp):esc_attr($tmp)) ?>"></div>
            <div class="mobile-poster" style="background-image:url(<?php echo hc_get_img($NOW_SUB['image'],"hd"); ?>)"></div>
        </div>
        <?php }  ?>
    </div>
    <div class="overlaybox">
        <div class="container">
            <div class="title-base">
                <hr class="anima" />
                <h1>
                    <?php echo esc_attr($Y_NOW['title']); ?>
                </h1>
                <p>
                    <?php echo esc_attr($Y_NOW['subtitle']); ?>
                </p>
                <?php if (hc_get_now($NOW_SUB,"breadcrumbs")) echo hc_get_breadcrumb(); ?>
            </div>
        </div>
    </div>
</div>
<?php }
if ($NOW_SUB["component"] == "hc_title_animation") { ?>
<div class="header-animation <?php echo $white ?>"
   <?php $tmp = explode("|",$NOW_SUB['image']);
       if ($NOW_SUB['parallax']) {
           echo 'data-parallax="scroll" data-natural-height="' .  esc_attr($tmp[1]) . '" data-natural-width="' . esc_attr($tmp[2]) . '" data-position="top" data-image-src="' . hc_get_img($NOW_SUB['image'],"hd") . '"';
       } else echo ' style="background-image: url(' . hc_get_img($NOW_SUB['image'],"hd") . ');"' ?>>
    <div id="anima-layer-a" class="anima-layer <?php echo esc_attr($NOW_SUB['animation_image']); ?>"></div>
    <div id="anima-layer-b" class="anima-layer <?php echo esc_attr( $NOW_SUB['animation_image_2']); ?>"></div>
    <?php  
    $tmp = hc_get_img_arr($NOW_SUB['image_main']); 
    if ($tmp[0] != "") echo '<img alt="Title image" class="overlay bottom"' . hc_get(esc_attr($tmp[2]),' width="','"') . ' src="' . esc_url($tmp[0]) . '" />';
    ?>
    <div class="container">
        <div class="title-base">
            <hr class="anima" />
            <h1><?php echo esc_attr($Y_NOW['title']); ?></h1>
            <p><?php echo esc_attr($Y_NOW['subtitle']); ?></p>
            <?php if (hc_get_now($NOW_SUB,"breadcrumbs")) echo hc_get_breadcrumb(); ?>
        </div>
    </div>
</div>
<script>
    (function ($) {
        $(document).ready(function () {
            $('#anima-layer-a').pan({ fps: 30, speed: 0.7, dir: 'left', depth: 30 });
            $('#anima-layer-b').pan({ fps: 30, speed: 1, dir: 'left', depth: 70 });
            $('.header-animation .overlay').css("margin-left", "-" + $('.header-animation .overlay').width() / 2 + "px");
        });
    }(jQuery));
</script>
<?php }
if ($NOW_SUB["component"] == "hc_title_base") {
    $img = hc_get_now($NOW_SUB,'image');
    $css = $white;
    if ($img != "") $css .= " bg-cover";
    if ($Y_NOW['subtitle'] == "") $css .= " no-subtitle";
?>
<div class="header-base <?php echo $css ?>" <?php hc_echo(hc_get_img($img),'style="background-image: url(',')"') ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="title-base text-left">
                    <h1>
                        <?php echo esc_attr($Y_NOW['title']); ?>
                    </h1>
                    <p>
                        <?php echo esc_attr($Y_NOW['subtitle']); ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <?php if(!isset($NOW_SUB["breadcrumbs"]) || hc_get_now($NOW_SUB,"breadcrumbs",0)) echo hc_get_breadcrumb(); ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
