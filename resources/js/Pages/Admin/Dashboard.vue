<script setup>
import Sidebar from "@/Components/Sidebar.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    user: Object,
    usersCount: Number,
    categories: Array,
});

// Static stats
const ongoingAuctions = 14;
const endedAuctions = 56;

// Static recent auctions
const recentAuctions = [
    {
        id: 1,
        title: "Vintage Camera Collection",
        category: "Collectibles",
        start_price: 250,
        current_bid: 375,
        end_time: "2025-05-01T15:00:00",
        image_url: null,
        bids_count: 8,
        status: "active",
    },
    {
        id: 2,
        title: "Apple MacBook Pro M3",
        category: "Electronics",
        start_price: 1200,
        current_bid: 1550,
        end_time: "2025-04-28T20:00:00",
        image_url: null,
        bids_count: 12,
        status: "active",
    },
    {
        id: 3,
        title: "Antique Wooden Desk",
        category: "Furniture",
        start_price: 450,
        current_bid: 450,
        end_time: "2025-04-30T18:30:00",
        image_url: null,
        bids_count: 0,
        status: "active",
    },
    {
        id: 4,
        title: "Diamond Engagement Ring",
        category: "Jewelry",
        start_price: 3000,
        current_bid: 4250,
        end_time: "2025-04-25T12:00:00",
        image_url: null,
        bids_count: 7,
        status: "active",
    },
];

// Static popular categories
const popularCategories = [
    { name: "Electronics", count: 35, color: "bg-blue-500" },
    { name: "Collectibles", count: 28, color: "bg-purple-500" },
    { name: "Jewelry", count: 24, color: "bg-yellow-500" },
    { name: "Art", count: 18, color: "bg-pink-500" },
    { name: "Vehicles", count: 15, color: "bg-green-500" },
];

// Static recent activity
const recentActivity = [
    {
        type: "bid",
        user: "Emma Wilson",
        item: "Vintage Camera Collection",
        amount: 375,
        time: "10 minutes ago",
    },
    {
        type: "auction_created",
        user: "Michael Chen",
        item: "Baseball Card Collection",
        time: "1 hour ago",
    },
    {
        type: "auction_ended",
        user: "Sarah Johnson",
        item: "Oil Painting - Beach Sunset",
        final_price: 780,
        time: "3 hours ago",
    },
    {
        type: "bid",
        user: "James Miller",
        item: "Apple MacBook Pro M3",
        amount: 1550,
        time: "4 hours ago",
    },
    {
        type: "auction_created",
        user: "Laura Garcia",
        item: "Handcrafted Leather Bag",
        time: "5 hours ago",
    },
];

// Get current date
const currentDate = new Date().toLocaleDateString("en-US", {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
});
</script>

