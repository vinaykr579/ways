import React, {Component, Fragment} from 'react';
import Cards from 'react-credit-cards'
import Cleave from 'cleave.js/react'
import {connect} from 'react-redux'
import { setCardDetails } from '../../actions/index'
import './booking-panel.css'
import 'react-credit-cards/lib/styles.scss'

class CardInput extends Component{

    state = {
        number:'',
        expiry:'',
        cvc:'',
        name:'',
        focused:'number'
    }
    
    handleInputChange = (e) => {
        const name = e.target.name
        const value = e.target.value
        this.setState({ 
            [name]: value,
            focused: name
         })
        
       this.props.setCardDetails(name, value);  
    }



    render(){
        if(this.props.paymentMode !== 2){
            return false;
        }
    
        return (
            <Fragment>
                <div>
                    <div className="tabs" style={{width:'45%', float:'left', padding:'15px'}}>
                        <Cards
                            number={this.state.number}
                            name={this.state.name}
                            expiry={this.state.expiry}
                            cvc={this.state.cvc}
                            focused={this.state.focused}
                        />
                    </div>
                    <div className="tabs"  style={{width:'45%', float:'right', margin:'20px'}}>
                        <Cleave options={{creditCard:true}} onChange={this.handleInputChange} name="number" placeholder="Card Number" />
                        <Cleave options={{date:true, datePattern: ['m', 'y']}}  onChange={this.handleInputChange}  name="expiry" type="text" placeholder="Expiry Date MM/YY" />
                        <Cleave options={{numeral: true}}  onChange={this.handleInputChange} name="cvc" type="text" placeholder="CVV" />
                        <input type="text"  onChange={this.handleInputChange} name="name" placeholder="Name on the Card" />
                    </div>
                    <div style={{clear:'both', fontSize:'1px'}}></div>
                </div>
            </Fragment>
        )
    }
} 

const mapStateToProps = state => {
    return {}
}

const mapDispatchToProps = dispatch => {
    return {
        setCardDetails: (type, value) => dispatch(setCardDetails(type, value))
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(CardInput)