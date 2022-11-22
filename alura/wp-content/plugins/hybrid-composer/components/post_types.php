<?php
// =============================================================================
// POST_TYPES.PHP
// -----------------------------------------------------------------------------
// Hybric Composer post types front-end components
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. GRID LIST - POST TYPE - Show the items of selected custom Post Type - Lists with the grid component. Grid documentation and demo: framework-y.com/containers/list-grid.html
//   02. MASONRY LIST - POST TYPE - Show the items of selected custom Post Type - Lists with the masonry component. Masonry documentation and demo: framework-y.com/containers/list-masonry.html
//   03. SLIDER LIST - POST TYPE - Show the items of selected custom Post Type - Lists with the slider component. Slider documentation and demo: framework-y.com/containers/sliders.html
//   04. COVERFLOW LIST - POST TYPE - Show the items of selected custom Post Type - Lists with the coverflow component. Coverflow documentation and demo: framework-y.com/containers/sliders.html#coverflow
//   05. MENU - POST TYPE - Show the categories menu of selected custom Post Type - Lists with the inner menu component. Inner menu documentation and demo: framework-y.com/components/menu/menu-inner-horizontal.html
//   06. TAG CLOUD - POST TYPE - Show the tags of post's blog
//   07. MENU NAVIGATION - POST TYPE - Show next post, previous post and archive page buttons
//   08. POST INFORMATIONS - POST TYPE - Show author, post date, post categories informations.
// =============================================================================

