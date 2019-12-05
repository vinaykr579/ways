import * as constants from '../actions/index'

const initialState = {
    TollSearch:false,
    Source:{},
    Destination:[],
    filteredVehicles: false,
    vehicleClassName: '',
    TripTypeTitle:'',
    Rides:[],
    TotalAmount:0,
    CalculationDetails: [],
    ChargableAmount: 0,
    TotalTollFare: 0,
    AgreeTermStatus: false,
    PaymentModeId: 2,
    BookingReponse: {},
    SelectedTollId: false,
    BookingType:'route-specific',
    PAYGAmount:0,
    NoOfTrips:1
}

const updateTollSelection =(Rides = [], selectionInfo={}) =>{
    let newRides = [];
    newRides = Rides.map((ride, index) => {
        if(index === parseInt(selectionInfo.rideIndex)){
            let rideTolls = ride.Tolls.map(toll => {
                if(parseInt(toll.TollId) === parseInt(selectionInfo.tollId)){
                    toll.IsSelected = selectionInfo.isSelected
                }
                return toll
            })
            
            ride.Tolls = rideTolls
        }
        return ride
    })
    return newRides
}

const updateVehicleSelection = (filteredVehicles =[], vehicleId, isSelected = 1) => {
    let newFilteredVehicles = [];
    newFilteredVehicles = filteredVehicles.map(vehicle => {
        if(parseInt(vehicleId) === parseInt(vehicle.VehicleId)){
            vehicle.IsSelected = isSelected
        }
        return vehicle
    })
    return newFilteredVehicles
}

const bookingReducers = (state = initialState, action) => {
    
    switch(action.type){
        case constants.SOURCE: 
            return Object.assign({}, state, {
                Source: action.value
              })
        case constants.DESTINATIONS:
            return { 
                ...state,
                Destination: [...state.Destination, action.value]
            }
        case constants.VEHICLE_TYPE:
            return Object.assign({}, state, {
                VehicleTypeId: action.value.vehicleTypeId,
                filteredVehicles: action.value.filteredVehicles,
                vehicleClassName: action.value.vehicleClassName
            })
        case constants.TRIP_TYPE:
            return Object.assign({}, state, {
                TripTypeId: action.value.tripTypeId,
                TripTypeTitle: action.value.tripTypeTitle
            }) 
        case constants.SET_RIDE_TOLLS:
            return Object.assign({}, state, {
                Rides: action.value.Rides,
            })
        case constants.SET_TOTAL_AMOUNT:
            return Object.assign({}, state, {
                TotalAmount: action.value,
            })
        case constants.SET_SELECTED_VEHICLES:
            return { 
                ...state,
                filteredVehicles: updateVehicleSelection(state.filteredVehicles, action.value, 1)
            }
        case constants.UNSET_SELECTED_VEHICLES:
            return { 
                ...state,
                filteredVehicles: updateVehicleSelection(state.filteredVehicles, action.value, 0)
            } 
        case constants.CALC_PAYABLE_AMOUNT:
            return Object.assign({}, state, {
                CalculationDetails: action.value.calculatedTax,
                ChargableAmount: action.value.chargableAmt,
                TotalTollFare: action.value.totalTollFare
            })
        case constants.TOLL_SELCTION_IN_RIDE:
            return Object.assign({}, state, {
                Rides: updateTollSelection(state.Rides , action.value)
            })
        case constants.AGREE_TERM_STATUS:
            return {
                ...state,
                AgreeTermStatus: action.value
            }
        case constants.RESET_RIDES:
            return Object.assign({}, state, {
                Rides: []
            }) 
        case constants.RESET_SOURCE:
            return {
                ...state,
                Source:{}
            }
        case constants.RESET_DESTINATION:
            return {
                ...state,
                Destination:[]
            }        
        case constants.TOLL_SEARCH:
            return {
                ...state,
                TollSearch: action.value
            } 
        case constants.REMOVE_DEST_ITEM:
            let destn = [...state.Destination]
            destn.splice(action.value, 1);
            return {
                ...state,
                Destination: destn
            }
        case constants.SET_PAYMENT_MODE:
            return {
                ...state,
                PaymentModeId: action.value
            }
        case constants.SET_BOOKING_RESPONSE:
            return {
                ...state,
                BookingResponse: action.payload
            }
        case constants.SET_BOOKING_TYPE:
            return {
                ...state,
                BookingType:action.value
            }
        case constants.SET_SELECTED_TOLL:
            return {
                ...state,
                BookingType:action.value
            }
        case constants.SET_PAYG_AMOUNT:
            return {
                ...state,
                PAYGAmount: action.value
            }
        case constants.SET_NO_OF_TRIPS:
            return {
                ...state,
                NoOfTrips: action.value
            }                                                                    
        default:
            return state;    
    }
}

export default bookingReducers