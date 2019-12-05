import BaseService from './baseService'

class GetTollInfoAndFare extends BaseService {
    
    
    requestStr = () => {
        return [
            {reqKey: 'VehicleTypeId', localKey: 'VehicleTypeId' },
            {reqKey: 'TripTypeId', localKey: 'TripTypeId' },
            {reqKey: 'Source', localKey: 'Source' },
            {reqKey: 'Destination', localKey: 'Destination' },
            {reqKey: 'Rides', localKey: false, calcFun: 'prepareRidesRequest' },
            {reqKey: 'TollIds', localKey: false, calcFun: 'getSelectedTollId' },
            {reqKey: 'PAYGAmount', localKey: false, calcFun: 'getPAYGAmount' },
            {reqKey: 'NoOfTrips', localKey: false, calcFun: 'getNoOfTrips' },
        ]
    }

    makeRequest = (data) =>{
        let request = this.createRequestBody(data);
        this.api.post('getTollInfoAndFare', request).then(res => {
            this.mainObj.props.setRideTolls(res.data.response);
            this.mainObj.props.tollSearch(false)
        }).catch(err => console.log(err))
    };
    
    prepareRidesRequest = () => {
        let res = [];
        let i = 0;
        let source = {}
        this.mainObj.props.requestObj.Destination.forEach(dest =>{
            if(i === 0){
                source = this.mainObj.props.requestObj.Source
            }
            let tmp = {};
            tmp.Source = source;
            tmp.Destination = dest;
            source = dest;
            i++;
            res.push(tmp);
        })
        return res;
    }

    getSelectedTollId = () => {
        return this.mainObj.toll.TollId
    }

    getPAYGAmount = () => {
        return this.mainObj.state.paygAmount
    }

    getNoOfTrips = () => {
        return this.mainObj.state.optionValue
    }
}

export default GetTollInfoAndFare