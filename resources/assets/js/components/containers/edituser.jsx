import React, { Component } from 'react';
import {Redirect} from 'react-router-dom';
import UserForm from '../components/users/user-form';
import UpdateCorporateUser from '../services/updateCorporateUser';
import AlertMsg from '../components/ui/alert-msg';

class EditUser extends Component {
    
    state = {
        alertmsg: '',
        corporateUser: null
    }

    componentDidMount(){
        if(this.props.location.query && this.props.location.query.corporateUser){
            this.setState({corporateUser: this.props.location.query.corporateUser})
        }
    }

    handleSubmit = values => {
        let obj = new UpdateCorporateUser(this)
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
        if(!this.props.location.query || !this.props.location.query.corporateUser){
            return (<Redirect to="/users/manage"/>)
        }
        return (  
            <UserForm
            formName="Update User" 
            handleSubmit={this.handleSubmit}  
            alertmsg={this.state.alertmsg}
            initialValues={this.state.corporateUser}
            resetForm={false}
            />
        );
    }
}
 
export default EditUser;