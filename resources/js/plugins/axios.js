import axios from 'axios'


const token = localStorage.getItem('token');
let config = {
    baseURL: import.meta.env.VITE_API_URL,
    withCredentials: true,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        Authorization: `Bearer ${token}`,
    }

}

const createAxiosInstance = axiosOptions => {
    return axios.create(axiosOptions);
}

const _axios = createAxiosInstance(config);

export default _axios;
