import React, { Component, Fragment } from 'react';
// import UserSearchForm from '../components/users/user-search-form'
import UserList from '../components/users/user-list'
import GetCorporateUsers from '../services/getCorporateUsers'
import UpdateCorporateUserStatus from '../services/updateCorporateUserStatus'
import Pagination from '../components/ui/pagination'

class ManageUser extends Component {
    
    state = {
        corporate_users:[],
        user_roles: []
    }

    page = 1

    componentDidMount(){
      this.loadCorporateUsers(this.page);
    }

    loadCorporateUsers = page =>{
        let obj = new GetCorporateUsers(this);
        obj.makeRequest(page);
    }

    handleApiResponse = data => {
      
        if(data.message === 'success'){
            this.setState({
              corporate_users: data.response.corporate_users,
              user_roles: data.response.user_roles,
            })
        }
    }

    changeCorporateUserStatus = (corporateId,status)  => {
        let changeTo = parseInt(status)===0?1:0;
        let obj = new UpdateCorporateUserStatus(this);
        obj.makeRequest({Status:changeTo, CorporateId:corporateId});
    }

  

    render() { 
        return (  
            <Fragment>
                {/* <div className="borders">
                  <h2 className="namePart">Manage User</h2>
                  <UserSearchForm />
                </div> */}

                <div className="borders m-b manage">
                  <h2 className="namePart">Manage User</h2>
                  <UserList  
                    corporate_users={this.state.corporate_users}
                    page={this.page}
                    changeCorporateUserStatus={this.changeCorporateUserStatus}
                    userRoles={this.state.user_roles}
                  />
                </div>
                <Pagination />
            </Fragment>
        );
    }
}
 
export default ManageUser;