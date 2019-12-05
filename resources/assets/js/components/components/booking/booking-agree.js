import React from 'react';
import {Link} from 'react-router-dom'
import {Checkbox, Button} from '../ui/elements'

const BookingAgree = (props) => { 
    if(props.hide === true){
        return false
    }

    return(
    <div className="term m-b" style={props.style}>
        <div className="col-md-12 borders">
            <div className="pay flex">
                <div className="tick">
                    <Checkbox onClick={props.handleAgreeCheckbox}/> 
                    I agree to <Link to="#">Terms & Conditions</Link>
                </div>
                <div className="pay-in">
                    <Button onClick={props.onClick} className={["btns"]}>Proceed</Button>
                </div>
            </div>
        </div>
    </div>
)}

export default BookingAgree