/**
 * laporbanjir.js
 * BPBD Kabupaten Bandung — Sistem Pelaporan Banjir
 *
 * Fitur:
 *   (a) Anti double-submit: tombol kirim dinonaktifkan setelah diklik
 *   (b) Indikator tingkat bahaya real-time berupa teks berwarna (tanpa emoji)
 */

'use strict';

document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       (a) ANTI DOUBLE-SUBMIT
       Nonaktifkan tombol segera setelah form dikirim untuk
       mencegah pengiriman data ganda akibat klik berulang.
       ========================================================= */

    var form     = document.getElementById('form-laporan');
    var btnKirim = document.getElementById('btn-kirim');

    if (form && btnKirim) {
        form.addEventListener('submit', function () {
            btnKirim.disabled    = true;
            btnKirim.textContent = 'Mengirim...';
            btnKirim.setAttribute('aria-busy', 'true');
        });
    }

    /* =========================================================
       (b) INDIKATOR TINGKAT BAHAYA REAL-TIME
       Menampilkan badge teks berwarna di bawah input tinggi
       genangan setiap kali pengguna mengetik angka baru.

       Ambang batas (sesuai spesifikasi controller):
         - <= 30 cm   => Waspada (hijau)
         - <= 70 cm   => Siaga (oranye)
         - > 70 cm    => Awas (merah, berdenyut)
       ========================================================= */

    var inputTinggi = document.getElementById('tinggi_genangan');
    var indikator   = document.getElementById('indikator-bahaya');

    if (inputTinggi && indikator) {

        /**
         * Menentukan level bahaya berdasarkan nilai tinggi genangan.
         *
         * @param {number} cm
         * @returns {{ level: string, teks: string }}
         */
        function tentukanBahaya(cm) {
            if (cm <= 30) {
                return { level: 'waspada', teks: 'Tingkat Bahaya: Waspada (<= 30 cm)' };
            }
            if (cm <= 70) {
                return { level: 'siaga', teks: 'Tingkat Bahaya: Siaga (31 - 70 cm)' };
            }
            return { level: 'awas', teks: 'Tingkat Bahaya: Awas (> 70 cm)' };
        }

        /**
         * Memperbarui tampilan badge indikator bahaya.
         * Kelas CSS (bahaya-rendah/sedang/tinggi) mengontrol warna teks dan latar.
         */
        function perbaruiIndikator() {
            var nilaiRaw = inputTinggi.value.trim();
            var nilai    = parseFloat(nilaiRaw);

            /* Sembunyikan badge jika input kosong atau tidak valid */
            if (nilaiRaw === '' || isNaN(nilai) || nilai < 1) {
                indikator.className   = 'bahaya-badge bahaya-hidden';
                indikator.textContent = '';
                return;
            }

            var bahaya = tentukanBahaya(nilai);

            /* Perbarui kelas dan teks — warna diatur sepenuhnya oleh CSS */
            indikator.className   = 'bahaya-badge bahaya-' + bahaya.level;
            indikator.textContent = bahaya.teks;
        }

        /* Dengarkan perubahan nilai setiap kali pengguna mengetik */
        inputTinggi.addEventListener('input', perbaruiIndikator);

        /* Jalankan sekali saat halaman dimuat untuk menangani nilai dari old() */
        perbaruiIndikator();
    }

});

