<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import useAuth from "../composables/useAuth";
import Loader from "@/components/base-components/Loader.vue";


const { isLoggedIn, redirectAndGenerateChallenge } = useAuth();
const router = useRouter();

onMounted(() => {
    if (localStorage.getItem('isLoggedIn') != 'true') {
        redirectAndGenerateChallenge()
        return;
    }

    router.push('/');
})
</script>

<template>
    <v-row>
        <v-col cols="12">
            <Loader />
        </v-col>
    </v-row>
</template>