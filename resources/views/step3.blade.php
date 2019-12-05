@extends('layout.reg')

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <div id="company-info" class="column">
                <form data-example-id="basic-forms">
                    <fieldset>
                    <div id="form-details">
                        <div class="information column">
                            <div class="verify column">
                                <div class="info-heading column">
                                <h3>Check Your Email</h3>
                                <h5>To active your account, please follow the instruction we just send to info@softbintech.com. If you're having trouble finding your email, check your Spam folder and make sure the email you provided is correct.</h5>
                                </div>
                                <div class="user-details column">
                                <h6>Email Address</h6>
                                <h4>info@softbintech.com</h4>
                                <h2><a class="create" href="<?php echo url('/').'/registration/step4';?>">Resend Email</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    </fieldset>
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="user-select column">
        <ul>
            <li class="active">Enter Company Info</li>
            <li class="active">Create an Account</li>
            <li>Verify Your Email</li>
            <li>Add a Payment Method</li>
            <li>Invite People</li>
        </ul>
        </div>
    </div>
</div>
@endsection