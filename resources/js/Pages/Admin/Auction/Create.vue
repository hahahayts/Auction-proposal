<script setup>
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";

const emit = defineEmits(["close"]);

defineProps({
    categories: {
        type: Array,
        required: true,
    },
    show: {
        type: Boolean,
        default: false,
    },
});

const form = useForm({
    title: "",
    category_id: null,
    description: "",
    imageURL: "",
    start_price: 0,
    start_time: "",
    end_time: "",
});

const submit = () => {
    form.post("/auctions", {
        onFinish: () => {
            // form.reset();
            toast.success("Form submitted successfully!");
            emit("close");
        },
    });
};
</script>

<template>
    <Modal :show="show" max-width="2xl" closeable>
        <div class="w-full bg-white rounded-lg shadow-lg p-8">
            <div
                class="flex justify-between items-center mb-6 pb-3 border-b border-gray-200"
            >
                <h2 class="text-2xl font-bold text-gray-800">Create Auction</h2>
                <button
                    @click="$emit('close')"
                    class="text-gray-400 hover:text-gray-600 transition duration-200 rounded-full p-1 hover:bg-gray-100"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Title -->
                <div>
                    <InputLabel
                        for="title"
                        value="Auction title"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="title"
                        required
                        type="text"
                        v-model="form.title"
                        placeholder="Enter auction title"
                        autofocus
                        autocomplete="title"
                        class="w-full mt-1 focus:ring-2 focus:ring-indigo-500/50"
                    />
                    <InputError
                        :message="form.errors.name"
                        for="name"
                        class="mt-2"
                    />
                </div>

                <!-- Category -->
                <div>
                    <InputLabel
                        for="category"
                        value="Category"
                        class="text-gray-700 font-medium"
                    />
                    <select
                        id="category"
                        name="category"
                        v-model="form.category_id"
                        required
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-opacity-50"
                    >
                        <option value="" disabled selected>
                            Select a category
                        </option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <InputError
                        :message="form.errors.category_id"
                        for="category"
                        class="mt-2"
                    />
                </div>

                <!-- Description -->
                <div>
                    <InputLabel
                        for="description"
                        value="Description"
                        class="text-gray-700 font-medium"
                    />
                    <textarea
                        name="description"
                        id="description"
                        v-model="form.description"
                        rows="5"
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-opacity-50"
                    ></textarea>
                    <InputError
                        :message="form.errors.description"
                        for="description"
                        class="mt-2"
                    />
                </div>

                <!-- Image URL -->
                <div>
                    <InputLabel
                        for="imageURL"
                        value="Image URL"
                        class="text-gray-700 font-medium"
                    />
                    <TextInput
                        id="imageURL"
                        required
                        type="text"
                        v-model="form.imageURL"
                        placeholder="https://example.com/image.jpg"
                        class="w-full mt-1 focus:ring-2 focus:ring-indigo-500/50"
                    />
                    <InputError
                        :message="form.errors.imageURL"
                        for="imageURL"
                        class="mt-2"
                    />
                </div>

                <!-- Start Price -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <InputLabel
                            for="start_price"
                            value="Starting Price"
                            class="text-gray-700 font-medium"
                        />
                        <div class="relative mt-1">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500"
                                >$</span
                            >
                            <TextInput
                                id="start_price"
                                required
                                type="number"
                                v-model="form.start_price"
                                class="pl-8 w-full focus:ring-2 focus:ring-indigo-500/50"
                            />
                        </div>
                        <InputError
                            :message="form.errors.start_price"
                            for="start_price"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <InputLabel
                            for="start_time"
                            value="Start Time"
                            class="text-gray-700 font-medium"
                        />
                        <TextInput
                            id="start_time"
                            type="datetime-local"
                            v-model="form.start_time"
                            class="mt-1 block w-full focus:ring-2 focus:ring-indigo-500/50"
                            required
                        />
                        <InputError
                            :message="form.errors.start_time"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <InputLabel
                            for="end_time"
                            value="End Time"
                            class="text-gray-700 font-medium"
                        />
                        <TextInput
                            id="end_time"
                            type="datetime-local"
                            v-model="form.end_time"
                            class="mt-1 block w-full focus:ring-2 focus:ring-indigo-500/50"
                            required
                        />
                        <InputError
                            :message="form.errors.end_time"
                            class="mt-2"
                        />
                    </div>
                </div>

                <!-- End Price -->
                <div class="flex mt-8 pt-4 border-t border-gray-200">
                    <button
                        :disabled="form.processing"
                        type="submit"
                        class="ml-auto bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-6 rounded-lg font-medium shadow-sm transition duration-200"
                    >
                        Create Auction
                    </button>
                </div>
            </form>
        </div>
    </Modal>
</template>
