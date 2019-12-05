import React, { Component } from 'react'
import {connect} from 'react-redux'
import {Redirect} from 'react-router-dom'

export default function publicRoutes (WrappedComponent) {

    class PublicComponent extends Component {
        render() { 
            if(this.props.isLogin){
                return <Redirect to="/dashboard" />
            }
            return <WrappedComponent {...this.props} />
        }
    }

    function mapStateToProps (state) {
        return { isLogin: state.isLogin }
    }

    return connect(mapStateToProps)(PublicComponent)
     

}
