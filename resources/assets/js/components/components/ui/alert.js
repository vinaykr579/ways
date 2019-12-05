import React from 'react';

const AlertBox = (props) => {
    return (
        <div className={['clearfix alert', props.className].join(' ')} role="alert">
            {props.alertMsg}
        </div>
    )
}

export default AlertBox