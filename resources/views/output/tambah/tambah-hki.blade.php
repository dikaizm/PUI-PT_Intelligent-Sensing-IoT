<form action="{{ route('output-detail.store-hki') }}" method="POST">
  @csrf
  @method('POST')
  <div class="input-style-1">
    <label for="judul_penelitian">{{ __('Judul Penelitian') }}</label>
    <input type="hidden" name="uuid" value="{{ isset($penelitian) ? $penelitian->uuid : '' }}">
    <input @error('judul_penelitian') class="form-control is-invalid" @enderror type="text" name="judul_penelitian"
      id="judul_penelitian" placeholder="{{ __('Judul Penelitian') }}"
      value="{{ old('judul_penelitian', $penelitian->judul ?? '') }}" @if (isset($penelitian->judul)) readonly @endif>
    @error('judul_penelitian')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
  <div class="input-style-1">
    <label for="jenis_output_id">{{ __('Jenis') }}</label>
    <select id="jenis_output_id" name="jenis_output_id" class="form-control">
      <option value="">--Pilih Jenis--</option>
      @foreach ($jenis_output as $item)
        @php
          $jenisOutputKey = $item->jenisOutputKey->name;
          $outputName = $item->name;
        @endphp
        @if (in_array($jenisOutputKey, ['HKI']))
          <option value="{{ $item->id }}">{{ $jenisOutputKey }} {{ $outputName }}</option>
        @endif
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
    <label>{{ __('Inventor') }}</label>
    <div id="input-anggota-hki"></div>
  </div>

  <div class="input-style-1">
    <label for="status_output_id">{{ __('Status Output') }}</label>
    <select id="status_output_id" name="status_output_id" class="form-control">
      <option value="">{{ __('Pilih Jenis') }}</option>
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
  <div class="action d-flex justify-content-end flex-wrap">
    <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
      style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
      {{ __('Simpan') }}
    </button>
    {{-- <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1" data-bs-dismiss="modal">
            {{ __('Batal') }}
        </button> --}}
  </div>
</form>
