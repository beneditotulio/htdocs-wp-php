'use strict'; 

jQuery(document).ready(
function()
	{
		jQuery(document).on('click','#preferences .alert .close',
			function()
				{
				jQuery(this).parent().slideUp('slow')
				}
			);
		
		jQuery('#field-pref').ajaxForm({
			data: {
			   action: 'save_field_pref'
			},
			beforeSubmit: function(formData, jqForm, options) {
				jQuery('#field-pref button').html('&nbsp;&nbsp;&nbsp;<span class="fa fa-spin fa-spinner"></span>&nbsp;Saving...&nbsp;&nbsp;&nbsp;')
			},
		   success : function(responseText, statusText, xhr, $form) {
			   jQuery('#field-pref button').html('&nbsp;&nbsp;&nbsp;Save Field Preferences&nbsp;&nbsp;&nbsp;');
			    Materialize.toast('Field Preferences Saved', 2000, 'toast-success');
			},
			 error: function(jqXHR, textStatus, errorThrown)
				{
				console.log(errorThrown)
				}
		});
		
		jQuery('#validation-pref').ajaxForm({
			data: {
			   action: 'save_validation_pref'
			},
			beforeSubmit: function(formData, jqForm, options) {
				jQuery('#validation-pref button').html('&nbsp;&nbsp;&nbsp;<span class="fa fa-spin fa-spinner"></span>&nbsp;Saving...&nbsp;&nbsp;&nbsp;')
			},
		   success : function(responseText, statusText, xhr, $form) {
			   jQuery('#validation-pref button').html('&nbsp;&nbsp;&nbsp;Save Validation Preferences&nbsp;&nbsp;&nbsp;');
			  Materialize.toast('Validation Preferences Saved', 2000, 'toast-success');
			   
			},
			 error: function(jqXHR, textStatus, errorThrown)
				{
				console.log(errorThrown)
				}
		});
		
		jQuery('#emails-pref').ajaxForm({
			data: {
			   action: 'save_email_pref'
			},
			beforeSubmit: function(formData, jqForm, options) {
				jQuery('#emails-pref button').html('&nbsp;&nbsp;&nbsp;<span class="fa fa-spin fa-spinner"></span>&nbsp;Saving...&nbsp;&nbsp;&nbsp;')
			},
		   success : function(responseText, statusText, xhr, $form) {
			   jQuery('#emails-pref button').html('&nbsp;&nbsp;&nbsp;Save Email Preferences&nbsp;&nbsp;&nbsp;');
			  Materialize.toast('Email Preferences Saved', 2000, 'toast-success');
			   
			},
			 error: function(jqXHR, textStatus, errorThrown)
				{
				console.log(errorThrown)
				}
		});
		
		jQuery('#other-pref').ajaxForm({
			data: {
			   action: 'save_other_pref'
			},
			beforeSubmit: function(formData, jqForm, options) {
				jQuery('#other-pref button').html('&nbsp;&nbsp;&nbsp;<span class="fa fa-spin fa-spinner"></span>&nbsp;Saving...&nbsp;&nbsp;&nbsp;')
			},
		   success : function(responseText, statusText, xhr, $form) {
			   jQuery('#other-pref button').html('&nbsp;&nbsp;&nbsp;Save Other Preferences&nbsp;&nbsp;&nbsp;');
			   Materialize.toast('Other Preferences Saved', 2000, 'toast-success');
			   
			},
			 error: function(jqXHR, textStatus, errorThrown)
				{
				console.log(errorThrown)
				}
		});
		
		
		
	}
);