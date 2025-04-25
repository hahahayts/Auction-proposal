<script setup>
import Sidebar from "@/Layouts/Sidebar.vue";
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
    auctions: {
        type: Array,
        required: true,
    },
});

const showModal = ref(false);

// Format date function
const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleString();
};
</script>

<template>
    <Head title="Auction Dashboard" />

    <Sidebar :user="user">
        <div class="flex-1 p-6 lg:p-8 bg-gray-50">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Auctions</h1>
                <button
                    @click="showModal = true"
                    class="flex items-center py-2 px-4 bg-blue-600 rounded-lg font-medium text-white hover:bg-blue-700 transition duration-200 shadow-sm"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    Create New Auction
                </button>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead class="bg-blue-300 border-b border-gray-200">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    Title
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    Category
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    Start Price
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    Start Time
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    End Time
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="auction in auctions"
                                :key="auction.id"
                                class="hover:bg-gray-50"
                            >
                                <td class="px-6 py-4">
                                    <div class="w-[100px] flex items-center">
                                        <div
                                            class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-md overflow-hidden"
                                        >
                                            <img
                                                v-if="auction.imageURL"
                                                :src="auction.imageURL"
                                                class="h-full w-full object-cover"
                                                alt=""
                                            />
                                            <div
                                                v-else
                                                class="h-full w-full flex items-center justify-center text-gray-400"
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
                                        </div>
                                        <div class="w-full ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-900 truncate"
                                            >
                                                {{ auction.title }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                                    >
                                        {{ auction.category.name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        ${{ auction.start_price }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ auction.start_time }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        {{ auction.end_time }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button
                                            class="text-indigo-600 hover:text-indigo-900"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                                />
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                        <button
                                            class="text-blue-600 hover:text-blue-900"
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
                                        <button
                                            class="text-red-600 hover:text-red-900"
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
                                </td>
                            </tr>

                            <!-- Empty state -->
                            <tr v-if="auctions.length === 0">
                                <td colspan="6" class="px-6 py-10 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-12 w-12 text-gray-400 mb-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                            />
                                        </svg>
                                        <p
                                            class="text-gray-500 text-lg font-medium"
                                        >
                                            No auctions found
                                        </p>
                                        <p class="text-gray-400 mt-1">
                                            Create your first auction to get
                                            started
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <Create
            :categories="categories"
            :show="showModal"
            @close="showModal = false"
        />
    </Sidebar>
</template>
