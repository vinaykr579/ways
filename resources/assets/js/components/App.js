import React from 'react';
import { Provider } from 'react-redux'
import { createStore, applyMiddleware, compose } from 'redux'
import rootReducer from './reducers/index'
import Main from './containers/main'
import {LOGIN_ACTION} from  './actions/index'

function App() {
  const logger = store => {
    return next => {
      return action => {
          return next(action);
      }
    }
  } 
  const composeEnhancers = window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ || compose;
  const store = createStore(rootReducer, composeEnhancers(applyMiddleware(logger)));
  const token = sessionStorage.getItem('token');
  sessionStorage.setItem('appUrl', 'http://waysapp.in/app')
  sessionStorage.setItem('homeUrl', 'http://waysapp.in')
  if (token) {
      store.dispatch({ type: LOGIN_ACTION, payload:{
        isLogin: true, 
        user: JSON.parse(sessionStorage.getItem('user'))
      } });
  }
  
  return (
    <Provider store={store}>
      <Main />
    </Provider>
  );
}

export default App;
