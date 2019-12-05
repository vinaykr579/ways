import React, {Component, Fragment} from 'react';
import {connect} from 'react-redux'
import Autocomplete from 'react-autocomplete'
import { Button, Input, Select, SelectAmount} from '../ui/elements'
import LocationSearchInput from '../maps/locationSearchInput'
import * as constants from '../../actions/index'
import GetTollInfoAndFare from '../../services/getTollInfoAndFare'
import CalculatePayableAmount from '../../actionClasses/calculatePayableAmount'
import './booking-panel.css'


class BookingPanel extends Component {

    constructor(props){
        super(props);
        this.state = {
            vehicleTypePayload: {
                vehicleTypeId:1,
                filteredVehicles: this.props.vehicles.filter(vehicle=>{
                    vehicle.IsSelected = 0;
                    return parseInt(vehicle.VehicleType) === 1
                }),
                vehicleClassName : this.getVehicleClass(1)
            },
            tripTypePayload: {
                tripTypeId: 1,
                tripTypeTitle: this.getTripTypeTitle(1)    
            },
            vehicleTypes:this.props.vehicleClass,
            tripTypes:this.props.tripTypes,
            destinations:[],
            tollname:'',
            toll:false,
            paygAmount:500,
            type:'route-specific',
            optionValue:1
        }
        this.props.setVehicleType(this.state.vehicleTypePayload);
        
        this.props.setTripType(this.state.tripTypePayload);
    }

    toll = {}

    getTripTypeTitle = tripTypeId => {
        let typeObj = this.props.tripTypes.find(o => parseInt(o.TripTypeId) === parseInt(tripTypeId));
        return typeObj.Title?typeObj.Title:''
    }

    getVehicleClass = vehicleType => {
        let typeObj = this.props.vehicleClass.find(o => parseInt(o.TypeId) === parseInt(vehicleType));
        return typeObj.Description?typeObj.Description:''
    }

    handleVehicleTypeChange = event => {
        const payload = {
            vehicleTypeId:event.target.value,
            filteredVehicles: this.props.vehicles.filter(vehicle=>{
                vehicle.IsSelected = 0;
                return parseInt(vehicle.VehicleType) === parseInt(event.target.value)
            }),
            vehicleClassName : this.getVehicleClass(event.target.value)
        }
        this.setState({
            vehicleTypePayload: payload
        })
    }
    
    handleTripTypeChange = event => {
        const payload = {
            tripTypeId: event.target.value,
            tripTypeTitle: this.getTripTypeTitle(event.target.value) 
        }
        this.setState({
            tripTypePayload: payload
        })
    }

    handleBtnClickSearch = () => {
        var search = this.props.searchAction(true, this.toll)
        if(search === true){
            let promise = new Promise((resolve, reject)=>{
                this.props.setTripType(this.state.tripTypePayload)
                this.props.setVehicleType(this.state.vehicleTypePayload)
                this.props.setBookingType(this.state.type)
                this.props.setPAYGAmount(this.state.paygAmount)
                this.props.setNoOfTrips(this.state.optionValue)
                resolve('success')    
            })
            promise.then(res => {
                let obj = new GetTollInfoAndFare(this);
                obj.makeRequest(this.props.requestObj);
                return true;
            }).then(res => {
                let obj = new CalculatePayableAmount(this);
                obj.action();
            })
        }
    } 

    handleMultiDestinationInputField = (location) =>{
        this.setState(state => ({
            destinations: [...this.state.destinations, location]
        }));
    }

    removeDestEle = (index) =>{
        let destn = [...this.state.destinations]
        destn.splice(index, 1);
        this.setState({destinations: destn})
        let destEle = document.getElementById('destination');
        destEle.style.paddingLeft = parseInt(destn.length*55)+10+'px'
        this.props.removeDestination(index)
    }

    typeClickHandler = (type) => {
        this.setState({
            type:type
        })
        this.props.setBookingType(type)
    }

