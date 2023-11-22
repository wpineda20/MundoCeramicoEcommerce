import axios from "axios";
// import environment from "../environment";

const directionApi = axios.create({
  baseURL: "https://api.mapbox.com/directions/v5/mapbox/driving",
  params: {
    alternatives: false,
    geometries: "geojson",
    language: "es",
    overview: "simplified",
    steps: true,
    continue_straight: false,
    access_token: import.meta.env.VITE_MAPBOX_ACCESS_TOKEN,
  },
});

export default directionApi;
