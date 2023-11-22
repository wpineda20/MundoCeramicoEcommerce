import { ref } from "vue";
import crypto from "crypto-js";
import axios from "axios";

import { useAuthStore } from "../stores/auth";
import { storeToRefs } from "pinia";
import { useRouter } from "vue-router";

const clientId = import.meta.env.VITE_CLIENT_ID;
const authorizeUrl = import.meta.env.VITE_AUTHORIZE_URL;
const tokenEndpoint = import.meta.env.VITE_TOKEN_ENDPOINT;
const userApiEndpoint = import.meta.env.VITE_USER_API_ENDPOINT;
const redirectUri = import.meta.env.VITE_REDIRECT_URI;

const useAuth = () => {
  const authStore = useAuthStore();
  const {
    state,
    verifier,
    challenge,
    accessToken,
    refreshToken,
    user,
    isLoggedIn,
    loadingAuth,
  } = storeToRefs(authStore);
  const router = useRouter();

  const cryptoSha256 = (string) => {
    return crypto.SHA256(string);
  };

  const generateChallenge = () => {
    state.value = createRandomString(40);
    verifier.value = createRandomString(128);

    challenge.value = base64Url(cryptoSha256(verifier.value));
    localStorage.setItem("state", state.value);
    localStorage.setItem("verifier", verifier.value);
  };

  const redirectAndGenerateChallenge = () => {
    generateChallenge();
    window.location.href = loginUrl();
  };

  const redirectToProvider = () => {
    window.location.href = loginUrl();
  };

  const createRandomString = (num) => {
    return [...Array(num)].map(() => Math.random().toString(36)[2]).join("");
  };

  const base64Url = (string) => {
    return string
      .toString(crypto.enc.Base64)
      .replace(/\+/g, "-")
      .replace(/\//g, "_")
      .replace(/=/g, "");
  };

  const loginUrl = () => {
    return `${authorizeUrl}?client_id=${clientId}&redirect_uri=${redirectUri}&response_type=code&scope=*&state=${state.value}&code_challenge=${challenge.value}&code_challenge_method=S256`;
  };

  const getAccessToken = async (verifier, code) => {
    loadingAuth.value = true;
    const { data } = await axios.post(tokenEndpoint, {
      grant_type: "authorization_code",
      client_id: clientId,
      redirect_uri: redirectUri,
      code_verifier: verifier,
      code: code,
    }).catch(error => {
      console.log(error)
    });

    accessToken.value = data.access_token;
    refreshToken.value = data.refresh_token;

    localStorage.setItem("isLoggedIn", true);
    localStorage.setItem("access_token", data.access_token);
    localStorage.setItem("refresh_token", data.refresh_token);
    loadingAuth.value = false;
  };

  const getUserInfo = async () => {
    loadingAuth.value = true;
    const { data } = await axios
      .post(userApiEndpoint, null, {
        headers: {
          Authorization: `Bearer ${accessToken.value}`,
        },
      })
      .catch(async (error) => {
        console.log(error)
        if (error.response.status == 401) {
          refreshAccessToken();
          return;
        }

        logout();
      });

    user.value = data;
    isLoggedIn.value = true;
    loadingAuth.value = false;
  };

  const refreshAccessToken = async (verifier, refreshToken) => {
    loadingAuth.value = true;

    const response = await axios
      .post(tokenEndpoint, {
        grant_type: "refresh_token",
        client_id: clientId,
        refresh_token: refreshToken,
        client_secret: verifier,
      })
      .catch((error) => {
        console.log(error);
        logout();
      });

    accessToken.value = response.data.access_token;
    refreshToken.value = response.data.refresh_token;
    loadingAuth.value = false;

    return response;
  };

  const logout = () => {
    localStorage.clear();
    isLoggedIn.value = false;
    // router.push("/");
  };

  return {
    // Variables
    state,
    verifier,
    challenge,
    accessToken,
    refreshToken,
    user,
    isLoggedIn,
    loadingAuth,

    // Functions
    cryptoSha256,
    redirectToProvider,
    createRandomString,
    base64Url,
    loginUrl,
    getAccessToken,
    getUserInfo,
    refreshAccessToken,
    logout,
    redirectAndGenerateChallenge,
  };
};

export default useAuth;
