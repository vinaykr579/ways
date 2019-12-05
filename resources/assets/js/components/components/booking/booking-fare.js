import React, {Component} from 'react';
import {connect} from 'react-redux'

class BookingFare extends Component {

    render(){
        let symbol = '%'
        let b = '(b)'
        let i =0
        return (
            <div className="col-md-4 tollcol1">
                <div className="borders">
                    <h2>{this.props.tripTypeTitle}</h2>
                    <ul>
                    {this.props.filteredVehicles.map((vehicle, index) => {
                        if(parseInt(vehicle.IsSelected) !== 0){
                            return (
                                <li key={vehicle.VehicleId}>
                                    <div className="list-val">
                                        <span>{index+1}</span> {vehicle.RegistrationNumber}
                                    </div>
                                    <div className="rate"><i className="fa fa-inr" aria-hidden="true"></i>{this.props.totalAmount}</div>
                                </li>
                            )
                        }else{
                            return null
                        }
                        
                    })}    
                    
                    
                    <li>
                        <div className="list-val">
                            <span className="bg-none">(a)</span> Toll Fees
                        </div>
                        <div className="rate"><i className="fa fa-inr" aria-hidden="true"></i>{this.props.totalTollFare}</div>
                    </li>
                    {this.props.calculationDetails.map(tax => {
                        b = parseInt(i)===0?b:''
                        i++
                        return (
                            <li key={tax.TaxCalculationId}>
                                <div className="list-val">
                                    <span className="bg-none">{b}</span>{tax.Description} @ {tax.TaxValue}{symbol}
                                </div>
                                <div className="rate"><i className="fa fa-inr" aria-hidden="true"></i>{tax.Amount}</div>
                            </li>       
                        )
                    })}
                    <li>
                        <div className="list-val">
                            <h4>Amount Payable</h4>
                        </div>
                        <div className="rate total_rate"><i className="fa fa-inr" aria-hidden="true"></i> {this.props.chargableAmount.toFixed(2)}</div>
                    </li>
                    </ul>
                </div>
            </div>
        
        )
    }

}

const mapStateToProps = state => {
    return {
        tripTypeTitle: state.bookingReducers.TripTypeTitle?state.bookingReducers.TripTypeTitle:'',
        filteredVehicles: state.bookingReducers.filteredVehicles?state.bookingReducers.filteredVehicles:[],
        totalAmount: state.bookingReducers.TotalAmount?state.bookingReducers.TotalAmount:0,
        calculationDetails: state.bookingReducers.CalculationDetails?state.bookingReducers.CalculationDetails:[],
        totalTollFare: state.bookingReducers.TotalTollFare?state.bookingReducers.TotalTollFare:0,
        chargableAmount: state.bookingReducers.ChargableAmount?state.bookingReducers.ChargableAmount:0
    }
}

export default connect(mapStateToProps)(BookingFare)