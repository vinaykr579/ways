import React from 'react';

const Logo = (props) => (
    <section className="title-bar">
        <div className="logo">
            <h1><a href="/"><img src="images/logo.png" alt="" /></a></h1>
        </div>
        <div className="menuicon"><i className="fa fa-bars" aria-hidden="true"></i></div>
        <div className="clearfix"> </div>
    </section>
)
    
 
export default Logo;