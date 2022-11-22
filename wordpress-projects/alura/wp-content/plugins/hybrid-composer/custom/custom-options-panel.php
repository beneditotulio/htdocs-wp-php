<?php

/*
=============================================================================
CUSTOM SETTINGS FOR THE THEME OPTIONS PANEL
=============================================================================

Add new settings to the theme options panel here.
Every array item is a new setting.

Available values for "type" setting: checkbox,select,text,textarea,color,image_upload
Available values for "label" setting: main,layout,menu,footer,lists,titles,customizations,social

$HC_CUSTOM_PANEL
name : Theme's name
version : Theme's version
colors : Theme's panel colors

Documentation: wordpress.framework-y.com/advanced-api-documentation/#custom-theme

 */
global $HC_CUSTOM_THEME_OPTIONS;
global $HC_CUSTOM_PANEL;

$HC_CUSTOM_FONT = "Roboto:300,400,500,700,900";
$HC_SITE_FONTS = 'body, .adv-img p, .caption-bottom p, .adv-circle .caption p, .advs-box p, .list-blog p,.shop-menu-cnt .cart-count {
    font-family: [FONT-1] !important;
}
.title-base p, .font-2 {
    font-family: [FONT-2] !important;
}';

$HC_CUSTOM_PANEL = array(
	'name'    => 'Yellow Business',
    'version' => '1.0',
    'colors'  => array("#F3B007","#464646"),
    'demos' => array(array('id' => 'yellowbusiness','name' => 'Main demo')),
    'demos_url' => 'http://themes.framework-y.com/demo-import/'
);

$HC_SITE_COLORS = '.extra-content, .nav:not(.ms-rounded) li > a:before, .boxed.advs-box-top-icon-img .advs-box-content, [class*="col-md-"].boxed,.cart-buttons a,
.advs-box-side-img hr, .mi-menu .sidebar-nav, .advs-box-top-icon-img.niche-box-post:after, .accordion-list .list-group-item:before, [class*=header-] .title-base h1:before,
.woocommerce .product span.onsale, .circle-button, .btn.circle-button, .btn, .header-bootstrap, .header-title hr, .advs-box.boxed, i.circle, .intro-box:after, .intro-box:before,.shop-menu-cnt .cart-count,
.advs-box-side-img hr, .call-action-box, .title-base hr, .nav.inner.ms-mini, .bg-color, .header-title.white .title-base hr, .header-animation.white .title-base hr,.woocommerce ul.products li.product .button,
.title-base .scroll-top, .title-modern .scroll-top, i.square, .header-base, .progress-bar, .tagbox span, .niche-box-post .block-infos .block-data, .header-base .title-base h1:before {
    background-color: [MAIN-COLOR];
}

    .navbar-inner .nav.ms-minimal li a:before, .header-base.white, .advs-box-multiple.boxed .advs-box-content,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
        background-color: [MAIN-COLOR] !important;
    }

    .btn:not(.btn-border):hover, .btn-primary:focus, .boxed .btn, .btn-primary.focus, .side-menu .active,.woocommerce ul.products li.product .button:hover,
    .white.circle-button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover,
    .woocommerce input.button.alt:hover, .white .title-base.yellow-bar hr, .cart-buttons a{
        background-color: [HOVER-COLOR] !important;
    }

    i.icon, .fullpage-menu .active i, .navbar-default .navbar-toggle:hover i, .navbar-default .navbar-toggle:focus i, header .side-menu .active > a,
    .adv-img-button-content .caption i, .icon-menu ul.nav > li.active > a i, .icon-menu ul.nav > li:hover > a i, .active .maso-order i, .btn.btn-border i, .advs-box-top-icon:not(.boxed) i.icon,
    .datepicker-panel > ul > li.picked, .tab-box .nav-tabs > li.active > a,.shop-menu-cnt > i:hover,
    .advs-box-content h2:hover a, .pricing-table .pricing-price span, .datepicker-panel > ul > li.picked:hover, footer h4, .box-menu-inner .icon-box i,
    .caption-bottom p, .mi-menu li .fa, .fullpage-arrow.arrow-circle .arrow i, .accordion-list .list-group-item > a i, .mega-menu .fa-ul .fa-li,.cart-total span,
    .adv-circle.adv-circle-center i, .mi-menu a > .fa, .box-steps .step-item:after, .box-steps .step-number, h6, li.panel-item .fa-li, .icon-menu .navbar-collapse ul.nav i,
    .side-menu i, .side-menu ul a i, .bs-menu li:hover > a, .bs-menu li.active > a, .hamburger-button:hover, .img-box.adv-circle i, .advs-box-side .icon, .advs-box-side-icon i,
    .niche-box-testimonails h5, .title-icon i, i, .fullpage-menu.white li.active a i, .timeline > li > .timeline-label h4, .anima-button i, .pricing-table .list-group-item.pricing-price,
    .footer-center .footer-title, .accordion-list .list-group-item > a.active, .btn-border, .btn.btn-border, .btn.circle-button.btn-border, footer a:hover, .block-quote.quote-1:before,
    .block-quote.quote-2:before, .breadcrumb > li + li:before, .adv-img-full-content p.sub {
        color: [MAIN-COLOR];
    }

