import React from 'react';
import {Input, Button} from '../ui/elements'

const UserSearchForm = (props) => (
    <div className="grid-list p-lr">
        <div className="book_target">
        <div className="adduser">
            <div className="col-sm-4 ride">
                <Input type="text" placeholder="User Name" />
            </div>
            <div className="col-sm-4 ride">
                <Input type="tel" placeholder="Mobile No." />
            </div>
            <div className="clearfix"></div>
            <div className="col-sm-4 ride">
                <Input type="email" placeholder="Email" />
            </div>
            <div className="col-sm-4 ride">
                <Input type="text" placeholder="Maxium Booking Amount" />
            </div>
            <div className="clearfix"></div>
            <div className="col-sm-4 ride">
                <Button className={['btns']}>Save</Button>
            </div>
        </div>
        </div>
    </div>

)

export default UserSearchForm