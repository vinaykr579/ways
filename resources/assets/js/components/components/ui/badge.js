import React from 'react';
import {Link} from 'react-router-dom'
import './badge.css'

const Badge = (props) => (
    <span className="tag label label-info">
    <span>{props.content}</span>
    <Link to="#"><i className="remove glyphicon glyphicon-remove-sign glyphicon-white"></i></Link> 
    </span>
)

export default Badge