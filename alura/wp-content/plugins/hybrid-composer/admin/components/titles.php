<?php
// =============================================================================
// TITLES.PHP
// -----------------------------------------------------------------------------
// Hybric Composer titles admin components
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
//   07. TITLE EMPTY - Without title
// =============================================================================
?>

<div id="cnt_hc_title">
    <div data-hc-id="main-title" data-hc-component="hc_title" id="main-title" class="hc-title">
        <input class="main_subtitle" data-hc-setting="subtitle" type="text" placeholder="<?php esc_attr_e("Insert subtitle here ...","hc") ?>" value="" />
        <div id="title-tab" class="tab-box inverse tab-wp">
            <div class="panel active">
                <div data-hc-setting="title_content" class="row"></div>
                <div class="clear"></div>
            </div>
            <ul class="nav nav-tabs">
                <li class="tab-title-image"><a href="#hc_title_image"><?php esc_attr_e("Image","hc") ?></a></li>
                <li class="tab-title-slider"><a href="#hc_title_slider"><?php esc_attr_e("Slider","hc") ?></a></li>
                <li class="tab-title-video"><a href="#hc_title_video"><?php esc_attr_e("Video","hc") ?></a></li>
                <li class="tab-title-animation"><a href="#hc_title_animation"><?php esc_attr_e("Animation","hc") ?></a></li>
                <li class="tab-title-base"><a href="#hc_title_base"><?php esc_attr_e("Base","hc") ?></a></li>
                <li class="tab-title-empty"><a href="#hc_title_empty"><?php esc_attr_e("Empty","hc") ?></a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_title_image">
    <div data-hc-id="title-image" data-hc-component="hc_title_image" data-hc-setting="title_content">
        <div class="upload-box upload-row full-input">
            <span class="close-button"></span>
            <div class="upload-container">
                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
            </div>
        </div>
        <hr class="space s" />
        <div class="input-checkbox input-row">
            <p><?php esc_attr_e("Fullscreen","hc") ?></p>
            <input data-hc-setting="full_screen" type="checkbox">
        </div>
        <div class="input-text input-row small-input">
            <p><?php esc_attr_e("Offset","hc") ?></p>
            <input data-hc-setting="full_screen_height" placeholder="px" type="text" data-mask="number" value="" data-require="full_screen" data-require-action="hide" />
        </div>  
        <div class="button-inner-options" data-width="315">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-checkbox input-row">
                    <p><?php esc_attr_e("Parallax","hc") ?></p>
                    <input data-hc-setting="parallax" type="checkbox" data-require-file="parallax">
                </li>
                <li class="input-row input-text small-input" data-dependence-show="parallax">
                    <p class="sch"><?php _e("Bleed","hc") ?></p>
                    <input data-hc-setting="bleed" type="text" placeholder="70" data-mask="number" value="" />
                </li>
                <li class="input-select input-row">
                    <p><?php esc_attr_e("Ken-burn animation","hc") ?></p>
                    <select data-hc-setting="ken_burn" data-require="parallax">
                        <option selected value=""><?php esc_attr_e("None","hc") ?></option>
                        <option value="ken-burn"><?php esc_attr_e("Zoom in","hc") ?></option>
                        <option value="ken-burn-out"><?php esc_attr_e("Zoom out","hc") ?></option>
                        <option value="ken-burn-center"><?php esc_attr_e("Zoom centered","hc") ?></option>
                    </select>
                </li>
                <li class="input-select input-row">
                    <p><?php esc_attr_e("Overlay","hc") ?></p>
                    <select data-hc-setting="overlay">
                        <option selected value=""><?php esc_attr_e("None","hc") ?></option>
                        <option value="dotted"><?php esc_attr_e("Dotted","hc") ?></option>
                        <option value="line-45"><?php esc_attr_e("Line 45","hc") ?></option>
                        <option value="carbonio"><?php esc_attr_e("Carbonio","hc") ?></option>
                        <option value="tile"><?php esc_attr_e("Tile","hc") ?></option>
                        <option value="transparent-dark"><?php esc_attr_e("Transparent dark","hc") ?></option>
                        <option value="transparent-light"><?php esc_attr_e("Transparent light","hc") ?></option>
                        <option value="tv"><?php esc_attr_e("Tv","hc") ?></option>
                        <option value="squares"><?php esc_attr_e("Squares","hc") ?></option>
                    </select>
                </li>
                <li class="input-checkbox input-row">
                    <p><?php esc_attr_e("Breadcrumbs","hc") ?></p>
                    <input data-hc-setting="breadcrumbs" type="checkbox">
                </li>
                <li class="input-checkbox input-row">
                    <p><?php esc_attr_e("White","hc") ?></p>
                    <input data-hc-setting="white" type="checkbox" checked>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_title_slider">
    <div data-hc-id="title-slider" data-hc-component="hc_title_slider" data-hc-setting="title_content">
        <input type="hidden" class="file_require" value="flexslider">
        <div class="upload-box upload-multi upload-row" data-hc-setting="slides" data-hc-id="slides" data-hc-container="repeater">
            <span class="close-button"></span>
            <div class="upload-container upload-add">
                <div data-hc-component="upload" class="upload-btn"></div>
            </div>
        </div>
        <hr class="space s" />
        <div class="input-checkbox input-row">
            <p><?php esc_attr_e("Fullscreen","hc") ?></p>
            <input data-hc-setting="full_screen" type="checkbox">
        </div>
        <div class="input-text input-row small-input">
            <p><?php esc_attr_e("Offset","hc") ?></p>
            <input data-hc-setting="full_screen_height" placeholder="px" type="text" data-mask="number" value="" data-require="full_screen" data-require-action="hide" />
        </div>
        <div class="button-inner-options" data-width="315">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-checkbox input-row">
                    <p><?php esc_attr_e("Parallax","hc") ?></p>
                    <input data-hc-setting="parallax" type="checkbox" data-require-file="parallax">
                </li>
                <li class="input-select input-row">
                    <p><?php esc_attr_e("Overlay","hc") ?></p>
                    <select data-hc-setting="overlay">
                        <option selected value=""><?php esc_attr_e("None","hc") ?></option>
                        <option value="dotted"><?php esc_attr_e("Dotted","hc") ?></option>
                        <option value="line-45"><?php esc_attr_e("Line 45","hc") ?></option>
                        <option value="carbonio"><?php esc_attr_e("Carbonio","hc") ?></option>
                        <option value="tile"><?php esc_attr_e("Tile","hc") ?></option>
                        <option value="transparent-dark"><?php esc_attr_e("Transparent dark","hc") ?></option>
                        <option value="transparent-light"><?php esc_attr_e("Transparent light","hc") ?></option>
                        <option value="tv"><?php esc_attr_e("Tv","hc") ?></option>
                        <option value="squares"><?php esc_attr_e("Squares","hc") ?></option>
                    </select>
                </li>
                <li class="input-checkbox input-row">
                    <p><?php esc_attr_e("Breadcrumbs","hc") ?></p>
                    <input data-hc-setting="breadcrumbs" type="checkbox">
                </li>
                <li class="input-checkbox input-row">
                    <p><?php esc_attr_e("White","hc") ?></p>
                    <input data-hc-setting="white" type="checkbox" checked>
                </li>
            </ul>
        </div>
        <a class="input-row" data-hc-setting="data_options" data-hc-component="value" data-value="" data-default-values="directionNav:false,animation:fade" href="#popover-box-flexslider"><i class="button-icon input-row icon-mixer-2"></i></a>
    </div>
