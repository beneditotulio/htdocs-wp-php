<?php
class wpda_vertical_menu_library {
	public static function get_value($key, $default_value=""){
		if (isset($_GET[$key])) {
		  $value = esc_html($_GET[$key]);
		}
		elseif (isset($_POST[$key])) {
		  $value = esc_html($_POST[$key]);
		}
		else {
		  $value = '';
		}
		if (!$value) {
		  $value = $default_value;
		}
		return $value;
	}
	
             /*#################### Table heading function ########################*/
			 
	public static function create_table_heading($heading_name,$heading_group){
		?>
			<tr class="<?php echo $heading_group ?> tr_heading"><th colspan="2"><?php echo $heading_name ?></th></tr>
		<?php		
	}

    /*###################### Description panel function ##################*/	
	
	public static function generete_standart_description_panel($args){
		?>
			<td class="td_option_description">				 
				 <?php if(isset($args['description']) && $args['description'] != "") { ?>
					<span class="wpdevart-info-container">?<span class="wpdevart-info"><?php echo $args['description']; ?></span></span>
				 <?php } ?>
				 <span class="wpdevart-title"><?php echo $args['title']; ?></span>
				 <?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "<span class='pro_feature'>(pro)</span>" : ""; ?>
			</td>
		<?php
	}
	
    /*###################### Simple input function ##################*/		
	
	public static function simple_input($args){
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="<?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
					<input type="<?php echo isset($args['type'])?$args['type']:'text'; ?>" value="<?php echo $args['value'] ?>" id="<?php echo $args['name']; ?>" name="<?php echo $args['name']; ?>">
					<small><?php echo isset($args['small_text'])?$args['small_text']:''; ?></small>
			</td>
		</tr>
		<?php		
	}
	
             /*#################### Color function ########################*/	
	
