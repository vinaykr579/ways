import BaseService from './baseService'


class GetDashboardData extends BaseService {
    
    
    requestStr = () => {
        return []
    }

    makeRequest = (data) =>{
        this.api.get('getDashboard').then(res => {
            this.mainObj.setState({'dashboardPanle' : res.data.response})
            this.mainObj.getBookings();
        }).catch(err => console.log(err))
    };
    
}

export default GetDashboardData