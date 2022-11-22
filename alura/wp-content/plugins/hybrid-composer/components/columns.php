<?php
// =============================================================================
// COLUMNS.PHP
// -----------------------------------------------------------------------------
// Hybric Composer columns front-end component
// =============================================================================

function hc_include_hc_column(&$Y_NOW,$EXTRA = array()) {
          ?>
<div id="<?php echo esc_attr($Y_NOW['id']); ?>" class="hc_column_cnt <?php echo esc_attr($Y_NOW["column_width"]) . " ";
                  if (in_array("timeline", $EXTRA)) { echo " anima"; if (!empty($Y_NOW["animation"])) echo " anima-" . esc_attr($Y_NOW["animation"]); }
                  echo " " . esc_attr($Y_NOW["css_classes"] . " " . $Y_NOW["custom_css_classes"]);
           ?>" style="<?php  echo esc_attr($Y_NOW["custom_css_styles"]); ?>" <?php hc_get_scroll_animation($Y_NOW["animation"],$Y_NOW["animation_time"],$Y_NOW["timeline_animation"],$Y_NOW["timeline_delay"],$Y_NOW["timeline_order"],(in_array("fullpage", $EXTRA) ? "fullpage":"")) ?>>
    <?php
    $isRow = false;
    $CURRENT_COLUMN = $Y_NOW["main_content"];
    echo '<div class="row">';
    for ($i = 0; $i < count($CURRENT_COLUMN); $i++) {
        if ($Y_NOW["timeline_animation"] == "true") array_push($EXTRA, "timeline");
        else $EXTRA = array_diff($EXTRA,array("timeline"));
        if (isset($CURRENT_COLUMN[$i]["component"]) && $CURRENT_COLUMN[$i]["component"] == "hc_column") $isRow = true; else $isRow = false;
        if (!$isRow) echo '<div class="col-md-12 ' . esc_attr($CURRENT_COLUMN[$i]['component']) . '_cnt">';
        hc_get_content_recursive($CURRENT_COLUMN[$i],$EXTRA);
        if (!$isRow) echo '</div>';
    }
    echo "</div>";
    ?>
</div>
<?php } ?>
