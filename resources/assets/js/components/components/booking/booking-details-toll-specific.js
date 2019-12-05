import React, {Component , Fragment} from 'react';
import {connect} from 'react-redux'
import {getTripTypeTitle} from '../../utils/helper' 
import Receipt from '../pdf/receipt'
import './booking-panel.css'

class BookingDetailsTollSpecific extends Component{
    
    consts ={
        aAmt: 0,
        tollAmt:0,
        tindex:0,
        tripTitle:''
    }

    state = {
        pdfReceipt: null
    }

    getTollName = () => {
        return this.props.details.ride.AssociateRides[0].Tolls[0].Name
    }

    getListTitle = () => {
        let tripTypeId = this.props.details.ride.TripTypeId
        switch(parseInt(tripTypeId)){
            case 3:
                let title =  getTripTypeTitle(tripTypeId)
                if(this.consts.tripTitle === 'Return' || this.consts.tripTitle === ''){
                    this.consts.tripTitle = title
                }else{
                    this.consts.tripTitle = 'Return'
                }
                break
            default:    
                this.consts.tripTitle = getTripTypeTitle(tripTypeId)
        }
        return this.consts.tripTitle
    }

    getListItem = (aride) => {
        if(aride.IsReturnRideId !== 0){return }
        let toll = aride.Tolls[0]
        this.consts.aAmt = parseInt(this.consts.aAmt) + parseInt(toll.TollFare) 
        this.consts.tollAmt = parseFloat(toll.TollFare)
        this.consts.tindex++
        return (
            <li key={this.consts.tindex}>
                <div className="list-val">
                    <span>{this.consts.tindex}</span>
                    {this.getListTitle()}
                </div>
                <div className="rate"><i className="fa fa-inr" aria-hidden="true"></i>{toll.TollFare}</div>
            </li>
            
        )
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
        if(this.props.details.length === 0){
            return false
        }

        return (
            <Fragment>
                <div className="tollPlaza">
                    <div className="row flex">
                    <div className="col-md-12 tollcol1" id="cbr">
                        <div className="borders ">
                            <div className="toll-cbr">
                                <h2>{this.getTollName()}</h2>
                                <ul>
                                {this.props.details.ride.AssociateRides.map((aride, index)=> {
                                        return (
                                            <Fragment key={index}>
                                                {this.getListItem(aride)}   
                                            </Fragment> 
                                        )
                                })}

                                    <li>
                                        <div className="list-val">
                                            <h4>Toll Fees</h4>
                                        </div>
                                        <div className="rate total_rate">
                                            <i className="fa fa-inr" aria-hidden="true"></i>
                                            {this.consts.aAmt}
                                        </div>
                                    </li>
                                    

                                </ul>
                         
                            </div>
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
                                        <div className="v_fare"><i className="fa fa-inr" aria-hidden="true"></i>{this.consts.tollAmt}</div>
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

const mapStateToProps = state => {
    return {
        defaultReducer: state.defaultReducer
    }
}

export default connect(mapStateToProps)(BookingDetailsTollSpecific)