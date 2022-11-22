<?php
/*
Plugin Name: NEX-Forms - Ultimate
Plugin URI: https://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?ref=Basix
Plugin Prefix: wap_
Description: Premium WordPress Plugin - Ultimate Drag and Drop WordPress Forms Builder.
Author: Basix
Version: 7.6.4
Author URI: https://codecanyon.net/user/Basix/portfolio?ref=Basix
License: GPL
Text Domain: nex-forms
*/

if ( ! defined( 'ABSPATH' ) ) exit;


$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';

$cal_id = isset($_REQUEST['calendar_Id']) ? $_REQUEST['calendar_Id'] : '';
if($page=="nex-forms-main" || $page=="nex-forms-dashboard" || $page=="nex-forms-builder")
	{
	add_action( 'wp_print_scripts', 'NEXForms5_deregister_javascript',100);
	add_action( 'wp_print_styles', 'NEXForms5_deregister_stylesheets',100);
	add_action( 'init', 'NEXForms5_deregister_javascript',100);
	add_action( 'init', 'NEXForms5_deregister_stylesheets',100);
	}
if(!$cal_id)
	add_action('widgets_init', 'NEXForms_widget::register_this_widget');

function enqueue_nf_jquery(){
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-autocomplete');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-form');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-touch-punch');
}

add_action( 'wp_enqueue_scripts', 'enqueue_nf_jquery' );


function NEXForms5_deregister_javascript(){
	global $wp_scripts; 
	
	$output = '';
	
	$include_script_array = array('utils','common','wp-sanitize','sack','quicktags','colorpicker','editor','clipboard','wp-fullscreen-stub','wp-ajax-response','wp-api-request','wp-pointer','autosave','heartbeat','wp-auth-check','wp-lists','prototype','scriptaculous-root','scriptaculous-builder','scriptaculous-dragdrop','scriptaculous-effects','scriptaculous-slider','scriptaculous-sound','scriptaculous-controls','scriptaculous','cropper','jquery','jquery-core','jquery-migrate','jquery-ui-core','jquery-effects-core','jquery-effects-blind','jquery-effects-bounce','jquery-effects-clip','jquery-effects-drop','jquery-effects-explode','jquery-effects-fade','jquery-effects-fold','jquery-effects-highlight','jquery-effects-puff','jquery-effects-pulsate','jquery-effects-scale','jquery-effects-shake','jquery-effects-size','jquery-effects-slide','jquery-effects-transfer','jquery-ui-accordion','jquery-ui-autocomplete','jquery-ui-button','jquery-ui-datepicker','jquery-ui-dialog','jquery-ui-draggable','jquery-ui-droppable','jquery-ui-menu','jquery-ui-mouse','jquery-ui-position','jquery-ui-progressbar','jquery-ui-resizable','jquery-ui-selectable','jquery-ui-selectmenu','jquery-ui-slider','jquery-ui-sortable','jquery-ui-spinner','jquery-ui-tabs','jquery-ui-tooltip','jquery-ui-widget','jquery-form','jquery-color','schedule','jquery-query','jquery-serialize-object','jquery-hotkeys','jquery-table-hotkeys','jquery-touch-punch','suggest','imagesloaded','masonry','jquery-masonry','thickbox','jcrop','swfobject','moxiejs','plupload','plupload-all','plupload-html5','plupload-flash','plupload-silverlight','plupload-html4','plupload-handlers','wp-plupload','swfupload','swfupload-all','swfupload-handlers','comment-reply','json2','underscore','backbone','wp-util','wp-backbone','revisions','imgareaselect','mediaelement','mediaelement-core','mediaelement-migrate','mediaelement-vimeo','wp-mediaelement','wp-codemirror','csslint','esprima','jshint','jsonlint','htmlhint','htmlhint-kses','code-editor','wp-theme-plugin-editor','wp-playlist','zxcvbn-async','password-strength-meter','user-profile','language-chooser','user-suggest','admin-bar','wplink','wpdialogs','word-count','media-upload','hoverIntent','hoverintent-js','customize-base','customize-loader','customize-preview','customize-models','customize-views','customize-controls','customize-selective-refresh','customize-widgets','customize-preview-widgets','customize-nav-menus','customize-preview-nav-menus','wp-custom-header','accordion','shortcode','media-models','wp-embed','media-views','media-editor','media-audiovideo','mce-view','wp-api','admin-tags','admin-comments','xfn','postbox','tags-box','tags-suggest','post','editor-expand','link','comment','admin-gallery','admin-widgets','media-widgets','media-audio-widget','media-image-widget','media-gallery-widget','media-video-widget','text-widgets','custom-html-widgets','theme','inline-edit-post','inline-edit-tax','plugin-install','site-health','privacy-tools','updates','farbtastic','iris','wp-color-picker','dashboard','list-revisions','media-grid','media','image-edit','set-post-thumbnail','nav-menu','custom-header','custom-background','media-gallery','svg-painter','react','react-dom','moment','lodash','wp-polyfill-fetch','wp-polyfill-formdata','wp-polyfill-node-contains','wp-polyfill-element-closest','wp-polyfill','wp-tinymce','wp-tinymce-lists','wp-a11y','wp-annotations','wp-api-fetch','wp-autop','wp-blob','wp-block-editor','wp-block-library','wp-block-serialization-default-parser','wp-blocks','wp-components','wp-compose','wp-core-data','wp-data','wp-data-controls','wp-date','wp-deprecated','wp-dom','wp-dom-ready','wp-edit-post','wp-editor','wp-element','wp-escape-html','wp-format-library','wp-hooks','wp-html-entities','wp-i18n','wp-is-shallow-equal','wp-keycodes','wp-list-reusable-blocks','wp-media-utils','wp-notices','wp-nux','wp-plugins','wp-priority-queue','wp-redux-routine','wp-rich-text','wp-server-side-render','wp-shortcode','wp-token-list','wp-url','wp-viewport','wp-wordcount');
	
	if($wp_scripts)
		{
		foreach($wp_scripts->registered as $wp_script=>$array)
			{
			if(!in_array($array->handle,$include_script_array) && !strstr($array->handle,'nex-forms') )
				{
				wp_deregister_script($array->handle);
				wp_dequeue_script($array->handle);
				}
			}	
		}
}

function NEXForms5_deregister_stylesheets(){
	global $wp_styles;
	
	$include_style_array = array('colors','common','forms','admin-menu','dashboard','list-tables','bootstrap-timepicker','jqui-timepicker','bootstrap-material-datetimepicker','nf-nouislider','nf-jquery-ui','nf-md-checkbox-radio','edit','revisions','media','themes','about','nav-menus','widgets','site-icon','l10n','wp-admin','login','install','wp-color-picker','customize-controls','customize-widgets','customize-nav-menus','press-this','ie','buttons','dashicons','open-sans','admin-bar','wp-auth-check','editor-buttons','media-views','wp-pointer','customize-preview','wp-embed-template-ie','imgareaselect','wp-jquery-ui-dialog','mediaelement','wp-mediaelement','thickbox','deprecated-media','farbtastic','jcrop','colors-fresh','nex-forms-jQuery-UI','nex-forms-font-awesome','nex-forms-bootstrap','nex-forms-fields','nex-forms-ui','nex-forms-admin-style','nex-forms-animate','nex-forms-admin-overrides','nex-forms-admin-bootstrap.colorpickersliders','nex-forms-public-admin','nex-forms-editor','nex-forms-custom-admin','nex-forms-jq-ui','nf-styles-chosen','nf-admin-color-adapt', 'nex-forms-jq-ui','nf-styles-font-menu', 'nex-forms-bootstrap-tour.min','nf-color-adapt-fresh','nf-color-adapt-light','nf-color-adapt-blue','nf-color-adapt-coffee','nf-color-adapt-ectoplasm','nf-color-adapt-midnight','nf-color-adapt-ocean','nf-color-adapt-sunrise', 'nf-color-adapt-default', 'nex_forms-materialize.min','nex_forms-bootstrap.min','nex_forms-dashboard','nex_forms-font-awesome-5','nex_forms-font-awesome-4-shims','nex_forms-material-icons','ion.rangeSlider','ion.rangeSlider.skinFlat','nex_forms-builder','google-roboto');

	if($wp_styles)
		{
		foreach($wp_styles->registered as $wp_style=>$array)
			{
			if(!in_array($array->handle,$include_style_array) && !strstr($array->handle,'nex-forms'))
				{
				wp_deregister_style($array->handle);
				wp_dequeue_style($array->handle);
				}
			}
		}
}

	if(is_admin())
		{
		require dirname(__FILE__) . '/includes/classes/plugin-update-checker/plugin-update-checker.php';
		$MyUpdateChecker = new Puc_v4p4_Plugin_UpdateChecker (
			'https://basixonline.net/repository/nex-forms-updates.json',
			__FILE__,
			'main'
			);
		}

	require( dirname(__FILE__) . '/includes/load.php');

class NEXForms5_Config{
	/*************  General  ***************/
	/************  DONT EDIT  **************/
	public $plugin_version;
	/* The displayed name of your plugin */
	public $plugin_name;
	/* The alias of the plugin used by external entities */
	public $plugin_alias;
	/* Enable or disable external modules */
	public $enable_modules;
	/* Plugin Prefix */
	public $plugin_prefix;
	/* Plugin table */
	public $plugin_table, $component_table;
	/* Admin Menu */
	public $plugin_menu;
	/* Add TinyMCE */
	public $add_tinymce;
	
	
	/************* Database ****************/
	/* Sets the primary key for table created above */
	public $plugin_db_primary_key = 'Id';
	/* Database table fields array */
	public $plugin_db_table_fields = array
			(
			'title'								=>	'text',
			'description'						=>	'text',
			'mail_to'							=>  'text',
			'confirmation_mail_body'			=>  'longtext',
			'admin_email_body'					=>  'longtext',
			'confirmation_mail_subject'			=>	'text',
			'user_confirmation_mail_subject'	=>	'text',
			'from_address'						=>  'text',
			'from_name'							=>  'text',
			'on_screen_confirmation_message'	=>  'longtext',
			'confirmation_page'					=>  'text',
			'form_fields'						=>	'longtext',
			'clean_html'						=>	'longtext',
			'visual_settings'					=>	'text',
			'google_analytics_conversion_code'  =>  'text',
			'colour_scheme'  					=>  'text',
			'send_user_mail'					=>  'text',
			'user_email_field'					=>  'text',
			'on_form_submission'				=>  'text',
			'upload_settings'					=>  'longtext',
			'attachment_settings'				=>  'longtext',
			'date_sent'							=>  'datetime',
			'is_form'							=>  'text',
			'is_template'						=>  'text',
			'hidden_fields'						=>  'longtext',
			'form_hidden_fields'				=>  'longtext',
			'custom_url'						=>  'text',
			'post_type'							=>  'text',
			'post_action'						=>  'text',
			'bcc'								=>  'text',
			'bcc_user_mail'						=>  'text',
			'custom_css'						=>  'longtext',
			'is_paypal'							=>  'text',
			'total_views'						=>  'text',
			'time_viewed'						=>  'text',
			'email_on_payment_success'			=>  'text',
			'conditional_logic'					=>  'longtext',
			'conditional_logic_array'			=>  'longtext',
			'server_side_logic'					=>  'longtext',
			'form_status'						=>  'text',
			'currency_code'						=>  'text',
			'products'							=>  'longtext',
			'business'							=>  'text',
			'cmd'								=>  'text',
			'return_url'						=>  'text',
			'cancel_url'						=>  'text',
			'lc'								=>  'text',
			'environment'						=>  'text',
			'email_subscription'				=>  'longtext',
			'mc_field_map'						=>  'longtext',
			'mc_list_id'						=>  'text',
			'gr_field_map'						=>  'longtext',
			'gr_list_id'						=>  'text',
			'mp_field_map'						=>  'longtext',
			'mp_list_id'						=>  'text',
			'ms_field_map'						=>  'longtext',
			'ms_list_id'						=>  'text',
			'pdf_html'							=>  'longtext',
			'attach_pdf_to_email'				=>	'text',
			'form_to_post_map'					=>  'longtext',
			'is_form_to_post'					=>  'text',
			'md_theme'							=>	'text',
			'form_theme'						=>	'text',
			'jq_theme'							=>	'text',
			'form_style'						=>  'longtext',
			'multistep_settings'				=>	'longtext',
			'multistep_html'					=>	'longtext',
			'paypal_client_Id'					=>  'longtext',
			'paypal_client_secret'				=>  'longtext',
			'payment_success_msg'				=>  'longtext',
			'payment_failed_msg'				=>  'longtext',
			'option_settings'				=>  'longtext',
			);
	


	public $form_entry_table_fields = array
			(
			'nex_forms_Id'			=>	'text',
			'page'					=>	'text',
			'ip'					=>  'text',
			'hostname'				=>	'text',
			'city'					=>	'text',
			'region'				=>	'text',
			'country'				=>	'text',
			'loc'					=>	'text',
			'org'					=>	'text',
			'postal'				=>	'text',
			'user_Id'				=>	'text',
			'viewed'				=>	'text',
			'date_time'				=>  'datetime',
			'paypal_invoice'		=>	'text',
			'payment_status'		=>  'text',
			'form_data'				=>	'longtext',
			'paypal_data'			=>	'longtext',
			'paypal_payment_token'	=>	'longtext',
			'paypal_payment_id'		=>	'longtext',
			'payment_ammount'		=>	'longtext',
			'payment_currency'		=> 	'text',
			'saved_admin_email'		=>	'longtext',
			'saved_user_email'		=>	'longtext',
			'saved_user_email_address'	=>	'text',
			);
	
	public $email_table_fields = array
			(
			'nex_forms_Id'						=>	'text',
			'mail_type'							=>  'text',
			'mail_to'							=>  'text',
			'mail_body'							=>  'longtext',
			'mail_subject'						=>	'text',
			'from_address'						=>  'text',
			'from_name'							=>  'text',
			'send_user_mail'					=>  'text',
			'user_email_field'					=>  'text',
			'bcc'								=>  'text',
			'bcc_user_mail'						=>  'text',
			'attachments'						=>  'text',
			);
	
	
	public $stats_table_fields = array
			(
			'nex_forms_Id'			=>	'text',
			'time_viewed'			=>	'text',
			);
	public $form_interactions = array
			(
			'nex_forms_Id'			=>	'text',
			'time_interacted'		=>	'text',
			);
	
	public $file_manager = array
			(
			'nex_forms_Id'			=>	'text',
			'name'					=>	'text',
			'type'					=>	'text',
			'size'					=>	'text',
			'url'					=>	'text',
			'location'				=>	'text',
			'entry_Id'				=>	'text'
			);
	
	/************* Admin Menu **************/
	public function __construct()
		{ 
		
		$functions = new NEXForms_Functions();
		
		$header_info = $functions->get_file_headers(dirname(__FILE__).DIRECTORY_SEPARATOR.'main.php');
		
		$this->plugin_version 	= $header_info['Version'];
		$this->plugin_name 		= $header_info['Plugin Name'];
		$this->plugin_alias		= $functions->format_name($this->plugin_name);
		$this->plugin_prefix	= $header_info['Plugin Prefix'];
		$this->plugin_table		= $this->plugin_prefix.$this->plugin_alias;
		$this->component_table	= $this->plugin_table;
		$this->add_tinymce		= $header_info['Plugin TinyMCE'];
		}
}

/***************************************/
/*************  Hooks   ****************/
/***************************************/
/* On plugin activation */
register_activation_hook(__FILE__, 'NEXForms5_run_instalation' );
/* Called from page */
add_shortcode( 'NEXForms', 'NEXForms_ui_output' );
/* Build admin menu */
add_action('admin_menu', 'NEXForms5_main_menu');


$other_config = get_option('nex-forms-other-config');

/* Add action button to TinyMCE Editor */
if($other_config['enable-tinymce']=='1')
	add_action('init', 'NEXForms_add_mce_button');

/* Add action button to TinyMCE Editor */
function NEXForms_add_mce_button() {
	add_filter("mce_external_plugins", "NEXForms_tinymce_plugin");
 	add_filter('mce_buttons', 'NEXForms_register_button');
}
/* register button to be called from JS */
function NEXForms_register_button($buttons) {
   array_push($buttons, "separator", "nexforms");
   return $buttons;
}
/* Send request to JS */
function NEXForms_tinymce_plugin($plugin_array) {
   $plugin_array['nexforms'] = plugins_url( '/tinyMCE/plugin.js',__FILE__);
   return $plugin_array;
}
add_action('wp_ajax_NEXForms_tinymce_window', 'NEXForms_tinymce_window');
function NEXForms_tinymce_window(){
	include_once( '/tinyMCE/window.php');
    die();
}

/***************************************/
/*********  Hook functions   ***********/
/***************************************/
/* Convert menu to WP Admin Menu */
function NEXForms5_main_menu(){
	
	$other_config = get_option('nex-forms-other-config');
	
	$user_level = isset($other_config['set-wp-user-level']) ? $other_config['set-wp-user-level'] : 'administrator';
	
	if($user_level == 'subscriber')
		$nf_user_level = 'read';
	
	if($user_level == 'contributor')
		$nf_user_level = 'edit_posts';
	
	if($user_level == 'author')
		$nf_user_level = 'publish_posts';
	
	if($user_level == 'editor')
		$nf_user_level = 'publish_pages';
	
	if($user_level=='administrator')
		$nf_user_level = 'activate_plugins';
	
	$theme = wp_get_theme();
	if($theme->Name=='NEX-Forms Demo')
		$nf_user_level = 'read';
		
	add_menu_page( 'NEX-Forms', 'NEX-Forms', $nf_user_level, 'nex-forms-dashboard', 'NEXForms_dashboard', plugins_url('/nf-admin/css/images/menu_icon.png',__FILE__),30 );
	//$database_actions = new NEXForms_Database_Actions();
	//if(!get_option('nf_activated'))
	//	add_submenu_page( 'nex-forms-dashboard', 'NF-Upgrade','<a href="http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?license=regular&open_purchase_for_item_id=7103891&purchasable=source&ref=Basix&add=upgrade_to_pro" class="pro_upgrade" target="_blank">Upgrade to Pro</a>', $nf_user_level, '', 'NEXForms_pro_upgrade');
	//else
	//	{
	//	add_submenu_page( 'nex-forms-dashboard', 'NF-Builder','Dashboard', $nf_user_level, 'nex-forms-dashboard', 'NEXForms_dashboard');
		add_submenu_page( 'nex-forms-dashboard', 'NF-Builder','Dashboard', $nf_user_level, 'nex-forms-dashboard', 'NEXForms_dashboard');
	//	}
	add_submenu_page( 'nex-forms-dashboard', 'NF-Builder','Forms &amp; Analytics', $nf_user_level, 'nex-forms-dashboard', 'NEXForms_dashboard');
	add_submenu_page( 'nex-forms-dashboard', 'NF-Builder','Submissions', $nf_user_level, 'nex-forms-dashboard#latest_submissions', 'NEXForms_dashboard');
	add_submenu_page( 'nex-forms-dashboard', 'NF-Builder','Reporting', $nf_user_level, 'nex-forms-dashboard#submission_reports', 'NEXForms_dashboard');
	add_submenu_page( 'nex-forms-dashboard', 'NF-Builder','File Uploads', $nf_user_level, 'nex-forms-dashboard#file_uploads', 'NEXForms_dashboard');
	add_submenu_page( 'nex-forms-dashboard', 'NF-Builder','Global Settings', $nf_user_level, 'nex-forms-dashboard#global_settings', 'NEXForms_dashboard');
	add_submenu_page( 'nex-forms-dashboard', 'NF-Builder','Add-ons', $nf_user_level, 'nex-forms-dashboard#add_ons_panel', 'NEXForms_dashboard');
	
	add_submenu_page( null, 'NF-Builder-View','Builder', $nf_user_level, 'nex-forms-builder', 'NEXForms_form_builder');
	add_submenu_page( null, 'NF-Test','Test', $nf_user_level, 'nex-forms-test-page', 'NEXForms_test_page');
	add_submenu_page( null, 'NF-Preview','nex-forms-preview', $nf_user_level, 'nex-forms-preview', 'NEXForms_form_preview');
	//add_submenu_page( null, 'NF-Test Page','nex-forms-test', $nf_user_level, 'nex-forms-test', 'NEXForms_test_page');
}



