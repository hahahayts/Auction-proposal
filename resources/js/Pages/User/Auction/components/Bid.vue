<script setup>
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { ref, computed } from "vue";

const props = defineProps({
    auction: {
        type: Object,
        required: true,
    },
    show: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close", "placeBid"]);

// Form handling
const bidAmount = ref("");
const bidError = ref("");

// Calculate minimum bid (current bid + 10% or at least 100)
const minimumBid = computed(() => {
    const currentBid = props.auction.current_bid || 0;
    return Math.max(currentBid + currentBid * 0.1, currentBid + 100);
});

// Format currency
const formatCurrency = (value) => {
    return new Intl.NumberFormat("en-PH", {
        style: "currency",
        currency: "PHP",
        minimumFractionDigits: 2,
    }).format(value);
};

// Handle bid submission
const submitBid = () => {
    // Clear previous errors
    bidError.value = "";

    // Validate bid amount
    if (!bidAmount.value) {
        bidError.value = "Please enter a bid amount";
        return;
    }

    const amount = parseFloat(bidAmount.value);

    if (isNaN(amount)) {
        bidError.value = "Please enter a valid amount";
        return;
    }

    if (amount < minimumBid.value) {
        bidError.value = `Your bid must be at least ${formatCurrency(
            minimumBid.value
        )}`;
        return;
    }

    // Submit the bid
    emit("placeBid", amount);
    bidAmount.value = "";
};

// Time remaining calculation
const timeRemaining = computed(() => {
    if (!props.auction.end_date) return "Auction ending soon";

    const endDate = new Date(props.auction.end_date);
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
</script>

<template>
    <Modal :show="show" max-width="2xl" @close="$emit('close')">
        <div class="p-6">
            <!-- Header with close button -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Auction Details</h2>
                <button
                    @click="$emit('close')"
                    class="text-gray-500 hover:text-gray-700 focus:outline-none"
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
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <!-- Main content -->
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Image container -->
                <div class="md:w-1/2">
                    <div class="bg-gray-100 rounded-lg overflow-hidden">
                        <img
                            :src="auction.imageURL"
                            :alt="auction.title"
                            class="w-full h-64 object-cover object-center"
                        />
                    </div>
                </div>

                <!-- Information container -->
                <div class="md:w-1/2">
                    <h1 class="text-2xl font-semibold text-gray-800">
                        {{ auction.title }}
                    </h1>
                    <p class="text-sm text-gray-600 mt-2">
                        {{ auction.description }}
                    </p>

                    <!-- Auction stats -->
                    <div class="mt-4 space-y-3">
                        <div
                            class="flex justify-between py-2 border-b border-gray-200"
                        >
                            <span class="text-gray-600">Current Bid:</span>
                            <span class="font-semibold">{{
                                formatCurrency(auction.current_bid || 0)
                            }}</span>
                        </div>

                        <div
                            class="flex justify-between py-2 border-b border-gray-200"
                        >
                            <span class="text-gray-600">Minimum Bid:</span>
                            <span class="font-semibold">{{
                                formatCurrency(minimumBid)
                            }}</span>
                        </div>

                        <div
                            class="flex justify-between py-2 border-b border-gray-200"
                        >
                            <span class="text-gray-600">Bids Placed:</span>
                            <span class="font-semibold">{{
                                auction.bids_count || 0
                            }}</span>
                        </div>

                        <div
                            class="flex justify-between py-2 border-b border-gray-200"
                        >
                            <span class="text-gray-600">Time Remaining:</span>
                            <span class="font-semibold text-amber-600">{{
                                timeRemaining
                            }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bidding form -->
            <div class="mt-6 pt-4 border-t border-gray-200">
                <form @submit.prevent="submitBid" class="space-y-4">
                    <div>
                        <InputLabel
                            for="bid"
                            value="Place your bid"
                            class="font-medium"
                        />
                        <TextInput
                            id="bid"
                            v-model="bidAmount"
                            type="number"
                            step="0.01"
                            class="mt-1 block w-full"
                            :placeholder="formatCurrency(minimumBid)"
                            min="0"
                        />
                        <InputError :message="bidError" class="mt-1" />
                        <p class="text-xs text-gray-500 mt-1">
                            Enter an amount of at least
                            {{ formatCurrency(minimumBid) }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold">Seller:</span>
                            {{ auction.seller?.name || "Unknown" }}
                        </p>
                        <button
                            type="submit"
                            :disabled="
                                !bidAmount || bidAmount < auction.current_bid
                            "
                            class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition cursor-pointer"
                        >
                            Place Bid
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Modal>
</template>
