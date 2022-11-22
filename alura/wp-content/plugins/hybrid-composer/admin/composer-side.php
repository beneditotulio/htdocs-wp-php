<?php
/*
 * =============================================================================
 * COMPOSER-SIDE.PHP
 * -----------------------------------------------------------------------------
 * Hybrid Composer side contents.
 * =============================================================================
 *
 * HYBRID COMPOSER META BOX
 * -----------------------------------------------------------------------------
 * Hybrid Composer meta box for admin pages
 * =============================================================================
 */
function hc_block_composer_side() {
    $post_id = "";
    if (isset($_GET['post'])) $post_id =  $_GET['post'];
?>
<div class="hc-co-box">
    <div id="mode_button_hc" title="Editor mode" class="input-row small-input input-select button">
        <select class="select-mode-button-hc">
            <option value="composer" selected><?php esc_attr_e("Composer","hc") ?></option>
            <option value="classic"><?php esc_attr_e("Classic","hc") ?></option>
        </select>
    </div>
    <a id="lock_button_hc" title="Locked mode" class="button lock-button-hc float-right btn-icon-only" onclick=""><i class="icon-unlock"></i></a>
    <a id="update_button_hc" title="Composer content" class="button float-right btn-icon-only" onclick="showPageContentArr()"><i class="icon-code-fork"></i></a>
    <a id="css_button_hc" title="Page CSS" class="button float-right btn-icon" onclick="showPageCSSbox()"><i class="icon-css3"></i>CSS</a>
    <a id="composer_templates_button_hc" title="Composer templates" class="button float-right btn-icon" onclick="showComposerTemplatesBox()"><i class="icon-folder-open"></i><?php esc_attr_e("Templates","hc") ?></a>
    <a id="composer_clear_cache" title="Clear page cache and reload" class="button float-right btn-icon-only" onclick="window.location = window.location.href + '&hc=cache' "><i class="icon-android-sync"></i></a>
</div>
<div class="clear"></div>
<div id="css-code-box" class="box-lightbox l">
    <div class="popover-title" style="border: none;">
        <h4>CSS</h4>
        <a class="button button-primary float-right" style="margin-left: 15px" onclick="$('.mfp-close').click();">X</a>
        <a class="button button-2 button-primary float-right" onclick="$('#css-page').val($('#css-code-box textarea').val()); $('.mfp-close').click();"><?php esc_attr_e("Save changes","hc") ?></a>
    </div>
    <div class="input-row full-input only-input">
        <textarea spellcheck="false" placeholder=""></textarea>
    </div>
</div>
<div id="composer-templates-box" class="box-lightbox l">
    <div class="popover-title">
        <h4><?php _e("Composer Templates","hc") ?></h4>
        <a class="button button-primary float-right" style="margin-left: 15px" onclick="$('.mfp-close').click();">X</a>
    </div>
    <div class="tab-box">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#"><?php esc_attr_e("My Templates","hc") ?></a></li>
            <li><a href="#"><?php esc_attr_e("Built-in Templates","hc") ?></a></li>
        </ul>
        <div class="panel active">
            <div class="scroll-content" data-height="350">
                <div class="save-template-box">
                    <div class="result-box">
                    </div>
                    <p><b><?php esc_attr_e("Save current page as a template","hc") ?></b></p>
                    <div class="flex-box">
                        <input id="current-page-template-name" class="full-input" placeholder="<?php esc_attr_e("Template name","hc") ?>" type="text" value="" />
                        <a class="button button-primary float-right" onclick="saveHCTemplate($('#current-page-template-name').val())"><?php esc_attr_e("Save template","hc") ?></a>
                    </div>
                    <hr class="space xs" />
                    <p><b><?php esc_attr_e("My Templates","hc") ?></b></p>
                    <ul id="hc_templates_list" class="list buttons-list"></ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="scroll-content" data-height="400">
                <ul id="hc_default_templates_list" class="list buttons-list">
                    <?php
                    $html = "";
                    if (file_exists(HC_PLUGIN_PATH . '/custom/templates.php')) {
                       include(HC_PLUGIN_PATH . "/custom/templates.php");
                       if (isset($HC_TEMPLATES)) {
                           foreach($HC_TEMPLATES as $key => $value) {
                               $name = ucfirst(str_replace("_", " ",$key));
                               $html .= '<li class="li-component"><div class="component-box" data-hc-target="' . $key . '"><span class="sch">' . $name . '</span></div></li>';
                           }
                       }
                    }
                    if ($html != "") echo $html;
                    else echo "<div style='padding-left: 3px;'>" . __("No templates available.") . "</div>";
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="page-code-box" class="box-lightbox l">
    <pre class="scroll-content prettyprint" data-height="300"></pre>
    <br />
    <br />
    <a class="button button-primary float-right" style="margin-left: 15px" onclick="$('.mfp-close').click();">X</a>
    <a class="button button-primary float-right" onclick="$('.wp-editor-area').val('')"><?php _e("Delete all content","hc") ?></a>
    <br />
    <br />
</div>
<div id="popover-box-page-settings" class="popover-box popover-box-big popover-list box-lightbox l">
    <span class="close-button" onclick="jQuery('.mfp-close').click();"></span>
    <div class="popover-title">
        <h4><?php _e("Page options","hc") ?></h4>
    </div>
    <div class="scroll-content settings-cnt" data-height="400">
        <input type="hidden" class="save_array_json" value='<?php if (isset($post_id)) echo str_replace('\\"','"', get_option("hc-page-settings-" . $post_id)) ?>'>
        <hr class="space s" />
        <ul class="list">
            <li class="input-row input-select">
                <p>Menu type</p>
                <select data-setting="menu-type">
                    <option value="">Default</option>
                    <option value="classic">Classic</option>
                    <option value="big-logo">Big logo</option>
                    <option value="subline">Subline</option>
                    <option value="subtitle">Subtitle</option>
                    <option value="middle-logo">Middle logo</option>
                    <option value="middle-box">Middle box</option>
                    <option value="icons">Icons</option>
                    <option value="side">Side menu</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Menu position</p>
                <select data-setting="menu-position">
                    <option value="">Default</option>
                    <option value="left">Left</option>
                    <option value="right">Right</option>
                </select>
            </li>
            <li class="input-row input-checkbox">
                <p>Hide menu</p>
                <input data-setting="menu-hide" type="checkbox">
            </li>
            <li class="input-row input-select">
                <p>Menu language</p>
                <select data-setting="menu-language">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Search box</p>
                <select data-setting="menu-search">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Search button</p>
                <select data-setting="menu-search-button">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-text">
                <p>Menu css classes</p>
                <input data-setting="menu-css" placeholder="" type="text">
            </li>
            <li class="input-row input-select">
                <p>Menu transparent</p>
                <select data-setting="menu-transparent">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Wide menu</p>
                <select data-setting="menu-wide-area">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Centered menu</p>
                <select data-setting="menu-center">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Top logo</p>
                <select data-setting="menu-top-logo">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Top menu</p>
                <select data-setting="menu-top-area">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Menu fixed top</p>
                <select data-setting="menu-fixed">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Wide footer</p>
                <select data-setting="footer-wide">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
            <li class="input-row input-checkbox">
                <p>Hide footer</p>
                <input data-setting="footer-hide" type="checkbox">
            </li>
            <li class="input-row input-text">
                <p>Footer css classes</p>
                <input data-setting="footer-css" placeholder="" type="text">
            </li>
            <li class="input-row input-select">
                <p>Layout</p>
                <select data-setting="layout-type">
                    <option value="">Default</option>
                    <option value="full-width">Full width</option>
                    <option value="boxed">Boxed</option>
                </select>
            </li>
            <li class="input-row input-text">
                <p>Site width</p>
                <input data-setting="site-width" placeholder="" type="text">
            </li>
            <li class="input-row input-text">
                <p>Full width padding X</p>
                <input data-setting="section-padding-x" placeholder="" type="text">
            </li>
            <li class="input-row input-text">
                <p>Full width padding Y</p>
                <input data-setting="section-padding-y" placeholder="" type="text">
            </li>
            <li class="input-row input-select">
                <p>Left sidebar width</p>
                <select id="sidebar-left-width">
                    <option value="">Default</option>
                    <option value="col-md-2">20% col-md-2</option>
                    <option value="col-md-3">25% col-md-3</option>
                    <option value="col-md-4">33% col-md-4</option>
                    <option value="col-md-5">41% col-md-5</option>
                    <option value="col-md-6">50% col-md-6</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>Right sidebar width</p>
                <select id="sidebar-right-width">
                    <option value="">Default</option>
                    <option value="col-md-2">20% col-md-2</option>
                    <option value="col-md-3">25% col-md-3</option>
                    <option value="col-md-4">33% col-md-4</option>
                    <option value="col-md-5">41% col-md-5</option>
                    <option value="col-md-6">50% col-md-6</option>
                </select>
            </li>
            <li class="input-row input-select">
                <p>RTL - Right To Left</p>
                <select data-setting="rtl">
                    <option value="">Default</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </li>
        </ul>
        <hr class="space s" />
        <a class="button button-primary settings-save-btn" onclick="indipendentSaveSystem(this, ''); jQuery('.mfp-close').click();"><?php _e("Save settings","hc") ?></a>
    </div>
    <div class="clear"></div>
</div>
<?php
 }
