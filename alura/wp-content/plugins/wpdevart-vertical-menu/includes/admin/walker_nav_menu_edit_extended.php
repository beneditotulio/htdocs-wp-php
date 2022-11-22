<?php
/*Helper Class for add cutom Field inside admin navigation menu*/
class wpda_walker_nav_menu_extend_for_custom_field extends Walker_Nav_Menu_Edit {
	

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $item_output = '';

        parent::start_el( $item_output, $item, $depth, $args, $id );
        $output .= preg_replace(
            //  wp-admin\includes\class-walker-nav-menu-edit.php 
            '/(?=<(fieldset|p)[^>]+class="[^"]*field-move)/',
            $this->get_fields( $item, $depth, $args ),
            $item_output
        );
    }
    protected function get_fields( $item, $depth, $args = array(), $id = 0 ) {
        ob_start();

        do_action( 'wp_nav_menu_item_icon_url', $item->ID, $item, $depth, $args, $id );

        return ob_get_clean();
    }
}
?>