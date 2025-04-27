<script setup>
import { Head, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { Link } from "@inertiajs/vue3";

import Navbar from "@/Layouts/Navbar.vue";
import AuctionCard from "./components/AuctionCard.vue";
import { throttle } from "lodash";
import { debounce } from "lodash";

const props = defineProps({
    auctions: {
        type: Object,
        required: true,
    },
    categories: {
        type: Object,
        required: true,
    },
});

const searchQuery = ref("");
watch(
    searchQuery,
    debounce(
        (q) => router.get("/auctions", { search: q }, { preserveState: true }),
        300
    )
);
</script>

<template>
    <Head title="My Auctions" />
    <Navbar>
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <!-- Header Section with Enhanced Styling -->
            <div class="mb-10 border-b pb-6">
                <h1 class="text-4xl font-bold mb-3 text-gray-800">
                    All Auctions
                </h1>
                <p class="text-gray-600 text-lg max-w-3xl">
                    Browse and find auctions here. Use the filters to find
                    specific auctions or search by name.
                </p>
            </div>

            <!-- Filter and Search Controls - Redesigned with better spacing -->
            <div class="flex flex-col md:flex-row justify-between mb-10 gap-6">
                <div class="flex flex-col gap-5">
                    <!-- Categories -->
                    <div class="flex flex-wrap gap-3">
                        <Link
                            href="/auctions"
                            class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200"
                            :class="
                                $page.component.includes('User/Auction')
                                    ? 'text-blue-600 font-semibold border-b-2 border-blue-600'
                                    : ''
                            "
                        >
                            All
                        </Link>
                        <div v-for="category in categories" :key="category.id">
                            <Link
                                :href="`/auctions/category-id=${category.id}`"
                                class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200"
                                :class="
                                    $page.url ===
                                    `/auctions/category-id=${category.id}`
                                        ? 'text-blue-600 font-semibold border-b-2 border-blue-600'
                                        : ''
                                "
                            >
                                {{ category.name }}
                            </Link>
                        </div>
                    </div>

                    <!-- Status Filters - Enhanced buttons -->
                    <div class="flex flex-wrap gap-3">
                        <Link
                            :href="'/auctions?status=ongoing'"
                            class="px-5 py-2 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium"
                            :class="
                                $page.url === '/auctions?status=ongoing'
                                    ? 'bg-blue-600 text-white shadow-md'
                                    : 'bg-gray-100 hover:bg-gray-200 text-gray-700 hover:shadow'
                            "
                        >
                            Ongoing
                        </Link>
                        <Link
                            :href="'/auctions?status=upcoming'"
                            class="px-5 py-2 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium"
                            :class="
                                $page.url === '/auctions?status=upcoming'
                                    ? 'bg-blue-600 text-white shadow-md'
                                    : 'bg-gray-100 hover:bg-gray-200 text-gray-700 hover:shadow'
                            "
                        >
                            Upcoming
                        </Link>
                        <Link
                            :href="'/auctions?status=closed'"
                            class="px-5 py-2 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium"
                            :class="
                                $page.url === '/auctions?status=closed'
                                    ? 'bg-blue-600 text-white shadow-md'
                                    : 'bg-gray-100 hover:bg-gray-200 text-gray-700 hover:shadow'
                            "
                        >
                            Closed
                        </Link>
                    </div>
                </div>

                <!-- Search Box - Enhanced -->
                <div class="relative">
                    <div
                        class="absolute top-4 left-0 pl-4 flex items-center pointer-events-none"
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
                        class="pl-12 pr-4 py-3 border border-gray-300 rounded-full w-full md:w-80 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm hover:shadow"
                    />
                </div>
            </div>

            <!-- Auctions Grid - Enhanced with better cards -->
            <div
                v-if="auctions.data.length > 0"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
            >
                <div
                    v-for="auction in auctions.data"
                    :key="auction.id"
                    class="border border-gray-200 rounded-xl overflow-hidden shadow hover:shadow-xl transition-all duration-300 bg-white flex flex-col h-full transform hover:-translate-y-1"
                >
                    <!-- Auction Card -->
                    <AuctionCard :auction="auction" />
                </div>
            </div>

            <!-- Empty state - Enhanced -->
            <div v-else class="text-center py-16 bg-gray-50 rounded-lg">
                <svg
                    class="mx-auto h-12 w-12 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                    />
                </svg>
                <p class="mt-2 text-lg font-medium text-gray-600">
                    No auctions found.
                </p>
                <p class="mt-1 text-gray-500">
                    Try adjusting your search or filter criteria.
                </p>
            </div>

            <!-- Pagination - Enhanced -->
            <div class="flex justify-end mt-10">
                <div
                    class="inline-flex items-center justify-center gap-2 bg-white p-1 rounded-lg shadow-sm border border-gray-200"
                >
                    <!-- First page button -->
                    <Link
                        :href="auctions.first_page_url"
                        class="flex items-center justify-center w-10 h-10 rounded-md text-gray-500 hover:bg-gray-100 transition-colors"
                    >
                        <span class="sr-only">First page</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd"
                            />
                            <path
                                fill-rule="evenodd"
                                d="M8.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L4.414 10l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </Link>

                    <!-- Previous page button -->
                    <Link
                        v-if="auctions.prev_page_url"
                        :href="auctions.prev_page_url"
                        class="flex items-center justify-center w-10 h-10 rounded-md text-gray-500 hover:bg-gray-100 transition-colors"
                    >
                        <span class="sr-only">Previous page</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </Link>

                    <!-- Page numbers -->
                    <span class="px-3 py-1 font-medium text-gray-700">
                        Page {{ auctions.current_page }} of
                        {{ auctions.last_page }}
                    </span>

                    <!-- Next page button -->
                    <Link
                        :href="auctions.next_page_url"
                        class="flex items-center justify-center w-10 h-10 rounded-md text-gray-500 hover:bg-gray-100 transition-colors"
                    >
                        <span class="sr-only">Next page</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </Link>

                    <!-- Last page button -->
                    <Link
                        :href="auctions.last_page_url"
                        class="flex items-center justify-center w-10 h-10 rounded-md text-gray-500 hover:bg-gray-100 transition-colors"
                    >
                        <span class="sr-only">Last page</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 15.707a1 1 0 001.414 0l5-5a1 1 0 000-1.414l-5-5a1 1 0 00-1.414 1.414L8.586 10l-4.293 4.293a1 1 0 000 1.414z"
                                clip-rule="evenodd"
                            />
                            <path
                                fill-rule="evenodd"
                                d="M11.293 15.707a1 1 0 001.414 0l5-5a1 1 0 000-1.414l-5-5a1 1 0 00-1.414 1.414L15.586 10l-4.293 4.293a1 1 0 000 1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </Link>
                </div>
            </div>
            <!-- End of Pagination -->
        </div>
    </Navbar>
</template>
