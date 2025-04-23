<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import CategoryCard from "@/Components/ui/CategoryCard.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

// For countdown timer functionality
const timeLeft = ref([
    { hours: 1, minutes: 20 },
    { hours: 3, minutes: 45 },
    { hours: 0, minutes: 45 },
]);

// For testimonials carousel
const testimonials = ref([
    {
        name: "Maria Santos",
        role: "Collector",
        text: "I found rare collectibles at amazing prices. The bidding process is exciting and transparent!",
        avatar: "/api/placeholder/50/50",
    },
    {
        name: "David Chen",
        role: "Entrepreneur",
        text: "This platform has become my go-to for finding unique items for my business. Highly recommended!",
        avatar: "/api/placeholder/50/50",
    },
    {
        name: "Sarah Johnson",
        role: "Art Enthusiast",
        text: "The variety of auctions is impressive. I've won several art pieces that I cherish.",
        avatar: "/api/placeholder/50/50",
    },
]);

const currentTestimonial = ref(0);

const nextTestimonial = () => {
    currentTestimonial.value =
        (currentTestimonial.value + 1) % testimonials.value.length;
};

const prevTestimonial = () => {
    currentTestimonial.value =
        (currentTestimonial.value - 1 + testimonials.value.length) %
        testimonials.value.length;
};

// For featured categories
const categories = ref([
    { name: "Electronics", icon: "💻", count: 42 },
    { name: "Collectibles", icon: "🏆", count: 37 },
    { name: "Art", icon: "🎨", count: 28 },
    { name: "Jewelry", icon: "💍", count: 24 },
    { name: "Furniture", icon: "🪑", count: 19 },
    { name: "Vehicles", icon: "🚗", count: 13 },
]);

// For countdown functionality
onMounted(() => {
    const interval = setInterval(() => {
        timeLeft.value = timeLeft.value.map((time) => {
            if (time.minutes > 0) {
                return { ...time, minutes: time.minutes - 1 };
            } else if (time.hours > 0) {
                return { hours: time.hours - 1, minutes: 59 };
            }
            return { hours: 0, minutes: 0 };
        });
    }, 60000); // Update every minute

    return () => clearInterval(interval);
});
</script>

