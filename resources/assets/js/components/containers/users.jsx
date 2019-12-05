import React, {Component, Fragment} from 'react';
import {Route} from 'react-router-dom'
import AddUser from './adduser'
import EditUser from './edituser'
import ManageUser from './manageuser'

class Users extends Component {
    
    render() { 
        return (  
            <Fragment>
                <Route path="/users/add" component={AddUser}/>
                <Route path="/users/edit" component={EditUser}/>
                <Route path="/users/manage" component={ManageUser}/>
            </Fragment>
        );
    }
}
 
export default Users;