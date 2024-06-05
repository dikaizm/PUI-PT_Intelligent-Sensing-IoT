$(document).ready(function () {
    // Inisialisasi select2
    $('.select2').select2({
        placeholder: 'Pilih Nama',
        allowClear: true,
    })

    // Fungsi untuk memfilter opsi ketua tim
    function populateKetuaTim() {
        var selectedMembers = $('.select2[name="user_id[]"]').val()
        var selectedKetua = $('#is_ketua').data('selected')

        // Kosongkan opsi ketua tim
        $('#is_ketua').empty()

        // Tambahkan opsi default "Ketua Tim"
        $('#is_ketua').append(
            $('<option>', {
                value: '',
                text: '-- Pilih Ketua Tim --',
            }),
        )

        // Tambahkan opsi ketua tim dari anggota yang telah dipilih sebelumnya
        var addedOptions = {}
        $.each(selectedMembers, function (index, memberId) {
            var memberName = $(
                '.select2[name="user_id[]"] option[value="' + memberId + '"]',
            ).text()
            if (!addedOptions[memberId]) {
                $('#is_ketua').append(
                    $('<option>', {
                        value: memberId,
                        text: memberName,
                        selected: memberId == selectedKetua,
                    }),
                )
                addedOptions[memberId] = true
            }
        })

        // Perbarui select2 untuk is_ketua
        $('#is_ketua').trigger('change.select2')
    }

    // Fungsi untuk memfilter opsi corresponding author
    function populateCorresponding() {
        var selectedMembers = $('.select2[name="user_id[]"]').val()
        var selectedCorresponding = $('#is_corresponding').data('selected')

        // Kosongkan opsi corresponding author
        $('#is_corresponding').empty()

        // Tambahkan opsi default "Corresponding Author"
        $('#is_corresponding').append(
            $('<option>', {
                value: '',
                text: '-- Pilih Corresponding Author --',
            }),
        )

        // Tambahkan opsi corresponding author dari anggota yang telah dipilih sebelumnya
        var addedOptions = {}
        $.each(selectedMembers, function (index, memberId) {
            var memberName = $(
                '.select2[name="user_id[]"] option[value="' + memberId + '"]',
            ).text()
            if (!addedOptions[memberId]) {
                $('#is_corresponding').append(
                    $('<option>', {
                        value: memberId,
                        text: memberName,
                        selected: memberId == selectedCorresponding,
                    }),
                )
                addedOptions[memberId] = true
            }
        })

        // Perbarui select2 untuk is_corresponding
        $('#is_corresponding').trigger('change.select2')
    }

    // Panggil fungsi populateKetuaTim dan populateCorresponding saat anggota tim berubah
    $('.select2[name="user_id[]"]').on('change', function () {
        populateKetuaTim()
        populateCorresponding()
    })

    // Panggil fungsi populateKetuaTim dan populateCorresponding saat halaman pertama kali dimuat
    populateKetuaTim()
    populateCorresponding()
})
