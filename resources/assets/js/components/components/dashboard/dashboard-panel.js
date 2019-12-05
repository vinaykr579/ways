import React, { Fragment } from 'react';
const DashboardPanel = (props) => (
    <Fragment>
        
        <div className="grid-list">
            <div className="list-in">
            <ul>
                <li>
                    <div className="text-sec">
                        <h2>{props.bookedTolls}</h2>
                        <h5>Toll Booked</h5>
                    </div>
                </li>
                <li>
                    <div className="text-sec">
                        <h2><span><i className="fa fa-inr" aria-hidden="true"></i></span>{props.amountPaid}</h2>
                        <h5>Amount Paid</h5>
                    </div>
                </li>
                <li>
                    <div className="text-sec">
                        <h2>{props.bookedRide}</h2>
                        <h5>Book Journey</h5>
                    </div>
                </li>
                <li>
                    <div className="text-sec">
                        <h2>{props.ongoingRide}</h2>
                        <h5>Ongoing Journey</h5>
                    </div>
                </li>
                <li>
                    <div className="text-sec">
                        <h2>{props.bookedVehicle}</h2>
                        <h5>Booked Vehicle</h5>
                    </div>
                </li>
            </ul>
            </div>
        </div>
    </Fragment>
)

export default DashboardPanel