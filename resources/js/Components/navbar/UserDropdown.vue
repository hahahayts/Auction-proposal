<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>

<template>
    <Dropdown align="right" width="56">
        <template #trigger>
            <button
                class="flex items-center gap-3 rounded-full pl-3 pr-2 py-2 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                <!-- Avatar with initials -->
                <div
                    class="flex items-center justify-center w-10 h-10 rounded-full ring-2 ring-white shadow-sm bg-blue-500"
                >
                    <span class="text-white text-sm font-bold capitalize">
                        {{ $page.props.auth?.user?.name[0] }}
                    </span>
                </div>

                <!-- Dropdown arrow -->
                <svg
                    class="w-5 h-5 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>
        </template>

        <template #content>
            <div
                class="w-full py-1 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
            >
                <!-- Header with user info -->
                <div class="px-4 py-3 border-b border-gray-100">
                    <div class="flex items-center">
                        <div
                            class="flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center bg-blue-500"
                        >
                            <span
                                class="text-white text-xl font-medium capitalize"
                            >
                                {{ $page.props.auth?.user?.name[0] }}
                            </span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $page.props.auth?.user?.name }}
                            </p>
                            <p class="text-xs text-gray-500 truncate">
                                {{
                                    $page.props.auth?.user?.email ||
                                    "user@example.com"
                                }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Menu items -->
                <div class="py-1">
                    <DropdownLink
                        href="/profile"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        <svg
                            class="mr-3 w-5 h-5 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                        Profile
                    </DropdownLink>

                    <DropdownLink
                        href="/settings"
                        class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                        <svg
                            class="mr-3 w-5 h-5 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg"
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
                        Settings
                    </DropdownLink>
                </div>

                <!-- Logout section -->
                <div class="py-1 border-t border-gray-100">
                    <DropdownLink
                        method="post"
                        href="/logout"
                        as="button"
                        class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                    >
                        <svg
                            class="mr-3 w-5 h-5 text-red-500"
                            xmlns="http://www.w3.org/2000/svg"
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
                        Logout
                    </DropdownLink>
                </div>
            </div>
        </template>
    </Dropdown>
</template>
