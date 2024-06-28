@extends('layouts.app')

@section('content')

  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="title mb-30">
          <h2>{{ __('Edit Output') }}</h2>
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

        <form action="{{ route('output-detail.update-publikasi', ['id' => $output->id]) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="input-style-1">
            <label for="jenis_output_id">{{ __('Jenis') }}</label>
            <select id="jenis_output_id" name="jenis_output_id" class="form-control" disabled>
              <option value="">--Pilih Jenis Output--</option>
              @foreach ($jenis_output as $item)
                <option value="{{ $item->id }}"
                  {{ old('jenis_output_id', $output->jenis_output_id) == $item->id ? 'selected' : '' }}>
                  {{ $item->jenisOutputKey->name }} {{ $item->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="input-style-1">
            <label for="tipe">{{ __('Tipe') }}</label>
            <select id="tipe" name="tipe" class="form-control">
              <option value="">--Pilih Tipe--</option>
              @foreach ($tipe as $tipeItem)
                <option value="{{ $tipeItem }}" {{ old('tipe', $output->tipe) == $tipeItem ? 'selected' : '' }}>
                  {{ $tipeItem }}
                </option>
              @endforeach
            </select>
          </div>
          @error('tipe')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror

          <div class="input-style-1">
            <label for="judul_output">{{ __('Judul Publikasi') }}</label>
            <input @error('judul_output') class="form-control is-invalid" @enderror type="text" name="judul_output"
              id="judul_output" placeholder="{{ __('Judul Publikasi') }}"
              value="{{ old('judul_output', $output->judul) }}">
            @error('judul_output')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="input-style-1">
            <label>{{ __('Author') }}</label>
            <div id="input-anggota-publikasi">
                <script>
                    window.selectedUsers = {!! $authors !!}
                  </script>
            </div>
          </div>

          <div class="input-style-1">
            <label for="is_corresponding">
                  @if ($userCorresponding)
                    Corresponding Sekarang: {{ $userCorresponding->name }} <br>
                    <span style="color: gray;">Pilih untuk mengganti Corresponding</span>
                  @else
                    Pilih Corresponding
                  @endif
                </label>
            <select name="is_corresponding" id="is_corresponding" class="form-control select2"
              style="width: 100%; height: 58px;" data-selected="{{ isset($userCorresponding) ? $userCorresponding->id : '' }}" required>
              <option value="">Pilih Corresponding</option>

              @if (is_array($authors))

                @foreach ($authors as $user)
                  <option value="{{ $user->id }}"
                    {{ isset($userCorresponding) == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                  </option>
                @endforeach

              @endif

            </select>
            @error('is_corresponding')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="input-style-1">
            <label for="status_output_id">{{ __('Status Output') }}</label>
            <select class="form-control @error('status_output_id') is-invalid @enderror" name="status_output_id"
              id="status_output_id" style="max-width: 100%; margin: 0 auto;">
              <option value="">Pilih Status</option>
              @foreach ($status_output as $item)
                <option value="{{ $item->id }}"
                  {{ old('status_output_id', $output->status_output_id) == $item->id ? 'selected' : '' }}>
                  {{ $item->name }}
                </option>
              @endforeach
            </select>
            @error('status_output_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="input-style-1">
            <label for="published_at">{{ __('Tanggal Publish') }} <span
                style="color:gray;">{{ __('*Diisi jika memilih status Published') }}</span></label>
            <input type="date" id="dateInput" name="published_at"
              value="{{ old('published_at', $output->published_at) }}">
            @error('published_at')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="input-style-1">
            <label for="tautan">{{ __('Link Jurnal') }} <span
                style="color:gray;">{{ __('*Apabila sudah publish') }}</span> </label>
            <input @error('tautan') class="form-control is-invalid" @enderror type="text" name="tautan" id="tautan"
              placeholder="{{ __('gunakan http:// atau https://') }}" value="{{ old('tautan', $output->tautan) }}">
            @error('tautan')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="action d-flex justify-content-end flex-wrap">
            <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
              style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
              {{ __('Simpan') }}
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <script></script>
@endsection