</div>
<div id="cnt_hc_title_video">
    <div data-hc-id="title-video" data-hc-component="hc_title_video" data-hc-setting="title_content">
        <div class="row">
            <div class="col-md-10">
                <div class="upload-link upload-row full-input">
                    <input data-hc-setting="video" placeholder="<?php esc_attr_e("Youtube or MP4 video link","hc") ?>" type="text" value="" />
                    <a class="input-button input-row"><?php esc_attr_e("Upload video","hc") ?></a>
                </div>
                <div class="upload-box upload-row full-input">
                    <span class="close-button"></span>
                    <div class="upload-container">
                        <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-checkbox input-row">
                    <p><?php esc_attr_e("Fullscreen","hc") ?></p>
                    <input data-hc-setting="full_screen" type="checkbox">
                </div>
                <div class="input-text input-row small-input">
                    <p><?php esc_attr_e("Offset","hc") ?></p>
                    <input data-hc-setting="full_screen_height" placeholder="px" type="text" data-mask="number" value="" data-require="full_screen" data-require-action="hide" />
                </div>
                <div class="button-inner-options" data-width="315">
                    <i class="button-icon input-row icon-gear-setting-2"></i>
                    <ul>
                        <li class="input-checkbox input-row">
                            <p><?php esc_attr_e("Parallax","hc") ?></p>
                            <input data-hc-setting="parallax" type="checkbox" data-require-file="parallax">
                        </li>
                        <li class="input-select input-row">
                            <p><?php esc_attr_e("Overlay","hc") ?></p>
                            <select data-hc-setting="overlay">
                                <option selected value=""><?php esc_attr_e("None","hc") ?></option>
                                <option value="dotted"><?php esc_attr_e("Dotted","hc") ?></option>
                                <option value="line-45"><?php esc_attr_e("Line 45","hc") ?></option>
                                <option value="carbonio"><?php esc_attr_e("Carbonio","hc") ?></option>
                                <option value="tile"><?php esc_attr_e("Tile","hc") ?></option>
                                <option value="transparent-dark"><?php esc_attr_e("Transparent dark","hc") ?></option>
                                <option value="transparent-light"><?php esc_attr_e("Transparent light","hc") ?></option>
                                <option value="tv"><?php esc_attr_e("Tv","hc") ?></option>
                                <option value="squares"><?php esc_attr_e("Squares","hc") ?></option>
                            </select>
                        </li>
                        <li class="input-checkbox input-row">
                            <p><?php esc_attr_e("Breadcrumbs","hc") ?></p>
                            <input data-hc-setting="breadcrumbs" type="checkbox">
                        </li>
                        <li class="input-checkbox input-row">
                            <p><?php esc_attr_e("White","hc") ?></p>
                            <input data-hc-setting="white" type="checkbox" checked>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_title_animation">
    <div data-hc-id="title-animation" data-hc-component="hc_title_animation" data-hc-setting="title_content">
        <input type="hidden" class="file_require" value="spritely">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <p class="input-label"><?php esc_attr_e("Background Image","hc") ?></p>
                        <div class="upload-box upload-row full-input">
                            <span class="close-button"></span>
                            <div class="upload-container">
                                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="input-label"><?php esc_attr_e("Main image - PNG","hc") ?></p>
                        <div class="upload-box upload-row full-input">
                            <span class="close-button"></span>
                            <div class="upload-container">
                                <div data-hc-setting="image_main" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-select input-row">
                    <p><?php esc_attr_e("Animation image","hc") ?></p>
                    <select data-hc-setting="animation_image">
                        <option selected value="clouds-1 "><?php esc_attr_e("Clouds 1","hc") ?></option>
                        <option value="clouds-2"><?php esc_attr_e("Clouds 2","hc") ?></option>
                        <option value="fog-1"><?php esc_attr_e("Fog 1","hc") ?></option>
                        <option value="fog-2"><?php esc_attr_e("Fog 2","hc") ?></option>
                    </select>
                </div>
                <div class="input-select input-row">
                    <p><?php esc_attr_e("Animation image","hc") ?> 2</p>
                    <select data-hc-setting="animation_image_2">
                        <option value="clouds-1 "><?php esc_attr_e("Clouds","hc") ?> 1</option>
                        <option selected value="clouds-2"><?php esc_attr_e("Clouds","hc") ?> 2</option>
                        <option value="fog-1"><?php esc_attr_e("Fog","hc") ?> 1</option>
                        <option value="fog-2"><?php esc_attr_e("Fog","hc") ?> 2</option>
                    </select>
                </div>
                <div class="button-inner-options" data-width="315">
                    <i class="button-icon input-row icon-gear-setting-2"></i>
                    <ul>
                        <li class="input-checkbox input-row">
                            <p><?php esc_attr_e("Parallax","hc") ?></p>
                            <input data-hc-setting="parallax" type="checkbox" data-require-file="parallax">
                        </li>
                        <li class="input-checkbox input-row">
                            <p><?php esc_attr_e("Breadcrumbs","hc") ?></p>
                            <input data-hc-setting="breadcrumbs" type="checkbox">
                        </li>
                        <li class="input-checkbox input-row">
                            <p><?php esc_attr_e("White","hc") ?></p>
                            <input data-hc-setting="white" type="checkbox" checked>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div id="cnt_hc_title_base">
    <div data-hc-id="title-base" data-hc-component="hc_title_base" data-hc-setting="title_content">
        <div class="upload-box upload-row full-input">
            <span class="close-button"></span>
            <div class="upload-container">
                <div data-hc-setting="image" data-hc-component="upload" data-upload-link="" data-upload-height="" data-upload-width="" class="upload-btn"></div>
            </div>
        </div>
        <hr class="space s" />
        <div class="button-inner-options" data-width="315">
            <i class="button-icon input-row icon-gear-setting-2"></i>
            <ul>
                <li class="input-checkbox input-row">
                    <p><?php esc_attr_e("Breadcrumbs","hc") ?></p>
                    <input data-hc-setting="breadcrumbs" type="checkbox"checked>
                </li>
                <li class="input-checkbox input-row">
                    <p><?php esc_attr_e("White","hc") ?></p>
                    <input data-hc-setting="white" type="checkbox" checked>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="cnt_hc_title_empty">
    <div data-hc-id="title-empty" data-hc-component="hc_title_empty" data-hc-setting="title_content"></div>
</div>
