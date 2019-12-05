import React from 'react'
import {Link} from 'react-router-dom'
import {Input, Image} from '../ui/elements'
import  './login.css';

export const LoginPanel = (props) => (
    <div id="login-panel">
        <div className="login-in">
        <div className="login-details"> 
            <a href={sessionStorage.getItem('homeUrl')}>
                <Image src="images/logo_icon_ways.png" />
            </a>
            <div className="forms-area">
            <ul>
                {props.alertMsg}    
                <li>
                    <Input 
                    type="text" 
                    name = "EmailId" 
                    onKeyPress= {props.onKeyPressed} 
                    onChange = {props.onChange} 
                    placeholder="Email Id" />
                </li>
                <li>
                <Input 
                    type="password" 
                    name = "Password" 
                    onKeyPress= {props.onKeyPressed}
                    onChange = {props.onChange}  
                    placeholder="Password" />
                    
                </li>
                <li className="Forgot-password">
                    <Link to='/password/forgot'>Forgot Password?</Link>
                </li>
                
            </ul>
            </div>
            <div className="forget-p">
            <p> <a href={sessionStorage.getItem('homeUrl')+'/registration'}>Create an account</a></p>
            </div>
        </div>
        </div>
    </div>
)

export default LoginPanel;