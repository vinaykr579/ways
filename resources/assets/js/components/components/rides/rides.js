import React, {Fragment} from 'react';
import {Link} from 'react-router-dom'

const Rides = (props) => (
    <Fragment>
        <div className="list-in lbs">
            <div className="table-responsive">
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
                                <tbody>
                                <tr>
                                    <td>S.NO.</td>
                                    <td>NUMBER PLATE</td>
                                    <td>VRN</td>
                                    <td>CONSUMED</td>
                                    <td>REMAINING</td>
                                    <td>AMOUNT</td>
                                </tr>
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
                        <td style={{background : '#f2f2f2'}} >2</td>
                        <td style={{background : '#f2f2f2'}}>27/07/2019</td>
                        <td style={{background : '#f2f2f2'}}>10001</td>
                        <td style={{background : '#f2f2f2'}}>Car/Jeep/Van</td>
                        <td style={{background : '#f2f2f2'}}>Single</td>
                        <td style={{background : '#f2f2f2'}}>Route Specific</td>
                        <td style={{background : '#f2f2f2'}}>3</td>
                        <td style={{background : '#f2f2f2'}}>Delhi</td>
                        <td style={{background : '#f2f2f2'}}>Jaipur</td>
                        <td style={{background : '#f2f2f2'}}>Mr. Vikas</td>
                        <td style={{background : '#f2f2f2'}}><span><i className="fa fa-inr" aria-hidden="true"></i></span>945</td>
                        <td style={{background : '#f2f2f2'}}><Link to="#" className="openTr"><i className="fa fa-angle-double-right" aria-hidden="true"></i></Link></td>
                        </tr>
                        <tr className="slideOpen">
                        <td colSpan="12">
                            <table>
                                <tbody>
                                <tr>
                                    <td>S.NO.</td>
                                    <td>NUMBER PLATE</td>
                                    <td>VRN</td>
                                    <td>CONSUMED</td>
                                    <td>REMAINING</td>
                                    <td>AMOUNT</td>
                                </tr>
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
                        <td><Link to="#" className="openTr"><i className="fa fa-angle-double-right" aria-hidden="true"></i></Link></td>
                        </tr>
                        <tr className="slideOpen">
                        <td colSpan="12">
                            <table>
                                <tbody>
                                <tr>
                                    <td>S.NO.</td>
                                    <td>NUMBER PLATE</td>
                                    <td>VRN</td>
                                    <td>CONSUMED</td>
                                    <td>REMAINING</td>
                                    <td>AMOUNT</td>
                                </tr>
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
                        <td style={{background : '#f2f2f2'}}>4</td>
                        <td style={{background : '#f2f2f2'}}>27/07/2019</td>
                        <td style={{background : '#f2f2f2'}}>10001</td>
                        <td style={{background : '#f2f2f2'}}>Car/Jeep/Van</td>
                        <td style={{background : '#f2f2f2'}}>Single</td>
                        <td style={{background : '#f2f2f2'}}>Route Specific</td>
                        <td style={{background : '#f2f2f2'}}>3</td>
                        <td style={{background : '#f2f2f2'}}>Delhi</td>
                        <td style={{background : '#f2f2f2'}}>Jaipur</td>
                        <td style={{background : '#f2f2f2'}}>Mr. Vikas</td>
                        <td style={{background : '#f2f2f2'}}><span><i className="fa fa-inr" aria-hidden="true"></i></span>945</td>
                        <td style={{background : '#f2f2f2'}}><Link to="#" className="openTr"><i className="fa fa-angle-double-right" aria-hidden="true"></i></Link></td>
                        </tr>
                        <tr className="slideOpen">
                        <td colSpan="12">
                            <table>
                                <tbody>
                                    <tr>
                                    <td>S.NO.</td>
                                    <td>NUMBER PLATE</td>
                                    <td>VRN</td>
                                    <td>CONSUMED</td>
                                    <td>REMAINING</td>
                                    <td>AMOUNT</td>
                                </tr>
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
    </Fragment>
)

export default Rides