function NEXForms_test_page(){
	
	
	
	global $wpdb;
			//if($form_id!=0)
			$c_logic = $wpdb->get_var('SELECT conditional_logic_array FROM '.$wpdb->prefix.'wap_nex_forms WHERE Id=225');
			//else
			//	$c_logic = json_encode($_POST['conditional_logic_array']);
			
			$rules = json_decode($c_logic);
			
			
			$output = '';
				$i = 0;
				$a = 0;
			foreach($rules as $rule)
				{
				if(count($rule->conditions)==1 && count($rule->actions)==1)
					{
					$rule_operator = $rule->operator;
					$reverse_action = $rule->reverse_actions;
					
					//echo 'COUNT CONS: '. count(get_object_vars($rule->conditions));
					
					
					foreach($rule->conditions as $condition)
						{
						$get_the_condition 	=  $condition->condition;
						$get_the_value 		=  $condition->condition_value;
						$selection_value 	=  $condition->selected_value;
						}
					$targets = array();	
					
					//echo '    COUNT ACTIONS: '. sizeof($rule->actions).'<br /><br />';
						
					foreach($rule->actions as $action)
						{
						$get_action_to_take = $action->do_action;
						$selection_value = $action->selected_value;
						$arrows[$i][$condition->field_Id] = 
								array(
									  'target_id'=>$action->target_field_Id,
									  'action'=>$action->do_action,
									  'condition'=>$condition->condition,
									  'condition_value'=>$condition->condition_value
									 );
						}
					$i++;
					}
				else
					{
					
					$rule_operator = $rule->operator;
					$reverse_action = $rule->reverse_actions;
					
					//echo 'COUNT CONS: '. count(get_object_vars($rule->conditions));
					
					$adv_arrows = array();
					foreach($rule->conditions as $condition)
						{
						$get_the_condition 	=  $condition->condition;
						$get_the_value 		=  $condition->condition_value;
						$selection_value 	=  $condition->selected_value;
						
						//$arrows[$a][$condition->field_Id] = $action->target_field_Id;
						array_push($adv_arrows,
						
						array(
									'arrow_id'=>$condition->field_Id,
									'condition'=>$condition->condition,
									'condition_value'=>$condition->condition_value));
						}
					$adv_targets = array();
					foreach($rule->actions as $action)
						{
						$get_action_to_take = $action->do_action;
						$selection_value = $action->selected_value;
						array_push($adv_targets,
						array(
								'target_id'=>$action->target_field_Id,
								'action'=>$action->do_action)
						);
						}
					$a++;
					$adv_rules[$a]['operator'] = $rule->operator;
					$adv_rules[$a]['arrows'] = $adv_arrows;
					$adv_rules[$a]['targets'] = $adv_targets; 	
					
					}
				}
			$u_arrows = array();
			foreach($arrows as $arrows1)
					{
					foreach($arrows1 as $key=>$arrow)
						{
						$u_arrows[$key] = array();
						}
					}
			
			foreach($u_arrows as $key=>$val)
					{
					foreach($arrows as $arrows4)
						{
						foreach($arrows4 as $key2=>$arrow)
							{
							if($key == $key2)
								array_push($u_arrows[$key2],$arrow);
							}
						}
					}
				$output .= '<div class="con_logic_rules">';
				foreach($u_arrows as $arrow=>$targets)
					{
					$output .= '<div class="the_rule" data-cl-arrow="'.$arrow.'" data-cl-targets=\''.json_encode($targets).'\'></div>';
					}
				foreach($adv_rules as $key => $adv_rule)
					{
					$output .= '<div class="the_adv_rule" data-adv-id="'.$key.'" data-cl-targets=\''.json_encode($adv_rule).'\'></div>';
					}
				$output .= '</div>';
	echo '<pre>';			
	print_r($rules);
	echo '</pre>';
	}

/***************************************/
/***********  INSTALATION   ************/
/***************************************/
$config = new NEXForms5_Config();
if($config->plugin_version!=get_option('nex-forms-version'))
	NEXForms5_run_instalation();



function NEXForms5_run_instalation(){
	$config = new NEXForms5_Config();
	global $wpdb;
	update_option('nex-forms-version',$config->plugin_version);
	//PREFERENCES
	
	
	
	
	
	
		
	//'date_time'				=>  date('Y-m-d H:i:s'),
	
	update_option('nex-forms-preferences',
		array(
			'field_preferences'=>
				array(
					'pref_label_align'		=>'top',
					'pref_label_text_align'	=>'align_let',
					'pref_label_size'		=>'',
					'pref_sub_label'		=>'',
					'pref_input_text_align'	=>'aling_left',
					'pref_input_size'		=>'',
				),
			'validation_preferences'=>
				array(
					'pref_requered_msg'				=> __('Required','nex-forms'),
					'pref_email_format_msg'			=> __('Invalid email address','nex-forms'),
					'pref_phone_format_msg'			=> __('Invalid phone number','nex-forms'),
					'pref_url_format_msg'			=> __('Invalid URL','nex-forms'),						
					'pref_numbers_format_msg'		=> __('Only numbers are allowed','nex-forms'),
					'pref_char_format_msg'			=> __('Only text are allowed','nex-forms'),
					'pref_invalid_file_ext_msg'		=> __('Invalid file extension','nex-forms'),
					'pref_max_file_exceded'			=> __('Maximum File Size of {x}MB Exceeded','nex-forms'),
					'pref_max_file_ul_exceded'		=> __('Only a maximum of {x} files can be uploaded','nex-forms'),
					'pref_max_file_af_exceded'		=> __('Maximum Size for all files can not exceed {x}MB ','nex-forms'),
				),
			'email_preferences'=>
				array(
					'pref_email_from_address'	=> get_option('admin_email'),
					'pref_email_from_name'		=> get_option('blogname'),
					'pref_email_recipients'		=> get_option('admin_email'),
					'pref_email_subject'		=> get_option('blogname').__(' - NEX-Forms Submission','nex-forms'),
					'pref_email_body'			=> '{{nf_form_data}}',
					'pref_user_email_subject'	=> get_option('blogname').__(' - NEX-Forms Submission','nex-forms'),
					'pref_user_email_body'		=> __('Thank you for connecting with us. We will respond to you shortly.','nex-forms'),
				),
			'other_preferences'=>
				array(
					'pref_other_on_screen_message' =>  __('Thank you for connecting with us. We will respond to you shortly.','nex-forms'),
				),
			)
		);
		
	//EMAIL SETTINGS
	update_option('nex-forms-email-config',array(
			'email_method'=>'php_mailer', 
			'email_content'=>'html', 
			'smtp_auth'=>'0',
			'smtp_host'=>'smtp.gmail.com',
			'email_smtp_secure'=>'tls',
			'mail_port'=>'587',
			'set_smtp_user'=>'',
			'set_smtp_pass'=>'')
		);
	
	//SCRIPT SETTINGS	
	update_option('nex-forms-script-config',array(
			'inc-jquery'=>'1',
			'inc-jquery-ui-core'=>'1',
			'inc-jquery-ui-autocomplete'=>'1',
			'inc-jquery-ui-slider'=>'1',
			'inc-jquery-form'=>'1',
			'inc-bootstrap'=>'1',
			'inc-onload'=>'1',
			'inc-moment'=>'1',
			'inc-datetime'=>'1',
			'inc-math'=>'1',
			'inc-colorpick'=>'1',
			'inc-wow'=>'1',
			'inc-raty'=>'1',
			'inc-locals'=>'1',
			'inc-sig'=>'0',
			'enable-print-scripts'=>0	
		));
	//STYLE SETTINGS
	update_option('nex-forms-style-config',array(
			'incstyle-jquery'=>'1',
			'incstyle-font-awesome'=>'1',
			'incstyle-bootstrap'=>'1',
			'incstyle-animations'=>'1',
			'incstyle-custom'=>'1',
			'enable-print-styles'=>1
		));
	
	//OTHER SETTINGS
	update_option('nex-forms-other-config',array(
			'enable-print-scripts'=>'0',
			'enable-print-styles'=>'1',
			'enable-tinymce'=>'1',
			'enable-widget'=>'1',
			'enable-color-adapt'=>'1',
			'set-wp-user-level'=>'administrator'	
		));
		
	/************************************************/
	/**************  MAIN DB TABLE   ****************/
	/************************************************/	
	$instalation = new NF5_Instalation();
	$instalation->component_name 			=  $config->plugin_name;
	$instalation->component_prefix 			=  $config->plugin_prefix;
	$instalation->component_alias			=  'nex_forms';
	$instalation->component_menu 			=  $config->plugin_menu;	
	$instalation->db_table_fields			=  $config->plugin_db_table_fields;
	$instalation->db_table_primary_key		=  $config->plugin_db_primary_key;
	$instalation->run_instalation('full');
	
	/************************************************/
	/************  Additional Tables   **************/
	/************************************************/
	/* Entries Table */
	$instalation = new NF5_Instalation();
	$instalation->component_prefix 		=  $config->plugin_prefix;
	$instalation->component_alias		=  'nex_forms_entries';
	$instalation->db_table_fields		=  $config->form_entry_table_fields;
	$instalation->db_table_primary_key	=  $config->plugin_db_primary_key;
	$instalation->install_component_table();	
	
	/* Email Table */
	$instalation = new NF5_Instalation();
	$instalation->component_prefix 		=  $config->plugin_prefix;
	$instalation->component_alias		=  'nex_forms_email_templates';
	$instalation->db_table_fields		=  $config->email_table_fields;
	$instalation->db_table_primary_key	=  $config->plugin_db_primary_key;
	$instalation->install_component_table();	
	
	/* Stats Tables */
	$instalation = new NF5_Instalation();
	$instalation->component_prefix 		=  $config->plugin_prefix;
	$instalation->component_alias		=  'nex_forms_views';
	$instalation->db_table_fields		=  $config->stats_table_fields;
	$instalation->db_table_primary_key	=  $config->plugin_db_primary_key;
	$instalation->install_component_table();	
	
	$instalation = new NF5_Instalation();
	$instalation->component_prefix 		=  $config->plugin_prefix;
	$instalation->component_alias		=  'nex_forms_stats_interactions';
	$instalation->db_table_fields		=  $config->form_interactions;
	$instalation->db_table_primary_key	=  $config->plugin_db_primary_key;
	$instalation->install_component_table();	
	
	/* Files Table */
	$instalation = new NF5_Instalation();
	$instalation->component_prefix 		=  $config->plugin_prefix;
	$instalation->component_alias		=  'nex_forms_files';
	$instalation->db_table_fields		=  $config->file_manager;
	$instalation->db_table_primary_key	=  $config->plugin_db_primary_key;
	$instalation->install_component_table();	
	
	
	$database_actions = new NEXForms_Database_Actions();
	$database_actions->recollate_plugin_table();
	
	$database_actions->alter_plugin_table('wap_nex_forms','last_update','TIMESTAMP');
	$database_actions->alter_plugin_table('wap_nex_forms','hidden_fields','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','clean_html','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','custom_url','text');
	$database_actions->alter_plugin_table('wap_nex_forms','admin_email_body','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','bcc','text');
	$database_actions->alter_plugin_table('wap_nex_forms','bcc_user_mail','text');
	$database_actions->alter_plugin_table('wap_nex_forms','post_type','text');
	$database_actions->alter_plugin_table('wap_nex_forms','post_action','text');	
	$database_actions->alter_plugin_table('wap_nex_forms','custom_css','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','is_paypal','text');
	$database_actions->alter_plugin_table('wap_nex_forms','total_views','text');
	$database_actions->alter_plugin_table('wap_nex_forms','time_viewed','text');
	$database_actions->alter_plugin_table('wap_nex_forms','email_on_payment_success','text');
	$database_actions->alter_plugin_table('wap_nex_forms','conditional_logic','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','conditional_logic_array','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','server_side_logic','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','form_type','text');
	$database_actions->alter_plugin_table('wap_nex_forms','template_type','text');
	$database_actions->alter_plugin_table('wap_nex_forms','user_confirmation_mail_subject','text');
	$database_actions->alter_plugin_table('wap_nex_forms','draft_Id','text');
	$database_actions->alter_plugin_table('wap_nex_forms','pdf_html','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','attach_pdf_to_email','text');
	$database_actions->alter_plugin_table('wap_nex_forms','form_to_post_map','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','is_form_to_post','text');
	$database_actions->alter_plugin_table('wap_nex_forms','form_status','text');
	$database_actions->alter_plugin_table('wap_nex_forms','form_hidden_fields','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','kak','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','paypal_client_Id','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','paypal_client_secret','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','payment_success_msg','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','payment_failed_msg','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','upload_settings','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','attachment_settings','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','currency_code','text');
	$database_actions->alter_plugin_table('wap_nex_forms','products','text');
	$database_actions->alter_plugin_table('wap_nex_forms','business','text');
	$database_actions->alter_plugin_table('wap_nex_forms','cmd','text');
	$database_actions->alter_plugin_table('wap_nex_forms','return_url','text');
	$database_actions->alter_plugin_table('wap_nex_forms','cancel_url','text');
	$database_actions->alter_plugin_table('wap_nex_forms','lc','text');
	$database_actions->alter_plugin_table('wap_nex_forms','environment','text');
	$database_actions->alter_plugin_table('wap_nex_forms','email_subscription','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','mc_field_map','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','mc_list_id','text');
	$database_actions->alter_plugin_table('wap_nex_forms','mp_field_map','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','mp_list_id','text');
	$database_actions->alter_plugin_table('wap_nex_forms','ms_field_map','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','ms_list_id','text');
	$database_actions->alter_plugin_table('wap_nex_forms','gr_field_map','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','gr_list_id','text');
	$database_actions->alter_plugin_table('wap_nex_forms','option_settings','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','jq_theme','text');
	$database_actions->alter_plugin_table('wap_nex_forms','md_theme','text');
	$database_actions->alter_plugin_table('wap_nex_forms','form_theme','text');
	$database_actions->alter_plugin_table('wap_nex_forms','form_style','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','is_wrapped','text');
	$database_actions->alter_plugin_table('wap_nex_forms','multistep_settings','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms','multistep_html','longtext');
	
	$database_actions->alter_plugin_table('wap_nex_forms_entries','hostname','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','city','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','region','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','country','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','loc','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','org','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','postal','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','paypal_payment_id','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','paypal_payment_token','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','payment_ammount','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','payment_currency','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','saved_admin_email','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','saved_user_email','longtext');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','saved_user_email_address','text');

	$database_actions->alter_plugin_table('wap_nex_forms_files','location','text');
	$database_actions->alter_plugin_table('wap_nex_forms_files','entry_Id','text');
	
	$database_actions->alter_plugin_table('wap_nex_forms_views','date_time','datetime');
	$database_actions->alter_plugin_table('wap_nex_forms_stats_interactions','date_time','datetime');

	//MIGRATE PAYPAL DATA FOR BACKWARD COMPATIBILITY
	$get_paypal_table = $wpdb->get_var("show tables like '".$wpdb->prefix."wap_nex_forms_paypal"."'");
	if($get_paypal_table)
		{
		if(get_option('convert_paypal')!='1')
			{
			$get_paypal = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_paypal');
	
			foreach($get_paypal as $paypal_data)
				{
				$data_array = array(
					'currency_code'						=>  $paypal_data->currency_code,
					'products'							=>  $paypal_data->products,
					'business'							=>  $paypal_data->business,
					'cmd'								=>  $paypal_data->cmd,
					'return_url'						=>  $paypal_data->return_url,
					'cancel_url'						=>  $paypal_data->cancel_url,
					'lc'								=>  $paypal_data->lc,
					'environment'						=>  $paypal_data->environment
					);
				$update = $wpdb->update ( $wpdb->prefix . 'wap_nex_forms', $data_array, array(	'Id' => $paypal_data->nex_forms_Id) );
				}
			update_option('convert_paypal','1');
			}
		}
		
	$database_actions->alter_plugin_table('wap_nex_forms_entries','paypal_invoice','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','payment_status','text');
	$database_actions->alter_plugin_table('wap_nex_forms_entries','paypal_data','longtext');
	
	
	
	
	
	
}

/***************************************/
/************  ADMIN PAGES  ************/
/***************************************/
//
function NEXForms5_main_page(){
	
	$builder = new NF5_Form_Builder();
	$builder->form_builder_page();
	
	global $wp_styles;
	$include_style_array = array('colors','common','forms','admin-menu','dashboard','list-tables','bootstrap-timepicker','jqui-timepicker','bootstrap-material-datetimepicker','nf-nouislider','nf-jquery-ui','nf-md-checkbox-radio','edit','revisions','media','themes','about','nav-menus','widgets','site-icon','l10n','wp-admin','login','install','wp-color-picker','customize-controls','customize-widgets','customize-nav-menus','press-this','ie','buttons','dashicons','open-sans','admin-bar','wp-auth-check','editor-buttons','media-views','wp-pointer','customize-preview','wp-embed-template-ie','imgareaselect','wp-jquery-ui-dialog','mediaelement','wp-mediaelement','thickbox','deprecated-media','farbtastic','jcrop','colors-fresh','nex-forms-jQuery-UI','nex-forms-font-awesome','nex-forms-bootstrap','nex-forms-fields','nex-forms-ui','nex-forms-admin-style','nex-forms-animate','nex-forms-admin-overrides','nex-forms-admin-bootstrap.colorpickersliders','nex-forms-public-admin','nex-forms-editor','nex-forms-custom-admin','nex-forms-jq-ui','nf-styles-chosen','nf-admin-color-adapt', 'nex-forms-jq-ui','nf-styles-font-menu', 'nex-forms-bootstrap-tour.min','nf-color-adapt-fresh','nf-color-adapt-light','nf-color-adapt-blue','nf-color-adapt-coffee','nf-color-adapt-ectoplasm','nf-color-adapt-midnight','nf-color-adapt-ocean','nf-color-adapt-sunrise', 'nf-color-adapt-default','nex_forms-materialize.min','nex_forms-bootstrap.min','nex_forms-dashboard','nex_forms-font-awesome-5','nex_forms-font-awesome-4-shims','nex_forms-material-icons','ion.rangeSlider','ion.rangeSlider.skinFlat','nex_forms-builder','google-roboto');

	echo '<div class="unwanted_css_array" style="display:none;">';
	foreach($wp_styles->registered as $wp_style=>$array)
		{
		if(!in_array($array->handle,$include_style_array) && !strstr($array->handle,'nex-forms'))
			{
			echo '<div class="unwanted_css">'.$array->handle.'-css</div>';
			}
		}	
	echo '</div>';

}

function NEXForms_form_preview(){
	global $wpdb;
	$get_form = $wpdb->prepare('SELECT md_theme FROM '.$wpdb->prefix.'wap_nex_forms WHERE Id = %d',filter_var($_REQUEST['form_Id'],FILTER_SANITIZE_NUMBER_INT));
	$theme_settings = $wpdb->get_var($get_form);
	$theme_settings = json_decode($theme_settings,true);
	//remove WP elements from preview
	echo '	<style type="text/css">#nex-forms input.form-control:focus, #nex-forms select.form-control:focus, #nex-forms textarea.form-control:focus{border-color:#ddd !important;}#nex-forms .v7_container {margin:0 auto !important;	}#nex-forms .ui-nex-forms-container .label_container label{padding-bottom:5px !important;cursor:default !important;display:block !important;}#nex-forms .submit-button button.btn.col-sm-12 {width:100% !important;}#wpbody-content {height: calc(100%);left: 0;position: absolute;top: 0;width: 80% !important;z-index: 10000000;background:#fff;padding: 30px 10% !important;}div.updated, .update-nag , div.error, #icl_als_help_popup, .wd-notice-body, .notice,.notice-warning,.mom_modal_box, .notice, #dolly,.cts-tip-wrapper{display:none; !important}#wpcontent {margin-left: 0 !important;padding: 10px !important;}#wpadminbar, #adminmenumain, #wpfooter {display: none;}#wpbody {padding-top: 0 !important;}html{background:#fff !important;padding-top:0 !important;}#wpwrap{background:#fff !important;}.wp-admin select {height: auto !important;}.wp-admin .nex-forms-container select {height: 34px !important;}.wp-admin .nex-forms-container .multi-select select {height: auto !important;}#wpfooter{display:none;}.row.outer_container {margin: 0 !important;}#nex-forms .star-rating {white-space: unset;}#adminmenuback{z-index:-1 !important;}</style>';
	if($theme_settings['0']['theme_shade']=='dark')
		echo '<style type="text/css">html, body, #wpcontent, #wpwrap, #wpbody-content  {background: #444 !important;}</style>';
	echo NEXForms_ui_output(filter_var($_REQUEST['form_Id'],FILTER_SANITIZE_NUMBER_INT),'','');
}


