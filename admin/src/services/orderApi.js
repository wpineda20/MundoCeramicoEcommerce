import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const orderApi = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_URL + "/api/order",
});

// orderApi.interceptors.request.use(interceptorRequest);
// orderApi.interceptors.response.reject(interceptorReponse);

export default orderApi;
