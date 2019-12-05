import React, { Component, Fragment } from 'react';
import BookingDetails from '../components/booking/booking-details'
import BookingDetailsTollSpecific from '../components/booking/booking-details-toll-specific'
import ArrangeRideDataForReceipts from '../actionClasses/arrangeRideDataForReceipts'

class BookingReceipt extends Component {
    state = { 
        receiptDetails: {}
    }

    componentWillMount(){
        let obj = new ArrangeRideDataForReceipts();
        let rides = this.props.history.location.state.payload.rides
        let transaction = this.props.history.location.state.payload.transaction
        this.setState({
             receiptDetails: obj.action(rides, transaction)
        })
    }

    handleTollAndRouteSpecific = () => {
        if(this.state.receiptDetails.ride.BookingType === 'route-specific'){
            return (<BookingDetails  
                receipt={this.prepareReceiptData()} 
                details={this.state.receiptDetails} />)
        }else{
            return (<BookingDetailsTollSpecific 
                receipt={this.prepareReceiptData()}    
                details={this.state.receiptDetails}/>)
        }
        
    }

    prepareReceiptData = () => {
        let booking = {
            Ride: this.props.history.location.state.payload.rides[0],
            Transaction: this.props.history.location.state.payload.transaction,
            VehicleBookings: this.state.receiptDetails.vehicles
        }
        return booking
    }

    render() { 
        
        return (  
            <Fragment>
                {this.handleTollAndRouteSpecific()}        
            </Fragment>    
        );
    }
}
 
export default BookingReceipt;