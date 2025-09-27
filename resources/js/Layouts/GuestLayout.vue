<script setup></script>

<template>
    <div
        class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 flex items-center justify-center p-4"
    >
        <div
            class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8 space-y-6"
        >
            <div class="text-center space-y-1">
                <h1 class="text-2xl font-semibold tracking-tight">
                    Abhimantra School
                </h1>
            </div>
            <slot />
            <div class="text-center text-xs text-gray-400">© 2025 Gilang</div>
        </div>
    </div>
</template>
