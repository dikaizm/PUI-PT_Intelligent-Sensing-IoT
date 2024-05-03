<div class="card-styles">
    <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
        <div class="card-content">

            @include('alert')

            <div class="menu-toggle-btn mr-20" style="text-align: right;">
                <button id="menu-toggle" class="main-btn btn-hover btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalTambah"
                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                    {{ __('Tambahkan Data') }}
                </button>
            </div>
            <div class="table-wrapper table-responsive" style="font-family: DM Sans">
                <table class="table striped-table" id="dataTables">
                    <thead>
                        <tr>
                            <th>
                                <h6>Name</h6>
                            </th>
                            <th>
                                <h6>Email</h6>
                            </th>
                            <th>
                                <h6>Nip</h6>
                            </th>
                            <th>
                                <h6>Tipe Pengguna</h6>
                            </th>
                            <th>
                                <h6>Action</h6>
                            </th>
                        </tr>
                        <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <p>{{ $user->name }}</p>
                                </td>
                                <td>
                                    <p>{{ $user->email }}</p>
                                </td>
                                <td>
                                    <p>{{ $user->nip }}</p>
                                </td>
                                <td>
                                    <p>{{ $user->getRoleNames()->implode(', ') }}</p>
                                </td>
                                <td>
                                    <a type="button" data-bs-toggle="modal"
                                        data-bs-target="#modalUserdetail{{ $user->id }}">
                                        <i class="lni lni-magnifier" style="color: gray; margin:2px;"></i>
                                    </a>
                                    <a type="button" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $user->id }}">
                                        <i class="lni lni-pencil" style="color: black; margin:2px;"></i>
                                    </a>
                                    <a type="button" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $user->id }}">
                                        <i class="lni lni-trash-can" style="color: red; margin:2px;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- end table row -->
                    </tbody>
                </table>
                <!-- end table -->

                {{-- Modal --}}

                {{-- {{ $users->links() }} --}}
            </div>

        </div>
    </div>
</div>

