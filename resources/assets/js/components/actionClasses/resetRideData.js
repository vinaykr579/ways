import CommonAction from './commonAction'

class ResetRideData extends CommonAction{

    action = () => {
        let actions = [];
        actions.map(action => {
            this[action]();
            return true
        })
    }
}

export default ResetRideData