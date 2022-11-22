/*standart countdown protytype_script*/
(function($){
	/// jquery animation for elements	
	$.fn.wpdevart_vertical_menu = function(resive_options) {
		var element = $(this);		
		options={
			open_menu_on:"click",
			open_duration:"400",
			click_image_action:"go_to_link",
		}
		for (var i in resive_options) if (resive_options.hasOwnProperty(i) && options.hasOwnProperty(i)) options[i] = resive_options[i];
		initial();
		function initial(){
			open_close();
		}
		
		function open_close(){
			
			
			switch(options["open_menu_on"]){
				case "hover":
					element.children().hover(function(){						
						$(this).find(".wpdevart_submenu").stop().slideDown(parseInt(options["open_duration"]));						
					},
					function(){
						$(this).find(".wpdevart_submenu").stop().slideUp(parseInt(options["open_duration"]));
					})
				break;	
				case "click":
					element.find(".wpdevart_menu_link_conteiner a").click(function(e){
						e.stopImmediatePropagation();
					})
					element.children().click(function(){
							
						$(this).find(".wpdevart_submenu").stop().slideToggle(parseInt(options["open_duration"]),function() {
							if ($(this).is(':hidden')) {
								$(this).parent().find(".wpdevart_open_icon").removeClass("wpdevart_hidden")
								$(this).parent().find(".wpdevart_close_icon").removeClass("wpdevart_active")
								
								$(this).parent().find(".wpdevart_open_icon").addClass("wpdevart_active")
								$(this).parent().find(".wpdevart_close_icon").addClass("wpdevart_hidden")
								
							} else {
								
								$(this).parent().find(".wpdevart_open_icon").removeClass("wpdevart_active")
								$(this).parent().find(".wpdevart_close_icon").removeClass("wpdevart_hidden")
								
								$(this).parent().find(".wpdevart_open_icon").addClass("wpdevart_hidden")
								$(this).parent().find(".wpdevart_close_icon").addClass("wpdevart_active")
							}							
						})						
					});
				break;	
			}
			
		}
		function isScrolledIntoView(){
			var $window = $(window);
			var docViewTop = $window.scrollTop();
			var docViewBottom = docViewTop + $window.height();
			var elemTop = element.offset().top;
			var elemBottom = elemTop + parseInt(element.css('height'));			
			return ( ( (docViewTop<=elemTop+5) && (elemTop-5<=docViewBottom) )  || ( (docViewTop<=elemBottom+5) && (elemBottom-5<=docViewBottom) ) || (docViewTop==0 && docViewBottom==0) || $window.height()==0);
		}
	}

})(jQuery)
	