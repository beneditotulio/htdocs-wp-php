<?php
// =============================================================================
// ADMIN-SETTINGS-PAGE.PHP
// -----------------------------------------------------------------------------
// This file contain all contents of Y theme settings page.
//
// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Save and read blocks
//   02. General settings
//   03. Menu settings
//   04. Footer settings
//   05. Social settings
// =============================================================================
global $HC_THEME_SETTINGS;
$hc_theme = wp_get_theme();
$langs = array();
if (function_exists('icl_object_id')) {
    $langs = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str');
}
if (HC_IS_CUSTOM_PANEL) include(HC_PLUGIN_PATH . "/custom/custom-options-panel.php");
if (HC_IS_CUSTOM_PANEL && isset($HC_CUSTOM_PANEL)) {
    echo "<style>.y_form .nav-tabs > li.active > a, .y-form .nav-tabs > li.active > a:hover, .y-form .nav-tabs > li.active > a:focus, .y_form .nav-tabs > li.active > a:hover {
                  background: " . $HC_CUSTOM_PANEL["colors"][0] . "; border-color: " . $HC_CUSTOM_PANEL["colors"][0] . ";}
                  .ypanel .brand-title { background-color: " . $HC_CUSTOM_PANEL["colors"][1] . "; }
          </style>";
}
//CUSTOMIZATIONS
function hc_custom_settings($label = "main") {
    if (HC_IS_CUSTOM_PANEL) {
        global $HC_CUSTOM_THEME_OPTIONS;
        if (isset($HC_CUSTOM_THEME_OPTIONS)) {
            $html = "";
            for ($i = 0; $i < count($HC_CUSTOM_THEME_OPTIONS); $i++) {
                if ($HC_CUSTOM_THEME_OPTIONS[$i]["label"] == $label) {
                    switch ($HC_CUSTOM_THEME_OPTIONS[$i]["type"]){
                        case "checkbox":
                            $html .= '<div class="row item-row"><div class="col-md-6 yinfo-bar"><h4>' . $HC_CUSTOM_THEME_OPTIONS[$i]["name"] . '</h4>
                                      <p>' . $HC_CUSTOM_THEME_OPTIONS[$i]["description"] . '</p></div><div class="col-md-6"><div class="input-checkbox input-row">
                                      <input id="' . $HC_CUSTOM_THEME_OPTIONS[$i]["id"] . '" data-save="checkbox" type="checkbox" ' . hc_get_setting($HC_CUSTOM_THEME_OPTIONS[$i]["id"]) . '></div></div></div><hr />';
                            break;
                        case "select":
                            $tmp = hc_get_setting($HC_CUSTOM_THEME_OPTIONS[$i]["id"]);
                            if (strlen($tmp) == 0) $tmp = "";
                            $html .= '<div class="row item-row skin-option"><div class="col-md-6 yinfo-bar"><h4>' . $HC_CUSTOM_THEME_OPTIONS[$i]["name"] . '</h4>
                                      <p>' . $HC_CUSTOM_THEME_OPTIONS[$i]["description"] . '</p></div><div class="col-md-6"><div class="input-select input-row">
                                      <select id="' . $HC_CUSTOM_THEME_OPTIONS[$i]["id"] . '" data-save="select">';
                            $arr = explode("|",$HC_CUSTOM_THEME_OPTIONS[$i]["value"]);
                            $html .= '<option ' . (($tmp == "") ? "selected" : "")  . ' value=""></option>';
                            for ($y = 0; $y < count($arr); $y++) {
                                $val = strtolower(str_replace(" ","-",$arr[$y]));
                                $html .= '<option ' . (($tmp == $val) ? "selected" : "")  . ' value="' . $val  . '">' . $arr[$y] . '</option>';
                            }
                            $html .= ' </select></div></div></div><hr />';
                            break;
                        case "text":
                            $html .= '<div class="row item-row"><div class="col-md-6 yinfo-bar"><h4>' . $HC_CUSTOM_THEME_OPTIONS[$i]["name"] . '</h4>
                                      <p>' . $HC_CUSTOM_THEME_OPTIONS[$i]["description"] . '</p></div><div class="col-md-6"><div class="input-text input-row">
                                      <input id="' . $HC_CUSTOM_THEME_OPTIONS[$i]["id"] . '" type="text" data-save="text" value="' . hc_get_setting($HC_CUSTOM_THEME_OPTIONS[$i]["id"]) . '" /></div></div></div><hr />';
                            break;
                        case "textarea":
                            $html .= '<div class="row item-row"><div class="col-md-6 yinfo-bar"><h4>' . $HC_CUSTOM_THEME_OPTIONS[$i]["name"] . '</h4>
                                      <p>' . $HC_CUSTOM_THEME_OPTIONS[$i]["description"] . '</p></div><div class="col-md-6"><div class="input-text-area input-row full-input">
                                      <textarea id="' . $HC_CUSTOM_THEME_OPTIONS[$i]["id"] . '" data-save="text" spellcheck="false">' . hc_get_setting($HC_CUSTOM_THEME_OPTIONS[$i]["id"]) . '</textarea></div></div></div><hr />';
                            break;
                        case "color":
                            $tmp = hc_get_setting($HC_CUSTOM_THEME_OPTIONS[$i]["id"]);
                            $html .= '<div class="row item-row"><div class="col-md-6 yinfo-bar"><h4>' . $HC_CUSTOM_THEME_OPTIONS[$i]["name"] . '</h4>
                                      <p>' . $HC_CUSTOM_THEME_OPTIONS[$i]["description"] . '</p></div><div class="col-md-6"><div class="input-color input-row">
                                      <input id="' . $HC_CUSTOM_THEME_OPTIONS[$i]["id"] . '" type="text" data-save="color" value="' . $tmp . '" />
                                      <span class="color-preview" style="' . ((strlen($tmp) > 0) ? "background-color:" . $tmp:"") . '"></span></div></div></div><hr />';
                            break;
                        case "image_upload":
                            $tmp = hc_get_setting($HC_CUSTOM_THEME_OPTIONS[$i]["id"]);
                            $html .= '<div class="row item-row"><div class="col-md-6 yinfo-bar"><h4>' . $HC_CUSTOM_THEME_OPTIONS[$i]["name"] . '</h4>
                                      <p>' . $HC_CUSTOM_THEME_OPTIONS[$i]["description"] . '</p></div><div class="col-md-6"><div class="upload-box upload-row float-left">
                                      <span class="close-button"></span><div class="upload-container"><div id="' . $HC_CUSTOM_THEME_OPTIONS[$i]["id"] . '"
                                      class="upload-btn ' . ((strlen($tmp) > 0) ? "setted":"") . '" data-save="upload" style="' . ((strlen($tmp) > 0) ? "background-image:url(" . $tmp . ")":"") . '"></div></div></div></div></div><hr />';
                            break;
                        default:
                    }
                }
            }
            echo $html;
        }
    }
}
function hc_demos(){
    global $HC_CUSTOM_PANEL;
    if (HC_IS_CUSTOM_PANEL && isset($HC_CUSTOM_PANEL)) {
        $html = "";
        for ($i = 0; $i < count($HC_CUSTOM_PANEL["demos"]); $i++) {
            $html .= '<div class="col-md-3"><div class="img-box" data-demo="' . $HC_CUSTOM_PANEL["demos"][$i]["id"] . '"><span>
                      <img src="' . HC_PLUGIN_URL . '/custom/demos/' . $HC_CUSTOM_PANEL["demos"][$i]["id"] . '.jpg")">
                      </span><span class="caption">' . $HC_CUSTOM_PANEL["demos"][$i]["name"] . '</span></div></div>';
        }
        echo $html;
    }
}
//OTHERS
function hc_set_footer_multilanguage(&$langs,$index) {
    if (function_exists('icl_object_id')) {
        foreach ($langs as $item) {
            $lan_code = $item['language_code'];
?>
<p class="label-panel"><img alt="flag" src="<?php echo $item['country_flag_url'] ?>"><?php echo $lan_code; ?></p>
<div class="input-text-area full-input" spellcheck="false">
    <textarea id="<?php echo "footer-content-" . $index . "-" . $lan_code; ?>" data-save="text"><?php hc_echo_setting('footer-content-' . $index . '-' . $lan_code) ?></textarea>
</div>
<?php
        }
    } else {
?>
<div class="input-text-area full-input" spellcheck="false">
    <textarea id="footer-content-<?php echo $index ?>" data-save="text"><?php hc_echo_setting('footer-content-' . $index) ?></textarea>
</div>
<?php
    }
}
//IMPORT SECTION
if (isset($_POST['submit_import_dmeo'])) {
    $val  = $_POST['demo_settings_string'];
    if (strlen($val) > 0) {
        $tmp_arr  = json_decode(stripslashes( $val));
        if (update_option('framework_y_theme_settings', $tmp_arr) == true) {
            $HC_THEME_SETTINGS = $tmp_arr;
        }
    }
}
// SAVE BLOCK
// -----------------------------------------------------------------------------
// Save all the settings into one WordPress option as single array.
// =============================================================================
if (isset($_POST['submit_save'])) {
    $string_arr = $_POST['framework_y_settings'];
    if (strlen($string_arr) > 0) {
        $all_settings_arr  = json_decode(stripslashes($string_arr));
        if (update_option('framework_y_theme_settings', $all_settings_arr) == true) {
            $HC_THEME_SETTINGS = $all_settings_arr;
        }
        if (in_array(array("custom-css","checked"), $all_settings_arr)) {
            if (!file_exists(HC_PLUGIN_PATH . '/custom/custom.css')) {
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once (ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $txt = "/* CUSTOM.CSS - Custom CSS block for personal customizations, activate it from WordPress menu > Apparence > Theme options */\n";
                if(!$wp_filesystem->put_contents(HC_PLUGIN_PATH . '/custom/custom.css', $txt, FS_CHMOD_FILE))
                    return new WP_Error('writing_error', 'Error when writing file');
            }
        }
        if (in_array(array("custom-js","checked"),$all_settings_arr)) {
            if (!file_exists(HC_PLUGIN_PATH . '/custom/custom.js')) {
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once (ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $txt = "// CUSTOM.JS - Custom Javascript block for personal customizations, activate it from WordPress menu > Apparence > Theme options\n";
                if(!$wp_filesystem->put_contents(HC_PLUGIN_PATH . '/custom/custom.js', $txt, FS_CHMOD_FILE))
                    return new WP_Error('writing_error', 'Error when writing file');
            }
        }
        if (in_array(array("custom-php","checked"),$all_settings_arr)) {
            if (!file_exists(HC_PLUGIN_PATH . '/custom/custom.php')) {
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once (ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $txt = "<?php\n // CUSTOM.PHP - Custom PHP block for personal customizations, activate it from WordPress menu > Apparence > Theme options\n?>";
                if(!$wp_filesystem->put_contents(HC_PLUGIN_PATH . '/custom/custom.php', $txt, FS_CHMOD_FILE))
                    return new WP_Error('writing_error', 'Error when writing file');
            }
        }
    }
    add_query_arg( array('key1' => 'value1','key2' => 'value2'));
}
// READ BLOCK
// -----------------------------------------------------------------------------
// Read all the settings and print its as a Javascript array.
// =============================================================================
$content_settings = get_option('framework_y_theme_settings');
?>
<script type='text/javascript'>
    <?php if(count($content_settings) > 0) echo "var all_y_settings = " . json_encode($content_settings) . ";";
          else echo "var all_y_settings = [];";
    ?>
    var HC_PLUGIN_URL = '<?php echo esc_url(HC_PLUGIN_URL) ?>';
    var ajax_url = "<?php echo esc_url(admin_url('admin-ajax.php'))?>";
</script>
<form name='hc_settings_form' id="hc_settings_form" method='post' class="y_form ypanel">
    <div class="brand-title" <?php if (file_exists(HC_PLUGIN_PATH . '/custom/logo-panel.png')) echo 'style="background-image:url(' . HC_PLUGIN_URL. '/custom/logo-panel.png)"'; ?>>
        <p>Version <?php if (HC_IS_CUSTOM_PANEL && isset($HC_CUSTOM_PANEL["version"])) echo $HC_CUSTOM_PANEL["version"]; else echo "1.0"; ?></p>
        <a href="http://wordpress.framework-y.com/documentation/" target="_blank"><?php _e("Documentation","hc") ?></a>
    </div>
    <div class="ytab tab-box left">
        <ul class="nav nav-tabs col-md-2">
            <li id="main" class="active"><a href="#"><i class="icon-android-list"></i><?php _e("Main settings","hc") ?></a></li>
            <li id="layout"><a href="#"><i class="icon-android-funnel"></i><?php _e("Layout","hc") ?></a></li>
            <li id="menu"><a href="#"><i class="icon-android-menu"></i><?php _e("Menu","hc") ?></a></li>
            <li id="footer"><a href="#"><i class="icon-android-archive"></i><?php _e("Footer","hc") ?></a></li>
            <li id="lists"><a href="#"><i class="icon-pricetags"></i><?php _e("Lists","hc") ?></a></li>
            <li id="woocommerce"><a href="#"><i class="icon-android-cart"></i><?php _e("Woocommerce","hc") ?></a></li>
            <li id="title"><a href="#"><i class="icon-quote"></i><?php _e("Page titles","hc") ?></a></li>
            <li id="customizations"><a href="#"><i class="icon-code-working"></i><?php _e("Customizations","hc") ?></a></li>
            <li id="social"><a href="#"><i class="icon-facebook"></i><?php _e("Social and API","hc") ?></a></li>
            <li id="demo"><a href="#"><i class="icon-images"></i><?php _e("Demo import","hc") ?></a></li>
        </ul>
        <div class="panel-box col-md-10">
            <div class="panel active">
                <?php hc_custom_settings("main") ?>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Logo","hc") ?></h4>
                        <p><?php _e("Select an image file for your main logo.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-box upload-row float-left">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('logo') ?>
                            <div class="upload-container">
                                <div id="logo" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ")"; ?>'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Secondary logo","hc") ?></h4>
                        <p><?php _e("Secondary logo is used on fixed menu, transparent menu and middle logo menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-box upload-row float-left">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('logo-2') ?>
                            <div class="upload-container">
                                <div id="logo-2" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ")"; ?>'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Retina logo","hc") ?></h4>
                        <p><?php _e("Retina logo is showed only on high resolution displays.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-box upload-row float-left">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('logo-retina') ?>
                            <div class="upload-container">
                                <div id="logo-retina" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ")"; ?>'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Secondary retina logo","hc") ?></h4>
                        <p><?php _e("Retina logo is showed only on high resolution displays.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-box upload-row float-left">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('logo-2-retina') ?>
                            <div class="upload-container">
                                <div id="logo-2-retina" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ")"; ?>'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Favicon","hc") ?></h4>
                        <p><?php _e("Favicon top browser tab at 16px x 16px.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-box upload-row float-left">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('favicon') ?>
                            <div class="upload-container">
                                <div id="favicon" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ");"?> background-size: initial;'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Logo margin top","hc") ?></h4>
                        <p><?php _e("Margin top of the logo.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="logo-margin-top" type="text" data-save="text" data-mask="number" value="<?php hc_echo_setting('logo-margin-top'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Font family","hc") ?></h4>
                        <p>
                            <?php _e("Select the main font family for your website. The fonts are provided by Google Fonts, you can preview the fonts from ","hc") ?>
                            <a href="https://fonts.google.com/" target="_blank">fonts.google.com</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="row input-font-cnt">
                            <div class="col-md-6">
                                <div class="input-text input-row input-font">
                                    <input id="font-family" data-save="text" class="font-family-value" type="text" value="<?php hc_echo_setting('font-family') ?>" />
                                    <input class="google-font-selector" type="text" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-checkbox input-row">
                                    <p>Thin</p>
                                    <input id="100" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Light</p>
                                    <input id="300" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Normal</p>
                                    <input id="400" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Semi Bold</p>
                                    <input id="500" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Bold</p>
                                    <input id="600" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Black</p>
                                    <input id="900" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Font family 2","hc") ?></h4>
                        <p>
                            <?php _e("Select the secondary font family for your website.") ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="row input-font-cnt">
                            <div class="col-md-6">
                                <div class="input-text input-row input-font">
                                    <input id="font-family-2" data-save="text" class="font-family-value" type="text" value="<?php hc_echo_setting('font-family-2') ?>" />
                                    <input class="google-font-selector" type="text" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-checkbox input-row">
                                    <p>Thin</p>
                                    <input id="100" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Light</p>
                                    <input id="300" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Normal</p>
                                    <input id="400" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Semi Bold</p>
                                    <input id="500" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Bold</p>
                                    <input id="600" type="checkbox">
                                </div>
                                <div class="input-checkbox input-row">
                                    <p>Black</p>
                                    <input id="900" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Icon family","hc") ?></h4>
                        <p><?php _e("Select the icon family for your website, available on Hybrid Composer components.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <select id="icons-family" data-save="select">
                                <?php
                                $tmp = hc_get_setting('icons-family');
                                if (strlen($tmp) == 0) $tmp = "";
                                ?>
                                <option <?php if ($tmp == "font-awesome" || $tmp == "") echo "selected"; ?> value="font-awesome">Font Awesome</option>
                                <option <?php if ($tmp == "icons-mind-line") echo "selected"; ?> value="icons-mind-line">Icons Mind Line</option>
                                <option <?php if ($tmp == "icons-mind-solid") echo "selected"; ?> value="icons-mind-solid">Icons Mind Solid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Main color","hc") ?></h4>
                        <p><?php _e("Main color of your website.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-color input-row">
                            <?php $tmp = hc_get_setting('main-color') ?>
                            <input id="main-color" type="text" data-save="color" value="<?php echo esc_attr($tmp); ?>" />
                            <span class="color-preview" style='<?php if (strlen($tmp) > 0) echo "background-color:" . esc_attr($tmp); ?>'></span>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Hover color","hc") ?></h4>
                        <p><?php _e("Hover color of your website.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-color input-row">
                            <?php $tmp = hc_get_setting('hover-color') ?>
                            <input id="hover-color" type="text" data-save="color" value="<?php echo esc_attr($tmp); ?>" />
                            <span class="color-preview" style='<?php if (strlen($tmp) > 0) echo "background-color:" . esc_attr($tmp); ?>'></span>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Color","hc") ?> 3</h4>
                        <p><?php _e("Additional color, used in some skin.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-color input-row">
                            <?php $tmp = hc_get_setting('color-3') ?>
                            <input id="color-3" type="text" data-save="color" value="<?php echo esc_attr($tmp); ?>" />
                            <span class="color-preview" style='<?php if (strlen($tmp) > 0) echo "background-color:" . esc_attr($tmp); ?>'></span>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Color","hc") ?> 4</h4>
                        <p><?php _e("Additional color, used in some skin.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-color input-row">
                            <?php $tmp = hc_get_setting('color-4') ?>
                            <input id="color-4" type="text" data-save="color" value="<?php echo esc_attr($tmp); ?>" />
                            <span class="color-preview" style='<?php if (strlen($tmp) > 0) echo "background-color:" . esc_attr($tmp); ?>'></span>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Smooth scroll","hc") ?></h4>
                        <p><?php _e("Add a nice moving scroll effect on page scroll.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="smooth-scroll" data-save="checkbox" type="checkbox" <?php hc_echo_setting('smooth-scroll'); ?>>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <?php hc_custom_settings("layout") ?>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Layout","hc") ?></h4>
                        <p><?php _e("Set the site layout.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('layout-type',"full-width");
                            ?>
                            <select id="layout-type" data-save="select">
                                <option <?php if ($tmp == "full-width") echo "selected"; ?> value="full-width">Full width</option>
                                <option <?php if ($tmp == "boxed") echo "selected"; ?> value="boxed">Boxed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Boxed layout background","hc") ?></h4>
                        <p><?php _e("Add a background to all the pages of your website. *Supported only for boxed layout.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-box upload-row upload-box-full">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('site-background') ?>
                            <div class="upload-container">
                                <div id="site-background" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ")"; ?>'></div>
                            </div>
                        </div>
                        <hr class="space xs" />
                        <div class="input-color input-row">
                            <?php $tmp = hc_get_setting('site-background-color') ?>
                            <p>Background color</p>
                            <input id="site-background-color" type="text" data-save="color" value="<?php echo esc_attr($tmp); ?>" />
                            <span class="color-preview" style='<?php if (strlen($tmp) > 0) echo "background-color:" . esc_attr($tmp); ?>'></span>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Site width","hc") ?></h4>
                        <p><?php _e("Set the overall site width in px.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="site-width" type="text" data-save="text" placeholder="px" data-mask="number" value="<?php hc_echo_setting('site-width'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Section top \ bottom padding","hc") ?></h4>
                        <p><?php _e("Set the top \ bottom padding for page sections.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="section-padding-y" type="text" data-save="text" placeholder="px" data-mask="number" value="<?php hc_echo_setting('section-padding-y'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Full width left \ right padding","hc") ?></h4>
                        <p><?php _e("Set the left \ right padding for full width sections.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="section-padding-x" type="text" data-save="text" placeholder="px" data-mask="number" value="<?php hc_echo_setting('section-padding-x'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Column margins","hc") ?></h4>
                        <p><?php _e("Set the top \ bottom margins for all column sizes.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="column-margin" type="text" data-save="text" placeholder="px" data-mask="number" value="<?php hc_echo_setting('column-margin'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Title and elements margins","hc") ?></h4>
                        <p><?php _e("Set the bottom margins for some element like the titles and the text blocks.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="elements-margin" type="text" data-save="text" placeholder="px" data-mask="number" value="<?php hc_echo_setting('elements-margin'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Left sidebar width","hc") ?></h4>
                        <p><?php _e("Set the width of the left sidebar.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('sidebar-left-width',"col-md-3");
                            ?>
                            <select id="sidebar-left-width" data-save="select">
                                <option <?php if ($tmp == "col-md-2") echo "selected"; ?> value="col-md-2">20% col-md-2</option>
                                <option <?php if ($tmp == "col-md-3") echo "selected"; ?> value="col-md-3">25% col-md-3</option>
                                <option <?php if ($tmp == "col-md-4") echo "selected"; ?> value="col-md-4">33% col-md-4</option>
                                <option <?php if ($tmp == "col-md-5") echo "selected"; ?> value="col-md-5">41% col-md-5</option>
                                <option <?php if ($tmp == "col-md-6") echo "selected"; ?> value="col-md-6">50% col-md-6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Right sidebar width","hc") ?></h4>
                        <p><?php _e("Set the width of the right sidebar.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('sidebar-right-width',"col-md-3");
                            ?>
                            <select id="sidebar-right-width" data-save="select">
                                <option <?php if ($tmp == "col-md-2") echo "selected"; ?> value="col-md-2">20% col-md-2</option>
                                <option <?php if ($tmp == "col-md-3") echo "selected"; ?> value="col-md-3">25% col-md-3</option>
                                <option <?php if ($tmp == "col-md-4") echo "selected"; ?> value="col-md-4">33% col-md-4</option>
                                <option <?php if ($tmp == "col-md-5") echo "selected"; ?> value="col-md-5">41% col-md-5</option>
                                <option <?php if ($tmp == "col-md-6") echo "selected"; ?> value="col-md-6">50% col-md-6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("RTL - Right To Left","hc") ?></h4>
                        <p><?php _e("Enable the right to left layout.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="rtl" data-save="checkbox" type="checkbox" <?php hc_echo_setting('rtl'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Featured image","hc") ?></h4>
                        <p><?php _e("Show the featured image on pages and post types.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="featured-image" data-save="checkbox" type="checkbox" <?php hc_echo_setting('featured-image'); ?>>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <?php hc_custom_settings("menu") ?>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Menu type","hc") ?></h4>
                        <p><?php _e("Select the menu type.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('menu-type');
                            if (strlen($tmp) == 0) $tmp = "classic";
                            ?>
                            <select id="menu-type" data-save="select">
                                <option <?php if ($tmp == "classic") echo "selected"; ?> value="classic">Classic</option>
                                <option <?php if ($tmp == "big-logo") echo "selected"; ?> value="big-logo">Big logo</option>
                                <option <?php if ($tmp == "subline") echo "selected"; ?> value="subline">Subline</option>
                                <option <?php if ($tmp == "subtitle") echo "selected"; ?> value="subtitle">Subtitle</option>
                                <option <?php if ($tmp == "middle-logo") echo "selected"; ?> value="middle-logo">Middle logo</option>
                                <option <?php if ($tmp == "middle-box") echo "selected"; ?> value="middle-box">Middle box</option>
                                <option <?php if ($tmp == "icons") echo "selected"; ?> value="icons">Icons</option>
                                <option <?php if ($tmp == "side") echo "selected"; ?> value="side">Side menu</option>
                            </select>
                        </div>
                        <img id="menu-type-preview" src="<?php echo esc_url(HC_PLUGIN_URL) . '/admin/images/menu/menu-'. esc_attr($tmp) . '.png'; ?>" />
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Menu animation","hc") ?></h4>
                        <p><?php _e("Animation on hover of menu dropdown items.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('menu-animation');
                            if (strlen($tmp) == 0) $tmp = "";
                            ?>
                            <select id="menu-animation" data-save="select">
                                <option <?php if ($tmp == "") echo "selected"; ?> value="">None</option>
                                <option <?php if ($tmp == "fade-in") echo "selected"; ?> value="fade-in">Fade in</option>
                                <option <?php if ($tmp == "fade-top") echo "selected"; ?> value="fade-top">Fade top</option>
                                <option <?php if ($tmp == "fade-bottom") echo "selected"; ?> value="fade-bottom">Fade bottom</option>
                                <option <?php if ($tmp == "fade-left") echo "selected"; ?> value="fade-left">Fade left</option>
                                <option <?php if ($tmp == "fade-right") echo "selected"; ?> value="fade-right">Fade right</option>
                                <option <?php if ($tmp == "show-scale") echo "selected"; ?> value="show-scale">Show scale</option>
                                <option <?php if ($tmp == "pulse") echo "selected"; ?> value="pulse">Pulse</option>
                                <option <?php if ($tmp == "pulse-fast") echo "selected"; ?> value="pulse-fast">Pulse fast</option>
                                <option <?php if ($tmp == "pulse-horizontal") echo "selected"; ?> value="pulse-horizontal">Pulse horizontal</option>
                                <option <?php if ($tmp == "pulse-vertical") echo "selected"; ?> value="pulse-vertical">Pulse vertical</option>
                                <option <?php if ($tmp == "slide-right-left") echo "selected"; ?> value="slide-right-left">Slide right from left</option>
                                <option <?php if ($tmp == "slide-top-bottom") echo "selected"; ?> value="slide-top-bottom">Slide bottom from top</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Transparent menu","hc") ?></h4>
                        <p><?php _e("Set transparent style for your menu.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-transparent" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-transparent'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Hamburger menu","hc") ?></h4>
                        <p><?php _e("Hamburger menu button for side menus. *Only for side menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-hamburger" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-hamburger'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Lateral dropdown","hc") ?></h4>
                        <p><?php _e("Lateral dropdown layout for side menus. *Only for side menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-lateral" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-lateral'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Wide menu","hc") ?></h4>
                        <p><?php _e("Full width menu layout. *Only for horizontal menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-wide-area" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-wide-area'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("One page","hc") ?></h4>
                        <p><?php _e("Activate it for one page and fullPage websites.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-one-page" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-one-page'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Fixed top","hc") ?></h4>
                        <p><?php _e("Menu is always visible on top. *Only for horizontal menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-fixed" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-fixed'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Search box","hc") ?></h4>
                        <p><?php _e("Show search box on right side of menu.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-search" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-search'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Search button","hc") ?></h4>
                        <p><?php _e("Show a search button on right side of menu.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-search-button" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-search-button'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Social icons","hc") ?></h4>
                        <p><?php _e("Show the social icons, you can set the icons on Social and API tab.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-social" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-social'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Centered","hc") ?></h4>
                        <p><?php _e("Set center menu.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-center" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-center'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Full width mega menu","hc") ?></h4>
                        <p><?php _e("Set full width sizes for the dropdown mega menu. *Only for horizontal menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-mega-full-width" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-mega-full-width'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Columns top padding","hc") ?></h4>
                        <p><?php _e("Top padding of the columns of the mega menu. *Only for mega menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="menu-mega-padding" type="text" data-save="text" data-mask="number" placeholder="px" value="<?php hc_echo_setting('menu-mega-padding'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("WPML Lan menu","hc") ?></h4>
                        <p><?php _e("Show the WPML language selector on the menu. You musy install and activate the WPML plugin.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-language" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-language'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Menu position","hc") ?></h4>
                        <p><?php _e("Menu position of horizontal menus. *Only for horizontal menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('menu-position');
                            if (strlen($tmp) == 0) $tmp = "left";
                            ?>
                            <select id="menu-position" data-save="select">
                                <option <?php if ($tmp == "left") echo "selected"; ?> value="left"><?php _e("Left","hc") ?></option>
                                <option <?php if ($tmp == "right") echo "selected"; ?> value="right"><?php _e("Right","hc") ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Top logo","hc") ?></h4>
                        <p><?php _e("Show the logo above the menu, on top of the page. *Only for middle logo menu.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-top-logo" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-top-logo'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Top icons","hc") ?></h4>
                        <p><?php _e("Change the icons position of icons menu from left to top. *Only for icons menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-top-icons" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-top-icons'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Custom area content","hc") ?></h4>
                        <p><?php _e("Insert every HTML you want, you can copy the code blocks of framework-y.com and paste theme here.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text-area full-input" spellcheck="false">
                            <textarea id="menu-custom-area" data-save="text"><?php hc_echo_setting('menu-custom-area') ?></textarea>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Middle box content","hc") ?></h4>
                        <p><?php _e("Insert every HTML you want, you can copy the code blocks of framework-y.com and paste theme here. *Only for middle box menus","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text-area full-input" spellcheck="false">
                            <textarea id="menu-middle-box" data-save="text"><?php hc_echo_setting('menu-middle-box') ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="item-title"><?php _e("Menu design settings","hc") ?></p>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Logo height","hc") ?></h4>
                        <p><?php _e("Set the main logo height of menu. In pixels.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="logo-height" type="text" data-save="text" placeholder="px" data-mask="number" value="<?php hc_echo_setting('logo-height'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Menu height","hc") ?></h4>
                        <p><?php _e("Set the menu height. *Only for horizontal menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="menu-height" type="text" data-save="text" placeholder="px" data-mask="number" value="<?php hc_echo_setting('menu-height'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Menu margin left","hc") ?></h4>
                        <p><?php _e("Menu margin left, use this option for centered logo menus.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="menu-margin-left" type="text" data-save="text" placeholder="px" data-mask="number" value="<?php hc_echo_setting('menu-margin-left'); ?>" />
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="item-title"><?php _e("Top mini menu","hc") ?></p>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Activate top menu","hc") ?></h4>
                        <p><?php _e("If activate the main menu show a secondary menu bar on top.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-top-area" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-top-area'); ?>>
                        </div>
                    </div>
                </div>
                <div id="top-area-options">
                    <hr />
                    <div class="row item-row">
                        <div class="col-md-6 yinfo-bar">
                            <h4><?php _e("Hide on scroll","hc") ?></h4>
                            <p><?php _e("Hide the top menu on page scroll.","hc") ?></p>
                        </div>
                        <div class="col-md-6">
                            <div class="input-checkbox input-row">
                                <input id="menu-top-scroll-hide" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-top-scroll-hide'); ?>>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row item-row">
                        <div class="col-md-6 yinfo-bar">
                            <h4><?php _e("Search box","hc") ?></h4>
                            <p><?php _e("Show the search box on right.","hc") ?></p>
                        </div>
                        <div class="col-md-6">
                            <div class="input-checkbox input-row">
                                <input id="menu-top-search" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-top-search'); ?>>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row item-row">
                        <div class="col-md-6 yinfo-bar">
                            <h4><?php _e("Social icons","hc") ?></h4>
                            <p><?php _e("Show the social icons, you can set the icons on Social and API tab.","hc") ?></p>
                        </div>
                        <div class="col-md-6">
                            <div class="input-checkbox input-row">
                                <input id="menu-top-social" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-top-social'); ?>>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row item-row">
                        <div class="col-md-6 yinfo-bar">
                            <h4><?php _e("WPML language menu","hc") ?></h4>
                            <p><?php _e("Show the WPML language selector on the menu. You musy install and activate the WPML plugin..","hc") ?></p>
                        </div>
                        <div class="col-md-6">
                            <div class="input-checkbox input-row">
                                <input id="menu-top-language" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-top-language'); ?>>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row item-row">
                        <div class="col-md-6 yinfo-bar">
                            <h4><?php _e("Custom content","hc") ?></h4>
                            <p><?php _e("Custom content of the top menu. Insert every HTML you want, you can copy the code blocks of framework-y.com and paste theme here.","hc") ?></p>
                        </div>
                        <div class="col-md-6">
                            <div class="input-text-area full-input" spellcheck="false">
                                <textarea id="menu-custom-top-area" placeholder="" data-save="text"><?php hc_echo_setting('menu-custom-top-area') ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <?php hc_custom_settings("footer") ?>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Footer type","hc") ?></h4>
                        <p><?php _e("Choose the footer type.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('footer-type');
                            if (strlen($tmp) == 0) $tmp = "base";
                            ?>
                            <select id="footer-type" data-save="select">
                                <option <?php if ($tmp == "base") echo "selected"; ?> value="base">Base</option>
                                <option <?php if ($tmp == "minimal") echo "selected"; ?> value="minimal">Minimal</option>
                                <option <?php if ($tmp == "parallax") echo "selected"; ?> value="parallax">Parallax</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Social icons","hc") ?></h4>
                        <p><?php _e("Show the social icons on the footer, you set the icons on Social and API tab.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="footer-social" data-save="checkbox" type="checkbox" <?php hc_echo_setting('footer-social'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("CSS classes","hc") ?></h4>
                        <p><?php _e("Insert the css classes to apply to the footer, separated by spaces.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row full-input">
                            <input id="footer-css" type="text" data-save="text" value="<?php hc_echo_setting('footer-css'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Footer height","hc") ?></h4>
                        <p><?php _e("Set the footer height.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row small-input">
                            <input id="footer-height" type="text" data-save="text" data-mask="number" value="<?php hc_echo_setting('footer-height'); ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Wide","hc") ?></h4>
                        <p><?php _e("Set full width footer.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="footer-wide" data-save="checkbox" type="checkbox" <?php hc_echo_setting('footer-wide'); ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Columns layout","hc") ?></h4>
                        <p><?php _e("Set the layout of the footer.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div id="footer-cols-cnt">
                            <div class="input-select input-row">
                                <?php
                                $tmp = hc_get_setting('footer-cols');
                                ?>
                                <select id="footer-cols" data-save="select">
                                    <option <?php if ($tmp == "") echo "selected"; ?> value="">3-6-3</option>
                                    <option <?php if ($tmp == "4-4-4") echo "selected"; ?> value="4-4-4">4-4-4</option>
                                    <option <?php if ($tmp == "6-3-3") echo "selected"; ?> value="6-3-3">6-3-3</option>
                                    <option <?php if ($tmp == "6-6") echo "selected"; ?> value="6-6">6-6</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Scroll top button","hc") ?></h4>
                        <p><?php _e("Show the scroll to top button on bottom right position.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('scroll-top-btn');
                            ?>
                            <select id="scroll-top-btn" data-save="select">
                                <option <?php if ($tmp == "") echo "selected"; ?> value="">None</option>
                                <option <?php if ($tmp == "mobile") echo "selected"; ?> value="mobile">Mobile</option>
                                <option <?php if ($tmp == "always") echo "selected"; ?> value="always">Always</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Footer background","hc") ?></h4>
                        <p><?php _e("Add a background image for the footer.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-box upload-row upload-box-full">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('bg-footer') ?>
                            <div class="upload-container">
                                <div id="bg-footer" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ")"; ?>'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Left area","hc") ?></h4>
                        <p><?php _e("Insert every HTML you want, you can copy the code blocks of framework-y.com and paste theme here.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <?php hc_set_footer_multilanguage($langs,"1") ?>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Center area","hc") ?></h4>
                        <p><?php _e("Insert every HTML you want, you can copy the code blocks of framework-y.com and paste theme here.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <?php hc_set_footer_multilanguage($langs,"2") ?>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Right area","hc") ?></h4>
                        <p><?php _e("Insert every HTML you want, you can copy the code blocks of framework-y.com and paste theme here.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <?php hc_set_footer_multilanguage($langs,"3") ?>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Copyright text","hc") ?></h4>
                        <p><?php _e("This text is showed as last text of the footer and is usually used for copyright texts.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <?php
                        if (function_exists('icl_object_id')) {
                            foreach ($langs as $item) {
                                $lan_code = $item['language_code'];
                        ?>
                        <div class="input-text input-row full-input">
                            <input id="footer-copyright-<?php echo $lan_code; ?>" type="text" placeholder="<?php echo strtoupper($lan_code); ?> langauge" data-save="text" value="<?php hc_echo_setting('footer-copyright-' . $lan_code); ?>" />
                        </div>
                        <?php
 }
                        } else {
                        ?>
                        <div class="input-text input-row full-input">
                            <input id="footer-copyright" type="text" data-save="text" value="<?php hc_echo_setting('footer-copyright'); ?>" />
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div class="help-row">
                    <p class="item-title">
                        <?php _e("What are the lists ?","hc") ?>
                    </p>
                    <p>
                        The lists are a new way to show your post types, post types are like the blog or the portfolio.
                        With the lists your archive page become a standard page, and like all pages, you can insert every content you need and customize it without any limitaion.
                        To show the items use the Post Type components, you can use the Grid list - Post type component or the Masonry list - Post type component.
                        To create a new list go to the Lists page.
                    </p>
                    <a class="button" href="http://wordpress.framework-y.com/documentation/lists/" target="_blank">Documentation</a>
                </div>
                <p class="item-title">
                    <?php _e("Blog","hc") ?>
                </p>
                <?php hc_custom_settings("lists") ?>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Blog page","hc") ?></h4>
                        <p><?php _e("Select the page of your blog archive. To show the items edit the page and insert the Grid list - Post type component or the Masonry list - Post type component.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('blog-page');
                            $tmp_2 = get_pages();
                            $html = "";
                            ?>
                            <select id="blog-page" data-save="select">
                                <option value="">--</option>
                                <?php
                                for ($i = 0; $i < count($tmp_2); $i++) {
                                    $html .= '<option value="' . esc_attr($tmp_2[$i]->ID) . '" '.  esc_attr((($tmp==$tmp_2[$i]->ID) ? 'selected':'')) . '>' . esc_attr($tmp_2[$i]->post_title) . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Blog options","hc") ?></h4>
                        <p><?php _e("All the options are provided by the components.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            To set all the options of your blog archive use the options of the Grid list or Masonry list components.
                            These components allow you to set pagination types, numbers of items, box design, box type, informations to display, categories, filters and many more.
                        </p>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="help-row">
                    <p class="item-title">
                        <?php _e("Add new list","hc") ?>
                    </p>
                    <p>
                        To add a new list go the to list page, insert the names of the list, create the single item template and you're done.
                        You can show the items with the Lists - Post type components of Hybrid Composer.
                    </p>
                    <a class="button" href="<?php echo esc_attr(HC_SITE_URL) . "/wp-admin/edit.php?post_type=y-post-types"; ?>"><?php _e("Add new list now","hc") ?></a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Shop menu","hc") ?></h4>
                        <p><?php _e("Show the cart menu of Woocommerce shop on main header.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="menu-shop" data-save="checkbox" type="checkbox" <?php hc_echo_setting('menu-shop'); ?>>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Shop sidebar","hc") ?></h4>
                        <p><?php _e("Select the sidebar for shop archive page, set the sidebar contents on Apparence > Widgets","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php $tmp = hc_get_setting('woocommerce-sidebar-shop'); ?>
                            <select id="woocommerce-sidebar-shop" data-save="select">
                                <option <?php if ($tmp == "") echo "selected"; ?> value="">None</option>
                                <option <?php if ($tmp == "right") echo "selected"; ?> value="right">Right</option>
                                <option <?php if ($tmp == "left") echo "selected"; ?> value="left">Left</option>
                                <option <?php if ($tmp == "right-left") echo "selected"; ?> value="right-left">Right and left</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Product sidebar","hc") ?></h4>
                        <p><?php _e("Select the sidebar for single product item of the shop, set the sidebar contents on Apparence > Widgets","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php $tmp = hc_get_setting('woocommerce-sidebar-single'); ?>
                            <select id="woocommerce-sidebar-single" data-save="select">
                                <option <?php if ($tmp == "") echo "selected"; ?> value="">None</option>
                                <option <?php if ($tmp == "right") echo "selected"; ?> value="right">Right</option>
                                <option <?php if ($tmp == "left") echo "selected"; ?> value="left">Left</option>
                                <option <?php if ($tmp == "right-left") echo "selected"; ?> value="right-left">Right and left</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Shop page","hc") ?></h4>
                        <p><?php _e("Select the main shop page if it's different from the default Woocommerce shop archive page.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('shop-page');
                            $tmp_2 = get_pages();
                            $html = "";
                            ?>
                            <select id="shop-page" data-save="select">
                                <option value="">--</option>
                                <?php
                                for ($i = 0; $i < count($tmp_2); $i++) {
                                    $html .= '<option value="' . esc_attr($tmp_2[$i]->ID) . '" '.  esc_attr((($tmp==$tmp_2[$i]->ID) ? 'selected':'')) . '>' . esc_attr($tmp_2[$i]->post_title) . '</option>';
                                }
                                echo $html;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div class="help-row">
                    <p>
                        Set here the title type and design that is applied to auto-generated pages like the woocommerce product page, search page, or any other page generated by external plugins.
                    </p>
                </div>
                <hr class="space s" />
                <?php hc_custom_settings("titles") ?>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Title type","hc") ?></h4>
                        <p><?php _e("Select the title type.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('title-type',"base");
                            ?>
                            <select id="title-type" data-save="select">
                                <option <?php if ($tmp == "image") echo "selected"; ?> value="image">Image background</option>
                                <option <?php if ($tmp == "slider") echo "selected"; ?> value="slider">Images slider</option>
                                <option <?php if ($tmp == "video") echo "selected"; ?> value="video">Video background</option>
                                <option <?php if ($tmp == "base") echo "selected"; ?> value="base">Base</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Title background","hc") ?></h4>
                        <p><?php _e("Add a background image for the title. All title types support background image, video type can require it for mobile. Title slider support up to 3 images.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-box upload-row upload-box-full">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('title-image') ?>
                            <div class="upload-container">
                                <div id="title-image" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ")"; ?>'></div>
                            </div>
                        </div>
                        <div class="upload-box upload-row upload-box-full">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('title-image-2') ?>
                            <div class="upload-container">
                                <div id="title-image-2" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ")"; ?>'></div>
                            </div>
                        </div>
                        <div class="upload-box upload-row upload-box-full">
                            <span class="close-button"></span>
                            <?php $tmp = hc_get_setting('title-image-3') ?>
                            <div class="upload-container">
                                <div id="title-image-3" class="upload-btn <?php if (strlen($tmp) > 0) echo "setted"?>" data-save="upload" style='<?php if (strlen($tmp) > 0) echo "background-image:url(" . esc_attr($tmp) . ")"; ?>'></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Video background","hc") ?></h4>
                        <p><?php _e("Set background video. *Supported only for video title type.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="upload-link upload-row full-input">
                            <input id="title-video" placeholder="<?php _e("Youtube or MP4 video link","hc") ?>" type="text" value="<?php hc_echo_setting('title-video'); ?>" />
                            <a class="input-button input-row"><?php _e("Upload","hc") ?></a>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Parallax","hc") ?></h4>
                        <p><?php _e("Set parallax effect for the title background.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="title-parallax" data-save="checkbox" type="checkbox" <?php hc_echo_setting('title-parallax'); ?>>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Ken-burn effect","hc") ?></h4>
                        <p><?php _e("Set the ken-burn animation. *Supported only for image title with parallax active.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('title-ken-burn');
                            ?>
                            <select id="title-ken-burn" data-save="select">
                                <option value="" <?php if ($tmp == "image") echo "selected"; ?>><?php _e("None","hc") ?></option>
                                <option value="ken-burn" <?php if ($tmp == "ken-burn") echo "selected"; ?>><?php _e("Zoom in","hc") ?></option>
                                <option value="ken-burn-out" <?php if ($tmp == "ken-burn-out") echo "selected"; ?>><?php _e("Zoom out","hc") ?></option>
                                <option value="ken-burn-center" <?php if ($tmp == "ken-burn-center") echo "selected"; ?>><?php _e("Zoom centered","hc") ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Full screen","hc") ?></h4>
                        <p><?php _e("Set the height of the title to full screen size.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="title-fullscreen" data-save="checkbox" type="checkbox" <?php hc_echo_setting('title-fullscreen'); ?>>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Overlay","hc") ?></h4>
                        <p><?php _e("Add a overlay pattern over the title background.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-select input-row">
                            <?php
                            $tmp = hc_get_setting('title-overlay');
                            ?>
                            <select id="title-overlay" data-save="select">
                                <option value="">None</option>
                                <option <?php if ($tmp == "dotted") echo "selected"; ?> value="dotted">Dotted</option>
                                <option <?php if ($tmp == "line-45") echo "selected"; ?> value="line-45">Line 45</option>
                                <option <?php if ($tmp == "carbonio") echo "selected"; ?> value="carbonio">Carbonio</option>
                                <option <?php if ($tmp == "tile") echo "selected"; ?> value="tile">Tile</option>
                                <option <?php if ($tmp == "transparent-dark") echo "selected"; ?> value="transparent-dark">Transparent dark</option>
                                <option <?php if ($tmp == "transparent-light") echo "selected"; ?> value="transparent-light">Transparent light</option>
                                <option <?php if ($tmp == "tv") echo "selected"; ?> value="tv">Tv</option>
                                <option <?php if ($tmp == "squares") echo "selected"; ?> value="squares">Squares</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Titles","hc") ?></h4>
                        <p><?php _e("Set the titles and subtitles for the various pages.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row full-input">
                            <input id="title-shop" type="text" data-save="text" placeholder="<?php _e("Woocommerce shop title","hc") ?>" value="<?php hc_echo_setting('title-shop') ?>">
                        </div>
                        <div class="input-text input-row full-input">
                            <input id="subtitle-shop" type="text" data-save="text" placeholder="<?php _e("Woocommerce shop subtitle","hc") ?>" value="<?php hc_echo_setting('subtitle-shop') ?>">
                        </div>
                        <div class="input-text input-row full-input">
                            <input id="title-search" type="text" data-save="text" placeholder="<?php _e("Search page title","hc") ?>" value="<?php hc_echo_setting('title-search') ?>">
                        </div>
                        <div class="input-text input-row full-input">
                            <input id="subtitle-search" type="text" data-save="text" placeholder="<?php _e("Search page subtitle","hc") ?>" value="<?php hc_echo_setting('subtitle-search') ?>">
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <?php hc_custom_settings("customizations") ?>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Javascript global","hc") ?></h4>
                        <p><?php _e("Javascript block loaded in every page. Insert the code without <script></script> tags. Use '' for text values.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text-area" spellcheck="false">
                            <textarea id="js-global" data-save="raw-text" placeholder="<?php _e("","hc") ?>"><?php hc_echo_setting('js-global') ?></textarea>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("CSS global","hc") ?></h4>
                        <p><?php _e("CSS block loaded in every page.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text-area" spellcheck="false">
                            <textarea id="css-global" data-save="text"><?php hc_echo_setting('css-global') ?></textarea>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Custom css","hc") ?></h4>
                        <p><?php _e("If activated a custom.css file is created into the custom folder of theme root and loaded in every page of your website.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="custom-css" data-save="checkbox" type="checkbox" <?php if (file_exists(HC_PLUGIN_PATH . '/custom/custom.css')) echo "checked"; ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Custom javascript","hc") ?></h4>
                        <p><?php _e("If activated a custom.js file is created into custom folder of theme root and loaded in every page of your website.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="custom-js" data-save="checkbox" type="checkbox" <?php if (file_exists(HC_PLUGIN_PATH . '/custom/custom.js')) echo "checked"; ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Custom php","hc") ?></h4>
                        <p><?php _e("If activated a custom.php file is created into custom folder of theme root and loaded in every page of your website.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-checkbox input-row">
                            <input id="custom-php" data-save="checkbox" type="checkbox" <?php if (file_exists(HC_PLUGIN_PATH . '/custom/custom.php')) echo "checked"; ?>>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Export settings","hc") ?></h4>
                        <p><?php _e("Export all settings of your website in a json file.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div id="submit_export_settings" class="button button-large">Export settings</div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Import settings","hc") ?></h4>
                        <p><?php _e("Import settings by paste here the text of demo json file or your exported json file.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text-area" spellcheck="false">
                            <textarea name="demo_settings_string" id="demo_settings_string"></textarea>
                        </div>
                        <input name="submit_import_dmeo" type="submit" value="Import now" id="submit_import_dmeo" class="button button-large" />
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Clear LocalStorage","hc") ?></h4>
                        <p><?php _e("LocalStorage is used for Hybrid Composer cache and for the Copy and paste feature, when it's full these functionality stop to work and you need to click this button.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div onclick="localStorage.clear();" class="button button-large">Clear LocalStorage</div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <?php hc_custom_settings("social") ?>
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Social channels","hc") ?></h4>
                        <p><?php _e("Insert the links to your social channels account and pages.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="social-admin">
                            <div class="input-text input-row full-input">
                                <p>Facebook</p>
                                <input id="social-fb" type="text" data-save="text" value="<?php hc_echo_setting('social-fb'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Twitter</p>
                                <input id="social-tw" type="text" data-save="text" value="<?php hc_echo_setting('social-tw'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Youtube</p>
                                <input id="social-yt" type="text" data-save="text" value="<?php hc_echo_setting('social-yt'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Instagram</p>
                                <input id="social-ig" type="text" data-save="text" value="<?php hc_echo_setting('social-ig'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Pinterest</p>
                                <input id="social-pi" type="text" data-save="text" value="<?php hc_echo_setting('social-pi'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Linked-in</p>
                                <input id="social-in" type="text" data-save="text" value="<?php hc_echo_setting('social-in'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Google+</p>
                                <input id="social-g+" type="text" data-save="text" value="<?php hc_echo_setting('social-g+'); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("SMTP Email","hc") ?></h4>
                        <p><?php _e("Insert the SMTP informations to allow the contact form component to send messages with your server. The sender email should use the same @domain of the server.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="social-admin">
                            <div class="input-text input-row full-input">
                                <p>Host</p>
                                <input id="smtp-host" type="text" data-save="text" value="<?php hc_echo_setting('smtp-host'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Username</p>
                                <input id="smtp-username" type="text" data-save="text" value="<?php hc_echo_setting('smtp-username'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Password</p>
                                <input id="smtp-psw" type="text" data-save="text" value="<?php hc_echo_setting('smtp-psw'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Port</p>
                                <input id="smtp-port" type="text" data-save="text" placeholder="465" value="<?php hc_echo_setting('smtp-port'); ?>" />
                            </div>
                            <div class="input-text input-row full-input">
                                <p>Email from</p>
                                <input id="smtp-email" type="text" data-save="text" value="<?php hc_echo_setting('smtp-email'); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Google maps key","hc") ?></h4>
                        <p><?php _e("Insert the Google maps API key, you can get a new key from developers.google.com/maps.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row full-input">
                            <input id="google-api-key" type="text" data-save="text" value="<?php hc_echo_setting('google-api-key') ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Twitter consumer key","hc") ?></h4>
                        <p><?php _e("Your twitter app consumer key. Go to http://dev.twitter.com/apps and create a new app and get the keys.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row full-input">
                            <input id="twitter-consumer-key" type="text" data-save="text" value="<?php hc_echo_setting('twitter-consumer-key') ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Twitter consumer secret","hc") ?></h4>
                        <p><?php _e("Your twitter app consumer secret.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row full-input">
                            <input id="twitter-consumer-secret" type="text" data-save="text" value="<?php hc_echo_setting('twitter-consumer-secret') ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Twitter access token","hc") ?></h4>
                        <p><?php _e("Your twitter app access token.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row full-input">
                            <input id="twitter-access-token" type="text" data-save="text" value="<?php hc_echo_setting('twitter-access-token') ?>" />
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row item-row">
                    <div class="col-md-6 yinfo-bar">
                        <h4><?php _e("Twitter access secret","hc") ?></h4>
                        <p><?php _e("Your twitter app access secret key.","hc") ?></p>
                    </div>
                    <div class="col-md-6">
                        <div class="input-text input-row full-input">
                            <input id="twitter-access-secret" type="text" data-save="text" value="<?php hc_echo_setting('twitter-access-secret') ?>" />
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div id="demo-panel">
                    <div id="import-progress" class="import-progress">
                        <i class="icon-spin-alt rotate"></i>
                        <span><?php _e("Demo importing in progress, please wait up to 5 minutes","hc") ?></span>
                    </div>
                    <div id="import-download" class="import-progress">
                        <i class="icon-spin-alt rotate"></i>
                        <span><?php _e("We're downloading the demo files","hc") ?></span>
                    </div>
                    <div class="pgr-status">
                    </div>
                    <div id="y-demos">
                        <div class="row">
                            <?php hc_demos() ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <div id="demo-manual">
                    <span onclick="$('#demo-manual > div').show(); $(this).hide()"><?php _e("Problems ?","hc") ?></span>
                    <div>
                        <h4>Manual importing</h4>
                        <p>
                            If the demo installation not work the most common cause is a file permission issue.
                            To solve the problem contact the support to get the demo.zip package, upload it with FTP into the folder /wp-content/uploads/ of your website and press the button below.
                        </p>
                        <div id="submit_demo_manual" class="button button-large">Start importing</div>
                    </div>
                </div>
                <div id="y-demo-start">
                    <div class="result-box">
                        <div class="notice notice-warning">
                            <p><?php _e("Install and activate Hybrid Composer and the other required plugins before start the demo importing.","hc") ?></p>
                        </div>
                    </div>
                    <p></p>
                    <div id="submit_import_demo" class="button button-large"><?php _e("Yes import now","hc") ?></div>
                    <div id="submit_import_demo_exit" title="Back to demos" class="button button-large">X</div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div>
        <div class="clear"></div>
        <input id="submit_save" name="submit_save" type="submit" value="<?php _e("SAVE ALL SETTINGS","hc") ?>" class="button button-primary button-large" />
    </div>
    <input type="hidden" name="framework_y_settings" id="framework_y_settings" value="" />
</form>
<div class="clear"></div>
