<?php
// =============================================================================
// CONTAINERS.PHP
// -----------------------------------------------------------------------------
// Hybric Composer containers admin components
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
?>
<div id="cnt_hc_scroll_box">
    <div data-hc-id="_ID" data-hc-component="hc_scroll_box" data-hc-setting="main_content" class="hc-scroll-box hc-cnt-component">
        <input type="hidden" class="file_require" value="slimscroll">
        <?php hc_e_composer_item_menu("Scroll box") ?>
        <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row ">
            <div class="clear"></div>
            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="input-row input-text small-input">
                <p><?php _e("Height","hc") ?></p>
                <input data-hc-setting="height" placeholder="--" type="text">
            </div>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Full screen","hc") ?></p>
                        <input data-hc-setting="full_screen" type="checkbox">
                    </li>
                    <li class="input-row input-text small-input" data-dependence-show="full_screen">
                        <p><?php _e("Offset height","hc") ?></p>
                        <input data-hc-setting="remove_height" placeholder="0" type="text">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Mobile disabled","hc") ?></p>
                        <input data-hc-setting="mobile_disabled" checked type="checkbox">
                    </li>
                </ul>
            </div>
            <a class="input-row" data-hc-setting="data_options" data-hc-component="value" data-value="" data-default-values="" href="#popover-box-scroll-box">
                <i class="button-icon input-row icon-gear-setting-2"></i>
            </a>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="popover-box-scroll-box" class="popover-box popover-list search-filter" data-search-class="sch" style="display: none">
    <span class="close-button"></span>
    <div class="input-text input-row">
        <p><?php _e("Search","hc") ?></p>
        <input class="search" placeholder="<?php _e("Search...","hc") ?>" />
    </div>
    <ul class="list">
        <li class="divider data-sub-option"><?php _e("Section","hc") ?></li>
        <li class="input-row input-text small-input">
            <p><?php _e("Height","hc") ?></p>
            <input data-sub-option-id="height" placeholder="0" value="300" data-mask="number" type="text">
        </li>
        <li class="input-row input-text small-input">
            <p><?php _e("Offset height","hc") ?></p>
            <input data-sub-option-id="height_remove" placeholder="0" data-mask="number" type="text">
        </li>
        <li class="input-row input-text small-input">
            <p><?php _e("Mobile disabled","hc") ?></p>
            <input data-sub-option-id="mobile_disabled" data-default="false" type="checkbox">
        </li>
        <li class="divider data-sub-option"><?php _e("All options","hc") ?></li>
        <li class="input-row input-text small-input">
            <p><?php _e("Size","hc") ?></p>
            <input data-option-id="size" placeholder="4px" type="text">
        </li>
        <li class="input-row input-select">
            <p class="sch"><?php _e("Position","hc") ?></p>
            <select data-option-id="direction" data-default="right">
                <option selected value="right"><?php _e("Right","hc") ?></option>
                <option value="left"><?php _e("Left","hc") ?></option>
            </select>
        </li>
        <li class="input-row input-text">
            <p class="sch"><?php _e("Color","hc") ?></p>
            <input data-option-id="color" placeholder="#464646" type="text">
        </li>
        <li class="input-row input-checkbox">
            <p class="sch"><?php _e("Always visible","hc") ?></p>
            <input data-option-id="alwaysVisible" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Distance","hc") ?></p>
            <input data-option-id="distance" type="text" placeholder="1px" />
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Start","hc") ?></p>
            <input data-option-id="start" type="text" />
        </li>
        <li class="input-row input-text">
            <p class="sch"><?php _e("Wheel step","hc") ?></p>
            <input data-option-id="wheelStep" type="text" placeholder="20" data-mask="number">
        </li>
        <li class="input-row input-checkbox">
            <p class="sch"><?php _e("Rail visible","hc") ?></p>
            <input data-option-id="railVisible" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text">
            <p class="sch"><?php _e("Rail color","hc") ?></p>
            <input data-option-id="railColor" placeholder="#333333" type="text">
        </li>
        <li class="input-row input-text">
            <p class="sch"><?php _e("Rail opacity","hc") ?></p>
            <input data-option-id="railOpacity" type="text" placeholder="1">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Allow page scroll","hc") ?></p>
            <input data-option-id="allowPageScroll" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-text small-input">
            <p class="sch"><?php _e("Touch scroll step","hc") ?></p>
            <input data-option-id="touchScrollStep" type="text" placeholder="200" data-mask="number" value="" />
        </li>
    </ul>
    <div class="clear"></div>
    <a class="button button-primary button-large popover-box-save"><?php _e("SAVE SETTINGS","hc") ?></a>
