import React,{Fragment} from 'react';
import  './element.css'

export const Input = (props) =>(
    <input  
     className={[props.className?props.className.join(' '):'']} 
     {...props}
     />
     
)

export const Checkbox = (props) =>(
    <input type="checkbox"
     className={[props.className?props.className.join(' '):'']} 
     {...props}
     />
)


export const TextArea = (props) => (
    <textarea 
    className={[props.className?props.className.join(' '):'']}>{props.children}</textarea>
)

export const Button = (props) => (
    <button 
    className={['btn btn-default', props.className.join(' ')].join(' ')}
    onClick={props.onClick} >{props.children}</button>
)

export const Image = (props) => (
     <img src={props.src}  alt={props.alt?props.alt:null} 
     className={[ props.className?props.className.join(' '):'']} />
)

export const Select = (props) => {
    
    return(
        <select name={props.name?props.name:{}} 
        id={props.id?props.id:''} 
        className={props.className?props.className:''}
        onChange={props.onChange?props.onChange:''} >
        {
            props.options.map(data => {
                return <option 
                key={data[props.optval]} 
                value={data[props.optval]} >{data[props.opt]}</option>
            })
        }
    </select>
)}

export const SelectAmount = (props) => {
    
    return(
        <select name={props.name?props.name:{}} 
        id={props.id?props.id:''} 
        className={props.className?props.className:''}
        onChange={props.onChange} >
        {
            props.options.map(data => {
                return <option 
                key={data[props.optval]} 
                value={data[props.optval]} >&#8377; {data[props.opt]}</option>
            })
        }
    </select>
)}

export const PDFFile = (props) => (
    <Fragment>PDF</Fragment>
)