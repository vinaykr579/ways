import React from 'react'
import { HashRouter as Router, Switch, Route } from 'react-router-dom'
import Login from './login'
import InnerRoutes from './innerroutes'
import requireauth from '../hoc/requireauth'
import publicRoutes from '../hoc/publicRoutes'
import ForgotPassword from './forgotpassword'
import Receipt from '../components/pdf/receipt'

const Main = () => (
    <Router>
        <Switch>
            <Route exact path="/" component={publicRoutes(Login)} />
            <Route exact path="/password/forgot" component={publicRoutes(ForgotPassword)} />
            <Route exact path="/pdf" component={Receipt} />
            <Route path="/" component={requireauth(InnerRoutes)} />
        </Switch>
    </Router>
)

export default Main