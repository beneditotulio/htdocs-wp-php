// JavaScript Document
/* SET FIELD NAMES TO STANDARD FORMAT */
'use strict';
//IMPORT FORM
jQuery(document).ready(
function()
	{
	
	
	
		jQuery( document ).on( 'click', '.dismiss_nf_notice .notice-dismiss, .dismiss_nf_notice button', function() {
			var data = {
					action: 'dismiss_nf_notice',
			};
			
				jQuery(this).closest('.notice').remove();
				
			jQuery.post( ajaxurl, data, function() {
				
			});
		})
	
		
		
	jQuery(document).on('click','.new-form-sidebar a',
			function()
				{
				jQuery('.new-form-sidebar li').removeClass('active');
				jQuery(this).parent().addClass('active');
				
				jQuery('.new-form-panel').removeClass('active');
				jQuery('.new-form-panel.'+jQuery(this).attr('data-panel')).addClass('active');
				}
			);
	
	
	
		
		
	
		
		jQuery(document).on('click','.load_template',
			function()
				{
				var data =
					{
					action	 						: 'load_template',
					template						: jQuery(this).attr('data-template-name'),
					};
				jQuery.post
					(
					ajaxurl, data, function(response)
						{
						jQuery('.new-form-panel').removeClass('active');
						jQuery('.new-form-panel.ajax_loading').addClass('active');
						var url = jQuery('.admin_url').text() + 'admin.php?page=nex-forms-builder&open_form=' + response;
						jQuery(location).attr('href',url);
						}
					);
				}
			);
		
		
	jQuery(document).on('click','#upload_form,#upload_form2',
			function()
				{
				jQuery('input[name="form_html"]').trigger('click');
				}
			);
		
	jQuery(document).on('change','input[name="form_html"]',
			function()
				{
				jQuery('#import_form').submit();
				jQuery('input[name="form_name"]').val('');
				jQuery('#nex-forms #form_update_id').text('');
				jQuery('.nex-forms-container').html('');
				jQuery('.open-form').removeClass('active');	
				jQuery('.center_panel').hide();
				}
		)
	if(typeof jQuery({}).ajaxForm == 'function')
		{
		jQuery('#import_form').ajaxForm({
			data: {
			   action: 'do_form_import'
			},
			beforeSubmit: function(formData, jqForm, options) {
				jQuery('div.nex-forms-container').html('<div class="loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
				
				jQuery('.new-form-panel').removeClass('active');
				jQuery('.new-form-panel.ajax_loading').addClass('active');
			},
		   success : function(responseText, statusText, xhr, $form) {
			   	
				//console.log(responseText);
					if(!responseText || responseText=='0' || responseText==0)
						{
						jQuery('.ajax_error_response').addClass('active');
						}
					else
						{
						var url = jQuery('.admin_url').text() + 'admin.php?page=nex-forms-builder&open_form=' + responseText;
						jQuery(location).attr('href',url);
						}
					
			},
			 error: function(jqXHR, textStatus, errorThrown)
				{
				console.log(errorThrown)
				}
		});	
		}
	if(typeof jQuery({}).ajaxForm == 'function')
		{
		jQuery('#manual_import_form').ajaxForm({
				data: {
				   action: 'do_form_import',
				   import_type: 'manual'
				},
				beforeSubmit: function(formData, jqForm, options) {
					jQuery('.new-form-panel').removeClass('active');
					jQuery('.new-form-panel.ajax_loading').addClass('active');
				},
			   success : function(responseText, statusText, xhr, $form) {
					
					if(!responseText || responseText=='0' || responseText==0)
						{
						jQuery('.ajax_error_response').addClass('active');
						}
					else
						{
						var url = jQuery('.admin_url').text() + 'admin.php?page=nex-forms-builder&open_form=' + responseText;
						jQuery(location).attr('href',url);
						}
					
				},
				 error: function(jqXHR, textStatus, errorThrown)
					{
					console.log(errorThrown)
					}
			});	
		}
	if(typeof jQuery({}).ajaxForm == 'function')
		{
		jQuery('#new_nex_form').ajaxForm({
				data: {
				   action: 'nf_insert_record',
				   table: 'wap_nex_forms',
				   is_form: 1,
				   is_template: 0
				},
				beforeSubmit: function(formData, jqForm, options) {
					jQuery('.new-form-panel').removeClass('active');
					jQuery('.new-form-panel.ajax_loading').addClass('active');
				},
			   success : function(responseText, statusText, xhr, $form) {
				  
				 jQuery(location).attr('href',jQuery('#siteurl').text()+'/wp-admin/admin.php?page=nex-forms-builder&open_form=' + responseText)
				},
				 error: function(jqXHR, textStatus, errorThrown)
					{
					console.log(errorThrown)
					}
			});	
		}
	jQuery(document).on('click','.create_new_form',
		function()
			{
			jQuery('#new_form_setup').modal('open');
			}
		);
	
	
	/*jQuery(document).on('click','.add-new-column',
		function()
			{
				var column = jQuery(this).closest('.grid_input_holder');
				var column_clone = column.clone();
				var panel = column_clone.find('.panel-body');
				panel.html('');
				
				create_droppable(panel)
				
				column_clone.insertAfter(column);
				
		
			}
		);*/
	jQuery(document).on('click','.add-new-column',
		function()
			{
				
		
				var grid = jQuery(this).closest('.form_field');
				var grid_class = '.id-'+grid.attr('id');
				var column = jQuery(this).closest('.grid_input_holder'+grid_class);
				var column_width = parseInt(column.attr('data-grid-width'));
				var column_class = 'sm';
				
				
				
				
				if(strstr(column.attr('class'),'-xs-'))
					column_class = 'xs';
				if(strstr(column.attr('class'),'-md-'))
					column_class = 'md';
				if(strstr(column.attr('class'),'-lg-'))
					column_class = 'lg';
					
					
				var largest_grid = '';
				var largest_grid_size = 1;
				var current_largest_grid = 0;
				var prev_largest_grid = 0;
				var get_grid_total =0;
				
				grid.find('.grid_input_holder'+grid_class).each(
					function()
						{
						current_largest_grid = parseInt(jQuery(this).attr('data-grid-width'));
						if(current_largest_grid > prev_largest_grid)
							{	
							largest_grid_size = current_largest_grid;	
							prev_largest_grid = current_largest_grid;
							}
						get_grid_total += parseInt(jQuery(this).attr('data-grid-width'));
						}
					);
				
				if(largest_grid_size>1)
					{
					if(column_width==1)
						{
							var column_clone = column.clone();
							var panel = column_clone.find('.panel-body');
							var set_size = largest_grid_size-1;
							largest_grid = grid.find('.grid_input_holder.col-'+column_class+'-'+largest_grid_size+grid_class).first();
							

							if(set_size==1)
								set_size = '1';
							for(var i=0;i<=12;i++)
								largest_grid.removeClass('col-'+column_class+'-'+i);
								
							
								largest_grid.addClass('col-'+column_class+'-'+set_size);
								largest_grid.attr('data-grid-width',set_size);
							
							column_clone.addClass('col-'+column_class+'-1');
							column_clone.attr('data-grid-width','1');
		
							if(jQuery(this).hasClass('blank-column'))
								panel.html('');
							
							//create_droppable(panel)
							column_clone.insertAfter(column);
							
							nf_setup_grid(grid);
							grid.find('.grid').each(
								function()
									{
									nf_setup_grid(jQuery(this));	
									}
								);
							
							
				
						}
					else
						{
					
						for(var i=0;i<=12;i++)
							column.removeClass('col-'+column_class+'-'+i);
						
					
					
						var column_clone = column.clone();
						var panel = column_clone.find('.panel-body');
						
						
					
						if((column_width-1)>0)
							{
							column.addClass('col-'+column_class+'-'+(column_width-1));
							column.attr('data-grid-width',(column_width-1))
							}
						else
							{
							column.addClass('col-'+column_class+'-1');
							column.attr('data-grid-width','1')	
							}
							
						column_clone.addClass('col-'+column_class+'-1');
						column_clone.attr('data-grid-width','1');
	
						if(jQuery(this).hasClass('blank-column'))
							panel.html('');
						
						
						column_clone.insertAfter(column);
						
						nf_setup_grid(grid);
						grid.find('.grid').each(
							function()
								{
								nf_setup_grid(jQuery(this));	
								}
							);
						
						
			
						
						}
					}
					
						
				var panels = jQuery('.form_canvas .panel-body');
				create_droppable(panels)
				
				if(jQuery('.form-canvas-area').hasClass('split_view'))
					{
					setTimeout(function() {nf_save_nex_form('','preview', '') },300);
					}
					
				}
			
		);
	
	jQuery(document).on('click','.delete-column',
		function()
			{
				var grid = jQuery(this).closest('.form_field');
				var column = jQuery(this).closest('.grid_input_holder');
				var column_width = parseInt(column.attr('data-grid-width'));
				
				var column_class = 'sm';
				if(strstr(column.attr('class'),'-xs-'))
					column_class = 'xs';
				if(strstr(column.attr('class'),'-md-'))
					column_class = 'md';
				if(strstr(column.attr('class'),'-lg-'))
					column_class = 'lg';
				
				
				
				
				var grid_num = parseInt(column.attr('data-grid-num'));
				
				
				
				if(grid_num!=0)
					{
					var prev_column = column.prev('.grid_input_holder'); 
					var prev_column_width = parseInt(prev_column.attr('data-grid-width'));
					for(var i=0;i<=12;i++)
						prev_column.removeClass('col-'+column_class+'-'+i);
						
					prev_column.addClass('col-'+column_class+'-'+(prev_column_width+column_width));
					prev_column.attr('data-grid-width',(prev_column_width+column_width))
					}
				else
					{
					var next_column = column.next('.grid_input_holder'); 
					var next_column_width = parseInt(next_column.attr('data-grid-width'));
					for(var i=0;i<=12;i++)
						next_column.removeClass('col-'+column_class+'-'+i);
						
					next_column.addClass('col-'+column_class+'-'+(next_column_width+column_width));
					next_column.attr('data-grid-width',(next_column_width+column_width))	
					}
				
				column.remove();
				
				
				
				nf_setup_grid(grid);
				
				grid.find('.grid').each(
					function()
						{
						nf_setup_grid(jQuery(this));	
						}
					);
				
				if(jQuery('.form-canvas-area').hasClass('split_view'))
					{
					setTimeout(function() {nf_save_nex_form('','preview', '') },300);
					}
		
			}
		);
	
	
	jQuery(document).on('mouseover','.edit_mask',function() {
	  jQuery(this).closest('.form_field').find('.field_settings').toggleClass('over-mask');
	});
	jQuery(document).on('mouseout','.edit_mask',function() {
	  jQuery(this).closest('.form_field').find('.field_settings').toggleClass('over-mask');
	});
	
	
	jQuery(document).on('mouseover','.field_settings .btn.delete',function() {
	  jQuery(this).closest('.form_field').toggleClass('over-delete');
	});
	jQuery(document).on('mouseout','.field_settings .btn.delete',function() {
	  jQuery(this).closest('.form_field').toggleClass('over-delete');
	});
	
	
	jQuery(document).on('mouseenter','.outer-container',function() {
	  jQuery(this).addClass('over-form');
	});
	jQuery(document).on('mouseleave','.outer-container',function() {
	  jQuery(this).removeClass('over-form');
	});
	
	
	jQuery(document).on('mouseover','.delete-column',function() {
	  jQuery(this).closest('.grid_input_holder').find('.panel').toggleClass('over-delete');
	});
	jQuery(document).on('mouseout','.delete-column',function() {
	  jQuery(this).closest('.grid_input_holder').find('.panel').toggleClass('over-delete');
	});
	
	jQuery(document).on('mouseover','.grid_input_holder',function() {
	  jQuery(this).toggleClass('over-column-tools');
	});
	jQuery(document).on('mouseout','.grid_input_holder',function() {
	  jQuery(this).toggleClass('over-column-tools');
	  jQuery('.grid_input_holder').removeClass('over-column-tools');
	});
	
	
	jQuery(document).on('mouseenter','.form-canvas-area .nex-forms-container:not(.dragging) .form_field',function() {
	  if(jQuery('.form_canvas').hasClass('conditional-logic-opened'))
	  	return;
	  jQuery(this).parents('.form_field').find('.field_settings').addClass('parent-over-field');
	  jQuery(this).find('.field_settings').last().addClass('over-field');
	  jQuery(this).find('.field_settings').last().removeClass('parent-over-field');
	  
	  
	  jQuery(this).parents('.form_field').addClass('set-parent-over-field');
	  jQuery(this).addClass('set-over-field');
	  jQuery(this).removeClass('set-parent-over-field');
	  jQuery('.outer-container').removeClass('over-form');
	  
	});
	
	
	jQuery(document).on('mouseleave','.form-canvas-area .nex-forms-container:not(.dragging) .form_field',function() {
	  
	  if(jQuery('.form_canvas').hasClass('conditional-logic-opened'))
	  	return;
	  jQuery(this).find('.field_settings').removeClass('over-field');
	  jQuery(this).parent().closest('.form_field').find('.field_settings').removeClass('parent-over-field');
	  
	  jQuery(this).removeClass('set-over-field');
	  jQuery(this).parent().closest('.form_field').removeClass('set-parent-over-field');
	  setTimeout(function(){ jQuery('.outer-container').addClass('over-form');400});
	});
	
	jQuery('div.updated').remove();
	jQuery('.update-nag').remove();
	jQuery('div.error').remove();	
	}
);

function unformat_name(input_value){
	if(!input_value)
		return;
	
	//var new_value = input_value;
	var new_value = input_value.replace(/_/g,' ')
	new_value = new_value.replace('[','')
	new_value = new_value.replace(']','')
	
	return new_value;
}
function format_illegal_chars(input_value){
	
	if(!input_value)
		return;
	
	input_value = input_value.toLowerCase();
	input_value = input_value.replace(/<(.|\n)*?>/g, '');
	
	if(input_value=='name' || input_value=='page' || input_value=='post' || input_value=='id')
		input_value = '_'+input_value;
		
	var illigal_chars = '"+=!@#$%^&*()*{};<>,.?~`|/\'';
	
	var new_value ='';
	
    for(var i=0;i<input_value.length;i++)
		{
		if (illigal_chars.indexOf(input_value.charAt(i)) != -1)
			{
			input_value.replace(input_value.charAt(i),'');
			}
		else
			{
			if(input_value.charAt(i)==' ')
			new_value += '_';
			else
			new_value += input_value.charAt(i);
			}
		}
	return new_value;	
}

function strstr(haystack, needle, bool) {
    var pos = 0;

    haystack += "";
    pos = haystack.indexOf(needle); if (pos == -1) {
       return false;
    } else {
       return true;
    }
}

function short_str(str) {
    //if(str)
    //   return str.substring(0, 30);
    return str;
}

function insertAtCaret(areaId,text) {
    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
    	"ff" : (document.selection ? "ie" : false ) );
    if (br == "ie") { 
    	txtarea.focus();
    	var range = document.selection.createRange();
    	range.moveStart ('character', -txtarea.value.length);
    	strPos = range.text.length;
    }
    else if (br == "ff") strPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0,strPos);  
    var back = (txtarea.value).substring(strPos,txtarea.value.length); 
    txtarea.value=front+text+back;
    strPos = strPos + text.length;
    if (br == "ie") { 
    	txtarea.focus();
    	var range = document.selection.createRange();
    	range.moveStart ('character', -txtarea.value.length);
    	range.moveStart ('character', strPos);
    	range.moveEnd ('character', 0);
    	range.select();
    }
    else if (br == "ff") {
    	txtarea.selectionStart = strPos;
    	txtarea.selectionEnd = strPos;
    	txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
} 

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function nf_form_modified(modification){	
	jQuery('.check_save').addClass('not_saved');	
	jQuery('.prime_save').find('.ns').remove();	
	jQuery('.prime_save').append('<span class="ns">*</span>');
}
function isNumber(n) {
   if(n!='')
		return !isNaN(parseFloat(n)) && isFinite(n);
	
	return true;
}


