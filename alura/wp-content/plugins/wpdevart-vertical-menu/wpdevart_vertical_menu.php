<?php
/*
* Plugin Name: Wpdevart vertical menu
* Plugin URI: https://wpdevart.com/wordpress-vertical-menu-plugin/
* Description: WordPress Responsive Vertical menu plugin is an nice and simple plugin for showing your menu in widget. It's very simple to use and allow users to display menu icons.
* Version: 1.1.4
* Author: wpdevart
* Author URI: https://wpdevart.com 
* License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

class wpda_vertical_menu{
	
	function __construct(){			
		$this->define_constants();
		// include files 
		$this->include_files();
		// call filters for plugin
		$this->call_base_filters();
		// crate admin panel	
		$this->databese = new wpda_vertical_menu_databese();
		// crate admin
		$this->create_admin();
		// crate front end
		$this->front_end();		
	}	
	
             /*#################### Admin function ########################*/	
	
	private function create_admin(){
		// create admin menu		
		$this->admin_menu = new wpda_vertical_menu_admin_panel();		
	}

             /*#################### Front end function ########################*/
			 
	public function front_end(){
		// create front end	
		$wpda_vertical_menu_end = new wpdevart_vertical_menu_frontend();	
	}

    /*###################### Required scripts function ##################*/	
	
	public function registr_requeried_scripts(){		
		wp_register_style('FontAwesome_5',wpda_vertical_menu_plugin_url.'includes/fonts/css/fontawesome-all.min.css');
	}

    /*###################### Base filters function ##################*/	
	
	private function call_base_filters(){
		register_activation_hook( __FILE__, array($this,'install_databese') );
		add_action('init',  array($this,'registr_requeried_scripts') );
		add_action('widgets_init', array($this,"vertical_menu_widget"));
	}
	public function vertical_menu_widget(){
		return register_widget("wpdevart_vertical_menu_widget");
	}
    /*###################### Constants function ##################*/
	
  	private function define_constants(){
		 define('wpda_vertical_menu_plugin_url',trailingslashit( plugins_url('', __FILE__ ) ));
		 define('wpda_vertical_menu_plugin_path',trailingslashit( plugin_dir_path( __FILE__ ) ));
		 define('wpda_vertical_menu_support_url',"https://wordpress.org/support/plugin/wpdevart-vertical-menu/");
		
	}

    /*###################### Include files function ##################*/
	
	private function include_files(){		
		require_once(wpda_vertical_menu_plugin_path.'includes/wpdevart_library.php'); 
		require_once(wpda_vertical_menu_plugin_path.'includes/install_databese.php');
		require_once(wpda_vertical_menu_plugin_path.'includes/admin/theme_page.php');
		require_once(wpda_vertical_menu_plugin_path.'includes/admin/admin.php'); 
		require_once(wpda_vertical_menu_plugin_path.'includes/frontend/front_end.php');
		require_once(wpda_vertical_menu_plugin_path.'includes/frontend/classes.php');
		require_once(wpda_vertical_menu_plugin_path.'includes/wpdevart_widget.php');
	}	
	public function install_databese(){
		// new class for installing databese
		$this->databese->install_theme_tabel();
	}
}
$wpda_vertical_menu = new wpda_vertical_menu();
?>