// HYBRID COMPOSER TEMPLATE META BOX
// -----------------------------------------------------------------------------
// Hybrid Composer meta box for admin pages with templates
// =============================================================================
function hc_block_templates_meta_boxes() {
    global $post;
    $template_name = get_page_template_slug($post->ID);
    echo "<div class='template_setting_cnt' data-hc-id='settings'>";
    if ($template_name == "template-background-slider.php") {
?>
<div class="input-text input-row full-input">
    <p><?php esc_attr_e("Speed","hc") ?></p>
    <input data-hc-setting="speed" class="input-link" placeholder="7000ms" type="text" value="7000" data-mask="number">
</div>
<input type="hidden" class="file_require" value="flexslider">
<?php
 }
    if ($template_name == "template-twosides.php") {
?>
<input type="hidden" class="file_require" value="twosides">
<div class="input-text input-row full-input">
    <p><?php esc_attr_e("Center offset","hc") ?></p>
    <input data-hc-setting="center_offset" class="input-link" placeholder="+-0" type="text" value="">
</div>
<?php
  }
    if ($template_name == "template-fullpage.php") {
?>
<input type="hidden" class="file_require" value="fullpage">
<input type="hidden" class="file_require" value="popover">
<div class="input-row full-input input-select">
    <p><?php esc_attr_e("Menu style","hc") ?></p>
    <select data-hc-setting="menu_style">
        <option value="">--</option>
        <option value="icon" selected><?php esc_attr_e("Icon","hc") ?></option>
        <option value="icon_text"><?php esc_attr_e("Icon text","hc") ?></option>
        <option value="dots"><?php esc_attr_e("Dots","hc") ?></option>
        <option value="classic"><?php esc_attr_e("Classic","hc") ?></option>
        <option value="none"><?php esc_attr_e("None","hc") ?></option>
    </select>
</div>
<div class="input-row full-input input-select">
    <p><?php esc_attr_e("Menu position","hc") ?></p>
    <select data-hc-setting="menu_position">
        <option value="" selected><?php esc_attr_e("Right","hc") ?></option>
        <option value="left"><?php esc_attr_e("Left","hc") ?></option>
    </select>
</div>
<div class="input-row input-select full-input">
    <p><?php esc_attr_e("Menu logo","hc") ?></p>
    <select data-hc-setting="menu_logo">
        <option value="" selected><?php esc_attr_e("None","hc") ?></option>
        <option value="scroll"><?php esc_attr_e("On scroll","hc") ?></option>
        <option value="visible"><?php esc_attr_e("Visible","hc") ?></option>
    </select>
</div>
<div class="input-row input-select full-input">
    <p><?php esc_attr_e("Arrows","hc") ?></p>
    <select data-hc-setting="arrows" data-dependence-trigger="hide">
        <option value="none" selected><?php esc_attr_e("None","hc") ?></option>
        <option value="next"><?php esc_attr_e("Next only","hc") ?></option>
        <option value="all"><?php esc_attr_e("Next and previous","hc") ?></option>
    </select>
</div>
<div class="input-text input-row full-input" data-dependence-show="arrows_none">
    <p><?php esc_attr_e("Arrow text 1","hc") ?></p>
    <input data-hc-setting="arrow_text_1" class="input-link" placeholder="<?php esc_attr_e("Back","hc") ?>" type="text" value="">
</div>
<div class="input-text input-row full-input" data-dependence-show="arrows_none">
    <p><?php esc_attr_e("Arrow text 2","hc") ?></p>
    <input data-hc-setting="arrow_text_2" class="input-link" placeholder="<?php esc_attr_e("Next","hc") ?>" type="text" value="">
</div>
<div class="input-row input-select full-input" data-dependence-show="arrows_none">
    <p><?php esc_attr_e("Arrows position","hc") ?></p>
    <select data-hc-setting="arrows_position">
        <option value="" selected><?php esc_attr_e("Center","hc") ?></option>
        <option value="right"><?php esc_attr_e("Right","hc") ?></option>
        <option value="left"><?php esc_attr_e("Left","hc") ?></option>
    </select>
</div>
<div class="input-row input-select full-input" data-dependence-show="arrows_none">
    <p><?php esc_attr_e("Arrows style","hc") ?></p>
    <select data-hc-setting="arrows_style">
        <option value="" selected><?php esc_attr_e("Default","hc") ?></option>
        <option value="arrow-circle"><?php esc_attr_e("Circle","hc") ?></option>
    </select>
</div>
<div class="flex-box">
    <div class="input-row input-checkbox">
        <p><?php esc_attr_e("Single bg","hc") ?></p>
        <input class="fullpage-single-bg-btn" id="fullpage-single-bg" data-hc-setting="single_background" type="checkbox">
    </div>
    <div class="input-row input-checkbox">
        <p><?php esc_attr_e("Hide header","hc") ?></p>
        <input data-hc-setting="hide_header" type="checkbox">
    </div>
</div>
<div class="flex-box">
    <div class="input-row input-checkbox">
        <p><?php esc_attr_e("Footer","hc") ?></p>
        <input data-hc-setting="footer" type="checkbox">
    </div>
    <div class="input-text input-row full-input">
        <p><?php esc_attr_e("Offset","hc") ?></p>
        <input data-hc-setting="center_offset" class="input-link" placeholder="+-0" type="text" value="">
    </div>
</div>
<div class="input-row full-input input-select">
    <p><?php esc_attr_e("Direction","hc") ?></p>
    <select data-hc-setting="direction">
        <option value="" selected><?php esc_attr_e("Vertical","hc") ?></option>
        <option value="horizontal"><?php esc_attr_e("Horizontal","hc") ?></option>
    </select>
</div>
<a class="input-row button-icon-text" style="text-align: center" data-hc-setting="data_options" data-hc-component="value" data-value="" data-default-values="" href="#popover-box-full-page" data-pos="top left">
    <i class="icon-gear-setting-2"></i>
</a>
<?php } ?>
<?php
    echo "</div><div class='template_meta_boxes_cnt'>";
    if ($template_name == "template-background-image.php") {
?>
<div data-hc-id="template_image" data-hc-component="hc_upload_image">
    <div class="upload-box upload-row full-input">
        <span class="close-button"></span>
        <div class="upload-container">
            <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
        </div>
    </div>
</div>
<?php
    }
    if ($template_name == "template-background-slider.php") {
?>
<div data-hc-id="template_slider" data-hc-component="hc_upload_img_multi">
    <div class="upload-box upload-multi upload-row upload-justified" data-hc-setting="slides" data-hc-id="slides" data-hc-container="repeater">
        <span class="close-button"></span>
        <div class="upload-container upload-add">
            <div data-hc-component="upload" class="upload-btn"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<?php
    }
    if ($template_name == "template-background-video.php") {
?>
<div data-hc-id="template_video" data-hc-component="hc_upload_video">
    <div class="input-text input-row link-field link-simple">
        <input data-hc-setting="link" class="input-link" placeholder="<?php esc_attr_e("Video link","hc") ?>" type="text" value="">
        <i class="button-icon input-row upload-hc-button icon-link" data-value=""></i>
    </div>
    <div class="upload-box upload-row full-input">
        <span class="close-button"></span>
        <div class="upload-container">
            <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
        </div>
    </div>
</div>
<?php } ?>
<div class="button button-full" id="hc-page-lightbox" onclick="showPageLightbox()">Lightbox</div>
<hr class="space xs" />
<div class="button button-full" id="hc-page-popup" onclick="showPagePopup()">Popup</div></div>
<div id="popover-box-page-lightbox" class="popover-box popover-box-big popover-list box-lightbox m">
    <span class="close-button" onclick="jQuery('.mfp-close').click();"></span>
    <div class="popover-title">
        <h4><?php _e("Lightbox","hc") ?></h4>
    </div>
    <div class="scroll-content settings-cnt" data-height="400">
        <input type="hidden" id="page-lightbox" class="save_array_json" value=''>
        <hr class="space s" />
        <ul class="list">
            <li class="input-row input-checkbox">
                <p>Active</p>
                <input data-setting="active" type="checkbox">
            </li>
            <li class="input-text-area input-row full-input">
                <p>Content</p>
                <textarea data-setting="content" style="overflow-x: hidden; word-wrap: break-word; resize: none; overflow-y: visible;"></textarea>
            </li>
            <li class="input-row full-input">
                <p><?php _e("Link","hc") ?></p>
                <input data-setting="link" class="input-link" type="text" value="" />
            </li>
            <li class="upload-box upload-row input-row upload-mini full-input upload-fixed">
                <p><?php _e("Image","hc") ?></p>
                <span class="close-button" style="display: none;"></span>
                <div class="upload-container">
                    <div data-setting="media_link" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                </div>
            </li>
            <li class="input-row input-checkbox">
                <p><?php _e("New window","hc") ?></p>
                <input data-setting="new_window" type="checkbox">
            </li>
            <li class="input-row input-select">
                <p><?php _e("Lightbox size","hc") ?></p>
                <select data-setting="lightbox_size">
                    <option value="s"><?php _e("Small","hc") ?></option>
                    <option selected="selected" value=""><?php _e("Medium","hc") ?></option>
                    <option value="l"><?php _e("Large","hc") ?></option>
                    <option value="full-screen-size"><?php _e("Full screen","hc") ?></option>
                </select>
            </li>
            <li class="input-row input-text">
                <p><?php _e("Expiration","hc") ?></p>
                <input data-setting="expire" placeholder="0 days" type="text" data-mask="number">
            </li>
            <li class="input-row input-select">
                <p><?php _e("Animation","hc") ?></p>
                <select data-setting="animation" class="animations-list">
                    <option selected="selected" value="">None</option>
                    <option value="fade-in">Fade in</option>
                    <option value="fade-left">Fade left</option>
                    <option value="fade-right">Fade right</option>
                    <option value="fade-top">Fade top</option>
                    <option value="fade-bottom">Fade bottom</option>
                    <option value="show-scale">Show scale</option>
                    <option value="scale-rotate">Scale rotate</option>
                    <option value="pulse">Pulse</option>
                    <option value="pulse-fast">Pulse fast</option>
                    <option value="pulse-horizontal">Pulse horizontal</option>
                    <option value="pulse-vertical">Pulse vertical</option>
                </select>
            </li>
        </ul>
        <hr class="space s" />
        <a class="button button-primary settings-save-btn" onclick="indipendentSaveSystem(this, ''); jQuery('.mfp-close').click();"><?php _e("Save","hc") ?></a>
    </div>
    <div class="clear"></div>
</div>
<div id="popover-box-page-popup" class="popover-box popover-box-big popover-list box-lightbox m">
    <span class="close-button" onclick="jQuery('.mfp-close').click();"></span>
    <div class="popover-title">
        <h4><?php _e("Popup","hc") ?></h4>
    </div>
    <div class="scroll-content settings-cnt" data-height="420">
        <input type="hidden" id="page-popup" class="save_array_json" value=''>
        <hr class="space s" />
        <ul class="list">
            <li class="input-row input-checkbox">
                <p>Active</p>
                <input data-setting="active" type="checkbox">
            </li>
            <li class="input-row input-text full-input">
                <p><?php _e("Title","hc") ?></p>
                <input data-setting="title" type="text">
            </li>
            <li class="input-text-area input-row full-input">
                <p><?php _e("Main text","hc") ?></p>
                <textarea data-setting="text"></textarea>
            </li>
            <li class="input-row full-input">
                <p><?php _e("Link","hc") ?></p>
                <input data-setting="link" class="input-link" type="text" value="" />
            </li>
            <li class="upload-box upload-row input-row upload-mini full-input upload-fixed">
                <p><?php _e("Image","hc") ?></p>
                <span class="close-button" style="display: none;"></span>
                <div class="upload-container">
                    <div data-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                </div>
            </li>
            <li class="input-row input-checkbox">
                <p><?php _e("Full width","hc") ?></p>
                <input data-setting="full_width" type="checkbox">
            </li>
            <li class="input-row input-select">
                <p><?php _e("Position","hc") ?></p>
                <select data-setting="position">
                    <option value="bottom-right"><?php _e("Bottom right","hc") ?></option>
                    <option value="bottom-left"><?php _e("Bottom left","hc") ?></option>
                    <option value="top-right"><?php _e("Top right","hc") ?></option>
                    <option value="top-left"><?php _e("Top left","hc") ?></option>
                </select>
            </li>
            <li class="input-row input-checkbox">
                <p><?php _e("New window","hc") ?></p>
                <input data-setting="new_window" type="checkbox">
            </li>
            <li class="input-row input-text">
                <p><?php _e("Expiration","hc") ?></p>
                <input data-setting="expire" placeholder="0 days" type="text" data-mask="number">
            </li>
            <li class="input-row input-select">
                <p><?php _e("Animation","hc") ?></p>
                <select data-setting="animation" class="animations-list">
                    <option selected="selected" value="">None</option>
                    <option value="fade-in">Fade in</option>
                    <option value="fade-left">Fade left</option>
                    <option value="fade-right">Fade right</option>
                    <option value="fade-top">Fade top</option>
                    <option value="fade-bottom">Fade bottom</option>
                    <option value="show-scale">Show scale</option>
                    <option value="scale-rotate">Scale rotate</option>
                    <option value="pulse">Pulse</option>
                    <option value="pulse-fast">Pulse fast</option>
                    <option value="pulse-horizontal">Pulse horizontal</option>
                    <option value="pulse-vertical">Pulse vertical</option>
                </select>
            </li>
        </ul>
        <hr class="space s" />
        <a class="button button-primary settings-save-btn" onclick="indipendentSaveSystem(this, ''); jQuery('.mfp-close').click();"><?php _e("Save","hc") ?></a>
    </div>
    <div class="clear"></div>
</div>
<?php }
function hc_block_templates_meta_boxes_top() {
    global $post;
    $template_name = get_page_template_slug($post->ID);
    if ($template_name == "template-fullpage.php") {
?>
<div class='template_meta_boxes_cnt'>
    <div data-hc-id="fullpage_menu" data-hc-component="hc_full_page_menu" class="hc-icon-list">
        <div class="input-css-repeater">
            <div class="css-repeater-container">
                <?php for ($i = 1; $i < 16; $i++) { ?>
                <div data-hc-id="item_<?php echo esc_attr($i); ?>" data-hc-setting="item_<?php echo esc_attr($i); ?>" class="css-repeater-item">
                    <div class="flex-box input-text input-row full-input">
                        <i class="input-row button-icon button-icons-list-all icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value="">
                            <input type="hidden" data-hc-setting="icon_style" class="icon-style" value="">
                            <input type="hidden" data-hc-setting="icon_image" class="icon-image" value="">
                        </i>
                        <input type="text" data-hc-setting="text" placeholder="<?php esc_attr_e("Menu item name","hc") ?>" />
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="clear"></div>
            <div class="input-row full-input input-select repeater-items">
                <p><?php esc_attr_e("Items","hc") ?></p>
                <select class="select-css-repeater" data-hc-setting="repeater_items">
                    <option value="">--</option>
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                </select>
            </div>
        </div>
        <p class="hc_help_label"><i class="icon-help"></i><?php esc_attr_e("Add a new section for every menu item","hc") ?></p>
    </div>
</div>
<?php
    }
    if ($template_name == "template-twosides.php") {
?>
<div class='template_meta_boxes_cnt'>
    <div data-hc-id="page_menu" data-hc-component="hc_two_sides_menu" class="hc-icon-list">
        <div class="input-css-repeater">
            <div class="css-repeater-container">
                <?php for ($i = 1; $i < 16; $i++) { ?>
                <div data-hc-id="item_<?php echo esc_attr($i); ?>" data-hc-setting="item_<?php echo esc_attr($i); ?>" class="css-repeater-item">
                    <div class="input-text input-row full-input">
                        <input type="text" data-hc-setting="text" placeholder="<?php esc_attr_e("Menu item name","hc") ?>" />
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="clear"></div>
            <div class="input-row full-input input-select repeater-items">
                <p><?php esc_attr_e("Items","hc") ?></p>
                <select class="select-css-repeater" data-hc-setting="repeater_items">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
        </div>
        <p class="hc_help_label"><i class="icon-help"></i><?php esc_attr_e("Add a new section for every menu item. First is for main title content.","hc") ?></p>
    </div>
</div>
<?php
    }
}
// HYBRID COMPOSER CUSTOM POST TYPE ARCHIVE ARRAY
// -----------------------------------------------------------------------------
// Array for default contents of archive pages of custom Post Types - Lists
// =============================================================================
function hc_default_content_post_type($title,$slug) {
    return array(
         'post_type' => 'page',
         'post_title'    => wp_strip_all_tags($title),
         'post_content'  => '{
	"main-title": {
		"component": "hc_title",
		"id": "main-title",
		"subtitle": "Archive page for ' . $title . '",
		"title_content": {
			"component": "hc_title_base",
			"id": "title-base",
			"image": ""
		},
		"title": "' . $title . '"
	},
	"section_1": {
		"component": "hc_section",
		"id": "section_1",
		"section_width": "",
		"animation": "",
		"animation_time": "",
		"timeline_animation": "",
		"timeline_delay": "",
		"timeline_order": "",
		"vertical_row": "",
		"box_middle": "",
		"css_classes": "",
		"custom_css_classes": "",
		"custom_css_styles": "",
		"section_content": [
			{
				"component": "hc_column",
				"id": "column_1",
				"column_width": "col-md-2",
				"animation": "",
				"animation_time": "",
				"timeline_animation": "",
				"timeline_delay": "",
				"timeline_order": "",
				"css_classes": "",
				"custom_css_classes": "",
				"custom_css_styles": "",
				"main_content": []
			},
			{
				"component": "hc_column",
				"id": "column_2",
				"column_width": "col-md-8",
				"animation": "",
				"animation_time": "",
				"timeline_animation": "",
				"timeline_delay": "",
				"timeline_order": "",
				"css_classes": "",
				"custom_css_classes": "",
				"custom_css_styles": "",
				"main_content": [
					{
						"component": "hc_pt_grid_list",
						"id": "5ZtkF",
						"css_classes": "",
						"custom_css_classes": "",
						"custom_css_styles": "",
						"post_type_slug": "' . $slug . '",
						"post_type_category": "",
						"box": "blog_side",
						"column": "col-md-12",
						"row": "",
						"margins": "",
						"pagination_type": "pagination",
						"pag_items": "8",
						"pag_lm_animation": "fade-bottom",
						"button_size": "pagination-sm",
						"boxed": true,
						"boxed_inverse": false,
						"button_text": "Read more",
						"hidden_content": false,
						"box_animation": "",
						"pag_scroll_top": true,
						"pag_centered": true,
						"pag_button_prev": "Prev",
						"pag_button_next": "Next",
						"lm_lazy": false,
						"lm_button_text": "Load more",
						"data_options_pagination": ""
					}
				]
			},
			{
				"component": "hc_column",
				"id": "column_3",
				"column_width": "col-md-2",
				"animation": "",
				"animation_time": "",
				"timeline_animation": "",
				"timeline_delay": "",
				"timeline_order": "",
				"css_classes": "",
				"custom_css_classes": "",
				"custom_css_styles": "",
				"main_content": []
			}
		],
		"section_settings": ""
	},
	"scripts": {
		"pagination": "jquery.twbsPagination.min.js"
	},
	"css": {
		"content_box": "css/content-box.css",
		"image_box": "css/image-box.css"
	},
	"css_page": "",
	"template_setting": {},
	"template_setting_top": {},
	"page_setting": {
		"settings": []
	}
}',
         'post_status'   => 'publish',
         'post_author'   => 1,
         'post_category' => array(8,39)
       );
}
// HYBRID COMPOSER CUSTOM POST TYPE ITEM META BOX
// -----------------------------------------------------------------------------
// Meta box of Post Types - Lists admin page
// =============================================================================
function hc_block_post_types_area() {
?>
<form name='hc_lists_form' id="hc_lists_form" method='post' class="">
    <div class="row">
        <div class="col-md-1">
            <i id="post-type-icon" class="input-row button-icon button-icons-list-wp dashicons dashicons-plus" data-hc-component="value" data-value=""></i>
        </div>
        <div class="col-md-3">
            <div class="input-text input-row full-input input-blue">
                <p><?php esc_attr_e("Name","hc") ?></p>
                <input name="post-type-name" id="post-type-name" type="text" placeholder="<?php esc_attr_e("Plural name","hc") ?>" value="" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-text input-row full-input input-blue">
                <p><?php esc_attr_e("Singular Name","hc") ?></p>
                <input name="post-type-name-singular" id="post-type-name-singular" type="text" placeholder="<?php esc_attr_e("Singual name","hc") ?>" value="" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-text input-row full-input input-blue">
                <p><?php esc_attr_e("Unique ID","hc") ?></p>
                <input name="post-type-slug" id="post-type-slug" type="text" placeholder="<?php esc_attr_e("Must be unique and alphanumeric only","hc") ?>" value="" />
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="space m"></div>
    <div id="y-post-type-links" class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-3">
            <a id="link-archive-view" href="#" target="_blank" class="button button-primary button-large" style="opacity: 0.2;"><?php esc_attr_e("View archive","hc"); ?></a>
            <a id="link-items-page" href="#" class="button button-primary button-large" style="opacity: 0.2;"><?php esc_attr_e("Edit items","hc"); ?></a>
        </div>
        <div class="col-md-6 col-list-archive">
            <div id="archive-page-list" class="input-select input-row full-input input-blue" style="display: none;">
                <p><?php esc_attr_e("Archive page","hc") ?></p>
                <?php hc_get_pages_list() ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</form>
<div class="clear"></div>
<input type="hidden" id="lists-archive-arr" value='<?php echo json_encode(get_option('y_theme_lists_archives')) ?>'>
<div id="post-type-error" class="notice error">
    <p><?php esc_attr_e("Name, singular name and id are required.","hc"); ?></p>
</div>
<div id="single-item-box">
    <p class="title"><?php esc_attr_e("Single item template","hc"); ?></p>
    <p class="desc">
        <?php esc_attr_e("Create the single item template here. Add the components you want, usually without contents, and you're done. Every item of your list will use this template.","hc"); ?>
        <a target="_blank" href="http://wordpress.framework-y.com/documentation/lists/"><?php esc_attr_e("Documentation","hc"); ?></a>
    </p>
</div>
<?php
}
// HYBRID COMPOSER CUSTOM POST TYPE ITEM META BOX
// -----------------------------------------------------------------------------
// Meta box of single item admin page of custom Post Types - Lists
// =============================================================================
function hc_block_post_types_single_area() {
?>
<div data-hc-component="hc_upload_image" class="input-box input-row full-input input-top">
    <p><?php esc_attr_e("Featured image","hc") ?></p>
    <div class="upload-box upload-row full-input">
        <span class="close-button"></span>
        <div class="upload-container">
            <div id="post-type-image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
        </div>
    </div>
</div>
<div class="input-text-area input-row full-input input-top">
    <p><?php esc_attr_e("Excerpt","hc") ?></p>
    <textarea id="post-type-excerpt" placeholder=""></textarea>
</div>
<div class="input-text input-row full-input">
    <p><?php esc_attr_e("Extra 1","hc") ?></p>
    <input id="post-type-extra-1" type="text" placeholder="" value="" />
</div>
<div class="input-text input-row full-input">
    <p><?php esc_attr_e("Extra 2","hc") ?></p>
    <input id="post-type-extra-2" type="text" placeholder="" value="" />
</div>
<div id="post-type-item-icon" class="input-text input-row">
    <p><?php esc_attr_e("Icon","hc") ?></p>
    <i class="input-row button-icon button-icons-list-all icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value="">
        <input type="hidden" id="post-type-item-icon-style" class="icon-style" value="">
        <input type="hidden" id="post-type-item-icon-image" class="icon-image" value="">
    </i>
</div>
<div id="post-type-error" class="notice error">
    <p><?php esc_attr_e("Featured image and excerpt are required.","hc"); ?></p>
</div>
<?php
}
// MENU META BOXES
// -----------------------------------------------------------------------------
// Meta boxes of menu, added on Apparence > Menu admin page
// =============================================================================
function hc_init_meta_box_divider() {
    global $_nav_menu_placeholder, $nav_menu_selected_id;
    $_nav_menu_placeholder = 0 > $_nav_menu_placeholder ? $_nav_menu_placeholder - 1 : -1;
?>
<div id="meta-box-divider">
    <div class="tabs-panel tabs-panel-active">
        <ul class="categorychecklist form-no-clear">
            <li>
                <label class="menu-item-default">
                    <input type="checkbox" checked class="menu-item-checkbox" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-object-id]" value="-1">
                </label>
                <input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-type]" value="custom">
                <input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-title]" value="Divider">
                <input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_url($_nav_menu_placeholder); ?>][menu-item-url]" value="#">
                <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-classes]" value="_divider">
            </li>
        </ul>
    </div>
    <p class="button-controls">
        <span class="add-to-menu">
            <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu','hc'); ?>" name="add-post-type-menu-item" id="submit-meta-box-divider">
            <span class="spinner"></span>
        </span>
    </p>
