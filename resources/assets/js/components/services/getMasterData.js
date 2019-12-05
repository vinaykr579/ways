import BaseService from './baseService'

class GetMasterData extends BaseService {
    
    
    requestStr = () => {
        return []
    }

    makeRequest = (data) =>{
        this.api.get('getMasterData').then(res => {
            this.mainObj.props.setMasterData(res.data.response);
            this.mainObj.setState({masterRecords:true})
        }).catch(err => console.log(err))
    };
    
}

export default GetMasterData