import React,{Component} from 'react';
import {connect}  from 'react-redux';
import {Checkbox} from '../ui/elements'
import * as constants from '../../actions/index'
import CalculatePayableAmount from '../../actionClasses/calculatePayableAmount'

class BookingVehicles extends Component {

    handleCheckBoxChange = (event) => {
        
        const target = event.target;
        
        if(target.checked === true){
            let promise = new Promise((resolve, reject) => {
                this.props.setSelectedVehicles(target.value) 
                resolve('done');   
            });
            promise.then(value => {
                let obj = new CalculatePayableAmount(this)
                obj.action()
            })
            
            
        }else{
            let promise = new Promise((resolve, reject) => {
                this.props.unsetSelectedVehicles(target.value) 
                resolve('done');   
            });
            promise.then(value => {
                let obj = new CalculatePayableAmount(this)
                obj.action()
            })
        }
        
        
    }

    render(){

        var checkBoxStyle = {};
        if(this.props.hideCheckBox === true){
            checkBoxStyle = {
                display: 'none'
            }
        }

        return (
            <div className="col-md-4 tollcol1">
                <div className="borders">
                    <h2>{this.props.vehicleClassName}</h2>
                    <ul>
                     {
                         this.props.filteredVehicles.map(vehicle=>{
                            return (
                                <li key={vehicle.VehicleId}>
                                    <label>
                                    <Checkbox style={checkBoxStyle} onChange={this.handleCheckBoxChange} value={vehicle.VehicleId}/>
                                        {vehicle.RegistrationNumber}
                                    </label>
                                </li>
                            )
                         })
                     }   
                        
                    </ul>
                </div>
            </div>
            
        )
        
    }
} 

const mapStateToProps = state => {
    return {
        vehicleTypeId: state.bookingReducers.VehicleTypeId,
        filteredVehicles: state.bookingReducers.filteredVehicles?state.bookingReducers.filteredVehicles:[],
        vehicleClassName: state.bookingReducers.vehicleClassName?state.bookingReducers.vehicleClassName:'',
        selectedVehicles: state.bookingReducers.SelectedVehicles?state.bookingReducers.SelectedVehicles:[],
        taxCalculations: state.defaultReducers.masterData.taxCalculations?state.defaultReducers.masterData.taxCalculations:[],
        totalAmount: state.bookingReducers.TotalAmount?state.bookingReducers.TotalAmount:0,
    }
}

const mapDispatchToProps = dispatch => {
    return {
        setSelectedVehicles: value => dispatch(constants.selectBookingOptions(constants.SET_SELECTED_VEHICLES, value)),
        unsetSelectedVehicles: value => dispatch(constants.selectBookingOptions(constants.UNSET_SELECTED_VEHICLES, value)),
        calculatePayableAmount: payload => dispatch(constants.selectBookingOptions(constants.CALC_PAYABLE_AMOUNT, payload))
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(BookingVehicles)