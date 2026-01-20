# Panduan Deployment: Mahira Tour (VPS IDCloudHost + CloudPanel)

Panduan ini disusun khusus untuk men-deploy aplikasi Laravel Mahira Tour ke server produksi yang stabil, aman, dan berperforma tinggi.

---

## Tahap 1: Persiapan Domain & DNS
1.  **Beli Domain:** Silakan beli domain (misal: `mahiratour.co.id`) di IDCloudHost atau Registrar lain.
2.  **Setting DNS:**
    *   Buka menu DNS Management di provider domain Anda.
    *   Tambahkan **A Record**:
        *   Host: `@` (atau kosong) -> Value: `IP VPS Anda`
        *   Host: `www` -> Value: `IP VPS Anda`

---

## Tahap 2: Setup VPS di IDCloudHost
1.  Login ke console [IDCloudHost](https://console.idcloudhost.com/).
2.  Pilih **App Catalog** atau **Compute** -> **New Resource**.
3.  Pilih **Virtual Machine** (Private Cloud).
4.  **Pilih Lokasi:** Jakarta.
5.  **Pilih OS:** Ubuntu 22.04 LTS.
6.  **Pilih Spek:** Minimal RAM 2GB.
7.  Berikan Nama (misal: `server-mahira`) dan klik **Create**.
8.  Catat **IP Address**, **Username** (biasanya `root`), dan **Password** yang diberikan via email.

---

## Tahap 3: Instalasi CloudPanel
1.  Buka terminal (Jika di Windows gunakan **PowerShell** atau aplikasi **Termius/Putty**).
2.  Login via SSH: `ssh root@IP_VPS_ANDA`.
3.  Jalankan perintah instalasi CloudPanel:
    ```bash
    curl -sS https://installer.cloudpanel.io/ce/v2/install.sh | sudo bash
    ```
4.  Tunggu ±10 menit sampai selesai.
5.  Akses Dashboard: `https://IP_VPS_ANDA:8443`.
6.  Buat akun Admin pertama Anda.

---

## Tahap 4: Konfigurasi Website di CloudPanel
1.  Klik **Add Site** -> **Create a PHP Site**.
2.  **Domain Name:** `mahiratour.co.id`
3.  **PHP Version:** `8.2`
4.  **Vhost Template:** `Laravel` (PENTING: Agar routing Laravel jalan).

---

## Tahap 5: Deployment Aplikasi
1.  **Database:**
    *   Di CloudPanel, klik menu **Databases** -> **Add Database**.
    *   Buat database (misal: `mahira_db`), user, dan password. Simpan detail ini.
2.  **File Aplikasi:**
    *   Gunakan menu **File Manager** untuk upload file ZIP projek Anda, ATAU:
    *   Gunakan **SSH/Git** untuk `git clone` dari repository Anda ke folder `/home/cloudpanel/htdocs/mahiratour.co.id/`.
3.  **Setup .env:**
    *   Copy file `.env.example` menjadi `.env`.
    *   Update isinya: `APP_ENV=production`, `APP_DEBUG=false`, detail Database, dan Email/WhatsApp API.
4.  **Install Dependencies:**
    *   Di terminal SSH (dalam folder projek):
    ```bash
    composer install --no-dev --optimize-autoloader
    php artisan migrate --force
    php artisan storage:link
    ```

---

## Tahap 6: Otomatisasi (Cron Job & SSL)
1.  **SSL (HTTPS):**
    *   Di CloudPanel, buka site Anda -> klik tab **SSL Store**.
    *   Pilih **Let's Encrypt** -> Klik **Install**.
2.  **Cron Job (Scheduler):**
    *   Di CloudPanel, buka site Anda -> klik tab **Cron Jobs**.
    *   Klik **Add Cron Job**.
    *   **Label:** Laravel Scheduler
    *   **Schedule:** Every Minute (`* * * * *`)
    *   **Command:** `php8.2 /home/cloudpanel/htdocs/mahiratour.co.id/artisan schedule:run`
    *   *Command ini akan menjalankan fitur Reminder & Cleanup otomatis yang kita buat kemarin.*

---

## Selesai!
Website Anda sekarang dapat diakses secara resmi di `https://mahiratour.co.id`.
> [!IMPORTANT]
> Jangan lupa untuk mematikan `APP_DEBUG=true` di file `.env` produksi demi keamanan.
