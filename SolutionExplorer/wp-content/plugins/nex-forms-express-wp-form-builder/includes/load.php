<?php
if ( ! defined( 'ABSPATH' ) ) exit;


ini_set('display_errors',1);
ini_set('error_reporting', 1 );
error_reporting(1);

include_once( 'classes/class.install.php');
include_once( 'classes/class.db.php');
include_once( 'classes/class.functions.php');
include_once( 'classes/class.export.php');
include_once( 'classes/class.icons.php');
include_once( 'classes/class.googlefonts.php');
include_once( 'classes/class.dashboard.php');
include_once( 'classes/class.builder.php');
include_once( 'classes/class.preferences.php');

add_action( 'init', 'nf_prefix_register_admin_resources' );

function nf_prefix_register_admin_resources(){
	
	 $js_version = '7.6.4.1';
	
	
	wp_register_script('nex-forms-admin-functions',plugins_url('/nf-admin/js/admin-functions.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-bootstrap.min',plugins_url('/nf-admin/js/bootstrap-admin.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-charts',plugins_url( '/nf-admin/js/chart.min.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-materialize.min',plugins_url('/nf-admin/js/materialize.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-formilise-js-init',plugins_url('/nf-admin/js/dashboard.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-global-settings',plugins_url('/nf-admin/js/global-settings.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-pref',plugins_url('/nf-admin/js/preferences.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-gcharts',plugins_url( '/nf-admin/js/gcharts.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-bootstrap-tour.min',plugins_url('/nf-admin/js/bootstrap-tour.min.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-bootstrap-admin',plugins_url('/nf-admin/js/bootstrap-admin.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-builder',plugins_url('/nf-admin/js/builder.js',dirname(__FILE__)),'',$js_version);		
	wp_register_script('nex-forms-materialize.min',plugins_url('/nf-admin/js/materialize.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-bootstrap-tour.min',plugins_url('/nf-admin/js/bootstrap-tour.min.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-drag-and-drop',plugins_url('/nf-admin/js/drag-and-drop.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-field-settings-recall',plugins_url('/nf-admin/js/field-settings-recall.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-field-settings',plugins_url('/nf-admin/js/field-settings.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-bootstrap.colorpickersliders',plugins_url('/nf-admin/js/bootstrap.colorpickersliders.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-tinycolor-min',plugins_url('/nf-admin/js/tinycolor-min.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-conditional-logic',plugins_url('/nf-admin/js/conditional_logic.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-wow',plugins_url('/nf-admin/js/wow.min.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-admin-tour',plugins_url('/nf-admin/js/tour.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-tinymce',includes_url( '/js/tinymce/tinymce.min.js'),'',$js_version);
	//FRONT+BACK
	
	// BS DATETIME 
	wp_register_script('nex-forms-moment.min', plugins_url('/js/moment.min.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-locales.min',plugins_url('/js/locales.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-date-time',plugins_url('/js/bootstrap-datetimepicker.js',dirname(__FILE__)),'',$js_version);
	
	
	wp_register_script('nex-forms-raty',plugins_url('/js/jquery.raty-fa.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-fields',plugins_url('/js/fields.js',dirname(__FILE__)),'',$js_version);
	wp_register_script('nex-forms-bootstrap-material-datetimepicker', plugins_url( '/js/bootstrap-material-datetimepicker.js',dirname(__FILE__)),'',$js_version);
	
	wp_register_script('nex-forms-jqui-timepicker', plugins_url( '/js/jqui-timepicker.js',dirname(__FILE__)),'',$js_version);
	
	wp_register_script('nex-forms-bootstrap.touchspin', plugins_url( '/js/jquery.bootstrap-touchspin.js',dirname(__FILE__)),'',$js_version);
	
	
	
	wp_register_style('nex-forms-material-theme-amber', plugins_url( '/css/themes/amber.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-blue-gray', plugins_url( '/css/themes/blue-gray.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-blue', plugins_url( '/css/themes/blue.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-brown', plugins_url( '/css/themes/brown.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-cyan', plugins_url( '/css/themes/cyan.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-deep-purple', plugins_url( '/css/themes/deep-purple.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-default', plugins_url( '/css/themes/default.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-gray', plugins_url( '/css/themes/gray.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-green', plugins_url( '/css/themes/green.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-indigo', plugins_url( '/css/themes/indigo.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-light-blue', plugins_url( '/css/themes/light-blue.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-light-green', plugins_url( '/css/themes/light-green.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-lime', plugins_url( '/css/themes/lime.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-orange', plugins_url( '/css/themes/orange.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-pink', plugins_url( '/css/themes/pink.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-purple', plugins_url( '/css/themes/purple.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-red', plugins_url( '/css/themes/red.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-teal', plugins_url( '/css/themes/teal.css',dirname(__FILE__)),'',$js_version);
	wp_register_style('nex-forms-material-theme-yellow', plugins_url( '/css/themes/yellow.css',dirname(__FILE__)),'',$js_version);	
}

function enqueue_nf_admin_scripts($hook) {

	$js_version = '7.6.4.1';
	
	wp_enqueue_script('jquery');
	wp_enqueue_style('jquery-ui');
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('jquery-ui-resizable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-autocomplete');
	wp_enqueue_script('jquery-form');
	wp_enqueue_script('jquery-widget');
	
	wp_enqueue_script('nex-forms-tinymce');
	wp_enqueue_style('nex-forms-admin-color-adapt',  plugins_url( '/nf-admin/css/color_adapt/'.get_user_option( 'admin_color' ).'.css',dirname(__FILE__)),'',$js_version);

	// Custom Includes 
	if($hook=='toplevel_page_nex-forms-dashboard')
		{
		wp_enqueue_script('nex-forms-admin-functions');
		wp_enqueue_script('nex-forms-bootstrap.min');
		wp_enqueue_script('nex-forms-charts');
		wp_enqueue_script('nex-forms-materialize.min');
		wp_enqueue_script('nex-forms-formilise-js-init');
		wp_enqueue_script('nex-forms-global-settings');
		wp_enqueue_script('nex-forms-pref');
		wp_enqueue_script('nex-forms-gcharts');
		wp_enqueue_script('nex-forms-bootstrap-tour.min');
		}
		

		$form = isset($_REQUEST['open_form']) ? true : false;
		
	if($hook=='admin_page_nex-forms-builder')
		{
		if($form)
			{
			wp_enqueue_script('nex-forms-admin-functions');
			wp_enqueue_script('nex-forms-bootstrap-admin');
			wp_enqueue_script('nex-forms-builder');		
			wp_enqueue_script('nex-forms-materialize.min');
			wp_enqueue_script('nex-forms-bootstrap-tour.min');
			wp_enqueue_script('nex-forms-drag-and-drop');
			wp_enqueue_script('nex-forms-field-settings');
			wp_enqueue_script('nex-forms-field-settings-recall');
			wp_enqueue_script('nex-forms-bootstrap.colorpickersliders');
			wp_enqueue_script('nex-forms-tinycolor-min');
			wp_enqueue_script('nex-forms-conditional-logic');
			wp_enqueue_script('nex-forms-wow');
			wp_enqueue_script('nex-forms-admin-tour');
			
			//FRONT+BACK
			
			// BS DATETIME 
			wp_enqueue_script('nex-forms-moment.min');
			wp_enqueue_script('nex-forms-locales.min');
			wp_enqueue_script('nex-forms-date-time');
			
			
			wp_enqueue_script('nex-forms-raty');
			wp_enqueue_script('nex-forms-fields');
			wp_enqueue_script('nex-forms-bootstrap-material-datetimepicker');
			
			wp_enqueue_script('nex-forms-jqui-timepicker');
			
			wp_enqueue_script('nex-forms-bootstrap.touchspin');
			}
		}
		
}

function enqueue_nf_admin_styles($hook) {
	// CSS 
	
	$js_version = '7.6.4.1';
	
	if($hook=='toplevel_page_nex-forms-dashboard')
		{
		wp_enqueue_style('nex-forms-materialize.min',plugins_url('/nf-admin/css/materialize-dashboard.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-bootstrap.min',plugins_url('/nf-admin/css/bootstrap.min.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-dashboard',plugins_url('/nf-admin/css/dashboard.css',dirname(__FILE__)),'',$js_version);
		//FRONT+BACK
		wp_enqueue_style('nex-forms-font-awesome-5',plugins_url('/css/fa5/css/all.min.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-font-awesome-4-shims',plugins_url('/css/fa5/css/v4-shims.min.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-animations',plugins_url('/css/animate.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-ui',plugins_url('/css/ui.css',dirname(__FILE__)),'',$js_version);
		}
	if($hook=='admin_page_nex-forms-builder')
		{
		wp_enqueue_style('nex-forms-builder',plugins_url('/nf-admin/css/builder.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-bootstrap.min',plugins_url('/nf-admin/css/bootstrap.min.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-bootstrap-tour.min',plugins_url('/nf-admin/css/bootstrap-tour.min.css',dirname(__FILE__)),'',$js_version);
		
		wp_enqueue_style('nex-forms-admin-bootstrap.colorpickersliders',plugins_url('/nf-admin/css/bootstrap.colorpickersliders.css?v=',dirname(__FILE__)),'',$js_version);
		//FRONT+BACK
		wp_enqueue_style('nex-forms-jq-ui',plugins_url('/css/jquery-ui.min.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-animate',plugins_url('/css/animate.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-fields',plugins_url('/css/fields.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-ui',plugins_url('/css/ui.css',dirname(__FILE__)),'',$js_version);
		
		wp_enqueue_style('nex_forms-font-awesome-5',plugins_url('/css/fa5/css/all.min.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-font-awesome-4-shims',plugins_url('/css/fa5/css/v4-shims.min.css',dirname(__FILE__)),'',$js_version);
		
		wp_enqueue_style('nex-forms-materialize.min',plugins_url('/css/materialize-ui.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-nf-md-checkbox-radio',plugins_url('/css/material-checkboxradio.css',dirname(__FILE__)),'',$js_version);
		
		wp_enqueue_style('nex-forms-nf-nouislider',plugins_url('/css/nouislider.css',dirname(__FILE__)),'',$js_version);
		wp_enqueue_style('nex-forms-bootstrap-material-datetimepicker', plugins_url( '/css/bootstrap-material-datetimepicker.css',dirname(__FILE__)),'',$js_version);
		
		wp_enqueue_style('nex-forms-jqui-timepicker', plugins_url( '/css/jqui-timepicker.css',dirname(__FILE__)),'',$js_version);
		
		wp_enqueue_style('nex-forms-material-theme-amber','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-blue-gray','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-blue','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-brown','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-cyan','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-deep-purple','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-default','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-gray','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-green','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-indigo','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-light-blue','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-light-green','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-lime','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-orange','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-pink','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-purple','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-red','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-teal','',$js_version);
		wp_enqueue_style('nex-forms-material-theme-yellow','',$js_version);	
		
		}
	
	
	
	
}
add_action( 'admin_enqueue_scripts', 'enqueue_nf_admin_scripts' );
add_action( 'admin_enqueue_scripts', 'enqueue_nf_admin_styles' );
?>