import React, { Component, Fragment } from 'react';
import { Redirect} from 'react-router-dom'
import { connect } from 'react-redux'
import ReeValidate from 'ree-validate'
import API from '../utils/api'
import {Image} from '../components/ui/elements'
import LoginPanel from '../components/login/loginPanel'
import AlertBox from '../components/ui/alert'
import * as constants from '../actions/index'
import QRCStatus from '../services/qrcstatus'

let alertClass = 'alert-success';
let timer = null;
class Login extends Component {
    constructor(props){
        super(props);
        this.state ={
            formData:{
                EmailId: '',
                Password: '',
            },
            qrcode: '',
            qrc: '',
            msgAction: false,
            messages: {
                items:[]
            }
        }
        this.loadQRCode();
        this.validator = new ReeValidate({
            EmailId: 'required|email',
            Password: 'required|min:6',
        })
        this.doLogin = this.doLogin.bind(this)
        this.onKeyPressed = this.onKeyPressed.bind(this)
        this.onChange = this.onChange.bind(this)
        this.qrcstatusObj = new QRCStatus(this)
    }


    loadQRCode = () =>{
        API.get('qrcode').then(res => {
            this.setState({
                qrcode: res.data.response.qimage,
                qrc: res.data.response.qrc
            });
        })
    }

    componentDidMount(){
        var eleId =  document.getElementsByTagName("div")[0].getAttribute('id');
        if(eleId !== 'page-wrapper'){
            document.getElementsByTagName("div")[0].setAttribute('id', 'page-wrapper')
        }
        this.checkQrcStatus()
    }

    componentWillUnmount(){
        var eleId =  document.getElementsByTagName("div")[0].getAttribute('id');
        if(eleId === 'page-wrapper'){
            document.getElementsByTagName("div")[0].setAttribute('id', 'page-view')
        }
        clearInterval(timer);
    }

    checkQrcStatus(){
        timer= setInterval(()=>{
            this.qrcstatusObj.makeRequest({})
        }, 10000)
    }

    checkQrCodeLoginStatus(res){
        if(res.status === true){
            sessionStorage.setItem('token', res.token);
            sessionStorage.setItem('user', JSON.stringify(res.user));
            let payload = {
                isLogin : true,
                user: JSON.parse(sessionStorage.getItem('user'))
            }
            this.props.doLogin(payload);
            this.props.history.push('/dashboard')
        }
    }


    onChange(e){
        const name = e.target.name
        const value = e.target.value
        this.setState({ formData: { ...this.state.formData, [name]: value } })
    } 

    onKeyPressed(e){
        if(e.key === 'Enter'){
            const { formData } = this.state
            const { errors } = this.validator

            this.validator.validateAll(formData)
            .then(success => {
                if (success) {
                    alertClass='alert-info'
                    this.setState({ 
                        messages:{...this.state.messages, items:[{msg:'Logging in...'}]},
                        msgAction:true 
                    })
                    this.doLogin();
                } else {
                    alertClass='alert-danger'
                    this.setState({ messages:errors, msgAction:true })
                }
            })
    
        }
    }

    doLogin(){
        API.post('login', this.state.formData).then(res=> {
            new Promise((resolve, reject) => {
                if(res.data.message === 'success' ){
                    sessionStorage.setItem('token', res.data.response.token);
                    sessionStorage.setItem('user', JSON.stringify(res.data.response.user));
                    resolve('success')
                }else{
                    reject(res.data.message)
                }
            }).then(res => {
                if(typeof sessionStorage.getItem('token') !== undefined){
                    let payload = {
                        isLogin : true,
                        user: JSON.parse(sessionStorage.getItem('user'))
                    }
                    this.props.doLogin(payload);
                    this.props.history.push('/dashboard')
                }
            }).catch(err => {
                alertClass='alert-danger'
                this.setState({ 
                    messages:{...this.state.messages, items:[{msg:err}]},
                    msgAction:true 
                })
            })
        }).catch(err =>{ console.log(err)});
    }

    redirectToDashboard(){
        return <Redirect to="/dashboard"/>;
    }

    prepareErrorMsg(){
        return(
            <ul>
            {this.state.messages.items.map((err, index) =>{
                return (<li key={index}>{err.msg}</li>)
            })}
           </ul>
        )
        
    }

    alertMsg(){
        return(
            <li>
                <AlertBox className={alertClass} alertMsg={this.prepareErrorMsg()} />
            </li>
        )
    }

    render() { 
        return (
            <Fragment>
                
               <section id="container-area">
                <form method="post" action="#">
                <LoginPanel
                    doLogin={this.doLogin} 
                    onKeyPressed= {this.onKeyPressed}
                    onChange = {this.onChange}
                    alertMsg={this.state.msgAction=== true?this.alertMsg():''}
                />
                </form>
                
                <div className="toll">
                <div className="toll-in">
                    <Image src={this.state.qrcode}/>	
                    <h6>Scan QR code via Ways App</h6>
                </div>
                {/* <QrCode imgSrc={this.state.qrcode}/> */}
                </div>
            </section>
            </Fragment>
        );
    }
}

const mapStateToProps = state => {
    return {
        isLogin : state.isLogin
    };
}

const mapDispatchToProps = dispatch => {
    return {
        doLogin : payload => dispatch(constants.loginAction(payload))
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Login);
