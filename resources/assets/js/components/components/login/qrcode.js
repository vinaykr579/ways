import React from 'react';
import {Image} from '../ui/elements'

const qrCode = (props) => (
    <div className="toll-in">
        <Image src={props.imaSrc}/>	
        <h6>Scan QR code via Ways App</h6>
    </div>
)

export default qrCode