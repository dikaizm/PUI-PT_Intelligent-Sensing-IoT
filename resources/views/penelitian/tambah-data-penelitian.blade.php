@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Tambah Data Penelitian') }}</h2>
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

                @include('alert')

                <form action="{{ route('penelitian.store') }}" method="POST">
                    @csrf
                    @method('post')

                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label style="text-align: left;" for="skema">
                                    {{ __('Pilih Skema Penelitian') }}
                                </label>
                                <select class="form-control @error('skema') is-invalid @enderror" name="skema_id"
                                    id="skema" style="max-width: 100%; margin: 0 auto;">
                                    @foreach ($skema as $s)
                                        <option value="{{ $s->id }}"
                                            @if (old('skema') == $s->id) selected @endif>
                                            {{ $s->name }}
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
                        <!-- end col -->
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="judul">{{ __('Judul Penelitian') }}</label>
                                <input @error('judul') class="form-control is-invalid" @enderror type="judul"
                                    name="judul" id="judul" placeholder="{{ __('Judul Penelitian') }}"
                                    value="{{ old('judul') }}">
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="user_id">{{ __('Anggota Tim') }}</label>
                                <select name="user_id[]" class="form-control select2" multiple="multiple"
                                    style="width: 100%; height: 58px;" required>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if(old('user_id') && in_array($user->id, old('user_id'))) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="mt-2">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#modalTambahAnggotaEksternal"
                                        style="font-size:20px; color: red !important;">
                                        {{ __('Tambah Anggota Eksternal') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="is_ketua">{{ __('Ketua Tim') }}</label>
                                <select name="is_ketua" id="is_ketua" class="form-control select2" style="width: 100%; height: 58px;" required>
                                    <option value="">-- Pilih Ketua Tim --</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if(old('is_ketua') == $user->id) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('is_ketua')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="statusPenelitian">
                                {{ __('Status Penelitian') }}
                            </label>
                            <select class="form-control @error('status_penelitian_id') is-invalid @enderror"
                                name="status_penelitian_id" id="statusPenelitian" style="max-width: 100%; margin: 0 auto;">
                                @foreach ($status_penelitian as $status)
                                    <option value="{{ $status->id }}" @if (old('status_penelitian_id') == $status->id) selected @endif>
                                        {{ $status->statusPenelitianKey->name }} {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_penelitian_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="mitra">{{ __('Mitra Penelitian') }}</label>
                            <input type="text" @error('mitra') class="form-control is-invalid" @enderror name="mitra"
                                id="mitra" placeholder="{{ __('Mitra Penelitian') }}" value="{{ old('mitra') }}">
                            @error('mitra')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="jenisPenelitian">
                                {{ __('Jenis Penelitian') }}
                            </label>
                            <select class="form-control @error('jenis_penelitian_id') is-invalid @enderror"
                                name="jenis_penelitian_id" id="jenisPenelitian" style="max-width: 100%; margin: 0 auto;">
                                @foreach ($jenis_penelitian as $jenis)
                                    <option value="{{ $jenis->id }}" @if (old('jenis_penelitian_id') == $jenis->id) selected @endif>
                                        {{ $jenis->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_penelitian_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="jangka_waktu">{{ __('Jangka Waktu Penelitian') }}</label>
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-4 input-style-1">
                                    <input type="number" @error('jangka_waktu') class="form-control is-invalid" @enderror
                                        name="jangka_waktu" id="jangka_waktu" placeholder="{{ __('Jangka') }}"
                                        value="{{ old('jangka_waktu') }}">
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
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="pendanaan">{{ __('Pendanaan') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" name="pendanaan" id="" placeholder="{{ __('Nominal') }}"
                                    class="form-control" min="0" value="{{ old('pendanaan') }}">
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="tingkatan_tkt">{{ __('Tingkatan TKT') }}</label>
                            <input type="number" placeholder="{{ __('1-9') }}"
                                @error('tingkatan_tkt') class="form-control" min="1"
                                max="9" @enderror
                                name="tingkatan_tkt" id="tingkatan_tkt" placeholder="{{ __('Jangka') }}"
                                value="{{ old('tingkatan_tkt') }}">
                            @error('tingkatan_tkt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="file">{{ __('File Penelitian') }}</label>
                                <input type="file" name="file" accept=".pdf"
                                class="form-control @error('file') is-invalid @enderror"
                                placeholder="{{ __('File Penelitian') }}" value="{{ old('file') }}">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- end col -->
                        <div>
                            <label for="arsip" style="font-size: 20px;font-weight: 500;color: $dark;display: block;margin-bottom: 10px;margin-left:20px;">{{ __('Arsip') }}</label>
                            <div class="form-check" style="width: 100%;">
                                <input class="form-check-input" type="checkbox" value="arsip" id="checkbox-jenis-output-1" style="margin-left: 0px;">
                                <label class="form-check-label" for="checkbox-jenis-output-1" style="font-size:16px; margin-left: 25px;">
                                    {{ __('Masukkan ke Arsip') }}
                                </label>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>

                    <div class="col-12">
                        <div class="button-group d-flex justify-content-center flex-wrap pt-20">
                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center"
                                style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                {{ __('Tambahkan') }}
                            </button>
                        </div>
                    </div>
                    <!-- end col -->
                    {{-- <div class="col-12">
                        <div style="text-align: center;">
                            <ul style="list-style: none; padding-left:15%;padding-top:75px;">
                                <li style="font-weight: 400;font-size: 20px; text-align: left;color: gray;">
                                    {{ __('Note: Apabila penelitian sudah selesai silahkan laporkan tombol laporan output penelitian dibawah ini!') }}
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                    <!-- end col -->
                    {{-- <div class="col-12">
                        <div class="button-group d-flex justify-content-center flex-wrap">
                            <button type="button" class="main-btn primary-btn btn-hover w-100 text-center"
                                style="background: linear-gradient(90deg, #4737FF 0%, #2B2199 100%);"
                                data-bs-toggle="modal" data-bs-target="#modalLaporkanOutput">
                                {{ __('Laporkan Output Penelitian') }}
                            </button>
                        </div>
                    </div> --}}
                    <!-- end col -->

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

