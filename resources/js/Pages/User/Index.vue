<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <h1>User's Page</h1>
    <Link :href="route('logout')" method="post"> Logout</Link>
</template>