<!-- ========== modal edit =========== -->
@foreach ($users as $user)
    <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" aria-labelledby="ModalFourLabel"
        aria-hidden="true">
        <div class="modal-dialog"
            style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="nameEdit{{ $user->id }}">{{ __('Name') }}</label>
                                        <input type="text" @error('name') class="form-control is-invalid" @enderror
                                            name="name" id="nameEdit{{ $user->id }}"
                                            placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}"
                                            required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="nipEdit{{ $user->id }}">{{ __('NIP') }}</label>
                                        <input type="text" @error('nip') class="form-control is-invalid" @enderror
                                            name="nip" id="nipEdit{{ $user->id }}"
                                            placeholder="{{ __('NIP') }}" value="{{ old('nip', $user->nip) }}"
                                            required>
                                        @error('nip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="emailEdit{{ $user->id }}">{{ __('Email') }}</label>
                                        <input @error('email') class="form-control is-invalid" @enderror type="email"
                                            name="email" id="emailEdit{{ $user->id }}"
                                            placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}"
                                            required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label
                                            for="telpEdit{{ $user->id }}{{ $user->id }}">{{ __('Nomor HP') }}</label>
                                        <input @error('telp') class="form-control is-invalid" @enderror type="text"
                                            name="telp" id="telpEdit{{ $user->id }}{{ $user->id }}"
                                            placeholder="{{ __('Nomor HP') }}" value="{{ old('telp', $user->telp) }}"
                                            required>
                                        @error('telp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="keahlianEdit{{ $user->id }}">{{ __('Keahlian') }}</label>
                                        <input @error('keahlian') class="form-control is-invalid" @enderror
                                            type="text" name="keahlian" id="keahlianEdit{{ $user->id }}"
                                            placeholder="{{ __('Keahlian') }}"
                                            value="{{ old('keahlian', $user->keahlian) }}">
                                        @error('keahlian')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="fakultasEdit{{ $user->id }}">{{ __('Fakultas') }}</label>
                                        <input @error('fakultas') class="form-control is-invalid" @enderror
                                            type="text" name="fakultas" id="fakultasEdit{{ $user->id }}"
                                            placeholder="{{ __('Fakultas') }}"
                                            value="{{ old('fakultas', $user->fakultas) }}">
                                        @error('fakultas')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label
                                            for="link_google_scholarEdit{{ $user->id }}">{{ __('Google Scholar') }}</label>
                                        <input @error('link_google_scholar') class="form-control is-invalid" @enderror
                                            type="text" name="link_google_scholar"
                                            id="link_google_scholarEdit{{ $user->id }}"
                                            placeholder="{{ __('Link Google Scholar') }}"
                                            value="{{ old('link_google_scholar', $user->link_google_scholar) }}">
                                        @error('link_google_scholar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="link_sintaEdit{{ $user->id }}">{{ __('Sinta') }}</label>
                                        <input @error('link_sinta') class="form-control is-invalid" @enderror
                                            type="text" name="link_sinta" id="link_sintaEdit{{ $user->id }}"
                                            placeholder="{{ __('Link Sinta') }}"
                                            value="{{ old('link_sinta', $user->link_sinta) }}">
                                        @error('link_sinta')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="passwordEdit{{ $user->id }}">{{ __('New password') }}</label>
                                        <input type="password"
                                            @error('password') class="form-control is-invalid"
                                            @enderror
                                            name="password" id="passwordEdit{{ $user->id }}"
                                            placeholder="{{ __('New password') }}">
                                        <input type="hidden" name="password_old" value="{{ $user->password }}">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label
                                            for="password_confirmationEdit{{ $user->id }}">{{ __('New password confirmation') }}</label>
                                        <input type="password"
                                            @error('password') class="form-control is-invalid"
                                            @enderror
                                            name="password_confirmation"
                                            id="password_confirmationEdit{{ $user->id }}"
                                            placeholder="{{ __('New password confirmation') }}">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="action d-flex flex-wrap justify-content-end">
                                    <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
                                        style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);"
                                        data-bs-dismiss="modal">
                                        {{ __('Simpan') }}
                                    </button>
                                    <button type="button" class="main-btn btn-sm danger-btn btn-hover m-1"
                                        style="background: linear-gradient(180deg, #DE0F0F 0%, #780808 100%);"
                                        data-bs-dismiss="modal">
                                        {{ __('Batal') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- ========== modal end =========== -->

<!-- ========== modal tambah =========== -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
    <div class="modal-dialog"
        style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="nameTambah">{{ __('Nama') }}</label>
                                    <input type="text" @error('name') class="form-control is-invalid" @enderror
                                        name="name" id="nameTambah" placeholder="{{ __('Nama') }}"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="nipTambah">{{ __('NIP') }}</label>
                                    <input type="text" @error('nip') class="form-control is-invalid" @enderror
                                        name="nip" id="nipTambah" placeholder="{{ __('NIP') }}"
                                        value="{{ old('nip') }}" required>
                                    @error('nip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="emailTambah">{{ __('Email') }}</label>
                                    <input @error('email') class="form-control is-invalid" @enderror type="email"
                                        name="email" id="emailTambah" placeholder="{{ __('Email') }}"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="telpTambah">{{ __('Nomor HP') }}</label>
                                    <input @error('telp') class="form-control is-invalid" @enderror type="text"
                                        name="telp" id="telpTambah" placeholder="{{ __('Nomor HP') }}"
                                        value="{{ old('telp') ?? '(+62) ' }}" required>
                                    @error('telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="keahlianTambah">{{ __('Keahlian') }}</label>
                                    <input @error('keahlian') class="form-control is-invalid" @enderror type="text"
                                        name="keahlian" id="keahlianTambah" placeholder="{{ __('Keahlian') }}"
                                        value="{{ old('keahlian') }}">
                                    @error('keahlian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="fakultasTambah">{{ __('Fakultas') }}</label>
                                    <input @error('fakultas') class="form-control is-invalid" @enderror type="text"
                                        name="fakultas" id="fakultasTambah" placeholder="{{ __('Fakultas') }}"
                                        value="{{ old('fakultas') }}">
                                    @error('fakultas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="link_google_scholarTambah">{{ __('Google Scholar') }}</label>
                                    <input @error('link_google_scholar') class="form-control is-invalid" @enderror
                                        type="text" name="link_google_scholar" id="link_google_scholarTambah"
                                        placeholder="{{ __('Link Google Scholar') }}"
                                        value="{{ old('link_google_scholar') }}">
                                    @error('link_google_scholar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="link_sintaTambah">{{ __('Sinta') }}</label>
                                    <input @error('link_sinta') class="form-control is-invalid" @enderror
                                        type="text" name="link_sinta" id="link_sintaTambah"
                                        placeholder="{{ __('Link Sinta') }}" value="{{ old('link_sinta') }}">
                                    @error('link_sinta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="passwordTambah">{{ __('Password') }}</label>
                                    <input type="password"
                                        @error('password') class="form-control is-invalid"
                                            @enderror
                                        name="password" id="passwordTambah" placeholder="{{ __('Password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="password_confirmationTambah">{{ __('Password') }}</label>
                                    <input type="password"
                                        @error('password') class="form-control is-invalid"
                                            @enderror
                                        name="password_confirmation" id="password_confirmationTambah"
                                        placeholder="{{ __('Konfirmasi Password') }}">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="action d-flex flex-wrap justify-content-end">
                                <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
                                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========== modal end =========== -->

<!-- ========== modal delete =========== -->
@foreach ($users as $user)
    <div class="modal fade" id="modalDelete{{ $user->id }}" tabindex="-1" aria-labelledby="ModalFourLabel"
        aria-hidden="true">
        <div class="modal-dialog"
            style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <h5 class="modal-title" id="ModalDeleteLabel">
                        <i class="lni lni-warning text-danger me-2"></i> {{ __('Delete') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <p class="text-sm">
                            {{ __('Are you sure you want to delete ' . $user->name . '?') }}
                        </p>
                    </div>
                    <div class="action d-flex flex-wrap justify-content-end">
                        <form action="{{ route('user.delete', ['id' => $user->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="main-btn btn-sm danger-btn btn-hover m-1">
                                Delete
                            </button>
                        </form>
                        <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- ========== modal end =========== -->

<!-- ========== modal detail =========== -->
@foreach ($users as $user)
    <div class="modal fade" id="modalUserdetail{{ $user->id }}" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 90%; width: 800px;min-height: 100vh; display: flex; align-items: center; justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0" style="width: 100%; text-align: center;">
                    <div class="col-xl-6 col-lg-10 col-md-6" style="margin: auto;width: 90%;">
                        <div style="border-radius: 50%; max-width: 225px; width: 100%; overflow: hidden; margin: auto; margin-top: 0px; margin-bottom: 40px;">
                            <a style="display: block;"  style="align-content: center;">
                                <img src="{{ asset('images/example/joji.jpg') }}" alt="Card Image" style="width: 100%;">
                            </a>
                        </div>
                        <div class="row g-0 auth-row" style="color: black; font-weight: 400;line-height: 35px;">
                            <div class="col-lg-6 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">{{ __('Nama Dosen') }}</li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">{{ __($user->name) }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">{{ __('Link Google Scholar') }}</li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">{{ __($user->link_google_scholar) }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">{{ __('Email Pengguna') }}</li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">{{ __($user->email) }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">{{ __('Link Sinta') }}</li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">{{ __($user->link_sinta) }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">{{ __('Bidang Keahlian') }}</li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">{{ __($user->keahlian) }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">{{ __('Fakultas') }}</li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">{{ __($user->fakultas) }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">{{ __('NIP') }}</li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">{{ __($user->nip) }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- ========== modal end =========== -->
