<div class="card-styles"  style="font-family: DM Sans">
    <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
        <div class="card-content">

            @session('success')
            <div class="alert-box success-alert">
                <div class="alert">
                    <h4 class="alert-heading">Success</h4>
                    <p class="text-medium">
                        {{ $value }}
                    </p>
                </div>
            </div>
            @endsession

            <div class="menu-toggle-btn mr-20 mb-3" style="text-align: right;" >
                <button id="menu-toggle" class="main-btn btn-hover btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                    {{ __('Tambahkan Data') }}
                </button>
            </div>
            <div class="table-wrapper table-responsive">
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
                                    <p>{{ $user->nip }}</p>
                                </td>
                                <td>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                        <i class="lni lni-pencil" style="color: black;"></i>
                                    </a>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                        <i class="lni lni-trash-can" style="color: red;"></i>
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
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" @error('name') class="form-control is-invalid" @enderror
                                        name="name" id="name" placeholder="{{ __('Name') }}"
                                        value="{{ old('name', auth()->user()->name) }}" required>
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
                                    <label for="email">{{ __('Email') }}</label>
                                    <input @error('email') class="form-control is-invalid" @enderror type="email"
                                        name="email" id="email" placeholder="{{ __('Email') }}"
                                        value="{{ old('email', auth()->user()->email) }}" required>
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
                                    <label for="password">{{ __('New password') }}</label>
                                    <input type="password"
                                        @error('password') class="form-control is-invalid"
                                            @enderror
                                        name="password" id="password" placeholder="{{ __('New password') }}">
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
                                    <label for="password_confirmation">{{ __('New password confirmation') }}</label>
                                    <input type="password"
                                        @error('password') class="form-control is-invalid"
                                            @enderror
                                        name="password_confirmation" id="password_confirmation"
                                        placeholder="{{ __('New password confirmation') }}">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="action d-flex flex-wrap justify-content-end">
                                <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1" style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);" data-bs-dismiss="modal">
                                    {{ __('Add') }}
                                </button>
                                <button type="button" class="main-btn btn-sm danger-btn btn-hover m-1" style="background: linear-gradient(180deg, #DE0F0F 0%, #780808 100%);" data-bs-dismiss="modal">
                                    {{ __('Cancel') }}
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

<!-- ========== modal tambah =========== -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="name">{{ __('Nama') }}</label>
                                    <input type="text" @error('name') class="form-control is-invalid" @enderror
                                        name="name" id="name" placeholder="{{ __('Nama') }}"
                                        value="{{ old('name', auth()->user()->name) }}" required>
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
                                    <label for="nip">{{ __('NIP') }}</label>
                                    <input type="text" @error('nip') class="form-control is-invalid" @enderror
                                        name="nip" id="nip" placeholder="{{ __('NIP') }}"
                                        value="{{ old('nip', auth()->user()->nip) }}" required>
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
                                    <label for="email">{{ __('Email') }}</label>
                                    <input @error('email') class="form-control is-invalid" @enderror type="email"
                                        name="email" id="email" placeholder="{{ __('Email') }}"
                                        value="{{ old('email', auth()->user()->email) }}" required>
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
                                    <label for="telp">{{ __('Nomor HP') }}</label>
                                    <input @error('telp') class="form-control is-invalid" @enderror type="telp"
                                        name="telp" id="telp" placeholder="{{ __('Nomor HP') }}"
                                        value="{{ old('telp', auth()->user()->telp) }}" required>
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
                                    <label for="keahlian">{{ __('Keahlian') }}</label>
                                    <input @error('keahlian') class="form-control is-invalid" @enderror type="keahlian"
                                        name="keahlian" id="keahlian" placeholder="{{ __('Keahlian') }}"
                                        value="{{ old('keahlian', auth()->user()->keahlian) }}" required>
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
                                    <label for="link_google_cholar">{{ __('Google Scholar') }}</label>
                                    <input @error('link_google_cholar') class="form-control is-invalid" @enderror type="link_google_cholar"
                                        name="link_google_cholar" id="link_google_cholar" placeholder="{{ __('Link Google Scholar') }}"
                                        value="{{ old('link_google_cholar', auth()->user()->link_google_cholar) }}" required>
                                    @error('link_google_cholar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="link_sinta">{{ __('Sinta') }}</label>
                                    <input @error('link_sinta') class="form-control is-invalid" @enderror type="link_sinta"
                                        name="link_sinta" id="link_sinta" placeholder="{{ __('Link Sinta') }}"
                                        value="{{ old('link_sinta', auth()->user()->link_sinta) }}" required>
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
                                    <label for="password">{{ __('Password') }}</label>
                                    <input type="password"
                                        @error('password') class="form-control is-invalid"
                                            @enderror
                                        name="password" id="password" placeholder="{{ __('Password') }}">
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
                                    <label for="password_confirmation">{{ __('Password') }}</label>
                                    <input type="password"
                                        @error('password') class="form-control is-invalid"
                                            @enderror
                                        name="password_confirmation" id="password_confirmation"
                                        placeholder="{{ __('Konfirmasi Password') }}">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="action d-flex flex-wrap justify-content-end">
                                <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1" style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);" data-bs-dismiss="modal">
                                    {{ __('Save') }}
                                </button>
                                <button type="button" class="main-btn btn-sm danger-btn btn-hover m-1" style="background: linear-gradient(180deg, #DE0F0F 0%, #780808 100%);" data-bs-dismiss="modal">
                                    {{ __('Cancel') }}
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
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <h5 class="modal-title" id="ModalFourLabel">
                    <i class="lni lni-warning text-danger me-2"></i> {{ __('Delete') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <p class="text-sm">
                        {{ __('Are you sure you want to delete it?') }}
                    </p>
                </div>
                <div class="action d-flex flex-wrap justify-content-end">
                    <button type="button" class="main-btn btn-sm primary-btn btn-hover m-1" data-bs-dismiss="modal">
                        Delete
                    </button>
                    <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========== modal end =========== -->
