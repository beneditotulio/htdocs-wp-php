'use strict';

(function ( $ ) {

    function inputStoreSet(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; expires=" + expires + "; path=/";
    };

    function inputStoreGet(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    };

    function store(settings, type, dom) {
        
		if($(dom).is('select'))
		 	type = 'select';
			
		if(type === "select" && $(dom).attr('multiple'))
			{
			var select_options = [];
			$(dom).find('option:selected').each(
				function()
					{
					select_options.push(jQuery(this).attr('value'));	
					}
				);
			inputStoreSet(settings.name, select_options, settings.expire);
			}
		else if(type === "checkbox")
			{
			var checkboxes = $(dom).closest('.input_container');
			var checks = [];
			checkboxes.find('input:checked').each(
				function()
					{
					if(jQuery(this).attr('checked')=='checked')
						checks.push(jQuery(this).val());
					}
				);
			inputStoreSet(settings.name, checks, settings.expire);
			}
		else if(type === "radio") {
          inputStoreSet(settings.name, $(dom).val(), settings.expire);
        } 
		else {
          inputStoreSet(settings.name, dom.value, settings.expire);
          if(settings.debug) {
            console.log("Previous Input for ["+settings.name+"] = ["+dom.value+"]");
          }
        }
    }

    $.fn.inputStore = function( options ) {

        // This is the easiest way to have default options.
        var settings = $.extend({
            name: this.attr("name"),
            expire: 365,
            debug: false
        }, options );

        var previousSet = inputStoreGet(settings.name);

        var type = this.attr("type");
		
		if(this.is('select'))
		 	type = 'select';
		

		if((type && type == "select")){
           
		   var select_options = previousSet.split(',');
		   this.find('option').prop('selected',false);
		   for (var i = 0; i < select_options.length; i++) {
				this.find('option[value="'+ select_options[i] +'"]').prop('selected',true);
				this.trigger('change');
			}
		} 
		
        else if(type && type == "checkbox"){
           
		   var checks = previousSet.split(',');
		   
		   for (i = 0; i < checks.length; i++) {
				var the_check = this.parent().find('input[value="'+ checks[i] +'"]');
				setTimeout(function(){ the_check.closest('label').trigger('click'); }, 100); 
				//the_check.closest('label').find('a').trigger('click');
				
				var the_super_check = this.closest('.icon-container').find('input[value="'+ checks[i] +'"]');
				the_super_check.prop('checked',true);
				the_super_check.trigger('change');
				
				the_super_check.parent().addClass('icon-checked');
				
				the_super_check.parent().find('.on-label').show();
				the_super_check.parent().find('.off-label').hide();
				
				the_super_check.parent().find('.on-icon').show();
				the_super_check.parent().find('.off-icon').hide();
				
			}
		} 
		else if(type && type == "radio"){
		  this.prop('checked',false);
          var the_radio = this.parent().find('input[value="'+ previousSet +'"]');
	
		  setTimeout(function(){ the_radio.closest('label').trigger('click'); }, 100); 

		  the_radio.closest('.icon-holder').trigger('click');
		  
		  
		  var the_super_check = this.closest('.icon-container').find('input[value="'+ previousSet +'"]');
		  the_super_check.prop('checked',true);
		  the_super_check.trigger('change');
		
		  the_super_check.parent().addClass('icon-checked');
		
		  the_super_check.parent().find('.on-label').show();
		  the_super_check.parent().find('.off-label').hide();
		
		  the_super_check.parent().find('.on-icon').show();
		  the_super_check.parent().find('.off-icon').hide();
		  
		  
        }
		
		else {
			if(previousSet)
				{
				if(this.closest('.ui-nex-forms-container').hasClass('m_design'))
					this.closest('.form_field').addClass('is_focused');	
				}
          this.val(previousSet); 
        }

        if(settings.debug) {
          console.log("Previous Input for ["+settings.name+"] = ["+previousSet+"]");
        }


        this.on('keyup', function(){
          store(settings, type, this);
        });

        this.on('change', function(){
          store(settings, type, this);
        });
		
		

        return this;
    };

}( jQuery ));
