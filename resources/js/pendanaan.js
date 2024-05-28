document.addEventListener('DOMContentLoaded', function () {
    const nominalInput = document.getElementById('nominalInput');

    nominalInput.addEventListener('input', function (e) {
        // Ambil nilai input dan hapus semua karakter selain angka
        let value = e.target.value.replace(/[^0-9]/g, '');

        // Format ulang nilai dengan titik setiap 3 angka
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Set nilai input dengan format baru
        e.target.value = value;
    });
});
