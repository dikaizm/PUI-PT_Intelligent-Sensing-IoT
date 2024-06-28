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

        <form action="{{ route('output-detail.update-video', ['id' => $output->id]) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="input-style-1">
            <label for="judul_output">{{ __('Judul Foto/Poster') }}</label>
            <input @error('judul_output') class="form-control is-invalid" @enderror type="text" name="judul_output"
              id="judul_output" placeholder="{{ __('Judul Foto/Poster') }}"
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
            <label for="jenis_output_id">{{ __('Jenis') }}</label>
            <select id="jenis_output_id" name="jenis_output_id" class="form-control">
              <option value="">--Pilih Video--</option>
              @foreach ($jenis_output as $item)
                @php
                  $jenisOutputKey = $item->jenisOutputKey->name;
                  $outputName = $item->name;
                @endphp
                @if (in_array($jenisOutputKey, ['Video']))
                  <option value="{{ $item->id }}"
                    {{ old('jenis_output_id', $output->jenis_output_id) == $item->id ? 'selected' : '' }}>
                    {{ $outputName }}
                  </option>
                @endif
              @endforeach
            </select>
          </div>

          <div class="input-style-1">
            <label for="tautan">{{ __('Link Foto/Poster') }} <span
                style="color:gray;">{{ __('*Apabila sudah publish') }}</span>
            </label>
            <input @error('tautan') class="form-control is-invalid" @enderror type="text" name="tautan" id="tautan"
              placeholder="{{ __('Link Foto/Poster') }}" value="{{ old('tautan', $output->tautan) }}">
            @error('tautan')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="action d-flex justify-content-end flex-wrap">
            <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
              style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);" data-bs-dismiss="modal">
              {{ __('Simpan') }}
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <script></script>
@endsection