</div>
<div id="cnt_hc_grid_table">
    <div data-hc-id="_ID" data-hc-component="hc_grid_table" data-hc-setting="main_content" class="hc-grid-table hc-cnt-component">
        <?php hc_e_composer_item_menu("Grid table") ?>
        <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row ">
            <div class="clear"></div>
            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="input-row input-text small-input">
                <p><?php _e("Rows","hc") ?></p>
                <input data-hc-setting="rows" placeholder="0" type="text" data-mask="number" value="0">
            </div>
            <div class="input-row input-text small-input">
                <p><?php _e("Columns","hc") ?></p>
                <input data-hc-setting="cols" placeholder="0" type="text" data-mask="number" data-layout="column" value="0">
            </div>
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Full border","hc") ?></p>
                        <input data-hc-setting="full-border" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Mobile full width","hc") ?></p>
                        <input data-hc-setting="full-mobile" type="checkbox">
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_image_slider">
    <div data-hc-id="_ID" data-hc-component="hc_image_slider" data-hc-setting="main_content" class="hc-image-slider hc-cnt-component">
        <input type="hidden" class="file_require" value="flexslider">
        <?php hc_e_composer_item_menu("Image slider") ?>
        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="slides" data-hc-id="slides" data-hc-container="repeater">
            <span class="close-button"></span>
            <div class="upload-container upload-add">
                <div data-hc-component="upload" class="upload-btn"></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Outer arrows","hc") ?></p>
                        <input data-hc-setting="outer_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Always visible arrows","hc") ?></p>
                        <input data-hc-setting="visible_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Inner dots","hc") ?></p>
                        <input data-hc-setting="nav_inner" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Lightbox","hc") ?></p>
                        <input data-hc-setting="lightbox" type="checkbox" data-require-file="lightbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Lightbox animation","hc") ?></p>
                        <select data-hc-setting="lightbox_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Images animation","hc") ?></p>
                        <select data-hc-setting="image_animation" class="animations-list">
                            <?php hc_html_image_animations();  ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Images size","hc") ?></p>
                        <select data-hc-setting="thumb_size">
                            <?php hc_thumb_sizes(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Lightbox image size","hc") ?></p>
                        <select data-hc-setting="image_size">
                            <?php hc_thumb_sizes(); ?>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Thumbnail","hc") ?></p>
                        <input data-hc-setting="thumbnail" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("PNG optimized","hc") ?></p>
                        <input data-hc-setting="png-over" type="checkbox">
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("CSS classes","hc") ?></p>
                        <input data-hc-setting="custom_classes" type="text">
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
            <a class="input-row" data-hc-setting="data_options" data-hc-component="value" data-value="" href="#popover-box-flexslider"><i class="button-icon input-row icon-gear-setting-2"></i></a>
            <div class="input-row input-select">
                <p><?php _e("Type","hc") ?></p>
                <select data-hc-setting="type">
                    <option value="slider"><?php _e("Slider","hc") ?></option>
                    <option value="carousel"><?php _e("Carousel","hc") ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_slider">
    <div data-hc-id="_ID" data-hc-component="hc_slider" data-hc-setting="main_content" class="hc-slider hc-cnt-component">
        <input type="hidden" class="file_require" value="flexslider">
        <?php hc_e_composer_item_menu("Slider") ?>
        <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row flex-repeater">
            <div class="clear"></div>
            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Outer arrows","hc") ?></p>
                        <input data-hc-setting="outer_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Vertical middle","hc") ?></p>
                        <input data-hc-setting="vertical_middle_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Always visible arrows","hc") ?></p>
                        <input data-hc-setting="visible_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Inner dots","hc") ?></p>
                        <input data-hc-setting="nav_inner" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("PNG optimized","hc") ?></p>
                        <input data-hc-setting="png-over" type="checkbox">
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
            <a class="input-row" data-hc-setting="data_options" data-hc-component="value" data-value="" href="#popover-box-flexslider"><i class="button-icon input-row icon-gear-setting-2"></i></a>
            <div class="input-row input-select">
                <p><?php _e("Type","hc") ?></p>
                <select data-hc-setting="type">
                    <option value="slider"><?php _e("Slider","hc") ?></option>
                    <option value="carousel"><?php _e("Carousel","hc") ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_adv_slider">
    <div data-hc-id="_ID" data-hc-component="hc_adv_slider" data-hc-setting="main_content" class="hc-adv-slider hc-cnt-component">
        <input type="hidden" class="file_require" value="flexslider">
        <?php hc_e_composer_item_menu("Advanced slider") ?>
        <div class="tab-box inverse">
            <div class="panel active">
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
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Outer arrows","hc") ?></p>
                        <input data-hc-setting="outer_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Vertical middle","hc") ?></p>
                        <input data-hc-setting="vertical_middle_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Always visible arrows","hc") ?></p>
                        <input data-hc-setting="visible_arrows" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Inner dots","hc") ?></p>
                        <input data-hc-setting="nav_inner" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Trigger","hc") ?></p>
                        <select data-hc-setting="trigger">
                            <option value=""><?php _e("Auto","hc") ?></option>
                            <option value="manual"><?php _e("Manual","hc") ?></option>
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
            <a class="input-row" data-hc-setting="data_options" data-hc-component="value" data-value="" href="#popover-box-flexslider"><i class="button-icon input-row icon-gear-setting-2"></i></a>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_image_coverflow">
    <div data-hc-id="_ID" data-hc-component="hc_image_coverflow" data-hc-setting="main_content" class="hc-image-coverflow hc-cnt-component">
        <input type="hidden" class="file_require" value="flipster">
        <?php hc_e_composer_item_menu("Image coverflow") ?>
        <div class="upload-box upload-multi upload-row" data-hc-setting="slides" data-hc-id="slides" data-hc-container="repeater">
            <span class="close-button"></span>
            <div class="upload-container upload-add">
                <div data-hc-component="upload" class="upload-btn"></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Slide width","hc") ?></p>
                        <input data-hc-setting="slide_width" type="text">
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Slide width mobile","hc") ?></p>
                        <input data-hc-setting="slide_width_mobile" type="text">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Lightbox","hc") ?></p>
                        <input data-hc-setting="lightbox" type="checkbox" data-require-file="lightbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Lightbox animation","hc") ?></p>
                        <select data-hc-setting="lightbox_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Images animation","hc") ?></p>
                        <select data-hc-setting="image_animation" class="animations-list">
                            <?php hc_html_image_animations();  ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Images size","hc") ?></p>
                        <select data-hc-setting="thumb_size">
                            <?php hc_thumb_sizes(); ?>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Thumbnail","hc") ?></p>
                        <input data-hc-setting="thumbnail" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("PNG optimized","hc") ?></p>
                        <input data-hc-setting="png-over" type="checkbox">
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("CSS classes","hc") ?></p>
                        <input data-hc-setting="custom_classes" type="text">
                    </li>
                    <li class="input-row input-select">
                        <p class="sch"><?php _e("Trigger","hc") ?></p>
                        <select data-hc-setting="trigger">
                            <option value=""><?php _e("Auto","hc") ?></option>
                            <option value="manual"><?php _e("Manual","hc") ?></option>
                        </select>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_coverflow">
    <div data-hc-id="_ID" data-hc-component="hc_coverflow" data-hc-setting="main_content" class="hc-coverflow hc-cnt-component">
        <input type="hidden" class="file_require" value="flipster">
        <?php hc_e_composer_item_menu("Coverflow") ?>
        <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row flex-repeater">
            <div class="clear"></div>
            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Slide width","hc") ?></p>
                        <input data-hc-setting="slide_width" type="text">
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Slide width mobile","hc") ?></p>
                        <input data-hc-setting="slide_width_mobile" type="text">
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
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_tab">
    <div data-hc-id="_ID" data-hc-component="hc_tab" data-hc-setting="main_content" class="hc-tab hc-cnt-component">
        <input type="hidden" class="file_require" value="components">
        <input type="hidden" class="file_require" value="tab_accordion">
        <?php hc_e_composer_item_menu("Tab") ?>
        <div class="tab-box inverse">
            <div class="panel active">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Tab name","hc") ?></p>
                        <input data-hc-setting="name_1" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_1" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_1" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_1" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_1" data-hc-id="main_content_1" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Tab name","hc") ?></p>
                        <input data-hc-setting="name_2" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_2" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_2" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_2" data-hc-id="main_content_2" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Tab name","hc") ?></p>
                        <input data-hc-setting="name_3" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_3" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_3" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_3" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_3" data-hc-id="main_content_3" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Tab name","hc") ?></p>
                        <input data-hc-setting="name_4" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_4" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_4" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_4" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_4" data-hc-id="main_content_4" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Tab name","hc") ?></p>
                        <input data-hc-setting="name_5" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_5" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_5" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_5" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_5" data-hc-id="main_content_5" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Tab name","hc") ?></p>
                        <input data-hc-setting="name_6" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_6" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_6" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_6" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_6" data-hc-id="main_content_6" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Tab name","hc") ?></p>
                        <input data-hc-setting="name_7" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_7" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_7" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_7" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_7" data-hc-id="main_content_7" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Tab name","hc") ?></p>
                        <input data-hc-setting="name_8" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_8" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_8" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_8" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_8" data-hc-id="main_content_8" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
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
        <div class="input-row input-select">
            <p>Style</p>
            <select data-hc-setting="style">
                <option value="classic" selected><?php _e("Classic","hc") ?></option>
                <option value="classic-bottom"><?php _e("Classic bottom","hc") ?></option>
                <option value="justified"><?php _e("Justified","hc") ?></option>
                <option value="justified-bottom"><?php _e("Justified bottom","hc") ?></option>
                <option value="centered"><?php _e("Centered","hc") ?></option>
                <option value="centered-bottom"><?php _e("Centered bottom","hc") ?></option>
                <option value="vertical-left"><?php _e("Vertical left","hc") ?></option>
                <option value="vertical-left-justified"><?php _e("Vertical left justified","hc") ?></option>
                <option value="vertical-right"><?php _e("Vertical right","hc") ?></option>
                <option value="vertical-right-justified"><?php _e("Vertical right justified","hc") ?></option>
            </select>
        </div>
        <div class="button-inner-options">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-checkbox">
                    <p><?php _e("Pills style","hc") ?></p>
                    <input data-hc-setting="pills" type="checkbox">
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Animation","hc") ?></p>
                    <select data-hc-setting="animation" class="animations-list">
                        <?php hc_html_animations(); ?>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Icon animation","hc") ?></p>
                    <select data-hc-setting="animation_icon" class="animations-list">
                        <?php hc_html_animations(); ?>
                    </select>
                </li>
                <li class="input-row input-select">
                    <p><?php _e("Vertical layout","hc") ?></p>
                    <select data-hc-setting="layout">
                        <option value="" selected><?php _e("Default","hc") ?></option>
                        <option value="3-9"><?php _e("3-9","hc") ?></option>
                        <option value="2-10"><?php _e("2-10","hc") ?></option>
                    </select>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_steps">
    <div data-hc-id="_ID" data-hc-component="hc_steps" data-hc-setting="main_content" class="hc-steps hc-cnt-component">
        <input type="hidden" class="file_require" value="components">
        <?php hc_e_composer_item_menu("Steps") ?>
        <div class="tab-box inverse">
            <div class="panel active">
                <div class="row">
                    <div class="col-md-4">
                        <div class="flex-box">
                            <div class="input-row full-only-input">
                                <input data-hc-setting="name_1" placeholder="<?php _e("Step name","hc") ?>" class="input-link" type="text" value="" />
                            </div>
                            <div class="input-row small-input only-input">
                                <input data-hc-setting="number_1" class="input-link" type="text" value="1" />
                            </div>
                        </div>
                        <div data-hc-setting="content_1" data-hc-id="main_content_1" data-hc-container="repeater" class="row">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="flex-box">
                            <div class="input-row full-only-input">
                                <input data-hc-setting="name_2" placeholder="<?php _e("Step name","hc") ?>" class="input-link" type="text" value="" />
                            </div>
                            <div class="input-row small-input only-input">
                                <input data-hc-setting="number_2" class="input-link" type="text" value="2" />
                            </div>
                        </div>
                        <div data-hc-setting="content_2" data-hc-id="main_content_2" data-hc-container="repeater" class="row">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="flex-box">
                            <div class="input-row full-only-input">
                                <input data-hc-setting="name_3" placeholder="<?php _e("Step name","hc") ?>" class="input-link" type="text" value="" />
                            </div>
                            <div class="input-row small-input only-input">
                                <input data-hc-setting="number_3" class="input-link" type="text" value="3" />
                            </div>
                        </div>
                        <div data-hc-setting="content_3" data-hc-id="main_content_3" data-hc-container="repeater" class="row">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="flex-box">
                            <div class="input-row full-only-input">
                                <input data-hc-setting="name_4" placeholder="<?php _e("Step name","hc") ?>" class="input-link" type="text" value="" />
                            </div>
                            <div class="input-row small-input only-input">
                                <input data-hc-setting="number_4" class="input-link" type="text" value="4" />
                            </div>
                        </div>
                        <div data-hc-setting="content_4" data-hc-id="main_content_4" data-hc-container="repeater" class="row">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="flex-box">
                            <div class="input-row full-only-input">
                                <input data-hc-setting="name_5" placeholder="<?php _e("Step name","hc") ?>" class="input-link" type="text" value="" />
                            </div>
                            <div class="input-row small-input only-input">
                                <input data-hc-setting="number_5" class="input-link" type="text" value="5" />
                            </div>
                        </div>
                        <div data-hc-setting="content_5" data-hc-id="main_content_5" data-hc-container="repeater" class="row">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="flex-box">
                            <div class="input-row full-only-input">
                                <input data-hc-setting="name_6" placeholder="<?php _e("Step name","hc") ?>" class="input-link" type="text" value="" />
                            </div>
                            <div class="input-row small-input only-input">
                                <input data-hc-setting="number_6" class="input-link" type="text" value="6" />
                            </div>
                        </div>
                        <div data-hc-setting="content_6" data-hc-id="main_content_6" data-hc-container="repeater" class="row">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#">1-2-3</a></li>
                <li><a href="#">4-5-6</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_accordion">
    <div data-hc-id="_ID" data-hc-component="hc_accordion" data-hc-setting="main_content" class="hc-accordion hc-cnt-component">
        <input type="hidden" class="file_require" value="components">
        <input type="hidden" class="file_require" value="tab_accordion">
        <?php hc_e_composer_item_menu("Accordion") ?>
        <div class="tab-box inverse">
            <div class="panel active">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_1" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_1" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_1" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_1" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_1" data-hc-id="main_content_1" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_2" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_2" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_2" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_2" data-hc-id="main_content_2" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_3" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_3" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_3" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_3" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_3" data-hc-id="main_content_3" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_4" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_4" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_4" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_4" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_4" data-hc-id="main_content_4" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_5" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_5" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_5" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_5" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_5" data-hc-id="main_content_5" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_6" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_6" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_6" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_6" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_6" data-hc-id="main_content_6" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_7" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_7" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_7" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_7" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_7" data-hc-id="main_content_7" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_8" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_8" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_8" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_8" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_8" data-hc-id="main_content_8" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_9" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_9" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_9" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_9" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_9" data-hc-id="main_content_9" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
            </div>
            <div class="panel">
                <div class="flex-box">
                    <div class="input-row full-input" data-dependence-show="link_type_media">
                        <p><?php _e("Name","hc") ?></p>
                        <input data-hc-setting="name_10" class="input-link" type="text" value="" />
                    </div>
                    <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_10" data-hc-component="value" data-value="">
                        <input type="hidden" data-hc-setting="icon_style_10" class="icon-style" value="">
                        <input type="hidden" data-hc-setting="icon_image_10" class="icon-image" value="">
                    </i>
                </div>
                <div data-hc-setting="content_10" data-hc-id="main_content_10" data-hc-container="repeater" class="row">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
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
                <li><a href="#">9</a></li>
                <li><a href="#">10</a></li>
            </ul>
        </div>
        <div class="input-row input-select">
            <p><?php _e("Open type","hc") ?></p>
            <select data-hc-setting="open_type">
                <option value="" selected><?php _e("Default","hc") ?></option>
                <option value="accordion"><?php _e("Accordion","hc") ?></option>
                <option value="visible"><?php _e("Visible","hc") ?></option>
            </select>
        </div>
        <div class="button-inner-options">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-row input-text small-input">
                    <p><?php _e("Opening time","hc") ?></p>
                    <input data-hc-setting="time" placeholder="500" type="text" data-mask="number">
                </li>
                <li class="input-row input-text small-input">
                    <p><?php _e("Open tab","hc") ?></p>
                    <input data-hc-setting="open" placeholder="" type="text" data-mask="number">
                </li>
            </ul>
        </div>

    </div>
