import React, { Component } from 'react';
import {TableHeading, BookingDetail} from '../components/bookings/booking-detail'
import GetBookings from '../services/getBookings'
// import Pagination from '../components/ui/pagination';

class Bookings extends Component {
    
    constructor(props){
        super(props)
        this.state = { 
            bookings: [],
        }
        this.loadBookingData(1)
    }

    counter =0
    handleBookingDetailClick = (ele) => {
        let slideEle = ele.target.parentElement.parentElement.parentNode.nextSibling;
        if(slideEle != null){
            if(slideEle.style.display === ''){
                slideEle.style.display = 'none'
            }else{
                slideEle.style.display = ''
            }
        }
    }


    loadBookingData = (page) => {
        let obj = new GetBookings(this)
        obj.makeRequest(page);
    }

    render() { 
        this.counter =0
        return (
            <div className="borders m-b">
                  <h2 className="namePart">Bookings</h2>
                  <div className="grid-list p-lr">
                        <div className="list-in lbs">
                            <div className="table-responsive">
                                <table className="tables">
                                    <thead>
                                        <TableHeading />
                                    </thead>
                                    <tbody>
                                {this.state.bookings.map(booking => {
                                    this.counter++
                                    return (<BookingDetail 
                                        key={booking.Transaction.TransactionId}
                                        booking={booking}
                                        counter={this.counter} 
                                        onClick={this.handleBookingDetailClick} 
                                        />)
                                })}        
                                        
                                    </tbody>
                                </table>
                            </div>
                            {/* <div style={{padding: '1.5rem',
    marginRight: '0',
    marginLeft: '0',
    borderWidth: '.2rem'}}>
                               <Pagination />
                                
                            </div> */}
                                
                        </div>
                  </div>
            </div>
        );
    }
}
 
export default Bookings;