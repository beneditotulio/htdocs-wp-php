<?php
function hc_set_twosides_bg_section($bg_settings) {
    if ( $bg_settings["component"] == "hc_title_image") {
        echo '
<div class="background-page" style="background-image:url('. hc_get_img($bg_settings["image"],"full") .')">
    ';
        if (strlen($bg_settings["overlay"]) > 0) echo '
    <div class="bg-overlay ' . esc_attr($bg_settings[" overlay"]) .'"></div>';
        echo '
</div>';
    }
    if ( $bg_settings["component"] == "hc_title_slider") { ?>
<div class="background-page">
    <?php if (strlen($bg_settings["overlay"]) > 0) echo '<div class="bg-overlay ' . esc_attr($bg_settings["overlay"]) .'"></div>'; ?>
    <div class="flexslider slider" data-options="<?php echo esc_attr($bg_settings['data_options']); ?>,directionNav:false,animation:fade">
        <ul class="slides">
            <?php
        foreach ($bg_settings['slides'] as $value) {
            echo '<li><div class="bg-cover" style="background-image: url(' . hc_get_img($value["link"],"full")  .')"></div></li>';
        }
            ?>
        </ul>
    </div>
</div>
<?php  }
    if ( $bg_settings["component"] == "hc_title_video") { ?>
<div class="background-page">
    <?php if (strlen($bg_settings["overlay"]) > 0) echo '<div class="bg-overlay ' . esc_attr($bg_settings["overlay"]) .'"></div>'; ?>
    <video loop autoplay muted poster="<?php echo hc_get_img($bg_settings['image'],"ultra-large"); ?>">
        <source src="<?php echo esc_url($bg_settings['video']); ?>" type="video/mp4">
    </video>
</div>
<?php }
}
if (count($HC_PAGE_ARR) > 3) {
$fp_settings = hc_get_now($HC_PAGE_ARR,array("template_setting","settings"));
$fp_content = hc_get_now($HC_PAGE_ARR,array("main-title","title_content"));
if (is_array($fp_content)) hc_set_twosides_bg_section($fp_content);
?>
<div class="sec-twoside white" <?php hc_echo(hc_get_now($fp_settings,"center_offset")," data-offset='","'") ?>>
    <div class="row">
        <div class="half-side left">
            <div class="content row">
                <!-- MAIN LEFT CONTENT -->
                <?php
                $i=0;
                foreach ($HC_PAGE_ARR as $key => $value) {
                    if ($i == 1) {
                        $CURRENT_SECTION = $HC_PAGE_ARR[$key]["section_content"];
                        for ($i = 0; $i < count($CURRENT_SECTION); $i++) {
                            hc_get_content_recursive($CURRENT_SECTION[$i], []);
                        }
                    }
                    $i++;
                }
                ?>
                <div class="clear"></div>
            </div>
        </div>
        <div class="half-side right">
            <div class="content">
                <!-- MAIN RIGHT CONTENT -->
                <div id="twosides-menu">
                    <?php
                    $arr = $HC_PAGE_ARR["template_setting_top"]["page_menu"];
                    for ($i = 1; $i < $arr["repeater_items"] + 1; $i++) echo '<div class="twoside-open"><hr />'.  esc_attr($arr["item_" . $i]["text"]) .'</div>';
                    ?>
                </div>
            </div>
        </div>
        <div id="twosides-main">
            <?php
            $i=0;
            foreach ($HC_PAGE_ARR as $key => $value) {
                if ($i > 1 && is_array($HC_PAGE_ARR[$key]) && key_exists("component",$HC_PAGE_ARR[$key])) {
                    if ($HC_PAGE_ARR[$key]["component"] == "hc_section") {
            ?>
            <div class="section center-box">
                <div class="content row">
                    <?php
                        $CURRENT_SECTION = $HC_PAGE_ARR[$key]["section_content"];
                        for ($i = 0; $i < count($CURRENT_SECTION); $i++) {
                            hc_get_content_recursive($CURRENT_SECTION[$i], []);
                        }
                    ?>
                </div>
            </div>
            <?php }
                }
                $i++;
            }
            ?>
        </div>
        <div class="center-bg"></div>
        <div class="close-button"></div>
    </div>
</div>
<?php
}