</div>
<div id="cnt_hc_collapse">
    <div data-hc-id="_ID" data-hc-component="hc_collapse" data-hc-setting="main_content" class="hc-collapse hc-cnt-component">
        <input type="hidden" class="file_require" value="components">
        <input type="hidden" class="file_require" value="tab_accordion">
        <?php hc_e_composer_item_menu("Collapse") ?>
        <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row ">
            <div class="clear"></div>
            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text">
                        <p><?php _e("Button text","hc") ?></p>
                        <input data-hc-setting="button_text" type="text">
                    </li>
                    <li class="input-row input-text">
                        <p><?php _e("Button open text","hc") ?></p>
                        <input data-hc-setting="button_open_text" type="text">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Position","hc") ?></p>
                        <select data-hc-setting="position">
                            <option value="bottom" selected><?php _e("Bottom","hc") ?></option>
                            <option value="top"><?php _e("Top","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Alignment","hc") ?></p>
                        <select data-hc-setting="alignment">
                            <option value="center" selected><?php _e("Center","hc") ?></option>
                            <option value="left"><?php _e("Left","hc") ?></option>
                            <option value="right"><?php _e("Right","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Height","hc") ?></p>
                        <input data-hc-setting="height" type="text">
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Opening time","hc") ?></p>
                        <input data-hc-setting="time" placeholder="500" type="text" data-mask="number">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="cnt_hc_grid_list">
    <div data-hc-id="_ID" data-hc-component="hc_grid_list" data-hc-setting="main_content" class="hc-grid-list hc-cnt-component layout-columns-4">
        <input type="hidden" class="file_require" value="lightbox">
        <?php hc_e_composer_item_menu("Grid list") ?>
        <div class="tab-box tab-hc-fast inverse">
            <input type="hidden" data-hc-setting="tab_index" class="tab_index" value="0">
            <div class="panel active panel-list-images">
                <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images" data-hc-id="images" data-hc-container="repeater">
                    <span class="close-button"></span>
                    <div class="upload-container upload-add">
                        <div data-hc-component="upload" class="upload-btn"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel panel-list-custom">
                <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row flex-repeater">
                    <div class="clear"></div>
                    <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                </div>
                <div class="clear"></div>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#"><?php _e("Images list","hc") ?></a></li>
                <li><a href="#"><?php _e("Advanced list","hc") ?></a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <i class="input-row button-icon button-icons-list icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
            <div class="button-inner-options big-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="divider"><?php _e("Grid options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Columns","hc") ?></p>
                        <select data-hc-setting="column" data-layout="column">
                            <option value="col-md-12">1</option>
                            <option value="col-md-6">2</option>
                            <option value="col-md-4">3</option>
                            <option value="col-md-3" selected>4</option>
                            <option value="col-md-2">6</option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Mobile columns","hc") ?></p>
                        <select data-hc-setting="mobile_column">
                            <option value="">Default</option>
                            <option value="col-sm-12">1</option>
                            <option value="col-sm-6">2</option>
                            <option value="col-sm-4">3</option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Row height","hc") ?></p>
                        <select data-hc-setting="row">
                            <option value="" selected>Auto</option>
                            <option value="row-1">Row 1</option>
                            <option value="row-2">Row 2</option>
                            <option value="row-3">Row 3</option>
                            <option value="row-4">Row 4</option>
                            <option value="row-5">Row 5</option>
                            <option value="row-6">Row 6</option>
                            <option value="row-7">Row 7</option>
                            <option value="row-8">Row 8</option>
                            <option value="row-9">Row 9</option>
                            <option value="row-10">Row 10</option>
                            <option value="row-11">Row 11</option>
                            <option value="row-12">Row 12</option>
                            <option value="row-13">Row 13</option>
                            <option value="row-14">Row 14</option>
                            <option value="row-15">Row 15</option>
                            <option value="row-16">Row 16</option>
                            <option value="row-17">Row 17</option>
                            <option value="row-18">Row 18</option>
                            <option value="row-19">Row 19</option>
                            <option value="row-20">Row 20</option>
                            <option value="row-21">Row 21</option>
                            <option value="row-22">Row 22</option>
                        </select>
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Margins","hc") ?></p>
                        <input data-hc-setting="margins" placeholder="5" type="text" data-mask="number">
                    </li>
                    <li class="divider"><?php _e("Images list options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Images size","hc") ?></p>
                        <select data-hc-setting="thumb_size">
                            <?php hc_thumb_sizes(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Lightbox images size","hc") ?></p>
                        <select data-hc-setting="lightbox_size">
                            <?php hc_thumb_sizes(); ?>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Gallery","hc") ?></p>
                        <input data-hc-setting="gallery" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Lightbox animation","hc") ?></p>
                        <select data-hc-setting="lightbox_animation" class="animations-list">
                            <?php hc_html_animations();?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Hover animation","hc") ?></p>
                        <select data-hc-setting="hover_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Icon animation","hc") ?></p>
                        <select data-hc-setting="icon_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
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
                    <li class="input-row input-checkbox">
                        <p><?php _e("Hide icon","hc") ?></p>
                        <input data-hc-setting="hide_icon" checked type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Thumbnail","hc") ?></p>
                        <input data-hc-setting="thumbnail" type="checkbox">
                    </li>
                </ul>
            </div>
            <div class="input-row input-checkbox">
                <p><?php _e("Pagination","hc") ?></p>
                <input data-hc-setting="pagination" name="image-grid-navs" type="checkbox" data-dependence-trigger="true" data-require-file="pagination">
            </div>
            <div class="button-inner-options" data-dependence-show="pagination">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Items per page","hc") ?></p>
                        <input data-hc-setting="pag_items" placeholder="3" type="text" data-mask="number">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Scroll top","hc") ?></p>
                        <input data-hc-setting="pag_scroll_top" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="pag_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Size","hc") ?></p>
                        <select data-hc-setting="pag_size">
                            <option value="pagination-sm" selected><?php _e("Small","hc") ?></option>
                            <option value="pagination"><?php _e("Normal","hc") ?></option>
                            <option value="pagination-lg"><?php _e("Large","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Centered","hc") ?></p>
                        <input data-hc-setting="pag_centered" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Simple controls","hc") ?></p>
                        <input data-hc-setting="pag_hide_controls" checked="checked" type="checkbox">
                    </li>
                </ul>
            </div>
            <a class="input-row data-options-button" data-hc-setting="pag_data_options" data-hc-component="value" data-value="" href="#popover-box-pagination" data-dependence-show="pagination">
                <i class="button-icon input-row icon-gear-setting-2"></i>
            </a>
            <div class="input-row input-checkbox">
                <p><?php _e("Load more","hc") ?></p>
                <input data-hc-setting="load_more" name="image-grid-navs" type="checkbox" data-dependence-trigger="true" data-require-file="pagination">
            </div>
            <div class="button-inner-options" data-dependence-show="load_more">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Items per load","hc") ?></p>
                        <input data-hc-setting="lm_items" placeholder="3" type="text" data-mask="number">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Lazy load","hc") ?></p>
                        <input data-hc-setting="lm_lazy" type="checkbox">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Button text","hc") ?></p>
                        <input data-hc-setting="lm_button_text" placeholder="<?php _e("Load more","hc") ?>" value="<?php _e("Load more","hc") ?>" type="text">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="lm_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_masonry_list">
    <div data-hc-id="_ID" data-hc-component="hc_masonry_list" data-hc-setting="main_content" class="hc-masonry-list hc-cnt-component layout-columns-4">
        <input type="hidden" class="file_require" value="lightbox">
        <input type="hidden" class="file_require" value="masonry">
        <?php hc_e_composer_item_menu("Masonry list") ?>
        <div class="tab-box tab-hc-fast">
            <input type="hidden" data-hc-setting="tab_index" class="tab_index" value="0">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#"><?php _e("Images list","hc") ?></a></li>
                <li><a href="#"><?php _e("Advanced list","hc") ?></a></li>
            </ul>
            <div class="panel active panel-list-images">
                <div class="tab-box inverse">
                    <div class="panel active">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_1" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_1" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_1" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_1" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_1" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_2" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_3" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_3" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_3" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_3" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_3" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_4" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_4" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_4" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_4" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_4" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_5" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_5" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_5" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_5" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_5" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_6" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_6" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_6" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_6" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_6" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_7" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_7" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_7" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_7" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_7" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_8" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_8" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_8" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_8" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_8" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_9" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_9" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_9" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_9" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_9" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_10" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_10" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_10" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_10" class="icon-image" value="">
                            </i>
                        </div>
                        <div class="upload-box upload-multi upload-row upload-fixed" data-hc-setting="images_10" data-hc-id="images" data-hc-container="repeater">
                            <span class="close-button"></span>
                            <div class="upload-container upload-add">
                                <div data-hc-component="upload" class="upload-btn"></div>
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
                        <li><a href="#">9</a></li>
                        <li><a href="#">10</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel panel-list-custom">
                <div class="tab-box inverse">
                    <div class="panel active">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_1" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_1" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_1" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_1" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_1" data-hc-id="content_2_1" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_2" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_2" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_2" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_2" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_2" data-hc-id="content_2_2" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_3" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_3" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_3" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_3" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_3" data-hc-id="content_2_3" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_4" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_4" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_4" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_4" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_4" data-hc-id="content_2_4" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_5" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_5" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_5" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_5" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_5" data-hc-id="content_2_5" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_6" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_6" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_6" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_6" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_6" data-hc-id="content_2_6" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_7" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_7" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_7" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_7" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_7" data-hc-id="content_2_7" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_8" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_8" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_8" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_8" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_8" data-hc-id="content_2_8" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_9" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_9" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_9" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_9" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_9" data-hc-id="content_2_9" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="panel">
                        <div class="flex-box">
                            <div class="input-row full-input" data-dependence-show="link_type_media">
                                <p><?php _e("Menu item","hc") ?></p>
                                <input data-hc-setting="name_2_10" class="input-link" type="text" value="" />
                            </div>
                            <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon_2_10" data-hc-component="value" data-value="">
                                <input type="hidden" data-hc-setting="icon_style_2_10" class="icon-style" value="">
                                <input type="hidden" data-hc-setting="icon_image_2_10" class="icon-image" value="">
                            </i>
                        </div>
                        <div data-hc-setting="content_2_10" data-hc-id="content_2_10" data-hc-container="repeater" class="row flex-repeater">
                            <div class="clear"></div>
                            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
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
                        <li><a href="#">9</a></li>
                        <li><a href="#">10</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <i class="input-row button-icon button-icons-list icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
            <div class="button-inner-options big-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="divider"><?php _e("Masonry options","hc") ?></li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Show menu","hc") ?></p>
                        <input data-hc-setting="menu" checked="checked" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Menu position","hc") ?></p>
                        <select data-hc-setting="menu_position">
                            <option value=""><?php _e("Left","hc") ?></option>
                            <option value="nav-center"><?php _e("Center","hc") ?></option>
                            <option value="nav-right"><?php _e("Right","hc") ?></option>
                            <option value="nav-outer"><?php _e("Outer right","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Menu style","hc") ?></p>
                        <select data-hc-setting="menu_style">
                            <option value=""><?php _e("Default","hc") ?></option>
                            <option value="ms-rounded"><?php _e("Rounded","hc") ?></option>
                            <option value="ms-minimal"><?php _e("Minimal","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Columns","hc") ?></p>
                        <select data-hc-setting="column" data-layout="column">
                            <option value="col-md-12">1</option>
                            <option value="col-md-6">2</option>
                            <option value="col-md-4">3</option>
                            <option value="col-md-3" selected>4</option>
                            <option value="col-md-2">6</option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Mobile columns","hc") ?></p>
                        <select data-hc-setting="mobile_column">
                            <option value="">Default</option>
                            <option value="col-sm-12">1</option>
                            <option value="col-sm-6">2</option>
                            <option value="col-sm-4">3</option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Row height","hc") ?></p>
                        <select data-hc-setting="row">
                            <option value="" selected>Auto</option>
                            <option value="row-1">25px</option>
                            <option value="row-2">50px</option>
                            <option value="row-3">75px</option>
                            <option value="row-4">100px</option>
                            <option value="row-5">125px</option>
                            <option value="row-6">150px</option>
                            <option value="row-7">175px</option>
                            <option value="row-8">200px</option>
                            <option value="row-9">225px</option>
                            <option value="row-10">250px</option>
                            <option value="row-11">275px</option>
                            <option value="row-12">300px</option>
                            <option value="row-13">325px</option>
                            <option value="row-14">350px</option>
                            <option value="row-15">375px</option>
                            <option value="row-16">400px</option>
                            <option value="row-17">425px</option>
                            <option value="row-18">450px</option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Auto masonry","hc") ?></p>
                        <input data-hc-setting="auto_masonry" type="checkbox">
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Margins","hc") ?></p>
                        <input data-hc-setting="margins" placeholder="5" type="text" data-mask="number">
                    </li>
                    <li class="input-row input-text small-input">
                        <p><?php _e("All button text","hc") ?></p>
                        <input data-hc-setting="all_text" placeholder="All" type="text">
                    </li>
                    <li class="divider"><?php _e("Images list options","hc") ?></li>
                    <li class="input-row input-select">
                        <p><?php _e("Images size","hc") ?></p>
                        <select data-hc-setting="thumb_size">
                            <?php hc_thumb_sizes(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Lightbox size","hc") ?></p>
                        <select data-hc-setting="lightbox_size">
                            <?php hc_thumb_sizes(); ?>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Gallery","hc") ?></p>
                        <input data-hc-setting="gallery" type="checkbox">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Lightbox animation","hc") ?></p>
                        <select data-hc-setting="lightbox_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Hover animation","hc") ?></p>
                        <select data-hc-setting="hover_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Icon animation","hc") ?></p>
                        <select data-hc-setting="icon_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
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
                    <li class="input-row input-checkbox">
                        <p><?php _e("Hide icon","hc") ?></p>
                        <input data-hc-setting="hide_icon" checked type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Thumbnail","hc") ?></p>
                        <input data-hc-setting="thumbnail" type="checkbox">
                    </li>
                </ul>
            </div>
            <div class="input-row input-checkbox">
                <p><?php _e("Pagination","hc") ?></p>
                <input data-hc-setting="pagination" name="image-grid-navs" type="checkbox" data-dependence-trigger="true" data-require-file="pagination">
            </div>
            <div class="button-inner-options" data-dependence-show="pagination">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Items per page","hc") ?></p>
                        <input data-hc-setting="pag_items" placeholder="3" type="text" data-mask="number">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="pag_animation" class="animations-list">
                            <?php hc_html_animations();?>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Size","hc") ?></p>
                        <select data-hc-setting="pag_size">
                            <option value="pagination-sm" selected><?php _e("Small","hc") ?></option>
                            <option value="pagination"><?php _e("Normal","hc") ?></option>
                            <option value="pagination-lg"><?php _e("Large","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Centered","hc") ?></p>
                        <input data-hc-setting="pag_centered" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Simple controls","hc") ?></p>
                        <input data-hc-setting="pag_hide_controls" checked="checked" type="checkbox">
                    </li>
                </ul>
            </div>
            <a class="input-row data-options-button" data-hc-setting="pag_data_options" data-hc-component="value" data-value="" href="#popover-box-pagination" data-dependence-show="pagination">
                <i class="button-icon input-row icon-gear-setting-2"></i>
            </a>
            <div class="input-row input-checkbox">
                <p><?php _e("Load more","hc") ?></p>
                <input data-hc-setting="load_more" name="image-grid-navs" type="checkbox" data-dependence-trigger="true" data-require-file="pagination">
            </div>
            <div class="button-inner-options" data-dependence-show="load_more">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text small-input">
                        <p><?php _e("Items per load","hc") ?></p>
                        <input data-hc-setting="lm_items" placeholder="3" type="text" data-mask="number">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php _e("Lazy load","hc") ?></p>
                        <input data-hc-setting="lm_lazy" type="checkbox">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Button text","hc") ?></p>
                        <input data-hc-setting="lm_button_text" placeholder="<?php _e("Load more","hc") ?>" value="<?php _e("Load more","hc") ?>" type="text">
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Animation","hc") ?></p>
                        <select data-hc-setting="lm_animation" class="animations-list">
                            <?php hc_html_animations(); ?>
                        </select>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="popover-box-pagination" class="popover-box popover-list" style="display: none">
    <span class="close-button"></span>
    <ul class="list">
        <li class="input-row input-text small-input">
            <p><?php _e("Start page","hc") ?></p>
            <input data-option-id="startPage" placeholder="1" data-mask="number" type="text">
        </li>
        <li class="input-row input-text small-input">
            <p><?php _e("Visible pages","hc") ?></p>
            <input data-option-id="visiblePages " placeholder="5" data-mask="number" type="text">
        </li>
        <li class="input-row input-text medium-input">
            <p><?php _e("First button text","hc") ?></p>
            <input data-option-id="first" placeholder="<?php _e("First","hc") ?>" value="<?php _e("First","hc") ?>" type="text">
        </li>
        <li class="input-row input-text medium-input">
            <p><?php _e("Prev button text","hc") ?></p>
            <input data-option-id="prev" placeholder="<?php _e("Prev","hc") ?>" value="<?php _e("Prev","hc") ?>" type="text">
        </li>
        <li class="input-row input-text medium-input">
            <p><?php _e("Next button text","hc") ?></p>
            <input data-option-id="next" placeholder="<?php _e("Next","hc") ?>" value="<?php _e("Next","hc") ?>" type="text">
        </li>
        <li class="input-row input-text medium-input">
            <p><?php _e("Last button text","hc") ?></p>
            <input data-option-id="last" placeholder="<?php _e("Last","hc") ?>" value="<?php _e("Last","hc") ?>" type="text">
        </li>
        <li class="input-row input-checkbox">
            <p><?php _e("Loop","hc") ?></p>
            <input data-option-id="loop" data-default="false" type="checkbox">
        </li>
        <li class="input-row input-checkbox">
            <p><?php _e("Scroll top","hc") ?></p>
            <input data-option-id="scrollTop" data-default="false" type="checkbox">
        </li>
    </ul>
    <div class="clear"></div>
    <a class="button button-primary button-large popover-box-save"><?php _e("SAVE SETTINGS","hc") ?></a>
