<script setup>
import { computed, ref } from "vue";
import { Link } from "@inertiajs/vue3";

import Bid from "./Bid.vue";
import { formatCurrency, formatDate } from "@/lib";

const props = defineProps({
    auction: {
        type: Object,
        required: true,
    },
});

const showModal = ref(false);

const timeRemaining = computed(() => {
    if (!props.auction.end_time) return "Auction ending soon";

    const endDate = new Date(props.auction.end_time);
    const now = new Date();
    const diff = endDate - now;

    if (diff <= 0) return "Auction ended";

    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

    if (days > 0) return `${days}d ${hours}h remaining`;
    if (hours > 0) return `${hours}h ${minutes}m remaining`;
    return `${minutes}m remaining`;
});

const handleTimeRemaining = (status) => {
    if (status === "ongoing") return timeRemaining;
    if (status === "upcoming") return "Upcoming auction";
    // return formatDate(props.auction.start_time, "MMM D, YYYY h:mm A");
    return "Auction ended";
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
                    handleTimeRemaining(auction.status)
                }}</span>
            </div>
            <div class="flex justify-between items-center text-sm capitalize">
                <p>
                    Owner:
                    <span class="font-semibold"> {{ auction.user.name }}</span>
                </p>
                <p class="bg-pink-50 py-1 px-3 rounded-full">
                    {{ auction.category.name }}
                </p>
            </div>
        </div>
        <div class="mt-4 flex justify-between gap-2">
            <Link
                :href="`/auctions/${auction.id}`"
                class="w-full flex-1 px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-center"
            >
                View Details
            </Link>
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
