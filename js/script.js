$(document).ready(function(){
	$('.center a').click(function(e){
		e.preventDefault();
		
		clicked = $(this);

		$.get( $(this).attr('href'), function(data){

			if (data.indexOf("ok") !== -1)
			{
				$(clicked).css({'-webkit-filter':'brightness(-20%)'});
			}
			else
			{
				alert(data);
			}
			
		});
	});
});
