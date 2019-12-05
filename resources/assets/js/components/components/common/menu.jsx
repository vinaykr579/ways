import React, { Component, Fragment } from 'react';
import { NavLink, Redirect } from 'react-router-dom';
import { connect } from "react-redux"
import ResetAppData from '../../actionClasses/resetAppData'
import {NavMenus} from '../../utils/menu-helper'
import NavItem from '../ui/navitem'

class Menu extends Component {

    constructor(props){
        super(props);
        this.logout = this.logout.bind(this)
    }

    logout(){
        let obj = new ResetAppData(this)
        obj.action();
        return <Redirect to="/" />
    }

    navlinkClickHandler(e){
        // console.log(e.target.closest(".has-subnav").previousSibling.length)
        // if(e.target.closest(".has-subnav") === null){
        //     e.target.closest("li").classList.add("active")
        // }else{
        //     e.target.closest(".has-subnav").classList.add("active")
        // }
        
    }

    render() { 
        let subMenu = [];
        return (
            <Fragment>
                <nav className="main-menu">
                    <ul>
                    {NavMenus.map((menu, mindex) => {
                        subMenu = menu.subNavs?menu.subNavs:[]
                        return <NavItem
                            menu={menu}
                            hasSubMenu={subMenu.length>0?true:false}
                            key={mindex}
                            onClick={this.navlinkClickHandler}
                        />
                    })}
                    
                    </ul>    
                    <ul className="logout">
                        <li> 
                            <NavLink to="#" onClick={this.logout} > 
                                <i className="fa fa-power-off"></i> 
                                <span className="nav-text"> Logout </span> 
                            </NavLink> 
                        </li>
                    </ul>
                </nav>
            </Fragment>
        );
    }
}

const mapDispatchToProps =(dispatch) => {
    return {
        resetStore: payload=>dispatch(payload)
    }
}

const mapStoreToProps = (state) => {
    return {}
}

export default connect(mapStoreToProps, mapDispatchToProps)(Menu);