<?php
class wpdevart_add_to_walker_menu_icon_field {
	protected static $fields = array();
	public static function init() {
		add_action( 'wp_nav_menu_item_icon_url', array( __CLASS__, '_fields' ), 10, 4 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );

		self::$fields = array(
			'menu_icon' => __( 'Set Menu Icon(Does not crop automatically)', 'menu-item-custom-fields-example' ),
		);
	}
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		foreach ( self::$fields as $_key => $label ) {
			$key = sprintf( 'menu-item-%s', $_key );

			// Sanitize
			if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
				// Do some checks here...
				$value = $_POST[ $key ][ $menu_item_db_id ];
			} else {
				$value = null;
			}

			// Update
			if ( ! is_null( $value ) ) {
				update_post_meta( $menu_item_db_id, $key, $value );
			} else {
				delete_post_meta( $menu_item_db_id, $key );
			}
		}
	}
	public static function _fields( $id, $item, $depth, $args ) {
		foreach ( self::$fields as $_key => $label ) :
			$key   = sprintf( 'menu-item-%s', $_key );
			$id    = sprintf( 'edit-%s-%s', $key, $item->ID );
			$name  = sprintf( '%s[%s]', $key, $item->ID );
			$value = get_post_meta( $item->ID, $key, true );
			$class = sprintf( 'field-%s', $_key );
			$image =	($value==''?"":'<img src="'.$value.'" class="cont_button_uploaded_img">');
			?>
				<p class="description description-wide <?php echo esc_attr( $class ) ?>">
					<?php printf(
						'<label for="%1$s">%2$s<br /><button class="wpdevart_upload_image button" onclick="wpdevart_initial_upload(this)">Upload image</button><input type="text" id="%1$s" class="wpdevart_upload_input %1$s" name="%3$s" value="%4$s" />%5$s</label>',
						esc_attr( $id ),
						esc_html( $label ),
						esc_attr( $name ),
						esc_attr( $value ),
						$image
					) ?>
				</p>
			<?php
		endforeach;
	}
	public static function _columns( $columns ) {
		$columns = array_merge( $columns, self::$fields );

		return $columns;
	}
}
wpdevart_add_to_walker_menu_icon_field::init();