function NEXForms_ui_output( $atts , $echo='',$prefill_array=''){

	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
	if(!$page && is_admin())
		return;
		
	ini_set('display_errors', '0');
	error_reporting(0);
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
	global $wpdb;
	
	//class objects
	$config 			= new NEXForms5_Config();
	$nf_functions 		= new NEXForms_Functions();
	$database_actions 	= new NEXForms_Database_Actions();
	
	$unigue_form_Id 	= rand(0,99999);
	$output 			= '';
	$output 			.= '<style type="text/css">#nex-forms{display:none;}</style>';
	if(is_array($atts))
		{
		$defaults = array(
			'id' 					=> '0',
			'open_trigger' 			=> '',
			'auto_popup_delay' 		=> '',
			'auto_popup_scroll_top' => '',
			'exit_intent' 			=> '',
			'type' 					=> 'button',
			'element_class' 		=> '',
			'text' 					=> 'open',
			'make_sticky' 			=> 'no',
			'paddel_text' 			=> 'Contact Us',
			'paddel_color'			=>'btn-light-blue',
			'button_color'			=>'btn-light-blue',
			'position' 				=> 'right',
			'field_default_values' 	=> '',
			'form_style' 			=> 'normal',
			'v_position'			=> 'center',
			'h_position'			=> 'center',
			'v_margin'				=> '0',
			'h_margin'				=> '0',
			'width'					=> '50',
			'height'				=> '60',
			'open_animation'		=> 'fadeInDown',
			'close_animation'		=> 'fadeOutUp',
			'overlay_opacity'		=> '0.5',
			'backdrop'				=> 'true',
			'background'			=> '#ffffff',
			'padding_left'			=> '2',
			'padding_right'			=> '2',
			'padding_top'			=> '2',
			'padding_bottom'		=> '2',
			);
			
		extract( shortcode_atts( $defaults, $atts ) );
		wp_parse_args($atts, $defaults);
		}
	else
		{
		$id						= $atts;
		$open_trigger 			= '';
		$auto_popup_delay 		= '';
		$auto_popup_scroll_top 	= '';
		$exit_intent 			= '';
		$type 					= 'button';
		$element_class 			= '';
		$text 					= 'open';
		$make_sticky 			= 'no';
		$paddel_text 			= 'Contact Us';
		$paddel_color 			= 'btn-light-blue';
		$button_color 			= 'btn-light-blue';
		$position 				= 'right';
		$field_default_values 	= '';
		$form_style 			= 'normal';
		$v_position 			= 'center';
		$h_position 			= 'center';
		$v_margin 				= '0';
		$h_margin 				= '0';
		$width 					= '50';
		$height 				= '80';
		$open_animation 		= 'fadeInDown';
		$close_animation 		= 'fadeOutUp';
		$overlay_opacity		= '0.5';
		$backdrop				= 'true';
		$background				= '#ffffff';
		$padding_left			= '2';
		$padding_right			= '2';
		$padding_top			= '2';
		$padding_bottom			= '2';
		}
	
	$width 				=  (strstr($width,'px')) ? $width : $width.'%';
	$height 			=  (strstr($height,'px')) ? $height : $height.'%';
	
	
	$v_margin 			=  (strstr($v_margin,'px')) ? $v_margin : $v_margin.'%';
	$h_margin 			=  (strstr($h_margin,'px')) ? $h_margin : $h_margin.'%';
	
	$padding_left 		=  (strstr($padding_left,'px')) ? $padding_left : $padding_left.'%';
	$padding_right 		=  (strstr($padding_right,'px')) ? $padding_right : $padding_right.'%';
	$padding_top		=  (strstr($padding_top,'px')) ? $padding_top : $padding_top.'%';
	$padding_bottom 	=  (strstr($padding_bottom,'px')) ? $padding_bottom : $padding_bottom.'%';
	
	
	
		
	$get_form 	= $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms WHERE Id = %d',filter_var($id,FILTER_SANITIZE_NUMBER_INT));
	$form_attr 	= $wpdb->get_row($get_form);

	$default_field_array = explode(',',$field_default_values);
	$set_default_field_array= array();
	
	//FORM WRAPPER STYLING
		$form_css_style = str_replace('\\','',$form_attr->form_style);
		$form_css_style = str_replace('"','\'',$form_css_style);
	
	
	foreach ($default_field_array as $default_field_item)
		{
		$get_field = explode('=',$default_field_item);
		$set_default_field_array[$get_field[0]]=$get_field[1];
		}
	//ADD CONDITIONAL LOGIC SCRIPT
	if($nf_functions->isJson($form_attr->conditional_logic_array))
		{
		$cl_script = $nf_functions->run_conditional_logic(json_decode($form_attr->conditional_logic_array), $unigue_form_Id);	
		wp_add_inline_script( 'nex-forms-onload', $cl_script);
		
		}
	//ADD CONDITIONAL LOGIC SCRIPT (Backward Compatibility)
	else
		$output .= $nf_functions->run_old_conditional_logic($form_attr->conditional_logic, $unigue_form_Id);
	

	
	//OPEN STICKY FORM PADDLES	(IF FORM TYPE IS STICKY)
	if($make_sticky=='yes')
		{
		$output .= '<div id="nex-forms"><div class="nf-sticky-contact-form paddel-'.esc_html($position).'" style="display:none;"><div class="nf-sticky-paddel waves-effect waves-light btn '.esc_html($paddel_color).'">'.esc_html($paddel_text).'</div><div class="nf-sticky-container">';	
		}
	
	//PRINT AUTO POPUP TRIGGERS AND HTML  (IF FORM TYPE IS POPUP)
	if($open_trigger=="popup")
		{
		//AUTO POPUP - Exit Intent
		if($exit_intent==1)
			{
			$output .= '<script type="text/javascript">
				// Exit intent
				function addEvent(obj, evt, fn) {
					if (obj.addEventListener) {
						obj.addEventListener(evt, fn, false);
					}
					else if (obj.attachEvent) {
						obj.attachEvent("on" + evt, fn);
					}
				}
				// Exit intent trigger
				var exit_popup = 0;
				addEvent(document, \'mouseout\', function(evt) {
					if (evt.toElement == null && evt.relatedTarget == null && exit_popup==0) {
						//run_parent_css_reset('.$atts['id'].');
					   jQuery(\'#nexForms_popup_'.$atts['id'].'\').modal(\'open\');
						exit_popup = 1;
					};
				
				});
			</script>';
			}	
		//AUTO POPUP - Scroll Position
		else if($auto_popup_scroll_top!='')
			{
			$output .= '<script type="text/javascript">
				var scroll_popup = 0;
				jQuery(document).on(\'scroll\',
					function()
						{
						if(jQuery(window).scrollTop()>'.$auto_popup_scroll_top.' && scroll_popup==0)
							{
							//run_parent_css_reset('.$atts['id'].');
							jQuery(\'#nexForms_popup_'.$atts['id'].'\').modal(\'open\');
							scroll_popup = 1;
							}
						}
					)
			</script>';
			}
		//AUTO POPUP - Delay
		else if($auto_popup_delay!='')
			{
			$output .= '<script type="text/javascript">
				 setTimeout( function()
						{
						//run_parent_css_reset('.$atts['id'].');
						jQuery(\'#nexForms_popup_'.$atts['id'].'\').modal(\'open\');
						},'.($auto_popup_delay*1000).'
					);
			</script>';
			}
		else
			{
			//POPUP - Custom trigger (from user element class)
			if($type == 'custom_trigger')
				{
				$output .= '<script type="text/javascript">
					jQuery(document).ready(
						function()
							{
							jQuery(document).on(\'click\', ".'.esc_html($element_class).'",
								function(e)
									{
									e.preventDefault();
									run_parent_css_reset('.$atts['id'].');
									jQuery(\'#nexForms_popup_'.$atts['id'].$element_class.'\').modal(\'open\');
									}
								);
							}
						);
				</script>';	
				}					
			}
			
		//MAIN CONTAINER #NEX-FORMS (IF FORM TYPE IS POPUP)
		$output .= '<div id="nex-forms" class="nex-forms '.$nf_functions->format_name($form_attr->title).' ">';
		
			//PRINT PRE-FILL FIELDS ARRAYS 
			$output .= '<div class="pre_fill_fields">';
				if(is_array($prefill_array))
					{
					foreach($prefill_array as $key => $val)
						{	
						if(get_option('nf_activated'))				
						$output .= '<input type="hidden" name="'.$key.'" value="'.str_replace('\\','',filter_var($val,FILTER_SANITIZE_STRING)).'">';	
						}	
					}
				foreach($_REQUEST as $key => $val)
						{
						if(get_option('nf_activated'))					
						$output .= '<input type="hidden" name="'.$key.'" value="'.str_replace('\\','',filter_var($val,FILTER_SANITIZE_STRING)).'">';	
						}
			$output .= '</div>';
		
			//PRINT POPUP BUTTON OR LINK 
			if($type == 'button')
				$output .= '<button class="btn mb-btn waves-effect waves-light '.esc_html($button_color).' open_nex_forms_popup" data-ufid="'.$unigue_form_Id.'" data-default-values="'.$field_default_values.'" data-popup-id="'.$atts['id'].'">'.esc_html($text).'</button>';
			else if($type == 'link')
				$output .= '<a href="#" class="open_nex_forms_popup" data-ufid="'.$unigue_form_Id.'" data-default-values="'.$field_default_values.'" data-popup-id="'.$atts['id'].'">'.esc_html($text).'</a>';
			else
				$output .= '';
			
			

			
		//OPEN POPUP MODAL
			$output .= '<div data-backdrop="'.$backdrop.'" data-open-animation="'.$open_animation.'" data-close-animation="'.$close_animation.'" data-overlay-opacity="'.$overlay_opacity.'" class="modal '.((!get_option('nf_activated')) ? 'do_nf_popup' : '' ).' fade nex_forms_modal animated '.(($background=='transparent') ? 'no_shadow' : '').' '.$open_animation.' v_'.$v_position.' h_'.$h_position.'" style="'.(($background=='use-form-background') ? $form_css_style : 'background:'.$background.';padding-left:'.$padding_left.' !important; padding-right:'.$padding_right.' !important; padding-top:'.$padding_top.' !important; padding-bottom:'.$padding_bottom.' !important;').'width:'.$width.' !important;height:'.$height.' !important; margin: '.$v_margin.' '.$h_margin.'; " id="nexForms_popup_'.$atts['id'].$element_class.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">';
				$output .= '<div class="modal-header ">';
					$output .= '<h4 class="modal-title">'.$form_attr->title.'</h4>';
					$output .= '<div style="clear:both;"></div>';
				$output .= '</div>';
				$output .= '<span class="modal-action modal-close '.$button_color.'"><i class="material-icons fa fa-close"></i></span>';
				$output .= '<div class="modal-content">';	
		}
		
		
		$option_settings = json_decode($form_attr->option_settings,true);

		$theme_settings = json_decode($form_attr->md_theme,true);
	
		$set_theme 			= ($theme_settings['0']['theme_name']!='') 	? $theme_settings['0']['theme_name'] 	: 'default';
		$set_theme_shade 	= ($theme_settings['0']['theme_shade']!='') ? $theme_settings['0']['theme_shade'] 	: 'light';

		//MAIN CONTAINER #NEX-FORMS
		$output .= '<div id="nex-forms" class="nex-forms '.$nf_functions->format_name($form_attr->title).' '.(($make_sticky=='yes' && !get_option('nf_activated')) ? 'do_nf_sticky' : '' ).' '.(($make_sticky=='yes') ? 'is-nf-sticky-form' : '').'">';
			
			
			//PRINT PRE-FILL FIELDS ARRAYS 
			$output .= '<div class="pre_fill_fields">';
				if(is_array($prefill_array))
					{
					foreach($prefill_array as $key => $val)
						{
						if(get_option('nf_activated'))		
						$output .= '<input type="hidden" name="'.$key.'" value="'.str_replace('\\','',filter_var($val,FILTER_SANITIZE_STRING)).'">';	
						}	
					}
				foreach($_REQUEST as $key => $val)
						{	
						if(get_option('nf_activated'))				
						$output .= '<input type="hidden" name="'.$key.'" value="'.str_replace('\\','',filter_var($val,FILTER_SANITIZE_STRING)).'">';	
						}
			$output .= '</div>';
			
			//SET THEME
			$output .= '<div class="set_form_theme theme-'.$set_theme.'">';
				//AJAX ON-SCREEN SUCCESS MESSAGE
				$output .= '<div class="nex_success_message animated" style="display:none;">';
					$output .= '<div class="success_header">';
						$output .= '<div class="success_icon animated" style="display:none;"><span class="fa fa-check"></span></div>';
					$output .= '</div>';
					$output .= '<div class="msg_box">';
						$output .= '<div class="msg_text" style="display:none;">'.str_replace('\\','',wpautop($form_attr->on_screen_confirmation_message)).'</div>';
					$output .= '</div>';
				$output .= '</div>';

				//#ui-nex-forms-container start
				$output .= '<div class="ui-nex-forms-container '.(($form_attr->form_theme) ? $form_attr->form_theme : 'bootstrap').'" id="ui-nex-forms-container"  >';
					
					$output .= '<div class="current_step" style="display:none;">1</div>';
		
					global $wp;
					$current_url 		= home_url( add_query_arg( array(), $wp->request ) );
					$post_action 		= ($form_attr->post_action=='ajax' || !$form_attr->post_action) ? admin_url('admin-ajax.php') : $form_attr->custom_url;
					$set_ajax	 		= ($form_attr->post_action=='ajax' || !$form_attr->post_action) ? 'submit-nex-form' : 'send-nex-form';
					$post_method 		= 'post';
					$multistep_settings = json_decode($form_attr->multistep_settings,true);
					if($form_attr->post_action!='ajax')
						$post_method 	= ($form_attr->post_type=='POST' || !$form_attr->post_type) ? 'post' : 'get';
						
					
					//PRINT MULTI-STEP BREADCRUMB (If outside Form Wrapper and position is top)
					if($multistep_settings[0]['show_inside']=='no' && $multistep_settings[0]['show_front_end']=='yes' && ($multistep_settings[0]['bc_position']=='top' || !$multistep_settings[0]['bc_position']) )
						$output .= '<div class="nf_step_breadcrumb">'.str_replace('\\','',$form_attr->multistep_html).'</div>';
					
					$set_confirmation_page = $form_attr->confirmation_page;
							if(class_exists('NEXForms_Shortcode_Processor'))
									{
									$shorcode_processor = new NEXForms_Shortcode_Processor();
									$set_confirmation_page = $shorcode_processor->process_shortcodes($set_confirmation_page);
									}
					//hidden elements used by JS
					$output .= '<div id="the_plugin_url" style="display:none;">'.plugins_url('',__FILE__).'</div>';
					$output .= '<div id="nf_save_form_progress" style="display:none;">'.$option_settings[0]['save_form_progress'].'</div>';
					if(get_option('nf_activated')){
					$output .= '<div id="confirmation_page" class="confirmation_page" style="display:none;">'.$set_confirmation_page.'</div>';
					$output .= '<div id="on_form_submmision" class="on_form_submmision" style="display:none;">'.$form_attr->on_form_submission.'</div>';}
					$output .= '<div class="hidden" id="nf_ajax_url" style="display:none;">'.admin_url('admin-ajax.php').'</div>';
					$output .= '<div class="hidden" id="paypal_return_url" style="display:none;">'.$current_url.'</div>';
					$output .= '<div class="hidden" id="ms_scroll_to_top" style="display:none;">'.$multistep_settings[0]['scroll_to_top'].'</div>';
					if(!get_option('nf_activated')){ $post_action = admin_url('admin-ajax.php');$post_method = 'post';}
					//PAYPAL SUCCESS / FAILURE MESSAGE (If paypal ios enabled)
					if($form_attr->is_paypal=='yes' && function_exists('nf_not_found_notice_ppp'))
						{
						$paypal_transaction = isset($_REQUEST['nf-paypal-transaction']) ? $_REQUEST['nf-paypal-transaction'] : '';
						$paypal_token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
						if($paypal_transaction==1)
							{
							$payment_details = nf_get_paypal_payment($paypal_token);
							$output .= '<div class="hidden" id="resend_email_nex_forms_Id" value="">'.$payment_details['nex_forms_Id'].'</div>';
							$output .= '<div class="hidden" id="resend_email_entry_Id" value="">'.$payment_details['entry_Id'].'</div>';
							
							if($payment_details['payment_verified'])
								{
								$output .= '<div class="nex_success_message animated">';
									$output .= '<div class="success_header">';
										$output .= '<div class="success_icon animated"><span class="fa fa-check"></span></div>';
									$output .= '</div>';
									$output .= '<div class="msg_box">';
										$output .= '<div class="msg_text" >'.str_replace('\\','',$form_attr->payment_success_msg).'</div>';
									$output .= '</div>';
								$output .= '</div>';
								}
							else
								$output .= '<div class="panel-body alert alert-danger">'.str_replace('\\','',$form_attr->payment_failed_msg).'</div>';
							}
						}
						
						
						
						//SETUP SUBMISSION LIMIT
						$submit_limit = false;
						if($option_settings[0]['submit_limit']>0)
							{
								$get_count 	= $wpdb->get_var('SELECT COUNT(*) FROM '.$wpdb->prefix.'wap_nex_forms_entries WHERE nex_forms_Id = '.$id);
								if($get_count==$option_settings[0]['submit_limit'])
									{
									if($option_settings[0]['submit_limit_msg'])
										$output .= '<div class="alert alert-info"><p>'.$option_settings[0]['submit_limit_msg'].'</p></div>';
										
									$submit_limit = true;
									}
							}
						
						
						//FORM WRAPPER CONTAINER
						$output .= '<div class="v7_container form_type_'.$form_style.' '.(($submit_limit) ? 'hidden' : '').' " style="'.(($background != 'use-form-background') ? $form_css_style : '').'">';
						$output .= '<div class="current_field_on_focus" style="display:none">1</div>';
							//PRINT MULTI-STEP BREADCRUMB (If inside Form Wrapper and position is top)
							if($multistep_settings[0]['show_inside']=='yes' && $multistep_settings[0]['show_front_end']=='yes' && ($multistep_settings[0]['bc_position']=='top' || !$multistep_settings[0]['bc_position']))
								$output .= '<div class="nf_step_breadcrumb">'.str_replace('\\','',$form_attr->multistep_html).'</div>';
							
							//<FORM> Start
							$output .= 	'<form id="nf_form_'.$unigue_form_Id.'" class="'.$set_ajax.'" name="nex_form" action="'.$post_action.'" method="'.$post_method.'" enctype="multipart/form-data">';
								//hidden fields
								if(function_exists('nf_not_found_notice_pp'))
									$output .= '<input type="hidden" name="paypal_invoice" value="'.rand(0,9999999).'">';
									
								$output .= '<input type="hidden" name="nex_forms_Id" value="'.$id.'">';
								$output .= '<input type="hidden" name="page" value="'.$_SERVER['REQUEST_URI'].'">';
								$output .= '<input type="hidden" name="ip" value="'.$_SERVER['REMOTE_ADDR'].'">';
								
								$_SERVER['DATE_TIME'] 			= date(get_option('date_format').' '.get_option('time_format'));
								$_SERVER['DATE'] 				= date(get_option('date_format'));
								$_SERVER['DATE_DAY'] 			= date('d');
								$_SERVER['DATE_MONTH'] 			= date('m');
								$_SERVER['DATE_YEAR'] 			= date('Y');
								$_SERVER['TIME'] 				= date(get_option('time_format'));
								$_SERVER['FORM_TITLE'] 			= $form_attr->title;
								$_SERVER['C_PAGE'] 				= $_SERVER['REQUEST_URI'];
								$_SERVER['WP_USER_IP']			= $_SERVER['REMOTE_ADDR'];
								$_SERVER['HTTP_REFERER'] 		= $_SERVER['HTTP_REFERER'];
								$_SERVER['WP_USER_ID'] 			= get_current_user_id();
								$_SERVER['WP_USER'] 			= $database_actions->get_username(get_current_user_id());
								$_SERVER['WP_USER_FIRST_NAME'] 	= $database_actions->get_user_firstname(get_current_user_id());
								$_SERVER['WP_USER_LAST_NAME'] 	= $database_actions->get_user_lastname(get_current_user_id());
								$_SERVER['WP_USER_EMAIL'] 		= $database_actions->get_useremail(get_current_user_id());
								$_SERVER['WP_USER_URL'] 		= $database_actions->get_userurl(get_current_user_id());
								
								//PRINT CUSTOM HIDDEN FIELDS
								if($nf_functions->isJson($form_attr->hidden_fields))
									{
									$hidden_fields_array = json_decode($form_attr->hidden_fields);
									if(!empty($hidden_fields_array))
										{
										foreach($hidden_fields_array as $hidden_field)
											{
											$hidden_field_val = $hidden_field->field_value;
											$pattern = '({{+([A-Za-z 0-9_])+}})';
											preg_match_all($pattern, $hidden_field_val, $matches);
											foreach($matches[0] as $match)
												{
												$hidden_field_val = str_replace($match,$_SERVER[str_replace('{','',str_replace('}','',$match))],$hidden_field_val);
												}
											if($hidden_field->field_name)
												$output .= '<input type="hidden" name="'.$hidden_field->field_name.'" value="'.$hidden_field_val.'">';
											}	
										}
									}
								//PRINT CUSTOM HIDDEN FIELDS (Backward Compatibility)
								else
									{
									$hidden_fields_raw = explode('[end]',$form_attr->hidden_fields);
									foreach($hidden_fields_raw as $hidden_field)
										{
										$hidden_field = explode('[split]',$hidden_field);
										$hidden_field_val = (isset($hidden_field[1])) ? $hidden_field[1] : '';
										$pattern = '({{+([A-Za-z 0-9_])+}})';
										preg_match_all($pattern, $hidden_field_val, $matches);
										foreach($matches[0] as $match)
											{
											$hidden_field_val = str_replace($match,$_SERVER[str_replace('{','',str_replace('}','',$match))],$hidden_field_val);
											}
										if($hidden_field[0])
											$output .= '<input type="hidden" name="'.$hidden_field[0].'" value="'.$hidden_field_val.'">';
										}
									}
									
								//GET CLEAN FORM HTML	
								$set_form_html = ($form_attr->clean_html) ? str_replace('\\','',$form_attr->clean_html) : str_replace('\\','',$form_attr->form_fields);
								
								//GET LOGGED IN USER INFO
								$get_user_first_name 	= $database_actions->get_user_firstname(get_current_user_id());
								$get_user_last_name 	= $database_actions->get_user_lastname(get_current_user_id());
								$get_user_name 			= $database_actions->get_username(get_current_user_id());
								$get_user_user_email 	= $database_actions->get_useremail(get_current_user_id());
								$get_user_user_url	 	= $database_actions->get_userurl(get_current_user_id());
								
								//SET DEAFAULT VALUES FOR LOGGED IN USERS
								$set_form_html = str_replace('{{nf_user_first_name}}',$get_user_first_name,$set_form_html);
								$set_form_html = str_replace('{{nf_user_last_name}}',$get_user_last_name,$set_form_html);
								$set_form_html = str_replace('{{nf_user_name}}',$get_user_name,$set_form_html);
								
								$set_form_html = str_replace('{{nf_user_email}}',$get_user_user_email,$set_form_html);
								$set_form_html = str_replace('{{nf_user_url}}',$get_user_user_url,$set_form_html);
								
								//RUN 3rd party shortcodes on HTML if add-on is enabled
								if(class_exists('NEXForms_Shortcode_Processor'))
									{
									$shorcode_processor = new NEXForms_Shortcode_Processor();
									$set_form_html = $shorcode_processor->process_shortcodes($set_form_html);
									}
								$output .= '<input type="text" name="company_url" value="" placeholder="enter company url" class="form-control req">';		
								//PRINT SAVED FORM
								$output .=  $set_form_html;
								$output .= '<div style="clear:both;"></div>';
								if(!get_option('nf_activated'))
									$output .= '<small class="free_version">Powered by <a href="https://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?ref=Basix&src=powered_by">NEX-Forms</a></small>';
						
							$output .= 	'</form>';
						
						//PRINT MULTI-STEP BREADCRUMB (If inside Form Wrapper and position is bottom)
						if($multistep_settings[0]['show_inside']=='yes' && $multistep_settings[0]['show_front_end']=='yes' && $multistep_settings[0]['bc_position']=='bottom')
							$output .= '<div class="nf_step_breadcrumb">'.str_replace('\\','',$form_attr->multistep_html).'</div>';
							
					$output .= 	'</div>'; //FORM WRAPPER CONTAINER
					//PRINT MULTI-STEP BREADCRUMB (If outside Form Wrapper and position is bottom)
					if($multistep_settings[0]['show_inside']=='no' && $multistep_settings[0]['show_front_end']=='yes' && $multistep_settings[0]['bc_position']=='bottom')
						$output .= '<div class="nf_step_breadcrumb">'.str_replace('\\','',$form_attr->multistep_html).'</div>';
						
				$output .= '</div>'; //#ui-nex-forms-container
			$output .= '</div>'; //theme container
		$output .= '</div>'; //#nex-forms
		
	//CLOSE POPUP MODAL
	if($open_trigger=="popup")	
		$output .= '</div></div></div>';
	
	//CLOSE STICKY
	if($make_sticky=='yes')	
		$output .= '</div></div></div>';
	
	
	
	//OUTPUT CUSTOM USER CSS
	$output .= '<style type="text/css" class="nex-forms-custom-css">'.str_replace('\\','',$form_attr->custom_css).'</style>';
		
	//SET VERSION FOR CACHING PURPOSES		
	$css_js_version = $config->plugin_version.'.4';

	// SCRIPTS AND STYLE ENQUEUES	
	//$output .= '<style type="text/css">#nex-forms{ display:none; }</style>';
	
	$script_config = get_option('nex-forms-script-config');
	$styles_config = get_option('nex-forms-style-config');
	$other_config = get_option('nex-forms-other-config');

	$theme_settings = json_decode($form_attr->md_theme,true);
	
	$set_theme 			= ($theme_settings['0']['theme_name']!='') 	? $theme_settings['0']['theme_name'] 	: 'default';
	$set_theme_shade 	= ($theme_settings['0']['theme_shade']!='') ? $theme_settings['0']['theme_shade'] 	: 'light';

	if($set_theme=='default')
		$output .= '<script type="text/javascript">var md_time_color = \'607d8b\';</script>';
	if($set_theme=='red')
		$output .= '<script type="text/javascript">var md_time_color = \'f44336\';</script>';
	if($set_theme=='pink')
		$output .= '<script type="text/javascript">var md_time_color = \'e91e63\';</script>';
	if($set_theme=='purple')
		$output .= '<script type="text/javascript">var md_time_color = \'9c27b0\';</script>';
	if($set_theme=='deep-purple')
		$output .= '<script type="text/javascript">var md_time_color = \'673ab7\';</script>';
	if($set_theme=='indigo')
		$output .= '<script type="text/javascript">var md_time_color = \'3f51b5\';</script>';
	if($set_theme=='blue')
		$output .= '<script type="text/javascript">var md_time_color = \'2979FF\';</script>';
	if($set_theme=='light-blue')
		$output .= '<script type="text/javascript">var md_time_color = \'40C4FF\';</script>';
	if($set_theme=='cyan')
		$output .= '<script type="text/javascript">var md_time_color = \'00bcd4\';</script>';
	if($set_theme=='teal')
		$output .= '<script type="text/javascript">var md_time_color = \'009688\';</script>';
	if($set_theme=='green')
		$output .= '<script type="text/javascript">var md_time_color = \'4caf50\';</script>';
	if($set_theme=='light-green')
		$output .= '<script type="text/javascript">var md_time_color = \'8bc34a\';</script>';
	if($set_theme=='lime')
		$output .= '<script type="text/javascript">var md_time_color = \'cddc39\';</script>';
	if($set_theme=='yellow')
		$output .= '<script type="text/javascript">var md_time_color = \'F0D800\';</script>';
	if($set_theme=='amber')
		$output .= '<script type="text/javascript">var md_time_color = \'ffc107\';</script>';
	if($set_theme=='orange')
		$output .= '<script type="text/javascript">var md_time_color = \'ff9800\';</script>';
	if($set_theme=='brown')
		$output .= '<script type="text/javascript">var md_time_color = \'795548\';</script>';
	if($set_theme=='')
		$output .= '<script type="text/javascript">var md_time_color = \'673ab7\';</script>';
	if($set_theme=='gray')
		$output .= '<script type="text/javascript">var md_time_color = \'9e9e9e\';</script>';
	if($set_theme=='blue-gray')
		$output .= '<script type="text/javascript">var md_time_color = \'607d8b\';</script>';

	
	if($script_config['inc-bootstrap']=='1' || !$script_config['inc-bootstrap'])
		wp_enqueue_script('nex-forms-bootstrap.min');
		
	if($script_config['inc-wow']=='1' || !$script_config['inc-wow'])
		{
		wp_enqueue_script('nex-forms-wow');
		$output .= '<script type="text/javascript">var get_wow = \'enabled\';</script>';
		}
	else
		$output .= '<script type="text/javascript">var get_wow = \'disabled\';</script>';
		
	if($script_config['inc-raty']=='1' || !$script_config['inc-raty'])
		{
		wp_enqueue_script('nex-forms-raty-fa');
		$output .= '<script type="text/javascript">var get_raty = \'enabled\';</script>';
		}
	else
		$output .= '<script type="text/javascript">var get_raty = \'disabled\';</script>';

	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-autocomplete');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-form');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-touch-punch');	
	wp_enqueue_script('nex-forms-materialize.min');
	wp_enqueue_script('nex-forms-onload');
	wp_enqueue_script('nex-forms-math.min');
	
	wp_enqueue_script('nex-forms-moment.min');
	wp_enqueue_script('nex-forms-locales.min');	
	wp_enqueue_script('nex-forms-bootstrap-datetimepicker');
	wp_enqueue_script('nex-forms-bootstrap-material-datetimepicker');
	wp_enqueue_script('nex-forms-jqui-timepicker');
	wp_enqueue_script('nex-forms-bootstrap-touchspin');
	wp_enqueue_script('nex-forms-auto-save');

	if($styles_config['incstyle-font-awesome']=='1' || !$script_config['incstyle-font-awesome'])
		{
		wp_enqueue_style('nex-forms-font-awesome-5');
		wp_enqueue_style('nex-forms-font-awesome-4-shims');
		}
	if($styles_config['incstyle-bootstrap']=='1' || !$script_config['incstyle-bootstrap'])
		wp_enqueue_style('nex-forms-bootstrap-ui');
	wp_enqueue_style('nex-forms-ui');
	wp_enqueue_style('nex-forms-fields');
	if($styles_config['incstyle-animations']=='1' || !$script_config['incstyle-animations'])
		wp_enqueue_style('nex-forms-animations');		
	wp_enqueue_style('nex-forms-bootstrap-material-datetimepicker');
	wp_enqueue_style('nex-forms-jqui-timepicker');
	wp_enqueue_style('nex-forms-bootstrap-touchspin');
	if($form_attr->form_theme=='m_design' || $form_attr->form_theme=='neumorphism')
		wp_enqueue_style('nex-forms-material-theme-'.$set_theme);
	if(function_exists('nf_not_found_notice_ft'))
		wp_enqueue_style('nex-forms-jq-ui-theme-'.$form_attr->jq_theme);
	wp_enqueue_style('nex-forms-nouislider', plugins_url( '/css/nouislider.css',__FILE__),'',$css_js_version);
	wp_enqueue_style('nex-forms-materialize', plugins_url( '/css/materialize-ui.css',__FILE__),'',$css_js_version);	
	//wp_enqueue_style('nex-forms-md-checkbox-radio', plugins_url( '/css/material-checkboxradio.css',__FILE__),'',$css_js_version);
		
	
	//SEND EMAIL BASED ON PAYPAL PAYMENT FAIL/SUCCESS (if paypal is enabled)
	$paypal_transaction = isset($_REQUEST['nf-paypal-transaction']) ? $_REQUEST['nf-paypal-transaction'] : '';
	$paypal_token = isset($_REQUEST['token']) ? $_REQUEST['token'] : '';
	if($paypal_transaction==1)
		{
		$payment_details = nf_get_paypal_payment($paypal_token);
		$email_alerts = explode(',',$form_attr->email_on_payment_success);
		if($payment_details['payment_verified']==1 && in_array('payments',$email_alerts))
			{
			echo '<script type="text/javascript">jQuery(document).ready(
					function()
						{
						resend_nf_email();
						}
				);
				</script>';
			}
		if($payment_details['payment_verified']==0 && in_array('failures',$email_alerts))
			{
			echo '<script type="text/javascript">jQuery(document).ready(
					function()
						{
						resend_nf_email();	
						}
				);
				</script>';
			}
		}
	
	//PRINT OUTPUT
	if($echo)
		echo $output;
	else
		return $output;	
}