    handleTollSelection =(toll) => {
        let supprtedVehicleTypes = toll.SupportedVehicleTypes.split(',')
        let supprtedTripTypes = toll.SupportedTripTypes.split(',')
        let vehicleTypes = this.state.vehicleTypes.filter(type => {
            return supprtedVehicleTypes.indexOf(type.TypeId.toString()) >= 0
        })
        let tripTypes = this.state.tripTypes.filter(type => {
            return supprtedTripTypes.indexOf(type.TripTypeId.toString()) >= 0
        })
        this.setState({
            vehicleTypes: vehicleTypes,
            tripTypes: tripTypes
        })
    }
    
    routeSpecificInputs = () => {
        return (
            <Fragment>
                <div className="col-md-3 ride">
                    <LocationSearchInput 
                        addressInfo={this.props.setSource} 
                        placeholder="Origin"
                        id='origin'
                    />
                </div>
                <div className="col-md-3 ride">
                    <LocationSearchInput 
                        addressInfo={this.props.setDestination} 
                        placeholder="Destination"
                        handleLocation = {this.handleMultiDestinationInputField}
                        id='destination'
                        destinations={this.props.requestObj.Destination}
                    />
                    {this.state.destinations.map((location, index) => {
                        let spanPos = parseInt(index)*55+20+'px'
                        return (
                            <span title={location} style={{left:spanPos}} key={index} className="r_set">{location.substr(0,4)} 
                                <small onClick={((e)=>(this.removeDestEle(index)))}>X</small>
                            </span>
                        )
                    })}
                </div>
                
            </Fragment>
        )
    }

    tollSelectionInput = () => {
        return (
            <Autocomplete 
                getItemValue={(item) => {
                    this.toll = item
                    return item.Name
                }}
                shouldItemRender={(item, value) => { 
                    return item.Name.toLowerCase().indexOf(value.toLowerCase()) > -1
                 }}
                items={this.props.tolls}
                renderItem={(item, isHighlighted) =>
                <div key={item.TollId} style={{ 
                    background: isHighlighted ? 'lightgray' : 'white',
                    overflowWrap: 'break-word'
                    }}>
                    {item.Name}
                </div>
                }
                value={this.state.tollname}
                onChange={e => this.setState({ tollname: e.target.value })}
                onSelect={(val) => {
                    this.setState({tollname:val})
                    let selectedToll = this.props.tolls.find(item => {
                        return item.Name.toLowerCase() === val.toLowerCase()
                    })
                    this.handleTollSelection(selectedToll)
                }}
                
                
                menuStyle ={{
                    borderRadius: '3px',
                    position: 'fixed',
                    overflow: 'auto',
                    maxHeight: '50%',
                  }}
                wrapperStyle = {{
                    width:'100%'
                }}  
                inputProps ={{
                    style:{ 
                        border: '1px solid #dadada',
                        fontSize: '16px',
                        width: '100%',
                        lineHeight:'inherit',
                        borderRadius: '3px',
                        height:'33px'
                    },
                    placeholder:'Toll Name'
                }}      
            />
            
        )
    }

    handlePAYGAmount = (e) => {
        let amt = e.target.value
        this.setState({
            paygAmount: amt
        })
        console.log(amt)
    }

    handleTollSpecificOptions = (e) => {
        let optionValue = e.target.value
        this.setState({
            optionValue: optionValue
        })
    }

    optionSelectionInput = () => {
        let i = 1;
        let options  = []
        let temp = {};
        if(parseInt(this.state.tripTypePayload.tripTypeId) === 11){
            options = this.props.paygSelectionAmounts.map(paygamt => {
               return temp = {
                    val: paygamt.Amount,
                    title: paygamt.Amount,
                    symbol: true
                }
            })
            return (<SelectAmount 
                options = {options}
                optval='val'
                opt="title"
                onChange={this.handlePAYGAmount}
            />)
        }else{
            while(i<=6){
                temp = {
                    val: i,
                    title: i + ' x ' + this.state.tripTypePayload.tripTypeTitle
                }
                options.push(temp)
                i++;
            }
            return (<Select 
                options = {options}
                optval='val'
                opt="title"
                onChange={this.handleTollSpecificOptions}
            />)
        }
        
        
    }

