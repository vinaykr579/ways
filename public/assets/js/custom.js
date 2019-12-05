/* HTML document is loaded. DOM is ready.
-------------------------------------------*/
$(function(){

    /* start typed element */
    var subElementArray = $.map($('.sub-element'), function(el) { return $(el).text(); });    
	var subElementArray1 = $.map($('.sub-element1'), function(el) { return $(el).text(); });
	var subElementArray2 = $.map($('.sub-element2'), function(el) { return $(el).text(); });
	var subElementArray3 = $.map($('.sub-element3'), function(el) { return $(el).text(); });
    $(".element").typed({
      /*  strings: subElementArray,
        typeSpeed: 30,
        contentType: 'html',
        showCursor: false,
        loop: true,
        loopCount: true,*/
    });
	
	$(".element1").typed({
        strings: subElementArray1,
        typeSpeed: 30,
        contentType: 'html',
        showCursor: false,
        loop: true,
        loopCount: true,
    });
	
	$(".element2").typed({
        strings: subElementArray2,
        typeSpeed: 30,
        contentType: 'html',
        showCursor: false,
        loop: true,
        loopCount: true,
    });
	
	$(".element3").typed({
        strings: subElementArray3,
        typeSpeed: 30,
        contentType: 'html',
        showCursor: false,
        loop: true,
        loopCount: true,
    });
	
	
    /* end typed element */

    /* Smooth scroll and Scroll spy (https://github.com/ChrisWojcik/single-page-nav)    
    ---------------------------------------------------------------------------------*/ 
    $('.templatemo-nav').singlePageNav({
        offset: $(".templatemo-nav").height(),
        filter: ':not(.external)',
        updateHash: false
    });

    /* start navigation top js */
    $(window).scroll(function(){
        if($(this).scrollTop()>58){
            $(".templatemo-nav").addClass("sticky");
        }
        else{
            $(".templatemo-nav").removeClass("sticky");
        }
    });
    
    /* Hide mobile menu after clicking on a link
    -----------------------------------------------*/
    $('.navbar-collapse a').click(function(){
        $(".navbar-collapse").collapse('hide');
    });
    /* end navigation top js */

    $('body').bind('touchstart', function() {});

    /* wow
    -----------------*/
    new WOW().init();

    // $.validator.setDefaults({
    //     debug: true,
    //     success: "valid"
    //   });
    $.validator.addMethod('mobileno', function(value, element){
        var validMobileNo = /^[6-9]\d{9}$/;
        return validMobileNo.test(value) === true?true:false;
    }, 'Please enter valid mobile no.');

    $('#contact-form').validate({
        errorElement:'h6',
        rules:{
            FullName:{
                required: true
            },
            EmailId:{
                required:true,
                email:true
            },
            MobileNo:{
                required:true,
                mobileno:true
            },
            Message:{
                required:true
            }
        },
        messages:{
            FullName:{
                required: 'This input field is required.'
            },
            EmailId:{
                required:'This input field is required.',
                email:'Invalid value for this input.'
            },
            MobileNo:{
                required:'This input field is required.',
            },
            Message:{
                required:'This input field is required.',
            }
        },
        submitHandler: function(e){
            $.ajax({
                url:siteurl+'/api/save-contact-form',
                type: 'post',
                data: $('#contact-form').serialize(),
                success:function(data){
                    if(data === 'saved'){
                        $('#contact-form').append('<div id="contactmsg" class="alert alert-success">'+
                        'Message sent successfully!. We will contact you soon.</div>');
                    }else{
                        $('#contact-form').append('<div id="contactmsg" class="alert alert-danger">'+
                        'Something went wrong.</div>');
                    }
                    setTimeout(function(){
                        $('#contactmsg').remove();
                    }, 5000);
                    return false;
                }
            });
            return false;
        }
    });
});

/* start preloader */
$(window).load(function(){
	$('.preloader').fadeOut(1000); // set duration in brackets    
});
/* end preloader */
