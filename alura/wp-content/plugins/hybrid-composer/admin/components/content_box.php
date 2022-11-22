<?php
// =============================================================================
// CONTENT_BOX.PHP
// -----------------------------------------------------------------------------
// Hybric Composer content boxes admin components
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
?>
<div id="cnt_hc_content_box">
    <div data-hc-id="_ID" data-hc-component="hc_content_box" data-hc-setting="main_content" class="hc-content-box hc-content-box-base hc-cnt-component">
        <input type="hidden" class="file_require" value="lightbox">
        <input type="hidden" class="file_require" value="content_box">
        <?php hc_e_composer_item_menu("Content box") ?>
        <div class="upload-box upload-row full-input content-box-upload">
            <span class="close-button"></span>
            <div class="upload-container">
                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn upload-img-box"></div>
            </div>
        </div>
        <div class="flex-box">
            <div class="input-text input-row full-only-input">
                <input type="text" placeholder="<?php esc_attr_e("Title ...","hc") ?>" data-hc-setting="title" />
            </div>
            <div class="flex-sub-box">
                <i class="input-row button-icons-list-all button-icon icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value="">
                    <input type="hidden" data-hc-setting="icon_style" class="icon-style" value="">
                    <input type="hidden" data-hc-setting="icon_image" class="icon-image" value="">
                </i>
                <div class="button-inner-options" data-width="330">
                    <i class="button-icon input-row icon-gear-setting-2"></i>
                    <ul>
                        <li class="input-row input-select">
                            <p><?php esc_attr_e("Box style","hc") ?></p>
                            <select data-hc-setting="box_style" class="content-box-style">
                                <option selected value="side_content"><?php esc_attr_e("Side image","hc") ?></option>
                                <option value="top_icon_image"><?php esc_attr_e("Top image","hc") ?></option>
                                <option value="top_icon"><?php esc_attr_e("Top icon","hc") ?></option>
                                <option value="side_icon"><?php esc_attr_e("Side icon","hc") ?></option>
                                <option value="multiple_box"><?php esc_attr_e("Multiple box","hc") ?></option>
                            </select>
                        </li>
                        <li class="input-row input-checkbox">
                            <p><?php esc_attr_e("Boxed","hc") ?></p>
                            <input data-hc-setting="boxed" type="checkbox">
                        </li>
                        <li class="input-row input-checkbox">
                            <p><?php esc_attr_e("Boxed inverse","hc") ?></p>
                            <input data-hc-setting="boxed_inverse" type="checkbox">
                        </li>
                        <li class="input-row input-select">
                            <p><?php _e("Title size","hc") ?></p>
                            <select data-hc-setting="title_size">
                                <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                                <option value="text-l"><?php _e("Large","hc") ?></option>
                                <option selected="selected" value=""><?php _e("Default","hc") ?></option>
                                <option value="text-m"><?php _e("Medium","hc") ?></option>
                                <option value="text-s"><?php _e("Small","hc") ?></option>
                                <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                            </select>
                        </li>
                        <li class="input-row input-select">
                            <p><?php _e("Text size","hc") ?></p>
                            <select data-hc-setting="text_size">
                                <option value="text-xl"><?php _e("Extra large","hc") ?></option>
                                <option value="text-l"><?php _e("Large","hc") ?></option>
                                <option selected="selected" value=""><?php _e("Default","hc") ?></option>
                                <option value="text-m"><?php _e("Medium","hc") ?></option>
                                <option value="text-s"><?php _e("Small","hc") ?></option>
                                <option value="text-xs"><?php _e("Extra small","hc") ?></option>
                            </select>
                        </li>
                        <?php hc_button_options(true) ?>
                        <li class="input-row input-text ">
                            <p><?php esc_attr_e("Extra content","hc") ?></p>
                            <input type="text" data-hc-setting="extra_content" />
                        </li>
                        <li class="input-row input-text ">
                            <p><?php esc_attr_e("Extra content 2","hc") ?></p>
                            <input type="text" data-hc-setting="extra_content_2" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="input-text-area input-row full-only-input">
            <textarea data-hc-setting="text" placeholder="<?php esc_attr_e("Text ...","hc") ?>"></textarea>
        </div>
        <?php hc_get_link_engine(); ?>
    </div>