</div>
<?php
}
function hc_init_meta_box_mega_menu() {
    global $_nav_menu_placeholder, $nav_menu_selected_id;
    $_nav_menu_placeholder = 0 > $_nav_menu_placeholder ? $_nav_menu_placeholder - 1 : -1;
?>
<div id="meta-box-mega-menu">
    <div class="tabs-panel tabs-panel-active">
        <label class="menu-item-small-width">
            <input type="checkbox" value="">
            <span><?php esc_attr_e("Small width dropdown","hc") ?></span>
        </label>
        <ul class="categorychecklist form-no-clear">
            <li>
                <label class="menu-item-default">
                    <input type="checkbox" checked class="menu-item-checkbox" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-object-id]" value="-1">
                </label>
                <label class="menu-item-classes howto">
                    <span><?php esc_attr_e("Background image link","hc") ?></span>
                    <input type="text" class="menu-item-url" name="menu-item[<?php echo esc_url($_nav_menu_placeholder); ?>][menu-item-url]" value="">
                </label>
                <div class="clear"></div>
                <input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-type]" value="custom">
                <input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-title]" value="Mega menu">
                <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-classes]" value="_mega_menu">
            </li>
        </ul>
    </div>
    <p class="button-controls">
        <span class="add-to-menu">
            <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu','hc'); ?>" name="add-post-type-menu-item" id="submit-meta-box-mega-menu">
            <span class="spinner"></span>
            <a class="button-secondary upload-button"><?php esc_attr_e("Upload","hc") ?></a>
        </span>
    </p>
