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

        @include('alert')

        <form action="{{ route('penelitian.update', $penelitian->uuid) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-12">
              <div class="input-style-1">
                <label for="skema_id">
                  {{ __('Skema Penelitian') }}
                </label>
                <div id="skema-container" class="select-container">
                  <select name="skema_id" id="skema" class="form-control @error('skema_id') is-invalid @enderror">
                    @foreach ($skema as $item)
                      <option value="{{ $item->id }}" {{ $penelitian->skema_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                      </option>
                    @endforeach
                    <option id="skema_other">Lainnya</option>
                  </select>
                </div>
                @error('skema_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="input-style-1">
                <label for="judul">{{ __('Judul Penelitian') }}</label>
                <input type="text" name="judul" id="judul"
                  class="form-control @error('judul') is-invalid @enderror" placeholder="{{ __('Judul Penelitian') }}"
                  value="{{ old('judul', $penelitian->judul) }}">
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
                <div id="input-anggota">

                  <script>
                    window.selectedUsers = {!! $users !!}
                  </script>

                </div>

              </div>
            </div>
            <!-- end col -->
            <div class="col-12">
              <div class="input-style-1">
                <label for="is_ketua">
                  @if ($userKetua)
                    Ketua Sekarang: {{ $userKetua->name }} <br>
                    <span style="color: gray;">Pilih untuk mengganti ketua</span>
                  @else
                    Pilih Ketua
                  @endif
                </label>
                <select name="is_ketua" id="is_ketua"
                  class="form-control select2 @error('is_ketua') is-invalid @enderror" style="width: 100%; height: 58px;"
                  data-selected="{{ $is_ketua }}">
                  <option value="">Ketua Tim</option>

                  @foreach ($users as $user)
                    <option
                      value="{{ $user->id }}"{{ isset($userKetua) && $user->id == $userKetua->id ? 'selected' : '' }}>
                      {{ $user->name }}
                    </option>
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
              <label for="status_penelitian_id">{{ __('Status Penelitian') }}</label>
              <select id="status_penelitian_id" name="status_penelitian_id"
                class="form-control @error('status_penelitian_id') is-invalid @enderror">
                @foreach ($status_penelitian as $item)
                  <option value="{{ $item->id }}"
                    {{ $penelitian->status_penelitian_id == $item->id ? 'selected' : '' }}>
                    {{ $item->statusPenelitianKey->name }} {{ $item->name }}
                  </option>
                @endforeach
              </select>
              @error('status_penelitian_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="input-style-1">
              <label for="mitra">{{ __('Mitra Penelitian') }}</label>
              <input type="text" name="mitra" id="mitra"
                class="form-control @error('mitra') is-invalid @enderror" placeholder="{{ __('Mitra Penelitian') }}"
                value="{{ old('mitra', $penelitian->mitra) }}">
              @error('mitra')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="input-style-1">
              <label for="jenis_penelitian_id">{{ __('Jenis Penelitian') }}</label>
              <div id="jenisPenelitian-container" class="select-container">
                <select id="jenisPenelitian" name="jenis_penelitian_id"
                  class="form-control @error('jenis_penelitian_id') is-invalid @enderror" style="max-width: 100%; margin: 0 auto;">
                  @foreach ($jenis_penelitian as $item)
                    <option value="{{ $item->id }}"
                      {{ $penelitian->jenis_penelitian_id == $item->id ? 'selected' : '' }}>
                      {{ $item->name }}
                    </option>
                  @endforeach
                  <option id="jenisPenelitian_other">Lainnya</option>
                </select>
              </div>
              @error('jenis_penelitian_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <!-- waktu mulai & waktu akhir -->
            <div class="d-flex gap-4">
              <div class="form-group w-100">
                <label for="waktu_mulai">Penelitian dimulai</label>
                <input type="date" id="waktu_mulai" class="form-control" name="waktu_mulai" required
                  value="{{ old('waktu_mulai', $penelitian->waktu_mulai) }}">
              </div>
              <div class="form-group w-100">
                <label for="waktu_akhir">Penelitian selesai</label>
                <input type="date" id="waktu_akhir" class="form-control" name="waktu_akhir"
                  value="{{ old('waktu_akhir', $penelitian->waktu_akhir) }}">
              </div>
            </div>

            <div class="input-style-1">
              <label for="jangka_waktu">{{ __('Jangka Waktu Penelitian') }}</label>
              <div class="input-group">

                <input type="number" class="form-control @error('jangka_waktu') is-invalid @enderror"
                  name="jangka_waktu" id="jangka_waktu" placeholder="{{ __('Jangka Waktu') }}"
                  value="{{ old('jangka_waktu', $penelitian->jangka_waktu) }}">
                <div class="input-group-prepend">
                  <span class="input-group-text">Bulan</span>
                </div>

                @error('jangka_waktu')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="input-style-1">
              <label for="pendanaan">{{ __('Pendanaan') }}</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input type="number" name="pendanaan" id="" placeholder="{{ __('Nominal') }}"
                  class="form-control @error('pendanaan') is-invalid @enderror" min="0"
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
              <input type="number" name="tingkatan_tkt" id="tingkatan_tkt"
                class="form-control @error('tingkatan_tkt') is-invalid @enderror" placeholder="{{ __('1-9') }}"
                min="1" max="9" value="{{ old('tingkatan_tkt', $penelitian->tingkatan_tkt) }}">
              @error('tingkatan_tkt')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="input-style-1">
              <label for="file">{{ __('Link Penelitian') }}</label>
              <input @error('link_penelitian') class="form-control is-invalid" @enderror type="text"
                name="link_penelitian" id="link_penelitian" placeholder="{{ __('Link Penelitian') }}"
                value="{{ old('link_penelitian', $penelitian->link_penelitian) }}">
              @error('link_penelitian')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            {{-- <div class="input-style-1">
              <label for="file">{{ __('File Penelitian') }}</label>
              <div class="row">
                <div class="col-12" id="inputContainer2">
                  <input type="file" name="file" accept=".pdf"
                    class="form-control @error('file') is-invalid @enderror" placeholder="{{ __('File Penelitian') }}">
                  @error('file')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
            </div>
            <div> --}}

            {{-- <label for="arsip"
              style="font-size: 20px;font-weight: 500;color: $dark;display: block;margin-bottom: 10px;margin-left:20px;">{{ __('Arsip') }}</label>
            <div class="form-check" style="width: 100%;">
              <input class="form-check-input @error('arsip') is-invalid @enderror" type="checkbox" name="arsip"
                value="1" {{ $penelitian->arsip ? 'checked' : '' }} id="checkbox-jenis-output-1"
                style="margin-left: 0px;">
              <label class="form-check-label" for="checkbox-jenis-output-1" style="font-size:16px; margin-left: 25px;">
                {{ __('Masukkan ke Arsip') }}
              </label>
              @error('arsip')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div> --}}

          </div>
          <!-- end col -->
          <div class="col-12">
            <div class="button-group d-flex justify-content-center flex-wrap pt-20">
              <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center"
                style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                {{ __('Edit') }}
              </button>
            </div>
          </div>
          {{-- <div class="col-12">
                            <div style="text-align: center;">
                                <ul style="list-style: none; padding-left:15%;padding-top:75px;">
                                    <li style="font-weight: 400;font-size: 20px; text-align: left;color: gray;">
                                        {{ __('Note: Apabila penelitian sudah selesai silahkan laporkan tombol laporan output penelitian dibawah ini!') }}
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
          {{-- <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="button" class="main-btn primary-btn btn-hover w-100 text-center"
                                    style="background: linear-gradient(90deg, #4737FF 0%, #2B2199 100%);"
                                    data-bs-toggle="modal" data-bs-target="#modalLaporkanOutput">
                                    {{ __('Laporkan Output Penelitian') }}
                                </button>
                            </div>
                        </div> --}}
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
