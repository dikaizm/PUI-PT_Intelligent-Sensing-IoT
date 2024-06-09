//START JS Pilih Tahun
document.addEventListener('DOMContentLoaded', function () {
    // Mendapatkan elemen select untuk tahun awal dan tahun akhir
    const tahunAwalSelect = document.getElementById('tahunAwal');
    const tahunAkhirSelect = document.getElementById('tahunAkhir');

    // Mendapatkan tahun sekarang
    const tahunSekarang = new Date().getFullYear();

    // Mengisi opsi select untuk tahun awal dengan rentang dari tahun sekarang hingga 20 tahun setelahnya
    for (let i = tahunSekarang; i <= tahunSekarang + 20; i++) {
        tahunAwalSelect.innerHTML += `<option value="${i}">${i}</option>`;
    }

    // Set nilai default tahun awal ke 2024
    const defaultTahunAwal = 2024;
    tahunAwalSelect.value = defaultTahunAwal;

    // Set nilai default tahun akhir ke tahun awal + 1
    const defaultTahunAkhir = defaultTahunAwal + 1;
    tahunAkhirSelect.innerHTML = `<option value="${defaultTahunAkhir}">${defaultTahunAkhir}</option>`;
    tahunAkhirSelect.value = defaultTahunAkhir;

    // Mendengarkan perubahan pada tahun awal
    tahunAwalSelect.addEventListener('change', function () {
        // Mendapatkan tahun yang dipilih pada tahun awal
        const tahunAwalValue = parseInt(tahunAwalSelect.value);

        // Mengisi opsi select untuk tahun akhir dengan rentang dari tahun yang dipilih pada tahun awal hingga 10 tahun setelahnya
        let tahunAkhirValue = tahunAwalValue + 1;
        tahunAkhirSelect.innerHTML += `<option value="${tahunAkhirValue}">${tahunAkhirValue}</option>`;
        tahunAkhirSelect.value = tahunAkhirValue;

        // Set nilai input tahunAwal dan tahunAkhir
        document.getElementById('tahunAwal').value = tahunAwalValue;
        document.getElementById('tahunAkhir').value = tahunAkhirValue;
    });
});
//END JS Pilih Tahun

//START JS Display Donat Status Penelitian
document.addEventListener('DOMContentLoaded', function () {
    // Mengambil data jumlah penelitian berdasarkan status dari window
    const statusCountsPenelitian = window.statusCountsPenelitian;

    // Mendefinisikan labels dan data untuk chart
    const labels = [
        'Submitted',
        'Review',
        'Accepted',
        'Rejected',
        'On Going',
        'Finished'
    ];

    // Mendapatkan elemen-elemen checkbox
    const checkboxes = document.querySelectorAll('.form-check-input');

    // Fungsi untuk mengambil data terpilih berdasarkan status checkbox
    function getSelectedData() {
        const selectedData = [];
        checkboxes.forEach(function (checkbox, index) {
            if (checkbox.checked) {
                selectedData.push(statusCountsPenelitian[index + 1] || 0);
            } else {
                selectedData.push(0);
            }
        });
        return selectedData;
    }

    // Mendapatkan konteks grafik donat penelitian
    const ctx1 = document.getElementById('donatPenelitian').getContext('2d');

    // Konfigurasi grafik donat penelitian
    const config1 = {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: Object.values(statusCountsPenelitian), // Gunakan data awal berdasarkan checkbox
                backgroundColor: [
                    'rgba(20,92,133,255)',
                    'rgba(233,115,45,255)',
                    'rgba(28,106,32,255)',
                    'rgba(16,159,208,255)',
                    'rgba(160,43,145,255)',
                    'rgba(86,162,51,255)',
                ],
                hoverOffset: 10,
            }],
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            },
        },
    };

    // Buat grafik donat penelitian
    const donatPenelitianChart = new Chart(ctx1, config1);

    // Event listener untuk setiap checkbox
    checkboxes.forEach(function (checkbox, index) {
        checkbox.addEventListener('change', function () {
            // Perbarui data grafik donat penelitian
            config1.data.datasets[0].data = getSelectedData();

            // Perbarui grafik donat penelitian
            donatPenelitianChart.update();
        });
    });
});
//END JS Display Donat Status Penelitian


//START JS Display Donat Jenis Output
document.addEventListener('DOMContentLoaded', function () {
    // Mengambil data jumlah penelitian berdasarkan status dari window
    const statusCountsOutput = window.statusCountsOutput;

    // Mendefinisikan labels dan data untuk chart
    const labels = [
        'Publikasi',
        'HKI',
        'Video',
        'Poster'
    ];

    // Mendapatkan elemen-elemen checkbox
    const checkboxes = document.querySelectorAll('.checkbox-output');

    // Fungsi untuk mengambil data terpilih berdasarkan status checkbox
    function getSelectedData() {
        const selectedData = [];
        checkboxes.forEach(function (checkbox, index) {
            if (checkbox.checked) {
                selectedData.push(statusCountsOutput[index + 1] || 0);
            } else {
                selectedData.push(0);
            }
        });
        return selectedData;
    }

    // Mendapatkan konteks grafik donat penelitian
    const ctx2 = document.getElementById('donatOutput').getContext('2d');

    // Konfigurasi grafik donat penelitian
    const config2 = {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: Object.values(statusCountsOutput), // Gunakan data awal berdasarkan checkbox
                backgroundColor: [
                    'rgba(20,92,133,255)',
                    'rgba(233,115,45,255)',
                    'rgba(28,106,32,255)',
                    'rgba(16,159,208,255)',
                ],
                hoverOffset: 10,
            }],
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            },
        },
    };
    // Buat grafik donat penelitian
    const donatOutputChart = new Chart(ctx2, config2);

    // Event listener untuk setiap checkbox
    checkboxes.forEach(function (checkbox, index) {
        checkbox.addEventListener('change', function () {
            // Perbarui data grafik donat penelitian
            config2.data.datasets[0].data = getSelectedData();

            // Perbarui grafik donat penelitian
            donatOutputChart.update();
        });
    });
});
//END JS Display Donat Jenis Output


