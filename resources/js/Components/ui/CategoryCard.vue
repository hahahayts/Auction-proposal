<script setup lang="ts">
interface CategoryCard {
    icon: string;
    name: string;
    count: number;
}
defineProps<{ category: CategoryCard }>();
</script>

<template>
    <div
        class="bg-gray-50 p-6 rounded-xl flex flex-col items-center justify-center hover:bg-blue-50 hover:shadow-md cursor-pointer transition"
    >
        <div class="text-4xl mb-2">{{ category.icon }}</div>
        <h3 class="font-semibold">{{ category.name }}</h3>
        <p class="text-sm text-gray-500">{{ category.count }} items</p>
    </div>
</template>
