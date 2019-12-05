import React, { Component, Fragment } from 'react';
import * as constants from '../../actions/index'
import {connect} from 'react-redux'
import UPIInput from './upi-input'
import CardInput from './card-input'
import NetBankingInput from './netbanking-input'


class PaymentDetail extends Component {
    state = {  
        bankname:"",
        upiAddr:"",
        cardDetails:{
            cardNumber:'',
            expiry:'',
            cvv:'',
            accountHolderName:''
        },
        banks: Object.entries(this.props.banks)
    }

    componentDidMount(){
        const script = document.createElement("script");

        script.src = "https://checkout.razorpay.com/v1/razorpay.js";
        script.async = true;

        document.body.appendChild(script);
    }

    bankListClickHandler = bank =>{
        this.setState({bankname:bank[1]})
        this.props.setNetBankingDetails(bank)
    }

    upiAddrHandler = (e) => {
        this.props.setUPIAddress(e.target.value)
    }

    cardDetailsAhndler = (e) => {
        const name = e.target.name
        const value = e.target.value
        this.setState({ cardDetails: { ...this.state.cardDetails, [name]: value } })
    }

    handleNetBankingSelection = (e) => {
        let banks = []
        var str = '';
        var serachStr = e.target.value;
        this.setState({bankname:serachStr})
        banks = Object.entries(this.props.banks).filter(bank => {
            str = bank[1].replace(/\s/g,'').toLowerCase()
            if(str.indexOf(serachStr.toLowerCase()) >= 0){
                return true
            }else{
                return false
            }
        })
        this.setState({banks: banks})
    }

    render() {
        if(this.props.show === false){
            return false
        } 
        return (
            <Fragment>  
                <div className="borders m-b searchB" id="bank_name" >
                    <CardInput onChange={this.cardDetailsAhndler} paymentMode={this.props.paymentModeId} />
                    <NetBankingInput 
                        banks={this.state.banks} 
                        paymentMode={this.props.paymentModeId}
                        onClick={this.bankListClickHandler}
                        bankname={this.state.bankname}
                        onChange={this.handleNetBankingSelection} 
                    />
                    <UPIInput onChange={this.upiAddrHandler} paymentMode={this.props.paymentModeId} />    
                </div>
                <div className="payNow m-b text-right">
                    <button className="btns" onClick={this.props.onClick}>Pay</button>
                </div>
            </Fragment>
        );
    }
}

const mapStateToProps = state => {
    return {
        paymentModeId: state.bookingReducers.PaymentModeId,
        banks: state.defaultReducers.masterData.netbanking_banks,
    }
}

const mapDispatchToProps = dispatch => {
    return {
        setNetBankingDetails: payload => dispatch({type: constants.SET_NET_BANKING_DETAILS, value: payload}),
        setUPIAddress: payload => dispatch({type: constants.SET_UPI_ADDRESS, value: payload}),
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PaymentDetail);