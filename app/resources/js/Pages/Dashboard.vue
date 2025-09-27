<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue"; // navbar khusus dashboard
import { Link, useForm, router } from "@inertiajs/vue3";

defineProps({
    stat: Object,
    items: Object, // data tabel nilai (paginate)
    filters: Object, // optional
    siswas: Array, // untuk form tambah/edit
    kelasOpt: Array, // filter kelas
    mapelOpt: Array, // filter mapel
});

// form import file
const importForm = useForm({ file: null });
const doImport = () =>
    importForm.post("/nilai/import", { forceFormData: true });

// aksi tabel
const removeRow = (id) => router.delete(`/nilai/${id}`);
const startEdit = (row) => {
    // contoh simpel: arahkan ke halaman Nilai dengan search nama biar langsung ketemu
    router.get("/nilai", { search: row.siswa?.nama });
};
</script>

<template>
    <DashboardLayout>
        <div class="space-y-8">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Dashboard</h1>
                <div class="hidden sm:flex gap-2">
                    <Link
                        href="/siswa"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg"
                        >Kelola Siswa</Link
                    >
                    <Link
                        href="/nilai"
                        class="px-4 py-2 bg-emerald-600 text-white rounded-lg"
                        >Kelola Nilai</Link
                    >
                </div>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 rounded-2xl bg-white shadow border">
                    <div class="text-gray-500">Total Siswa</div>
                    <div class="text-4xl font-bold">{{ stat.siswa }}</div>
                </div>
                <div class="p-6 rounded-2xl bg-white shadow border">
                    <div class="text-gray-500">Total Nilai</div>
                    <div class="text-4xl font-bold">{{ stat.nilai }}</div>
                </div>
            </div>

            <!-- Tabel Nilai + Import/Export -->
            <div class="p-4 bg-white rounded-2xl shadow overflow-x-auto">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-semibold">Data Nilai</h2>
                    <div class="flex gap-2">
                        <a
                            href="/nilai/export"
                            class="px-3 py-2 bg-indigo-600 text-white rounded-lg"
                            >Export Excel</a
                        >
                        <form
                            @submit.prevent="doImport"
                            class="flex items-center gap-2"
                            enctype="multipart/form-data"
                        >
                            <input
                                type="file"
                                @change="
                                    (e) => (importForm.file = e.target.files[0])
                                "
                                class="border rounded-lg px-3 py-2"
                            />
                            <button
                                class="px-3 py-2 bg-amber-500 text-white rounded-lg"
                            >
                                Import
                            </button>
                        </form>
                    </div>
                </div>

                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="p-2">Nama</th>
                            <th class="p-2">Kelas</th>
                            <th class="p-2">Mapel</th>
                            <th class="p-2">Nilai</th>
                            <th class="p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="row in items.data"
                            :key="row.id"
                            class="border-b"
                        >
                            <td class="p-2">{{ row.siswa?.nama }}</td>
                            <td class="p-2">{{ row.kelas }}</td>
                            <td class="p-2">{{ row.mapel }}</td>
                            <td class="p-2">{{ row.nilai }}</td>
                            <td class="p-2 flex gap-2">
                                <button
                                    class="px-3 py-1 rounded-lg bg-amber-500 text-white"
                                    @click="startEdit(row)"
                                >
                                    Edit
                                </button>
                                <button
                                    class="px-3 py-1 rounded-lg bg-rose-600 text-white"
                                    @click="removeRow(row.id)"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-3 flex gap-2">
                    <Link
                        v-if="items.prev_page_url"
                        :href="items.prev_page_url"
                        class="px-3 py-1 border rounded-lg"
                        >Prev</Link
                    >
                    <Link
                        v-if="items.next_page_url"
                        :href="items.next_page_url"
                        class="px-3 py-1 border rounded-lg"
                        >Next</Link
                    >
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
