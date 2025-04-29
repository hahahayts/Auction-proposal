<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen flex">
        <!-- Enhanced Sidebar -->
        <aside class="w-72 bg-white shadow-xl p-6 flex flex-col">
            <!-- Logo & Header -->
            <div class="mb-8">
                <!-- {{ $page.component }} -->
                <div class="flex items-center gap-3">
                    <div
                        class="w-[50px] h-[50px] bg-gray-600 rounded-full"
                    ></div>
                    <div class="w-1/2">
                        <h1
                            class="text-2xl font-bold text-gray-800 flex items-center capitalize truncate"
                        >
                            {{ $page.props.auth.user.name }}
                        </h1>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $page.props.auth.user.email }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-2 flex-1">
                <!-- Dashboard -->
                <Link
                    href="/admin/dashboard"
                    class="flex items-center px-4 py-3 rounded-lg transition duration-200 group"
                    :class="
                        $page.component === 'Admin/Dashboard'
                            ? 'bg-blue-50 text-blue-600'
                            : 'text-gray-700 hover:bg-gray-100'
                    "
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        :class="
                            $page.component === 'Admin/Dashboard'
                                ? 'text-blue-600'
                                : 'text-gray-500 group-hover:text-blue-500'
                        "
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h6v6H3V3zm0 12h6v6H3v-6zm12-12h6v6h-6V3zm0 12h6v6h-6v-6z"
                        />
                    </svg>

                    <span class="font-medium"> Dashboard</span>
                    <span
                        v-if="$page.component === '/dashboard'"
                        class="ml-auto w-1 h-8 bg-blue-600 rounded-full"
                    ></span>
                </Link>

                <!-- Auction -->
                <Link
                    href="/admin/auctions"
                    class="flex items-center px-4 py-3 rounded-lg transition duration-200 group"
                    :class="
                        $page.component === 'Admin/Auction/Index'
                            ? 'bg-blue-50 text-blue-600'
                            : 'text-gray-700 hover:bg-gray-100'
                    "
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        :class="
                            $page.component === '/dashboard'
                                ? 'text-blue-600'
                                : 'text-gray-500 group-hover:text-blue-500'
                        "
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
                    <span class="font-medium"> Auctions</span>
                    <span
                        v-if="$page.component === '/Admin/Auction/Index'"
                        class="ml-auto w-1 h-8 bg-blue-600 rounded-full"
                    ></span>
                </Link>

                <!-- All Bids -->

                <Link
                    href="/admin/bids"
                    class="flex items-center px-4 py-3 rounded-lg transition duration-200 group"
                    :class="
                        $page.url === '/admin/bids'
                            ? 'bg-blue-50 text-blue-600'
                            : 'text-gray-700 hover:bg-gray-100'
                    "
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        :class="
                            $page.url === '/admin/bids'
                                ? 'text-blue-600'
                                : 'text-gray-500 group-hover:text-blue-500'
                        "
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span class="font-medium">All Bids</span>
                </Link>

                <!-- Users -->
                <Link
                    href="/admin/users"
                    class="flex items-center px-4 py-3 rounded-lg transition duration-200 group"
                    :class="
                        $page.component === 'Admin/Users/Index'
                            ? 'bg-blue-50 text-blue-600'
                            : 'text-gray-700 hover:bg-gray-100'
                    "
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        :class="
                            $page.component === 'Admin/Users/Index'
                                ? 'text-blue-600'
                                : 'text-gray-500 group-hover:text-blue-500'
                        "
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5.121 17.804A10.97 10.97 0 0112 15c2.389 0 4.584.746 6.379 2.004M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                    <span class="font-medium">Users</span>
                </Link>

                <Link
                    href="/admin/settings"
                    class="flex items-center px-4 py-3 rounded-lg transition duration-200 group"
                    :class="
                        $page.url === '/admin/settings'
                            ? 'bg-blue-50 text-blue-600'
                            : 'text-gray-700 hover:bg-gray-100'
                    "
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3"
                        :class="
                            $page.url === '/admin/settings'
                                ? 'text-blue-600'
                                : 'text-gray-500 group-hover:text-blue-500'
                        "
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                    <span class="font-medium">Settings</span>
                </Link>
            </nav>

            <!-- Footer / Logout Section -->
            <div class="mt-auto pt-4 border-t border-gray-200">
                <Link
                    :href="route('logout')"
                    method="post"
                    class="w-full flex items-center px-4 py-3 rounded-lg text-red-500 hover:bg-red-50 hover:text-red-600 transition duration-200 group"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 mr-3 text-red-400 group-hover:text-red-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                        />
                    </svg>
                    <span class="font-medium">Logout</span>
                </Link>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-50">
            <slot />
        </main>
    </div>
</template>
