import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const storeApi = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_URL + "/api/store",
});

// storeApi.interceptors.request.use(interceptorRequest);
// storeApi.interceptors.response.reject(interceptorReponse);

export default storeApi;