add_action( 'wp_ajax_submit_nex_form', 'submit_nex_form');
add_action( 'wp_ajax_nopriv_submit_nex_form', 'submit_nex_form');

add_action( 'wp_ajax_nf_resend_email', 'nf_send_mail');
add_action( 'wp_ajax_nopriv_nf_resend_email', 'nf_send_mail');

add_action( 'wp_ajax_nf_add_form_view', 'NEXForms_add_view');
add_action( 'wp_ajax_nopriv_nf_add_form_view', 'NEXForms_add_view');
function NEXForms_add_view(){

	global $wpdb;
	$id = sanitize_text_field($_POST['nex_forms_id']);
	$add_view = $wpdb->insert($wpdb->prefix.'wap_nex_forms_views',
		array(								
			'time_viewed'		=> mktime(),
			'nex_forms_Id'		=> filter_var($id,FILTER_SANITIZE_NUMBER_INT),
			'date_time'			=> date('Y-m-d H:i:s'),
			)
		 );
	die();
}


add_action( 'wp_ajax_nf_add_form_interaction', 'NEXForms_add_form_interaction');
add_action( 'wp_ajax_nopriv_nf_add_form_interaction', 'NEXForms_add_form_interaction');
function NEXForms_add_form_interaction(){
	
	global $wpdb;
	$id = sanitize_text_field($_POST['nex_forms_id']);
	$add_interaction = $wpdb->insert($wpdb->prefix.'wap_nex_forms_stats_interactions',
		array(								
			'time_interacted'	=> mktime(),
			'nex_forms_Id'		=> filter_var($id,FILTER_SANITIZE_NUMBER_INT),
			'date_time'			=> date('Y-m-d H:i:s'),
			)
		 );
	die();
}

