import React from 'react';
import { Field, Form } from 'react-final-form'
import {FormTextInput, FormSelectInput, FormButton} from '../ui/form-elements'
import  * as validator from '../../utils/validation-helper'



const UserForm = (props) => (
    <div className="borders">
        <h2 className="namePart">{props.formName}</h2>
        <div className="grid-list p-lr">
            <div className="book_target">
                <div className="adduser">
                 {props.alertmsg}   
        <Form
            onSubmit={props.handleSubmit}
            initialValues={props.initialValues?props.initialValues:{CountryCode:'91',UserRole:'1'}}  
            render={({handleSubmit, submitting, form})=>(
                <form className="form-horizontal" onSubmit={event => {
                   const promise =  handleSubmit(event)
                   //const reset = props.resetForm?props.resetForm:true
                   promise && promise.then(()=>{
                        form.reset();
                        
                    })
                    
                }} >
                   
                    <Field
                        name="CountryCode" 
                        label="Country" 
                        component={FormSelectInput} 
                        options={[{"country":"India", "code":"91"}]} 
                        opt="country" optval="code"
                        validate={validator.required} 
                        />
                    
                    <Field
                        name="UserRole" 
                        label="Role" 
                        component={FormSelectInput} 
                        options={[{"name":"Admin", "value":"1"}, {"name":"Corporate User", "value":"3"}]} 
                        opt="name" optval="value" 
                        validate={validator.required}
                        />

                    <Field 
                        label="Name"
                        placeholder="Enter name"
                        name="Name" 
                        component={FormTextInput}
                        validate={validator.required}
                    />
                    
                    <Field 
                        label="Mobile number"
                        placeholder="Enter mobile number"
                        name="MobileNumber" 
                        component={FormTextInput}
                        validate={validator.composeValidators(validator.required, validator.validMobileNo)}
                    />

                    <Field 
                        label="Email"
                        placeholder="Enter email id"
                        name="EmailId" 
                        component={FormTextInput}
                        validate={validator.required}
                    />    
                    
                    <Field 
                        label="Amount"
                        placeholder="Maximum booking amount"
                        name="MaximumBookingAmount" 
                        component={FormTextInput}
                        validate={validator.composeValidators(validator.required, validator.isNumber, validator.minValue(100))}
                    />    
                    
                    <FormButton disabled={submitting}/>

                </form>

            )}
        
        />            
    </div>
            </div>
        </div>
    </div>            
)

export default UserForm