import React, { Component } from 'react';
import UserForm from '../components/users/user-form';
import AddCorporateUser from '../services/addCorporateUser';
import AlertMsg from '../components/ui/alert-msg';

class AddUser extends Component {
    
    state = {
        alertmsg: ''
    }

    handleSubmit = values => {
        let obj = new AddCorporateUser(this)
        return obj.makeRequest(values);
    }

    apiResponseHandler = (data) => {
        let type = '';
        let message = '';
        if(data.message === 'success'){
            type = 'success'
            message = data.response.message;
        }else{
            message = data.response.error
            type = 'danger'
        }
        this.setState({
            alertmsg: this.getAlertMessage(message, type)
        });  
          
        return true;
    }

    getAlertMessage = (message, type) => {
        
        return (<AlertMsg message={message} type={type} pstyle={{padding:'15px'}} className=" col-md-offset-2 col-md-10" />)
    }



    render() { 
        return (  
            <UserForm
            formName="Add User" 
            handleSubmit={this.handleSubmit}  
            alertmsg={this.state.alertmsg}/>
        );
    }
}
 
export default AddUser;