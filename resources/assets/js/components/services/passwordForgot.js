import BaseService from './baseService'

class PasswordForgot extends BaseService{

    requestStr = () => {
        return [
            {reqKey:'EmailId' , localKey:'EmailId'}
        ]
    }

    makeRequest = (data = []) =>{
        let request = this.createRequestBody(data)
        this.api.post('password/forgot', request).then(res => {
            this.mainObj.setState({ 
                messages:{...this.mainObj.state.messages, items:[{msg:res.data.message}]},
                msgAction:true 
            })
        }).catch(err => console.log(err))
    };
}

export default PasswordForgot