import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const stateApi = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_URL + "/api/state",
});

// stateApi.interceptors.request.use(interceptorRequest);
// stateApi.interceptors.response.reject(interceptorReponse);

export default stateApi;
