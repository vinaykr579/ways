import API from '../utils/api'

class BaseService {

    api = API
    mainObj= null
    data=null

    constructor(mainObj){
        this.mainObj = mainObj
    }
    
    requestStr = () => {
        console.log('BaseService method requestStr called');
        return []
    };

    createRequestBody = (data = {}) => {
        let result = {};
        let bodystr = this.requestStr()
        bodystr.forEach( str => {
            if(str.localKey !== false){
                result[str.reqKey] =  data[str.localKey];
            }else{
                result[str.reqKey] =  this[str.calcFun]();
            }
        })
        return result;
    };

    makeRequest = (data) => {
        console.log('makeRequest method called from base service')
        let request = this.createRequestBody(data);
        return request
    }

}

export default BaseService;