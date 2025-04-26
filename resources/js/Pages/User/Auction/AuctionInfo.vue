<script setup>
import Navbar from "@/Layouts/Navbar.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

defineProps({
    auction: {
        type: Object,
        required: true,
    },
});

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
    <Head title="Auction Info" />

    <Navbar>
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <Link
                href="/auctions"
                class="flex items-center text-gray-700 hover:text-black cursor-pointer my-3"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
                Back
            </Link>

            <!-- Auction Header Section -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                <div class="px-4 py-5 sm:px-6 bg-gray-50">
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ auction.title }}
                    </h1>
                    <p
                        v-if="auction.description"
                        class="mt-1 text-sm text-gray-500"
                    >
                        {{ auction.description }}
                    </p>
                </div>

                <!-- Auction Status Banner -->
                <div
                    class="px-4 py-3"
                    :class="{
                        'bg-green-50': auction.status === 'ongoing',
                        'bg-yellow-50': auction.status === 'upcoming',
                        'bg-red-50': auction.status === 'closed',
                    }"
                >
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"
                        :class="
                            auction.status === 'ongoing'
                                ? 'bg-green-100 text-green-800'
                                : 'bg-gray-100 text-gray-800'
                        "
                    >
                        {{ auction.status }}
                    </span>
                    <span class="ml-3 text-sm text-gray-500">
                        {{
                            auction.active
                                ? "Ends on " + auction.end_date
                                : "Ended on " + auction.end_date
                        }}
                    </span>
                </div>
            </div>

            <!-- Auction Details -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Auction Details
                    </h2>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Starting Price
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                ${{ auction.starting_price }}
                            </dd>
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Current Bid
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                <span class="font-bold text-lg">{{
                                    formatCurrency(auction.current_bid)
                                }}</span>
                            </dd>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Total Bids
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ auction.bids_count || 0 }}
                            </dd>
                        </div>
                        <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Category
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ auction.category.name }}
                            </dd>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                        >
                            <dt class="text-sm font-medium text-gray-500">
                                Seller
                            </dt>
                            <dd
                                class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"
                            >
                                {{ auction.seller_name }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Image Gallery (if available) -->
            <div
                v-if="auction.images && auction.images.length"
                class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg"
            >
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-medium text-gray-900">Images</h2>
                </div>
                <div class="border-t border-gray-200 p-4">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div
                            v-for="(image, index) in auction.images"
                            :key="index"
                            class="aspect-w-1 aspect-h-1"
                        >
                            <img
                                :src="image.url"
                                :alt="auction.title + ' image ' + (index + 1)"
                                class="object-cover rounded-lg shadow-sm hover:opacity-90 transition-opacity"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bid Form -->
            <div
                v-if="auction.active"
                class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg"
            >
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Place Your Bid
                    </h2>
                </div>
                <div class="border-t border-gray-200 p-4">
                    <form class="space-y-4">
                        <div>
                            <label
                                for="bid_amount"
                                class="block text-sm font-medium text-gray-700"
                                >Bid Amount ($)</label
                            >
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                                >
                                    <span class="text-gray-500 sm:text-sm"
                                        >$</span
                                    >
                                </div>
                                <input
                                    type="number"
                                    name="bid_amount"
                                    id="bid_amount"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md"
                                    placeholder="0.00"
                                    min="auction.current_bid || auction.starting_price"
                                    step="0.01"
                                />
                            </div>
                            <p class="mt-1 text-xs text-gray-500">
                                Minimum bid: ${{
                                    (auction.current_bid ||
                                        auction.starting_price) + 1
                                }}
                            </p>
                        </div>
                        <button
                            type="submit"
                            class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Place Bid
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bid History -->
            <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Bid History
                    </h2>
                </div>
                <div class="border-t border-gray-200">
                    <div
                        v-if="auction.bids && auction.bids.length"
                        class="overflow-hidden"
                    >
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Bidder
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Amount
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="(bid, index) in auction.bids"
                                    :key="index"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                    >
                                        {{ bid.bidder_name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        ${{ bid.amount }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ bid.created_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        v-else
                        class="px-4 py-5 sm:px-6 text-sm text-gray-500 italic"
                    >
                        No bids have been placed yet.
                    </div>
                </div>
            </div>
            <p>{{ auction }}</p>
        </div>
    </Navbar>
</template>
