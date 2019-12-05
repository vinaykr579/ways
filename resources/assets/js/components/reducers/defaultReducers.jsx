import {LOGIN_ACTION, SET_MASTER_DATA, RESET_STORE} from  '../actions/index'

const initialState = {
    isLogin : false,
    masterData: false,
    loggedInUser: {}
}

const defaultReducers = (state = initialState , action) =>{
    switch(action.type){
        case LOGIN_ACTION:
            if(action.payload.isLogin === true){
                return Object.assign({}, state, {
                    isLogin: action.payload.isLogin,
                    loggedInUser: action.payload.user
                })
            }
            break
        case SET_MASTER_DATA:
            return Object.assign({}, state, {
                masterData: action.data
            })
        case RESET_STORE:
            return Object.assign({}, state, initialState)    
        default:
            return state;
    }
}

export default defaultReducers