import {RESET_STORE} from '../actions/index'
import CommonAction from './commonAction'

class ResetAppData extends CommonAction{

    action = () => {
        let actions = ['clearSessionStorage', 'clearStoreData'];
        actions.map(action => {
            this[action]();
            return true
        })
    }

    clearSessionStorage(){
        sessionStorage.clear()
    }

    clearStoreData(){
        this.mainObject.props.resetStore({type:RESET_STORE});
    }
}

export default ResetAppData