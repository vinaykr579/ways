@extends('layout.reg')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <div id="company-info" class="column">
            @if($validToken == true)
            <form data-example-id="basic-forms" action="#" id="registration-pwd-form"> 
				<fieldset>
					<div id="form-details">
					<div class="information column">
						<div class="info-in column active">
							<div class="info-heading column">
							<h5>Please set up your password.</h5>
						</div>
						<div class="form-field column">
						<div class="form-group">
							<label for="Password">Password</label>
							<input id="Password" class="form-control" type="password" name="password">
						</div>
						<div class="form-group">
							<label for="ConfirmPassword">Confirm Password</label>
							<input id="ConfirmPassword" class="form-control" type="password" name="password_confirmation">
						</div>
						<div class="next-sec column">
							<button  class="create column btn btn-grey" type="submit" onclick="resetPswdForm()">Save</button>							
						</div>
						</div>
					</div>
				    </div>
			    </div>
			</fieldset>
            </form>
            
            @else
            <div id="message" class="column">
                <div  style="padding:10px;" class="alert-info">
                    This url has been expired. 
                </div>
            </div>
            
            @endif
            

            </div>
        </div>
        </div>
    </div>
</div>


@endsection
