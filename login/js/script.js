$(document).ready(function(){
	//$('#menu').slicknav();
	$('.openTr').click(function(){
		if($(this).closest('tr').next('.slideOpen').css('display')=='table-row'){
			$('.slideOpen').removeClass('active');
			$('.openTr').removeClass('active');
			return false;
		}
		$('.slideOpen').removeClass('active');
		$('.openTr').removeClass('active');
		$(this).closest('tr').next('.slideOpen').addClass('active');
		$(this).addClass('active');
	});
	$('.menuicon').click(function(){
		$('#mask').addClass('active');
		$('.has-subnav ul').hide();
		$('.main-menu').toggleClass('active');
	});
	$(document).on('click','.has-subnav', function(){
		if($('.main-menu').hasClass('active')){
			$('.has-subnav ul').slideUp();
			$(this).children('ul').slideDown();
		}
	});
	$('#mask').click(function(){
		$('.main-menu').removeClass('active');
		$('.has-subnav ul').slideUp();
		$(this).children('ul').slideDown();
		$(this).removeClass('active');
	});
	$(window).resize(function(){
		if($(window).width() > 639){
			$('.main-menu, #mask').removeClass('active');
			$('.has-subnav ul').show();
		}
	});
});


	
