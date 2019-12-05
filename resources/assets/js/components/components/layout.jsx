import React,{ Component,Fragment} from 'react';
import Menu from './common/menu'
import Logo from './common/logo'
import LoggedInUser from './common/loggedInUser'

class Layout extends Component {

    
    getUserName(){
        var user = JSON.parse(sessionStorage.getItem('user'))
        return user.Name
    }

    render(){
        return (
            <Fragment>
                <Menu />
                <div className="wrapper scrollable">
                    <Logo />
                    <div className="main-grid">
                        <LoggedInUser name={this.getUserName()} />
                        {this.props.children}
                    </div>
                </div>
            </Fragment>
        )
    }
}


export default Layout;
