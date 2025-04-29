<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>

<template>
    <Dropdown width="48">
        <template #trigger>
            <button class="relative bg-gray-500 rounded-full p-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                    class="w-8 h-8 text-white"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z"
                    />
                </svg>
                <span
                    class="absolute bottom-0 -right-1 text-red-500 font-bold px-1 py-0.5 bg-white rounded-full text-xs"
                >
                    15</span
                >
            </button>
        </template>
        <!-- Notification Modal -->

        <template #content>
            <div class="w-64 p-4 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-2">Notifications</h3>
                <ul class="space-y-2">
                    <li class="flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            class="w-6 h-6 text-gray-500 mr-2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M12 4a8 8 0 100 16 8 8 0 000-16z"
                            />
                        </svg>
                        <span class="text-gray-700"
                            >New bid on your auction</span
                        >
                    </li>
                    <li class="flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            class="w-6 h-6 text-gray-500 mr-2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 8v4m0 4h.01M12 4a8 8 0 100 16 8 8 0 000-16z"
                            />
                        </svg>
                        <span class="text-gray-700"
                            >New message from seller</span
                        >
                    </li>
                </ul>
            </div>
        </template>
    </Dropdown>
</template>
