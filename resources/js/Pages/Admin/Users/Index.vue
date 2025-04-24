<script setup>
import Sidebar from "@/Components/Sidebar.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    users: {
        type: Array,
        required: true,
    },
});

const searchQuery = ref("");
const filteredUsers = ref([]);

// Filter users based on search query
const filterUsers = () => {
    if (!searchQuery.value) {
        filteredUsers.value = props.users;
        return;
    }

    const query = searchQuery.value.toLowerCase();
    filteredUsers.value = props.users.filter(
        (user) =>
            user.name.toLowerCase().includes(query) ||
            user.email.toLowerCase().includes(query) ||
            (user.roles.length > 0 &&
                user.roles[0].name.toLowerCase().includes(query))
    );
};

// Initialize filtered users
filterUsers();
</script>

<template>
    <Head title="Manage Users" />
    <Sidebar :user="user">
        <div class="flex-1 p-6 lg:p-8 bg-gray-50">
            <div class="mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">
                        Users Management
                    </h1>
                    <div class="relative">
                        <input
                            v-model="searchQuery"
                            @input="filterUsers"
                            type="text"
                            placeholder="Search users..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        />
                        <div
                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-400"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100"
                >
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="bg-blue-300">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs text-white font-semibold uppercase tracking-wider"
                                    >
                                        User
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                    >
                                        Email
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                    >
                                        Role
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr
                                    v-for="user in filteredUsers"
                                    :key="user.id"
                                    class="hover:bg-gray-50 transition-colors duration-150 ease-in-out"
                                >
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-12 w-12 bg-gray-100 rounded-full overflow-hidden"
                                            >
                                                <img
                                                    v-if="user.imageURL"
                                                    :src="user.imageURL"
                                                    class="h-full w-full object-cover"
                                                    alt=""
                                                />
                                                <div
                                                    v-else
                                                    class="h-full w-full flex items-center justify-center text-gray-400 bg-gradient-to-br from-gray-100 to-gray-200"
                                                >
                                                    <span
                                                        class="text-lg font-medium text-gray-500"
                                                        >{{
                                                            user.name.charAt(0)
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium text-gray-900"
                                                >
                                                    {{ user.name }}
                                                </div>
                                                <div
                                                    class="text-xs text-gray-500 mt-1"
                                                >
                                                    User ID: {{ user.id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-600">
                                            {{ user.email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            v-if="user.roles.length > 0"
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="{
                                                'bg-blue-100 text-blue-800':
                                                    user.roles[0].name ===
                                                    'Admin',
                                                'bg-green-100 text-green-800':
                                                    user.roles[0].name ===
                                                    'Manager',
                                                'bg-purple-100 text-purple-800':
                                                    user.roles[0].name ===
                                                    'Editor',
                                                'bg-gray-100 text-gray-800': ![
                                                    'Admin',
                                                    'Manager',
                                                    'Editor',
                                                ].includes(user.roles[0].name),
                                            }"
                                        >
                                            {{ user.roles[0].name }}
                                        </span>
                                        <span
                                            v-else
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"
                                        >
                                            User
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <button
                                                class="text-gray-600 hover:text-indigo-600 transition-colors duration-150 ease-in-out group"
                                                title="View user details"
                                            >
                                                <div
                                                    class="p-1 rounded-full group-hover:bg-indigo-50"
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
                                                </div>
                                            </button>
                                            <button
                                                class="text-gray-600 hover:text-blue-600 transition-colors duration-150 ease-in-out group"
                                                title="Edit user"
                                            >
                                                <div
                                                    class="p-1 rounded-full group-hover:bg-blue-50"
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
                                                </div>
                                            </button>
                                            <button
                                                class="text-gray-600 hover:text-red-600 transition-colors duration-150 ease-in-out group"
                                                title="Delete user"
                                            >
                                                <div
                                                    class="p-1 rounded-full group-hover:bg-red-50"
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
                                                </div>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Empty state -->
                                <tr v-if="filteredUsers.length === 0">
                                    <td
                                        colspan="6"
                                        class="px-6 py-12 text-center"
                                    >
                                        <div class="flex flex-col items-center">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-16 w-16 text-gray-300 mb-4"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                                />
                                            </svg>
                                            <p
                                                class="text-gray-600 text-lg font-medium"
                                            >
                                                No users found
                                            </p>
                                            <p
                                                class="text-gray-400 mt-2 max-w-sm"
                                            >
                                                There are no users matching your
                                                search criteria. Try adjusting
                                                your search or check back later.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </Sidebar>
</template>
