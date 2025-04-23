<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <!-- Card container with shadow -->
        <div class="rounded-lg bg-white p-8 shadow-lg">
            <!-- Header section -->
            <div></div>

            <div>
                <div class="mb-6 text-center">
                    <h1 class="text-2xl font-bold text-gray-800">
                        Welcome Back
                    </h1>
                    <p class="mt-2 text-sm text-gray-500">
                        Sign in to your account
                    </p>
                </div>

                <!-- Status message with improved styling -->
                <div
                    v-if="status"
                    class="mb-6 rounded-md bg-green-50 p-4 text-sm font-medium text-green-600 border border-green-200"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
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
                            autofocus
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
                            autocomplete="current-password"
                            placeholder="••••••••"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>

                    <!-- Remember me checkbox with better spacing -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <Checkbox
                                name="remember"
                                v-model:checked="form.remember"
                                class="text-indigo-600 focus:ring-indigo-500"
                            />
                            <span class="ms-2 text-sm text-gray-600"
                                >Remember me</span
                            >
                        </label>
                    </div>

                    <!-- Login button and forgot password with improved layout -->
                    <div
                        class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0"
                    >
                        <PrimaryButton
                            class="w-full justify-center py-2.5 bg-indigo-600 hover:bg-indigo-700 sm:w-auto sm:px-6"
                            :class="{ 'opacity-75': form.processing }"
                            :disabled="form.processing"
                        >
                            <span v-if="form.processing">Please wait...</span>
                            <span v-else>Sign in</span>
                        </PrimaryButton>

                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="text-center text-sm text-indigo-600 hover:text-indigo-800 focus:outline-none focus:underline"
                        >
                            Forgot your password?
                        </Link>
                    </div>
                </form>

                <!-- Sign up section -->
                <div
                    class="mt-8 border-t border-gray-200 pt-6 text-center text-sm text-gray-600"
                >
                    Don't have an account?
                    <Link
                        :href="route('register')"
                        class="font-medium text-indigo-600 hover:text-indigo-800"
                    >
                        Create an account
                    </Link>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
