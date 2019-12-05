import React, { Component } from 'react';
import ReeValidate from 'ree-validate'
import ForgotPasswordPanel from '../components/login/forgot-password-panel'
import PasswordForgot from '../services/passwordForgot'
import AlertBox from '../components/ui/alert'

let alertClass = 'alert-success';
class ForgotPassword extends Component{

    constructor(props){
        super(props)
        this.state = {
            formData:{
                EmailId:''
            },
            msgAction: false,
            messages: {
                items:[]
            }
        }
        this.validator = new ReeValidate({
            EmailId: 'required|email'
        })
        
    }

    handleOnChange = (e) => {
        const name = e.target.name
        const value = e.target.value
        this.setState({ formData: { ...this.state.formData, [name]: value } })
    }

    handleOnKeyPress = (e) =>{
        if(e.key === 'Enter'){
            const { formData } = this.state
            const { errors } = this.validator

            this.validator.validateAll(formData)
            .then(success => {
                if (success) {
                    this.setState({ 
                        messages:{...this.state.messages, items:[{msg:'Checking...'}]},
                        msgAction:true 
                    })
                    this.passwordForgotRequest();
                } else {
                    this.setState({ messages:errors, msgAction:true })
                }
            })
        }
    }

    passwordForgotRequest = () => {
        let obj = new PasswordForgot(this)
        obj.makeRequest(this.state.formData);
    }

    prepareErrorMsg(){
        return(
            <ul>
            {this.state.messages.items.map((err, index) =>{
                return (<li key={index}>{err.msg}</li>)
            })}
           </ul>
        )
        
    }

    alertMsg(){
        return(
            <li>
                <AlertBox className={alertClass} alertMsg={this.prepareErrorMsg()} />
            </li>
        )
    }

    render(){
        return (
            <ForgotPasswordPanel 
                onChange={this.handleOnChange}
                onKeyPress = {this.handleOnKeyPress} 
                alertMsg={this.state.msgAction=== true?this.alertMsg():''}   
            />
        )
    }
}

export default ForgotPassword