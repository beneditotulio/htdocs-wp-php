'use strict';

var strPos = 0;
var timer;
var help_text_timer;
var LS_MCE_l10n = 'test';
var mtheme_shortcodegen_url = '';
jQuery('div.updated').remove();
jQuery('.update-nag').remove();
jQuery('div.error').remove();


function render_radiochecks(field_container,group_name,target,radio_check_type, theme)
	{
	var set_options ='';
		field_container.find(target).each(
			function(i)
				{
				var label = jQuery(this).find('.input-label').text();
				var value = jQuery(this).find('input').val();
				
				var radio_layout = field_container.find('#the-radios').attr('data-layout');
				var set_layout = '';
				if(radio_layout=='1c')
					set_layout='display-block col-sm-12'; 
				if(radio_layout=='2c')
					set_layout='display-block col-sm-6';
				if(radio_layout=='3c')
					set_layout='display-block col-sm-4';
				if(radio_layout=='4c')
					set_layout='display-block col-sm-3';

				/*if(theme=='m_design')
					{
					if(radio_check_type=='radio')
						{
						field_container.removeClass('radio-group').removeClass('jq-radio-group').removeClass('classic-radio-group').addClass('md-radio-group');
						set_options += '<p class="radio_check_input '+ set_layout +'"><input class="with-gap the_input_element" type="radio" name="'+ format_illegal_chars(group_name) +'" id="'+format_illegal_chars(label)+'_'+ i +'_r" value="'+value+'"><label class="input-label" for="'+format_illegal_chars(label)+'_'+ i +'_r">'+ label +'</label></p>';
						}
					if(radio_check_type=='check')
						{
						field_container.removeClass('check-group').removeClass('jq-check-group').removeClass('classic-check-group').addClass('md-check-group');
						set_options += '<p class="radio_check_input  '+ set_layout +'"><input class=" the_input_element" type="checkbox" name="'+ format_illegal_chars(group_name) +'" id="'+format_illegal_chars(label)+'_'+ i +'_c" value="'+value+'"><label class="input-label" for="'+format_illegal_chars(label)+'_'+ i +'_c">'+ label +'</label></p>';
						}
					}
					*/
				if(theme=='bootstrap' || theme=='m_design')
					{
					if(radio_check_type=='radio')
						{
						field_container.removeClass('md-radio-group').removeClass('jq-radio-group').removeClass('classic-radio-group').addClass('radio-group');
						set_options += '<label class="radio-inline  '+ set_layout +'" for="'+ format_illegal_chars(label) +'" ><span class="svg_ready"><input class="radio the_input_element" type="radio" name="'+ format_illegal_chars(group_name) +'" id="'+format_illegal_chars(label)+'" value="'+value+'"><span class="input-label radio-label">'+label+'</span></span></label>';					
						}
					if(radio_check_type=='check')
						{
						field_container.removeClass('md-check-group').removeClass('jq-check-group').removeClass('classic-check-group').addClass('check-group');
						set_options += '<label class="checkbox-inline  '+ set_layout +'" for="'+ format_illegal_chars(label) +'" ><span class="svg_ready"><input class="check the_input_element" type="checkbox" name="'+ format_illegal_chars(group_name) +'" id="'+format_illegal_chars(label)+'" value="'+value+'"><span class="input-label check-label">'+label+'</span></span></label>';
						}
					}
					
				if(theme=='jq_ui')
					{
					if(radio_check_type=='radio')
						{
						field_container.removeClass('md-radio-group').removeClass('radio-group').removeClass('classic-radio-group').addClass('jq-radio-group');
						set_options += '<div class="jq_radio_check  '+ set_layout +'"><label class="input-label" for="'+ format_illegal_chars(label) +'_jq">'+label+'</label><input type="radio" name="'+ format_illegal_chars(group_name) +'" id="'+ format_illegal_chars(label) +'_jq" value="'+value+'"></div>';
						}
					if(radio_check_type=='check')
						{
						field_container.removeClass('md-check-group').removeClass('check-group').removeClass('classic-check-group').addClass('jq-check-group');
						set_options += '<div class="jq_radio_check  '+ set_layout +'"><label class="input-label" for="'+ format_illegal_chars(label) +'_jq">'+label+'</label><input type="checkbox" name="'+ format_illegal_chars(group_name) +'" id="'+ format_illegal_chars(label) +'_jq" value="'+value+'"></div>';	
						}
					}
				if(theme=='browser')
					{
					if(radio_check_type=='radio')
						{
						field_container.removeClass('md-radio-group').removeClass('jq-radio-group').addClass('radio-group').addClass('classic-radio-group');
						set_options += '<label class="radio-inline  '+ set_layout +'" for="'+ format_illegal_chars(label) +'" ><span class="svg_ready"><input class="radio the_input_element" type="radio" name="'+ format_illegal_chars(group_name) +'" id="'+format_illegal_chars(label)+'" value="'+value+'"><span class="input-label radio-label">'+label+'</span></span></label>';					
						}
					if(radio_check_type=='check')
						{
						field_container.removeClass('md-check-group').removeClass('jq-check-group').addClass('check-group').addClass('classic-check-group');
						set_options += '<label class="checkbox-inline  '+ set_layout +'" for="'+ format_illegal_chars(label) +'" ><span class="svg_ready"><input class="check the_input_element" type="checkbox" name="'+ format_illegal_chars(group_name) +'" id="'+format_illegal_chars(label)+'" value="'+value+'"><span class="input-label check-label">'+label+'</span></span></label>';
						}
					}
				
				
				}
			);
		field_container.find('.input-inner').html(set_options);		
	}


function reset_field_theme(set_theme,field_container){
	
	var field_container = field_container;
	var group_name = field_container.find('input').attr('name');
	var radio_check_type = 'none';
	var target = '';
	
	jQuery('.settings-column-style').removeClass('material_theme');
	jQuery('.field-setting.s-odd_setting').removeAttr('style');
	
	if(set_theme=='browser' )
				{
				jQuery('.ui-nex-forms-container .input-group').addClass('input-group-bd');
				jQuery('.ui-nex-forms-container .input-group').removeClass('input-group');
				jQuery('.ui-nex-forms-container .input-group-addon').addClass('input-group-addon-bd');
				jQuery('.ui-nex-forms-container .input-group-addon').removeClass('input-group-addon');
				jQuery('.ui-nex-forms-container button').removeClass('btn').removeClass('btn-default');
				}
			else
				{
				jQuery('.ui-nex-forms-container .input-group-bd').addClass('input-group').removeClass('input-group-bd');
				jQuery('.ui-nex-forms-container .input-group-addon-bd').addClass('input-group-addon').removeClass('input-group-addon-bd');	
				jQuery('.ui-nex-forms-container button').addClass('btn').addClass('btn-default');
				}
	
	if(field_container.hasClass('radio-group') || field_container.hasClass('md-radio-group') || field_container.hasClass('jq-radio-group') || field_container.hasClass('classic-radio-group'))
		radio_check_type = 'radio';
	if(field_container.hasClass('check-group') || field_container.hasClass('md-check-group') || field_container.hasClass('jq-check-group')  || field_container.hasClass('classic-check-group'))
		radio_check_type = 'check';
	
	if(field_container.hasClass('radio-group') || field_container.hasClass('check-group') || field_container.hasClass('classic-radio-group') || field_container.hasClass('classic-check-group'))
		target = '.input-inner label';
	if(field_container.hasClass('md-radio-group') || field_container.hasClass('md-check-group'))
		target = '.radio_check_input';
	if(field_container.hasClass('jq-radio-group') || field_container.hasClass('jq-check-group'))
		target = '.jq_radio_check';
	
	
	if(radio_check_type!='none')
		render_radiochecks(field_container,group_name,target,radio_check_type, 'bootstrap');
	if(set_theme!='browser' )
		setup_form_element(field_container);
	
	
//MATERIAL THEME				
	if(set_theme=='m_design')
		{
		
		//jQuery('.settings-column-style').addClass('material_theme');
		

		
		
		/*if(field_container.hasClass('touch_spinner'))
			{
			
			field_container.find('#spinner').attr('data-verticalbuttons',false);
			field_container.find('.bootstrap-touchspin .input-group-btn').remove();
			field_container.find('.bootstrap-touchspin .input-group-btn-vertical').remove();
			
			field_container.find('.bootstrap-touchspin').prepend('<span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-down" type="button">-</button></span>');
			field_container.find('.bootstrap-touchspin').append('<span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-up" type="button">+</button></span>');

			
			field_container.addClass('md-spinner').removeClass('jq-spinner');
			
			setup_form_element(field_container);
			
			}
		*/
		
		
		
		//field_container.removeClass('jquery_field');
		//field_container.removeClass('bootstrap_field');
		//field_container.removeClass('classic_field');
		//field_container.addClass('material_field');
		
		
		//field_container.find('#the-radios' ).removeClass('the-radios');	
		
		/*if(!field_container.hasClass('html_fields') || !field_container.hasClass('button_fields'))
			field_container.find('.the_input_element').addClass('form-control')
		
			field_container.find('.the_input_element').removeClass('ui-corner-all').removeClass('ui-widget');
			if(field_container.hasClass('preset_fields') || field_container.hasClass('text') || field_container.hasClass('autocomplete') || field_container.hasClass('date') || field_container.hasClass('time') || field_container.hasClass('jq-datepicker') || field_container.hasClass('jq-time-picker') || field_container.hasClass('textarea') || field_container.hasClass('select') || field_container.hasClass('multi-select') || field_container.hasClass('password') )
				{
				
				if(field_container.hasClass('submit-button') || field_container.hasClass('nex-button') || field_container.hasClass('prev-button'))
					return;
				
				
				field_container.find('.label_container').addClass('hidden');
				
				var set_style = field_container.find('.label_container').find('.the_label').attr('style');
				
				if(field_container.find('.input-group-addon.prefix').attr('class'))
					{
					field_container.find('.input_container .the_input_element').before('<i class="material-icons prefix '+  field_container.find('.input-group-addon.prefix span').attr('class') +'"></i>');
					}
					
				field_container.find('.input_container .the_input_element').after('<label id="md_label" style="' + set_style + '" for="' + field_container.find('.the_input_element').attr('name') + '" class="">'+ field_container.find('.the_label').html()  +'</label>');
				
				field_container.find('.input_container').attr('class', 's12 input-field  material_design_field col');
				field_container.find('.input-group').attr('class', 'input-group-md');
				field_container.find('.input-group-addon.prefix').attr('class','input-group-addon prefix2')
				field_container.find('.input-group-addon').addClass('hidden').removeClass('ui-button').removeClass('jq-add-on');
				
				if(field_container.hasClass('textarea') || (field_container.hasClass('Query') && field_container.hasClass('preset_fields')))
					{
					field_container.find('.textarea').addClass('materialize-textarea');;
					jQuery('textarea').trigger('autoresize');
					}
				if(field_container.hasClass('select') || field_container.hasClass('multi-select'))
					{
					if(field_container.find('select').hasClass('jq_select'))
						{
						field_container.find('select').selectmenu('destroy');
						field_container.find('select').removeClass('jq_select');
						}
					field_container.find('select').addClass('material_select').removeClass('form-control');
					field_container.find('select').material_select();
					}
			}*/
			if(field_container.hasClass('slider'))
				{
				field_container.removeClass('slider').addClass('md-slider');
				
					field_container.find( "#slider" ).slider('destroy');
					field_container.find( "#slider" ).addClass('noUi-target').addClass('noUi-ltr').addClass('noUi-horizontal');  
					setup_form_element(field_container);
					
				}
			if(field_container.hasClass('date'))
				{
				field_container.removeClass('date').addClass('md-datepicker');  
				setup_form_element(field_container);
				}
			if(field_container.hasClass('jq-datepicker'))
				{
				field_container.find('input').datepicker('destroy');
				field_container.removeClass('jq-datepicker').addClass('md-datepicker');
				setup_form_element(field_container);
				}
				
			if(field_container.hasClass('time'))
				{
				field_container.removeClass('time').addClass('md-time-picker');  
				setup_form_element(field_container);
				}
			if(field_container.hasClass('jq-time-picker'))
				{
				field_container.find('input').timepicker('destroy');
				field_container.removeClass('jq-time-picker').addClass('md-time-picker');
				setup_form_element(field_container);
				}
			
			
			
		}
	
//BOOTSTRAP THEME						
	else if(set_theme=='bootstrap' || set_theme=='browser' || set_theme=='m_design' || set_theme=='neumorphism')
		{
			if(set_theme=='bootstrap')
				{
				if(!field_container.hasClass('html_fields') || !field_container.hasClass('button_fields'))
					field_container.find('.the_input_element').addClass('form-control')
				
					field_container.find('.the_input_element').removeClass('ui-corner-all').removeClass('ui-widget').removeClass('default-browser-style');
				}
			if(set_theme=='browser' )
				{
				field_container.find('.the_input_element').removeClass('ui-corner-all').removeClass('ui-widget').removeClass('form-control').addClass('default-browser-style');
				}
		if(radio_check_type!='none' && set_theme!='browser')
			setTimeout(function(){field_container.find('#the-radios input').nexchecks()},10);
		
		
		if(field_container.hasClass('touch_spinner'))
			{
			field_container.find('#spinner').attr('data-verticalbuttons',false);
			field_container.find('.bootstrap-touchspin .input-group-btn').remove();
			field_container.find('.bootstrap-touchspin .input-group-btn-vertical').remove();
			
			field_container.find('.bootstrap-touchspin').prepend('<span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-down" type="button">-</button></span>');
			field_container.find('.bootstrap-touchspin').append('<span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-up" type="button">+</button></span>');

			field_container.removeClass('md-spinner').removeClass('jq-spinner');
			
			setup_form_element(field_container);
			}
		
		
		field_container.removeClass('jquery_field');
		field_container.removeClass('material_field');
		field_container.removeClass('bootstrap_field');
		field_container.removeClass('classic_field');
		
		if(set_theme=='bootstrap')
			field_container.addClass('bootstrap_field');
		if(set_theme=='browser')
			field_container.addClass('classic_field');
			
		if(field_container.hasClass('md-slider'))
			{
			field_container.removeClass('md-slider').addClass('slider');
			field_container.find( "#slider" ).slider('destroy');
			field_container.find( "#slider" ).removeClass('noUi-target').removeClass('noUi-ltr').removeClass('noUi-horizontal');
			setup_form_element(field_container);
			}
		
			field_container.find('#the-radios' ).addClass('the-radios');	
			
			
			if(field_container.hasClass('preset_fields') || field_container.hasClass('text') || field_container.hasClass('autocomplete') || field_container.hasClass('md-datepicker') || field_container.hasClass('jq-datepicker') || field_container.hasClass('md-time-picker') || field_container.hasClass('jq-time-picker') || field_container.hasClass('textarea') || field_container.hasClass('select') || field_container.hasClass('multi-select') || field_container.hasClass('password') )
				{
				if(field_container.hasClass('submit-button') || field_container.hasClass('nex-button') || field_container.hasClass('prev-button'))
					return;
					
				
				field_container.find('.label_container').removeClass('hidden');
				
				field_container.find('i.material-icons').remove();
				field_container.find('#md_label').remove();
				
				field_container.find('.input-field').attr('class', 'col-sm-12  input_container');
				field_container.find('.input-group-md').attr('class', 'input-group');
				field_container.find('.input-group-addon.prefix2').attr('class','input-group-addon prefix')
				field_container.find('.input-group-addon').removeClass('hidden').removeClass('ui-button').removeClass('jq-add-on');;
				
				if(field_container.hasClass('textarea'))
					{
					field_container.find('.textarea').removeClass('materialize-textarea');;
					}
				if(field_container.hasClass('select') || field_container.hasClass('multi-select'))
					{
					if(field_container.find('select').hasClass('jq_select'))
						{
						field_container.find('select').selectmenu('destroy');
						field_container.find('select').removeClass('jq_select');
						}
					field_container.find('select').material_select('destroy');
					field_container.find('select').removeClass('material_select').removeClass('initialized').addClass('form-control');
					}
				
				if(field_container.hasClass('md-datepicker'))
					{
					field_container.find('input').bootstrapMaterialDatePicker('destroy');
					field_container.find('input').attr('readonly',false);
					field_container.removeClass('md-datepicker').addClass('date');
					setup_form_element(field_container);
					}
				if(field_container.hasClass('jq-datepicker'))
					{
					field_container.find('input').datepicker('destroy');
					field_container.removeClass('jq-datepicker').addClass('date');
					setup_form_element(field_container);
					}
					
				
				if(field_container.hasClass('md-time-picker'))
					{
					field_container.find('input').bootstrapMaterialDatePicker('destroy');
					field_container.find('input').attr('readonly',false);
					field_container.removeClass('md-time-picker').addClass('time');
					setup_form_element(field_container);
					}
				if(field_container.hasClass('jq-time-picker'))
					{
					field_container.find('input').timepicker('destroy');
					field_container.removeClass('jq-time-picker').addClass('time');
					setup_form_element(field_container);
					}
			
			if(set_theme=='browser')
				jQuery('.ui-nex-forms-container .form-control').removeClass('form-control');
			}
			
			
			
			if(set_theme=='m_design')
				{
				if(field_container.hasClass('slider'))
					{
					field_container.removeClass('slider').addClass('md-slider');
					
						field_container.find( "#slider" ).slider('destroy');
						field_container.find( "#slider" ).addClass('noUi-target').addClass('noUi-ltr').addClass('noUi-horizontal');  
						setup_form_element(field_container);
						
					}
				if(field_container.hasClass('date'))
					{
					field_container.removeClass('date').addClass('md-datepicker');  
					setup_form_element(field_container);
					}
				if(field_container.hasClass('jq-datepicker'))
					{
					field_container.find('input').datepicker('destroy');
					field_container.removeClass('jq-datepicker').addClass('md-datepicker');
					setup_form_element(field_container);
					}
					
				if(field_container.hasClass('time'))
					{
					field_container.removeClass('time').addClass('md-time-picker');  
					setup_form_element(field_container);
					}
				if(field_container.hasClass('jq-time-picker'))
					{
					field_container.find('input').timepicker('destroy');
					field_container.removeClass('jq-time-picker').addClass('md-time-picker');
					setup_form_element(field_container);
					}
				}
			
			
			
		}	
	
	
//JQUERY UI THEME						
	else if(set_theme=='jq_ui')
		{
		
		if(radio_check_type!='none')
			field_container.find( "#the-radios input" ).checkboxradio();
		
		if(field_container.hasClass('touch_spinner'))
			{
			field_container.find('#spinner').attr('data-verticalbuttons',true);
			
			field_container.find('.bootstrap-touchspin .input-group-btn').remove();
			field_container.find('.bootstrap-touchspin .input-group-btn-vertical').remove();
			
			field_container.find('.bootstrap-touchspin').append('<span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="glyphicon glyphicon-chevron-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="glyphicon glyphicon-chevron-down"></i></button></span>');
			
			field_container.removeClass('md-spinner').addClass('jq-spinner');
			
			setup_form_element(field_container);
			
			}
		if(field_container.hasClass('md-slider'))
			{
			field_container.removeClass('md-slider').addClass('slider');
			field_container.find( "#slider" ).slider('destroy');
			field_container.find( "#slider" ).removeClass('noUi-target').removeClass('noUi-ltr').removeClass('noUi-horizontal');
			setup_form_element(field_container);
			}
		
		field_container.find('#the-radios' ).removeClass('the-radios');	
		
		jQuery( ".md-radio-group #the-radios" ).removeClass('the-radios');	
		jQuery( ".md-check-group #the-radios" ).removeClass('the-radios');	

		
		field_container.find('.the_input_element').addClass('ui-corner-all').addClass('ui-widget').addClass('form-control');
		
		field_container.find('.label_container').removeClass('hidden');
		field_container.find('i.material-icons').remove();
		field_container.find('#md_label').remove();
		
		field_container.find('.input-field').attr('class', 'col-sm-12  input_container');
		field_container.find('.input-group-md').attr('class', 'input-group');
		field_container.find('.input-group-addon.prefix2').attr('class','input-group-addon prefix')
		field_container.find('.input-group-addon').removeClass('hidden').removeClass('ui-button').addClass('jq-add-on');
		
		
		if(field_container.hasClass('select') || field_container.hasClass('multi-select'))
			{
			if(field_container.hasClass('material_field'))
				{
				field_container.find('select').material_select('destroy');
				field_container.find('select').removeClass('material_select').removeClass('initialized');
				}
			}
		if(field_container.hasClass('select'))
			{
			field_container.find('select').addClass('jq_select');
			field_container.find( "select.jq_select" ).selectmenu();
			}
		
		
		if(field_container.hasClass('date'))
			{
			field_container.removeClass('date').addClass('jq-datepicker');  
			setup_form_element(field_container);
			}
		if(field_container.hasClass('md-datepicker'))
			{
			field_container.find('input').bootstrapMaterialDatePicker('destroy');
			field_container.find('input').attr('readonly',false);
			field_container.removeClass('md-datepicker').addClass('jq-datepicker');
			setup_form_element(field_container);
			}

		
		
		if(field_container.hasClass('time'))
			{
			field_container.removeClass('time').addClass('jq-time-picker');  
			setup_form_element(field_container);
			}
		if(field_container.hasClass('md-time-picker'))
			{
			field_container.find('input').bootstrapMaterialDatePicker('destroy');
			field_container.find('input').attr('readonly',false);
			field_container.removeClass('md-time-picker').addClass('jq-time-picker');
			setup_form_element(field_container);
			}
		
		field_container.removeClass('classic_field');
		field_container.addClass('jquery_field');
		field_container.removeClass('material_field');
		field_container.removeClass('bootstrap_field');
		
		
		jQuery('.ui-nex-forms-container select').removeClass('form-control');
		
		
		}	
		jQuery('.ui-nex-forms-container .single-image-select-group #the-radios').addClass('the-radios');
		jQuery('.ui-nex-forms-container .multi-image-select-group #the-radios').addClass('the-radios');
		jQuery('.the-icon-field-container').removeClass('form-control');
		jQuery('.ui-nex-forms-container .html_fields .the_input_element, .ui-nex-forms-container .button_fields .the_input_element').removeClass('form-control');
}

