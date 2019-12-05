import React, { Component, Fragment } from 'react';
import {Link} from 'react-router-dom'
import './dashboard.css'

class LatestBookings extends Component {
    
    render() { 
        return (  
            <Fragment>
                <div className="borders m-b">
                    <h2 className="namePart">Latest Booking</h2>
                    <div className="grid-list p-lr">
                        <div className="list-in lbs">
                        <table className="tables">
                            <thead>
                                <tr>
                                    <th>S. NO.</th>
                                    <th>DATE</th>
                                    <th>INVOICE</th>
                                    <th>CLASS</th>
                                    <th>TICKET</th>
                                    <th>BOOKING</th>
                                    <th>VECHILE(S)</th>
                                    <th>SOURCE</th>
                                    <th>DESTINATION</th>
                                    <th>BOOK BY</th>
                                    <th>TOTAL</th>
                                    <th>VIEW</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>27/07/2019</td>
                                    <td>10001</td>
                                    <td>Car/Jeep/Van</td>
                                    <td>Single</td>
                                    <td>Route Specific</td>
                                    <td>3</td>
                                    <td>Delhi</td>
                                    <td>Jaipur</td>
                                    <td>Mr. Vikas</td>
                                    <td><span><i className="fa fa-inr" aria-hidden="true"></i></span>945</td>
                                    <td><Link className="openTr" to="#"><i className="fa fa-angle-double-right" aria-hidden="true"></i></Link></td>
                                </tr>
                                <tr className="slideOpen">
                                    <td colSpan="12">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>S.NO.</td>
                                                <td>NUMBER PLATE</td>
                                                <td>VRN</td>
                                                <td>CONSUMED</td>
                                                <td>REMAINING</td>
                                                <td>AMOUNT</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>i)</td>
                                                <td>DL 2C AE 2200</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 315</td>
                                            </tr>
                                            <tr>
                                                <td>ii)</td>
                                                <td>DL 2C AE 2200</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 315</td>
                                            </tr>
                                            <tr>
                                                <td>iii)</td>
                                                <td>DL 2C AE 2200</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 315</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="td-background">2</td>
                                    <td className="td-background">27/07/2019</td>
                                    <td className="td-background">10001</td>
                                    <td className="td-background">Car/Jeep/Van</td>
                                    <td className="td-background">Single</td>
                                    <td className="td-background">Route Specific</td>
                                    <td className="td-background">3</td>
                                    <td className="td-background">Delhi</td>
                                    <td className="td-background">Jaipur</td>
                                    <td className="td-background">Mr. Vikas</td>
                                    <td className="td-background"><span><i className="fa fa-inr" aria-hidden="true"></i></span>945</td>
                                    <td className="td-background">
                                        <Link to="#" className="openTr">
                                            <i className="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </Link>
                                    </td>
                                </tr>
                                <tr className="slideOpen">
                                    <td colSpan="12">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>S.NO.</td>
                                                <td>NUMBER PLATE</td>
                                                <td>VRN</td>
                                                <td>CONSUMED</td>
                                                <td>REMAINING</td>
                                                <td>AMOUNT</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>i)</td>
                                                <td>DL 2C AE 2250</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 315</td>
                                            </tr>
                                            <tr>
                                                <td>ii)</td>
                                                <td>DL 2C AE 2200</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 315</td>
                                            </tr>
                                            <tr>
                                                <td>iii)</td>
                                                <td>DL 2C AE 2200</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 325</td>
                                            </tr>
                                        </tbody>    
                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>27/07/2019</td>
                                    <td>10001</td>
                                    <td>Car/Jeep/Van</td>
                                    <td>Single</td>
                                    <td>Route Specific</td>
                                    <td>3</td>
                                    <td>Delhi</td>
                                    <td>Jaipur</td>
                                    <td>Mr. Vikas</td>
                                    <td><span><i className="fa fa-inr" aria-hidden="true"></i></span>945</td>
                                    <td>
                                        <Link to="#" className="openTr">
                                            <i className="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </Link></td>
                                </tr>
                                <tr className="slideOpen">
                                    <td colSpan="12">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>S.NO.</td>
                                                <td>NUMBER PLATE</td>
                                                <td>VRN</td>
                                                <td>CONSUMED</td>
                                                <td>REMAINING</td>
                                                <td>AMOUNT</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>i)</td>
                                                <td>DL 2C AE 2250</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 315</td>
                                            </tr>
                                            <tr>
                                                <td>ii)</td>
                                                <td>DL 2C AE 2200</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 315</td>
                                            </tr>
                                            <tr>
                                                <td>iii)</td>
                                                <td>DL 2C AE 2200</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 325</td>
                                            </tr>

                                        </tbody>    
                                    </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="td-background">4</td>
                                    <td className="td-background">27/07/2019</td>
                                    <td className="td-background">10001</td>
                                    <td className="td-background">Car/Jeep/Van</td>
                                    <td className="td-background">Single</td>
                                    <td className="td-background">Route Specific</td>
                                    <td className="td-background">3</td>
                                    <td className="td-background">Delhi</td>
                                    <td className="td-background">Jaipur</td>
                                    <td className="td-background">Mr. Vikas</td>
                                    <td className="td-background"><span><i className="fa fa-inr" aria-hidden="true"></i></span>945</td>
                                    <td className="td-background">
                                        <Link to="#" className="openTr">
                                            <i className="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </Link>
                                    </td>
                                </tr>
                                <tr className="slideOpen">
                                    <td colSpan="12">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>S.NO.</td>
                                                <td>NUMBER PLATE</td>
                                                <td>VRN</td>
                                                <td>CONSUMED</td>
                                                <td>REMAINING</td>
                                                <td>AMOUNT</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>i)</td>
                                                <td>DL 2C AE 2250</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 315</td>
                                            </tr>
                                            <tr>
                                                <td>ii)</td>
                                                <td>DL 2C AE 2200</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 315</td>
                                            </tr>
                                            <tr>
                                                <td>iii)</td>
                                                <td>DL 2C AE 2200</td>
                                                <td>123456</td>
                                                <td>3/4</td>
                                                <td>1/4</td>
                                                <td><i className="fa fa-inr" aria-hidden="true"></i> 325</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
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
 
export default LatestBookings;