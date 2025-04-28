<script setup>
import { Head } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import Create from "@/Components/ui/Create.vue";
import { ref } from "vue";

const props = defineProps({
    auctions: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

const showModal = ref(false);
</script>

<template>
    <Head title="My Auctions" />
    <Navbar>
        <div>This is a my aucitons page</div>
        <button @click="showModal = true">Create</button>

        <Create
            :categories="categories"
            :show="showModal"
            postURL="/my-auctions/create"
            @close="showModal = false"
        />
        <div v-for="auction in auctions" :key="auction.id">
            {{ auction.title }}
        </div>
    </Navbar>
</template>
