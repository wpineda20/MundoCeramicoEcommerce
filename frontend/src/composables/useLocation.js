import { onMounted, ref, watch } from "vue";
import mapboxgl from "mapbox-gl/dist/mapbox-gl";

import directionApi from "@/services/directionApi";
import { storeToRefs } from "pinia";
import { useLocationStore } from "../stores/location";

export const useLocation = (props) => {
  const map = ref(null);
  const markerDestination = ref(null);
  const markerInitial = ref(null);
  const storeLocation = useLocationStore();
  const { center, selectedDestination } = storeToRefs(storeLocation);

  const createMap = () => {
    // Showing map
    map.value = new mapboxgl.Map({
      accessToken:
        "pk.eyJ1IjoibG9wZXpsZW9uZWwxOTEiLCJhIjoiY2t1dXN5dzNyMXp0ajJ4cGc1MnZoczFxdyJ9.6XfZ0RrfVg6rYbM2SFk-ew",
      container: "map", // container ID
      style: "mapbox://styles/mapbox/streets-v12", // style URL
      center: [-74.5, 40], // starting position [lng, lat]
      zoom: 14, // starting zoom
      center: [...center.value],
    });

    // Adding mapbox events
    map.value.on("click", (e) => {
      createDestinationMarker(e);
    });
  };

  const createDestinationMarker = (event) => {
    //   Delete actual marker
    if (markerDestination.value) markerDestination.value.remove();

    //   Create new marker
    markerDestination.value = createMarker({
      lng: event.lngLat.lng,
      lat: event.lngLat.lat,
      color: "#2B01FF",
    });

    markerDestination.value.addTo(map.value);

    getDirection({
      initLng: event.lngLat.lng,
      initLat: event.lngLat.lat,
      endLng: center.value[0],
      endLat: center.value[1],
    });
  };

  const getDirection = async ({ initLng, initLat, endLng, endLat }) => {
    if (map.value.getLayer("route")) {
      map.value.removeLayer("route");
      map.value.removeSource("route");
    }

    const response = await directionApi.get(
      `/${initLng}%2C${initLat}%3B${endLng}%2C${endLat}`
    );

    // console.log(response.data.routes[0].duration);
    selectedDestination.value = {
      distance: response.data.routes[0].distance,
      duration: response.data.routes[0].duration,
      location: {
        longitude: response.data.waypoints[0].location[0],
        latitude: response.data.waypoints[0].location[1],
      },
      name: response.data.waypoints[0].name,
    };

    // console.log(selectedDestination.value);
    setRoutePolyline(response.data.routes[0].geometry.coordinates);
  };

  const setRoutePolyline = (coords) => {
    const sourceData = {
      type: "geojson",
      data: {
        type: "FeatureCollection",
        features: [
          {
            type: "Feature",
            properties: {},
            geometry: {
              type: "LineString",
              coordinates: coords,
            },
          },
        ],
      },
    };

    map.value.addSource("route", sourceData);
    map.value.addLayer({
      id: "route",
      type: "line",
      source: "route",
      layout: {
        "line-join": "round",
        "line-cap": "round",
      },
      paint: {
        "line-color": "#84846E",
        "line-width": 5,
        "line-opacity": 1,
      },
    });
  };

  const createMarker = ({
    lng = "-89.2894733",
    lat = "13.6757837",
    color = "#b40219",
    popup = null,
  }) => {
    const marker = new mapboxgl.Marker({ color: color }).setLngLat({
      lng: lng,
      lat: lat,
    });

    if (popup) {
      marker.setPopup(popup);
    }

    return marker;
  };

  const createPopup = (text) => {
    return new mapboxgl.Popup().setHTML(`<h4>${text}</h4>`);
  };

  const getUserLocation = async () => {
    navigator.geolocation.getCurrentPosition(
      ({ coords }) => {
        center.value = [coords.longitude, coords.latitude];
      },
      (error) => {
        // TODO: Set default location in environment file
        center.value = [0, 0];
      }
    );
  };

  // onMounted(async () => {
  //   getUserLocation();
  // });

  // watch(center, () => {
  //   if (!map.value) {
  //     createMap();
  //     // console.log("Hola");
  //     return;
  //   }

  //   map.value.flyTo({
  //     center: center.value,
  //   });
  // });

  return {
    // Variables
    map,
    markerDestination,
    center,
    markerInitial,
    selectedDestination,

    // Functions
    createMap,
    createDestinationMarker,
    getDirection,
    setRoutePolyline,
    createMarker,
    getUserLocation,
    createPopup,
  };
};

export default useLocation;