//START JS Display Diagram Balok Jenis Output
document.addEventListener('DOMContentLoaded', function () {
    // Mengakses data dari objek window
    const statusCountsOutputAwal = window.statusCountsOutputAwal;
    const statusCountsOutputAkhir = window.statusCountsOutputAkhir;
    const tahunAwal = window.tahunAwal;
    const tahunAkhir = window.tahunAkhir;

    // Horizontal Bar Chart
    const labels3 = ['Publikasi', 'HKI', 'Video', 'Poster'];
    const data3 = {
        labels: labels3,
        datasets: [
            {
                label: tahunAwal,
                data: [
                    statusCountsOutputAwal[1], // Data untuk tahun awal
                    statusCountsOutputAwal[2],
                    statusCountsOutputAwal[3],
                    statusCountsOutputAwal[4]
                ],
                borderColor: 'rgba(21,95,131,255)',
                backgroundColor: 'rgba(21,95,131,255)',
            },
            {
                label: tahunAkhir,
                data: [
                    statusCountsOutputAkhir[1], // Data untuk tahun akhir
                    statusCountsOutputAkhir[2],
                    statusCountsOutputAkhir[3],
                    statusCountsOutputAkhir[4]
                ],
                borderColor: 'rgba(79,149,218,255)',
                backgroundColor: 'rgba(79,149,218,255)',
            },
        ],
    };
    const config3 = {
        type: 'bar',
        data: data3, // Menggunakan variabel data3 yang baru
        options: {
            indexAxis: 'y',
            elements: {
                bar: {
                    borderWidth: 2,
                },
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            },
        },
    };
    const ctx3 = document.getElementById('barchartOutput').getContext('2d');
    new Chart(ctx3, config3);
});
//END JS Display Diagram Balok Jenis Output


//START JS Display Diagram Balok Status Penelitian
document.addEventListener('DOMContentLoaded', function () {
    const targetPenelitian = window.targetPenelitian;

    const labels2 = ['Tahun ' + tahunAwal, 'Tahun ' + tahunAkhir];
    const data2 = {
        labels: labels2,
        datasets: [
            {
                label: 'Target',
                data: [targetPenelitian[tahunAwal], targetPenelitian[tahunAkhir]],
                borderColor: 'rgba(233,113,52,255)',
                backgroundColor: 'rgba(233,113,52,255)',
            },
            {
                label: 'Jumlah Penelitian',
                data: [penelitianTahunAwal, penelitianTahunAkhir],
                borderColor: 'rgba(21,95,131,255)',
                backgroundColor: 'rgba(21,95,131,255)',
            },
        ],
    };

    const config2 = {
        type: 'bar',
        data: data2,
        options: {
            indexAxis: 'y',
            elements: {
                bar: {
                    borderWidth: 2,
                },
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            },
        },
    };

    const ctx2 = document.getElementById('barchartPenelitian').getContext('2d');
    new Chart(ctx2, config2);
});
//END JS Display Diagram Balok Status Penelitian

//START JS ENTOTTT
document.addEventListener('DOMContentLoaded', function () {
    const startYear = new Date().getFullYear();
    const tahunAwalSelect = document.getElementById('tahunAwal');
    const tahunAkhirSelect = document.getElementById('tahunAkhir');

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const tahunAwalQuery = urlParams.get('tahunAwal');
    const tahunAkhirQuery = urlParams.get('tahunAkhir');

    // Populate tahunAwal select options
    for (let year = startYear; year <= startYear + 20; year++) {
        let optionAwal = document.createElement('option');
        optionAwal.value = year;
        optionAwal.text = year;
        if (year == tahunAwalQuery) {
            optionAwal.selected = true;
        }
        tahunAwalSelect.add(optionAwal);
    }

    // Function to update tahunAkhir options based on tahunAwal selection
    function updateTahunAkhirOptions() {
        // Clear existing options
        tahunAkhirSelect.innerHTML = '';

        // Get selected tahunAwal value
        const selectedTahunAwal = parseInt(tahunAwalSelect.value);

        // Add new option for tahunAkhir
        let optionAkhir = document.createElement('option');
        optionAkhir.value = selectedTahunAwal + 1;
        optionAkhir.text = selectedTahunAwal + 1;
        if ((selectedTahunAwal + 1) == tahunAkhirQuery) {
            optionAkhir.selected = true;
        }
        tahunAkhirSelect.add(optionAkhir);
    }

    // Initial population of tahunAkhir based on query string or default tahunAwal
    if (tahunAwalQuery) {
        tahunAwalSelect.value = tahunAwalQuery;
        updateTahunAkhirOptions();
    }

    // Update tahunAkhir options whenever tahunAwal changes
    tahunAwalSelect.addEventListener('change', updateTahunAkhirOptions);
});
//END JS ENTOTTT
