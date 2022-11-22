// JavaScript Document
'use strict';

function reset_logic_gui(){

		jQuery('.show-active-rule').removeClass('show-active-rule');
		jQuery('.over-connector').removeClass('over-connector');
		jQuery('.is_target').removeClass('is_target');
		jQuery('.is_arrow').removeClass('is_arrow');
		for(var i=0;i<1000;i++)
			jQuery('.connect_id_' + i).removeClass('connect_id_' + i);
		jQuery('.nex-forms-container .form_field').each(
			function(index)
				{
				jQuery('.for_rule_'+ jQuery(this).attr('id')).removeClass('for_rule_'+ jQuery(this).attr('id'));
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
					);
					
					jQuery(this).find('.get_rule_actions .the_rule_actions').each(
						function(index)
							{
							
							cl_actions_array.push(
								{
								target_field_Id: jQuery(this).find('select[name="cla_field"] option:selected').attr('data-field-id'),
								target_field_name: jQuery(this).find('select[name="cla_field"] option:selected').attr('data-field-name'),
								target_field_type: jQuery(this).find('select[name="cla_field"] option:selected').attr('data-field-type'),
								do_action: jQuery(this).find('select[name="the_action"]').val(),
								selected_value: jQuery(this).find('select[name="cla_field"]').attr('data-selected'),
								}
							);	
							
							}
						);
					
				
				
				cl_rule_array.push(
						{
						operator: jQuery(this).find('select[name="selector"]').val(),
						reverse_actions: jQuery(this).find('select[name="reverse_actions"] option:selected').val(),
						conditions: cl_conditions_array,
						actions: cl_actions_array
						}
					)
				
				}
			);	
				
				
			var data =
				{
				action	 							: 'get_c_logic_ui',
				conditional_logic_array				: cl_rule_array,
				}
			
			
			jQuery.post
				(
				ajaxurl, data, function(response)
					{
					jQuery('.adv_arrow').remove();
					jQuery('.adv_target').remove();
					jQuery('.cl_arrow').remove();
					jQuery('.con_logic_ui').html('');
					jQuery('.con_logic_ui').html(response);
					logic_interface();
					count_nf_conditions();
					//refresh_cl_fields();
					}
				);
	
}


function refresh_cl_fields(){
		jQuery('select[name="reloaded_fields"]').attr('name','fields_for_conditions');
			jQuery('select[name="cla_field"]').addClass('cla_field');	
				
			jQuery('.refresh_cl_fields').find('.fa').addClass('fa-spin');
			set_c_logic_fields();
			
			
			/*var set_step_selection = '<option value="0">-- Select Step --</option>';
				
				for(var i=1; i <= nf_count_multi_steps(); i++)
					set_step_selection += '<option value="'+ i +'">Step '+ i +'</option>';
				
				jQuery('.cl_current_action_fields_steps').html(set_step_selection);
			*/
			//jQuery('select[name="cla_steps"]').trigger('mouseover');
			jQuery('select[name="cla_field"]').trigger('mouseover');
			jQuery('select[name="fields_for_conditions"]').trigger('mouseover');
			
			jQuery('select[name="cla_field"]').trigger('mouseout');
			jQuery('select[name="fields_for_conditions"]').trigger('mouseout');
	
			setTimeout(function(){jQuery('.refresh_cl_fields').find('.fa').removeClass('fa-spin')},500);
			
		}
