import axios from "axios";

const http = axios.create({
    baseURL: process.env.API_URL
});

http.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    config.headers["Authorization"] = `Bearer ${token}`;
    return config;
});

http.interceptors.response.use(
    (response) => {
        return response; // Mengembalikan keseluruhan objek respons
    },
    (error) => {
        return Promise.resolve(error.response);
    }
);

export default http;
