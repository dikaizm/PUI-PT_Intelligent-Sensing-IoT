document.addEventListener('DOMContentLoaded', function () {
    const endpoint = window.location.pathname;
    if (!endpoint.startsWith('/penelitian')) return;

    // Get value from datepicker mulai & akhir
    const datepickerMulai = document.getElementById('waktu_mulai')
    const datepickerAkhir = document.getElementById('waktu_akhir')

    const waktuAwal = localStorage.getItem('waktu_mulai');
    const waktuAkhir = localStorage.getItem('waktu_akhir');

    if (waktuAwal) {
        datepickerMulai.value = waktuAwal;
    }

    if (waktuAkhir) {
        datepickerAkhir.value = waktuAkhir;
    }

    datepickerMulai.addEventListener('change', function() {
        const dateMulaiValue = datepickerMulai.value;
        const dateAkhirValue = datepickerAkhir.value;

        countPeriodMonth(dateMulaiValue, dateAkhirValue);
        localStorage.setItem('waktu_mulai', datepickerMulai.value);
    })

    datepickerAkhir.addEventListener('change', function() {
        const dateMulaiValue = datepickerMulai.value;
        const dateAkhirValue = datepickerAkhir.value;

        countPeriodMonth(dateMulaiValue, dateAkhirValue);
        localStorage.setItem('waktu_akhir', dateAkhirValue);
    })

    // Count period in month
    function countPeriodMonth(mulai, akhir) {
        let dateMulai = new Date(mulai)
        let dateAkhir = new Date(akhir)
        let periodMonth = (dateAkhir.getFullYear() - dateMulai.getFullYear()) * 12 + dateAkhir.getMonth() - dateMulai.getMonth()

        if (periodMonth === NaN) return

        document.getElementById('jangka_waktu').value = periodMonth
    }
})
