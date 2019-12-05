import React, { Component, Fragment } from 'react';
import {connect} from 'react-redux';
import { Redirect} from 'react-router-dom'
import * as constants from '../actions/index'
import {errors as errorMsg} from '../utils/text-util'
import BookingPanel from '../components/booking/booking-panel'
import BookingRides from '../components/booking/booking-rides';
import BookingVehicles from '../components/booking/booking-vehicles'
import BookingFare from '../components/booking/booking-fare'
import BookingAgree from '../components/booking/booking-agree'
import PopupAlert from '../components/ui/popup-alert'
import PaymentMethods from '../components/booking/payment-methods'
import PaymentDetail from '../components/booking/payment-detail'
import InitiateBookRideAndTransaction from '../services/initiateBookRideAndTransaction'
import UpdateTransactionWithConfirmRide from '../services/updateTransactionWithConfirmRide'


class BookRide extends Component {
    
    constructor(props){
        super(props);
        this.state = {
            masterData : this.props.masterData,
            style: {
                display: 'none'
            },
            modalShow: false,
            errors: '',
            showPaymentScreen:false
        }
        
    }

    paymentOptions ={
        amount: 0, // in currency subunits. Here 1000 = 1000 paise, which equals to ₹10
        currency: "INR",
        email: this.props.loggedInUser.EmailId,
        contact: this.props.loggedInUser.MobileNumber,
        order_id: '',
        method: '',
    }

    redirectToDashboard(){
        return <Redirect to="/dashboard"/>;
    }

    componentWillUnmount(){
        this.props.resetRides();
        this.props.resetSource();
        this.props.resetDestination();
    }

    handleSearchAction = (actionValue, toll) => {
        if(actionValue === true){
            if(this.props.bookingReducers.BookingType === 'route-specific'){
                if(this.props.bookingReducers.Source.length !== 0 
                    && this.props.bookingReducers.Destination.length){
                        const style = {
                            display: ''
                        }
                        this.setState({style: style, showPaymentScreen: false})
                        this.props.resetRides()
                        this.props.tollSearch(actionValue)
                        return true;
                }else{
                    this.setState({
                        modalShow: true,
                        errors:[errorMsg.selectSourceDestination] 
                    });
                    return false;
                }
            }else{
                if(toll === false){
                    this.setState({
                        modalShow: true,
                        errors:[errorMsg.selectTollToProceed] 
                    });
                    return false;
                }else{
                    const style = {
                        display: ''
                    }
                    this.setState({style: style, showPaymentScreen: false})
                    this.props.resetRides()
                    this.props.tollSearch(actionValue)
                    return true;
                }
            }
            
        }
        
    }

    handleAgreeCheckbox = (event) =>{
        this.props.setBookingStatus(event.target.checked)
    }

    handleProceedBtn = () => {
        let errors = this.handleBookingValidation();
        if(errors === false){
            this.setState({modalShow: false, showPaymentScreen:true});
        }else{
            this.setState({
                modalShow: true,
                errors: errors
            });
        }
    }

    handlePayBtn = (e) => {
        let errors = this.handlePaymentValidation();
        if(errors.length === 0){
            let obj = new InitiateBookRideAndTransaction(this)
            obj.makeRequest(this.props.bookingReducers)
        }else{
            this.setState({
                modalShow: true,
                errors: errors
            });
        }   
    }

    handleBookingValidation = () => {
        let errors = [];
        if(parseInt(this.props.bookingReducers.ChargableAmount) === 0){
            errors.push(errorMsg.chargableAmountIs0)
        }else if(this.props.bookingReducers.AgreeTermStatus === false){
            errors.push(errorMsg.agreeCheckStatus)
        }
        if(errors.length > 0){
            return (
                <ul>
                    {errors.map((err, index)=>{
                        return (<li key={index}>{err}</li>)
                    })}
                </ul>
            )
        }else{
            return false
        }
        
    }

    handlePaymentValidation = () => {
        let errors = [];
        switch(parseInt(this.props.bookingReducers.PaymentModeId)){
            case 2:
                if(this.props.paymentReducers.cardDetail.number === ''){
                    errors.push(errorMsg.cardNumberIsEmpty)
                }else if(this.props.paymentReducers.cardDetail.expiry === ''){
                    errors.push(errorMsg.cardExpiryIsEmpty)
                }
                return errors;
            case 3:
                if(this.props.paymentReducers.bankCode === ''){
                    errors.push(errorMsg.bankIsNotSelected)
                }
                return errors;    
            case 5:
                if(this.props.paymentReducers.upiAddress === ''){
                    errors.push(errorMsg.upiAddrsIsEmpty)
                }
                return errors;    
            default:
                errors.push(errorMsg.invalidPaymentMethod)    
        }

    }

