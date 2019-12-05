import React ,{ Fragment} from 'react'
import { Route } from 'react-router-dom'
import Layout from '../components/layout'
import * as components from '../utils/asyncComponents'

const InnerRoutes = (props) => (
    <Fragment>
        <Layout>
            <Route exact path="/dashboard" component={components.asyncDashboard} />
            <Route  path="/rides" component={components.asyncRides} />
            <Route  path="/bookings" component={components.asyncBookings} />
            <Route  path="/users" component={components.asyncUsers} />
        </Layout>
    </Fragment>
)


export default InnerRoutes