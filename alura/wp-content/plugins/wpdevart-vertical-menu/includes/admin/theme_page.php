<?php
class wpda_vertical_menu_theme_page{
	
	private $options;
	
	function __construct(){		
		$this->options=self::return_params_array();					
	}

    /*###################### Return parameters function ##################*/	
	
	public static function return_params_array(){	
		return array(
			"vertical_menu_general"=>array(
				"heading_name"=>"General Settings",
				"params"=>array(					
					"open_menu_on"=>array(
						"title"=>"Submenu opening type",
						"description"=>"Select when to display the submenu",				
						"function_name"=>"simple_select",
						"values"=>array("click"=>"Click","hover"=>"Hover"),
						"default_value"=>"click",
					),
					"open_duration"=>array(
						"title"=>"Submenu opening duration",
						"description"=>"Type the submenu opening duration",				
						"function_name"=>"simple_input",
						"type"=>"number",
						"small_text"=>"(milliseconds)",
						"default_value"=>"400",
					),	
					"click_image_action"=>array(
						"title"=>"Menu icon function when clicking on it",
						"description"=>"Choose the menu icon function when clicking on it",				
						"function_name"=>"simple_select",
						"values"=>array("go_to_link"=>"Go to link","open_submenu"=>"Open submenu"),
						"default_value"=>"go_to_link",
					),
					"submenu_opened_type"=>array(
						"title"=>"When to display the Submenu ?",
						"description"=>"Choose when plugin should display the Submenu",				
						"function_name"=>"simple_select",
						"values"=>array("always_closed"=>"Don't display","when_subemnu_item_active"=>"When submenu item is active","always_opened"=>"Always display"),
						"default_value"=>"always_closed",
					)			
				)
			),
			"menu_styles"=>array(
				"heading_name"=>"Main(Parent) menu style <span class='pro_feature'>(pro)</span>",
				"params"=>array(	
					"padding"=>array(
						"title"=>"Padding",
						"description"=>"Type the padding parameters",				
						"function_name"=>"input_extended",
						"default_value"=>array("top"=>"5","right"=>"0","bottom"=>"5","left"=>"15"),
						"labels"=>array("top"=>"top(px)","right"=>"right(px)","bottom"=>"bottom(px)","left"=>"left(px)"),
						"pro"=>true,
					),
					"image_sizes"=>array(
						"title"=>"Menu icon size",
						"description"=>"Type the Menu icon size",				
						"function_name"=>"input_extended",
						"default_value"=>array("width"=>"40","height"=>"40"),
						"labels"=>array("width"=>"width(px)","height"=>"height(px)"),
						"pro"=>true,
					),
					"image_margin"=>array(
						"title"=>"Menu icon margin",
						"description"=>"Type the Menu icon margin",				
						"function_name"=>"input_extended",
						"default_value"=>array("top"=>"0","right"=>"5","bottom"=>"0","left"=>"0"),
						"labels"=>array("top"=>"top(px)","right"=>"right(px)","bottom"=>"bottom(px)","left"=>"left(px)"),
						"pro"=>true,		
					),
					"background_color"=>array(
						"title"=>"Background color",
						"description"=>"Select the Background color",				
						"function_name"=>"gradient_color_input",
						"default_value"=>array("color1"=>"#ffffff","color2"=>"#ffffff","gradient"=>"none"),
						"pro"=>true,
					),
					"font_size"=>array(
						"title"=>"Font size",
						"description"=>"Type the Font size",				
						"function_name"=>"simple_input",
						"type"=>"number",
						"default_value"=>"18",
						"pro"=>true,
					),	
					"font_family"=>array(
						"title"=>"Font family",
						"description"=>"Choose the Font family",				
						"function_name"=>"font_select",
						"values"=>wpda_vertical_menu_library::fonts_select(),
						"default_value"=>"monospace",
						"pro"=>true,
					),
					"font_style"=>array(
						"title"=>"Font style",
						"description"=>"Select the Font style",				
						"function_name"=>"simple_select",
						"values"=>array("normal"=>"Normal","bold"=>"Bold","italic"=>"Italic","underline"=>"Underline","bold italic"=>"Bold Italic","bold underline"=>"Bold Underline","italic underline"=>"Italic Underline","bold italic underline"=>"Bold Italic Underline"),
						"default_value"=>"normal",
						"pro"=>true,
					),
					"text_color"=>array(
						"title"=>"Text color",
						"description"=>"Choose the Text color",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"background_color_hover"=>array(
						"title"=>"Background color when hovering",
						"description"=>"Choose the Background color when hovering",				
						"function_name"=>"gradient_color_input",
						"default_value"=>array("color1"=>"#ffffff","color2"=>"#ffffff","gradient"=>"none"),
						"pro"=>true,
					),
					"font_size_hover"=>array(
						"title"=>"Font size when hovering",
						"description"=>"Type the Font size when hovering",				
						"function_name"=>"simple_input",
						"type"=>"number",
						"default_value"=>"18",
						"pro"=>true,
					),	
					"font_family_hover"=>array(
						"title"=>"Font family when hovering",
						"description"=>"Select the Font family when hovering",				
						"function_name"=>"font_select",
						"values"=>wpda_vertical_menu_library::fonts_select(),
						"default_value"=>"monospace",
						"pro"=>true,
					),
					"font_style_hover"=>array(
						"title"=>"Font style when hovering",
						"description"=>"Select the Font style when hovering",				
						"function_name"=>"simple_select",
						"values"=>array("normal"=>"Normal","bold"=>"Bold","italic"=>"Italic","underline"=>"Underline","bold italic"=>"Bold Italic","bold underline"=>"Bold Underline","italic underline"=>"Italic Underline","bold italic underline"=>"Bold Italic Underline"),
						"default_value"=>"normal",
						"pro"=>true,
					),
					"text_color_hover"=>array(
						"title"=>"Text color when hovering",
						"description"=>"Choose the Text color when hovering",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"background_color_active"=>array(
						"title"=>"Active menu Background color",
						"description"=>"Select the active menu Background",				
						"function_name"=>"gradient_color_input",
						"default_value"=>array("color1"=>"#ffffff","color2"=>"#ffffff","gradient"=>"none"),
						"pro"=>true,
					),
					"font_size_active"=>array(
						"title"=>"Active menu Font size",
						"description"=>"Type the active menu Font size",				
						"function_name"=>"simple_input",
						"type"=>"number",
						"default_value"=>"18",
						"pro"=>true,
					),	
					"font_family_active"=>array(
						"title"=>"Active menu Font family",
						"description"=>"Select the active menu Font family",				
						"function_name"=>"font_select",
						"values"=>wpda_vertical_menu_library::fonts_select(),
						"default_value"=>"monospace",
						"pro"=>true,
					),
					"font_style_active"=>array(
						"title"=>"Active menu Font style",
						"description"=>"Select the active menu Font style",				
						"function_name"=>"simple_select",
						"values"=>array("normal"=>"Normal","bold"=>"Bold","italic"=>"Italic","underline"=>"Underline","bold italic"=>"Bold Italic","bold underline"=>"Bold Underline","italic underline"=>"Italic Underline","bold italic underline"=>"Bold Italic Underline"),
						"default_value"=>"normal",
						"pro"=>true,
					),
					"text_color_active"=>array(
						"title"=>"Active menu Text color",
						"description"=>"Select the active menu Text color",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"border_width"=>array(
						"title"=>"Border width",
						"description"=>"Type the Border width",				
						"function_name"=>"input_extended",
						"default_value"=>array("top"=>"0","right"=>"0","bottom"=>"1","left"=>"0"),
						"labels"=>array("top"=>"top(px)","right"=>"right(px)","bottom"=>"bottom(px)","left"=>"left(px)"),
						"pro"=>true,
					),
					"border_color"=>array(
						"title"=>"Border color",
						"description"=>"Select the Border color",				
						"function_name"=>"color_input_extended",
						"default_value"=>array("top"=>"#ffffff","right"=>"#ffffff","bottom"=>"#000000","left"=>"#ffffff"),
						"labels"=>array("top"=>"top","right"=>"right","bottom"=>"bottom","left"=>"left"),
						"pro"=>true,
					),
					"border_color_hover"=>array(
						"title"=>"Border color when hovering",
						"description"=>"Select the Border color when hovering",				
						"function_name"=>"color_input_extended",
						"default_value"=>array("top"=>"#ffffff","right"=>"#ffffff","bottom"=>"#000000","left"=>"#ffffff"),
						"labels"=>array("top"=>"top","right"=>"right","bottom"=>"bottom","left"=>"left"),
						"pro"=>true,
					),
					"border_color_active"=>array(
						"title"=>"Active menu Border color",
						"description"=>"Select the active menu Border color",				
						"function_name"=>"color_input_extended",
						"default_value"=>array("top"=>"#ffffff","right"=>"#ffffff","bottom"=>"#000000","left"=>"#ffffff"),
						"labels"=>array("top"=>"top","right"=>"right","bottom"=>"bottom","left"=>"left"),
						"pro"=>true,
					),	
					"open_icon"=>array(
						"title"=>"Icon class for opening Sub menu",
						"description"=>"Use this link and choose the icon you need, then copy the class of selected icon(below icon) and paste it into this field",				
						"function_name"=>"simple_input",
						"type"=>"text",
						"default_value"=>"fas fa-angle-right",
						"small_text"=>"<a style='text-decoration:none' target='_blank' href='https://fontawesome.com/icons?d=gallery&m=free'>Go to choose the icon</a>",
						"pro"=>true,
					),	
					"close_icon"=>array(
						"title"=>"Icon class for closing Sub menu",
						"description"=>"Use this link and choose the icon you need, then copy the class of selected icon(below icon) and paste it into this field",				
						"function_name"=>"simple_input",
						"type"=>"text",
						"default_value"=>"fas fa-angle-down",
						"small_text"=>"<a style='text-decoration:none' target='_blank' href='https://fontawesome.com/icons?d=gallery&m=free'>Go to choose the icon</a>",
						"pro"=>true,
					),
					"open_icon_color"=>array(
						"title"=>"Sub menu opening icon color",
						"description"=>"Select the Sub menu opening icon color",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"open_icon_color_hover"=>array(
						"title"=>"Sub menu opening icon color when hovering",
						"description"=>"Select the Sub menu opening icon color when hovering",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"close_icon_color"=>array(
						"title"=>"Sub menu closing icon color",
						"description"=>"Select the Sub menu closing icon color",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"close_icon_color_hover"=>array(
						"title"=>"Sub menu closing icon color when hovering",
						"description"=>"Select the Sub menu closing icon color when hovering",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"icon_size"=>array(
						"title"=>"Sub menu icons size",
						"description"=>"Type the Sub menu icons size",				
						"function_name"=>"simple_input",
						"type"=>"number",
						"default_value"=>"18",
						"pro"=>true,
					),
			
					"open_icon_padding"=>array(
						"title"=>"Sub menu opening icon padding",
						"description"=>"Type the Sub menu opening icon padding",				
						"function_name"=>"input_extended",
						"default_value"=>array("top"=>"0","right"=>"0","bottom"=>"0","left"=>"0"),
						"labels"=>array("top"=>"top(px)","right"=>"right(px)","bottom"=>"bottom(px)","left"=>"left(px)"),
						"pro"=>true,
					),
					"close_icon_padding"=>array(
						"title"=>"Sub menu closing icon padding",
						"description"=>"Type the Sub menu closing icon padding",				
						"function_name"=>"input_extended",
						"default_value"=>array("top"=>"0","right"=>"0","bottom"=>"1","left"=>"0"),
						"labels"=>array("top"=>"top(px)","right"=>"right(px)","bottom"=>"bottom(px)","left"=>"left(px)"),
						"pro"=>true,
					),
				),
			),	
			"submenumenu_styles"=>array(
				"heading_name"=>"Sub Menu Styles <span class='pro_feature'>(pro)</span>",
				"params"=>array(	
					"submenu_padding"=>array(
						"title"=>"Padding",
						"description"=>"Type the padding parameters",				
						"function_name"=>"input_extended",
						"default_value"=>array("top"=>"0","right"=>"0","bottom"=>"0","left"=>"10"),
						"labels"=>array("top"=>"top(px)","right"=>"right(px)","bottom"=>"bottom(px)","left"=>"left(px)"),
						"pro"=>true,
					),
					"submenu_background_color"=>array(
						"title"=>"Background color",
						"description"=>"Select the Background color",				
						"function_name"=>"gradient_color_input",
						"default_value"=>array("color1"=>"#ffffff","color2"=>"#ffffff","gradient"=>"none"),
						"pro"=>true,
					),
					"submenu_font_size"=>array(
						"title"=>"Font size",
						"description"=>"Type the Font size",				
						"function_name"=>"simple_input",
						"type"=>"number",
						"default_value"=>"18",
						"pro"=>true,
					),	
					"submenu_font_family"=>array(
						"title"=>"Font family",
						"description"=>"Choose the Font family",				
						"function_name"=>"font_select",
						"values"=>wpda_vertical_menu_library::fonts_select(),
						"default_value"=>"monospace",
						"pro"=>true,
					),
					"submenu_font_style"=>array(
						"title"=>"Font style",
						"description"=>"Select the Font style",				
						"function_name"=>"simple_select",
						"values"=>array("normal"=>"Normal","bold"=>"Bold","italic"=>"Italic","underline"=>"Underline","bold italic"=>"Bold Italic","bold underline"=>"Bold Underline","italic underline"=>"Italic Underline","bold italic underline"=>"Bold Italic Underline"),
						"default_value"=>"normal",
						"pro"=>true,
					),
					"submenu_text_color"=>array(
						"title"=>"Text color",
						"description"=>"Choose the Text color",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"submenu_background_color_hover"=>array(
						"title"=>"Background color when hovering",
						"description"=>"Choose the Background color when hovering",				
						"function_name"=>"gradient_color_input",
						"default_value"=>array("color1"=>"#ffffff","color2"=>"#ffffff","gradient"=>"none"),
						"pro"=>true,
					),
					"submenu_font_size_hover"=>array(
						"title"=>"Font size when hovering",
						"description"=>"Type the Font size when hovering",				
						"function_name"=>"simple_input",
						"type"=>"number",
						"default_value"=>"18",
						"pro"=>true,
					),	
					"submenu_font_family_hover"=>array(
						"title"=>"Font family when hovering",
						"description"=>"Select the Font family when hovering",				
						"function_name"=>"font_select",
						"values"=>wpda_vertical_menu_library::fonts_select(),
						"default_value"=>"monospace",
						"pro"=>true,
					),
					"submenu_font_style_hover"=>array(
						"title"=>"Font style when hovering",
						"description"=>"Select the Font style when hovering",				
						"function_name"=>"simple_select",
						"values"=>array("normal"=>"Normal","bold"=>"Bold","italic"=>"Italic","underline"=>"Underline","bold italic"=>"Bold Italic","bold underline"=>"Bold Underline","italic underline"=>"Italic Underline","bold italic underline"=>"Bold Italic Underline"),
						"default_value"=>"normal",
						"pro"=>true,
					),
					"submenu_text_color_hover"=>array(
						"title"=>"Text color when hovering",
						"description"=>"Choose the Text color when hovering",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"submenu_background_color_active"=>array(
						"title"=>"Active menu Background color",
						"description"=>"Select the active menu Background",				
						"function_name"=>"gradient_color_input",
						"default_value"=>array("color1"=>"#ffffff","color2"=>"#ffffff","gradient"=>"none"),
						"pro"=>true,
					),
					"submenu_font_size_active"=>array(
						"title"=>"Active menu Font size",
						"description"=>"Type the active menu Font size",				
						"function_name"=>"simple_input",
						"type"=>"number",
						"default_value"=>"18",
						"pro"=>true,
					),	
					"submenu_font_family_active"=>array(
						"title"=>"Active menu Font family",
						"description"=>"Select the active menu Font family",				
						"function_name"=>"font_select",
						"values"=>wpda_vertical_menu_library::fonts_select(),
						"default_value"=>"monospace",
						"pro"=>true,
					),
					"submenu_font_style_active"=>array(
						"title"=>"Active menu Font style",
						"description"=>"Select the active menu Font style",				
						"function_name"=>"simple_select",
						"values"=>array("normal"=>"Normal","bold"=>"Bold","italic"=>"Italic","underline"=>"Underline","bold italic"=>"Bold Italic","bold underline"=>"Bold Underline","italic underline"=>"Italic Underline","bold italic underline"=>"Bold Italic Underline"),
						"default_value"=>"normal",
						"pro"=>true,
					),
					"submenu_text_color_active"=>array(
						"title"=>"Active menu Text color",
						"description"=>"Select the active menu Text color",				
						"function_name"=>"color_input",
						"default_value"=>"#000000",
						"pro"=>true,
					),
					"submenu_border_width"=>array(
						"title"=>"Border width",
						"description"=>"Type the Border width",				
						"function_name"=>"input_extended",
						"default_value"=>array("top"=>"0","right"=>"0","bottom"=>"1","left"=>"0"),
						"labels"=>array("top"=>"top(px)","right"=>"right(px)","bottom"=>"bottom(px)","left"=>"left(px)"),
						"pro"=>true,
					),
					"submenu_border_color"=>array(
						"title"=>"Border color",
						"description"=>"Select the Border color",				
						"function_name"=>"color_input_extended",
						"default_value"=>array("top"=>"#ffffff","right"=>"#ffffff","bottom"=>"#000000","left"=>"#ffffff"),
						"labels"=>array("top"=>"top","right"=>"right","bottom"=>"bottom","left"=>"left"),
						"pro"=>true,
					),
					"submenu_border_color_hover"=>array(
						"title"=>"Border color when hovering",
						"description"=>"Select the Border color when hovering",				
						"function_name"=>"color_input_extended",
						"default_value"=>array("top"=>"#ffffff","right"=>"#ffffff","bottom"=>"#000000","left"=>"#ffffff"),
						"labels"=>array("top"=>"top","right"=>"right","bottom"=>"bottom","left"=>"left"),
						"pro"=>true,
					),
					"submenu_border_color_active"=>array(
						"title"=>"Active menu Border color",
						"description"=>"Select the active menu Border color",				
						"function_name"=>"color_input_extended",
						"default_value"=>array("top"=>"#ffffff","right"=>"#ffffff","bottom"=>"#000000","left"=>"#ffffff"),
						"labels"=>array("top"=>"top","right"=>"right","bottom"=>"bottom","left"=>"left"),
						"pro"=>true,
					),
				),
			),
		);
	}
	public static function get_default_values_array(){
		$array_of_returned=array();
		$options=self::return_params_array();
		foreach($options as $param_heading_key=>$param_heading_value){
			foreach($param_heading_value['params'] as $key=>$value){
				$array_of_returned[$key]=$value['default_value'];
			}
		}	
		return $array_of_returned;
	}
	
	public function controller_page(){
		global $wpdb;
		$task="default";
		$id=0;
		if(isset($_GET["task"])){
			$task=$_GET["task"];
		}
		if(isset($_GET["id"])){
			$id=$_GET["id"];
		}		
		switch($task){
		case 'add_wpda_vertical_menu_theme':	
			$this->add_edit_theme($id);
			break;
			
		case 'add_edit_theme':	
			$this->add_edit_theme($id);
			break;
		
		case 'save_theme':		
			if($id)	
				$this->update_theme($id);
			else
				$this->save_theme();
				
			$this->display_table_list_theme();	
			break;
			
			
		case 'update_theme':		
			if($id){
				$this->update_theme($id);
			}else{
				$this->save_theme();
				$_GET['id']=$wpdb->get_var("SELECT MAX(id) FROM ".wpda_vertical_menu_databese::$table_names['theme']);
				$id=$_GET['id'];
			}
			$this->add_edit_theme($id);
			break;
		case 'set_default_theme':
			$this->set_default_theme($id);
			$this->display_table_list_theme();	
		break;
		case 'remove_theme':	
			$this->remove_theme($id);
			$this->display_table_list_theme();
			break;				
		default:
			$this->display_table_list_theme();
		}
	}
	
/*############  Save function  ################*/
	
	private function save_theme(){
		
		
		global $wpdb;
		if(count($_POST)==0)
			return;		
		$params_array=array();
		if(isset($_POST['name']) && $_POST['name']!=""){
			$name=sanitize_text_field($_POST['name']);
		}else{
			$name="Unnamed";
		}
		
		$params_array=array('name'=>sanitize_text_field($name));
		foreach($this->options as $param_heading_key=>$param_heading_value){
			foreach($param_heading_value['params'] as $key=>$value){
				if(isset($_POST[$key])){					
					$params_array[$key]=wpda_vertical_menu_library::sanitize_value_by_function_name($value["function_name"],$_POST[$key]);
				}else{
					$params_array[$key]=$value['default_value'];
				}
			}
		}	
		$save_or_no=$wpdb->insert( wpda_vertical_menu_databese::$table_names['theme'], 
			array( 
				'name' => $name,
				'option_value' => json_encode($params_array),
			), 
			array( 
				'%s', 
				'%s',
			) 
		);
		if($save_or_no){
			?><div class="updated"><p><strong>Item Saved</strong></p></div><?php
		}
		else{
			?><div id="message" class="error"><p>Error please reinstall plugin</p></div> <?php
		}
	}
	
/*############  Update theme ID function  ################*/
	
	private function update_theme($id){
		global $wpdb;
		if(count($_POST)==0)
			return;
		$params_array=array();
		if(isset($_POST['name'])){
			$name=sanitize_text_field($_POST['name']);
		}else{
			$name="theme";
		}
		$params_array=array('name'=>sanitize_text_field($name));
		foreach($this->options as $param_heading_key=>$param_heading_value){
			foreach($param_heading_value['params'] as $key=>$value){
				if(isset($_POST[$key])){					
					$params_array[$key]=wpda_vertical_menu_library::sanitize_value_by_function_name($value["function_name"],$_POST[$key]);
				}else{
					$params_array[$key]=$value['default_value'];
				}
			}
		}		
		$wpdb->update( wpda_vertical_menu_databese::$table_names['theme'], 
			array( 
				'name' => $name,
				'option_value' => json_encode($params_array),
			), 
			array( 
				'id'=>$id 
			),
			array( 
				'%s', 
				'%s'
			),
			array( 
				'%d'
			)  
		);
		
		?><div class="updated"><p><strong>Item Saved</strong></p></div><?php
		
	}
	
	
	private function remove_theme($id){
		global $wpdb;
		$default_theme = $wpdb->get_var($wpdb->prepare('SELECT `default` FROM ' . wpda_vertical_menu_databese::$table_names['theme'].' WHERE id="%d"', $id));
		if (!$default_theme) {
			$wpdb->query($wpdb->prepare('DELETE FROM ' . wpda_vertical_menu_databese::$table_names['theme'].' WHERE id="%d"', $id));
		}
		else{
			?><div id="message" class="error"><p>You cannot remove default theme</p></div> <?php
		}
	}
	
	private function display_table_list_theme(){
		
		?>
        <style>
        .description_row:nth-child(odd){
			background-color: #f9f9f9;
		}
		
        </style>
        <script> var my_table_list=<?php echo $this->generete_jsone_list(); ?></script>
        <div class="wrap">
			<div class="wpdevart_plugins_header div-for-clear">
				<div class="wpdevart_plugins_get_pro div-for-clear">
					<div class="wpdevart_plugins_get_pro_info">
						<h3>WpDevArt Vertical Menu Premium</h3>
						<p>Powerful and Customizable Vertical Menu</p>
					</div>
						<a target="blank" href="http://wpdevart.com/wordpress-vertical-menu-plugin/" class="wpdevart_upgrade">Upgrade</a>
				</div>
				<a target="blank" href="<?php echo wpda_vertical_menu_support_url; ?>" class="wpdevart_support">Have any Questions? Get quick support!</a>
			</div>
            <form method="post"  action="" id="admin_form" name="admin_form" ng-app="" ng-controller="customersController">
			<h2>Theme <a href="admin.php?page=wpda_vertical_menu_themes&task=add_wpda_vertical_menu_theme" class="add-new-h2">Add New</a></h2>            
   
            <div class="tablenav top">  
                <input type="text" placeholder="Search" ng-change="filtering_table();" ng-model="searchText">            
                <div class="tablenav-pages"><span class="displaying-num">{{filtering_table().length}} items</span>
                <span ng-show="(numberOfPages()-1)>=1">
                    <span class="pagination-links"><a class="first-page" ng-class="{disabled:(curPage < 1 )}" title="Go to the first page" ng-click="curPage=0">«</a>
                    <a class="prev-page" title="Go to the previous page" ng-class="{disabled:(curPage < 1 )}" ng-click="curPage=curPage-1; curect()">‹</a>
                    <span class="paging-input"><span class="total-pages">{{curPage + 1}}</span> of <span class="total-pages">{{ numberOfPages() }}</span></span>
                    <a class="next-page" title="Go to the next page" ng-class="{disabled:(curPage >= (numberOfPages() - 1))}" ng-click=" curPage=curPage+1; curect()">›</a>
                    <a class="last-page" title="Go to the last page" ng-class="{disabled:(curPage >= (numberOfPages() - 1))}" ng-click="curPage=numberOfPages()-1">»</a></span></div>
                </span>
            </div>
            <table class="wp-list-table widefat fixed pages">
                <thead>
                    <tr>
                        <th style="width: 100px;" id='oreder_by_id' data-ng-click="order_by='id'; reverse=!reverse; ordering($event,order_by,reverse);" class="manage-column sortable desc" scope="col"><a><span>ID</span><span class="sorting-indicator"></span></a></th>
                        <th data-ng-click="order_by='name'; reverse=!reverse; ordering($event,order_by,reverse)" class="manage-column sortable desc"><a><span>Name</span><span class="sorting-indicator"></span></a></th>
                        <th style="width:100px"><a>Default</span></a></th>
                        <th style="width:80px">Edit</th>                        
                        <th  style="width:80px">Delete</th>
                    </tr>
                </thead>
                <tbody>
                 <tr ng-repeat="rows in names | filter:filtering_table" class="description_row">
					 <td>{{rows.id}}</td>
					 <td><a href="admin.php?page=wpda_vertical_menu_themes&task=add_edit_theme&id={{rows.id}}">{{rows.name}}</a></td>
					 <td><a href="admin.php?page=wpda_vertical_menu_themes&task=set_default_theme&id={{rows.id}}"><img src="<?php echo wpda_vertical_menu_plugin_url.'includes/admin/images/default' ?>{{rows.default}}.png"></a></td>
					 <td><a href="admin.php?page=wpda_vertical_menu_themes&task=add_edit_theme&id={{rows.id}}">Edit</a></td>
					 <td><a href="admin.php?page=wpda_vertical_menu_themes&task=remove_theme&id={{rows.id}}">Delete</a></td>                               
                  </tr> 
                </tbody>
            </table>
        </form>
        </div>
    <script>

jQuery(document).ready(function(e) {
    jQuery('a.disabled').click(function(){return false});
	jQuery('form').on("keyup keypress", function(e) {
		var code = e.keyCode || e.which; 
		if (code  == 13) {               
			e.preventDefault();
			return false;
		}
	});
});
    function customersController($scope,$filter) {
		var orderBy = $filter('orderBy');
		$scope.previsu_search_result='';
		$scope.oredering=new Array();
		$scope.baza = my_table_list;
		$scope.curPage = 0;
		$scope.pageSize = 20;
		$scope.names=$scope.baza.slice( $scope.curPage* $scope.pageSize,( $scope.curPage+1)* $scope.pageSize)
		$scope.numberOfPages = function(){
		   return Math.ceil($scope.filtering_table().length / $scope.pageSize);
	   };
	   $scope.filtering_table=function(){
		   var new_searched_date_array=new Array;
		   new_searched_date_array=[];
		   angular.forEach($scope.baza,function(value,key){
			   var catched=0;
			   angular.forEach(value,function(value_loc,key_loc){
				   if((''+value_loc).indexOf($scope.searchText)!=-1 || $scope.searchText=='' || typeof($scope.searchText) == 'undefined')
					  catched=1;
			   })
			  if(catched)
				  new_searched_date_array.push(value);
		   })
		   if($scope.previsu_search_result != $scope.searchText){
			  
			  $scope.previsu_search_result=$scope.searchText;
			   $scope.ordering($scope.oredering[0],$scope.oredering[1], $scope.oredering[2]);
			   
		   }
		   if(new_searched_date_array.length<=$scope.pageSize)
		   		$scope.curPage = 0;
		   return new_searched_date_array;
	   }
	   $scope.curect=function(){
		   if( $scope.curPage<0){
				$scope.curPage=0;
		   }
		   if( $scope.curPage> $scope.numberOfPages()-1)
			   $scope.curPage=$scope.numberOfPages()-1;
		  $scope.names=$scope.filtering_table().slice( $scope.curPage* $scope.pageSize,( $scope.curPage+1)* $scope.pageSize)
	   }
		
		$scope.ordering=function($event,order_by,revers){
		   if( typeof($event) != 'undefined' && typeof($event.currentTarget) != 'undefined')
		   		element=$event.currentTarget;
			else
				element=jQuery();
		   
			if(revers)
			  indicator='asc'
			else
			  indicator='desc'
			 $scope.oredering[0]=$event;
			 $scope.oredering[1]=order_by;
			 $scope.oredering[2]=revers;
			jQuery(element).parent().find('.manage-column').removeClass('sortable desc asc sorted');
			jQuery(element).parent().find('.manage-column').not(element).addClass('sortable desc');
			jQuery(element).addClass('sorted '+indicator);		  
			$scope.names=orderBy($scope.filtering_table(),order_by,revers).slice( $scope.curPage* $scope.pageSize,( $scope.curPage+1)* $scope.pageSize)
		}
	}
    </script>
		<?php
		$this->generete_jsone_list();
	}
	private function generete_jsone_list(){
		global $wpdb;
		$query = "SELECT `id`,`name`,`default` FROM ".wpda_vertical_menu_databese::$table_names['theme'];
		$rows=$wpdb->get_results($query);
		$json="[";
		$no_frst_storaket=1;
		foreach($rows as $row){
			$json.=(($no_frst_storaket) ? '' : ',' )."{";
			$no_frst_storaket=1;
			foreach($row as $key=>$value){
				if($key!='id'){
					$json.= "".(($no_frst_storaket) ? '' : ',' )."'".$key."':"."'".(($value)?preg_replace('/^\s+|\n|\r|\s+$/m', '',htmlspecialchars_decode(addslashes(strip_tags($value)))):'0')."'";				
				}
				else{					
					$json.= "".(($no_frst_storaket) ? '' : ',' )."'".$key."':".(($value)?htmlspecialchars_decode(addslashes($value)):'0'); 
				}
				
				$no_frst_storaket=0;
			 }			 
			 $json.="}";
		}
		$json.="]";
		return $json;
	}	
	
	private function generete_theme_parametrs($id=0){
		global $wpdb;	
		$theme_params = NULL;
		$new_theme=1;
		if($id){
			$theme_params = $wpdb->get_row('SELECT * FROM '.wpda_vertical_menu_databese::$table_names['theme'].' WHERE id='.$id);	
			$new_theme=0;
		}else{
			$theme_params = $wpdb->get_row('SELECT * FROM '.wpda_vertical_menu_databese::$table_names['theme'].' WHERE `default`=1');				
		}
		if($theme_params==NULL){			
			foreach($this->options as $param_heading_key=>$param_heading_value){
				foreach($param_heading_value['params'] as $key=>$value){
					$this->options[$param_heading_key]['params'][$key]["value"]=$this->options[$param_heading_key]['params'][$key]["default_value"];
				}
			}
		}else{
			$databases_parametrs=json_decode($theme_params->option_value, true);
			foreach($this->options as $param_heading_key=>$param_heading_value){
				foreach($param_heading_value['params'] as $key=>$value){
					if(isset($databases_parametrs[$key])){
						$this->options[$param_heading_key]['params'][$key]["value"]=$databases_parametrs[$key];
					}else{
						$this->options[$param_heading_key]['params'][$key]["value"]=$this->options[$param_heading_key]['params'][$key]["default_value"];
					}
				}
			}
			if($new_theme){
				return "New Theme";
			}else{
				return $theme_params->name;
			}
		}
	}
	
	
	private function add_edit_theme($id=0){
		global $wpdb;
		$name=$this->generete_theme_parametrs($id);
		?>		         
		<form action="admin.php?page=wpda_vertical_menu_themes<?php if($id) echo '&id='.$id; ?>" method="post" name="adminForm" class="top_description_table" id="adminForm">
            <div class="conteiner">
                <div class="header">
                    <span><h2 class="wpda_theme_title"><?php echo $id?"Edit":"Add" ?> Theme <a target="_blank" class="upgrate_pro_link" href="http://wpdevart.com/wordpress-vertical-menu-plugin/"><span class="pro_feature"> (Upgrade to Pro Version)</span></a></h2></span>
                    <div class="header_action_buttons">
                        <span><input type="button" onclick="submitbutton('save_theme')" value="Save" class="button-primary action"> </span> 
                        <span><input type="button" onclick="submitbutton('update_theme')" value="Apply" class="button-primary action"> </span> 
                        <span><input type="button" onclick="window.location.href='admin.php?page=wpda_vertical_menu_themes'" value="Cancel" class="button-secondary action"> </span> 
                    </div>
                </div>
                <div class="option_panel">            
                    <div class="parametr_name"></div>
                    <div class="all_options_panel">
                        <input type="text" class="theme_name" name="name" placeholder="Enter name here" value="<?php echo isset($name)?$name:'' ?>" >
                        <div class="wpda_theme_link_tabs">
							<?php
								echo "<ul>";
								foreach($this->options as $params_grup_name =>$params_group_value){ 
									echo '<li id="'.$params_grup_name.'_tab">'.$params_group_value['heading_name'].'</li>';
								}
								echo "</ul>";
							?>
						</div>
                        <table>
						<?php 
						foreach($this->options as $params_grup_name =>$params_group_value){ 
							wpda_vertical_menu_library::create_table_heading($params_group_value['heading_name'],$params_grup_name);
							foreach($params_group_value['params'] as $param_name => $param_value){
								$args=array(
									"name"=>$param_name,
									"heading_name"=>$params_group_value['heading_name'],
									"heading_group"=>$params_grup_name,
								);
								$args=array_merge($args,$param_value);
								$function_name=$param_value['function_name'];
								wpda_vertical_menu_library::$function_name($args);
							}
						}

						?>
					</table>
                    </div>
                </div>
            </div>
		</form>
		<?php

		 
	}
	private function set_default_theme($id){
		global $wpdb;
		$wpdb->update(wpda_vertical_menu_databese::$table_names['theme'], array('default' => 0), array('default' => 1));
		$save = $wpdb->update(wpda_vertical_menu_databese::$table_names['theme'], array('default' => 1), array('id' => $id));		
	}
	private function border_types(){
		$border_type[ 'dotted' ] = 'dotted';
		$border_type[ 'dashed' ] = 'dashed';
		$border_type[ 'solid' ] = 'solid';
		$border_type[ 'double' ] = 'double';
		$border_type[ 'groove' ] = 'groove';
		$border_type[ 'ridge' ] = 'ridge';
		$border_type[ 'inset' ] = 'inset';	
		$border_type[ 'outset' ] = 'outset';
		return $border_type;
	}
	
	private function select_font_with_label($select_name,$main_value='',$bind=''){
		?>
        
		<select class="wpda_gallselect" name="<?php echo 'parametrs['.$select_name.']'; ?>" id="<?php echo $select_name ?>" >
		<?php
		
		foreach($this->fonts_options() as $key => $value){
			?>
			<option <?php selected($key,$main_value) ?> value="<?php echo $key ?>" ><?php echo $value ?></option>
			<?php 					
		}
		?>
		</select>																

		<?php
	}
	private function select_border_with_label($select_name,$main_value='',$bind=''){
		?>
		<select class="wpda_gallselect" name="<?php echo 'parametrs['.$select_name.']'; ?>" id="<?php echo $select_name ?>" >
		<?php
		
		foreach($this->border_types() as $key => $value){
			?>
			<option <?php selected($key,$main_value) ?> value="<?php echo $key ?>"><?php echo $value ?></option>
			<?php 					
		}
		?>
		</select>																

		<?php
	}
	private function hex2rgba($color, $opacity = false) {

		$default = 'rgba(0,0,0,1)';
		$opacity=$opacity/100;
		if(empty($color))
			  return $default; 
			if ($color[0] == '#' ) {
				$color = substr( $color, 1 );
			}	
			if (strlen($color) == 6) {
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
					return $default;
			}
			$rgb =  array_map('hexdec', $hex);
			if($opacity){
				if(abs($opacity) > 1)
					$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			} else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
			return $output;
	}	
}
 ?>