<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <header class="bg-white border-b">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between"
            >
                <div class="text-lg font-semibold">Abhimantra School</div>
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="px-3 py-1.5 text-sm rounded bg-gray-900 text-white hover:bg-black"
                >
                    Logout
                </Link>
            </div>
        </header>

        <main>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <slot />
            </div>
        </main>
    </div>
</template>