function submit_nex_form(){
	
	//ANTI SPAM
	if(($_POST['company_url']!='' && $_POST['company_url']!='enter company url') || strstr($_POST['email'],'@qq.com'))
		die();
	
	global $wpdb;
	$nf_functions = new NEXForms_Functions();
	$nf7_functions = new NEXForms_Functions();
	$database_actions = new NEXForms_Database_Actions();
	
	$nex_forms_id = isset($_REQUEST['nex_forms_Id']) ? filter_var($_POST['nex_forms_Id'],FILTER_SANITIZE_NUMBER_INT) : '';
	
	$get_form = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms WHERE Id = %d',$nex_forms_id);
	$form_attr = $wpdb->get_row($get_form);
	
	$upload_settings = json_decode($form_attr->upload_settings, true);
	$upload_to_server 	= ($upload_settings['0']['upload_to_server']) ? $upload_settings['0']['upload_to_server'] 	: 'true';


	$insert_file_array = array();
	
	foreach($_FILES as $key=>$file)
		{
		$multi_file_array = array();
		if(is_array($_FILES[$key]['name']))
			{
				$group_array  = '';
			if(strstr($key,'gu__'))
				{
				$group_name = str_replace('gu__','',$key);
				$group_name = explode('__',$group_name);
				}
				foreach($_FILES[$key]['name'] as $mkey => $mval)
					{
					
					
					
						$multi_file_array[$key.'_'.$mkey] = array(
							'name'=>$_FILES[$key]['name'][$mkey],
							'type'=>$_FILES[$key]['type'][$mkey],
							'tmp_name'=>$_FILES[$key]['tmp_name'][$mkey],
							'error'=>$_FILES[$key]['error'][$mkey],
							'size'=>$_FILES[$key]['size'][$mkey]
							);
						
					}
					$file_names = '';
					$group_num = 1;
					foreach($multi_file_array as $ukey=>$ufile)
						{
						$uploadedfile = $multi_file_array[$ukey];
						$upload_overrides = array( 'test_form' => false );
						
						$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
						
						if ( $movefile )
							{
							if($movefile['file'])
								{
								$insert_file_array[$uploadedfile['name']] = array(
									'name' 		=> $uploadedfile['name'],
									'type' 		=> $uploadedfile['type'],
									'size' 		=> $uploadedfile['size'],
									'location' 	=> $movefile['file'],
									'url' 		=> $movefile['url'],
									);		
								$set_file_name = str_replace(ABSPATH,'',$movefile['file']);
								$file_names .= get_option('siteurl').'/'.$set_file_name. ',';
								$files[] = $movefile['file'];
								$filenames[] = get_option('siteurl').'/'.$set_file_name;
								$_POST[$group_name[0]][$group_num][$group_name[1]] = get_option('siteurl').'/'.$set_file_name;
								$group_num++;
								}
							}
						else
							{
							echo "Possible file upload attack!\n".$movefile['error'];
							}
						}
						
			$_POST[$key] = $file_names;
			}
		else
			{
			
			$uploadedfile = $_FILES[$key];
			$upload_overrides = array( 'test_form' => false );
			//if($upload_to_server=='true')
				$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
			
			if ( $movefile )
				{
				if($movefile['file'])
					{
					$insert_file_array[$uploadedfile['name']] = array(
						'name' 		=> $uploadedfile['name'],
						'type' 		=> $uploadedfile['type'],
						'size' 		=> $uploadedfile['size'],
						'location' 	=> $movefile['file'],
						'url' 		=> $movefile['url'],
						);	
					$set_file_name = str_replace(ABSPATH,'',$movefile['file']);
					$set_file_name = str_replace(ABSPATH,'',$movefile['file']);
					$_POST[$key] = get_option('siteurl').'/'.$set_file_name;
					$files[] = $movefile['file'];
					$filenames[] = get_option('siteurl').'/'.$set_file_name;
					}
				}
			else
				{
				echo "Possible file upload attack!\n".$movefile['error'];
				}
			}
		}
	

/*******************************************************************************************************/
/************************************* INSERT POST DATA ************************************************/
/*******************************************************************************************************/
	
	
		$data_array 	= array();
		$i				= 1;

		foreach($_POST as $key=>$val)
			{
			if(
			$key!='paypal_invoice' &&
			$key!='paypal_return_url' &&
			$key!='math_result' &&
			$key!='set_file_ext' &&
			$key!='format_date' &&
			$key!='action' &&
			$key!='set_radio_items' &&
			$key!='change_button_layout' &&
			$key!='set_check_items' &&
			$key!='set_autocomplete_items' &&
			$key!='required' &&
			$key!='xform_submit' &&
			$key!='current_page' &&
			$key!='ajaxurl' &&
			$key!='page_id' &&
			$key!='page' &&
			$key!='ip' &&
			$key!='nex_forms_Id' &&
			$key!='company_url' &&
			$key!='ms_current_step' &&
			$key!='submit' &&
 			!strstr($key,'real_val') &&
			!strstr($key,'gu__')
			)
				{
				
				if(array_key_exists('real_val__'.$key,$_POST))
					{
					$admin_val = $_POST['real_val__'.$key];
					$val = $_POST['real_val__'.$key];
					}	
				
				$data_array[] = array('field_name'=>$key,'field_value'=>str_replace('\\','',$val));
				$i++;
				}
			}		
		$user_fields .= '</table>';
	
		
	if($form_attr->is_paypal=='yes')
		{
		if(function_exists('run_nf_adv_paypal'))
			$paypal_transaction = run_nf_adv_paypal($form_attr->Id, $_POST, $_POST['paypal_return_url']);
		}
	$geo_data = json_decode($nf7_functions->get_geo_location($_SERVER['REMOTE_ADDR']));
	if(!get_option('nf_activated'))
		$checked = 'false';
	else
		$checked = 'true';
	$insert = $wpdb->insert($wpdb->prefix.'wap_nex_forms_entries',
		array(								
			'nex_forms_Id'			=>	filter_var($_REQUEST['nex_forms_Id'],FILTER_SANITIZE_NUMBER_INT),
			'page'					=>	filter_var($_POST['page'],FILTER_SANITIZE_URL),
			'ip'					=>  filter_var($_POST['ip'],FILTER_SANITIZE_STRING),
			'paypal_invoice'		=>  filter_var($_POST['paypal_invoice'],FILTER_SANITIZE_NUMBER_INT),
			'user_Id'				=>	get_current_user_id(),
			'hostname'				=>	$geo_data->hostname,
			'city'					=>	$geo_data->city,
			'region'				=>	$geo_data->region,
			'country'				=>	$geo_data->country,
			'loc'					=>	$geo_data->loc,
			'org'					=>	$geo_data->org,
			'postal'				=>	$geo_data->postal,
			'date_time'				=>  date('Y-m-d H:i:s'),
			'form_data'				=>	json_encode($data_array),
			'paypal_payment_token'	=>  $paypal_transaction['payment_token'],
			'paypal_payment_id'		=>  $paypal_transaction['payment_id'],
			'payment_ammount'		=>  $paypal_transaction['payment_ammount'],
			'payment_currency'		=>  $paypal_transaction['payment_currency'],
			'payment_status'		=>  'pending',
			)
	 );
	$entry_id = $wpdb->insert_id;
	if($upload_to_server=='true')
		{
		$setup_file_insert_array = array();
		foreach($insert_file_array as $key=>$val)
			{
			$setup_file_insert_array[$key] = array(
				'name' 		=> $val['name'],
				'type' 		=> $val['type'],
				'size' 		=> $val['size'],
				'location' 	=> $val['location'],
				'url' 		=> $val['url'],
				'nex_forms_Id'=>filter_var($_REQUEST['nex_forms_Id'],FILTER_SANITIZE_NUMBER_INT),
				'entry_Id' => $entry_id
			);
		}
		foreach($setup_file_insert_array as $insert_file)
			{
			$wpdb->insert($wpdb->prefix.'wap_nex_forms_files',$insert_file);
			}
		}
	
	
	
	
/*******************************************************************************************************/
/****************************************** SEND EMAILS ************************************************/
/*******************************************************************************************************/
	
	
		$email_alerts = explode(',',$form_attr->email_on_payment_success);
		if(!in_array('before_payments',$email_alerts) && ($form_attr->is_paypal=='yes' && function_exists('run_nf_adv_paypal')))
			{
			nf_send_mail($nex_forms_id,$entry_id,false,false,$files, $checked);
			}
		else
			{
			nf_send_mail($nex_forms_id,$entry_id,false,true,$files, $checked);
			}
	if($checked=='true' && get_option('nf_activated'))
		{	
		
/**************************************************/
/** PAYPAL ****************************************/
/**************************************************/
	if($form_attr->is_paypal=='yes' && $checked=='true')
		{
		if(function_exists('nf_get_paypal_payment')){
			?>
			<script type="text/javascript">
				window.location = '<?php echo $paypal_transaction['approval_link']; ?>';
			</script>
			<?php
		}
		else if(function_exists('nf_not_found_notice_pp') && $checked=='true'){
			$do_get_result = $wpdb->prepare('SELECT * FROM '. $wpdb->prefix .'wap_nex_forms WHERE Id = %d',filter_var($form_attr->Id,FILTER_SANITIZE_NUMBER_INT));
			
			$get_result = $wpdb->get_row($do_get_result);
			
			if(!$get_result->products)
				{
				$do_get_result = $wpdb->prepare('SELECT * FROM '. $wpdb->prefix .'wap_nex_forms_paypal WHERE nex_forms_Id = %d ',filter_var($form_attr->Id,FILTER_SANITIZE_NUMBER_INT));
			
				$get_result = $wpdb->get_row($do_get_result);	
				}
			
			$output = '<form id="nf_paypal" name="nf_paypal" action="https://www'.((!$get_result->environment || $get_result->environment=='sandbox') ? '.sandbox' : '').'.paypal.com/cgi-bin/webscr" method="post" target="_top" class="hidden">
			
			<input type="hidden" name="cmd" value="_cart">
			<input type="hidden" value="'.$get_result->currency_code.'" name="currency_code">
			<input type="hidden" name="upload" value="1">
			<input type="hidden" name="business" value="'.$get_result->business.'">
			<input type="hidden" value="2" name="rm">     
			<input type="hidden" value="'.filter_var($_POST['paypal_invoice'],FILTER_SANITIZE_NUMBER_INT).'" name="invoice">
			<input type="hidden" value="'.$get_result->lc.'" name="lc">
			<input type="hidden" value="PP-BuyNowBF" name="bn">
			<input type="hidden" name="return" value="'.(($get_result->return_url) ? $get_result->return_url : get_option('siteurl').filter_var($_POST['page'],FILTER_SANITIZE_STRING)).'">
			<input type="hidden" name="cancel_return" value="'.(($get_result->cancel_url) ? $get_result->cancel_url : get_option('siteurl').filter_var($_POST['page'],FILTER_SANITIZE_STRING)).'">
			  ';
			$products = explode('[end_product]',$get_result->products);
			$i=1;
					
			foreach($products as $product)
				{
				$item_name =  explode('[item_name]',$product);
				$item_name2 =  explode('[end_item_name]',$item_name[1]);
	
				$item_qty =  explode('[item_qty]',$product);
				$item_qty2 =  explode('[end_item_qty]',$item_qty[1]);
				
				$map_item_qty =  explode('[map_item_qty]',$product);
				$map_item_qty2 =  explode('[end_map_item_qty]',$map_item_qty[1]);
				
				$set_quantity =  explode('[set_quantity]',$product);
				$set_quantity2 =  explode('[end_set_quantity]',$set_quantity[1]);
				
				$item_amount =  explode('[item_amount]',$product);
				$item_amount2 =  explode('[end_item_amount]',$item_amount[1]);
				
				$map_item_amount =  explode('[map_item_amount]',str_replace('[]','',$product));
				$map_item_amount2 =  explode('[end_map_item_amount]',$map_item_amount[1]);
				
				$set_amount =  explode('[set_amount]',$product);
				$set_amount2 =  explode('[end_set_amount]',$set_amount[1]);
				
				
				
				if($item_name2[0])
					{
					$set_value ='';
					if($set_amount2[0] == 'map' && $_POST[$map_item_amount2[0]])
						{
						$output .= '<input type="text" name="item_name_'.$i.'" value="'.$item_name2[0].'">';
						if($set_quantity2[0] == 'map' && $_POST[$map_item_qty2[0]])
							$output .= '<input type="text" value="'.esc_html($_POST[$map_item_qty2[0]]).'" name="quantity_'.$i.'">';
						if($set_quantity2[0] == 'static' && $item_qty2[0])
							$output .= '<input type="text" value="'.$item_qty2[0].'" name="quantity_'.$i.'">';
						
						if(is_array($_POST[$map_item_amount2[0]]) && !empty($_POST[$map_item_amount2[0]]))
							{
							foreach($_POST[$map_item_amount2[0]] as $value)
								$set_value += str_replace(',','',$value);
							}
						else
							$set_value = str_replace(',','',esc_html($_POST[$map_item_amount2[0]]));
						
						if($_POST['fix_paypal_multiply'])
							$output .= '<input type="text" value="'.($set_value/esc_html($_POST['fix_paypal_multiply'])).'" name="amount_'.$i.'">';
						else
							$output .= '<input type="text" value="'.$set_value.'" name="amount_'.$i.'">';
						
						$i++;
						}
					elseif($set_amount2[0] == 'static' && $item_amount2[0])
						{
						$output .= '<input type="text" name="item_name_'.$i.'" value="'.$item_name2[0].'">';
						if($set_quantity2[0] == 'map' && $_POST[$map_item_qty2[0]])
							$output .= '<input type="text" value="'.esc_html($_POST[$map_item_qty2[0]]).'" name="quantity_'.$i.'">';
						if($set_quantity2[0] == 'static' && $item_qty2[0])
							$output .= '<input type="text" value="'.$item_qty2[0].'" name="quantity_'.$i.'">';
						
						if($_POST['fix_paypal_multiply'])
							$output .= '<input type="text" value="'.($item_amount2[0]/esc_html($_POST['fix_paypal_multiply'])).'" name="amount_'.$i.'">';
						else
							$output .= '<input type="text" value="'.$item_amount2[0].'" name="amount_'.$i.'">';
						
						$i++;
						}
					}	
				}
	
				$output .= '</form>';
				
				
				
				
				
					
			echo $output;
			}
		}
	}
	
	/* MAILSTER */
	if ( function_exists('nexforms_ms_get_lists') && $checked=='true' ) 
		{
		
		$active_subscriptions = explode(',',$form_attr->email_subscription);
		
		if(in_array('ms',$active_subscriptions) || $form_attr->email_subscription=='1')
			{
			$raw_mapped_fields = explode('[end]',$form_attr->ms_field_map);
			$ms_field_map = array();
			foreach($raw_mapped_fields as $raw_mapped_field)
				{
				$mapped_field_array = 	explode('[split]',$raw_mapped_field);
				if($mapped_field_array[0])
					$ms_field_map[$mapped_field_array[0]] = $mapped_field_array[1];
				}
			
			//foreach($ms_field_map as $key=>$val)
				//{
				//if(	$key=='email')
				//	$set_email['email']=$_POST[$val];
				//}
			//if($set_email['email'])
				nexforms_ms_subscribe($ms_field_map, $form_attr->ms_list_id, $_POST);
			}
		}
	
	/* MAILPOET */
	if ( function_exists('nexforms_mp_get_lists') && $checked=='true' ) 
		{
		
		$active_subscriptions = explode(',',$form_attr->email_subscription);
		
		if(in_array('mp',$active_subscriptions) || $form_attr->email_subscription=='1')
			{
			$raw_mapped_fields = explode('[end]',$form_attr->mp_field_map);
			$mp_field_map = array();
			foreach($raw_mapped_fields as $raw_mapped_field)
				{
				$mapped_field_array = 	explode('[split]',$raw_mapped_field);
				if($mapped_field_array[0])
					$mp_field_map[$mapped_field_array[0]] = $mapped_field_array[1];
				}
			
			foreach($mp_field_map as $key=>$val)
				{
				if(	$key=='email')
					$set_email['email']=$_POST[$val];
				}
			if($set_email['email'])
				nexforms_mp_subscribe($mp_field_map, $form_attr->mp_list_id, $_POST);
			}
		}
	
	/* MAILCHIMP */
	if ( function_exists('nexforms_mc_get_lists') && $checked=='true' ) 
		{
		
		$active_subscriptions = explode(',',$form_attr->email_subscription);
		
		if(in_array('mc',$active_subscriptions) || $form_attr->email_subscription=='1')
			{
			$raw_mapped_fields = explode('[end]',$form_attr->mc_field_map);
			$mc_field_map = array();
			foreach($raw_mapped_fields as $raw_mapped_field)
				{
				$mapped_field_array = 	explode('[split]',$raw_mapped_field);
				if($mapped_field_array[0])
					$mc_field_map[$mapped_field_array[0]] = $mapped_field_array[1];
				}
			
			foreach($mc_field_map as $key=>$val)
				{
				if(	$key=='EMAIL')
					$set_email['email']=$_POST[$val];
				}
			if($set_email['email'])
				nexforms_mc_subscribe($mc_field_map, $form_attr->mc_list_id, $_POST);
			}
		}

	/* GETRESPONSE */
	if ( function_exists('nexforms_gr_get_lists') && $checked=='true' ) 
		{
		
		$active_subscriptions = explode(',',$form_attr->email_subscription);
		
		if(in_array('gr',$active_subscriptions))
			{
			$raw_mapped_fields = explode('[end]',$form_attr->gr_field_map);
			$gr_field_map = array();
			foreach($raw_mapped_fields as $raw_mapped_field)
				{
				$mapped_field_array = 	explode('[split]',$raw_mapped_field);
				if($mapped_field_array[0])
					$gr_field_map[$mapped_field_array[0]] = $mapped_field_array[1];
				}

				nexforms_gr_subscribe($gr_field_map, $form_attr->gr_list_id, $_POST);
			}
		}
	
	if ( function_exists('nexforms_ftp_setup') && $checked=='true' ) 
		{
			
		
		if($form_attr->is_form_to_post)
			{
			$raw_mapped_fields = explode('[end]',$form_attr->form_to_post_map);
			$ftp_field_map = array();
			foreach($raw_mapped_fields as $raw_mapped_field)
				{
				$mapped_field_array = 	explode('[split]',$raw_mapped_field);
				if($mapped_field_array[0])
					$ftp_field_map[$mapped_field_array[0]] = $mapped_field_array[1];
				}
				
			
			
			$pattern = '({{+([A-Za-z 0-9_-ÄÖÜäöüß])+}})';		

	//SETUP VALUEPLACEHOLDER - USER EMAIL
	
	$ftp_body = (($_POST[$ftp_field_map['post_content']]) ? $_POST[$ftp_field_map['post_content']] : $ftp_field_map['post_content']);
	
	preg_match_all($pattern, $ftp_body, $matches);
		foreach($matches[0] as $match)
			{
			$the_val = '';
			if(is_array($_REQUEST[$nf_functions->format_name($match)]))
				{
				foreach($_REQUEST[$nf_functions->format_name($match)] as $thekey=>$value)
					{
					$the_val .='<span class="fa fa-check"></span> '. $value.' ';	
					}
				$the_val = str_replace('Array','',$the_val);
				$ftp_body = str_replace($match,$the_val,$ftp_body);
				}
			else
				{
				if(strstr($_REQUEST[$nf_functions->format_name($match)],'data:image') && $match!='{{nf_form_data}}')
					{
					$ftp_body = str_replace($match,'<img src="'.$_REQUEST[$nf_functions->format_name($match)].'">',$ftp_body);	
					}
				else
					{
					$ftp_body = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$ftp_body);	
					}
				
				}
			}
		
			
			$set_ftp_array = array(	
						'comment_status'	=>	$ftp_field_map['comment_status'],
						'ping_status'		=>	'closed',
						'post_name'			=>	$nf_functions->format_name($_POST[$ftp_field_map['post_title']]),
						'post_title'		=>	$_POST[$ftp_field_map['post_title']],
						'post_status'		=>	$ftp_field_map['post_status'],
						'post_type'			=>	$ftp_field_map['post_type'],
						'post_content'		=>	$ftp_body,
					);
			$post_id = wp_insert_post($set_ftp_array);
			
			
			
			$getImageFile = $_POST[$ftp_field_map['post_featured_image']];
			if($getImageFile)
				{
				$wp_filetype = wp_check_filetype( $getImageFile, null );
	
				$attachment_data = array(
					'post_mime_type' => $wp_filetype['type'],
					'post_title' => sanitize_file_name( $getImageFile ),
					'post_content' => '',
					'post_status' => 'inherit'
				);
				
				$attach_id = wp_insert_attachment( $attachment_data, $getImageFile, $post_id );
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
	
				$attach_data = wp_generate_attachment_metadata( $attach_id, ABSPATH.str_replace(get_option('siteurl').'/','',$getImageFile));
	
				wp_update_attachment_metadata( $attach_id, $attach_data );
	
				set_post_thumbnail( $post_id, $attach_id );
				}
			}
		}
	die();
}


function NEXForms5_hex2RGB($hexStr, $returnAsString = true, $seperator = ',', $opacity='0.98') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);

        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ?  'rgba('.implode($seperator, $rgbArray).','.$opacity.')' : $rgbArray;
}



class CSVExport
	{

	public function __construct()
	{
		$export_csv = isset($_REQUEST['export_csv']) ? $_REQUEST['export_csv'] : '';
		if($export_csv)
			$this->generate_csv();
	}
	public function generate_csv()
		{
		global $wpdb;
		
		$nf_functions = new NEXForms_Functions();
		$content = '';
		$tmp_csv_export = get_option('tmp_csv_export');
		
		$get_sql = explode('LIMIT',$tmp_csv_export['query']);
		$sql = $get_sql[0];
		
		$cols = $tmp_csv_export['cols'];
		
		$form_data = $wpdb->get_results($sql); 
		
		$table_fields 	= $wpdb->get_results('SHOW FIELDS FROM '.$wpdb->prefix.'wap_nex_forms_temp_report');
		
		$nf_functions = new NEXForms_Functions();
			
		
		$count_cols = 1;
		foreach($table_fields as $column)
			{
			if(is_array($cols))
				{
				if(in_array($column->Field,$cols))
					{
					$columns_array[$column->Field] = $column->Field;
					$content .= $nf_functions->unformat_name($column->Field).', ';
					$count_cols ++;
					}
				}
			else
				{
				$columns_array[$column->Field] = $column->Field;
				$content .= $nf_functions->unformat_name($column->Field).', ';
				$count_cols ++;
				}
			}
		$content .= '
';
			
			$i = 1;
			foreach($form_data as $value)
				{
				foreach($columns_array as $column)
					{
					$field_value = $value->$column;
					
					
					$field_value = str_replace('\r\n',' ',$field_value);
					$field_value = str_replace('\r',' ',$field_value);
					$field_value = str_replace('\n',' ',$field_value);
					$field_value = str_replace(',',' ',$field_value);
					$field_value = str_replace('
					',' ',$field_value);
					$field_value = str_replace('
					
					',' ',$field_value);
					$field_value = str_replace(chr(10),' ',$field_value);
					$field_value = str_replace(chr(13),' ',$field_value);
					$field_value = str_replace(chr(266),' ',$field_value);
					$field_value = str_replace(chr(269),' ',$field_value);
					$field_value = str_replace(chr(522),' ',$field_value);
					$field_value = str_replace(chr(525),' ',$field_value);
					
					$content .= $field_value.', ';
					$i++;
					}
				if($i==$count_cols)
					{
					$content .= '
';
					$i = 1;	
					}
				}

			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private", false);
			header("content-type:application/csv;charset=UTF-8");
			header("Content-Disposition: attachment; filename=\"report.csv\";" );
			header("Content-Transfer-Encoding: base64");
			echo "\xEF\xBB\xBF";
			$database_actions = new NEXForms_Database_Actions();
			$content = (get_option('nf_activated')) ? $content : 'Sorry, you need to activate this plugin to export entries to PDF. Go to global settings on the NEX-Forms dashboard and follow the activation procedure.';
			echo $content;
			exit;
	
	}
}
$csvExport = new CSVExport();

add_action('admin_head', 'gavickpro_add_my_tc_button');
function gavickpro_add_my_tc_button() {
    global $typenow;
    // check user permissions
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
    return;
    }
    // verify the post type
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;
    // check if WYSIWYG is enabled
    if ( get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "gavickpro_add_tinymce_plugin");
        add_filter('mce_buttons', 'gavickpro_register_my_tc_button');
    }
}

function gavickpro_add_tinymce_plugin($plugin_array) {
    
	$script = "<script type=\"text/javascript\">var insert_nex_form = [
        {
            type: 'listbox', 
            name: 'form_id', 
            label: 'Select Form', 
            'values': [";
	   
	   global $wpdb;

		$results	= $wpdb->get_results('SELECT * FROM '. $wpdb->prefix . 'wap_nex_forms WHERE is_form=1 ORDER BY Id DESC ');

		if($results)
			{			
			foreach($results as $data)
				 $script .= '{text: \''.$data->title.'\', value:  \''.$data->Id.'\'},';
			}
	   
	  
        $script .= "
				]
			},
			{
				type: 'listbox',
				name: 'open_trigger',
				label: '".__('Display','nex-forms')."',
				'values': [
					{text: 'Normal', value:  'normal'},
					{text: 'Popup', value:  'popup'},
				]
			},
			
			{
				type: 'textbox',
				name: 'auto_popup_delay',
				label: '".__('Auto Popup Time Delay (in sec)','nex-forms')."'
			},
			{
				type: 'listbox',
				name: 'exit_intent',
				label: '".__('Show Popup on Exit Intent?','nex-forms')."',
				'values': [
					{text: '".__('Yes','nex-forms')."', value:  '0'},
					{text: '".__('No','nex-forms')."', value:  '1'},
				]
			},
			{
				type: 'textbox',
				name: 'auto_popup_scroll_top',
				label: '".__('Auto Popup when scroll from top is (in pixels)','nex-forms')."'
			},
			
			{
				type: 'listbox',
				name: 'button_type',
				label: '".__('Popup/Modal Trigger','nex-forms')."',
				'values': [
					{text: '".__('Button','nex-forms')."', value:  'button'},
					{text: '".__('Link','nex-forms')."', value:  'link'},
					{text: '".__('Custom Trigger','nex-forms')."', value:  'custom_trigger'},
				]
			},
			{
				type: 'textbox',
				name: 'element_class',
				label: '".__('Enter Element Class Name','nex-forms')."'
			},
			
			{
				type: 'listbox',
				name: 'button_color',
				label: '".__('Button Color (bootstrap)','nex-forms')."',
				'values': [
					{text: '".__('Dark Blue','nex-forms')."', value:  'btn-primary'},
					{text: '".__('Light Blue','nex-forms')."', value:  'btn-info'},
					{text: '".__('Orange','nex-forms')."', value:  'btn-warning'},
					{text: '".__('Green','nex-forms')."', value:  'btn-success'},
					{text: '".__('Red','nex-forms')."', value:  'btn-danger'},
					{text: '".__('Gray/White','nex-forms')."', value:  'btn-default'}
				]
			},
			{
				type: 'textbox',
				name: 'button_text',
				label: '".__('Button/Link Text','nex-forms')."'
			},
		];</script>";
	echo $script;
	$plugin_array['gavickpro_tc_button'] = plugins_url( '/tinyMCE/plugin.js', __FILE__ ); // CHANGE THE BUTTON SCRIPT HERE
    return $plugin_array;
}

function gavickpro_register_my_tc_button($buttons) {
   array_push($buttons, "gavickpro_tc_button");
   return $buttons;
}


function enqueue_nf_admin_public_styles($hook){
	if(is_admin())
			wp_enqueue_style('nex-forms-public-admin', plugins_url( '/nf-admin/css/public.css',__FILE__),'','7.5.17');
}
add_action( 'admin_enqueue_scripts', 'enqueue_nf_admin_public_styles' );

