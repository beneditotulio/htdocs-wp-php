<?php
// =============================================================================
// OTHERS.PHP
// -----------------------------------------------------------------------------
// Hybric Composer various admin components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. LINK - Link engine for all link types
//   02. UPLOAD IMAGE - Image uploader with WordPress Uploader
//   03. UPLOAD VIDEO - Video uploader with WordPress Uploader
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
//   27. WORDPRESS EDITOR - WordPress WYSIWYG editor
//   28. CODE BLOCK - Raw code string
//   29. FULLPAGE COMPONENTS - Exclusive fullpage template components
// =============================================================================
?>

<div id="cnt_hc_link">
    <?php function hc_get_link_engine() { ?>
    <div class="hc-link">
        <div class="input-text input-row link-field">
            <select data-hc-setting="link_type" class="link-type" data-require-file="yes">
                <option selected value="classic"><?php _e("Link","hc") ?></option>
                <option value="lightbox" data-require-file="lightbox"><?php _e("Lightbox","hc") ?></option>
                <option value="custom" data-require-file="lightbox"><?php _e("Custom","hc") ?></option>
            </select>
            <i class="button-icon input-row upload-hc-button icon-link" data-value=""></i>
            <div class="button-inner-options" data-width="315">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Lightbox animation","hc") ?></p>
                        <select data-hc-setting="lightbox_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Lightbox caption","hc") ?></p>
                        <input data-hc-setting="caption" type="text">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Inner caption","hc") ?></p>
                        <input data-hc-setting="inner_caption" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("New window","hc") ?></p>
                        <input data-hc-setting="new_window" type="checkbox">
                    </li>
                </ul>
            </div>
            <input data-hc-setting="link" class="input-link" placeholder="<?php _e("Link","hc") ?>" type="text" value="" />
            <a class="preview button link-content-btn" href="#"><?php _e("Edit content","hc") ?></a>
        </div>
        <div class="clear"></div>
        <div class="link-content css-box-popup">
            <div class="scroll-content" data-height="500">
                <div data-hc-setting="link_content" data-hc-id="main_content" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="clear"></div>
                <div class="link-content-bar">
                    <div class="input-row input-select">
                        <p><?php _e("Lightbox size","hc") ?></p>
                        <select data-hc-setting="lightbox_size" data-default="left">
                            <option value="s"><?php _e("Small","hc") ?></option>
                            <option selected="selected" value=""><?php _e("Medium","hc") ?></option>
                            <option value="l"><?php _e("Large","hc") ?></option>
                            <option value="full-screen-size"><?php _e("Full screen","hc") ?></option>
                        </select>
                    </div>
                    <div class="input-row input-checkbox">
                        <p><?php _e("Scroll box","hc") ?></p>
                        <input data-hc-setting="scrollbox" type="checkbox" data-require-file="slimscroll">
                    </div>
                </div>
            </div>
            <a class="button button-primary button-large save-button-css-box"><?php _e("SAVE","hc") ?></a>
        </div>
    </div>
    <?php } ?>
</div>
<div id="cnt_hc_upload_img">
    <div class="upload-container" data-hc-id="_ID" data-hc-setting="_ID" data-hc-component="hc_upload_img">
        <span class="close-button"></span>
        <div data-hc-setting="link" data-hc-component="upload" data-upload-link="_LINK" data-upload-height="_HEIGHT" data-upload-width="_WIDTH" data-upload-id="_IMGID" class="upload-btn" style="background-image: url(_LINK)"></div>
    </div>
</div>
<div id="cnt_hc_upload_image">
    <div data-hc-id="_ID" data-hc-component="hc_upload_image">
        <div class="upload-box upload-row full-input">
            <span class="close-button"></span>
            <div class="upload-container">
                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_upload_img_multi">
    <div data-hc-id="_ID" data-hc-component="hc_upload_img_multi">
        <div class="upload-box upload-multi upload-row upload-justified" data-hc-setting="slides" data-hc-id="slides" data-hc-container="repeater">
            <span class="close-button"></span>
            <div class="upload-container upload-add">
                <div data-hc-component="upload" class="upload-btn"></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="cnt_hc_upload_video">
    <div data-hc-id="_ID" data-hc-component="hc_upload_video">
        <div class="input-text input-row link-field link-simple">
            <input data-hc-setting="link" class="input-link" placeholder="<?php _e("Video link","hc") ?>" type="text" value="">
            <i class="button-icon input-row upload-hc-button icon-link" data-value=""></i>
        </div>
        <div class="upload-box upload-row full-input">
            <span class="close-button"></span>
            <div class="upload-container">
                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_video">
    <div data-hc-id="_ID" data-hc-component="hc_video" data-hc-setting="main_content" class="hc-video hc-cnt-component">
        <?php hc_e_composer_item_menu("Video") ?>
        <div class="flex-box">
            <div class="input-text input-row link-field">
                <p><?php _e("Link","hc") ?></p>
                <input data-hc-setting="link" class="input-link" placeholder="<?php _e("Youtube or MP4 link","hc") ?>" type="text" value="">
                <i class="button-icon input-row upload-hc-button icon-link" data-value=""></i>
            </div>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-text input-row small-input">
                        <p><?php _e("Width","hc") ?></p>
                        <input data-hc-setting="width" placeholder="100%" type="text" data-mask="number" value="" />
                    </li>
                    <li class="input-text input-row small-input">
                        <p><?php _e("Height","hc") ?></p>
                        <input data-hc-setting="height" type="text" data-mask="number" value="350" />
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Autoplay","hc") ?></p>
                        <input data-hc-setting="autoplay" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Loop","hc") ?></p>
                        <input data-hc-setting="loop" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Controls","hc") ?></p>
                        <input data-hc-setting="controls" checked type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Muted","hc") ?></p>
                        <input data-hc-setting="muted" type="checkbox">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_button">
    <div data-hc-id="_ID" data-hc-component="hc_button" data-hc-setting="main_content" class="hc-button hc-cnt-component">
        <?php hc_e_composer_item_menu("Button") ?>
        <div class="flex-box">
            <i class="input-row button-icon button-icons-list icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Style","hc") ?></p>
                        <select data-hc-setting="style" data-default="circle">
                            <option selected value="circle"><?php _e("Circle","hc") ?></option>
                            <option value="square"><?php _e("Square","hc") ?></option>
                            <option value="circle-border"><?php _e("Circle border","hc") ?></option>
                            <option value="square-border"><?php _e("Square border","hc") ?></option>
                            <option value="link"><?php _e("Link","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Size","hc") ?></p>
                        <select data-hc-setting="size">
                            <option selected="selected" value=""><?php _e("Default","hc") ?></option>
                            <option value="btn-lg"><?php _e("Large","hc") ?></option>
                            <option value="btn-sm"><?php _e("Small","hc") ?></option>
                            <option value="btn-xs"><?php _e("Extra small","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Position","hc") ?></p>
                        <select data-hc-setting="position" data-default="left">
                            <option selected="selected" value="left"><?php _e("Left","hc") ?></option>
                            <option value="right"><?php _e("Right","hc") ?></option>
                            <option value="center"><?php _e("Center","hc") ?></option>
                            <option value="full"><?php _e("Full","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Animated","hc") ?></p>
                        <input data-hc-setting="animation" type="checkbox">
                    </li>
                </ul>
            </div>
            <div class="input-text input-row full-only-input">
                <input data-hc-setting="text" placeholder="<?php _e("Button text","hc") ?>" type="text" value="" />
            </div>
        </div>

        <?php hc_get_link_engine(); ?>
    </div>
