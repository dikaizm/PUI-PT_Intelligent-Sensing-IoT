// "+" Tambah anggota
document.addEventListener('DOMContentLoaded', function() {
    var addButton = document.querySelector('#addButton');
    var iconContainer = document.querySelector('#iconContainer');

    addButton.addEventListener('click', function() {
        var inputContainer = document.querySelector('#inputContainer');

        // Duplikat input pertama
        var clonedInput = inputContainer.firstElementChild.cloneNode(true);

        // Bersihkan nilai input duplikat
        clonedInput.querySelector('input').value = '';

        // Tambahkan input duplikat di bawah input yang sudah ada
        inputContainer.appendChild(clonedInput);

        // Tambahkan tombol "-" di dalam iconContainer
        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('col-12'); // Tambahkan kelas col-12
        removeButton.innerHTML = '<i class="lni lni-minus" style="color: red; margin:2px; font-size: 30px;"></i>';
        removeButton.style = 'border: none; background: none; padding-top: 55px;'; // Tambahkan padding-top
        removeButton.addEventListener('click', function() {
            inputContainer.removeChild(clonedInput); // Hapus input saat tombol "-" diklik
            iconContainer.removeChild(removeButton); // Hapus tombol "-" saat input dihapus
        });

        iconContainer.appendChild(removeButton); // Tambahkan tombol "-" ke dalam iconContainer
    });
});

// "+" Tambah file
document.addEventListener('DOMContentLoaded', function() {
    var addButton = document.querySelector('#addButton2');
    var iconContainer = document.querySelector('#iconContainer2');

    addButton.addEventListener('click', function() {
        var inputContainer = document.querySelector('#inputContainer2');

        // Duplikat input pertama
        var clonedInput = inputContainer.firstElementChild.cloneNode(true);

        // Bersihkan nilai input duplikat
        clonedInput.querySelector('input').value = '';

        // Tambahkan input duplikat di bawah input yang sudah ada
        inputContainer.appendChild(clonedInput);

        // Tambahkan tombol "-" di dalam iconContainer
        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('col-12'); // Tambahkan kelas col-12
        removeButton.innerHTML = '<i class="lni lni-minus" style="color: red; margin:2px; font-size: 30px;"></i>';
        removeButton.style = 'border: none; background: none; padding-top: 59px;'; // Tambahkan padding-top
        removeButton.addEventListener('click', function() {
            inputContainer.removeChild(clonedInput); // Hapus input saat tombol "-" diklik
            iconContainer.removeChild(removeButton); // Hapus tombol "-" saat input dihapus
        });

        iconContainer.appendChild(removeButton); // Tambahkan tombol "-" ke dalam iconContainer
    });
});
