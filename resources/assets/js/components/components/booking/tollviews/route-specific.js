import React,{Fragment} from 'react';
import {Checkbox} from '../../ui/elements';

const RouteSpecific = (props) => {
    return (
        <Fragment>
        {props.Rides.map(ride => {
            let amount = 0 
            let liUKey = ride.Source.Name+'-li-'+ride.Destination.Name;
            let frUKey = ride.Source.Name+'-fr-'+ride.Destination.Name;
            props.obj.index = props.obj.rideIndex
            props.obj.rideIndex++
            return (
                <Fragment key={frUKey}>
                    <h2>{ride.Source.Name}-{ride.Destination.Name}</h2>
                    <ul>
                        {ride.Tolls.map(toll => {
                            props.obj.counter++
                            if(parseInt(toll.IsSelected) === 1){
                                amount += parseInt(toll.TollFare)
                                props.obj.totalamount += parseInt(toll.TollFare)
                            }
                            
                            return (
                                <li key={props.obj.counter}  title={toll.State}>
                                    <div className="list-val">
                                        <label>
                                        {<Checkbox style={props.obj.checkBoxStyle} onClick={props.handleTollCheckBoxClick} value={props.obj.index+'-'+toll.TollId} defaultChecked={true}/>}</label>
                                        {toll.Name}
                                    </div>
                                    <div className="rate">
                                        <i className="fa fa-inr" aria-hidden="true"></i> {toll.TollFare}
                                    </div>
                                </li>
                            )
                        })}
                        <li key={liUKey}>
                            <div className="list-val">
                                <h4>Toll Fees</h4>
                            </div>
                            <div className="rate total_rate">
                                <i className="fa fa-inr" aria-hidden="true"></i> {amount}
                            </div>
                        </li>
                    </ul>    
                </Fragment>
            )
        })}
        {props.handleTollFareAndCounter(props.obj.totalamount)} 
        </Fragment>
                
    )
}

export default RouteSpecific
