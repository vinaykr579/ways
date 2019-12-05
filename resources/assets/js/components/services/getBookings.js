import BaseService from './baseService'

class GetBookings extends BaseService {
    
    requestStr = () => {
        return []
    }

    makeRequest = (page) =>{
        this.api.get('getBookings', {params:{page:page}}).then(res => {
            this.mainObj.setState({bookings : res.data.response})
        }).catch(err => console.log(err))
    };
    
}

export default GetBookings