function hc_get_post_pagination($prev_text="",$next_text="",$button_size="pagination-sm") {
	//if (is_singular()) return;

	global $hc_wp_query;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

	if( $hc_wp_query->max_num_pages <= 1 )	return;
	$max   = intval( $hc_wp_query->max_num_pages );
    $links = array();
	if ($paged >= 1) $links[] = $paged;
	if ($paged >= 3) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if (($paged + 2 ) <= $max) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
    $prev_text = '<i class="fa fa-angle-double-left"></i> <span>' .  $prev_text . '</span>';
    $next_text = '<span>' .$next_text . '</span> <i class="fa fa-angle-double-right"></i>';

	echo '<ul class="pagination ' . esc_attr($button_size) . '">' . "\n";

    /**	Back Post Link */
    if ($paged != 1) {
        printf('<li%s><a href="%s">' . $prev_text . '</a></li>' . "\n", " class='first'", esc_url(get_pagenum_link($paged-1)),$paged-1);
    }
	if (!in_array(1, $links)) {
		$class = 1 == $paged ? ' class="active page"' : ' class="page"';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1' );
		if (!in_array(2, $links)) echo '<li></li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort($links);
	foreach ((array)$links as $link ) {
		$class = $paged == $link ? ' class="active page"' : ' class="page"';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
	}

	/**	Link to last page, plus ellipses if necessary */
	if (!in_array($max, $links)) {
		if (!in_array($max - 1, $links)) echo '<li><a>...</a></li>' . "\n";
		$class = $paged == $max ? ' class="active"' : ' class="page"';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
	}

	/**	Next Post Link */
    if ($paged != $max) {
        printf('<li%s><a href="%s">' . $next_text .'</a></li>' . "\n", " class='last'", esc_url(get_pagenum_link($paged+1)),$paged+1);
    }

	echo '</ul>' . "\n";
    wp_reset_query();
}
function hc_get_post_type_item_box($item, &$Y_NOW) {
    $box_type = $Y_NOW["box"];
    $hidden = $Y_NOW["hidden_content"];
    $animation = $Y_NOW["box_animation"];
    $extra_1 = hc_get_now($Y_NOW,"extra_1","false");
    $extra_2 = hc_get_now($Y_NOW,"extra_2","false");
    $content = hc_get_now($Y_NOW,"content");
    $css = " " . hc_get_now($Y_NOW,"custom_css");

    $button = "";
    if ($Y_NOW["button_text"] != "") {
        $button = hc_get_now($Y_NOW,"button_style","circle");
        if ($button == "square") $button = "btn btn-default ";
        if ($button == "circle")  $button =  "btn circle-button ";
        if ($button == "square-border") $button = "btn btn-border ";
        if ($button == "circle-border")  $button =  "btn circle-button btn-border ";
        if ($button == "link") {
            $button =  "btn-text";
        } else {
            $button .= hc_get_now($Y_NOW,"button_dimensions","btn-sm");
            if (hc_get_now($Y_NOW,"button_animation")) $button .= " anima-button ";
        }
        $button = '<a class="' . $button . '" href="' . esc_url($item["link"]) . '">' . ((hc_get_now($Y_NOW,"button_animation")) ? '<i class="fa fa-long-arrow-right"></i> ':'') . $Y_NOW["button_text"] . '</a>';
    }

    $title_len = hc_get_now($Y_NOW,"title_length","-1");
    $excerpt_len = hc_get_now($Y_NOW,"excerpt_length","-1");
    $title_size = hc_get_now($Y_NOW,"title_size");
    $title = $item["title"];
    $excerpt = $item["excerpt"];
    if ($title_len != "-1" && strlen($title) > $title_len) $title = mb_substr($title,0,$title_len) . " ...";
    if ($excerpt_len != "-1" && strlen($excerpt) > $excerpt_len) $excerpt = mb_substr($excerpt,0,$excerpt_len) . " ...";

    if ($Y_NOW["boxed"] == "true") $css .= " boxed";
    if ($Y_NOW["boxed_inverse"] == "true") $css .= " boxed-inverse";

    if ($box_type == "side_content") {
        $img = hc_get_img($item["image"],"large");
?>
<div class="advs-box advs-box-side <?php echo $css; ?>" data-anima="fade-left" data-trigger="hover">
    <div class="row">
        <?php hc_echo($img,'<div class="col-md-4"><div class="img-box"><img src="','" alt="" /></div></div>'); ?>
        <div class="<?php if ($img != "") echo "col-md-8"; else echo "col-md-12" ?>">
            <h3>
                <a href="<?php echo esc_url($item["link"]) ?>" class="<?php echo $title_size; ?>">
                    <?php echo esc_attr($title); ?>
                </a>
            </h3>
            <hr class="anima" />
            <?php if ($extra_1 == "true") hc_echo($item["extra_1"],' <p class="box-extra-value extra-1">','</p>'); if ($extra_2 == "true") hc_echo($item["extra_2"],' <p class="box-extra-value extra-2">','</p>'); ?>
            <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo ' <p class="big-text">' . $excerpt . '</p>'; ?>
            <?php echo $button ?>
        </div>
    </div>
</div>
<?php }
    if ($box_type == "top_icon") {
        $style = "";
        if ($item["icon"]["icon"] == "") $style = 'style="padding-top: 15px !important; margin-top: 0 !important;"';
?>
<div class="advs-box advs-box-top-icon <?php echo $css ?>" <?php if ($animation != "") echo 'data-anima="' . $animation . '" data-trigger="hover"'; echo $style; ?>>
    <?php echo hc_get_icon($item["icon"]["icon"], $item["icon"]["icon_style"], $item["icon"]["icon_image"], "icon circle" . (($animation != "") ? " anima":"")); ?>
    <h3>
        <a href="<?php echo esc_url($item["link"]) ?>" class="<?php echo $title_size; ?>">
            <?php echo esc_attr($title); ?>
        </a>
    </h3>
    <?php if ($extra_1 == "true") hc_echo($item["extra_1"],' <p class="box-extra-value extra-1">','</p>'); if ($extra_2 == "true") hc_echo($item["extra_2"],' <p class="box-extra-value extra-2">','</p>'); ?>
    <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo ' <p class="big-text">' . $excerpt . '</p>'; ?>
    <?php echo $button ?>
</div>
<?php }
    if ($box_type == "side_icon") { ?>
<div class="advs-box advs-box-side-icon <?php echo $css ?>" <?php if ($animation != "") echo 'data-anima="' . $animation . '" data-trigger="hover"'; ?>>
    <?php if (isset($item["icon"]["icon"])) {  hc_echo(hc_get_icon($item["icon"]["icon"], $item["icon"]["icon_style"], $item["icon"]["icon_image"], "icon" . (($animation != "") ? " anima":"")),'<div class="icon-box">','</div>'); }   ?>
    <div class="caption-box">
        <h3>
            <a href="<?php echo esc_url($item["link"]) ?>" class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </a>
        </h3>
        <?php if ($extra_1 == "true") hc_echo($item["extra_1"],' <p class="box-extra-value extra-1">','</p>');  if ($extra_2 == "true") hc_echo($item["extra_2"],' <p class="box-extra-value extra-2">','</p>'); ?>
        <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo ' <p class="big-text">' . $excerpt . '</p>'; ?>
        <?php echo $button ?>
    </div>
</div>
<?php }
    if ($box_type == "top_icon_image") { ?>
<div class="advs-box advs-box-top-icon-img <?php echo $css ?>">
    <?php hc_echo($item["icon"]["icon"], "<i class='fa ", "'></i>"); ?>
    <a href="<?php echo esc_url($item["link"]) ?>" class="img-box img-<?php echo $animation ?>">
        <span>
            <img alt="" src="<?php echo hc_get_img($item["image"],"large"); ?>" />
        </span>
    </a>
    <div class="advs-box-content">
        <h3>
            <a href="<?php echo esc_url($item["link"]) ?>" class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </a>
        </h3>
        <?php if ($extra_1 == "true") hc_echo($item["extra_1"],' <p class="box-extra-value extra-1">','</p>'); if ($extra_2 == "true") hc_echo($item["extra_2"],' <p class="box-extra-value extra-2">','</p>'); ?>
        <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p>' . $excerpt . '</p>'; ?>
        <?php echo $button ?>
    </div>
</div>
<?php }
    if ($box_type == "multiple_box") { ?>
<div class="advs-box advs-box-multiple <?php echo $css ?>" data-anima="scale-up" data-trigger="hover">
    <a href="<?php echo esc_url($item["link"]) ?>" class="img-box <?php hc_echo($animation,"img-",""); ?>">
        <img alt="" src="<?php echo hc_get_img($item["image"]); ?>" />
    </a>
    <div class="circle anima">
        <?php if ($extra_1 == "true" && strlen($item["extra_1"]) > 0) echo $item["extra_1"];
              elseif (strlen($item["extra_2"]) > 0) echo $item["extra_2"];
              elseif (strlen($item["icon"]["icon"]) > 0) echo '<i class="' . $item["icon"]["icon"] . '"></i>';
              else echo date('d', $item["date"]) . '<span>' . date_i18n('M', $item["date"]) . '</span>' ?>
    </div>
    <div class="advs-box-content">
        <h3>
            <a href="<?php echo esc_url($item["link"]) ?>" class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </a>
        </h3>
        <?php
        if ($extra_1 == "true") hc_echo($item["extra_1"],' <p class="box-extra-value extra-1">','</p>');
        hc_echo($item["extra_2"],' <p class="box-extra-value extra-2">','</p>');
        ?>
        <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p>' . $excerpt . '</p>'; ?>
        <?php echo $button ?>
    </div>
</div>
<?php }
    if ($box_type == "blog_side") {
        $img = hc_get_img($item["image"],"ultra-large");
?>
<div class="advs-box advs-box-side-img <?php echo $css ?>">
    <div class="row">
        <?php if (strlen($img) > 0) { ?>
        <div class="col-md-4">
            <a class="img-box" href="<?php echo esc_url($item["link"]) ?>">
                <img alt="" src="<?php echo $img; ?>" />
            </a>
        </div>
        <?php } else echo '<div style="width:20px"></div>'; ?>
        <div class="col-md-8">
            <h3>
                <a href="<?php echo esc_url($item["link"]); ?>" class="<?php echo $title_size; ?>">
                    <?php echo esc_attr($title); ?>
                </a>
            </h3>
            <hr />
            <?php hc_get_post_tags($item,$Y_NOW["post_type_slug"],false) ?>
            <?php if ($extra_1 == "true") hc_echo($item["extra_1"],' <p class="box-extra-value extra-1">','</p>'); if ($extra_2 == "true") hc_echo($item["extra_2"],' <p class="box-extra-value extra-2">','</p>'); ?>
            <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p>' . $excerpt . '</p>'; ?>
            <?php echo $button ?>
        </div>
    </div>
</div>
<?php }
    if ($box_type == "blog_full_width") { ?>
<div class="advs-box advs-box-top-icon-img niche-box-post <?php echo $css ?>">
    <div class="block-infos">
        <div class="block-data">
            <p class="bd-day">
                <?php echo date('d', $item["date"]) ?>
            </p>
            <p class="bd-month">
                <?php echo date_i18n('M', $item["date"]) . ' ' . date('Y', $item["date"]) ?>
            </p>
        </div>
        <a class="block-comment">
            <?php echo esc_attr($item["comments_count"]) ?>
            <i class="fa fa-comment-o"></i>
        </a>
    </div>
    <a class="img-box" href="<?php echo esc_url($item["link"]) ?>">
        <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large");  ?>" />
    </a>
    <div class="advs-box-content">
        <h3>
            <a href="<?php echo esc_url($item["link"]); ?>" class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </a>
        </h3>
        <?php hc_get_post_tags($item,$Y_NOW["post_type_slug"],true,true,false,false,false) ?>
        <?php if ($extra_1 == "true") hc_echo($item["extra_1"],' <p class="box-extra-value extra-1">','</p>'); if ($extra_2 == "true") hc_echo($item["extra_2"],' <p class="box-extra-value extra-2">','</p>'); ?>
        <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p>' . $excerpt . '</p>'; ?>
        <?php echo $button ?>
    </div>
</div>
<?php }
    if ($box_type == "blog_full_width_2") { ?>
<div class="advs-box niche-box-blog <?php echo $css ?>">
    <div class="block-top">
        <div class="block-infos">
            <div class="block-data">
                <p class="bd-day">
                    <?php echo date('d', $item["date"]) ?>
                </p>
                <p class="bd-month">
                    <?php echo date_i18n('M', $item["date"]) . ' ' . date('Y', $item["date"]) ?>
                </p>
            </div>
            <a class="block-comment">
                <?php echo esc_attr($item["comments_count"]) ?>
                <i class="fa fa-comment-o"></i>
            </a>
        </div>
        <div class="block-title">
            <h3>
                <a href="<?php echo esc_url($item["link"]); ?>" class="<?php echo $title_size; ?>">
                    <?php echo esc_attr($title); ?>
                </a>
            </h3>
            <?php hc_get_post_tags($item,$Y_NOW["post_type_slug"],true,true,false,false,false) ?>
        </div>
    </div>
    <a class="img-box" href="<?php echo esc_url($item["link"]); ?>">
        <img alt="Blog post" src="<?php echo hc_get_img($item["image"],"ultra-large"); ?>" />
    </a>
    <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p class="excerpt">' . $excerpt . '</p>'; ?>
    <?php if ($extra_1 == "true") hc_echo($item["extra_1"],' <p class="box-extra-value extra-1">','</p>'); if ($extra_2 == "true") hc_echo($item["extra_2"],' <p class="box-extra-value extra-2">','</p>'); ?>
    <?php echo $button ?>
</div>
<?php }
    if ($box_type == "team") { ?>
<div class="advs-box niche-box-team <?php echo $css ?>" data-anima="scale-up" data-trigger="hover">
    <a class="img-box" href="<?php echo esc_url($item["link"]); ?>">
        <img alt="Team" class="anima" src="<?php echo hc_get_img($item["image"],"large"); ?>" />
    </a>
    <div class="content-box">
        <h2>
            <?php echo esc_attr($title) ?>
        </h2>
        <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) echo '<h4>' . $item["subtitle"] . '</h4>'; ?>
        <hr class="e" />
        <div class="btn-group social-group">
            <a target="_blank" href="<?php echo esc_url($item["link"]) ?>">
                <i data-social="share-facebook" class="fa fa-facebook"></i>
            </a>
            <a target="_blank" href="<?php echo esc_url($item["link"]) ?>">
                <i data-social="share-twitter" class="fa fa-twitter"></i>
            </a>
            <a target="_blank" href="<?php echo esc_url($item["link"]) ?>">
                <i data-social="share-google" class="fa fa-google"></i>
            </a>
            <a target="_blank" href="<?php echo esc_url($item["link"]) ?>">
                <i data-social="share-linkedin" class="fa fa-linkedin"></i>
            </a>
        </div>
        <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p>' . $excerpt . '</p>'; ?>
        <?php if ($extra_1 == "true") hc_echo($item["extra_1"],' <p class="box-extra-value extra-1">','</p>'); if ($extra_2 == "true") hc_echo($item["extra_2"],' <p class="box-extra-value extra-2">','</p>'); ?>
    </div>
</div>
<?php  }
    if ($box_type == "image_half_content") { ?>
<div class="img-box adv-img adv-img-half-content <?php hc_echo($animation," img-",""); echo $css; ?>" <?php if ($hidden == "true") echo 'data-anima="fade-bottom" data-trigger="hover" data-anima-out="hide"' ?>>
    <?php hc_echo($item["icon"]["icon"],'<i class="',' anima anima-fade-left"></i>'); ?>
    <a <?php if (strlen($Y_NOW["button_text"]) == 0) echo 'href="' . esc_url($item["link"]) . '"' ?>>
        <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    </a>
    <div class="caption <?php if ($hidden == "true") echo "anima" ?>">
        <h2>
            <a href="<?php echo esc_url($item["link"]); ?>" class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </a>
        </h2>
        <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) hc_echo(esc_attr($item["subtitle"]),'<p class="sub">','</p>'); ?>
        <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p>' . $excerpt . '</p>'; ?>
        <?php hc_echo(esc_attr($Y_NOW["button_text"]),'<br><a class="anima-button circle-button white btn btn-sm" href="' . esc_url($item["link"]) . '"><i class="fa fa-long-arrow-right"></i>','</a>'); ?>
    </div>
</div>
<?php }
    if ($box_type == "image_side_content") { ?>
<div class="img-box adv-img adv-img-side-content i-top-right <?php hc_echo($animation,"img-",""); echo $css; ?>" <?php if ($hidden == "true") echo 'data-anima="fade-left" data-trigger="hover" data-anima-out="hide"' ?>>
    <?php hc_echo($item["icon"]["icon"],'<i class="',' anima anima-fade-top"></i>'); ?>
    <a href="<?php echo esc_url($item["link"]); ?>">
        <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    </a>
    <div class="caption <?php if ($hidden == "true") echo "anima" ?>">
        <h2>
            <a href="<?php echo esc_url($item["link"]); ?>" class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </a>
        </h2>
        <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) hc_echo(esc_attr($item["subtitle"]),'<p class="sub">','</p>'); ?>
        <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p>' . $excerpt . '</p>'; ?>
        <?php hc_echo(esc_attr($Y_NOW["button_text"]),'<br><a class="anima-button circle-button white btn btn-sm" href="' . esc_url($item["link"]) . '"><i class="fa fa-long-arrow-right"></i>','</a>'); ?>
    </div>
