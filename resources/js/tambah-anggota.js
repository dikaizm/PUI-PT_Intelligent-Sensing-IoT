$(document).ready(function () {
    // Inisialisasi select2
    $('.select2').select2({
        placeholder: 'Pilih Anggota Tim',
        allowClear: true,
    });

    // Fungsi untuk memfilter opsi ketua tim
    function populateKetuaTim() {
        var selectedMembers = $('.select2[name="user_id[]"]').val();
        $('#is_ketua').empty(); // Kosongkan opsi ketua tim

        // Tambahkan opsi default "Ketua Tim"
        $('#is_ketua').append(
            $('<option>', {
                value: '',
                text: '-- Pilih Ketua Tim --',
            })
        );

        // Tambahkan opsi ketua tim dari anggota yang telah dipilih sebelumnya
        $.each(selectedMembers, function (index, memberId) {
            var memberName = $('.select2[name="user_id[]"] option[value="' + memberId + '"]').text();
            $('#is_ketua').append(
                $('<option>', {
                    value: memberId,
                    text: memberName,
                })
            );
        });

        // Memilih ketua tim yang sudah disimpan sebelumnya (untuk halaman edit)
        var selectedKetua = $('#is_ketua').data('selected-ketua');
        if (selectedKetua) {
            $('#is_ketua').val(selectedKetua).trigger('change'); // Set selected value
        }
    }

    // Panggil fungsi populateKetuaTim saat anggota tim berubah
    $('.select2[name="user_id[]"]').on('change', populateKetuaTim);

    // Panggil fungsi populateKetuaTim saat halaman pertama kali dimuat
    populateKetuaTim();
});
