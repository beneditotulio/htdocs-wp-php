<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action('wp_ajax_get_table_records', array('NEXForms_dashboard','get_table_records'));
add_action('wp_ajax_do_form_entry_save', array('NEXForms_dashboard','do_form_entry_save'));
add_action('wp_ajax_submission_report', array('NEXForms_dashboard','submission_report'));
add_action('wp_ajax_nf_print_chart', array('NEXForms_dashboard','print_chart'));

add_action('wp_ajax_nf_print_to_pdf', array('NEXForms_dashboard','print_to_pdf'));
add_action('wp_ajax_nopriv_nf_print_to_pdf', array('NEXForms_dashboard','print_to_pdf'));

add_action('wp_ajax_nf_print_report_to_pdf', array('NEXForms_dashboard','print_report_to_pdf'));
add_action('wp_ajax_nopriv_nf_print_report_to_pdf', array('NEXForms_dashboard','print_report_to_pdf'));



if(!class_exists('NEXForms_dashboard'))
	{
	class NEXForms_dashboard{
		public 
		$table = 'wap_nex_forms',
		$table_header = '',
		$extra_classes = '',
		$table_header_icon = '',
		$additional_params = array(),
		$search_params = array(),
		$build_table_dropdown = false,
		$table_headings = array(),
		$field_selection = array(),
		$extra_buttons = array(),
		$show_headings = true,
		$show_delete = true,
		$checkout = false,
		$client_info = 'no info',
		$action_button;
		
		public function __construct($table='', $table_header='', $extra_classes='', $table_header_icon='',$additional_params='', $search_params='', $table_headings='', $show_headings='', $show_delete='', $field_selection ='', $extra_buttons ='', $checkout=false ){
			$this->table 				= $table;
			$this->table_header 		= $table_header;
			$this->table_header_icon	= $table_header_icon;
			$this->additional_params 	= $additional_params;
			$this->search_params 		= $search_params;
			$this->field_selection 		= $field_selection;
			$this->table_headings		= $table_headings;
			$this->show_headings		= $show_headings;
			$this->show_delete			= $show_delete;
			$this->extra_buttons		= $extra_buttons;
			$this->extra_classes		= $extra_classes;
			}
		public function dashboard_checkout()
			{
			$db_action = new NEXForms_Database_Actions();
			$this->checkout	= $db_action->checkout();
			$this->client_info	= $db_action->client_info;	
			
			}
		public function dashboard_header(){
				$item = get_option('7103891');
				
				$output = '';
				$config = new NEXForms5_Config();
				$nf_function = new NEXForms_Functions();
				//$builder = new NEXForms_Builder7();
					
				$output .= $nf_function->new_form_setup($this->checkout);
				
			   
				$theme = wp_get_theme();
				$output .= '<div id="demo_site" style="display:none;">'.(($theme->Name=='NEX-Forms Demo') ? 'yes' : 'no').'</div>';
				$output .= '<div id="currently_viewing" style="display:none;">'.(($this->checkout) ? 'dashboard' : 'backend').'</div>';
				
				$output .= '<div class="row row_zero_margin">';
					
					$output .= '
						<div class="col-sm-12">
						  <nav class="nav-extended dashboard_nav aa_bg_main main_nav">
							
							<div class="nav-content aa_bg_main">
							 
							  <ul class="tabs_nf  aa_bg_main aa_menu">
							  	
								 <li class="tab logo"><img src="'. plugins_url( '/nf-admin/css/images/logo.png',dirname(dirname(__FILE__))).'" alt=""><span class="version_number">v '.$config->plugin_version.'</li>
							  	
								<li class="tab"><a class="active forms_tab" href="#dashboard_panel">'.__('Forms &amp; Analytics','nex-forms').'</a></li>
								<li class="tab"><a href="#latest_submissions" class="submissions_tab">'.__('Submissions','nex-forms').'</a></li>';
								if(function_exists('run_nf_adv_paypal') && $theme->Name!='NEX-Forms Demo')
									$output .= '<li class="tab"><a href="#online_payments">'.__('Payments','nex-forms').'</a></li>';

								
								
								$output .= '
								<li class="tab"><a href="#submission_reports" class="reporting_tab">'.__('Reporting','nex-forms').'</a></li>
								<li class="tab"><a href="#file_uploads" class="file_uploads_tab">'.__('File Uploads','nex-forms').'</a></li>
								<li class="tab"><a href="#global_settings" class="global_settings_tab">'.__('Global Settings','nex-forms').'</a></li>
								<li class="tab"><a href="#add_ons_panel" class="add_ons_tab">'.__('ADD-ONS','nex-forms').' </a></li>
								<li class="tab docs_link"><a href="http://basixonline.net/nex-forms-docs/" target="_blank"><span class="fa fas fa-file-export"></span> '.__('DOCS','nex-forms').'</a></li>
								'.(($theme->Name=='NEX-Forms Demo') ? '<a href="http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?license=regular&open_purchase_for_item_id=7103891&purchasable=source&ref=Basix" target="_blank" class="btn waves-effect waves-light upgrade_pro">BUY NEX-FORMS</a>' : '' ).'
							  </ul>
							</div>
						  </nav>
						</div>';
				
				$output .= '</div>';
				
				return $output;
		}	
		
		public function form_analytics(){
			
			global $wpdb;
			
			$output = '';
			
			$output .= '<div class="dashboard-box form_analytics">';
			
				$output .= '<div class="dashboard-box-header">';
					$output .= '<div class="table_title"><i class="material-icons header-icon">insert_chart</i> <span class="header_text">'.__('Analytics','nex-forms').'</span></div>
					  
					';
					$output .= '<div class="controls">';
						$output .= '<div class="col-xs-3">';
							$output .= '<select class="form_control" name="stats_per_form">';
								$output .= '<option value="0" selected>'.__('All Forms','nex-forms').'</option>';
								$get_forms = 'SELECT * FROM '.$wpdb->prefix.'wap_nex_forms WHERE is_template<>1 AND is_form<>"preview" AND is_form<>"draft" ORDER BY Id DESC';
								
								$forms = $wpdb->get_results($get_forms);
								foreach($forms as $form)
									$output .= '<option value="'.$form->Id.'">'.str_replace('\\','',$form->title).'</option>';
							$output .= '</select>';
							
						$output .= '</div>';
						
						$output .= '<div class="col-xs-2">';
							$output .= '<select class="form_control" name="stats_per_year">';
								$current_year = (int)date('Y');
								$output .= '<option value="'.$current_year.'" selected>'.$current_year.'</option>';
								for($i=($current_year-1);$i>=($current_year-20);$i--)
									{
									if($i>=2015)
										$output .= '<option value="'.$i.'">'.$i.'</option>';
									}
							$output .= '</select>';
						$output .= '</div>';
						
						$output .= '<div class="col-xs-2">';
							$output .= '<select class="form_control" name="stats_per_month">';
							$month_array = array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
								//$output .= '<option value="0">'.__('Month','nex-forms').'</option>';
								$current_month = (int)date('m');
								foreach($month_array as $key=>$val)
									{
									$output .= '<option value="'.$key.'" '.(($key==$current_month) ? 'selected' : '' ).'>'.$val.'</option>';
									
									}
							$output .= '</select>';
						$output .= '</div>';
						
							//$output .= '<button class="btn waves-effect waves-light switch_chart" data-chart-type="global"><i class="fa fa-globe"></i></button>';
							$output .= '<button class="btn waves-effect waves-light switch_chart" data-chart-type="radar"><i class="fa fa-spider"></i></button>';
							$output .= '<button class="btn waves-effect waves-light switch_chart" data-chart-type="polarArea"><i class="fa fa-bullseye"></i></button>';
							$output .= '<button class="btn waves-effect waves-light switch_chart" data-chart-type="doughnut"><i class="fa fa-pie-chart"></i></button>';
							$output .= '<button class="btn waves-effect waves-light switch_chart" data-chart-type="bar"><i class="fa fa-bar-chart"></i></button>';
							$output .= '<button class="btn waves-effect waves-light switch_chart active" data-chart-type="line"><i class="fa fa-line-chart"></i></button>';
						
						
					$output .= '</div>';
				$output .= '</div>';
				
				
				
				
					
				
				$output .= '<div  class="dashboard-box-content">';
				
				
					
					$output .= '<div class="chart-container"><div class="data_set">'.$this->print_chart($this->checkout).'</div>
					
					<canvas id="chart_canvas" height="136px" ></canvas>
					</div>';
					
					
					
					
					
				$output .= '</div>';
				$output .='<div class="chart_legend">';
					$output .= '<span class="legend" style="background:#1976D2">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;'.__('Views','nex-forms').'&nbsp;&nbsp;&nbsp;&nbsp;';
					$output .= '<span class="legend" style="background:#8BC34A">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;'.__('Interactions','nex-forms').'&nbsp;&nbsp;&nbsp;&nbsp;';
					$output .= '<span class="legend" style="background:#F57C00">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;'.__('Submissions','nex-forms').'</div>';
				$output .= '</div>';
			
			return $output;
		}	
		
		public function print_chart($args=''){
			global $wpdb;
			$current_year = (int)date('Y');
	
					$year_selected = isset($_REQUEST['year_selected']) ? $_REQUEST['year_selected'] : (int)date('Y');
					$month_selected =  isset($_REQUEST['month_selected']) ? $_REQUEST['month_selected'] : (int)date('m');
					$month_array = array('1'=>__('January','nex-forms'),'2'=>__('February','nex-forms'),'3'=>__('March','nex-forms'),'4'=>__('April','nex-forms'),'5'=>__('May','nex-forms'),'6'=>__('June','nex-forms'),'7'=>__('July','nex-forms'),'8'=>__('August','nex-forms'),'9'=>__('September','nex-forms'),'10'=>__('October','nex-forms'),'11'=>__('November','nex-forms'),'12'=>__('December','nex-forms'));
					
					if($year_selected)
						$current_year = $year_selected;
					
					$database_actions = new NEXForms_Database_Actions();
					$nf7_functions = new NEXForms_Functions();
					
					if($args)
						$checkin = $args;
					else
						$checkin = $database_actions->checkout();
					
					$form_id = isset($_REQUEST['form_id']) ? filter_var($_REQUEST['form_id'],FILTER_SANITIZE_NUMBER_INT) : '';
					
									
					if($form_id)
						{
						$get_entries = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_entries WHERE nex_forms_Id = '.$form_id.' AND Year(date_time)=Year("'.$current_year.'-'.$month_selected.'-01") AND Month(date_time)= Month("'.$current_year.'-'.$month_selected.'-01") ORDER BY date_time ASC',$form_id);
						$form_entries = $wpdb->get_results($get_entries);
					
						$get_views = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_views WHERE nex_forms_Id = '.$form_id.' AND Year(date_time)=Year("'.$current_year.'-'.$month_selected.'-01") AND Month(date_time)= Month("'.$current_year.'-'.$month_selected.'-01") ORDER BY time_viewed ASC',$form_id);
						$form_views = $wpdb->get_results($get_views);
						
						$get_interactions = $wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_stats_interactions WHERE nex_forms_Id = '.$form_id.' AND Year(date_time)=Year("'.$current_year.'-'.$month_selected.'-01") AND Month(date_time)= Month("'.$current_year.'-'.$month_selected.'-01") ORDER BY time_interacted ASC',$form_id);
						$form_interactions = $wpdb->get_results($get_interactions);
						}
					else
						{
						$get_entries = 'SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_entries WHERE Year(date_time)=Year("'.$current_year.'-'.$month_selected.'-01") AND Month(date_time)= Month("'.$current_year.'-'.$month_selected.'-01")';
						$form_entries = $wpdb->get_results($get_entries);
						
						$get_views = 'SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_views WHERE Year(date_time)=Year("'.$current_year.'-'.$month_selected.'-01") AND Month(date_time)= Month("'.$current_year.'-'.$month_selected.'-01")';
						$form_views = $wpdb->get_results($get_views);
						
						$get_interactions = 'SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_stats_interactions WHERE Year(date_time)=Year("'.$current_year.'-'.$month_selected.'-01") AND Month(date_time)= Month("'.$current_year.'-'.$month_selected.'-01")';
						$form_interactions = $wpdb->get_results($get_interactions);
						}
						
					$submit_array 				= array();
					$view_array 				= array();
					$interaction_array 			= array();
					$submit_array_pm 			= array();
					$view_array_pm 				= array();
					$interaction_array_pm 		= array();
					$country_array 				= array(
													'AF' => __('Afghanistan','nex-forms'),
													'AX' => __('Aland Islands','nex-forms'),
													'AL' => __('Albania','nex-forms'),
													'DZ' => __('Algeria','nex-forms'),
													'AS' => __('American Samoa','nex-forms'),
													'AD' => __('Andorra','nex-forms'),
													'AO' => __('Angola','nex-forms'),
													'AI' => __('Anguilla','nex-forms'),
													'AQ' => __('Antarctica','nex-forms'),
													'AG' => __('Antigua and Barbuda','nex-forms'),
													'AR' => __('Argentina','nex-forms'),
													'AM' => __('Armenia','nex-forms'),
													'AW' => __('Aruba','nex-forms'),
													'AU' => __('Australia','nex-forms'),
													'AT' => __('Austria','nex-forms'),
													'AZ' => __('Azerbaijan','nex-forms'),
													'BS' => __('Bahamas the','nex-forms'),
													'BH' => __('Bahrain','nex-forms'),
													'BD' => __('Bangladesh','nex-forms'),
													'BB' => __('Barbados','nex-forms'),
													'BY' => __('Belarus','nex-forms'),
													'BE' => __('Belgium','nex-forms'),
													'BZ' => __('Belize','nex-forms'),
													'BJ' => __('Benin','nex-forms'),
													'BM' => __('Bermuda','nex-forms'),
													'BT' => __('Bhutan','nex-forms'),
													'BO' => __('Bolivia','nex-forms'),
													'BA' => __('Bosnia and Herzegovina','nex-forms'),
													'BW' => __('Botswana','nex-forms'),
													'BV' => __('Bouvet Island (Bouvetoya)','nex-forms'),
													'BR' => __('Brazil','nex-forms'),
													'IO' => __('British Indian Ocean Territory (Chagos Archipelago)','nex-forms'),
													'VG' => __('British Virgin Islands','nex-forms'),
													'BN' => __('Brunei Darussalam','nex-forms'),
													'BG' => __('Bulgaria','nex-forms'),
													'BF' => __('Burkina Faso','nex-forms'),
													'BI' => __('Burundi','nex-forms'),
													'KH' => __('Cambodia','nex-forms'),
													'CM' => __('Cameroon','nex-forms'),
													'CA' => __('Canada','nex-forms'),
													'CV' => __('Cape Verde','nex-forms'),
													'KY' => __('Cayman Islands','nex-forms'),
													'CF' => __('Central African Republic','nex-forms'),
													'TD' => __('Chad','nex-forms'),
													'CL' => __('Chile','nex-forms'),
													'CN' => __('China','nex-forms'),
													'CX' => __('Christmas Island','nex-forms'),
													'CC' => __('Cocos (Keeling) Islands','nex-forms'),
													'CO' => __('Colombia','nex-forms'),
													'KM' => __('Comoros the','nex-forms'),
													'CD' => __('Congo - Kinshasa','nex-forms'),
													'CG' => __('Congo - Brazzaville','nex-forms'),
													'CK' => __('Cook Islands','nex-forms'),
													'CR' => __('Costa Rica','nex-forms'),
													'CI' => __('CI','nex-forms'),
													'HR' => __('Croatia','nex-forms'),
													'CU' => __('Cuba','nex-forms'),
													'CY' => __('Cyprus','nex-forms'),
													'CZ' => __('Czech Republic','nex-forms'),
													'DK' => __('Denmark','nex-forms'),
													'DJ' => __('Djibouti','nex-forms'),
													'DM' => __('Dominica','nex-forms'),
													'DO' => __('Dominican Republic','nex-forms'),
													'EC' => __('Ecuador','nex-forms'),
													'EG' => __('Egypt','nex-forms'),
													'SV' => __('El Salvador','nex-forms'),
													'GQ' => __('Equatorial Guinea','nex-forms'),
													'ER' => __('Eritrea','nex-forms'),
													'EE' => __('Estonia','nex-forms'),
													'ET' => __('Ethiopia','nex-forms'),
													'FO' => __('Faroe Islands','nex-forms'),
													'FK' => __('Falkland Islands (Malvinas)','nex-forms'),
													'FJ' => __('Fiji the Fiji Islands','nex-forms'),
													'FI' => __('Finland','nex-forms'),
													'FR' => __('France','nex-forms'),
													'GF' => __('French Guiana','nex-forms'),
													'PF' => __('French Polynesia','nex-forms'),
													'TF' => __('French Southern Territories','nex-forms'),
													'GA' => __('Gabon','nex-forms'),
													'GM' => __('Gambia the','nex-forms'),
													'GE' => __('Georgia','nex-forms'),
													'DE' => __('Germany','nex-forms'),
													'GH' => __('Ghana','nex-forms'),
													'GI' => __('Gibraltar','nex-forms'),
													'GR' => __('Greece','nex-forms'),
													'GL' => __('Greenland','nex-forms'),
													'GD' => __('Grenada','nex-forms'),
													'GP' => __('Guadeloupe','nex-forms'),
													'GU' => __('Guam','nex-forms'),
													'GT' => __('Guatemala','nex-forms'),
													'GG' => __('Guernsey','nex-forms'),
													'GN' => __('Guinea','nex-forms'),
													'GW' => __('Guinea-Bissau','nex-forms'),
													'GY' => __('Guyana','nex-forms'),
													'HT' => __('Haiti','nex-forms'),
													'HM' => __('Heard Island and McDonald Islands','nex-forms'),
													'VA' => __('Holy See (Vatican City State)','nex-forms'),
													'HN' => __('Honduras','nex-forms'),
													'HK' => __('Hong Kong','nex-forms'),
													'HU' => __('Hungary','nex-forms'),
													'IS' => __('Iceland','nex-forms'),
													'IN' => __('India','nex-forms'),
													'ID' => __('Indonesia','nex-forms'),
													'IR' => __('Iran','nex-forms'),
													'IQ' => __('Iraq','nex-forms'),
													'IE' => __('Ireland','nex-forms'),
													'IM' => __('Isle of Man','nex-forms'),
													'IL' => __('Israel','nex-forms'),
													'IT' => __('Italy','nex-forms'),
													'JM' => __('Jamaica','nex-forms'),
													'JP' => __('Japan','nex-forms'),
													'JE' => __('Jersey','nex-forms'),
													'JO' => __('Jordan','nex-forms'),
													'KZ' => __('Kazakhstan','nex-forms'),
													'KE' => __('Kenya','nex-forms'),
													'KI' => __('Kiribati','nex-forms'),
													'KP' => __('North Korea','nex-forms'),
													'KR' => __('South Korea','nex-forms'),
													'KW' => __('Kuwait','nex-forms'),
													'KG' => __('Kyrgyzstan','nex-forms'),
													'LA' => __('Lao','nex-forms'),
													'LV' => __('Latvia','nex-forms'),
													'LB' => __('Lebanon','nex-forms'),
													'LS' => __('Lesotho','nex-forms'),
													'LR' => __('Liberia','nex-forms'),
													'LY' => __('Libya','nex-forms'),
													'LI' => __('Liechtenstein','nex-forms'),
													'LT' => __('Lithuania','nex-forms'),
													'LU' => __('Luxembourg','nex-forms'),
													'MO' => __('Macao','nex-forms'),
													'MK' => __('Macedonia','nex-forms'),
													'MG' => __('Madagascar','nex-forms'),
													'MW' => __('Malawi','nex-forms'),
													'MY' => __('Malaysia','nex-forms'),
													'MV' => __('Maldives','nex-forms'),
													'ML' => __('Mali','nex-forms'),
													'MT' => __('Malta','nex-forms'),
													'MH' => __('Marshall Islands','nex-forms'),
													'MQ' => __('Martinique','nex-forms'),
													'MR' => __('Mauritania','nex-forms'),
													'MU' => __('Mauritius','nex-forms'),
													'YT' => __('Mayotte','nex-forms'),
													'MX' => __('Mexico','nex-forms'),
													'FM' => __('Micronesia','nex-forms'),
													'MD' => __('Moldova','nex-forms'),
													'MC' => __('Monaco','nex-forms'),
													'MN' => __('Mongolia','nex-forms'),
													'ME' => __('Montenegro','nex-forms'),
													'MS' => __('Montserrat','nex-forms'),
													'MA' => __('Morocco','nex-forms'),
													'MZ' => __('Mozambique','nex-forms'),
													'MM' => __('Myanmar','nex-forms'),
													'NA' => __('Namibia','nex-forms'),
													'NR' => __('Nauru','nex-forms'),
													'NP' => __('Nepal','nex-forms'),
													'AN' => __('Netherlands Antilles','nex-forms'),
													'NL' => __('Netherlands','nex-forms'),
													'NC' => __('New Caledonia','nex-forms'),
													'NZ' => __('New Zealand','nex-forms'),
													'NI' => __('Nicaragua','nex-forms'),
													'NE' => __('Niger','nex-forms'),
													'NG' => __('Nigeria','nex-forms'),
													'NU' => __('Niue','nex-forms'),
													'NF' => __('Norfolk Island','nex-forms'),
													'MP' => __('Northern Mariana Islands','nex-forms'),
													'NO' => __('Norway','nex-forms'),
													'OM' => __('Oman','nex-forms'),
													'PK' => __('Pakistan','nex-forms'),
													'PW' => __('Palau','nex-forms'),
													'PS' => __('Palestinian Territory','nex-forms'),
													'PA' => __('Panama','nex-forms'),
													'PG' => __('Papua New Guinea','nex-forms'),
													'PY' => __('Paraguay','nex-forms'),
													'PE' => __('Peru','nex-forms'),
													'PH' => __('Philippines','nex-forms'),
													'PN' => __('Pitcairn Islands','nex-forms'),
													'PL' => __('Poland','nex-forms'),
													'PT' => __('Portugal','nex-forms'),
													'PR' => __('Puerto Rico','nex-forms'),
													'QA' => __('Qatar','nex-forms'),


													'RE' => __('Reunion','nex-forms'),
													'RO' => __('Romania','nex-forms'),
													'RU' => __('Russia','nex-forms'),
													'RW' => __('Rwanda','nex-forms'),
													'BL' => __('Saint Barthelemy','nex-forms'),
													'SH' => __('Saint Helena','nex-forms'),
													'KN' => __('Saint Kitts and Nevis','nex-forms'),
													'LC' => __('Saint Lucia','nex-forms'),
													'MF' => __('Saint Martin','nex-forms'),
													'PM' => __('Saint Pierre and Miquelon','nex-forms'),
													'VC' => __('Saint Vincent and the Grenadines','nex-forms'),
													'WS' => __('Samoa','nex-forms'),
													'SM' => __('San Marino','nex-forms'),
													'ST' => __('Sao Tome and Principe','nex-forms'),
													'SA' => __('Saudi Arabia','nex-forms'),
													'SN' => __('Senegal','nex-forms'),
													'RS' => __('Serbia','nex-forms'),
													'SC' => __('Seychelles','nex-forms'),
													'SL' => __('Sierra Leone','nex-forms'),
													'SG' => __('Singapore','nex-forms'),
													'SS' => __('SS','nex-forms'),
													'SK' => __('Slovakia (Slovak Republic)','nex-forms'),
													'SI' => __('Slovenia','nex-forms'),
													'SB' => __('Solomon Islands','nex-forms'),
													'SO' => __('Somalia, Somali Republic','nex-forms'),
													'ZA' => __('South Africa','nex-forms'),
													'GS' => __('South Georgia and the South Sandwich Islands','nex-forms'),
													'ES' => __('Spain','nex-forms'),
													'LK' => __('Sri Lanka','nex-forms'),
													'SD' => __('Sudan','nex-forms'),
													'SR' => __('Suriname','nex-forms'),
													'SJ' => __('SJ','nex-forms'),
													'SZ' => __('Swaziland','nex-forms'),
													'SE' => __('Sweden','nex-forms'),
													'CH' => __('Switzerland, Swiss Confederation','nex-forms'),
													'SY' => __('Syrian Arab Republic','nex-forms'),
													'TW' => __('Taiwan','nex-forms'),
													'TJ' => __('Tajikistan','nex-forms'),
													'TZ' => __('Tanzania','nex-forms'),
													'TH' => __('Thailand','nex-forms'),
													'TL' => __('Timor-Leste','nex-forms'),
													'TG' => __('Togo','nex-forms'),
													'TK' => __('Tokelau','nex-forms'),
													'TO' => __('Tonga','nex-forms'),
													'TT' => __('Trinidad and Tobago','nex-forms'),
													'TN' => __('Tunisia','nex-forms'),
													'TR' => __('Turkey','nex-forms'),
													'TM' => __('Turkmenistan','nex-forms'),
													'TC' => __('Turks and Caicos Islands','nex-forms'),
													'TV' => __('Tuvalu','nex-forms'),
													'UG' => __('Uganda','nex-forms'),
													'UA' => __('Ukraine','nex-forms'),
													'AE' => __('United Arab Emirates','nex-forms'),
													'GB' => __('United Kingdom','nex-forms'),
													'US' => __('United States','nex-forms'),
													'UM' => __('United States Minor Outlying Islands','nex-forms'),
													'VI' => __('United States Virgin Islands','nex-forms'),
													'UY' => __('Uruguay','nex-forms'),
													'UZ' => __('Uzbekistan','nex-forms'),
													'VU' => __('Vanuatu','nex-forms'),
													'VE' => __('Venezuela','nex-forms'),
													'VN' => __('Vietnam','nex-forms'),
													'WF' => __('Wallis and Futuna','nex-forms'),
													'EH' => __('Western Sahara','nex-forms'),
													'YE' => __('Yemen','nex-forms'),
													'ZM' => __('Zambia','nex-forms'),
													'ZW' => __('Zimbabwe','nex-forms')
												);
					$total_form_entries 		= 0;
					$total_form_views	 		= 0;
					$total_form_interactions 	= 0;
					$set_form_views 			= rand(1010,1999);
					$set_form_interactions 		= rand(410,999);
					$set_form_entries 			= rand(10,399);
					
					$days_in_month = '';
					if($month_selected && $month_selected!='0')
						$days_in_month = cal_days_in_month(CAL_GREGORIAN, (int)$month_selected, $current_year);
					
					for($m=1;$m<=12;$m++)
						{
						$submit_array[$m]		= 0;
						$view_array[$m]			= 0;
						$interaction_array[$m]	= 0;
						}
					for($d=1;$d<=$days_in_month;$d++)
						{
						$submit_array_pm[$d] 		= 0;
						$view_array_pm[$d]			= 0;
						$interaction_array_pm[$d]	= 0;
						}
					
					$array_countries = array();
					foreach($country_array as $key=>$val)
						$array_countries[$key] = 0;
						
					foreach($form_entries as $form_entry)
						{
						
						$year = substr($form_entry->date_time,0,4);
						$month = (int)substr($form_entry->date_time,5,2);
						$day = (int)substr($form_entry->date_time,8,2);
						
						if($current_year==$year)
							{
							if($month_selected && $month_selected!='0')
								{
								if($month==$month_selected)
									{
									
									$total_form_entries++;
									
									if($form_entry->country!='')
										$array_countries[$form_entry->country]++;
										
									
									
									for($d=1;$d<=$days_in_month;$d++)
										{
										if($day==$d)
											{
											$submit_array_pm[$d]++;
											}
										}	
									}
								}
							else
								{	
								for($m=1;$m<=12;$m++)
									{
									if($month==$m)
										{
										$submit_array[$m]++;	
										$total_form_entries++;
										if($form_entry->country!='')
											$array_countries[$form_entry->country]++;
											
										
										}
									}
								}
							}
						}	
					foreach($form_views as $view)
						{
						$date = date('Y-m-d h:i:s',$view->time_viewed);
						$year = substr($date,0,4);
						$month = (int)substr($date,5,2);
						$day = (int)substr($date,8,2);
						
						if($current_year==$year)
							{
							if($month_selected && $month_selected!='0')
								{
								if($month==$month_selected)
									{
									$total_form_views++;
									for($dv=1;$dv<=$days_in_month;$dv++)
										{
										if($day==$dv)
											$view_array_pm[$dv]++;		
										}	
									}
								}
							else
								{	
								for($mv=1;$mv<=12;$mv++)
									{
									if($month==$mv)
										{
										$view_array[$mv]++;	
										$total_form_views++;
										}
									}
								}	
							}
						}
					
					foreach($form_interactions as $interaction)
						{
						
						$date = date('Y-m-d h:i:s',$interaction->time_interacted);
						$year = substr($date,0,4);
						$month = (int)substr($date,5,2);
						$day = (int)substr($date,8,2);
						
						if($current_year==$year)
							{
							if($month_selected && $month_selected!='0')
								{
								if($month==$month_selected)
									{
									$total_form_interactions++;
									for($dv=1;$dv<=$days_in_month;$dv++)
										{
										if($day==$dv)
											$interaction_array_pm[$dv]++;		
										}	
									}
								}
							else
								{	
								for($mv=1;$mv<=12;$mv++)
									{
									if($month==$mv)
										{
										$interaction_array[$mv]++;	
										$total_form_interactions++;
										}
									}
								}	
							}
						}
					$output = '';
					
					if(!$checkin)
						{
						for($m=1;$m<=12;$m++)
							{
							$submit_array[$m] = rand(20,150);
							$interaction_array[$m] = rand(170,429);
							$view_array[$m] = rand(440,999);
							}
						
						for($dv=1;$dv<=$days_in_month;$dv++)
							{
							$submit_array_pm[$dv] = rand(20,99);
							$interaction_array_pm[$dv] = rand(170,429);
							$view_array_pm[$dv] = rand(440,999);	
							}
						}
					
					
					
					$output.= '<div class="row stats">';
						if(!$checkin)
							{
							$output.= '<div class="alert alert-danger" style="width:95%"><strong>'.__('Plugin NOT Registered!</strong> The below <strong>data is randomized</strong>! To view actual data go to Global Settings above and register the plugin.','nex-forms').'</div>';	
							}
							
							
							$output.= '<div class="col-xs-3" ><span class="big_txt">'.(($checkin) ? $total_form_views : $set_form_views).'</span> <label style="color:#1976D2;">'.__('Views','nex-forms').'</label> </div>';
							$output.= '<div class="col-xs-3" ><span class="big_txt">'.(($checkin) ? $total_form_interactions : $set_form_interactions).'</span> <label style="color:#8BC34A;">'.__('Interactions','nex-forms').'</label> </div>';
							$output.= '<div class="col-xs-3" ><span class="big_txt">'.(($checkin) ? $total_form_entries : $set_form_entries).'</span> <label style="color:#F57C00;">'.__('Submissions','nex-forms').'</label> </div>';
							
							if($total_form_entries==0 || $total_form_views==0)
								$output.= '<div class="col-xs-3" ><span class="big_txt">0%</span> <label>Conversion</label> </div>';
							else
								$output.= '<div class="col-xs-3" ><span class="big_txt">'.round((($total_form_entries/$total_form_views)*100),2).'%</span> <label>Conversion</label> </div>';
								
								
								
							$output.= '</div>';
							
							$get_countries = $nf7_functions->code_to_country('',1);
							$opacity = 0.1;
							$chart_type = isset($_REQUEST['chart_type']) ? $_REQUEST['chart_type'] : '';
							if($chart_type=='global')
								{
									
								$output .= '<script type="text/javascript">
											  google.charts.load(\'current\', {\'packages\':[\'geochart\']});
											  google.charts.setOnLoadCallback(drawRegionsMap);
										
											  function drawRegionsMap() {
										
												var data = google.visualization.arrayToDataTable([
												  [\'Country\', \'Submissions\'],
												  
												  ';
												  if($checkin)
												  	{
													foreach($array_countries as $key=>$value)
														{
														if(is_int($value))
															$output .=	  '[\''.$nf7_functions->code_to_country($key).'\', '.$value.'],';
														
														}
													}
												else
													{
													foreach($get_countries as $key=>$val)
														$output .=	  '["'.str_replace('"','',$val).'", '.rand(0,150).'],';	
													}
												  $output .= '
												]);
										
												var options = {};
										
												var gchart = new google.visualization.GeoChart(document.getElementById(\'regions_div\'));
										
												gchart.draw(data, options);
											  }
											</script>';
									$output .= '<div id="regions_div" style="width: 900px; height: 500px;"></div>';
								}
							if($chart_type=='bar')
								$opacity = 0.2;
							
							if($chart_type=='doughnut' || $chart_type=='polarArea')
								{
								$opacity = 0.3;
								$output .= '<script>
									randomScalingFactor = function(){ return Math.round(Math.random()*100)};
									
									var lineChartData = {
											labels: [
												"'.__('Views','nex-forms').'",
												"'.__('Interactions','nex-forms').'",
												"'.__('Submissions','nex-forms').'"
											],
									datasets: [
										{
											data: ['.(($checkin) ? $total_form_views : $set_form_views).', '.(($checkin) ? $total_form_interactions : $set_form_interactions).', '.(($checkin) ? $total_form_entries : $set_form_entries).'],
											backgroundColor: [
												"'.NEXForms5_hex2RGB('#1976D2',true,',',$opacity).'",
												"'.NEXForms5_hex2RGB('#8BC34A',true,',',$opacity).'",
												"'.NEXForms5_hex2RGB('#F57C00',true,',',$opacity).'"
											],
											hoverBackgroundColor: [
												"#1976D2",
												"#8BC34A",
												"#F57C00"
											],
											borderColor : [
												"#fff",
												"#fff",
												"#fff"
											],
											
										}]
									}
								</script>';
								}
							else
								{		
								$output.= '<script>
									randomScalingFactor = function(){ return Math.round(Math.random()*100)};
									lineChartData = {
										labels : [';
										$stop_count = 1;
										if($month_selected && $month_selected!='0')
											{
											for($d=1;$d<=$days_in_month;$d++)
												{
												$output.= '"'.$d.'"';
												if($d<$days_in_month)
													$output.= ',';
												}
											}
										else
											{
											foreach($month_array as $month)
												{
												$output.= '"'.$month.'"';
												if($stop_count<12)
													$output.= ',';
												$stop_count++;		
												}
											}
										$output.= '],
										datasets : [
											{
												label: "'.__('Form Views','nex-forms').'",
												backgroundColor : "'.NEXForms5_hex2RGB('#1976d2',true,',',$opacity).'",
												borderColor : "#1976d2",
												borderWidth : 1,
												pointBackgroundColor : "#1976d2",
												pointHoverBorderWidth : 5,
												fill:true,
												data : [
												';
												if($month_selected && $month_selected!='0')
													{
													$counter2 = 1;
													foreach($view_array_pm as $views)
														{
														$output.= $views;
														if($counter2<$days_in_month)
															$output.= ',';
														$counter2++;		
														}
													}
												else
													{
													$counter2 = 1;
													foreach($view_array as $views)
														{
														$output.= $views;
														if($counter2<12)
															$output.= ',';
														$counter2++;				
														}
													}
											$output.= '
													]
											},
											
											{
												label: "'.__('Form Interactions','nex-forms').'",
												backgroundColor : "'.NEXForms5_hex2RGB('#8BC34A',true,',',$opacity).'",
												borderColor : "#8BC34A",
												borderWidth : 1,
												pointBackgroundColor : "#8BC34A",
												pointHoverBorderWidth : 5,
												fill:true,
												data : [
												';
												if($month_selected && $month_selected!='0')
													{
													$counter3 = 1;
													foreach($interaction_array_pm as $interaction)
														{
														$output.= $interaction;
														if($counter3<$days_in_month)
															$output.= ',';
														$counter3++;		
														}
													}
												else
													{
													$counter3 = 1;
													foreach($interaction_array as $interaction)
														{
														$output.= $interaction;
														if($counter3<12)
															$output.= ',';
														$counter3++;				
														}
													}
											$output.= '
													]
											},
											{
												label: "'.__('Form Entries','nex-forms').'",
												backgroundColor : "'.NEXForms5_hex2RGB('#F57C00',true,',',$opacity).'",
												borderColor : "#F57C00",
												borderWidth : 1,
												pointBackgroundColor : "#F57C00",
												pointHoverBorderWidth : 5,
												fill:true,
												data : [
												';
												if($month_selected && $month_selected!='0')
													{
													$counter = 1;
													foreach($submit_array_pm as $submissions)
														{
														$output.= $submissions;
														if($counter<$days_in_month)
															$output.= ',';
														$counter++;		
														}
													}
												else
													{
													$counter = 1;
													foreach($submit_array as $submissions)
														{
														$output.= $submissions;
														if($counter<12)
															$output.= ',';
														$counter++;		
														}
													}
											$output.= '
													]
											}
										]
									}
								  </script>
								  ';
								}
						$ajax = isset($_REQUEST['ajax']) ? $_REQUEST['ajax'] : '';
						if($ajax)
							{
							echo $output;
							die();
							}
						else
							return $output;
		}
		
		
		public function print_record_table(){
			
			global $wpdb;
			
			$functions = new NEXForms_functions();
			$database_actions = new NEXForms_Database_Actions();
			
			$output = '';
			
			$output .= '<div class="dashboard-box database_table '.$this->table.' '.$this->extra_classes.'" data-table="'.$this->table.'">';
				$output .= '<div class="dashboard-box-header aa_bg_main">';
					$output .= '<div class="table_title">';
					if($this->action_button)
						$output .= '<a class="btn-floating btn-large waves-effect waves-light blue"><i class="material-icons">'.$this->action_button.'</i></a>';
					else
						$output .= '<i class="material-icons header-icon">'.$this->table_header_icon.'</i>';
					
					$output .= '<span class="header_text '.(($this->action_button) ? 'has_action_button' : '' ).'">'.$this->table_header.'</span></div>
					  <div class="search_box">
						<div class="input-field">
						<input id="search" type="text" class="search_box material-d" value="" placeholder="'.__('Search...','nex-forms').'" name="table_search_term">
						<i class="fa fa-search do_search"></i>
					   </div>
					   </div>
					';
					if(is_array($this->extra_buttons))
						{
						$output .= '<div class="dashboard-box-header-buttons">';
						foreach($this->extra_buttons as $button)
							{
							if($button['type']=='link')
								$output .= '<a href="'.$button['link'].'" class="'.$button['class'].' btn waves-effect waves-light">'.$button['icon'].'</a>';
							else
								$output .= '<button class="'.$button['class'].' btn waves-effect waves-light">'.$button['icon'].'</button>';
							}
						$output .= '</div>';
						}
					
				if($this->build_table_dropdown)
					{
					$output .= '<select class="form-control table_dropdown" name="'.$this->build_table_dropdown.'">';
						$output .= '<option value="0" selected>'.__('--- Select Form ---','nex-forms').'</option>';
						$get_forms = 'SELECT * FROM '.$wpdb->prefix.'wap_nex_forms WHERE is_template<>1 AND is_form<>"preview" AND is_form<>"draft" ORDER BY Id DESC';
						$forms = $wpdb->get_results($get_forms);
						foreach($forms as $form)
							$output .= '<option value="'.$form->Id.'">'.$database_actions->get_total_records($this->table,'',$form->Id).' - '.$form->title.'</option>';
					$output .= '</select>';
					}
				$output .= '</div>';
				$output .= '<div  class="dashboard-box-content zero_padding">';
				
					$output .= '<table class="">'; //highlight
					if($this->show_headings)
						{
						$output .= '<thead>';
							$output .= '<tr>';
							/*$output .= '<th class="db-table-head toggle-selection">
							<input id="rs-check-all" class="filled-in" name="check-all" value="check-all" type="checkbox"><label for="rs-check-all">
							</th>';*/
							foreach($this->table_headings as $key=>$val)
								{
								if(is_array($val))
									$output .= '<th class="db-table-head '.$functions->format_name($val['heading']).'">'.$functions->unformat_name($val['heading']).'</th>';
								else
									$output .= '<th class="db-table-head  '.$functions->format_name($val).'">'.$functions->unformat_name($val).'</th>';
								}
								
							$output .= '</tr>';
						    
								$output .= '<th></th>';
						$output .= '</thead>';
						}
						//$output .= $functions->print_preloader('big','blue',false,'database-table-loader');
						$output .= '<tbody class="'.(($this->checkout) ? 'saved_records_container' : 'saved_records_contianer').'">'.$this->get_table_records($this->additional_params, $this->search_params, $this->table_headings).'</tbody>';

					$output .= '</table>';
				$output .= '</div>';
				$output .= '<div class="paging_wrapper">';
					$output .='<input type="hidden" value="0" name="current_page" />';
					
					$output .="<input type='hidden' value='".json_encode($this->additional_params)."' name='additional_params' />";
					$output .="<input type='hidden' value='".json_encode($this->field_selection)."' name='field_selection' />";
					$output .="<input type='hidden' value='".json_encode($this->search_params)."'     name='search_params' />";
					$output .="<input type='hidden' value='".json_encode($this->table_headings)."'    name='header_params' />";
					$output .="<input type='hidden' value='".$this->table."'     name='database_table' />";
					
					$total_record = $database_actions->get_total_records($this->table,$this->additional_params,'', $this->search_params,'');
					
					$output .= '<div class="paging">';
						$output .= '
						<span class="displaying-num"><span class="entry-count">'.$total_record.'</span> '.__('items ','nex-forms').'</span>
						<span class="pagination-links">
							<a class="first-page iz-first-page btn waves-effect waves-light"><span class="fa fa-angle-double-left"></span></a>
							<a title="'.__('Go to the next page','nex-forms').'" class="iz-prev-page btn waves-effect waves-light prev-page"><span class="fa fa-angle-left"></span></a>&nbsp;
							<span class="paging-input"> <span class="current-page">1</span> '.__('of','nex-forms').' <span class="total-pages">'.round(($total_record/10)+1,0).'</span>&nbsp;</span>
							<a title="'.__('Go to the next page','nex-forms').'" class="iz-next-page btn waves-effect waves-light next-page"><span class="fa fa-angle-right"></span></a>
							<a title="'.__('Go to the last page','nex-forms').'" class="iz-last-page btn waves-effect waves-light last-page"><span class="fa fa-angle-double-right"></span></a>
						</span>
						
						';					
					$output .= '</div>';
				$output .= '</div>';
				
			$output .= '</div>';
			
			return $output;
		}	
		public function get_table_records($additional_params=array(), $search_params=array(), $header_params=array()){
			
			global $wpdb;
			$output = '';
			$page_num = isset($_POST['page']) ? $_POST['page'] : 0;
			$page_num = filter_var($page_num ,FILTER_SANITIZE_NUMBER_INT);
			
			$page_num = isset($_POST['page']) ? $_POST['page'] : 0;
			$page_num = filter_var($page_num ,FILTER_SANITIZE_NUMBER_INT);
			$search_term = isset($_POST['search_term']) ? $_POST['search_term'] : '';
			$limit = 10;			
			
			$nf_functions = new NEXForms_Functions();
			$database_actions = new NEXForms_Database_Actions();
			
			$header_params = (isset($_POST['header_params'])) ? $_POST['header_params'] : '';
			$additional_params = (isset($_POST['additional_params'])) ? $_POST['additional_params'] : '';
			$field_selection = (isset($_POST['field_selection'])) ? $_POST['field_selection'] : '';
			$search_params = (isset($_POST['search_params'])) ? $_POST['search_params'] : '';
			
			/*echo '<pre>';
			print_r($_POST['field_selection']);
			echo '</pre>';*/
			
			if($header_params)
				{
				$set_header_params = isset($header_params) ? $header_params : '';
				$header_params = json_decode(str_replace('\\','',$set_header_params),true);
				}
			else
				$header_params = $this->table_headings;
				
			if($additional_params)
				{
				$set_params = isset($additional_params) ? $additional_params : '';
				$additional_params = json_decode(str_replace('\\','',$set_params),true);
				}
			else
				$additional_params = $this->additional_params;
				
			if($field_selection)
				{
				$set_field_selection = isset($field_selection) ? $field_selection : '';
				$field_selection = json_decode(str_replace('\\','',$set_field_selection),true);
				}
			else
				$field_selection = $this->field_selection;	
			
			if($search_params)
				{
				$set_search_params = isset($search_params) ? $search_params : '';
				$search_params = json_decode(str_replace('\\','',$set_search_params),true);
				}
			else
				$search_params = $this->search_params;
			
			if(isset($_POST['table']))
				$table = $_POST['table'];
			else
				$table = $this->table;
				
			$where_str = '';
			
			$show_hide_field = (isset($_POST['showhide_fields'])) ? $_POST['showhide_fields'] : '';
			
			$show_cols = filter_var($show_hide_field ,FILTER_SANITIZE_STRING);
			
			if(is_array($additional_params))
				{
				foreach($additional_params as $clause)
					{
					$like = '';
					if($clause['operator'] == 'LIKE' || $clause['operator'] == 'NOT LIKE')
						$like = '%';
					$where_str .= ' AND `'.$clause['column'].'` '.(($clause['operator']!='') ? $clause['operator'] : '=').'  "'.$like.$clause['value'].$like.'"';
					}
				}
			
			$select_fields = '*';
			if(is_array($field_selection))
				{
				$j=1;
				$select_fields = '';
				foreach($field_selection as $field_select)
					{
					
					if($j<count($field_selection))
						 $select_fields .= '`'.$field_select.'`,';
					else
						$select_fields .= '`'.$field_select.'`';
					$j++;
					}
				}
			else
				{
				$select_fields = '*';	
				}
				
			$count_search_params = count($search_params);
			if(is_array($search_params) && $search_term)
				{
				if($count_search_params>1)
					{
					$where_str .= ' AND (';
					$loop_count = 1;
					foreach($search_params as $column)
						{
						if($loop_count==1)
							$where_str .= '`'.$column.'` LIKE "%'.$search_term.'%" ';
						else
							$where_str .= ' OR `'.$column.'` LIKE "%'.$search_term.'%" ';
							
						$loop_count++;
						}
					$where_str .= ') ';
					}
				else
					{
					foreach($search_params as $column)
						{
						$where_str .= ' AND `'.$column.'` LIKE "%'.$search_term.'%" ';
						}
					}
				}
			
			$entry_report_id = (isset($_POST['entry_report_id'])) ? $_POST['entry_report_id'] : '';
			$form_id = (isset($_POST['form_id'])) ? $_POST['form_id'] : '';
			$post_table = (isset($_POST['table'])) ? $_POST['table'] : '';
			
			if($entry_report_id)
				{
				$where_str .= ' AND nex_forms_Id = '.filter_var($entry_report_id ,FILTER_SANITIZE_NUMBER_INT);
				$nex_forms_id = filter_var($entry_report_id ,FILTER_SANITIZE_NUMBER_INT);
				}
			if($form_id)
				{
				$where_str .= ' AND nex_forms_Id = '.filter_var($form_id ,FILTER_SANITIZE_NUMBER_INT);
				$nex_forms_id = filter_var($form_id ,FILTER_SANITIZE_NUMBER_INT);
				}
			
			if($post_table)
				$output = '<div class="total_table_records hidden">'.$database_actions->get_total_records($table,$additional_params,$nex_forms_id, $search_params,$search_term).'</div>';
		
			
			
			$get_records = 'SELECT '.$select_fields.' FROM '.$wpdb->prefix.$table.'  WHERE Id<>"" '.$where_str.' ORDER BY Id DESC LIMIT '.($page_num*10).',10';
			$records = $wpdb->get_results($get_records);
			
			$get_temp_table_details = get_option('tmp_csv_export');
			update_option('tmp_csv_export',array('query'=>$get_records,'cols'=>$field_selection,'form_Id'=>$get_temp_table_details['form_Id']));
			
			$img_ext_array = array('jpg','jpeg','png','tiff','gif','psd');
			$file_ext_array = array('doc','docx','mpg','mpeg','mp3','mp4','odt','odp','ods','pdf','ppt','pptx','txt','xls','xlsx');
				foreach($records as $record)
					{
					$output .= '<tr class="form_record" id="'.$record->Id.'">';
						foreach($header_params as $key=>$val)
							{
							if(is_array($val))
								{
								$func_args_1 = (isset($val['user_func_args_1'])) ? $val['user_func_args_1'] : '';
								$func_args_2 = (isset($val['user_func_args_2'])) ? $val['user_func_args_2'] : '';
								$func_args_3 = (isset($val['user_func_args_3'])) ? $val['user_func_args_3'] : '';
								$func_args_4 = (isset($val['user_func_args_4'])) ? $val['user_func_args_4'] : '';
								$func_args_5 = (isset($val['user_func_args_5'])) ? $val['user_func_args_5'] : '';
								$func_args_6 = (isset($val['user_func_args_6'])) ? $val['user_func_args_6'] : '';
								
								
								if($val['user_func_class'])
									$output .= '<td>'.call_user_func(array($val['user_func_class'],$val['user_func']), array($record->$func_args_1, $func_args_2)).'</td>';
								else
									$output .= '<td>'.call_user_func($val['user_func'], $record->$func_args).'</td>';
								}
							else
								{
								if($val)
									{
									if($nf_functions->isJson($record->$val) && !is_numeric($record->$val))
										{
										$output .= '<td class="'.$val.'" style="overflow-x:auto;overflow-y:auto;">';
										$json = json_decode($record->$val,1);
										
										$output .= '<table width="100%" class="highlight" cellpadding="3" cellspacing="0" style="border-bottom:1px solid #ddd; border-left:1px solid #ddd; border-top:1px solid #ddd;">';
										$i = 1;
										foreach($json as $value)
											{
											if(is_array($value) || is_object($value))
												{
													
													if($i==1)
														{
														$output .= '<tr>';
														foreach($value as $innerkey=>$innervalue)
															{
															if(!strstr($innerkey,'real_val__'))	
																$output .= '<td style="border-bottom:1px solid #ddd;border-right:1px solid #ddd;"><strong>'.$nf_functions->unformat_name($innerkey).'</strong></td>';
															}
														$output .= '</tr>';
														}
													
													$output .= '<tr>';
													foreach($value as $innerkey=>$innervalue)
														{
														if(array_key_exists('real_val__'.$innerkey.'',$val))
																{
																$realval = 'real_val__'.$innerkey;
																$innervalue = $val->$realval;	
																
																}
														if(!strstr($innerkey,'real_val__'))
															{
															
															if(in_array($nf_functions->get_ext($innervalue),$img_ext_array))
																$output .= '<td style="border-right:1px solid #ddd;border-bottom:1px solid #eee;"><img class="materialboxed" src="'.rtrim($innervalue,', ').'" width="80px" /></td>';
															else
																$output .= '<td style="border-right:1px solid #ddd;border-bottom:1px solid #eee;">'.rtrim($innervalue,', ').'</td>';
															
															}
														}
														
													$output .= '</tr>';
													
													//foreach($value as $innerkey => $innervalue)
														//{
														//$output .= '<strong>'.$nf_functions->unformat_name($innerkey).'</strong>: '.$innervalue.' | ';	
														//}
													//$output .= '<br />';	
												}
											else
												$output .= ''.rtrim(esc_html(strip_tags($value)),', ').'';
											
											$i++;
											}
										
										$output .= '</table>';
										$output .= '</td>';
										}
									else if(strstr($record->$val,',') && !strstr($record->$val,'data:image'))
										{
										$is_array = explode(',',$record->$val);
										$output .= '<td class="image_td '.$val.'">';
										foreach($is_array as $item)
											{
											if(in_array($nf_functions->get_ext($item),$img_ext_array))
												$output .= '<img class="materialboxed"  width="65px" src="'.$item.'">';
											else if(in_array($nf_functions->get_ext($item),$file_ext_array))
												$output .= '<a class="btn file_upload_link" href="'.$item.'" target="_blank"><i class="fa fa-file"></i> '.$nf_functions->get_ext($item).'</a>';
											else
												$output .= $item;
											}
										$output .= '</td>';
										}
									else if(strstr($record->$val,'data:image'))
										$output .= '<td class="'.$val.'"><img  width="100px" src="'.$record->$val.'" /></td>';
									else if(in_array($nf_functions->get_ext($record->$val),$img_ext_array) && $val!='name')
										$output .= '<td class="'.$val.'"><img class="materialboxed"  width="65px" src="'.esc_html(strip_tags($record->$val)).'"></td>';
									else
										$output .= '<td class="'.$val.'">'.$nf_functions->view_excerpt(esc_html(strip_tags($record->$val)),30).'</td>';
									
									}
								else
									$output .= '<td>&nbsp;</td>';
								}
							}
						
						//$theme = wp_get_theme();
						///if($theme->Name=='NEX-Forms Demo' && $record->Id<22)
						//	$output .= '<td class="td_right"></td>';
						//else
						
							$output .= '<td class="td_right"><i id="'.$record->Id.'" data-table="'.$table.'" class="delete-record fas fa-trash" title="'.__('Delete Record','nex-forms').'"></i></td>';
					$output .= '</tr>';
					}
			
			if(!$records)
				{
				$output .= '<tr class="no_records">';	
				$output .= '<td colspan="100" background="" class="no_records">'.__('No records found'.(($search_term) ? ' containing <strong>'.$search_term.'</strong>': '').'','nex-forms').'</td>';
				$output .= '</tr>';	
				}
				
			if(isset($_POST['do_ajax']))
				{
				echo $output;
				die();
				}
			else
				return $output;
				
				
			echo $get_records;
		}
		public function get_total_entries($form_Id){
			global  $wpdb;
			
			if(is_array($form_Id))
				$set_form_id = $form_Id[0];
			$total_entries = $wpdb->get_var('SELECT count(*) FROM '.$wpdb->prefix.'wap_nex_forms_entries WHERE nex_forms_Id='.$set_form_id);
			return $total_entries;
		}
		public function duplicate_record($form_Id){
			global  $wpdb;
			
			if(is_array($form_Id))
				$set_form_id = $form_Id[0];
				
			return '<a id="'.$set_form_id.'" class="duplicate_record" title="'.__('Duplicate Form','nex-forms').'"><i class="fa fa-files-o"></i></a>';
		}
		public function link_form_title($form_Id){
			global  $wpdb;
			
			if(is_array($form_Id))
				$set_form_id = $form_Id[0];
			$title = $wpdb->get_var('SELECT title FROM '.$wpdb->prefix.'wap_nex_forms WHERE Id='.$set_form_id);
			return '<a href="'.get_admin_url().'admin.php?page=nex-forms-builder&open_form='.$set_form_id.'" class="edit_record" title="'.__('Edit Form','nex-forms').'"><i class="fa fa-edit"></i></a>';
		}
		
		public function print_export_form_link($form_Id){
			global  $wpdb;
			
			if(is_array($form_Id))
				$set_form_id = $form_Id[0];
			$title = $wpdb->get_var('SELECT title FROM '.$wpdb->prefix.'wap_nex_forms WHERE Id='.$set_form_id);
			return '<a href="'.get_option('siteurl').'/wp-admin/admin.php?page=nex-forms-dashboard&nex_forms_Id='.$set_form_id.'&export_form=true"  class="export_form" title="'.__('Export Form','nex-forms').'"><i class="fa fa-cloud-download"></i></a>';
		}
		
		
		
		public function print_form_entry(){
			
			global $wpdb;
			$output = '';
			$output .= '<form id="form_save_form_entry" class="form_save_form_entry" name="save_form_entry" action="'.admin_url('admin-ajax.php').'" method="post" enctype="multipart/form-data">';
			$output .= '<div class="dashboard-box form_entry_view">';
				
				
				$output .= '<div class="dashboard-box-header">';
					$output .= '<div class="table_title"><i class="material-icons header-icon">assignment_turned_in</i> <span class="header_text">'.__('Form Entry Data','nex-forms').'</span></div>';
					
					
					$output .= '<a  class="cancel_save_form_entry save_button btn waves-effect waves-light" style="display:none;"><i class="fa fa-close"></i></a>';
					$output .= '<button type="submit" class="save_form_entry save_button btn waves-effect waves-light" style="display:none;">'.__('Save','nex-forms').'</button>';
					
					$output .= '<a class="btn waves-effect waves-light print_to_pdf" disabled="disabled">'.__('PDF','nex-forms').'</a>';
					$output .= '<a class="btn waves-effect waves-light print_form_entry" disabled="disabled">'.__('Print','nex-forms').'</a>';
					$output .= '<a id="" class="btn waves-effect waves-light edit_form_entry" disabled="disabled">'.__('Edit','nex-forms').'</a>';
				$output .= '</div>';
				$output .= '<div  class="dashboard-box-content form_entry_data">';
				
				$output .= '<table class="highlight" id="form_entry_table"><thead><tr><th>'.__('Field Name','nex-forms').'</th><th>'.__('Field Value','nex-forms').'</th></tr></thead></table>';
				
				$output .= '</div>';
					
			$output .= '</div>';
			$output .= '</form>';
			return $output;
		}
		
	public function do_form_entry_save(){
		
		global $wpdb;
		
		$edit_id = $_POST['form_entry_id'];
		
		unset($_POST['action']);
		unset($_POST['submit']);
		unset($_POST['form_entry_id']);
		
		foreach($_POST as $key=>$val)
			{
			$data_array[] = array('field_name'=>$key,'field_value'=>$val);
			}
		//print_r($data_array);
		$update = $wpdb->update ( $wpdb->prefix . 'wap_nex_forms_entries',array(
				'form_data'=>json_encode($data_array)
		), array(	'Id' => filter_var($edit_id,FILTER_SANITIZE_NUMBER_INT)) );
		
		echo $edit_id;
		
		die();
		}
		
		
		
	public function submission_report(){
			global $wpdb;
			
			$set_additional_params = array();
			$nf_functions = new NEXForms_Functions();
			
			if($_POST['field_selection'])
					{
					$field_selection = isset($_POST['field_selection']) ? $_POST['field_selection'] : '';
					}
				//else
				//	$field_selection = $this->field_selection;
			//
			
			$get_records = 'SELECT * FROM '.$wpdb->prefix.'wap_nex_forms_entries WHERE nex_forms_Id='.filter_var($_POST['form_Id'] ,FILTER_SANITIZE_NUMBER_INT);
			$records = $wpdb->get_results($get_records);
			
			
			
			$get_temp_table_details = get_option('tmp_csv_export');
			update_option('tmp_csv_export',array('query'=>$get_temp_table_details['query'],'cols'=>$get_temp_table_details['cols'],'form_Id'=>filter_var($_POST['form_Id'] ,FILTER_SANITIZE_NUMBER_INT)));
			
			foreach($records as $data)
				{
				$form_values = json_decode($data->form_data);
				
				$header_array['entry_Id'] = $data->Id;
				
				foreach($form_values as $field)
					{
					if(is_array($field_selection))
						{
						if(in_array($field->field_name,$field_selection))
							{
							$header_array_filters[$field->field_name] = $nf_functions->unformat_name($field->field_name);
							}
						}
					else
						{
						$header_array_filters[$field->field_name] = $nf_functions->unformat_name($field->field_name);
						}
					$header_array[$field->field_name] = $nf_functions->unformat_name($field->field_name);
					}
				};
			if($wpdb->get_var("show tables like '".$wpdb->prefix."wap_nex_forms_temp_report'") == $wpdb->prefix.'wap_nex_forms_temp_report')
				{
				$drop_table = 'DROP TABLE '.$wpdb->prefix.'wap_nex_forms_temp_report';
				$wpdb->query($drop_table);
				}
			$nf_functions = new NEXForms_Functions();
			
			$header_array2 = array_unique($header_array);
			$col_array_unique = array();
			foreach($header_array2 as $key => $val){
				$col_array_unique[$nf_functions->format_column_name($key)] = $nf_functions->format_column_name($key);
			}
			
			
			$sql .= 'CREATE TABLE `'.$wpdb->prefix.'wap_nex_forms_temp_report` (';	
					
					$sql .= '`Id` BIGINT(255) unsigned NOT NULL AUTO_INCREMENT,';
				
					foreach($col_array_unique as $key => $val){
						
						$col_name = $nf_functions->format_column_name($key);
						
						if($col_name!='')
							$sql .= '`'.$col_name.'` longtext,';
					}
				$sql .= 'PRIMARY KEY (`Id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';
				
				$wpdb->query($sql);
				
			  $table_fields 	= $wpdb->get_results('SHOW FIELDS FROM '.$wpdb->prefix.'wap_nex_forms_temp_report');
			
			  foreach($records as $data)
					{
					$form_fields = json_decode($data->form_data);

					$column_array = array();
					
					$column_array['entry_Id'] = $data->Id;
					
					foreach($table_fields as $table_field)
						{
						foreach($form_fields as $form_field)
							{
							$form_field_name = $nf_functions->format_column_name($form_field->field_name);
							$table_field_col = $nf_functions->format_column_name($table_field->Field);
							
							if(is_array($form_field->field_value) || is_object($form_field->field_value))
								$form_field->field_value = json_encode($form_field->field_value);
							
							if($form_field_name==$table_field_col)
								{
								$column_array[$table_field_col] = $form_field->field_value;
								}
							}
						}
					$insert = $wpdb->insert ( $wpdb->prefix . 'wap_nex_forms_temp_report' , $column_array );
					$insert_id = $wpdb->insert_id;
					}
			  foreach($col_array_unique as $key=>$val)
			  	{
				if(is_array($field_selection))
					{
					if(in_array($key,$field_selection))
						{
						$set_headers[$key]	= $key;
						$set_search[$key]	= $key;
						}
					}
				else
					{
					$set_headers[$key]	= $key;
					$set_search[$key]	= $key;
					}
				}
			
			$output .= '<div class="report_label">Report</div><div class="row row_zero_margin reporting_controls">';
				
				$show_cols = $_POST['showhide_fields'];
				
				$output .= '<div class="col-sm-5 field_selection_col">';
				$output .= '<select name="showhide_fields[]" multiple="multiple" class="field_selection_multi_select">
							<option disabled="disabled">'.__('Show Fields','nex-forms').'</option>
				';
				$show_cols = explode(',',$show_cols);
				$i = 0;
				 
				if($_POST['field_selection'])
					{
					$field_selection = isset($_POST['field_selection']) ? $_POST['field_selection'] : '';
					}
				//else
					//$field_selection = $this->field_selection;
				 
				 foreach($col_array_unique as $key=>$val)
					{
					if(is_array($field_selection))
						{
						$output .= '<option value="'.$key.'" '.((in_array($key,$field_selection)) ? 'selected="selected"' : '').'>
								'. $nf_functions->unformat_name($val,30).'</option>';
						}
					else
						{
						$output .= '<option value="'.$key.'"  selected="selected">
								'.$nf_functions->unformat_name($val,30).'</option>';	
						}
					$i++;
					}
					$output .= '</select></div>';
				 $output .= '<div class="col-sm-1">';
						$output .= '<a class="btn add_new_where_clause"><i class="fa fa-plus"></i></a>';	
					 $output .= '</div>';
				
				$output .= '<div class="col-sm-6 clause_container zero_padding">';
				
				foreach($_POST['additional_params'] as $key=>$val)
					{
						
					$output .= '<div class="new_clause">';
					$output .= '<div class="col-sm-4">';
						$output .= '<select class="post_ajax_select form_control" name="column">
									  <option value="">'.__('--- Select field ---','nex-forms').'</option>';
										foreach($header_array_filters as $key2=>$val2)
											$output .= ' <option value="'.$key2.'" '.(($val['column']==$key2) ? 'selected="selected"' : '').'>'.$val2.'</option>';
						$output .= '</select>';	
					 $output .= '</div>';
					 
					 $output .= '<div class="col-sm-3">';
						$output .= '
									<select class="post_ajax_select form_control" name="operator">
									  <option value="=" 		'.(($val['operator']=='=') 			? 'selected="selected"' : '').'>'.__('Equal to','nex-forms').'</option>
									  <option value="<>" 		'.(($val['operator']=='<>') 		? 'selected="selected"' : '').'>'.__('Not equal','nex-forms').'</option>
									  <option value=">" 		'.(($val['operator']=='>') 			? 'selected="selected"' : '').'>'.__('Greater than','nex-forms').'</option>
									  <option value="<" 		'.(($val['operator']=='<') 			? 'selected="selected"' : '').'>'.__('Less than','nex-forms').'</option>
									  <option value="LIKE" 		'.(($val['operator']=='LIKE') 		? 'selected="selected"' : '').'>'.__('Contains','nex-forms').'</option>
									  <option value="NOT LIKE" 	'.(($val['operator']=='NOT LIKE') 	? 'selected="selected"' : '').'>'.__('Does not contain','nex-forms').'</option>
									  ';
						$output .= '</select>';	
					$output .= '</div>';
					
					$output .= '<div class="col-sm-5">';
						$output .= '<input name="column_value" class="form-control" placeholder="'.__('Value','nex-forms').'" value="'.$val['value'].'">';	
					 $output .= '</div>';
					 
					 $output .= '<div class="">';
						$output .= '<a class="btn remove_where_clause">X</a>';	
					 $output .= '</div>';
				$output .= '</div>';
						
					$set_additional_params[$val['column']] = $val['value'];
					}
				
				$output .= '</div>';
				
				$output .= '<div class="clause_replicator hidden">';
					$output .= '<div class="col col-sm-4">';
						$output .= '
									<select class="post_ajax_select form_control" name="column">
									  <option value="" selected="selected">'.__('--- Select field ---','nex-forms').'</option>';
										foreach($header_array_filters as $key=>$val)
											$output .= ' <option value="'.$key.'">'.$val.'</option>';
						$output .= '</select>';	
					 $output .= '</div>';
					 
					 $output .= '<div class="col col-sm-3">';
						$output .= '
									<select class="post_ajax_select form_control" name="operator">
									  <option value="=">'.__('Equal to','nex-forms').'</option>
									  <option value="<>">'.__('Not equal','nex-forms').'</option>
									  <option value=">">'.__('Greater than','nex-forms').'</option>
									  <option value="<">'.__('Less than','nex-forms').'</option>
									  <option value="LIKE">'.__('Contains','nex-forms').'</option>
									  <option value="NOT LIKE">'.__('Does not contain','nex-forms').'</option>
									  ';
						$output .= '</select>';	
					$output .= '</div>';
					
					$output .= '<div class="col col-sm-5">';
						$output .= '<input name="column_value" class="form-control" placeholder="'.__('Value','nex-forms').'">';	
					 $output .= '</div>';
					 
					 $output .= '<div class="">';
						$output .= '<a class="btn remove_where_clause">X</a>';	
					 $output .= '</div>';
				$output .= '</div>';
				
				$output .= '</div>';
				$output .= '<a class="btn run_query" id="'.$_POST['form_Id'].'"><span class="fa fa-filter"></span> '.__('Run Report','nex-forms').'</a>';
				
				  
			$output .= '</div>';
			  
			  $database = new NEXForms_Database_Actions();

			  $report = new NEXForms_dashboard();
			  $report->table = 'wap_nex_forms_temp_report';
			  $report->table_header = 'Report';
			  $report->table_header_icon = 'view_list';
			  $report->action_button = 'add';
			  $report->table_headings = $set_headers;
			  $report->show_headings=true;
			  $report->search_params = $set_search;
			  $report->extra_buttons = array('Export'=>array('class'=>'export-csv', 'type'=>'link','link'=>admin_url().'admin.php?page=nex-forms-dashboard&amp;export_csv=true', 'icon'=>'<span class="fa fa-file-excel txt-green"></span> '.__('Export to Excel(CSV)','nex-forms').''), 'PDF'=>array('class'=>'print_report_to_pdf', 'type'=>'button','link'=>'', 'icon'=>'<span class="fa fa-file-pdf txt-red"></span> '.__('Export to PDF','nex-forms').''));
			  $report->checkout = $database->checkout();
			  if($_POST['field_selection'])
			 	 $report->field_selection = $_POST['field_selection'];
			  $report->additional_params = $_POST['additional_params'];
			  
			$output .= $report->print_record_table();
			echo $output;
			die();
		}
		
	public function	print_to_pdf()
		{
		if (function_exists('NEXForms_export_to_PDF'))
			{
			echo NEXForms_export_to_PDF($_POST['form_entry_Id'], true, true);
			}
		else
			{
			echo 'not installed';
			die();	
			}
		}
	public function	print_report_to_pdf()
		{
		if (function_exists('NEXForms_report_to_PDF'))
			{
			echo NEXForms_report_to_PDF();
			}
		else
			{
			echo 'not installed';
			die();	
			}
		}
	
	
	public function email_setup(){
		$email_config = get_option('nex-forms-email-config');
		$output = '';	
		$theme = wp_get_theme();
		$output .= '<div class="dashboard-box global_settings">';
			$output .= '<div class="dashboard-box-header no_tools">';
				$output .= '<div class="table_title"><i class="material-icons header-icon">drafts</i><span class="header_text ">'.__('Email Setup','nex-forms').'</span></div>';
			$output .= '</div>';
			
			$output .= '<div  class="dashboard-box-content">';
				$output .= '<form name="email_config" id="email_config" action="'.admin_url('admin-ajax.php').'" method="post">		
							
								
									<div class="row">
										<div class="col-sm-4">'.__('Email Format','nex-forms').'</div>
										<div class="col-sm-8">
											<input type="radio" '.(($email_config['email_content']=='html' || !$email_config['email_content']) ? 	'checked="checked"' : '').' name="email_content" value="html" 	id="html" class="with-gap"><label for="html">HTML</label>
											<input type="radio" '.(($email_config['email_content']=='pt') ? 	'checked="checked"' : '').' name="email_content" value="pt" 	id="pt"	class="with-gap"><label for="pt">Plain Text</label>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-4">'.__('Mailing Method','nex-forms').'</div>
										<div class="col-sm-8">
											<input type="radio" '.((!$email_config['email_method'] || $email_config['email_method']=='php_mailer') ? 	'checked="checked"' : '').' name="email_method" value="php_mailer" 	id="php_mailer"	class="with-gap"><label for="php_mailer">PHP Mailer</label><br />
											<input type="radio" '.(($email_config['email_method']=='wp_mailer' || $email_config['email_method']=='api') ? 	'checked="checked"' : '').' name="email_method" value="wp_mailer" 	id="wp_mailer"	class="with-gap"><label for="wp_mailer">WP Mail</label><br />
											<input type="radio" '.(($email_config['email_method']=='php') ? 		'checked="checked"' : '').' name="email_method" value="php" 		id="php"		class="with-gap"><label for="php">Normal PHP</label><br />
											<input type="radio" '.(($email_config['email_method']=='smtp') ? 		'checked="checked"' : '').' name="email_method" value="smtp" 		id="smtp"		class="with-gap"><label for="smtp">SMTP</label><br />
											
										</div>
									</div>
									
									<div class="smtp_settings" '.(($email_config['email_method']!='smtp') ? 		'style="display:none;"' : '').'>
										<h5>'.__('SMTP Setup','nex-forms').'</h5>
										<div class="row">
											<div class="col-sm-4">'.__('Host','nex-forms').'</div>
											<div class="col-sm-8">
												<input class="form-control" type="text" name="smtp_host" placeholder="'.__('eg: mail.gmail.com','nex-forms').'" value="'.$email_config['smtp_host'].'">
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-4">'.__('Port','nex-forms').'</div>
											<div class="col-sm-8">
												<input class="form-control" type="text" name="mail_port" placeholder="'.__('likely to be 25, 465 or 587','nex-forms').'" value="'.$email_config['mail_port'].'">
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-4">'.__('Security','nex-forms').'</div>
											<div class="col-sm-8">
												<input type="radio" '.(($email_config['email_smtp_secure']=='0' || !$email_config['email_smtp_secure']) ? 	'checked="checked"' : '').' name="email_smtp_secure" value="0" id="none" class="with-gap"><label for="none">'.__('None','nex-forms').'</label>
												<input type="radio" '.(($email_config['email_smtp_secure']=='ssl') ? 	'checked="checked"' : '').'  name="email_smtp_secure" value="ssl" id="ssl" class="with-gap"><label for="ssl">SSL</label>
												<input type="radio" '.(($email_config['email_smtp_secure']=='tls') ? 	'checked="checked"' : '').'  name="email_smtp_secure" value="tls" id="tls" class="with-gap"><label for="tls">TLS</label>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-4">'.__('Authentication','nex-forms').'</div>
											<div class="col-sm-8">
												<input type="radio" '.(($email_config['smtp_auth']=='1') ? 	'checked="checked"' : '').'  name="smtp_auth" value="1" 		id="auth_yes"		class="with-gap"><label for="auth_yes">Use Authentication</label>
												<input type="radio" '.(($email_config['smtp_auth']=='0') ? 	'checked="checked"' : '').'  name="smtp_auth" value="0" 		id="auth_no"		class="with-gap"><label for="auth_no">No Authentication</label>
											</div>
										</div>
										
									</div>
									
									<div class="smtp_auth_settings" '.(($email_config['email_method']!='smtp' || $email_config['smtp_auth']!='1') ? 		'style="display:none;"' : '').'>
										<h5>'.__('SMTP Authentication','nex-forms').'</h5>
										<div class="row">
											<div class="col-sm-4">'.__('Username','nex-forms').'</div>
											<div class="col-sm-8">
												<input class="form-control" type="text" name="set_smtp_user" value="'.$email_config['set_smtp_user'].'">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">'.__('Password','nex-forms').'</div>
											<div class="col-sm-8">
												<input class="form-control" type="password" name="set_smtp_pass" value="'.$email_config['set_smtp_pass'].'">
											</div>
										</div>
									</div>
									
									
										<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save Email Setup','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
										<div style="clear:both;"></div>
									
									
										
								
					</form></div>';
			
		$output .= '<div class="dashboard-box-footer">
											<input type="text" class="form-control" name="test_email_address" value="" placeholder="'.__('Enter Email Address','nex-forms').'">
										
											<div class="btn blue waves-effect waves-light send_test_email full_width">'.__('Send Test Email','nex-forms').'</div>
											<div style="clear:both"></div>
										</div></div>';
		return $output;
	}
	
	
	public function email_subscriptions_setup(){
		
		$output = '';
			$output .= '<div class="dashboard-box global_settings ">';
							$output .= '<div class="dashboard-box-header">';
								$output .= '<div class="table_title"><i class="material-icons header-icon contact_mail">contact_mail</i><span class="header_text ">'.__('Email Subscriptions Setup','nex-forms').'</span></div>';
								$output .= '
								<nav class="nav-extended dashboard_nav dashboard-box-nav">
									<div class="nav-content">
									  <ul class="tabs_nf tabs_nf-transparent">
										<li class="tab"><a class="active" href="#mail_chimp">'.__('MailChimp','nex-forms').'</a></li>
										<li class="tab"><a href="#get_response">'.__('GetResponse','nex-forms').'</a></li>
									  </ul>
									</div>
								 </nav>';
							$output .= '</div>';
							
							$output .= '<div  class="dashboard-box-content">';
								$output .= '<div id="mail_chimp">';
									$output .= $this->print_mailchimp_setup();
								$output .= '</div>';
								
								$output .= '<div id="get_response">';
									$output .= $this->print_getresponse_setup();
								$output .= '</div>';
								
							$output .= '</div>';
						$output .= '</div>';
		return $output;
	}
	
	public function print_mailchimp_setup(){
		
		$output = '';	
		$theme = wp_get_theme();
		$output .= '
				<form name="mail_chimp_setup" id="mail_chimp_setup" action="'.admin_url('admin-ajax.php').'" method="post">
					<div class="row">
						<div class="col-sm-4">'.__('Mailchimp API key','nex-forms').'</div>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="mc_api" value="'.(($theme->Name=='NEX-Forms Demo') ? '&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;' : get_option('nex_forms_mailchimp_api_key')).'" id="mc_api" placeholder="Enter your Mailchimp API key">
						</div>
					</div>
					<div class="alert alert-info">
						'.__('<strong>How to get your Mailchimp API key:</strong>
						<ol>
							<li>Login to your Mailchimp account: <a href="http://mailchimp.com/" target="_blank">mailchimp.com</a></li>
							<li>Click on your profile picture (top right of the screen)</li>
							<li>From the dropdown Click on Account</li>
							<li>Click on Extras->API Keys</li>
							<li>Copy your API key, or create a new one</li>
							<li>Paste your API key in the above field.</li>
							<li>Save</li>
						</ol>','nex-forms').'
					</div>
					
					
					<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save MailChimp API','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
					<div style="clear:both"></div>
				</form>
					';
		
		
		return $output;
	}
	
	public function print_getresponse_setup(){
		
		$output = '';	
		$theme = wp_get_theme();
		$output .= '
				<form name="get_response_setup" id="get_response_setup" action="'.admin_url('admin-ajax.php').'" method="post">
					<div class="row">
						<div class="col-sm-4">'.__('GetResponse API key','nex-forms').'</div>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="gr_api" value="'.(($theme->Name=='NEX-Forms Demo') ? '&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;' : get_option('nex_forms_get_response_api_key')).'" id="gr_api" placeholder="Enter your GetResponse API key">
						</div>
					</div>
					<div class="alert alert-info">
						'.__('<strong>How to get your GetReponse API key:</strong>
						<ol>
							<li>Login to your GetResponse account: <a href="https://app.getresponse.com/" target="_blank">GetResponse</a></li>
							<li>Hover over your profile picture (top right of the screen)</li>
							<li>From the dropdown Click on Integrations</li>
							<li>Click on API &amp; OAuth</li>
							<li>Copy your API key, or create a new one</li>
							<li>Paste your API key in the above field.</li>
							<li>Save</li>
						</ol>','nex-forms').'
					</div>
					
					
					<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save GetResponse API','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
					<div style="clear:both"></div>
				</form>
					';
		
		return $output;
	}
	
	
	
	public function wp_admin_options(){
		$other_config = get_option('nex-forms-other-config');
		$theme = wp_get_theme();
		$output = '';	
		$output .= '<div class="dashboard-box global_settings">';
			$output .= '<div class="dashboard-box-header no_tools">';
				$output .= '<div class="table_title"><i class="material-icons header-icon">accessibility</i><span class="header_text ">'.__('WP Admin Accessibility Options','nex-forms').'</span></div>';
			$output .= '</div>';
			
			$output .= '<div  class="dashboard-box-content">';
			if($theme->Name!='NEX-Forms Demo')
				$output .= '<form name="other_config" id="other_config" action="'.admin_url('admin-ajax.php').'" method="post">';
							
								
				$output .= '		<!--<div class="row">
									<div class="col-sm-4">'.__('Admin Color Adapt','nex-forms').'</div>
									<div class="col-sm-8">
										<label  for="enable-color-adapt-1">			<input type="radio" '.(($other_config['enable-color-adapt']=='1') ? 	'checked="checked"' : '').'  name="enable-color-adapt" value="1" 		id="enable-color-adapt-1"		><strong> Yes</strong> <em>(NEX-Forms admin will adapt to the Wordpress color scheme)</em></label>
										<label  for="enable-color-adapt-0">			<input type="radio" '.(($other_config['enable-color-adapt']=='0' || !$other_config['enable-color-adapt']) ? 	'checked="checked"' : '').'  name="enable-color-adapt" value="0" 		id="enable-color-adapt-0"		><strong> No</strong> <em>(Use default NEX-Forms admin colors)</em></label>
									</div>
								</div>-->
								
								<div class="row">
									<div class="col-sm-6">'.__('NEX-Forms User Level','nex-forms').'</div>
									<div class="col-sm-6">
										
										<select name="set-wp-user-level" id="set-wp-user-level" class="material_select_1 form-control" style="display:block !important;">
											<option '.(($other_config['set-wp-user-level']=='subscriber') ? 	'selected="selected"' : '').'  value="subscriber">'.__('Subscriber','nex-forms').'</option>
											<option '.(($other_config['set-wp-user-level']=='contributor') ? 	'selected="selected"' : '').' value="contributor">'.__('Contributor','nex-forms').'</option>
											<option '.(($other_config['set-wp-user-level']=='author') ? 	'selected="selected"' : '').' value="author">'.__('Author','nex-forms').'</option>
											<option '.(($other_config['set-wp-user-level']=='editor') ? 	'selected="selected"' : '').' value="editor">'.__('Editor','nex-forms').'</option>
											<option '.(($other_config['set-wp-user-level']=='administrator' || !$other_config['set-wp-user-level']) ? 	'selected="selected"' : '').' value="administrator">'.__('Administrator','nex-forms').'</option>			
										</select>
										
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-6">'.__('Enable NEX-Forms TinyMCE Button','nex-forms').'</div>
									<div class="col-sm-6">
										
										<div class="switch">
											<label>
											  '.__('No','nex-forms').'
											  <input type="checkbox" '.(($other_config['enable-tinymce']=='1') ? 	'checked="checked"' : '').'  name="enable-tinymce" value="1" 		id="enable-tinymce">
											  <span class="lever"></span>
											  '.__('Yes','nex-forms').'
											</label>
										</div>
										
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-6">'.__('Enable NEX-Forms Widget','nex-forms').'</div>
									<div class="col-sm-6">
										
										<div class="switch">
											<label>
											  '.__('No','nex-forms').'
											  <input type="checkbox" '.(($other_config['enable-widget']=='1') ? 	'checked="checked"' : '').'  name="enable-widget" value="1" 		id="enable-widget">
											  <span class="lever"></span>
											  '.__('Yes','nex-forms').'
											</label>
										</div>
										
									</div>
								</div>
						
						
							<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save WP Admin Options','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
							<div style="clear:both;"></div>';
						
									
										
					if($theme->Name!='NEX-Forms Demo')			
						$output .= '</form>';
					
					$output .= '</div>';
					
			$output .= '</div>';
		return $output;
	}
	
	
	
	public function troubleshooting_options(){
		
		$output = '';	
			$output .= '<div class="dashboard-box global_settings ">';
							$output .= '<div class="dashboard-box-header">';
								$output .= '<div class="table_title"><i class="material-icons header-icon contact_mail">report_problem</i><span class="header_text ">'.__('Troubleshooting Options','nex-forms').'</span></div>';
								$output .= '
								<nav class="nav-extended dashboard_nav dashboard-box-nav">
									<div class="nav-content">
									  <ul class="tabs_nf tabs_nf-transparent">
										<li class="tab"><a class="active" href="#js_inc">'.__('Javascript Includes','nex-forms').'</a></li>
										<li class="tab"><a href="#css_inc">'.__('Stylesheet Includes','nex-forms').'</a></li>
									  </ul>
									</div>
								 </nav>';
							$output .= '</div>';
							
							$output .= '<div  class="dashboard-box-content">';
								$output .= '<div id="js_inc">';
									$output .= $this->print_js_inc();
								$output .= '</div>';
								
								$output .= '<div id="css_inc">';
									$output .= $this->print_css_inc();
								$output .= '</div>';
								
							$output .= '</div>';
						$output .= '</div>';
		return $output;
	}
	
	public function print_js_inc(){
		$script_config = get_option('nex-forms-script-config');
		$theme = wp_get_theme();
		$output = '';
		$output .= '
				<form name="script_config" id="script_config" action="'.admin_url('admin-ajax.php').'" method="post">
					
					
					<div class="alert alert-info">'.__('Please leave these includes if you are not a developer with the proper know-how!','nex-forms').'</div>
					
					<div class="row">
											<div class="col-sm-4">'.__('WP Core javascript','nex-forms').'</div>
											<div class="col-sm-8">
												<input type="checkbox" '.(($script_config['inc-jquery']=='1') ? 	'checked="checked"' : '').' name="inc-jquery" value="1" 	id="inc-jquery"	><label for="inc-jquery">jQuery </label><br />
												<input type="checkbox" '.(($script_config['inc-jquery-ui-core']=='1') ? 	'checked="checked"' : '').' name="inc-jquery-ui-core" value="1" 	id="inc-jquery-ui-core"	><label for="inc-jquery-ui-core">jQuery UI Core</label><br />
												<input type="checkbox" '.(($script_config['inc-jquery-ui-autocomplete']=='1') ? 	'checked="checked"' : '').' name="inc-jquery-ui-autocomplete" value="1" 	id="inc-jquery-ui-autocomplete"	><label for="inc-jquery-ui-autocomplete">jQuery UI Autocomplete</label><br />
												<input type="checkbox" '.(($script_config['inc-jquery-ui-slider']=='1') ? 	'checked="checked"' : '').' name="inc-jquery-ui-slider" value="1" 	id="inc-jquery-ui-slider"	><label for="inc-jquery-ui-slider">jQuery UI Slider</label><br />
												<input type="checkbox" '.(($script_config['inc-jquery-form']=='1') ? 	'checked="checked"' : '').' name="inc-jquery-form" value="1" 	id="inc-jquery-form"	><label for="inc-jquery-form">jQuery Form</label><br />
											</div>
											</div>
											
											<div class="row">
												<div class="col-sm-4">'.__('Extras','nex-forms').'</div>
												<div class="col-sm-8">
													<input type="checkbox" '.(($script_config['inc-datetime']=='1') ? 	'checked="checked"' : '').' name="inc-datetime" value="1" 	id="inc-datetime"	><label for="inc-datetime">Datepicker </label><br />
													<input type="checkbox" '.(($script_config['inc-moment']=='1') ? 	'checked="checked"' : '').' name="inc-moment" value="1" 	id="inc-moment"	><label for="inc-moment">Moment </label><br />
													<input type="checkbox" '.(($script_config['inc-locals']=='1') ? 	'checked="checked"' : '').' name="inc-locals" value="1" 	id="inc-locals"	><label for="inc-locals">Locals </label><br />
													
													<input type="checkbox" checked="checked" disabled="disabled" name="inc-math" value="1" 	id="inc-math"	><label for="inc-math">Math </label><br />
													<input type="checkbox" '.(($script_config['inc-colorpick']=='1') ? 	'checked="checked"' : '').' name="inc-colorpick" value="1" 	id="inc-colorpick"	><label for="inc-colorpick">Colorpicker Field </label><br />
													<input type="checkbox" '.(($script_config['inc-wow']=='1') ? 	'checked="checked"' : '').' name="inc-wow" value="1" 	id="inc-wow"	><label for="inc-wow">Animations </label><br />
													<input type="checkbox" '.(($script_config['inc-raty']=='1') ? 	'checked="checked"' : '').' name="inc-raty" value="1" 	id="inc-raty"	><label for="inc-raty">Raty Form </label><br />
													<input type="checkbox" '.(($script_config['inc-sig']=='1') ? 	'checked="checked"' : '').' name="inc-sig" value="1" 	id="inc-sig"	><label for="inc-sig">Digital Signature </label><br />
												
												</div>
											</div>
											
											<div class="row">
												<div class="col-sm-4">'.__('Plugin Dependent Javascript','nex-forms').'</div>
												<div class="col-sm-8">
													<input type="checkbox" '.(($script_config['inc-bootstrap']=='1') ? 	'checked="checked"' : '').' name="inc-bootstrap" value="1" 	id="inc-bootstrap"	><label for="inc-bootstrap">Bootstrap </label><br />
													<input type="checkbox" '.(($script_config['inc-onload']=='1') ? 	'checked="checked"' : '').' name="inc-onload" value="1" 	id="inc-onload"	><label for="inc-onload">Onload Functions </label><br />
												</div>
											</div>
											
											
											<div class="row">
												<div class="col-sm-4">'.__('Print Scripts','nex-forms').'</div>
												<div class="col-sm-8">
													<input type="checkbox" '.(($script_config['enable-print-scripts']=='' || $script_config['enable-print-scripts']=='1') ? 	'checked="checked"' : '').'  name="enable-print-scripts" value="1" 		id="enable-print-scripts"><label  for="enable-print-scripts"><strong> Use wp_print_scripts()</strong> </label>
												</div>
											</div>
					
					
					<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save JS Inclusions','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
					<div style="clear:both"></div>
				</form>
					';
		
		return $output;
	}
	
	public function print_css_inc(){
		$styles_config = get_option('nex-forms-style-config');
		$output = '';
		$theme = wp_get_theme();
		$output .= '
				<form name="style_config" id="style_config" action="'.admin_url('admin-ajax.php').'" method="post">
					
					<div class="alert alert-info">'.__('Please leave these includes if you are not a developer who knows what you are doing!','nex-forms').'</div>
					
					<div class="row">
						<div class="col-sm-4">'.__('WP Core stylesheets','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="checkbox" '.(($styles_config['incstyle-jquery']=='1') ? 	'checked="checked"' : '').' name="incstyle-jquery" value="1" 	id="incstyle-jquery"	> <label for="incstyle-jquery-ui">jQuery UI</label>	
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">'.__('Other stylesheets','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="checkbox" '.(($styles_config['incstyle-bootstrap']=='1') ? 	'checked="checked"' : '').' name="incstyle-bootstrap" value="1" 	id="incstyle-bootstrap"	><label for="incstyle-bootstrap">Bootstrap</label><br />
							<input type="checkbox" '.(($styles_config['incstyle-font-awesome']=='1') ? 	'checked="checked"' : '').' name="incstyle-font-awesome" value="1" 	id="incstyle-font-awesome"	><label for="incstyle-font-awesome">Font Awesome</label><br />
							<input type="checkbox" '.(($styles_config['incstyle-animations']=='1') ? 	'checked="checked"' : '').' name="incstyle-animations" value="1" 	id="incstyle-animations"	><label for="incstyle-animations">Animations</label><br />
							
							<input type="checkbox" '.(($styles_config['incstyle-custom']=='1') ? 	'checked="checked"' : '').' name="incstyle-custom" value="1" 	id="incstyle-custom"	><label for="incstyle-custom">Custom NEX-Forms CSS</label>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">'.__('Print Styles','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="checkbox" '.(($styles_config['enable-print-styles']=='' || $styles_config['enable-print-styles']=='1') ? 	'checked="checked"' : '').'  name="enable-print-styles" value="1" 		id="enable-print-styles"		><label  for="enable-print-styles"><strong> Use wp_print_styles()</strong></label>
						</div>
					</div>
					
					<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save CSS Inclusions','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
					<div style="clear:both"></div>
				</form>
					';
		
		return $output;
	}
	

	public function license_setup($args='', $client_info=''){
		
		
		
		if(!$args)
			{
			$api_params2 = array( 'check_key' => 1,'ins_data'=>get_option('7103891'));
			$response2 = wp_remote_post( 'https://basixonline.net/activate-license-new-api-v3', array('timeout'   => 30,'sslverify' => false,'body'  => $api_params2) );
			if(is_array($response2->errors))
				{
				foreach($response2->errors as $error_type => $error)
					{
					echo '<br /><br /><div class="alert alert-danger"><strong>WP ERROR: </strong>'.strtoupper($error_type).' - '.$error[0].'<br />NEX-Forms can not verify your license as a result of this error. Please as your Hosting Provider to resolve this error. <a href="https://www.google.com/search?q='.$error[0].'" target="_blank">Here are some helpfull articles for your Host</a> </div><br /><br />&nbsp;';
					}	
				}
			$checked = false;
			}
		else
			$checked = $args;
		
		$output = '';
		$output .= '<div class="dashboard-box global_settings">';
			$output .= '<div class="dashboard-box-header">';
				$output .= '<div class="table_title"><i class="material-icons header-icon">verified_user</i><span class="header_text ">'.__('NEX-Forms Registration Info','nex-forms').'</span></div>';
				$output .= '<p class="box-info"><strong>Status:</strong> '.(($checked=='true') ? '<span class="label label-success">'.__('Registered','nex-forms').'</span>' : '<span class="label label-danger">'.__('Not Registered','nex-forms').'</span>').'</p>';
			$output .= '</div>';
			
			$output .= '<div  class="dashboard-box-content activation_box">';
	
			if($checked=='true')
				{	
				$theme = wp_get_theme();
				if($theme->Name=='NEX-Forms Demo')
					{
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-5">';
							$output .= '<strong>'.__('Purchase Code','nex-forms').'</strong>';
						$output .= '</div>';
						$output .= '<div class="col-sm-7">';
							$output .= '&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;';
							$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-5">';
							$output .= '<strong>'.__('Envato Username','nex-forms').'</strong>';
						$output .= '</div>';
						$output .= '<div class="col-sm-7">';
							$output .= 'Basix';
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-5">';
							$output .= '<strong>'.__('License Type','nex-forms').'</strong>';
						$output .= '</div>';
						$output .= '<div class="col-sm-7">';
							$output .= 'Regular';
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-5">';
							$output .= '<strong>'.__('Activated on','nex-forms').'</strong>';
						$output .= '</div>';
						$output .= '<div class="col-sm-7">';
							$output .= 'Demo Site';
						$output .= '</div>';
					$output .= '</div>';
					
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-12">';
							$output .= '
							'.__('<div class="alert alert-info">Unregistering a Puchase Code will free up the above code to be re-used on another domain. <strong>NOTE:</strong> This will make the current active site\'s registration inactive!</div>
							<button class="btn blue waves-effect waves-light" disabled="disabled">Unregister Puchase Code</button>','nex-forms').'';
						$output .= '</div>';
					$output .= '</div>';
					}
				else
					{
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-5">';
							$output .= '<strong>'.__('Purchase Code','nex-forms').'</strong>';
						$output .= '</div>';
						$output .= '<div class="col-sm-7">';
							if($client_info['purchase_code'])
								$output .= $client_info['purchase_code'];
							else
								$output .= __('<strong>License not activated for this domain. Please refresh this page and enter your purchase code when prompted.</strong>','nex-forms');
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-5">';
							$output .= '<strong>'.__('Envato Username','nex-forms').'</strong>';
						$output .= '</div>';
						$output .= '<div class="col-sm-7">';
							$output .= $client_info['envato_user_name'];
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-5">';
							$output .= '<strong>'.__('License Type','nex-forms').'</strong>';
						$output .= '</div>';
						$output .= '<div class="col-sm-7">';
							$output .= $client_info['license_type'];
						$output .= '</div>';
					$output .= '</div>';
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-5">';
							$output .= '<strong>'.__('Activated on','nex-forms').'</strong>';
						$output .= '</div>';
						$output .= '<div class="col-sm-7">';
							$output .= $client_info['for_site'];
						$output .= '</div>';
					$output .= '</div>';
					
					$output .= '<div class="row">';
						$output .= '<div class="col-sm-12">';
							$output .= __('
							<div class="alert alert-info">Unregistering a Puchase Code will free up the above code to be re-used on another domain. <strong>NOTE:</strong> This will make the current active site\'s registration inactive!</div>
							<button class="btn blue waves-effect waves-light deactivate_license">Unregister Puchase Code</button>','nex-forms');
						$output .= '</div>';
					$output .= '</div>';
					}
				}
			else
				{
				$output .= __('
								<div class="alert alert-info">Currenty this is a free version of NEX-Forms and as such some key features will be disabled. To <a href="http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?ref=Basix" target="_blank">activate these features</a> you will need to <a href="http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?ref=Basix" target="_blank"><strong>upgrade to the pro-version</strong></a></div>
				
							  <input name="purchase_code" id="purchase_code" placeholder="Enter Item Purchase Code" class="form-control" type="text">
							  <br />
							  <div class="show_code_response">
							  <div class="alert alert-success">After your <a href="http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?ref=Basix" target="_blank">purchase</a> you can find your purchase code from <a href="http://codecanyon.net/downloads" target="_blank"><strong>http://codecanyon.net/downloads</strong></a>. Click on Download next to NEX-Forms and then click on "License certificate &amp; purchase code" and copy that code into the above text field and hit Register.</div>
							  </div>
						   
						<button class="btn blue waves-effect waves-light deactivate_license hidden">Unregister Puchase Code</button>
						 <button class="btn blue waves-effect waves-light verify_purchase_code " type="button">Register</button> 
						<div style="clear:both"></div>
						','nex-forms');
				}
		$output .= '</div>';	
	$output .= '</div>';	
			
		return $output;
	}
	
	public function preferences(){
		
		$output = '';	
		$output .= '<div class="dashboard-box global_settings field_preferences">';
							$output .= '<div class="dashboard-box-header">';
								$output .= '<div class="table_title"><i class="material-icons header-icon">favorite</i><span class="header_text ">'.__('Preferences','nex-forms').'</span></div>';
								$output .= '
								<nav class="nav-extended dashboard_nav dashboard-box-nav">
									<div class="nav-content">
									  <ul class="tabs_nf tabs_nf-transparent">
										<li class="tab"><a class="active" href="#field_pref">'.__('Fields','nex-forms').'</a></li>
										<li class="tab"><a href="#validation_pref">'.__('Validation','nex-forms').'</a></li>
										<li class="tab"><a href="#email_pref">'.__('Emails','nex-forms').'</a></li>
										<li class="tab"><a href="#other_pref">'.__('Other','nex-forms').'</a></li>
									  </ul>
									</div>
								 </nav>';
							$output .= '</div>';
							
							$output .= '<div  class="dashboard-box-content">';
								//FIELD PREFERENCES
								$output .= '<div id="field_pref">';
									$output .= $this->print_field_pref();
								$output .= '</div>';
								
								$output .= '<div id="validation_pref">';
									$output .= $this->print_validation_pref();
								$output .= '</div>';
								
								$output .= '<div id="email_pref">';
									$output .= $this->print_email_pref();
								$output .= '</div>';
								
								$output .= '<div id="other_pref">';
									$output .= $this->print_other_pref();
								$output .= '</div>';
								
							$output .= '</div>';
		  			$output .= '</div>';
		return $output;
		}
		
		public function print_field_pref(){
			$preferences = get_option('nex-forms-preferences');
			$theme = wp_get_theme();
			$output = '';
			$output .= '
				<form name="field-pref" id="field-pref" action="'.admin_url('admin-ajax.php').'" method="post">	
					<h5>Field Labels</h5>
						<div class="row">
							<div class="col-sm-4">'.__('Label Position','nex-forms').'</div>
							<div class="col-sm-8">
								
								<input type="radio" class="with-gap" name="pref_label_align" '.((!$preferences['field_preferences']['pref_label_align'] || $preferences['field_preferences']['pref_label_align']=='top') ? 'checked="checked"' : '').' id="pref_label_align_top" value="top">
								<label for="pref_label_align_top">'.__('Top','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_label_align" id="pref_label_align_left" value="left" '.(($preferences['field_preferences']['pref_label_align']=='left') ? 'checked="checked"' : '').'>
								<label for="pref_label_align_left">'.__('Left','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_label_align" id="pref_label_align_right" value="right" '.(($preferences['field_preferences']['pref_label_align']=='right') ? 'checked="checked"' : '').'>
								<label for="pref_label_align_right">'.__('Right','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_label_align" id="pref_label_align_hidden" value="hidden" '.(($preferences['field_preferences']['pref_label_align']=='hidden') ? 'checked="checked"' : '').'>
								<label for="pref_label_align_hidden">'.__('Hidden','nex-forms').'</label>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-4">Label Text Alignment</div>
							<div class="col-sm-8">
								
								<input type="radio" class="with-gap" name="pref_label_text_align" id="pref_label_text_align_left" value="align_left" '.((!$preferences['field_preferences']['pref_label_text_align'] || $preferences['field_preferences']['pref_label_text_align']=='align_left') ? 'checked="checked"' : '').'> 
								<label for="pref_label_text_align_left">'.__('Left','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_label_text_align" id="pref_label_text_align_right" value="align_right" '.(($preferences['field_preferences']['pref_label_text_align']=='align_right') ? 'checked="checked"' : '').'> 
								<label for="pref_label_text_align_right">'.__('Right','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_label_text_align" id="pref_label_text_align_center" value="align_center" '.(($preferences['field_preferences']['pref_label_text_align']=='align_center') ? 'checked="checked"' : '').'> 
								<label for="pref_label_text_align_center">'.__('Center','nex-forms').'</label>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-4">Label Size</div>
							<div class="col-sm-8">
								
								<input type="radio" class="with-gap" name="pref_label_size" id="pref_label_size_sm" value="text-sm" '.(($preferences['field_preferences']['pref_label_size']=='text-sm') ? 'checked="checked"' : '').'> 
								<label for="pref_label_size_sm">'.__('Small','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_label_size" id="pref_label_size_normal" value="" '.((!$preferences['field_preferences']['pref_label_size'] || $preferences['field_preferences']['pref_label_size']=='') ? 'checked="checked"' : '').'> 
								<label for="pref_label_size_normal">'.__('Normal','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_label_size"  id="pref_label_size_lg" value="text-lg" '.(($preferences['field_preferences']['pref_label_size']=='text-lg') ? 'checked="checked"' : '').'>
								<label for="pref_label_size_lg">'.__('Large','nex-forms').'</label>
							</div>
						</div>
						
						<div class="row">

							<div class="col-sm-4">Show Sublabel</div>
							<div class="col-sm-8">
								<div class="switch">
									<label>
									  '.__('No','nex-forms').'
									  <input type="checkbox" '.((!$preferences['field_preferences']['pref_label_align'] || $preferences['field_preferences']['pref_label_align']=='top') ? 'checked="checked"' : '').' name="pref_sub_label">
									  <span class="lever"></span>
									  '.__('Yes','nex-forms').'
									</label>
								</div>
							</div>
						</div>
						
						
						
						<h5>Field Inputs</h5>

						<div class="row">
							<div class="col-sm-4">'.__('Input Text Alignment','nex-forms').'</div>
							<div class="col-sm-8">
								
								<input type="radio" class="with-gap" name="pref_input_text_align" id="pref_input_text_align_left" value="align_left" '.((!$preferences['field_preferences']['pref_input_text_align'] || $preferences['field_preferences']['pref_input_text_align']=='align_left') ? 'checked="checked"' : '').'> 
								<label for="pref_input_text_align_left">'.__('Left','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_input_text_align" id="pref_input_text_align_right" value="align_right" '.(($preferences['field_preferences']['pref_input_text_align']=='align_right') ? 'checked="checked"' : '').'> 
								<label for="pref_input_text_align_right">'.__('Right','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_input_text_align" id="pref_input_text_align_center" value="align_center" '.(($preferences['field_preferences']['pref_input_text_align']=='align_center') ? 'checked="checked"' : '').'> 
								<label for="pref_input_text_align_center">'.__('Center','nex-forms').'</label>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-4">'.__('Input Size','nex-forms').'</div>
							<div class="col-sm-8">
								
								<input type="radio" class="with-gap" name="pref_input_size" id="pref_input_size_sm" value="input-sm" '.(($preferences['field_preferences']['pref_input_size']=='input-sm') ? 'checked="checked"' : '').'> 
								<label for="pref_input_size_sm">'.__('Small','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_input_size" id="pref_input_size_normal" value="" '.((!$preferences['field_preferences']['pref_input_size'] || $preferences['field_preferences']['pref_input_size']=='') ? 'checked="checked"' : '').'> 
								<label for="pref_input_size_normal">'.__('Normal','nex-forms').'</label>
								
								<input type="radio" class="with-gap" name="pref_input_size"  id="pref_input_size_lg" value="input-lg" '.(($preferences['field_preferences']['pref_input_size']=='input-lg') ? 'checked="checked"' : '').'> 
								<label for="pref_input_size_lg">'.__('Large','nex-forms').'</label>
							</div>
						</div>
						
						<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save Field Preferences','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
						<div style="clear:both"></div>
					</form>
					';
		return $output;	
		}
		
		
		public function print_validation_pref(){
			$theme = wp_get_theme();
			$preferences = get_option('nex-forms-preferences');
			$output = '';
			$output .= '
				<form name="validation-pref" id="validation-pref" action="'.admin_url('admin-ajax.php').'" method="post">	
					<div class="row">
						<div class="col-sm-4">'.__('Required Field','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_requered_msg" class="form-control" value="'.(($preferences['validation_preferences']['pref_requered_msg']) ? $preferences['validation_preferences']['pref_requered_msg'] : 'Required').'">
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">'.__('Incorect Email','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_email_format_msg" class="form-control" value="'.(($preferences['validation_preferences']['pref_email_format_msg']) ? $preferences['validation_preferences']['pref_email_format_msg'] : 'Invalid email address').'">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">'.__('Incorect Phone Number','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_phone_format_msg" class="form-control" value="'.(($preferences['validation_preferences']['pref_phone_format_msg']) ? $preferences['validation_preferences']['pref_phone_format_msg'] : 'Invalid phone number').'">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">'.__('Incorect URL','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_url_format_msg" class="form-control" value="'.(($preferences['validation_preferences']['pref_url_format_msg']) ? $preferences['validation_preferences']['pref_url_format_msg'] : 'Invalid URL').'">
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">'.__('Numerical','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_numbers_format_msg" class="form-control" value="'.(($preferences['validation_preferences']['pref_numbers_format_msg']) ? $preferences['validation_preferences']['pref_numbers_format_msg'] : 'Only numbers are allowed').'">
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">'.__('Alphabetical','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_char_format_msg" class="form-control" value="'.(($preferences['validation_preferences']['pref_char_format_msg']) ? $preferences['validation_preferences']['pref_char_format_msg'] : 'Only text are allowed').'">
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">'.__('Incorect File Extension','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_invalid_file_ext_msg" class="form-control" value="'.(($preferences['validation_preferences']['pref_invalid_file_ext_msg']) ? $preferences['validation_preferences']['pref_invalid_file_ext_msg'] : 'Invalid file extension').'">
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-4">'.__('Maximum File Size Exceded','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_max_file_exceded" class="form-control" value="'.(($preferences['validation_preferences']['pref_max_file_exceded']) ? $preferences['validation_preferences']['pref_max_file_exceded'] : 'Maximum File Size of {x}MB Exceeded').'">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">'.__('Maximum Size for All Files Exceded','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_max_file_af_exceded" class="form-control" value="'.(($preferences['validation_preferences']['pref_max_file_af_exceded']) ? $preferences['validation_preferences']['pref_max_file_af_exceded'] : 'Maximum Size for all files can not exceed {x}MB').'">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">'.__('Maximum File Upload Limit Exceded','nex-forms').'</div>
						<div class="col-sm-8">
							<input type="text" name="pref_max_file_ul_exceded" class="form-control" value="'.(($preferences['validation_preferences']['pref_max_file_ul_exceded']) ? $preferences['validation_preferences']['pref_max_file_ul_exceded'] : 'Only a maximum of {x} files can be uploaded').'">
						</div>
					</div>	
					<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save Validation Preferences','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
					<div style="clear:both"></div>
				</form>
				';
			
		return $output;	
		}
		
		public function print_email_pref(){
			$preferences = get_option('nex-forms-preferences');
			$output = '';
			$theme = wp_get_theme();
			$output .= '
				<form name="emails-pref" id="emails-pref" action="'.admin_url('admin-ajax.php').'" method="post">	
					
					<h5>'.__('Email Notifications (Admin emails)','nex-forms').'</h5>
															
															<div class="row">
																<div class="col-sm-4">'.__('From Address','nex-forms').'</div>
																<div class="col-sm-8">
																	<input type="text" name="pref_email_from_address" class="form-control" value="'.(($preferences['email_preferences']['pref_email_from_address']) ? $preferences['email_preferences']['pref_email_from_address'] : get_option('admin_email')).'">
																</div>
															</div>
															
															<div class="row">
																<div class="col-sm-4">'.__('From Name','nex-forms').'</div>
																<div class="col-sm-8">
																	<input type="text" name="pref_email_from_name" class="form-control" value="'.(($preferences['email_preferences']['pref_email_from_name']) ? $preferences['email_preferences']['pref_email_from_name'] : get_option('blogname')).'">
																</div>
															</div>
															
															<div class="row">
																<div class="col-sm-4">'.__('Recipients','nex-forms').'</div>
																<div class="col-sm-8">
																	<input type="text" name="pref_email_recipients" class="form-control" value="'.(($preferences['email_preferences']['pref_email_recipients']) ? $preferences['email_preferences']['pref_email_recipients'] : get_option('admin_email')).'">
																</div>
															</div>
															
															<div class="row">
																<div class="col-sm-4">'.__('Subject','nex-forms').'</div>
																<div class="col-sm-8">
																	<input type="text" name="pref_email_subject" class="form-control" value="'.(($preferences['email_preferences']['pref_email_subject']) ? $preferences['email_preferences']['pref_email_subject'] : get_option('blogname').' NEX-Forms submission').'">
																</div>
															</div>
															
															<div class="row">
																<div class="col-sm-4">'.__('Mail Body','nex-forms').'</div>
																<div class="col-sm-8">
																	<textarea name="pref_email_body" placeholder="'.__('Enter {{nf_form_data}} to display all submitted data from the form in a table','nex-forms').'" class="materialize-textarea">'.(($preferences['email_preferences']['pref_email_body']) ? $preferences['email_preferences']['pref_email_body'] : '{{nf_form_data}}').'</textarea>
																</div>
															</div>
															
															<h5>'.__('Email Autoresponder (User emails)','nex-forms').'</h5>
															
															
															
															<div class="row">
																<div class="col-sm-4">'.__('Subject<','nex-forms').'/div>
																<div class="col-sm-8">
																	<input type="text" name="pref_user_email_subject" class="form-control" value="'.(($preferences['email_preferences']['pref_user_email_subject']) ? $preferences['email_preferences']['pref_user_email_subject'] : get_option('blogname').' NEX-Forms submission').'">
																</div>
															</div>
															
															<div class="row">
																<div class="col-sm-4">'.__('Mail Body','nex-forms').'</div>
																<div class="col-sm-8">
																	<textarea name="pref_user_email_body" placeholder="'.__('Enter {{nf_form_data}} to display all submitted data from the form in a table','nex-forms').'" class="materialize-textarea">'.(($preferences['email_preferences']['pref_user_email_body']) ? $preferences['email_preferences']['pref_user_email_body'] : 'Thank you for connecting with us. We will respond to you shortly.').'</textarea>
																</div>
															</div>
					
					<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save Email Preferences','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
					<div style="clear:both"></div>
				</form>
				';
			
		return $output;	
		}
		
		public function print_other_pref(){
			$preferences = get_option('nex-forms-preferences');
			$output = '';
			$theme = wp_get_theme();
			$output .= '
				<form name="other-pref" id="other-pref" action="'.admin_url('admin-ajax.php').'" method="post">	
					
					<div class="row">
						<div class="col-sm-4">'.__('On-screen confirmation message','nex-forms').'</div>
						<div class="col-sm-8">
							<textarea name="pref_other_on_screen_message" class="materialize-textarea">'.(($preferences['other_preferences']['pref_other_on_screen_message']) ? $preferences['other_preferences']['pref_other_on_screen_message'] : 'Thank you for connecting with us. We will respond to you shortly.').'</textarea>
						</div>
					</div>
						
					<button class="btn blue waves-effect waves-light" '.(($theme->Name=='NEX-Forms Demo') ? 'disabled="disabled"' : '').'>&nbsp;&nbsp;&nbsp;'.__('Save Other Preferences','nex-forms').'&nbsp;&nbsp;&nbsp;</button>
					<div style="clear:both"></div>
				</form>
				';
			
		return $output;	
		}
	
	
	
	}	
}
?>