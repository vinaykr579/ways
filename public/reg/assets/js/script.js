function addOTPForm(){
	$('#registration-form').remove();
	var otpForm = '<form data-example-id="basic-forms" id="registration-otp-form">'+	
				'<fieldset>'+
					'<div id="form-details">'+
					'<div class="information column">'+
						'<div class="info-in column active">'+
							'<div class="info-heading column">'+
							'<h3>Congratulations!!</h3>'+
							'<h5>Please verify mobile no.</h5>'+
						'</div>'+
						'<div class="form-field column">'+
						'<div class="form-group">'+
							'<label for="OTP">OTP Code</label>'+
							'<input id="OTP" class="form-control" type="text" name="OTPCode">'+
						'</div>'+
						'<div class="next-sec column">'+
							'<button  class="create column btn btn-grey" type="submit">Verify OTP</button>'+							
						'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
			'</fieldset></form>';
	$(otpForm).insertBefore('#message');
	$('#company-info form').attr('id', 'registration-otp-form');
	// $.validator.setDefaults({
	//     debug: true,
	//     success: "valid"
	// });
	
	$('#company-info form').validate({
		rules:{
			OTPCode:{
				required:true,
				number:true
			}
		},
		messages:{
			OTPCode:{
				required:'Please enter OTP.',
				number:'Please valid OTP.'
			}
		},
		submitHandler:function(){
			btnLoading();
			$.ajax({
				url:siteUrl+'/register/verify-otp',
				type:'post',
				data:$('#registration-otp-form').serialize(),
				success:function(res){
					if(res.message == 'error'){
						setAlertMsg(res.response.error, 'error');
						$('#registration-otp-form button').attr('disabled', false).html('Verify OTP');
						return false;
					}
					$('#uselect').children('li').removeClass('active').eq(2).addClass('active');
					setPswdForm();
					return false;
				}
			});
			return false;
		}
	});	
	

	
}

function setPswdForm(){
	$('#registration-otp-form').remove();
	var pwdForm =
	'<form data-example-id="basic-forms" id="registration-pwd-form">'+ 
				'<fieldset>'+
					'<div id="form-details">'+
					'<div class="information column">'+
						'<div class="info-in column active">'+
							'<div class="info-heading column">'+
							'<h3>Congratulations!!</h3>'+
							'<h5>Please set up your password.</h5>'+
						'</div>'+
						'<div class="form-field column">'+
						'<div class="form-group">'+
							'<label for="Password">Password</label>'+
							'<input id="Password" class="form-control" type="password" name="password">'+
						'</div>'+
						'<div class="form-group">'+
							'<label for="ConfirmPassword">Confirm Password</label>'+
							'<input id="ConfirmPassword" class="form-control" type="password" name="password_confirmation">'+
						'</div>'+
						'<div class="next-sec column">'+
							'<button  class="create column btn btn-grey" type="submit">Save</button>'+							
						'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</div>'+
			'</fieldset></form>';

	$(pwdForm).insertBefore('#message');
	$('#registration-pwd-form').validate({
		rules:{
			password:{
				required:true,
				min:6
			},
			password_confirmation:{
				required:true,
				equalTo:'#Password'
			}
		},
		messages:{
			password:'Please set a password to login.',
			password_confirmation:'Please confirm your password.'
		},
		submitHandler:function(){
			btnLoading();
			$.ajax({
				url:siteUrl+'/register/set-password',
				type:'post',
				data:$('#registration-pwd-form').serialize(),
				success:function(res){
					if(res.message == 'error'){
						setAlertMsg(res.response.error, 'error');
						$('#registration-pwd-form button').html('Save');
						return false;
					}
					$('#registration-pwd-form').remove();
					var msg = res.response.message+loginLink(); 
					setAlertMsg(msg, 'success');
					return false;
				}
			});
			return false;
		}
	});	

}


function resetPswdForm(){
	$('#registration-pwd-form').validate({
		rules:{
			password:{
				required:true,
				min:6
			},
			password_confirmation:{
				required:true,
				equalTo:'#Password'
			}
		},
		messages:{
			password:'Please set a password to login.',
			password_confirmation:'Please confirm your password.'
		},
		submitHandler:function(){
			btnLoading();
			$.ajax({
				url:siteUrl+'/password/reset',
				type:'post',
				data:$('#registration-pwd-form').serialize(),
				success:function(res){
					if(res.message == 'error'){
						setAlertMsg(res.error, 'error');
						$('#registration-pwd-form button').html('Save');
						return false;
					}
					$('#registration-pwd-form').remove();
					var msg = res.message+loginLink(); 
					setAlertMsg(msg, 'success');
					return false;
				}
			});
			return false;
		}
	});	

}

function loginLink(){
	return '<p>Please click <a href="'+siteUrl+'/login">here</a> to login.';
}

function listmsgs(msgs){
	if(Object.keys(msgs).length > 0){
		var msg = '<ol>';
		for(var props in msgs){
			msg += '<li>'+msgs[props][0]+'</li>';
		}
		msg += '</ol>';
		return msg;
	}
}

function setAlertMsg(msgs, type='success'){
	var divClass = '';
	var msg = null;
	if(type === 'success'){
		msg = msgs;
		divClass = 'alert-success'
	}else{
		msg = listmsgs(msgs);
		divClass = 'alert-danger'
	}
	var alertHtml = '<div  style="padding:10px;" class="'+divClass+'">'+msg+'</div>';
	$('#message').html(alertHtml);
}


function btnLoading(){
	$('#company-info form button').html('Loading...').attr('disabled', true);
}
























