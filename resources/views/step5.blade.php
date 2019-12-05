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
                            <div class="pay_online column">
                                <div class="info-heading column">
                                <h3>Enter a payment method</h3>
                                <h5>The central payment method for your Ways for Business account. Your payment details will not be shared.</h5>
                                </div>
                                <div class="form-group">
                                <label for="Companylocation">payment type</label>
                                <div class="select-loc column">
                                    <select class="selectpicker" data-live-search="true">
                                        <option>Add Paytm</option>
                                        <option>Add Credit Card</option>
                                        <option>Add Debit Card</option>
                                    </select>
                                </div>
                                </div>
                                <div class="next-sec column"> 
                                <a class="column btn btn-grey" href="javascript:;">Next</a> 
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
            <li class="active">Verify Your Email</li>
            <li class="active">Add a Payment Method</li>
            <li>Invite People</li>
        </ul>
        </div>
    </div>
</div>
@endsection               
            