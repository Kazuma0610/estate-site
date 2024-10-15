(function($){
	$(window).on('load',function(){
		//基本
		var $slide = $('.bxslider1');
		var $slide_ul = $slide.find('ul');
		$slide_ul.bxSlider({
				easing: 'easeOutExpo',
				speed: 1000,
				onSliderLoad: function(){
					$slide_ul.animate({
						opacity: 1
					},500);
				}
			}
		);
	});
})(jQuery);