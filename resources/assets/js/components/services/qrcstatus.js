import BaseService from './baseService'

class QRCStatus extends BaseService {
    
    makeRequest = (data) =>{
        this.api.get('qrcstatus',{
            params:{
                QrC: this.mainObj.state.qrc
            }
        }).then(res => {
            this.mainObj.checkQrCodeLoginStatus(res.data.response);
        }).catch(err => console.log(err))
    };
    
}

export default QRCStatus