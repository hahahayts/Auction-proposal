<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";

defineProps({
    bids: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="My Bids" />
    <Navbar>
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-10 border-b pb-6">
                <h1 class="text-4xl font-bold mb-3 text-gray-800">My Bids</h1>
                <p class="text-gray-600 text-lg max-w-3xl">
                    Track all your auction bids in one place. Monitor your
                    active bids and auction status.
                </p>
            </div>

            <!-- Bids List -->
            <div v-if="bids.length > 0" class="space-y-6">
                <div
                    v-for="bid in bids"
                    :key="bid.id"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300"
                >
                    <div class="p-6">
                        <div
                            class="flex flex-col md:flex-row md:items-center justify-between gap-4"
                        >
                            <!-- Auction Info -->
                            <div class="flex-1">
                                <h3
                                    class="text-xl font-bold text-gray-800 mb-2"
                                >
                                    {{ bid.auction.title }}
                                </h3>
                                <div
                                    class="flex items-center text-gray-500 mb-3"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 mr-2"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        />
                                    </svg>
                                    <span
                                        >Bid placed on
                                        {{
                                            new Date(
                                                bid.created_at
                                            ).toLocaleDateString()
                                        }}</span
                                    >
                                </div>

                                <!-- Bid Status Badge -->
                                <div class="flex items-center">
                                    <span
                                        :class="{
                                            'bg-green-100 text-green-800':
                                                bid.is_winning,
                                            'bg-yellow-100 text-yellow-800':
                                                !bid.is_winning &&
                                                bid.auction.status ===
                                                    'ongoing',
                                            'bg-red-100 text-red-800':
                                                !bid.is_winning &&
                                                bid.auction.status === 'closed',
                                        }"
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"
                                    >
                                        <span
                                            v-if="
                                                bid.is_winning &&
                                                bid.auction.status === 'ongoing'
                                            "
                                            >Currently Winning</span
                                        >
                                        <span
                                            v-else-if="
                                                bid.is_winning &&
                                                bid.auction.status === 'closed'
                                            "
                                            >Won</span
                                        >
                                        <span
                                            v-else-if="
                                                !bid.is_winning &&
                                                bid.auction.status === 'ongoing'
                                            "
                                            >Outbid</span
                                        >
                                        <span v-else>Lost</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Bid Amount -->
                            <div class="text-right">
                                <div class="text-sm text-gray-500 mb-1">
                                    Your bid:
                                </div>
                                <div class="text-2xl font-bold text-blue-600">
                                    ${{ bid.amount.toLocaleString() }}
                                </div>

                                <div
                                    v-if="bid.auction.status === 'ongoing'"
                                    class="mt-2 text-sm text-gray-500"
                                >
                                    <span v-if="bid.is_winning"
                                        >Current highest bid</span
                                    >
                                    <span v-else>
                                        Current highest:
                                        <span class="font-semibold"
                                            >${{
                                                bid.auction.current_bid.toLocaleString()
                                            }}</span
                                        >
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-5 flex justify-end">
                            <Link
                                :href="`/auctions/${bid.auction.id}`"
                                class="inline-flex items-center px-4 py-2 rounded-md bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors text-sm font-medium"
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
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>
                                View Auction
                            </Link>
                            <button
                                v-if="bid.auction.status === 'ongoing'"
                                class="ml-3 inline-flex items-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition-colors text-sm font-medium"
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
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                    />
                                </svg>
                                Place New Bid
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="bg-gray-50 rounded-lg p-12 text-center">
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
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                    />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">
                    No bids yet
                </h3>
                <p class="mt-2 text-gray-500">
                    You haven't placed any bids on auctions. Start bidding to
                    see your activity here.
                </p>
                <div class="mt-6">
                    <a
                        href="/auctions"
                        class="inline-flex items-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition-colors"
                    >
                        Browse Auctions
                    </a>
                </div>
            </div>

            <!-- Current User -->
            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                <p class="text-gray-600">
                    Signed in as:
                    <span class="font-medium">{{
                        $page.props.auth.user.name
                    }}</span>
                </p>
            </div>
        </div>
    </Navbar>
</template>