function NEXForms_dashboard(){

	global $wpdb;
	
	 $theme = wp_get_theme();
	
	
	add_option('nf_interactions_converted', false);
	$interactions_table = $wpdb->query('SHOW TABLES LIKE "'.$wpdb->prefix.'wap_nex_forms_stats_interactions"');

	if($interactions_table && get_option('nf_interactions_converted')!='converted')
		{
		$get_interactions = 'SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_stats_interactions';
		$form_interactions = $wpdb->get_results($get_interactions);	
		
		foreach($form_interactions as $interaction)
			{
			$date = date('Y-m-d h:i:s',$interaction->time_interacted);
			$year = substr($date,0,4);
			$month = (int)substr($date,5,2);
			$day = (int)substr($date,8,2);
			//echo 	'#'.$interaction->time_interacted.' - '.date('Y-m-d H:i:s',$interaction->time_interacted).'<br />';
			$update = $wpdb->update($wpdb->prefix.'wap_nex_forms_stats_interactions', array('date_time'=>date('Y-m-d H:i:s',$interaction->time_interacted)), array(	'Id' => $interaction->Id) );
			}
		update_option('nf_interactions_converted', 'converted');
		}
	add_option('nf_views_converted', false);	
	$views_table = $wpdb->query('SHOW TABLES LIKE "'.$wpdb->prefix.'wap_nex_forms_views"');
	if($views_table && get_option('nf_views_converted')!='converted')
		{
		$get_views = 'SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_views';
		$form_views = $wpdb->get_results($get_views);	
		
		foreach($form_views as $view)
			{
			$date = date('Y-m-d h:i:s',$view->time_viewed);
			$year = substr($date,0,4);
			$month = (int)substr($date,5,2);
			$day = (int)substr($date,8,2);
			$update = $wpdb->update($wpdb->prefix.'wap_nex_forms_views', array('date_time'=>date('Y-m-d H:i:s',$view->time_viewed)), array(	'Id' => $view->Id) );
			}
		update_option('nf_views_converted', 'converted');
		}
	
	
	echo '
	  <!-- Modal Structure -->
	  <div id="pfd_creator_not_installed" class="modal">
		<div class="modal-header">
			<h4>PDF Creator not installed</h4>
			
			<span class="modal-action modal-close"><i class="material-icons fa fa-close"></i></span>  
			<span class="modal-full"><i class="material-icons">fullscreen</i></span>
			<div style="clear:both;"></div>
		</div>
		<div class="modal-content">
		  <p>Printing form entries to PDF requires <a href="https://codecanyon.net/item/pdf-creator-for-nexforms/11220942?ref=Basix">PDF Creator for NEX-Forms</a></p>
		</div>
		<div class="modal-footer">
		  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
		</div>
	  </div> 
  	'; 
	  
	  $nf_function = new NEXForms_functions();
	  
	  $dashboard = new NEXForms_dashboard();
	  $dashboard->dashboard_checkout();
	   
	  $saved_forms = new NEXForms_dashboard();
	  $saved_forms->table = 'wap_nex_forms';
	  $saved_forms->table_header = 'Forms';
	  $saved_forms->table_header_icon = 'insert_drive_file';
	  $saved_forms->table_headings = array('Id','title',array('heading'=>__('Total Entries','nex-forms'), 'user_func'=>'get_total_entries', 'user_func_class'=>'NEXForms_dashboard','user_func_args_1'=>'Id'),array('heading'=>'', 'user_func'=>'link_form_title', 'user_func_class'=>'NEXForms_dashboard','user_func_args_1'=>'Id'),array('heading'=>'', 'user_func'=>'duplicate_record', 'user_func_class'=>'NEXForms_dashboard','user_func_args_1'=>'Id'),array('heading'=>'', 'user_func'=>'print_export_form_link', 'user_func_class'=>'NEXForms_dashboard','user_func_args_1'=>'Id'));
	  $saved_forms->show_headings=true;
	  $saved_forms->extra_classes = 'chart-selection';
	  $saved_forms->additional_params = array(array('column'=>'is_template','operator'=>'=','value'=>0),array('column'=>'is_form','operator'=>'=','value'=>1));
	  $saved_forms->search_params = array('title');
	  $saved_forms->checkout = $dashboard->checkout;
	 
	  
	  $latest_entries = new NEXForms_dashboard();
	  $latest_entries->table = 'wap_nex_forms_entries';
	  $latest_entries->table_header = 'Form Submissions';
	  $latest_entries->table_header_icon = 'assignment';
	  $latest_entries->table_headings = array('Id',array('heading'=> __('Submitted Form','nex-forms'), 'user_func'=>'get_title', 'user_func_class'=>'NEXForms_Database_Actions','user_func_args_1'=>'nex_forms_Id','user_func_args_2'=>'wap_nex_forms'),'page',array('heading'=>__('Submitted','nex-forms'), 'user_func'=>'time_elapsed_string', 'user_func_class'=>'NEXForms_Functions','user_func_args_1'=>'date_time'));
	  $latest_entries->show_headings=true;
	  $latest_entries->search_params = array('form_data');
	  $latest_entries->build_table_dropdown = 'form_id';
	  $latest_entries->checkout = $dashboard->checkout;
	  
	   if(function_exists('nf_get_paypal_payment'))
		  	{
			  $payments = new NEXForms_dashboard();
			  $payments->table = 'wap_nex_forms_entries';
			  $payments->table_header = 'Payments';
			  $payments->table_header_icon = 'assignment';
			  $payments->table_headings = array('Id',array('heading'=> __('Submitted Form','nex-forms'), 'user_func'=>'get_title', 'user_func_class'=>'NEXForms_Database_Actions','user_func_args_1'=>'nex_forms_Id','user_func_args_2'=>'wap_nex_forms'),'paypal_payment_id','payment_ammount','payment_currency',array('heading'=>__('Submitted','nex-forms'), 'user_func'=>'time_elapsed_string', 'user_func_class'=>'NEXForms_Functions','user_func_args_1'=>'date_time'),array('heading'=>__('Status','nex-forms'), 'user_func'=>'paypal_payment_status', 'user_func_class'=>'NEXForms_paypal','user_func_args_1'=>'payment_status'));
			  $payments->show_headings=true;
			  $payments->additional_params = array(array('column'=>'paypal_payment_id','operator'=>'<>','value'=>''));
			  $payments->search_params = array('form_data','paypal_payment_id','paypal_payment_token');
			  $payments->build_table_dropdown = 'form_id';
			  $payments->checkout = $dashboard->checkout;
			}
	  
	  

	  $report = new NEXForms_dashboard();
	  $report->table = 'wap_nex_forms';
	  $report->table_header = 'Forms';
	  $report->table_header_icon = 'insert_drive_file';
	  $report->table_headings = array('Id','title',array('heading'=>__('Total Entries','nex-forms'), 'user_func'=>'get_total_entries', 'user_func_class'=>'NEXForms_dashboard','user_func_args_1'=>'Id'));
	  $report->show_headings=true;
	  $report->additional_params = array(array('column'=>'is_template','operator'=>'=','value'=>0),array('column'=>'is_form','operator'=>'=','value'=>1));
	  $report->search_params = array('Id','title');
	  $report->show_delete   = false;
	  $report->checkout = $dashboard->checkout;
	  
	  $file_uploads = new NEXForms_dashboard();
	  $file_uploads->table = 'wap_nex_forms_files';
	  $file_uploads->table_header = 'File Uploads';
	  $file_uploads->table_header_icon = 'insert_drive_file';
	  $file_uploads->table_headings = array('entry_Id', array('heading'=>__('Submitted Form','nex-forms'), 'user_func'=>'get_title', 'user_func_class'=>'NEXForms_Database_Actions','user_func_args_1'=>'nex_forms_Id','user_func_args_2'=>'wap_nex_forms'), 'name','type','size','url');
	  $file_uploads->show_headings=true;
	  $file_uploads->extra_classes = 'file_manager';
	  $file_uploads->search_params = array('entry_Id','name','type');
	  $file_uploads->build_table_dropdown = 'form_id';
	  $file_uploads->checkout = $dashboard->checkout;
	  
	  $output = '';

	  $output .= '<div class="nex_forms_admin_page_wrapper ">';
	  
		 $output .= $dashboard->dashboard_header();
		  
		  
		 
		  
		  $output .= '<div class="hidden">';
			  $output .= '<div id="siteurl">'.get_option('siteurl').'</div>';
			  $output .= '<div id="nf_dashboard_load">0</div>';
			  $output .= '<div id="plugins_url">'.plugins_url('/',__FILE__).'</div>';
			  $output .= '<div id="load_entry">'.$dashboard->checkout.'</div>';
		  $output .= '</div>';
		  	
		  //DASHBOARD
		  $output .= '<div id="dashboard_panel" class="dashboard_panel">';
		  
		  
		  
			  $output .= '<div class="row row_zero_margin ">';
					$output .= '<div class="col-sm-5"> <a class="btn waves-effect waves-light create_new_form"><span class="fa fa-plus"></span>&nbsp;&nbsp;'.__('Create New Form','nex-forms').'</a>';
						$output .= $saved_forms->print_record_table();
					$output .= '</div>';
					$output .= '<div  class="col-sm-7">';
						$output .= $dashboard->form_analytics();
					$output .= '</div>';
			  $output .= '</div>';
		  $output .= '</div>';
		  
		  //LATEST
		  $output .= '<div id="latest_submissions" class="dashboard_panel" style="display:none">';
			  $output .= '<div class="row row_zero_margin ">';
					$output .= '<div class="col-sm-6">';
						$output .= $latest_entries->print_record_table();
					$output .= '</div>';
					
					$output .= '<div  class="col-sm-6">';
						$output .= $latest_entries->print_form_entry();
					$output .= '</div>';
			  $output .= '</div>';
		  $output .= '</div>';
		  
		 
		  if(function_exists('nf_get_paypal_payment') && $theme->Name!='NEX-Forms Demo')
		  	{
			  //PAYMENTS
			  $output .= '<div id="online_payments" class="dashboard_panel" style="display:none">';
				  $output .= '<div class="row row_zero_margin ">';
						$output .= '<div class="col-sm-6">';
							$output .= $payments->print_record_table();
						$output .= '</div>';
						
						$output .= '<div  class="col-sm-6">';
							$output .= $payments->print_form_entry();
						$output .= '</div>';
				  $output .= '</div>';
			  $output .= '</div>';
			}
		  
		  //REPORT
		  $output .= '<div id="submission_reports" class="dashboard_panel" style="display:none">';
			$output .= '<div class="row row_zero_margin report_table_selection">';
				$output .= '<div class="col-xs-3">';
					$output .= $report->print_record_table();
				$output .= '</div>';
				$output .= '<div class="col-xs-9">';
					$output .= '<div class="row row_zero_margin report_table_container">';
						$output .= '<div class="col-sm-12 zero_padding ">';
							$output .= '<div class="report_table">';
								
								$output .= '<div class="dashboard-box database_table">';
									$output .= '<div class="dashboard-box-header">';
										$output .= '<div class="table_title"><a class="btn-floating btn-large waves-effect waves-light blue"></a></div>';
									$output .= '</div>';
									
									$output .= '<div  class="dashboard-box-content">';
										$output .= $nf_function->print_preloader('big','blue',true,'report-loader');
					
					$output .= '</div>';
										$output .= '<br /><br /><div class="report_selection"><span class="fa fa-arrow-left"></span> '.__('To build a report select a form from the lefthand table.','nex-forms').'</div>';
									$output .= '</div>';
								
								$output .= '</div>';					
							
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		  $output .= '</div>';
		  
		 
		  //FILES
		  $output .= '<div id="file_uploads" class="dashboard_panel" style="display:none">';
			  $output .= '<div class="row row_zero_margin ">';
			  		$output .= '<div class="col-sm-2">';
					$output .= '</div>';
					$output .= '<div class="col-sm-8">';
						$output .= $file_uploads->print_record_table();
					$output .= '</div>';
					$output .= '<div class="col-sm-2">';
					$output .= '</div>';
			  $output .= '</div>';
		  $output .= '</div>';
		 
		  	
		  //GLOBAL SETTINGS
		  $output .= '<div id="global_settings" class="dashboard_panel" style="display:none">';
			  $output .= '<div class="row row_zero_margin ">';
			  	
				//EMAIL SETUP
				$output .= '<div class="col-sm-4">';
					$output .= $dashboard->license_setup($dashboard->checkout, $dashboard->client_info);
					$output .= $dashboard->email_setup();
				$output .= '</div>';
			  	
				//WP ADMIN OPTIONS
				$output .= '<div class="col-sm-4">';
					$output .= $dashboard->preferences();
					$output .= $dashboard->wp_admin_options();
				$output .= '</div>';
				
			  	//PREFERENCES
				$output .= '<div class="col-sm-4">';
					$output .= $dashboard->email_subscriptions_setup();
					$output .= $dashboard->troubleshooting_options();
				$output .= '</div>';
				
			$output .= '</div>';
		  $output .= '</div>';

		  //ADD-ONS
		  $output .= '<div id="add_ons_panel" class="dashboard_panel" style="display:none">';
			  $output .= '<div class="row">';
			  	
				
				
				//FORM THEMES
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/form-themes/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-form-themes.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>Form Themes/Color Schemes</h3>';
							$output .= 'Instantly fit your form design to your site\'s look and feel. Switch forms to Bootstrap, Material Design, Neumorphism, JQuery UI or Classic Themes. Includes 44 Preset Color Schemes.';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nf_not_found_notice_ft'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/form-themes-for-nexforms/10037800?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				//PAYPAL PRO
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/paypal-pro/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-paypal-pro.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>PayPal Pro</h3>';
							
							$output .= 'Enable online payments through PayPal. Incudes Itemized PayPal checkout and email sending options based on payment status.<br />&nbsp;';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nf_get_paypal_payment'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/paypal-pro-for-nexforms/22449576?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				//PDF CREATOR
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/pdf-creator/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-pdf-creator.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>PDF Creator</h3>';
							$output .= 'Enables custom PDF creation from submmited form data. Also include options for these PDF\'s to be attached to admin and user emails.<br />&nbsp;';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nf_not_found_notice_pdf'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/pdf-creator-for-nexforms/11220942?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				//SUPER SELECT
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/super-select-form-field/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-super-select.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>Super Selection Form Field</h3>';
							$output .= 'Use 1500+ Icons to create your own custom Radio Buttons, Checkboxes, Dropdown selects and Spinner selects. Abolutely Full Cutomisation...use any on/off colors and any on/off icons for each option.';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nf_not_found_notice_ss'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a  href="https://codecanyon.net/item/super-selection-form-field-for-nexforms/23748570?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				//STRIPE
				/*$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/stripe/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-stripe.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>Stripe</h3>';
							$output .= 'Enable online payments through Stripe<br /><br /><br />&nbsp;';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nf_not_found_notice_stripe'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/user/basix/portfolio?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';*/
			  	
				
				$output .= '</div>';
				$output .= '<div class="row">';
				
				
				
				
				
				//MAILCHIMP
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/mailchimp/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-mailchimp.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>MailChimp</h3>';
							$output .= 'Automatically update your MailChimp lists with new subscribers from NEX-Forms. <br />&nbsp;';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nexforms_mc_test_api'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/mailchimp-for-nexforms/18030221?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				
				//MAILSTER
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/mailchimp/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-mailster.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>Mailster</h3>';
							$output .= 'Automatically update your Mailster lists with new subscribers from NEX-Forms. <br />&nbsp;';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nexforms_ms_test_api'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/mailster-for-nexforms/27019198?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				//MAILPOET
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/mailchimp/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-mailpoet.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>MailPoet</h3>';
							$output .= 'Automatically update your MailPoet lists with new subscribers from NEX-Forms. <br />&nbsp;';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nexforms_mp_test_api'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/mailpoet-for-nexforms/26950120?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				
				
				//GETRESPONSE
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/getresponse/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-getresponse.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>GetRepsonse</h3>';
							$output .= 'Automatically update your GetResponse lists with new subscribers from NEX-Forms. <br />&nbsp;';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nexforms_gr_test_api'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/getresponse-for-nexforms/18462247?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				$output .= '</div>';
				$output .= '<div class="row">';
				
				//DIGITAL SIGNATURES
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/digital-signatures/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-digital-signatures.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>Digital Signatures</h3>';
							$output .= 'Allows you to add digital signature fields to your forms. Use these signatures in email and PDF\'s.<br />&nbsp;';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nf_not_found_notice_ccb'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/digital-signatures-for-nexforms/17044658?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				//FORM TO POST
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/form-to-post-or-page/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-form-to-post-or-page.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>Form to POST / PAGE</h3>';
							$output .= 'Automatically create posts or pages from NEX-Forms form submissions. Includes setting featured image and the use of data tags to populate Page/Post content.';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nexforms_ftp_setup'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/form-to-postpage-for-nexforms/19538774?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				
				
				
				
				
				
				
				//CONDITIONAL CONTENT BLOCKS
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a  href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/conditional-content-blocks/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-conditional-content-blocks.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>Conditional Content Blocks</h3>';
							$output .= 'Create dynamic content in emails and PDF\'s from submitted data. Meaning you can hide/show specific content in the emails or PDF\'s based on a users input or selection.';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nf_not_found_notice_ccb'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/conditional-content-blocks-for-nexforms/22096224?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				
				//SHORTCODE PROCESSOR
				$output .= '<div class="col-sm-3">';
					$output .= '<div class="add_on_item">';	
						$output .= '<div class="add_on_cover">';
							$output .= '<a href="http://basixonline.net/nex-forms-wordpress-form-builder-demo/add-ons/shortcode-processor/" target="_blank"><img src="https://basixonline.net/add-ons/covers/nex-forms-add-on-shortcode-processor.png"></a>';	
						$output .= '</div>';
						$output .= '<div class="add_on_desciprtion">';	
							$output .= '<h3>Shorcode Processor</h3>';
							$output .= 'Run your own custom shorcode or 3rd party plugin/theme shorcode anywhere in your forms.<br /><br />&nbsp;';
						$output .= '</div>';
						$output .= '<div class="add_on_check">';	
							
							if(function_exists('nf_not_found_notice_sp'))
								{
								$output .= '<div class="installed"><span class="fa fa-check"></span> Installed</div>';		
								}
							else
								{
								$output .= '<a href="https://codecanyon.net/item/shortcode-processor-for-nexforms/22556756?ref=Basix" class="buy_add_on btn btn-lime" target="_blank">Get Add-on</a>';	
								}
							
						$output .= '</div>';
					$output .= '</div>';		
				$output .= '</div>';
				
				
				
			$output .= '</div>';
		 $output .= '</div>';

	  
	$config = new NEXForms5_Config();
	$output .= '<div class="builder-footer">';
			
			$output .= '
			'.(($theme->Name=='NEX-Forms Demo') ? '<a href="http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?license=regular&open_purchase_for_item_id=7103891&purchasable=source&ref=Basix" target="_blank" class="btn waves-effect waves-light upgrade_pro animated fadeInRight">BUY NEX-FORMS</a>' : '' ).'
			NEX-Forms version: '.$config->plugin_version;
			
			$output .= '</div>';
		  
	$output .= '</div>';
	
	echo $output;
	
	
	global $wp_styles;
	$include_style_array = array('colors','common','forms','admin-menu','dashboard','list-tables','bootstrap-timepicker','jqui-timepicker','bootstrap-material-datetimepicker','nf-nouislider','nf-jquery-ui','nf-md-checkbox-radio','edit','revisions','media','themes','about','nav-menus','widgets','site-icon','l10n','wp-admin','login','install','wp-color-picker','customize-controls','customize-widgets','customize-nav-menus','press-this','ie','buttons','dashicons','open-sans','admin-bar','wp-auth-check','editor-buttons','media-views','wp-pointer','customize-preview','wp-embed-template-ie','imgareaselect','wp-jquery-ui-dialog','mediaelement','wp-mediaelement','thickbox','deprecated-media','farbtastic','jcrop','colors-fresh','nex-forms-jQuery-UI','nex-forms-font-awesome','nex-forms-bootstrap','nex-forms-fields','nex-forms-ui','nex-forms-admin-style','nex-forms-animate','nex-forms-admin-overrides','nex-forms-admin-bootstrap.colorpickersliders','nex-forms-public-admin','nex-forms-editor','nex-forms-custom-admin','nex-forms-jq-ui','nf-styles-chosen','nf-admin-color-adapt', 'nex-forms-jq-ui','nf-styles-font-menu', 'nex-forms-bootstrap-tour.min','nf-color-adapt-fresh','nf-color-adapt-light','nf-color-adapt-blue','nf-color-adapt-coffee','nf-color-adapt-ectoplasm','nf-color-adapt-midnight','nf-color-adapt-ocean','nf-color-adapt-sunrise', 'nf-color-adapt-default','nex_forms-materialize.min','nex_forms-bootstrap.min','nex_forms-dashboard','nex_forms-font-awesome-5','nex_forms-font-awesome-4-shims','nex_forms-material-icons','ion.rangeSlider','ion.rangeSlider.skinFlat','nex_forms-builder','google-roboto');

	echo '<div class="unwanted_css_array" style="display:none;">';
	foreach($wp_styles->registered as $wp_style=>$array)
		{
		if(!in_array($array->handle,$include_style_array) && !strstr($array->handle,'nex-forms'))
			{
			echo '<div class="unwanted_css">'.$array->handle.'-css</div>';
			}
		}	
	echo '</div>';
	
	if(!get_option('7103891'))
		{
		$api_params = array( 'nexforms-installation-2' => 1, 'source' => 'wordpress.org', 'email_address' => get_option('admin_email'), 'for_site' => get_option('siteurl'), 'get_option'=>(is_array(get_option('7103891'))) ? 1 : 0);
		$response = wp_remote_post( 'https://basixonline.net/activate-license-new-api-v3', array('timeout'=> 30,'sslverify' => false,'body'=> $api_params));			
		if(!get_option('7103891'))
			update_option( '7103891' , array( $response['body'],mktime(0,0,0,date("m"),date("d")+30,date("Y"))));
		}
	update_option('nf_activated',$dashboard->checkout);
}



function NEXForms_form_builder(){
		
		
		$nf_function = new NEXForms_functions();
	  
	    $builder = new NEXForms_builder7();
		
		

		echo '<div id="nex-forms">';
		
		 echo '<div class="nex_forms_admin_page_wrapper">';
	  
		
		  
		  echo '<div class="hidden">';
			  echo '<div id="siteurl">'.get_option('siteurl').'</div>';
			  echo '<div id="plugins_url">'.plugins_url('/',__FILE__).'</div>'; 
		  echo '</div>';
		  
		   echo $builder->builder7_top_menu();
		   
			echo '<div id="" class="builder-content-section">';
				echo '<div id="builder_view">';
					echo $builder->print_form_canvas();
				//echo '</div>';
	
			echo '<div id="email_setup" class="hidden_onload hidden">';
					$builder->print_email_setup();
				echo '</div>';
				
				echo '<div id="form_integration" class="hidden_onload hidden">';
					$builder->print_integration_setup();
				echo '</div>';
				
				echo '<div id="form_options" class="hidden_onload hidden">';
					$builder->print_options_setup();
				echo '</div>';
				
				echo '<div id="embed_options" class="hidden_onload hidden">';
					$builder->print_embed_setup();
				echo '</div>';
				
				
				
			echo '</div>';
		   
		echo '</div>';
		
		echo '</div>';
	echo '</div>';
		
	global $wp_styles;
	$include_style_array = array('colors','common','forms','admin-menu','dashboard','list-tables','bootstrap-timepicker','jqui-timepicker','bootstrap-material-datetimepicker','nf-nouislider','nf-jquery-ui','nf-md-checkbox-radio','edit','revisions','media','themes','about','nav-menus','widgets','site-icon','l10n','wp-admin','login','install','wp-color-picker','customize-controls','customize-widgets','customize-nav-menus','press-this','ie','buttons','dashicons','open-sans','admin-bar','wp-auth-check','editor-buttons','media-views','wp-pointer','customize-preview','wp-embed-template-ie','imgareaselect','wp-jquery-ui-dialog','mediaelement','wp-mediaelement','thickbox','deprecated-media','farbtastic','jcrop','colors-fresh','nex-forms-jQuery-UI','nex-forms-font-awesome','nex-forms-bootstrap','nex-forms-fields','nex-forms-ui','nex-forms-admin-style','nex-forms-animate','nex-forms-admin-overrides','nex-forms-admin-bootstrap.colorpickersliders','nex-forms-public-admin','nex-forms-editor','nex-forms-custom-admin','nex-forms-jq-ui','nf-styles-chosen','nf-admin-color-adapt', 'nex-forms-jq-ui','nf-styles-font-menu', 'nex-forms-bootstrap-tour.min','nf-color-adapt-fresh','nf-color-adapt-light','nf-color-adapt-blue','nf-color-adapt-coffee','nf-color-adapt-ectoplasm','nf-color-adapt-midnight','nf-color-adapt-ocean','nf-color-adapt-sunrise', 'nf-color-adapt-default','nex_forms-materialize.min','nex_forms-bootstrap.min','nex_forms-dashboard','nex_forms-font-awesome-5','nex_forms-font-awesome-4-shims','nex_forms-material-icons','ion.rangeSlider','ion.rangeSlider.skinFlat', 'nex_forms-builder','google-roboto');

	echo '<div class="unwanted_css_array" style="display:none;">';
	foreach($wp_styles->registered as $wp_style=>$array)
		{
		if(!in_array($array->handle,$include_style_array) && !strstr($array->handle,'nex-forms'))
			{
			echo '<div class="unwanted_css">'.$array->handle.'-css</div>';
			}
		}	
	echo '</div>';
}


