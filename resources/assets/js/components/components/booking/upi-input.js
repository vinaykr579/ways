import React from 'react';

const UPIInput = (props) => {
    if(props.paymentMode !== 5){
        return false;
    }
    
    return  (
        <div className="tabs">
            <input onChange={props.onChange} type="text" placeholder="UPI Address" />
        </div>
    )
}

export default UPIInput