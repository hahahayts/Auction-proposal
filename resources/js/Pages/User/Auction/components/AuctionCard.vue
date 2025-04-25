<script setup>
import { ref } from "vue";

import Bid from "./Bid.vue";

defineProps({
    auction: {
        type: Object,
        required: true,
    },
});

const showModal = ref(false);

// Format date helper
const formatDate = (dateString) => {
    if (!dateString) return "N/A";

    try {
        const date = new Date(dateString);
        return date.toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
            day: "numeric",
        });
    } catch (error) {
        return "Invalid date";
    }
};

// Format currency helper to safely handle undefined or non-number values
const formatCurrency = (value) => {
    if (value === undefined || value === null) return "₱0";
    if (typeof value !== "number") return `₱${value}`;

    try {
        return `₱${value.toLocaleString()}`;
    } catch (error) {
        return `₱${value}`;
    }
};
</script>

<template>
    <div class="relative h-40">
        <img
            :src="auction.imageURL || '/api/placeholder/250/150'"
            :alt="auction.title"
            class="w-full h-full object-cover"
        />
        <span
            class="absolute z-50 bottom-3 right-3 text-sm px-3 py-1 rounded-full font-medium shadow-sm"
            :class="{
                'bg-green-100 text-green-800': auction.status === 'ongoing',
                'bg-yellow-100 text-yellow-800': auction.status === 'upcoming',
                'bg-gray-100 text-gray-800': auction.status === 'closed',
            }"
        >
            {{ auction.status || "unknown" }}
        </span>
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <h3 class="font-bold text-lg text-gray-800 mb-3 line-clamp-2 min-h-14">
            {{ auction.title }}
        </h3>
        <div class="mt-auto flex flex-col gap-2 border-t border-gray-100 pt-3">
            <div class="flex justify-between text-sm">
                <span class="text-gray-600">Current Bid:</span>
                <span class="font-semibold text-gray-900">{{
                    formatCurrency(auction.current_bid)
                }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-600">Ends:</span>
                <span class="text-gray-900">{{
                    formatDate(auction.endDate)
                }}</span>
            </div>
        </div>
        <div class="mt-4 flex justify-between gap-2">
            <button
                class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                View Details
            </button>
            <button
                @click="showModal = true"
                v-if="auction.status === 'ongoing'"
                class="flex-1 px-4 py-2 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
            >
                Place Bid
            </button>

            <button
                v-else-if="auction.status === 'closed'"
                class="flex-1 px-4 py-2 bg-gray-600 text-white rounded-md text-sm font-medium hover:bg-gray-700 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
            >
                View Results
            </button>
        </div>
    </div>
    <Bid :show="showModal" :auction="auction" @close="showModal = false" />
</template>
