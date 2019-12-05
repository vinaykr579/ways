import React, { Component} from 'react';
import { NavLink } from 'react-router-dom';
import { Image } from './elements'

class NavItem extends Component{

    render(){
        if(this.props.hasSubMenu === true){
            return (
                <li key={this.props.menu.title} className="has-subnav"> 
                    <NavLink activeClassName="active" to={this.props.menu.to}> 
                        <Image src={this.props.menu.imageSrc} /> 
                        <span className="nav-text">{this.props.menu.title}</span> 
                        <i className="fa fa-angle-right" aria-hidden="true"></i>
                        <i className="icon-angle-down"></i> 
                    </NavLink>
                    <ul>
                        {this.props.menu.subNavs.map((subm, index) => {
                            return (<li  onClick={this.props.onClick} key={index}>
                                <NavLink  
                                    className="subnav-text" 
                                    to={subm.to}>{subm.title}
                                </NavLink>
                            </li>)
                        })}
                        
                    </ul>
                </li>
            )
        }else{
            return (
                <li key={this.props.menu.title} onClick={this.props.onClick} > 
                    <NavLink activeClassName="active" to={this.props.menu.to}>
                        <Image src={this.props.menu.imageSrc} />
                        <span className="nav-text">{this.props.menu.title}</span>
                    </NavLink>
                </li>
            )
        }
        
    }
    
}

export default NavItem