function nf_setup_grid(grid){

				
				
				
				
				
				var grid_parent_class_pre = '.id-'+grid.attr('id');
				grid.find('.grid-width-slider').remove();
				grid.find('.column_tools').remove();
				var column_tools = '';
				column_tools += '<div class="column_tools">';

				if(grid.find('.grid_input_holder'+grid_parent_class_pre).length<=0)
					{
					grid_parent_class_pre = '';	
					}
				else
					{
					
					}
					/*column_tools += '<div class="add-new-column title="Duplicate Column"">';
						column_tools += '<span class="fas fa-copy"></span>';
					column_tools += '</div>';*/
					
					column_tools += '<div class="add-new-column blank-column" title="Add Column">';
						column_tools += '<span class="fas fa-plus"></span>';
					column_tools += '</div>';
					column_tools += '<div class="delete-column" title="Delete Column">';
						column_tools += '<span class="fa fa-minus"></span>';
					column_tools += '</div>';
					
				column_tools += '</div>';
				
				
							
				grid.find('.grid_input_holder'+grid_parent_class_pre).each(
					function(index)
						{
						jQuery(this).append(column_tools);
						var grid_parent_class = 'id-'+jQuery(this).closest('.form_field').attr('id');
						var grid_width = jQuery(this).attr('class');
						
						var col_bs_class = 'sm';
						if(strstr(grid_width,'-xs-'))
							col_bs_class = 'xs';
						if(strstr(grid_width,'-md-'))
							col_bs_class = 'md';
						if(strstr(grid_width,'-lg-'))
							col_bs_class = 'lg';
							
						grid_width = grid_width.replace('nex_prev_steps','');
						grid_width = grid_width.replace('grid_input_holder','');
						grid_width = grid_width.replace('dropped','');
						grid_width = grid_width.replace(grid_parent_class,'');
						grid_width = grid_width.replace('over-column-tools','');
						grid_width = grid_width.replace('col-xs-','');
						grid_width = grid_width.replace('col-sm-','');
						grid_width = grid_width.replace('col-md-','');
						grid_width = grid_width.replace('col-lg-','');
					
						for(var i=12;i>=0;i--)
							grid_width = grid_width.replace('grid-target-'+i,'');
						
					
						jQuery(this).attr('data-grid-width', parseInt(grid_width.trim()));
						jQuery(this).attr('data-grid-num',index);
						
						 
						var set_grid_width = parseInt(grid_width.trim())
						if(set_grid_width<1)
							set_grid_width = 1;
						
						jQuery(this).attr('class','grid_input_holder '+grid_parent_class+'  col-'+ col_bs_class +'-'+ set_grid_width +' grid-target-'+index);
						
						grid.prepend('<div class="grid-width-slider '+grid_parent_class+' grid-'+ index +'" data-grid-target="'+ index +'" data-grid-width="'+ set_grid_width +'" data-col-class="'+ col_bs_class +'"></div>');
							
						}
				);
				
				
				
				grid.find('.grid-width-slider').each(
					function(index)
						{
						var grid_class = '.id-'+jQuery(this).closest('.form_field').attr('id');
						
						
						
						var target_num = parseInt(jQuery(this).attr('data-grid-target'));
						var col_class = (jQuery(this).attr('data-col-class')!='') ? jQuery(this).attr('data-col-class') : 'sm';
						
						var slider_start = 0;
						for(var x=(target_num);x>=0;x--)
							{
							slider_start += parseInt(grid.find('.grid-target-'+x).attr('data-grid-width'));
							}
						var get_grid_total = 0;
						var get_grid_before_total = 0;
						
						var target = '';
						var target_size =  '';
						
						var target_after = '';
						var target_after_size = '';
						
						
						jQuery(this).slider({
								  min: 0,
								  max: 12,
								  value: slider_start,
								  slide: function( event, ui ) {
									  
									  	
										get_grid_total = 0;
										get_grid_before_total = 0;
										for(var x=(target_num);x>=0;x--)
											get_grid_total += parseInt(grid.find('.grid-target-'+x+grid_class).attr('data-grid-width'));
										
										
									  
										target = grid.find('.grid-target-'+(target_num)+grid_class).first();
										target_size =  parseInt(grid.find('.grid-target-'+(target_num)+grid_class).first().attr('data-grid-width'));
										
										target_after = grid.find('.grid-target-'+(target_num+1)+grid_class).first();
										target_after_size =  parseInt(grid.find('.grid-target-'+(target_num+1)+grid_class).first().attr('data-grid-width'));
										
										get_grid_before_total = (get_grid_total-target_size);
										
										
										var set_target_total = (ui.value-get_grid_before_total);
										var set_target_after_total = ((get_grid_total-ui.value)+target_after_size);
										
										
										if((set_target_total)>0 && (set_target_after_total)>0)
										 	{
											for(var i=0;i<=12;i++)
												{
										 		target.removeClass('col-'+col_class+'-'+i);
												target_after.removeClass('col-'+col_class+'-'+i);
												}
											 target.addClass('col-'+col_class+'-'+set_target_total);
											 target_after.addClass('col-'+col_class+'-'+set_target_after_total);
											}
										else
											{
											event.preventDefault();
											}
										
										 },
								stop:function( event, ui )
										{
										grid.find('.grid-width-slider.grid-'+target.attr('data-grid-num')).attr('data-grid-width',(ui.value-get_grid_before_total));
										grid.find('.grid-width-slider.grid-'+(parseInt(target.attr('data-grid-num'))+1)).attr('data-grid-width',((get_grid_total-ui.value)+target_after_size));
										if(target)
											{
											target.attr('data-grid-width',(ui.value-get_grid_before_total));
											target_after.attr('data-grid-width',((get_grid_total-ui.value)+target_after_size))	
											}
										
										if(jQuery('.form-canvas-area').hasClass('split_view'))
											{
											setTimeout(function() {nf_save_nex_form('','preview', '') },300);
											}
										
										}
								});
							}
						);	
}


