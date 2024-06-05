<form action="#">
    <div class="input-style-1">
        <label for="judul_penelitian">{{ __('Judul Penelitian') }}</label>
        <input @error('judul_penelitian') class="form-control is-invalid" @enderror type="text" name="judul_penelitian"
            id="judul_penelitian" placeholder="{{ __('Judul Penelitian') }}"
            value="{{ old('judul_penelitian', $penelitian->judul ?? '') }}"
            @if (isset($penelitian->judul)) readonly @endif>
        @error('judul')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="judul_output">{{ __('Judul Output') }}</label>
        <input @error('judul_output') class="form-control is-invalid" @enderror type="text" name="judul_output"
            id="judul_output" placeholder="{{ __('Judul Output') }}" value="{{ old('judul_output') }}">
        @error('judul_output')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="tautan">{{ __('Link Video') }}</label>
        <input @error('tautan') class="form-control is-invalid" @enderror type="text" name="tautan" id="tautan"
            placeholder="{{ __('Link Video') }}" value="{{ old('tautan') }}">
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

