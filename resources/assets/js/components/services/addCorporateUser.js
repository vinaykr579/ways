import BaseService from './baseService'

class AddCorporateUser extends BaseService {
    
    
    requestStr = () => {
        return [
            {reqKey: 'Name', localKey: 'Name' },
            {reqKey: 'MobileNumber', localKey: 'MobileNumber' },
            {reqKey: 'EmailId', localKey: 'EmailId' },
            {reqKey: 'UserRole', localKey: 'UserRole' },
            {reqKey: 'CountryCode', localKey: 'CountryCode' },
            {reqKey: 'MaximumBookingAmount', localKey: 'MaximumBookingAmount' }
        ]
    }

    makeRequest = (data) =>{
        let request = this.createRequestBody(data);
        return this.api.post('addCorporateUser', request).then(res => {
            this.mainObj.apiResponseHandler(res.data)
        }).catch(err => console.log(err))
    };
    
}

export default AddCorporateUser