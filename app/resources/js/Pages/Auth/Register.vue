<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});
const submit = () =>
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <div class="space-y-5">
            <div class="space-y-1 text-center">
                <h2 class="text-xl font-semibold">Register</h2>
                <p class="text-sm text-gray-500">Buat akun baru</p>
            </div>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="text-sm">Nama</label>
                    <input
                        v-model="form.name"
                        class="mt-1 w-full border rounded-lg px-3 py-2"
                        required
                        autofocus
                    />
                    <div
                        v-if="form.errors.name"
                        class="text-sm text-rose-600 mt-1"
                    >
                        {{ form.errors.name }}
                    </div>
                </div>

                <div>
                    <label class="text-sm">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="mt-1 w-full border rounded-lg px-3 py-2"
                        required
                    />
                    <div
                        v-if="form.errors.email"
                        class="text-sm text-rose-600 mt-1"
                    >
                        {{ form.errors.email }}
                    </div>
                </div>

                <div>
                    <label class="text-sm">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="mt-1 w-full border rounded-lg px-3 py-2"
                        required
                        autocomplete="new-password"
                    />
                    <div
                        v-if="form.errors.password"
                        class="text-sm text-rose-600 mt-1"
                    >
                        {{ form.errors.password }}
                    </div>
                </div>

                <div>
                    <label class="text-sm">Konfirmasi Password</label>
                    <input
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 w-full border rounded-lg px-3 py-2"
                        required
                    />
                </div>

                <button
                    :disabled="form.processing"
                    class="w-full bg-emerald-600 text-white py-2 rounded-lg hover:bg-emerald-700"
                >
                    Daftar
                </button>
            </form>

            <div class="text-center text-sm">
                Sudah punya akun?
                <Link href="/login" class="text-blue-600 hover:underline"
                    >Masuk di sini</Link
                >
            </div>
        </div>
    </GuestLayout>
</template>
