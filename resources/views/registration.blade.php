@extends('layout.reg')
@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="row">
        <div class="col-md-offset-3 col-md-9">
            <div id="company-info" class="column">
                <form  data-example-id="basic-forms" id="registration-form">
                    <fieldset>
                    <div id="form-details">
                        <div class="information column">
                            <div class="info-in column active">
                                <div class="info-heading column">
                                <h3>Let's get started.</h3>
                                <h5>First, please enter your information.</h5>
                                </div>
                                <div class="form-field column">
                                    <div class="form-group">
                                        <label for="Companyname">Company Group name</label>
                                        <input id="Companyname" class="form-control" type="text" name="CompanyGroupName">
                                    </div>
                                    <div class="form-group">
                                        <label for="Companyemail">Your work email</label>
                                        <input id="Companyemail" class="form-control" placeholder="example@workdomain.com" type="email" name="EmailId">
                                    </div>
                                    <div class="form-group">
                                        <label for="MobileNumber">Mobile Number</label>
                                        <input id="MobileNumber" class="form-control" type="text" name="MobileNumber">
                                    </div>
                                    <div class="form-group">
                                        <label for="AlternateNumber">Alternate Number</label>
                                        <input id="AlternateNumber" class="form-control" type="text" name="AlternateNumber">
                                    </div>
                                    <div class="form-group">
                                        <label for="Companylocation">Country</label>
                                        <div class="select-loc column">
                                            <select class="selectpicker" data-live-search="true" name="CountryCode">
                                                <option class="_eo" value="91" selected>India</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="notes column">
                                        <label class="custom-check">By submitting this form, you agree to Ways <a href="#">Terms and Conditions</a> and <a href="#">Privacy policy.</a>
                                        <input type="checkbox" checked="" name="TermsPolicy">
                                        <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    
                                    <div class="next-sec column">
                                        <button  class="create column btn btn-grey" type="submit">Next</button>							
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    </fieldset>
                </form>
            <div id="message" class="column"></div>

            </div>
        </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="user-select column">
        <ul id="uselect">
            <li class="active">Enter Company Info</li>
            <li>Verify Your Mobile Number</li>
            <li>Set Your Password</li>
            <li>Verify Your Email</li>
        </ul>
        </div>
    </div>
</div>
@endsection