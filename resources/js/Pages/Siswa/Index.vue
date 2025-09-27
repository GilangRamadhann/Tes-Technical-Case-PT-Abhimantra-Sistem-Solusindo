<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router, useForm, Link } from "@inertiajs/vue3";
defineProps({ items: Object, filters: Object });

const form = useForm({ nama: "", kelas: "" });
const editForm = useForm({ id: null, nama: "", kelas: "" });

const submit = () => form.post("/siswa");
const startEdit = (row) => {
    editForm.id = row.id;
    editForm.nama = row.nama;
    editForm.kelas = row.kelas;
};
const update = () => editForm.put(`/siswa/${editForm.id}`);
const remove = (id) => router.delete(`/siswa/${id}`);

const doSearch = (e) => {
    e.preventDefault();
    router.get("/siswa", { search: e.target.search.value || null });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Siswa</h1>
                <Link
                    href="/dashboard"
                    class="text-sm px-3 py-2 rounded bg-gray-900 text-white"
                    >← Kembali ke Dashboard</Link
                >
            </div>

            <form class="flex gap-2" @submit.prevent="doSearch">
                <input
                    name="search"
                    :value="filters?.search"
                    placeholder="Cari nama/kelas..."
                    class="border rounded-lg px-3 py-2 w-full"
                />
                <button class="px-4 py-2 bg-gray-800 text-white rounded-lg">
                    Search
                </button>
            </form>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="p-4 bg-white rounded-2xl shadow">
                    <h2 class="font-semibold mb-3">Tambah Siswa</h2>
                    <form @submit.prevent="submit" class="space-y-2">
                        <input
                            v-model="form.nama"
                            placeholder="Nama"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                        <input
                            v-model="form.kelas"
                            placeholder="Kelas (cth: 7A)"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                        <button
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg"
                        >
                            Simpan
                        </button>
                    </form>
                </div>

                <div class="p-4 bg-white rounded-2xl shadow">
                    <h2 class="font-semibold mb-3">Edit Siswa</h2>
                    <form @submit.prevent="update" class="space-y-2">
                        <input
                            v-model="editForm.nama"
                            placeholder="Nama"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                        <input
                            v-model="editForm.kelas"
                            placeholder="Kelas"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                        <button
                            class="px-4 py-2 bg-emerald-600 text-white rounded-lg"
                            :disabled="!editForm.id"
                        >
                            Update
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-4 bg-white rounded-2xl shadow overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="p-2">Nama</th>
                            <th class="p-2">Kelas</th>
                            <th class="p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="row in items.data"
                            :key="row.id"
                            class="border-b"
                        >
                            <td class="p-2">{{ row.nama }}</td>
                            <td class="p-2">{{ row.kelas }}</td>
                            <td class="p-2 flex gap-2">
                                <button
                                    class="px-3 py-1 rounded-lg bg-amber-500 text-white"
                                    @click="startEdit(row)"
                                >
                                    Edit
                                </button>
                                <button
                                    class="px-3 py-1 rounded-lg bg-rose-600 text-white"
                                    @click="remove(row.id)"
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
    </AuthenticatedLayout>
</template>
