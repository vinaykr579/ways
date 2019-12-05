import React from 'react';

const AlertMsg = (props) => {
    let alertClasses = 'alert ';
    let type = props.type?props.type:'';
    if(type=== 'success'){
        alertClasses += ' alert-success';
    }else if(type === 'danger'){
        alertClasses += ' alert-danger';
    } else if(type === 'info'){
        alertClasses += ' alert-info';
    }
    alertClasses += props.className?props.className:''

    return (
        <div className="row" style={props.pstyle?props.pstyle:{}}>
            <div className={alertClasses}>{props.message}</div>
        </div>
    )
}

export default AlertMsg;