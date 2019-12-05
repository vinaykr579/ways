import React, {Fragment} from 'react';
import {Input} from '../ui/elements'

const NetBankingInput = (props) => {
    if(props.paymentMode !== 3){
        return false;
    }
    
    return (
        <Fragment>
            <div className="tabs">
                <Input 
                    type="text" 
                    placeholder="Bank Name" 
                    value={props.bankname}
                    onChange={props.onChange} 
                />
            </div>
            <ul style={{overflowY:'scroll',height:'200px'}}>
                {props.banks.map(bank=>{
                    return (
                        <li onClick={((e)=>{props.onClick(bank)})} key={bank[0]}>{bank[1]}</li>
                    )
                })}
                
            </ul>
        </Fragment>
    )
}

export default NetBankingInput