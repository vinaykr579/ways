import * as constants from '../actions/index'

const initialstate = {
    cardDetail:{
        number: '',
        expiry: '',
        cvc: '',
        name: ''
    },
    bankName:'',
    bankCode:'',
    upiAddress:''
}

const paymentReducers = (state = initialstate, action) => {

    switch(action.type){
        case constants.SET_NET_BANKING_DETAILS:
            return Object.assign({}, state, {
                bankCode: action.value[0],
                bankName: action.value[1]
            })
        case constants.SET_CARD_DETAILS:
            return { ...state,
                cardDetail: {...state.cardDetail, [action.payload.type]:action.payload.value} 
            } 
        case constants.SET_UPI_ADDRESS:
            return {
                ...state,
                upiAddress: action.value
            }       
        default:
            return {...state}    
    }
}

export default paymentReducers