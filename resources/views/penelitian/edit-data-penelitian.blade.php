@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Edit Data Penelitian') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
            <div class="card-content">

                <form action="{{ route('profile.update', $penelitian->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="skema">{{ __('Skema Penelitian') }}</label>
                                <select name="skema" id="skema" class="form-control">
                                    @foreach ($skema as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $penelitian->skema_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('skema')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="judul">{{ __('Judul Penelitian') }}</label>
                                <input type="text" name="judul" id="judul" class="form-control"
                                    placeholder="{{ __('Judul Penelitian') }}"
                                    value="{{ old('judul', $penelitian->judul) }}">
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="ketua_tim">{{ __('Ketua Tim') }}</label>
                                <input type="text" name="ketua_tim" id="ketua_tim" class="form-control"
                                    placeholder="{{ __('Ketua Tim') }}"
                                    value="{{ old('ketua_tim', auth()->user()->name) }}">
                                @error('ketua_tim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="anggota_tim">{{ __('Anggota Tim') }}</label>
                                <div class="row">
                                    <div class="col-8" id="inputContainer">
                                        @foreach ($penelitian->users as $user)
                                            <input type="text" name="anggota_tim[]" class="form-control"
                                                placeholder="{{ __('Name') }}" value="{{ $user->name }}">
                                            <input type="hidden" name="user_id[]" value="{{ $user->id }}">
                                            @error('anggota_tim')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endforeach
                                    </div>
                                    <div class="col-1" id="iconContainer">
                                        <button type="button" id="addButton" style="border: none; background: none;">
                                            <i class="lni lni-plus" style="color: black; margin:15px; font-size: 30px;"></i>
                                        </button>
                                    </div>
                                    <div class="col-lg-3" id="tambahAnggotaContainer">
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalTambahAnggotaEksternal"
                                            style="font-size:20px; color: red !important;">
                                            {{ __('Tambah Anggota Eksternal') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-style-1">
                            <label for="status_penelitian">{{ __('Status Penelitian') }}</label>
                            <select id="status_penelitian" name="status_penelitian" class="form-control">
                                @foreach ($status_penelitian as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $penelitian->status_penelitian_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
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
                            <label for="mitra">{{ __('Mitra Penelitian') }}</label>
                            <input type="text" name="mitra" id="mitra"
                                class="form-control @error('mitra') is-invalid @enderror"
                                placeholder="{{ __('Mitra Penelitian') }}" value="{{ old('mitra', $penelitian->mitra) }}">
                            @error('mitra')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="jenis_penelitian">{{ __('Jenis Penelitian') }}</label>
                            <select id="jenis_penelitian" name="jenis_penelitian" class="form-control">
                                @foreach ($jenis_penelitian as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $penelitian->jenis_penelitian_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_penelitian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="jangka_waktu">{{ __('Jangka Waktu Penelitian') }}</label>
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-4 input-style-1">
                                    <input type="number" name="jangka_waktu" class="form-control"
                                        placeholder="{{ __('Berapa') }}" min="1"
                                        value="{{ old('jangka_waktu', $penelitian->jangka_waktu) }}">
                                    @error('jangka_waktu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-xl-10 col-lg-10 col-md-8">
                                    <ul style="padding-left:0%;">
                                        <li style="font-weight: 400;font-size: 40px; text-align: left;color:gray;">
                                            {{ __('Bulan') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="input-style-1">
                            <label for="pendanaan">{{ __('Pendanaan') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" name="pendanaan" id="pendanaan" class="form-control"
                                    placeholder="{{ __('Nominal') }}"
                                    value="{{ old('pendanaan', $penelitian->pendanaan) }}">
                                @error('pendanaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-style-1">
                            <label for="tingkatan_tkt">{{ __('Tingkatan TKT') }}</label>
                            <input type="number" name="tingkatan_tkt" id="tingkatan_tkt" class="form-control"
                                placeholder="{{ __('1-9') }}" min="1" max="9"
                                value="{{ old('tingkatan_tkt', $penelitian->tingkatan_tkt) }}">
                            @error('tingkatan_tkt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="file">{{ __('File Penelitian') }}</label>
                            <div class="row">
                                <div class="col-11" id="inputContainer2">
                                    <input type="file" name="file" accept=".pdf"
                                        class="form-control @error('file') is-invalid @enderror"
                                        placeholder="{{ __('File Penelitian') }}">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center"
                                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div style="text-align: center;">
                                <ul style="list-style: none; padding-left:15%;padding-top:75px;">
                                    <li style="font-weight: 400;font-size: 20px; text-align: left;color: gray;">
                                        {{ __('Note: Apabila penelitian sudah selesai silahkan laporkan tombol laporan output penelitian dibawah ini!') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="button" class="main-btn primary-btn btn-hover w-100 text-center"
                                    style="background: linear-gradient(90deg, #4737FF 0%, #2B2199 100%);"
                                    data-bs-toggle="modal" data-bs-target="#modalLaporkanOutput">
                                    {{ __('Laporkan Output Penelitian') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- ========== modal status =========== -->
    @include('penelitian.modal-tambah-anggota-eksternal')
    <!-- ========== modal end =========== -->

    <!-- ========== modal status =========== -->
    @include('penelitian.modal-tombol-penelitian')
    <!-- ========== modal end =========== -->
@endsection

