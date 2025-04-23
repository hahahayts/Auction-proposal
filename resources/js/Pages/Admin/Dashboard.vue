<script setup>
import Sidebar from "@/Components/Sidebar.vue";
import Create from "./Create.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    user: {
        type: Object,
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
    <Head title="Auction" />

    <Sidebar :user="user">
        <div class="flex-1 p-6 bg-gray-100">
            <div class="flex justify-end mb-4">
                <button
                    @click="showModal = true"
                    class="py-2 px-5 rounded-lg border border-blue-500 font-semibold text-gray-700 hover:bg-blue-600 hover:text-white transition duration-200"
                >
                    Create New Auction
                </button>
            </div>
            <div>
                <div>Current Auctions</div>
                <div>Ended Auctions</div>
            </div>
        </div>
        <Create
            :categories="categories"
            :show="showModal"
            @close="showModal = false"
        />
    </Sidebar>
</template>
