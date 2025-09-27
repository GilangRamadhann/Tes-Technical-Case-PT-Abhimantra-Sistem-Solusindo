<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({ email: "", password: "", remember: false });
const submit = () =>
    form.post(route("login"), { onFinish: () => form.reset("password") });
</script>

<template>
    <Head title="Log in" />
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
        <div class="w-full max-w-md bg-white shadow rounded-xl p-6 space-y-6">
            <div>
                <h1 class="text-2xl font-semibold">Login</h1>
                <p class="text-sm text-gray-500">
                    Masuk untuk mengakses dashboard
                </p>
            </div>

            <form @submit.prevent="submit" class="space-y-4">
                <div>
                    <label class="text-sm">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="mt-1 w-full border rounded px-3 py-2"
                        autofocus
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
                        class="mt-1 w-full border rounded px-3 py-2"
                        required
                        autocomplete="current-password"
                    />
                    <div
                        v-if="form.errors.password"
                        class="text-sm text-rose-600 mt-1"
                    >
                        {{ form.errors.password }}
                    </div>
                </div>
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" v-model="form.remember" /> Remember
                    me
                </label>
                <button
                    :disabled="form.processing"
                    class="w-full bg-gray-900 text-white py-2 rounded hover:bg-black"
                >
                    Masuk
                </button>
            </form>

            <div class="text-center text-sm">
                Belum punya akun?
                <Link href="/register" class="text-blue-600 hover:underline"
                    >Daftar sekarang</Link
                >
            </div>
        </div>
    </div>
</template>