function hide_step_back_next(obj){
	var btn_container_1 = obj.closest('.form_field');			
	var btn_container_2 = btn_container_1.closest('.form_field.grid-system');
	if(btn_container_2.hasClass('grid-system'))
		btn_container_2.removeClass('hidden');	
	else
		btn_container_1.removeClass('hidden')	
}
window.onbeforeunload = confirmExit;
  function confirmExit()
  {
	if(jQuery('.check_save').hasClass('not_saved'))
   	 return "You have attempted to leave this page.  If you have made any changes without clicking the Save button, your changes will be lost.  Are you sure you want to exit this page?";
  }
jQuery(document).ready(
function()
	{
	
	
	
	
		jQuery('.nex-forms-container .form_field.step').each(
		function(index, element)
			{
			jQuery(this).find('input[name="multi_step_name"]').val(jQuery(this).attr('data-step-name'));
			});

//setTimeout(function() { jQuery('.animated').removeClass('animated') },3000);	


		

	
	
	
	
	
	jQuery('.nf_title br').remove();
	
	jQuery(document).on('click','.close-preview',
		function()
			{
			jQuery('.form-canvas-area').removeClass('preview_view');
			jQuery('.form-canvas-area').removeClass('split_view');
			jQuery('.preview-tools .btn.workspace').removeClass('active');
			jQuery('.preview-tools .btn.workspace.normal').addClass('active');
			}
		);
	
	jQuery(document).on('click','.preview-tools .btn.workspace_theme',
		function()
			{
			jQuery('.preview-tools .btn.workspace_theme').removeClass('active');	
			jQuery(this).addClass('active');
			jQuery('.form-canvas-area').removeClass('dark');
			if(jQuery(this).attr('data-view')=='dark')
				jQuery('.form-canvas-area').addClass('dark');
			}
		);
	
	jQuery(document).on('click','.preview-tools .btn.workspace',
		function()
			{
			jQuery('.preview-tools .btn.workspace').removeClass('active');
			jQuery(this).addClass('active');	
			jQuery('.conditional_logic_wrapper #close-settings').trigger('click');
			jQuery('.field-settings-column.open_sidenav  #close-settings').trigger('click');
			jQuery('.overall-settings-column #close-settings').trigger('click');
			
			if(jQuery(this).hasClass('preview'))
				{
				
				if(!jQuery('.form-canvas-area').hasClass('preview_view') && !jQuery('.form-canvas-area').hasClass('split_view'))
					nf_save_nex_form('','preview', '');
				
				jQuery('.form-canvas-area').removeClass('preview_view');
				jQuery('.form-canvas-area').removeClass('split_view');
				jQuery('.form-canvas-area').addClass('preview_view');
				}
			else if(jQuery(this).hasClass('split'))
				{
				
				if(!jQuery('.form-canvas-area').hasClass('preview_view') && !jQuery('.form-canvas-area').hasClass('split_view'))
					nf_save_nex_form('','preview', '');
				
				jQuery('.form-canvas-area').removeClass('preview_view');
				jQuery('.form-canvas-area').removeClass('split_view');	
				jQuery('.form-canvas-area').addClass('split_view');
				}
			else
				{
				jQuery('.form-canvas-area').removeClass('preview_view');
				jQuery('.form-canvas-area').removeClass('split_view');	
				}
			
			
			jQuery('.form_canvas').trigger('focus');
			}
		);		
		
	
	jQuery('[data-toggle="tooltip_bs"]:not(.group-addon-label)').tooltip_bs(
			{
			delay: 0,
			html:true
			}
		);
	jQuery('[data-toggle="tooltip_bs2"]').tooltip_bs(
			{
			delay: { "show": 500, "hide": 0 },
			html:true
			}
		);
	jQuery('.field-setting .btn').each(
		function()
			{
			jQuery(this).find('i').attr('title', jQuery(this).attr('title'))
			}
		);
	jQuery('.field-setting .btn i').tooltip_bs(
			{
			delay: { "show": 200, "hide": 0 },
			placement: 'top',
			html:true
			}
		);
	
	jQuery(document).on('change', '#google_analytics_conversion_code', function(){
			
			var set_val = jQuery(this).val();
			
			set_val = set_val.replace('"','\'');
			
			jQuery('#google_analytics_conversion_code').val(set_val);
			
			jQuery('.nex-submit').attr('onclick',set_val);
			
		}
	);
	

	jQuery(document).on('click', '.tabs_nf a', function(){
		if(jQuery('#demo_site').text()=='yes')
			{
			jQuery('#admin_email_body_content_ifr').contents().find('body p').css('font-family', 'Arial').css('font-size', '13px');
			jQuery('#user_email_body_content_ifr').contents().find('body p').css('font-family', 'Arial').css('font-size', '13px');
			jQuery('#on_screen_message_ifr').contents().find('body p').css('font-family', 'Arial').css('font-size', '13px');
			jQuery('#pdf_html_ifr').contents().find('body p').css('font-family', 'Arial').css('font-size', '13px');
			jQuery('#ftp_content_ifr').contents().find('body p').css('font-family', 'Arial').css('font-size', '13px');
			}
	});
	
	jQuery(document).on('click', '.form_attr_left_menu a', function(){
		jQuery(this).parent().parent().find('li').removeClass('active');
		jQuery(this).parent().addClass('active');
		}
	);
//EMAIL SETUP MENU CLICK	
	jQuery(document).on('click', '.show-admin-email-setup', function(){
		jQuery('.tri-menu .admin_email_tab a').trigger('click');
	});
	jQuery(document).on('click', '.show-user-email-setup', function(){
		jQuery('.tri-menu .user_email_tab a').trigger('click');
	});

//INTEGRATION SETUP MENU CLICK	
	jQuery(document).on('click', '.show_paypal_setup', function(){
		set_paypal_fields();
		jQuery('.tri-menu .show_paypal_setup_menu_item a').trigger('click');
	});
	jQuery(document).on('click', '.show_pdf_setup', function(){
		jQuery('.tri-menu .show_pdf_setup_menu_item a').trigger('click');
	});
	jQuery(document).on('click', '.show_ftp_setup', function(){
		set_ftp_field_map();
		jQuery('.tri-menu .show_ftp_setup_menu_item a').trigger('click');
	});
	jQuery(document).on('click', '.show_mc_setup', function(){
		set_mc_field_map();
		jQuery('.tri-menu .show_mc_setup_menu_item a').trigger('click');
	});
	jQuery(document).on('click', '.show_gr_setup', function(){
		set_gr_field_map();
		jQuery('.tri-menu .show_gr_setup_menu_item a').trigger('click');
	});
	jQuery(document).on('click', '.show_mp_setup', function(){
		set_mp_field_map();
		jQuery('.tri-menu .show_mp_setup_menu_item a').trigger('click');
	});
	
	jQuery(document).on('click', '.show_ms_setup', function(){
		set_ms_field_map();
		jQuery('.tri-menu .show_ms_setup_menu_item a').trigger('click');
	});


//EMBED SETUP MENU CLICK	
	jQuery(document).on('click', '.show_inline_embed', function(){
		set_paypal_fields();
		jQuery('.tri-menu .show_inline_embed_menu_item a').trigger('click');
	});
	jQuery(document).on('click', '.show_popup_embed', function(){
		jQuery('.tri-menu .show_popup_embed_menu_item a').trigger('click');
	});
	jQuery(document).on('click', '.show_sticky_embed', function(){
		set_ftp_field_map();
		jQuery('.tri-menu .show_sticky_embed_menu_item a').trigger('click');
	});
	
	jQuery(document).on('click', '.form_embed_tri_menu a', function(){
		
		jQuery(this).closest('.form_embed_tri_menu').find('li').removeClass('active');
		jQuery(this).parent().addClass('active');
		
		jQuery(this).closest('.embed').find('.form_embed_shortcode_display').hide();
		jQuery(this).closest('.embed').find('.form_embed_shortcode_display.'+jQuery(this).attr('data-shortcode')).show();
		
	});
	
	jQuery(document).on('click', '.shortcode_php .btn', function(){
		jQuery('.shortcode_php .btn').removeClass('active');
		jQuery(this).addClass('active');
		if(jQuery(this).hasClass('show_php'))
			{
			jQuery('.form_embed_settings_wrapper .shortcode').hide();
			jQuery('.form_embed_settings_wrapper .php').show();
			}
		if(jQuery(this).hasClass('show_shortcode'))
			{
			jQuery('.form_embed_settings_wrapper .shortcode').show();
			jQuery('.form_embed_settings_wrapper .php').hide();
			}
	});
	

 var get_target = jQuery('.modal-container');
	
	
	
	jQuery(document).on('click', '.embed_tools.set_form_type .btn', function(){
		jQuery('.embed_tools.set_form_type .btn').removeClass('active');
		jQuery(this).addClass('active');
		
		if(jQuery(this).hasClass('popup')){
			jQuery('.form_embed_types a.popup').trigger('click');
			
			jQuery('.embed-settings-column').addClass('open_sidenav');
			
		}
		if(jQuery(this).hasClass('inline')){
			jQuery('.form_embed_types a.inline').trigger('click');
			jQuery('.embed-settings-column').removeClass('open_sidenav');
		}
		if(jQuery(this).hasClass('sticky')){
			jQuery('.embed-settings-column').removeClass('open_sidenav');
			jQuery('.popup-previews').addClass('hidden');
			jQuery('.button-preview').addClass('hidden');
		}
		
	}
	);
	
	
	jQuery(document).on('click', '.embed_options', function(){
		generate_shortcode();
	});
	
	jQuery(document).on('click', '.form_embed_types a', function(){
		generate_shortcode();
		jQuery('.popup-previews').addClass('hidden');
		jQuery('.button-preview').addClass('hidden');
		if(jQuery(this).hasClass('popup'))
			{
			jQuery('.popup-previews').removeClass('hidden');
			if(jQuery('.embed-poppup-trigger .btn.active').hasClass('button'))
				jQuery('.button-preview').removeClass('hidden');
			
			
			var get_form_bg = jQuery('.nex-forms-container').css('background-color');
			var get_form_bg_image = jQuery('.nex-forms-container').css('background-image');
			
			var res = get_form_bg.substring(get_form_bg.length - 4, get_form_bg.length);
			
			if(res == ', 0)' && (!get_form_bg_image || get_form_bg_image=='none'))
				{
				jQuery('.set_popup_bg.use_custom').trigger('click');
				}
			else
				{
				jQuery('.set_popup_bg.use_form').trigger('click');
				}
			
			}
	});
	
	jQuery(document).on('click', '.embed-form-style .btn', function(){
		jQuery('.embed-form-style .btn').removeClass('active');
		
		if(jQuery(this).hasClass('normal'))
			jQuery('.embed-form-style .btn.normal').addClass('active');
		if(jQuery(this).hasClass('conversational'))
			jQuery('.embed-form-style .btn.conversational').addClass('active');
		if(jQuery(this).hasClass('chat'))
			jQuery('.embed-form-style .btn.chat').addClass('active');
		
		generate_shortcode();
		
	});
	jQuery(document).on('click', '.embed-poppup-trigger .btn', function(){
		jQuery('.embed-poppup-trigger .btn').removeClass('active');
		jQuery(this).addClass('active');
		
		jQuery('.embed-button-text').addClass('hidden');
		jQuery('.embed-link-text').addClass('hidden');
		jQuery('.embed-custom-class').addClass('hidden');
		jQuery('.embed-on-timer').addClass('hidden');
		jQuery('.embed-on-scroll').addClass('hidden');
		
		jQuery('.embed-poppup-button-color').addClass('hidden');
		jQuery('.button-preview').addClass('hidden');
		
		if(jQuery(this).hasClass('button'))
			{
			jQuery('.embed-button-text').removeClass('hidden');
			jQuery('.button-preview').removeClass('hidden');
			jQuery('.embed-poppup-button-color').removeClass('hidden');
			
			}
		if(jQuery(this).hasClass('link'))
			{
			jQuery('.embed-link-text').removeClass('hidden');
			
			}
		if(jQuery(this).hasClass('custom'))
			{
			jQuery('.embed-custom-class').removeClass('hidden');
			}
		if(jQuery(this).hasClass('timer'))
			{
			jQuery('.embed-on-timer').removeClass('hidden');
			}
		if(jQuery(this).hasClass('scroll'))
			{
			jQuery('.embed-on-scroll').removeClass('hidden');
			}
		
		
		generate_shortcode();
	});
	
	jQuery(document).on('click', '.embed-poppup-button-color .btn', function(){
		
		jQuery('.embed-poppup-button-color .btn').removeClass('active');
		
		jQuery('.popup-previews .btn').attr('class','btn md-btn '+jQuery(this).attr('data-btn-class'));
		
		jQuery(this).addClass('active');
		
		generate_shortcode();
	});
jQuery(document).on('keyup', '#set_popup_button_text', function(){
		
		jQuery('.popup-previews .btn').html(jQuery(this).val());
	});	

jQuery(document).on('keyup', '#set_popup_button_text, #set_popup_link_text, #set_popup_custom_text', function(){
		
		generate_shortcode();
		
	});

jQuery(document).on('click', '.embed-popup-v-position .btn', function(){
		jQuery('.embed-popup-v-position .btn').removeClass('active');
		jQuery(this).addClass('active');
		
		
		jQuery('.modal-container').removeClass('v_center');
		jQuery('.modal-container').removeClass('v_top');
		jQuery('.modal-container').removeClass('v_bottom');
		
		if(jQuery(this).hasClass('center'))
			{
			jQuery('.modal-container').addClass('v_center');
			}
		if(jQuery(this).hasClass('top'))
			{
			jQuery('.modal-container').addClass('v_top');
			}
		if(jQuery(this).hasClass('bottom'))
			{
			jQuery('.modal-container').addClass('v_bottom');
			}
		
		
		generate_shortcode();
	});


jQuery(document).on('click', '.embed-popup-h-position .btn', function(){
		jQuery('.embed-popup-h-position .btn').removeClass('active');
		jQuery(this).addClass('active');
		
		
		jQuery('.modal-container').removeClass('h_center');
		jQuery('.modal-container').removeClass('h_left');
		jQuery('.modal-container').removeClass('h_right');
		
		if(jQuery(this).hasClass('center'))
			{
			jQuery('.modal-container').addClass('h_center');
			}
		if(jQuery(this).hasClass('left'))
			{
			jQuery('.modal-container').addClass('h_left');
			}
		if(jQuery(this).hasClass('right'))
			{
			jQuery('.modal-container').addClass('h_right');
			}
		
		
		generate_shortcode();
	});

jQuery(document).on('click', '.set_popup_bg', function(){
		jQuery('.set_popup_bg').removeClass('active');
		jQuery(this).addClass('active');
		
		jQuery('input[name="popup-bg-color"]').prop('disabled',true);
		
		if(jQuery(this).hasClass('use_form'))
			{
			jQuery('.popup-previews .modal-container').attr('style',jQuery('.nex-forms-container').attr('style'));
			jQuery('.popup-previews .modal-inner-container').removeAttr('style');
			/*jQuery( "#popup_padding_right" ).val(0);
			jQuery( "#popup_padding_left" ).val(0);
			jQuery( "#popup_padding_top" ).val(0);
			jQuery( "#popup_padding_bottom" ).val(0);*/
			}
		if(jQuery(this).hasClass('use_custom'))
			{
			jQuery('.popup-previews .modal-container').removeAttr('style');
			jQuery('.popup-previews .modal-container').css('background',jQuery('input[name="popup-bg-color"]').val());
		 	jQuery('.popup-previews .modal-inner-container').attr('style',jQuery('.nex-forms-container').attr('style'));
			jQuery('input[name="popup-bg-color"]').prop('disabled',false);
			/*jQuery( "#popup_padding_right" ).val(2);
			jQuery( "#popup_padding_left" ).val(2);
			jQuery( "#popup_padding_top" ).val(2);
			jQuery( "#popup_padding_bottom" ).val(2);*/
			
			}

		generate_shortcode();
	});


jQuery(document).on('click', '.modal-container .close-preview', function(){
	clear_animation(get_target);
	get_target.addClass('animated');
	get_target.addClass(jQuery('#popup_close_animation').val());
	
	setTimeout(function(){ clear_animation(get_target) },1000);
});

jQuery(document).on('click', '.button-preview .btn', function(){
	clear_animation(get_target);
	get_target.addClass('animated');
	get_target.addClass(jQuery('#popup_open_animation').val());
	
	setTimeout(function(){ clear_animation(get_target) },1000);
});
	
	
jQuery(document).on('change', '#popup_open_animation, #popup_close_animation', function(){
	
	clear_animation(get_target)
	get_target.addClass('animated');
	get_target.addClass(jQuery(this).val());
	
	generate_shortcode();
	
	setTimeout(function(){ clear_animation(get_target) },1000);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});
function clear_animation(obj){
		jQuery('select[name="popup_open_animation"] option').each(
			function()
				{
				obj.removeClass(jQuery(this).attr('value'));	
				}
			);	
		jQuery('select[name="popup_close_animation"] option').each(
			function()
				{
				obj.removeClass(jQuery(this).attr('value'));	
				}
			);	
	}

jQuery( "#popup_width" ).spinner(
		{ 
		min:10, 
		max:100,  
		spin: function( event, ui ) 
				{
				jQuery('.modal-container').css('width',ui.value+'%');
				},
		stop: function(event,ui){
			generate_shortcode()
			}
		}
	).on('keyup', function(e)
				{
				jQuery('.modal-container').css('width',jQuery(this).val()+'%');
				generate_shortcode()
				});	

jQuery( "#popup_height" ).spinner(
		{ 
		min:10, 
		max:100,  
		spin: function( event, ui ) 
			{
			jQuery('.modal-container').css('height',ui.value+'%');
			jQuery('.modal-container').css('top',Math.floor((100-ui.value)/2)+'%');
			},
		stop: function(event,ui){
			generate_shortcode()
			}
		}
	).on('keyup', function(e)
			{
			jQuery('.modal-container').css('height',jQuery(this).val()+'%');
			jQuery('.modal-container').css('top',Math.floor((100-jQuery(this).val())/2)+'%');
			generate_shortcode()
			});	


jQuery( "#set_popup_time" ).spinner(
		{ 
		min:0,  
		spin: function( event, ui ) 
			{
			},
		stop: function(event,ui){
			generate_shortcode()
			}
		}
	).on('keyup', function(e)
			{
			generate_shortcode()
			});	
			
jQuery( "#set_popup_scroll_pos" ).spinner(
		{ 
		min:0,  
		spin: function( event, ui ) 
			{
			},
		stop: function(event,ui){
			generate_shortcode()
			}
		}
	).on('keyup', function(e)
			{
			generate_shortcode()
			});	





jQuery(".popup-bg-color").ColorPickerSliders(
		{
		 placement: 'bottom',
		 hsvpanel: true,
		 previewformat: 'hex',
		 color: '#ffff',
		 onchange: function(container, color)
			{
			get_target.css('background','rgba('+color.rgba.r+','+color.rgba.g+','+color.rgba.b+','+color.rgba.a+')');
			generate_shortcode();
			//jQuery(''+jQuery('.form-canvas-area').attr('data-pre-class')+'.form_field span.the_label, #md_label, '+jQuery('.form-canvas-area').attr('data-pre-class')+'.form_field .input-label, '+jQuery('.form-canvas-area').attr('data-pre-class')+'.form_field .radio-inline, '+jQuery('.form-canvas-area').attr('data-pre-class')+'.form_field .checkbox-inline').css('color','rgba('+color.rgba.r+','+color.rgba.g+','+color.rgba.b+','+color.rgba.a+')')
			}
		});


      
		jQuery( "#popup_padding_top" ).spinner(
			{ 
			min:0,
			spin: function( event, ui ) 
					{
					get_target.css('padding-top',ui.value+'%');
					},
			stop: function(event,ui){
				generate_shortcode()
				}
			}
		).on('keyup', function(e)
			{
			get_target.css('padding-top',jQuery(this).val()+'%');
			generate_shortcode()
			});	 
			
	
	jQuery( "#popup_padding_right" ).spinner(
		{ 
		min:0,  
		spin: function( event, ui ) 
				{
				get_target.css('padding-right',ui.value+'%');
				},
		stop: function(event,ui){
				generate_shortcode()
				}
		}
	).on('keyup', function(e)
		{
		get_target.css('padding-right',jQuery(this).val()+'%');
		generate_shortcode()
		});	

	jQuery( "#popup_padding_bottom" ).spinner(
		{  
		min:0,
		spin: function( event, ui ) 
				{
				get_target.css('padding-bottom',ui.value+'%');
				},
		stop: function(event,ui){
				generate_shortcode()
				}
		}
	).on('keyup', function(e)
		{
		get_target.css('padding-bottom',jQuery(this).val()+'%');
		generate_shortcode()
		});

	jQuery( "#popup_padding_left" ).spinner(
		{ 
		min:0, 
		spin: function( event, ui ) 
				{
				get_target.css('padding-left',ui.value+'%');
				},
		stop: function(event,ui){
				generate_shortcode()
				}
		}
	).on('keyup', function(e)
		{
		get_target.css('padding-left',jQuery(this).val()+'%');
		generate_shortcode()
		});	



	
function generate_shortcode(){
	
	
	
	
	var ID = jQuery('#form_update_id').text();
	
	var shortcode 	= '[NEXForms id="' +ID+'"';
	
	var php_code 	= '&lt;?php NEXForms_ui_output(array("id"=>'+ID;
	
	
		
	
	if(jQuery('.embed-form-style .btn.active').hasClass('conversational'))
		{
		shortcode 	+= ' form_style="conversational"';
		php_code 	+= ', "form_style"=>"conversational"';
		}
	if(jQuery('.embed-form-style .btn.active').hasClass('chat'))
		{
		shortcode	+= ' form_style="chat"';
		php_code 	+= ', "form_style"=>"chat"';
		}
		
		
	//button_color="btn-primary" type="button" text="Open Form"
	
	if(jQuery('.form_embed_types a.active').hasClass('popup'))
		{
		shortcode += ' open_trigger="popup" ';
		php_code 	+= ', "open_trigger"=>"popup"';	
		
		
	
	
		if(jQuery('.embed-poppup-trigger .btn.active').hasClass('button'))
			{
			shortcode 	+= ' type="button"';
			php_code 	+= ', "type"=>"button"';
			
			shortcode 	+= ' text="'+ jQuery('#set_popup_button_text').val() +'"';
			php_code 	+= ', "text"=>"'+ jQuery('#set_popup_button_text').val() +'"';
			
			shortcode 	+= ' button_color="'+ jQuery('.embed-poppup-button-color .btn.active').attr('data-btn-class') +'"';
			php_code 	+= ', "button_color"=>"'+ jQuery('.embed-poppup-button-color .btn.active').attr('data-btn-class') +'"';
			}
		if(jQuery('.embed-poppup-trigger .btn.active').hasClass('link'))
			{
			shortcode	+= ' type="link"';
			php_code 	+= ', "type"=>"link"';
			
			shortcode 	+= ' text="'+ jQuery('#set_popup_link_text').val() +'"';
			php_code 	+= ', "text"=>"'+ jQuery('#set_popup_link_text').val() +'"';
			}
		if(jQuery('.embed-poppup-trigger .btn.active').hasClass('custom'))
			{
			shortcode	+= ' type="custom_trigger"';
			php_code 	+= ', "type"=>"custom_trigger"';
			
			shortcode 	+= ' element_class="'+ jQuery('#set_popup_custom_text').val() +'"';
			php_code 	+= ', "element_class"=>"'+ jQuery('#set_popup_custom_text').val() +'"';
			}
		
		if(jQuery('.embed-poppup-trigger .btn.active').hasClass('timer'))
			{
			shortcode	+= ' type="timer"';
			php_code 	+= ', "type"=>"timer"';
			
			shortcode	+= ' auto_popup_delay="'+ jQuery('#set_popup_time').val() +'"';
			php_code 	+= ', "auto_popup_delay"=>"'+ jQuery('#set_popup_time').val() +'"';
			}
		if(jQuery('.embed-poppup-trigger .btn.active').hasClass('scroll'))
			{
			shortcode	+= ' type="scroll"';
			php_code 	+= ', "type"=>"scroll"';
			
			shortcode	+= ' auto_popup_scroll_top="'+ jQuery('#set_popup_scroll_pos').val() +'"';
			php_code 	+= ', "auto_popup_scroll_top"=>"'+ jQuery('#set_popup_scroll_pos').val() +'"';
			}
		if(jQuery('.embed-poppup-trigger .btn.active').hasClass('exit'))
			{
			shortcode	+= ' type="exit"';
			php_code 	+= ', "type"=>"exit"';
			
			shortcode	+= ' exit_intent="1"';
			php_code 	+= ', "exit_intent"=>"1"';
			}
		
		if(jQuery('.embed-popup-v-position .btn.active').hasClass('top'))
			{
			shortcode	+= ' v_position="top"';
			php_code 	+= ', "v_position"=>"top"';
			}
		if(jQuery('.embed-popup-v-position .btn.active').hasClass('bottom'))
			{
			shortcode	+= ' v_position="bottom"';
			php_code 	+= ', "v_position"=>"bottom"';
			}
		
		if(jQuery('.embed-popup-h-position .btn.active').hasClass('left'))
			{
			shortcode	+= ' h_position="left"';
			php_code 	+= ', "h_position"=>"left"';
			}
		if(jQuery('.embed-popup-h-position .btn.active').hasClass('right'))
			{
			shortcode	+= ' h_position="right"';
			php_code 	+= ', "h_position"=>"right"';
			}
		
		shortcode	+= ' width="'+jQuery('#popup_width').val()+'"';
		php_code 	+= ', "width"=>"'+jQuery('#popup_width').val()+'"';
		
		shortcode	+= ' height="'+jQuery('#popup_height').val()+'"';
		php_code 	+= ', "height"=>"'+jQuery('#popup_height').val()+'"';
		
		
		
		
		
		
		if(jQuery('.set_popup_bg.active').hasClass('use_form'))
			{
			shortcode	+= ' background="use-form-background"';
			php_code 	+= ', "background"=>"use-form-background"';	
			}
		if(jQuery('.set_popup_bg.active').hasClass('use_custom'))
			{
			shortcode	+= ' background="'+jQuery('input[name="popup-bg-color"]').val()+'"';
			php_code 	+= ', "background"=>"'+jQuery('input[name="popup-bg-color"]').val()+'"';
			}
		
		
		if(jQuery('#popup_padding_left').val()!='2')
			{
			shortcode	+= ' padding_left="'+jQuery('#popup_padding_left').val()+'"';
			php_code 	+= ', "padding_left"=>"'+jQuery('#popup_padding_left').val()+'"';	
			}
		if(jQuery('#popup_padding_right').val()!='2')
			{
			shortcode	+= ' padding_right="'+jQuery('#popup_padding_right').val()+'"';
			php_code 	+= ', "padding_right"=>"'+jQuery('#popup_padding_right').val()+'"';	
			}
		if(jQuery('#popup_padding_top').val()!='2')
			{
			shortcode	+= ' padding_top="'+jQuery('#popup_padding_top').val()+'"';
			php_code 	+= ', "padding_top"=>"'+jQuery('#popup_padding_top').val()+'"';	
			}
		if(jQuery('#popup_padding_bottom').val()!='2')
			{
			shortcode	+= ' padding_bottom="'+jQuery('#popup_padding_bottom').val()+'"';
			php_code 	+= ', "padding_bottom"=>"'+jQuery('#popup_padding_bottom').val()+'"';	
			}
		
		
		
			shortcode	+= ' open_animation="'+jQuery('#popup_open_animation').val()+'"';
			php_code 	+= ', "open_animation"=>"'+jQuery('#popup_open_animation').val()+'"';	
			
			shortcode	+= ' close_animation="'+jQuery('#popup_close_animation').val()+'"';
			php_code 	+= ', "close_animation"=>"'+jQuery('#popup_close_animation').val()+'"';	
			
		
		
		get_target.css('padding-top',jQuery('#popup_padding_top').val()+'%');
		get_target.css('padding-right',jQuery('#popup_padding_right').val()+'%');
		get_target.css('padding-bottom',jQuery('#popup_padding_bottom').val()+'%');
		get_target.css('padding-left',jQuery('#popup_padding_left').val()+'%');
		get_target.css('width',jQuery( "#popup_width" ).val()+'%');
		get_target.css('height',jQuery( "#popup_height" ).val()+'%');
		get_target.css('top',Math.floor((100-jQuery( "#popup_height" ).val())/2)+'%');
		
		
		
		
	}
	
			
	
	shortcode 	+= ']';
	php_code 	+= '),true); ?&gt';
	
	if(jQuery('.form_embed_shortcode_display').hasClass('no_code') && jQuery('.form_embed_types a.active').hasClass('popup'))
		{
		shortcode = '<div class="alert alert-danger">Please register NEX-Forms to enable the use of Popup Forms. Dont have a registration code?<br><a href="http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?license=regular&open_purchase_for_item_id=7103891&purchasable=source&ref=Basix" target="_blank">Get your code now</a></div>';
		php_code = '<div class="alert alert-danger">Please register NEX-Forms to enable the use of Popup Forms. Dont have a registration code?<br><a href="http://codecanyon.net/item/nexforms-the-ultimate-wordpress-form-builder/7103891?license=regular&open_purchase_for_item_id=7103891&purchasable=source&ref=Basix" target="_blank">Get your code now</a></div>';
		}
	
	jQuery('.shortcode .embed_code').html(shortcode);
	jQuery('.php .embed_code').html(php_code);
	
}
	

//OPTIONS SETUP MENU CLICK	
	jQuery(document).on('click', '.show_on_submission_options', function(){
		jQuery('.tri-menu .on_submission_options_tab a').trigger('click');
	});
	jQuery(document).on('click', '.show_file_uploads_options', function(){
		jQuery('.tri-menu .file_uploads_options_tab a').trigger('click');
	});
	jQuery(document).on('click', '.show_hidden_fields', function(){
		jQuery('.tri-menu .hidden_fields_options_tab a').trigger('click');
	});
	
	jQuery('.form_canvas .radio-inline').each(
			function()
				{
				if(jQuery(this).find('.check-icon').attr('class'))
					jQuery(this).find('input').prop('checked', true);
				
					
				}
			);
	jQuery('.form_canvas .image-choices-choice').each(
		function()
			{
			if(jQuery(this).find('.thumb-icon-holder').attr('class'))
				jQuery(this).find('input').prop('checked', true);	
			}
		);
	
	jQuery(document).on('click', '.the-radios a, .image-choices-choice-text, .the-thumb-image, .thumb-icon-holder, .the-radios .input-label, .the-radios span.check-icon', function(e){
				

				var the_field = jQuery(this).closest('.form_field');

				if(!the_field.hasClass('classic-radio-group') && !the_field.hasClass('classic-check-group'))
					{
						e.preventDefault();
					}
				
				var clickedParent = jQuery(this).closest('label');
				var	input = clickedParent.find('input');
				var	nexCheckable = clickedParent.find('a:first');
				var	input_label = clickedParent.closest('label');
				
				var	input_holder 	= 	jQuery(this).closest('.input_container');
				
				var check_animation 	= (input_holder.attr('data-checked-animation')) ? input_holder.attr('data-checked-animation') : 'fadeInDown';
				var uncheck_animation 	= (input_holder.attr('data-unchecked-animation')) ? input_holder.attr('data-unchecked-animation') : 'fadeOutUp';
				
				if(input.prop('type') === 'radio')
					{
					
					the_field.find('.radio_selected').removeClass('radio_selected');
					the_field.find('#the-radios a').css('background','#fff');
					the_field.find('.check-icon').remove();
					the_field.find('.thumb-icon-holder').remove();
					if(!nexCheckable.hasClass('checked'))
						{
							jQuery('input[name="' + input.attr('name') + '"]').each(
								function(index, el)
									{
									jQuery(el).prop('checked', false).parent().find('a:first').removeClass('checked').removeClass("ui-state-active").addClass("ui-state-default").removeClass(jQuery(el).closest('.the-radios').attr('data-checked-class'));
									nexCheckable.attr('class','checked' );
									input_label.removeClass('radio_selected');
									
									}
								);
							
						}
					}
				
					if(input.prop('checked'))
						{
						input.prop('checked', false);
						nexCheckable.attr('class','ui-state-default');
							nexCheckable.css('background','#fff');
						input_label.removeClass('radio_selected');
						nexCheckable.parent().find('.check-icon').remove();
						
						clickedParent.find('.thumb-icon-holder .thumb-icon').removeClass(check_animation);
						clickedParent.find('.thumb-icon-holder .thumb-icon').addClass(uncheck_animation);
						setTimeout(function() { clickedParent.find('.thumb-icon-holder').remove() },300);
						} 
					else 
						{
						the_field.find('.thumb-icon-holder .thumb-icon').removeClass(uncheck_animation);
						the_field.find('.thumb-icon-holder .thumb-icon').addClass(check_animation);
						
						var set_thumb_icon_bg = '#8bc34a';
						
						input.prop('checked', true);
						nexCheckable.attr('class','checked');
						nexCheckable.addClass("ui-state-active").removeClass("ui-state-default")
						input_label.addClass('radio_selected');
						if(nexCheckable.closest('.the-radios').attr('data-checked-bg-color') && nexCheckable.closest('.the-radios').attr('data-checked-bg-color')!='')
							{
							nexCheckable.css('background',nexCheckable.closest('#the-radios').attr('data-checked-bg-color'));
							set_thumb_icon_bg = nexCheckable.closest('#the-radios').attr('data-checked-bg-color');
							}
						else
							nexCheckable.css('background','#8bc34a');
						
						var checked_color = '#ffffff';
						
						if(nexCheckable.css('color')!='transparent' && nexCheckable.css('color')!='undefined' && nexCheckable.css('color')!='' && nexCheckable.css('color')!='rgba(0, 0, 0, 0)')
							checked_color = nexCheckable.css('color');
						if(the_field.hasClass('image-choices-field'))
							clickedParent.find('.thumb-image-outer-wrap').prepend('<div class="thumb-icon-holder"><span style="background: '+ set_thumb_icon_bg +'; color:'+ checked_color +';" class="thumb-icon animated_fast '+check_animation+' checked fa '+ nexCheckable.closest('.the-radios').attr('data-checked-class')+'"></span></div>' );
						else
							nexCheckable.after('<span style="color:'+ checked_color +';" class="check-icon checked fa '+ nexCheckable.closest('.the-radios').attr('data-checked-class')+'"></span>' );
						
						nexCheckable.addClass('animated').addClass('pulse');
						setTimeout(function(){ nexCheckable.removeClass('animated').removeClass('pulse');},1300);
						
						}	
						
					input.trigger('change');
					}			
				
			);

	
	jQuery(document).on('click','.resposive_tests i',
		function()
			{
			
			jQuery('.resposive_tests i').removeClass('active');
			
			jQuery(this).addClass('active');	
			jQuery('.show_form_preview').css('height','calc(100% - 37px)');
			jQuery('.preview_canvas').removeClass('preview_mobile');
			
			if(jQuery(this).hasClass('laptop'))
				jQuery('.show_form_preview').css('width','');
			else if(jQuery(this).hasClass('tablet'))
				{
				jQuery('.show_form_preview').css('width','768px');
				jQuery('.preview_canvas').addClass('preview_mobile');
				jQuery('.show_form_preview').css('height','calc(100% - 50px)');
				}
			else if(jQuery(this).hasClass('phone'))
				{
				jQuery('.preview_canvas').addClass('preview_mobile');
				jQuery('.show_form_preview').css('width','320px')
				jQuery('.show_form_preview').css('height','568px')
				}
			}
		);

	
	jQuery(document).on('click','.canvas_background_tools .shade div',
		function()
			{
			jQuery('select.md_theme_shade_selection option[value="light"]').trigger('click');
			jQuery('select.md_theme_shade_selection').trigger('change');
			}
		);
	
	
		
	
			
		
		
		update_select('.choose_form_theme');
		update_select('.set_form_theme');
		
		jQuery(document).on('change','.set_form_theme',
			function()
				{
				jQuery(this).attr('data-selected',jQuery(this).val())
				}
		);
		
		jQuery(document).on('click', ".date #datetimepicker input",
		function()
			{
			jQuery(this).parent().find('.input-group-addon').trigger('click');
			}
		);	
		jQuery(document).on('click', ".time #datetimepicker input",
		function()
			{
			jQuery(this).parent().find('.input-group-addon').trigger('click');
			}
		);	
		jQuery(document).on('change','select[name="choose_form_theme"]',
			function()
				{
				jQuery('.html_fields').find('.ui-state-default').removeClass('ui-state-default');
				jQuery('.html_fields').find('.ui-state-widget').removeClass('ui-state-widget');
				jQuery('.html_fields').find('.ui-state-active').removeClass('ui-state-active');
				}
			);
				
		jQuery(document).on('change','select[name="set_form_theme"]',
			function()
				{
				
					
				jQuery('label.radio-inline,  label.checkbox-inline').removeClass('ui-state-default');	
				jQuery('.field-settings-column.open_sidenav  #close-settings').trigger('click');	
				var set_theme = jQuery(this).val();
				jQuery('.outer-container').attr('class', 'outer-container');
				jQuery('.nex_forms_admin_page_wrapper').attr('class', 'nex_forms_admin_page_wrapper');
				
				if(set_theme=='m_design' || set_theme=='neumorphism' )
					{
					jQuery('.choose_form_theme').addClass('hidden');
					jQuery('.md_theme_selection').removeClass('hidden');
					//jQuery('link.material_theme').attr('href',jQuery('.plugin_url').text()+ '/css/themes/'+ jQuery('.md_theme_selection').attr('data-selected') +'.css?v=7.5.16.1');
					jQuery('link.jquery_ui_theme').attr('href',"");
					jQuery('.ui-state-default').removeClass('ui-state-default');
					jQuery('.ui-state-active').removeClass('ui-state-active')
					jQuery('.ui-widget-content').removeClass('ui-widget-content');
					jQuery('.ui-widget-header, .panel-heading').removeClass('ui-widget-header')
					
					jQuery('.outer-container').attr('class', 'outer-container theme-'+jQuery('.md_theme_selection').attr('data-selected'));
					
					
					}
				else if(set_theme=='jquery_ui')
					{
					setTimeout(function(){ jQuery('label.radio-inline,  label.checkbox-inline').addClass('ui-state-default') },500);
					jQuery('.choose_form_theme').removeClass('hidden');
					jQuery('.md_theme_selection').addClass('hidden');
					jQuery('.outer-container').attr('class', 'outer-container');
					jQuery('.choose_form_theme').trigger('change');
					}
				else
					{
					jQuery('.choose_form_theme').removeClass('hidden');
					jQuery('.md_theme_selection').addClass('hidden');
					jQuery('.outer-container').attr('class', 'outer-container');
					jQuery('.choose_form_theme').trigger('change');
					//jQuery('link.material_theme').attr('href',jQuery('.plugin_url').text()+ '/css/themes/none.css');	
					}

				jQuery('.ui-nex-forms-container').removeClass('bootstrap').removeClass('m_design').removeClass('jq_ui').removeClass('jquery_ui').removeClass('browser').removeClass('neumorphism').addClass(set_theme);	
				jQuery('.ui-nex-forms-container').attr('data-form-theme',set_theme);
				
				jQuery('.ui-nex-forms-container .form_field').each( //
					function()
						{
						
						reset_field_theme(set_theme,jQuery(this));
						
						
						
						}
					);
					
						jQuery('.ui-nex-forms-container .html_fields .the_input_element, .ui-nex-forms-container .input-group-addon .form-control, .ui-nex-forms-container .submit-button button, .ui-nex-forms-container .nex-step button, .ui-nex-forms-container .prev-step button').removeClass('form-control');
						jQuery('.ui-nex-forms-container .html_fields .the_input_element, .ui-nex-forms-container .submit-button button, .ui-nex-forms-container .nex-step button, .ui-nex-forms-container .prev-step button').removeClass('ui-corner-all').removeClass('ui-widget');
					
						
					
					
				}
			);	
		
	
	
		
		jQuery(document).on('blur','textarea, input',
			function()
				{
				if(!jQuery(this).val() && !jQuery(this).attr('placeholder'))
					jQuery(this).parent().find('#md_label').removeClass('active');
				}
			
		);
		
		
		
		
		
		jQuery('.tooltipped').tooltip(
			{
			delay: 50,
			position: 'top',
			html: true
			}
		);
		
		
		update_select('.md_theme_shade_selection');
		update_select('.md_theme_selection');
		
		
		
		
		jQuery(document).on('click','a.full-screen-btn',
			function()
				{
				if(jQuery(this).hasClass('fc'))
					{
					jQuery('.form-canvas-area').removeClass('fullscreen')
					jQuery(this).find('.material-icons').addClass('fa-expand').removeClass('fa-compress');
					jQuery(this).removeClass('fc')
					}
				else
					{
					jQuery('.form-canvas-area').addClass('fullscreen')
					jQuery(this).addClass('fc');
					jQuery(this).find('.material-icons').removeClass('fa-expand').addClass('fa-compress');
					}
				}
			);	
		
		
		jQuery(document).on('change','select[name="md_theme_shade_selection"]',
			function()
				{
				//jQuery('link.material_theme_shade').attr('href',jQuery('.plugin_url').text()+ '/css/themes/'+ jQuery(this).val() +'.css');
				}
			);	
		
		jQuery(document).on('change','select[name="md_theme_selection"]',
			function()
				{
				//jQuery('link.material_theme').attr('href',jQuery('.plugin_url').text()+ '/css/themes/'+ jQuery(this).val() +'.css?v=7.5.16.1');
				
				jQuery('.outer-container').attr('class', 'outer-container theme-'+jQuery(this).val());
				
				jQuery('select.md_theme_selection option').each(
					function()
						{
						jQuery('.nex_forms_admin_page_wrapper').removeClass('theme-'+jQuery(this).attr('value'));
						}
					)
					
					jQuery('.nex_forms_admin_page_wrapper').addClass('theme-'+jQuery(this).val());
				
				}
			);	
		
		
		jQuery(document).on('click','.field_selection_dropdown_menu', function()
			{
			if(jQuery(this).hasClass('active'))
				{
				jQuery('.form_canvas').removeClass('fields_opened');
				jQuery(this).removeClass('active');
				jQuery('ul#fields_dropdown').hide();
				jQuery(this).find('.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
				}
			else
				{
				jQuery('.form_canvas').addClass('fields_opened');	
				jQuery(this).addClass('active');
				jQuery('ul#fields_dropdown').fadeIn();
				jQuery(this).find('.fa').removeClass('fa-chevron-down').addClass('fa-chevron-up');
				}
			}
		);
		
		
		
		jQuery('input').trigger('autoresize');
		jQuery('textarea').trigger('autoresize');
		
		jQuery(document).on('click','.tabs_nf .tab', function()
			{
			jQuery('.mce-flight_shortcodes.is_opened').trigger('click');	
			}
		);
		
		jQuery('div.updated').remove();
		jQuery('.update-nag').remove();
		jQuery('div.error').remove();
		
		//REMOVE UNWANTED STYLESHEETS
			var link_id = '';
			var css_link = '';
			jQuery('head link').each(
				function()
					{
					css_link = jQuery(this);
					link_id = jQuery(this).attr('id');
					jQuery('.unwanted_css_array .unwanted_css').each(
						function()
							{
							if(link_id)
								{
								if(link_id.trim()==jQuery(this).text())
									css_link.attr('href','');
								}
							}
						);
					
					}
				)
		
		jQuery('ul.tabs_nf').tabs_nf();
		
		//setTimeout(function(){
		//jQuery('.builder_nav li.tab a.active').removeClass('active').trigger('click');
		//},500);
		
		
		jQuery('.builder_nav li.tab a.active').removeClass('active').trigger('click');
		
		
		jQuery(document).on('click','.builder_nav li.tab a.email_setup, .builder_nav li.tab a.integration', function()
				{
				jQuery('.form_attr_left_menu li.active a').trigger('click');
				jQuery('.tri-menu li.tab a.active').removeClass('active').trigger('click');
				setup_tags();
				}
			);
			
		jQuery(document).on('click','.builder_nav li.tab a.form_options', function()
				{
				setup_tags();
				}
			);
		
		
		
		
		var total_steps = jQuery('.nex-forms-container .form_field.step').size();
					
		if(total_steps!=0)
			{
			jQuery('#ms-css-settings').show();
			jQuery('.show_all_steps').show();
			if(jQuery('.multi-step-stepping li').size()<1)
				{
				nf_count_multi_steps();
				setTimeout(function(){ jQuery('.multi-step-tools ul li:eq(1) a').trigger('click'); },200);
				}
			}
		jQuery('.nex-forms-container .step .nex-step').each(
			function()
				{
				hide_step_back_next(jQuery(this))
				}
			);
		jQuery('.nex-forms-container .step .prev-step').each(
			function()
				{
				hide_step_back_next(jQuery(this))
				}
			);
		jQuery('.nex-forms-container .step .nex-submit').each(
			function()
				{
				hide_step_back_next(jQuery(this))
				}
			);
		
		
		jQuery(document).on('change','select[name="ms_current_fields"]', function()
				{
				jQuery(this).attr('data-selected',jQuery(this).val())	
				}
			);
			jQuery(document).on('change','select[name="mailster_lists"]', function()
				{
				/*jQuery(this).attr('data-selected',jQuery(this).val());
				
				var data =
					{
					action	 						: 'reload_mp_form_fields',
					reload_mp_list					: 'true',
					form_Id							: jQuery('#form_update_id').text(),
					mp_list_id						: jQuery(this).val(),
					};
				jQuery('.mp_field_map').html('<div class="loading">Loading <i class="fa fa-circle-o-notch fa-spin"></i></div>')		
				jQuery.post
					(
					ajaxurl, data, function(response)
						{
						jQuery('.mp_field_map').html(response);
						set_mp_field_map();
						}
					);*/
				
				}
			);
		
		
	
		jQuery(document).on('change','select[name="mp_current_fields"]', function()
				{
				jQuery(this).attr('data-selected',jQuery(this).val())	
				}
			);
			jQuery(document).on('change','select[name="mailpoet_lists"]', function()
				{
				/*jQuery(this).attr('data-selected',jQuery(this).val());
				
				var data =
					{
					action	 						: 'reload_mp_form_fields',
					reload_mp_list					: 'true',
					form_Id							: jQuery('#form_update_id').text(),
					mp_list_id						: jQuery(this).val(),
					};
				jQuery('.mp_field_map').html('<div class="loading">Loading <i class="fa fa-circle-o-notch fa-spin"></i></div>')		
				jQuery.post
					(
					ajaxurl, data, function(response)
						{
						jQuery('.mp_field_map').html(response);
						set_mp_field_map();
						}
					);*/
				
				}
			);
		
		
	
		
		jQuery(document).on('change','select[name="mc_current_fields"]', function()
				{
				jQuery(this).attr('data-selected',jQuery(this).val())	
				}
			);
			jQuery(document).on('change','select[name="mail_chimp_lists"]', function()
				{
				jQuery(this).attr('data-selected',jQuery(this).val());
				
				var data =
					{
					action	 						: 'reload_mc_form_fields',
					reload_mc_list					: 'true',
					form_Id							: jQuery('#form_update_id').text(),
					mc_list_id						: jQuery(this).val(),
					};
				jQuery('.mc_field_map').html('<div class="loading">Loading <i class="fa fa-circle-o-notch fa-spin"></i></div>')		
				jQuery.post
					(
					ajaxurl, data, function(response)
						{
						jQuery('.mc_field_map').html(response);
						set_mc_field_map();
						}
					);
				
				}
			);
			
			
			jQuery(document).on('change','select[name="gr_current_fields"]', function()
				{
				jQuery(this).attr('data-selected',jQuery(this).val())	
				}
			);
			/*jQuery(document).on('change','select[name="get_response_lists"]', function()
				{
				jQuery(this).attr('data-selected',jQuery(this).val());
				
				var data =
					{
					action	 						: 'reload_gr_form_fields',
					reload_gr_list					: 'true',
					form_Id							: jQuery('#form_update_id').text(),
					gr_list_id						: jQuery(this).val(),
					};
				jQuery('.gr_field_map').html('<div class="loading">Loading <i class="fa fa-circle-o-notch fa-spin"></i></div>')		
				jQuery.post
					(
					ajaxurl, data, function(response)
						{
						jQuery('.gr_field_map').html(response);
						set_gr_field_map();
						}
					);
				
				}
			);*/
				
		
		setTimeout(function()
			{
			jQuery('.form_field.slider').each(
				function()
					{
					jQuery(this).find('input.the_slider').trigger('change');
					}
				);
			},100);
		
		
		jQuery(document).on('change', 'select', function()
				{
				jQuery(this).attr('data-selected',jQuery(this).val());
				}
			);
		
		jQuery(document).on('click', '.builder_nav .tab a', function()
				{
				//jQuery('.currently_editing').removeClass('currently_editing');
				if(jQuery(this).attr('class'))
					{
					jQuery('#builder_view').removeClass('styling_view').addClass(jQuery(this).attr('class'));
					}
				}
			);

		possible_email_fields();
		jQuery(document).on('click','a.user_email_tab',
			function()
				{
				possible_email_fields();
				update_select('.posible_email_fields');
				}
			);
	
		
		jQuery(document).on('click','.add_hidden_field',
				function()
					{
					var hf_clone = jQuery('.hidden_field_clone').clone();
					hf_clone.removeClass('hidden').removeClass('hidden_field_clone').addClass('hidden_field');
					
					jQuery('.hidden_fields_setup .hidden_fields').append(hf_clone);
					
					}
				);
				
			jQuery(document).on('click','.remove_hidden_field',
				function()
					{
					jQuery(this).closest('.hidden_field').remove();
					}
				);
			jQuery(document).on('change','select[name="set_hidden_field_value"]',
				function()
					{
					jQuery(this).closest('.input-group').find('.hidden_field_value').val(jQuery(this).closest('.input-group').find('.hidden_field_value').val()+ '' +jQuery(this).val());
					jQuery(this).find('option').prop('selected',false);
					}
				);
		
		jQuery('.hidden_onload').removeClass('hidden');
		
		jQuery('.modal').modal(
			{
			dismissible: true, // Modal can be dismissed by clicking outside of the modal
			opacity: .8, // Opacity of modal background
			inDuration: 300, // Transition in duration
			outDuration: 200, // Transition out duration (not for bottom modal)
			startingTop: '4%', // Starting top style attribute (not for bottom modal)
			endingTop: '10%', // Ending top style attribute (not for bottom modal)
			ready: function(modal, trigger)
				{ 	// Callback for Modal open. Modal and trigger parameters available.
				},
			complete: function() 
				{  
				} // Callback for Modal close
			}
		);
		
		
		jQuery(document).on('click','.btn-fullscreen',
			function()
				{
				jQuery('.nex_forms_admin_page_wrapper').addClass('fullscreen');
				jQuery('.nex_forms_admin_page_wrapper').addClass('fullscreen');
				jQuery('.expand_fullscreen').hide();
				jQuery('.colapse_fullscreen').show();
				}
			);
		jQuery(document).on('click','.btn-wordpress',
			function()
				{
				jQuery('.nex_forms_admin_page_wrapper').removeClass('fullscreen');
				jQuery('.expand_fullscreen').show();
				jQuery('.colapse_fullscreen').hide();
				}
			);
		
		jQuery(document).on('click','.create_new_form',
			function()
				{
				jQuery('#new_form_wizard').modal('open');
				}
			);
			
		jQuery(document).on('click','.preview-form',
			function()
				{
				jQuery('.btn.workspace.preview').trigger('click');
				//nf_save_nex_form('','preview', jQuery(this));
				}
			);
		jQuery(document).on('click','.refresh-preview ',
			function()
				{
				
				nf_save_nex_form('','preview', '');
				}
			);
		
		jQuery(document).on('click','.field_settings .btn.delete',
			function()
				{
					var get_field = jQuery(this).closest('.form_field');
					
					if(get_field.hasClass('currently_editing'))
						jQuery('.field-settings-column #close-settings').trigger('click');
					
					get_field.remove();
					nf_form_modified('field delete');
					
				}
			);
		jQuery(document).on('click','.step .zero-clipboard .btn.delete',
			function()
				{
				var step_num = jQuery(this).closest('.step').attr('data-step-num');
				jQuery(this).closest('.step').fadeOut('fast',
				function()
					{
					jQuery(this).remove();	
					var total_steps = jQuery('.nex-forms-container .form_field.step').size();
					
					if(total_steps==0)
						{
						jQuery('#ms-css-settings').hide();
						jQuery('.nf_step_breadcrumb').hide();
						jQuery('.show_all_steps').hide();
						}
					nf_reset_multi_steps();
					nf_count_multi_steps();
					if(step_num==1)
						jQuery('li.all_steps a').trigger('click');//jQuery('.nf_step_breadcrumb ol li:eq(0) a').trigger('click');
					else
						{
						if(!jQuery('.show_all_steps li.all_steps').hasClass('current'))
							{
							jQuery('.nf_step_breadcrumb ol li:eq(' + (step_num-2) + ') a').trigger('click');
							jQuery('.multi-step-tools ul li:eq('+ (step_num-1) +')').find('a').trigger('click');
							}
						}
					}
				);
			}
		);
		
	jQuery(document).on('click','.duplicate_field',
		function()
			{
			
			var get_field = jQuery(this).closest('.form_field');
			jQuery(get_field.find('.form_field.grid-system')).each(
					function()
						{
						jQuery(this).find('.id-'+jQuery(this).attr('id')).removeClass('id-'+jQuery(this).attr('id'));
						}
					);
			
			var duplication = get_field.clone();
			duplication.find('.edit-done').remove();
			duplication.find('.currently_editing_field').removeClass('currently_editing_field');
			duplication.find('.currently_editing_settings').remove();
			duplication.find('.over-field').removeClass('over-field');
			duplication.find('.parent-over-field').removeClass('parent-over-field');
			//duplication.removeClass('set-over-field');
			//duplication.removeClass('parent-over-field');
			if(duplication.hasClass('date') || duplication.hasClass('time'))
				{
				duplication.find('.bootstrap-datetimepicker-widget').remove();
				setup_form_element(duplication);
				}
			if(duplication.hasClass('field_spacer'))
				{
				duplication.find('.ui-resizable-handle').remove();
				duplication.attr('class','form_field field_spacer');
				duplication.resizable({
				  handles: "s",
				  minHeight: 1,
				  resize: function( event, ui ) {
					  duplication.find('.total_px').text(ui.size['height']);
					  }
				});
				}
			if(duplication.hasClass('html_image'))
				{	
				duplication.find('.the-image-container .ui-resizable-handle').remove();
				duplication.find('.the-image-container img').unwrap();
				var image = duplication.find('.the-image-container');
				var width_display = duplication.find('.show-width');
				var height_display = duplication.find('.show-height');
		
				duplication.find('.the-image-container img').resizable({
				  minHeight: 20,
				  minWidth: 20,
				  resize: function( event, ui ) {
					  image.addClass('resizing');
					  image.css('width',ui.size['width']+'px');
					  image.css('height',ui.size['height']+'px');
					  width_display.text(ui.size['width']+'px');
					  height_display.text(ui.size['height']+'px');
					  
					  if(duplication.hasClass('currently_editing'))
						{
						jQuery('#set_image_width').val(ui.size['width']);
						jQuery('#set_image_height').val(ui.size['height']);
						}
					  
					  },
				  stop: function( event, ui ){
					  image.removeClass('resizing');
				  }
				});
				}
			
			
			
			
			duplication.insertAfter(get_field);
			
			
			
			duplication.attr('id','_' + Math.round(Math.random()*99999));
			duplication.find('.form_field').each(
				function()
					{
					jQuery(this).attr('id','_' + Math.round(Math.random()*99999));
					}
				);
			duplication.removeClass('currently_editing');
			//if(!get_field.hasClass('step'))
				//jQuery(duplication).find('.edit').trigger('click');
			
			nf_form_modified('field duplicated');
			
			
			if(get_field.hasClass('step'))
				{
				nf_reset_multi_steps();
				nf_count_multi_steps();
				var step_num = duplication.attr('data-step-num');
				
				
				duplication.addClass('animated');
				duplication.addClass('pulse');
				duplication.addClass('duplicated');
				
				setTimeout(function()
					{
					duplication.removeClass('animated');
					duplication.removeClass('pulse');
					duplication.removeClass('duplicated');
					},1000
				);
				
				
				jQuery('.nf_step_breadcrumb ol li:eq(' + step_num + ') a').trigger('click');
				jQuery('.multi-step-tools ul li:eq('+ step_num +')').find('a').trigger('click');
				}
			if(get_field.hasClass('grid-system'))
				{
				
				duplication.find('.id-'+get_field.attr('id')).removeClass('id-'+get_field.attr('id'));
				nf_setup_grid(duplication);
				
				jQuery(duplication.find('.grid-system')).each(
					function()
						{
						nf_setup_grid(jQuery(this));	
						}
					);
					
				jQuery(get_field.find('.grid-system')).each(
					function()
						{
						nf_setup_grid(jQuery(this));
						//create_droppable(jQuery(this));		
						}
					);	

				}

			var panel = jQuery('.form_canvas .panel-body');
			create_droppable(panel)
			
					
				
			}
		);	
	
	
	jQuery(document).on('click','.nf_step_breadcrumb a', //
		function()
			{
			jQuery('.nf_step_breadcrumb li').removeClass('current')
			jQuery('.nf_step_breadcrumb li').removeClass('visited')
			jQuery(this).parent().addClass('current');
			
			for(var i=(parseInt(jQuery(this).attr('data-show-step'))-1) ;i>=0;i--)
				jQuery('.nf_step_breadcrumb li:eq('+i+')').addClass('visited');
			
			}
		);
	
	
	jQuery(document).on('click','.multi-step-tools ul a', //
		function()
			{
			
				
			jQuery('.multi-step-tools ul li').removeClass('current');
			jQuery(this).parent().addClass('current')
			
			
			jQuery('.nex-forms-container .form_field.step').removeClass('active_step')
			jQuery('.nf_step_breadcrumb li:eq(0)').addClass('current');
			
			
			if(jQuery(this).parent().hasClass('new_step'))
				{
				jQuery('.multi-step-fields .form_field.step .draggable_object').first().trigger('click');
				return;
				}
			
			
			
			if(jQuery(this).attr('data-show-step')!='all')
				{
				jQuery('.nex-forms-container .step').hide()
				jQuery('.nex-forms-container').removeClass('view_all_steps');
				jQuery('.nex-forms-container .nf_multi_step_'+ jQuery(this).attr('data-show-step')).show();
				jQuery('.nex-forms-container .nf_multi_step_'+ jQuery(this).attr('data-show-step')).addClass('active_step')
				}
			else
				{
				jQuery('.nex-forms-container').addClass('view_all_steps');
				jQuery('.nex-forms-container .step').show()
				}
				
			
			//if(jQuery('.form_canvas').hasClass('conditional-logic-opened'))
			//	setTimeout(function(){ logic_interface();},1000);
			
			}
		);
	
	
	
	jQuery(document).on('click', '.save_nex_form', 
		function()
			{
			nf_save_nex_form(0,1, jQuery(this));
			jQuery(this).addClass('saving').html('<span class="fa fa-spin fa-refresh"></span>');
			}
		);		
		
	
	
	jQuery(document).on('change', 'input[name="form_post_action"]', 
		function()
			{
			
			if(jQuery(this).val()=='ajax')
				{
				jQuery('.submit_custom_options').addClass('hidden');
				jQuery('.submit_ajax_options').removeClass('hidden');
				
				if(jQuery('input[name="on_form_submission"]:checked').val()=='message')
					{
					jQuery('.on_submit_redirect').addClass('hidden');
					jQuery('.on_submit_show_message').removeClass('hidden');
					}
				else
					{
					jQuery('.on_submit_redirect').removeClass('hidden');
					jQuery('.on_submit_show_message').addClass('hidden');
					}
					
				}
			else
				{
					
				jQuery('.on_submit_redirect').addClass('hidden');
				jQuery('.on_submit_show_message').addClass('hidden');
				jQuery('.submit_custom_options').removeClass('hidden');
				jQuery('.submit_ajax_options').addClass('hidden');
				}
			}
		);		
		
		
		jQuery(document).on('change', 'input[name="on_form_submission"]', 
		function()
			{
			
			if(jQuery(this).val()=='message')
				{
				jQuery('.on_submit_redirect').addClass('hidden');
				jQuery('.on_submit_show_message').removeClass('hidden');
				}
			else
				{
				jQuery('.on_submit_redirect').removeClass('hidden');
				jQuery('.on_submit_show_message').addClass('hidden');
				}
			
			}
		);		

	
	/* PAYPAL  */
	jQuery(document).on('click', ".paypal_product .input-group-addon",
		function()
			{
					if(!jQuery(this).hasClass('is_label'))
							{
							jQuery(this).parent().find('.input-group-addon').removeClass('active');
							jQuery(this).addClass('active');
							
							if(jQuery(this).hasClass('static_value'))
								{
								if(jQuery(this).parent().hasClass('pp_product_quantity'))
									jQuery(this).parent().find('input[name="set_quantity"]').val('static');
								if(jQuery(this).parent().hasClass('pp_product_amount'))
									jQuery(this).parent().find('input[name="set_amount"]').val('static');
									
								
								jQuery(this).parent().find('input[type="text"]').removeClass('hidden')
								jQuery(this).parent().find('select').addClass('hidden')
								}
							else
								{
								if(jQuery(this).parent().hasClass('pp_product_quantity'))
									jQuery(this).parent().find('input[name="set_quantity"]').val('map');
								if(jQuery(this).parent().hasClass('pp_product_amount'))
									jQuery(this).parent().find('input[name="set_amount"]').val('map');
									
									
								jQuery(this).parent().find('select').removeClass('hidden')
								jQuery(this).parent().find('input[type="text"]').addClass('hidden')
								}
							}
					}
				)
	jQuery(document).on('click', '#add_paypal_product', function()
					{
					var pp_clone = jQuery('.paypal_product_clone').clone();
					pp_clone.removeClass('hidden').removeClass('paypal_product_clone').addClass('paypal_product');

					jQuery('.paypal_products').append(pp_clone);
					
					pp_clone.find('.product_number').text(jQuery('.paypal_products .paypal_product').size());
					
					jQuery(".paypal_products").animate(
							{
							scrollTop:(jQuery(".paypal_product").height()*jQuery('.paypal_products .paypal_product').size())+200
							},500
						);
					
			
					var set_current_fields_math_logic = '<option value="0" selected="selected">--- Map Field --</option>';
						set_current_fields_math_logic += '<optgroup label="Text Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
							function()
								{
								set_current_fields_math_logic += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_math_logic += '</optgroup>';
						
						set_current_fields_math_logic += '<optgroup label="Radio Buttons">';
						
						var old_radio = '';
						var new_radio = '';
						
						jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
							function()
								{
								old_radio = jQuery(this).attr('name');
								if(old_radio != new_radio)
									set_current_fields_math_logic += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								
								new_radio = old_radio;
								
								}
							);	
						set_current_fields_math_logic += '</optgroup>';
						
						var old_check = '';
						var new_check = '';
						set_current_fields_math_logic += '<optgroup label="Check Boxes">';
						jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
							function()
								{
								old_check = jQuery(this).attr('name');
								if(old_check != new_check)
									set_current_fields_math_logic += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								new_check = old_check;
								}
							);	
						set_current_fields_math_logic += '</optgroup>';
						
						set_current_fields_math_logic += '<optgroup label="Selects">';
						jQuery('div.nex-forms-container div.form_field select').each(
							function()
								{
								set_current_fields_math_logic += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_math_logic += '</optgroup>';
						
						set_current_fields_math_logic += '<optgroup label="Text Areas">';
						jQuery('div.nex-forms-container div.form_field textarea').each(
							function()
								{
								set_current_fields_math_logic += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_math_logic += '</optgroup>';
					
						set_current_fields_math_logic += '<optgroup label="Hidden Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="hidden"]').each(
							function()
								{
								set_current_fields_math_logic += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_math_logic += '</optgroup>';
						
						
						
					pp_clone.find('select').html(set_current_fields_math_logic);
		
					
					
					}
				);
			jQuery(document).on('click', ".remove_paypal_product",
		function()
			{	
			
					jQuery('.remove_paypal_product').remove('btn-primary');
					jQuery(this).closest('.paypal_product').remove();
					jQuery('.paypal_products .paypal_product').each(
						function(index)
							{
							jQuery(this).find('.product_number').text(index+1);
							}
						);
					}
				);
	
	
	
	jQuery('.form_field.grid').each(
		function()
			{
			var panel = jQuery(this).find('.panel-body');
			create_droppable(panel)
			}
		);
	
	//setTimeout(function()
		//{
		jQuery('div.nex-forms-container .form_field').each(
			function(index)
				{
				
				if(!jQuery(this).attr('data-settings-tabs'))
					setup_field_settings(jQuery(this));
				
				setup_form_element(jQuery(this))
				}
			);
		//},200);
	
	
	if(jQuery(document).width()<1600)
		{
		jQuery('.btn-fullscreen').trigger('click'); 
		/*jQuery('.nex_forms_admin_page_wrapper').addClass('fullscreen')
					jQuery('a.full-screen-btn').addClass('fc');
					jQuery('a.full-screen-btn').find('.material-icons').removeClass('fa-expand').addClass('fa-compress');*/
		}
	
	if(jQuery('#demo_site').text()=='yes')
		{
		var test_page_tour = new Tour({
			  name: "test-page-tour-"+jQuery('#form_update_id').text(),
			  template: "<div class='popover tour'><div class='popover-arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><button class='btn btn-default tour-step-back' data-role='prev'><span class='fa fa-arrow-left'></span> PREV </button><button class='btn btn-default end-tour dismiss_tour' data-role='end'><span class='fa fa-thumbs-up'></span> OK, got it. </button></div><button class='end-tour' data-role='end'><span class='fa fa-close'></span></button></div>",
			
			  steps: [
			  	{
				element: ".view_test_page",
				title: "New Test Page Created",
				content: "<br>A front-end test page has been created just for you!<br><br> Click on this button after you created <strong>AND SAVED</strong> the form. You can test your form live with email submissions and everything. </br></br>Remember you can download the form you create here to import into your own site!",
				placement: 'bottom'
			  	},
			  
			]});
		}
	}
);


function nf_count_multi_steps(){
	var total_steps = jQuery('.nex-forms-container .form_field.step').size();
	var set_breadcrumb = '';
	var set_stepping = '';
	var step_name = '';
	jQuery('.nex-forms-container .form_field.step').each(
		function(index, element)
			{
			
			for(var i=0;i<80;i++)
				jQuery(this).removeClass('nf_multi_step_'+(i))
			
			if(jQuery(this).find('.zero-clipboard .duplicate_field').length<=0)
				jQuery(this).find('.zero-clipboard .delete').after('<div title="Duplicate Step" class="btn btn-default btn-sm duplicate_field"><i class="fa fa-files-o"></i></div>') 
			
			
			if(jQuery(this).find('.zero-clipboard .show_step').length<=0)
				jQuery(this).find('.zero-clipboard .the_step_number').after('<div class="show_step">' + (index+1) + '</div>')
			
			jQuery(this).addClass('nf_multi_step_'+(index+1));

			if(!jQuery(this).attr('data-step-name'))
				jQuery(this).attr('data-step-name','Step '+ (index+1) );

			jQuery(this).attr('data-step-num', (index+1) );	
			step_name = jQuery(this).attr('data-step-name');
			if(!step_name || step_name=='' || step_name==null || step_name==' ' || step_name=='&nbsp;' || step_name=='&nbsp; ')
				step_name = (index+1);
				
			set_stepping += '<li ><a data-title="'+ step_name +'" data-toggle="tooltip_bs" data-placement="bottom" data-show-step="'+ (index+1) +'">'+ (index+1) +'</a></li>';
			set_breadcrumb += '<li><a data-show-step="'+ (index+1) +'">'+ step_name +'</a></li>';
			
			
			jQuery(this).find('.show_step').text(index+1);
			
				
			if(!jQuery(this).find('.btn-clipboard .the_step_number').attr('class'))
				{
				jQuery(this).find('.btn-clipboard').html('<span class="badge the_step_number">Step '+ (index+1) +' / ' + total_steps +  '</span>&nbsp;<div class="btn btn-default btn-sm delete " title="Delete field"><i class="glyphicon glyphicon-remove"></i></div>');
				}
			else
				{
				jQuery(this).find('.the_step_number').html('<input name="multi_step_name" type="text" class="form_control" placeholder="Step '+ (index+1) +'" value="'+ jQuery(this).attr('data-step-name') +'">' );
				jQuery(this).addClass('nf_multi_step_'+(index+1))
				}
			
			
			
			}
		);
		
	jQuery('span.all_steps_count').html(total_steps);
	jQuery('.nf_step_breadcrumb ol').html(set_breadcrumb);
	
	jQuery('.multi-step-stepping').html(set_stepping);
	
	jQuery('[data-toggle="tooltip_bs"]').tooltip_bs(
			{
			delay: 0,
			html:true
			}
		);
	
	return total_steps;
	
}
function nf_reset_multi_steps(){
	for(var i=0;i<80;i++)
		jQuery('.nex-forms-container .form_field.step').removeClass('nf_multi_step_'+(i))
}

function nf_save_nex_form(form_id,form_status, clicked_obj)
	{
	var set_form_id = 0;
	if(clicked_obj)
	clicked_obj.find('.waves-ripple').remove();
	
	if(jQuery('.ui-nex-forms-container .jq-datepicker').attr('class')!='')
		jQuery('.ui-nex-forms-container .jq-datepicker input').datepicker("destroy")
	
	if(jQuery('.ui-nex-forms-container .jq-radio-group').attr('class')!='')
		jQuery('.ui-nex-forms-container .jq-radio-group input').checkboxradio("destroy");
	if(jQuery('.ui-nex-forms-container .jq-check-group').attr('class')!='')
		jQuery('.ui-nex-forms-container .jq-check-group input').checkboxradio("destroy");
		
	if(jQuery('.ui-nex-forms-container .jq_select').attr('class')!='')
		jQuery('.ui-nex-forms-container select.jq_select').selectmenu('destroy');
	
	var text_before_save = '';
	if(clicked_obj)
		{
		var text_before_save = clicked_obj.html();
		clicked_obj.addClass('saving_btn');
		clicked_obj.html('<span class="fa fa-spin fa-refresh"></span>');
		}
	if(tinyMCE && tinyMCE!='undefined')
		tinyMCE.triggerSave();	
		
	if(jQuery('#form_name').val()=='')
			{
			return;
			}
		
		jQuery('link#arial').remove();
		jQuery('link#bookman').remove();
		jQuery('link#century_gothic').remove();
		jQuery('link#comic_sans_ms').remove();
		jQuery('link#courier').remove();
		jQuery('link#garamond').remove();
		jQuery('link#georgia').remove();
		jQuery('link#helvetica').remove();
		jQuery('link#lucida_grande').remove();
		jQuery('link#palatino').remove();
		jQuery('link#tahoma').remove();
		jQuery('link#times').remove();
		jQuery('link#trebuchet_ms').remove();
		jQuery('link#verdana').remove();
		jQuery('link#open_sans_condensed').remove();
		
		
		jQuery('div.nex-forms-container .edit_mask').remove();
		
		jQuery('div.admin_html').html(jQuery('div.nex-forms-container').html())
		jQuery('div.clean_html').html(jQuery('div.nex-forms-container').html())
		
		var clean_html = jQuery('div.clean_html');
		var admin_html = jQuery('div.admin_html');
		
		admin_html.find('.change_image').remove();
		admin_html.find('.bootstrap-datetimepicker-widget').remove();
		
		admin_html.find('.change_image2').remove();
		admin_html.find('.c_logic_field_type').remove();
		admin_html.find('.adv_arrow').remove();
		admin_html.find('.adv_target').remove();
		admin_html.find('.cl_arrow').remove();
		admin_html.find('.currently_editing_field').removeClass('currently_editing_field');
		admin_html.find('.edit-done').remove();
		admin_html.find('.currently_editing_settings').remove();
		admin_html.find('.grid-width-slider').remove();
		admin_html.find('.column_tools').remove();
		
		
		admin_html.find('.the-image-container .ui-resizable-handle').remove();
		admin_html.find('.the-image-container img').unwrap();
		
		admin_html.find('.form_field.field_spacer .ui-resizable-handle').remove();
		admin_html.find('.form_field.field_spacer').attr('class','form_field field_spacer');
		
		
		
		admin_html.find('.form_field').css('visibility','');
		admin_html.find('.form_field').css('display','');
		admin_html.find('.btn-lg.move_field').remove();
		admin_html.find('#slider').html('');
		
		admin_html.find('#slider').html('');
		
		admin_html.find('.the-thumb').removeClass('text-danger').removeClass('text-success').removeClass('checked');
		admin_html.find('.js-signature canvas').remove();
		admin_html.find('#star' ).html('');
		admin_html.find('.bootstrap-touchspin-postfix').remove();
		admin_html.find('.bootstrap-touchspin .input-group-btn').remove();
		admin_html.find('.bootstrap-touchspin .input-group-btn-vertical').remove();
		admin_html.find('.bootstrap-tagsinput').remove();
		admin_html.find('#spinner').unwrap();
		
		admin_html.find('.bootstrap-tagsinput').remove();
		admin_html.find('.popover').remove();
		admin_html.find('div.cd-dropdown').remove();
		admin_html.find('.form_field').removeClass('edit-field').removeClass('currently_editing');
		admin_html.find('.bootstrap-select').remove();
		admin_html.find('.popover').remove();
		admin_html.find('.step').removeClass('active_step');
		admin_html.find('.step').hide()
		admin_html.find('.step').first().show();
		
		var hidden_fields = '';	
		jQuery('.hidden_fields_setup .hidden_fields .hidden_field').each(
			function()
				{
				hidden_fields += jQuery(this).find('input.field_name').val();
				hidden_fields += '[split]';
				hidden_fields += jQuery(this).find('input.field_value').val();
				hidden_fields += '[end]';
				}
			);
		
		var form_hidden_fields = []; 
		
		jQuery('.hidden_fields_setup .hidden_fields .hidden_field').each(
			function()
				{
				form_hidden_fields.push(
						{
						field_name: jQuery(this).find('input.field_name').val(),
						field_value: jQuery(this).find('input.field_value').val(),
						}
					);
				}
			);	
			
	
			
			
				
		
		var mc_field_map = '';	
		jQuery('.mc_field_map .mc-form-field').each(
			function()
				{
				mc_field_map += jQuery(this).attr('data-field-tag');
				mc_field_map += '[split]';
				mc_field_map += jQuery(this).find('select').attr('data-selected');
				mc_field_map += '[end]';
				}
			);
			
		var gr_field_map = '';	
		jQuery('.gr_field_map .gr-form-field').each(
			function()
				{
				gr_field_map += jQuery(this).attr('data-field-tag');
				gr_field_map += '[split]';
				gr_field_map += jQuery(this).find('select').attr('data-selected');
				gr_field_map += '[end]';
				}
			);
		var mp_field_map = '';	
		jQuery('.mp_field_map .mp-form-field').each(
			function()
				{
				mp_field_map += jQuery(this).attr('data-field-tag');
				mp_field_map += '[split]';
				mp_field_map += jQuery(this).find('select').attr('data-selected');
				mp_field_map += '[end]';
				}
			);
			
		var ms_field_map = '';	
		jQuery('.ms_field_map .ms-form-field').each(
			function()
				{
				ms_field_map += jQuery(this).attr('data-field-tag');
				ms_field_map += '[split]';
				ms_field_map += jQuery(this).find('select').attr('data-selected');
				ms_field_map += '[end]';
				}
			);
		
		var ftp_field_map = '';	
		
		jQuery('.ftp_reponse_setup .ftp-attr').each(
			function()
				{
				ftp_field_map += jQuery(this).attr('data-field-tag');
				ftp_field_map += '[split]';
				ftp_field_map += jQuery(this).find('select').attr('data-selected');
				ftp_field_map += '[end]';
				}
			);
		
		jQuery('.ftp_reponse_setup .ftp-form-field').each(
			function()
				{
				ftp_field_map += jQuery(this).attr('data-field-tag');
				ftp_field_map += '[split]';
				
				if( jQuery(this).attr('data-field-tag')=='post_content')
					ftp_field_map += jQuery('#ftp_content').val();
				else
					ftp_field_map += jQuery(this).find('select').attr('data-selected');
				ftp_field_map += '[end]';
				}
			);
		
		
		var cl_array = '';
								
								jQuery('.set_rules .new_rule').each(
									function(index)
										{
										
										cl_array += '[start_rule]';
											
											//OPERATOR
											cl_array += '[operator]';
												cl_array += jQuery(this).find('select[name="selector"]').val() + '##' + jQuery(this).find('select[name="reverse_actions"] option:selected').val();
											cl_array += '[end_operator]';
											
											//CONDITIONS
											cl_array += '[conditions]';
											jQuery(this).find('.get_rule_conditions .the_rule_conditions').each(
												function(index)
													{
													cl_array += '[new_condition]';
														cl_array += '[field]';
															cl_array += jQuery(this).find('.cl_field').attr('data-selected');
														cl_array += '[end_field]';
														cl_array += '[field_condition]';
															cl_array += jQuery(this).find('select[name="field_condition"]').val();
														cl_array += '[end_field_condition]';
														cl_array += '[value]';
															cl_array += jQuery(this).find('input[name="conditional_value"]').val();
														cl_array += '[end_value]';
													cl_array += '[end_new_condition]';
													}
												);
											cl_array += '[end_conditions]';
											
											//ACTIONS
											cl_array += '[actions]';
											jQuery(this).find('.get_rule_actions .the_rule_actions').each(
												function(index)
													{
													cl_array += '[new_action]';
														cl_array += '[the_action]';
															cl_array += jQuery(this).find('select[name="the_action"]').val();
														cl_array += '[end_the_action]';
														cl_array += '[field_to_action]';
															cl_array += jQuery(this).find('select[name="cla_field"]').attr('data-selected');
														cl_array += '[end_field_to_action]';
														cl_array += '[to_value]';
															cl_array += jQuery(this).find('input[name="action_value_to"]').val();
														cl_array += '[end_to_value]';
													cl_array += '[end_new_action]';
													}
												);
											cl_array += '[end_actions]';
											
									
											
																					
										cl_array += '[end_rule]';
										
										
										}
									);
									
		
		if(jQuery('.set_rules .new_rule').size()>0)
			var cl_rule_array = [];
		else
			var cl_rule_array = '';
		
		var cl_actions_array = [];
		var cl_conditions_array = [];
								
								jQuery('.set_rules .new_rule').each(
									function(index)
										{
										
										var cl_actions_array = [];
										var cl_conditions_array = [];
										
										jQuery(this).find('.get_rule_conditions .the_rule_conditions').each(
											function(index)
												{
												if(jQuery(this).find('.input-group'))
													{
													if(
														(jQuery(this).find('select.cl_field').val() && jQuery(this).find('select.cl_field').val()!='0')
														&&
														(jQuery(this).find('select[name="field_condition"]').val() && jQuery(this).find('select[name="field_condition"]').val()!='0')
														)
														{
														cl_conditions_array.push(
																{
																field_Id: jQuery(this).find('.cl_field option:selected').attr('data-field-id'),
																field_name: jQuery(this).find('.cl_field option:selected').attr('data-field-name'),
																field_type: jQuery(this).find('.cl_field option:selected').attr('data-field-type'),
																condition: jQuery(this).find('select[name="field_condition"]').val(),
																condition_value: jQuery(this).find('input[name="conditional_value"]').val(),
																selected_value: jQuery(this).find('.cl_field').attr('data-selected')
																}
															);
														}
													}
												}
											);
											
											jQuery(this).find('.get_rule_actions .the_rule_actions').each(
												function(index)
													{
													if(jQuery(this).find('.input-group'))
														{
														if(jQuery('#'+ jQuery(this).find('select[name="cla_field"] option:selected').attr('data-field-id')).hasClass('step') && jQuery(this).find('select[name="the_action"]').val()=='show')
																clean_html.find('#'+ jQuery(this).find('select[name="cla_field"] option:selected').attr('data-field-id')).hide().addClass('hidden_by_logic').removeClass('step');
														
														if(jQuery(this).find('select[name="the_action"]').val()=='show')
															{
															clean_html.find('#'+ jQuery(this).find('select[name="cla_field"] option:selected').attr('data-field-id')).hide().addClass('hidden');
															
															}
														if(
															(jQuery(this).find('select[name="cla_field"]').val() && jQuery(this).find('select[name="cla_field"]').val()!='0')
															&&
															(jQuery(this).find('select[name="the_action"]').val() && jQuery(this).find('select[name="the_action"]').val()!='0')
															){
																cl_actions_array.push(
																	{
																	target_field_Id: jQuery(this).find('select[name="cla_field"] option:selected').attr('data-field-id'),
																	target_field_name: jQuery(this).find('select[name="cla_field"] option:selected').attr('data-field-name'),
																	target_field_type: jQuery(this).find('select[name="cla_field"] option:selected').attr('data-field-type'),
																	do_action: jQuery(this).find('select[name="the_action"]').val(),
																	selected_value: jQuery(this).find('select[name="cla_field"]').attr('data-selected'),
																	change_value: jQuery(this).find('input[name="action_value_to"]').val()
																	
																	}
																);	
															}
														}
													
													}
												);
											
										
										if(cl_conditions_array.length>0 && cl_actions_array.length>0)
											{
											cl_rule_array.push(
													{
													operator: jQuery(this).find('select[name="selector"]').val(),
													reverse_actions: jQuery(this).find('select[name="reverse_actions"] option:selected').val(),
													conditions: cl_conditions_array,
													actions: cl_actions_array
													}
												)
											}
										
										}
									);
		
		
		
		
				
	var product_array = '';
	var paypal_products_array = [];
								
								jQuery('.paypal_products .paypal_product').each(
									function(index)
										{
										//JSON ARRAY
										//To BE USED IN FUTURE UPDATES
										/*paypal_products_array.push(
														{
														item_name: jQuery(this).find('input[name="item_name"]').val(),
														set_quantity: jQuery(this).find('input[name="set_quantity"]').val(),
														item_qty: jQuery(this).find('input[name="item_quantity"]').val(),
														map_item_qty: jQuery(this).find('select[name="map_item_quantity"]').val(),
														set_amount: jQuery(this).find('input[name="set_amount"]').val(),
														item_amount: jQuery(this).find('input[name="item_amount"]').val(),
														map_item_amount: jQuery(this).find('select[name="map_item_amount"]').val()
														}
													);*/
										
										product_array += '[start_product]';
										
											product_array += '[item_name]';
												product_array += jQuery(this).find('input[name="item_name"]').val();
											product_array += '[end_item_name]';
											
											product_array += '[item_qty]';
												product_array += jQuery(this).find('input[name="item_quantity"]').val();
											product_array += '[end_item_qty]';
											
											product_array += '[map_item_qty]';
												product_array += jQuery(this).find('select[name="map_item_quantity"]').val();
											product_array += '[end_map_item_qty]';
											
											product_array += '[set_quantity]';
												product_array += jQuery(this).find('input[name="set_quantity"]').val();
											product_array += '[end_set_quantity]';
											
											product_array += '[item_amount]';
												product_array += jQuery(this).find('input[name="item_amount"]').val();
											product_array += '[end_item_amount]';
											
											product_array += '[map_item_amount]';
												product_array += jQuery(this).find('select[name="map_item_amount"]').val();
											product_array += '[end_map_item_amount]';
											
											product_array += '[set_amount]';
												product_array += jQuery(this).find('input[name="set_amount"]').val();
											product_array += '[end_set_amount]';
																					
										product_array += '[end_product]';
										
										
										}
									);		
	jQuery('.current_id').text('');
	clean_html.find('.change_thumb').remove();
	clean_html.find('.bootstrap-datetimepicker-widget').remove();
	clean_html.find('.form_field.date input').removeAttr('value');
	clean_html.find('.c_logic_field_type').remove();
	clean_html.find('.cl_arrow').remove();
	clean_html.find('.adv_arrow').remove();
	clean_html.find('.adv_target').remove();
	
	clean_html.find('.the-image-container .ui-resizable-handle').remove();
	clean_html.find('.the-image-container img').unwrap();
	clean_html.find('.the-image-container .show-width').remove();
	clean_html.find('.the-image-container .show-height').remove();
	clean_html.find('.the-image-container .change_image').remove();
	clean_html.find('.the-image-container .change_image2').remove();
	
	
	clean_html.find('.the-image-container img').unwrap();
	clean_html.find('.field_settings').remove();
	clean_html.find('.currently_editing_settings').remove();
	clean_html.find('.column_tools').remove();
	clean_html.find('.grid-width-slider').remove();
	clean_html.find('.field_spacer').html('');
	clean_html.find('.field_spacer').attr('class','field_spacer');
	clean_html.find('.form_field').css('visibility','');
	clean_html.find('.form_field').css('display','');
	clean_html.find('.btn-lg.move_field').remove();
	clean_html.find('#star' ).raty('destroy');	
	clean_html.find('.the-thumb').removeClass('text-danger').removeClass('text-success').removeClass('checked');
	clean_html.find('.js-signature canvas').remove();	
	clean_html.find('.zero-clipboard, div.ui-nex-forms-container .field_settings').remove();
	clean_html.find('.grid').removeClass('grid-system')		
	clean_html.find('.editing-field-container').removeClass('.editing-field-container')
	clean_html.find('.bootstrap-touchspin-prefix').remove();
	clean_html.find('.bootstrap-touchspin-postfix').remove();
	clean_html.find('.bootstrap-touchspin .input-group-btn').remove();
	clean_html.find('.bootstrap-touchspin .input-group-btn-vertical').remove();
	clean_html.find('.bootstrap-tagsinput').remove();
	clean_html.find('#spinner').unwrap();
	clean_html.find('.editing-field').removeClass('editing-field')
	clean_html.find('.editing-field-container').removeClass('.editing-field-container')
	clean_html.find('div.trash-can').remove();
	clean_html.find('div.draggable_object').hide();
	clean_html.find('div.draggable_object').remove();
	clean_html.find('div.form_field').removeClass('field').removeClass('currently_editing');
	clean_html.find('.zero-clipboard').remove();
	clean_html.find('.tab-pane').removeClass('tab-pane');	
	clean_html.find('.help-block.hidden, .is_required.hidden').remove();
	clean_html.find('.has-pretty-child, .slider').removeClass('svg_ready')
	clean_html.find('.input-group').removeClass('date');
	clean_html.find('.popover').remove();
	clean_html.find('.the_input_element, .row, .svg_ready, .radio-inline').each(
		function()
			{
			if(!jQuery(this).closest('.form_field').hasClass('image-choices-field'))
				{
				if(jQuery(this).parent().hasClass('input-inner') || jQuery(this).parent().hasClass('input_holder')){
					jQuery(this).unwrap();
					}	
				}
			}
		);
	clean_html.find('.form_field').each(
		function()
			{
			
				
			
			var obj = jQuery(this);
			
			if(obj.find('.input-group-addon.prefix').length>0)
				obj.addClass('has_prefix_icon');
			else
				obj.removeClass('has_prefix_icon');
				
				
			if(obj.find('.input-group-addon.postfix').length>0)
				obj.addClass('has_postfix_icon');
			else
				obj.removeClass('has_postfix_icon');
				
					
			clean_html.find('.customcon').each(
					function()
						{
						if(obj.attr('id')==jQuery(this).attr('data-target') && (jQuery(this).attr('data-action')=='show' || jQuery(this).attr('data-action')=='slideDown' || jQuery(this).attr('data-action')=='fadeIn'))
							clean_html.find('#'+obj.attr('id')).hide();
						}
					);
				}
			);
	clean_html.find('div').each(
		function()
			{
			if(!jQuery(this).closest('.form_field').hasClass('image-choices-field'))
				{
				if(jQuery(this).parent().hasClass('svg_ready') || jQuery(this).parent().hasClass('form_object') || jQuery(this).parent().hasClass('input-inner')){
					jQuery(this).unwrap();
					}
				}
			}
		);
	clean_html.find('div.form_field').each(
		function()
			{
			
			
			if(jQuery(this).hasClass('paragraph') || jQuery(this).hasClass('heading') || jQuery(this).hasClass('html') || jQuery(this).hasClass('math_logic'))
				{
				if(jQuery(this).find('.the_input_element').attr('data-original-math-equation')!='')
					{
					var text = jQuery(this).find('.the_input_element').html();
					if(text)
						{
						var set_text = text.replace('{math_result}','<span class="math_result">0</span>');
						jQuery(this).find('.the_input_element').html(set_text);
						}
					}
				}
			
			
			/*if(!jQuery(this).hasClass('material_field')){ 
				jQuery(this).find('#field_container').unwrap();
				jQuery(this).find('#field_container .row').unwrap('#field_container');
			}*/
				
			if(jQuery(this).parent().parent().hasClass('panel-default') && !jQuery(this).parent().prev('div').hasClass('panel-heading')){
				jQuery(this).parent().unwrap();
				jQuery(this).unwrap();
				}
			}

		);
		
	clean_html.find('.help-block').each(
		function()
			{
			if(!jQuery(this).text())
				jQuery(this).remove()
			}
		);
	clean_html.find('.sub-text').each(
		function()
			{
			if(jQuery(this).text()=='')
				{
				jQuery(this).parent().find('br').remove()
				jQuery(this).remove();
				}
			}
		);
	clean_html.find('.label_container').each(
		function()
			{
			if(jQuery(this).css('display')=='none')
				{
				jQuery(this).remove()
				}
			}
		);
	clean_html.find('.ui-draggable').removeClass('ui-draggable');
	clean_html.find('.ui-draggable-handle').removeClass('ui-draggable-handle')
	clean_html.find('.dropped').removeClass('dropped')
	clean_html.find('.ui-sortable-handle').removeClass('ui-sortable-handle');
	clean_html.find('.ui-sortable').removeClass('ui-sortable-handle');
	clean_html.find('.ui-droppable').removeClass('ui-sortable-handle');
	clean_html.find('.over').removeClass('ui-sortable-handle');
	clean_html.find('.the_input_element.bs-tooltip').removeClass('bs-tooltip') 
	clean_html.find('.bs-tooltip.glyphicon').removeClass('glyphicon');
	clean_html.find('.grid-system.panel').removeClass('panel-body');
	clean_html.find('.grid-system.panel').removeClass('panel');
	clean_html.find('.form_field.grid').removeClass('grid').removeClass('form_field').addClass('is_grid');
	clean_html.find('.grid-system').removeClass('grid-system');
	clean_html.find('.move_field').remove();
	clean_html.find('.input-group-addon.btn-file span').attr('class','fa fa-cloud-upload');
	clean_html.find('.input-group-addon.fileinput-exists span').attr('class','fa fa-close');
	clean_html.find('.checkbox-inline').addClass('radio-inline');
	clean_html.find('.check-group').addClass('radio-group');
	clean_html.find('.submit-button br').remove();
	clean_html.find('.submit-button small.svg_ready').remove();
	clean_html.find('.radio-group a, .check-group a').addClass('ui-state-default')
	clean_html.find('.is_grid .panel-body').removeClass('ui-widget-content');
	clean_html.find('.bootstrap-select.ui-state-default').removeClass('ui-state-default');
	clean_html.find('.selectpicker, .dropdown-menu.the_input_element').addClass('ui-state-default');
	clean_html.find('.selectpicker').removeClass('dropdown-toggle')
	clean_html.find('.is_grid .panel-body').removeClass('ui-widget-content');
	clean_html.find('.bootstrap-select.ui-state-default').removeClass('ui-state-default');
	clean_html.find('.is_grid .panel-body').removeClass('ui-sortable').removeClass('ui-droppable').removeClass('ui-widget-content').removeClass('');
	clean_html.find('.step').hide()
	clean_html.find('.step').first().show();
	clean_html.find('.step').removeClass('active_step');
	clean_html.find('.is_grid').css('z-index','');	
	
	var get_multistep_html = jQuery('.nf_step_breadcrumb');
	
	var multistep_html = get_multistep_html.clone();
	
	if(clean_html.find('.step').size()<2)
		multistep_html.find('ol').addClass('hidden');
	
	multistep_html.find('ul.show_all_steps').remove(); 
	multistep_html.find('li.new_step').remove(); 
	multistep_html.find('li').removeClass('current'); 
	multistep_html.find('li').removeClass('visited'); 
	multistep_html.find('li').first().addClass('current');
	
	
	
	var multistep_nav = jQuery('.multi-step-stepping').clone();
	multistep_nav.find('li').removeClass('current');
	multistep_nav.find('li:eq(0)').addClass('current');
	var md_theme = []; 
	md_theme.push(
			{
			theme_name: jQuery('select[name="md_theme_selection"]').val(),
			theme_shade: (jQuery('.workspace_theme_dark').hasClass('active')) ? 'dark' : 'light',
			
			overall_font: jQuery('#google_fonts_overall').attr('data-selected'),
			
			field_spacing: jQuery('#field_spacing').val(),
			
			overall_label_font: jQuery('#google_fonts_lable').attr('data-selected'),
			overall_label_font_size: jQuery('#label_font_size').val(),
			overall_label_align: jQuery('.overall-fields-styling-settings .o-label-text-align.active').attr('data-style-tool'),
			
			overall_label_color: jQuery('.o-label-color').val(),
			
			
			overall_label_bold: (jQuery('.o-label-bold').hasClass('active')) ? 'bold' : 'not-bold',
			overall_label_italic: (jQuery('.o-label-italic').hasClass('active')) ? 'italic' :'not-italic',
			overall_label_underline: (jQuery('.o-label-underline').hasClass('active')) ? 'underline' : 'not-underline',
			
			
			
			
			overall_input_font: jQuery('#google_fonts_input').attr('data-selected'),
			overall_input_font_size: jQuery('#input_font_size').val(),
			overall_input_align: jQuery('.overall-fields-styling-settings .o-input-text-align.active').attr('data-style-tool'),
			
			overall_input_color: jQuery('.o-input-color').val(),
			overall_input_bg_color: jQuery('.o-input-bg-color').val(),
			overall_input_border_color: jQuery('.o-input-border-color').val(),
			
			overall_input_bold: (jQuery('.o-input-bold').hasClass('active')) ? 1 : 0,
			overall_input_italic: (jQuery('.o-input-italic').hasClass('active')) ? 1 : 0,
			overall_input_underline: (jQuery('.o-input-underline').hasClass('active')) ? 1 : 0,
			
			overall_field_layout: jQuery('.overall-fields-styling-settings .set_layout.active').attr('data-style-tool'),
			overall_field_corners: jQuery('.overall-fields-styling-settings .overall-input-corners .btn.active').attr('data-style-tool'),
			
			
			overall_icon_font_size: jQuery('#icon_font_size').val(),
			
			overall_icon_color: jQuery('.o-icon-text-color').val(),
			overall_icon_bg_color: jQuery('.o-icon-bg-color').val(),
			overall_icon_border_color: jQuery('.o-icon-brd-color').val(),
			
			overall_field_errors: jQuery('.overall-fields-styling-settings .overall-error-style .btn.active').attr('data-style-tool'),
			overall_field_errors_pos: jQuery('.overall-fields-styling-settings .overall-error-position .btn.active').attr('data-style-tool')
			}
		);
	console.log(jQuery('.overall-fields-styling-panel .set_layout.active').attr('data-style-tool'));
	var multistep_settings = [];	
	multistep_settings.push(
			{
			multi_step_total: jQuery('.nex-forms-container .form_field.step').size(),
			multi_step_stepping:multistep_nav.html(),
			breadcrumb_list:jQuery('.nf_step_breadcrumb ol').html(),
			breadcrumb_type:jQuery('.nf_step_breadcrumb ol').attr('data-breadcrumb-type'),
			text_pos: jQuery('.nf_step_breadcrumb ol').attr('data-text-pos'),
			crumb_align: jQuery('.nf_step_breadcrumb ol').attr('data-align-crumb'),
			bc_position: jQuery('.nf_bc_position').text(),
			data_theme: jQuery('.nf_step_breadcrumb ol').attr('data-theme'),
			show_front_end: jQuery('.nf_step_breadcrumb ol').attr('data-show-front-end'),
			show_inside: jQuery('.nf_step_breadcrumb ol').attr('data-show-inside'),
			scroll_to_top: jQuery('.nf_step_scroll_top').text(),
			form_width_pixels: jQuery('.ui-nex-forms-container').attr('data-width-pixels'),
			form_width_percentage: jQuery('.ui-nex-forms-container').attr('data-width-percentage'),
			form_width_unit: jQuery('.ui-nex-forms-container').attr('data-width-unit'),
			}
		);
	
	var option_settings = [];	
	option_settings.push(
			{
			save_form_progress:jQuery('input[name="save_form_progress"]:checked').val(),
			submit_limit:jQuery('input[name="submit_limit"]').val(),
			submit_limit_msg:jQuery('textarea[name="submit_limit_msg"]').val(),
			}
		);
	
	var upload_settings = [];	
	upload_settings.push(
			{
			upload_to_server:jQuery('input[name="upload_to_server"]:checked').val(),
			}
		);
	
	var attachment_settings = [];	
	attachment_settings.push(
			{
			attach_to_user_email:jQuery('input[name="attach_to_user_email"]:checked').val(),
			attach_to_admin_email:jQuery('input[name="attach_to_admin_email"]:checked').val(),
			}
		);
	
	
	
		var take_action = 'nf_insert_record';
		
		if(jQuery('#form_update_id').text() || form_id)
			take_action = 'nf_update_record'
		if(form_status == 'preview')
			take_action = 'preview_nex_form'
		if(form_status == 'draft')
			take_action = 'nf_update_draft'
	    var active_mail_subscriptions = '';
		
	if(jQuery('input[name="mc_integration"]:checked').val()=='1')
		active_mail_subscriptions += 'mc,';
	if(jQuery('input[name="gr_integration"]:checked').val()=='1')
		active_mail_subscriptions += 'gr,';
	if(jQuery('input[name="mp_integration"]:checked').val()=='1')
		active_mail_subscriptions += 'mp,';
	if(jQuery('input[name="ms_integration"]:checked').val()=='1')
		active_mail_subscriptions += 'ms,';
		
		
		
		
	 var pdf_attachements = '';
	if(jQuery('input[name="pdf_admin_attach"]:checked').val()=='1')
		pdf_attachements += 'admin,';
	if(jQuery('input[name="pdf_user_attach"]:checked').val()=='1')
		pdf_attachements += 'user,';
		
	 var email_on_payment_success = '';
	if(jQuery('input[name="email_on_payments"]:checked').val()=='1')
		email_on_payment_success += 'payments,';
	if(jQuery('input[name="email_on_failures"]:checked').val()=='1')
		email_on_payment_success += 'failures,';
	if(jQuery('input[name="email_before_payments"]:checked').val()=='1')
		email_on_payment_success += 'before_payments,';
	
	jQuery( ".ui-nex-forms-container .jq-radio-group input" ).checkboxradio();
	jQuery( ".ui-nex-forms-container .jq-check-group input" ).checkboxradio();

	jQuery('.ui-nex-forms-container .jq-datepicker input').datepicker();
	
	
	jQuery('input[name="nex_autoresponder_recipients"]').trigger('change');
	jQuery('input[name="nex_autoresponder_from_address"]').trigger('change')
	jQuery('input[name="nex_autoresponder_from_name"]').trigger('change')
	
	
	jQuery('.ui-nex-forms-container select.jq_select').selectmenu();
			var data =
				{
				action	 							: take_action,
				table								: 'wap_nex_forms',
				edit_Id								: (form_id) ? form_id : jQuery('#form_update_id').text().trim(),
				plugin								: 'shared',
				title								: jQuery('#form_name').val(),
				form_fields							: admin_html.html(),
				clean_html							: clean_html.html(),
				is_form								: form_status,
				is_template							: '0',
				post_type							: jQuery('input[name="form_post_method"]:checked').val(),
				post_action							: jQuery('input[name="form_post_action"]:checked').val(),
				custom_url							: jQuery('#on_form_submission_custum_url').val(),
				mail_to								: jQuery('input[name="nex_autoresponder_recipients"]').val(),
				from_address						: jQuery('input[name="nex_autoresponder_from_address"]').val(),
				from_name							: jQuery('input[name="nex_autoresponder_from_name"]').val(),
				on_screen_confirmation_message		: jQuery('#on_screen_message').val(),
				google_analytics_conversion_code	: jQuery('#google_analytics_conversion_code').val(),
				confirmation_page					: jQuery('#nex_autoresponder_confirmation_page').val(),
				user_email_field					: jQuery('#nex_autoresponder_user_email_field').attr('data-selected'),
				confirmation_mail_subject			: jQuery('#nex_autoresponder_confirmation_mail_subject').val(),
				user_confirmation_mail_subject		: jQuery('#nex_autoresponder_user_confirmation_mail_subject').val(),
				confirmation_mail_body				:  jQuery('#user_email_body_content').val(),
				on_form_submission					: jQuery('input[name="on_form_submission"]:checked').val(),
				form_hidden_fields					: form_hidden_fields,
				hidden_fields						: form_hidden_fields,
				conditional_logic					: cl_array,
				conditional_logic_array				: cl_rule_array,
				admin_email_body					: jQuery('#admin_email_body_content').val(),
				bcc									: jQuery('#nex_admin_bcc_recipients').val(),
				bcc_user_mail						: jQuery('#nex_autoresponder_bcc_recipients').val(),
				custom_css							: jQuery('#custom_css').val(),
				is_paypal							: jQuery('input[name="go_to_paypal"]:checked').val(),
				form_type							: jQuery('.form_attr .form_type').text(),
				draft_Id							: 0,
				products							: product_array,
				currency_code						: (jQuery('.paypal-column select[name="currency_code"]').val()) ? jQuery('.paypal-column select[name="currency_code"]').val() : 'USD',
				business							: jQuery('.paypal-column input[name="business"]').val(),
				paypal_client_Id					: jQuery('.paypal-column input[name="paypal_client_Id"]').val(),
				paypal_client_secret				: jQuery('.paypal-column input[name="paypal_client_secret"]').val(),
				payment_success_msg					: jQuery('.paypal-column textarea[name="payment_success_msg"]').val(),
				payment_failed_msg					: jQuery('.paypal-column textarea[name="payment_failed_msg"]').val(),
				email_on_payment_success			: email_on_payment_success,
				cmd									: '_cart',
				return_url							: jQuery('.paypal-column input[name="return"]').val(),
				cancel_url							: jQuery('.paypal-column input[name="cancel_url"]').val(),
				lc									: (jQuery('.paypal-column select[name="paypal_language_selection"]').val()) ? jQuery('.paypal-column select[name="paypal_language_selection"]').val() : 'US',
				environment							: jQuery('input[name="paypal_environment"]:checked').val(),
				mc_field_map						: mc_field_map,
				mc_list_id							: jQuery('select[name="mail_chimp_lists"]').attr('data-selected'),
				gr_field_map						: gr_field_map,
				gr_list_id							: jQuery('select[name="get_response_lists"]').attr('data-selected'),
				mp_field_map						: mp_field_map,
				mp_list_id							: jQuery('select[name="mailpoet_lists"]').attr('data-selected'),
				ms_field_map						: ms_field_map,
				ms_list_id							: jQuery('select[name="mailster_lists"]').attr('data-selected'),
				email_subscription					: active_mail_subscriptions,
				pdf_html							: jQuery('#pdf_html').val(),
				attach_pdf_to_email					: pdf_attachements,
				form_to_post_map					: ftp_field_map,
				is_form_to_post						: jQuery('.ftp_reponse_setup input[name="ftp_integration"]:checked').val(),
				md_theme							: md_theme,
				form_theme							: jQuery('.set_form_theme').attr('data-selected'),
				jq_theme							: jQuery('.choose_form_theme').attr('data-selected'),
				form_style							: jQuery('.nex-forms-container').attr('style'),
				multistep_settings					: multistep_settings,
				multistep_html						: multistep_html.html(),
				upload_settings						: upload_settings,
				attachment_settings					: attachment_settings,
				option_settings						: option_settings
				};
				if(clicked_obj)
					{
					if(clicked_obj.hasClass('is_template'))
						{
						data.is_form = '0';
						data.is_template = '1';
						data.action = 'nf_insert_record';
						
						if(jQuery('#form_type').text()=='template')
							{
							data.action = 'nf_update_record';	
							}
						
						var is_template = '1';
						}
					}
				else
					{
					if(jQuery('#form_type').text()=='template')
						{
						data.action = 'nf_insert_record';	
						}
					
					data.is_template = '0';
					var is_template = '0';
					}
			
			jQuery('.form_preview_loader').show();
			
			if(clicked_obj)
				clicked_obj.html();
			clearTimeout(timer);				
			jQuery.post
				(
				ajaxurl, data, function(response)
					{
					jQuery('.ns').remove();
					if(form_status=='preview')
						{
						jQuery('.show_form_preview').attr('src',jQuery('.admin_url').text() + '/admin.php?page=nex-forms-preview&form_Id='+response);
						if(clicked_obj)
							clicked_obj.html(text_before_save);	
							
						setTimeout(
								function()
									{
									jQuery('.form_preview_loader').hide();
									
									}
									,3000
								);
						jQuery('div.clean_html').html('');	
						}
					else
						{
						jQuery('div.clean_html').html('');
						jQuery('div.admin_html').html('');
						
						
							if(is_template=='1')
								{
								popup_user_alert('Template Saved');
								jQuery('.save_nex_form.is_template').removeClass('saving').html('Update Template');
								}
							else
								{
								if(jQuery('#form_update_id').text())
									{
									if(jQuery('#form_type').text()=='template')
										{
										popup_user_alert('New Form Created');
										jQuery('.save_nex_form.is_template').removeClass('saving').html('Save as template');
										}
									else
										{
										jQuery('.prime_save').removeClass('saving');
										jQuery('.prime_save').addClass('flip_btn');
										
										jQuery('.prime_save').html('<span class="fa fa-floppy-o"></span>&nbsp;&nbsp;SAVED!');
										
										setTimeout(function(){ jQuery('.prime_save').html('<span class="fa fa-floppy-o"></span>&nbsp;&nbsp;SAVE'); //jQuery('.prime_save').removeClass('flip_btn'); 
										},2000);
										
										}
									}
								else
									{
									popup_user_alert('New Form Created');
									jQuery('.prime_save').html('<span class="fa fa-floppy-o"></span>&nbsp;&nbsp;UPDATE');
									}
								}
											
						if(response)
							{
							if(!is_template || is_template==0 || form_status!='draft')
								{
								jQuery('#form_update_id').text(response.trim())
								
								}
							jQuery('.check_save').removeClass('not_saved');
							}
						}
					}
				);	
			
	}


function popup_user_alert(msg){
	
	Materialize.toast(msg, 2000, 'toast-success');
}

function possible_email_fields(){
	var posible_email_fields = '<option value="">Dont send confirmation mail to user</option>';	
	var has_email_fields = false;
	jQuery('div.nex-forms-container div.form_field input.email').each(
			function()
				{
				has_email_fields = true;
				posible_email_fields += '<option value="'+  jQuery(this).attr('name') +'" '+ ((jQuery('.nex_form_attr .user_email_field').text()==jQuery(this).attr('name')) ? 'selected="selected"' : '') +' >'+ jQuery(this).closest('div.form_field').find('.the_label').text() +'</option>';
				}
			);
	jQuery('select[name="posible_email_fields"]').html(posible_email_fields);	
}

function update_select(the_class){
	jQuery('select'+ the_class +' option').each(
		function()
			{
			var get_selected = jQuery(this).closest('select');
			
			
			if(jQuery(this).val()==get_selected.attr('data-selected'))
				{
				jQuery(this).attr('selected','selected');
				jQuery(this).trigger('click');
				}
			}
		);	
}

function nf_apply_font(obj, selector){	

	  if(jQuery('select[name="'+ selector +'"]').val()=='')
	  	{
			jQuery('select[name="'+ selector +'"]').attr('data-selected','')
			obj.css('font-family','');
			return;
		}

	  var font = JSON.parse( jQuery('select[name="'+ selector +'"]').val() )
	  obj.css('font-family', font.family);
	  jQuery('select[name="'+ selector +'"]').attr('data-selected',jQuery('select[name="'+ selector +'"] option:selected').attr('class'))
	  
	  if ( 'undefined' !== font.name ) {
			if(!jQuery('link[id="'+ format_illegal_chars(font.name) +'"]').length>0)
				{
				if(format_illegal_chars(font.name)!='arial'
				&& format_illegal_chars(font.name)!='bookman'
				&& format_illegal_chars(font.name)!='century_gothic'
				&& format_illegal_chars(font.name)!='comic_sans_ms'
				&& format_illegal_chars(font.name)!='courier'
				&& format_illegal_chars(font.name)!='garamond'
				&& format_illegal_chars(font.name)!='georgia'
				&& format_illegal_chars(font.name)!='helvetica'
				&& format_illegal_chars(font.name)!='lucida_grande'
				&& format_illegal_chars(font.name)!='palatino'
				&& format_illegal_chars(font.name)!='tahoma'
				&& format_illegal_chars(font.name)!='times'
				&& format_illegal_chars(font.name)!='trebuchet_ms'
				&& format_illegal_chars(font.name)!='verdana'
				)
					{
					jQuery( '<link id="'+format_illegal_chars(font.name)+'" type="text/css" role="google-font-import" rel="stylesheet" href="https://fonts.googleapis.com/css?family='+ font.name +'">').appendTo( '.nex-forms-container' );
					}
				}
		}
	  
}

function set_ms_field_map(){
	var set_current_fields_paypal = '<option value="0" selected="selected">--- Map Field --</option>';
						set_current_fields_paypal += '<optgroup label="Text Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Text Areas">';
						jQuery('div.nex-forms-container div.form_field textarea').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Radio Buttons">';
						
						var old_radio = '';
						var new_radio = '';
						
						jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
							function()
								{
								old_radio = jQuery(this).attr('name');
								if(old_radio != new_radio)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								
								new_radio = old_radio;
								
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						var old_check = '';
						var new_check = '';
						set_current_fields_paypal += '<optgroup label="Check Boxes">';
						jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
							function()
								{
								old_check = jQuery(this).attr('name');
								if(old_check != new_check)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								new_check = old_check;
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Selects">';
						jQuery('div.nex-forms-container div.form_field select').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						set_current_fields_paypal += '<optgroup label="Hidden Fields">';
							set_current_fields_paypal += jQuery('.hidden_form_fields').html()
						set_current_fields_paypal += '</optgroup>';
						
						
					jQuery('.ms_field_map').find('select').html(set_current_fields_paypal);
					
					jQuery('.ms_field_map').find('select option').each(
						function()
							{
							var get_selected = jQuery(this).closest('select');
							if(jQuery(this).val()==get_selected.attr('data-selected'))
								{
								jQuery(this).attr('selected','selected');
								}
							}
						);
}
function set_mp_field_map(){
	var set_current_fields_paypal = '<option value="0" selected="selected">--- Map Field --</option>';
						set_current_fields_paypal += '<optgroup label="Text Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Text Areas">';
						jQuery('div.nex-forms-container div.form_field textarea').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Radio Buttons">';
						
						var old_radio = '';
						var new_radio = '';
						
						jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
							function()
								{
								old_radio = jQuery(this).attr('name');
								if(old_radio != new_radio)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								
								new_radio = old_radio;
								
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						var old_check = '';
						var new_check = '';
						set_current_fields_paypal += '<optgroup label="Check Boxes">';
						jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
							function()
								{
								old_check = jQuery(this).attr('name');
								if(old_check != new_check)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								new_check = old_check;
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Selects">';
						jQuery('div.nex-forms-container div.form_field select').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						set_current_fields_paypal += '<optgroup label="Hidden Fields">';
							set_current_fields_paypal += jQuery('.hidden_form_fields').html()
						set_current_fields_paypal += '</optgroup>';
						
						
					jQuery('.mp_field_map').find('select').html(set_current_fields_paypal);
					
					jQuery('.mp_field_map').find('select option').each(
						function()
							{
							var get_selected = jQuery(this).closest('select');
							if(jQuery(this).val()==get_selected.attr('data-selected'))
								{
								jQuery(this).attr('selected','selected');
								}
							}
						);
}

function set_mc_field_map(){
	var set_current_fields_paypal = '<option value="0" selected="selected">--- Map Field --</option>';
						set_current_fields_paypal += '<optgroup label="Text Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Text Areas">';
						jQuery('div.nex-forms-container div.form_field textarea').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Radio Buttons">';
						
						var old_radio = '';
						var new_radio = '';
						
						jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
							function()
								{
								old_radio = jQuery(this).attr('name');
								if(old_radio != new_radio)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								
								new_radio = old_radio;
								
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						var old_check = '';
						var new_check = '';
						set_current_fields_paypal += '<optgroup label="Check Boxes">';
						jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
							function()
								{
								old_check = jQuery(this).attr('name');
								if(old_check != new_check)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								new_check = old_check;
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Selects">';
						jQuery('div.nex-forms-container div.form_field select').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						set_current_fields_paypal += '<optgroup label="Hidden Fields">';
							set_current_fields_paypal += jQuery('.hidden_form_fields').html()
						set_current_fields_paypal += '</optgroup>';
						
						
					jQuery('.mc_field_map').find('select').html(set_current_fields_paypal);
					
					jQuery('.mc_field_map').find('select option').each(
						function()
							{
							var get_selected = jQuery(this).closest('select');
							if(jQuery(this).val()==get_selected.attr('data-selected'))
								{
								jQuery(this).attr('selected','selected');
								}
							}
						);
}


function set_gr_field_map(){
	var set_current_fields_paypal = '<option value="0" selected="selected">--- Map Field --</option>';
						set_current_fields_paypal += '<optgroup label="Text Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Text Areas">';
						jQuery('div.nex-forms-container div.form_field textarea').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Radio Buttons">';
						
						var old_radio = '';
						var new_radio = '';
						
						jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
							function()
								{
								old_radio = jQuery(this).attr('name');
								if(old_radio != new_radio)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								
								new_radio = old_radio;
								
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						var old_check = '';
						var new_check = '';
						set_current_fields_paypal += '<optgroup label="Check Boxes">';
						jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
							function()
								{
								old_check = jQuery(this).attr('name');
								if(old_check != new_check)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								new_check = old_check;
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Selects">';
						jQuery('div.nex-forms-container div.form_field select').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						set_current_fields_paypal += '<optgroup label="Hidden Fields">';
							set_current_fields_paypal += jQuery('.hidden_form_fields').html()
						set_current_fields_paypal += '</optgroup>';
						
						
						
						
					jQuery('.gr_field_map').find('select').html(set_current_fields_paypal);
					
					jQuery('.gr_field_map').find('select option').each(
						function()
							{
							var get_selected = jQuery(this).closest('select');
							if(jQuery(this).val()==get_selected.attr('data-selected'))
								{
								jQuery(this).attr('selected','selected');
								}
							}
						);
}

function set_ftp_field_map(){
	var set_current_fields_paypal = '<option value="0" selected="selected">--- Map Field --</option>';
						set_current_fields_paypal += '<optgroup label="Text Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Text Areas">';
						jQuery('div.nex-forms-container div.form_field textarea').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Radio Buttons">';
						
						var old_radio = '';
						var new_radio = '';
						
						jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
							function()
								{
								old_radio = jQuery(this).attr('name');
								if(old_radio != new_radio)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								
								new_radio = old_radio;
								
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						var old_check = '';
						var new_check = '';
						set_current_fields_paypal += '<optgroup label="Check Boxes">';
						jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
							function()
								{
								old_check = jQuery(this).attr('name');
								if(old_check != new_check)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								new_check = old_check;
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Selects">';
						jQuery('div.nex-forms-container div.form_field select').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="File Uploaders">';
						jQuery('div.nex-forms-container div.form_field input[type="file"]').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						
						set_current_fields_paypal += '<optgroup label="Hidden Fields">';
							set_current_fields_paypal += jQuery('.hidden_form_fields').html()
						set_current_fields_paypal += '</optgroup>';
						
						
					jQuery('.ftp-form-field').find('select').html(set_current_fields_paypal);
					
					jQuery('.ftp-form-field').find('select option').each(
						function()
							{
							var get_selected = jQuery(this).closest('select');
							if(jQuery(this).val()==get_selected.attr('data-selected'))
								{
								jQuery(this).attr('selected','selected');
								}
							}
						);
}


function set_paypal_fields(){
	var set_current_fields_paypal = '<option value="0" selected="selected">--- Map Field --</option>';
						set_current_fields_paypal += '<optgroup label="Text Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Radio Buttons">';
						
						var old_radio = '';
						var new_radio = '';
						
						jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
							function()
								{
								old_radio = jQuery(this).attr('name');
								if(old_radio != new_radio)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								
								new_radio = old_radio;
								
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						var old_check = '';
						var new_check = '';
						set_current_fields_paypal += '<optgroup label="Check Boxes">';
						jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
							function()
								{
								old_check = jQuery(this).attr('name');
								if(old_check != new_check)
									set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								new_check = old_check;
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Selects">';
						jQuery('div.nex-forms-container div.form_field select').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
						
						set_current_fields_paypal += '<optgroup label="Text Areas">';
						jQuery('div.nex-forms-container div.form_field textarea').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += '</optgroup>';
					
						set_current_fields_paypal += '<optgroup label="Hidden Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="hidden"]').each(
							function()
								{
								set_current_fields_paypal += '<option value="'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ jQuery(this).attr('name') +'</option>';
								}
							);	
						set_current_fields_paypal += jQuery('.hidden_form_fields').html()
						set_current_fields_paypal += '</optgroup>';
						
						
						
					jQuery('.paypal_products').find('select').html(set_current_fields_paypal);
					
					jQuery('.paypal-column').find('select option').each(
						function()
							{
							var get_selected = jQuery(this).closest('select');
							if(jQuery(this).val()==get_selected.attr('data-selected'))
								{
								jQuery(this).attr('selected','selected');
								}
							}
						);
}



function setup_tags(){
	
	var tag_str = '';
	var old_radio = '';
	var new_radio = '';
	
	tag_str += '<li class="tiny_menu_head"><strong>Default tags</strong></li>';
	
	
	tag_str += '<li><a class="item" element="tag" code="nf_form_data" href="#">Form Data Table</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_from_page" href="#">From Page</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_form_title" href="#">Form Title</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_form_id" href="#">Form ID</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_entry_id" href="#">Unique Entry ID</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_entry_date_time" href="#">Date &amp; Time</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_entry_date" href="#">Date</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_entry_date_day" href="#">Date - Day </a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_entry_date_month" href="#">Date - Month </a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_entry_date_year" href="#">Date - Year </a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_entry_time" href="#">Time</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_user_ip" href="#">User IP</a></li>';
	
	tag_str += '<li class="tiny_menu_head"><strong>Field tags</strong></li>';
	
	jQuery('div.nex-forms-container div.form_field input.the_input_element').each(
		function()	
			{
			var input_name	 = 	jQuery(this).attr('name');	
			input_name = input_name.replace(']','');
			input_name = input_name.replace('[','');
			var input_type	 = 	jQuery(this).attr('type');	
			if(input_type=='radio' || input_type=='checkbox')
				{
				old_radio = jQuery(this).attr('name');
				if(old_radio != new_radio)
					tag_str += '<li><a class="item" element="tag" code="'+ input_name +'" href="#">'+ unformat_name(input_name) +'</a></li>';
				new_radio = old_radio;
				}
			else
				{
				tag_str += '<li><a class="item" element="tag" code="'+ input_name +'" href="#">'+ unformat_name(input_name) +'</a></li>';
				}
			}
		);
	
	jQuery('div.nex-forms-container div.form_field select.the_input_element').each(
		function()	
			{
			var input_name	 = 	jQuery(this).attr('name');	
			tag_str += '<li><a class="item" element="tag" code="'+ input_name +'" href="#">'+ unformat_name(input_name) +'</a></li>';
			}
		);
	
	jQuery('div.nex-forms-container div.form_field textarea.the_input_element').each(
		function()	
			{
			var input_name	 = 	jQuery(this).attr('name');	
			tag_str += '<li><a class="item" element="tag" code="'+ input_name +'" href="#">'+ unformat_name(input_name) +'</a></li>';
			}
		);
	
	tag_str += '<li class="tiny_menu_head"><strong>Logged-in User tags</strong></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_user_name" href="#">Username</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_user_first_name" href="#">User First Name</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_user_last_name" href="#">User Last Name</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_user_email_address" href="#">User Email Address</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_user_url" href="#">User URL</a></li>';
	
	
	tag_str += '<li class="tiny_menu_head"><strong>PayPal tags</strong></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_paypal_data" href="#">PayPal Data Table</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_paypal_status" href="#">Payment Status</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_paypal_ammount" href="#">Payment Ammount</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_paypal_currency" href="#">Payment Currency</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_paypal_payment_id" href="#">Payment ID</a></li>';
	tag_str += '<li><a class="item" element="tag" code="nf_paypal_payment_token" href="#">Payment Token</a></li>';
	
	
	
	
	
	jQuery('.tiny_button_tags_placeholders').html(	tag_str);	
}



function setup_tags2(){
		var set_email_tags = '';
						set_email_tags += '<optgroup label="Text Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
							function()
								{
								set_email_tags += '<option value="{{'+ format_illegal_chars(jQuery(this).attr('name'))  +'}}">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
								
								}
							);	
						set_email_tags += '</optgroup>';
						
						set_email_tags += '<optgroup label="Radio Buttons">';
						var old_radio = '';
						var new_radio = '';
						
						jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
							function()
								{
								old_radio = jQuery(this).attr('name');
								if(old_radio != new_radio)
									set_email_tags += '<option value="{{'+ format_illegal_chars(jQuery(this).attr('name'))  +'}}">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
								
								new_radio = old_radio;
								
								}
							);	
						set_email_tags += '</optgroup>';
						
						var old_check = '';
						var new_check = '';
						set_email_tags += '<optgroup label="Check Boxes">';
						jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
							function()
								{
								var check_name = jQuery(this).attr('name').replace('[]','')
									
								old_check = check_name;
								if(old_check != new_check)
									set_email_tags += '<option value="{{'+ format_illegal_chars(check_name)  +'}}">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
								new_check = old_check;
								}
							);	
						set_email_tags += '</optgroup>';
						
						set_email_tags += '<optgroup label="Selects">';
						jQuery('div.nex-forms-container div.form_field select').each(
							function()
								{
								set_email_tags += '<option value="{{'+ format_illegal_chars(jQuery(this).attr('name'))  +'}}">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
								}
							);	
						set_email_tags += '</optgroup>';
						
						set_email_tags += '<optgroup label="Text Areas">';
						jQuery('div.nex-forms-container div.form_field textarea').each(
							function()
								{
								set_email_tags += '<option value="{{'+ format_illegal_chars(jQuery(this).attr('name'))  +'}}">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
								}
							);	
						set_email_tags += '</optgroup>';
						
						
						set_email_tags += '<optgroup label="File Uploaders">';
						jQuery('div.nex-forms-container div.form_field input[type="file"]').each(
							function()
								{
								set_email_tags += '<option value="{{'+ format_illegal_chars(jQuery(this).attr('name'))  +'}}">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
								}
							);	
						set_email_tags += '</optgroup>';
						
						set_email_tags += '<optgroup label="Hidden Fields">';
						jQuery('div.nex-forms-container div.form_field input[type="hidden"]').each(
							function()
								{
								set_email_tags += '<option value="{{'+ format_illegal_chars(jQuery(this).attr('name'))  +'}}">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
								}
							);	
						set_email_tags += jQuery('.hidden_form_fields').html()
						set_email_tags += '</optgroup>';
						
						
						set_email_tags += '<optgroup label="More Tags">';
						set_email_tags += '<option value="{{nf_form_data}}">Form Data Table</option>';
						set_email_tags += '<option value="{{nf_user_ip}}">IP Address</option>';
						set_email_tags += '<option value="{{nf_from_page}}">Page Title</option>';
						set_email_tags += '<option value="{{nf_form_title}}">Form Title</option>';
						set_email_tags += '<option value="{{nf_user_name}}">User Name</option>';
						
					
						
						set_email_tags += '</optgroup>';
						
						
						
					jQuery('select[name="email_field_tags"], select[name="user_email_field_tags"]').html(set_email_tags);
						
	}
function setup_field_settings(field_obj){
	//console.log('ran ' + field_obj.attr('class'));
	if(field_obj.hasClass('icon-select-group'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .icon-select-group').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .icon-select-group').attr('data-settings'));
		}
	if(field_obj.hasClass('digital-signature'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .digital-signature').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .digital-signature').attr('data-settings'));
		}
	if(field_obj.hasClass('preset_fields'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .preset_fields.name').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .preset_fields.name').attr('data-settings'));
		}
	if(field_obj.hasClass('textarea'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .textarea.common_fields').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .textarea.common_fields').attr('data-settings'));
		}
	if(field_obj.hasClass('text'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .text').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .text').attr('data-settings'));
		}
	if(field_obj.hasClass('password'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .password').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .password').attr('data-settings'));
		}
	if(field_obj.hasClass('select'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .select').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .select').attr('data-settings'));
		}
	if(field_obj.hasClass('multi-select'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .multi-select').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .multi-select').attr('data-settings'));
		}
	if(field_obj.hasClass('radio-group') || field_obj.hasClass('md-radio-group'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .radio-group').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .radio-group').attr('data-settings'));
		}
	if(field_obj.hasClass('check-group') || field_obj.hasClass('md-check-group'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .check-group').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .check-group').attr('data-settings'));
		}
	if(field_obj.hasClass('single-image-select-group'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .single-image-select-group').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .single-image-select-group').attr('data-settings'));
		}
	if(field_obj.hasClass('multi-image-select-group'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .multi-image-select-group').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .multi-image-select-group').attr('data-settings'));
		}
	if(field_obj.hasClass('slider') || field_obj.hasClass('md-slider'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .slider').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .slider').attr('data-settings'));
		}
	if(field_obj.hasClass('touch_spinner'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .touch_spinner').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .touch_spinner').attr('data-settings'));
		}
	if(field_obj.hasClass('autocomplete'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .autocomplete').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .autocomplete').attr('data-settings'));
		}	
	if(field_obj.hasClass('tags'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .tags').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .tags').attr('data-settings'));
		}
	if(field_obj.hasClass('date') || field_obj.hasClass('md-datepicker') || field_obj.hasClass('jq-datepicker'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .date').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .date').attr('data-settings'));
		}	
	if(field_obj.hasClass('time') || field_obj.hasClass('md-time-picker') || field_obj.hasClass('jq-time-picker'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .time').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .time').attr('data-settings'));
		}	
	if(field_obj.hasClass('star-rating'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .star-rating').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .star-rating').attr('data-settings'));
		}
	if(field_obj.hasClass('thumb-rating'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .thumb-rating').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .thumb-rating').attr('data-settings'));
		}	
	if(field_obj.hasClass('smily-rating'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .smily-rating').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .smily-rating').attr('data-settings'));
		}
	if(field_obj.hasClass('upload-multi'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .upload-multi').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .upload-multi').attr('data-settings'));
		}	
	if(field_obj.hasClass('upload-single'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .upload-single').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .upload-single').attr('data-settings'));
		}
	if(field_obj.hasClass('upload-image'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .upload-image').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .upload-image').attr('data-settings'));
		}
	if(field_obj.hasClass('submit-button') || field_obj.hasClass('submit-button-2'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .submit-button').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .submit-button').attr('data-settings'));
		}
	if(field_obj.hasClass('heading'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .heading').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .heading').attr('data-settings'));
		}
	if(field_obj.hasClass('math_logic'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .math_logic').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .math_logic').attr('data-settings'));
		}
	if(field_obj.hasClass('paragraph'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .paragraph').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .paragraph').attr('data-settings'));
		}
	if(field_obj.hasClass('html'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .html').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .html').attr('data-settings'));
		}
	if(field_obj.hasClass('divider'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .divider').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .divider').attr('data-settings'));
		}
	if(field_obj.hasClass('is_panel'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .is_panel').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .is_panel').attr('data-settings'));
		}
	if(field_obj.hasClass('grid-system'))
		{
		field_obj.attr('data-settings-tabs',jQuery('.field-selection-tools .grid-system').attr('data-settings-tabs'));
		field_obj.attr('data-settings',jQuery('.field-selection-tools .grid-system').attr('data-settings'));
		}
	
	
}