</div>
<?php
}
function hc_init_meta_box_mega_menu_col() {
    global $_nav_menu_placeholder, $nav_menu_selected_id;
    $_nav_menu_placeholder = 0 > $_nav_menu_placeholder ? $_nav_menu_placeholder - 1 : -1;
?>
<div id="meta-box-mega-menu-col">
    <div class="tabs-panel tabs-panel-active">
        <ul class="categorychecklist form-no-clear">
            <li>
                <label class="menu-item-default">
                    <input type="checkbox" checked class="menu-item-checkbox" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-object-id]" value="-1">
                </label>
                <input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_url($_nav_menu_placeholder); ?>][menu-item-url]" value="#">
                <input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-type]" value="custom">
                <input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-title]" value="Mega menu column">
                <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-classes]" value="_mega_menu_col">
            </li>
        </ul>
    </div>
    <p class="button-controls">
        <span class="add-to-menu">
            <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu','hc'); ?>" name="add-post-type-menu-item" id="submit-meta-box-mega-menu-col">
            <span class="spinner"></span>
        </span>
    </p>
</div>
<?php
}
function hc_init_meta_box_mega_menu_title() {
    global $_nav_menu_placeholder, $nav_menu_selected_id;
    $_nav_menu_placeholder = 0 > $_nav_menu_placeholder ? $_nav_menu_placeholder - 1 : -1;
?>
<div id="meta-box-mega-menu-title">
    <div class="tabs-panel tabs-panel-active">
        <ul class="categorychecklist form-no-clear">
            <li>
                <label class="menu-item-default">
                    <input type="checkbox" checked class="menu-item-checkbox" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-object-id]" value="-1">
                </label>
                <label class="menu-item-title howto">
                    <span>Title</span>
                    <input type="text" class="menu-item-title" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-title]" value="">
                </label>
                <input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_url($_nav_menu_placeholder); ?>][menu-item-url]" value="#">
                <input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-type]" value="custom">
                <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-classes]" value="_mega_menu_title">
            </li>
        </ul>
    </div>
    <p class="button-controls">
        <span class="add-to-menu">
            <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu','hc'); ?>" name="add-post-type-menu-item" id="submit-meta-box-mega-menu-title">
            <span class="spinner"></span>
        </span>
    </p>