</div>
<?php }
    if ($box_type == "image_full_content") { ?>
<div class="img-box adv-img adv-img-full-content <?php echo $css ?>" <?php if ($hidden == "true") echo 'data-anima="' . $animation . '" data-trigger="hover" data-anima-out="hide"' ?>>
    <div class="img-box">
        <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    </div>
    <a href="<?php echo esc_url($item["link"]); ?>" class="img-box caption-bg anima">
        <div class="caption">
            <div class="inner">
                <?php hc_echo($item["icon"]["icon"],'<i class="',' main-icon anima anima-fade-top"></i>'); ?>
                <h2 class="<?php echo $title_size; ?>">
                    <?php echo esc_attr($title); ?>
                </h2>
                <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) hc_echo(esc_attr($item["subtitle"]),'<p class="sub">','</p>'); ?>
                <?php if ($content == "description" && strlen($excerpt) > 0) hc_echo($excerpt,'<p class="sub">','</p>'); ?>
            </div>
        </div>
    </a>
</div>
<?php }
    if ($box_type == "image_buttons_content") { ?>
<div class="img-box adv-img adv-img-button-content <?php hc_echo($animation,"img-",""); echo $css; ?>" data-anima="fade-left" data-trigger="hover" <?php if ($hidden == "true") echo 'data-anima-out="hide"' ?>>
    <a href="#">
        <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    </a>
    <div class="caption <?php if ($hidden == "true") echo "anima anima-fade-top" ?>">
        <h2 class="<?php echo $title_size; ?>">
            <?php echo esc_attr($title); ?>
        </h2>
        <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) hc_echo(esc_attr($item["subtitle"]),'<p class="sub">','</p>'); ?>
        <?php if ($content == "description" && strlen($excerpt) > 0) hc_echo($excerpt,'<p class="sub">','</p>'); ?>
        <a href="<?php echo esc_url($item["link"]); ?>">
            <i class="fa <?php if(strlen($item["icon"]["icon"]) > 0) echo esc_attr($item["icon"]["icon"]); else echo "fa-link"; ?> text-m circle anima"></i>
        </a>
        <a class="lightbox" href="<?php echo hc_get_img($item["image"],"ultra-large") ?>" data-lightbox-anima="fade-bottom">
            <i class="fa fa-search text-m circle anima anima-fade-right"></i>
        </a>
    </div>
