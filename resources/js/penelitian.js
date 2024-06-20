// "+" Tambah anggota
// document.addEventListener('DOMContentLoaded', function () {
//     var addButton = document.querySelector('#addButton');
//     var iconContainer = document.querySelector('#iconContainer');

//     addButton.addEventListener('click', function () {
//         var inputContainer = document.querySelector('#inputContainer');

//         // Duplikat input pertama
//         var clonedInput = inputContainer.firstElementChild.cloneNode(true);

//         // Bersihkan nilai input duplikat
//         clonedInput.querySelector('input').value = '';

//         // Tambahkan input duplikat di bawah input yang sudah ada
//         inputContainer.appendChild(clonedInput);

//         // Tambahkan tombol "-" di dalam iconContainer
//         var removeButton = document.createElement('button');
//         removeButton.type = 'button';
//         removeButton.classList.add('col-12'); // Tambahkan kelas col-12
//         removeButton.innerHTML = '<i class="lni lni-minus" style="color: red; margin:2px; font-size: 30px;"></i>';
//         removeButton.style = 'border: none; background: none; padding-top: 55px;'; // Tambahkan padding-top
//         removeButton.addEventListener('click', function () {
//             inputContainer.removeChild(clonedInput); // Hapus input saat tombol "-" diklik
//             iconContainer.removeChild(removeButton); // Hapus tombol "-" saat input dihapus
//         });

//         iconContainer.appendChild(removeButton); // Tambahkan tombol "-" ke dalam iconContainer
//     });
// });

// "+" Tambah file
// document.addEventListener('DOMContentLoaded', function () {
//     var addButton = document.querySelector('#addButton2');
//     var iconContainer = document.querySelector('#iconContainer2');

//     addButton.addEventListener('click', function () {
//         var inputContainer = document.querySelector('#inputContainer2');

//         // Duplikat input pertama
//         var clonedInput = inputContainer.firstElementChild.cloneNode(true);

//         // Bersihkan nilai input duplikat
//         clonedInput.querySelector('input').value = '';

//         // Tambahkan input duplikat di bawah input yang sudah ada
//         inputContainer.appendChild(clonedInput);

//         // Tambahkan tombol "-" di dalam iconContainer
//         var removeButton = document.createElement('button');
//         removeButton.type = 'button';
//         removeButton.classList.add('col-12'); // Tambahkan kelas col-12
//         removeButton.innerHTML = '<i class="lni lni-minus" style="color: red; margin:2px; font-size: 30px;"></i>';
//         removeButton.style = 'border: none; background: none; padding-top: 59px;'; // Tambahkan padding-top
//         removeButton.addEventListener('click', function () {
//             inputContainer.removeChild(clonedInput); // Hapus input saat tombol "-" diklik
//             iconContainer.removeChild(removeButton); // Hapus tombol "-" saat input dihapus
//         });

//         iconContainer.appendChild(removeButton); // Tambahkan tombol "-" ke dalam iconContainer
//     });
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const datePickerStart = document.querySelector("#datetimepicker1");

//     datePickerStart.datepicker({
//         format: "mm/dd/yyyy",
//         weekStart: 0,
//         calendarWeeks: true,
//         autoclose: true,
//         todayHighlight: true,
//         orientation: "auto"
//     });
// });


