<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import Create from "@/Components/ui/Create.vue";
import EditModal from "./components/EditModal.vue";
import { ref } from "vue";
import { formatCurrency, formatDate } from "@/lib";
import { toast } from "vue3-toastify";

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
const showEditModal = ref(false);

const deleteAuction = (id) => {
    if (confirm("Are you sure you want to delete this auction?")) {
        router.delete(route("my-auctions.delete", id), {
            onSuccess: () => {
                toast.success("Auction deleted successfully!");
            },
        });
    }
};
</script>

<template>
    <Head title="My Auctions" />
    <Navbar>
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <!-- Header Section with improved gradient background -->
            <div class="mb-10 border-b pb-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4"
                    >
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">
                                My Auctions
                            </h1>
                            <p class="text-gray-600 mt-1">
                                Manage your active auction listings
                            </p>
                        </div>
                        <button
                            @click="showModal = true"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-5 rounded-lg shadow-md transition duration-150 ease-in-out flex items-center transform hover:scale-105"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            Create New Auction
                        </button>
                    </div>
                </div>
            </div>

            <!-- Auctions Grid Container with improved spacing -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div
                    v-if="auctions.length === 0"
                    class="bg-white rounded-xl shadow-sm border border-gray-100 text-center py-16 px-4"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-16 w-16 mx-auto text-blue-300"
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
                    <h3 class="mt-4 text-lg font-medium text-gray-900">
                        No auctions found
                    </h3>
                    <p class="mt-2 text-gray-500 max-w-md mx-auto">
                        Create your first auction and start receiving bids from
                        interested buyers.
                    </p>
                    <button
                        @click="showModal = true"
                        class="mt-6 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg shadow transition duration-150 ease-in-out"
                    >
                        Create Your First Auction
                    </button>
                </div>

                <div
                    v-else
                    class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3"
                >
                    <div
                        v-for="auction in auctions"
                        :key="auction.id"
                        class="bg-white overflow-hidden shadow-md rounded-xl border border-gray-100 hover:shadow-xl transition duration-200 ease-in-out group"
                    >
                        <!-- Show Edit Modal -->
                        <EditModal
                            :auction="auction"
                            :categories="categories"
                            :show="showEditModal"
                            @close="showEditModal = false"
                        />
                        <!-- Auction image with improved presentation -->
                        <div class="relative h-48 overflow-hidden bg-gray-100">
                            <img
                                :src="auction.imageURL"
                                alt=""
                                class="w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-105"
                            />
                            <div class="absolute top-3 right-3">
                                <span
                                    v-if="auction.status"
                                    class="px-3 py-1.5 text-xs font-medium rounded-full shadow-sm"
                                    :class="{
                                        'bg-green-100 text-green-800 border border-green-200':
                                            auction.status === 'ongoing',
                                        'bg-blue-100 text-blue-800 border border-blue-200':
                                            auction.status === 'upcoming',
                                        'bg-gray-100 text-gray-800 border border-gray-200':
                                            auction.status === 'closed',
                                    }"
                                >
                                    {{ auction.status }}
                                </span>
                            </div>
                        </div>

                        <!-- Auction details with improved typography -->
                        <div class="p-5">
                            <h3
                                class="text-lg font-semibold text-gray-900 truncate group-hover:text-blue-600 transition duration-150"
                            >
                                {{ auction.title }}
                            </h3>

                            <p
                                v-if="auction.description"
                                class="mt-2 text-sm text-gray-600 line-clamp-2"
                            >
                                {{ auction.description }}
                            </p>

                            <div class="mt-6 flex justify-between items-end">
                                <div>
                                    <p
                                        class="text-xs font-medium uppercase tracking-wide text-gray-500"
                                    >
                                        Current Bid
                                    </p>
                                    <p class="text-xl font-bold text-gray-900">
                                        {{
                                            formatCurrency(auction.current_bid)
                                        }}
                                    </p>
                                </div>

                                <div class="flex space-x-1">
                                    <!-- Edit Button -->
                                    <button
                                        @click="showEditModal = true"
                                        class="p-2 text-blue-600 hover:text-blue-800 rounded-full hover:bg-blue-50 transition duration-150"
                                        title="Edit auction"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                            />
                                        </svg>
                                    </button>

                                    <!-- Delete Button -->
                                    <button
                                        @click="deleteAuction(auction.id)"
                                        class="p-2 text-red-600 hover:text-red-800 rounded-full hover:bg-red-50 transition duration-150"
                                        title="Delete auction"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Auction footer with improved layout -->
                        <div
                            class="bg-gray-50 px-5 py-3 border-t border-gray-100"
                        >
                            <div
                                class="text-sm text-gray-500 flex justify-between items-center"
                            >
                                <span
                                    v-if="auction.end_time"
                                    class="flex items-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 mr-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                    {{ formatDate(auction.end_time) }}
                                </span>
                                <span
                                    v-if="auction.bidCount"
                                    class="flex items-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 mr-1"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
                                        />
                                    </svg>
                                    {{ auction.bidCount }} bids
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Create Auction Modal -->
            <Create
                :categories="categories"
                :show="showModal"
                postURL="/my-auctions/create"
                @close="showModal = false"
            />
        </div>
    </Navbar>
</template>