	public static function color_input($args){
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="wpda_color-picker <?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
				<input type="text" class="color" value="<?php echo $args['value'] ?>" data-default-color="<?php echo $args["default_value"] ?>" id="<?php echo $args['name']; ?>" name="<?php echo $args['name']; ?>">
				<script  type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#<?php echo $args['name']; ?>').wpColorPicker();
					});
				</script>
			</td>
		</tr>
		<?php		
	}
	
	public static function gradient_color_input($args){
		if(!is_array($args['value'])){
			$color=$args['value'];
			$args['value']=array();
			$args['value']['color1']=$color;
			$args['value']['color2']=$color;
			$args['value']['gradient']='none';
		}
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="wpda_color-picker <?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
				<input type="text" class="color" data-alpha="true" value="<?php echo isset($args['value']['color1']) ? $args['value']['color1'] : ""; ?>" data-default-color="<?php echo isset($args['value']['color1']) ? $args['value']['color1'] : "" ?>" id="<?php echo $args['name']; ?>_color1" name="<?php echo $args['name']; ?>[color1]">
				<input type="text" class="color" data-alpha="true" value="<?php echo isset($args['value']['color2']) ? $args['value']['color2'] : "" ?>" data-default-color="<?php echo isset($args['value']['color2']) ? $args['value']['color2'] : ""; ?>" id="<?php echo $args['name']; ?>_color2" name="<?php echo $args['name']; ?>[color2]">
				<select id="<?php echo $args['name']; ?>_select_grad" name="<?php echo $args['name']; ?>[gradient]">
					<option <?php selected(isset($args['value']['gradient']) && $args['value']['gradient'] == 'none'); ?> value="none">Without gradient</option>
					<option <?php selected(isset($args['value']['gradient']) && $args['value']['gradient'] == 'to right'); ?> value="to right">Right</option>
					<option <?php selected(isset($args['value']['gradient']) && $args['value']['gradient'] == 'to left'); ?> value="to left">Left</option>
					<option <?php selected(isset($args['value']['gradient']) && $args['value']['gradient'] == 'to bottom'); ?> value="to bottom">Bottom</option>
					<option <?php selected(isset($args['value']['gradient']) && $args['value']['gradient'] == 'to top'); ?> value="to top">Top</option>
					<option <?php selected(isset($args['value']['gradient']) && $args['value']['gradient'] == 'to bottom right'); ?> value="to bottom right">Bottom Right</option>
					<option <?php selected(isset($args['value']['gradient']) && $args['value']['gradient'] == 'to bottom left'); ?> value="to bottom left">Bottom Left</option>
					<option <?php selected(isset($args['value']['gradient']) && $args['value']['gradient'] == 'to top right'); ?> value="to top right">Top Right</option>
					<option <?php selected(isset($args['value']['gradient']) && $args['value']['gradient'] == 'to top left'); ?> value="to top left">Top Left</option>
				<select>
				<script  type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('#<?php echo $args['name']; ?>_color1,#<?php echo $args['name']; ?>_color2').wpColorPicker();
						if(jQuery('#<?php echo $args['name']; ?>_select_grad').val()=='none'){
							jQuery('#<?php echo $args['name']; ?>_select_grad').parent().children().eq(1).hide();
						}
						jQuery('#<?php echo $args['name']; ?>_select_grad').change(function(){
							if(jQuery(this).val()=='none'){
								jQuery(this).parent().children().eq(1).hide();
							}else{
								jQuery(this).parent().children().eq(1).show();
							}
						});
						
						
					});
				</script>
			</td>
		</tr>
		<?php		
	}
	
    /*###################### Simple select function ##################*/		
	
	public static function simple_select($args){
		$curent_value=$args['value'];
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="<?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
				<select id="<?php echo $args['name']; ?>" name="<?php echo $args['name']; ?>">
					<?php foreach($args['values'] as $key => $value){ 
						if(!is_array($value)){
							?><option value="<?php echo $key ?>" <?php selected($key,$curent_value)  ?>><?php echo $value ?></option><?php
						}else{
							?><optgroup label="<?php echo str_replace("_"," ",$key) ?>"><?php
							foreach($value as $key1 => $value1){
								?><option value="<?php echo $key1 ?>" <?php selected($key1,$curent_value)  ?>><?php echo $value1 ?></option><?php
							}
							?></optgroup><?php
						}
					} ?>
				</select>
			</td>
		</tr>
		<?php	
	}
	
             /*#################### Font select function ########################*/	
	
	public static function font_select($args){
		$curent_value=$args['value'];
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="<?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
				<select id="<?php echo $args['name']; ?>" name="<?php echo $args['name']; ?>">
					<?php foreach($args['values'] as $key => $value){ 						
						?><option style="font-family:<?php echo $key ?>" value="<?php echo $key ?>" <?php selected($key,$curent_value)  ?>><?php echo $value ?></option><?php						
					} ?>
				</select>
			</td>
		</tr>
		<?php	
	}
	
    /*###################### Simple checkbox function ##################*/		
	
	public static function simple_checkbox($args){
		$curent_value=$args['value'];
		$counter=0;
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option checkbox_tr">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="td_value <?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
				<?php foreach($args['values'] as $key => $value){ 
								
				?>
				<div>
					<span>
						<input <?php if(isset($curent_value[$key])) checked( $key, $curent_value[$key] ); ?> type="checkbox" name="<?php echo $args['name']; ?>[<?php echo "$key" ?>]" id="<?php echo $args['name'].$key; ?>_id" value="<?php echo $key ?>">
						<label for="<?php echo $args['name'].$key; ?>_id"><?php echo $value ?></label>
					</span>
				</div>
				<?php } ?>
			</td>
		</tr>
		<?php	
	}
	public static function input_extended($args){
		$curent_value=$args['value'];
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option tr_pading_margin">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="td_value <?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
			<?php foreach($args['default_value'] as $key => $value){  ?>
				<span>
					<input type="text" name="<?php echo $args['name']."[".$key."]"; ?>" id="<?php echo $args['name']."_".$key."_id"; ?>" value="<?php echo $args['value'][$key]; ?>">
					<label for="<?php echo $args['name']."_".$key."_id"; ?>"><?php echo $args['labels'][$key] ?></label>
				</span>
			<?php } ?>
			</td>
		</tr>
		<?php	
			
	}
	public static function color_input_extended($args){
		$curent_value=$args['value'];
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option tr_pading_margin">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="td_value <?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
			<?php foreach($args['default_value'] as $key => $value){  ?>
				<span class="color_picker_extended">
					<input type="text" class="color" value="<?php echo $args['value'][$key] ?>" data-default-color="<?php echo $args["default_value"][$key] ?>" id="<?php echo $args['name']."_".$key."_id"; ?>"  name="<?php echo $args['name']."[".$key."]"; ?>">
					<label for="<?php echo $args['name']."_".$key."_id"; ?>"><?php echo $args['labels'][$key] ?></label>
					<script  type="text/javascript">
						jQuery(document).ready(function() {
							jQuery('#<?php echo $args['name']."_".$key."_id"; ?>').wpColorPicker();
						});
					</script>
				</span>	
			<?php } ?>
			</td>
		</tr>
		<?php	
	}
	public static function range_input($args){
		$curent_value=$args['value'];
		$min=(isset($args['min_value']))?('min="'.$args['min_value'].'"'):'';
		$max=(isset($args['max_value']))?('max="'.$args['max_value'].'"'):'';
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="range_option_td <?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
				<input oninput="document.getElementById('<?php echo $args['name']; ?>_conect').innerHTML=this.value" type="range" id="<?php echo $args['name']; ?>" name="<?php echo $args['name']; ?>" value="<?php echo $args['value'] ?>" <?php echo $min." ".$max; ?> />
                <output id="<?php echo $args['name']; ?>_conect" ><?php echo $args['value'] ?></output>
                <small><?php echo isset($args['small_text'])?$args['small_text']:''; ?></small>
			</td>
		</tr>
		<?php	
	}
	public static function upload_input($args){
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="upload_option_td <?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
				<input type="text" class="upload" id="<?php echo $args['name']; ?>" name="<?php echo $args['name']; ?>" value="<?php echo $args['value'] ?>">
				<input class="upload-button button" type="button" value="Upload">
				<img src="<?php echo $args['value'] ?>" class="cont_button_uploaded_img">	      
			</td>
		</tr>
		<?php	
	}
	/*for front end*/
	public static function hex2rgba($color, $opacity = false) {
		$default = 'rgb(0,0,0)';        
		if (empty($color))
			return $default;     
		if ($color[0] == '#')
			$color = substr($color, 1);    
		if (strlen($color) == 6)
			$hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);    
		elseif (strlen($color) == 3)
			$hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);    
		else
			return $default;       
		$rgb = array_map('hexdec', $hex);    
		$opacity = min($opacity, 1);
		$output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';   
		return $output;
	}
	public static function calendar_input($args){
		?>
		<tr class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="<?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>">
				<input class="wpda_datepicker_timer" type="<?php echo isset($args['type'])?$args['type']:'text'; ?>" value="<?php echo $args['value'] ?>" name="<?php echo $args['name']; ?>">
			</td>
		</tr>
		<?php		
	}
	public static function tinmce($args){		
		?>
		<tr  class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<td class="<?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>" colspan="2" style="padding: 4px;">
				<?php wp_editor( $args['value'], $args['name'], $settings = array() ); ?>
			</td>
		</tr>
		<?php		
	}
	public static function oredering($args){		
	
		$ordering_info= json_decode(stripslashes($args['value']), true);
		$ordering_elements=$args['values'];?>
		<tr  class="<?php echo isset($args['heading_group'])?$args['heading_group']:'' ?> tr_option">
			<?php self::generete_standart_description_panel($args) ?>
			<td class="<?php echo ((isset($args["pro"]) && $args["pro"] === true)) ? "wpdevart_pro" : ""; ?>"  style="padding: 4px;">
				<ul class="wpdevart_sortable" id="<?php echo $args['name']; ?>_ul">
					<?php foreach($ordering_info as $key =>$value){ 
						echo '<li date-value="'.$key.'"  class="ui-state-default '.( $value[0] ? " control_active ":" control_deactive ").'">'.$ordering_elements[$key].'<span class="ui-icon ui-icon-arrowthick-2-n-s"></span></li>';
					 } ?>
				 </ul>
				<input type="hidden" name="<?php echo $args['name']; ?>" id="<?php echo $args['name']; ?>" value='<?php echo stripslashes($args['value']) ?>'  />
				
			</td>
		</tr>
		<?php		
	}
	public static function fonts_select(){
		$font_choices[ 'monospace' ] = 'Monospace';
		$font_choices[ 'Arial,Helvetica Neue,Helvetica,sans-serif' ] = 'Arial *';
		$font_choices[ 'Arial Black,Arial Bold,Arial,sans-serif' ] = 'Arial Black *';
		$font_choices[ 'Arial Narrow,Arial,Helvetica Neue,Helvetica,sans-serif' ] = 'Arial Narrow *';
		$font_choices[ 'Courier,Verdana,sans-serif' ] = 'Courier *';
		$font_choices[ 'Georgia,Times New Roman,Times,serif' ] = 'Georgia *';
		$font_choices[ 'Times New Roman,Times,Georgia,serif' ] = 'Times New Roman *';
		$font_choices[ 'Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Arial,sans-serif' ] = 'Trebuchet MS *';
		$font_choices[ 'Verdana,sans-serif' ] = 'Verdana *';
		$font_choices[ 'American Typewriter,Georgia,serif' ] = 'American Typewriter';
		$font_choices[ 'Andale Mono,Consolas,Monaco,Courier,Courier New,Verdana,sans-serif' ] = 'Andale Mono';
		$font_choices[ 'Baskerville,Times New Roman,Times,serif' ] = 'Baskerville';
		$font_choices[ 'Bookman Old Style,Georgia,Times New Roman,Times,serif' ] = 'Bookman Old Style';
		$font_choices[ 'Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif' ] = 'Calibri';
		$font_choices[ 'Cambria,Georgia,Times New Roman,Times,serif' ] = 'Cambria';
		$font_choices[ 'Candara,Verdana,sans-serif' ] = 'Candara';
		$font_choices[ 'Century Gothic,Apple Gothic,Verdana,sans-serif' ] = 'Century Gothic';
		$font_choices[ 'Century Schoolbook,Georgia,Times New Roman,Times,serif' ] = 'Century Schoolbook';
		$font_choices[ 'Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif' ] = 'Consolas';
		$font_choices[ 'Constantia,Georgia,Times New Roman,Times,serif' ] = 'Constantia';
		$font_choices[ 'Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif' ] = 'Corbel';
		$font_choices[ 'Franklin Gothic Medium,Arial,sans-serif' ] = 'Franklin Gothic Medium';
		$font_choices[ 'Garamond,Hoefler Text,Times New Roman,Times,serif' ] = 'Garamond';
		$font_choices[ 'Gill Sans MT,Gill Sans,Calibri,Trebuchet MS,sans-serif' ] = 'Gill Sans MT';
		$font_choices[ 'Helvetica Neue,Helvetica,Arial,sans-serif' ] = 'Helvetica Neue';
		$font_choices[ 'Hoefler Text,Garamond,Times New Roman,Times,sans-serif' ] = 'Hoefler Text';
		$font_choices[ 'Lucida Bright,Cambria,Georgia,Times New Roman,Times,serif' ] = 'Lucida Bright';
		$font_choices[ 'Lucida Grande,Lucida Sans,Lucida Sans Unicode,sans-serif' ] = 'Lucida Grande';
		$font_choices[ 'Palatino Linotype,Palatino,Georgia,Times New Roman,Times,serif' ] = 'Palatino Linotype';
		$font_choices[ 'Tahoma,Geneva,Verdana,sans-serif' ] = 'Tahoma';
		$font_choices[ 'Rockwell, Arial Black, Arial Bold, Arial, sans-serif' ] = 'Rockwell';
		$font_choices[ 'Segoe UI' ] = 'Segoe UI';
		return $font_choices;
	}
	
	public static function get_randowm_animation(){
		return self::$list_of_animations[array_rand(self::$list_of_animations)];
	}
	
	public static function darkest_color($color,$pracent){
		$new_color=$color;
		if(!(strlen($new_color==6) || strlen($new_color)==7))
		{
			return $color;
		}
		$color_vandakanishov=strpos($new_color,'#');
		if($color_vandakanishov == false) {
			$new_color= str_replace('#','',$new_color);
		}
		$color_part_1=substr($new_color, 0, 2);
		$color_part_2=substr($new_color, 2, 2);
		$color_part_3=substr($new_color, 4, 2);
		$color_part_1=dechex( (int) (hexdec( $color_part_1 ) - ((hexdec( $color_part_1 )  ) * $pracent / 100 )));
		$color_part_2=dechex( (int) (hexdec( $color_part_2)  - ((hexdec( $color_part_2 )  ) * $pracent / 100 )));
		$color_part_3=dechex( (int) (hexdec( $color_part_3 ) - ((hexdec( $color_part_3 )  ) * $pracent / 100 )));
		$new_color="#".(strlen($color_part_1)>1?$color_part_1:"0".$color_part_1).(strlen($color_part_2)>1?$color_part_2:"0".$color_part_2).(strlen($color_part_3)>1?$color_part_3:"0".$color_part_3);
		if($color_vandakanishov == false){
			return $new_color;
		}
		else{
			return '#'.$new_color;
		}
	}
	
	
	/*Sanitize Fields*/
	public static function sanitize_value_by_function_name($function_name,$value){
		switch($function_name){
			case "simple_input":
				return sanitize_text_field($value);
			break;
			case "color_input":
				return sanitize_text_field($value);
			break;
			case "simple_select":
				return sanitize_text_field($value);
			break;
			case "font_select":
				return sanitize_text_field($value);
			break;
			case "simple_checkbox":
				$returned_array=array();
				foreach($value as $key => $checked){
					$returned_array[$key]=sanitize_text_field($checked);
				}
				return $returned_array;
			break;
			case "input_extended":
				$returned_array=array();
				foreach($value as $input_key => $input_value){
					$returned_array[$input_key]=sanitize_text_field($input_value);
				}
				return $returned_array;
			break;
			case "color_input_extended":
				$returned_array=array();
				foreach($value as $input_key => $input_value){
					$returned_array[$input_key]=sanitize_text_field($input_value);
				}
				return $returned_array;
			break;
			case "range_input":
				return sanitize_text_field($value);
			break;
			case "upload_input":
				return sanitize_text_field(esc_url($value));
			break;
		}
		return "";
	}
}
?>