// "+" Tambah anggota
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let users = [];
    let selectedUsers = [];

    // Initialize the first input field
    InputAnggotaDiv(0);
    // Initialize users
    fetchUsers();

    // Fetch users
    function fetchUsers() {
        fetch('/api/users', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        }).then(res => {
            if (!res.ok) {
                throw new Error('Failed to fetch users');
            }
            return res.json();
        }).then(data => {
            users = data;
        });
    }

    function showUserDropdown(num) {
        const input = document.getElementById(`user_id_${num}`);
        if (input.readOnly) {
            return;
        }
        const dropdown = document.getElementById(`user_dropdown_${num}`);
        dropdown.classList.remove('d-none');
        populateUserDropdown(users, num);
    }

    function hideUserDropdown(num) {
        const dropdown = document.getElementById(`user_dropdown_${num}`);
        dropdown.classList.add('d-none');
    }

    function populateUserDropdown(users, num) {
        const dropdown = document.getElementById(`user_dropdown_${num}`);
        dropdown.innerHTML = '';
        users.forEach(user => {
            // Filter out selected users
            if (Object.values(selectedUsers).some(selectedUser => selectedUser.name.toLowerCase() === user.name.toLowerCase())) {
                return;
            }

            const div = document.createElement('div');
            div.classList.add('dropdown-item');
            div.textContent = user.name;
            div.onclick = () => selectUser(user, num);
            dropdown.appendChild(div);
        });
    }

    function filterUserDropdown(num) {
        const input = document.getElementById(`user_id_${num}`);
        const filter = input.value.toLowerCase();
        const filteredUsers = users.filter(user => user.name.toLowerCase().includes(filter));
        populateUserDropdown(filteredUsers, num);

        if (!selectedUsers[num]) {
            selectedUsers[num] = {};
        }
        selectedUsers[num].name = input.value;
    }

    function selectUser(user, num) {
        const inputError = document.getElementById(`error_user_id_${num}`);
        inputError.textContent = '';

        const input = document.getElementById(`user_id_${num}`);
        input.value = user.name;

        if (!selectedUsers[num]) {
            selectedUsers[num] = {};
        }
        selectedUsers[num].name = user.name;
        selectedUsers[num].email = user.email;
        selectedUsers[num].id = user.id;

        hideUserDropdown(num);
    }

    function tambahAnggotaPenelitian(num) {
        const inputError = document.getElementById(`error_user_id_${num}`);
        inputError.textContent = '';

        if (!selectedUsers[num] || !selectedUsers[num].name) {
            inputError.textContent = 'Pilih anggota terlebih dahulu!';
            return;
        }

        fetch('/user/external-store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                name: selectedUsers[num].name,
            })
        }).then(res => {
            if (!res.ok) {
                return res.json().then(data => { throw new Error(data.errors.name[0]); });
            }
            return res.json();
        }).then(data => {
            if (!data.success) {
                inputError.textContent = data.errors.name[0];
                throw new Error('Failed to add anggota penelitian');
            }

            const input = document.getElementById(`user_id_${num}`);
            input.readOnly = true;

            const btnAction = document.getElementById(`btn-action-anggota-${num}`);
            btnAction.innerHTML = `<i class="fas fa-x"></i>`;
            btnAction.classList.remove('btn-primary');
            btnAction.classList.add('btn-danger');
            btnAction.onclick = () => removeInput(num);

            hideUserDropdown(num);
            InputAnggotaDiv(num + 1);
            populateKetuaTim();
            populateCorresponding();

            if (data.message != "exist") {
                fetchUsers();
            }

            console.log('Anggota penelitian added:', data);
        }).catch(error => {
            console.error(error.message);
        });
    }

    function removeInput(num) {
        const inputGroupDiv = document.getElementById(`input-group-${num}`);
        if (inputGroupDiv) {
            inputGroupDiv.remove();
            delete selectedUsers[num];
        }
    }

    function InputAnggotaDiv(num) {
        const inputAnggotaDiv = document.getElementById('input-anggota');

        const inputGroupDiv = document.createElement('div');
        inputGroupDiv.id = `input-group-${num}`;
        inputGroupDiv.classList.add('input-group-col');
        inputGroupDiv.innerHTML = `
            <div class="position-relative d-flex gap-2">
                <div class="position-relative" style="width: 360px">
                    <input type="text" class="form-control" id="user_id_${num}" placeholder="Cari atau masukkan anggota tim">
                    <div id="user_dropdown_${num}" class="shadow position-absolute bg-white w-100 top-100 rounded d-none z-3"></div>
                </div>
                <div class="d-flex gap-2">
                    <button id="btn-action-anggota-${num}" class="d-flex align-items-center btn btn-primary" type="button"">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <span id="error_user_id_${num}" class="text-danger text-sm"></span>
        `;
        inputAnggotaDiv.appendChild(inputGroupDiv);

        const input = document.getElementById(`user_id_${num}`);
        input.addEventListener('focus', () => showUserDropdown(num));
        input.addEventListener('input', () => filterUserDropdown(num));

        const btnAction = document.getElementById(`btn-action-anggota-${num}`);
        btnAction.addEventListener('click', () => tambahAnggotaPenelitian(num));
    }

    document.addEventListener('click', function (event) {
        const inputs = document.querySelectorAll('[id^="user_id_"]');

        inputs.forEach(input => {
            const num = input.id.split('_')[2];
            const dropdown = document.getElementById(`user_dropdown_${num}`);
            if (!input.contains(event.target) && !dropdown.contains(event.target)) {
                hideUserDropdown(num);
            }
        });
    });


    /* KETUA TIM */

    // Inisialisasi select2
    $('.select2').select2({
        placeholder: 'Pilih Nama',
        allowClear: true,
    })

    // Fungsi untuk memfilter opsi ketua tim
    function populateKetuaTim() {
        const selectedKetua = $('#is_ketua').data('selected')

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
        var addedOptions = {};
        $.each(selectedUsers, function (index, user) {
            const memberName = user.name;
            const memberId = user.id;

            if (!addedOptions[memberId]) {
                $('#is_ketua').append(
                    $('<option>', {
                        value: memberId,
                        text: memberName,
                        selected: memberId == selectedKetua
                    })
                );
                addedOptions[memberId] = true;
            }
        });

        // Perbarui select2 untuk is_ketua
        $('#is_ketua').trigger('change.select2')
    }

    // Fungsi untuk memfilter opsi corresponding author
    function populateCorresponding() {
        const selectedCorresponding = $('#is_corresponding').data('selected')

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
        var addedOptions = {};
        $.each(selectedUsers, function (index, user) {
            const memberName = user.name;
            const memberId = user.id;

            if (!addedOptions[memberId]) {
                $('#is_corresponding').append(
                    $('<option>', {
                        value: memberId,
                        text: memberName,
                        selected: memberId == selectedCorresponding
                    })
                );
                addedOptions[memberId] = true;
            }
        });

        // Perbarui select2 untuk is_corresponding
        $('#is_corresponding').trigger('change.select2')
    }

    // Get semua button dengan class nav-link untuk reload populate ketika pindah tab
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(navLink => {
        navLink.addEventListener('click', function () {
            populateUserDropdown(users, 0);
        });
    });

    // Panggil fungsi populateKetuaTim dan populateCorresponding saat halaman pertama kali dimuat
    populateKetuaTim()
    populateCorresponding()
});
