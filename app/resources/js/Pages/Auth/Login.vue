<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const form = useForm({ email: "", password: "", remember: false });
const submit = () =>
    form.post(route("login"), { onFinish: () => form.reset("password") });
</script>

<template>
    <GuestLayout>
        <Head title="Login" />
        <div class="space-y-5">
            <!-- Pesan sukses setelah register -->
            <div
                v-if="$page.props.flash && $page.props.flash.status"
                class="p-3 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-700"
            >
                {{ $page.props.flash.status }}
            </div>

            <div class="space-y-1 text-center">
                <h2 class="text-xl font-semibold">Login</h2>
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
                        class="mt-1 w-full border rounded-lg px-3 py-2"
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
                        class="mt-1 w-full border rounded-lg px-3 py-2"
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

                <button
                    :disabled="form.processing"
                    class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-black"
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
    </GuestLayout>
</template>