</div>
<div id="cnt_hc_album">
    <div data-hc-id="_ID" data-hc-component="hc_album" data-hc-setting="main_content" class="hc-album hc-cnt-component">
        <input type="hidden" class="file_require" value="pagination">
        <input type="hidden" class="file_require" value="image_box">
        <?php hc_e_composer_item_menu("Album") ?>
        <div class="area-label">
            <?php _e("Album menu","hc") ?>
        </div>
        <div class="input-text input-row input-repeater" data-value="">
            <div class="repeater-source">
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="album_image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn upload-img-box"></div>
                    </div>
                </div>
                <div class="input-row input-text full-input">
                    <p><?php _e("Name","hc") ?></p>
                    <input data-hc-setting="album_name" type="text">
                </div>
            </div>
            <div class="repeater-container" data-hc-setting="menu_items" data-hc-id="slides" data-hc-container="repeater"></div>
            <div class="clear"></div>
            <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="area-label">
            <?php _e("Album content","hc") ?>
        </div>
        <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row">
            <div class="clear"></div>
            <div class="hc-add-component" data-components="only-col-12"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="input-row input-select">
                <p><?php _e("Animation","hc") ?></p>
                <select data-hc-setting="animation" class="animations-list">
                    <?php hc_html_animations(); ?>
                </select>
            </div>
            <div class="input-row input-select">
                <p><?php _e("Columns","hc") ?></p>
                <select data-hc-setting="column">
                    <option value="col-md-12">1</option>
                    <option value="col-md-6">2</option>
                    <option value="col-md-4">3</option>
                    <option value="col-md-3" selected>4</option>
                    <option value="col-md-2">6</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_fixed_area">
    <div data-hc-id="_ID" data-hc-component="hc_fixed_area" data-hc-setting="main_content" class="hc-fixed-area hc-cnt-component">
        <?php hc_e_composer_item_menu("Fixed area") ?>
        <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row ">
            <div class="clear"></div>
            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar">
            <div class="input-row input-text small-input">
                <p><?php _e("Top","hc") ?></p>
                <input data-hc-setting="top" placeholder="0" data-mask="number" type="text">
            </div>
            <div class="input-row input-text small-input">
                <p><?php _e("Bottom","hc") ?></p>
                <input data-hc-setting="bottom" placeholder="0" data-mask="number" type="text">
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_popover">
    <div data-hc-id="_ID" data-hc-component="hc_popover" data-hc-setting="main_content" class="hc-popover hc-cnt-component">
        <input type="hidden" class="file_require" value="toolstip">
        <?php hc_e_composer_item_menu("Popover") ?>
        <div data-hc-setting="content" data-hc-id="main_content" data-hc-container="repeater" class="row">
            <div class="clear"></div>
            <div class="hc-add-component"><i class="icon-plus-add-2"></i></div>
        </div>
        <div class="clear"></div>
        <div class="box-content-bar text-center">
            <div class="button-inner-options">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php _e("Type","hc") ?></p>
                        <select data-hc-setting="type">
                            <option value="toolstip" selected><?php _e("Toolstip","hc") ?></option>
                            <option value="popover"><?php _e("Popover","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Direction","hc") ?></p>
                        <select data-hc-setting="direction">
                            <option value="top" selected><?php _e("Top","hc") ?></option>
                            <option value="left"><?php _e("Left","hc") ?></option>
                            <option value="right"><?php _e("Right","hc") ?></option>
                            <option value="bottom"><?php _e("Bottom","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-select">
                        <p><?php _e("Trigger","hc") ?></p>
                        <select data-hc-setting="trigger">
                            <option value="hover" selected><?php _e("Hover","hc") ?></option>
                            <option value="click"><?php _e("Click","hc") ?></option>
                            <option value="manual"><?php _e("Manual","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Title","hc") ?></p>
                        <input data-hc-setting="title" value="" type="text">
                    </li>
                    <li class="input-row input-text medium-input">
                        <p><?php _e("Text","hc") ?></p>
                        <input data-hc-setting="text" value="" type="text">
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_page_lightbox">
    <div data-hc-id="_ID" data-hc-component="hc_page_lightbox" class="hc-section hc-page-element hc-page-lightbox">
        <input type="hidden" class="file_require" value="lightbox">
        This component has been deprecated. The new Page Lightbox can be found on the right menu of this page.
        <div class="clear"></div>
    </div>
</div>
<div id="cnt_hc_page_popup">
    <div data-hc-id="_ID" data-hc-component="hc_page_popup" class="hc-section hc-page-element hc-page-popup">
        This component has been deprecated. The new Page Popup can be found on the right menu of this page.
        <div class="clear"></div>
    </div>
</div>
