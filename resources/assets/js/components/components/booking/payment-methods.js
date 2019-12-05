import React, { Component } from 'react';
import {connect} from 'react-redux'
import {SET_PAYMENT_MODE, selectBookingOptions} from  '../../actions/index'
import {Input} from '../ui/elements'
import './booking-panel.css'

class PaymentMethods extends Component {
    state = {
       card:true,
       netbanking:false,
       upi: false 
    }

    handlePaymentMethodClick = (method,paymentMode) => {
        let statedef = {
            card:false,
            netbanking:false,
            upi:false
        }
        statedef[method] = true
        this.setState(statedef)
        this.props.setPaymentMode(paymentMode)
    }

    render() {
        
        if(this.props.show === false){
            return false
        }
        
        return (  
            <div className="borders m-b" id="payways">
			<h2 className="namePart">Payment Method</h2>
			<table className="data">
                <tbody>
                    <tr>
                        <td className="payDetails" onClick={((e)=>this.handlePaymentMethodClick('card',2))} >
                            <Input 
                                type="radio" 
                                name="PaymentMode" 
                                id="f15" 
                                className={['input-hidden']} 
                                defaultChecked={this.state.card}
                            />
                            <label htmlFor="f15">
                                Card</label>
                        </td>
                        <td className="payDetails"  onClick={((e)=>this.handlePaymentMethodClick('netbanking',3))} >
                            <Input
                             type="radio" 
                             name="PaymentMode" 
                             id="f16" 
                             className={['input-hidden']}
                             defaultChecked={this.state.netbanking} 
                            />
                            <label htmlFor="f16">Netbanking</label>
                        </td>
                        <td style={{borderRight:'0'}} className="payDetails" onClick={((e)=>this.handlePaymentMethodClick('upi',5))} >
                            <Input
                             type="radio" 
                             name="PaymentMode" 
                             id="f17" 
                             className={['input-hidden']}
                             defaultChecked={this.state.upi} 
                             />
                                <label htmlFor="f17">UPI</label>
                        </td>
                    </tr>
                </tbody>
            </table>	
		</div>
        );
    }
}

const mapStateToProps = state =>{
    return {
    }
}

const mapDispatchToProps = dispatch => {
    return {
        setPaymentMode : paymentMode => dispatch(selectBookingOptions(SET_PAYMENT_MODE, paymentMode))
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(PaymentMethods);