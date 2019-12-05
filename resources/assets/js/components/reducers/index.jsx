import {combineReducers} from 'redux';
import defaultReducers from './defaultReducers';
import bookingReducers from './bookingReducers';
import paymentReducers from './paymentReducers';

const rootReducer = combineReducers({
    defaultReducers,
    bookingReducers,
    paymentReducers
});

export default rootReducer