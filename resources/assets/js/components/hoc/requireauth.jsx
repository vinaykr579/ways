import React, { Component } from "react";
import { connect } from "react-redux";
import { Redirect } from "react-router-dom";
import {setMasterData} from '../actions/index'
import ResetAppData from '../actionClasses/resetAppData'
import GetMasterData from '../services/getMasterData'
import Spinner from '../components/ui/spinner'

export default function requireAuth (WrappedComponent) {

  class Authentication extends Component {

    constructor(props) {
      super(props);
      let masterRecordsLoaded = this.props.masterData=== false?false:true
      this.state = {
        warningTime: 1000 * 60 * 10,
        signoutTime: 1000 * 60 * 15,
        masterRecords: masterRecordsLoaded
      };
    }

    componentDidMount() {
      this.events = [
        'load',
        'mousemove',
        'mousedown',
        'click',
        'scroll',
        'keypress'
      ];

      for (var i in this.events) {
        window.addEventListener(this.events[i], this.resetTimeout);
      }

      this.setTimeout();
      this.masterRecordHandler();
    }

    masterRecordHandler(){
      if(this.props.masterData === false){
        let obj = new GetMasterData(this);
        obj.makeRequest({});
      }
    }


    clearTimeoutFunc = () => {
      if (this.warnTimeout) clearTimeout(this.warnTimeout);

      if (this.logoutTimeout) clearTimeout(this.logoutTimeout);
    };

    setTimeout = () => {
      this.warnTimeout = setTimeout(this.warn, this.state.warningTime);
      this.logoutTimeout = setTimeout(this.logout, this.state.signoutTime);
    };

    resetTimeout = () => {
      this.clearTimeoutFunc();
      this.setTimeout();
    };

    warn = () => {
      //console.log('You will be logged out automatically in 1 minute.');
    };

    loadSpinner = () => {
      return (<Spinner />)
    }

    logout = () => {
      this.destroy();
    };

    destroy = () => {
     //clear the session
      let obj = new ResetAppData(this);
      obj.action(); 
      return <Redirect to="/"/>
    };

    render () {
      if (!this.props.isLogin) {
        return <Redirect to="/"/>
      }
      if(this.state.masterRecords === false){
        return this.loadSpinner()
      }
      
      return <WrappedComponent { ...this.props }/>
    }
  }

  function mapStateToProps (state) {
    return { 
      isLogin: state.defaultReducers.isLogin,
      masterData: state.defaultReducers.masterData 
    }
  }

  function mapDispatchToProps(dispatch){
      return {
        resetStore : payload => dispatch(payload),
        setMasterData: payload => dispatch(setMasterData(payload))
      }
  }

  return connect(mapStateToProps, mapDispatchToProps)(Authentication);
}