</div>
<?php }
    if ($box_type == "image_down_text") { ?>
<div class="img-box adv-img adv-img-down-text <?php echo $css ?>">
    <a class="img-box img-<?php if ($animation == "") echo "scale-up"; else echo $animation; ?> i-center" href="<?php echo esc_url($item["link"]); ?>">
        <div class="caption">
            <i class="fa fa-plus"></i>
        </div>
        <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    </a>
    <div class="caption-bottom">
        <h2>
            <a href="<?php echo esc_url($item["link"]); ?>" class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </a>
        </h2>
        <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) hc_echo(esc_attr($item["subtitle"]),'<p class="sub">','</p>'); ?>
        <?php if ($content == "description" && strlen($excerpt) > 0) hc_echo($excerpt,'<p class="sub">','</p>'); ?>
        <?php echo $button ?>
    </div>
</div>
<?php }
    if ($box_type == "image_classic_box") { ?>
<div class="img-box adv-img adv-img-classic-box <?php echo $css ?>">
    <div class="img-box <?php hc_echo($animation,"img-",""); ?>">
        <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    </div>
    <a href="<?php echo esc_url($item["link"]) ?>" class="caption img-box">
        <div class="caption-inner">
            <h2 class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </h2>
            <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) echo '<p class="sub-text">' . esc_attr($item["subtitle"]) . '</p>'; ?>
            <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p class="big-text">' . $excerpt . '</p>'; ?>
        </div>
    </a>