</div>
<?php
}
function hc_init_meta_box_mega_menu_tab() {
    global $_nav_menu_placeholder, $nav_menu_selected_id;
    $_nav_menu_placeholder = 0 > $_nav_menu_placeholder ? $_nav_menu_placeholder - 1 : -1;
?>
<div id="meta-box-mega-menu-tab">
    <div class="tabs-panel tabs-panel-active">
        <ul class="categorychecklist form-no-clear">
            <li>
                <label class="menu-item-default">
                    <input type="checkbox" checked class="menu-item-checkbox" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-object-id]" value="-1">
                </label>
                <label class="menu-item-title howto">
                    <span><?php esc_attr_e("Tab name","hc") ?></span>
                    <input type="text" class="menu-item-title" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-title]" value="">
                </label>
                <input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_url($_nav_menu_placeholder); ?>][menu-item-url]" value="#">
                <input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-type]" value="custom">
                <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr($_nav_menu_placeholder); ?>][menu-item-classes]" value="_mega_menu_tab">
            </li>
        </ul>
    </div>
    <p class="button-controls">
        <span class="add-to-menu">
            <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu','hc'); ?>" name="add-post-type-menu-item" id="submit-meta-box-mega-menu-tab">
            <span class="spinner"></span>
        </span>
    </p>
</div>
<?php
}
