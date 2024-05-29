<!-- ========== modal edit =========== -->
@foreach ($penelitian as $user)
    <div class="modal fade" id="modalEditPenelitian{{ $user->id }}" tabindex="-1" aria-labelledby="ModalFourLabel"
        aria-hidden="true" style="">
        <div class="modal-dialog"
            style="min-height: 100vh; max-width:90%; width:800px; display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <h2>{{ __('Output Penelitian') }}</h2>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-judul-tab" data-bs-toggle="pill" data-bs-target="#v-pills-judul" type="button" role="tab" aria-controls="v-pills-judul" aria-selected="true">
                                        Nama
                                    </button>
                                    <button class="nav-link" id="v-pills-publikasi-tab" data-bs-toggle="pill" data-bs-target="#v-pills-publikasi" type="button" role="tab" aria-controls="v-pills-publikasi" aria-selected="false">
                                        Publikasi
                                    </button>
                                    <button class="nav-link" id="v-pills-hki-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hki" type="button" role="tab" aria-controls="v-pills-hki" aria-selected="false">
                                        HKI
                                    </button>
                                    <button class="nav-link" id="v-pills-foto-tab" data-bs-toggle="pill" data-bs-target="#v-pills-foto" type="button" role="tab" aria-controls="v-pills-foto" aria-selected="false">
                                        Foto/Poster
                                    </button>
                                    <button class="nav-link" id="v-pills-video-tab" data-bs-toggle="pill" data-bs-target="#v-pills-video" type="button" role="tab" aria-controls="v-pills-video" aria-selected="false">
                                        Video
                                    </button>
                                </div>
                                <div class="col-lg-10 tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-judul" role="tabpanel" aria-labelledby="v-pills-judul-tab">
                                        <div class="input-style-1">
                                            <label for="name">{{ __('Nama Penelitian') }}</label>
                                            <input @error('name') class="form-control is-invalid" @enderror type="text"
                                                name="name" id="name" placeholder="{{ __('Skema Penelitian') }}"
                                                value="{{ old('name', auth()->user()->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-publikasi" role="tabpanel" aria-labelledby="v-pills-publikasi-tab">
                                        <div class="input-style-1">
                                            <label for="nameEdit{{ $user->id }}">{{ __('Tipe') }}</label>
                                            <select id="jenisPengguna{{ $user->id }}" name="jenisPengguna" class="form-control">
                                                <option value="admin">Internasional</option>
                                                <option value="user">Domestik</option>
                                            </select>
                                        </div>
                                        <div class="input-style-1">
                                            <label for="nameEdit{{ $user->id }}">{{ __('Judul Publikasi') }}</label>
                                            <select id="jenisPengguna{{ $user->id }}" name="jenisPengguna" class="form-control">
                                                <option value="admin">Internasional</option>
                                                <option value="user">Domestik</option>
                                            </select>
                                            <input @error('name') class="form-control is-invalid" @enderror type="text"
                                                name="name" id="name" placeholder="{{ __('Skema Penelitian') }}"
                                                value="{{ old('name', auth()->user()->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-style-1">
                                            <label for="name">{{ __('Author') }}</label>
                                            <div class="row">
                                                <div class="col-10" id="inputContainer">
                                                    <div class="input-style-1">
                                                        <input type="text"
                                                               name="name"
                                                               {{-- id="nameEdit{{ $user->id }}" --}}
                                                               placeholder="{{ __('Name') }}"
                                                               {{-- value="{{ old('name', $user->name) }}" --}}
                                                               required
                                                               class="form-control @error('name') is-invalid @enderror">
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-1" id="iconContainer">
                                                    <div style="display: flex; flex-direction: column;">
                                                        <button type="button" id="addButton" style="border: none; background: none;">
                                                            <i class="lni lni-plus" style="color: black; margin:15px; font-size: 30px;"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-style-1">
                                            <label for="nameEdit{{ $user->id }}">{{ __('Status HKI') }}</label>
                                            <select
                                                class="form-control @error('status_penelitian') is-invalid @enderror"
                                                name="status_penelitian"
                                                id="statusPenelitian{{ $item->id }}"
                                                style="max-width: 100%; margin: 0 auto;">
                                                @foreach ($status_penelitian as $status)
                                                    <option value="{{ $status->id }}"
                                                        @if (old('status_penelitian', $item->statusPenelitian->id) == $status->id) selected @endif>
                                                        {{ $status->statusPenelitianKey->name }} {{ $status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status_penelitian')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-style-1">
                                            <label for="nameEdit{{ $user->id }}">{{ __('Tanggal Granted') }} <span style="color:gray;">{{ __('*Diisi jika memilih status Granted') }}</span></label>
                                            @error('status_penelitian')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input type="date" id="dateInput" required>
                                        </div>
                                        <div class="input-style-1">
                                            <label for="name">{{ __('Link HKI') }} <span style="color:gray;">{{ __('*Apabila sudah publish') }}</span> </label>
                                            <input @error('name') class="form-control is-invalid" @enderror type="text"
                                                name="name" id="name" placeholder="{{ __('Skema Penelitian') }}"
                                                value="{{ old('name', auth()->user()->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-hki" role="tabpanel" aria-labelledby="v-pills-hki-tab">
                                        <div class="input-style-1">
                                            <label for="nameEdit{{ $user->id }}">{{ __('Judul HKI') }}</label>
                                            <input @error('name') class="form-control is-invalid" @enderror type="text"
                                                name="name" id="name" placeholder="{{ __('Skema Penelitian') }}"
                                                value="{{ old('name', auth()->user()->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-style-1">
                                            <label for="name">{{ __('Inventor') }}</label>
                                            <input @error('name') class="form-control is-invalid" @enderror type="text"
                                                name="name" id="name" placeholder="{{ __('Skema Penelitian') }}"
                                                value="{{ old('name', auth()->user()->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-style-1">
                                            <label for="nameEdit{{ $user->id }}">{{ __('Status HKI') }}</label>
                                            <select
                                                class="form-control @error('status_penelitian') is-invalid @enderror"
                                                name="status_penelitian"
                                                id="statusPenelitian{{ $item->id }}"
                                                style="max-width: 100%; margin: 0 auto;">
                                                @foreach ($status_penelitian as $status)
                                                    <option value="{{ $status->id }}"
                                                        @if (old('status_penelitian', $item->statusPenelitian->id) == $status->id) selected @endif>
                                                        {{ $status->statusPenelitianKey->name }} {{ $status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status_penelitian')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-style-1">
                                            <label for="nameEdit{{ $user->id }}">{{ __('Tanggal Granted') }} <span style="color:gray;">{{ __('*Diisi jika memilih status Granted') }}</span></label>
                                            @error('status_penelitian')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input type="date" id="dateInput" required>
                                        </div>
                                        <div class="input-style-1">
                                            <label for="name">{{ __('Link HKI') }} <span style="color:gray;">{{ __('*Apabila sudah publish') }}</span> </label>
                                            <input @error('name') class="form-control is-invalid" @enderror type="text"
                                                name="name" id="name" placeholder="{{ __('Skema Penelitian') }}"
                                                value="{{ old('name', auth()->user()->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-foto" role="tabpanel" aria-labelledby="v-pills-foto-tab">
                                        <div class="tab-pane fade show active" id="v-pills-judul" role="tabpanel" aria-labelledby="v-pills-judul-tab">
                                            <div class="input-style-1">
                                                <label for="name">{{ __('Judul') }}</label>
                                                <input @error('name') class="form-control is-invalid" @enderror type="text"
                                                    name="name" id="name" placeholder="{{ __('Skema Penelitian') }}"
                                                    value="{{ old('name', auth()->user()->name) }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="input-style-1">
                                                <label for="email_verified_at">{{ __('File Foto') }}</label>
                                                <div class="input-style-1">
                                                    <input type="file"
                                                        accept=".pdf"
                                                        @error('name') class="form-control is-invalid" @enderror
                                                        name="name"
                                                        placeholder="{{ __('Name') }}"
                                                        required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-video" role="tabpanel" aria-labelledby="v-pills-video-tab">
                                        <div class="input-style-1">
                                            <label for="name">{{ __('Judul') }}</label>
                                            <input @error('name') class="form-control is-invalid" @enderror type="text"
                                                name="name" id="name" placeholder="{{ __('Skema Penelitian') }}"
                                                value="{{ old('name', auth()->user()->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-style-1">
                                            <label for="email_verified_at">{{ __('File Video') }}</label>
                                            <div class="input-style-1">
                                                <input type="file"
                                                    accept=".pdf"
                                                    @error('name') class="form-control is-invalid" @enderror
                                                    name="name"
                                                    placeholder="{{ __('Name') }}"
                                                    required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="action d-flex flex-wrap justify-content-end">
                                <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
                                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                    {{ __('Edit') }}
                                </button>
                                <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1"
                                data-bs-dismiss="modal">
                                    {{ __('Batal') }}
                                </button>
                            </div>
                        </form>
                        <div class="col-12">
                            <div style="text-align: center;">
                                <ul style="list-style: none; padding-top:50px;">
                                    <li style="font-weight: 400;font-size: 14px; text-align: left;color: black;">
                                        {{ __('Reminder:') }} <br>
                                        {{ __('Untuk seluruh member PUI-PT IS-IoT jangan lupa menggunakan affiliasi University Center of Excellence for Intelligent Sensing-IoT, Telkom University, Indonesia pada jurnal masing masing') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- ========== modal end =========== -->
