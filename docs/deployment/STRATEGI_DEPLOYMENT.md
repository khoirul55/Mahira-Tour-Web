# Deployment Plan: Mahira Tour Production

Rencana deployment aplikasi **Mahira Tour** ke server produksi menggunakan infrastruktur VPS Indonesia.

## Proposed Setup
- **Domain:** Melalui IDCloudHost atau Registrar lain (.id / .co.id disarankan).
- **Server:** IDCloudHost Private Cloud (VPS) - RAM 2GB+, Ubuntu 22.04 LTS.
- **Control Panel:** [CloudPanel](https://www.cloudpanel.io/) (Khusus Laravel, gratis, dan performa tinggi).

## Steps Overview
1.  **Domain & DNS:** Beli domain dan arahkan A Record ke IP VPS.
2.  **Server Provisioning:** Setup VPS baru dengan Ubuntu 22.04.
3.  **Installation:** Install CloudPanel melalui terminal SSH.
4.  **Web Setup:** Menambahkan site baru di CloudPanel (PHP 8.2 + MySQL).
5.  **App Deployment:** Clone repository Git, install dependencies, dan setup `.env`.
6.  **Configurations:** Setup SSL (Let's Encrypt), Symlink Storage, dan Cron Job.

## Verification
- Akses website via HTTPS.
- Test pendaftaran jamaah (pastikan upload file bekerja).
- Test dashboard admin.
- Verifikasi Cron Job berjalan (log file).
