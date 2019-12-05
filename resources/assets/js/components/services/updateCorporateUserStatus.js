import BaseService from './baseService'

class UpdateCorporateUserStatus extends BaseService {

    
    requestStr = () => {
        return [
            {reqKey: 'CorporateId', localKey:'CorporateId'},
            {reqKey: 'Status', localKey: 'Status'},
        ]
    }

    makeRequest = (data = {}) =>{
        let request = this.createRequestBody(data);
        this.api.put('updateCorporateUserStatus', request).then(res=>{
            if(res.data.message === 'success'){
                this.mainObj.loadCorporateUsers(this.mainObj.page)
            }
        })
    }
    
}

export default UpdateCorporateUserStatus