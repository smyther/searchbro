$(document).ready(function(){
	$('.center a').click(function(e){
		e.preventDefault();
		
		clicked = $(this);

		$.get( $(this).attr('href'), function(data){
			$(clicked).css({'-webkit-filter':'brightness(-20%)'});
		});
	});
});
