import React, { Component, Fragment } from 'react';
import {Route} from 'react-router-dom'
import BookRide from './bookride'
import Bookings from './bookings'
import BookingReceipt from './bookingreceipt'

class Ride extends Component {
    
    render() { 
        return (  
            <Fragment>
                    <Route path="/rides/book" component={BookRide}/>
                    <Route path="/rides/bookings" component={Bookings}/>
                    <Route path="/rides/reciept" component={BookingReceipt}/>
            </Fragment>
        );
    }
}
 
export default Ride;