@media (max-width: 994px) {
    .navbar-nav .open .dropdown-menu > li > a[href="#"] {
        color: [MAIN-COLOR] !important;
    }
}

.footer-minimal .footer-title, .advs-box-top-icon.boxed .btn, .advs-box-top-icon.boxed .circle-button, .sidebar-nav ul a:hover, header .mi-menu .sidebar-nav ul a:hover,
.woocommerce div.product p.price, .woocommerce div.product span.price, .white .text-color, .accordion-list .list-group-item > a:hover, .boxed .circle-button:hover i,.woocommerce ul.products li.product .price,
.boxed .btn:hover i, .pagination > .active > a, .pagination > li:not(.disabled):hover > a, .boxed .circle-button, header .btn-search:hover, .advs-box h2 a:hover, .nav.ms-minimal > li.active > a {
    color: [MAIN-COLOR] !important;
}

.btn-border:hover, .btn.btn-border:hover, .btn.circle-button.btn-border:hover, .tag-row i {
    color: [HOVER-COLOR];
}

    .btn-border:hover i, .white .btn i {
        color: [HOVER-COLOR] !important;
    }

.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus, .pagination > li:not(.disabled):hover > a i:before, .advs-box-multiple div.circle, .advs-box-multiple div.circle i {
    border-color: [MAIN-COLOR] !important;
    color: [MAIN-COLOR] !important;
}

.nav.inner.ms-rounded > li > a:hover, .nav.inner.ms-rounded > li.active a,.list-blog input[type="submit"]:hover {
    background-color: [MAIN-COLOR] !important;
    border-color: [MAIN-COLOR] !important;
}

.circle-button, .btn-default, .white .btn:not(.btn-border), .btn-border, .bg-transparent .navbar-nav > li.active > a .caret:before, .bg-transparent .navbar-nav > li:hover > a .caret:before,
.white .btn-text, .scroll-top-mobile:hover:before, .tab-box.left:not(.pills) .panel-box, .tab-box.right:not(.pills) .panel-box, .tab-box.right .nav-tabs {
    border-color: [MAIN-COLOR];
}

.boxed.advs-box-multiple .advs-box-content, .niche-box-post, .extra-content, .quote-author, .border-color, .border-color.boxed-border.boxed-border.white, .img-border, .timeline > li > .timeline-badge,
body div.boxed-border.border-yellow, .pagination li.active a {
    border-color: [MAIN-COLOR] !important;
}

.datepicker-top-left, .datepicker-top-right {
    border-top-color: [MAIN-COLOR];
}

    .datepicker-top-left:before, .datepicker-top-right:before {
        border-bottom-color: [MAIN-COLOR];
    }

.text-color {
    color: [HOVER-COLOR];
}

.circle-button:hover, .btn:hover {
    border-color: [HOVER-COLOR] !important;
}

.btn-text, html .advs-box .btn-text:after {
    color: [HOVER-COLOR];
    border-color: [HOVER-COLOR];
}';
?>
