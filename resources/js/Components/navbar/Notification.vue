<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

// Assuming notifications come from props
const props = defineProps({
    notifications: {
        type: Array,
        default: () => [],
    },
});

// Get time ago formatting
const getTimeAgo = (timestamp) => {
    // This is a placeholder - you would implement actual time formatting
    return "5m ago"; // Example
};
</script>

<template>
    <Dropdown width="80">
        <!-- Trigger Button with Badge -->
        <template #trigger>
            <button
                class="relative p-2 transition duration-300 bg-indigo-600 rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                    class="w-6 h-6 text-white"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z"
                    />
                </svg>

                <!-- Animated Badge -->
                <span
                    v-if="$page.props.notification_count > 0"
                    class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full ring-2 ring-white animate-pulse"
                >
                    {{
                        notifications.length > 9
                            ? "9+"
                            : $page.props.notification_count
                    }}
                </span>
            </button>
        </template>

        <!-- Dropdown Content -->
        <template #content>
            <div
                class="w-80 bg-white rounded-lg shadow-xl ring-1 ring-black ring-opacity-5 divide-y divide-gray-100"
            >
                <!-- Header -->
                <div class="p-4 flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900">
                        Notifications
                    </h3>
                    <Link
                        :href="route('notifications.markAllAsRead')"
                        method="post"
                        as="button"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-500"
                    >
                        Mark all as read
                    </Link>
                </div>

                <!-- Notification List -->
                <div class="max-h-80 overflow-y-auto">
                    <div v-if="notifications && notifications.length > 0">
                        <div
                            v-for="notification in notifications"
                            :key="notification.id"
                            :class="[
                                'p-4 transition-colors duration-200 hover:bg-gray-50 flex items-start gap-3',
                                !notification.is_read ? 'bg-indigo-50' : '',
                            ]"
                        >
                            <!-- Icon based on notification type -->
                            <div
                                :class="[
                                    'flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center',
                                    !notification.is_read
                                        ? 'bg-indigo-100 text-indigo-600'
                                        : 'bg-gray-100 text-gray-500',
                                ]"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    class="w-5 h-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 8v4m0 4h.01M12 4a8 8 0 100 16 8 8 0 000-16z"
                                    />
                                </svg>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <p
                                    :class="[
                                        'text-sm',
                                        !notification.is_read
                                            ? 'font-medium text-gray-900'
                                            : 'text-gray-700',
                                    ]"
                                >
                                    {{ notification.message }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ getTimeAgo(notification.timestamp) }}
                                </p>
                            </div>

                            <!-- Mark as read button -->

                            <button
                                class="flex-shrink-0 text-indigo-600 hover:text-indigo-900"
                            >
                                <span class="sr-only">Mark as read</span>
                                <svg
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div v-else class="p-8 text-center">
                        <svg
                            class="w-12 h-12 mx-auto text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                            ></path>
                        </svg>
                        <p class="mt-4 text-gray-500">No notifications yet</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="p-2">
                    <a
                        href="#"
                        class="block px-4 py-2 text-sm text-center font-medium text-indigo-600 hover:bg-indigo-50 rounded-md"
                    >
                        View all notifications
                    </a>
                </div>
            </div>
        </template>
    </Dropdown>
</template>
