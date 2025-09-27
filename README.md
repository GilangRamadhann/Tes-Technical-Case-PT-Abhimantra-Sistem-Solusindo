# Tes Technical – Aplikasi Abhimantra School

Aplikasi ini dibangun menggunakan Laravel 11 (backend), Vue 3 (frontend), Tailwind CSS, dengan **Inertia.js** (Laravel + Vue dalam satu repo) dan **PostgreSQL**.  
Aplikasi mencakup **Authentication (Login/Register)**, **CRUD Siswa & Nilai**, serta **Import/Export Excel**. Dashboard menampilkan **tabel data Nilai** lengkap dengan **Add, Edit, Delete, Import, Export**.

---

## 1) Arsitektur

**Digabung: Laravel + Inertia.js + Vue.**  
Alasan memilih digabung :

-   **Satu repo, satu deploy** → setup cepat & minim boilerplate (tanpa REST API terpisah).
-   **SSR/CSR hybrid** Inertia → navigasi seperti SPA, tetap pakai routing Laravel.
-   **Breeze** menyediakan auth siap pakai (login/register) + Tailwind default yang rapi.

> Catatan : **register → redirect ke login** (tanpa auto-login) diterapkan agar user login terlebih dahulu setelah data tersimpan.

---

## 2) Fitur

-   **Authentication**: Register & Login (hanya user login yang bisa akses dashboard).
-   **Siswa**: CRUD + pencarian.
-   **Nilai**: CRUD + filter (kelas, mapel, nama) + **Import/Export Excel**.
-   **Dashboard**: menampilkan kartu statistik dan **tabel Nilai** (Add/Edit/Delete + Import/Export).
-   **Validasi**: via `FormRequest` (`SiswaRequest`, `NilaiRequest`).
-   **Migration**: `siswas`, `nilais` (relasi `siswa_id` → `siswas.id`).

---

## 3) Stack & Kebutuhan

-   PHP **8.2+**
-   Composer **2+**
-   Node.js **18+** & npm
-   PostgreSQL **13+**
-   Laravel **11**
-   Vue **3**, Inertia.js, Breeze, Tailwind CSS
-   Paket Excel: `maatwebsite/excel`

---

## 4) Instalasi & Menjalankan

> Contoh path Windows dari dokumen: `D:\Tes-Technical-Case-PT-Abhimantra-Sistem-Solusindo`

### a. Clone & pasang dependency

```bash
git clone https://github.com/GilangRamadhann/Tes-Technical-Case-PT-Abhimantra-Sistem-Solusindo.git
cd app
composer install
npm install
```

### b. Konfigurasi `.env`

Salin `.env.example` → `.env`, lalu set koneksi PostgreSQL:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=tes_technical
DB_USERNAME=postgres
DB_PASSWORD=123
```

Generate key aplikasi:

```bash
php artisan key:generate
```

### c. Instal Breeze (jika belum ada di repo)

> Jika repo ini sudah berisi Breeze, lewati langkah ini.

```bash
composer require laravel/breeze --dev
php artisan breeze:install vue
npm install
npm run build
```

### d. Migrasi & Seed

```bash
php artisan migrate
php artisan db:seed
```

Seeder demo akan menambahkan data **Siswa** & **Nilai**

### e. Jalankan aplikasi (dev)

Buka dua terminal:

```bash
npm run dev
php artisan serve
```

Akses: `http://127.0.0.1:8000` → otomatis redirect ke **/login**.

---

## 5) Akun Demo (Login)

**Daftar manual via UI**

-   Buka `/register`, buat akun baru → setelah sukses Anda akan diarahkan ke **/login**.

**Contoh akun:**

```
Email    : admin@gmail.com
Password : password
```

---

## 6) Struktur Database (PostgreSQL)

### Tabel `siswas`

-   `id` (bigint, PK)
-   `nama` (string)
-   `kelas` (string)
-   `created_at`, `updated_at` (timestamp)

### Tabel `nilais`

-   `id` (bigint, PK)
-   `siswa_id` (FK → `siswas.id`)
-   `kelas` (string)
-   `mapel` (string)
-   `nilai` (unsigned int, 0–100)
-   `created_at`, `updated_at` (timestamp)

---

## 7) Navigasi Utama

-   `/login` → Login user
-   `/register` → Register user
-   `/dashboard` → **hanya setelah login**, menampilkan statistik + tabel Nilai lengkap
-   `/siswa` → CRUD Siswa + pencarian
-   `/nilai` → CRUD Nilai + filter + Import/Export

> Root `/` otomatis redirect ke `/login`.

---

## 8) Alasan Memilih Inertia (Singkat)

-   Pengembangan lebih cepat: **tanpa** membuat REST API/SPA terpisah.
-   Reuse middleware/validation Laravel langsung ke halaman Vue.
-   UX seperti SPA (navigasi cepat) dengan kontrol routing di Laravel.

---
