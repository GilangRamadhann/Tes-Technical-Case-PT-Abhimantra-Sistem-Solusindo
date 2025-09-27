<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { router, useForm, Link } from "@inertiajs/vue3";
defineProps({
    items: Object,
    filters: Object,
    siswas: Array,
    kelasOpt: Array,
    mapelOpt: Array,
});

const form = useForm({ siswa_id: "", kelas: "", mapel: "", nilai: "" });
const editForm = useForm({
    id: null,
    siswa_id: "",
    kelas: "",
    mapel: "",
    nilai: "",
});
const importForm = useForm({ file: null });

const submit = () => form.post("/nilai");
const startEdit = (row) => {
    editForm.id = row.id;
    editForm.siswa_id = row.siswa_id;
    editForm.kelas = row.kelas;
    editForm.mapel = row.mapel;
    editForm.nilai = row.nilai;
};
const update = () => editForm.put(`/nilai/${editForm.id}`);
const remove = (id) => router.delete(`/nilai/${id}`);
const doFilter = (e) => {
    e.preventDefault();
    router.get("/nilai", {
        kelas: e.target.kelas.value || null,
        mapel: e.target.mapel.value || null,
        search: e.target.search.value || null,
    });
};
const doImport = () => {
    importForm.post("/nilai/import", { forceFormData: true });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Nilai</h1>
                <Link
                    href="/dashboard"
                    class="text-sm px-3 py-2 rounded bg-gray-900 text-white"
                    >← Kembali ke Dashboard</Link
                >
            </div>

            <form class="grid md:grid-cols-4 gap-2" @submit.prevent="doFilter">
                <select name="kelas" class="border rounded-lg px-3 py-2">
                    <option value="">Semua Kelas</option>
                    <option v-for="k in kelasOpt" :key="k" :value="k">
                        {{ k }}
                    </option>
                </select>
                <select name="mapel" class="border rounded-lg px-3 py-2">
                    <option value="">Semua Mapel</option>
                    <option v-for="m in mapelOpt" :key="m" :value="m">
                        {{ m }}
                    </option>
                </select>
                <input
                    name="search"
                    :value="filters?.search"
                    placeholder="Cari nama siswa..."
                    class="border rounded-lg px-3 py-2"
                />
                <button class="px-4 py-2 bg-gray-800 text-white rounded-lg">
                    Filter
                </button>
            </form>

            <div class="grid lg:grid-cols-2 gap-6">
                <div class="p-4 bg-white rounded-2xl shadow">
                    <h2 class="font-semibold mb-3">Tambah Nilai</h2>
                    <form @submit.prevent="submit" class="space-y-2">
                        <select
                            v-model="form.siswa_id"
                            class="border rounded-lg px-3 py-2 w-full"
                        >
                            <option value="">Pilih Siswa</option>
                            <option
                                v-for="s in siswas"
                                :value="s.id"
                                :key="s.id"
                            >
                                {{ s.nama }} ({{ s.kelas }})
                            </option>
                        </select>
                        <input
                            v-model="form.kelas"
                            placeholder="Kelas (cth: 7A)"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                        <input
                            v-model="form.mapel"
                            placeholder="Mapel (cth: Matematika)"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                        <input
                            v-model.number="form.nilai"
                            type="number"
                            min="0"
                            max="100"
                            placeholder="Nilai (0-100)"
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
                    <h2 class="font-semibold mb-3">Edit Nilai</h2>
                    <form @submit.prevent="update" class="space-y-2">
                        <select
                            v-model="editForm.siswa_id"
                            class="border rounded-lg px-3 py-2 w-full"
                        >
                            <option
                                v-for="s in siswas"
                                :value="s.id"
                                :key="s.id"
                            >
                                {{ s.nama }} ({{ s.kelas }})
                            </option>
                        </select>
                        <input
                            v-model="editForm.kelas"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                        <input
                            v-model="editForm.mapel"
                            class="border rounded-lg px-3 py-2 w-full"
                        />
                        <input
                            v-model.number="editForm.nilai"
                            type="number"
                            min="0"
                            max="100"
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
