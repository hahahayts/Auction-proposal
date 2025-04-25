<script setup>
import { Head } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import { ref, computed } from "vue";

const props = defineProps({
    auctions: {
        type: Array,
        required: true,
    },
});

// Mock data for demonstration
const mockAuctions = [
    {
        id: 1,
        title: "Vintage Watch Collection",
        status: "active",
        currentBid: 250,
        endDate: "2025-05-15",
        imageUrl: "/api/placeholder/250/150",
    },
    {
        id: 2,
        title: "Gaming Console Bundle",
        status: "active",
        currentBid: 180,
        endDate: "2025-05-10",
        imageUrl: "/api/placeholder/250/150",
    },
    {
        id: 3,
        title: "Antique Furniture Set",
        status: "ended",
        currentBid: 420,
        endDate: "2025-04-20",
        imageUrl: "/api/placeholder/250/150",
    },
    {
        id: 4,
        title: "Rare Book Collection",
        status: "pending",
        currentBid: 0,
        endDate: "2025-05-30",
        imageUrl: "/api/placeholder/250/150",
    },
    {
        id: 5,
        title: "Sport Memorabilia",
        status: "active",
        currentBid: 150,
        endDate: "2025-05-18",
        imageUrl: "/api/placeholder/250/150",
    },
];

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

// Format date helper
const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "short",
        day: "numeric",
    });
};
</script>

<template>
    <Head title="My Auctions" />
    <Navbar>
        <div class="max-w-7xl mx-auto p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold mb-2">My Auctions</h1>
                <p class="text-gray-600">
                    Manage your ongoing and past auctions
                </p>
            </div>

            <!-- Filter and Search Controls -->
            <div class="flex flex-col md:flex-row justify-between mb-6 gap-4">
                <div class="flex gap-2">
                    <button
                        @click="statusFilter = 'all'"
                        class="px-4 py-2 rounded-md"
                        :class="
                            statusFilter === 'all'
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-200'
                        "
                    >
                        All
                    </button>
                    <button
                        @click="statusFilter = 'active'"
                        class="px-4 py-2 rounded-md"
                        :class="
                            statusFilter === 'active'
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-200'
                        "
                    >
                        Active
                    </button>
                    <button
                        @click="statusFilter = 'pending'"
                        class="px-4 py-2 rounded-md"
                        :class="
                            statusFilter === 'pending'
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-200'
                        "
                    >
                        Pending
                    </button>
                    <button
                        @click="statusFilter = 'ended'"
                        class="px-4 py-2 rounded-md"
                        :class="
                            statusFilter === 'ended'
                                ? 'bg-blue-600 text-white'
                                : 'bg-gray-200'
                        "
                    >
                        Ended
                    </button>
                </div>
                <div class="relative">
                    <input
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search auctions..."
                        class="px-4 py-2 border rounded-md w-full md:w-64"
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
                    class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition"
                >
                    <img
                        :src="auction.imageUrl"
                        :alt="auction.title"
                        class="w-full h-40 object-cover"
                    />
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-lg">
                                {{ auction.title }}
                            </h3>
                            <span
                                class="text-sm px-2 py-1 rounded-full"
                                :class="{
                                    'bg-green-100 text-green-800':
                                        auction.status === 'active',
                                    'bg-yellow-100 text-yellow-800':
                                        auction.status === 'pending',
                                    'bg-gray-100 text-gray-800':
                                        auction.status === 'ended',
                                }"
                            >
                                {{ auction.status }}
                            </span>
                        </div>
                        <div class="mt-3 flex flex-col gap-1">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Current Bid:</span>
                                <span class="font-medium"
                                    >${{ auction.currentBid }}</span
                                >
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Ends:</span>
                                <span>{{ formatDate(auction.endDate) }}</span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between">
                            <button
                                class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm"
                            >
                                View Details
                            </button>
                            <button
                                v-if="auction.status === 'active'"
                                class="px-3 py-1 bg-green-600 text-white rounded-md text-sm"
                            >
                                Place Bid
                            </button>
                            <button
                                v-else-if="auction.status === 'pending'"
                                class="px-3 py-1 bg-yellow-600 text-white rounded-md text-sm"
                            >
                                Edit Listing
                            </button>
                            <button
                                v-else
                                class="px-3 py-1 bg-gray-600 text-white rounded-md text-sm"
                            >
                                View Results
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty state -->
            <div v-else class="text-center py-12 bg-gray-50 rounded-lg">
                <p class="text-xl text-gray-600">
                    No auctions found matching your criteria
                </p>
                <button
                    @click="
                        statusFilter = 'all';
                        searchQuery = '';
                    "
                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md"
                >
                    Clear Filters
                </button>
            </div>

            <!-- Create New Auction Button -->
            <div class="mt-8 flex justify-end">
                <button
                    class="px-6 py-2 bg-blue-600 text-white rounded-md font-medium"
                >
                    Create New Auction
                </button>
            </div>
        </div>
    </Navbar>
</template>
