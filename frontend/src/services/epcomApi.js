import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const epcomApi = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_URL + "/api/epcom",
});

// epcomApi.interceptors.request.use(interceptorRequest);
// epcomApi.interceptors.response.reject(interceptorReponse);

export default epcomApi;
