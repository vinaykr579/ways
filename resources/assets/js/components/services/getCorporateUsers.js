import BaseService from './baseService'

class GetCorporateUsers extends BaseService {
    
    makeRequest = (page=1) =>{
        return this.api.get('getCorporateUsers',{
            params:{
                page:page
            }
        }).then(res => {
            this.mainObj.handleApiResponse(res.data)
        }).catch(err => console.log(err))
    };
    
}

export default GetCorporateUsers