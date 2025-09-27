<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({ stat: Object });
</script>

<template>
    <div class="space-y-6">
        <h1 class="text-2xl font-semibold">Dashboard</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-4 rounded-xl bg-white shadow">
                <div class="text-gray-500">Total Siswa</div>
                <div class="text-3xl font-bold">{{ stat.siswa }}</div>
            </div>
            <div class="p-4 rounded-xl bg-white shadow">
                <div class="text-gray-500">Total Nilai</div>
                <div class="text-3xl font-bold">{{ stat.nilai }}</div>
            </div>
        </div>

        <div class="flex gap-3">
            <Link href="/siswa" class="px-4 py-2 rounded bg-blue-600 text-white"
                >Kelola Siswa</Link
            >
            <Link
                href="/nilai"
                class="px-4 py-2 rounded bg-emerald-600 text-white"
                >Kelola Nilai</Link
            >
        </div>
    </div>
</template>
