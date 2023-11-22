import axios from "axios";
// import { interceptorRequest, interceptorReponse } from "./interceptor";

const localizationApi = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_URL + "/api/localization",
});

// localizationApi.interceptors.request.use(interceptorRequest);
// localizationApi.interceptors.response.reject(interceptorReponse);

export default localizationApi;
