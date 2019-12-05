import React from 'react';

const LoggedInUser = (props) => (
    <div className="user-name text-right">
        <h6>Welcome ,{props.name}</h6>
    </div>
)
    
 
export default LoggedInUser;