</div>
<div id="cnt_hc_title_tag">
    <div data-hc-id="_ID" data-hc-component="hc_title_tag" data-hc-setting="main_content" class="hc-title-tag hc-cnt-component">
        <?php hc_e_composer_item_menu("Title H1-H6") ?>
        <div class="flex-box">
            <div class="input-text input-row full-only-input">
                <input placeholder="<?php _e("Title","hc") ?>" data-hc-setting="text" type="text" value="" />
            </div>
            <div class="input-row input-select only-input" style="min-width: 60px;">
                <select data-hc-setting="tag">
                    <option value="h1">H1</option>
                    <option value="h2" selected>H2</option>
                    <option value="h3">H3</option>
                    <option value="h4">H4</option>
                    <option value="h5">H5</option>
                    <option value="h6">H6</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_subtitle">
    <div data-hc-id="_ID" data-hc-component="hc_subtitle" data-hc-setting="main_content" class="hc-subtitle hc-cnt-component">
        <?php hc_e_composer_item_menu("Subtitle") ?>
        <div class="input-text input-row full-only-input">
            <input data-hc-setting="title" placeholder="<?php _e("Title ...","hc") ?>" type="text" />
        </div>
        <div class="flex-box">
            <div class="input-text input-row full-only-input">
                <input data-hc-setting="subtitle" placeholder="<?php _e("Subtitle ...","hc") ?>" type="text" />
            </div>
            <i class="input-row button-icon button-icons-list icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select ">
                        <p class="sch"><?php _e("Style","hc") ?></p>
                        <select data-hc-setting="style">
                            <option value="base" selected><?php _e("Base","hc") ?></option>
                            <option value="base_2"><?php _e("Base 2","hc") ?></option>
                            <option value="base_small"><?php _e("Base small","hc") ?></option>
                            <option value="icon"><?php _e("Icon","hc") ?></option>
                            <option value="bg_icon"><?php _e("Background icon","hc") ?></option>
                            <option value="modern"><?php _e("Modern","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select ">
                        <p class="sch"><?php _e("Alignment","hc") ?></p>
                        <select data-hc-setting="alignment">
                            <option selected value="text-left"><?php _e("Left","hc") ?></option>
                            <option value="text-center"><?php _e("Center","hc") ?></option>
                            <option value="text-right"><?php _e("Right","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p class="sch"><?php _e("Hide scroll top","hc") ?></p>
                        <input data-hc-setting="scroll_top" checked type="checkbox">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_icon_list">
    <div data-hc-id="_ID" data-hc-component="hc_icon_list" data-hc-setting="main_content" class="hc-icon-list hc-cnt-component">
        <?php hc_e_composer_item_menu("Icon list advanced") ?>
        <div class="input-text input-row input-repeater" data-value="">
            <div class="repeater-source">
                <div class="flex-box">
                    <i class="input-row button-icon button-icons-list-all icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image" class="icon-image" value="">
                    </i>
                    <input type="text" data-hc-setting="text" />
                </div>
            </div>
            <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
            <div class="clear"></div>
            <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="button-inner-options">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-select">
                    <p><?php _e("Direction","hc") ?></p>
                    <select data-hc-setting="direction">
                        <option selected value=""><?php _e("Horizontal","hc") ?></option>
                        <option value="vertical-icon-list"><?php _e("Vertical","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Alignment","hc") ?></p>
                    <select data-hc-setting="alignment">
                        <option selected value="text-left"><?php _e("Left","hc") ?></option>
                        <option value="text-right"><?php _e("Right","hc") ?></option>
                        <option value="text-center"><?php _e("Center","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Icon position","hc") ?></p>
                    <select data-hc-setting="icon_position">
                        <option selected value=""><?php _e("Left","hc") ?></option>
                        <option value="right"><?php _e("Right","hc") ?></option>
                        <option value="top"><?php _e("Top","hc") ?></option>
                        <option value="bottom"><?php _e("Bottom","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Text size","hc") ?></p>
                    <select data-hc-setting="text_size">
                        <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                        <option value="text-l"><?php _e("Large","hc") ?></option>
                        <option value="text-m"><?php _e("Medium","hc") ?></option>
                        <option value="text-s"><?php _e("Small","hc") ?></option>
                        <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        <option selected value=""><?php _e("Default","hc") ?></option>
                    </select>
                </li>
                 <li class="input-row input-select">
                    <p><?php _e("Icon size","hc") ?></p>
                    <select data-hc-setting="icon_size">
                        <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                        <option value="text-l"><?php _e("Large","hc") ?></option>
                        <option value="text-m"><?php _e("Medium","hc") ?></option>
                        <option value="text-s"><?php _e("Small","hc") ?></option>
                        <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        <option selected value=""><?php _e("Default","hc") ?></option>
                    </select>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_icon_list_simple">
    <div data-hc-id="_ID" data-hc-component="hc_icon_list_simple" data-hc-setting="main_content" class="hc-icon-list-simple hc-cnt-component">
        <?php hc_e_composer_item_menu("Icon list") ?>
        <div class="input-text input-row input-repeater" data-value="">
            <div class="repeater-source">
                <div class="flex-box">
                    <i class="input-row button-icon button-icons-list icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
                    <input type="text" data-hc-setting="text" />
                </div>
            </div>
            <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
            <div class="clear"></div>
            <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="button-inner-options">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-select">
                    <p><?php _e("Alignment","hc") ?></p>
                    <select data-hc-setting="alignment">
                        <option selected value="text-left"><?php _e("Left","hc") ?></option>
                        <option value="text-right"><?php _e("Right","hc") ?></option>
                        <option value="text-center"><?php _e("Center","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Size","hc") ?></p>
                    <select data-hc-setting="icon_size">
                        <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                        <option value="text-l"><?php _e("Large","hc") ?></option>
                        <option value="text-m"><?php _e("Medium","hc") ?></option>
                        <option value="text-s"><?php _e("Small","hc") ?></option>
                        <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        <option selected value=""><?php _e("Default","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Style","hc") ?></p>
                    <select data-hc-setting="list_style">
                        <option selected value=""><?php _e("Icons","hc") ?></option>
                        <option value="decimal"><?php _e("Decimal","hc") ?></option>
                        <option value="initial"><?php _e("Dots","hc") ?></option>
                        <option value="square"><?php _e("Square","hc") ?></option>
                    </select>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_icon_links">
    <div data-hc-id="_ID" data-hc-component="hc_icon_links" data-hc-setting="main_content" class="hc-icon-links hc-cnt-component">
        <?php hc_e_composer_item_menu("Icon links") ?>
        <div class="input-text input-row input-repeater" data-value="">
            <div class="repeater-source">
                <div class="flex-box">
                    <i class="input-row button-icon button-icons-list icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
                    <input type="text" data-hc-setting="text" />
                </div>
            </div>
            <div class="repeater-container" data-hc-setting="rows" data-hc-id="rows" data-hc-container="repeater"></div>
            <div class="clear"></div>
            <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="input-row input-select">
            <p class="sch"><?php _e("Style","hc") ?></p>
            <select class="social-type" data-hc-setting="type" data-require-file="yes">
                <option selected value="classic"><?php _e("Classic","hc") ?></option>
                <option value="classic_big"><?php _e("Classic big","hc") ?></option>
                <option value="circle_tt" data-require-file="toolstip"><?php _e("Circle toolstip","hc") ?></option>
                <option value="circle_tt_big" data-require-file="toolstip"><?php _e("Circle toolstip big","hc") ?></option>
                <option value="simple"><?php _e("Simple icons","hc") ?></option>
                <option value="button"><?php _e("Social button","hc") ?></option>
                <option value="button_2"><?php _e("Social button 2","hc") ?></option>
            </select>
        </div>
        <div class="button-inner-options">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-select">
                    <p><?php _e("Social colors","hc") ?></p>
                    <input data-hc-setting="social_colors" type="checkbox">
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_icon_box">
    <div data-hc-id="_ID" data-hc-component="hc_icon_box" data-hc-setting="main_content" class="hc-icon-box hc-cnt-component">
        <?php hc_e_composer_item_menu("Icon box") ?>
        <div class="flex-box">
            <i class="input-row button-icon button-icons-list-all icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value="">
                <input type="hidden" data-hc-setting="icon_style" class="icon-style" value="">
                <input type="hidden" data-hc-setting="icon_image" class="icon-image" value="">
            </i>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Icon position","hc") ?></p>
                        <select data-hc-setting="icon_position">
                            <option selected value="left"><?php _e("Left","hc") ?></option>
                            <option value="right"><?php _e("Right","hc") ?></option>
                            <option value="top"><?php _e("Top","hc") ?></option>
                            <option value="bottom"><?php _e("Bottom","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Icon size","hc") ?></p>
                        <select data-hc-setting="icon_size">
                            <option value="text-xxl"><?php _e("Ultra large","hc") ?></option>
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option selected value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Title size","hc") ?></p>
                        <select data-hc-setting="title_size">
                            <option selected value="-"><?php _e("Default","hc") ?></option>
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Text size","hc") ?></p>
                        <select data-hc-setting="text_size">
                            <option selected value="-"><?php _e("Default","hc") ?></option>
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                        </select>
                    </li>
                </ul>
            </div>
            <div class="input-text input-row full-only-input">
                <input data-hc-setting="title" placeholder="<?php _e("Title ...","hc") ?>" type="text" value="" />
            </div>
        </div>
        <div class="input-text input-row full-only-input">
            <input data-hc-setting="subtitle" placeholder="<?php _e("Text ...","hc") ?>" type="text" value="" />
        </div>
    </div>
</div>
<div id="cnt_hc_text_list">
    <div data-hc-id="_ID" data-hc-component="hc_text_list" data-hc-setting="main_content" class="hc-text-list hc-cnt-component">
        <?php hc_e_composer_item_menu("Text list") ?>
        <div class="input-text input-row input-repeater" data-value="">
            <div class="repeater-source">
                <div class="flex-box">
                    <div class="upload-box upload-row input-row upload-mini" data-dependence-show="show_images">
                        <span class="close-button"></span>
                        <div class="upload-container">
                            <div data-hc-setting="image_link" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                        </div>
                    </div>
                    <div class="input-text input-row full-only-input">
                        <input data-hc-setting="title" placeholder="<?php _e("Title ...","hc") ?>" type="text" value="" />
                    </div>
                    <div class="input-text input-row full-only-input">
                        <input data-hc-setting="subtitle" placeholder="<?php _e("Subtitle ...","hc") ?>" type="text" value="" />
                    </div>
                    <div class="input-text input-row only-input">
                        <input data-hc-setting="extra" placeholder="<?php _e("Extra","hc") ?>" type="text" value="" />
                    </div>
                </div>
            </div>
            <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
            <div class="clear"></div>
            <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="button-inner-options">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-select">
                    <p><?php _e("Style","hc") ?></p>
                    <select data-hc-setting="style">
                        <option value=""><?php _e("Classic","hc") ?></option>
                        <option value="style_2"><?php _e("Bold","hc") ?></option>
                        <option value="style_3"><?php _e("Underline","hc") ?></option>
                        <option value="style_4"><?php _e("Horizontal","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Animation","hc") ?></p>
                    <select data-hc-setting="animation" class="animations-list">
                        <?php hc_html_animations(); ?>
                    </select>
                </li>
            </ul>
        </div>
        <div class="input-row input-checkbox">
            <p><?php _e("Images","hc") ?></p>
            <input data-hc-setting="show_images" type="checkbox" data-dependence-trigger="show">
        </div>
    </div>
</div>
<div id="cnt_hc_counter">
    <div data-hc-id="_ID" data-hc-component="hc_counter" data-hc-setting="main_content" class="hc-counter hc-cnt-component">
        <input type="hidden" class="file_require" value="progress_counter">
        <?php hc_e_composer_item_menu("Counter") ?>
        <div class="flex-box">
            <div class="input-row input-text full-only-input">
                <input placeholder="<?php _e("Text","hc") ?>" data-hc-setting="title" type="text">
            </div>
            <div class="input-row input-text full-only-input">
                <input data-hc-setting="count_to" placeholder="<?php _e("Count to","hc") ?>" data-mask="number" type="text">
            </div>
            <i class="input-row button-icon button-icons-list-all icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value="">
                <input type="hidden" data-hc-setting="icon_style" class="icon-style" value="">
                <input type="hidden" data-hc-setting="icon_image" class="icon-image" value="">
            </i>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Style","hc") ?></p>
                        <select data-hc-setting="style">
                            <option selected value=""><?php _e("Simple","hc") ?></option>
                            <option value="icon"><?php _e("Icon","hc") ?></option>
                            <option value="icon-horizontal"><?php _e("Icon horizontal","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Start number","hc") ?></p>
                        <input data-hc-setting="from" data-mask="number" type="text">
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Speed","hc") ?></p>
                        <input data-hc-setting="speed" data-mask="number" type="text">
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Refresh interval","hc") ?></p>
                        <input data-hc-setting="interval" data-mask="number" type="text">
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Before","hc") ?></p>
                        <input data-hc-setting="before_text" type="text">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Numbers size","hc") ?></p>
                        <select data-hc-setting="text_size">
                            <option value="text-xxl"><?php _e("Ultra large","hc") ?></option>
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                            <option selected value="default"><?php _e("Default","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p>Label size</p>
                        <select data-hc-setting="text_size_2">
                            <option value="text-xxl"><?php _e("Ultra large","hc") ?></option>
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                            <option selected value="default"><?php _e("Default","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p>Icon size</p>
                        <select data-hc-setting="icon_size">
                            <option value="text-xxl"><?php _e("Ultra large","hc") ?></option>
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                            <option selected value="default"><?php _e("Default","hc") ?></option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_countdown">
    <div data-hc-id="_ID" data-hc-component="hc_countdown" data-hc-setting="main_content" class="hc-countdown hc-cnt-component">
        <input type="hidden" class="file_require" value="progress_counter">
        <input type="hidden" class="file_require" value="components">
        <?php hc_e_composer_item_menu("Countdown") ?>
        <div class="flex-box">
            <div class="input-row input-text full-input">
                <p><?php _e("Date time","hc") ?></p>
                <input data-hc-setting="date" data-mask="00/00/0000 00:00:00" placeholder="<?php _e("mm/dd/yyyy hh:mm:ss","hc") ?>" type="text">
            </div>
            <i class="input-row button-icon button-icons-list-all icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value="">
                <input type="hidden" data-hc-setting="icon_style" class="icon-style" value="">
                <input type="hidden" data-hc-setting="icon_image" class="icon-image" value="">
            </i>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Style","hc") ?></p>
                        <select data-hc-setting="style">
                            <option selected value=""><?php _e("Simple","hc") ?></option>
                            <option value="column"><?php _e("Simple column","hc") ?></option>
                            <option value="icon"><?php _e("Icon","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("UTC offset","hc") ?></p>
                        <input data-hc-setting="offset" type="text">
                    </li>
                    <li class="input-row input-text input-checkbox">
                        <p><?php _e("Show days","hc") ?></p>
                        <input data-hc-setting="days" checked type="checkbox">
                        <input class="checkbox-text" data-hc-setting="days_text" type="text" value=":">
                    </li>
                    <li class="input-row input-text input-checkbox">
                        <p><?php _e("Show hours","hc") ?></p>
                        <input data-hc-setting="hours" checked type="checkbox">
                        <input class="checkbox-text" data-hc-setting="hours_text" type="text" value=":">
                    </li>
                    <li class="input-row input-text input-checkbox">
                        <p><?php _e("Show minutes","hc") ?></p>
                        <input data-hc-setting="minutes" checked type="checkbox">
                        <input class="checkbox-text" data-hc-setting="minutes_text" type="text" value=":">
                    </li>
                    <li class="input-row input-text input-checkbox">
                        <p><?php _e("Show seconds","hc") ?></p>
                        <input data-hc-setting="seconds" checked type="checkbox">
                        <input class="checkbox-text" data-hc-setting="seconds_text" type="text" value=":">
                    </li>
                    <li class="input-row input-text full-input">
                        <p><?php _e("Before text","hc") ?></p>
                        <input data-hc-setting="text" type="text">
                    </li>
                    <li class="input-row input-text full-input">
                        <p><?php _e("After content","hc") ?></p>
                        <input data-hc-setting="after_text" type="text">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Numbers size","hc") ?></p>
                        <select data-hc-setting="number_size">
                            <option value="text-xxl"><?php _e("Ultra large","hc") ?></option>
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                            <option selected value="default"><?php _e("Default","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Text size","hc") ?></p>
                        <select data-hc-setting="text_size">
                            <option value="text-xxl"><?php _e("Ultra large","hc") ?></option>
                            <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                            <option value="text-l"><?php _e("Large","hc") ?></option>
                            <option value="text-m"><?php _e("Medium","hc") ?></option>
                            <option value="text-s"><?php _e("Small","hc") ?></option>
                            <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                            <option selected value="default"><?php _e("Default","hc") ?></option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_progress_bar">
    <div data-hc-id="_ID" data-hc-component="hc_progress_bar" data-hc-setting="main_content" class="hc-progress-bar hc-cnt-component">
        <input type="hidden" class="file_require" value="progress_counter">
        <?php hc_e_composer_item_menu("Progress bar") ?>
        <div class="flex-box">
            <div class="input-row input-text full-input only-input">
                <input data-hc-setting="title" placeholder="<?php _e("Title","hc") ?>" type="text">
            </div>
            <div class="input-row input-text only-input small-input text-bold">
                <input data-hc-setting="progress" data-mask="number" title="<?php _e("Progress from 0 to 100","hc") ?>" placeholder="0-100" type="text">
            </div>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Style","hc") ?></p>
                        <select data-hc-setting="style">
                            <option selected value=""><?php _e("Simple","hc") ?></option>
                            <option value="striped"><?php _e("Striped","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Title position","hc") ?></p>
                        <select data-hc-setting="title_position">
                            <option value="left"><?php _e("Left","hc") ?></option>
                            <option value="right"><?php _e("Right","hc") ?></option>
                            <option selected value="top"><?php _e("Top","hc") ?></option>
                            <option value="bottom"><?php _e("Bottom","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Progress position","hc") ?></p>
                        <select data-hc-setting="progress_position">
                            <option value="inner"><?php _e("Inner","hc") ?></option>
                            <option value="outer"><?php _e("Outer","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Progress text","hc") ?></p>
                        <input data-hc-setting="progress_text" value="%" type="text">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_circle_progress_bar">
    <div data-hc-id="_ID" data-hc-component="hc_circle_progress_bar" data-hc-setting="main_content" class="hc-circle-progress-bar hc-cnt-component">
        <input type="hidden" class="file_require" value="progress_counter">
        <input type="hidden" class="file_require" value="components">
        <?php hc_e_composer_item_menu("Circle progress bar") ?>
        <div class="input-row input-text medium-input">
            <input data-hc-setting="title" placeholder="<?php _e("Title","hc") ?>" type="text">
        </div>
        <div class="input-row input-text only-input small-input text-bold">
            <input data-hc-setting="progress" data-mask="number" placeholder="<?php _e("0-100","hc") ?>" type="text">
        </div>
        <i class="input-row button-icon button-icons-list-all icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value="">
            <input type="hidden" data-hc-setting="icon_style" class="icon-style" value="">
            <input type="hidden" data-hc-setting="icon_image" class="icon-image" value="">
        </i>
        <div class="button-inner-options">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-text">
                    <p><?php _e("Subtitle","hc") ?></p>
                    <input data-hc-setting="subtitle" type="text">
                </li>
                <li class="input-row input-text small-input">
                    <p><?php _e("Line width","hc") ?></p>
                    <input data-hc-setting="thickness" data-mask="number" placeholder="2" type="text">
                </li>
                <li class="input-row input-text small-input">
                    <p><?php _e("Size","hc") ?></p>
                    <input data-hc-setting="size" value="" data-mask="number" placeholder="100%" type="text">
                </li>
                <li class="input-row input-text small-input">
                    <p><?php _e("Hide percentage","hc") ?></p>
                    <input data-hc-setting="hide_percentage" type="checkbox">
                </li>
                <li class="input-row input-text small-input">
                    <p><?php _e("Unit text","hc") ?></p>
                    <input data-hc-setting="unit" type="text" placeholder="%" value="%">
                </li>
                <li class="input-row input-text small-input">
                    <p><?php _e("Color","hc") ?></p>
                    <input data-hc-setting="color" type="text" placeholder="#ABCDEF" value="">
                </li>
            </ul>
        </div>
        <a class="input-row" data-hc-setting="data_options" data-hc-component="value" data-value="" data-default-values="" href="#popover-box-circle-progress-bar">
            <i class="button-icon input-row icon-gear-setting-2"></i>
        </a>
    </div>
</div>
<div id="popover-box-circle-progress-bar" class="popover-box popover-list" style="display: none">
    <input type="hidden" class="file_require" value="progress_counter">
    <span class="close-button"></span>
    <ul class="list">
        <li class="input-row input-text small-input">
            <p><?php _e("Start angle","hc") ?></p>
            <input data-option-id="startAngle" type="text">
        </li>
        <li class="input-row input-checkbox">
            <p class="sch"><?php _e("Reverse","hc") ?></p>
            <input data-option-id="reverse" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-select">
            <p class="sch"><?php _e("Line cap","hc") ?></p>
            <select data-option-id="lineCap">
                <option selected value=""><?php _e("Butt","hc") ?></option>
                <option value="round"><?php _e("Round","hc") ?></option>
                <option value="square"><?php _e("Square","hc") ?></option>
            </select>
        </li>
        <li class="input-row input-text">
            <p class="sch"><?php _e("Fill","hc") ?></p>
            <input data-option-id="fill" type="text">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Animation","hc") ?></p>
            <input data-option-id="animation" type="text" />
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Animation start","hc") ?></p>
            <input data-option-id="animationStartValue" type="text" placeholder="0.0" />
        </li>
    </ul>
    <div class="clear"></div>
    <a class="button button-primary button-large popover-box-save"><?php _e("SAVE SETTINGS","hc") ?></a>
</div>
<div id="cnt_hc_timeline">
    <div data-hc-id="_ID" data-hc-component="hc_timeline" data-hc-setting="main_content" class="hc-timeline hc-cnt-component">
        <input type="hidden" class="file_require" value="components">
        <?php hc_e_composer_item_menu("Timeline") ?>
        <div class="input-text input-row input-repeater" data-value="">
            <div class="repeater-source">
                <div class="input-text input-row full-only-input only-input">
                    <input data-hc-setting="title" placeholder="<?php _e("Title ...","hc") ?>" type="text" />
                </div>
                <div class="input-text input-row full-only-input only-input">
                    <input data-hc-setting="subtitle" placeholder="<?php _e("Subtitle ...","hc") ?>" type="text" />
                </div>
                <div class="input-text-area input-row full-input only-input">
                    <textarea data-hc-setting="content" placeholder="<?php _e("Content ...","hc") ?>"></textarea>
                </div>
                <div class="flex-box">
                    <div class="input-row input-select medium-input" style="min-width: 134px;">
                        <p class="sch"><?php _e("Position","hc") ?></p>
                        <select data-hc-setting="position">
                            <option selected value=""><?php _e("Left","hc") ?></option>
                            <option value="right"><?php _e("Right","hc") ?></option>
                        </select>
                    </div>
                    <div class="input-text input-row full-input">
                        <p><?php _e("Date","hc") ?></p>
                        <input data-hc-setting="date" type="text" />
                    </div>
                    <div class="input-text input-row full-input">
                        <p><?php _e("Label","hc") ?></p>
                        <input data-hc-setting="date_subtitle" type="text" />
                    </div>
                </div>
            </div>
            <div class="repeater-container" data-hc-setting="rows" data-hc-id="rows" data-hc-container="repeater"></div>
            <div class="clear"></div>
            <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
        </div>
    </div>
</div>
<div id="cnt_hc_google_map">
    <div data-hc-id="_ID" data-hc-component="hc_google_map" data-hc-setting="main_content" class="hc-google-map hc-cnt-component">
        <input type="hidden" class="file_require" value="gmaps">
        <input type="hidden" class="file_require" value="gmaps_api">
        <?php hc_e_composer_item_menu("Google map") ?>
        <div class="hc-cmp-preview"></div>
        <div class="flex-box">
            <div class="input-row input-text full-input">
                <p class="sch"><?php _e("Map coordinates","hc") ?></p>
                <input data-hc-setting="map_coordinates" type="text" placeholder="00.0000,00.0000" value="" />
            </div>
            <div class="button-inner-options" data-width="450">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text small-input">
                        <p class="sch"><?php _e("Map height","hc") ?></p>
                        <input data-hc-setting="map_height" type="text" placeholder="350" value="" />
                    </li>
                    <li class="input-row input-text">
                        <p class="sch"><?php _e("Map address","hc") ?></p>
                        <input data-hc-setting="map_address" type="text" value="" />
                    </li>
                    <li class="input-row input-text small-input">
                        <p class="sch"><?php _e("Map zoom","hc") ?></p>
                        <input data-hc-setting="map_zoom" type="text" placeholder="12" data-mask="number" value="" />
                    </li>
                    <li class="upload-box upload-row input-row upload-mini">
                        <p><?php _e("Marker image","hc") ?></p>
                        <span class="close-button"></span>
                        <div class="upload-container">
                            <div data-hc-setting="marker_image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                        </div>
                    </li>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Marker position","hc") ?></p>
                        <select data-hc-setting="marker_position">
                            <option value="" selected><?php _e("Center","hc") ?></option>
                            <option value="col-md-6-left"><?php _e("Left","hc") ?></option>
                            <option value="col-md-6-right"><?php _e("Right","hc") ?></option>
                            <option value="center-top"><?php _e("Center top","hc") ?></option>
                            <option value="center-bottom"><?php _e("Center bottom","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p class="sch"><?php _e("Marker top offset","hc") ?></p>
                        <input data-hc-setting="marker_position_top" type="text" placeholder="0" data-mask="number" value="" />
                    </li>
                    <li class="input-row input-text small-input">
                        <p class="sch"><?php _e("Marker left offset","hc") ?></p>
                        <input data-hc-setting="marker_position_left" type="text" placeholder="0" data-mask="number" value="" />
                    </li>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Map skin","hc") ?></p>
                        <select data-hc-setting="map_skin">
                            <option value=""><?php _e("Default","hc") ?></option>
                            <option value="gray"><?php _e("Gray","hc") ?></option>
                            <option value="black"><?php _e("Black","hc") ?></option>
                            <option value="green"><?php _e("Green","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Trigger","hc") ?></p>
                        <select data-hc-setting="trigger">
                            <option value=""><?php _e("Auto","hc") ?></option>
                            <option value="manual"><?php _e("Manual","hc") ?></option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_social_feeds">
    <div data-hc-id="_ID" data-hc-component="hc_social_feeds" data-hc-setting="main_content" class="hc-social-feeds hc-cnt-component">
        <input type="hidden" class="file_require" value="social">
        <?php hc_e_composer_item_menu("Social feeds") ?>
        <div class="flex-box">
            <div class="input-row input-text full-input">
                <p class="sch">ID</p>
                <input data-hc-setting="page_id" type="text" />
            </div>
            <div class="input-row input-select full-input">
                <p class="sch"><?php _e("Type","hc") ?></p>
                <select class="social-type" data-hc-setting="type">
                    <option selected value="fb">Facebook</option>
                    <option value="tw">Twitter</option>
                </select>
            </div>
            <div class="button-inner-options" data-width="450">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select ">
                        <p class="sch"><?php _e("Container type","hc") ?></p>
                        <select class="social-container-type" data-hc-setting="container_type" data-require-file="yes">
                            <option selected value=""><?php _e("None","hc") ?></option>
                            <option value="scroll_box" data-require-file="slimscroll"><?php _e("Scroll box","hc") ?></option>
                            <option value="slider" data-require-file="flexslider"><?php _e("Slider","hc") ?></option>
                            <option value="carousel" data-require-file="flexslider"><?php _e("Carousel","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Trigger","hc") ?></p>
                        <select data-hc-setting="trigger">
                            <option value=""><?php _e("Auto","hc") ?></option>
                            <option value="manual"><?php _e("Manual","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text full-input">
                        <p><?php _e("Access token","hc") ?></p>
                        <input data-hc-setting="access_token" type="text">
                    </li>
                    <li class="input-row input-checkbox">
                        <p class="sch"><?php _e("Hide comments","hc") ?></p>
                        <input data-hc-setting="hide_comments" type="checkbox">
                    </li>
                </ul>
            </div>
            <a class="input-row data-options-button data-options-slider" data-hc-setting="data_options_slider" data-hc-component="value" data-value="" href="#popover-box-flexslider">
                <i class="button-icon input-row icon-mixer-2"></i>
            </a>
            <a class="input-row data-options-button options-all data-options-scroll-box" data-hc-setting="data_options_scroll_box" data-hc-component="value" data-value="" href="#popover-box-scroll-box">
                <i class="button-icon input-row icon-mixer-2"></i>
                <input type="hidden" class="data_sub_options" data-hc-setting="data_sub_options_scroll_box" value="">
            </a>
            <a class="input-row data-options-button data-options-button-fb" style="margin-right: 0; display: inline-block" data-hc-setting="data_options_fb" data-hc-component="value" data-value="" data-default-values="" href="#popover-box-social-feeds-fb">
                <i class="button-icon input-row icon-gear-setting-2"></i>
            </a>
            <a class="input-row data-options-button data-options-button-tw" data-hc-setting="data_options_tw" data-hc-component="value" data-value="" data-default-values="" href="#popover-box-social-feeds-tw">
                <i class="button-icon input-row icon-gear-setting-2"></i>
            </a>
        </div>
    </div>
</div>
<div id="popover-box-social-feeds-fb" class="popover-box popover-list" style="display: none">
    <input type="hidden" class="file_require" value="progress_counter">
    <span class="close-button"></span>
    <ul class="list">
        <li class="input-row input-text">
            <p class="sch"><?php _e("Limit","hc") ?></p>
            <input data-option-id="limit" placeholder="4" type="text">
        </li>
        <li class="input-row input-text">
            <p class="sch"><?php _e("Timeout","hc") ?></p>
            <input data-option-id="timeout" placeholder="400" type="text">
        </li>
        <li class="input-row input-text">
            <p class="sch"><?php _e("Speed","hc") ?></p>
            <input data-option-id="speed" placeholder="400" type="text">
        </li>
        <li class="input-row input-select">
            <p class="sch"><?php _e("Effect","hc") ?></p>
            <select data-option-id="effect">
                <option selected value=""><?php _e("Slide","hc") ?></option>
                <option value="fade"><?php _e("Fade","hc") ?></option>
                <option value="none"><?php _e("None","hc") ?></option>
            </select>
        </li>
        <li class="input-row input-text">
            <p class="sch"><?php _e("Locale","hc") ?></p>
            <input data-option-id="locale" placeholder="en_US" type="text">
        </li>
        <li class="input-row input-select">
            <p class="sch"><?php _e("Avatar size","hc") ?></p>
            <select data-option-id="avatar_size">
                <option selected value=""><?php _e("Default","hc") ?></option>
                <option value="small"><?php _e("Small","hc") ?></option>
                <option value="normal"><?php _e("Normal","hc") ?></option>
                <option value="large"><?php _e("Large","hc") ?></option>
            </select>
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Message length","hc") ?></p>
            <input data-option-id="message_length" type="text" placeholder="200" />
        </li>
        <li class="input-row input-checkbox">
            <p class="sch"><?php _e("Show guest entries","hc") ?></p>
            <input data-option-id="show_guest_entries" data-default="true" checked type="checkbox">
        </li>
    </ul>
    <div class="clear"></div>
    <a class="button button-primary button-large popover-box-save"><?php _e("SAVE SETTINGS","hc") ?></a>
</div>
<div id="popover-box-social-feeds-tw" class="popover-box popover-list" style="display: none">
    <input type="hidden" class="file_require" value="progress_counter">
    <span class="close-button"></span>
    <ul class="list">
        <li class="input-row input-text">
            <p class="sch"><?php _e("Limit","hc") ?></p>
            <input data-option-id="limit" placeholder="4" type="text">
        </li>
        <li class="input-row input-checkbox">
            <p class="sch"><?php _e("Profile image","hc") ?></p>
            <input data-option-id="profile_image" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-checkbox">
            <p class="sch"><?php _e("Show time","hc") ?></p>
            <input data-option-id="show_time" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-checkbox">
            <p class="sch"><?php _e("Show media","hc") ?></p>
            <input data-option-id="show_media" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-checkbox">
            <p class="sch"><?php _e("Show retweeted text","hc") ?></p>
            <input data-option-id="show_retweeted_text" data-default="false" type="checkbox">
        </li>
    </ul>
    <div class="clear"></div>
    <a class="button button-primary button-large popover-box-save"><?php _e("SAVE SETTINGS","hc") ?></a>
</div>
<div id="cnt_hc_social_share_buttons">
    <div data-hc-id="_ID" data-hc-component="hc_social_share_buttons" data-hc-setting="main_content" class="hc-social-share-buttons hc-cnt-component">
        <?php hc_e_composer_item_menu("Social share buttons") ?>
        <div class="input-row input-select">
            <p class="sch"><?php _e("Style","hc") ?></p>
            <select class="social-type" data-hc-setting="type" data-require-file="yes">
                <option selected value="classic"><?php _e("Classic","hc") ?></option>
                <option value="classic_big"><?php _e("Classic big","hc") ?></option>
                <option value="circle_tt" data-require-file="toolstip"><?php _e("Circle toolstip","hc") ?></option>
                <option value="circle_tt_big" data-require-file="toolstip"><?php _e("Circle toolstip big","hc") ?></option>
                <option value="simple"><?php _e("Simple icons","hc") ?></option>
                <option value="button"><?php _e("Social button","hc") ?></option>
                <option value="button_2"><?php _e("Social button 2","hc") ?></option>
            </select>
        </div>
        <div class="button-inner-options" data-width="400">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-select">
                    <p><?php _e("Position","hc") ?></p>
                    <select data-hc-setting="position">
                        <option value="left"><?php _e("Left","hc") ?></option>
                        <option value="right"><?php _e("Right","hc") ?></option>
                        <option value="center"><?php _e("Center","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Type","hc") ?></p>
                    <select data-hc-setting="link_type">
                        <option value="share"><?php _e("Share","hc") ?></option>
                        <option value="link"><?php _e("Link","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-text small-input">
                    <p><?php _e("Text","hc") ?></p>
                    <input data-hc-setting="text" type="text" placeholder="<?php _e("Share","hc") ?>" value="<?php _e("Share","hc") ?>" />
                </li>
                <li class="input-row input-checkbox">
                    <p><?php _e("Social colors","hc") ?></p>
                    <input data-hc-setting="social_colors" type="checkbox">
                </li>
                <li class="input-row input-checkbox">
                    <p>Facebook</p>
                    <input data-hc-setting="fb" checked type="checkbox">
                </li>
                <li class="input-row input-text">
                    <p>Facebook <?php _e("link","hc") ?></p>
                    <input data-hc-setting="fb_link" type="text">
                </li>
                <li class="input-row input-checkbox">
                    <p>Twitter</p>
                    <input data-hc-setting="tw" checked type="checkbox">
                </li>
                <li class="input-row input-text">
                    <p>Twitter <?php _e("link","hc") ?></p>
                    <input data-hc-setting="tw_link" type="text">
                </li>
                <li class="input-row input-checkbox">
                    <p>Google+</p>
                    <input data-hc-setting="g+" checked type="checkbox">
                </li>
                <li class="input-row input-text">
                    <p>Google+ <?php _e("link","hc") ?></p>
                    <input data-hc-setting="g+_link" type="text">
                </li>
                <li class="input-row input-checkbox">
                    <p>LinkedIn</p>
                    <input data-hc-setting="li" checked type="checkbox">
                </li>
                <li class="input-row input-text">
                    <p>LinkedIn <?php _e("link","hc") ?></p>
                    <input data-hc-setting="li_link" type="text">
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_quote">
    <div data-hc-id="_ID" data-hc-component="hc_quote" data-hc-setting="main_content" class="hc-quote hc-cnt-component">
        <?php hc_e_composer_item_menu("Quote") ?>
        <div class="input-text-area input-row full-input only-input">
            <textarea data-hc-setting="text" placeholder="<?php _e("Text ...","hc") ?>"></textarea>
        </div>
        <div class="flex-box">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select ">
                        <p class="sch"><?php _e("Style","hc") ?></p>
                        <select data-hc-setting="style">
                            <option selected value=""><?php _e("Single quote","hc") ?></option>
                            <option value="double_quote"><?php _e("Double quote","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-text input-row full-only-input">
                        <p class="sch"><?php _e("Author","hc") ?></p>
                        <input data-hc-setting="author" type="text" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_separator">
    <div data-hc-id="_ID" data-hc-component="hc_separator" data-hc-setting="main_content" class="hc-separator hc-cnt-component">
        <?php hc_e_composer_item_menu("Separator") ?>
        <div class="input-row input-select">
            <select data-hc-setting="style">
                <option selected value=""><?php _e("Style","hc") ?> 1</option>
                <option value="a"><?php _e("Style","hc") ?> 2</option>
                <option value="b"><?php _e("Style","hc") ?> 3</option>
                <option value="c"><?php _e("Style","hc") ?> 4</option>
                <option value="d"><?php _e("Style","hc") ?> 5</option>
                <option value="d-dark"><?php _e("Style","hc") ?> 6</option>
                <option value="e"><?php _e("Style","hc") ?> 7</option>
                <option value="f-top"><?php _e("Style","hc") ?> 8</option>
                <option value="f"><?php _e("Style","hc") ?> 9</option>
                <option value="f-top f-dark"><?php _e("Style","hc") ?> 10</option>
                <option value="f f-dark"><?php _e("Style","hc") ?> 11</option>
                <option value="g"><?php _e("Style","hc") ?> 12</option>
                <option value="h"><?php _e("Style","hc") ?> 13</option>
                <option value="i"><?php _e("Style","hc") ?> 14</option>
            </select>
        </div>
    </div>
</div>
<div id="cnt_hc_space">
    <div data-hc-id="_ID" data-hc-component="hc_space" data-hc-setting="main_content" class="hc-space hc-cnt-component">
        <?php hc_e_composer_item_menu("Space") ?>
        <div class="input-row input-select only-input">
            <select data-hc-setting="size">
                <option selected value=""><?php _e("Space","hc") ?></option>
                <option value="l"><?php _e("Space l","hc") ?></option>
                <option value="m"><?php _e("Space m","hc") ?></option>
                <option value="s"><?php _e("Space s","hc") ?></option>
                <option value="xs"><?php _e("Space xs","hc") ?></option>
            </select>
        </div>
        <div class="button-inner-options" data-width="450">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-text">
                    <p><?php _e("Custom height","hc") ?></p>
                    <input data-hc-setting="height" type="text">
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_breadcrumbs">
    <div data-hc-id="_ID" data-hc-component="hc_breadcrumbs" data-hc-setting="main_content" class="hc-breadcrumbs hc-cnt-component">
        <?php hc_e_composer_item_menu("Breadcrumbs") ?>
        <div class="input-row input-select only-input">
            <select data-hc-setting="position">
                <option value="text-left"><?php _e("Left","hc") ?></option>
                <option value="text-center"><?php _e("Center","hc") ?></option>
                <option value="" selected><?php _e("Right","hc") ?></option>
            </select>
        </div>
    </div>
</div>
<div id="cnt_hc_table">
    <div data-hc-id="_ID" data-hc-component="hc_table" data-hc-setting="main_content" class="hc-table hc-cnt-component">
        <?php hc_e_composer_item_menu("Table") ?>
        <div class="tab-box tab-hc inverse">
            <div class="panel active">
                <div data-hc-id="sub1__ID" data-hc-component="this" data-hc-setting="table">
                    <div class="input-text input-row full-only-input">
                        <div class="flex-box">
                            <input data-hc-setting="c1_1_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                        </div>
                    </div>
                    <div class="input-text input-row input-repeater" data-value="">
                        <div class="repeater-source">
                            <div class="input-text input-row full-only-input order-active">
                                <input data-hc-setting="c1_1_content" type="text" value="" />
                            </div>
                        </div>
                        <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
                        <div class="clear"></div>
                        <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div data-hc-id="sub2__ID" data-hc-component="this" data-hc-setting="table">
                    <div class="input-text input-row full-only-input">
                        <div class="flex-box">
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c2_1_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c2_2_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="input-text input-row input-repeater" data-value="">
                        <div class="repeater-source">
                            <div class="flex-box">
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c2_1_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c2_2_content" type="text" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
                        <div class="clear"></div>
                        <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div data-hc-id="sub3__ID" data-hc-component="this" data-hc-setting="table">
                    <div class="input-text input-row full-only-input">
                        <div class="flex-box">
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c3_1_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c3_2_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c3_3_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="input-text input-row input-repeater" data-value="">
                        <div class="repeater-source">
                            <div class="flex-box">
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c3_1_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c3_2_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c3_3_content" type="text" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
                        <div class="clear"></div>
                        <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div data-hc-id="sub4__ID" data-hc-component="this" data-hc-setting="table">
                    <div class="input-text input-row full-only-input">
                        <div class="flex-box">
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c4_1_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c4_2_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c4_3_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c4_4_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="input-text input-row input-repeater" data-value="">
                        <div class="repeater-source">
                            <div class="flex-box">
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c4_1_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c4_2_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c4_3_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c4_4_content" type="text" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
                        <div class="clear"></div>
                        <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div data-hc-id="sub5__ID" data-hc-component="this" data-hc-setting="table">
                    <div class="input-text input-row full-only-input">
                        <div class="flex-box">
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c5_1_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c5_2_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c5_3_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c5_4_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c5_5_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="input-text input-row input-repeater" data-value="">
                        <div class="repeater-source">
                            <div class="flex-box">
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c5_1_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c5_2_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c5_3_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c5_4_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c5_5_content" type="text" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
                        <div class="clear"></div>
                        <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div data-hc-id="sub6__ID" data-hc-component="this" data-hc-setting="table">
                    <div class="input-text input-row full-only-input">
                        <div class="flex-box">
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c6_1_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c6_2_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c6_3_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c6_4_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c6_5_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c6_6_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="input-text input-row input-repeater" data-value="">
                        <div class="repeater-source">
                            <div class="flex-box">
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c6_1_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c6_2_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c6_3_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c6_4_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c6_5_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c6_6_content" type="text" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
                        <div class="clear"></div>
                        <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div data-hc-id="sub7__ID" data-hc-component="this" data-hc-setting="table">
                    <div class="input-text input-row full-only-input">
                        <div class="flex-box">
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c7_1_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c7_2_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c7_3_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c7_4_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c7_5_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c7_6_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c7_7_header" placeholder="Header" class="text-bold" type="text" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="input-text input-row input-repeater" data-value="">
                        <div class="repeater-source">
                            <div class="flex-box">
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c7_1_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c7_2_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c7_3_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c7_4_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c7_5_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c7_6_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c7_7_content" type="text" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
                        <div class="clear"></div>
                        <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel">
                <div data-hc-id="sub8__ID" data-hc-component="this" data-hc-setting="table">
                    <div class="input-text input-row full-only-input">
                        <div class="flex-box">
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c8_1_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c8_2_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c8_3_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c8_4_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c8_5_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c8_6_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c8_7_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                            <div class="input-text input-row full-only-input">
                                <input data-hc-setting="c8_8_header" placeholder="<?php _e("Header","hc") ?>" class="text-bold" type="text" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="input-text input-row input-repeater" data-value="">
                        <div class="repeater-source">
                            <div class="flex-box">
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c8_1_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c8_2_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c8_3_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c8_4_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c8_5_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c8_6_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c8_7_content" type="text" value="" />
                                </div>
                                <div class="input-text input-row full-only-input">
                                    <input data-hc-setting="c8_8_content" type="text" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
                        <div class="clear"></div>
                        <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">7</a></li>
                <li><a href="#">8</a></li>
            </ul>
            <input type="hidden" data-hc-setting="tab_index" class="tab_index" value="0">
        </div>
        <div class="input-row input-select">
            <p><?php _e("Style","hc") ?></p>
            <select data-hc-setting="style">
                <option value=""><?php _e("Default","hc") ?></option>
                <option value="table-striped"><?php _e("Striped","hc") ?></option>
                <option value="table-bordered"><?php _e("Bordered","hc") ?></option>
                <option value="table-condensed"><?php _e("Condensed","hc") ?></option>
            </select>
        </div>
        <div class="input-row input-checkbox">
            <p><?php _e("Advanced","hc") ?></p>
            <input data-hc-setting="advanced" data-require-file="bootgrid" type="checkbox">
        </div>
        <a class="input-row bootgrid-button" data-hc-setting="data_options" data-require="advanced" data-require-action="hide" data-hc-component="value" data-value="" data-default-values="" href="#popover-box-advanced-table">
            <i class="button-icon input-row icon-gear-setting-2"></i>
        </a>
    </div>
</div>
<div id="popover-box-advanced-table" class="popover-box popover-list search-filter" data-search-class="sch" style="display: none">
    <span class="close-button"></span>
    <div class="input-text input-row">
        <p><?php _e("Search","hc") ?></p>
        <input class="search" placeholder="<?php _e("Search...","hc") ?>" />
    </div>
    <ul class="list">
        <li class="input-row input-select">
            <p class="sch"><?php _e("Navigation","hc") ?></p>
            <select data-option-id="navigation">
                <option selected value=""><?php _e("Header and footer","hc") ?></option>
                <option value="1"><?php _e("Header","hc") ?></option>
                <option value="2"><?php _e("Footer","hc") ?></option>
                <option value="0"><?php _e("None","hc") ?></option>
            </select>
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Padding","hc") ?></p>
            <input data-option-id="padding" placeholder="2" data-mask="number" type="text">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Column Selection","hc") ?></p>
            <input data-option-id="columnSelection" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Row Selection","hc") ?></p>
            <input data-option-id="selection" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Multi select","hc") ?></p>
            <input data-option-id="multiSelect" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Sorting","hc") ?></p>
            <input data-option-id="sorting" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Multi sorting","hc") ?></p>
            <input data-option-id="multiSort" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Keep selection","hc") ?></p>
            <input data-option-id="keepSelection" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Data service URL","hc") ?></p>
            <input data-option-id="url" type="text">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Case sensitive","hc") ?></p>
            <input data-option-id="caseSensitive" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Request handler","hc") ?></p>
            <input data-option-id="requestHandler" placeholder="function (request) { return request; }" type="text">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Response handler","hc") ?></p>
            <input data-option-id="responseHandler" placeholder="function (response) { return response; }" type="text">
        </li>
    </ul>
    <div class="clear"></div>
    <a class="button button-primary button-large popover-box-save"><?php _e("SAVE SETTINGS","hc") ?></a>
</div>
<div id="cnt_hc_full_page_menu">
    <div data-hc-id="fullpage_menu" data-hc-component="hc_full_page_menu" class="hc-icon-list hc_full_page_menu">
        <div class="input-css-repeater">
            <div class="css-repeater-container">
                <?php for ($i = 1; $i < 16; $i++) { ?>
                <div data-hc-id="item_<?php echo esc_attr($i); ?>" data-hc-setting="item_<?php echo esc_attr($i); ?>" class="css-repeater-item">
                    <div class="flex-box input-text input-row full-input">
                        <i class="input-row button-icon button-icons-list-all icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value="">
                            <input type="hidden" data-hc-setting="icon_style" class="icon-style" value="">
                            <input type="hidden" data-hc-setting="icon_image" class="icon-image" value="">
                        </i>
                        <input type="text" data-hc-setting="text" placeholder="<?php _e("Menu item name","hc") ?>" />
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="clear"></div>
            <div class="input-row full-input input-select repeater-items">
                <p><?php _e("Items","hc") ?></p>
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
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                </select>
            </div>
        </div>
        <p class="hc_help_label"><i class="icon-help"></i><?php _e("Add a new section for every menu item","hc") ?></p>
    </div>
</div>
<div id="popover-box-full-page" class="popover-box popover-list search-filter" data-search-class="sch" style="display: none">
    <span class="close-button"></span>
    <div class="input-text input-row">
        <p><?php _e("Search","hc") ?></p>
        <input class="search" placeholder="<?php _e("Search","hc") ?>..." />
    </div>
    <ul class="list">
        <li class="input-row input-checkbox small-input">
            <p class="sch">CSS3</p>
            <input data-option-id="css3" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Scrolling speed","hc") ?></p>
            <input data-option-id="scrollingSpeed" data-default="700" placeholder="700" data-mask="number" type="text">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Auto scrolling","hc") ?></p>
            <input data-option-id="autoScrolling" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Fit to section","hc") ?></p>
            <input data-option-id="fitToSection" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Fit to section delay","hc") ?></p>
            <input data-option-id="fitToSectionDelay" data-default="1000" placeholder="1000" data-mask="number" type="text">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Scroll bar","hc") ?></p>
            <input data-option-id="scrollBar" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Easing","hc") ?></p>
            <input data-option-id="easing" data-default="easeInOutCubic" placeholder="easeInOutCubic" type="text">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Easing CSS3","hc") ?></p>
            <input data-option-id="easingcss3" data-default="ease" placeholder="ease" type="text">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Loop bottom","hc") ?></p>
            <input data-option-id="loopBottom" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Loop top","hc") ?></p>
            <input data-option-id="loopTop" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Loop horizontal","hc") ?></p>
            <input data-option-id="loopHorizontal" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Continuous vertical","hc") ?></p>
            <input data-option-id="continuousVertical" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Normal elements","hc") ?></p>
            <input data-option-id="normalScrollElements" placeholder="#element1" type="text">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Scroll overflow","hc") ?></p>
            <input data-option-id="scrollOverflow" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Touch sensitivity","hc") ?></p>
            <input data-option-id="touchSensitivity" data-default="15" placeholder="15" data-mask="number" type="text">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Keyboard scrolling","hc") ?></p>
            <input data-option-id="keyboardScrolling" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Animate anchor","hc") ?></p>
            <input data-option-id="animateAnchor" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Record history","hc") ?></p>
            <input data-option-id="recordHistory" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Control arrows","hc") ?></p>
            <input data-option-id="controlArrows" data-default="true" checked type="checkbox">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Resize","hc") ?></p>
            <input data-option-id="resize" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-checkbox small-input">
            <p class="sch"><?php _e("Mobile fullpage","hc") ?></p>
            <input data-option-id="mobileMode" data-default="false" type="checkbox">
        </li>
    </ul>
    <div class="clear"></div>
    <a class="button button-primary button-large popover-box-save"><?php _e("SAVE SETTINGS","hc") ?></a>
</div>
<div id="cnt_hc_inner_menu">
    <div data-hc-id="_ID" data-hc-component="hc_inner_menu" data-hc-setting="main_content" class="hc-inner-menu hc-cnt-component">
        <input type="hidden" class="page_setting" value="inner_menu">
        <?php hc_e_composer_item_menu("Inner menu") ?>
        <div class="input-text input-row input-repeater" data-value="">
            <div class="repeater-source">
                <i class="input-row button-icon button-checkbox icon-ios-arrow-forward hc-inner-menu-child" data-hc-setting="child" data-hc-component="value" data-value=""></i>
                <div class="flex-box">
                    <i class="input-row button-icon button-icons-list icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
                    <input class="hc-inner-menu-item-name" type="text" data-hc-setting="text" placeholder="<?php _e("Menu item name","hc") ?>" />
                </div>
                <div class="input-row full-input" data-dependence-show="one_page">
                    <input type="text" data-hc-setting="link" placeholder="<?php _e("Link","hc") ?>" />
                </div>
            </div>
            <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
            <div class="clear"></div>
            <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
        </div>    
        <div class="button-inner-options" data-width="450">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-select">
                    <p><?php _e("Type","hc") ?></p>
                    <select data-hc-setting="type">
                        <option value="horizontal"><?php _e("Horizontal","hc") ?></option>
                        <option value="vertical"><?php _e("Vertical","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Style","hc") ?></p>
                    <select data-hc-setting="style">
                        <option value="" selected><?php _e("Classic","hc") ?></option>
                        <option value="ms-rounded"><?php _e("Rounded","hc") ?></option>
                        <option value="ms-minimal"><?php _e("Minimal","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Alignment","hc") ?></p>
                    <select data-hc-setting="alignment">
                        <option selected value=""><?php _e("Left","hc") ?></option>
                        <option value="nav-right"><?php _e("Right","hc") ?></option>
                        <option value="nav-center"><?php _e("Center","hc") ?></option>
                    </select>
                </li>
                <li class="input-row input-checkbox">
                    <p><?php _e("Automatic","hc") ?></p>
                    <input data-hc-setting="one_page" data-dependence-trigger="hide" type="checkbox">
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_contact_form">
    <div data-hc-id="_ID" data-hc-component="hc_contact_form" data-hc-setting="main_content" class="hc-contact-form hc-cnt-component">
        <input type="hidden" class="file_require" value="contact_form">
        <input type="hidden" class="file_require" value="datepicker">
        <?php hc_e_composer_item_menu("Contact form") ?>
        <div class="input-text input-row input-repeater" data-value="">
            <div class="repeater-source">
                <div class="flex-box">
                    <div class="input-row input-select only-input">
                        <select data-hc-setting="input_type">
                            <option value="text" selected><?php _e("Text","hc") ?></option>
                            <option value="textarea"><?php _e("Textarea","hc") ?></option>
                            <option value="email"><?php _e("Email","hc") ?></option>
                            <option value="select"><?php _e("Select 0-10","hc") ?></option>
                            <option value="number"><?php _e("Number","hc") ?></option>
                            <option value="calendar"><?php _e("Calendar","hc") ?></option>
                            <option value="link"><?php _e("Link","hc") ?></option>
                        </select>
                    </div>
                    <div title="Column width" class="input-row input-select only-input select-col">
                        <select data-hc-setting="column">
                            <option value="col-md-12" selected>12</option>
                            <option value="col-md-6">6</option>
                            <option value="col-md-4">4</option>
                            <option value="col-md-3">3</option>
                            <option value="col-md-2">2</option>
                            <option value="col-md-1">1</option>
                        </select>
                    </div>
                    <div title="Field is required" class="input-row only-input input-checkbox">
                        <input data-hc-setting="required" type="checkbox">
                    </div>
                    <div class="input-text input-row full-only-input">
                        <input data-hc-setting="text" placeholder="Name" type="text" value="" />
                    </div>
                </div>
            </div>
            <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
            <div class="clear"></div>
            <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="button-inner-options">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-text input-row">
                    <p><?php _e("Recipient's email","hc") ?></p>
                    <input data-hc-setting="recipient_email" placeholder="<?php _e("your-email@domain.com","hc") ?>" type="text" value="">
                </li>
                <li class="input-text input-row">
                    <p><?php _e("Subject","hc") ?></p>
                    <input data-hc-setting="subject" placeholder="" type="text" value="">
                </li>
                <li class="input-row input-checkbox">
                    <p><?php _e("Label","hc") ?></p>
                    <input data-hc-setting="label" checked type="checkbox">
                </li>
                <li class="input-row input-checkbox">
                    <p><?php _e("Placeholder","hc") ?></p>
                    <input data-hc-setting="placeholder" checked type="checkbox">
                </li>
                <?php hc_button_options() ?>
                <li class="input-row input-select">
                    <p><?php _e("Button position","hc") ?></p>
                    <select data-hc-setting="button_position">
                        <option selected="selected" value="left"><?php _e("Left","hc") ?></option>
                        <option value="right"><?php _e("Right","hc") ?></option>
                        <option value="center"><?php _e("Center","hc") ?></option>
                        <option value="inline"><?php _e("Inline","hc") ?></option>
                    </select>
                </li>
                <li class="input-text input-row">
                    <p><?php _e("Button icon","hc") ?></p>
                    <input data-hc-setting="button_icon" placeholder="fa fa-icon" type="text" value="">
                </li>
                <li class="input-text input-row">
                    <p><?php _e("Recaptcha key","hc") ?></p>
                    <input data-hc-setting="recaptcha" placeholder="Google recaptcha key" type="text" value="" data-require-file="recaptcha">
                </li>
                <li class="input-text input-row">
                    <p><?php _e("Success message","hc") ?></p>
                    <input data-hc-setting="success_message" placeholder="" type="text" value="Congratulations. Your message has been sent successfully.">
                </li>
                <li class="input-text input-row">
                    <p><?php _e("Error message","hc") ?></p>
                    <input data-hc-setting="error_message" placeholder="" type="text" value="Error, please retry. Your message has not been sent.">
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_text_block">
    <div data-hc-id="_ID" data-hc-component="hc_text_block" data-hc-setting="main_content" class="hc-text-block hc-cnt-component">
        <?php hc_e_composer_item_menu("Text block") ?>
        <div class="input-text-area input-row full-input only-input">
            <textarea data-hc-setting="content" placeholder="..."></textarea>
        </div>
    </div>
</div>
<div id="cnt_hc_wp_editor">
    <div data-hc-id="_ID" data-hc-component="hc_wp_editor" data-hc-setting="main_content" class="hc-wp-editor hc-cnt-component">
        <?php hc_e_composer_item_menu("WordPress editor") ?>
        <div class="cnt-wpe input-row" data-hc-setting="editor_content" data-hc-component="html"></div>
    </div>
</div>
<div id="cnt_hc_code_block">
    <div data-hc-id="_ID" data-hc-component="hc_code_block" data-hc-setting="main_content" class="hc-code-block hc-cnt-component">
        <?php hc_e_composer_item_menu("Code block") ?>
        <div class="input-text-area input-row full-input only-input">
            <textarea data-hc-setting="content" data-hc-component="base64" spellcheck="false" placeholder="<?php _e("Not insert any <script></script> or <style></style> tag","hc") ?>"></textarea>
        </div>
        <div class="input-row input-select">
            <p><?php _e("Language","hc") ?></p>
            <select data-hc-setting="language">
                <option selected value=""><?php _e("Generic","hc") ?></option>
                <option value="js">Javascript</option>
                <option value="css">CSS</option>
            </select>
        </div>
    </div>
</div>
<div id="cnt_hc_fp_bottom_top_container">
    <div data-hc-id="_ID" data-hc-component="hc_fp_bottom_top_container" data-hc-setting="main_content" class="hc-fp-bottom-top-container hc-cnt-component">
        <?php hc_e_composer_item_menu("Bottom-Top container") ?>
        <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row">
            <div class="clear"></div>
            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Position","hc") ?></p>
                        <select data-hc-setting="position">
                            <option selected value="bottom"><?php _e("Bottom","hc") ?></option>
                            <option value="top"><?php _e("Top","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Full width","hc") ?></p>
                        <input data-hc-setting="full_width" type="checkbox">
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_fp_slides">
    <div data-hc-id="_ID" data-hc-component="hc_fp_slides" data-hc-setting="main_content" class="hc-fp-slides hc-cnt-component">
        <?php hc_e_composer_item_menu("Slides") ?>
        <div class="tab-box inverse">
            <div class="panel active">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Slide name","hc") ?></p>
                        <input data-hc-setting="name_1" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon_1" data-hc-component="value" data-value=""></i>
                </div>
                <hr class="space s" />
                <div data-hc-setting="content_1" data-hc-id="main_content_1" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image_1" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Slide name","hc") ?></p>
                        <input data-hc-setting="name_2" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon_2" data-hc-component="value" data-value=""></i>
                </div>
                <hr class="space s" />
                <div data-hc-setting="content_2" data-hc-id="main_content_2" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image_2" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Slide name","hc") ?></p>
                        <input data-hc-setting="name_3" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon_3" data-hc-component="value" data-value=""></i>
                </div>
                <hr class="space s" />
                <div data-hc-setting="content_3" data-hc-id="main_content_3" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image_3" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Slide name","hc") ?></p>
                        <input data-hc-setting="name_4" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon_4" data-hc-component="value" data-value=""></i>
                </div>
                <hr class="space s" />
                <div data-hc-setting="content_4" data-hc-id="main_content_4" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image_4" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Slide name","hc") ?></p>
                        <input data-hc-setting="name_5" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon_5" data-hc-component="value" data-value=""></i>
                </div>
                <hr class="space s" />
                <div data-hc-setting="content_5" data-hc-id="main_content_5" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image_5" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Slide name","hc") ?></p>
                        <input data-hc-setting="name_6" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon_6" data-hc-component="value" data-value=""></i>
                </div>
                <hr class="space s" />
                <div data-hc-setting="content_6" data-hc-id="main_content_6" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image_6" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Slide name","hc") ?></p>
                        <input data-hc-setting="name_7" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon_7" data-hc-component="value" data-value=""></i>
                </div>
                <hr class="space s" />
                <div data-hc-setting="content_7" data-hc-id="main_content_7" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image_7" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Slide name","hc") ?></p>
                        <input data-hc-setting="name_8" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon_8" data-hc-component="value" data-value=""></i>
                </div>
                <hr class="space s" />
                <div data-hc-setting="content_8" data-hc-id="main_content_8" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image_8" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">7</a></li>
                <li><a href="#">8</a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Arrows","hc") ?></p>
                        <select data-hc-setting="arrows">
                            <option selected value=""><?php _e("None","hc") ?></option>
                            <option value="next"><?php _e("Only next","hc") ?></option>
                            <option value="all"><?php _e("All","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Left arrow text","hc") ?></p>
                        <input data-hc-setting="left_arrow" type="text">
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Right arrow text","hc") ?></p>
                        <input data-hc-setting="right_arrow" type="text">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show menu","hc") ?></p>
                        <input data-hc-setting="menu" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Menu style","hc") ?></p>
                        <select data-hc-setting="menu_style">
                            <option selected value=""><?php _e("Default","hc") ?></option>
                            <option selected value="ms-minimal"><?php _e("Style 1","hc") ?></option>
                            <option value="ms-rounded"><?php _e("Style 2","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Menu position","hc") ?></p>
                        <select data-hc-setting="menu_position">
                            <option selected value="center"><?php _e("Center","hc") ?></option>
                            <option value="left"><?php _e("Left","hc") ?></option>
                            <option value="right"><?php _e("Right","hc") ?></option>
                            <option value="center-bottom"><?php _e("Center bottom","hc") ?></option>
                            <option value="left-bottom"><?php _e("Left bottom","hc") ?></option>
                            <option value="right-bottom"><?php _e("Right bottom","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Menu margins","hc") ?></p>
                        <input data-hc-setting="menu_margins" type="text" placeholder="0" data-mask="number">
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