</div>
<div id="cnt_hc_niche_content_box_blog">
    <div data-hc-id="_ID" data-hc-component="hc_niche_content_box_blog" data-hc-setting="main_content" class="hc-content-box hc-blog-content-box hc-cnt-component">
        <input type="hidden" class="file_require" value="content_box">
        <?php hc_e_composer_item_menu("Blog box") ?>
        <div class="tab-box tab-hc inverse">
            <div class="panel image-panel active">
                <div data-hc-id="sub1__ID" data-hc-component="this" data-hc-setting="media_content">
                    <input type="hidden" data-hc-setting="content_type" value="image">
                    <div class="upload-box upload-row full-input">
                        <span class="close-button"></span>
                        <div class="upload-container">
                            <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn upload-img-box"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="panel slider-panel">
                <div data-hc-id="sub2__ID" data-hc-component="this" data-hc-setting="media_content">
                    <input type="hidden" class="file_require" value="flexslider">
                    <input type="hidden" data-hc-setting="content_type" value="slider">
                    <div class="upload-box upload-multi upload-row" data-hc-setting="slides" data-hc-id="slides" data-hc-container="repeater">
                        <span class="close-button"></span>
                        <div class="upload-container upload-add">
                            <div data-hc-component="upload" class="upload-btn"></div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="panel video-panel">
                <div data-hc-id="sub3__ID" data-hc-component="this" data-hc-setting="media_content">
                    <input type="hidden" data-hc-setting="content_type" value="video">
                    <div class="upload-box upload-row full-input">
                        <span class="close-button"></span>
                        <div class="upload-container">
                            <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                        </div>
                    </div>
                    <div class="upload-link full-input ">
                        <input data-hc-setting="video" placeholder="<?php esc_attr_e("Youtube or MP4 video link","hc") ?>" type="text" value="" />
                        <a class="input-button input-row"><?php esc_attr_e("Upload video","hc") ?></a>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#"><?php esc_attr_e("Image","hc") ?></a></li>
                <li><a href="#"><?php esc_attr_e("Slider","hc") ?></a></li>
                <li><a href="#"><?php esc_attr_e("Video","hc") ?></a></li>
            </ul>
        </div>
        <div class="flex-box">
            <div class="input-text input-row full-only-input">
                <input type="text" placeholder="<?php esc_attr_e("Title ...","hc") ?>" data-hc-setting="title" />
            </div>
            <div class="button-inner-options" data-width="330">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-select">
                        <p><?php esc_attr_e("Style","hc") ?></p>
                        <select data-hc-setting="box_style">
                            <option selected value="side"><?php esc_attr_e("Side","hc") ?></option>
                            <option value="full_width"><?php esc_attr_e("Full width","hc") ?></option>
                            <option value="full_width_2"><?php esc_attr_e("Full width 2","hc") ?></option>
                        </select>
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php esc_attr_e("Boxed","hc") ?></p>
                        <input data-hc-setting="boxed" type="checkbox">
                    </li>
                    <li class="input-row input-checkbox">
                        <p><?php esc_attr_e("Boxed inverse","hc") ?></p>
                        <input data-hc-setting="boxed_inverse" type="checkbox">
                    </li>
                    <li class="input-row input-text">
                        <p><?php esc_attr_e("Button text","hc") ?></p>
                        <input type="text" data-hc-setting="button_text" />
                    </li>
                    <li class="input-row input-text ">
                        <p><?php esc_attr_e("Extra content","hc") ?></p>
                        <input type="text" data-hc-setting="extra_content" />
                    </li>
                </ul>
            </div>
        </div>
        <div class="input-text input-row full-only-input">
            <input type="text" placeholder="<?php esc_attr_e("Subtitle ...","hc") ?>" data-hc-setting="subtitle" />
        </div>
        <div class="input-text-area input-row full-only-input">
            <textarea data-hc-setting="text" placeholder="<?php esc_attr_e("Text ...","hc") ?>"></textarea>
        </div>
        <?php hc_get_link_engine(); ?>
    </div>
