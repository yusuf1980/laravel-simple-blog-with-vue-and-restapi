// import axios from 'axios';

const $axios = axios.create({
	baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        Authorization: localStorage.getItem('uuidpandaisuite') != null ? 'Bearer ' + localStorage.getItem('uuidpandaisuite'):'',
      } 
})

$axios.interceptors.request.use (
    function (config) {
        const token = localStorage.getItem('uuidpandaisuite')
        if (token) config.headers.Authorization = `Bearer ${token}`;
        return config;
    },
    function (error) {
        return Promise.reject (error);
    }
);

export default $axios;