</div>
<?php }
    if ($box_type == "image_circle_center") { ?>
<a href="<?php echo esc_url($item["link"]); ?>" class="img-box adv-circle circle adv-circle-center <?php if ($hidden != "true") echo 'show' ?>" data-anima="<?php if ($animation == "") echo "fade-in"; else echo $animation; echo $css; ?>" data-trigger="hover" <?php if ($hidden == "true") echo 'data-anima-out="hide"' ?>>
    <?php hc_echo(esc_attr($item["icon"]["icon"]),'<i class="',' main-icon anima"></i>'); ?>
    <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    <div class="caption anima">
        <h2 class="<?php echo $title_size; ?>">
            <a href="<?php echo esc_url($item["link"]); ?>">
                <?php echo esc_attr($title); ?>
            </a>
        </h2>
        <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) hc_echo(esc_attr($item["subtitle"]),'<p>','</p>'); ?>
        <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p>' . $excerpt . '</p>'; ?>
    </div>
</a>
<?php   }
    if ($box_type == "image_circle_center_2") { ?>
<a href="<?php echo esc_url($item["link"]); ?>" class="img-box adv-circle circle adv-circle-center-2 <?php if ($hidden != "true") echo 'show' ?>" data-anima="<?php if ($animation == "") echo "fade-in"; else echo $animation;echo $css; ?>" data-trigger="hover" <?php if ($hidden == "true") echo 'data-anima-out="hide"' ?>>
    <?php hc_echo($item["icon"]["icon"],'<i class="',' main-icon anima"></i>'); ?>
    <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    <div class="caption anima">
        <div class="inner">
            <h2 class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </h2>
            <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) hc_echo(esc_attr($item["subtitle"]),'<p>','</p>'); ?>
            <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p class="sub">' . $excerpt . '</p>'; ?>
        </div>
    </div>
</a>
<?php   }
    if ($box_type == "image_circle_half" || $box_type == "image_circle_bottom") { ?>
<a href="<?php echo esc_url($item["link"]); ?>" class="img-box adv-circle circle <?php hc_echo($animation,"img-"," "); if ($hidden != "true") echo 'show'; if ($box_type == "image_circle_bottom") echo " adv-circle-bottom"; else echo " adv-circle-half"; echo $css; ?>" data-anima="fade-in" data-trigger="hover" <?php if ($hidden == "true") echo 'data-anima-out="hide"' ?>>
    <?php hc_echo($item["icon"]["icon"],'<i class="',' main-icon anima ' . (($box_type == "image_circle_bottom") ? " i-center":"") .'"></i>'); ?>
    <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    <div class="caption anima anima-fade-bottom">
        <div class="inner">
            <h2 class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </h2>
            <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) hc_echo(esc_attr($item["subtitle"]),'<p>','</p>'); ?>
            <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p class="sub">' . $excerpt . '</p>'; ?>
        </div>
    </div>
</a>
<?php   }
    if ($box_type == "image_circle_background") { ?>
<a href="<?php echo esc_url($item["link"]); ?>" class="img-box adv-circle circle adv-circle-bg  <?php if ($hidden != "true") echo 'show'; echo $css; ?>" data-anima="<?php if ($animation == "") echo "fade-in"; else echo $animation; ?>" data-trigger="hover" <?php if ($hidden == "true") echo 'data-anima-out="hide"' ?>>
    <?php hc_echo($item["icon"]["icon"],'<i class="',' main-icon anima"></i>'); ?>
    <img alt="" src="<?php echo hc_get_img($item["image"],"ultra-large") ?>" />
    <div class="caption anima">
        <div class="inner">
            <h2 class="<?php echo $title_size; ?>">
                <?php echo esc_attr($title); ?>
            </h2>
            <?php if (($content == "" || $content == "subtitle") && strlen($item["subtitle"])) hc_echo(esc_attr($item["subtitle"]),'<p>','</p>'); ?>
            <?php if (($content == "" || $content == "description") && strlen($excerpt) > 0) echo '<p class="sub">' . $excerpt . '</p>'; ?>
        </div>
    </div>
</a>
<?php   }
}

