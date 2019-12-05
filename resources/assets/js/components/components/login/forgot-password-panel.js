import React from 'react';
import {Link} from 'react-router-dom'
import {Input, Image} from '../ui/elements'
import  './login.css';

const ForgotPasswordPanel = (props) => (
    <section id="container-area">
        <form method="post" action="#" onSubmit={(e)=> {  
            e.preventDefault()}}>
        <div id="login-panel" style={{width:'100%'}}>
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
                            onKeyPress= {props.onKeyPress} 
                            onChange = {props.onChange}  
                            placeholder="Email Id" 
                            />
                        </li>
                        <li className="Forgot-password">
                            <Link to="/">Sign In?</Link>
                        </li>
                        
                    </ul>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </section>
)

export default ForgotPasswordPanel