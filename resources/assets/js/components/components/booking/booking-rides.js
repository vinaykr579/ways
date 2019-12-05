import React,{Component} from 'react';
import {connect} from 'react-redux';
import * as constants from '../../actions/index';
import Spinner from '../ui/spinner'
import RouteSpecific from './tollviews/route-specific'
import TollSpecific from './tollviews/toll-specific'
import CalculatePayableAmount from '../../actionClasses/calculatePayableAmount'


class BookingRides extends Component{
    
    loadSpinner = () => {
        return (<Spinner />)
    }

    handleTollFareAndCounter = (amount=0) => {
        new Promise((resolve, reject) => {
            this.props.setTotalAmount(amount)
            resolve(true);
        }).then(res => {
            var obj = new CalculatePayableAmount(this);
            obj.action()
        })
    }

    handleTollCheckBoxClick =(event) =>{
        let valArr = event.target.value.split('-');
        let payload = {
            rideIndex: valArr[0],
            tollId: valArr[1],
            isSelected: 1
        }
        if(event.target.checked === false){
            payload.isSelected = 0
        }
        this.props.tollSelectionInRide(payload)
    }
    
    handleRenderForBookingType = (obj) => {
        if(this.props.bookingType === 'route-specific'){
            return (
                <RouteSpecific 
                    obj={obj} 
                    Rides={this.props.Rides}
                    handleTollFareAndCounter={this.handleTollFareAndCounter}
                    handleTollCheckBoxClick = {this.handleTollCheckBoxClick}
                />
            )
        }else{
            return (
                <TollSpecific 
                    tripType={this.props.tripTypeId}
                    obj={obj} 
                    Rides={this.props.Rides}
                    handleTollFareAndCounter={this.handleTollFareAndCounter}
                    handleTollCheckBoxClick = {this.handleTollCheckBoxClick}
                />
            )
        }
    }

    render(){
        let obj = {
            counter: 0,
            totalamount: 0,
            rideIndex: 0,
            index: 0,
            checkBoxStyle:{}
        }
        if(this.props.hideCheckBox === true){
            obj.checkBoxStyle = {
                display: 'none'
            }
        }

        return(
            <div className="col-md-4 tollcol1">
                <div  className="borders ">
                {this.props.tollSearchAction===true?this.loadSpinner():''}
                {this.handleRenderForBookingType(obj)}
                </div>
            </div>
        )
    }
}

const mapStateToProps = state => {
    return {
        tollSearchAction:state.bookingReducers.TollSearch,
        Rides: state.bookingReducers.Rides?state.bookingReducers.Rides:[],
        filteredVehicles: state.bookingReducers.filteredVehicles?state.bookingReducers.filteredVehicles:[],
        taxCalculations: state.defaultReducers.masterData.taxCalculations?state.defaultReducers.masterData.taxCalculations:[],
        totalAmount: state.bookingReducers.TotalAmount?state.bookingReducers.TotalAmount:0,
        bookingType: state.bookingReducers.BookingType,
        tripTypeId: state.bookingReducers.TripTypeId,
    }
}

const mapDispatchToProps = dispatch => {
    return {
        setTotalAmount : value => dispatch(constants.selectBookingOptions(constants.SET_TOTAL_AMOUNT, value)),
        tollSelectionInRide: payload => dispatch(constants.selectBookingOptions(constants.TOLL_SELCTION_IN_RIDE, payload)),
        calculatePayableAmount: payload => dispatch(constants.selectBookingOptions(constants.CALC_PAYABLE_AMOUNT, payload)),
    }
}
export default connect(mapStateToProps, mapDispatchToProps)(BookingRides)