<?php
// =============================================================================
// IMAGE_BOX.PHP
// -----------------------------------------------------------------------------
// Hybric Composer image boxes admin components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. IMAGE BOX - Documentation and demo: framework-y.com/components/image-box.html
//   02. ADVANCED IMAGE BOX - Documentation and demo: framework-y.com/components/image-box.html#advanced-image-box
//   03. IMAGE - Static image
// =============================================================================
?>
<div id="cnt_hc_image_box">
    <div data-hc-id="_ID" data-hc-component="hc_image_box" data-hc-setting="main_content" class="hc-image-box hc-cnt-component">
        <input type="hidden" class="file_require" value="lightbox">
        <?php hc_e_composer_item_menu("Image box") ?>
        <div class="upload-box upload-row full-input">
            <span class="close-button"></span>
            <div class="upload-container">
                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn upload-img-box"></div>
            </div>
        </div>
        <div class="flex-box flex-box-link">
            <?php hc_get_link_engine(); ?>
            <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
            <div class="button-inner-options" data-width="330">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Style","hc") ?></p>
                        <select data-hc-setting="style" data-default="circle">
                            <option selected value=""><?php _e("Square","hc") ?></option>
                            <option value="square_thumbnail"><?php _e("Square thumbnail","hc") ?></option>
                            <option value="circle"><?php _e("Circle","hc") ?></option>
                            <option value="circle_thumbnail"><?php _e("Circle thumbnail","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Icon position","hc") ?></p>
                        <select data-hc-setting="icon_position">
                            <option selected="selected" value=""><?php _e("Top left","hc") ?></option>
                            <option value="i-bottom"><?php _e("Bottom Left","hc") ?></option>
                            <option value="i-top-right"><?php _e("Top Right","hc") ?></option>
                            <option value="i-bottom-right"><?php _e("Bottom Right","hc") ?></option>
                            <option value="i-center"><?php _e("Center","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Image animation","hc") ?></p>
                        <select data-hc-setting="image_animation" class="animations-list">
                            <?php hc_html_image_animations();  ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Icon animation","hc") ?></p>
                        <select data-hc-setting="icon_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Image size","hc") ?></p>
                        <select data-hc-setting="thumb_size">
                            <?php hc_thumb_sizes(); ?>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Hidden icon","hc") ?></p>
                        <input data-hc-setting="icon_hidden" checked="checked" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Inner caption","hc") ?></p>
                        <input data-hc-setting="img_box_inner_caption" checked="checked" type="checkbox">
                    </li>
                    <li class="input-text input-row caption-img-box">
                        <p><?php _e("Title","hc") ?></p>
                        <input type="text" data-hc-setting="caption_img_box" />
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Alt text","hc") ?></p>
                        <input type="text" data-hc-setting="alt" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_adv_image_box">
    <div data-hc-id="_ID" data-hc-component="hc_adv_image_box" data-hc-setting="main_content" class="hc-image-box hc-adv-image-box hc-cnt-component">
        <input type="hidden" class="file_require" value="lightbox">
        <input type="hidden" class="file_require" value="image_box">
        <?php hc_e_composer_item_menu("Advanced image box") ?>
        <div class="upload-box upload-row full-input">
            <span class="close-button"></span>
            <div class="upload-container">
                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn upload-img-box"></div>
            </div>
        </div>
        <div class="flex-box">
            <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
            <div class="input-text input-row caption-img-box text-bold">
                <input type="text" data-hc-setting="title" placeholder="<?php _e("Title ...","hc") ?>" />
            </div>
            <div class="button-inner-options" data-width="330">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Box style","hc") ?></p>
                        <select data-hc-setting="box_style" data-require-file="yes">
                            <option selected value="half_content"><?php _e("Half content","hc") ?></option>
                            <option value="double_content"><?php _e("Double content","hc") ?></option>
                            <option value="side_content"><?php _e("Side content","hc") ?></option>
                            <option value="full_content"><?php _e("Full content","hc") ?></option>
                            <option value="buttons_content" data-require-file="lightbox"><?php _e("Buttons content","hc") ?></option>
                            <option value="down_text"><?php _e("Down text","hc") ?></option>
                            <option value="classic_box"><?php _e("Classic box","hc") ?></option>
                            <option value="circle_center"><?php _e("Circle center","hc") ?></option>
                            <option value="circle_center_2"><?php _e("Circle center 2","hc") ?></option>
                            <option value="circle_half"><?php _e("Circle half","hc") ?></option>
                            <option value="circle_bottom"><?php _e("Circle bottom","hc") ?></option>
                            <option value="circle_background"><?php _e("Circle background","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="image_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Hidden content","hc") ?></p>
                        <input data-hc-setting="hidden_content" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Image size","hc") ?></p>
                        <select data-hc-setting="thumb_size">
                            <?php hc_thumb_sizes(); ?>
                        </select>
                    </li>
                    <?php hc_button_options() ?>
                    <li class="input-row input-text">
                        <p><?php _e("Extra text","hc") ?></p>
                        <input type="text" data-hc-setting="extra_text" />
                    </li>
                    <li class="input-text input-row full-only-input">
                        <p><?php _e("Subtitle","hc") ?></p>
                        <input type="text" data-hc-setting="subtitle" />
                    </li>
                    <li class="input-text-area input-row">
                        <p><?php _e("Main text","hc") ?></p>
                        <textarea data-hc-setting="text"></textarea>
                    </li>
                </ul>
            </div>
        </div>
        <?php hc_get_link_engine(); ?>
    </div>
</div>
<div id="cnt_hc_image">
    <div data-hc-id="_ID" data-hc-component="hc_image" data-hc-setting="main_content" class="hc-image-box hc-image hc-cnt-component">
        <?php hc_e_composer_item_menu("Image") ?>
        <div class="upload-box upload-row full-input">
            <span class="close-button"></span>
            <div class="upload-container">
                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn upload-img-box"></div>
            </div>
        </div>
        <div class="button-inner-options btn-inner">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-text">
                    <p><?php _e("Alt text","hc") ?></p>
                    <input type="text" data-hc-setting="alt" />
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Image size","hc") ?></p>
                    <select data-hc-setting="thumb_size">
                        <?php hc_thumb_sizes(); ?>
                    </select>
                </li>
            </ul>
        </div>
    </div>
</div>