<template>
    <Head title="Dashboard" />

    <Sidebar :user="user">
        <div class="p-6 lg:p-8 bg-gray-50 min-h-screen">
            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between mb-8"
            >
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                    <p class="text-gray-500 mt-1">{{ currentDate }}</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8"
            >
                <!-- Total Users -->
                <div
                    class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center"
                >
                    <div class="rounded-full p-3 bg-blue-100 mr-4">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-blue-600"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                            />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-gray-600 text-sm font-medium">
                            Total Users
                        </h2>
                        <p class="text-3xl font-bold text-gray-800 mt-1">
                            {{ usersCount }}
                        </p>
                    </div>
                </div>

                <!-- Ongoing Auctions -->
                <div
                    class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center"
                >
                    <div class="rounded-full p-3 bg-green-100 mr-4">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-green-600"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-gray-600 text-sm font-medium">
                            Ongoing Auctions
                        </h2>
                        <p class="text-3xl font-bold text-gray-800 mt-1">
                            {{ ongoingAuctions }}
                        </p>
                    </div>
                </div>

                <!-- Ended Auctions -->
                <div
                    class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center"
                >
                    <div class="rounded-full p-3 bg-red-100 mr-4">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-red-600"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-gray-600 text-sm font-medium">
                            Ended Auctions
                        </h2>
                        <p class="text-3xl font-bold text-gray-800 mt-1">
                            {{ endedAuctions }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Auctions -->
                <div class="lg:col-span-2">
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden"
                    >
                        <div
                            class="p-6 border-b border-gray-100 flex justify-between items-center"
                        >
                            <h2 class="text-lg font-semibold text-gray-800">
                                Recent Auctions
                            </h2>
                            <a
                                href="#"
                                class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
                                >View All</a
                            >
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th
                                            class="text-left py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Item
                                        </th>
                                        <th
                                            class="text-left py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Category
                                        </th>
                                        <th
                                            class="text-left py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Current Bid
                                        </th>
                                        <th
                                            class="text-left py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Ends In
                                        </th>
                                        <th
                                            class="text-left py-3 px-6 text-xs font-medium text-gray-500 uppercase tracking-wider"
                                        >
                                            Bids
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr
                                        v-for="auction in recentAuctions"
                                        :key="auction.id"
                                        class="hover:bg-gray-50"
                                    >
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center text-gray-400"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="h-6 w-6"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                        />
                                                    </svg>
                                                </div>
                                                <div class="ml-4">
                                                    <div
                                                        class="text-sm font-medium text-gray-900"
                                                    >
                                                        {{ auction.title }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800"
                                            >
                                                {{ auction.category }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                ${{ auction.current_bid }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                Start: ${{
                                                    auction.start_price
                                                }}
                                            </div>
                                        </td>
                                        <td
                                            class="py-4 px-6 text-sm text-gray-500"
                                        >
                                            <div class="text-sm font-medium">
                                                3 days
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{ auction.bids_count }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Popular Categories -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden"
                    >
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-800">
                                Popular Categories
                            </h2>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-4">
                                <li
                                    v-for="(
                                        category, index
                                    ) in popularCategories"
                                    :key="index"
                                    class="flex items-center justify-between"
                                >
                                    <div class="flex items-center">
                                        <div
                                            class="w-3 h-3 rounded-full mr-3"
                                            :class="category.color"
                                        ></div>
                                        <span
                                            class="text-sm font-medium text-gray-700"
                                            >{{ category.name }}</span
                                        >
                                    </div>
                                    <span class="text-sm text-gray-500">{{
                                        category.count
                                    }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden"
                    >
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-800">
                                Recent Activity
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-5">
                                <div
                                    v-for="(activity, index) in recentActivity"
                                    :key="index"
                                    class="flex"
                                >
                                    <!-- Icon based on activity type -->
                                    <div
                                        v-if="activity.type === 'bid'"
                                        class="rounded-full h-8 w-8 flex items-center justify-center bg-green-100 text-green-500 mr-3"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </div>
                                    <div
                                        v-else-if="
                                            activity.type === 'auction_created'
                                        "
                                        class="rounded-full h-8 w-8 flex items-center justify-center bg-blue-100 text-blue-500 mr-3"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </div>
                                    <div
                                        v-else
                                        class="rounded-full h-8 w-8 flex items-center justify-center bg-red-100 text-red-500 mr-3"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <!-- Activity description -->
                                        <div
                                            class="text-sm"
                                            v-if="activity.type === 'bid'"
                                        >
                                            <span
                                                class="font-medium text-gray-900"
                                                >{{ activity.user }}</span
                                            >
                                            <span class="text-gray-600"
                                                >bid ${{
                                                    activity.amount
                                                }}
                                                on</span
                                            >
                                            <span
                                                class="font-medium text-gray-900"
                                                >{{ activity.item }}</span
                                            >
                                        </div>
                                        <div
                                            class="text-sm"
                                            v-else-if="
                                                activity.type ===
                                                'auction_created'
                                            "
                                        >
                                            <span
                                                class="font-medium text-gray-900"
                                                >{{ activity.user }}</span
                                            >
                                            <span class="text-gray-600"
                                                >created a new auction:</span
                                            >
                                            <span
                                                class="font-medium text-gray-900"
                                                >{{ activity.item }}</span
                                            >
                                        </div>
                                        <div class="text-sm" v-else>
                                            <span
                                                class="font-medium text-gray-900"
                                                >{{ activity.user }}</span
                                            >
                                            <span class="text-gray-600"
                                                >ended auction:</span
                                            >
                                            <span
                                                class="font-medium text-gray-900"
                                                >{{ activity.item }}</span
                                            >
                                            <span class="text-gray-600"
                                                >at ${{
                                                    activity.final_price
                                                }}</span
                                            >
                                        </div>

                                        <!-- Timestamp -->
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ activity.time }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Sidebar>
</template>
