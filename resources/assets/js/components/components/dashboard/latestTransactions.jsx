import React, { Component, Fragment } from 'react';

class LatestTransactions extends Component {
    
    render() { 
        return (  
            <Fragment>
                <div className="borders m-b">
                    <h2 className="namePart">Latest Transscations</h2>
                    <div className="grid-list p-lr">
                        <div className="list-in">
                        <table className="tables">
                            <thead>
                                <tr>
                                    <th>S. NO.</th>
                                    <th>DATE & TIME</th>
                                    <th>TXN</th>
                                    <th>PLATE NUMBER</th>
                                    <th>CLASS</th>
                                    <th>TICKET</th>
                                    <th>PAYMENT</th>
                                    <th>AMOUNT</th>
                                    <th>LANE</th>
                                    <th>OPETATOR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>27/07/2019 18:22:22</td>
                                    <td>10001</td>
                                    <td>YSHS7T727</td>
                                    <td>BUS/TRUCK</td>
                                    <td>SINGLE</td>
                                    <td>CASH</td>
                                    <td><span><i className="fa fa-inr" aria-hidden="true"></i></span>145</td>
                                    <td>1</td>
                                    <td>Mr. Vikas</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>27/07/2019 18:22:22</td>
                                    <td>10001</td>
                                    <td>YSHS7T727</td>
                                    <td>BUS/TRUCK</td>
                                    <td>SINGLE</td>
                                    <td>CASH</td>
                                    <td><span><i className="fa fa-inr" aria-hidden="true"></i></span>145</td>
                                    <td>1</td>
                                    <td>Mr. Vikas</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

            </Fragment>
        );
    }
}
 
export default LatestTransactions
