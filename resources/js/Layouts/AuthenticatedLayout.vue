<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const isActive = (path) => page.url.startsWith(path);
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Top Nav -->
        <header class="bg-white border-b">
            <div
                class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between"
            >
                <div class="flex items-center gap-8">
                    <Link href="/dashboard" class="text-lg font-semibold"
                        >Abhimantra School</Link
                    >
                    <nav class="hidden md:flex items-center gap-6 text-sm">
                        <Link
                            href="/dashboard"
                            :class="[
                                isActive('/dashboard')
                                    ? 'text-gray-900 font-medium'
                                    : 'text-gray-600 hover:text-gray-900',
                            ]"
                        >
                            Dashboard
                        </Link>
                        <Link
                            href="/siswa"
                            :class="[
                                isActive('/siswa')
                                    ? 'text-gray-900 font-medium'
                                    : 'text-gray-600 hover:text-gray-900',
                            ]"
                        >
                            Siswa
                        </Link>
                        <Link
                            href="/nilai"
                            :class="[
                                isActive('/nilai')
                                    ? 'text-gray-900 font-medium'
                                    : 'text-gray-600 hover:text-gray-900',
                            ]"
                        >
                            Nilai
                        </Link>
                    </nav>
                </div>

                <!-- Right -->
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

        <!-- Page Content -->
        <main>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <slot />
            </div>
        </main>
    </div>
</template>
