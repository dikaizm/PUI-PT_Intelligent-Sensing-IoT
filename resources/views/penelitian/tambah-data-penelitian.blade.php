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
                <form action="{{ route('penelitian.store') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="name">{{ __('Skema Penelitian') }}</label>
                                <input @error('name') class="form-control is-invalid" @enderror type="text"
                                    name="name" id="name" placeholder="{{ __('Skema Penelitian') }}">
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
                                <label for="email">{{ __('Judul Penelitian') }}</label>
                                <input @error('email') class="form-control is-invalid" @enderror type="email"
                                    name="email" id="email" placeholder="{{ __('Judul Penelitian') }}">
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
                                <label for="password">{{ __('Ketua Tim') }}</label>
                                <input type="password"
                                    @error('password') class="form-control is-invalid"
                                        @enderror
                                    name="password" id="password" placeholder="{{ __('Ketua Tim') }}">
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
                                <label for="password_confirmation">{{ __('Anggota Tim') }}</label>
                                <div class="row">
                                    <div class="col-8" id="inputContainer">
                                        <div class="input-style-1">
                                            <input type="text" name="name" {{-- id="nameEdit{{ $user->id }}" --}}
                                                placeholder="{{ __('Name') }}" {{-- value="{{ old('name', $user->name) }}" --}} required
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
                                                <i class="lni lni-plus"
                                                    style="color: black; margin:15px; font-size: 30px;"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-3" id="tambahAnggotaContainer">
                                        <div style="display: flex; flex-direction: column;">
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalTambahAnggotaEksternal"
                                                style="font-size:20px; color: red !important;">
                                                {{ __('Tambah Anggota') }} <br> {{ __('Eksternal') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="nip">{{ __('Status Penelitian') }}</label>
                            <select id="statusPenelitian" name="statusPenelitian" class="form-control">
                                <option value="submitted">Submitted</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                                <option value="on_going">On going</option>
                                <option value="finished">Finished</option>
                            </select>
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="telp">{{ __('Mitra Penelitian') }}</label>
                            <input type="text" @error('telp') class="form-control is-invalid" @enderror name="telp"
                                id="telp" placeholder="{{ __('Mitra Penelitian') }}">
                            @error('telp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="keahlian">{{ __('Jenis Penelitian') }}</label>
                            <select id="statusPenelitian" name="statusPenelitian" class="form-control">
                                <option value="submitted">Dasar</option>
                                <option value="accepted">Terapan</option>
                            </select>
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="fakultas">{{ __('Jangka Waktu Penelitian') }}</label>
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-4 input-style-1">
                                    <input type="number" placeholder="{{ __('Berapa') }}" class="form-control"
                                        min="1">
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
                            <label for="link_google_scholar">{{ __('Pendanaan') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" id="nominalInput" placeholder="{{ __('Nominal') }}"
                                    class="form-control" min="0">
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="link_sinta">{{ __('Tingkatan TKT') }}</label>
                            <input type="number" placeholder="{{ __('1-9') }}" class="form-control" min="1"
                                max="9">
                        </div>
                        <!-- end col -->
                        <div class="input-style-1">
                            <label for="email_verified_at">{{ __('File Penelitian') }}</label>
                            <div class="row">
                                <div class="col-8" id="inputContainer2">
                                    <div class="input-style-1">
                                        <input type="file" accept=".pdf"
                                            @error('name') class="form-control is-invalid" @enderror name="name"
                                            placeholder="{{ __('Name') }}" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-1" id="iconContainer2">
                                    <div style="display: flex; flex-direction: column;">
                                        <button type="button" id="addButton2" style="border: none; background: none;">
                                            <i class="lni lni-plus"
                                                style="color: black; margin:15px; font-size: 30px;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center"
                                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                    {{ __('Tambahkan') }}
                                </button>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div style="text-align: center;">
                                <ul style="list-style: none; padding-left:15%;padding-top:75px;">
                                    <li style="font-weight: 400;font-size: 20px; text-align: left;color: gray;">
                                        {{ __('Note: Apabila penelitian sudah selesai silahkan laporkan tombol laporan output penelitian dibawah ini!') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="button" class="main-btn primary-btn btn-hover w-100 text-center"
                                    style="background: linear-gradient(90deg, #4737FF 0%, #2B2199 100%);"
                                    data-bs-toggle="modal" data-bs-target="#modalLaporkanOutput">
                                    {{ __('Laporkan Output Penelitian') }}
                                </button>
                            </div>
                        </div>
                        <!-- end col -->
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

