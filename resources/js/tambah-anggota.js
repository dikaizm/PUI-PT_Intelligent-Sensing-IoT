$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Pilih Anggota Tim',
        allowClear: true,
    });

    // Fungsi untuk memfilter opsi ketua tim
    $('.select2[name="anggota_tim[]"]').on('change', function() {
        var selectedMembers = $(this).val();
        $('#is_ketua').empty(); // Kosongkan opsi ketua tim

        // Tambahkan opsi "Ketua Tim" ke dalam select2
        $('#is_ketua').append($('<option>', {
            value: '',
            text: '-- Pilih Ketua Tim --'
        }));

        // Tambahkan opsi ketua tim dari anggota yang telah dipilih sebelumnya
        $.each(selectedMembers, function(index, memberId) {
            var memberName = $('.select2[name="anggota_tim[]"] option[value="' + memberId + '"]').text(); // Perbaikan di sini
            $('#is_ketua').append($('<option>', {
                value: memberId,
                text: memberName
            }));
        });

        $('#is_ketua').trigger('change'); // Perbarui tampilan select2
    });
});
