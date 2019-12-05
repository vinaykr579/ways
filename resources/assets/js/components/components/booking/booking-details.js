import React, {Component,Fragment} from 'react';
import Receipt from '../pdf/receipt'
import './booking-panel.css'

class BookingDetails extends Component{

    state = {
        pdfReceipt: null
    }

    componentDidMount(){
        this.setState({
            pdfReceipt: this.renderPdfDownloadLInk()
        })
    }

    renderPdfDownloadLInk = () => {
        return(
            <div className="payNow m-b text-right">
                <button className="btn btn-default btns">
                    <Receipt booking={this.props.receipt}/>
                </button>
            </div>
        )
    }


    render(){
        let tollAmt = 0; let tollCounter = 0
        if(this.props.details.length === 0){
            return false
        }
        return (
            <Fragment>
                <div className="tollPlaza">
                    <div className="row flex">
                    <div className="col-md-12 tollcol1" id="cbr">
                        <div className="borders ">
                    {this.props.details.ride.AssociateRides.map((aride, index)=> {
                        let aAmt = 0
                        return (
                            <Fragment key={index}>
                                <div className="toll-cbr">   
                                    <h2>{aride.Source_Name+'-'+aride.Destination_Name}</h2>
                                    <ul key={index}>
                                    {aride.Tolls.map((toll, tindex) => {
                                        aAmt += parseFloat(toll.TollFare) 
                                        tollAmt += parseFloat(toll.TollFare)
                                        return (
                                            <li key={tindex}>
                                                <div className="list-val">
                                                    <span>{++tollCounter}</span>
                                                    {toll.Name}
                                                </div>
                                                <div className="rate"><i className="fa fa-inr" aria-hidden="true"></i>{toll.TollFare}</div>
                                            </li>
                                            
                                        )
                                    })}   
                                    
                                    <li>
                                        <div className="list-val">
                                            <h4>Toll Fees</h4>
                                        </div>
                                        <div className="rate total_rate"><i className="fa fa-inr" aria-hidden="true"></i>{aAmt}</div>
                                    </li>
                                    
                                    </ul>
                                </div>
                        </Fragment> 
                        )
                    })}     
                            
                            <div className="toll-cbr">
                                <h4 className="alg">
                                    <span>Vehicle</span>
                                    <span>Booking ID(VRN)</span>
                                    <span>Fare</span>
                                </h4>
                                    <ul className="toll_fare">
                                    {this.props.details.vehicles.map((vehicle, vindex)=>{
                                        return (
                                            <li key={vindex}>
                                                <div className="v_no">{vehicle.RegistrationNumber}</div>
                                                <div className="otp_nos">{vehicle.BookingId}</div>
                                                <div className="v_fare"><i className="fa fa-inr" aria-hidden="true"></i>{vehicle.TotalAmount}</div>
                                            </li>
                                            
                                        )
                                    })}    
                                        
                                    <li>
                                        <div className="t_fare">
                                            <h5><span>(a)</span><b>Toll Fees</b></h5>
                                        </div>
                                        <div className="v_fare"><i className="fa fa-inr" aria-hidden="true"></i>{tollAmt}</div>
                                    </li>
                                    <li>
                                        <div style={{width:'100%'}} className="final_fare column">
                                            
                                            <div className="fare_cal flex">
                                                <div className="t_fare pull-left" >
                                                    <h5><span>(b)</span>Booking Fees @{this.props.details.taxDetails.convenienceChargeVal}%</h5>
                                                </div>
                                                <div className="v_fare pull-right"  >
                                                    <i className="fa fa-inr" aria-hidden="true"></i>
                                                    {this.props.details.taxDetails.convenienceCharge}
                                                </div>
                                            </div>
                                            <div className="fare_cal flex">
                                                <div className="t_fare intGst pull-left" >
                                                    <h5>Integrated GST @{this.props.details.taxDetails.gstVal}%</h5>
                                                </div>
                                                <div className="v_fare pull-right" >
                                                    <i className="fa fa-inr" aria-hidden="true"></i>
                                                    {this.props.details.taxDetails.gst}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div className="amt">Amount Payable</div>
                                        <div className="t_amt"><i className="fa fa-inr" aria-hidden="true"></i>{this.props.details.taxDetails.paidAmount}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                </div>
                {this.state.pdfReceipt}
        </Fragment> 
        )
    }
} 

export default BookingDetails