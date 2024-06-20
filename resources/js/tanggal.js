document.addEventListener('DOMContentLoaded', function () {
    let dateMulaiValue;
    let dateAkhirValue;

    // Get value from datepicker mulai & akhir
    const datepickerMulai = document.getElementById('waktu_mulai')
    const datepickerAkhir = document.getElementById('waktu_akhir')

    datepickerMulai.addEventListener('change', function() {
        dateMulaiValue = this.value
        countPeriodMonth(dateMulaiValue, dateAkhirValue)
    })

    datepickerAkhir.addEventListener('change', function() {
        dateAkhirValue = this.value
        countPeriodMonth(dateMulaiValue, dateAkhirValue)
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