jQuery(document).ready(
function()
	{
	
	
	jQuery(document).on('change','select[name="the_action"]',
		function()
			{
			jQuery(this).parent().find('.changeable').removeClass('show_change_value');
			jQuery(this).closest('.input-group').removeClass('steps_only');
			jQuery(this).parent().parent().find('.show_change_value_to').addClass('hidden');
			
			jQuery(this).parent().find('.cl_current_action_fields_container').removeClass('hidden');
			//jQuery(this).parent().parent().find('.cl_current_action_fields_steps').addClass('hidden');
			
			console.log(jQuery(this).val());
			if(jQuery(this).val()=='change_value')
				{	
				jQuery(this).parent().find('.changeable').addClass('show_change_value');
				jQuery(this).parent().parent().find('.show_change_value_to').removeClass('hidden');
				}
			if(jQuery(this).val()=='skip_to')
				{	
				jQuery(this).closest('.input-group').addClass('steps_only'); ;
				
				/*jQuery(this).parent().find('.cl_current_action_fields_container').addClass('hidden');
				jQuery(this).parent().parent().find('.cl_current_action_fields_steps').removeClass('hidden');
				
				var set_step_selection = '<option value="0">-- Select Step --</option>';
				
				for(var i=1; i <= nf_count_multi_steps(); i++)
					set_step_selection += '<option value="'+ i +'">Step '+ i +'</option>';
				
				jQuery(this).parent().parent().find('.cl_current_action_fields_steps').html(set_step_selection);
				*/
				}
			}
		);
	
	jQuery('.set_rules select').change
	
	jQuery(document).on('change','.set_rules select, .set_rules input',
		function()
			{ 
			reset_logic_gui();
			}
		);
	
	setTimeout(function(){ refresh_cl_fields() }, 3000);
	//setTimeout(function(){ reset_logic_gui() }, 3500);
	//reset_logic_gui();	
	
	/*jQuery(document).on('mouseover','select[name="cla_steps"]',
		function()
			{ 
			
			var set_step_selection = '<option value="0">-- Select Step --</option>';
				
				for(var i=1; i <= nf_count_multi_steps(); i++)
					set_step_selection += '<option data-field-id="'+ jQuery('.nf_multi_step_'+i).attr('id') +'" data-field-name="'+ jQuery('.nf_multi_step_'+i).attr('id') +'" data-field-type="step" value="'+ jQuery('.nf_multi_step_'+i).attr('id') +'**step##' + i + '">Step '+ i +'</option>';
				
				jQuery('.cl_current_action_fields_steps').html(set_step_selection);
			
			//set_c_logic_fields();
			 var select_clone = '';
			var the_select = jQuery(this);
			var get_selected = the_select.attr('data-selected')
			jQuery('select[name="cla_steps"] option').each(
				function()
					{	
					if(jQuery(this).val()==get_selected)
						jQuery(this).attr('selected',true);
					else
						jQuery(this).attr('selected',false);
					}
				);
			jQuery('select[name="cla_steps"] option:selected').trigger('click');
			}
		);*/
		
	jQuery(document).on('mouseover','select[name="fields_for_conditions"]',
		function()
			{ 
			//set_c_logic_fields();
			 var select_clone = '';
			var the_select = jQuery(this);
			var get_selected = (the_select.attr('data-selected')) ? the_select.attr('data-selected') : '0';
			jQuery('select[name="cl_current_fields_container"] option').each(
				function()
					{	
					if(jQuery(this).val()==get_selected)
						jQuery(this).attr('selected',true);
					else
						jQuery(this).attr('selected',false);
					}
				);
			jQuery('select[name="cl_current_fields_container"] option:selected').trigger('click');
			select_clone = jQuery('select[name="cl_current_fields_container"]').clone();
			select_clone.removeClass('hidden').addClass('form-control').addClass('cl_field')
			select_clone.attr('name','reloaded_fields');
			select_clone.attr('data-selected',get_selected)
			the_select.after(select_clone);
			the_select.remove();
			}
		);
	jQuery(document).on('mouseover','.cla_field',
		function()
			{
			
			 var select_clone = '';
			var the_select = jQuery(this);
			var get_selected = (the_select.attr('data-selected')) ? the_select.attr('data-selected') : '0';
			jQuery('select[name="cl_current_action_fields_container"] option').each(
				function()
					{
					if(jQuery(this).val()==get_selected)
						jQuery(this).attr('selected',true);
					else
						jQuery(this).attr('selected',false);
					}
				);
			jQuery('select[name="cl_current_action_fields_container"] option:selected').trigger('click');
			select_clone = jQuery('select[name="cl_current_action_fields_container"]').clone();
			
				select_clone.removeClass('hidden');
				
			select_clone.addClass('form-control')
			select_clone.attr('name','cla_field');
			select_clone.attr('data-selected',get_selected)
			the_select.after(select_clone);
			the_select.remove();
			}
		);
	
	
	
	jQuery(document).on('click','.refresh_cl_fields',
		function()
			{
			refresh_cl_fields();
			}
		);
	
	jQuery(document).on('click','.conditional-logic-btn',
		function()
			{
			
			jQuery('.nex-forms-container .form_field').each(
			function(index)
				{
				if(jQuery(this).hasClass('icon-select-group'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-check-double"></span>')
				if(jQuery(this).hasClass('digital-signature'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-file-signature"></span>')
				if(jQuery(this).hasClass('name'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-user"></span>')
				if(jQuery(this).hasClass('email'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-envelope"></span>')
				if(jQuery(this).hasClass('phone_number'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-phone"></span>')
				if(jQuery(this).hasClass('url'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-link"></span>')
				if(jQuery(this).hasClass('Query'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-comment"></span>')
				if(jQuery(this).hasClass('text'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-text-width"></span>')
				if(jQuery(this).hasClass('textarea'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-text-height"></span>')
				if(jQuery(this).hasClass('password'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-key"></span>')
				if(jQuery(this).hasClass('select'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-list-ul"></span>')
				if(jQuery(this).hasClass('multi-select'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-tasks"></span>')
				if(jQuery(this).hasClass('radio-group'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-dot-circle-o"></span>')
				if(jQuery(this).hasClass('check-group'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-check-square-o"></span>')
				if(jQuery(this).hasClass('image-choices-field'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-image"></span>')
				if(jQuery(this).hasClass('slider'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-sliders-h"></span>')
				if(jQuery(this).hasClass('touch_spinner'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-sort"></span>')
				if(jQuery(this).hasClass('autocomplete'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-pencil"></span>')
				if(jQuery(this).hasClass('tags'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-tag"></span>')
				if(jQuery(this).hasClass('date'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-calendar-o"></span>')
				if(jQuery(this).hasClass('time'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-clock-o"></span>')
				if(jQuery(this).hasClass('star-rating'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-star"></span>')
				if(jQuery(this).hasClass('thumb-rating'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-thumbs-up"></span>')
				if(jQuery(this).hasClass('smily-rating'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-smile-o"></span>')
				if(jQuery(this).hasClass('upload-multi'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-reply-all"></span>')
				if(jQuery(this).hasClass('upload-single'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-reply"></span>')
				if(jQuery(this).hasClass('upload-image'))
					jQuery(this).prepend('<span class="c_logic_field_type fas fa-file-image"></span>')
				if(jQuery(this).hasClass('submit-button'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-send"></span>')
				if(jQuery(this).hasClass('heading'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-header"></span>');
				if(jQuery(this).hasClass('math_logic'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-calculator"></span>');
				if(jQuery(this).hasClass('html_image'))
					jQuery(this).prepend('<span class="c_logic_field_type far fa-image"></span>');
				if(jQuery(this).hasClass('paragraph'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-align-justify"></span>');
				if(jQuery(this).hasClass('html'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-code"></span>');
				if(jQuery(this).hasClass('is_panel'))
					jQuery(this).prepend('<span class="c_logic_field_type fa fa-window-maximize"></span>');
				}
			);
			
			//jQuery('select[name="cla_field"]').select2();
			//jQuery('select[name="fields_for_conditions"]').select2();
			
			
			
			
			if(jQuery(this).hasClass('active'))
				{
				jQuery('.conditional_logic_wrapper #close-settings').trigger('click');	
				}
			else
				{
				
				/*var data =
					{
					action	 						: 'get_c_logic_ui',
					form_Id							: jQuery('#form_update_id').text(),
					};	
				jQuery.post
					(
					ajaxurl, data, function(response)
						{
						jQuery('.adv_arrow').remove();
						jQuery('.adv_target').remove();
						jQuery('.cl_arrow').remove();
						jQuery('.con_logic_ui').html('');
						jQuery('.con_logic_ui').html(response);
						//logic_interface();
						count_nf_conditions();
						//refresh_cl_fields();
							
						}
					);
					
				*/		
				jQuery('.conditional_logic_wrapper').addClass('opened');
				jQuery('.conditional-logic-btn').addClass('active');
				jQuery('.form_canvas').addClass('conditional-logic-opened');
				jQuery('.nex_forms_admin_page_wrapper').addClass('conditional-logic-ui');
				jQuery('.overall-settings-column #close-settings').trigger('click');
				jQuery('.field-settings-column #close-settings').trigger('click');
				
				reset_logic_gui();
				}
			}
		);
	
	jQuery(document).on('click','.conditional_logic_wrapper #close-settings',
		function()
			{
			jQuery('.conditional-logic-btn').removeClass('active');
			jQuery('.conditional_logic_wrapper').removeClass('opened');
			jQuery('.form_canvas').removeClass('conditional-logic-opened');
			jQuery('.nex_forms_admin_page_wrapper').removeClass('conditional-logic-ui');
			jQuery('.c_logic_field_type').remove();
			jQuery('.conditional_logic_wrapper').removeClass('opened');
			}
		);
	
	reset_rule_complexity();
	setTimeout(function(){set_c_logic_fields()},1000);
	jQuery(document).on('change', '.cl_field, select[name="cla_field"]', function()
		{
		jQuery(this).attr('data-selected',jQuery(this).val());
		}
	);
	
	
	jQuery(document).on('change', 'input[name="adv_cl"]', function()
		{
		if(jQuery(this).prop('checked')==true)
			{
			jQuery('.conditional_logic').removeClass('simple_view').addClass('advanced_view');	
			}
		else
			{
			jQuery('.conditional_logic').addClass('simple_view').removeClass('advanced_view');
			
			var count1 = 0;
			var count2 = 0;
			
			reset_rule_complexity();
				
			}
		}
	);
	jQuery(document).on('click', '.add_new_rule', function()
		{
		var new_rule = jQuery('.conditional_logic_clonables .new_rule').clone();
		jQuery('.set_rules').append(new_rule);
		var radio_name =  Math.round(Math.random()*9999);
		
		new_rule.find('.set_rule_conditions').addClass('get_rule_conditions');
		new_rule.find('.set_rule_conditions').removeClass('set_rule_conditions');
		
		new_rule.find('.set_rule_actions').addClass('get_rule_actions');
		new_rule.find('.set_rule_actions').removeClass('set_rule_actions');
		
		new_rule.find('input[type="radio"]').attr('name',radio_name);
		
		
		new_rule.find('select.cl_field').val('0');
		new_rule.find('select[name="cla_field"]').val('0');
		

		jQuery('.conditional_logic_wrapper.settings-column-style .inner').animate(
					{
					scrollTop:10000
					},300
				);
		count_nf_conditions();
		}
	);

	jQuery(document).on('click', '.add_condition', function()
		{
		var new_condition = jQuery('.conditional_logic_clonables .set_rule_conditions').clone();
		
		//new_condition.removeClass('set_rule_conditions').addClass('the_rule_conditions');
		
		jQuery(this).parent().find('.get_rule_conditions').append(new_condition);
		}
	);

	
	jQuery(document).on('click', '.add_action', function()
		{
		var new_condition = jQuery('.conditional_logic_clonables .set_rule_actions').clone();
		//new_condition.removeClass('set_rule_actions').addClass('the_rule_actions');
		jQuery(this).parent().find('.get_rule_actions').append(new_condition);
		}
	);

	jQuery(document).on('click', '.delete_action, .delete_condition', function()
		{
		jQuery(this).parent().remove();
		
		reset_rule_complexity();
		reset_logic_gui();
		}
	);
	jQuery(document).on('click', '.delete_rule, .delete_simple_rule', function()
		{
		jQuery(this).closest('.new_rule').remove();
		reset_rule_complexity();
		reset_logic_gui();
		}
	);	
	
	jQuery(document).on('click', '.duplicate_simple_rule', function()
		{
		var the_rule = jQuery(this).closest('.new_rule');
		
		var the_clone = the_rule.clone();
		
		the_clone.insertAfter(the_rule);
		
		reset_rule_complexity();
		//reset_logic_gui();
		}
	);	
	
	
	
	jQuery(document).on('mouseenter','.adv_arrow, .avd_arrows_connector, .adv_target, .avd_targets_connector, .adv_connector, .avd_arrow_condition, .new_rule.advanced_view',function() {
	  var get_rule_connect_id = jQuery(this).attr('data-rule-id');
	  jQuery('.connect_id_'+get_rule_connect_id).addClass('over-connector');
	 
	});
	
	jQuery(document).on('mouseleave','.adv_arrow, .avd_arrows_connector, .adv_target, .avd_targets_connector, .adv_connector, .avd_arrow_condition, .new_rule.advanced_view',function() {
	  var get_rule_connect_id = jQuery(this).attr('data-rule-id');
	  jQuery('.connect_id_'+get_rule_connect_id).removeClass('over-connector');
	 
	});
	
	
	jQuery(document).on('mouseenter','.cl_arrow',function() {
		
		var rule_key = jQuery(this).attr('data-rule-key');
		
		//if(!jQuery('.conditional_logic_wrapper.settings-column-style .inner .for_rule_'+rule_key).is(':visible'))
			//{
		
			var get_offset =  jQuery('.conditional_logic_wrapper.settings-column-style .inner .for_rule_'+rule_key).attr('data-original-offset');
			var get_offset2 =  jQuery('.conditional_logic_wrapper.settings-column-style .inner').offset();
			var set_top = (get_offset - get_offset2.top);
			
			jQuery('.conditional_logic_wrapper.settings-column-style .inner').animate(
					{
					scrollTop:set_top
					},100
				);
			//}
	});
	
	
	
	jQuery(document).on('mouseenter','.adv_arrow, .avd_arrows_connector, .adv_target, .avd_targets_connector, .adv_connector, .avd_arrow_condition',function() {
		
		var rule_key = jQuery(this).attr('data-rule-key');
		
		//if(!jQuery('.conditional_logic_wrapper.settings-column-style .inner .for_rule_'+rule_key).is(':visible'))
			//{
			
			var get_rule_connect_id = jQuery(this).attr('data-rule-id');
	  		jQuery('.connect_id_'+get_rule_connect_id).addClass('over-connector');
			
			
			var get_offset =  jQuery('.conditional_logic_wrapper.settings-column-style .inner .connect_id_'+get_rule_connect_id).attr('data-original-offset');
			var get_offset2 =  jQuery('.conditional_logic_wrapper.settings-column-style .inner').offset();
			var set_top = (get_offset - get_offset2.top);
			
			jQuery('.conditional_logic_wrapper.settings-column-style .inner').animate(
					{
					scrollTop:set_top
					},100
				);
			//}
	});
	
	
	
	
	
	jQuery(document).on('mouseenter','.cl_arrow, .panel.new_rule',function() {
	  var rule_key = jQuery(this).attr('data-rule-key');
	  jQuery('.for_rule_'+rule_key).addClass('show-active-rule');
	  
	});
	jQuery(document).on('mouseleave','.cl_arrow, .panel.new_rule',function() {
	  var rule_key = jQuery(this).attr('data-rule-key');
	  jQuery('.for_rule_'+rule_key).removeClass('show-active-rule');
	});
	
	
	
});

function reset_rule_complexity(){
	jQuery('.set_rules .new_rule').each(
				function()
					{
					var count1 = jQuery(this).find('.delete_condition').size();
					var count2 = jQuery(this).find('.delete_action').size();
					
					if(count1>1 || count2>1)
						jQuery(this).addClass('advanced_view');
					else
						jQuery(this).removeClass('advanced_view');
					}
				);
	count_nf_conditions();
}

function count_nf_conditions(){
	jQuery('.set_rules .new_rule').each(
		function(index)
			{
			jQuery(this).find('.rule_number').text(index+1)
			var get_rule_connect_id = jQuery(this).find('select[name="cla_field"]').attr('data-selected');
			
			
			
			if(get_rule_connect_id)
				{
				var get_offset =  jQuery(this).offset();
				
				jQuery(this).attr('data-original-offset',get_offset.top);
				
				var set_rule_connect_id = get_rule_connect_id.split('**');
				
				jQuery(this).attr('data-rule-key',set_rule_connect_id[0]);
				jQuery(this).addClass('for_rule_'+set_rule_connect_id[0]);
				}
			}
		);
	
	
	jQuery('.set_rules .new_rule.advanced_view').each(
		function(index)
			{
			jQuery(this).attr('data-rule-id',(index+1));
			jQuery(this).addClass('connect_id_'+(index+1));
			
			
			var get_offset =  jQuery(this).offset();
			jQuery(this).attr('data-original-offset',get_offset.top);
			
			}
		);
	
	
}


function set_c_logic_fields(the_select){
	
	var set_current_fields_conditional_logic = '<option value="0">-- Fields --&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
	var set_current_action_fields_conditional_logic ='';
	set_current_fields_conditional_logic += '<optgroup label="Text Fields" class="cl_text_fields">';
	//SPACER
	set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
		function()
			{
			
			if(jQuery(this).attr('name')!='multi_step_name')
				{
				if(jQuery(this).attr('name') && jQuery(this).attr('name')!='undefined')
					{
					if(jQuery(this).closest('.form_field').hasClass('date'))
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="date" value="'+ jQuery(this).closest('.form_field').attr('id') +'**date##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'<br><br></option>';
					else if(jQuery(this).closest('.form_field').hasClass('datetime'))
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="datetime" value="'+ jQuery(this).closest('.form_field').attr('id') +'**datetime##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'<br><br></option>';
					else if(jQuery(this).closest('.form_field').hasClass('time'))
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="time"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**time##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'<br><br></option>';
					else if(jQuery(this).closest('.form_field').hasClass('star-rating'))
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="stars"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**hidden##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'<br><br></option>';
					else
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="text"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**text##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'<br><br></option>';
				
					//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
					}
				
				}
			}
		);	
	jQuery('div.nex-forms-container div.form_field input[type="password"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="hidden"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**password##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				//SPACER
				set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_fields_conditional_logic += '<optgroup label="Radio Buttons" class="cl_radios">';
	//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	var old_radio = '';
	var new_radio = '';
	
	jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				old_radio = jQuery(this).attr('name');
				if(old_radio != new_radio){
					set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="radio"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**radio##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
					//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
				}
				new_radio = old_radio;
				
				}
			
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	var old_check = '';
	var new_check = '';
	set_current_fields_conditional_logic += '<optgroup label="Check Boxes" class="cl_checks">';
	//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				old_check = jQuery(this).attr('name');
				if(old_check != new_check)
					{
					set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="checkbox"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**checkbox##'+ jQuery(this).attr('name')  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
					//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
					}
				new_check = old_check;
				
				
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_fields_conditional_logic += '<optgroup label="Selects" class="cl_selects">';
	//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field select').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="select"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**select##'+ jQuery(this).attr('name')  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				
				//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_fields_conditional_logic += '<optgroup label="Text Areas" class="cl_textareas">';
	//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field textarea').each(
		function()
			{
			set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="textarea"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**textarea##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
			//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	
	set_current_fields_conditional_logic += '<optgroup label="File Uploaders" class="cl_uploaders">';
	//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field input[type="file"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="file"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**file##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_fields_conditional_logic += '<optgroup label="Hidden Fields" class="cl_hidden">';
	//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	
	jQuery('.hidden_fields_setup .hidden_fields .hidden_field').each(
		function()
			{
			set_current_fields_conditional_logic += '<option data-field-id="hidden_field" data-field-name="'+ format_illegal_chars(jQuery(this).find('.hidden_field_name').val())  +'" data-field-type="hidden"  value="hidden_field**hidden##'+ format_illegal_chars(jQuery(this).find('.hidden_field_name').val())  +'">'+ unformat_name(jQuery(this).find('.hidden_field_name').val()) +'</option>';
			//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
			}
		);	
	
	
	
	jQuery('div.nex-forms-container div.form_field input[type="hidden"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined' && jQuery(this).attr('name')!='math_result')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="hidden"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**hidden##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	
	/*set_current_fields_conditional_logic += '<optgroup label="Password Fields" class="cl_radios">';
	jQuery('div.nex-forms-container div.form_field input[type="password"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="hidden"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**password##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';*/
	
	
	set_current_fields_conditional_logic += '<optgroup label="Math Fields" class="cl_math">';
	//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field input.set_math_result').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="hidden"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**text##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				//SPACER
					set_current_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_action_fields_conditional_logic += '<optgroup label="Buttons" class="cl_buttons">';
	//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field.button_fields').each(
		function()
			{
			//if(jQuery(this).find('.the_input_element').hasClass('nex-submit'))
				//set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).find('.the_input_element').text())  +'" data-field-type="button"  value="'+ jQuery(this).attr('id') +'**button##button">'+ jQuery(this).find('.the_input_element').text() +'</option>';
			//else
			var button_step = '';
			var button_type = ' [-] ';
			if(jQuery(this).closest('.step').attr('class')!='')
				button_step = jQuery(this).closest('.step').find('input[name="multi_step_name"]').val() +' - ';
			
			if(jQuery(this).find('.the_input_element').hasClass('nex-step'))
				button_type = ' [>] ';
			if(jQuery(this).find('.the_input_element').hasClass('prev-step'))
				button_type = ' [<] ';
			
			set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).find('.the_input_element').text())  +'" data-field-type="button"  value="'+ jQuery(this).attr('id') +'**button##button">'+ button_step + button_type + jQuery(this).find('.the_input_element').text() +'</option>';
			//SPACER
			set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
			}
		);	
	set_current_action_fields_conditional_logic += '</optgroup>';
	
	set_current_action_fields_conditional_logic += '<optgroup label="Panels" class="cl_panels">';
	//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field.is_panel').each(
		function()
			{
			set_current_action_fields_conditional_logic += '<option  data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="panel" data-field-type="panel"   value="'+ jQuery(this).attr('id') +'**panel##panel">'+ short_str(jQuery(this).find('.panel-heading').text()) +'</option>';
			//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
			}
		);	
	set_current_action_fields_conditional_logic += '</optgroup>';
	
	set_current_action_fields_conditional_logic += '<optgroup label="Headings" class="cl_headings">';
	//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field.heading').each(
		function()
			{
			set_current_action_fields_conditional_logic += '<option   data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="heading" data-field-type="heading"   value="'+ jQuery(this).attr('id') +'**heading##heading">'+ short_str(jQuery(this).find('.the_input_element').text()) +'</option>';
			//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
			}
		);	
	set_current_action_fields_conditional_logic += '</optgroup>';
	
	set_current_action_fields_conditional_logic += '<optgroup label="Images" class="cl_images">';
	//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field.html_image').each(
		function()
			{
			var image = jQuery(this).find('img');
			if(image.length>0 && image.attr('alt'))
				set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="html" data-field-type="html"  value="'+ jQuery(this).attr('id') +'**image##html">'+ short_str(jQuery(this).find('img').attr('alt')) +'</option>';
			//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
			}
		);	
	set_current_action_fields_conditional_logic += '</optgroup>';
	
	set_current_action_fields_conditional_logic += '<optgroup label="HTML/Paragraphs" class="cl_paragraphs">';
	//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field.html').each(
		function()
			{
			set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="html" data-field-type="html"  value="'+ jQuery(this).attr('id') +'**paragraph##html">'+ short_str(jQuery(this).find('.the_input_element').text()) +'</option>';
			//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
			}
		);	
	jQuery('div.nex-forms-container div.form_field.paragraph').each(
		function()
			{
			set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="paragraph" data-field-type="paragraph" value="'+ jQuery(this).attr('id') +'**heading##html">'+ short_str(jQuery(this).find('.the_input_element').text()) +'</option>';
			//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
			}
		);	
	set_current_action_fields_conditional_logic += '</optgroup>';

	
	
	
	
	
	set_current_action_fields_conditional_logic += '<optgroup label="Steps" class="cl_steps">';
	//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
	jQuery('div.nex-forms-container div.form_field.step').each(
		function(index)
			{
			set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ jQuery(this).attr('data-step-num') +'" data-field-type="step"  value="'+ jQuery(this).attr('id') +'**' + jQuery(this).attr('data-step-num') + '##step">Step '+ (index+1) +' ('+ short_str(jQuery(this).find('input[name="multi_step_name"]').val()) +')</option>';
			//SPACER
					set_current_action_fields_conditional_logic += '<option class="option_spacer" disabled="disabled">&nbsp;</option>';
			}
		);		
	set_current_action_fields_conditional_logic += '</optgroup>';
		
	

jQuery('select[name="cl_current_fields_container"]').html(set_current_fields_conditional_logic);
jQuery('select[name="cl_current_action_fields_container"]').html(set_current_fields_conditional_logic + set_current_action_fields_conditional_logic);
}




function logic_interface(){
		
		
		jQuery('.is_target').removeClass('is_target');
		jQuery('.is_arrow').removeClass('is_arrow');
		for(var i=0;i<1000;i++)
			jQuery('.connect_id_' + i).removeClass('connect_id_' + i);
		jQuery('.nex-forms-container .form_field').each(
			function(index)
				{
				jQuery('.for_rule_'+ jQuery(this).attr('id')).removeClass('for_rule_'+ jQuery(this).attr('id'));
				}
			);
		
		
		var set_avd_width = 50;
		var set_right = 217;
		var set_right_panel = -48;
		
		var set_width = 88;
		var set_top = 16;
		var set_left = 100;
		var set_left_panel = -70;
		var set_zindex = 1000000;
		
		var set_top_offset = 0;
		var targets = '';
		var arrow = '';
		jQuery('.the_rule').each(
			function(index)
				{
				arrow = jQuery(this).attr('data-cl-arrow');
				
				targets = JSON.parse( jQuery(this).attr('data-cl-targets') )
				
				
				jQuery.each( targets, function( key, value ) {

					var element_1 = document.getElementById(''+arrow);
					var element_2 = document.getElementById(''+value['target_id']);
					var offset_1 = element_1.getBoundingClientRect();
					var offset_2 = element_2.getBoundingClientRect();
					
					var target_is_step = false;
					if(jQuery('#'+value['target_id']).hasClass('step'))
						target_is_step = true;
					
					var height = (offset_2.top-offset_1.top)-(set_top_offset);
					
					
					if(target_is_step)
						height = height - 15;
					
					var build_arrow = '<div class="cl_arrow '+ ((target_is_step) ? 'step_rule' : '') +'  for_rule_'+ value['target_id']+' from'+ arrow +'" data-rule-key="'+ value['target_id'] +'" data-target="'+value['target_id']+'" style="width: '+ set_width +'px;left: '+ ((jQuery('#'+arrow).closest('.is_panel').attr('class')) ? set_left_panel : set_left)  +'px;top: '+ set_top +'px; height:'+height+'px; z-index:'+set_zindex+'; ">';
					
					var condition = '=';
					
					if(value['condition']=='equal_to')
						condition = '<span class="show_condition is_equal">Is Equal to</span>';
					if(value['condition']=='not_equal_to')
						condition = '<span class="show_condition not_equal">Is NOT Equal to</span>';
					if(value['condition']=='less_than')
						condition = '<span class="show_condition less_than">Is Less than</span>';
					if(value['condition']=='greater_than')
						condition = '<span class="show_condition greater_than">Is Greater than</span>';
					if(value['condition']=='less_equal')
						condition = '<span class="show_condition less_than_equal">Is Less than or Equal to</span>';
					if(value['condition']=='greater_equal')
						condition = '<span class="show_condition less_than_equal">Is Greater than or Equal to</span>';
					
					build_arrow += '<div class="arrow_condition for_rule_'+ value['target_id']+'" data-rule-key="'+ value['target_id'] +'">'+ condition +'<span class="show_value"> '+ ((value['condition_value']) ? value['condition_value'] : 'Empty' )+'</span></div>';
					
						if(value['action']=='show')        
							build_arrow += '<div class="target_action for_rule_'+ value['target_id']+'"><span class="target_action_icon fa fa-eye" title="Show" data-toggle="tooltip_bs" data-placement="top"></span></div>';
						if(value['action']=='hide')
							build_arrow += '<div class="target_action for_rule_'+ value['target_id']+'"><span class="target_action_icon fa fa-eye-slash" title="Hide" data-toggle="tooltip_bs" data-placement="top"></span></div>';
						
						if(value['action']=='enable')
							build_arrow += '<div class="target_action for_rule_'+ value['target_id']+'"><span class="target_action_icon fas fa-user-edit" title="Enable" data-toggle="tooltip_bs" data-placement="top"></span></div>';
						if(value['action']=='disable')
							build_arrow += '<div class="target_action for_rule_'+ value['target_id']+'"><span class="target_action_icon fas fa-user-slash" title="Disable" data-toggle="tooltip_bs" data-placement="top"></span></div>';	
						
						
						if(value['action']=='change_value')
							build_arrow += '<div class="target_action for_rule_'+ value['target_id']+'"><span class="target_action_icon fas fa-exchange-alt" title="Change Value" data-toggle="tooltip_bs" data-placement="top"></span></div>';
							
						if(value['action']=='skip_to')
							build_arrow += '<div class="target_action for_rule_'+ value['target_id']+'"><span class="target_action_icon fas fa-fast-forward" title="Skip to Step" data-toggle="tooltip_bs" data-placement="top"></span></div>';
						
						build_arrow += '<span class="arrow_start fa fa-caret-left animated  infinite for_rule_'+ value['target_id']+'"></span>';
						build_arrow += '<span class="arrow_end fa fa-caret-right animated  infinite for_rule_'+ value['target_id']+'"></span>';
						
						//build_arrow += '<span class="arrow_end fa fa-caret-right animated slideInLeft infinite"></span>';
						
						build_arrow += '</div>';
					
					jQuery('#'+arrow).append(build_arrow);
					
					
					jQuery('#'+arrow).addClass('is_arrow');
					jQuery('#'+arrow).addClass('for_rule_'+ value['target_id']);
					
					jQuery('#'+value['target_id']).addClass('is_target');
					jQuery('#'+value['target_id']).addClass('for_rule_'+ value['target_id']);
					
					
					
					 
					 set_width += 5;
					 set_left -= 5;
					 set_left_panel -= 5;
					 set_zindex  -= 10;
					});

				}
			);
		
		
		
		jQuery('.the_adv_rule').each(
			function(index)
				{
				var rule_id = jQuery(this).attr('data-adv-id');
				
				targets = JSON.parse( jQuery(this).attr('data-cl-targets') )
				
				
					
					
				jQuery.each( targets['arrows'], function( key, value ) {
					
					
					var build_avd_arrow = '<div data-rule-id="'+ rule_id +'" id="' + rule_id + value['arrow_id'] + '" class="connect_id_' + rule_id +' adv_arrow rule_id_'+rule_id+'" style="width: '+ (set_avd_width+(rule_id*5)+5) +'px;right: '+ ((jQuery('#'+value['arrow_id']).closest('.is_panel').attr('class')) ? (set_right_panel+(rule_id*5)) : (set_right+(rule_id*5)))  +'px;top: '+ set_top +'px; height:1px">';
					
				
					var condition = '=';
						
						if(value['condition']=='equal_to')
							condition = '<span class="show_condition is_equal">Is Equal to</span>';
						if(value['condition']=='not_equal_to')
							condition = '<span class="show_condition not_equal">Is NOT Equal to</span>';
						if(value['condition']=='less_than')
							condition = '<span class="show_condition less_than">Is Less than</span>';
						if(value['condition']=='greater_than')
							condition = '<span class="show_condition greater_than">Is Greater than</span>';
						if(value['condition']=='less_equal')
							condition = '<span class="show_condition less_than_equal">Is Less than or Equal to</span>';
						if(value['condition']=='greater_equal')
							condition = '<span class="show_condition less_than_equal">Is Greater than or Equal to</span>';
						
						build_avd_arrow += '<div class="avd_arrow_condition" data-operator="'+ targets['operator'] +'">'+ condition +'  <span class="show_value">'+ ((value['condition_value']) ? value['condition_value'] : 'Empty' )+'</span></div>';	
						
						build_avd_arrow += '<span class="avd_arrow_start fa fa-caret-right animated  infinite"></span>';
						build_avd_arrow += '</div>';
					
					jQuery('#'+value['arrow_id']).addClass('is_arrow');
					jQuery('#'+value['arrow_id']).append(build_avd_arrow).addClass('connect_id_' + rule_id);

					});
					
				jQuery.each( targets['targets'], function( key, value ) {
						
						
						var target_is_step = false;
						if(jQuery('#'+value['target_id']).hasClass('step'))
							target_is_step = true;
						
						var build_avd_target = '<div data-rule-id="'+ rule_id +'" id="' + rule_id + value['target_id'] + '" class="connect_id_' + rule_id +' '+ ((target_is_step) ? 'avd_step_rule' : '') +' adv_target rule_id_'+rule_id+'" style="width: 300px;right: '+ ((jQuery('#'+value['target_id']).closest('.is_panel').attr('class')) ? (set_right_panel+(rule_id*5)) : (set_right+(rule_id*5))) +'px;top: '+ set_top +'px; height:1px">';
						
						
						if(value['action']=='show')
							build_avd_target += '<div class="avd_target_action"><span class="target_action_icon fa fa-eye" title="Show" data-toggle="tooltip_bs" data-placement="top"></span></div>';
						if(value['action']=='hide')
							build_avd_target += '<div class="avd_target_action"><span class="target_action_icon fa fa-eye-slash" title="Hide" data-toggle="tooltip_bs" data-placement="top"></span></div>';
						
						if(value['action']=='enable')
							build_avd_target += '<div class="avd_target_action"><span class="target_action_icon fas fa-user-edit" title="Enable" data-toggle="tooltip_bs" data-placement="top"></span></div>';
						if(value['action']=='disable')
							build_avd_target += '<div class="avd_target_action"><span class="target_action_icon fas fa-user-slash" title="Disable" data-toggle="tooltip_bs" data-placement="top"></span></div>';
						
						if(value['action']=='change_value')
							build_arrow += '<div class="target_action for_rule_'+ value['target_id']+'"><span class="target_action_icon fas fa-exchange-alt" title="Change Value" data-toggle="tooltip_bs" data-placement="top"></span></div>';
							
						if(value['action']=='skip_to')
							build_arrow += '<div class="target_action for_rule_'+ value['target_id']+'"><span class="target_action_icon fas fa-fast-forward" title="Skip to Step" data-toggle="tooltip_bs" data-placement="top"></span></div>';
						
						
						build_avd_target += '</div>';
						
						jQuery('#'+value['target_id']).addClass('is_target');
						jQuery('#'+value['target_id']).append(build_avd_target).addClass('connect_id_' + rule_id);
					});
				set_avd_width += 15;
				
				}
			);	
		
		
		jQuery('.the_adv_rule').each(
			function(index)
				{
				var rule_id = jQuery(this).attr('data-adv-id');
				
				
				
				
				var id_1 = jQuery('.adv_arrow.rule_id_'+rule_id).first().attr('id');
				var id_2 = jQuery('.adv_arrow.rule_id_'+rule_id).last().attr('id');
				
				var element_1 = document.getElementById(''+id_1);
				var element_2 = document.getElementById(''+id_2);
				
				var offset_1 = element_1.getBoundingClientRect();
				var offset_2 = element_2.getBoundingClientRect();
				
				var arrows_height = (offset_2.top-offset_1.top);
				
				
				jQuery('#'+id_1).append('<div data-rule-id="'+ rule_id +'" class="connect_id_' + rule_id +' avd_arrows_connector" id="avd_arrows_connector_'+ rule_id +'" style="width: 1px;right: 0px;top: 0px; height:'+arrows_height+'px"></div>');
				
				
				
				var id_3 = jQuery('.adv_target.rule_id_'+rule_id).first().attr('id');
				var id_4 = jQuery('.adv_target.rule_id_'+rule_id).last().attr('id');
				
				var element_3 = document.getElementById(''+id_3);
				var element_4 = document.getElementById(''+id_4);
				
				var offset_3 = element_3.getBoundingClientRect();
				var offset_4 = element_4.getBoundingClientRect();
				
				var targets_height = (offset_4.top-offset_3.top);
				
				
				jQuery('#'+id_3).append('<div data-rule-id="'+ rule_id +'" class="connect_id_' + rule_id +' avd_targets_connector" id="avd_targets_connector_'+ rule_id +'" style="width: 1px;right: 0px;top: 0px; height:'+targets_height+'px"></div>');
				
				
				
				var id_5 = jQuery('#avd_arrows_connector_'+rule_id).attr('id');
				var id_6 = jQuery('#avd_targets_connector_'+rule_id).attr('id');
				
				var element_5 = document.getElementById(''+id_5);
				var element_6 = document.getElementById(''+id_6);
				
				var offset_5 = element_5.getBoundingClientRect();
				var offset_6 = element_6.getBoundingClientRect();
				
				var adv_connector_height = ((offset_6.top-(arrows_height/2)+(targets_height/2))-(offset_5.top))+1;
				
				var set_operator = jQuery('#'+id_1).find('.avd_arrow_condition').attr('data-operator');

				jQuery('#'+id_1).append('<div data-rule-id="'+ rule_id +'" class="connect_id_' + rule_id +' avd_connector" id="avd_connector_'+ rule_id +'" style="width: 30px;right: -30px;top: '+((arrows_height/2)-1)+'px; height:'+adv_connector_height+'px"><div class="adv_rule_operator">'+ set_operator +'</div></div>');
				
				}
			);
		
		
		
		/*jQuery('[data-toggle="tooltip_bs"]').tooltip_bs(
			{
			delay: 0,
			html:true
			}
		);*/
		
		}