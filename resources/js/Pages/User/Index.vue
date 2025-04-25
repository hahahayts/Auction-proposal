<script setup>
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";

import Navbar from "@/Layouts/Navbar.vue";
import AuctionCard from "./Auction/components/AuctionCard.vue";

const props = defineProps({
    auctions: {
        type: Array,
        required: true,
    },
});

// Use props.auctions if available, otherwise use mockAuctions
const allAuctions = computed(() =>
    props.auctions?.length ? props.auctions : mockAuctions
);

// Filter functionality
const statusFilter = ref("all");
const searchQuery = ref("");

const filteredAuctions = computed(() => {
    return allAuctions.value.filter((auction) => {
        const matchesStatus =
            statusFilter.value === "all" ||
            auction.status === statusFilter.value;
        const matchesSearch = auction.title
            .toLowerCase()
            .includes(searchQuery.value.toLowerCase());
        return matchesStatus && matchesSearch;
    });
});
</script>

<template>
    <Head title="My Auctions" />
    <Navbar>
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="mb-8 border-b pb-4">
                <h1 class="text-3xl font-bold mb-2 text-gray-800">
                    All Auctions
                </h1>
                <p class="text-gray-600">
                    Manage your ongoing and past auctions
                </p>
            </div>

            <!-- Filter and Search Controls -->
            <div class="flex flex-col md:flex-row justify-between mb-8 gap-4">
                <div class="flex flex-wrap gap-2">
                    <button
                        @click="statusFilter = 'all'"
                        class="px-4 py-2 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="
                            statusFilter === 'all'
                                ? 'bg-blue-600 text-white shadow-md'
                                : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                        "
                    >
                        All
                    </button>
                    <button
                        @click="statusFilter = 'ongoing'"
                        class="px-4 py-2 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="
                            statusFilter === 'ongoing'
                                ? 'bg-blue-600 text-white shadow-md'
                                : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                        "
                    >
                        Active
                    </button>
                    <button
                        @click="statusFilter = 'upcoming'"
                        class="px-4 py-2 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="
                            statusFilter === 'upcoming'
                                ? 'bg-blue-600 text-white shadow-md'
                                : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                        "
                    >
                        Upcoming
                    </button>
                    <button
                        @click="statusFilter = 'ended'"
                        class="px-4 py-2 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        :class="
                            statusFilter === 'ended'
                                ? 'bg-blue-600 text-white shadow-md'
                                : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                        "
                    >
                        Closed
                    </button>
                </div>
                <div class="relative">
                    <div
                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                    >
                        <svg
                            class="h-5 w-5 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search auctions..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full md:w-64 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    />
                </div>
            </div>

            <!-- Auctions Grid -->
            <div
                v-if="filteredAuctions.length"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
            >
                <div
                    v-for="auction in filteredAuctions"
                    :key="auction.id"
                    class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-all duration-200 bg-white flex flex-col h-full"
                >
                    <!-- Auction Card -->
                    <AuctionCard :auction="auction" />
                </div>
            </div>

            <!-- Empty state -->
            <div
                v-else
                class="text-center py-16 bg-gray-50 rounded-lg border border-gray-200 shadow-sm"
            >
                <svg
                    class="mx-auto h-12 w-12 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">
                    No auctions found
                </h3>
                <p class="mt-1 text-gray-500">
                    No auctions found matching your criteria
                </p>
                <button
                    @click="
                        statusFilter = 'all';
                        searchQuery = '';
                    "
                    class="mt-6 px-5 py-2 bg-blue-600 text-white rounded-md font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Clear Filters
                </button>
            </div>
        </div>
    </Navbar>
</template>
