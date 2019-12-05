import React, { Component, Fragment } from 'react';
import TollSpecificSingle from './toll-specific-single'
import TollSpecificReturn from './toll-specific-return'
import TollSpecific24HrReturn from './toll-specific-24hr-return'
import TollSpecificMonthly from './toll-specific-monthly'
import TollSpecificMultitrips from './toll-specific-multitrips'
import TollSpecificDayPass from './toll-specific-day-pass'
import TollSpecificDayReturn from './toll-specific-day-return'
import TollSpecificPAYG from './toll-specific-payg'
import TollSpecificLocalPass from './toll-specific-local-pass'
import TollSpecificLocalCommercial from './toll-specific-local-commercials'

class TollSpecific extends Component {
    
    handleComponentOnTripType = () => {
        switch(parseInt(this.props.tripType)){
            case 1:
                return (<TollSpecificSingle {...this.props}/>)
            case 2:
                return (<TollSpecific24HrReturn {...this.props}/>)
            case 3:
                return (<TollSpecificReturn {...this.props}/>)
            case 4:
                return (<TollSpecificMonthly {...this.props}/>)                              
            case 5:
                return (<TollSpecificLocalCommercial {...this.props}/>)      
            case 6:
                return (<TollSpecificLocalPass {...this.props}/>)      
            case 8:
                return (<TollSpecificDayPass {...this.props}/>)      
            case 9:
                return (<TollSpecificDayReturn {...this.props}/>)      
            case 13:
            case 14
            :
                return (<TollSpecificMultitrips {...this.props}/>)      
            case 11:
                return (<TollSpecificPAYG {...this.props}/>)                              
            default:    
        }
    }
    
    render() { 
        return (  
            <Fragment>
                {this.handleComponentOnTripType()}
            </Fragment>
        );
    }
}
export default TollSpecific