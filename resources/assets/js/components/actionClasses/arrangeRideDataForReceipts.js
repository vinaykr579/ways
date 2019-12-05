import CommonAction from './commonAction'

class ArrangeRideDataForReceipts extends CommonAction{

    receipt = {
        ride:[],
        vehicles: [],
        taxDetails: {}
    }

    props = {}

    action = (rides, transaction) => {
        this.props = {
            rides: rides,
            transaction: transaction
        }
        let actions = ['setRideDetails', 'setVehicles', 'setTransactionDetails']
        actions.forEach(action => {
            this[action]();
        })
        return this.receipt
    }

    setRideDetails = () => {
        this.receipt.ride = this.props.rides[0]
    }

    setVehicles = () => {
        let vehicles = []
        let tmp = {}
        vehicles = this.props.rides.map(ride => {
            tmp = {
                RegistrationNumber: ride.RegistrationNumber,
                TotalAmount: ride.TotalAmount,
                VehicleType: ride.VehicleTypeId,
                VehicleId: ride.VehicleId
            }
            return tmp
        })
        this.receipt.vehicles = vehicles
    }

    setTransactionDetails = () => {
        this.receipt.taxDetails = {
            paidAmount: this.props.transaction.Amount,
            convenienceCharge: this.props.transaction.ConvenienceCharges,
            convenienceChargeVal: this.props.transaction.ConvenienceChargesTaxValue,
            gst: this.props.transaction.GST,
            gstVal: this.props.transaction.GSTTaxValue
        }
        
    }

}

export default ArrangeRideDataForReceipts