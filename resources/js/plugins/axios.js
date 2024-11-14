import axios from 'axios'

let config = {
    baseURL: import.meta.env.VITE_API_URL,
}

const createAxiosInstance = axiosOptions => {
    return axios.create(axiosOptions);
}

const _axios = createAxiosInstance(config);

export default _axios;