<template>
    <Head title="Auction Portal - Bid Smart, Win Big" />

    <div class="min-h-screen bg-white">
        <!-- Navigation -->
        <nav class="bg-white shadow py-4">
            <div
                class="container mx-auto px-4 flex justify-between items-center"
            >
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600"
                        >AuctionHub</span
                    >
                </div>
                <div class="flex items-center space-x-4">
                    <Link
                        v-if="canLogin"
                        href="/login"
                        class="text-gray-600 hover:text-blue-600 transition"
                        >Sign In</Link
                    >
                    <Link
                        v-if="canRegister"
                        href="/register"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                        >Sign Up</Link
                    >
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section
            class="bg-gradient-to-r from-blue-500 to-indigo-600 py-24 text-center text-white"
        >
            <div class="container mx-auto px-4">
                <h1 class="text-5xl font-bold mb-6">Bid Smart. Win Big.</h1>
                <p class="text-xl mb-8 max-w-2xl mx-auto">
                    Discover exclusive items and experience the thrill of live
                    auctions from anywhere, anytime.
                </p>
                <div class="flex justify-center gap-4">
                    <Link
                        v-if="canRegister"
                        href="/register"
                        class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition"
                    >
                        Start Bidding
                    </Link>
                    <Link
                        href="/auctions"
                        class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:bg-opacity-20 transition"
                    >
                        Explore Auctions
                    </Link>
                </div>
                <div class="mt-8 flex justify-center">
                    <div class="bg-white bg-opacity-20 rounded-lg p-3">
                        <p class="text-sm">
                            🔥
                            <span class="font-semibold">10 active bidders</span>
                            and
                            <span class="font-semibold">53 live auctions</span>
                            right now!
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Categories -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-semibold text-center mb-4">
                    Browse Categories
                </h2>
                <p class="text-gray-600 text-center mb-10 max-w-2xl mx-auto">
                    Discover thousands of unique items across popular categories
                </p>
                <div
                    class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4"
                >
                    <CategoryCard
                        v-for="category in categories"
                        :key="category.name"
                        :category="category"
                    />
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-semibold mb-4">How It Works</h2>
                <p class="text-gray-600 mb-12 max-w-2xl mx-auto">
                    Our simple 4-step process gets you from sign-up to winning
                    in minutes
                </p>
                <div class="grid md:grid-cols-4 gap-8">
                    <div
                        class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition"
                    >
                        <div
                            class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4"
                        >
                            1
                        </div>
                        <h3 class="font-bold text-lg mb-2">Sign Up</h3>
                        <p class="text-gray-600">
                            Create your free account with just an email address.
                            No credit card required.
                        </p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition"
                    >
                        <div
                            class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4"
                        >
                            2
                        </div>
                        <h3 class="font-bold text-lg mb-2">Browse</h3>
                        <p class="text-gray-600">
                            Explore thousands of auctions across dozens of
                            categories.
                        </p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition"
                    >
                        <div
                            class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4"
                        >
                            3
                        </div>
                        <h3 class="font-bold text-lg mb-2">Bid</h3>
                        <p class="text-gray-600">
                            Place strategic bids and track your auctions in
                            real-time.
                        </p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition"
                    >
                        <div
                            class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4"
                        >
                            4
                        </div>
                        <h3 class="font-bold text-lg mb-2">Win</h3>
                        <p class="text-gray-600">
                            Win the auction and get your item delivered to your
                            doorstep!
                        </p>
                    </div>
                </div>
                <div class="mt-12">
                    <Link
                        v-if="canRegister"
                        href="/register"
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition"
                    >
                        Get Started Now
                    </Link>
                </div>
            </div>
        </section>

        <!-- Featured Auctions -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-10">
                    <h2 class="text-3xl font-semibold">Featured Auctions</h2>
                    <Link
                        href="/auctions"
                        class="text-blue-600 hover:underline flex items-center"
                    >
                        View all auctions
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 ml-1"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </Link>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition"
                    >
                        <div class="relative">
                            <div class="w-full h-64 overflow-hidden">
                                <img
                                    src="https://images.bobswatches.com/images/Vintage-Rolex-Submariner-16800-Matte-Black-Dial-SKU172976.jpg?q=50&ef=2&h=950&sh=true&dpr=2"
                                    alt="Antique Watch"
                                    class="w-full h-full object-contain"
                                />
                            </div>
                            <div
                                class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold"
                            >
                                Hot
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-2">
                                <span
                                    class="text-xs font-semibold text-gray-500 uppercase"
                                    >Jewelry</span
                                >
                                <span
                                    class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded"
                                    >{{ timeLeft[0].hours }}h
                                    {{ timeLeft[0].minutes }}m left</span
                                >
                            </div>
                            <h4 class="font-bold text-xl mb-2">
                                Vintage Rolex Submariner
                            </h4>
                            <p class="text-gray-600 mb-4">
                                1960s classic timepiece in excellent condition
                                with original box.
                            </p>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-500 text-sm">
                                        Current Bid
                                    </p>
                                    <p class="text-2xl font-bold text-blue-600">
                                        ₱75,500
                                    </p>
                                </div>
                                <Link
                                    href="/auctions/1"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                                >
                                    Bid Now
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition"
                    >
                        <div class="relative">
                            <img
                                src="https://i.ebayimg.com/images/g/DJcAAeSw0E9n~eSe/s-l1600.webp"
                                alt="Vintage Camera"
                                class="w-full h-64 object-cover"
                            />
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-2">
                                <span
                                    class="text-xs font-semibold text-gray-500 uppercase"
                                    >Electronics</span
                                >
                                <span
                                    class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded"
                                    >{{ timeLeft[1].hours }}h
                                    {{ timeLeft[1].minutes }}m left</span
                                >
                            </div>
                            <h4 class="font-bold text-xl mb-2">
                                Leica M3 Rangefinder
                            </h4>
                            <p class="text-gray-600 mb-4">
                                Collector's item camera with original 50mm
                                Summicron lens.
                            </p>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-500 text-sm">
                                        Current Bid
                                    </p>
                                    <p class="text-2xl font-bold text-blue-600">
                                        ₱48,000
                                    </p>
                                </div>
                                <Link
                                    href="/auctions/2"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                                >
                                    Bid Now
                                </Link>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition"
                    >
                        <div class="relative">
                            <img
                                src="/api/placeholder/400/300"
                                alt="Gaming Chair"
                                class="w-full h-64 object-cover"
                            />
                            <div
                                class="absolute top-3 right-3 bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold"
                            >
                                Ending Soon
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-2">
                                <span
                                    class="text-xs font-semibold text-gray-500 uppercase"
                                    >Gaming</span
                                >
                                <span
                                    class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded"
                                    >{{ timeLeft[2].hours }}h
                                    {{ timeLeft[2].minutes }}m left</span
                                >
                            </div>
                            <h4 class="font-bold text-xl mb-2">
                                Secret Lab Omega Chair
                            </h4>
                            <p class="text-gray-600 mb-4">
                                Premium gaming chair with ergonomic design and
                                lumbar support.
                            </p>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-500 text-sm">
                                        Current Bid
                                    </p>
                                    <p class="text-2xl font-bold text-blue-600">
                                        ₱12,750
                                    </p>
                                </div>
                                <Link
                                    href="/auctions/3"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                                >
                                    Bid Now
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-16 bg-blue-50">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-semibold mb-4">What Our Users Say</h2>
                <p class="text-gray-600 mb-12 max-w-2xl mx-auto">
                    Join thousands of satisfied bidders on our secure and
                    trusted platform
                </p>

                <div class="relative max-w-3xl mx-auto">
                    <div class="bg-white p-8 rounded-xl shadow-sm">
                        <div class="flex items-center justify-center mb-4">
                            <img
                                :src="testimonials[currentTestimonial].avatar"
                                alt="User"
                                class="w-16 h-16 rounded-full border-4 border-blue-100"
                            />
                        </div>
                        <p class="text-lg italic mb-4">
                            "{{ testimonials[currentTestimonial].text }}"
                        </p>
                        <h4 class="font-bold">
                            {{ testimonials[currentTestimonial].name }}
                        </h4>
                        <p class="text-gray-500 text-sm">
                            {{ testimonials[currentTestimonial].role }}
                        </p>
                    </div>

                    <!-- Navigation buttons -->
                    <button
                        @click="prevTestimonial"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-2 shadow-md hover:bg-gray-100"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-gray-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                    </button>
                    <button
                        @click="nextTestimonial"
                        class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-2 shadow-md hover:bg-gray-100"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-gray-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 5l7 7-7 7"
                            />
                        </svg>
                    </button>
                </div>

                <!-- Indicators -->
                <div class="flex justify-center mt-6 space-x-2">
                    <button
                        v-for="(_, index) in testimonials"
                        :key="index"
                        @click="currentTestimonial = index"
                        :class="[
                            'w-3 h-3 rounded-full',
                            currentTestimonial === index
                                ? 'bg-blue-600'
                                : 'bg-gray-300',
                        ]"
                    ></button>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section
            class="py-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white"
        >
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-4">Ready to Start Bidding?</h2>
                <p class="text-lg mb-8 max-w-xl mx-auto">
                    Join thousands of bidders and find amazing deals today. No
                    subscription fees, just exciting auctions!
                </p>
                <div class="flex justify-center gap-4">
                    <Link
                        v-if="canRegister"
                        href="/register"
                        class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition"
                    >
                        Create Free Account
                    </Link>
                    <Link
                        href="/auctions"
                        class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:bg-opacity-20 transition"
                    >
                        Browse Auctions
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-gray-300 py-12">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-bold text-white mb-4">
                            AuctionHub
                        </h3>
                        <p class="text-sm">
                            The premier online auction platform connecting
                            buyers and sellers since 2022.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">
                            Quick Links
                        </h4>
                        <ul class="space-y-2">
                            <li>
                                <Link
                                    href="/auctions"
                                    class="hover:text-white transition"
                                    >Browse Auctions</Link
                                >
                            </li>
                            <li>
                                <Link
                                    href="/how-it-works"
                                    class="hover:text-white transition"
                                    >How It Works</Link
                                >
                            </li>
                            <li>
                                <Link
                                    href="/pricing"
                                    class="hover:text-white transition"
                                    >Seller Fees</Link
                                >
                            </li>
                            <li>
                                <Link
                                    href="/support"
                                    class="hover:text-white transition"
                                    >Support</Link
                                >
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Legal</h4>
                        <ul class="space-y-2">
                            <li>
                                <Link
                                    href="/terms"
                                    class="hover:text-white transition"
                                    >Terms of Service</Link
                                >
                            </li>
                            <li>
                                <Link
                                    href="/privacy"
                                    class="hover:text-white transition"
                                    >Privacy Policy</Link
                                >
                            </li>
                            <li>
                                <Link
                                    href="/refunds"
                                    class="hover:text-white transition"
                                    >Refund Policy</Link
                                >
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white mb-4">Contact</h4>
                        <ul class="space-y-2">
                            <li>support@auctionhub.com</li>
                            <li>+63 912 345 6789</li>
                            <li>Manila, Philippines</li>
                        </ul>
                        <div class="flex space-x-4 mt-4">
                            <a href="#" class="hover:text-white transition">
                                <svg
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                            <a href="#" class="hover:text-white transition">
                                <svg
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
                                    />
                                </svg>
                            </a>
                            <a href="#" class="hover:text-white transition">
                                <svg
                                    class="w-5 h-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="border-t border-gray-700 mt-8 pt-8 text-sm text-center"
                >
                    <p>&copy; 2025 AuctionHub. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
