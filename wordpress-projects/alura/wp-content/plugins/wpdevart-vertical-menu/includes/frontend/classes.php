<?php
/* Clases For wordpress countdown*/
class wpdevart_vertical_menu_frontend_classes{
	public static $counter;	
	private $menu_id=NULL;
	private $theme_parametrs=false;
	
	public function __construct($term_id,$theme_id){	
		if($theme_id)
			$this->generete_theme_parametrs($theme_id);
		if($term_id)
			$this->menu_id=$term_id;
		self::$counter++;	
		
	}

             /*#################### Create menu function ########################*/
			 
	public function create_menu(){
		if($this->theme_parametrs===false){
			return "<span class ='parametrs_error'>Please Set Theme(its required)</span>";
			
		}	
		if($this->menu_id===false){
			return "<span class ='parametrs_error'>Please Set Menu(its required)</span>";
		}	
		echo $this->create_css();
		$this->call_filters();
		echo $this->create_html();
		$this->remove_filters();
		echo $this->create_js();
		
	}
	
	private function create_html(){
		
		$menu_params = array( 
			'menu' => $this->menu_id,
			'container' => 'div',
			'container_class' => '',
			'container_id' => '',
			'menu_class' => 'wpdevart_menu_ul',
			'menu_id' => 'wpdevart_menu_'.self::$counter,
			'echo' => true,
			'fallback_cb' => 'wp_page_menu',
			'before' => '',
			'after' => '',
			'link_before' => '',
			'link_after' => '',
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'item_spacing' => 'preserve',			
			'depth' => 0,
			'walker' => '',
			'theme_location' => ''
		);
		return wp_nav_menu($menu_params);
	}
	
	private function create_js(){
		$curent_menu_options_array=array(
			"open_duration"=>$this->theme_parametrs["open_duration"],
			"open_menu_on"=>$this->theme_parametrs["open_menu_on"],
			"click_image_action"=>$this->theme_parametrs["click_image_action"],
		);		
		$output_js="<script>\r\n";
		$output_js.="var wpdevart_vertical_menu_js_".self::$counter."=".json_encode($curent_menu_options_array)."\r\n";
		$output_js.='document.addEventListener("DOMContentLoaded",function(){'."\r\n";
		$output_js.='jQuery("#wpdevart_menu_'.self::$counter.'").wpdevart_vertical_menu(wpdevart_vertical_menu_js_'.self::$counter.');'."\r\n";
		$output_js.='})'."\r\n";
		$output_js.="</script>";
		return $output_js;
		
	}
	
	private function create_css(){
		$output_style="<style>";
		/*############################ MENU ################################*/
		if($this->theme_parametrs["open_menu_on"]=="hover"){
			$output_style.="#wpdevart_menu_".self::$counter." > li:hover i.wpdevart_close_icon{\r\n";				
				$output_style.="display: inline-block;";
			$output_style.="} \r\n";
			$output_style.="#wpdevart_menu_".self::$counter." > li:hover i.wpdevart_open_icon{\r\n";				
				$output_style.="display: none;";
			$output_style.="} \r\n";
		}
		/*############################ Submenu ################################3*/
		
		if($this->theme_parametrs["submenu_opened_type"]==="when_subemnu_item_active"){
			$output_style.="#wpdevart_menu_".self::$counter." li.current-menu-ancestor ul{\r\n";		
				$output_style.="display:block; \r\n";
			$output_style.="} \r\n";
			$output_style.="#wpdevart_menu_".self::$counter." li.current-menu-ancestor .wpdevart_open_icon{\r\n";		
				$output_style.="display:none; \r\n";
			$output_style.="} \r\n";
			$output_style.="#wpdevart_menu_".self::$counter." li.current-menu-ancestor .wpdevart_close_icon{\r\n";		
				$output_style.="display:block; \r\n";
			$output_style.="} \r\n";
		}
		
		if($this->theme_parametrs["submenu_opened_type"]==="always_opened"){
			$output_style.="#wpdevart_menu_".self::$counter." ul{\r\n";		
				$output_style.="display:block; \r\n";
			$output_style.="} \r\n";
			$output_style.="#wpdevart_menu_".self::$counter." .wpdevart_open_icon{\r\n";		
				$output_style.="display:none; \r\n";
			$output_style.="} \r\n";
			$output_style.="#wpdevart_menu_".self::$counter." .wpdevart_close_icon{\r\n";		
				$output_style.="display:block; \r\n";
			$output_style.="} \r\n";
		}
		$output_style.="</style>";
		return $output_style;
		
	}
	
