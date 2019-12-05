export const arrayRemove = (arr, value, key= false) => {

    if(key !== false){
        return arr.filter(ele => {
            return ele[key] !== value;
        });
    }else{
        return arr.filter(ele => {
            return ele !== value;
        });
    }
    
 }


export const getTripTypeTitle = (tripTypeId) => {
    let tripTypes = {
        1:'Single',
        2:'24hr Return',
        3:'Return',
        4:'Monthly',
        5:'Local Commercial',
        6:'Local Pass',
        8:'Day Pass',
        9:'Day Return',
        11:'PAYG',
        13:'100 trips',
        14:'50 trips',
    }
    return tripTypes[tripTypeId]
}

export const getVehicleTypeTitle = (vehicleTypeId) => {
    let tripTypes = {
        1:'Car/Jeep/Van',
        2:'LCV',
        3:'Bus/Truck',
        4:'3 Axle',
        5:'4-6 Axle',
        6:'HCM/EME',
        7:'7+ Axle'
    }
    return tripTypes[vehicleTypeId]
}

export const datetimeTodate = (datetime, options = null) => {
    if(options === null){
        options = {day:'numeric', month:'long', year:'numeric'}
    }
    var date = new Date(datetime)
    return date.toLocaleDateString("en-US", options)
}
