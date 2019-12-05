import axios from 'axios'

  

const axiosReq = axios.create({
    baseURL: "http://localhost/ways/webapi/public/api/",
    //baseURL: "https://waysapp.in/api/",
    responseType: "json",
    timeout: 60000,
    maxRedirects: 0,
    transformResponse: [data => {
        return data
    }],
    headers: {
        'Content-Type': 'application/json',
        Authorization: {
            toString () {
              return `Bearer ${sessionStorage.getItem('token')}`
            }
        }  
    },  

});

axiosReq.interceptors.response.use(function (response) {
    // Do something with response data
    if(response.errors){
        if(parseInt(response.errors.status) === 401){
            window.location = '/login'
        }
    }
    return response;
}, function (error) {
    window.location = '/'
    // Do something with response error
    return Promise.reject(error);
});

export default axiosReq