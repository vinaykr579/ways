import React from 'react';
import './switch.css'

const SwitchElement = (props) => {
    return (
        <label className="switch">
            <input type="checkbox" defaultChecked />
            <span className="slider round"></span>
        </label>
    )
}

export default SwitchElement