<form action="#">
    <div class="input-style-1">
        <label for="judul_penelitian">{{ __('Judul Penelitian') }}</label>
        <input @error('judul_penelitian') class="form-control is-invalid" @enderror type="text"
        name="judul_penelitian" id="judul_penelitian" placeholder="{{ __('Judul Penelitian') }}" value="{{ old('judul_penelitian', request()->query('judul')) }}">
        @error('judul_penelitian')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label
        for="tipePublikasi"
        >{{ __('Tipe') }}</label>
        <select id="tipePublikasi" name="tipePublikasi" class="form-control">
            <option value="">Pilih Tipe</option>
            @foreach ($tipe as $item)
            <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
        @error('tipePublikasi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="jenis_output_id">{{ __('Jenis') }}</label>
        <select id="jenis_output_id" name="jenis_output_id" class="form-control">
            <option value="">Pilih Jenis</option>
            @foreach ($jenis_output as $item)
            <option value="{{ $item->id }}">{{ $item->jenisOutputKey->name }} {{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-style-1">
        <label for="judul_output" >{{ __('Judul Publikasi') }}</label>
        <input @error('judul_output') class="form-control is-invalid" @enderror type="text"
            name="judul_output" id="judul_output" placeholder="{{ __('Judul Publikasi') }}" value="{{ old('judul_output') }}">
        @error('judul_output')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label>{{ __('Author') }}</label>
        <select name="user_id[]" class="form-control select2" multiple="multiple"
            style="width: 100%; height: 58px;" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}"
                    @if (old('user_id') && in_array($user->id, old('user_id'))) selected @endif>{{ $user->name }}</option>
            @endforeach
        </select>
        @error('user_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="corresponding">{{ __('Corresponding') }}</label>
        <div id="inputContainer">
            <div class="input-style-1">
                <input type="text" name="corresponding" id="corresponding"
                placeholder="{{ __('Corresponding') }}" value="{{ old('corresponding') }}" required class="form-control
                       @error('corresponding') is-invalid @enderror">
                @error('corresponding')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="input-style-1">
        <label for="status_output">{{ __('Status Output') }}</label>
        <select
            class="form-control @error('status_output') is-invalid @enderror"
            name="status_output"
            id="status_output"
            style="max-width: 100%; margin: 0 auto;">
            <option value="">Pilih Status</option>
            @foreach ($status_output as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        @error('status_output')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="tanggal_publish">{{ __('Tanggal Publish') }} <span style="color:gray;">{{ __('*Diisi jika memilih status Published') }}</span></label>
        @error('status_penelitian')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <input type="date" id="dateInput" required>
    </div>
    <div class="input-style-1">
        <label for="tautan">{{ __('Link Jurnal') }} <span style="color:gray;">{{ __('*Apabila sudah publish') }}</span> </label>
        <input @error('tautan') class="form-control is-invalid" @enderror type="text"
            name="tautan" id="tautan" placeholder="{{ __('Link Jurnal') }}" value="{{ old('tautan') }}">
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
        <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1"
            data-bs-dismiss="modal">
            {{ __('Batal') }}
        </button>
    </div>
</form>