    tollSpecificInputs = () =>{
        return (
            <Fragment>
                <div className="col-md-3 ride"  style={{clear:'right'}}>
                    {this.tollSelectionInput()}
                </div>
                <div className="col-md-3 ride">
                    {this.optionSelectionInput()}
                </div>
                
            </Fragment>
        )
    }

    render(){
        return (
            <Fragment>
                <div className="borders counts">
                    <h2 className="namePart">Book Ride</h2>
                    <div className="grid-list">
                        <div className="tolls">
                            <ul>
                                <li>
                                    <label>
                                        <Input 
                                            type='radio'
                                            name="bookingType"
                                            onClick={(e) =>this.typeClickHandler('route-specific')} 
                                             defaultChecked={true}/>
                                        <span>Route Specific</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <Input
                                         type='radio' 
                                         name="bookingType" 
                                         onClick={(e) =>this.typeClickHandler('toll-specific')}
                                        />
                                        <span>Toll Specific</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div className="book_target">
                            <div className="row">
                            {this.state.type ==='route-specific'?this.routeSpecificInputs():this.tollSpecificInputs()}    
                                <div className="col-md-2 ride">
                                     <Select 
                                        options={this.state.vehicleTypes}
                                        optval='TypeId'
                                        opt="Description"
                                        onChange={this.handleVehicleTypeChange} />
                                </div>
                                <div className="col-md-2 ride">
                                    <Select 
                                    options={this.state.tripTypes} 
                                    optval='TripTypeId'
                                    opt="Title"
                                    onChange={this.handleTripTypeChange} />
                                </div>
                                <div className="col-md-2 ride">
                                    <Button onClick={this.handleBtnClickSearch} className={['btns']}>Search</Button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Fragment>
        )
    }
} 

const mapStateToProps = state => {
    return {
         vehicleTypeId: state.bookingReducers.VehicleTypeId?state.bookingReducers.VehicleTypeId:false,
         vehicleClass: state.defaultReducers.masterData.vehicleTypes?state.defaultReducers.masterData.vehicleTypes:[],
         requestObj : state.bookingReducers?state.bookingReducers:{},
         filteredVehicles: state.bookingReducers.filteredVehicles?state.bookingReducers.filteredVehicles:[],
         taxCalculations: state.defaultReducers.masterData.taxCalculations?state.defaultReducers.masterData.taxCalculations:[],
         tolls: state.defaultReducers.masterData.tolls?state.defaultReducers.masterData.tolls:[],
         paygSelectionAmounts: state.defaultReducers.masterData.paygSelectionAmounts?state.defaultReducers.masterData.paygSelectionAmounts:[],
         totalAmount: state.bookingReducers.TotalAmount?state.bookingReducers.TotalAmount:0,
    }
}

const mapDispatchToProps = dispatch => {
    return {
        setSource : value => dispatch(constants.selectBookingOptions(constants.SOURCE, value)),
        setDestination : value => dispatch(constants.selectBookingOptions(constants.DESTINATIONS, value)),
        removeDestination : value => dispatch(constants.selectBookingOptions(constants.REMOVE_DEST_ITEM, value)),
        setVehicleType: payload => dispatch(constants.selectBookingOptions(constants.VEHICLE_TYPE, payload)),
        setTripType: payload => dispatch(constants.selectBookingOptions(constants.TRIP_TYPE, payload)),
        setRideTolls: payload => dispatch(constants.selectBookingOptions(constants.SET_RIDE_TOLLS, payload)),
        calculatePayableAmount: payload => dispatch(constants.selectBookingOptions(constants.CALC_PAYABLE_AMOUNT, payload)),
        tollSearch: value => dispatch(constants.tollSearchAction(value)),
        setToll: tollId => dispatch(constants.selectBookingOptions(constants.SET_SELECTED_TOLL, tollId)),
        setBookingType: type => dispatch(constants.selectBookingOptions(constants.SET_BOOKING_TYPE, type)),
        setPAYGAmount: amount => dispatch(constants.selectBookingOptions(constants.SET_PAYG_AMOUNT, amount)),
        setNoOfTrips: no => dispatch(constants.selectBookingOptions(constants.SET_NO_OF_TRIPS, no)),
    }
}


export default connect(mapStateToProps, mapDispatchToProps)(BookingPanel)