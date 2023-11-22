<script>
import { RouterLink } from 'vue-router';

export default {
    props: {
        locations: {
            type: Array,
            required: true,
            default: [],
        },
        divider: {
            type: String,
            required: true,
            default: "/",
        }
    },
    components: { RouterLink }
}
</script>

<template>
    <ul class="breadcrumb">
        <template v-for="(location, index) in locations" :key="index">
            <!-- v-if="index < location.length" -->
            <li class="breadcrumb-item" v-if="location.path">
                <RouterLink :to="location.path">
                    <a href="#">{{ location.title }}
                    </a>
                </RouterLink>
                {{ divider }}
            </li>
            <li v-else class="ms-1">{{ location.title }}</li>
        </template>
    </ul>
</template>

<style scoped>
ul {
    list-style: none;
}

ul li {
    display: inline;
}

.breadcrumb {
    font-size: 18px !important;
}
</style>