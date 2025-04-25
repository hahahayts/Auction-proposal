<script setup>
import { Link } from "@inertiajs/vue3";
import UserDropdown from "@/Components/navbar/UserDropdown.vue";
</script>

<template>
    <header>
        <nav class="bg-white shadow py-4">
            <div
                class="container mx-auto px-4 flex justify-between items-center"
            >
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600"
                        >AuctionHub</span
                    >
                </div>
                <div class="md:flex space-x-8">
                    <Link
                        href="/auctions"
                        :class="
                            $page.url === '/auctions'
                                ? 'text-blue-600'
                                : 'text-gray-700'
                        "
                    >
                        Auctions
                    </Link>
                    <Link
                        href="/my-bids"
                        :class="
                            $page.url === '/my-bids'
                                ? 'text-blue-600'
                                : 'text-gray-700'
                        "
                    >
                        My Bids
                    </Link>
                    <Link> My Auctions </Link>
                </div>
                <div class="flex items-center space-x-4">
                    <UserDropdown />
                </div>
            </div>
        </nav>
    </header>
    <main>
        <slot />
    </main>
</template>
