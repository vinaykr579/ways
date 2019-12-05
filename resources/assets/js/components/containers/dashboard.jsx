import React, { Component, Fragment } from 'react';
import {connect} from 'react-redux';
import DashboardPanel from '../components/dashboard/dashboard-panel'
// import LatestBookings from '../components/dashboard/latestBookings'
// import LatestTransactions from '../components/dashboard/latestTransactions'
import GetDashboardData from '../services/getDashboardData'
import Bookings from './bookings';


class Dashboard extends Component {
    
    constructor(props){
        super(props);
        this.state = {
            dashboardPanle : {},
            bookings: null
        }
    }
    componentDidMount(){
        this.getDashboardPanel()
    }

    
    getDashboardPanel(){
        var obj = new GetDashboardData(this);
        obj.makeRequest({})
    }

    getBookings = () => {
        this.setState({
            bookings: this.loadBookings()
        })
    }

    loadBookings = () => {
        return (<Bookings />)
    }

    render() { 
        return (  
            <Fragment>
                <div className="borders counts">
                    <h2 className="namePart">Dashboard</h2>
                    <DashboardPanel {...this.state.dashboardPanle}/>
                </div>
                {this.state.bookings}
                {/* <LatestBookings />
                <LatestTransactions /> */}
            </Fragment>
        );
    }
}
 
const mapStateToProps = state => {
    return {}
}

const mapDispatchToProps = dispatch => {
    return {
    }
}
export default connect(mapStateToProps, mapDispatchToProps)(Dashboard);