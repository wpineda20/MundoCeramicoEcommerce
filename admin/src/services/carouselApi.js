import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const carouselApi = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_URL + "/api/carousel",
});

// carouselApi.interceptors.request.use(interceptorRequest);
// carouselApi.interceptors.response.reject(interceptorReponse);

export default carouselApi;