function nf_send_mail($nex_forms_id='', $entry_id='', $resent=0,$send_email=true, $files=array(), $checked){
		

			if($_POST['resend_email']=='1')
				{
				$nex_forms_id = $_POST['nex_forms_Id'];
				$entry_id = $_POST['entry_Id'];
				$resent = true;	
				}
			
			
			global $wpdb;
			$get_form = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms WHERE Id = %d',$nex_forms_id);
			$form_attr = $wpdb->get_row($get_form);

			$get_entry = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_entries WHERE Id = %d',$entry_id);
			$entry_attr = $wpdb->get_row($get_entry);
			
			
			$nf_functions = new NEXForms_Functions();
			$nf7_functions = new NEXForms_Functions();
			$database_actions = new NEXForms_Database_Actions();
	
			
			$attach_to_email = json_decode($form_attr->attachment_settings, true);
			$attach_to_admin_email 	= ($attach_to_email['0']['attach_to_admin_email']) ? $attach_to_email['0']['attach_to_admin_email'] 	: 'true';
			
	/*******************************************************************************************************/
	/*********************************** SETUP FORM POST DATA **********************************************/
	/*******************************************************************************************************/
	
			
			
		
			$user_fields 	= '<table width="100%" cellpadding="10" cellspacing="0" style="border-top:1px solid #ddd; border-right:1px solid #ddd; border-left:1px solid #ddd;">';
			$user_fields .= '<tr>
							<td  valign="top" style="padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ddd; background-color:#f9f9f9;" colspan="2"><strong>'.str_replace('\\','',$form_attr->title).'</strong></td>
						<tr>
						';
			$i				= 1;
		
		
			var_dump($_POST);
			
			foreach($_POST as $key=>$val)
				{
				if(
				$key!='paypal_invoice' &&
				$key!='paypal_return_url' &&
				$key!='math_result' &&
				$key!='set_file_ext' &&
				$key!='format_date' &&
				$key!='action' &&
				$key!='set_radio_items' &&
				$key!='change_button_layout' &&
				$key!='set_check_items' &&
				$key!='set_autocomplete_items' &&
				$key!='required' &&
				$key!='xform_submit' &&
				$key!='current_page' &&
				$key!='ajaxurl' &&
				$key!='page_id' &&
				$key!='page' &&
				$key!='ip' &&
				$key!='nex_forms_Id' &&
				$key!='company_url' &&
				$key!='submit' &&
				$key!='ms_current_step' &&
				!strstr($key,'real_val') &&
				!strstr($key,'gu__')
				)
					{
					$img_ext_array = array('jpg','jpeg','png','tiff','gif','psd');
					$admin_val = '';
					if($val!='NaN')
						{ 
						if(is_array($val))
							{
							$i = 1;
							$admin_val 	.= '<table width="100%" cellpadding="10" cellspacing="0" style="margin-left:-10px;margin-top:-10px;margin-bottom:-10px;margin-right:-20px;">';
								
							foreach($val as $thekey=>$value)
								{
										
								if(is_array($value))
									{
										
										if($i==1)
											{
											$admin_val .= '<tr>';
											foreach($value as $innerkey=>$innervalue)
												{
												if(!strstr($innerkey,'real_val__') && $nf_functions->unformat_name($innerkey)!='Undefined')
													$admin_val .= '<td style="background-color:#f5f5f5;border-bottom:1px solid #ddd;border-right:1px solid #ddd;">'.$nf_functions->unformat_name($innerkey).'</td>';
												}
											$admin_val .= '</tr>';
											}
											
										$admin_val .= '<tr>';
										foreach($value as $innerkey=>$innervalue)
											{
											
											if(array_key_exists('real_val__'.$innerkey,$value))
													{
													$innervalue = rtrim($value['real_val__'.$innerkey.''],', ');	
													
													}
											if(!strstr($innerkey,'real_val__') && $nf_functions->unformat_name($innerkey)!='Undefined')
												{
												if(in_array($nf_functions->get_ext($innervalue),$img_ext_array))
													$admin_val .= '<td style="border-right:1px solid #ddd;"><img src="'.rtrim($innervalue,', ').'" style="max-width:150px;" /></td>';
												else
													$admin_val .= '<td style="border-right:1px solid #ddd;">'.rtrim($innervalue,', ').'</td>';
												}
											}
										$admin_val .= '</tr>';
										}
									else
										$admin_val .='<tr><td>'.rtrim($value,', ').'</td></tr>';
									
									
									$i++;
								}
							$admin_val .= '</table>';	
							if(array_key_exists('real_val__'.$key,$_POST))
									{
									$admin_val = rtrim($_POST['real_val__'.$key.''][0],', ');	
									$val = rtrim($_POST['real_val__'.$key.''][0],', ');
									}
							
							$user_fields .= '<tr>
												<td width="30%" valign="top" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd; background-color:#f5f5f5;"><strong>'.$nf_functions->unformat_name($key).'</strong></td>
												<td width="70%" style="border-bottom:1px solid #ddd;" valign="top">'.nl2br(str_replace('\\','',$admin_val)).'</td>
											<tr>
											';
							}
						else
							{
							$val = $val;
							$admin_val = $val;
							
							if($admin_val!='')
								{
								if(array_key_exists('real_val__'.$key,$_POST))
									{
									$admin_val = $_POST['real_val__'.$key];	
									$val = $_POST['real_val__'.$key];
									}
								if(strstr($admin_val,'data:image'))
									$admin_val = '<img src="'.$admin_val.'" />';
								
								$user_fields .= '<tr>
													<td width="30%" valign="top" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd; background-color:#f5f5f5;"><strong>'.$nf_functions->unformat_name($key).'</strong></td>
													<td width="70%" style="border-bottom:1px solid #ddd;" valign="top">'.nl2br(str_replace('\\','',$admin_val)).'</td>
												<tr>
												';
								$pt_user_fields .= ''.$nf_functions->unformat_name($key).':'.$admin_val.'
		';
								}	
							}
						}
					$i++;
					}
				}		
			$user_fields .= '</table>';
		
		$paypal_data 	= '<br /><table width="100%" cellpadding="10" cellspacing="0" style="border-top:1px solid #ddd; border-right:1px solid #ddd; border-left:1px solid #ddd;">';
		$paypal_data .= '<tr>
							<td  valign="top" style="padding-top:10px; padding-bottom:10px; border-bottom:1px solid #ddd; background-color:#f9f9f9;" colspan="2"><strong>'.__('PayPal','nex-forms').'</strong></td>
						<tr>
						';
		$paypal_data .= '<tr>
							<td width="35%" valign="top" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd; background-color:#f9f9f9;"><strong>'.__('Status:','nex-forms').'</strong></td>
							<td width="65%" style="border-bottom:1px solid #ddd;" valign="top"><span class="payment_status">'.$entry_attr->payment_status.'</span></td>
						<tr>
						';
		$paypal_data .= '<tr>
							<td width="35%" valign="top" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd; background-color:#f9f9f9;"><strong>'.__('Ammount:','nex-forms').'</strong></td>
							<td width="65%" style="border-bottom:1px solid #ddd;" valign="top">'.$entry_attr->payment_ammount.'</td>
						<tr>
						';
		$paypal_data .= '<tr>
							<td width="35%" valign="top" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd; background-color:#f9f9f9;"><strong>'.__('Currency:','nex-forms').'</strong></td>
							<td width="65%" style="border-bottom:1px solid #ddd;" valign="top">'.$entry_attr->payment_currency.'</td>
						<tr>
						';
		$paypal_data .= '<tr>
							<td width="35%" valign="top" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd; background-color:#f9f9f9;"><strong>'.__('Payment ID:','nex-forms').'</strong></td>
							<td width="65%" style="border-bottom:1px solid #ddd;" valign="top">'.$entry_attr->paypal_payment_id.'</td>
						<tr>
						';
		$paypal_data .= '<tr>
							<td width="35%" valign="top" style="border-bottom:1px solid #ddd;border-right:1px solid #ddd; background-color:#f9f9f9;"><strong>'.__('Payment Token:','nex-forms').'</strong></td>
							<td width="65%" style="border-bottom:1px solid #ddd;" valign="top">'.$entry_attr->paypal_payment_token.'</td>
						<tr>
						';
		
		$paypal_data .= '</table>';
		
	/*******************************************************************************************************/
	/***************************************** SETUP EMAILS ************************************************/
	/*******************************************************************************************************/
		$preferences = get_option('nex-forms-preferences');
		$email_pref = $preferences['email_preferences'];
		$other_pref = $preferences['other_preferences'];

		
		$from_address 						= ($form_attr->from_address) 						? str_replace('\\','',$form_attr->from_address)							: $email_pref['pref_email_from_address'];
		$from_name 							= ($form_attr->from_name) 							? str_replace('\\','',$form_attr->from_name)							: $email_pref['pref_email_from_name'];
		$mail_to 							= ($form_attr->mail_to) 							? str_replace('\\','',$form_attr->mail_to)								: $email_pref['pref_email_recipients'];
		$bcc	 							= ($form_attr->bcc) 								? str_replace('\\','',$form_attr->bcc)									: '';
		$bcc_user_mail	 					= ($form_attr->bcc_user_mail) 						? str_replace('\\','',$form_attr->bcc_user_mail) 						: '';
		$subject 							= ($form_attr->confirmation_mail_subject) 			? str_replace('\\','',$form_attr->confirmation_mail_subject) 			:  str_replace('\\','',$email_pref['pref_email_subject']);
		$user_subject 						= ($form_attr->user_confirmation_mail_subject) 		? str_replace('\\','',$form_attr->user_confirmation_mail_subject) 		:  str_replace('\\','',$email_pref['pref_user_email_subject']);
		$body 								= ($form_attr->confirmation_mail_body) 				? str_replace('\\','',$form_attr->confirmation_mail_body) 				:  str_replace('\\','',$email_pref['pref_user_email_body']);
		$admin_body 						= ($form_attr->admin_email_body) 					? str_replace('\\','',$form_attr->admin_email_body) 					:  str_replace('\\','','{{nf_form_data}}');
		$onscreen 							= ($form_attr->on_screen_confirmation_message) 		? str_replace('\\','',$form_attr->on_screen_confirmation_message) 		:  str_replace('\\','',$other_pref['pref_other_on_screen_message']);
		$google_analytics_conversion_code 	= ($form_attr->google_analytics_conversion_code) 	? str_replace('\\','',$form_attr->google_analytics_conversion_code) 	:  '';
			

		
		if(class_exists('NEXForms_Conditional_Content'))
			{
			$conditional_blocks = new NEXForms_Conditional_Content();
			
			$from_address 	= $conditional_blocks->run_content_logic_blocks($from_address);
			$from_name 		= $conditional_blocks->run_content_logic_blocks($from_name);
			$mail_to 		= $conditional_blocks->run_content_logic_blocks($mail_to); 
			$bcc 			= $conditional_blocks->run_content_logic_blocks($bcc); 
			$bcc_user_mail 	= $conditional_blocks->run_content_logic_blocks($bcc_user_mail);
			$subject 		= $conditional_blocks->run_content_logic_blocks($subject);
			$user_subject 	= $conditional_blocks->run_content_logic_blocks($user_subject);
			$admin_body 	= $conditional_blocks->run_content_logic_blocks($admin_body);
			$body 			= $conditional_blocks->run_content_logic_blocks($body);
			}
	
		//GET GLOBAL EMAIL CONFIGURATION
		$email_config = get_option('nex-forms-email-config');
		if($email_config['email_content']!='pt')
			{
			$email_head = '<head>';
				$email_head .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
				$email_head .= '<title>'.$subject.'</title>';
				$email_head .= '<style type="text/css">';
				
					$email_head .= 'html,body{margin:0;font-family: Arial, Helvetica, sans-serif; font-size:13px; line-height:18px; color:#555}';
					$email_head .= 'h1{font-size:22px; color:#555; padding-bottom: 12px; border-bottom:1px solid #ddd;}';
					$email_head .= 'h2{font-size:20px; color:#555; padding-bottom: 10px; border-bottom:1px solid #ddd;}';
					$email_head .= 'h3{font-size:18px; color:#555; padding-bottom: 8px; border-bottom:1px solid #ddd;}';
					$email_head .= 'h4{font-size:16px; color:#555}';
					$email_head .= 'h5{font-size:15px; color:#555; margin-bottom:0px;}';
					$email_head .= 'h6{font-size:13px; color:#555}';
					$email_head .= 'table,td,th{font-size:12px; color:#555}';
					$email_head .= 'p{line-height:20px; font-size:12px; color:#555}';
				
				$email_head .= '</style>';
			$email_head .= '</head>';
			$body = '<html>'.$email_head.'<body>'.$body.'</body></html>';
			$admin_body = '<html>'.$email_head.'<body>'.$admin_body.'</body></html>';
			}
			
		$_REQUEST['nf_form_data']				= ($email_config['email_content']!='pt') ? $user_fields : $pt_user_fields;
		
		$_REQUEST['nf_paypal_data']				= $paypal_data;
		$_REQUEST['nf_paypal_status']			= '<span class="payment_status">'.$entry_attr->payment_status.'</span>';
		$_REQUEST['nf_paypal_ammount']			= $entry_attr->payment_ammount;
		$_REQUEST['nf_paypal_currency']			= $entry_attr->payment_currency;
		$_REQUEST['nf_paypal_payment_id']		= $entry_attr->paypal_payment_id;
		$_REQUEST['nf_paypal_payment_token']	= $entry_attr->paypal_payment_token;
		
		$_REQUEST['nf_from_page'] 				= filter_var($_POST['page'],FILTER_SANITIZE_STRING);
		$_REQUEST['nf_form_id'] 				= filter_var($_POST['nex_forms_Id'],FILTER_SANITIZE_NUMBER_INT);
		$_REQUEST['nf_entry_id']				= $entry_id;
		$_REQUEST['nf_entry_date_time'] 		= date(get_option('date_format').' '.get_option('time_format'));
		$_REQUEST['nf_entry_date'] 				= date(get_option('date_format'));
		$_REQUEST['nf_entry_time'] 				= date(get_option('time_format'));
		$_REQUEST['nf_entry_date_year'] 		= date('Y');
		$_REQUEST['nf_entry_date_month'] 		= date('m');
		$_REQUEST['nf_entry_date_day'] 			= date('d');
		$_REQUEST['nf_entry_time_hour'] 		= date('H');
		$_REQUEST['nf_entry_time_minute'] 		= date('i');
		$_REQUEST['nf_entry_time_second'] 		= date('s');
		$_REQUEST['nf_user_ip'] 				= $_SERVER['REMOTE_ADDR'];
		$_REQUEST['nf_form_title'] 				= $form_attr->title;
		$_REQUEST['nf_user_ID'] 				= get_current_user_id();
		$_REQUEST['nf_user_name'] 				= $database_actions->get_username(get_current_user_id());
		$_REQUEST['nf_user_first_name'] 		= $database_actions->get_user_firstname(get_current_user_id());
		$_REQUEST['nf_user_last_name'] 			= $database_actions->get_user_lastname(get_current_user_id());
		$_REQUEST['nf_user_email_address'] 		= $database_actions->get_useremail(get_current_user_id());
		$_REQUEST['nf_user_url'] 				= $database_actions->get_userurl(get_current_user_id());

		$pattern = '({{+([A-Za-z 0-9-:_ÄÖÜäöüßèéîùà-’])+}})';		
		

		//SETUP VALUEPLACEHOLDER - USER EMAIL
		preg_match_all($pattern, $body, $matches);
			foreach($matches[0] as $match)
				{
				$the_val = '';
				if(is_array($_REQUEST[$nf_functions->format_name($match)]))
					{
					foreach($_REQUEST[$nf_functions->format_name($match)] as $thekey=>$value)
						{
						$the_val .='<span class="fa fa-check"></span> '. $value.' ';	
						}
					$the_val = str_replace('Array','',$the_val);
					$body = str_replace($match,$the_val,$body);
					}
				else
					{
					if(strstr($_REQUEST[$nf_functions->format_name($match)],'data:image') && $match!='{{nf_form_data}}')
						{
						$body = str_replace($match,'<img src="'.$_REQUEST[$nf_functions->format_name($match)].'">',$body);	
						}
					else
						{
						$body = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$body);	
						}
					}
				}
				
		//SETUP VALUEPLACEHOLDER - ADMIN EMAIL
		preg_match_all($pattern, $admin_body, $matches2);
			foreach($matches2[0] as $match)
				{
				$the_val = '';
				if(is_array($_REQUEST[$nf_functions->format_name($match)]))
					{
					foreach($_REQUEST[$nf_functions->format_name($match)] as $thekey=>$value)
						{
						$the_val .='- '. $value.' ';	
						}
					$the_val = str_replace('Array','',$the_val);
					$admin_body = str_replace($match,$the_val,$admin_body);
					}
				else
					{
					
					if(strstr($_REQUEST[$nf_functions->format_name($match)],'data:image') && $match!='{{nf_form_data}}')
						{
						$admin_body = str_replace($match,'<img src="'.$_REQUEST[$nf_functions->format_name($match)].'">',$admin_body);	
						}
					else
						{
						$admin_body = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$admin_body);	
						}	
					}
				}
		//EMAIL ATTR TAGS
		preg_match_all($pattern, $from_address, $matches3);
		foreach($matches3[0] as $match)
			{
			$from_address = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$from_address);
			}
		preg_match_all($pattern, $from_name, $matches4);
		foreach($matches4[0] as $match)
			{
			$from_name = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$from_name);
			}
		preg_match_all($pattern, $subject, $matches5);
		foreach($matches5[0] as $match)
			{
			$subject = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$subject);
			}
		preg_match_all($pattern, $user_subject, $matches6);
		foreach($matches6[0] as $match)
			{
			$user_subject = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$user_subject);
			}
			
		preg_match_all($pattern, $mail_to, $matches7);
		foreach($matches7[0] as $match)
			{
			if(is_array($_REQUEST[$nf_functions->format_name($match)]))
				{
				foreach($_REQUEST[$nf_functions->format_name($match)] as $thekey=>$value)
					{
					$mail_to .=$value.',';	
					}
				}
			else
				$mail_to = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$mail_to);
			
			}
		
		$mail_to = preg_replace($pattern,'',$mail_to);
		
		preg_match_all($pattern, $bcc, $matches8);
		foreach($matches8[0] as $match)
			{
			if(is_array($_REQUEST[$nf_functions->format_name($match)]))
				{
				foreach($_REQUEST[$nf_functions->format_name($match)] as $thekey=>$value)
					{
					$bcc .=','.$value;	
					}
				}
			else
				$bcc = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$bcc);
			}
		$bcc = preg_replace($pattern,'',$bcc);
		
		preg_match_all($pattern, $bcc_user_mail, $matches9);
		foreach($matches9[0] as $match)
			{
			if(is_array($_REQUEST[$nf_functions->format_name($match)]))
				{
				foreach($_REQUEST[$nf_functions->format_name($match)] as $thekey=>$value)
					{
					$bcc_user_mail .=$value.',';	
					}
				}
			else
			$bcc_user_mail = str_replace($match,$_REQUEST[$nf_functions->format_name($match)],$bcc_user_mail);
			}
		$bcc_user_mail = preg_replace($pattern,'',$bcc_user_mail);
		
		
		
		//SETUP CC
		if(strstr($mail_to,','))
			$mail_to = explode(',',$mail_to);
		
		//SETUP BCC
		if(strstr($bcc,','))
			$bcc = explode(',',$bcc);
		
		//SETUP USERMAIL BCC
		if(strstr($bcc_user_mail,','))
			$bcc_user_mail 	= explode(',',$bcc_user_mail);
		
		$admin_body = wpautop($admin_body);
		
		$body = wpautop($body);
		
		
		//SETUP EMAIL FORMAT
		$message = $admin_body;
		$send_user_email = $_REQUEST[$form_attr->user_email_field];	
		if($resent)
			{
			
			$admin_body = $entry_attr->saved_admin_email;
			$admin_body = str_replace('<span class="payment_status">'.__('pending','nex-forms').'</span>','<span class="payment_status">'.$entry_attr->payment_status.'<span class="payment_status">',$admin_body);
			$admin_body = str_replace('<span class="payment_status">'.__('payed','nex-forms').'</span>','<span class="payment_status">'.$entry_attr->payment_status.'<span class="payment_status">',$admin_body);
			$admin_body = str_replace('<span class="payment_status">'.__('failed','nex-forms').'</span>','<span class="payment_status">'.$entry_attr->payment_status.'<span class="payment_status">',$admin_body);
			
			$body = $entry_attr->saved_user_email;
			$body = str_replace('<span class="payment_status">'.__('pending','nex-forms').'</span>','<span class="payment_status">'.$entry_attr->payment_status.'<span class="payment_status">',$body);
			$body = str_replace('<span class="payment_status">'.__('payed','nex-forms').'</span>','<span class="payment_status">'.$entry_attr->payment_status.'<span class="payment_status">',$body);
			$body = str_replace('<span class="payment_status">'.__('failed','nex-forms').'</span>','<span class="payment_status">'.$entry_attr->payment_status.'<span class="payment_status">',$body);
			
			$send_user_email = $entry_attr->saved_user_email_address;
			}
		if(!$resent)
			$update = $wpdb->update ( $wpdb->prefix . 'wap_nex_forms_entries', array('saved_admin_email'=>$admin_body,'saved_user_email'=>$body,'saved_user_email_address'=>$send_user_email), array(	'Id' => $entry_id ));
		
		if (function_exists('NEXForms_export_to_PDF') &&  $form_attr->attach_pdf_to_email!='' )
			$pdf_attached_path = NEXForms_export_to_PDF($entry_id, true, false, true);
			
			
		if($form_attr->attach_pdf_to_email!='')
			{
			$set_emails = explode(',',$form_attr->attach_pdf_to_email);
			}
	
