<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>

<template>
    <Dropdown align="right" width="48">
        <template #trigger>
            <button
                class="flex gap-2 items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none capitalize"
            >
                <span>{{ $page.props.auth.user.name }}</span>
                <div
                    class="relative w-[50px] h-[50px] bg-gray-500 rounded-full"
                >
                    <span
                        class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white text-2xl font-semibold uppercase"
                    >
                        {{ $page.props.auth.user.name[0] }}
                    </span>
                </div>
                <!-- <span>Name</span> -->
                <svg
                    class="ml-1 w-4 h-4"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path d="M5.25 7.75L10 12.5l4.75-4.75" />
                </svg>
            </button>
        </template>

        <template #content>
            <DropdownLink href="/profile">Profile</DropdownLink>
            <DropdownLink href="/settings">Settings</DropdownLink>
            <DropdownLink method="post" href="/logout" as="button">
                Logout
            </DropdownLink>
        </template>
    </Dropdown>
</template>
