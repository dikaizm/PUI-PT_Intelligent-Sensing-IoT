<form action="">
    <div class="tab-pane fade show active" id="v-pills-judul" role="tabpanel" aria-labelledby="v-pills-judul-tab">
        <div class="input-style-1">
            <label for="judul_penelitian">{{ __('Judul Penelitian') }}</label>
            <input @error('judul_penelitian') class="form-control is-invalid" @enderror type="text"
                name="judul_penelitian" id="judul_penelitian" placeholder="{{ __('Judul Penelitian') }}"
                value="{{ old('judul_penelitian', $penelitian->judul ?? '') }}"
                @if (isset($penelitian->judul)) readonly @endif>
            @error('judul_penelitian')
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
            <label for="file">{{ __('File Foto') }}</label>
            <input type="file" name="file" accept=".pdf" class="form-control @error('file') is-invalid @enderror"
                placeholder="{{ __('File Foto') }}" value="{{ old('file') }}">
            @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
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

