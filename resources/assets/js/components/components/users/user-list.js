import React, {Fragment} from 'react';
import {Link} from 'react-router-dom'
import {Button} from '../ui/elements'

const UserList = (props) => {
    let counter = (parseInt(props.page)-1)*5
    return (
        <Fragment>
            <div className="grid-list p-lr">
                <div className="list-in lbs">
                <div className="table-responsive">
                    <table className="tables">
                        <thead>
                            <tr>
                                <th width="5%">Sr. No.</th>
                                <th>Mobile Number</th>
                                <th>Email Id</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Maximum <br />Booking Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    {props.corporate_users.map(user => {
                        let btcls = parseInt(user.IsActive) === 1?"btn-success btn-xs":"btn-danger btn-xs"
                        let bttext = parseInt(user.IsActive) === 1?"Active":"Inactive"
                        return (
                            <tr key={user.CorporateId}>
                                <td>{++counter}</td>
                                <td>{user.MobileNumber}</td>
                                <td>{user.EmailId}</td>
                                <td>{user.Name}</td>
                                <td>{props.userRoles[parseInt(user.UserRole)]}</td>
                                <td><i className="fa fa-inr" aria-hidden="true"></i>{user.MaximumBookingAmount}</td>
                                <td><Button onClick={()=>props.changeCorporateUserStatus(user.CorporateId, user.IsActive)} className={[btcls]} >{bttext}</Button></td>
                                <td><Link to={{
                                    pathname:"/users/edit",
                                    query:{corporateUser: user}
                                }}><i className="fa fa-edit"></i></Link></td>
                            </tr>
                        )
                    })}        
                            
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
    
        </Fragment>
    )
    
}
export default UserList