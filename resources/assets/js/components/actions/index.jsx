export const RESET_STORE = 'RESET_STORE'
export const SET_TOKEN = 'SET_TOKEN'
export const LOGIN_ACTION = 'LOGIN_ACTION'
export const TOLL_SEARCH = 'TOLL_SEARCH'
export const RESET_RIDES = 'RESET_RIDES'
export const RESET_SOURCE = 'RESET_SOURCE'
export const RESET_DESTINATION = 'RESET_DESTINATION'
export const SOURCE = 'SOURCE'
export const DESTINATIONS = 'DESTINATIONS'
export const VEHICLE_TYPE = 'VEHICLE_TYPE'
export const TRIP_TYPE = 'TRIP_TYPE'
export const SET_MASTER_DATA = 'SET_MASTER_DATA'
export const SET_RIDE_TOLLS = 'SET_RIDE_TOLLS'
export const SET_TOTAL_AMOUNT = 'SET_TOTAL_AMOUNT'
export const SET_SELECTED_VEHICLES = 'SET_SELECTED_VEHICLES'
export const UNSET_SELECTED_VEHICLES = 'UNSET_SELECTED_VEHICLES'
export const CALC_PAYABLE_AMOUNT = 'CALC_PAYABLE_AMOUNT' 
export const TOLL_SELCTION_IN_RIDE = 'TOLL_SELCTION_IN_RIDE'
export const AGREE_TERM_STATUS = 'RIDE_BOOKING_STATUS'
export const REMOVE_DEST_ITEM = 'REMOVE_DEST'
export const SET_PAYMENT_MODE = 'SET_PAYMENT_MODE'
export const SET_NET_BANKING_DETAILS = 'SET_NET_BANKING_DETAILS'
export const SET_UPI_ADDRESS = 'SET_UPI_ADDRESS'
export const SET_CARD_DETAILS = 'SET_CARD_DETAILS'
export const SET_BOOKING_RESPONSE = 'SET_BOOKING_RESPONSE'
export const SET_BOOKING_TYPE = 'SET_BOOKING_TYPE'
export const SET_SELECTED_TOLL = 'SET_SELECTED_TOLL'
export const SET_PAYG_AMOUNT = 'SET_PAYG_AMOUNT'
export const SET_NO_OF_TRIPS = 'SET_NO_OF_TRIPS'

export const setToken = value => {
    return {
        type: SET_TOKEN,
        value: value        
    }
}
export const loginAction = value =>{
    return {
        type: LOGIN_ACTION,
        payload: value
    }
}

export const selectBookingOptions = (type, value) => {
    return {
        type: type,
        value: value
    }
}

export const setMasterData = value => {
    return {
        type: SET_MASTER_DATA,
        data: value
    }
}

export const tollSearchAction = value => {
    return {
        type: TOLL_SEARCH,
        value: value
    }
}

export const resetRides = () => {
    return {
        type: RESET_RIDES
    }
}

export const resetSource = () => {
    return {
        type: RESET_SOURCE
    }
}

export const resetDestination = () => {
    return {
        type: RESET_DESTINATION
    }
}

export const setCardDetails = (type, value) => {
    return {
        type: SET_CARD_DETAILS,
        payload: {
            type: type,
            value: value
        }
    }
}
