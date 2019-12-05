import BaseService from "./baseService";

class InitiateBookRideAndTransaction extends BaseService{

    requestStr = () => {
        return [
            {reqKey: 'VehicleTypeId', localKey: 'VehicleTypeId'},
            {reqKey: 'TripTypeId', localKey: 'TripTypeId'},
            {reqKey: 'Source', localKey: 'Source'},
            {reqKey: 'Destination', localKey: false, calcFun:'getDestination'},
            {reqKey: 'PayableAmount', localKey: 'ChargableAmount'},
            {reqKey: 'TotalAmount', localKey: 'TotalAmount'},
            {reqKey: 'Vehicles', localKey: false, calcFun: 'prepareSelectedVehicles'},
            {reqKey: 'Rides', localKey: false, calcFun: 'prepareRidesRequest'},
            {reqKey: 'TaxCalculationDetails', localKey:false, calcFun: 'calculationDetails'},
            {reqKey: 'PaymentModeId', localKey: 'PaymentModeId' },
            {reqKey: 'PaymentInfo', localKey: false, calcFun: 'getPaymentInfo'},
            {reqKey: 'PaymentInfoId', localKey: false, calcFun: 'getPaymentInfoId'},
            {reqKey: 'BookingType', localKey: 'BookingType'},
            {reqKey: 'NoOfTrips', localKey: 'NoOfTrips'},
        ]
    }

    makeRequest = (data) =>{
        this.data = data
        let request = this.createRequestBody(this.data);
        this.api.post('initiateBookRideAndTransactions', request).then(res=>{
            let payableAmount = parseFloat(res.data.response.PayableAmount).toFixed(2)
            this.mainObj.props.setBookingResponse(res.data.response)
            this.mainObj.paymentOptions.order_id = res.data.response.OrderId
            this.mainObj.paymentOptions.amount = parseInt(payableAmount*100)
            this.mainObj.payThroughRazorPay()

        })
    }

    getDestination = () => {
        let destination = this.mainObj.props.bookingReducers.Destination
        return destination[destination.length-1]
    }

    prepareSelectedVehicles = () => {
        let selectedVehicles = []
        selectedVehicles = this.mainObj.props.bookingReducers.filteredVehicles.filter(vehicle => {
            return vehicle.IsSelected=== 1
        })
        return selectedVehicles
    }

    prepareRidesRequest = () => {
        if(this.data['BookingType'] ==='toll-specific'){
            let ride = {
                Tolls: [this.mainObj.props.bookingReducers.Rides[0].Tolls[0]]
            }
            return [ride]
        }
        return this.mainObj.props.bookingReducers.Rides
    }

    calculationDetails = () => {
        return JSON.stringify(this.mainObj.props.bookingReducers.CalculationDetails)
    }

    getPaymentInfo = () => {
        let paymentModeId = this.mainObj.props.bookingReducers.PaymentModeId

        switch(parseInt(paymentModeId)){
            case 2:
                return this.mainObj.props.paymentReducers.cardDetail
            case 3:
                return {
                    bankname: this.mainObj.props.paymentReducers.bankname
                }
            case 5:
                return {
                    upi: this.mainObj.props.paymentReducers.upiAddress
                }    
            default:    
        }
    }

    getPaymentInfoId = () =>{
        return ""
    }

}

export default InitiateBookRideAndTransaction