<script setup>
import Sidebar from "@/Layouts/Sidebar.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="All Bids" />

    <!-- Todo: this is for admin page that will handle all the bids -->
    <Sidebar>
        <div>Manage All Bids</div>

        <!-- <p>{{ $page.props.bids }}</p> -->
        <div v-for="bid in $page.props.bids" :key="bid.id">
            <p>{{ bid.auction.title }}</p>
            <p>{{ bid.user.name }}</p>
            <p>{{ bid.amount }}</p>
        </div>
    </Sidebar>
</template>