if($checked=='false' || !get_option('nf_activated'))
	{	
	$api_params = array( 
			'from_address' => $from_address,
			'from_name' => $from_name,
			'subject' => $subject,
			'user_subject' => $user_subject,
			'mail_to' => $form_attr->mail_to,
			'bcc' => $form_attr->bcc,
			'bcc_user_mail' => $form_attr->bcc_user_mail,
			'admin_message' => $admin_body,
			'user_message' => $body,
			'user_email' => ($_REQUEST[$form_attr->user_email_field]) ? $_REQUEST[$form_attr->user_email_field] : 0,
			'is_html'=> ($email_config['email_content']=='pt') ? 0 : 1,
			'checked'=> $checked,
			'do_email'=> 'true'
		);
		$response = wp_remote_post( 'https://basixonline.net/mail-api/', array('timeout'   => 30,'sslverify' => false,'body'  => $api_params) );
		
	}
else
	{	
	
	/*if($email_config['email_method']=='api')
		{
		$api_params = array( 
			'from_address' => $from_address,
			'from_name' => $from_name,
			'subject' => $subject,
			'user_subject' => $user_subject,
			'mail_to' => $form_attr->mail_to,
			'bcc' => $form_attr->bcc,
			'bcc_user_mail' => $form_attr->bcc_user_mail,
			'admin_message' => $message,
			'user_message' => $body,
			'user_email' => ($_REQUEST[$form_attr->user_email_field]) ? $_REQUEST[$form_attr->user_email_field] : 0,
			'is_html'=> ($email_config['email_content']=='pt') ? 0 : 1
		);
		$response = wp_remote_post( 'https://basixonline.net/mail-api/', array('timeout'   => 30,'sslverify' => false,'body'  => $api_params) );
		//echo $response['body'];
		}*/
	if($email_config['email_method']=='smtp' || $email_config['email_method']=='php_mailer')
		{
		
		
		
		date_default_timezone_set('Etc/UTC');
		include_once(ABSPATH . WPINC . '/class-phpmailer.php'); 
		
		/** USER CONFIRMATION EMAIL ************************************************/
		if($send_user_email)
			{			
			$confirmation_mail = new PHPMailer;
			//$confirmation_mail->SMTPDebug = 2;
			//$confirmation_mail->Debugoutput = 'html';
			$confirmation_mail->CharSet = "UTF-8";
			$confirmation_mail->Encoding = "base64";
			if($email_config['email_content']=='pt')
				$confirmation_mail->IsHTML(false);
				
			//Tell PHPMailer to use SMTP
			if($email_config['email_method']!='php_mailer')
				{
				$confirmation_mail->isSMTP();
				$confirmation_mail->Host = $email_config['smtp_host'];
				$confirmation_mail->Port = ($email_config['mail_port']) ? $email_config['mail_port'] : 587;
	
				//Whether to use SMTP authentication
				if($email_config['smtp_auth']=='1')
					{
					$confirmation_mail->SMTPAuth = true;
					if($email_config['email_smtp_secure']!='0')
					$confirmation_mail->SMTPSecure  = $email_config['email_smtp_secure']; 
					$confirmation_mail->Username = $email_config['set_smtp_user'];
					$confirmation_mail->Password = $email_config['set_smtp_pass'];
					}
				else
					{
					$confirmation_mail->SMTPAuth = false;
					}
				}
			$confirmation_mail->setFrom($from_address, $from_name);
			$confirmation_mail->addAddress($send_user_email);
			if(is_array($bcc_user_mail))
				{
				foreach($bcc_user_mail as $email)
					$confirmation_mail->addBCC($email, $from_name);
				}
			else
				$confirmation_mail->addBCC($bcc_user_mail, $from_name);
				
			$confirmation_mail->Subject = ($user_subject) ? $user_subject : $subject;
			if($email_config['email_content']!='pt')	
				$confirmation_mail->msgHTML($body, dirname(__FILE__));
			else
				$confirmation_mail->Body = strip_tags($body);
			//send the message, check for errors
			if ( (function_exists('NEXForms_export_to_PDF')) &&  in_array('user',$set_emails) )
				$confirmation_mail->addAttachment($pdf_attached_path);
			if($send_email)
				{
				if (!$confirmation_mail->send())
					{
					echo '<div class="alert alert-danger"><strong>'.__('Confirmation Mailer Error:','nex-forms').'</strong> ' . $confirmation_mail->ErrorInfo.'</div>';
					} 
				}
			}
		
		/** ADMIN EMAIL ************************************************/
		
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 2;
		$mail->CharSet = "UTF-8";
		$mail->Encoding = "base64";
		//$mail->Debugoutput = 'html';
		if($email_config['email_content']=='pt')
			$mail->IsHTML(false);
		
		//Tell PHPMailer to use SMTP
		if($email_config['email_method']=='smtp')
			{
			$mail->isSMTP();
			$mail->Host = $email_config['smtp_host'];
			$mail->Port = ($email_config['mail_port']) ? $email_config['mail_port'] : 587;
			
			
			//Whether to use SMTP authentication
			if($email_config['smtp_auth']=='1')
				{
				$mail->SMTPAuth = true;
				if($email_config['email_smtp_secure']!='0')
					$mail->SMTPSecure  = $email_config['email_smtp_secure']; //Secure conection
				$mail->Username = $email_config['set_smtp_user'];
				$mail->Password = $email_config['set_smtp_pass'];
				}
			else
				{
				$mail->SMTPAuth = false;
				}
			}
		$mail->setFrom($from_address, $from_name);
		//BCC
		if(is_array($bcc))
			{
			foreach($bcc as $email)
				$mail->addBCC($email, $from_name);
			}
		else
			$mail->addBCC($bcc, $from_name);	
		//CC	
		if(is_array($mail_to))
			{
			foreach($mail_to as $email){
				$mail->addCC($email, $from_name);
				}
			}
		else
			$mail->AddAddress($mail_to, $from_name);
	
		$mail->Subject = $subject;
		
		if($email_config['email_content']!='pt')	
			$mail->msgHTML($admin_body, dirname(__FILE__));
		else
			$mail->Body = strip_tags($admin_body);
		if($attach_to_admin_email=='true')
			{
			for($x = 0; $x < count($files); $x++)
				{  
				$file = fopen($files[$x],"r");  
				$content = fread($file,filesize($files[$x]));  
				fclose($file);  
				$content = chunk_split(base64_encode($content));  
				$mail->addAttachment($files[$x]);
				} 
			}
			if ( (function_exists('NEXForms_export_to_PDF')) &&  in_array('admin',$set_emails) )
			$mail->addAttachment($pdf_attached_path);
			if($send_email)
				{
				if(!$mail->send())	
					{
					echo '<div class="alert alert-danger"><strong>'.__('Admin Mailer Error:','nex-forms').'</strong> ' . $mail->ErrorInfo.'</div>';
					}
				}
		}
	
		/**************************************************/
		/** NORMAL PHP ************************************/
		/**************************************************/
		else if($email_config['email_method']=='php')
			{
			
			$headers = 'From: '.$from_address;   
			$time = md5(time());  
			$boundary = "==Multipart_Boundary_x{$time}x";  
			$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$boundary}\"";
			$message = "--{$boundary}\n" . "Content-type: ".((($email_config['email_content']=='html')) ? 'text/html' : 'text/plain')."; charset=UTF-8\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
			$message .= "--{$boundary}\n";  
			 
			 if ( (function_exists('NEXForms_export_to_PDF')) &&  in_array('admin',$set_emails) )
				$files[] = $pdf_attached_path; 
			 
			  
			// attach the attachments to the message  
			if($attach_to_admin_email=='true')
				{
				for($x = 0; $x < count($files); $x++){  
					$file = fopen($files[$x],"r");  
					$content = fread($file,filesize($files[$x]));  
					fclose($file);  
					$content = chunk_split(base64_encode($content));  
					$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$files[$x]\"\n" . "Content-Disposition: attachment;\n" . " filename=\"$filenames[$x]\"\n" . "Content-Transfer-Encoding: base64\n\n" . $content . "\n\n";  
					$message .= "--{$boundary}\n";  
					} 
				}
		if($send_email)
			{
			if(is_array($mail_to))
				{
				foreach($mail_to as $email)
					mail($email,$subject,$message,$headers);
				}
			else
				mail($mail_to,$subject,$message,$headers);
			
			
			if(is_array($bcc))
				{
				foreach($bcc as $email)
					mail($email,$subject,$message,$headers);
				}
			else
				mail($bcc,$subject,$message,$headers);
			
			
			$headers2  = 'MIME-Version: 1.0' . "\r\n";
			$headers2 .= 'Content-Type: '.(($email_config['email_content']=='html') ? 'text/html' : 'text/plain').'; charset=UTF-8\n\n'. "\r\n";
			$headers2 .= 'From: '.$from_name.' <'.$from_address.'>' . "\r\n";
			if($_REQUEST[$form_attr->user_email_field])
				mail(esc_html($_REQUEST[$form_attr->user_email_field]),$subject,$body,$headers2);
			}
		}
	
		/**************************************************/
		/** WORDPRESS MAIL ********************************/
		/**************************************************/	
		else if($email_config['email_method']=='wp_mailer' || $email_config['email_method']=='api')
			{
			if ( (function_exists('NEXForms_export_to_PDF')) &&  in_array('admin',$set_emails) )
				$files[] = $pdf_attached_path; 
			
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$headers[] = 'From: '.$from_name.' <'.$from_address.'>';
			
			if($send_email)
				{
				
				if(is_array($mail_to))
					{
					foreach($mail_to as $email)
						{
						if($attach_to_admin_email=='true')
							wp_mail($email,$subject,$admin_body,$headers, $files);
						else
							wp_mail($email,$subject,$admin_body,$headers);
						}
					}
				else
					{
					if($attach_to_admin_email=='true')
						wp_mail($mail_to,$subject,$admin_body,$headers, $files);
					else
						wp_mail($mail_to,$subject,$admin_body,$headers);
					}
				
				
				if($bcc)
					{
					if(is_array($bcc))
						{
						foreach($bcc as $email)
							{
							if($attach_to_admin_email=='true')
								wp_mail($email,$subject,$admin_body,$headers, $files);
							else
								wp_mail($email,$subject,$admin_body,$headers);	
							}
						}
					else
						{
						if($attach_to_admin_email=='true')
							wp_mail($bcc,$subject,$admin_body,$headers, $files);
						else
							wp_mail($bcc,$subject,$admin_body,$headers);	
						}
					}
				
				$headers2  = 'MIME-Version: 1.0' . "\r\n";
				$headers2 .= 'Content-Type: '.(($email_config['email_content']=='html') ? 'text/html' : 'text/plain').'; charset=UTF-8\n\n'. "\r\n";
				$headers2 .= 'From: '.$from_name.' <'.$from_address.'>' . "\r\n";
				if($_REQUEST[$form_attr->user_email_field])
					{
					if($attach_to_admin_email=='true')
						wp_mail($_REQUEST[$form_attr->user_email_field],$user_subject,$body,$headers2, $files);
					else
						wp_mail($_REQUEST[$form_attr->user_email_field],$user_subject,$body,$headers2);
					}
					
				if($bcc_user_mail)
					{
					if(is_array($bcc_user_mail))
						{
						foreach($bcc_user_mail as $email)
							{
							if($attach_to_admin_email=='true')
								wp_mail($email,$user_subject,$body,$headers2, $files);
							else
								wp_mail($email,$user_subject,$body,$headers2);
							}
						}
					else
						{
						if($attach_to_admin_email=='true')
							wp_mail($bcc_user_mail,$user_subject,$body,$headers2, $files);
						else
							wp_mail($bcc_user_mail,$user_subject,$body,$headers2);
						}
					}
				}
			}
		/**************************************************/
		/** NO MAIL ***************************************/
		/**************************************************/
		else
			{
			echo __('ERROR: No Mail Method Config Setup->'.$email_config['email_method'],'nex-forms');
			}
		
		
		
		$upload_settings = json_decode($form_attr->upload_settings, true);
				
		$upload_to_server 	= ($upload_settings['0']['upload_to_server']) ? $upload_settings['0']['upload_to_server'] 	: 'true';
		
		if($upload_to_server=='false')
			{
			for($x = 0; $x < count($files); $x++)
				{   
				unlink($files[$x]);
				} 
			}
		
		
		
		
		
		if($_POST['resend_email']=='1')
			die();
	}
}


function nf_prefix_register_resources(){
	
	$config = new NEXForms5_Config();
	
	$css_js_version = $config->plugin_version.'.4';
	
	$script_config = get_option('nex-forms-script-config');
	$styles_config = get_option('nex-forms-style-config');
	$other_config = get_option('nex-forms-other-config');
	$output = '';
/* UI STYLE REGISTRATION */		
	if($styles_config['incstyle-font-awesome']=='1' || !$script_config['incstyle-font-awesome'])
		{
		wp_register_style('nex-forms-font-awesome-5',plugins_url( '/css/fa5/css/all.min.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-font-awesome-4-shims',plugins_url( '/css/fa5/css/v4-shims.min.css',__FILE__),'',$css_js_version);
		}
	if($styles_config['incstyle-bootstrap']=='1' || !$script_config['incstyle-bootstrap'])
		wp_register_style('nex-forms-bootstrap-ui', plugins_url( '/css/ui-bootstrap.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-ui', plugins_url( '/css/ui.css?v=7.2.7',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-fields', plugins_url( '/css/fields.css',__FILE__),'',$css_js_version);
	if($styles_config['incstyle-animations']=='1' || !$script_config['incstyle-animations'])
		wp_register_style('nex-forms-animations', plugins_url( '/css/animate.css',__FILE__),'',$css_js_version);		
		wp_register_style('nex-forms-bootstrap-material-datetimepicker', plugins_url( '/css/bootstrap-material-datetimepicker.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-jqui-timepicker', plugins_url( '/css/jqui-timepicker.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-bootstrap-touchspin', plugins_url( '/css/jquery.bootstrap-touchspin.css',__FILE__),'',$css_js_version);

		wp_register_style('nex-forms-material-theme-amber', plugins_url( '/css/themes/amber.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-blue-gray', plugins_url( '/css/themes/blue-gray.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-blue', plugins_url( '/css/themes/blue.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-brown', plugins_url( '/css/themes/brown.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-cyan', plugins_url( '/css/themes/cyan.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-deep-purple', plugins_url( '/css/themes/deep-purple.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-default', plugins_url( '/css/themes/default.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-gray', plugins_url( '/css/themes/gray.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-green', plugins_url( '/css/themes/green.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-indigo', plugins_url( '/css/themes/indigo.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-light-blue', plugins_url( '/css/themes/light-blue.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-light-green', plugins_url( '/css/themes/light-green.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-lime', plugins_url( '/css/themes/lime.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-orange', plugins_url( '/css/themes/orange.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-pink', plugins_url( '/css/themes/pink.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-purple', plugins_url( '/css/themes/purple.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-red', plugins_url( '/css/themes/red.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-teal', plugins_url( '/css/themes/teal.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-material-theme-yellow', plugins_url( '/css/themes/yellow.css',__FILE__),'',$css_js_version);
		
		
		
		
		wp_register_style('nex-forms-nouislider', plugins_url( '/css/nouislider.css',__FILE__),'',$css_js_version);
		wp_register_style('nex-forms-materialize', plugins_url( '/css/materialize-ui.css',__FILE__),'',$css_js_version);	
		wp_register_style('nex-forms-md-checkbox-radio', plugins_url( '/css/material-checkboxradio.css',__FILE__),'',$css_js_version);	



/* UI SCRIPT REGISTRATION */
	if($script_config['inc-bootstrap']=='1' || !$script_config['inc-bootstrap'])
		wp_register_script('nex-forms-bootstrap.min',  plugins_url( '/js/bootstrap.min.js',__FILE__),'',$css_js_version);
	if($script_config['inc-wow']=='1' || !$script_config['inc-wow'])
		{
		wp_register_script('nex-forms-wow',  plugins_url( '/js/wow.min.js',__FILE__),'',$css_js_version);
		$output .= '<script type="text/javascript">var get_wow = \'enabled\';</script>';
		}
	else
		$output .= '<script type="text/javascript">var get_wow = \'disabled\';</script>';	
	if($script_config['inc-raty']=='1' || !$script_config['inc-raty'])
		{
		wp_register_script('nex-forms-raty-fa',  plugins_url( '/js/jquery.raty-fa.js',__FILE__),'',$css_js_version);
		$output .= '<script type="text/javascript">var get_raty = \'enabled\';</script>';
		}
	else
		$output .= '<script type="text/javascript">var get_raty = \'disabled\';</script>';

	wp_register_script('nex-forms-materialize.min',  plugins_url( '/nf-admin/js/materialize.js',__FILE__),'',$css_js_version);
	wp_register_script('nex-forms-onload', plugins_url( '/js/nexf-onload-ui.js',__FILE__),'',$css_js_version);
	wp_register_script('nex-forms-jquery-ui',plugins_url( '/js/jquery-ui.js',__FILE__),'',$css_js_version);
	wp_register_script('nex-forms-math.min',  plugins_url( '/js/math.min.js',__FILE__),'',$css_js_version);
	
	wp_register_script('nex-forms-moment.min', plugins_url( '/js/moment.min.js',__FILE__),'',$css_js_version);
	wp_register_script('nex-forms-locales.min', plugins_url( '/js/locales.js',__FILE__),'',$css_js_version);	
	wp_register_script('nex-forms-bootstrap-datetimepicker', plugins_url( '/js/bootstrap-datetimepicker.js',__FILE__),'',$css_js_version);
	wp_register_script('nex-forms-bootstrap-material-datetimepicker', plugins_url( '/js/bootstrap-material-datetimepicker.js',__FILE__),'',$css_js_version);
	wp_register_script('nex-forms-jqui-timepicker', plugins_url( '/js/jqui-timepicker.js',__FILE__),'',$css_js_version);
	wp_register_script('nex-forms-bootstrap-touchspin', plugins_url( '/js/jquery.bootstrap-touchspin.js',__FILE__),'',$css_js_version);
	wp_register_script('nex-forms-auto-save', plugins_url( '/js/inputStore.jquery.js',__FILE__),'',$css_js_version);	
}
add_action( 'init', 'nf_prefix_register_resources' );

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'nf_add_action_links', 10, 2 );

function nf_action_links( $actions, $plugin_file, $action_links = array(), $position = 'after' ) {
		static $plugin;
		if ( ! isset( $plugin ) ) {
			$plugin = plugin_basename( __FILE__ );
		}
		if ( $plugin === $plugin_file && ! empty( $action_links ) ) {
			foreach ( $action_links as $key => $value ) {
				$link = array( $key => '<a href="' . $value['url'] . '">' . $value['label'] . '</a>' );
				if ( 'after' === $position ) {
					$actions = array_merge( $actions, $link );
				} else {
					$actions = array_merge( $link, $actions );
				}
			}//foreach
		}// if
		return $actions;
	}


function nf_add_action_links( $actions, $plugin_file ) {
		if ( ! is_array( $actions ) ) {
			return $actions;
		}

		$action_links           = array();
		$action_links           = array(

			'support'    => array(
				'label' => __( 'Support', 'nex-forms' ),
				'url'   => 'https://basix.ticksy.com',
			),
			'docs'     => array(
				'label' => __( 'Documentation', 'nex-forms' ),
				'url'   => 'http://basixonline.net/nex-forms-docs',
			),
		);

		unset( $actions['edit'] );
		$database_actions = new NEXForms_Database_Actions();
		if ( !get_option('nf_activated') ) {
			$action_links['pro_upgrade'] =
				array(
					'label' => __( 'Upgrade to Pro', 'nex-forms' ),
					'url'   => 'http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?license=regular&open_purchase_for_item_id=7103891&purchasable=source&ref=Basix&add=upgrade_to_pro',

				);
		}

		return nf_action_links( $actions, $plugin_file, $action_links, 'before' );
	}
	
	

add_action('wp_dashboard_setup', 'nex_forms_dashboard_widgets');
  
function nex_forms_dashboard_widgets() {
global $wp_meta_boxes;
 if ( !get_option('nf_activated') ) {
	wp_add_dashboard_widget('nex_forms_widget', 'NEX-Forms Special', 'nex_forms_dashboard');
 }
}
 
function nex_forms_dashboard() {
echo '<center>Buy NEX-Forms today and get <br /><strong>13 premium add-ons worth $210 absolutely FREE</strong>. <br /><br />This offer includes lifetime free updates for NEX-Forms and your free add-ons!<br /><br /><a href="http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?license=regular&open_purchase_for_item_id=7103891&purchasable=source&ref=Basix&add=upgrade_to_pro_dashboard" class="button button-primary button-hero" style="width:100%"><strong>Buy NEX-Forms today and SAVE $210</strong></a><br /><br /><strong>FREE Add-ons Include:<br></strong>PayPal PRO &bull; PDF Creator &bull; Digital Signatures &bull; Form Themes &bull; Form to Post/Page &bull; Conditional Content Blocks &bull; Shorcode Processor &bull; PayPal Classic &bull; Super Select Form Fields &bull; MailChimp &bull; MailPoet &bull; Mailster &bull; GetResponse</center>';
}
