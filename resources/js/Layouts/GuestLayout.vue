<script setup></script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0"
    >
        <div
            class="mt-6 w-full overflow-hidden px-6 py-4 sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
