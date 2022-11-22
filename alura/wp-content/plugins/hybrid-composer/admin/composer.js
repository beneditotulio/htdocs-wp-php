var SCRIPTS_ARR = { parallax: "parallax.min.js", flexslider: "flexslider/jquery.flexslider-min.js", spritely: "jquery.spritely.min.js", lightbox: "jquery.magnific-popup.min.js", slimscroll: "jquery.slimscroll.min.js", gmaps: "google.maps.min.js", gmaps_api: "https://maps.googleapis.com/maps/api/js?sensor=false", progress_counter: "jquery.progress-counter.js", social: "social.stream.min.js", toolstip: "bootstrap/js/bootstrap.popover.min.js", bootgrid: "jquery.bootgrid.min.js", flipster: "jquery.flipster.min.js", components: "jquery.tab-accordion.js", pagination: "jquery.twbsPagination.min.js", masonry: "isotope.min.js", fullpage: "jquery.fullPage.min.js", popover: "bootstrap/js/bootstrap.popover.min.js", twosides: "fullpage.twoside.js", contact_form: "php/contact-form.js", datepicker: "php/datepicker.min.js", recaptcha: "https://www.google.com/recaptcha/api.js" };
var CSS_ARR = { flexslider: "scripts/flexslider/flexslider.css", lightbox: "scripts/magnific-popup.css", image_box: "css/image-box.css", content_box: "css/content-box.css", social: "scripts/social.stream.css", bootgrid: "scripts/jquery.bootgrid.css", flipster: "scripts/jquery.flipster.min.css", components: "css/components.css", fullpage: "scripts/jquery.fullPage.css", twosides: "css/fullpage.twoside.css", contact_form: "scripts/php/contact-form.css" };
var PAGE_CONTENT_ARR = {};
var HC_CNT = "#hybrid_composer_content";
var HC_CMP = "#hybrid_composer_components";
var wysiwyg_arr = { 'class': "fake-bootstrap", toolbar: 'top-selection', buttons: { insertlink: { title: 'Insert link', image: '\uf08e' }, bold: { title: 'Bold (Ctrl+B)', image: '\uf032', hotkey: 'b' }, italic: { title: 'Italic (Ctrl+I)', image: '\uf033', hotkey: 'i' }, underline: { title: 'Underline (Ctrl+U)', image: '\uf0cd', hotkey: 'u' }, orderedList: { title: 'Ordered list', image: '\uf0cb', showselection: false }, unorderedList: { title: 'Unordered list', image: '\uf0ca', showselection: false }, strikethrough: { title: 'Strikethrough (Ctrl+S)', image: '\uf0cc', hotkey: 's' }, forecolor: { title: 'Text color', image: '\uf1fc' }, highlight: { title: 'Background color', image: '\uf043' }, alignleft: { title: 'Left', image: '\uf036', showselection: false }, aligncenter: { title: 'Center', image: '\uf037', showselection: false }, alignright: { title: 'Right', image: '\uf038', showselection: false }, alignjustify: { title: 'Justify', image: '\uf039', showselection: false }, subscript: { title: 'Subscript', image: '\uf12c', showselection: true }, superscript: { title: 'Superscript', image: '\uf12b', showselection: true }, indent: { title: 'Indent', image: '\uf03c', showselection: false }, outdent: { title: 'Outdent', image: '\uf03b', showselection: false }, removeformat: { title: 'Remove format', image: '\uf12d' } } };
var isPostType = false;
var isPostTypeSingle = false;
var isPostBlog = false;
var isComposerPage = false;
var hc_templates;
var hc_init_archive_page_id = "";
var makeIDarr = [];