function hc_include_hc_pt_grid_list(&$Y_NOW,$EXTRA) {   ?>
<div class="grid-list <?php echo hc_get_component_classes($Y_NOW,$EXTRA); if($Y_NOW["column"] == "col-md-12") echo " one-row-list"; ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <div class="grid-box row" <?php if (strlen($Y_NOW["margins"]) > 0) echo 'style="margin: -' . esc_attr($Y_NOW["margins"]) . 'px; width: calc(100% + ' . esc_attr((int)$Y_NOW["margins"]*2) . 'px)"'; ?>>
        <?php
    global $HC_PT_CATEGORY;
    $cat = (($HC_PT_CATEGORY == "") ? $Y_NOW["post_type_category"]:$HC_PT_CATEGORY);
    $arr = hc_get_post_type_items($Y_NOW["post_type_slug"],$cat,(($Y_NOW["pagination_type"] == "pagination_wp" || $Y_NOW["pagination_type"] == "") ? $Y_NOW["pag_items"] : "9999"));
    $count = count($arr);
    if ($count > 0) {
        $grid_container =  '<div class="grid-item ' .  esc_attr($Y_NOW["column"]) . " " . esc_attr($Y_NOW["row"]) . '" ' . hc_get(esc_attr($Y_NOW["margins"])," style='padding:","px'") . '>';
        $boxed = "";
        if ($Y_NOW["boxed"] == "true") $boxed = "boxed";
        if ($Y_NOW["boxed_inverse"] == "true") $boxed = "boxed-inverse";
        for ($i = 0; $i < count($arr); $i++) {
            echo $grid_container;
            hc_get_post_type_item_box($arr[$i],$Y_NOW);
            echo '</div>';
        }
    } else echo "<div class='text-center' style='width: 100%;'>" . esc_attr__("We didn't found any ","hc") . $Y_NOW["post_type_slug"] . ".</div>";
        ?>
    </div>
    <?php
    if ($count > 0) {
        if ($Y_NOW["pagination_type"] == "pagination") { ?>
    <div class="pagination-inner<?php if ($Y_NOW["pag_centered"] == "true") echo " list-nav" ?>">
    <ul class="<?php echo esc_attr($Y_NOW["button_size"]); ?> hide-first-last pagination-grid" data-page-items="<?php if (strlen($Y_NOW["pag_items"]) > 0 ) echo esc_attr($Y_NOW["pag_items"]); else echo "10"; ?>" <?php hc_echo(esc_attr($Y_NOW["pag_lm_animation"]),"data-pagination-anima='","'"); ?>
        data-options="<?php if ($Y_NOW["pag_scroll_top"] == "true" ) echo "scrollTop:true,"; hc_echo(esc_attr($Y_NOW["pag_button_prev"]),"prev:<i class='fa fa-angle-left'></i> ",","); hc_echo(esc_attr($Y_NOW["pag_button_next"]),"next:","<i class='fa fa-angle-right'></i>"); ?>">
    </ul>
   </div> 
  <?php  }
        if ($Y_NOW["pagination_type"] == "load_more") {  ?>
    <div class="list-nav">
        <a class="circle-button btn btn-sm load-more-grid" <?php hc_echo(esc_attr($Y_NOW["pag_lm_animation"]),"data-pagination-anima='","'"); ?>
            data-page-items="<?php if (strlen($Y_NOW["pag_items"]) > 0 ) echo esc_attr($Y_NOW["pag_items"]); else echo "3"; ?>"
            data-options="<?php if (strlen($Y_NOW["lm_lazy"]) > 0 ) echo "lazyLoad:true"; ?>">
            <?php echo esc_attr($Y_NOW["lm_button_text"]); ?>
            <i class="fa fa-arrow-down"></i>
        </a>
    </div>
    <?php }
        if ($Y_NOW["pagination_type"] == "pagination_wp") {
            if ($Y_NOW["pag_centered"] == "true") echo "<div class='list-nav'>";
            hc_get_post_pagination(esc_attr($Y_NOW["pag_button_prev"]),esc_attr($Y_NOW["pag_button_next"]), hc_get_now($Y_NOW,"button_size"));
            if ($Y_NOW["pag_centered"] == "true") echo "</div>";
        }
    }
    ?>
</div>
<?php }
function hc_include_hc_pt_masonry_list(&$Y_NOW,$EXTRA) {
    $classes = hc_get_component_classes($Y_NOW,$EXTRA);
    $mobile_col = " col-sm-6";
    if ($Y_NOW["column"] == "col-md-12") {
        $mobile_col = "";
        $classes .= " one-row-list";
    }
    if ($Y_NOW["auto_masonry"] == "true") $classes .= " maso-layout";
    if ($Y_NOW["menu_position"] == "nav-center nav-menu-outer") $classes .= "menu-outer";
?>
<div class="maso-list <?php echo $classes ?>" style="<?php echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <?php
    global $HC_PT_CATEGORY;
    $cat = (($HC_PT_CATEGORY == "") ? $Y_NOW["post_type_category"]:$HC_PT_CATEGORY);
    $arr = hc_get_post_type_items($Y_NOW["post_type_slug"],$cat,(($Y_NOW["pagination_type"] == "pagination_wp" || $Y_NOW["pagination_type"] == "") ? $Y_NOW["pag_items"] : "9999"));
    $count = count($arr);
    if ($count > 0) {
        if ($Y_NOW["menu"] == "true") {
    ?>
    <div class="navbar navbar-inner">
        <div class="navbar-toggle">
            <i class="fa fa-bars"></i>
            <span>
                <?php esc_html_e("Menu","hc"); ?>
            </span>
            <i class="fa fa-angle-down"></i>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav over inner maso-filters <?php echo esc_attr($Y_NOW["menu_style"] . " " . $Y_NOW["menu_position"]); ?>">
                <li class="current-active active">
                    <a class="maso-filter-auto" data-filter="maso-item">All</a>
                </li>
                <?php
            if ($Y_NOW["post_type_slug"] != "post") $catsArr = get_terms(array('taxonomy' => $Y_NOW["post_type_slug"] . '-cat','hide_empty' => true));
            else $catsArr = get_categories();
            if (!is_wp_error($catsArr)) {
                foreach ($catsArr as $term) {
                    echo '<li><a data-filter="cat-'. esc_attr($term->slug) .'">'. esc_attr($term->name) .'</a></li>';
                }
            }
                ?>
                <li>
                    <a class="maso-order maso-filter-auto" data-sort="asc">
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php } ?>
    <div class="maso-box row" <?php if (strlen($Y_NOW["margins"]) > 0) echo 'style="margin: -' . esc_attr($Y_NOW["margins"]) . 'px; width: calc(100% + ' . esc_attr((int)$Y_NOW["margins"]*2) . 'px)"'; ?>>
        <?php

        $grid_container_part_2 =   esc_attr($Y_NOW["column"] . ' ' . $Y_NOW["row"]) . $mobile_col . '  " ' . hc_get(esc_attr($Y_NOW["margins"])," style='padding:","px'") . '>';
        $boxed = "";
        if ($Y_NOW["boxed"] == "true") $boxed = "boxed";
        if ($Y_NOW["boxed_inverse"] == "true") $boxed = "boxed-inverse";
        for ($i = 0; $i < count($arr); $i++) {
            if ($Y_NOW["post_type_slug"] == "post") $post_categories = get_the_category($arr[$i]["id"]);
            else $post_categories = get_the_terms($arr[$i]["id"], $Y_NOW["post_type_slug"] . '-cat');
            $cat_html = "";
            if ($post_categories != false) {
                foreach($post_categories as $c){
                    $cat_html .= ' cat-'. $c->slug;
                }
            }
            echo '<div data-sort="' . $i .'" class="maso-item cat-' . esc_attr($cat_html) . ' ' . $grid_container_part_2;
            hc_get_post_type_item_box($arr[$i],$Y_NOW);
            echo '</div>';
        }
        ?>
    </div>
    <?php
        if ($Y_NOW["pagination_type"] == "pagination") {
            if ($Y_NOW["pag_centered"] == "true") echo "<div class='list-nav'>"; ?>
    <ul class="<?php echo esc_attr($Y_NOW["button_size"]); ?> hide-first-last pagination-maso" data-page-items="<?php if (strlen($Y_NOW["pag_items"]) > 0 ) echo esc_attr($Y_NOW["pag_items"]); else echo "10"; ?>" <?php hc_echo(esc_attr($Y_NOW["pag_lm_animation"]),"data-pagination-anima='","'"); ?>
        data-options="<?php if ($Y_NOW["pag_scroll_top"] == "true" ) echo "scrollTop:true,"; hc_echo(esc_attr($Y_NOW["pag_button_prev"]),"prev:<i class='fa fa-angle-left'></i> ",","); hc_echo(esc_attr($Y_NOW["pag_button_next"]),"next:"," <i class='fa fa-angle-right'></i"); ?>"></ul>
    <?php if ($Y_NOW["pag_centered"] == "true") echo "</div>";
        }
        if ($Y_NOW["pagination_type"] == "load_more") {  ?>
    <div class="list-nav">
        <a class="circle-button btn btn-sm load-more-maso" <?php hc_echo(esc_attr($Y_NOW["pag_lm_animation"]),"data-pagination-anima='","'"); ?>
            data-page-items="<?php if (strlen($Y_NOW["pag_items"]) > 0 ) echo esc_attr($Y_NOW["pag_items"]); else echo "3"; ?>"
            data-options="<?php if (strlen($Y_NOW["lm_lazy"]) > 0 ) echo "lazyLoad:true"; ?>">
            <?php echo esc_attr($Y_NOW["lm_button_text"]); ?>
            <i class="fa fa-arrow-down"></i>
        </a>
    </div>
    <?php }
        if ($Y_NOW["pagination_type"] == "pagination_wp") {
            if ($Y_NOW["pag_centered"] == "true") echo "<div class='list-nav'>";
            hc_get_post_pagination($Y_NOW["pag_button_prev"],$Y_NOW["pag_button_next"],$Y_NOW["button_size"]);
            if ($Y_NOW["pag_centered"] == "true") echo "</div>";
        }
    } else echo "<div class='text-center' style='width: 100%;'>" . esc_attr__("We didn't found any ","hc") . $Y_NOW["post_type_slug"] . ".</div>";
    ?>
</div>
<?php }
function hc_include_hc_pt_slider(&$Y_NOW,$EXTRA) {   ?>
<div class="flexslider <?php echo esc_attr($Y_NOW["slider_type" ]). ' ' . $Y_NOW["css_classes"] . ' ' . $Y_NOW["custom_css_classes"]; if ($Y_NOW["nav_inner"] == "true") echo " nav-inner"; if ($Y_NOW["outer_arrows"] == "true") echo " outer-navs"; if ($Y_NOW["visible_arrows"] == "true") echo " visible-dir-nav"; ?>"
    data-options="<?php echo esc_attr($Y_NOW["data_options"]) ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php hc_echo(hc_get_now($Y_NOW,"trigger"),"data-trigger='","'") ?>>
    <ul class="slides">
        <?php
    global $HC_PT_CATEGORY;
    $cat = (($HC_PT_CATEGORY == "") ? $Y_NOW["post_type_category"]:$HC_PT_CATEGORY);
    $arr = hc_get_post_type_items($Y_NOW["post_type_slug"],$cat,$Y_NOW["num_items"]);

    for ($i = 0; $i < count($arr); $i++) {
        echo '<li>';
        hc_get_post_type_item_box($arr[$i],$Y_NOW);
        echo '</li>';
    }
        ?>
    </ul>
</div>
<?php }
function hc_include_hc_pt_coverflow(&$Y_NOW,$EXTRA) {   ?>
<div class="coverflow-slider <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" <?php hc_echo(esc_attr($Y_NOW["slide_width"]),"data-width='","'"); ?> style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>">
    <ul class="slides">
        <?php
    global $HC_PT_CATEGORY;
    $cat = (($HC_PT_CATEGORY == "") ? $Y_NOW["post_type_category"]:$HC_PT_CATEGORY);
    $arr = hc_get_post_type_items($Y_NOW["post_type_slug"],$cat,$Y_NOW["num_items"]);
    $boxed = "";
    if ($Y_NOW["boxed"] == "true") $boxed = "boxed";
    if ($Y_NOW["boxed_inverse"] == "true") $boxed = "boxed-inverse";
    for ($i = 0; $i < count($arr); $i++) {
        echo '<li>';
        hc_get_post_type_item_box($arr[$i],$Y_NOW);
        echo '</li>';
    }
        ?>
    </ul>
</div>
<?php }
function hc_include_hc_pt_menu(&$Y_NOW,$EXTRA) {
    global $HC_PT_CATEGORY;

    $menu_html = '';
    $menu_type =  $Y_NOW["type"];
    if ($menu_type == "horizontal") $menu_html = '<ul id="hc-inner-menu" class="nav navbar-nav inner '. esc_attr($Y_NOW["alignment"]) . ' ' . esc_attr($Y_NOW["style"]) . '">';
    if ($menu_type == "vertical") $menu_html = '<ul id="hc-inner-menu" class="side-menu">';
    if ($Y_NOW["all_button_text"] != "") $menu_html .= '<li ' . (($HC_PT_CATEGORY == "") ? 'class="active"':'') . '><a href="' . (($Y_NOW["post_type_slug"] != "post") ? esc_url(get_post_type_archive_link($Y_NOW["post_type_slug"])):esc_url(get_page_link(hc_get_setting('blog-page')))) . '">' . esc_attr($Y_NOW["all_button_text"]) . '</a></li>';

    if ($Y_NOW["post_type_slug"] != 'post') {
        $arr = get_terms(array('taxonomy' => $Y_NOW["post_type_slug"] . '-cat','hide_empty' => true));
        foreach ($arr as $term) {
            $menu_html .= '<li ' . (($HC_PT_CATEGORY == $term->slug) ? 'class="active"':'') . '><a href="' . get_term_link($term->term_id) . '">' . $term->name . '</a></li>';
        }
    }  else {
        $arr = get_categories();
        foreach ($arr as $term ) {
            if ($term->term_id > 1 && $term->cat_name != "Uncategorized") $menu_html .= '<li ' . (($HC_PT_CATEGORY == $term->slug) ? 'class="active"':'') . '><a href="' . get_category_link($term->term_id) .'">' . $term->name . '</a></li>';
        }
    }

    $menu_html .= '</ul>';
    if ($menu_type == "horizontal") echo '<div class="navbar navbar-inner ' . hc_get_component_classes($Y_NOW,$EXTRA) .'" style="' . esc_attr($Y_NOW["custom_css_styles"]) .'"><div class="navbar-toggle"><i class="fa fa-bars"></i><span>' . esc_attr__("menu","hc") . '</span><i class="fa fa-angle-down"></i></div><div class="collapse navbar-collapse">' . $menu_html . '</div></div>';
    if ($menu_type == "vertical") echo '<aside class="sidebar mi-menu ' . hc_get_component_classes($Y_NOW,$EXTRA) .'" style="' . esc_attr($Y_NOW["custom_css_styles"]) .'"><nav class="sidebar-nav">' . $menu_html . '</nav></aside>';
}
function hc_include_hc_pt_tag_cloud(&$Y_NOW,$EXTRA) {
    $arr = get_tags( array("orderby" => $Y_NOW["orderby"],"order" => $Y_NOW["order"],"number" => $Y_NOW["items"]));
    $html = '';
    for ($i = 0; $i < count($arr); $i++){
        $html .= '<a href="' . esc_url(get_tag_link($arr[$i]->term_id)) .'">' . esc_attr($arr[$i]->name) . '</a>';
    }
    echo '<div class="tagbox">' . $html . '</div>';
}
function hc_include_hc_pt_navigation(&$Y_NOW,$EXTRA) {
    global $HC_PT_CATEGORY;
    $prev = get_previous_post_link('%link',esc_attr($Y_NOW["previous_text"]));
    $next = get_next_post_link('%link',esc_attr($Y_NOW["next_text"]));
    $link = hc_get_now($Y_NOW,"archive_link");
    if ($link == "") $link = (($Y_NOW["post_type_slug"] != "post") ? esc_url(get_post_type_archive_link($Y_NOW["post_type_slug"])) : esc_url(get_permalink(hc_get_setting('blog-page'))));
?>
<div class="row porfolio-bar <?php echo hc_get_component_classes($Y_NOW,$EXTRA); ?>" <?php hc_echo(esc_attr($Y_NOW["custom_css_styles"],'style="','"')); ?> ">
    <div class="col-md-2">
        <?php if (strlen($prev) > 0) { ?>
        <div class="icon-box" data-anima="scale-up" data-trigger="hover">
            <i class="fa fa-arrow-left text-m"></i>
            <label class="text-s">
                <?php echo $prev ?>
            </label>
        </div>
        <?php } ?>
    </div>
    <div class="col-md-8 text-center">
        <a href="<?php echo esc_url($link) ?>" data-anima="scale-up" data-trigger="hover">
            <i class="anima fa fa-th"></i>
        </a>
    </div>
    <div class="col-md-2 text-right">
        <?php if (strlen($next) > 0) { ?>
        <div class="icon-box icon-box-right pull-right" data-anima="scale-up" data-trigger="hover">
            <label class="text-s">
                <?php echo $next ?>
            </label>
            <i class="fa fa-arrow-right text-m"></i>
        </div>
        <?php } ?>

    </div>
</div>
<?php
}
function hc_include_hc_pt_post_informations(&$Y_NOW,$EXTRA) {
    global $post; ?>
<div class="tag-row icon-row text-<?php echo esc_attr($Y_NOW["position"]) ?>">
    <?php
    if ($Y_NOW["date"] == "true") echo '<span><i class="fa fa-calendar"></i><a>' . get_the_time('l, F jS, Y') . '</a></span>';
    if ($Y_NOW["categories"] == "true") hc_echo(hc_get_post_categories($post->ID,$post->post_type),'<span><i class="fa fa-bookmark"></i>','</span>');
    if ($Y_NOW["author"] == "true") hc_echo(ucfirst(get_the_author()),'<span><i class="fa fa-pencil"></i><a>','</a></span>');
    if ($Y_NOW["share"] == "true") {
    ?>
    <div class="social-group-button">
        <div class="social-button" data-anima="pulse-vertical" data-trigger="hover">
            <i class="fa fa-share-alt"></i>
        </div>
        <div class="btn-group social-group">
            <a target="_blank" href="#" data-social="share-facebook">
                <i class="fa fa-facebook circle"></i>
            </a>
            <a target="_blank" href="#">
                <i data-social="share-twitter" class="fa fa-twitter circle"></i>
            </a>
            <a target="_blank" href="#">
                <i data-social="share-google" class="fa fa-google circle"></i>
            </a>
            <a target="_blank" href="#">
                <i data-social="share-linkedin" class="fa fa-linkedin circle"></i>
            </a>
        </div>
    </div>
    <?php } ?>
</div>
<?php
} ?>