	/**/
	private function generete_theme_parametrs($theme_id){
		global $wpdb;
		$theme=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".wpda_vertical_menu_databese::$table_names["theme"]." WHERE `id`=%d",$theme_id));
		if($theme==NULL){
			$theme=$wpdb->get_row("SELECT * FROM ".wpda_vertical_menu_databese::$table_names["theme"]." WHERE `default`=1");
		}
		if($theme!=NULL){
			$theme=json_decode($theme->option_value, true);
		}else{
			$theme=array();
		}
		$default_parametrs=wpda_vertical_menu_theme_page::return_params_array();
		foreach($default_parametrs as $param_heading_key=>$param_heading_value){
			foreach($param_heading_value['params'] as $key=>$value){
				if(isset($theme[$key])){					
					$this->theme_parametrs[$key]=$theme[$key];
				}else{
					$this->theme_parametrs[$key]=$value['default_value'];
				}
			}
		}	
	}
	private function call_filters(){
		add_filter("nav_menu_item_args",array($this,"nav_menu_item_args_filter"),10,4);
		add_filter( 'nav_menu_css_class',array($this,"nav_menu_item_classes_filter"),10,4,4);
		add_filter( 'nav_menu_submenu_css_class',array($this,"nav_submenu_item_classes_filter"),10,4);
		add_filter('nav_menu_item_title', array($this, 'menu_title_filter'), 10, 4);		
	}
	private function remove_filters(){
		remove_filter( 'nav_menu_item_args',array($this,"nav_menu_item_args_filter"),10,4 );
		remove_filter( 'nav_menu_css_class',array($this,"nav_menu_item_classes_filter"),10,4,4 );
		remove_filter( 'nav_menu_submenu_css_class',array($this,"nav_submenu_item_classes_filter"),10,4);
		remove_filter( 'nav_menu_item_title',array($this,"menu_title_filter"),10,4);
	}
	public function nav_menu_item_args_filter($args, $item, $depth){
		$before="";
		$after="";
		$image="";
		$open_icon="";
		$close_icon="";
		if($item->menu_item_parent=="0" && $item->menu_icon_url!="" && $this->theme_parametrs["click_image_action"]=="open_submenu"){
			$image='<span class="wpdevart_menu_img"><img src="'.$item->menu_icon_url.'"/></span>';
		}
		if(in_array("menu-item-has-children",$item->classes) && $item->menu_item_parent=="0" && ($this->theme_parametrs["open_icon"]!='' || $this->theme_parametrs["close_icon"]!='')){
			$open_icon='<i class="wpdevart_open_icon '.$this->theme_parametrs["open_icon"].'"></i>';
			$close_icon='<i class="wpdevart_close_icon '.$this->theme_parametrs["close_icon"].'"></i>';
		}
		$before.='<div class="wpdevart_menu_link_conteiner">'.$image;
		$args->before=$before;
		
		$after.=$open_icon;
		$after.=$close_icon;
		$after.="</div>";
		$args->after=$after;
		return $args; 
		
	}
	public function nav_menu_item_classes_filter($classes, $item, $args, $depth){
		if($item->menu_item_parent!="0"){
			array_push($classes,"wpdevart_submenu_item");
		}
		return $classes;
	}
	public function nav_submenu_item_classes_filter($classes, $args, $depth){
		array_push($classes,"wpdevart_submenu");
		return $classes;
	}
	public function menu_title_filter($title, $item, $args, $depth){   
		$image="";
		if($item->menu_item_parent=="0" && $item->menu_icon_url!="" && $this->theme_parametrs["click_image_action"]=="go_to_link"){
			$image='<span class="wpdevart_menu_img"><img src="'.$item->menu_icon_url.'"/></span>';
		}
		return $image.$title;
   }
	private function automaticly_genereted_params(){
		
	}
	/*HELPER FUNCTIONS*/
	function generete_font_style($style,$important="") {
		$output = '';
		if( $style == 'normal' || $style == 'bold' ) {
			$output .= 'font-weight: ' .$style .$important.';';
		}

		if( $style == 'italic' ) {
			$output .= 'font-style: ' .$style .$important. ';';
		}

		if( $style == 'underline' ) {
			$output .= 'text-decoration: ' .$style .$important. ';';
		}

		if( $style == 'bold italic') {
			$output .= 'font-style: italic'.$important.';';
			$output .= 'font-weight: bold'.$important.';'; 
		}
		if( $style == 'bold underline' ) {
			$output .= 'font-weight: bold'.$important.';';
			$output .= 'text-decoration: underline'.$important.';';
		}

		if( $style == 'italic underline') {
			$output .= 'font-style: italic'.$important.'; ';
			$output .= 'text-decoration: underline'.$important.';';
		}

		if( $style == 'bold italic underline' ) {
			$output .= 'font-weight: bold'.$important.';';
			$output .= 'font-style: italic'.$important.';';
			$output .= 'text-decoration: underline'.$important.';';
		}

		return $output;
	}

}
?>