<form action="{{ route('output-detail.store-foto-poster') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('POST')
  <div class="tab-pane fade show active" id="v-pills-judul" role="tabpanel" aria-labelledby="v-pills-judul-tab">

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
      <label for="judul_output">{{ __('Judul Foto/Poster') }}</label>
      <input type="hidden" name="uuid" value="{{ isset($penelitian) ? $penelitian->uuid : '' }}">
      <input @error('judul_output') class="form-control is-invalid" @enderror type="text" name="judul_output"
        id="judul_output" placeholder="{{ __('Judul Foto/Poster') }}" value="{{ old('judul_output') }}">
      @error('judul_output')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="input-style-1">
      <label>{{ __('Author') }}</label>
      <div id="input-anggota-foto"></div>
    </div>

    <div class="input-style-1">
      <label for="jenis_output_id">{{ __('Jenis') }}</label>
      <select id="jenis_output_id" name="jenis_output_id" class="form-control">
        <option value="">--Pilih Foto/Poster--</option>
        @foreach ($jenis_output as $item)
          @php
            $jenisOutputKey = $item->jenisOutputKey->name;
            $outputName = $item->name;
          @endphp
          @if (in_array($jenisOutputKey, ['Foto/Poster']))
            <option value="{{ $item->id }}">{{ $outputName }}</option>
          @endif
        @endforeach
      </select>
    </div>

    <div class="input-style-1">
      <label for="status_output_id">{{ __('Status Output') }}</label>
      <select class="form-control @error('status_output_id') is-invalid @enderror" name="status_output_id"
        id="status_output_id" style="max-width: 100%; margin: 0 auto;">
        <option value="">Pilih Status</option>
        @foreach ($status_output as $item)
          <option value="{{ $item->id }}" {{ old('status_output_id') == $item->id ? 'selected' : '' }}>
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
      <label for="tautan">{{ __('Link Foto/Poster') }} <span
          style="color:gray;">{{ __('*Apabila sudah publish') }}</span> </label>
      <input @error('tautan') class="form-control is-invalid" @enderror type="text" name="tautan" id="tautan"
        placeholder="{{ __('gunakan http:// atau https://') }}" value="{{ old('tautan') }}">
      @error('tautan')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div class="action d-flex justify-content-end flex-wrap">
    <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
      style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
      {{ __('Simpan') }}
    </button>
  </div>
</form>
