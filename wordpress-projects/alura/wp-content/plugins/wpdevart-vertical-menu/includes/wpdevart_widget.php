<?php 
/*############################### WIDGET ###############################################*/

class wpdevart_vertical_menu_widget extends WP_Widget {
	private static $id_for_content=0;
	// Constructor //	
	function __construct() {		
		$widget_ops = array( 'classname' => 'wpdevart_vertical_menu_widget', 'description' => 'Create vertical menu' ); // Widget Settings
		$control_ops = array( 'id_base' => 'wpdevart_vertical_menu_widget' ); // Widget Control Settings
		parent::__construct( 'wpdevart_vertical_menu_widget', 'vertical menu wpdevart', $widget_ops, $control_ops ); // Create the widget
	}

	/*vertical menu display in front*/
	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];    
		// Before widget //
		echo $before_widget;		
		// Title of widget //
		if ( $title ) { echo $before_title . $title . $after_title; }
		// Widget output //
		$wpdevart_menu= new wpdevart_vertical_menu_frontend_classes($instance['menu'],$instance['theme']);
		echo $wpdevart_menu->create_menu();
		// After widget //		
		echo $after_widget;
	}
	// Update Settings //
	function update($new_instance, $old_instance) {	
		extract( $args );
		$instance['title'] 	= strip_tags($new_instance['title']);    
		$instance['theme'] 	= $new_instance['theme'];
		$instance['menu'] 	= $new_instance['menu'];
		return $instance;  /// return new value of parametrs		
	}

	/* admin page opions */
	function form($instance) {
		$defaults = array( 
			'title' 				=> '',
			'menu' 					=> '0',
			'theme' 				=> '0',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$themes=$this->get_themes();
		$menus=$this->get_menus();
		?> 
        <p class="flb_field">
          <label for="title">Title:</label>
          <br>
          <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat">
        </p>
        
        <p class="flb_field">  
			<select style="width: 100%" id="<?php echo $this->get_field_id('menu'); ?>" name="<?php echo $this->get_field_name('menu'); ?>">
				<option value="0">Select Menu</option>
				<?php foreach($menus as $value){
					echo "<option ".selected($value['term_id'],$instance['menu'],false)." value=\"".$value['term_id']."\">".$value['name']."</option>";
				} ?>
			</select>  
            <a target="_blank" style="text-decoration: none; color: #5b9dd9; font-size: 14px;" href="<?php echo get_admin_url().'nav-menus.php'  ?>">(Add new Menu)</a>   
        </p>
        
        <p class="flb_field">  
			<select style="width: 100%" id="<?php echo $this->get_field_id('theme'); ?>" name="<?php echo $this->get_field_name('theme'); ?>">
				<option value="0">Select Theme</option>
				<?php foreach($themes as $id => $name){
					echo "<option ".selected($id,$instance['theme'],false)." value=\"".$id."\">".$name."</option>";
				} ?>
			</select>  
      		<a target="_blank" style="text-decoration: none; color: #5b9dd9; font-size: 14px;" href="<?php echo get_admin_url().'admin.php?page=wpda_vertical_menu_themes'  ?>">(Add new Theme)</a> 
        </p>
          
        
		<?php 
	}
	
	// return array timers ids and names
	private function get_menus(){
		$vertical_menus=wp_get_nav_menus();
		$finnaly_menu=array();
		$counter=0;
		foreach($vertical_menus as $key => $value){			
			$finnaly_menu[$counter]["term_id"]=$value->term_id;
			$finnaly_menu[$counter]["name"]=$value->name;
			$counter++;
		}
		return $finnaly_menu;
	}
	
	// return array theme ids and names
	private function get_themes(){
		global $wpdb;
		$thems=array();
		$query = "SELECT `id`,`name` FROM ".wpda_vertical_menu_databese::$table_names['theme'];
		$rows=$wpdb->get_results($query,ARRAY_A);
		foreach($rows as $value){
			$thems[$value["id"]]=$value["name"];
		}
		return $thems;
	}
}
