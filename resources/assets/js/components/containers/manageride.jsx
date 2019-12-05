import React, { Component, Fragment } from 'react';
import Rides from '../components/rides/rides'

class ManageRide extends Component {
    
    render() { 
        return (  
            <Fragment>
                <div className="borders">
                  <h2 className="namePart">Manage Rides</h2>
                  <div className="grid-list p-lr">
                     <Rides />
                  </div>
               </div>
            </Fragment>
        );
    }
}
 
export default ManageRide;