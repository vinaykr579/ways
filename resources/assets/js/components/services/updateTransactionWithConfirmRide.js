import BaseService from './baseService'

class UpdateTransactionWithConfirmRide extends BaseService {

    razorpayResponse = {}

    requestStr = () => {
        return [
            {reqKey: 'RideIds', localKey: false, calcFun:'getRideIds'},
            {reqKey: 'TransactionId', localKey: false, calcFun:'getTransactionId'},
            {reqKey: 'RazorPaymentId', localKey: false, calcFun:'getRazorPaymentId'},
            {reqKey: 'RazorPaymentResponse', localKey: false, calcFun:'getRazorPaymentResponse'},
            {reqKey: 'Status', localKey: false, calcFun:'getStatus'},
            
        ]
    }

    makeRequest = (data = {}) =>{
        let request = this.createRequestBody(data);
        this.api.post('updateTransactionWithConfirmRide', request).then(res=>{
            this.mainObj.loadBookingReceipt(res.data.response)
        })
    }
    

    getRideIds = () =>{
        let rideIds = [];
        rideIds = this.mainObj.props.bookingReducers.BookingResponse.Bookings.map(booking => {
            return booking.RideId
        })
        return rideIds.join(',')
    }

    getTransactionId = () =>{
        return this.mainObj.props.bookingReducers.BookingResponse.TransactionId
    }

    getRazorPaymentId = () =>{
        return this.razorpayResponse.razorpay_payment_id
    }

    getRazorPaymentResponse = () =>{
        return JSON.stringify(this.razorpayResponse)
    }

    getStatus = () =>{
        return 'Success'
    }

}

export default UpdateTransactionWithConfirmRide