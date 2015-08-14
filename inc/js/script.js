var rotten = {

	init: function(){
		$(window).on('hashchange', function(){
			if( window.location.hash == '' ){
				$('span.close-content:visible').trigger('click');
			} else {
				var $el = $('.movie[data-hash="'+window.location.hash.replace('#','')+'"]');
				if( $el.length > 0 ){
					$el.trigger('click');
				}
			}
		});
	}
};

$(document).ready(function(){rotten.init();});