(function ($) {
    var myTether;
    var current_source;
    var item_source;
    var current_add_button;
    var html;
    var template_name;
    var body_class_arr;
    var defaul_content = { "main-title": { "component": "hc_title", "id": "main-title", "subtitle": "", "title_content": { "component": "hc_title_image", "id": "title-image", "full_screen": false, "full_screen_height": "", "parallax": false, "ken_burn": "", "overlay": "" }, "title": "" }, "page_setting": { "settings": [] } };
    var browser_type = "chrome";
    var body;

    $(document).ready(function () {
        //INIT
        body = $("body");
        body_class_arr = $(body).attr("class").split(" ");
        if (body_class_arr.indexOf("post-type-page") > -1 || body_class_arr.indexOf("post-type-y-post-types") > -1 || $("#y-post-types-single-area").length || body_class_arr.indexOf("post-type-post") > -1) {
            isComposerPage = true;
            $(body).addClass("hc");

            var wp_editor = $("textarea#content");
            template_name = $("#page_template").val();
            if (body_class_arr.indexOf("post-type-post") > -1) {
                isPostBlog = true;
                defaul_content["section_5ZtkF"] = { "component": "hc_section", "id": "section_5ZtkF", "section_width": "", "animation": "", "animation_time": "", "timeline_animation": "", "timeline_delay": "", "timeline_order": "", "vertical_row": "", "box_middle": "", "css_classes": "", "custom_css_classes": "", "custom_css_styles": "", "section_content": [{ "component": "hc_column", "id": "column_vtfQF", "column_width": "col-md-12", "animation": "", "animation_time": "", "timeline_animation": "", "timeline_delay": "", "timeline_order": "", "css_classes": "", "custom_css_classes": "", "custom_css_styles": "", "main_content": [{ "component": "hc_wp_editor", "id": "Xhugf", "css_classes": "", "custom_css_classes": "", "custom_css_styles": "", "editor_content": "" }] }], "section_settings": "" }
            }
            if (!isEmpty(template_name)) {
                template_name = template_name.replace(".php", "");
                $(body).addClass(template_name);
            }
            if (!!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/)) browser_type = "safari";
            if (navigator.userAgent.indexOf('Firefox') > -1) browser_type = "firefox";
            if (navigator.userAgent.indexOf('MSIE') > -1) browser_type = "ie";
            $(body).addClass("browser-" + browser_type);

            var edit_txt = $(wp_editor).text();
            if (edit_txt.length > 0) {
                var err = false;
                try {
                    PAGE_CONTENT_ARR = JSON.parse(edit_txt);
                    var typevarr = typeof (PAGE_CONTENT_ARR);
                    if (typevarr == "string" || typevarr == "number") err = true;
                } catch (e) {
                    err = true;
                }
                if (err) {
                    PAGE_CONTENT_ARR = defaul_content
                    editor_mode = "classic";
                    $(body).addClass("editor-mode-classic");
                    $(window).trigger('resize').trigger('scroll');
                    $(".select-mode-button-hc").val("classic");
                }
                PAGE_SCRIPTS_ARR = (!isEmpty(PAGE_CONTENT_ARR["scripts"])) ? PAGE_CONTENT_ARR["scripts"] : {};
                PAGE_CSS_ARR = (!isEmpty(PAGE_CONTENT_ARR["css"])) ? PAGE_CONTENT_ARR["css"] : {};
            } else {
                var content = $("#hc_content_container_secondary").html();
                if (isEmpty(content)) {
                    PAGE_CONTENT_ARR = defaul_content;
                } else {
                    try {
                        PAGE_CONTENT_ARR = JSON.parse(content);
                    } catch (e) { PAGE_CONTENT_ARR = defaul_content }
                    try {
                        if (!isEmpty(PAGE_CONTENT_ARR)) {
                            PAGE_SCRIPTS_ARR = (!isEmpty(PAGE_CONTENT_ARR["scripts"])) ? PAGE_CONTENT_ARR["scripts"] : {};
                            PAGE_CSS_ARR = (!isEmpty(PAGE_CONTENT_ARR["css"])) ? PAGE_CONTENT_ARR["css"] : {};
                        } else PAGE_CONTENT_ARR = defaul_content;
                    } catch (e) { PAGE_CONTENT_ARR = defaul_content; }
                }
            }
            if (body_class_arr.indexOf("post-type-y-post-types") > -1) {
                isPostType = true;
                var p = $(".post-type-y-post-types #titlediv #title");
                if ($(p).val() == "") $("#titlewrap").hide(); else $(p).attr("disabled", "true");
                if ("post_type_setting" in PAGE_CONTENT_ARR && "settings" in PAGE_CONTENT_ARR["post_type_setting"]) {
                    hc_init_archive_page_id = PAGE_CONTENT_ARR["post_type_setting"]["settings"]["archive_page_id"];
                }
            }
            if ($("#y-post-types-single-area").length) {
                if (!isPostBlog) {
                    $("#lock-mode").val("lock-mode-on");
                    $(body).addClass("y-post-types-single").addClass("hc-locked-mode");
                    $("#lock_button_hc i").attr("class", "icon-lock");
                }
                isPostTypeSingle = true;
            }
            //if (isComposerPage && $(window).width() < 1700) $(body).addClass("folded");

            //APPLY CONTENT
            var reload_hc = false;
            if (getURLParameter("hc") == "cache") {
                reload_hc = true;
            } else {
                var post_id = getURLParameter("post");
                if (!isEmpty(post_id)) {
                    try {
                        var ls_0 = localStorage.getItem("arr-post-" + post_id);
                        if (ls_0 === null || ls_0 != edit_txt.length) {
                            reload_hc = true;
                        } else {
                            var ls_1 = localStorage.getItem("post-" + post_id);
                            var ls_2 = localStorage.getItem("post-meta-top-" + post_id);
                            var ls_3 = localStorage.getItem("post-meta-" + post_id);
                            if (ls_1 === null || ls_2 === null || ls_3 === null) {
                                reload_hc = true;
                            } else {
                                if (ls_1.length > 10) $("#hybrid_composer_content").html(ls_1);
                                if (ls_2.length > 10) $("#template-meta-boxes-top .inside").html(ls_2);
                                if (ls_3.length > 10) $("#template-meta-boxes .inside").html(ls_3);
                                $("#hybrid_composer_content select,#template-meta-boxes-top select,#template-meta-boxes select").each(function () {
                                    $(this).setContentValue($(this).find("[data-select]").val());
                                });
                                $("#hybrid_composer_content select,#template-meta-boxes-top select,#template-meta-boxes select").each(function () {
                                    $(this).setContentValue($(this).find("[data-select]").val());
                                });
                                applyPostTypesContent();
                                applyGlobalContentArr();
                            }
                        }
                    } catch (e) {
                        reload_hc = true;
                    }
                } else {
                    reload_hc = true;
                    var post_id = getURLParameter("post");
                    if (!isEmpty(post_id)) {
                        localStorage.removeItem("post-" + post_id);
                    }
                }
            }
            if (reload_hc) {
                applyHTMLContentArr();
                applyContentArr();
            }
            $(".hc-loading-icon").hide();
            $(".hc-start-button,#edit-slug-box").show();

            //INPUTS MONITOR
            $(body).on("click", "input:checkbox", function () {
                //1
                if (!isEmpty($(this).attr("data-dependence-trigger"))) {
                    var p = $(this).closest("[data-hc-id]");
                    var action = $(this).attr("data-dependence-trigger");
                    if (isEmpty(p)) p = $(this).closest(".inside");
                    var target = $(p).find("[data-dependence-show='" + $(this).attr("data-hc-setting") + "']");
                    if (action == "hide") {
                        if ($(this).is(':checked')) {
                            $(target).hide();
                        } else $(target).showSmart();
                    } else {
                        if ($(this).is(':checked')) {
                            $(target).showSmart();
                        } else $(target).hide();
                    }
                }
                //2
                if ($(this).isContentSetted()) {
                    var t = this;
                    var name = $(t).attr("name");
                    if (!isEmpty(name)) {
                        $(t).closest("[data-hc-id]").find("input:checkbox[name='" + name + "']").each(function () {
                            if ($(this).isContentSetted() && this !== t) { $(this).click(); $(this).attr("checked", false); }
                        });
                    }
                }
                //3
                if (!isEmpty($(this).attr("data-require"))) {
                    var id = $(this).attr('data-require');
                    var c = $(this).closest("[data-hc-id]");
                    var t = $(c).find("[data-hc-setting='" + id + "']");
                    if (isEmpty(t)) t = $(".popover-box").find("[data-hc-setting='" + id + "']");
                    if ($(this).is(':checked') && !$(t).is(':checked')) $(t).click();
                }
            });
            $(body).on("change", "select", function () {
                var css = $(this).attr("class");
                if (!isEmpty(css)) css.split(" ");
                else css = [];
                $(this).setContentValue($(this).val());

                //1
                if (!isEmpty($(this).attr("data-dependence-trigger"))) {
                    var p = $(this).closest("[data-hc-id]");
                    var action = $(this).attr("data-dependence-trigger");
                    if (isEmpty(p)) p = $(this).closest(".inside");
                    var target = $(this).attr("data-hc-setting");
                    var val = $(this).val();
                    $(this).find("option").each(function () {
                        var tt = $(p).find("[data-dependence-show='" + target + "_" + $(this).val() + "']");
                        if (action == "hide") if ($(this).val() != val) $(tt).showSmart(); else $(tt).hide();
                        else if ($(this).val() != val) $(tt).hide(); else $(tt).showSmart();
                    });
                }
                //2
                var id = $(this).attr('data-require');
                if (!isEmpty(id)) {
                    var t = $(this).closest("[data-hc-id]").find("[data-hc-setting='" + id + "']");
                    if (isEmpty(t)) t = $(".popover-box").find("[data-hc-setting='" + id + "']");
                    if ($(this).val() != "" && !$(t).is(':checked')) $(t).click();
                }
                //3
                if (css.indexOf("select-css-repeater") > -1) $(this).setInputCSSrepeater(parseInt($(this).val()));
                //4
                if (css.indexOf("content-box-style") > -1) {
                    var val = $(this).val();
                    if (val == "top_icon_image" || val == "multiple_box" || val == "side_content") $(current_source).closest(".hc-content-box").find(".upload-box").show();
                    else $(current_source).closest(".hc-content-box").find(".upload-box").hide();
                }
                //5
                if (css.indexOf("link-type") > -1) {
                    var t = $(this).closest(".hc-link");
                    var val = $(this).val();
                    if (val == "custom") {
                        $(t).find(".input-link").first().hide();
                        $(t).find(".link-content-btn").first().show();
                    } else {
                        $(t).find(".input-link").first().show().prop("disabled", false);
                        $(t).find(".link-content-btn").first().hide();
                    }
                    if (val == "lightbox") {
                        $(t).find("input").show();
                        $(t).find(".upload-hc-button").show();
                    } else $(t).find(".upload-hc-button").hide();
                }
                //6
                if (css.indexOf("select-icon-style") > -1) {
                    if ($(this).val().indexOf("image") != -1) $("#popover-box-icons-all .upload-box").show();
                    else $("#popover-box-icons-all .upload-box").hide();
                }
                //7
                if (css.indexOf("social-container-type") > -1) {
                    var t = $(current_source).closest(".hc-social-feeds").find(".data-options-slider");
                    var t2 = $(current_source).closest(".hc-social-feeds").find(".data-options-scroll-box");
                    if ($(this).val() == "slider" || $(this).val() == "carousel") $(t).show();
                    else $(t).hide();
                    if ($(this).val() == "scroll_box") $(t2).show();
                    else $(t2).hide();
                }
                //8
                if (css.indexOf("social-type") > -1) {
                    $(".data-options-button-tw,.data-options-button-fb").hide();
                    $(".data-options-button-" + $(this).val()).show();
                }
                //9
                if (css.indexOf("select-mode-button-hc") > -1) {
                    if ($(this).val() == "composer") {
                        $(body).removeClass("editor-mode-classic");
                    } else {
                        $(body).addClass("editor-mode-classic");
                        $(window).trigger('resize').trigger('scroll');
                    }
                }
                //10
                if (css.indexOf("post-type-slug") > -1) {
                    var select_cats = $(this).closest("[data-hc-id]").find(".post-type-category");
                    var cat_slug = $(this).val();
                    if ($(select_cats).length) {
                        $(select_cats).val("");
                        $(select_cats).find("option").each(function (i) {
                            if (i > 0) {
                                if ($(this).attr("data-taxonomy").startsWith(cat_slug)) $(this).show();
                                else $(this).hide();
                            }
                        });
                    }
                }
            });
            $(body).on("click", "div,input,span,li,a,i,th", function (e) {
                var attr_sett = $(this).attr("data-hc-setting");
                var css = $(this).attr("class");
                if (!isEmpty(css)) css = css.split(" ");
                else css = [];

                //1
                if (!isEmpty(attr_sett)) {
                    if ($(this).is("input:checkbox")) {
                        var id = $(this).attr("data-hc-setting");
                        var t = $(this).closest("*[data-hc-id]").find("*[data-require='" + id + "']");
                        if (!$(this).is(':checked')) {
                            $(t).setContentValue("");
                            if ($(t).attr("data-require-action") == "hide") {
                                $(t).closest(".input-row").hide();
                            }
                        } else if ($(t).attr("data-require-action") == "hide") $(t).closest(".input-row").css("display", "inline-block");
                    }
                }
                //2
                var tmp = $(this).attr("data-hc-component");
                if (!isEmpty(tmp) && tmp == "upload") {
                    var img_src = this;
                    var cnt = $(this).closest(".upload-box");
                    $(this).open_upload_box(function (target, attachment) {
                        if ($(cnt).hasClass("upload-multi")) {
                            var html = "";
                            var cmp = $("#cnt_hc_upload_img").html();
                            var IDs = makeID(attachment.length);
                            var img_size = [$(cnt).find(".upload-container").first().width(), $(cnt).find(".upload-container").first().height()];
                            for (var i = 0; i < attachment.length; i++) {
                                var img = attachment.models[i].toJSON();
                                var img_url;
                                try {
                                    img_url = img.sizes.large.url;
                                } catch (e) {
                                    img_url = img.url;
                                }
                                var img_html = cmp.replace(/_ID/g, IDs[i]).replace(/_HEIGHT/g, img.height).replace(/_WIDTH/g, img.width).replace(/_LINK/g, img_url).replace(/_IMGID/g, img.id);
                                if (img_size[0] > img.width || img_size[0] > img.height) img_html = img_html.replace('class="upload-btn"', 'class="upload-btn bg-contain"');
                                html += img_html;
                            }
                            $(cnt).append(html);
                        } else {
                            var img = attachment.models[0].toJSON();
                            var img_url;
                            var cnt_w = $(img_src).width();
                            var cnt_h = $(img_src).height();
                            try {
                                img_url = img.sizes.large.url;
                            } catch (e) {
                                img_url = img.url;
                            }
                            $(img_src).attr("data-upload-link", img_url);
                            $(img_src).attr("data-upload-height", img.height);
                            $(img_src).attr("data-upload-width", img.width);
                            $(img_src).attr("data-upload-id", img.id);
                            $(img_src).css("background-image", "url(" + img_url + ")");
                            $(img_src).setImageSize();
                        }
                        $(cnt).find(".close-button").show();
                        if ($(img_src).hasClass("upload-img-box")) {
                            var iml = $(img_src).closest(".hc-image-box");
                            var it = $(img_src).closest(".hc-image-box").find(".input-link");
                            if ($(iml).find(".link-type").val() == "lightbox" && ($(it).val().length == 0 || $(it).val().indexOf(".jpg") > -1)) $(it).val(img_url);
                        }
                    });
                }
                //3
                if (css.indexOf("close-button") > -1) {
                    var tmp = $(this).closest(".upload-container");
                    var isPopup = true;
                    if (!isEmpty(tmp)) {
                        $(this).closest(".upload-container").remove();
                        isPopup = false;
                    } else {
                        var tmp = $(this).closest(".upload-box");
                        if (!isEmpty(tmp)) {
                            isPopup = false;
                            var img_src = $(this).closest(".upload-box").find('[data-hc-component="upload"]');
                            $(img_src).attr("data-upload-link", "").attr("data-upload-height", "").attr("data-upload-width", "").attr("data-upload-id", "").css("background-image", "");
                            $(this).hide();
                        } else {
                            var tmp = $(this).closest(".upload-link");
                            if (!isEmpty(tmp)) {
                                var t = this;
                                $(this).open_upload_box(function (target, attachment) {
                                    $(img_src).closest(".upload-link").find("input").val(attachment.first().toJSON().url);
                                });
                            } else {
                                var tmp = $(this).closest(".repeater-cnt");
                                if (!isEmpty(tmp)) {
                                    $(this).closest(".repeater-cnt").remove();
                                } else {
                                    var tmp = $(this).closest("#popover-box-columns");
                                    if (!isEmpty(tmp)) {
                                        $(".button-column").removeClass("active");
                                    } else {
                                        var tmp = $(this).closest(".save-template-box");
                                        if (!isEmpty(tmp)) {
                                            deleteHCTemplate($(this).closest(".component-box").find(".sch").html());
                                            e.preventDefault;
                                            return false;
                                        } else {
                                            var tmp = $(this).closest(".hc-cnt-content");
                                            if (!isEmpty(tmp)) {
                                                var col = $(tmp).closest(".column-content");
                                                if ($(col).find(".hc-cnt-content").length < 2) {
                                                    $(col).find(".hc-add-component").addClass("column-empty");
                                                }
                                                $(tmp).remove();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    if (isPopup) $(".popover-box").hide();
                }
                //4
                if (css.indexOf("button-column") > -1) {
                    var t = $("#popover-box-columns");
                    var val = $(this).attr("data-value");
                    $(".columns-list span").removeClass("active");
                    $(t).find("*[data-value='" + val + "']").addClass("active");
                    current_source = this;
                    $(t).showTether(this);
                    $(this).addClass("active");
                    $(".column-type").html("");
                }
                //5
                if (css.indexOf("button-anima") > -1) {
                    var t = $("#popover-box-anima");
                    var val = $(this).attr("data-value");
                    $("#popover-box-anima .select-button").removeClass("active");
                    $(t).find("*[data-value='" + val + "']").addClass("active");
                    if ($(this).hasClass("button-anima-section")) {
                        $(t).find("#timeline-delay").val($(this).find(".timeline-delay").val());
                        $(t).find("#timeline-order").val($(this).find(".timeline-order").val());
                        if ($(this).find(".timeline-animation").val() == "true") $(t).find("#timeline-animation").prop('checked', true);
                        else $(t).find("#timeline-animation").prop('checked', false);
                        $(t).addClass("popover-box-section");
                    } else $(t).removeClass("popover-box-section");
                    $(t).find("#animation-speed").val($(this).find(".animation-time").val());
                    current_source = this;
                    $(t).showTether(this);
                }
                //6
                if (css.indexOf("repeater-add-new") > -1) {
                    var t = $(this).closest(".input-repeater");
                    var source = $(t).find(".repeater-source").html().replace("<!--", "").replace("-->", "");
                    $(t).find(".repeater-container").append('<div class="hc-cnt-content" data-hc-setting="' + $(t).find(".repeater-container").attr("data-hc-setting") + '" data-hc-id="' + makeID() + '" data-hc-component="repeater_item">' + source + '<span class="order-top"></span><span class="order-down"></span><span class="close-button"></span><div class="clear"></div></div>');
                    $(this).closest(".hc-cnt-component").find("[data-dependence-trigger]").click().click();
                }
                //7
                if (css.indexOf("button-close") > -1) {
                    var tmp = $(this).closest("[data-hc-component]");
                    if (!isEmpty(tmp)) {
                        var tmp2 = $(tmp).closest(".column-content");
                        if ($(tmp2).find(".hc-cnt-content,.hc-column").length < 2) {
                            $(tmp2).find(" > .row > .hc-add-component").addClass("column-empty");
                        }
                        $(tmp).remove();
                    }
                }
                //8
                if (css.indexOf("select-button") > -1) {
                    if (!isEmpty($(this).closest("#popover-box-anima"))) {
                        var val = $(this).attr("data-value");
                        $(current_source).attr("data-value", val);
                        $(current_source).find(".animation-time").val($("#popover-box-anima #animation-speed").val());
                        $("#popover-box-anima .select-button").removeClass("active");
                        $(this).addClass("active");
                    }
                }
                //9
                if (css.indexOf("popover-button-save") > -1) {
                    if (!isEmpty($(this).closest("#popover-box-anima"))) {
                        $(current_source).find(".animation-time").val($("#popover-box-anima #animation-speed").val());
                        $(current_source).find(".timeline-animation").val($("#popover-box-anima #timeline-animation").is(':checked'));
                        $(current_source).find(".timeline-delay").val($("#popover-box-anima #timeline-delay").val());
                        $(current_source).find(".timeline-order").val($("#popover-box-anima #timeline-order").val());
                        $("#popover-box-anima").hide();
                    }
                }
                //10
                if (css.indexOf("button-copy") > -1) {
                    var target = $(this).closest(".hc-column,.hc-section,.hc-cnt-content");
                    $(target).find("[data-hc-setting]").each(function () {
                        $(this).setContentValue($(this).readContentValue());
                    });
                    var duplicate = $.parseHTML($(target).outerHTML());
                    var type = "column_";
                    if ($(target).hasClass("hc-section")) type = "section_";
                    if ($(target).hasClass("hc-column")) type = "column_";
                    var target_id = $(target).attr("data-hc-id");
                    if (isEmpty(target_id)) target_id = $(this).closest("[data-hc-id]").attr("data-hc-id");
                    var duplicate_id = type + makeID();

                    $(duplicate).find("[data-hc-id]").each(function () {
                        $(this).attr("data-hc-id", makeID());
                    });

                    $(duplicate).attr("data-hc-id", duplicate_id).addClass("new-anima");
                    $(target).replaceWith($(target).outerHTML() + $(duplicate).outerHTML());
                    $(target).resetComponentsValue();
                    $("[data-hc-id='" + duplicate_id + "']").resetComponentsValue();
                    autosize($("[data-hc-id='" + duplicate_id + "'] .input-text-area textarea,[data-hc-id='" + target_id + "'] textarea"));
                }
                //13
                if (css.indexOf("cl-item") > -1) {
                    var val = $(this).attr("data-value");
                    var t = $(current_source).closest(".hc-column");
                    $(t).attr("class", "hc-column " + val).find(".button-column").first().attr("data-value", val);
                    $(t).setWidthLayout();
                    myTether.position();
                    $(".columns-list span").removeClass("active");
                    $(this).addClass("active");
                    $(t).find("[data-hc-component='upload']").setImageSize();
                }
                //14
                if (css.indexOf("button-vertical-row") > -1) {
                    if ($(this).hasClass("active")) {
                        $(this).attr("data-value", "");
                        $(this).removeClass("active");
                    } else {
                        $(this).attr("data-value", "true");
                        $(this).addClass("active");
                    }
                }
                //15
                if (css.indexOf("lock-button-hc") > -1) {
                    var t = $("#lock-mode");
                    if ($(t).val() == "lock-mode-off") {
                        $(this).find("i").attr("class", "icon-lock");
                        $(t).val("lock-mode-on");
                        $(body).addClass("hc-locked-mode");
                    } else {
                        $(this).find("i").attr("class", "icon-unlock");
                        $(t).val("lock-mode-off");
                        $(body).removeClass("hc-locked-mode");
                    }
                }
                //16
                if (css.indexOf("upload-hc-button") > -1) {
                    var t = this;
                    $(this).open_upload_box(function (target, attachment) {
                        $(t).closest("div").find(".input-link").val(attachment.first().toJSON().url);
                    });
                }
                //17
                if (css.indexOf("hc-add-new-component") > -1 || css.indexOf("hc-add-component") > -1) {
                    var t = $("#popover-box-components");
                    current_source = $(this).closest("*[data-hc-setting]");
                    current_add_button = this;

                    $(t).attr("class", "popover-box search-filter");
                    if ($(this).hasClass("hc-add-new-component")) {
                        current_source = HC_CNT;
                        $(t).addClass("only-sections");
                    }
                    if ($(this).hasClass("hc-add-component")) {
                        var did = $(current_source).attr("data-hc-id");
                        var css_class = $(current_source).attr("data-class");
                        if (!isEmpty(css_class)) $(t).addClass(css_class);
                        $(t).addClass("no-sections");
                        if (did == "section_content" || did == "link_content") $(t).addClass("only-columns");
                        var hide_val = $(this).attr("data-components");
                        if (!isEmpty(hide_val)) {
                            $(t).addClass("only-hide-all").addClass(hide_val);
                        }
                    }
                    $(t).showTether(this);
                }
                //18
                if (css.indexOf("component-box") > -1) {
                    if (!isEmpty($(this).closest("#popover-box-components"))) {
                        var button = $(current_source).find(".hc-add-component").last();
                        var target = $(this).attr("data-hc-target");
                        var label = "";
                        var new_id = makeID();
                        if (target.indexOf("hc_section") != -1) label = "section_"
                        if (target == "hc_column") label = "column_"
                        var html = $(HC_CMP + " #cnt_" + target).html();
                        html = html.replace(/_ID/g, label + new_id);
                        if (target == "hc_column") {
                            var col = $(this).attr("data-hc-extra");
                            html = html.replace(/hc-tmp/g, col).replace("hc-column", "hc-column new-anima");
                        } else html = "<div class='hc-cnt-content new-anima'>" + html + "</div>";
                        $(current_source).find("> .clear").remove();
                        $(current_source).append(html);
                        $(current_source).find(".column-empty").removeClass(".column-empty");
                        var cmp_id = $(html).find("[data-hc-id]").attr("data-hc-id");
                        $(current_source).find("[data-hc-id='" + cmp_id + "'] .input-repeater").each(function () {
                            var t = $(this).find(".repeater-container");
                            var s = $(this).find(".repeater-source");
                            if ($(t).html().length == 0) $(t).html('<div class="hc-cnt-content" data-hc-setting="' + $(t).attr("data-hc-setting") + '" data-hc-id="' + makeID() + '" data-hc-component="repeater_item">' + $(s).html() + '<div class="clear"></div><span class="order-top"></span><span class="order-down"></span><span class="close-button"></span></div>');
                            setHTMLcomment($(s));
                        });
                        $(current_source).find("[data-hc-id='" + cmp_id + "'] .tab-hc .panel").each(function (i) {
                            if (i != 0 && target != "hc_column") setHTMLcomment($(this));
                        });
                        if (target.indexOf("hc_section") == -1 && target.indexOf("hc_page_") == -1) {
                            var hide_val = $(current_add_button).attr("data-components");
                            var hide_val_html = "";
                            if (!isEmpty(hide_val)) hide_val_html = ' data-components="' + hide_val + '"';
                            $(current_source).append('<div class="clear"></div><div class="hc-add-component"' + hide_val_html + '><i class="icon-plus-add-2"></i></div>');
                            $(button).remove();
                        }
                        var t = $(current_source).find("> .hc-cnt-content").last();
                        if (isEmpty(t)) t = current_source;
                        if (target == "hc_column") {
                            $($(current_source).find("[data-hc-id='column_" + new_id + "']")).setWidthLayout();
                        } else {
                            $(t).setWidthLayout();
                        }

                        setTimeout(function () {
                            $(".new-anima").removeClass("new-anima");
                        }, 1000);

                        //Initialize plugins
                        if (target == "hc_wp_editor") $(current_source).find(".hc-wysiwyg-editor").last().wysiwyg(wysiwyg_arr);
                        autosize($(current_source).find(".input-text-area textarea"));

                        $(".popover-box").hide();
                    }
                    if (!isEmpty($(this).closest("#hc_templates_list"))) {
                        PAGE_CONTENT_ARR = hc_templates[$(this).find(".sch").html()];
                        applyHTMLContentArr();
                        applyContentArr();
                        generatePageContentArr();
                        printPageContentArr();
                        $('.mfp-close').click();
                    }
                    if (!isEmpty($(this).closest("#hc_default_templates_list"))) {
                        var t = this;
                        jQuery.ajax({
                            method: "POST",
                            url: ajax_url,
                            data: {
                                action: 'hc_get_templates',
                                template_id: $(t).attr("data-hc-target")
                            },
                            async: false
                        }).done(function (response) {
                            if (response != "error") {
                                PAGE_CONTENT_ARR = JSON.parse(response);
                                applyHTMLContentArr();
                                applyContentArr();
                                generatePageContentArr();
                                printPageContentArr();
                                $('.mfp-close').click();
                            } else alert("Error. Template not found.");
                        });
                    }
                    e.preventDefault();
                    return false;
                }
                //19
                if (css.indexOf("button-icons-list") > -1) {
                    var t = $("#popover-box-icons");
                    current_source = this;
                    $(t).showTether(this);
                }
                //20
                if (css.indexOf("button-icons-list-wp") > -1) {
                    var t = $("#popover-box-icons-wp");
                    current_source = this;
                    $(t).showTether(this);
                }
                //21
                if (css.indexOf("button-icons-list-all") > -1) {
                    var t_txt = "#popover-box-icons-all";
                    var t = $(t_txt);
                    var icon_s = $(this).find(".icon-style").val();
                    if (icon_s.indexOf("image") != -1) $(t_txt + " .upload-box").show();
                    else $(t_txt + " .upload-box").hide();
                    $(t).find("#icon-style").val(icon_s);
                    $(t).find(".upload-btn").setContentValue($(this).find(".icon-image").val());
                    current_source = this;
                    $(t).showTether(this);
                }
                //22
                if (css.indexOf("button-css") > -1) {
                    current_source = this;
                    var t = $("#popover-box-code");
                    var val = $(this).attr("data-value");
                    var arr = [];
                    if (val.length > 0) arr = val.split(" ");
                    $(t).find(".css-class-list input").setContentValue(false);
                    for (var i = 0; i < arr.length; i++) {
                        $(t).find(".css-class-list [data-value='" + arr[i] + "'] input").setContentValue(true);
                    }
                    $(t).find(".custom-css-classes input").val($(current_source).find(".custom-css-classes").val());
                    $(t).find(".custom-css-styles input").val($(current_source).find(".custom-css-styles").val());
                    $(t).showTether(this);
                    $("#composer-item-id input").val($(this).closest("[data-hc-id]").attr("data-hc-id"));
                }
                //23
                if (css.indexOf("button-css-save") > -1) {
                    var t = $(this).closest("#popover-box-code");
                    var classes = "";
                    $(".css-class-list li").each(function () {
                        if ($(this).find("input").isContentSetted()) classes += $(this).attr("data-value") + " ";
                    });
                    $(current_source).find(".custom-css-classes").val($(t).find(".custom-css-classes input").val());
                    $(current_source).find(".custom-css-styles").val($(t).find(".custom-css-styles input").val());
                    $(current_source).attr("data-value", classes);

                    var id = $(t).find("#composer-item-id input").val();
                    var target = $(current_source).closest(".hc-cnt-component,.hc-column,.hc-section");
                    $(target).removeClass("layout-column-center")
                    if (!isEmpty(id)) $(target).attr("data-hc-id", id);
                    if (classes.indexOf("col-center") > -1) {
                        if ($(target).hasClass("hc-column")) $(target).closest(".hc-column").addClass("layout-column-center");
                    }
                    $(t).hide();
                }
                //24
                if (css.indexOf("button-inner-options") > -1) {
                    var t;
                    if ($(this).hasClass("big-inner-options")) {
                        t = $("#popover-box-empty-big");
                        $("#popover-box-empty-big .list").slimScroll({
                            height: '385px',
                            size: '4px'
                        });
                    }
                    else t = $("#popover-box-empty");
                    var w = $(this).attr("data-width");
                    $(t).css("max-width", "");
                    if (!isEmpty(w)) $(t).css("max-width", w + "px");
                    current_source = this;
                    $(t).find("ul").html($(this).find("ul").html());

                    $(t).find("ul select[data-hc-setting]").each(function () {
                        $(this).find("option[data-select]").attr("selected", "selected");
                    });

                    $(t).find(".upload-box").each(function () {
                        var close = $(this).find(".close-button");
                        if (!isEmpty($(this).find(".upload-btn").attr("data-upload-link"))) {
                            $(close).css("display", "block");
                        } else $(close).css("display", "none");
                    });

                    $(t).showTether(this);
                }
                //25
                if (css.indexOf("popover-inner-save") > -1) {
                    if ($(this).hasClass("popover-big-inner-save")) t = $("#popover-box-empty-big");
                    else t = $("#popover-box-empty");
                    $(t).find("ul").html($(this).find("ul").html())
                    $(t).find("[data-hc-setting]").each(function () {
                        $(current_source).find("[data-hc-setting='" + $(this).attr("data-hc-setting") + "']").setContentValue($(this).readContentValue());
                        if ($(this).attr("data-layout") == "column")
                            setColumnLayout(this, $(current_source).closest("[data-hc-id]"));
                    });
                    $(t).hide();
                }
                //26
                if (css.indexOf("data-options-button") > -1 || (!isEmpty(attr_sett) && attr_sett == "data_options")) {
                    var t = $(this).attr("href");
                    current_source = this;
                    var val = $(this).attr("data-value");
                    var defval = $(this).attr("data-default-values");
                    $(t).find("ul li *[data-option-id],ul li *[data-sub-option-id]").each(function () {
                        var def = $(this).attr("data-default");
                        if (isEmpty(def)) def = "";
                        $(this).setContentValue(def);
                    });
                    if (!isEmpty(defval)) {
                        var arr = defval.split(",");
                        for (var i = 0; i < arr.length; i++) {
                            var item = arr[i].split(":");
                            $(t).find("*[data-option-id='" + item[0] + "']").setContentValue(item[1]);
                        }
                    }
                    if (!isEmpty(val)) {
                        var arr = val.split(",");
                        for (var i = 0; i < arr.length; i++) {
                            var item = arr[i].split(":");
                            $(t).find("*[data-option-id='" + item[0] + "']").setContentValue(item[1]);
                        }
                    }

                    var sub_val = $(this).find(".data_sub_options").val();
                    if (!isEmpty(sub_val)) {
                        var arr = sub_val.split(",");
                        for (var i = 0; i < arr.length; i++) {
                            var item = arr[i].split(":");
                            $(t).find("*[data-sub-option-id='" + item[0] + "']").setContentValue(item[1]);
                        }
                    }

                    if ($(this).hasClass("options-all")) {
                        $(t).find("*[data-sub-option-id]").closest("li").show();
                        $(t).find(".data-sub-option").show();
                    } else {
                        $(t).find("*[data-sub-option-id]").closest("li").hide();
                        $(t).find(".data-sub-option").hide();
                    }


                    $(this).show();
                    $(t).showTether(this);
                    return false;
                }
                //27
                if (css.indexOf("popover-box-save") > -1) {
                    var c = $(this).closest(".popover-box");
                    var result = "";

                    $(c).find("ul li *[data-option-id]").each(function () {
                        var def = $(this).attr("data-default");
                        if (isEmpty(def)) def == "";
                        var val = $(this).readContentValue() + "";
                        if (val != def && val.length > 0) result += $(this).attr("data-option-id") + ":" + val + ",";
                    });
                    result = result.substr(0, result.length - 1);
                    $(current_source).attr("data-value", result);

                    var sub_opt = $(current_source).find(".data_sub_options");
                    if (sub_opt.length) {
                        result = "";
                        $(c).find("ul li *[data-sub-option-id]").each(function () {
                            var def = $(this).attr("data-default");
                            if (isEmpty(def)) def == "";
                            var val = $(this).readContentValue() + "";
                            if (val != def && val.length > 0) result += $(this).attr("data-sub-option-id") + ":" + val + ",";
                        });
                        result = result.substr(0, result.length - 1);
                        $(sub_opt).val(result);
                    }

                    $(c).hide();
                    return false;
                }
                //28
                if (css.indexOf("button-checkbox") > -1) {
                    if ($(this).attr("data-value") == "true") $(this).setContentValue("");
                    else $(this).setContentValue("true");
                }
                //29
                if (css.indexOf("fullpage-single-bg-btn") > -1) {
                    if ($(this).isContentSetted()) $(body).addClass("fullpage-single-bg");
                    else $(body).removeClass("fullpage-single-bg");
                }
                //30
                if (css.indexOf("input-button") > -1) {
                    var tmp = $(this).closest(".upload-link");
                    if (!isEmpty(tmp)) {
                        var t = this;
                        $(this).open_upload_box(function (target, attachment) {
                            $(tmp).find("input").val(attachment.first().toJSON().url);
                        });
                    }
                }
                //31
                if (css.indexOf("link-content-btn") > -1) {
                    var t = $(this).closest(".hc-link").find(".link-content");
                    $(t).show();
                    $(t).find(".scroll-content").slimScroll({
                        height: '500px'
                    });
                }
                //32
                if (css.indexOf("save-button-css-box") > -1) {
                    $(this).closest(".css-box-popup").hide();
                }
                //33
                if (css.indexOf("composer-item-copy") > -1) {
                    var target = $(current_source).closest(".hc-column,.hc-section,.hc-cnt-content");
                    $(target).find("[data-hc-setting]").each(function () {
                        $(this).setContentValue($(this).readContentValue());
                    });
                    var clone = $(target)[0].cloneNode(true);
                    localStorage.setItem("hc-clipboard", $(clone).outerHTML());
                    $(".popover-box").hide();
                }
                //34
                if (css.indexOf("composer-item-paste") > -1) {
                    var html = localStorage.getItem("hc-clipboard");
                    if (!isEmpty(html)) {
                        var target_type = "component";
                        var type = "component";
                        var sub = html.substring(0, 100);
                        var sec = "#hybrid_composer_content > .hc-cnt-content:last-child,#hybrid_composer_content > div > .hc-cnt-content:last-child";
                        if (isEmpty(current_source)) current_source = sec;
                        if ($(this).hasClass("item-add")) {
                            target_type = "column";
                        }
                        if ($(current_source).attr("data-hc-setting") == "section_content") {
                            target_type = "inner_section";
                        }
                        if ($(this).hasClass("section-add")) {
                            target_type = "section";
                        }
                        if (sub.indexOf("hc_column") > 0) type = "column";
                        if (sub.indexOf("hc_section") > 0) {
                            type = "section";
                            current_source = sec;
                        }
                        if (target_type == type || target_type == "column" && type == "component" || target_type == "inner_section" && type == "column") {
                            if ($(current_source).length == 0 && type == "section") {
                                current_source = $("#hybrid_composer_content");
                                html = '<div class="hc-cnt-content">' + html + '</div>';
                            }
                            var dom = $('<div>').html(html);
                            $.each($(dom).find('[data-hc-id]'), function () {
                                $(this).attr('data-hc-id', makeID());
                            });

                            $(current_source).append($(dom).html());
                            $(current_source).resetComponentsValue();
                            if (type == "component" || type == "column") {
                                posButtonBottom(current_add_button);
                            }
                            $(".popover-box").hide();
                        }
                    }
                }
                //35
                if (css.indexOf("add-init") > -1) {
                    var html = $(HC_CMP + " #cnt_" + $(this).attr("data-target")).html();
                    var num_col = parseInt($(this).attr("data-index"));
                    var html_col = "";
                    html = html.replace(/_ID/g, "section_" + makeID());
                    if (num_col > 1) {
                        var tmp = $(HC_CMP + " #cnt_hc_column").html();
                        tmp = tmp.replace(/hc-tmp/g, "col-md-" + (12 / num_col));
                        for (var i = 0; i < num_col; i++) {
                            html_col += tmp.replace(/_ID/g, "column_" + makeID());
                        }
                    }
                    html = html.replace("<!--section-content-start-->", html_col);
                    $(HC_CNT).append('<div class="hc-cnt-content">' + html + '</div>');
                }
                //36
                if (css.indexOf("order-top") > -1 || css.indexOf("order-down") > -1) {
                    var items = $(this).closest(".repeater-container").find(".hc-cnt-content");
                    var t = $(this).closest(".hc-cnt-content");
                    var is_down = false;
                    var index = $(t).index();
                    var index2 = -1;
                    if (css.indexOf("order-down") > -1) {
                        is_down = true;
                        index2 = 1;
                    }
                    if ((!is_down && index > 0) || (is_down && index < $(items).length - 1)) {
                        var t2 = $(items).eq(index + index2);
                        $(t2).find("[data-hc-setting]").each(function () {
                            $(this).setContentValue($(this).readContentValue());
                        });
                        var html = $('<div>').append($(t2).clone()).html();
                        $(t2).remove();
                        if (css.indexOf("order-down") > -1) {
                            $(t).before(html);
                        } else {
                            $(t).after(html);
                        }
                    }
                }
            });

            //DRAG & DROP ENGINE
            var isDragging = false;
            var dragType;
            var currentOverItem;
            var dragTime = false;
            function hc_drag_reset() {
                $(".hc-column,.hc-section").removeClass("drag-component-active");
                $(".hc-column,.hc-section,.hc-cnt-content").removeClass("drag-move").removeClass("drag-source-cnt").css("margin-top", "").css("margin-bottom", "");
                $(".button-move").removeClass("active");
                $(".button-move-into").remove();
                $(".dragged-now-up").removeClass("dragged-now-up");
                $(".dragged-now-down").removeClass("dragged-now-down");
                $("#wpwrap").removeClass("mouse-dragging").removeClass("drag-type-" + dragType);
                isDragging = false;
            }
            $(body).on("mousedown", ".button-move", function (e) {
                if (e.which === 1) {
                    setTimeout(function () { dragTime = true; }, 700);
                    item_source = $(this).closest(".hc-column,.hc-section,.hc-cnt-content");
                    isDragging = true;
                    currentOverItem = null;
                    var selector_a = ".column-content > div,[data-hc-container='repeater']";

                    if ($(item_source).hasClass("hc-section")) {
                        $(".hc-section").addClass("drag-move").addClass("drag-component-active");
                        dragType = "section";
                        selector_a = "#hybrid_composer_content";
                    }
                    if ($(item_source).hasClass("hc-column")) {
                        $(".hc-column,.hc-cnt-content").addClass("drag-move");
                        $(".hc-column,.hc-section").addClass("drag-component-active");
                        selector_a = ".section-content > div,.column-content > div";
                        dragType = "column";
                    }
                    if ($(item_source).hasClass("hc-cnt-content")) {
                        $(".hc-cnt-content").addClass("drag-move");
                        $(".hc-column,.hc-section").addClass("drag-component-active");
                        dragType = "component";
                    }
                    $(selector_a).each(function () {
                        var items = $(this).find(".drag-move");
                        if (selector_a == "#hybrid_composer_content") items = $(this).find(" > .hc-cnt-content");
                        $(items).removeClass("last-item").last().addClass("last-item");
                        $(items).first().addClass("first-item");
                    });

                    $(item_source).removeClass("drag-move");
                    $(this).addClass("active");
                    $(item_source).addClass("drag-source");
                    $(this).parents(".hc-column,.hc-section,.hc-cnt-content").addClass("drag-source-cnt");
                    $(item_source).find("[data-hc-setting]").each(function () {
                        $(this).setContentValue($(this).readContentValue());
                    });
                    $(".hc-column").each(function () {
                        if ($(this).find(".column-content .hc-cnt-content,.column-content .hc-column").length == 0) {
                            $(this).find("[data-hc-setting='main_content']").append('<i class="button-move-complete button-move-into icon-plus-add-2"></i>');
                        }
                    });
                    $("#wpwrap").addClass("mouse-dragging").addClass("drag-type-" + dragType);
                    e.preventDefault();
                }
            });
            $(body).on("mouseenter", ".column-content", function () {
                if (isDragging) $(this).find(".button-move-into").css("opacity", "1");
            });
            $(body).on("mouseleave", ".column-content", function () {
                if (isDragging) $(this).find(".button-move-into").css("opacity", "0");
            });
            $(body).on("mouseup", ".button-move-complete", function () {
                if (isDragging) currentOverItem = this;
            });

            $(document).on("mouseup", "body", function () {
                if (isDragging) {
                    $(item_source).removeClass("drag-source");
                    $(item_source).css("left", "").css("top", "");
                    if (!isEmpty(currentOverItem) && dragTime) {
                        var target = $(currentOverItem).closest(".hc-column,.hc-section,.hc-cnt-content");
                        $(item_source).remove();
                        $(target).find("[data-hc-setting]").each(function () {
                            $(this).setContentValue($(this).readContentValue());
                        });
                        $(item_source).find("[data-hc-setting]").each(function () {
                            $(this).setContentValue($(this).readContentValue());
                        });

                        if ($(currentOverItem).hasClass("button-move-up")) $(target).replaceWith($(item_source).outerHTML() + $(target).outerHTML());
                        if ($(currentOverItem).hasClass("button-move-down")) $(target).replaceWith($(target).outerHTML() + $(item_source).outerHTML());
                        if ($(currentOverItem).hasClass("button-move-into")) $(target).find("[data-hc-setting='main_content']").first().prepend($(item_source).outerHTML());

                        var source_id = $(item_source).find("[data-hc-id]").attr('data-hc-id');
                        if (isEmpty(source_id) || source_id == "main_content") source_id = $(item_source).closest("[data-hc-component]").attr('data-hc-id');
                        $(target).resetComponentsValue();
                        $(item_source).resetComponentsValue();
                        $(".hc-column,.hc-section,.hc-cnt-content").removeClass("drag-source").removeClass("drag-component-active");
                        $(".drag-anima").removeClass("drag-anima");
                        if (!isEmpty(source_id)) $("[data-hc-id='" + source_id + "']").addClass("drag-anima");
                        dragTime = false;
                        autosize($("[data-hc-id='" + source_id + "'] .input-text-area textarea"));
                        $(target).find(".column-empty").removeClass("column-empty");
                    }
                    hc_drag_reset();
                    item_source = null;
                }
            });
            $(document).mousemove(function (e) {
                if (isDragging) {
                    if (e.which === 1) {
                        var dragX = e.pageX, dragY = e.pageY;
                        $(item_source).offset({
                            left: e.pageX + 20,
                            top: e.pageY + 20
                        });

                        if (e.stopPropagation) e.stopPropagation();
                        if (e.preventDefault) e.preventDefault();
                        e.cancelBubble = true;
                        e.returnValue = false;
                        return false;
                    } else {
                        hc_drag_reset();
                        item_source = null;
                    }
                }
            });

            $(body).on("mouseover", ".drag-component-active .button-move-up", function () {
                $(this).closest(".hc-cnt-component,.hc-column,.hc-section").first().addClass("dragged-now-up");
            });
            $(body).on("mouseout", ".drag-component-active .button-move-up", function () {
                $(this).closest(".hc-cnt-component,.hc-column,.hc-section").first().removeClass("dragged-now-up");
            });
            $(body).on("mouseover", ".drag-component-active .button-move-down", function () {
                $(this).closest(".hc-cnt-component,.hc-column,.hc-section").first().addClass("dragged-now-down");
            });
            $(body).on("mouseout", ".drag-component-active .button-move-down", function () {
                $(this).closest(".hc-cnt-component,.hc-column,.hc-section").first().removeClass("dragged-now-down");
            });
            $(body).on("click", ".column-content .hc-cnt-content .hc-menu-component > .close-button,.column-content .hc-cnt-content > .close-button", function () {
                $(this).closest(".hc-cnt-content").remove();
            });
            $(HC_CNT).on("click", ".tab-wp .nav-tabs li a", function () {
                var t = $(this).closest(".tab-box");
                var component = $(this).attr("href").replace("#", "");
                var content = "";
                if (component.length > 2) content = "<div class='hc-cnt-content'>" + $(HC_CMP + " #cnt_" + component).html() + "</div>";
                $(t).find(".panel > div").first().html(content);
                $(t).find(".nav-tabs li").removeClass("active")
                $(this).closest("li").addClass("active");
                return false;
            });
            $(HC_CNT).on("click", ".tab-hc .nav-tabs li", function () {
                var t = $(this).closest(".tab-box");
                var t_active = $(t).find("> .panel").eq($(this).index());
                $(t).find(".panel").each(function () {
                    setHTMLcomment($(this));
                });
                $(t_active).html($(t_active).html().replace("<!--", "").replace("-->", ""));
                $(t).find(".tab_index").val($(this).index());
            });
            $(HC_CNT).on("click", ".tab-hc-fast .nav-tabs li", function () {
                $(this).closest(".tab-box").find(".tab_index").val($(this).index());
            });
            $(body).on("click", "#popover-box-icons-wp li span,#popover-box-icons li span,#popover-box-icons-all li span,#popover-box-icons-all .popover-icon-save", function () {
                if (!$(this).hasClass("popover-icon-save")) {
                    var newClass = $(this).attr("class").replace("sch ", "");
                    $(current_source).attr("data-value", newClass);
                    var classArr = $(current_source).attr("class").split(" ");
                    var selector = "fa-";
                    if ($(this).closest("#popover-box-icons-wp").length) {
                        selector = "dashicons-";
                        $(current_source).removeClass("fa")
                    }
                    if ($(this).closest(".icons-mind-line-list").length || $(this).closest(".icons-mind-solid-list").length) {
                        selector = "im-";
                        $(current_source).removeClass("fa")
                    }
                    for (var i = 0; i < classArr.length; i++) {
                        if (classArr[i].indexOf("fa-") != -1 || classArr[i].indexOf("im-") != -1 || classArr[i].indexOf("dashicons-") != -1) $(current_source).removeClass(classArr[i]);
                    }
                    $(current_source).removeClass("icon-plus-add-2");
                    if (newClass == "") {
                        if (selector == "fa-" || selector == "im-") $(current_source).addClass("icon-plus-add-2");
                        else $(current_source).addClass("dashicons dashicons-plus");
                    } else $(current_source).addClass(newClass);
                    $(current_source).removeClass("bg-contain").removeClass("fa-hide").css("background-image", "");
                }
                var t = $(this).closest("#popover-box-icons-all");
                if ($(t).length) {
                    var img = $(t).find(".upload-btn").readContentValue();
                    var style = $(t).find("#icon-style").val();
                    $(current_source).find(".icon-style").val(style);
                    $(current_source).find(".icon-image").val(img);
                    if (img.length > 0 && style.indexOf("image") != -1) {
                        $(current_source).addClass("bg-contain");
                        $(current_source).css("background-image", "url(" + img.split("|")[0] + ")");
                        if (style.indexOf("icon") == -1) $(current_source).addClass("fa-hide");
                    }
                }
                $('#popover-box-icons,#popover-box-icons-all,#popover-box-icons-wp').hide();
            });
            $(body).on("focusout", "input:text[data-require]", function () {
                var id = $(this).attr('data-require');
                var t = $(this).closest("*[data-hc-id]").find("*[data-hc-setting='" + id + "']");
                if ($(this).val() > 0 && !$(t).is(':checked')) $(t).click();
            });

            //SECTIONS & COLUMNS & PAGE ELEMENTS
            $(body).on("mouseover", ".columns-list span", function () {
                $(".columns-list .column-type").html($(this).attr("data-title"));
            });
            $(body).on("change", "[data-layout='column']", function () {
                setColumnLayout(this);
            });

            //OTHERS
            $(HC_CMP + " #cnt_hc_image_box .link-type").setContentValue("lightbox");
            $(HC_CMP + " #cnt_hc_image_box .link-field .upload-hc-button").show();
            if ($("#editor-mode").val() == "classic") {
                $(body).addClass("editor-mode-classic");
                $("#mode_button_hc select").val("classic");
                $(window).trigger('resize').trigger('scroll');
                $("#sidebars-menu").val($("#hc-sidebar").val());
            }
            $(body).on("focusin", ".link-field .input-link", function () {
                var t = $(this).closest(".link-field");
                var width = $(t).width();
                var chars = $(this).val().length;
                if ((chars * 12) > width) {
                    $(t).addClass("link-popup");
                }
            });
            $(body).on("focusout", ".link-field .input-link", function () {
                $(this).closest(".link-field").removeClass("link-popup");
            });
            $(body).on("click", "#popover-box-flexslider .popover-box-save", function () {
                var t = $(current_source).closest(".hc-slider");
                if ($(t).find("[data-hc-setting='type']").val() == "carousel") {
                    var n = $("#popover-box-flexslider").find("[data-option-id='numItems']").val();
                    if (n > 6) n = 6;
                    saveColumnLayout(t, n);
                }
            });

            //WP EDITOR - WORDPRESS
            var active_editor;
            $(body).on("click", ".hc-wp-editor .cnt-wpe", function () {
                active_editor = this;
                $("#hc-wp-editor-core #hc-wp-editor-2-html").click();
                $('textarea#hc-wp-editor-2').val($(this).html());
                $("#hc-wp-editor-core #hc-wp-editor-2-tmce").click();
                $('#hc-wp-editor-core').show();
            });
            $(body).on("click", "#hc-wp-editor-core > .close-button", function () {
                $('#hc-wp-editor-core').hide();
            });
            $(body).on("click", "#hc-wp-editor-core > .save-button", function () {
                var cnt = $('textarea#hc-wp-editor-2').val();
                $("#hc-wp-editor-core #hc-wp-editor-2-html").click();
                if (!tinyMCE.editors['wp-editor-area'] || tinyMCE.activeEditor.isHidden()) {
                    cnt = $('textarea#hc-wp-editor-2').val();
                } else {
                    cnt = tinyMCE.get($(this).attr("textarea#hc-wp-editor-2")).getContent()
                }
                $(active_editor).html(cnt.replace('<p style="text-align: justify;"></p>', '&nbsp;&nbsp;'));
                $("#hc-wp-editor-core #hc-wp-editor-2-tmce").click();
                $('#hc-wp-editor-core').hide();
            });

            //TEMPLATES
            $("#page_template").change(function () {
                $("#template-meta-boxes .inside").html("");
            });

            //COMPOSER TEMPLATES
            try {
                var source = $("#hc_templates_container").text();
                var html = "";
                if (source.length > 10) {
                    hc_templates = JSON.parse(source);
                    for (var key in hc_templates) {
                        html += '<li class="li-component ' + key.replace(" ", "-") + '"><div class="component-box" data-hc-target="hc_title_tag"><span class="sch">' + key + '</span><span class="close-button"></span></div></li>'
                    }
                    if (html == "") html = "<span style='opacity: 0.5;margin: 3px;'>No templates saved.</span>"
                } else {
                    hc_templates = {};
                    html = "<span style='padding-left: 3px;'>No templates saved.</span>";
                }

                $("#hc_templates_list").html(html);
            } catch (e) {
                console.log(e);
                $("#hc_templates_list").html(e);
                hc_templates = {}
            }

            //POST TYPES
            if (isPostType) {
                if ("post_type_setting" in PAGE_CONTENT_ARR && "settings" in PAGE_CONTENT_ARR["post_type_setting"]) {
                    var lists_arr = JSON.parse($("#lists-archive-arr").val());
                    var slug = $("#post-type-slug").val();
                    var id;
                    if (isEmpty(id)) id = 0;
                    if (!isEmpty(lists_arr) && !isEmpty(lists_arr[slug])) id = lists_arr[slug][1];
                    else id = PAGE_CONTENT_ARR["post_type_setting"]["settings"]["archive_page_id"];
                    var url_base = window.location.href;
                    url_base = url_base.substring(0, url_base.indexOf("wp-admin"));
                    $("#link-archive-view").attr("href", url_base + slug);
                    $("#link-items-page").attr("href", url_base + "wp-admin/edit.php?post_type=" + slug);
                    $("#link-archive-page").attr("href", "post.php?post=" + id + "&action=edit");
                    $("#y-post-type-links a").css("opacity", 1);
                    $("#pages-list").val(id).show();
                    $("#archive-page-list").show();
                }
            }

            //PUBLISH
            function pubblishHybridComposer(e, id) {
                if (isPostType) {
                    var name = $("#post-type-name").val();
                    $("#titlewrap #title").val(name);
                    if ($("#post-type-slug").val() == "") {
                        $("#post-type-slug").val(name);
                    }

                    if ($("#post-type-name").val() == "" || $("#post-type-name-singular").val() == "") {
                        $("#post-type-error").show();
                        e.preventDefault();
                        return false;
                    }
                }
                var editor_mode = $("#mode_button_hc select").val();
                if (!isEmpty(editor_mode) && editor_mode == "classic") {
                    var t = $("#wp-content-wrap > #wp-content-editor-container > #content.wp-editor-area")
                    if ($(t).text().indexOf("{") == 0) $(t).text("");
                } else {
                    generatePageContentArr();
                    printPageContentArr();
                    if (id == "publish") {
                        var post_id = getURLParameter("post");
                        if (!isEmpty(post_id)) {
                            try {
                                $("#hybrid_composer_content [data-hc-setting],#template-meta-boxes-top [data-hc-setting],#template-meta-boxes [data-hc-setting]").each(function () {
                                    $(this).setContentValue($(this).readContentValue());
                                });
                                $(".new-anima").removeClass("new-anima");
                                localStorage.setItem("post-" + post_id, $("#hybrid_composer_content").html());
                                localStorage.setItem("post-meta-top-" + post_id, $("#template-meta-boxes-top .inside").html());
                                localStorage.setItem("post-meta-" + post_id, $("#template-meta-boxes .inside").html());
                                localStorage.setItem("arr-post-" + post_id, $('textarea#content').val().length);
                            } catch (e) {
                                if (e.code == 22) localStorage.clear();
                            }
                        }
                    }
                }
            }
            $("#post").submit(function (e) {
                return pubblishHybridComposer(e, $(this).attr("id"));
            });
            $("#publish,#post-preview").click(function (e) {
                return pubblishHybridComposer(e, $(this).attr("id"));
            });
        } else $("#postdivrich").show();
    });

    //HIDE ELEMENTS ON MOUSE CLICK OUT
    $(document).mouseup(function (e) {
        $(".popover-box").each(function () {
            var container = $(this);
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($(this).attr("id") == "popover-box-columns") {
                    $(".button-column").removeClass("active");
                    if (!$(".button-move.active")) $(".hc-column");
                }
            }
        });
    });

    //FUNCTIONS
    $.fn.isContentSetted = function () {
        var c = $(this).readContentValue();
        if (c == false) return false;
        if (c == true) return true;
        if (isEmpty(c) || c.length == 0 || c.indexOf("_RUNTIME_VAL") != -1) return false; else return true;
        return false;
    }
    $.fn.readContentValue = function () {
        var type = $(this).attr("data-hc-component");
        if (isEmpty(type)) type = "";

        if ($(this).is("input:text") || $(this).attr('type') == "hidden") return $(this).val();
        else if ($(this).is("input:checkbox")) return $(this).is(':checked');
        else if ($(this).is("textarea")) {
            if (type == "base64") return bin2hex($(this).val());
            else return $(this).val();
        }
        else if ($(this).is("select")) return $(this).val();
        else {
            if (type == "upload") return (isEmpty($(this).attr("data-upload-link"))) ? "" : setTextArr([$(this).attr("data-upload-link"), $(this).attr("data-upload-height"), $(this).attr("data-upload-width"), $(this).attr("data-upload-id")]);
            if (type == "value") return $(this).attr("data-value");
            if (type == "html") return $(this).html();
            if (type == "wordpress_editor") return tinyMCE.get($(this).attr("data-wp-id")).getContent();
            return "";
        }
    }
    $.fn.setContentValue = function (content) {
        var bool = true;
        var type = $(this).attr("data-hc-component");
        if (isEmpty(type)) type = "";

        if (content == "" || content == "false") bool = false;
        if ($(this).is("input:text") || $(this).attr('type') == "hidden") $(this).val(content).attr("value", content);
        else if ($(this).is("input:checkbox")) {
            $(this).prop('checked', bool)
            if (bool) $(this).attr("checked", "checked");
            else $(this).removeAttr("checked");
        }
        else if ($(this).is("textarea")) {
            if (type == "base64") content = hex2bin(content);
            $(this).val(content).html(content);
        }
        else if ($(this).is("select")) {
            $(this).val(content);
            $(this).find("option").removeAttr("data-select");
            $(this).find("option[value='" + content + "']").attr("data-select", "selected");
        }
        else {
            if (type == "upload") {
                var arr = getTextArr(content);
                if (arr.length == 0) { arr = ["", "", "", ""] }
                $(this).attr("data-upload-link", arr[0]);
                $(this).attr("data-upload-height", arr[1]);
                $(this).attr("data-upload-width", arr[2]);
                $(this).attr("data-upload-id", arr[3]);
                $(this).css("background-image", "url(" + arr[0] + ")");
            }
            if (type == "value") {
                var def = $(this).attr("data-default-values");
                if (content == "" && !isEmpty(def)) $(this).attr("data-value", def);
                else $(this).attr("data-value", content);
            }
            if (type == "html") $(this).html(content);
            if (type == "wordpress_editor") tinyMCE.get($(this).attr("data-wp-id")).setContent(content);
        }
    }
    $.fn.outerHTML = function () {
        var elem = this[0],
          tmp;

        return !elem ? null
          : typeof (tmp = elem.outerHTML) === 'string' ? tmp
          : (div = div || $('<div/>')).html(this.eq(0).clone()).html();
    };
    $.fn.showTether = function (target) {
        if (!isEmpty(this)) {
            var _targetAttachment = $(target).attr("data-pos");
            if (isEmpty(_targetAttachment)) _targetAttachment = "top center";
            $(this).show();
            if (!isEmpty(myTether)) myTether.destroy()
            myTether = new Tether({
                element: this,
                target: target,
                attachment: 'bottom center',
                targetAttachment: _targetAttachment,
                offset: '50px 0px',
                constraints: [{
                    to: 'window',
                    pin: true
                }]
            });
            $(window).scroll();
        }
    }
    $.fn.showSmart = function () {
        $(this).each(function () {
            $(this).css("display", "");
            var s = $(this).css("display");
            var dd = $(this).attr("data-display");
            if (!isEmpty(dd) || isEmpty(s) || s == "none") s = dd;
            if (isEmpty(s)) s = "inline-block";
            $(this).css("display", s);
        });
    }
    $.fn.resetComponentsValue = function () {
        var target_id = $(this).attr('data-hc-id');
        if (isEmpty(target_id)) target_id = $(this).find("[data-hc-id]").attr('data-hc-id');
        $(this).find("*[data-hc-setting]").each(function () {
            if ($(this).is("select")) {
                var current_id = $(this).closest("[data-hc-id]").attr("data-hc-id");
                var current_selector = ' ';
                if (current_id != target_id) current_selector = ' [data-hc-id="' + current_id + '"] ';
                var val = $(this).find("[data-select]").attr("value");
                if (isEmpty(val)) val = $(this).readContentValue();
                $('[data-hc-id="' + target_id + '"]' + current_selector + '[data-hc-setting="' + $(this).attr("data-hc-setting") + '"]').setContentValue(val);
            }
            $(this).setContentValue($(this).readContentValue());
        });
    }
    String.prototype.capitalizeFirstLetter = function () {
        try {
            return this.charAt(0).toUpperCase() + this.slice(1);
        } catch (e) { return this; }
    }
    $.fn.setWidthLayout = function () {
        var w = $(this).width();
        $(this).removeClass("small-cnt");
        if (w < 263) {
            $(this).addClass("small-cnt");
        }
    }
    $.fn.setImageSize = function (isFixed) {
        if (isEmpty(isFixed)) isFixed = false;
        var h = parseInt($(this).attr("data-upload-height"));
        var w = parseInt($(this).attr("data-upload-width"));
        var cnt_w = $(this).width();
        var cnt_h = $(this).height();
        if (h < 70 || w < 115) {
            $(this).addClass("bg-contain");
        } else {
            if (!isFixed) {
                var hh = (h / w) * cnt_w;
                if (hh <= h) {
                    $(this).css("height", hh + "px");
                } else {
                    $(this).css("height", h + "px");
                }
                if (cnt_w > w) {
                    $(this).addClass("bg-auto");
                }
            } else {
                var rh = (h / w) * cnt_w;
                if (cnt_h > rh * 1.6) {
                    $(this).addClass("container-bg").css("height", "");
                }
            }
        }
    }

    //COMPONENTS FUNCTIONS 
    $.fn.setInputCSSrepeater = function (num_items) {
        var t = $(this).closest(".input-css-repeater");
        var items = $(t).find(".css-repeater-container .css-repeater-item");
        $(items).hide();
        for (var i = 0; i < num_items; i++) {
            $(items[i]).show();
        }
    }
}(jQuery));

//FUNCTIONS
function generatePageContentArr() {
    var FINAL_SCRIPTS_ARR = {};
    var FINAL_CSS_ARR = {};
    var archive_page_id = "";

    if (isPostType && "post_type_setting" in PAGE_CONTENT_ARR && "settings" in PAGE_CONTENT_ARR["post_type_setting"]) {
        archive_page_id = PAGE_CONTENT_ARR["post_type_setting"]["settings"]["archive_page_id"];
        if (isEmpty(archive_page_id)) archive_page_id = hc_init_archive_page_id;
    }
    PAGE_CONTENT_ARR = {};
    $(HC_CNT + " [data-hc-id]").each(function () {
        if (isEmpty($(this).attr("data-hc-setting"))) PAGE_CONTENT_ARR[$(this).attr("data-hc-id")] = recursiveContent(this);
    });
    function recursiveContent(t) {
        var hc_component = {
            component: $(t).attr("data-hc-component"), id: $(t).attr("data-hc-id"), path: $(t).attr("data-hc-path")
        };
        var id = $(t).attr("data-hc-id");
        var cnt = $(t).attr("data-hc-container");
        if (!isEmpty(cnt) && cnt == "repeater") hc_component = [];
        var cont = null;
        $(t).find("[data-hc-setting]").each(function () {
            if (cont != null && !$.contains(cont, this) || cont == null) {
                var id_sub = $(this).attr("data-hc-id");
                var setting = $(this).attr("data-hc-setting");
                if (isEmpty(id_sub)) {
                    hc_component[setting] = $(this).readContentValue();
                } else {
                    cont = this;
                    if (!isEmpty(cnt) && cnt == "repeater") {
                        hc_component.push(recursiveContent(this));
                    } else {
                        hc_component[setting] = {
                            id: id_sub
                        };
                        hc_component[setting] = recursiveContent(this);
                    }
                }
            }
        });
        return hc_component;
    }

    $().each(function () {
        $(this).setFileRequire();
    });

    $(HC_CNT + " .file_require,.template_setting_cnt .file_require," + HC_CNT + " [data-require-file]").each(function () {
        var file = $(this).attr("data-require-file");
        var valid = true;

        if (isEmpty(file)) {
            file = $(this).readContentValue();
        } else {
            valid = false;
            if ($(this).is("select")) {
                file = $(this).find("[data-select='selected']").attr("data-require-file");
                if (!isEmpty(file)) valid = true;
            } else {
                if ($(this).isContentSetted()) {
                    valid = true;
                }
            }
        }
        if (valid && !isEmpty(SCRIPTS_ARR[file])) FINAL_SCRIPTS_ARR[file] = SCRIPTS_ARR[file];
        if (valid && !isEmpty(CSS_ARR[file])) FINAL_CSS_ARR[file] = CSS_ARR[file];
    });

    PAGE_CONTENT_ARR["main-title"]["title"] = $("#title").val();
    PAGE_CONTENT_ARR["scripts"] = FINAL_SCRIPTS_ARR;
    PAGE_CONTENT_ARR["css"] = FINAL_CSS_ARR;
    PAGE_CONTENT_ARR["css_page"] = $("#css-page").val();

    PAGE_CONTENT_ARR["template_setting"] = {};
    PAGE_CONTENT_ARR["template_setting_top"] = {};
    $("#template-meta-boxes [data-hc-id]").each(function () {
        if (isEmpty($(this).attr("data-hc-setting"))) PAGE_CONTENT_ARR["template_setting"][$(this).attr("data-hc-id")] = recursiveContent(this);
    });
    $("#template-meta-boxes-top [data-hc-id]").each(function () {
        if (isEmpty($(this).attr("data-hc-setting"))) PAGE_CONTENT_ARR["template_setting_top"][$(this).attr("data-hc-id")] = recursiveContent(this);
    });
    $("#template-meta-boxes-top .template_setting_cnt [data-hc-setting]").each(function () {
        PAGE_CONTENT_ARR["template_setting_top"][$(this).attr("data-hc-setting")] = $(this).readContentValue();;
    });
    PAGE_SETTING = [$("#lock-mode").val()];
    $(HC_CNT + " .page_setting").each(function () {
        PAGE_SETTING.push($(this).readContentValue());
    });
    PAGE_CONTENT_ARR["page_setting"] = { "settings": PAGE_SETTING };

    //PAGE LIGHTBOX AND POPUP
    var p_lp = $("#page-lightbox").val();
    if (!isEmpty(p_lp)) {
        p_lp = JSON.parse(p_lp);
        if (!isEmpty(p_lp)) {
            PAGE_CONTENT_ARR["page_setting"]["lightbox"] = p_lp;
        }
    }
    p_lp = $("#page-popup").val();
    if (!isEmpty(p_lp)) {
        p_lp = JSON.parse(p_lp);
        if (!isEmpty(p_lp)) {
            PAGE_CONTENT_ARR["page_setting"]["popup"] = p_lp;
        }
    }

    //POST TYPES
    if (isPostType) {
        PAGE_CONTENT_ARR["post_type_setting"] = {
            "settings": {
                "slug": $("#post-type-slug").val().toLowerCase(),
                "name": $("#post-type-name").val(),
                "name_singular": $("#post-type-name-singular").val(),
                "icon": $("#post-type-icon").attr("data-value")
            }
        };
    }
    if (isPostTypeSingle) {
        PAGE_CONTENT_ARR["post_type_setting"] = {
            "settings": {
                "image": $("#post-type-image").readContentValue(),
                "excerpt": $("#post-type-excerpt").readContentValue(),
                "extra_1": $("#post-type-extra-1").readContentValue(),
                "extra_2": $("#post-type-extra-2").readContentValue(),
                "icon": { "icon": $("#post-type-item-icon i").readContentValue(), "icon_style": $("#post-type-item-icon-style").readContentValue(), "icon_image": $("#post-type-item-icon-image").readContentValue() }
            }
        };
    }
}

function bin2hex(s) {
    var hex, i;
    var result = "";
    for (i = 0; i < s.length; i++) {
        hex = s.charCodeAt(i).toString(16);
        result += ("000" + hex).slice(-4);
    }
    return result
}
function hex2bin(hex) {
    var j;
    var hexes = hex.match(/.{1,4}/g) || [];
    var back = "";
    for (j = 0; j < hexes.length; j++) {
        back += String.fromCharCode(parseInt(hexes[j], 16));
    }
    return back;
}
function applyHTMLContentArr() {
    var ALL_HTML = recursiveApply($('<div><div data-hc-setting="main-title"></div></div>'), PAGE_CONTENT_ARR);
    function recursiveApply(HTML, arr, parent_key) {
        for (var key in arr) {
            if (!isEmpty(arr[key]) && typeof arr[key] === 'object') {
                var cmp = arr[key]["component"];
                if (cmp == "this") recursiveApply($(HTML), arr[key], key);
                var HTML_SUB = $(HC_CMP + " #cnt_" + cmp).html();
                if (cmp == "repeater_item")
                    HTML_SUB = '<div class="hc-cnt-content" data-hc-setting="' + parent_key + '" data-hc-id="_ID" data-hc-component="repeater_item"><div class="clear"></div><span class="order-top"></span><span class="order-down"></span><span class="close-button"></span></div>';
                if (!isEmpty(HTML_SUB)) {
                    HTML_SUB = HTML_SUB.replace(/_ID/g, arr[key]["id"]);
                    if (cmp != "hc_column" && cmp != "repeater_item") HTML_SUB = "<div class='hc-cnt-content'>" + HTML_SUB + "</div>";
                }
                var container_key;
                if (isInt(key)) {
                    container_key = "repeater";
                    if (isEmpty(HTML)) {
                        HTML = recursiveApply($(HTML_SUB), arr[key], key);
                        HTML = HTML;
                    } else {
                        var t = $("*[data-hc-setting='" + container_key + "']", HTML);
                        if (isEmpty(t))
                            HTML = $($('<div>').append(HTML).append(recursiveApply($(HTML_SUB), arr[key], key))).html();
                        else
                            $(t).append(recursiveApply($(HTML_SUB), arr[key], key));
                    }
                } else {
                    container_key = key;
                    if ($("*[data-hc-setting='" + container_key + "']", HTML).length) $("*[data-hc-setting='" + container_key + "']", HTML).append(recursiveApply($(HTML_SUB), arr[key], key));
                    else $(HTML).append(recursiveApply($(HTML_SUB), arr[key], key));
                }
            }
        }
        return HTML;
    }

    $(HC_CNT).html($('<div>').append($(ALL_HTML).clone()).html());

    $(HC_CNT + " .input-repeater").each(function () {
        var t = $(this).find(".repeater-container");
        var source = $(this).find(".repeater-source").html();
        if ($(t).html().length > 0) $(this).find(".hc-cnt-content").prepend(source);
        setHTMLcomment($(this).find(".repeater-source"));
    });
    $(HC_CNT + " .hc-wysiwyg-editor").wysiwyg(wysiwyg_arr);
    $(HC_CNT + " .hc-add-component").each(function () {
        posButtonBottom(this);
    });
    var TEMPLATE_HTML = recursiveApply($('<div></div>'), PAGE_CONTENT_ARR["template_setting"]);
    if ($(TEMPLATE_HTML).html() != "") $("#template-meta-boxes .inside .template_meta_boxes_cnt").html($('<div>').append($(TEMPLATE_HTML).clone()).html());
    TEMPLATE_HTML = recursiveApply($('<div></div>'), PAGE_CONTENT_ARR["template_setting_top"]);
    if ($(TEMPLATE_HTML).html() != "") $("#template-meta-boxes-top .inside .template_meta_boxes_cnt").html($('<div>').append($(TEMPLATE_HTML).clone()).html());
}
function applyContentArr() {
    recursiveApply(PAGE_CONTENT_ARR);
    function recursiveApply(arr, cnt_key) {
        for (var key in arr) {
            if (!isEmpty(arr[key]) && typeof arr[key] === 'object') {
                var t = $("[data-hc-id='" + cnt_key + "'] [data-hc-id='" + arr[key]["id"] + "']");
                if ($(t).attr("data-hc-component") == "this") {
                    $(t).first().attr("setted", "true");
                }
                recursiveApply(arr[key], arr[key]["id"]);
            } else {
                var t = $("[data-hc-id='" + cnt_key + "'] [data-hc-setting='" + key + "']");
                if (t.length < 2) {
                    $(t).setContentValue(arr[key]);
                    $(t).attr("processed", "true");
                } else {
                    for (var i = 0; i < t.length; i++) {
                        if (isEmpty($(t[i]).attr("processed"))) {
                            $(t[i]).setContentValue(arr[key]);
                            $(t[i]).attr("processed", "true");
                            break;
                        }
                    }
                }
            }
        }
    }
    $("[data-require-action='hide']").each(function () {
        var id = $(this).attr("data-require");
        if (!$(this).closest("*[data-hc-id]").find("*[data-hc-setting='" + id + "']").isContentSetted()) $(this).closest(".input-row").hide();
        else $(this).closest(".input-row").css("display", "inline-block");
    });
    $(".tab-wp").each(function () {
        var items = $(this).find(".nav-tabs li");
        for (var i = 0; i < items.length; i++) {
            if ($(this).find(".panel " + " *[data-hc-component='" + $(items[i]).find("a").attr("href").replace("#", "") + "']").length) $(items[i]).addClass("active");
        }
    });
    $(".section-panel .tab-wp").each(function () {
        if ($(this).find(".nav-tabs li.active").length > 1) $(this).find(".nav-tabs li:first-child").removeClass("active");
    });

    $(".button-icons-list, .button-icons-list-all").each(function () {
        var val = $(this).attr("data-value");
        var css = "button-icons-list-all";
        if ($(this).hasClass("button-icons-list")) css = "button-icons-list";
        if (val.length) {
            $(this).attr("class", "input-row " + css + " button-icon fa " + val);
        } else {
            val = $(this).find(".icon-image").val();
            if (!isEmpty(val)) $(this).attr("class", "input-row " + css + " button-icon bg-contain").css("background-image", "url(" + val.split("|")[0] + ")");
        }
    });
    $(".hc-link .link-type").each(function () {
        var val = $(this).val();
        if (val == "custom") {
            var t = $(this).closest(".hc-link");
            $(t).find(".link-content-btn").first().show();
            $(t).find(".input-link").first().hide();
        } else {
            $(t).find(".input-link").first().show().prop("disabled", false);
        }
        if (val == "lightbox") $(this).closest("div").find(".upload-hc-button").show();
    });
    $(".hc-content-box-base").each(function () {
        var val = $(this).find(".content-box-style").val();
        if (val == "top_icon_image" || val == "multiple_box" || val == "side_content") $(this).find(".upload-box").show();
        else $(this).find(".upload-box").hide();
    });
    $(".tab-hc").each(function () {
        var t = this;
        var pan = $(this).find(".panel");
        var li = $(t).find(".nav-tabs li");
        $(li).attr("class", "");
        $(pan).each(function (index) {
            if ($(this).find("[setted='true']").length == 0) {
                setHTMLcomment(this);
                $(this).removeClass("active");
            } else {
                $(this).addClass("active");
                $(li).eq(index).addClass("active").addClass("current-active");
            }
        });
        if ($(t).find(".nav-tabs li.active").length == 0) $(li).first().addClass("active");
        if ($(t).find(".panel.active").length == 0) $(pan).first().addClass("active").html($(pan).first().html().replace("<!--", "").replace("-->", ""));
    });
    $(".tab-hc-fast").each(function () {
        var index = $(this).find(".tab_index").val();
        $(this).find('>.panel,>.nav-tabs li').removeClass("active");
        $(this).find('>.nav-tabs li:eq(' + index + '),>.panel:eq(' + index + ')').addClass("active");
    });
    $(".input-css-repeater .repeater-items select").each(function () {
        $(this).setInputCSSrepeater(parseInt($(this).val()));
    });
    $("select[data-dependence-trigger]").each(function () {
        var p = $(this).closest("[data-hc-id]");
        var action = $(this).attr("data-dependence-trigger");
        if (isEmpty(p)) p = $(this).closest(".inside");
        var target = $(this).attr("data-hc-setting");
        var val = $(this).val();
        $(this).find("option").each(function () {
            var tt = $(p).find("[data-dependence-show='" + target + "_" + $(this).val() + "']");
            if (action == "hide") if ($(this).val() != val) $(tt).showSmart(); else $(tt).hide();
            else if ($(this).val() != val) $(tt).hide(); else $(tt).showSmart();
        });
    });
    $("input:checkbox[data-dependence-trigger]").each(function () {
        var p = $(this).closest("[data-hc-id]");
        var action = $(this).attr("data-dependence-trigger");
        if (isEmpty(p)) p = $(this).closest(".inside");
        var target = $(p).find("[data-dependence-show='" + $(this).attr("data-hc-setting") + "']");
        if (action == "hide") {
            if ($(this).is(':checked')) {
                $(target).hide();
            } else $(target).showSmart();
        } else {
            if ($(this).is(':checked')) {
                $(target).showSmart();
            } else $(target).hide();
        }
    });
    $(".hc-slider").each(function (index) {
        if ($(this).find("[data-hc-setting='type']").val() == "carousel") {
            var val = $(this).find("[data-hc-setting='data_options']").attr("data-value");
            var n = 3;
            if (val != "") {
                if (val.indexOf("numItems:4") > 0) n = 4;
                else if (val.indexOf("numItems:5") > -1) n = 5;
                else if (val.indexOf("numItems:6") > -1) n = 6;
                else if (val.indexOf("numItems:7") > -1) n = 7;
                else if (val.indexOf("numItems:8") > -1) n = 8;
            }
            if (n > 6) n = 6;
            saveColumnLayout(this, n);
        }
    });

    applyGlobalContentArr();
    $(HC_CNT + " .hc-column").each(function () {
        $(this).addClass($(this).find(".button-column").attr("data-value"));
        $(this).setWidthLayout();
        var css = $(this).find(".button-css").attr("data-value");
        if (css.indexOf("col-center") > -1) {
            $(this).addClass("layout-column-center");
        }
    });

    $(HC_CNT + " .hc-social-feeds").each(function () {
        var v = $(this).find(".social-container-type").val();
        if (v == "slider" || v == "carousel") $(this).find(".data-options-slider").show();
        if (v == "scroll_box") $(this).find(".data-options-scroll-box").show();
        $(this).find(".data-options-button-tw,.data-options-button-fb").hide();
        $(this).find(".data-options-button-" + $(this).find(".social-type").val()).show();
    });
    applyPostTypesContent();
    $(HC_CNT + " [data-layout='column']").each(function () {
        setColumnLayout(this);
    });
    $(HC_CNT + " .flex-repeater .hc-cnt-content").each(function (index) {
        $(this).setWidthLayout();
    });
    $("[data-hc-component='upload']").each(function () {
        if ($(this).isContentSetted()) {
            $(this).closest(".upload-box").find(".close-button").show();
            $(this).setImageSize();
        }
    });
    $(".upload-fixed [data-hc-component='upload']").each(function () {
        $(this).setImageSize(true);
    });
    if (!isEmpty(PAGE_CONTENT_ARR["page_setting"]["lightbox"])) {
        $("#page-lightbox").val(JSON.stringify(PAGE_CONTENT_ARR["page_setting"]["lightbox"]));
    }
    if (!isEmpty(PAGE_CONTENT_ARR["page_setting"]["popup"])) {
        $("#page-popup").val(JSON.stringify(PAGE_CONTENT_ARR["page_setting"]["popup"]));
    }
}
function applyGlobalContentArr(cnt) {
    if (isEmpty(cnt)) cnt = "";
    else cnt = cnt + " ";

    $("#css-page").val(PAGE_CONTENT_ARR["css_page"]);
    if ($("#fullpage-single-bg").isContentSetted()) $("body").addClass("fullpage-single-bg");
    if (PAGE_CONTENT_ARR["page_setting"]["settings"].indexOf("lock-mode-on") != -1) {
        $("body").addClass("hc-locked-mode");
        $("#lock_button_hc i").attr("class", "icon-lock");
        $("#lock-mode").val("lock-mode-on");
    }
    autosize($(".input-text-area textarea"));
}
function applyPostTypesContent() {
    if (isPostType && !isEmpty(PAGE_CONTENT_ARR["post_type_setting"])) {
        $("#post-type-name").setContentValue(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["name"]);
        $("#post-type-name-singular").setContentValue(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["name_singular"]);
        $("#archive-page-list").val("ABCDE");
        var icon = PAGE_CONTENT_ARR["post_type_setting"]["settings"]["icon"];
        $("#post-type-icon").setContentValue(icon);
        $("#post-type-icon").attr("class", "input-row button-icon button-icons-list-wp " + icon);
        $("#post-type-slug").val(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["slug"]);
    }
    if (isPostTypeSingle && !isEmpty(PAGE_CONTENT_ARR["post_type_setting"])) {
        try {
            $("#post-type-image").setContentValue(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["image"]);
            $("#post-type-excerpt").setContentValue(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["excerpt"]);
            $("#post-type-extra-1").setContentValue(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["extra_1"]);
            $("#post-type-extra-2").setContentValue(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["extra_2"]);
            $("#post-type-item-icon i").setContentValue(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["icon"]["icon"]);
            $("#post-type-item-icon i").removeClass("icon-plus-add-2").addClass(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["icon"]["icon"]);
            $("#post-type-item-icon-style").setContentValue(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["icon"]["icon_style"]);
            $("#post-type-item-icon-image").setContentValue(PAGE_CONTENT_ARR["post_type_setting"]["settings"]["icon"]["icon_image"]);
        } catch (e) { console.log(e); }
    }
    $(".post-type-slug").each(function () {
        var select_cats = $(this).closest("[data-hc-id]").find(".post-type-category");
        var cat_slug = $(this).val();
        if ($(select_cats).length) {
            $(select_cats).find("option").each(function (i) {
                if (i > 0) {
                    if ($(this).attr("data-taxonomy").startsWith(cat_slug)) $(this).show();
                    else $(this).hide();
                }
            });
        }
    });

}
function isInt(value) {
    var x = parseFloat(value);
    return !isNaN(value) && (x | 0) === x;
}
function setHTMLcomment(obj) {
    $(obj).html("<!--" + $(obj).html().replace("<!--", "").replace("-->", "") + "-->");
}
function printPageContentArr() {
    $("#content-html").click();
    var json_string = JSON.stringify(PAGE_CONTENT_ARR);
    if (!tinyMCE.editors['wp-editor-area'] || tinyMCE.activeEditor.isHidden()) {
        $('textarea#content').val(json_string);
    } else {
        tinyMCE.execCommand('mceInsertRawHTML', false, json_string);
    }
}
function showPageCSSbox() {
    $('#css-code-box textarea').val($('#css-page').val());
    $.magnificPopup.open({
        items: {
            src: '#css-code-box'
        }, type: 'inline'
    });
    $('#css-code-box .scroll-content').slimScroll({
        height: '250px'
    });
}
function showComposerTemplatesBox() {
    $.magnificPopup.open({
        items: {
            src: '#composer-templates-box'
        }, type: 'inline'
    });
    $('#composer-templates-box .scroll-content').slimScroll({
        height: '650px'
    });
}
function showPageSettingsBox() {
    if (isEmpty(getURLParameter("post"))) {
        alert("Please publish the page before enter in page settings area.")
    } else {
        indipendentSaveSystem("#popover-box-page-settings", "populate");
        $.magnificPopup.open({
            items: {
                src: '#popover-box-page-settings'
            }, type: 'inline'
        });
        $('#popover-box-page-settings .scroll-content').slimScroll({
            height: '450px'
        });
    }
}
function showPageLightbox() {
    indipendentSaveSystem("#popover-box-page-lightbox", "populate");
    $.magnificPopup.open({
        items: {
            src: '#popover-box-page-lightbox'
        }, type: 'inline'
    });
}
function showPagePopup() {
    indipendentSaveSystem("#popover-box-page-popup", "populate");
    $.magnificPopup.open({
        items: {
            src: '#popover-box-page-popup'
        }, type: 'inline'
    });
}
function showPageContentArr() {
    $(HC_CNT).find("*[data-hc-setting]").each(function () {
        $(this).setContentValue($(this).readContentValue());
    });

    generatePageContentArr();
    printPageContentArr();
    $("#page-code-box .scroll-content").html(JSON.stringify(PAGE_CONTENT_ARR, null, '\t'));
    prettyPrint();
    $.magnificPopup.open({
        items: {
            src: '#page-code-box'
        }, type: 'inline'
    });
    $('#page-code-box .scroll-content').slimScroll({
        height: '250px'
    });
    applyHTMLContentArr();
    applyContentArr();
}
function setTextArr(arr) {
    var result = "";
    for (var i = 0; i < arr.length; i++) {
        result += arr[i].replace("|", "-") + "|";
    }
    return result.substr(0, result.length - 1);
}
function getTextArr(text) {
    if (isEmpty(text)) return [];
    return text.split("|");
}
function setValue(string, id, val) {
    var output_1 = string.substr(0, string.indexOf(id));
    var output_2 = output_1.substr(output_1.indexOf('"'), string.indexOf(id));
}
function makeID(count) {
    var text = "5ZtkF";
    if (isEmpty(count)) count = 1;
    var arrIDs = [];
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var page_content = $("#content").val();
    if (makeIDarr.length == 0) {
        $("[data-hc-id]").each(function () {
            makeIDarr.push($(this).attr("data-hc-id"));
        });
    }
    for (var i = 0; i < count; i++) {
        while ($.inArray(text, makeIDarr) != -1) {
            text = "";
            for (var j = 0; j < 5; j++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        arrIDs[i] = text;
        makeIDarr.push(text);
    }
    if (count == 0) return arrIDs[0];
    return arrIDs;
}
function inArray(obj, search) {
    var result = false;
    recursive(obj, search);
    function recursive(obj, search) {
        for (var property in obj) {
            if (obj.hasOwnProperty(property)) {
                if (typeof obj[property] == "object") {
                    recursive(obj[property], search);
                } else {
                    try {
                        if (obj[property].indexOf("_" + search) != -1) {
                            result = true;
                            return true;
                        }
                    } catch (e) { }
                }
            }
        }
    }
    return result;
}
function posButtonBottom(button) {
    var cnt = $(button).closest("[data-hc-setting]");
    var hide_val = $(button).attr("data-components");
    var hide_val_html = "";
    var css = "";
    if ($(cnt).find("> div").length < 3) {
        css = " column-empty";
    }
    if (!isEmpty(hide_val)) hide_val_html = ' data-components="' + hide_val + '"';
    $(cnt).find("> .clear").remove();
    $(cnt).append('<div class="clear"></div><div class="hc-add-component' + css + '"' + hide_val_html + '><i class="icon-plus-add-2"></i></div>');
    $(button).remove();
}
function ajaxSaveOption(option_name, content) {
    var res;
    jQuery.ajax({
        method: "POST",
        url: ajax_url,
        data: {
            action: 'hc_ajax_save_option',
            option_name: option_name,
            content: content
        },
        async: false
    }).done(function (response) {
        res = response;
    });
    return res;
}
function saveHCTemplate(name) {
    generatePageContentArr();
    hc_templates[name] = PAGE_CONTENT_ARR;
    var response = ajaxSaveOption('hc_templates', JSON.stringify(hc_templates));
    if (response == true) {
        $("#composer-templates-box .result-box").html('<div class="notice notice-success"><p>Template saved successfully.</p></div>');
    } else {
        $("#composer-templates-box .result-box").html('<div class="notice error"><p>Error. Template may be not saved.</p></div>');
    };
}
function deleteHCTemplate(name) {
    var hc_templates_new = {}
    for (var key in hc_templates) {
        if (key != name) hc_templates_new[key] = hc_templates[key];
    }
    var response = ajaxSaveOption('hc_templates', JSON.stringify(hc_templates_new));
    if (response == true) {
        $("#composer-templates-box .result-box").html('<div class="notice notice-success"><p>Template deleted successfully.</p></div>');
        $("#composer-templates-box .save-template-box ." + name.replace(" ", "-")).remove();
        hc_templates = hc_templates_new;
    } else {
        $("#composer-templates-box .result-box").html('<div class="notice error"><p>Error. Template not deleted.</p></div>');
    };
}
function resetSelectValues(container) {
    $(container).find("select").each(function () {
        $(this).attr("data-select-value", $(this).readContentValue());
    });
}
function setColumnLayout(obj, target) {
    var val = $(obj).val();
    if (isEmpty(target)) target = $(obj).closest("[data-hc-id]").closest("[data-hc-id]");
    if (val == "col-md-12") val = 1;
    if (val == "col-md-6") val = 2;
    if (val == "col-md-4") val = 3;
    if (val == "col-md-3") val = 4;
    if (val == "col-md-2") val = 6;
    saveColumnLayout(target, val);
}
function saveColumnLayout(target, val) {
    $(target).removeClass("layout-columns-1").removeClass("layout-columns-2").removeClass("layout-columns-3").removeClass("layout-columns-4").removeClass("layout-columns-5").removeClass("layout-columns-6").addClass("layout-columns-" + val);
    $(target).find(".hc-cnt-content,.hc-column").setWidthLayout();
}
//INDIPENDENT JS SAVE SETTINGS SYSTEM
function indipendentSaveSystem(source, action) {
    if (isEmpty(action) || action == "read") {
        var t = $(source).closest(".settings-cnt");
        var arr = $(t).find("[data-setting]");
        var arr_result = {};
        var post_id = getURLParameter("post");

        for (var i = 0; i < arr.length; i++) {
            arr_result[$(arr[i]).attr("data-setting")] = $(arr[i]).readContentValue();
        }

        var result = JSON.stringify(arr_result);
        jQuery.ajax({
            method: "POST",
            url: ajax_url,
            data: {
                action: 'hc_ajax_save_option',
                option_name: 'hc-page-settings-' + post_id,
                content: result,
            },
            async: false
        }).done(function (response) {
            $(t).find(".save_array_json").val(result);
        });
    } else {
        if (action == "populate") {
            var arr_json = $(source).find(".save_array_json").val();
            if (!isEmpty(arr_json)) {
                arr_json = JSON.parse(arr_json);
                for (var key in arr_json) {
                    $(source).find("[data-setting='" + key + "']").setContentValue(arr_json[key]);
                }
            }
        }
    }
}
