<form action="{{ route('output-detail.store-hki') }}" method="POST">
    @csrf
    @method('POST')
    <div class="input-style-1">
        <label for="judul_penelitian">{{ __('Judul Penelitian') }}</label>
        <input type="hidden" name="uuid" value="{{ isset($penelitian) ? $penelitian->uuid : '' }}">
        <input @error('judul_penelitian') class="form-control is-invalid" @enderror type="text" name="judul_penelitian"
            id="judul_penelitian" placeholder="{{ __('Judul Penelitian') }}"
            value="{{ old('judul_penelitian', $penelitian->judul ?? '') }}"
            @if (isset($penelitian->judul)) readonly @endif>
        @error('judul_penelitian')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="jenis_output_id">{{ __('Jenis') }}</label>
        <select id="jenis_output_id" name="jenis_output_id" class="form-control">
            <option value="">{{ __('Pilih Jenis') }}</option>
            @foreach ($jenis_output as $item)
                <option value="{{ $item->id }}">{{ $item->jenisOutputKey->name }} {{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-style-1">
        <label for="judul_output">{{ __('Judul HKI') }}</label>
        <input @error('judul_output') class="form-control is-invalid" @enderror type="text" name="judul_output"
            id="judul_output" placeholder="{{ __('Judul HKI') }}" value="{{ old('judul_output') }}">
        @error('judul_output')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label>{{ __('Author') }}</label>
        <select name="user_id[]" class="form-control select2 @error('user_id[]') is-invalid @enderror"
            multiple="multiple" style="width: 100%; height: 58px;" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @if (isset($penelitian) && $penelitian && in_array($user->id, $penelitian->users->pluck('id')->toArray())) selected @endif>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('user_id[]')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="mt-2">
            <a type="button" data-bs-toggle="modal" data-bs-target="#modalTambahAnggotaEksternal2"
                style="font-size:20px; color: red !important;">
                {{ __('Tambah Anggota Eksternal') }}
            </a>
        </div>
    </div>
    <div class="input-style-1">
        <label for="status_output_id">{{ __('Status Output') }}</label>
        <select id="status_output_id" name="status_output_id" class="form-control">
            <option value="">{{ __('Pilih Jenis') }}</option>
            @foreach ($status_output as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        @error('status_output_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="#">{{ __('Tanggal Granted') }} <span
                style="color:gray;">{{ __('*Diisi jika memilih status Granted') }}</span></label>
        <input type="date" id="dateInput" name="published_at">
        @error('published_at')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="tautan">{{ __('Link HKI') }} <span style="color:gray;">{{ __('*Apabila sudah publish') }}</span>
        </label>
        <input @error('tautan') class="form-control is-invalid" @enderror type="text" name="tautan" id="tautan"
            placeholder="{{ __('Link HKI') }}" value="{{ old('tautan') }}">
        @error('tautan')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="action d-flex flex-wrap justify-content-end">
        <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
            style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
            {{ __('Simpan') }}
        </button>
        <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1" data-bs-dismiss="modal">
            {{ __('Batal') }}
        </button>
    </div>
</form>

<div class="modal fade" id="modalTambahAnggotaEksternal2" tabindex="-1" aria-labelledby="ModalFourLabel"
    aria-hidden="true">
    <div class="modal-dialog"
        style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <form action="{{ route('user.external-store') }}" method="POST">
                        @csrf
                        @method('post')

                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="nameTambah">{{ __('Nama Lengkap') }}</label>
                                    <input type="text" @error('name') class="form-control is-invalid" @enderror
                                        name="name" id="nameTambah" placeholder="{{ __('Nama Lengkap') }}"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="action d-flex flex-wrap justify-content-end">
                                <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
                                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                    {{ __('Tambah') }}
                                </button>
                            </div>
                            <!-- end col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

