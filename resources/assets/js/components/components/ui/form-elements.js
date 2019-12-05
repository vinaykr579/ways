import React from 'react';
import {Input, Select} from './elements'

export const FormTextInput = ({ input, label, meta: { touched, error }}) => {
    let inputClass = ['form-control'];
    if(error && touched){
        inputClass = [' form-control has-error '];
    }
    return (
        <div className="form-group">
            <label className="control-label col-sm-2"  htmlFor={input.name}>{label}:</label>
            <div className="col-sm-10">
                <Input className={inputClass} {...input} type="text"/>
                { touched && error && <span className="error">{error}</span>}
            </div>
        </div>
    )
}

export const FormSelectInput = ({ input,label,options,opt,optval, meta: { touched, error }}) => {
    return (
        <div className="form-group">
            <label className="control-label col-sm-2" htmlFor={input.name}>{label}:</label>
            <div className="col-sm-10">
                <Select  className={["form-control"]} {...input} options={options} opt={opt} optval={optval}/>
                { error && <span className="error">{error}</span>}
            </div>
        </div>
    );
}

export const FormButton = (props) => (
    <div className="form-group">
        <div className="col-sm-offset-2 col-sm-10">
            <button  className='btn btn-default btns' {...props}>Save</button>
        </div>
    </div>
)