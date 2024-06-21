const URL_CREATE_OUTPUT = '/output-detail';

// "+" Tambah anggota
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let users = [];
    let selectedUsers = [];

    // Get current url
    const urlPath = window.location.pathname;
    // if (urlPath !== '/penelitian/create') return

    // Create state variable for output tab
    let outputTabState = {
        activeTab: 'publikasi',
    }

    if (urlPath.startsWith(URL_CREATE_OUTPUT)) {
        // Select all navigation links (buttons) in the vertical pill navigation
        const groupTabOutput = document.getElementById('v-pills-tab');
        const navLinksOutput = groupTabOutput.querySelectorAll('.nav-link');

        // Loop through each link and add an event listener for 'shown.bs.tab' event
        navLinksOutput.forEach(link => {
            link.addEventListener('shown.bs.tab', function (event) {
                const activeTabId = event.target.getAttribute('data-bs-target').substring(1); // Get the active tab id
                const tabName = activeTabId.split('-')[2];
                // Update tab state
                outputTabState.activeTab = tabName;

                const groupInput = document.getElementById(`input-anggota-${tabName}`)
                const inputUsers = groupInput.querySelectorAll(`[id^="user_id_${outputTabState.activeTab}_"]`);

                if (inputUsers.length < 1) {
                    InputAnggotaDiv(0);
                }
            });
        });
    }

    const inputUsers = document.querySelectorAll(`[id^="user_id_${outputTabState.activeTab}_"]`);
    if (inputUsers.length > 0) {
        // populate selected users
        inputUsers.forEach(input => {
            const num = input.id.split('_')[2];
            const hiddenInput = document.getElementById(`hidden_user_id_${outputTabState.activeTab}_${num}`);
            selectedUsers[num] = {
                name: input.value,
                id: hiddenInput.value
            };

            const btnAction = document.getElementById(`btn-action-anggota-${outputTabState.activeTab}_${num}`);
            btnAction.onclick = () => removeInput(num);
        })

        InputAnggotaDiv(inputUsers.length);
    } else {
        // Initialize the first input field
        InputAnggotaDiv(0);
    }

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
        const input = document.getElementById(`user_id_${outputTabState.activeTab}_${num}`);
        if (input.readOnly) {
            return;
        }
        const dropdown = document.getElementById(`user_dropdown_${outputTabState.activeTab}_${num}`);
        dropdown.classList.remove('d-none');
        populateUserDropdown(users, num);
    }

    function hideUserDropdown(num) {
        const dropdown = document.getElementById(`user_dropdown_${outputTabState.activeTab}_${num}`);
        dropdown.classList.add('d-none');
    }

    function populateUserDropdown(users, num) {
        const dropdown = document.getElementById(`user_dropdown_${outputTabState.activeTab}_${num}`);
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
        const input = document.getElementById(`user_id_${outputTabState.activeTab}_${num}`);
        const filter = input.value.toLowerCase();
        const filteredUsers = users.filter(user => user.name.toLowerCase().includes(filter));
        populateUserDropdown(filteredUsers, num);

        if (!selectedUsers[num]) {
            selectedUsers[num] = {};
        }
        selectedUsers[num].name = input.value;
    }

    function selectUser(user, num) {
        const inputError = document.getElementById(`error_user_id_${outputTabState.activeTab}_${num}`);
        inputError.textContent = '';

        const input = document.getElementById(`user_id_${outputTabState.activeTab}_${num}`);
        input.value = user.name;
        const hiddenInput = document.getElementById(`hidden_user_id_${outputTabState.activeTab}_${num}`);
        hiddenInput.value = user.id;

        if (!selectedUsers[num]) {
            selectedUsers[num] = {};
        }
        selectedUsers[num].name = user.name;
        selectedUsers[num].email = user.email;
        selectedUsers[num].id = user.id;

        hideUserDropdown(num);
    }

    function tambahAnggotaPenelitian(num) {
        const inputError = document.getElementById(`error_user_id_${outputTabState.activeTab}_${num}`);
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

            const input = document.getElementById(`user_id_${outputTabState.activeTab}_${num}`);
            input.readOnly = true;

            const btnAction = document.getElementById(`btn-action-anggota-${outputTabState.activeTab}_${num}`);
            btnAction.innerHTML = `<i class="fas fa-x"></i>`;
            btnAction.classList.remove('btn-primary');
            btnAction.classList.add('btn-danger');
            btnAction.onclick = () => removeInput(num);

            if (data.message != "exist") {
                fetchUsers();
                selectedUsers[num].id = data.data.id;
                const hiddenInput = document.getElementById(`hidden_user_id_${outputTabState.activeTab}_${num}`);
                hiddenInput.value = data.data.id;
            }

            removeUserDropdown(num);
            InputAnggotaDiv(num + 1);
            populateKetuaTim();
            populateCorresponding();
        }).catch(error => {
            console.error(error.message);
        });
    }

    function removeUserDropdown(num) {
        const dropdown = document.getElementById(`user_dropdown_${outputTabState.activeTab}_${num}`);

        if (dropdown) {
            dropdown.remove();
        }
    }

    function removeInput(num) {
        const inputGroupDiv = document.getElementById(`input-group-${outputTabState.activeTab}_${num}`);

        if (inputGroupDiv) {
            inputGroupDiv.remove();
            delete selectedUsers[num];
            populateKetuaTim();
        }
    }

    function createOutputCurrentTab() {
        const activeTab = outputTabState.activeTab;
        let div;

        if (activeTab === 'publikasi') {
            div = document.getElementById('input-anggota-publikasi');
        } else if (activeTab === 'hki') {
            div = document.getElementById('input-anggota-hki');
        } else if (activeTab === 'foto') {
            div = document.getElementById('input-anggota-foto');
        } else if (activeTab === 'video') {
            div = document.getElementById('input-anggota-video');
        }

        return div;
    }

    function InputAnggotaDiv(num) {
        const urlPath = window.location.pathname;
        let inputAnggotaDiv;

        if (urlPath.startsWith(URL_CREATE_OUTPUT)) {
            inputAnggotaDiv = createOutputCurrentTab();
        } else {
            inputAnggotaDiv = document.getElementById('input-anggota');
        }

        if (!inputAnggotaDiv) {
            return;
        }

        const inputGroupDiv = document.createElement('div');
        inputGroupDiv.id = `input-group-${outputTabState.activeTab}_${num}`;
        inputGroupDiv.classList.add('input-group-col');
        inputGroupDiv.innerHTML = `
            <div class="position-relative d-flex gap-2">
                <div class="position-relative" style="width: 360px">
                    <input type="text" class="form-control" id="user_id_${outputTabState.activeTab}_${num}" placeholder="Cari atau masukkan anggota tim">
                    <input type="hidden" id="hidden_user_id_${outputTabState.activeTab}_${num}" name="user_id_${outputTabState.activeTab}_${num}" value="">
                    <div id="user_dropdown_${outputTabState.activeTab}_${num}" class="shadow position-absolute bg-white w-100 top-100 rounded d-none z-3 dropdown-hr-scroll"></div>
                </div>
                <div class="d-flex gap-2">
                    <button id="btn-action-anggota-${outputTabState.activeTab}_${num}" class="d-flex align-items-center btn btn-primary" type="button">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <span id="error_user_id_${outputTabState.activeTab}_${num}" class="text-danger text-sm"></span>
        `;
        inputAnggotaDiv.appendChild(inputGroupDiv);

        const input = document.getElementById(`user_id_${outputTabState.activeTab}_${num}`);
        input.addEventListener('focus', () => showUserDropdown(num));
        input.addEventListener('input', () => filterUserDropdown(num));

        const btnAction = document.getElementById(`btn-action-anggota-${outputTabState.activeTab}_${num}`);
        btnAction.addEventListener('click', () => tambahAnggotaPenelitian(num));
    }

    document.addEventListener('click', function (event) {
        const inputs = document.querySelectorAll(`[id^="user_id_${outputTabState.activeTab}_"]`);

        inputs.forEach(input => {
            const num = input.id.split('_')[3];
            const dropdown = document.getElementById(`user_dropdown_${outputTabState.activeTab}_${num}`);

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
        if (selectedUsers.length > 0) {
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
        }

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
