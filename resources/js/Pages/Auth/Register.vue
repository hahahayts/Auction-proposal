<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <!-- Card container with shadow -->
        <div class="rounded-lg bg-white p-8 shadow-lg">
            <!-- Header section -->
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-gray-800">Create Account</h1>
                <p class="mt-2 text-sm text-gray-500">
                    Join us by filling out the form below
                </p>
            </div>

            <form @submit.prevent="submit">
                <!-- Name field -->
                <div class="mb-5">
                    <InputLabel
                        for="name"
                        value="Name"
                        class="text-gray-700 font-medium"
                    />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Your full name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <!-- Email field -->
                <div class="mb-5">
                    <InputLabel
                        for="email"
                        value="Email"
                        class="text-gray-700 font-medium"
                    />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300"
                        v-model="form.email"
                        required
                        autocomplete="username"
                        placeholder="your@email.com"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- Password field -->
                <div class="mb-5">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="text-gray-700 font-medium"
                    />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- Confirm Password field -->
                <div class="mb-6">
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                        class="text-gray-700 font-medium"
                    />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-300"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />

                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>

                <!-- Register button and login link with improved layout -->
                <div
                    class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0"
                >
                    <PrimaryButton
                        class="w-full justify-center py-2.5 bg-indigo-600 hover:bg-indigo-700 sm:w-auto sm:px-6"
                        :class="{ 'opacity-75': form.processing }"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Processing...</span>
                        <span v-else>Create Account</span>
                    </PrimaryButton>

                    <Link
                        :href="route('login')"
                        class="text-center text-sm text-indigo-600 hover:text-indigo-800 focus:outline-none focus:underline"
                    >
                        Already have an account?
                    </Link>
                </div>
            </form>

            <!-- Terms section -->
            <div
                class="mt-8 border-t border-gray-200 pt-6 text-center text-xs text-gray-500"
            >
                By creating an account, you agree to our
                <a href="#" class="text-indigo-600 hover:text-indigo-800"
                    >Terms of Service</a
                >
                and
                <a href="#" class="text-indigo-600 hover:text-indigo-800"
                    >Privacy Policy</a
                >
            </div>
        </div>
    </GuestLayout>
</template>
