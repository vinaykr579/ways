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
                            <div class="payment column">
                                <div class="info-heading column">
                                <h3>Our pricing</h3>
                                <h5>Only pay when your people ride.</h5>
                                </div>
                                <div class="ride-cost column">
                                <h2>Cost of ride + 10%</h2>
                                <p>Why 10%? Uber for Business offers powerful features to help you manage how your company uses Uber, such as:</p>
                                <ul>
                                    <li>Spend Allowances</li>
                                    <li>Trip Review</li>
                                    <li>Vehicle Policies</li>
                                    <li>Monthly Billing</li>
                                    <li>Data Exports</li>
                                    <li>Employee Management</li>
                                </ul>
                                <div class="notes column">
                                    <label class="radiobtn">The 10% service fee will be assessed per ride on each Ways service selected will be billed to you.
                                    <input type="radio" name="radio">
                                    <span class="checkmark"></span>
                                    </label>
                                    <label class="radiobtn">The 10% service fee will be assessed per ride on each Ways service selected will be billed to you.
                                    <input type="radio" name="radio">
                                    <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="next-sec column"> 
                                    <a class="create column btn btn-grey" href="<?php echo url('/').'/registration/step5';?>">Next</a> 
                                </div>
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
            <li>Add a Payment Method</li>
            <li>Invite People</li>
        </ul>
        </div>
    </div>
</div>
@endsection               
