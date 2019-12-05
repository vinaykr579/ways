import CommonAction from './commonAction'

class CalculatePayableAmount extends CommonAction{

    
    action = () =>{
        let totalTollFare = this.calculateTollFare()
        var value = 0;
        let i =0;
        var calculations = []
        var chargableAmt = totalTollFare;
        calculations = this.mainObject.props.taxCalculations.map(tax => {
            value = i===0?totalTollFare:value
            if(tax.ValueType === 'Percentage'){
                value = parseFloat(value)*(parseInt(tax.TaxValue)/100)
            }else{
                value = tax.TaxValue
            }
            chargableAmt = parseFloat(chargableAmt)+ parseFloat(value.toFixed(2))
            tax.Amount = value.toFixed(2)
            i++;
            return tax
        })
        let payload = {
            chargableAmt : chargableAmt,
            calculatedTax : calculations,
            totalTollFare: totalTollFare
        }
        this.mainObject.props.calculatePayableAmount(payload)
    }

    calculateTollFare = () => {
        let selectedVehicles = [];
        selectedVehicles = this.mainObject.props.filteredVehicles.filter(vehicle=>{
            return parseInt(vehicle.IsSelected) === 1 
        }) 
        return selectedVehicles.length * parseInt(this.mainObject.props.totalAmount) 
    }
}

export default CalculatePayableAmount