</div>
<div id="cnt_hc_niche_content_box_testimonials">
    <div data-hc-id="_ID" data-hc-component="hc_niche_content_box_testimonials" data-hc-setting="main_content" class="hc-content-box hc-testimonials-content-box hc-cnt-component">
        <input type="hidden" class="file_require" value="content_box">
        <?php hc_e_composer_item_menu("Testimonials box") ?>
        <div class="row">
            <div class="col-md-3">
                <div class="upload-box upload-row full-input upload-fixed">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn upload-img-box"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="flex-box">
                    <div class="input-text input-row full-only-input">
                        <input type="text" placeholder="<?php esc_attr_e("Title ...","hc") ?>" data-hc-setting="title" />
                    </div>
                    <div class="button-inner-options" data-width="330">
                        <i class="button-icon input-row icon-gear-setting-2"></i>
                        <ul>
                            <li class="input-row input-select">
                                <p><?php esc_attr_e("Style","hc") ?></p>
                                <select data-hc-setting="box_style">
                                    <option selected value="style_1"><?php esc_attr_e("Style 1","hc") ?></option>
                                    <option value="style_2"><?php esc_attr_e("Style 2","hc") ?></option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="input-text input-row full-only-input">
                    <input type="text" placeholder="<?php esc_attr_e("Subtitle ...","hc") ?>" data-hc-setting="subtitle" />
                </div>
                <div class="input-text-area input-row full-only-input">
                    <textarea data-hc-setting="text" placeholder="<?php esc_attr_e("Text ...","hc") ?>"></textarea>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_niche_content_box_team">
    <div data-hc-id="_ID" data-hc-component="hc_niche_content_box_team" data-hc-setting="main_content" class="hc-content-box hc-team-content-box hc-cnt-component">
        <input type="hidden" class="file_require" value="content_box">
        <?php hc_e_composer_item_menu("Team box") ?>
        <div class="upload-box upload-row full-input">
            <span class="close-button"></span>
            <div class="upload-container">
                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn upload-img-box"></div>
            </div>
        </div>
        <div class="flex-box">
            <div class="input-text input-row full-only-input">
                <input type="text" placeholder="<?php esc_attr_e("Name ...","hc") ?>" data-hc-setting="title" />
            </div>
            <div class="button-inner-options" data-width="330">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-text">
                        <p>Facebook</p>
                        <input type="text" data-hc-setting="social_fb" />
                    </li>
                    <li class="input-row input-text">
                        <p>Twitter</p>
                        <input type="text" data-hc-setting="social_tw" />
                    </li>
                    <li class="input-row input-text">
                        <p>Google+</p>
                        <input type="text" data-hc-setting="social_g+" />
                    </li>
                    <li class="input-row input-text">
                        <p>LinkedIn</p>
                        <input type="text" data-hc-setting="social_in" />
                    </li>
                    <li class="input-row input-text">
                        <p>Youtube</p>
                        <input type="text" data-hc-setting="social_yt" />
                    </li>
                    <li class="input-row input-text">
                        <p>Instagram</p>
                        <input type="text" data-hc-setting="social_ig" />
                    </li>
                </ul>
            </div>
        </div>
        <div class="input-text input-row full-only-input">
            <input type="text" placeholder="<?php esc_attr_e("Subtitle ...","hc") ?>" data-hc-setting="subtitle" />
        </div>
        <div class="input-text-area input-row full-only-input">
            <textarea data-hc-setting="text" placeholder="<?php esc_attr_e("Text ...","hc") ?>"></textarea>
        </div>
        <?php hc_get_link_engine(); ?>
    </div>
</div>
<div id="cnt_hc_niche_content_box_pricing_table">
    <div data-hc-id="_ID" data-hc-component="hc_niche_content_box_pricing_table" data-hc-setting="main_content" class="hc-content-box hc-pricing-table-content-box hc-cnt-component">
        <input type="hidden" class="file_require" value="content_box">
        <?php hc_e_composer_item_menu("Pricing table box") ?>
        <div class="flex-box">
            <div class="input-text input-row full-only-input">
                <input type="text" placeholder="<?php esc_attr_e("Title ...","hc") ?>" data-hc-setting="title" />
            </div>
            <div class="button-inner-options" data-width="330">
                <i class="button-icon input-row icon-gear-setting-2"></i>
                <ul>
                    <li class="input-row input-checkbox">
                        <p><?php esc_attr_e("Featured","hc") ?></p>
                        <input data-hc-setting="featured" type="checkbox">
                    </li>
                      <li class="input-row input-text">
                        <p><?php esc_attr_e("Extra text","hc") ?></p>
                        <input data-hc-setting="extra_text" type="text">
                    </li>
                      <li class="input-row input-text">
                        <p><?php esc_attr_e("Button text","hc") ?></p>
                        <input data-hc-setting="button_text" type="text">
                    </li>
                      <li class="input-row input-text">
                        <p><?php esc_attr_e("Button link","hc") ?></p>
                        <input data-hc-setting="button_link" type="text">
                    </li>
                </ul>
            </div>
        </div>
        <div class="input-text input-row full-only-input">
            <input type="text" placeholder="<?php esc_attr_e("Subtitle ...","hc") ?>" data-hc-setting="subtitle" />
        </div>
        <div class="input-text input-row input-repeater" data-value="">
            <div class="repeater-source">
                <input type="text" data-hc-setting="text" />
            </div>
            <div class="repeater-container" data-hc-setting="rows" data-hc-id="slides" data-hc-container="repeater"></div>
            <div class="clear"></div>
            <div class="repeater-add-new"><i class="icon-plus-add-2"></i></div>
        </div>
    </div>
</div>
<div id="cnt_hc_niche_content_box_call">
    <div data-hc-id="_ID" data-hc-component="hc_niche_content_box_call" data-hc-setting="main_content" class="hc-content-box hc-call-content-box hc-cnt-component">
        <input type="hidden" class="file_require" value="content_box">
        <?php hc_e_composer_item_menu("Call to action box") ?>
        <div class="flex-box">
            <div class="input-text input-row full-only-input">
                <input type="text" placeholder="<?php esc_attr_e("Content ...","hc") ?>" data-hc-setting="content" />
            </div>
            <div class="flex-sub-box">
                <i class="input-row button-icons-list button-icon icon-plus-add-2" data-hc-setting="icon" data-hc-component="value" data-value=""></i>
                <div class="button-inner-options" data-width="330">
                    <i class="button-icon input-row icon-gear-setting-2"></i>
                    <ul>
                        <li class="input-row input-text">
                            <p><?php esc_attr_e("Button text","hc") ?></p>
                            <input type="text" data-hc-setting="button_text" />
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php hc_get_link_engine(); ?>
    </div>
</div>
