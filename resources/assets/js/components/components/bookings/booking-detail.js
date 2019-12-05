import React, {Fragment} from 'react';
import {Link} from 'react-router-dom'
import Receipt from '../pdf/receipt'
import './booking.css'
import {getTripTypeTitle, getVehicleTypeTitle , datetimeTodate} from '../../utils/helper'

export const BookingDetail = (props) => {
    let bookingType = props.booking.Ride.BookingType==='route-specific'?'Route specific':'Toll specific'
    let toll = (booking) =>{
        let ret = ''
        if(booking.Ride.BookingType === 'route-specific'){
            let source = booking.Ride.Source_Name
            let destination = booking.Ride.Destination_Name
            ret = source+'-'+destination
        }else{
            let aride = booking.Ride.AssociateRides[0]
            ret = aride.Tolls[0].Name
        }
        return ret
    }

    let vehicles = props.booking.VehicleBookings.map(vehicle => {
        return vehicle.RegistrationNumber
    })
    
    return (
        <Fragment>
            <tr>
                <td>{props.counter}</td>
                <td>{datetimeTodate(props.booking.Transaction.UpdatedOnDate)}</td>
                <td>{props.booking.Transaction.TransactionId}</td>
                <td>{getVehicleTypeTitle(props.booking.Ride.VehicleTypeId)}</td>
                <td>{getTripTypeTitle(props.booking.Ride.TripTypeId)}</td>
                <td>{bookingType}</td>
                <td title={vehicles.join(', ')}>{props.booking.VehicleBookings.length}</td>
                <td>{toll(props.booking)}</td>
                <td><span>
                        <i className="fa fa-inr" aria-hidden="true"></i>
                        </span>{props.booking.Transaction.Amount}
                </td>
                <td>
                    <Link onClick={(e) => props.onClick(e)} to="#" className="openTr">
                        <i className="fa fa-angle-double-right" aria-hidden="true"></i>
                    </Link>
                </td>
                <td>
                    <Receipt booking={props.booking}/>
                </td>
            </tr>
            <tr style={{display:'none'}}>
                <td colSpan="11">
                    <ReceiptDetails booking={props.booking} />
                </td>
            </tr>
        </Fragment>
    )

}


const ReceiptDetails = (props) => {
    return (
        <table style={{width:'100%', padding:'30px'}} className="tableSlideOpen">
            <tbody>
            <RideDetails ride={props.booking.Ride}/>
            <tr>
                <td colSpan="2"><strong>Toll Fees</strong></td>
                <td colSpan="1">
                    <strong>
                        <i className="fa fa-inr" aria-hidden="true"></i>
                        {props.booking.Ride.TotalAmount}
                    </strong>
                </td>
            </tr>
            <tr>
                <td><strong>Vehicles</strong></td>
                <td><strong>Vehicle Reference No</strong></td>
                <td><strong>Fare</strong></td>
            </tr>
            {props.booking.VehicleBookings.map(vehicle => {
                return (
                    <tr key={vehicle.RegistrationNumber}>
                        <td>{vehicle.RegistrationNumber}</td>
                        <td>{vehicle.BookingId?vehicle.BookingId:''}</td>
                        <td>
                            <i className="fa fa-inr" aria-hidden="true"></i>
                            {vehicle.TotalAmount}
                        </td>
                    </tr>
                )
            })}
            <TaxCalculations transaction={props.booking.Transaction} />
            <tr>
                <td colSpan="2"><strong>Amount Payable</strong></td>
                <td colSpan="1">
                    <strong>
                        <i className="fa fa-inr" aria-hidden="true"></i>
                        {props.booking.Transaction.Amount}
                    </strong>
                </td>
            </tr>
            </tbody>
        </table>

    )
}

const RideDetails = (props) => {
    if(props.ride.BookingType === 'route-specific'){
        let i =0
        return (
            props.ride.AssociateRides.map(aride=>{
                return (
                    <Fragment key={aride.AssociateRideId}>
                        <tr>
                            <td colSpan="3">
                                <span className="arideTitle">
                                    <strong>{aride.Source_Name}-{aride.Destination_Name}</strong>
                                </span>
                            </td>
                        </tr>
                        {aride.Tolls.map(toll => {
                           return(
                               <tr key={toll.TollId}>
                                   <td colSpan="2"><span  className="srNo">{++i}.</span>{toll.Name}</td>
                                   <td colSpan="1">
                                    <i className="fa fa-inr" aria-hidden="true"></i>
                                    {toll.TollFare}
                                   </td>
                               </tr>
                           ) 
                        })}
                    </Fragment>
                )
            })
        )
    }else{
        let tollname = props.ride.AssociateRides[0].Tolls[0].Name
        let tripType = getTripTypeTitle(props.ride.TripTypeId)
        let i =0
        return(
            <Fragment>
                <tr>
                    <td colSpan="3"  className="arideTitle">
                        <strong>{tollname}</strong>
                    </td>
                </tr>
                {props.ride.AssociateRides.map(aride => {
                    return (
                        <tr key={aride.AssociateRideId}>
                            <td colSpan="2"><span className="srNo">{++i}.</span>{tripType}</td>
                            <td colSpan="1">
                                <i className="fa fa-inr" aria-hidden="true"></i>
                                {aride.Tolls[0].TollFare}
                            </td>
                        </tr>
                    )
                })}    
            </Fragment>
        )
    }
}


const TaxCalculations = (props) => {
    
    return(
        <Fragment>
            <tr>
                <td colSpan="2">(a). Toll Fees</td>
                <td colSpan="1">{props.transaction.TollAmount}</td>
            </tr>
            <tr rowSpan="2">
                <td colSpan="2">
                    <div className="flex">(b). Booking Fee @ {props.transaction.ConvenienceChargesTaxValue}%</div>
                    <div className="flex">Integrated GST @ {props.transaction.GSTTaxValue}%</div>
                </td>
                <td colSpan="1">
                    <div className="flex">
                        <span>
                            <i className="fa fa-inr" aria-hidden="true"></i>
                            {props.transaction.ConvenienceCharges}
                        </span>
                    </div>
                    <div className="flex">
                        <span>
                            <i className="fa fa-inr" aria-hidden="true"></i>
                            {props.transaction.GST}
                        </span>
                    </div>
                </td>
            </tr>
        </Fragment>
    )
}

export const TableHeading = () => (
    <tr>
        <th>S.NO.</th>
        <th>DATE</th>
        <th>INVOICE</th>
        <th>CLASS</th>
        <th>TICKET</th>
        <th>BOOKING</th>
        <th>VECHILE(S)</th>
        <th>TOLLS</th>
        <th>TOTAL</th>
        <th>VIEW</th>
        <th>DOWNLOAD</th>
    </tr>
)