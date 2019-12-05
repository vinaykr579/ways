import React,{Fragment} from 'react';

const TollSpecificPAYG = (props) => {
    let tollName = props.Rides[0]?props.Rides[0].Tolls[0].Name:''
    let title = 'PAYG'
    return (
        <Fragment>
        <h2>{tollName}</h2>
        {props.Rides.map(ride => {
            let amount = 0 
            let liUKey = tollName+'-li';
            let frUKey = tollName+'-fr';
            props.obj.index = props.obj.rideIndex
            props.obj.rideIndex++
            return (
                <Fragment key={frUKey}>
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
                                        {title}
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

export default TollSpecificPAYG