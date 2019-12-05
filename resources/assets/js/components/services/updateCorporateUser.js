import BaseService from './baseService'

class UpdateCorporateUser extends BaseService {
    
    
    requestStr = () => {
        return [
            {reqKey: 'CorporateId', localKey: false, calcFun:'getCorporateId' },
            {reqKey: 'CorporateUserId', localKey: false, calcFun:'getCorporateUserId' },
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
        return this.api.post('updateCorporateUser', request).then(res => {
            this.mainObj.apiResponseHandler(res.data)
            this.mainObj.setState({corporateUser:request}) 
        }).catch(err => console.log(err))
    };

    getCorporateId = () => {
        return this.mainObj.props.location.query.corporateUser.CorporateId
    }

    getCorporateUserId = () => {
        return this.mainObj.props.location.query.corporateUser.CorporateUserId
    }
    
}

export default UpdateCorporateUser