    setCardDetailsForPayment = () => {
        this.paymentOptions['method'] = 'card'
        let cardDetail = this.props.paymentReducers.cardDetail
        let expiryDetails = cardDetail.expiry.split('/')
        this.paymentOptions['card[number]'] = cardDetail.number
        this.paymentOptions['card[name]'] = cardDetail.name
        this.paymentOptions['card[cvv]'] = cardDetail.cvc
        this.paymentOptions['card[expiry_month]'] = expiryDetails[0]
        this.paymentOptions['card[expiry_year]'] = expiryDetails[1]
    }

    setNetbankingPayment = () => {
        this.paymentOptions['method'] = 'netbanking'
        this.paymentOptions['bank'] = this.props.paymentReducers.bankCode
    }

    setUPIPayment = () => {
        this.paymentOptions['method'] = 'upi'
        this.paymentOptions['vpa'] = this.props.paymentReducers.upiAddress
    }

    payThroughRazorPay = (e) => {
        let paymentModeId = parseInt(this.props.bookingReducers.PaymentModeId)
        switch(paymentModeId){
            case 2:
                this.setCardDetailsForPayment()
                break;
            case 3:
                this.setNetbankingPayment()
                break
            case 5:
                this.setUPIPayment()
                break;        
            default:    
        }

        var razorpay = new window.Razorpay({
            key:'rzp_test_6EG87aogPkcGLw',
            //image:'images/logo.png',
            image:'http://waysapp.in/images/logo.png',
        });
        razorpay.createPayment(this.paymentOptions);

        razorpay.on('payment.success', (resp) =>{
            var cnfrmApiObj = new UpdateTransactionWithConfirmRide(this)
            cnfrmApiObj.razorpayResponse = resp;
            cnfrmApiObj.makeRequest(); 
        }); // will pass payment ID, order ID, and Razorpay signature to success handler.

        razorpay.on('payment.error', (resp)=>{
            let errors = []
            errors.push(resp.error.description)
            this.setState({
                modalShow: true,
                errors: errors
            });
        }); // will pass error object to error handler
    }

    loadBookingReceipt = (payload) =>{
        this.props.history.push({
            pathname: '/rides/reciept',
            state: { payload: payload }
        })
    }

    render() { 
        let modalClose = () => this.setState({ modalShow: false });
        let errorTitle = 'Errors'
        return (  
            <Fragment>
                <BookingPanel 
                    vehicleClass={this.state.masterData.vehicleTypes?this.state.masterData.vehicleTypes:[]}
                    tripTypes={this.state.masterData.tripTypes?this.state.masterData.tripTypes:[]}
                    vehicles={this.state.masterData.vehicles?this.state.masterData.vehicles:[]}
                    searchAction={this.handleSearchAction}
                    />
                <div className="tollPlaza m-b" style={this.state.style}>
			        <div className="row flex">
                        <BookingRides
                            hideCheckBox={this.state.showPaymentScreen}  
                        />

                        <BookingVehicles
                            vehicles={this.state.masterData.vehicles?this.state.masterData.vehicles:[]} 
                            hideCheckBox={this.state.showPaymentScreen}
                        />
                        <BookingFare />
                    </div>
                </div>    
                <BookingAgree 
                    handleAgreeCheckbox={this.handleAgreeCheckbox} 
                    onClick = {this.handleProceedBtn}
                    style={this.state.style}
                    hide={this.state.showPaymentScreen}
                />
                
                <PaymentMethods show={this.state.showPaymentScreen} />
                <PaymentDetail show={this.state.showPaymentScreen} 
                    onClick={this.handlePayBtn}
                />
                <PopupAlert 
                    content={this.state.errors}
                    title={errorTitle}
                    show={this.state.modalShow} 
                    onHide={modalClose} 
                />
            </Fragment>
        );
    }
}

const mapStateToProps = state => {
    return {
        masterData: state.defaultReducers.masterData,
        bookingReducers: state.bookingReducers,
        paymentReducers: state.paymentReducers,
        loggedInUser: state.defaultReducers.loggedInUser
    }
}

const mapDispatchToProps = dispatch => {
    return {
        setBookingStatus: value => dispatch(constants.selectBookingOptions(constants.AGREE_TERM_STATUS, value)),
        resetRides: () => dispatch(constants.resetRides()),
        resetSource: () => dispatch(constants.resetSource()),
        resetDestination: () => dispatch(constants.resetDestination()),
        tollSearch: value => dispatch(constants.tollSearchAction(value)),
        setBookingResponse: payload => dispatch({
            type: constants.SET_BOOKING_RESPONSE,
            payload: payload
        })
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(BookRide);